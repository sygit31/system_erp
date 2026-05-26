<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kp extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('galvanik/M_kp');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['kd_unit'] = $_GET['kd_unit'];
		$data['tahun'] = $this->M_kp->desain($data['kd_unit']);
		$this->load->view('galvanik/v_kp',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kd_unit = $data[2];
		$cari = $data[3];
		$desain = $data[4];
		$tipe = $data[5];
		$master = $data[6];

		$data['filter'] = $this->M_kp->filter($tgl1, $tgl2, $kd_unit, $cari, $desain, $tipe, $master);
		$this->load->view('galvanik/v_kp_table', $data);
	}

}