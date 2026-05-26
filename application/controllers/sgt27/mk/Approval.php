<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_tugas');
		
		session_start();
	}
	
	function index(){
		$data['DataUsulan'] = $this->M_tugas->getTugasByStatus('usul');

		$this->load->view('sgt/mk/v_approval.php',$data);
	}

	
	public function simpan()
	{
			// print_r($_POST);
			// Array ( 
			// 	[example2_length] => 10 
			// 	[txtId] => Array ( 
			// 		[0] => 10 
			// 		[1] => 3 
			// 		[2] => 11 
			// 	) 
			// 	[txtApproval] => Array ( 
			// 		[0] => 
			// 		[1] => 
			// 		[2] => 
			// 	) 
			// )

		$idS = $this->input->post('txtId');
		$approvalS = $this->input->post('txtApproval');

		for ($i=0; $i < count($idS); $i++) { 
			$data['id']=$idS[$i];
			$data['approval']=$approvalS[$i];
			$data['status']='acc';
			$data['approval']!==''?$this->M_tugas->updateApproval($data):'';
		}

		print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/mk/approval'>");
	}
	

}
?>