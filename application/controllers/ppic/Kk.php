<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kk extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('ppic/M_kk');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['kk'] = $this->M_kk->kk();
		$data['barang'] = $this->M_kk->barang();
		$data['satuan'] = $this->M_kk->satuan();

		$this->load->view('ppic/v_kk', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$bln = date('m', strtotime($data[1]));
		$thn = date('Y', strtotime($data[1]));
		$bln_romawi = $data[2];
		$desain = $data[3];

		$auto_no = $this->M_kk->auto_no($id_edit, $bln, $bln_romawi, $desain, $thn);
		print_r(json_encode($auto_no));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$seri = $data[3];
		$nmr = $data[4];
		$id_bahan = $data[5];

		$data['filter'] = $this->M_kk->filter($tgl1, $tgl2, $desain, $seri, $nmr, $id_bahan);
		$this->load->view('ppic/v_kk_table', $data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$nmr = $data[3];
		$seri = $data[4];
		$deadline = date('d-m-Y', strtotime($data[5]));
		$bahan = $data[6];

		$id_cs_risalah_detail = 111;
		$id_proses = 1;
		$status = 'OPEN';
		$id_input = explode('@', $this->M_kk->karyawan())[0];
		$id_bagian = explode('@', $this->M_kk->karyawan())[1];
		$qty = $bahan[2][0];

		if ($id_edit != '') {
			$this->M_kk->hapus_gudang_order($id_edit);
			$this->M_kk->hapus_kk($id_edit);
			$this->M_kk->hapus_kk_detail($id_edit);
		}

		$urut_kk = $this->M_kk->urut_kk();
		$this->M_kk->simpan_kk($urut_kk, $id_cs_risalah_detail, $tgl, $id_proses, $qty, $status, $id_input, $nmr, $seri, $desain);
		for ($i=0; $i<count($bahan[0]); $i++) {
			$id_bahan = $bahan[0][$i];
			$satuan = $bahan[1][$i];
			$qty = $bahan[2][$i];
			$relasi = 'KK DETAIL';

			$urut_kk_detail = $this->M_kk->urut_kk_detail();
			$this->M_kk->simpan_kk_detail($urut_kk_detail, $urut_kk, $id_bahan, $qty);

			$urut_gudang_order = $this->M_kk->urut_gudang_order();
			$this->M_kk->simpan_gudang_order($urut_gudang_order, $tgl, $id_bahan, $qty, $satuan, $deadline, $nmr, $id_bagian, $status, $seri, $relasi, $urut_kk_detail, $desain);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');

		$data = $this->M_kk->edit($id_edit);
		print_r(json_encode($data));
	}

	function cek_transaksi() {
		$id_kk_detail = $this->input->post('data');

		$data = $this->M_kk->cek_transaksi($id_kk_detail);
		print_r($data);
	}

	function hapus() {
		$data = $this->input->post('data');
		$aksi = $data[0];
		$id_hapus = $data[1];

		if ($aksi == 'hapus') {
			$this->M_kk->hapus_gudang_order($id_hapus);
			$this->M_kk->hapus_kk($id_hapus);
			$this->M_kk->hapus_kk_detail($id_hapus);
		}else{
			$this->M_kk->close_gudang_order($id_hapus);	
			$this->M_kk->close_kk($id_hapus);		
		}
	}

}