<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_data_project');
		$this->load->model('sistem/M_ide');
		$this->load->model('dash/M_reminder');
		session_start();
	}

	function index() {
		$data['project']=$this->M_data_project->show();
		$data['ide'] = $this->M_ide->show_ide();
		$data['isi_box'] = $this->M_reminder->isi_box();
		
		$this->load->view('dash/v_reminder',$data);
	}

	function video() {
		$data = $this->M_reminder->video();
		print_r($data);
	}

}

?>