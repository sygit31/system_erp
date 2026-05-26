<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller{

	function __construct()	{
		parent::__construct();
		
		$this->load->model('hrd/M_jabatan');
		session_start();
	}

	function index()	{  	    	
		$data['jabatan'] = $this->M_jabatan->jabatan();	      	
		$this->load->view('hrd/v_jabatan.php',$data);
	}

	function filter() {
		$cari = strtoupper($this->input->post('data'));

		$data['jabatan'] = $this->M_jabatan->filter($cari);
		$this->load->view('hrd/v_jabatan_table',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$kode = $data[0];
		$jabatan = $data[1];
		$level_jabatan = $data[2];
		$id_edit = $data[3];
		$this->M_jabatan->simpan($kode,$jabatan,$level_jabatan,$id_edit);
	}

}

?>