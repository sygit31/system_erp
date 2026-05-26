<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bagian extends CI_Controller{

	function __construct()	{
		parent::__construct();
		
		$this->load->model('hrd/M_bagian');
		session_start();
	}

	function index() {  	  	    	
		$data['bagian'] = $this->M_bagian->bagian();	      	
		$this->load->view('hrd/v_bagian.php',$data);
	}

	function filter() {
		$cari = strtoupper($this->input->post('data'));

		$data['bagian'] = $this->M_bagian->filter($cari);
		$this->load->view('hrd/v_bagian_table',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$kode = $data[0];
		$bagian = $data[1];
		$id_edit = $data[2];
		$this->M_bagian->simpan($kode,$bagian,$id_edit);
	}

}

?>