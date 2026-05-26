<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rev_risalah extends CI_Controller {
	function __construct(){
		parent::__construct();
		
		$this->load->model('cs/M_rev_risalah');
		session_start();
	}

	function show_risalah_rev() {
		$cs['rev_risalah']=$this->M_rev_risalah->show_rev_risalah();
		$cs['risalah']=$this->M_rev_risalah->get_risalah();
		$this->load->view('Cs/v_rev_risalah',$cs);
	}	

	function get_no_risalah() {		
		$data = $this->input->post('data');
		$get_no_risalah = $this->M_rev_risalah->get_no_risalah($data);
		print_r($get_no_risalah);
	}

	function simpan_revisi(){
		$data = $this->input->post('data');
		$this->M_rev_risalah->simpan_revisi($data);
	}

	function filter_risalah_rev() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');
		$desain = $data[2];
		$cari = strtoupper($data[3]);

		$cs['rev_risalah']=$this->M_rev_risalah->filter_risalah_rev($tgl1,$tgl2,$desain,$cari);
		$this->load->view('cs/v_rev_risalah_table',$cs);
	}

}
