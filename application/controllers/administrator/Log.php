<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('administrator/M_log');
		session_start();
	}

	function index()
	{       	
		$data['log'] = $this->M_log->show_log();	       	
		$this->load->view('administrator/v_log.php',$data);
	}

	function filter_log() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');
		$cari = strtoupper($data[2]);

		$data['log'] = $this->M_log->filter_log($tgl1,$tgl2,$cari);
		$this->load->view('administrator/v_log_table',$data);
	}
	
}

?>