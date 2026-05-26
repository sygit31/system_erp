<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_pet extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_lap_pet');
		session_start();
	}

	function index() {
		$data['kk'] = $this->M_lap_pet->kk();

		$this->load->view('produksi/v_lap_pet.php',$data);
	}

	function info_kk() {
		$kk = $this->input->post('data');
		$info_kk = $this->M_lap_pet->info_kk($kk);
		$info_roll = $this->M_lap_pet->info_roll($kk);

		print_r(json_encode(array($info_kk,$info_roll)));
	}

}