<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tipe extends CI_Controller {

	function __construct()	{
		parent::__construct();

		$this->load->model('sistem/M_tipe');
		
		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$this->load->view('sistem/v_tipe');
	}

	function filter() {
		$data = $this->M_tipe->filter();
		print_r(json_encode($data));
	}

	function cek_kode() {
		$data = $this->input->post('data');
		$id_edit = $data[0] == '' ? 'baru' : $data[0];
		$kode = $data[1];
		$tipe = $data[2];

		$qty_kode = $this->M_tipe->cek_kode($id_edit, $kode);
		$qty_tipe = $this->M_tipe->cek_tipe($id_edit, $tipe);
		print_r(json_encode(array($qty_kode, $qty_tipe)));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$kode = $data[1];
		$tipe = $data[2];
		$group = $data[3];
		$distribusi = $data[4];

		if ($id_edit != '') {
			$this->M_tipe->update($id_edit, $kode, $tipe, $group, $distribusi);
		}else{
			$urut = $this->M_tipe->urut();
			$this->M_tipe->simpan($urut, $kode, $tipe, $group, $distribusi);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_tipe->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_tipe->hapus($id_hapus);
	}

}