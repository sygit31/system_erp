<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('rnd/M_location');
		session_start();
	}

	function show_location() {    
		$data['location'] = $this->M_location->show_location();   	
		$this->load->view('rnd/v_location.php',$data);
	}

	function simpan_location() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$lokasi = $data[1];
		$pic = $data[2];
		$telp = $data[3];
		$keterangan = $data[4];
		
		$this->M_location->simpan_location($id_edit,$lokasi,$pic,$telp,$keterangan);
	}

	function filter_location() {
		$cari = strtoupper($this->input->post('data'));

		$data['location'] = $this->M_location->filter_location($cari);   	
		$this->load->view('rnd/v_location_table.php',$data);
	}

}

?>