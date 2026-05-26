<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reject extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_reject');
		session_start();
	}

	function index() {
		$data['karyawan_produksi'] = $this->M_reject->karyawan_produksi();
		$data['karyawan_qc'] = $this->M_reject->karyawan_qc();
		$data['karyawan_gudang'] = $this->M_reject->karyawan_gudang();
		$data['akses'] = $this->M_reject->akses();
		$data['desain'] = $this->M_reject->desain();

		$this->load->view('produksi/v_reject.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$cari = strtoupper($data[2]);
		$desain = $data[3];

		$data['filter'] = $this->M_reject->filter($tgl1, $tgl2, $cari, $desain);		
		$data['akses'] = $this->M_reject->akses();
		$this->load->view('produksi/v_reject_table.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_detail = $data[0];
		$tahun = $data[1];
		$bln_romawi = $data[2];

		$urut = $this->M_reject->auto_no($id_detail, $tahun, $bln_romawi);
		print_r($urut);
	}

	function data_reject() {
		$desain = $this->input->post('data');
		$data = $this->M_reject->data_reject($desain);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_detail = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$nmr = $data[2];
		$id_dibuat = $data[3];
		$id_disetujui = $data[4];
		$id_diterima = $data[5];
		$desain = $data[7];

		if ($id_detail != '') {
			$this->M_reject->hapus($id_detail);
		}

		$urut = $this->M_reject->urut();
		$this->M_reject->simpan($urut, $tgl, $nmr, $id_dibuat, $id_disetujui, $id_diterima, $desain);

		for ($i=0; $i<count($data[6]); $i++) {
			$urut_detail = $this->M_reject->urut_detail();
			$id_prod_pet_detail = $data[6][$i];

			$this->M_reject->simpan_detail($urut_detail, $urut, $id_prod_pet_detail);
		}
	}

	function edit() {
		$id_detail = $this->input->post('data');
		$data = $this->M_reject->edit($id_detail);
		print_r(json_encode($data));
	}

	function batal() {
		$id_detail = $this->input->post('data');
		$this->M_reject->batal($id_detail);
	}

	function approve() {
		$id_detail = $this->input->post('data');
		$this->M_reject->approve($id_detail);
	}

}
