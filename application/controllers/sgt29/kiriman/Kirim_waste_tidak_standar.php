<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim_waste_tidak_standar extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_kirim_waste');
		
		session_start();
	}
	
	function index(){
		$data["data_waste_siap_kirim"] = $this->M_kirim_waste->getWasteSiapKirim();

		$this->load->view('sgt/kiriman/v_kirim_waste_tidak_standar.php',$data);
	}



}
?>