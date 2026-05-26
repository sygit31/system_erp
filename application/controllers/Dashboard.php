<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('dash/M_dashboard');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}
	
	function index() {	
		$data['kary'] = $this->M_dashboard->dt_kary();
		$data['tbl_bmi'] = $this->M_dashboard->tbl_bmi();
		$this->load->view('v_dashboard.php', $data);
	}


}
?>