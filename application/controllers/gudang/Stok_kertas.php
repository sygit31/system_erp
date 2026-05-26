<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_kertas extends CI_Controller{

	function __construct() {
		parent::__construct();

		$this->load->model('gudang/M_stok_kertas');
		session_start();
	}

	function index() {
		$this->load->view('gudang/v_stok_kertas');
	}

	function filter() {
		$data = $this->input->post('data');
		$desain = $data[2];
		$tgl1 = date('ymd', strtotime($data[3] . '-' . $data[0] . '-' . $data[1]));
		$tgl2 = date('d-m-Y', strtotime($data[3] . '-' . $data[0] . '-' . $data[1]));
		
		$data = $this->M_stok_kertas->filter($desain, $tgl1, $tgl2);
		print_r(json_encode($data));
	}

}