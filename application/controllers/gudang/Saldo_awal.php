<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_awal extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_saldo');
		$this->load->model('pembelian/M_pembelian');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {  	
		$data['produk'] = $this->M_saldo->barang();	    	
		$data['tahun'] = $this->M_saldo->tahun();    	
		$this->load->view('gudang/v_saldo.php',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tahun = $data[0];
		$cari = strtoupper($data[1]);

		$data['filter'] = $this->M_saldo->filter($tahun,$cari);
		$this->load->view('gudang/v_saldo_table.php',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_barang = $data[0];
		$saldo = str_replace('.', ',', $data[1]);
		$harga = str_replace('.', ',', $data[2]);
		
		$id = $this->M_saldo->urut();
		$this->M_saldo->simpan($id,$id_barang,$saldo,$harga);
	}


}

?>