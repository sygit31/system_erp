<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reject extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('galvanik/M_reject');
		session_start();
	}

	function id_kary() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];
	}

	function index() {
		$kode_menu = $_GET['kode_menu'];
		$id_kary = $this->id_kary();

		$data['status_menu'] = $this->M_reject->status_menu($kode_menu,$id_kary);
		$data['kd_unit'] = $this->M_reject->kd_unit($id_kary);
		$data['seri'] = $this->M_reject->seri();
		$data['desain'] = $this->M_reject->desain();

		$this->load->view('galvanik/v_reject', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kd_unit = $data[2];
		$status_menu = $data[3];
		$seri = $data[4];
		$desain = $data[5];

		$data['status_menu'] = $status_menu;
		$data['reject'] = $this->M_reject->filter($tgl1, $tgl2, $kd_unit, $seri, $desain);
		$this->load->view('galvanik/v_reject_table', $data);
	}

	function get_romawi($bln) {
		$romawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
		return $romawi[$bln];
	}

	function auto_no() {
		$data = $this->input->post('data');
		$nmr_ipb = $data[0];
		$tgl = $data[1];
		$kd_unit = $data[2];
		$desain = $data[3];
		$tgl = substr($tgl, 0, 2);
		$bln = (int)date('m', strtotime($data[1]));
		$romawi = $this->get_romawi($bln - 1);
		$tahun = date('Y', strtotime($data[1]));

		$urut = $this->M_reject->auto_no($desain);

		if ($kd_unit == '12') {
			$kode_trans = '/PNP-HLG/EMB/';
		} else {
			$kode_trans = '/PNP-HPD/EMB/';
		}

		$kode = $kode_trans . $tgl . '/' . $romawi . '/' . $tahun;
		print_r(json_encode(array($urut, $kode)));
	}

	function isi_ipb() {
		$kd_unit = $this->input->post('data');

		$data = $this->M_reject->isi_ipb($kd_unit);
		print_r(json_encode($data));
	}

	function isi_pch() {
		$nmr_ipb = $this->input->post('data');

		$data = $this->M_reject->isi_pch($nmr_ipb);
		print_r(json_encode($data));
	}

	function cek_nomor() {
		$data = $this->input->post('data');
		$urut = $data[0];
		$nmr_ipb = $data[1];
		$desain = $this->M_reject->get_desain($nmr_ipb);

		$duplikat = $this->M_reject->cek_nomor($urut, $desain);
		print_r($duplikat);
	}

	function simpan() {
		$data = $this->input->post('data');
		$tgl = date('d-m-Y', strtotime($data[0]));
		$nmr = strtoupper($data[1]);
		$id_kary = $this->id_kary();

		for ($i = 0; $i < count($data[2]); $i++) {
			$id_ipb = $this->M_reject->urut();
			$id_galv_ipb = $data[2][$i];
			$kondisi = $data[3][$i];
			$keterangan = $data[4][$i];

			$this->M_reject->simpan($id_ipb, $tgl, $nmr, $id_galv_ipb, $id_kary, $kondisi, $keterangan);
		}
	}

	function hapus() {
		$nmr = $this->input->post('data');
		$this->M_reject->hapus($nmr);
	}

	function approve() {
		$nmr = $this->input->post('data');
		$this->M_reject->approve($nmr);
	}

	function isi_print() {
		$nmr = $this->input->post('data');
		$data = $this->M_reject->isi_print($nmr);
		print_r(json_encode($data));
	}
}
