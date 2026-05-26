<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kk_kecil extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_kk');
		
		session_start();
	}
	
	function index(){

		$this->load->view('sgt/ppic/v_kk_kecil.php');
	}


}
?>