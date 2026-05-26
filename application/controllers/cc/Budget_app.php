<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget_app extends CI_Controller {
	function __construct(){
		parent::__construct();
		
		$this->load->model('cc/M_budget');
		$this->load->model('cc/M_budget_app');
		session_start();
	}

	function index()
	{
		$data['budget'] = $this->M_budget_app->show_budget();
		$data['periode'] = $this->M_budget->get_periode();
		$this->load->view('cc/v_budget_app.php',$data);
	}	

	function preview_budget(){
		$id_budget = $this->input->post('data');
		$data = $this->M_budget->preview_budget($id_budget);
		print_r(json_encode($data));
	}

	function filter_budget() {
		$periode = $this->input->post('data');
		
		$data['budget'] = $this->M_budget_app->filter_budget($periode);
		$this->load->view('cc/v_budget_app_table.php',$data);
	}

	function status() {
		$data = $this->input->post('data');
		$id_budget = $data[0];
		$app_status = $data[1];
		if ($app_status == 'Approve') {$app_status = '1';}else{$app_status = '0';}
		$id_budget_app = $this->M_budget_app->urut_budget_app();
		
		$this->M_budget_app->status($id_budget_app,$id_budget,$app_status);
	}

}
