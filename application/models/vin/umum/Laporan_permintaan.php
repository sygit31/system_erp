<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_permintaan extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_permintaan');
		
		session_start();
	}
	
	function index(){
		$data['laporan_permintaan_track'] = $this->M_permintaan->getLaporanPermintaanTrack();
		
		
		$this->load->view('sgt/umum/v_laporan_permintaan.php',$data);
	}

	

}
?>