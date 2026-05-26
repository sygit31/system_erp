<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hlreader extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('rnd/M_hlreader');
		session_start();
	}

	function index() {    
		$data['hlreader'] = $this->M_hlreader->hlreader();   	
		$data['location'] = $this->M_hlreader->location();   	
		$data['tahun'] = $this->M_hlreader->tahun();  

		$this->load->view('rnd/v_hlreader.php',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tahun = $data[1];
		$no_register = $data[2];
		$kondisi = $data[3];
		$keterangan = $data[4];
		
		$this->M_hlreader->simpan($id_edit,$tahun,$no_register,$kondisi,$keterangan);
	}

	function filter() {
		$data = $this->input->post('data');
		$tahun = $data[0];
		$cari = $data[1];
		$kondisi = $data[2];
		$upgrade = $data[3];
		$hlreader = $data[4];

		$data['hlreader'] = $this->M_hlreader->filter($tahun,$cari,$kondisi,$upgrade,$hlreader);   	
		$this->load->view('rnd/v_hlreader_table.php',$data);
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_hlreader->hapus($id_hapus);
	}

}