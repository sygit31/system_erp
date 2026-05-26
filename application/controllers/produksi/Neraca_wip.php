<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Neraca_wip extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_neraca_wip');
		session_start();
	}

	function index() {
		$data['seri'] = $this->M_neraca_wip->seri();
		$data['kk'] = $this->M_neraca_wip->kk();
		$data['proses'] = $this->M_neraca_wip->proses();
		$data['desain'] = $this->M_neraca_wip->desain();

		$this->load->view('produksi/v_neraca_wip.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('d-m-Y', strtotime($data[0]));
		$tgl2 = date('d-m-Y', strtotime($data[1] . '+1 days'));

		$tgl1 = new DateTime($tgl1);
		$tgl2 = new DateTime($tgl2);
		$diff = $tgl2->getTimestamp() - $tgl1->getTimestamp();
		$diff = round($diff/(60*60*24));

		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('d/m/Y', strtotime($data[1] . '+1 days'));
		$desain = $data[2];
		$seri = $data[3];
		$proses = $data[4];
		$kk = $data[5];

		$data = $this->M_neraca_wip->filter($diff, $tgl1, $tgl2, $desain, $seri, $proses, $kk);
		
		print_r(json_encode($data));
	}

}
