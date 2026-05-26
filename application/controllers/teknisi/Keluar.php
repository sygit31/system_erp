<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Keluar extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('teknisi/M_keluar');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['jenis'] = 'SPARE PART';
		$dt_login = $this->M_keluar->dt_login();
		$data['dt_unit'] = $this->M_keluar->dt_unit();
		$data['kd_unit'] = $dt_login[0];
		$data['id_bagian'] = $dt_login[1];
		$data['karyawan'] = $this->M_keluar->karyawan($data['kd_unit'], $data['id_bagian']);
		$data['dt_bahan'] = $this->M_keluar->bahan($data['jenis'], $data['kd_unit']);
		
		$this->load->view('teknisi/v_keluar.php',$data);
	}

	function bahan() {
		$data = $this->input->post('data');
		$jenis = $data[0];
		$kd_unit = $data[1];

		$data = $this->M_keluar->bahan($jenis, $kd_unit);
		print_r(json_encode($data));
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$thn = date('y', strtotime($data[1]));
		$bln = date('m', strtotime($data[1]));
		$kd_unit = $data[2];
		$jenis = $data[3];

		$data = $this->M_keluar->auto_no($id_edit,$bln, $thn, $kd_unit, $jenis);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$jenis = $data[0];
		$tgl1 = date('ymd', strtotime($data[1]));
		$tgl2 = date('ymd', strtotime($data[2]));
		$kd_unit = $data[3];
		$id_bahan = $data[4];
		$id_kary = $data[5];

		$data = $this->M_keluar->filter($jenis, $tgl1, $tgl2, $kd_unit, $id_bahan, $id_kary);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$kd_unit = $data[1];
		$tgl = date('d-m-Y',strtotime($data[2]));
		$nmr = $data[3];
		$id_kary = $data[4];
		$jenis = $data[5];
		$isi_tabel = $data[6];

		if ($id_edit != '') {$this->M_keluar->batal($id_edit);}

		$id_bagian = $this->M_keluar->dt_login()[1];
		$id_keluar = $this->M_keluar->urut();
		$this->M_keluar->simpan($id_keluar, $kd_unit, $tgl, $nmr, $id_bagian, $id_kary, $id_kary, $id_kary, $id_kary, $jenis);

		for ($i=0; $i<count($isi_tabel[0]); $i++) {
			$id_barang = $isi_tabel[0][$i];
			$satuan = $isi_tabel[1][$i];
			$qty = str_replace('.', ',', $isi_tabel[2][$i]);
			$keterangan = $isi_tabel[3][$i];

			$id_detail = $this->M_keluar->urut_detail();
			$this->M_keluar->simpan_detail($id_detail, $id_keluar, $id_barang, $satuan, $qty, $keterangan);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_keluar->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_keluar->hapus($id_hapus);
	}

}