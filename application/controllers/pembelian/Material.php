<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('pembelian/M_material');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function id_kary() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];
	}

	function index() {
		$menu = $_GET['mn'];
		$id_kary = $this->id_kary();
		$data['status'] = $this->M_material->status_menu($menu, $id_kary);
		
		$bagian = $this->M_material->bagian();
		if ($bagian == 'GUDANG' || $bagian == 'PENGEMBANGAN' || $bagian == 'PPIC' || $bagian == 'SYSTEM') {
			$data['kategori'] = 'PRODUKSI';
		} elseif ($bagian == 'TEKNISI' || $bagian == 'UMUM') {
			$data['kategori'] = 'NON PRODUKSI';
		} else {
			$data['kategori'] = '';
		}

		$data['satuan'] = $this->M_material->satuan();
		$data['fKategori'] = $this->M_material->fKategori();
		$data['jenis'] = $this->M_material->jenis();
		$data['karyawan'] = $this->M_material->karyawan();

		$data['approved'] = 'true';

		$data['rekjurnal'] = $this->M_material->rekjurnal();
		$data['nama_barang_sakti'] = $this->M_material->nama_barang_sakti();
		$data['nama_barang_sakti_baru'] = $this->M_material->nama_barang_sakti_baru();
		$data['supplier'] = $this->M_material->supplier();
		$data['simpg'] = $this->M_material->simpg();

		$this->load->view('pembelian/v_material.php', $data);
	}

	function cek_barang() {
		$data = $this->input->post('data');
		$nama = strtoupper($data[0]);
		$spesifikasi = strtoupper($data[1]);

		$cek_barang = $this->M_material->cek_barang($nama, $spesifikasi);
		print_r($cek_barang);
	}

	function simpan() {
		$id_kary = $this->id_kary();
		$data = $this->input->post('data');
		$kode = $data[0];
		$nama_material = strtoupper($data[1]);
		$spesifikasi = strtoupper($data[2]);
		$satuan = $data[3];
		$min_stok = $data[4];
		$kategori = $data[5];
		$jenis = $data[6];
		$tahun = $data[7];
		($data[8] == 'Tidak') ? $qc_test = '0' : $qc_test = '1';
		$deskripsi = $data[9];
		$kode_barang_sakti = $data[10];

		$cek_barang = $this->M_material->cek_barang($nama_material, $spesifikasi);
		if ($cek_barang > 0) {print_r('1'); return;}

		$id = $this->M_material->urut();
		$this->M_material->simpan($id, $kode, $nama_material, $spesifikasi, $satuan, $min_stok, $kategori, $jenis, $tahun, $qc_test, $id_kary, $deskripsi,$kode_barang_sakti);
	    if ($jenis=='BB - BAHAN BAKU') 
		{
			$this->M_material->simpan_block_barang($id);
		}
	}

	function hapus() {
		$id_barang = $this->input->post('data');
		$this->M_material->hapus($id_barang);
	}

	function filter() {
		$data = $this->input->post('data');
		$kategori = $data[0];
		$jenis = $data[1];
		$cari = strtoupper($data[2]);
		($data[3] == 'true') ? $approved = '0' : $approved = '1';
		$id_karyawan = $data[4];

		$data['material'] = $this->M_material->filter($kategori, $jenis, $cari, $approved, $id_karyawan);
		$data['approved'] = $approved;
		$data['status'] = $data[5];
		$this->load->view('pembelian/v_material_table.php', $data);
	}

	function auto_no() {
		$jenis = $this->input->post('data');
		$data = $this->M_material->auto_no($jenis);
		print_r($data);
	}

	function nama_barang_sakti_by_id() {
		$id = $this->input->post('data');
		$data = $this->M_material->nama_barang_sakti_by_id($id);
		print_r($data);
	}

	function simpan_update() {
		$data = $this->input->post('data');
		$id_barang = $data[0];
		$rekjurnal = $data[1];
		$jenis = substr($data[2], 0, 2);
		$satuan = $data[3];
		$nama = strtoupper($data[4]);
		$spesifikasi = strtoupper($data[5]);
		$kode_simpg = $data[6];
		$min_stok = str_replace('.', ',', $data[7]);
		$status = $data[8];
		$deskripsi = $data[9];
		$new = $data[10];
		$id_barang_sakti = $data[11];
		$nama_simpg = substr($nama . ' - ' . $spesifikasi, 0, 60);

		if ($status == '1') {
			$this->M_material->update_material($id_barang, $nama, $spesifikasi, $satuan, $deskripsi);
		}else{
			if ($kode_simpg == '' && $new == 'true') {
				$kode_simpg = $this->simpan_simpg($id_barang, $rekjurnal, $jenis, $satuan, $nama_simpg, $min_stok);
			}

			if ($new == 'false') {
				$this->M_material->update_rekening($id_barang, $rekjurnal);
				$this->M_material->update_id_barang_sakti($id_barang, $id_barang_sakti);
				$this->M_material->buka_block($id_barang);
			}else{
				$this->M_material->simpan_update($id_barang, $rekjurnal, $kode_simpg,$id_barang_sakti);
			    $this->M_material->buka_block($id_barang);
			}
		}
	}

	// Menu SIMPG
	function simpan_simpg($id_barang, $rekjurnal, $jenis, $satuan, $nama, $min_stok) {
		$username_input = $this->M_material->username_input($id_barang);
		$username = substr($username_input, 0, 8);

		if ($jenis == 'SP') {
			$kategori = 'SC';
			$kode_barang = $this->M_material->kode_barang($kategori, '501');
		} elseif ($jenis == 'BB') {
			$kategori = 'BB';
			$kode_barang = $this->M_material->kode_barang($kategori, '299');
		} elseif ($jenis == 'BP') {
			$kategori = 'BP';
			$kode_barang = $this->M_material->kode_barang($kategori, '399');
		} elseif ($jenis == 'LL' || $jenis == 'IT' || $jenis == 'JS' || $jenis == 'BN') {
			$kategori = 'LL';
			$kode_barang = $this->M_material->kode_barang($kategori, '701');
		} elseif ($jenis == 'GA') {
			$kategori = 'PS';
			$kode_barang = $this->M_material->kode_barang($kategori, '401');
		}

		$this->M_material->simpan_simpg($kode_barang, $satuan, $nama, $kategori, $username, $rekjurnal, $min_stok);

		return $kode_barang;
	}
}