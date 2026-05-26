<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('pembelian/M_supplier');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['jenis'] = $this->M_supplier->jenis();
		$data['supplier_sakti'] = $this->M_supplier->supplier_sakti();
		
		$data['material'] = $this->M_supplier->material();
		$data['mata_uang'] = $this->M_supplier->mata_uang();
		$data['supplier_simpg'] = $this->M_supplier->supplier_simpg();
		$data['supplier'] = $this->M_supplier->show_supplier();

		$this->load->view('pembelian/v_supplier.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$cari = strtoupper($data[0]);
		$jenis = strtoupper($data[1]);

		$data['supplier'] = $this->M_supplier->filter($cari, $jenis);
		$this->load->view('pembelian/v_supplier_table.php', $data);
	}

	function ambil_material() {
		$id_supplier = $this->input->post('data');
		$data = $this->M_supplier->show_material($id_supplier);
		print_r(json_encode($data));
	}

	function simpan_supplier() {
		$data = $this->input->post('data');
		$kode = strtoupper($data[0]);
		$nama = strtoupper($data[1]);
		$alamat = strtoupper($data[2]);
		$kota = strtoupper($data[3]);
		$negara = $data[4];
		$kode_pos = $data[5];
		$phone = strtoupper($data[6]);
		$fax = strtoupper($data[7]);
		$email = $data[8];
		$kontak = strtoupper($data[9]);
		$title = strtoupper($data[10]);
		$npwp = $data[11];
		$id_input = $data[12];
		$rekening = strtoupper($data[13]);
		$kode_keuangan = $data[14];
		$jenis = $data[15];
		$id_supplier = $data[16];
		$kode_simpg = $data[17];
		$qty_material =  $data[18][0];

		// Simpan Supplier
		if ($id_supplier == '') {
			$id_supplier = $this->M_supplier->urut_supplier();
			if ($kode_simpg == '') {
				$kode_simpg = $this->M_supplier->urut_supplier_simpg();

				$nickname = substr($nama, 0, 25);
				$nama = substr($nama, 0, 40);
				$alamat = substr($alamat, 0, 40);
				$kota = substr($kota, 0, 25);
				$negara = substr($negara, 0, 15);
				$phone = substr($phone, 0, 15);
				$fax = substr($fax, 0, 15);
				$kontak = substr($kontak, 0, 25);
				$this->M_supplier->simpan_supplier_simpg($kode_simpg, $nickname, $nama, $alamat, $kota, $negara, $phone, $fax, $email, $kontak, $npwp, $kode_keuangan);
			}
			$this->M_supplier->simpan_supplier($id_supplier, $kode, $nama, $alamat, $kota, $negara, $kode_pos, $phone, $fax, $email, $kontak, $title, $npwp, $id_input, $kode_keuangan, $rekening, $jenis, $kode_simpg);
		} else {
			$this->M_supplier->update_supplier($id_supplier, $kode, $nama, $alamat, $kota, $negara, $kode_pos, $phone, $fax, $email, $kontak, $title, $npwp, $id_input, $kode_keuangan, $rekening, $jenis);

			$nickname = substr($nama, 0, 25);
			$nama = substr($nama, 0, 40);
			$alamat = substr($alamat, 0, 40);
			$kota = substr($kota, 0, 25);
			$negara = substr($negara, 0, 15);
			$phone = substr($phone, 0, 15);
			$fax = substr($fax, 0, 15);
			$kontak = substr($kontak, 0, 25);
			$this->M_supplier->update_supplier_simpg($id_supplier, $nickname, $nama, $alamat, $kota, $negara, $phone, $fax, $email, $kontak, $npwp, $kode_keuangan);
		}

		// Simpan Material Supply
		$id_material_supply = $this->M_supplier->urut_material();
		for ($i = 0; $i < $qty_material; $i++) {
			$lead_time = $data[18][1][$i];
			$harga = str_replace(".", ",", $data[18][2][$i]);
			$mata_uang = $data[18][3][$i];
			$id_material = $data[18][4][$i];
			$id_edit_material = $data[18][5][$i];
			$moq = $data[18][6][$i];
			$capacity = $data[18][7][$i];
			if ($id_edit_material == '') {
				$this->M_supplier->simpan_material($id_material_supply, $id_supplier, $id_material, $lead_time, $harga, $mata_uang, $moq, $capacity);
				$id_material_supply++;
			} else {
				$this->M_supplier->update_material($id_edit_material, $id_supplier, $id_material, $lead_time, $harga, $mata_uang, $moq, $capacity);
			}
		}
	}

	function simpan_material() {
		$data = $this->input->post('data');
		$id_supplier = strtoupper($data[0]);
		$barang = $data[1];

		$id_material_supply = $this->M_supplier->urut_material();
		for ($i=0; $i<count($barang[0]); $i++) {
			$id_material = $barang[0][$i];
			$satuan = $barang[1][$i];
			$lead_time = $barang[2][$i];
			$harga = str_replace(".", ",", $barang[3][$i]);
			$mata_uang = $barang[4][$i];
			$moq = $barang[5][$i];
			$capacity = $barang[6][$i];

			$id_edit_material = $this->M_supplier->edit_material($id_supplier,$id_material);
			if ($id_edit_material == null) {
				$this->M_supplier->simpan_material($id_material_supply, $id_supplier, $id_material, $lead_time, $harga, $mata_uang, $moq, $capacity);
				$id_material_supply++;
			}else{
				$this->M_supplier->update_material($id_edit_material, $id_supplier, $id_material, $lead_time, $harga, $mata_uang, $moq, $capacity);
			}
		}
	}

	function get_supplier() {
		$id_supplier = $this->input->post('data');

		$data = $this->M_supplier->get_supplier($id_supplier);
		print_r(json_encode($data));
	}

	function hapus_supplier() {
		$id_supplier = $this->input->post('data');

		$this->M_supplier->hapus_supplier($id_supplier);
	}

	function ambil_simpg() {
		$kode = $this->input->post('data');
		$data = $this->M_supplier->ambil_simpg($kode);
		print_r(json_encode($data));
	}
}
