<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kp extends CI_Controller {
	function __construct() {
		parent::__construct();
		
		$this->load->model('ppic/M_kp');
		session_start();
	}

	function index() {
		$data['dt_desain'] = $this->M_kp->desain();
		$this->load->view('galvanik/v_kp',$data);
	}

	function filter_kp() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kd_unit = $data[2];
		$cari = $data[3];
		$desain = $data[4];
		$tipe = $data[5];
		$master = $data[6];

		$data['kp'] = $this->M_kp->filter_kp($tgl1, $tgl2, $kd_unit, $cari, $desain, $tipe, $master);
		$this->load->view('galvanik/v_kp_table', $data);
	}

}