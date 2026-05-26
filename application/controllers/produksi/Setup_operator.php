<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup_operator extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_setup_operator');
		session_start();
	}

	function index() {
		$data['kode_flow'] = $this->M_setup_operator->kode_flow();
		$data['desain'] = $this->M_setup_operator->desain();
		$data['proses'] = $this->M_setup_operator->proses();
		$data['operator'] = $this->M_setup_operator->operator();

		$this->load->view('produksi/v_setup_operator.php', $data);
	}

	function mesin() {
		$proses = $this->input->post('data');

		$data = $this->M_setup_operator->mesin($proses);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$proses = $data[1];

		$data['filter'] = $this->M_setup_operator->filter($desain, $proses);
		$this->load->view('produksi/v_setup_operator_table', $data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$proses = $data[2];
		$mesin = $data[3];
		$shift = $data[4];
		$id_operator = $data[5];

		if ($id_edit == '') {
			$id_prod_proses = $this->M_setup_operator->urut_proses($desain, $proses, $mesin, $shift);
			$id_prod_proses_detail = $this->M_setup_operator->urut_proses_detail();
			$this->M_setup_operator->simpan($id_prod_proses_detail, $id_prod_proses, $id_operator);
		}else{
			$this->M_setup_operator->update($id_edit, $id_operator);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_setup_operator->edit($id_edit);
		print_r(json_encode($data));
	}

	function batal() {
		$id = $this->input->post('data');
		$this->M_setup_operator->batal($id);
	}

}
