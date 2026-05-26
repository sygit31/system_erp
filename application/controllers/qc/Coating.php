<?php defined('BASEPATH') or exit('No direct script access allowed');

class Coating extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_coating');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_coating->desain();
		$data['pemeriksa'] = $this->M_coating->pemeriksa();
		$data['approval'] = $this->M_coating->approval();

		$this->load->view('qc/v_coating.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tahun = date('y', strtotime($data[1]));
		$tgl = date('d-m-Y', strtotime($data[1]));

		$data = $this->M_coating->auto_no($id_edit, $tahun, $tgl);
		print_r(json_encode($data));
	}

	function isi_roll() {
		$desain = $this->input->post('data');
		$data = $this->M_coating->isi_roll($desain);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$kode_roll = $data[3];

		$data = $this->M_coating->filter($tgl1, $tgl2, $desain, $kode_roll);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$desain = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$tomorrow = date('d-m-Y', strtotime('+1 days', strtotime($data[3])));
		$kode_roll = $data[5];
		$panjang = str_replace('.', ',', $data[6]);
		$id_pemeriksa = $data[7];
		$id_approval = $data[8];
		$speed = str_replace('.', ',', $data[9]);
		$visual = $data[10];
		$arah = $data[11];
		$visc_1 = str_replace('.', ',', $data[12]);
		$visc_2 = str_replace('.', ',', $data[13]);
		$visc_3 = str_replace('.', ',', $data[14]);
		$gsm_1 = str_replace('.', ',', $data[15]);
		$gsm_2 = str_replace('.', ',', $data[16]);
		$gsm_3 = str_replace('.', ',', $data[17]);
		$acc = str_replace('.', ',', $data[18]);
		$rej = str_replace('.', ',', $data[19]);
		$keterangan = $data[20];

		$jam = (int)date('Gi', strtotime($data[4]));
		if ($jam < 630) {
			$jam = $tomorrow . ' ' . $data[4];
		} else {
			$jam = $tgl . ' ' . $data[4];
		}

		if ($id_edit == '') {
			$urut = $this->M_coating->urut();
			$this->M_coating->simpan($urut, $nmr, $desain, $tgl, $jam, $kode_roll, $panjang, $id_pemeriksa, $id_approval, $speed, $visual, $arah, $visc_1, $visc_2, $visc_3, $gsm_1, $gsm_2, $gsm_3, $acc, $rej, $keterangan);
		}else{
			$this->M_coating->update($id_edit, $nmr, $desain, $tgl, $jam, $kode_roll, $panjang, $id_pemeriksa, $id_approval, $speed, $visual, $arah, $visc_1, $visc_2, $visc_3, $gsm_1, $gsm_2, $gsm_3, $acc, $rej, $keterangan);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_coating->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_coating->hapus($id_hapus);
	}

	function open_set() {
		$dt_kode = $this->input->post('data');
		$data = $this->M_coating->open_set($dt_kode);
		print_r(json_encode($data));
	}

	function simpan_set() {
		$data = $this->input->post('data');
		$dt_kode = $data[3];
		$dt_deskripsi = $data[4];

		$this->M_coating->hapus_target($dt_kode);
		$urut_target = $this->M_coating->urut_target();
		for ($i=0; $i<count($dt_kode); $i++) {
			$kode = $dt_kode[$i];
			$deskripsi = $dt_deskripsi[$i];
			$target = str_replace('.', ',', $data[0][$i]);
			$max = str_replace('.', ',', $data[1][$i]);
			$min = str_replace('.', ',', $data[2][$i]);

			print_r(array($urut_target, $kode, $deskripsi, $target, $max, $min));
			$this->M_coating->simpan_target($urut_target, $kode, $deskripsi, $target, $max, $min);
			$urut_target++;
		}
	}

	function cetak() {
		$data = $this->input->post('data');
		$id_cetak = $data[0];
		$dt_kode = $data[1];

		$target = $this->M_coating->open_set($dt_kode);
		$data = $this->M_coating->cetak($id_cetak);
		print_r(json_encode(array($target, $data)));
	}

}