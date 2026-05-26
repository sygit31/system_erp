<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kk_kecil extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_kk');
		
		session_start();
	}
	
	function index(){

		$this->load->view('sgt/ppic/v_kk_kecil.php');
	}


}
?>