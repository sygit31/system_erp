<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submit extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_submit');
		session_start();
	}

	function index() {
		$this->load->view('produksi/v_submit.php');
	}

	function show_submit() {
		$data['budget'] = $this->M_submit->show_submit();
		print_r(json_encode($data));		
	}

	function show_budget() {
		$id_budget = $this->input->post('data');

		$data = $this->M_submit->show_budget($id_budget);
		print_r(json_encode($data));
	}

	function simpan_approval() {
		$data = $this->input->post('data');
		$id_budget = $data[0];
		$status = $data[1];

		$this->M_submit->simpan_approval($id_budget,$status);
		print_r(date('d-M-Y'));
	}

}

?>