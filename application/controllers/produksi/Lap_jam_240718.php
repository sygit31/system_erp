<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_jam extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_lap_jam');
		session_start();
	}

	function index() {
		$data['desain'] = $this->M_lap_jam->desain();	
		$data['seri'] = $this->M_lap_jam->seri();		
		$data['kk'] = $this->M_lap_jam->kk();
		$data['proses'] = $this->M_lap_jam->proses();
		$data['jenis'] = $this->M_lap_jam->jenis();
		$data['nama_mesin'] = $this->M_lap_jam->nama_mesin();

		$this->load->view('produksi/v_lap_jam.php',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$kk = $data[3];
		$proses = $data[4];
		$mesin = $data[5];
		$seri = $data[6];

		$data = $this->M_lap_jam->filter($tgl1, $tgl2, $desain, $kk, $proses, $mesin, $seri);
		print_r(json_encode($data));
	}

}