<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('cs/M_arsip');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['status_menu'] = $this->M_arsip->status_menu($_GET['mn']);
		$data['karyawan'] = $this->M_arsip->karyawan($_GET['mn']);	
		$data['bagian'] = $this->M_arsip->bagian();	
		$data['kode_rak'] = $this->M_arsip->kode_rak();	
		$data['nomor_rak'] = $this->M_arsip->nomor_rak();	
		
		$this->load->view('cs/v_arsip.php', $data);
	}

	function isi_kode_rak() {
		$data = $this->M_arsip->isi_kode_rak();	
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$id_bagian = $data[0];
		$kode_rak = $data[1];
		$nomor_rak = $data[2];
		$cari = $data[3];

		$data['filter'] = $this->M_arsip->filter($id_bagian, $kode_rak, $nomor_rak, $cari);
		$this->load->view('cs/v_arsip_table',$data);
	}

	function urut_bagian() {
		$id_bagian = $this->input->post('data');
		$data = $this->M_arsip->urut_bagian($id_bagian);
		print_r($data);
	}

	function cek_box() {
		$data = $this->input->post('data');
		$id_bagian = $data[0];
		$urut_box = $data[1];
		$id_edit = $data[2];
		$kode_rak = $data[3];

		$urut_box = $this->M_arsip->cek_urut_box($id_bagian, $urut_box, $id_edit);
		$kode_rak = $this->M_arsip->cek_kode_rak($id_edit, $kode_rak);
		print_r(json_encode(array($urut_box, $kode_rak)));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$id_kary = $data[1];
		$id_bagian = $data[2];
		$kode_rak = $data[3];
		$urut_box = $data[4];
		$kode_box = $data[5];
		$isi = $data[6];
		$retensi = $data[7];
		$tgl = date('d-m-Y',strtotime($data[8]));

		if ($id_edit == '') {
			$id = $this->M_arsip->urut();
			$this->M_arsip->simpan($id, $id_kary, $id_bagian, $kode_rak, $urut_box, $kode_box, $isi, $retensi, $tgl);
		}else{
			$this->M_arsip->update($id_edit, $id_kary, $id_bagian, $kode_rak, $urut_box, $kode_box, $isi, $retensi, $tgl);			
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_arsip->edit($id_edit);
		print_r(json_encode($data));
	}

	function cetak() {
		$kode_rak = $this->input->post('data');
		$data = $this->M_arsip->cetak($kode_rak);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_arsip->hapus($id_hapus);
	}

	function lihat() {
		$rak = $this->input->post('data');
		$data = $this->M_arsip->lihat($rak);
		print_r(json_encode($data));
	}

	function daftar_rak() {
		$data = $this->M_arsip->kode_rak();
		print_r(json_encode($data->result_array()));
	}

	function isi_ambil() {
		$data = $this->M_arsip->isi_ambil();
		print_r(json_encode($data));
	}

}