<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip_lap extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_arsip_lap');
		session_start();
	}

	function index() {
		$data['bagian'] = $this->M_arsip_lap->bagian();		
		$this->load->view('sistem/v_lap_arsip',$data);
	}

	function filter() {
		$bagian = $this->input->post('data');
		$data['filter'] = $this->M_arsip_lap->filter($bagian);	
		$this->load->view('sistem/v_lap_arsip_table',$data);
	}

}

?>