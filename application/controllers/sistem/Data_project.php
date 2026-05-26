<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_project extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_data_project');
		session_start();
	}

	function index()	{    
		$sistem['project']=$this->M_data_project->show();
		$this->load->view('sistem/v_project',$sistem);
	}

	function filter()	{  
		$data = $this->input->post('data');
		$periode = $data[0];
		$status = $data[1];
		$cari = strtoupper($data[2]);

		$sistem['project'] = $this->M_data_project->filter($periode,$status,$cari);
		$this->load->view('sistem/v_project_table',$sistem);
	}

}

?>