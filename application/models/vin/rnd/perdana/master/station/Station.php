<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('vin/m_station_perdana');
		session_start();
	}

	function show_station() {    
		$data['station'] = $this->m_station_perdana->show_station_perdana();   	
		$this->load->view('vin/rnd/perdana/master/station/v_station.php',$data);
	}

	function simpan_station_perdana() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$station = $data[1];
		
		
		$this->m_station_perdana->simpan_station_perdana($id_edit,$station);
	}

	function filter_station() {
		$cari = strtoupper($this->input->post('data'));

		$data['station'] = $this->m_station_perdana->filter_station($cari);   	
		$this->load->view('vin/rnd/perdana/master/station/v_station_table',$data);
	}

}

?>
