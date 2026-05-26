<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
	function __construct(){
		parent::__construct();
		
		$this->load->model('galvanik/M_master');
		session_start();
	}

	function index() {
		$data['produk'] = $this->M_master->produk();
		$data['desain'] = $this->M_master->desain();
		$this->load->view('galvanik/v_master', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$produk = $data[2];
		$desain = $data[3];

		$data['data'] = $this->M_master->filter($tgl1, $tgl2, $produk, $desain);
		$this->load->view('galvanik/v_master_table', $data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$menu = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$id_galv_proses = $data[2];

		$id = $this->M_master->urut();
		$this->M_master->simpan($id, $menu, $id_galv_proses, $tgl);
	}

}