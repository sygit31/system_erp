<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class risalah extends CI_Controller {
	function __construct(){
		parent::__construct();
		
		$this->load->model('cs/M_risalah');
		session_start();
	}

	function show_risalah()
	{
		$cs['risalah']=$this->M_risalah->show_risalah();
		$cs['produk']=$this->M_risalah->show_produk();
		$this->load->view('cs/v_risalah',$cs);
	}	

	function simpan_risalah(){
		$data = $this->input->post('data');
		$this->M_risalah->simpan_risalah($data);
	}

	function filter_risalah() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');
		$desain = $data[2];
		$cari = strtoupper($data[3]);

		$cs['risalah']=$this->M_risalah->filter_risalah($tgl1,$tgl2,$desain,$cari);
		$this->load->view('cs/v_risalah_table',$cs);
	}

}
