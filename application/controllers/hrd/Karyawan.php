<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller{

	function __construct()	{
		parent::__construct();
		
		$this->load->model('hrd/M_karyawan');
		session_start();
	}

	function index() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];

		$data['bagian'] = $this->M_karyawan->bagian();	
		$data['jabatan'] = $this->M_karyawan->jabatan();	    	
		$data['unit'] = $this->M_karyawan->unit();
		$data['kd_unit'] = $this->M_karyawan->kd_unit($id_kary);

		$this->load->view('hrd/v_karyawan.php', $data);
	}

	function r_jabatan() {
		$id_karyawan = $this->input->post('data');

		$data = $this->M_karyawan->r_jabatan($id_karyawan);	  
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$cari = strtoupper($data[0]);
		$id_bagian = $data[1];
		$id_jabatan = $data[2];
		$status = $data[3];
		$kd_unit = $data[4];
		$jkel = substr($data[5],0,1);
		if ($jkel == 'A') {$jkel = 'All';}

		$data['filter'] = $this->M_karyawan->filter($cari,$id_bagian,$id_jabatan,$status,$kd_unit,$jkel);
		$this->load->view('hrd/v_karyawan_table',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nik = $data[1];
		$nama = $data[2];
		$id_bagian = $data[3];
		$id_jabatan = $data[4];
		$status = $data[5];
		$kd_unit = $data[6];
		$jkel = $data[7];
		$s_premi = $data[8];
		$tgl_masuk = date('d-m-Y', strtotime($data[9]));
		$tgl_penetapan = $data[10] == '' ? '' : date('d-m-Y',strtotime($data[10]));
		$nick_name = $data[11];

		$this->M_karyawan->simpan($id_edit, $nik, $nama, $id_bagian, $id_jabatan, $status, $kd_unit, $jkel, $s_premi, $tgl_masuk, $tgl_penetapan, $nick_name);
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_karyawan->edit($id_edit);
		print_r(json_encode($data));
	}

	function r_simpan() {
		$data = $this->input->post('data');
		$id_karyawan = $data[0];
		$id_bagian = $data[1];
		$id_jabatan = $data[2];
		$kd_unit = $data[3];

		$id_r_jabatan = $this->M_karyawan->urut_r_jabatan();
		$this->M_karyawan->r_simpan($id_r_jabatan, $id_karyawan, $id_bagian, $id_jabatan, $kd_unit);
	}

	function r_hapus() {
		$id = $this->input->post('data');
		$this->M_karyawan->r_hapus($id);
	}

	function keluar() {
		$data = $this->input->post('data');
		$id_karyawan = $data[0];
		$tgl_keluar = date('d-m-Y',strtotime($data[1]));

		$this->M_karyawan->keluar($id_karyawan,$tgl_keluar);
	}

}