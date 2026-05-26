<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kp extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('ppic/M_kp');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function show_kp() {
		$kd_menu = $_GET['mn'];
		$data['dt_desain'] = $this->M_kp->desain();
		$data['produk'] = $this->M_kp->produk();
		$data['karyawan'] = $this->M_kp->karyawan($kd_menu);

		$this->load->view('ppic/v_kp', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$unit = $data[1];
		$tipe = $data[2];

		$auto_no = $this->M_kp->auto_no($desain, $unit, $tipe);
		print_r($auto_no);
	}

	function cek_nomor() {
		$data = $this->input->post('data');
		$urut = $data[0];
		$unit = $data[1];
		$desain = $data[2];
		$qty = $this->M_kp->cek_nomor($urut,$unit,$desain);

		print_r($qty);
	}

	function simpan_kp() {
		$data = $this->input->post('data');
		$this->M_kp->simpan_kp($data);
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
		$nama = strtoupper($data[7]);
		$jenis = $data[8];

		$data['kp'] = $this->M_kp->filter_kp($tgl1, $tgl2, $kd_unit, $cari, $desain, $tipe, $master, $nama, $jenis);
		$this->load->view('ppic/v_kp_table', $data);
	}

	function cetak() {
		$id_kp_detail = $this->input->post('data');
		$data = $this->M_kp->cetak($id_kp_detail);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_kp_detail = $this->input->post('data');
		$data = $this->M_kp->cek_data($id_kp_detail);

		if ($data != '1') {print_r($data); return;}
		$this->M_kp->hapus($id_kp_detail);
	}

}
