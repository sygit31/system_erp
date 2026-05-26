<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hlreader_mut extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('rnd/M_hlreader_mut');
		session_start();
	}

	function input_hlreader() {
		$data['location'] = $this->M_hlreader_mut->location_mutasi(); 	
		$data['tahun'] = $this->M_hlreader_mut->tahun();  

		$data['hlreader'] = $this->M_hlreader_mut->hlreader_mutasi();
		$data['hlreader_distribusi'] = $this->M_hlreader_mut->hlreader_distribusi();
		$data['location_distribusi'] = $this->M_hlreader_mut->location_distribusi();
		$data['hlreader_upgrade'] = $this->M_hlreader_mut->hlreader_upgrade();
		$data['hlreader_tukar'] = $this->M_hlreader_mut->hlreader_tukar();

		// $data['hlreader_pinjam'] = $this->M_hlreader_mut->hlreader_pinjam();

		$data['karyawan'] = $this->M_hlreader_mut->show_karyawan();

		$this->load->view('rnd/v_hlreader_mut.php',$data);
	}

	function filter_mutasi() {
		$data = $this->input->post('data');
		$jenis = $data[0];
		$hlreader = $data[1];
		$location = $data[2];
		$kondisi = $data[3];
		$aktif = $data[4];
		$tahun = $data[5];

		$data['mutasi'] = $this->M_hlreader_mut->filter_mutasi($jenis,$hlreader,$location,$kondisi,$aktif,$tahun);   	
		$this->load->view('rnd/v_hlreader_mut_table.php',$data);
	}

	function simpan_mutasi() {
		$data = $this->input->post('data');
		$id_hlreader = $data[0];
		$id_hlreader_new =$data[1];
		$id_karyawan = $data[2];
		$jenis = $data[3];
		$no_surat = $data[4];
		$tanggal =  date('d-m-Y',strtotime($data[5]));
		$id_location = $data[6];
		$tahun = $data[7];
		$kondisi = $data[8];
		$keterangan = $data[9];
		$id_karyawan_pinjam = $data[10];
		$id_mutasi = $this->M_hlreader_mut->urut_mutasi();

		$this->M_hlreader_mut->simpan_mutasi($id_mutasi,$id_hlreader,$id_hlreader_new,$id_karyawan,$jenis,$no_surat,$tanggal,$id_location,$tahun,$kondisi,$keterangan,$id_karyawan_pinjam);	

		$this->M_hlreader_mut->update_lokasi($jenis,$id_location,$id_hlreader,$tahun,$kondisi,$id_hlreader_new);
	}

	function area_kembali() {
		$hlreader_kembali = $this->input->post('data');
		$area_kembali = $this->M_hlreader_mut->area_kembali($hlreader_kembali);
		print_r($area_kembali);
	}

	function area_tukar() {
		$hlreader_tukar = $this->input->post('data');
		$area_tukar = $this->M_hlreader_mut->area_tukar($hlreader_tukar);
		print_r($area_tukar);
	}

	function hapus_mutasi() {
		$data = $this->input->post('data');
		$id_mutasi = $data[0];
		$jenis = $data[1];
		$id_hlreader = $data[2];
		$kondisi = $data[3];
		$hlreader_new = $data[4];
		$id_location = $data[5];

		$this->M_hlreader_mut->hapus_mutasi($id_mutasi,$jenis,$id_hlreader,$kondisi,$hlreader_new,$id_location);
	}

}

?>