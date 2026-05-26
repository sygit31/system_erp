<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ide extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_ide');
		session_start();
	}

	function show_ide()	{
		if(!isset($_SESSION['logERP'])) {header("location:". base_url()); return;}

		$data['karyawan'] = $this->M_ide->show_karyawan();
		$data['ide'] = $this->M_ide->show_ide();

		$this->load->view('sistem/v_ide',$data);
	}

	function auto_no() {
		$tahun = $this->input->post('data');
		$nmr = $this->M_ide->auto_no($tahun);
		print_r($nmr);
	}

	function simpan_ide() {
		$data = $this->input->post('data');
		$nmr = $data[0];
		$id_karyawan = $data[1];
		$ide = $data[2];

		$this->M_ide->simpan_ide($nmr,$id_karyawan,$ide);
	}

	function filter_ide() {
		$data = $this->input->post('data');
		$cari = strtoupper($data[0]);
		$tahun = $data[1];
		$status = $data[2];

		$data['ide'] = $this->M_ide->filter_ide($cari,$tahun,$status);
		$this->load->view('sistem/v_ide_table',$data);
	}

	function approve_ide() {
		$id_ide = $this->input->post('data');
		$this->M_ide->approve_ide($id_ide);
	}

}

?>