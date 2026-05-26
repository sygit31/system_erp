<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bahan extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_bahan');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['barang'] = $this->M_bahan->barang();
		$data['pemeriksa'] = $this->M_bahan->pemeriksa();
		$data['approval'] = $this->M_bahan->approval();

		$this->load->view('qc/v_bahan.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tahun = date('y', strtotime($data[1]));
		$tgl = date('d-m-Y', strtotime($data[1]));

		$data = $this->M_bahan->auto_no($id_edit, $tahun, $tgl);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$id_barang = $data[2];

		$data = $this->M_bahan->filter($tgl1, $tgl2, $id_barang);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$tgl_pbt = date('d-m-Y', strtotime($data[2]));
		$tgl = date('d-m-Y', strtotime($data[3]));
		$id_barang = $data[4];
		$qty = str_replace('.', ',', $data[5]);
		$satuan = $data[6];
		$solid = str_replace('.', ',', $data[7]);
		$visc = str_replace('.', ',', $data[8]);
		$densitas = str_replace('.', ',', $data[9]);
		$visual = $data[10];
		$acc = $data[11];
		$id_pemeriksa = $data[12];
		$id_approval = $data[13];
		$keterangan = $data[14];

		if ($id_edit == '') {
			$urut = $this->M_bahan->urut();
			$this->M_bahan->simpan($urut, $nmr, $tgl_pbt, $tgl, $id_barang, $qty, $satuan, $solid, $visc, $densitas, $visual, $acc, $id_pemeriksa, $id_approval, $keterangan);
		}else{
			$this->M_bahan->update($id_edit, $nmr, $tgl_pbt, $tgl, $id_barang, $qty, $satuan, $solid, $visc, $densitas, $visual, $acc, $id_pemeriksa, $id_approval, $keterangan);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_bahan->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_bahan->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');
		$data = $this->M_bahan->cetak($id_cetak);
		print_r(json_encode($data));
	}

}