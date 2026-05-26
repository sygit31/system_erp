<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reject_code extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_reject_code');
		session_start();
	}
	
	public function index()
	{
		$data['TestCode'] = $this->M_reject_code->getTestCode();
		$data['NoReject'] = $this->M_reject_code->getRejectCode();
		$data['reject_code'] = $this->M_reject_code->ShowRejectData();
		$this->load->view('qc/v_reject_code.php',$data);
	}

	public function add()
	{
		$reject_code = $this->input->POST('txtRejectCode');
		$id_detail_test_code = $this->input->POST('cmbTestCode');
		$reject_description = $this->input->POST('txtRejectDescription');
		$id_reject = $this->input->POST('id_reject');
		$id_reject_code = explode("-", $id_reject);
		$data = array(
			'REJECT_CODE' => $reject_code,
			'ID_DETAIL_TEST_CODE' => $id_detail_test_code,
			'REJECT_DESCRIPTION' => $reject_description,
			'ID_REJECT_CODE' => $id_reject_code[1]
		);
		$this->M_reject_code->save('TBL_REJECT_CODE',$data);
		redirect('qc/reject_code', "activetab");
	}

	public function cek()
	{
		if($this->input->POST('simpan'))
		{
			$id_reject_code = $this->input->POST('txtRejectCode');
			print_r($_POST);
		}
	}
	

}
?>