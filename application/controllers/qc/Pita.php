<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pita extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_pita');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_pita->desain();
		$data['pemeriksa'] = $this->M_pita->pemeriksa();
		$data['approval'] = $this->M_pita->approval();
		$data['operator'] = $this->M_pita->operator();

		$this->load->view('qc/v_pita.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$desain = $data[2];

		$data = $this->M_pita->auto_no($id_edit, $desain, $tgl);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$seri = $data[3];
		$mesin = $data[4];

		$data = $this->M_pita->filter($tgl1, $tgl2, $desain, $seri, $mesin);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$nmr = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$mesin = $data[4];
		$tomorrow = date('d-m-Y', strtotime('+1 days', strtotime($data[3])));
		$kode_foil = strtoupper($data[6]);
		$panjang_bahan = str_replace('.', ',', $data[7]);
		$lebar_bahan = str_replace('.', ',', $data[8]);
		$seri = $data[9];
		$lebar = $data[10];
		$qty_roll = $data[11];
		$panjang = str_replace('.', ',', $data[12]);
		$arah_baca = $data[13];
		$cerah = $data[14];
		$visual = $data[15];
		$acc = str_replace('.', ',', $data[16]);
		$reject = str_replace('.', ',', $data[17]);
		$id_operator = $data[18];
		$id_pemeriksa = $data[19];
		$id_approval = $data[20];
		$remark = $data[21];

		$jam = (int)date('Gi', strtotime($data[5]));
		if ($jam < 630) {
			$jam = $tomorrow . ' ' . $data[5];
		} else {
			$jam = $tgl . ' ' . $data[5];
		}

		if ($id_edit == '') {
			$urut = $this->M_pita->urut();
			$this->M_pita->simpan($urut, $desain, $nmr, $tgl, $mesin, $jam, $kode_foil, $panjang_bahan, $lebar_bahan, $seri, $lebar, $qty_roll, $panjang, $arah_baca, $cerah, $visual, $acc, $reject, $id_operator, $id_pemeriksa, $id_approval, $remark);
		}else{
			$this->M_pita->update($id_edit, $desain, $nmr, $tgl, $mesin, $jam, $kode_foil, $panjang_bahan, $lebar_bahan, $seri, $lebar, $qty_roll, $panjang, $arah_baca, $cerah, $visual, $acc, $reject, $id_operator, $id_pemeriksa, $id_approval, $remark);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_pita->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_pita->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$data = $this->M_pita->cetak($id_cetak);
		print_r(json_encode($data));
	}

}