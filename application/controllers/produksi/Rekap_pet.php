<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap_pet extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('produksi/M_rekap_pet');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$this->load->view('produksi/v_rekap_pet.php');
	}

	function filter() {
		$desain = $this->input->post('data');
		$periode = $this->M_rekap_pet->periode($desain);
		$data = $this->M_rekap_pet->filter($desain);
		print_r(json_encode(array($periode,$data)));
	}

}