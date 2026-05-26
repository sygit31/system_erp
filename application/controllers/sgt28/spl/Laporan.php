<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_spl');
		
		session_start();
	}
	
	function index(){
		$data['dataLembur'] = $this->M_spl->getSPLTotalLembur();

		$this->load->view('sgt/spl/v_laporan.php',$data);
	}

	

	
}
?>