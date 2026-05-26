<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_budget extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('pembelian/M_lap_budget');
		$this->load->model('ppic/M_budget');
		session_start();
	}

	function index() {
		$data['budget'] = $this->M_lap_budget->show_budget();
		$data['periode'] = $this->M_budget->get_periode();
		$this->load->view('pembelian/v_lap_budget.php',$data);
	}

	function filter_budget() {
		$periode = $this->input->post('data');

		$data['budget'] = $this->M_lap_budget->filter_budget($periode);
		$this->load->view('pembelian/v_lap_budget_table.php',$data);
	}

}

?>