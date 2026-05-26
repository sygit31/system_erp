<?php defined('BASEPATH') or exit('No direct script access allowed');

class Visc extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_visc');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_visc->desain();
		$data['pemeriksa'] = $this->M_visc->pemeriksa();
		$data['operator'] = $this->M_visc->operator();
		$data['mengetahui'] = $this->M_visc->mengetahui();

		$this->load->view('qc/v_visc.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tahun = date('y', strtotime($data[1]));
		$tgl = date('d-m-Y', strtotime($data[1]));

		$data = $this->M_visc->auto_no($id_edit, $tahun, $tgl);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$kode_roll = $data[3];

		$data = $this->M_visc->filter($tgl1, $tgl2, $desain, $kode_roll);
		$target = $this->M_visc->open_set();
		print_r(json_encode(array($target, $data)));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$desain = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$tomorrow = date('d-m-Y', strtotime('+1 days', strtotime($data[3])));
		$proses_1 = $data[5];
		$proses_2 = $data[6];
		$kode_1 = $data[7];
		$kode_2 = $data[8];
		$station_1 = str_replace('.', ',', $data[9]);
		$station_2 = str_replace('.', ',', $data[10]);
		$station_3 = str_replace('.', ',', $data[11]);
		$station_4 = str_replace('.', ',', $data[12]);
		$id_pemeriksa = $data[13];
		$id_operator = $data[14];
		$id_mengetahui = $data[15];
		$keterangan = $data[16];

		$jam = (int)date('Gi', strtotime($data[4]));
		if ($jam < 630) {
			$jam = $tomorrow . ' ' . $data[4];
		} else {
			$jam = $tgl . ' ' . $data[4];
		}

		if ($id_edit == '') {
			$urut = $this->M_visc->urut();
			$this->M_visc->simpan($urut, $nmr, $desain, $tgl, $jam, $proses_1, $proses_2, $kode_1, $kode_2, $station_1, $station_2, $station_3, $station_4, $id_pemeriksa, $id_operator, $id_mengetahui, $keterangan);
		}else{
			$this->M_visc->update($id_edit, $nmr, $desain, $tgl, $jam, $proses_1, $proses_2, $kode_1, $kode_2, $station_1, $station_2, $station_3, $station_4, $id_pemeriksa, $id_operator, $id_mengetahui, $keterangan);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_visc->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_visc->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$target = $this->M_visc->open_set();
		$data = $this->M_visc->cetak($id_cetak);
		print_r(json_encode(array($target, $data)));
	}

	function open_set() {
		$data = $this->M_visc->open_set();
		print_r(json_encode($data));
	}

	function simpan_set() {
		$data = $this->input->post('data');
		$visc_d1 = $data[0];
		$visc_r1 = $data[1];
		$visc_r2 = $data[2];
		$visc_r3 = $data[3];
		
		$data = $this->M_visc->simpan_set($visc_d1, $visc_r1, $visc_r2, $visc_r3);
	}

}