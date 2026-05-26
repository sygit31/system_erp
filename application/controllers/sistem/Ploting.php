<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ploting extends CI_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_ploting');
		session_start();
	}

	function show_nilai() {
		$data['unit'] = $this->M_ploting->unit();
		$data['periode'] = $this->M_ploting->show_periode();
		$data['bagian'] = $this->M_ploting->show_bagian();
		$data['kd_unit'] = $this->M_ploting->kd_unit();

		$this->load->view('sistem/v_ploting', $data);
	}

	function get_data() {
		// $periode = $this->input->post('data');
		// $data = $this->M_ploting->show_nilai($periode);
		// print_r(json_encode($data));
	}

	function get_kategori() {
		$id_penilai = $this->input->post('data');

		$data = $this->M_ploting->get_kategori($id_penilai);
		print_r(json_encode($data));
	}

	function filter_nilai() {
		$data = $this->input->post('data');
		$periode = $data[0];
		$bagian = $data[1];
		$kd_unit = $data[2];
		$status = $data[3];

		$data = $this->M_ploting->filter_nilai($periode, $bagian, $kd_unit, $status);
		print_r(json_encode($data));
	}

	function detail_nilai() {
		$data['penilai'] = $this->M_ploting->show_penilai();
		$data['periode'] = $this->M_ploting->show_periode();
		$this->load->view('sistem/v_detail_nilai', $data);
	}

	function get_detail_nilai() {
		$data = $this->input->post('data');
		$id_penilai = $data[0];
		$periode = $data[1];
		$kategori = $data[2];

		$periode = $this->M_ploting->ambil_tgl($periode);
		$data = $this->M_ploting->get_detail_nilai($id_penilai, $periode, $kategori);
		print_r(json_encode($data));
	}

	function get_laporan() {
		$data = $this->input->post('data');
		$periode1 = $this->M_ploting->ambil_tgl($data[0]);
		$periode2 = $this->M_ploting->ambil_tgl($data[1]);
		$bagian = $data[2];
		$kd_unit = $data[3];
		$status = $data[4];
		$cari = strtoupper($data[5]);

		$nama = $this->M_ploting->get_nama($periode2, $bagian, $kd_unit, $status, $cari);
		$data = $this->M_ploting->get_laporan($periode1, $periode2, $bagian, $kd_unit, $status, $cari);
		print_r(json_encode(array($nama, $data)));
	}

	// Plotting Penilai
	function auto_nilai() {
		$periode = $this->input->post('data');

		$periode = $this->M_ploting->ambil_tgl($periode);
		$id = $this->M_ploting->urut();
		$this->M_ploting->lock_nilai();
		$this->M_ploting->auto_nilai($periode, $id);
	}

	function isi_penilai() {
		$data = $this->input->post('data');
		$periode = $data[0];
		$unit = strtoupper($data[1]);

		$periode = $this->M_ploting->ambil_tgl($periode);
		$data = $this->M_ploting->isi_penilai($periode,$unit);
		print_r(json_encode($data));
	}

	function isi_auto() {
		$periode = $this->input->post('data');

		$periode = $this->M_ploting->ambil_tgl($periode);
		$data = $this->M_ploting->isi_auto($periode);
		print_r(json_encode($data));
	}

	function detail_auto() {
		$data = $this->input->post('data');
		$id_penilai = $data[0];
		$kategori = $data[1];
		$periode = $data[2];

		$periode = $this->M_ploting->ambil_tgl($periode);
		$data = $this->M_ploting->detail_auto($id_penilai, $kategori, $periode);
		print_r(json_encode($data));
	}

	function unlock_penilai() {
		$id_penilai = $this->input->post('data');
		$id = $this->M_ploting->urut_unlock();
		$this->M_ploting->unlock_penilai($id, $id_penilai);
	}

	function detail_outstanding() {
		$data = $this->input->post('data');
		$id_penilai = $data[0];
		$kategori = $data[1];
		$periode = $data[2];

		$periode = $this->M_ploting->ambil_tgl($periode);
		$data = $this->M_ploting->detail_outstanding($id_penilai, $kategori, $periode);
		print_r(json_encode($data));
	}

	function detail_penilai() {
		$nik = $this->input->post('data');
		
		$data = $this->M_ploting->detail_penilai($nik);
		print_r(json_encode($data));
	}
}
