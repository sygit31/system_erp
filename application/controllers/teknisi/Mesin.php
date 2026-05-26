<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mesin extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('teknisi/M_mesin');
		session_start();
	}

	function show_mesin() {
		$data['mesin'] = $this->M_mesin->show_mesin();    	
		$data['material'] = $this->M_mesin->show_material();    	
		$this->load->view('teknisi/v_mesin.php',$data);
	}

	function simpan_mesin()	{
		$data = $this->input->post('data');
		$this->M_mesin->simpan_mesin($data);
	}

	function filter_mesin()	{
		$data = $this->input->post('data');
		$teknisi['mesin'] = $this->M_mesin->filter_mesin($data);
		$this->load->view('teknisi/v_mesin_table.php',$teknisi);
	}

	function show_part() {	
		$id = $this->input->post('data');
		$part = $this->M_mesin->show_part($id);
		print_r(json_encode($part));
	}

}