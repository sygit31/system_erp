<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('galvanik/M_proses');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function show_proses() {
		$data['kd_unit'] = $_GET['kd_unit'];
		$data['tahun'] = $this->M_proses->get_tahun($data['kd_unit']);
		$this->load->view('galvanik/v_proses', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$tgl1 = date('ymd', strtotime($data[1]));
		$tgl2 = date('ymd', strtotime($data[2]));
		$desain = $data[3];
		$tipe = $data[4];
		$tahap = $data[5];
		$cari = strtoupper($data[6]);
		$quality = $data[7];
		$nama = strtoupper($data[8]);
		
		$data['proses'] = $this->M_proses->filter($kd_unit, $tgl1, $tgl2, $desain, $tipe, $tahap, $cari, $quality, $nama);
		$this->load->view('galvanik/v_proses_table', $data);
	}

}