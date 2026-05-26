<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_spl');
		
		session_start();
	}
	
	function index(){
		$data['dataLembur'] = $this->M_spl->getSPLTotalLembur();

		$this->load->view('sgt/spl/v_laporan.php',$data);
	}

	

	
}
?>