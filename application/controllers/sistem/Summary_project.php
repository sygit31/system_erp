<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summary_project extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_summary_project');
		session_start();
	}

	function index() {    
		$data['project'] = $this->M_summary_project->show();
		$data['karyawan'] = $this->M_summary_project->karyawan();

		$this->load->view('sistem/v_summary',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$periode = $data[0];
		$id_kary = $data[1];

		$data['project'] = $this->M_summary_project->filter($periode,$id_kary);
		$this->load->view('sistem/v_summary_table',$data);
	}

	function summary_pic() {
		$data = $this->input->post('data');
		$id = $data[0];
		$periode = $data[1];

		$data = $this->M_summary_project->summary_pic($id,$periode);		
		print_r(json_encode($data));
	}

}

?>