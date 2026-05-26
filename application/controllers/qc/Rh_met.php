<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rh_met extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_rh_met');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$this->load->view('qc/v_rh_met.php');
	}

	function isi_rim() {
		$data = $this->M_rh_met->isi_rim();
		print_r(json_encode($data));
	}

	function isi_roll() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$id_kk_detail = $data[1];

		$data = $this->M_rh_met->isi_roll($desain, $id_kk_detail);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kode = $data[2];

		$data = $this->M_rh_met->filter($tgl1, $tgl2, $kode);
		$data_pallet = $this->M_rh_met->filter_pallet($tgl1, $tgl2);
		print_r(json_encode(array($data, $data_pallet)));
	}

	function simpan() {
		$data = $this->input->post('data');
		$tgl = date('d-m-Y', strtotime($data[0]));
		$dt_rim = $data[1];

		$urut = $this->M_rh_met->urut();
		for ($i=0; $i<count($dt_rim); $i++) {
			$rim = $dt_rim[$i][0];
			$rh = $dt_rim[$i][1];
			$suhu = $dt_rim[$i][2];

			$cek_data = $this->M_rh_met->cek_data($rim);
			if ($cek_data == 0) {
				$this->M_rh_met->simpan($urut, $tgl, $rim, $rh, $suhu);
				$urut++;
			}else{
				$this->M_rh_met->update($tgl, $rim, $rh, $suhu);
			}
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_rh_met->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_rh_met->hapus($id_hapus);
	}

	function e_simpan() {
		$data = $this->input->post('data');
		$tgl = date('d-m-Y', strtotime($data[0]));
		$rim = $data[1];
		$rh = $data[2];
		$suhu = $data[3];

		$this->M_rh_met->update($tgl, $rim, $rh, $suhu);
	}

}