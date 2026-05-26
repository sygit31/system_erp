<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rh_fin extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_rh_fin');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_rh_fin->desain();
		$data['seri'] = $this->M_rh_fin->seri();
		$this->load->view('qc/v_rh_fin.php', $data);
	}

	function isi_rim() {
		$desain = $this->input->post('data');
		$data = $this->M_rh_fin->isi_rim($desain);
		print_r(json_encode($data));
	}

	function isi_roll() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$id_kk_detail = $data[1];

		$data = $this->M_rh_fin->isi_roll($desain, $id_kk_detail);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$kode = $data[3];

		$data = $this->M_rh_fin->filter($tgl1, $tgl2, $desain, $kode);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$rim = $data[3];
		$seri = $data[4];
		$rh = $data[5];
		$suhu = $data[6];

		if ($id_edit == '') {
			$urut = $this->M_rh_fin->urut();
			$this->M_rh_fin->simpan($urut, $desain, $tgl, $rim, $seri, $rh, $suhu);
		}else{
			$this->M_rh_fin->update($id_edit, $desain, $tgl, $rim, $seri, $rh, $suhu);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_rh_fin->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_rh_fin->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');
		$data = $this->M_rh_fin->cetak($id_cetak);
		print_r(json_encode($data));
	}

	function filter_p() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$seri = $data[3];
		$sp = $data[4];
		$pallet = $data[5];

		$data = $this->M_rh_fin->filter_p($tgl1, $tgl2, $desain, $seri, $sp, $pallet);
		print_r(json_encode($data));
	}

	function view() {
		$data = $this->input->post('data');
		$kode_palette = $data[0];
		$tahun_palette = $data[1];
		$nomor_sop = $data[2];

		$data = $this->M_rh_fin->view($kode_palette, $tahun_palette, $nomor_sop);
		print_r(json_encode($data));
	}

}