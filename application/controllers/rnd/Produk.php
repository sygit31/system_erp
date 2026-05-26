<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('rnd/M_produk');
		session_start();
	}

	function show_produk() {    
		$data['produk'] = $this->M_produk->show_produk();   	
		$this->load->view('rnd/v_produk.php',$data);
	}

	function auto_kode() {
		$jenis = $this->input->post('data');

		$data = $this->M_produk->auto_kode($jenis);
		print_r($data);
	}

	function simpan_produk() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$kode = $data[1];
		$jenis = $data[2];
		$nama = $data[3];
		$deskripsi = $data[4];
		$satuan = $data[5];
		$ukuran = $data[6];
		
		$this->M_produk->simpan_produk($id_edit,$kode,$jenis,$nama,$deskripsi,$satuan,$ukuran);
	}

	function filter_produk() {
		$data = $this->input->post('data');
		$jenis = $data[0];
		$cari = strtoupper($data[1]);

		$data['produk'] = $this->M_produk->filter_produk($jenis,$cari);   	
		$this->load->view('rnd/v_produk_table.php',$data);
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_produk->hapus($id_hapus);   	
	}

}