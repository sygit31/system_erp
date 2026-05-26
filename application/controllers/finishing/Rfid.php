<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rfid extends CI_Controller{

	function __construct() {
		parent::__construct();

		$this->load->model('finishing/M_rfid');
		session_start();
	}

	function index() {
		$data['pengawas'] = $this->M_rfid->kode_pengawas();
		$this->load->view('finishing/v_rfid', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$number1 = $data[0];
		$number2 = $data[1];
		$pengawas = $data[2];

		$data['pengawas'] = $pengawas;
		$data['filter'] = $this->M_rfid->filter($number1, $number2);	
		$this->load->view('finishing/v_rfid_table',$data);
	}

}

?>