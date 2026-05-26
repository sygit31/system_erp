<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilai extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_penilai');
		session_start();
	}

	function show_penilai()	{
		// $this->load->view('administrator/v_error'); return;
		
		$data['unit'] = $this->M_penilai->unit();	    	
		$data['bagian'] = $this->M_penilai->bagian();

		$data['karyawan'] = $this->M_penilai->show_karyawan();
		$data['penilai'] = $this->M_penilai->show_penilai();

		$this->load->view('sistem/v_penilai',$data);
	}

	function data_karyawan() {
		$data = $this->M_penilai->data_karyawan();
		print_r(json_encode($data));
	}

	function ambil_karyawan()	{
		$kategori = $this->input->post('data');

		$data = $this->M_penilai->ambil_karyawan($kategori);
		print_r(json_encode($data));
	}

	function simpan_penilai() {
		$data = $this->input->post('data');
		$id_sis_penilai = $data[0];
		$id_penilai = $data[1];
		$kategori = $data[2];

		if ($id_sis_penilai == '') {
			$id_sis_penilai = $this->M_penilai->urut_penilai();
			$this->M_penilai->simpan_penilai($id_sis_penilai,$id_penilai,$kategori);
		}else{
			$this->M_penilai->update_penilai($id_sis_penilai,$id_penilai,$kategori);
		}

		$id_sis_kategori = $this->M_penilai->urut_kategori();
		for ($i=0; $i<count($data[3]); $i++) {
			$id_karyawan = $data[3][$i];
			$id_edit_kategori = $data[4][$i];
			if ($id_edit_kategori == '') {
				$this->M_penilai->simpan_kategori($id_sis_kategori,$id_sis_penilai,$id_karyawan);
				$id_sis_kategori++;			
			}else{
				$this->M_penilai->update_kategori($id_edit_kategori,$id_sis_penilai,$id_karyawan);
			}
		}
	}

	function preview_penilai() {
		$data = $this->input->post('data');
		$id_penilai = $data[0];
		$kategori = $data[1];
		$unit = $data[2];

		$data = $this->M_penilai->preview_penilai($id_penilai,$kategori,$unit);
		print_r(json_encode($data));
	}

	function filter_nilai() {
		$data = $this->input->post('data');
		$tab = $data[2];
		$id_bagian = $data[3];
		$kd_unit = $data[4];
		
		if ($tab == 'Penilai') {
			$cari = strtoupper($data[0]);
			$data['penilai'] = $this->M_penilai->filter_nilai($cari);
			$this->load->view('sistem/v_penilai_table',$data);
		}else{
			$cari = strtoupper($data[1]);
			$data['karyawan'] = $this->M_penilai->filter_karyawan($cari,$id_bagian,$kd_unit);
			$this->load->view('sistem/v_penilai_table_detail',$data);
		}		
	}

	function hapus_penilai() {
		$id_penilai = $this->input->post('data');
		$this->M_penilai->hapus_penilai($id_penilai);
	}

	function hapus_sis_kategori() {
		$id_sis_kategori = $this->input->post('data');
		$this->M_penilai->hapus_sis_kategori($id_sis_kategori);
	}

}

?>