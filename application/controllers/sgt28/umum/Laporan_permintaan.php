<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_permintaan extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_permintaan');
		
		session_start();
	}
	
	function index(){
		$data['laporan_permintaan_track'] = $this->M_permintaan->getLaporanPermintaanTrack();
		
		
		$this->load->view('sgt/umum/v_laporan_permintaan.php',$data);
	}

	

}
?>