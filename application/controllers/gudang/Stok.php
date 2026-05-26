<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stok extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_stok');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$id_kary = explode('|', $_SESSION['logERP'])[0];
		$data['jenis'] = $this->M_stok->jenis($id_kary);
		$data['lokasi'] = $this->M_stok->lokasi();
		$data['kd_menu'] = $_GET['kd_menu'];

		$this->load->view('gudang/v_stok.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$id_location = $data[2];
		$cari = $data[3];
		$no_lokasi = $data[4];

		$data = $this->M_stok->filter($tgl1, $tgl2, $id_location, $cari, $no_lokasi);
		print_r(json_encode($data));
	}

}