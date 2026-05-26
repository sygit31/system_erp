<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('cc/M_rekening');
		session_start();
	}

	function index() {
		$data['rekening'] = $this->M_rekening->show_rekening();
		$this->load->view('cc/v_rekening.php',$data);
	}

	function filter_rekening() {
		$cari = strtoupper($this->input->post('data'));

		$data['rekening'] = $this->M_rekening->filter_rekening($cari);
		$this->load->view('cc/v_rekening_table',$data);
	}

	function simpan_rekening() {
		$data = $this->input->post('data');
		$nomor = $data[0];
		$nama = $data[1];
		$id_rekening = $this->M_rekening->urut_rekening();

		$this->M_rekening->simpan_rekening($id_rekening,$nomor,$nama);
	}

	function aktif_rekening() {
		$data = $this->input->post('data');
		$id_rekening = $data[0];
		$aktif = $data[1];

		$this->M_rekening->aktif_rekening($id_rekening,$aktif);
	}

}
