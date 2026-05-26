<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adjust extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_adjust');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['karyawan'] = $this->M_adjust->karyawan();
		$data['level'] = $this->M_adjust->level();

		$this->load->view('sistem/v_adjust', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));

		$data['filter'] = $this->M_adjust->filter($tgl1, $tgl2);
		$this->load->view('sistem/v_adjust_table', $data);
	}

	function filter_jabatan() {
		$data['filter'] = $this->M_adjust->filter_jabatan();
		$this->load->view('sistem/v_adjust_jabatan_table', $data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_karyawan = $data[0];
		$nilai = $data[1];
		$keterangan = $data[2];
		$kategori = $data[3];
		$tgl = date('d-m-Y', strtotime($data[4]));
		$id_nilai_plus = $data[5];

		if ($id_nilai_plus == '') {
			$id = $this->M_adjust->urut();
			$this->M_adjust->simpan($id, $id_karyawan, $nilai, $keterangan, $kategori, $tgl);
		} else {
			$this->M_adjust->edit($id_nilai_plus, $id_karyawan, $nilai, $keterangan, $kategori, $tgl);
		}
	}

	function hapus() {
		$id = $this->input->post('data');
		$this->M_adjust->hapus($id);
	}
}
