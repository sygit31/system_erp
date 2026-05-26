<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sticker extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_sticker');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_sticker->desain();
		$data['pemeriksa'] = $this->M_sticker->pemeriksa();
		$data['approval'] = $this->M_sticker->approval();
		$data['operator'] = $this->M_sticker->operator();

		$this->load->view('qc/v_sticker.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$desain = $data[2];

		$data = $this->M_sticker->auto_no($id_edit, $desain, $tgl);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$cari = strtolower($data[3]);

		$data = $this->M_sticker->filter($tgl1, $tgl2, $desain, $cari);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$desain = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$tomorrow = date('d-m-Y', strtotime('+1 days', strtotime($data[3])));
		$kode_kertas = strtoupper($data[5]);
		$lebar_kertas = str_replace('.', ',', $data[6]);
		$panjang_kertas = str_replace('.', ',', $data[7]);
		$id_pemeriksa = $data[8];
		$id_approval = $data[9];
		$id_operator = $data[10];
		$gsm_kertas = str_replace('.', ',', $data[11]);
		$thickness_kertas = str_replace('.', ',', $data[12]);
		$jenis_lem = strtoupper($data[13]);
		$gsm_lem = str_replace('.', ',', $data[14]);
		$thickness_lem = $data[18] - $data[16] - $data[12];
		$gsm_srp = str_replace('.', ',', $data[15]);
		$thickness_srp = str_replace('.', ',', $data[16]);
		$gsm_total = str_replace('.', ',', $data[17]);
		$thickness_total = str_replace('.', ',', $data[18]);
		$daya_rekat = str_replace('.', ',', $data[19]);
		$acc_meter = str_replace('.', ',', $data[20]);
		$reject_meter = str_replace('.', ',', $data[21]);
		$remark = $data[22];

		$jam = (int)date('Gi', strtotime($data[4]));
		if ($jam < 630) {
			$jam = $tomorrow . ' ' . $data[4];
		} else {
			$jam = $tgl . ' ' . $data[4];
		}

		if ($id_edit == '') {
			$urut = $this->M_sticker->urut();
			$this->M_sticker->simpan($urut, $nmr, $desain, $tgl, $jam, $kode_kertas, $lebar_kertas, $panjang_kertas, $id_pemeriksa, $id_approval, $id_operator, $gsm_kertas, $thickness_kertas, $jenis_lem, $gsm_lem, $thickness_lem, $gsm_srp, $thickness_srp, $gsm_total, $thickness_total, $daya_rekat, $acc_meter, $reject_meter, $remark);
		}else{
			$this->M_sticker->update($id_edit, $nmr, $desain, $tgl, $jam, $kode_kertas, $lebar_kertas, $panjang_kertas, $id_pemeriksa, $id_approval, $id_operator, $gsm_kertas, $thickness_kertas, $jenis_lem, $gsm_lem, $thickness_lem, $gsm_srp, $thickness_srp, $gsm_total, $thickness_total, $daya_rekat, $acc_meter, $reject_meter, $remark);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_sticker->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_sticker->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$data = $this->M_sticker->cetak($id_cetak);
		print_r(json_encode($data));
	}

}