<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Bulanan_pet extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_bulanan_pet');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_bulanan_pet->desain();

		$this->load->view('gudang/v_bulanan_pet.php',$data);
	}

	function filter() {
		$desain = $this->input->post('data');
		$id_barang = $this->M_bulanan_pet->id_barang($desain);
		$filter = $this->M_bulanan_pet->filter($desain, $id_barang);
		print_r(json_encode($filter));
	}

}
