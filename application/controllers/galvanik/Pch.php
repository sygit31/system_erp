<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pch extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('galvanik/M_pch');
		session_start();
	}

	function index() {
		$data['kd_unit'] = $_GET['kd'] == 'hlg' ? '12' : '01';
		$data['produk'] = $this->M_pch->produk($data['kd_unit']);
		$menu = $data['kd_unit'] == '12' ? 'v_pch' : 'v_pch_hpd';

		$this->load->view('galvanik/' . $menu, $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('d-m-Y', strtotime($data[0]));
		$tgl2 = date('d-m-Y', strtotime($data[1] . '+1 days'));
		$id_produk = $data[2];

		$tgl1 = new DateTime($tgl1);
		$tgl2 = new DateTime($tgl2);
		$diff = $tgl2->getTimestamp() - $tgl1->getTimestamp();
		$diff = round($diff/(60*60*24));

		$tgl1 = date('d/m/Y', strtotime($data[0]));
		$tgl2 = date('d/m/Y', strtotime($data[1] . '+1 days'));
		
		$data = $this->M_pch->data($id_produk, $diff, $tgl1, $tgl2);

		print_r(json_encode($data));
	}

	function filter_hpd() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kd_unit = $data[2];
		
		$data = $this->M_pch->filter_hpd($tgl1, $tgl2, $kd_unit);
		print_r(json_encode($data));
	}

}