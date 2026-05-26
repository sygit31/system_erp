<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flow extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('rnd/M_flow');
		session_start();
	}

	function show_flow() {    
		$data['station'] = $this->M_flow->show_station();
		$data['flow'] = $this->M_flow->show_flow();
		$data['proses'] = $this->M_flow->show_proses();
		$this->load->view('rnd/v_flow.php',$data);
	}

	function simpan_station() {
		$nama_station = $this->input->post('data');
		$this->M_flow->simpan_station($nama_station);
	}

	function simpan_flow() {
		$data = $this->input->post('data');
		$kode = $data[0];
		
		$id_flow = $this->M_flow->urut_flow();
		for ($i=0; $i<count($data[1]); $i++) {
			$id_station = $data[1][$i];
			$urut = $data[2][$i];
			$this->M_flow->simpan_flow($id_flow,$kode,$id_station,$urut);
			$id_flow++;
		}
	}

	function filter_flow() {
		$cari = strtoupper($this->input->post('data'));

		$data['flow'] = $this->M_flow->filter_flow($cari);   	
		$this->load->view('rnd/v_flow_table.php',$data);
	}

}

?>