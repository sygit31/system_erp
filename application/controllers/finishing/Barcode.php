<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('finishing/M_finishing');
		session_start();
	}

	function index() {		
		$this->load->view('finishing/v_barcode');
	}

	function filter() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'ymd');
		$tgl2 = date_format($date2,'ymd');

		// Uji Coba Database Oracle Simonita
		// $data = $this->M_finishing->simonita();
		// print_r($data);
		// return;

		$data['finishing'] = $this->M_finishing->filter($tgl1,$tgl2);	
		$this->load->view('finishing/v_barcode_table',$data);
	}

	function cutter() {
		$data = $this->input->post('data');
		$pp_cutter = $data[0];
		$desain = $data[1];

		$data = $this->M_finishing->cutter($pp_cutter,$desain);	
		print_r(json_encode($data));
	}

}

?>