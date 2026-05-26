<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kertas extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_kertas');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_kertas->desain();
		$data['karyawan_qc'] = $this->M_kertas->karyawan_qc();
		$this->load->view('qc/v_kertas.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tahun = date('y', strtotime($data[1]));
		$day = date('ymd', strtotime($data[1]));

		$data = $this->M_kertas->auto_no($id_edit, $tahun, $day);
		print_r(json_encode($data));
	}

	function isi_roll() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$ukuran = $data[1];

		$data = $this->M_kertas->isi_roll($desain, $ukuran);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$ukuran = $data[3];
		$status = $data[4];

		$data = $this->M_kertas->filter($tgl1, $tgl2, $desain, $ukuran, $status);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$desain = $data[3];
		$kode_roll = $data[4];
		$pabrikasi = $data[5];
		$pemeriksa = $data[6];
		$approval = $data[7];
		$awal = $data[8];
		$tengah = $data[9];
		$akhir = $data[10];
		$visual = $data[11];
		$acc = $data[12];
		$berat = $data[13];

		if ($id_edit == '') {
			$urut = $this->M_kertas->urut();
			$this->M_kertas->simpan($urut, $nmr, $tgl, $desain, $kode_roll, $pabrikasi, $pemeriksa, $approval, $awal, $tengah, $akhir, $visual, $acc, $berat);
		}else{
			$this->M_kertas->update($id_edit, $nmr, $tgl, $desain, $kode_roll, $pabrikasi, $pemeriksa, $approval, $awal, $tengah, $akhir, $visual, $acc, $berat);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_kertas->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_kertas->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');
		$data = $this->M_kertas->cetak($id_cetak);
		print_r(json_encode($data));
	}

}