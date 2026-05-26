<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_parameter extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_test_code');
		$this->load->model('sgt/M_detail_test_code');
		$this->load->database();
		    //$this->load->library(array('session'));
		session_start();
		
	}
	
	function index()
	{    
	        // $data['xxx'] = $this->M_test_code->getMaxTestCode();
	        // $data['detail'] = $this->M_test_code->getMaxDetailTestCode();
		$data['stage'] = $this->M_test_code->getMasterStage();
	        // $data['test_code'] = $this->M_test_code->getMasterTestCode();
		$data['all_data'] = $this->M_test_code->getAllData();
		$data['edit_test'] = array();
		
		$this->load->view('sgt/qc/v_master_parameter.php',$data);
	}

	public function editKategori($test_code)
	{
		$data = array();
		$code =  $this->M_test_code->findById($test_code);
		$data['kategori'] = $code;
		$this->load->view('sgt/qc/v_edit_master_parameter.php',$data);
	}

	public function save_testcode()
	{   
	    	// print_r($_POST);
		$success = true;

		$txtFlagEdit = $this->input->post('txtFlagEdit');
		if ($txtFlagEdit == 'no'){
	    		//Save

			$data['Kode'] = 'kode';
			$data['Deskripsi'] = $this->input->post('txtDeskripsi');
			$data['Stage'] = $this->input->post('cmbStage');
			$jenis = $this->input->post('cmbJenis');
			$data['Jenis'] = $jenis;
			$data['Prioritas'] = $this->input->post('cmbPrioritas');

			$dataDetail = array();
			$jumlahDetail = $this->input->post('txtJumlahDetail');

			if ($jenis == 'measure'){
				for($i=0;$i<=$jumlahDetail;$i++){
					$Max = $this->input->post('txtDMax'.$i);
					$dataDetail[$i]['Max'] = str_replace('.',',',$Max);
					$Min = $this->input->post('txtDMin'.$i);
					$dataDetail[$i]['Min'] = str_replace('.',',',$Min);
					$dataDetail[$i]['Hasil'] = $this->input->post('txtDHasil'.$i);;
					$dataDetail[$i]['Range'] = $this->input->post('txtDRange'.$i);
				}
			}

			if ($jenis == 'visibility'){
				for($i=0;$i<=$jumlahDetail;$i++){
					$dataDetail[$i]['Max'] = '';
					$dataDetail[$i]['Min'] = '';
					$dataDetail[$i]['Hasil'] = $this->input->post('txtDHasil'.$i);
					$dataDetail[$i]['Range'] = $this->input->post('txtDRange'.$i);
				}
			}

			$success = $this->M_test_code->saveTestCode($data);

			if ($success){
				foreach($dataDetail as $isi){
					if ($isi['Max']!='' || $isi['Hasil']!='') {
						$success = $this->M_detail_test_code->save($isi);
					}
				}
			}
			
		}else{
	    		//Edit

	    		//delete id_detail
			$txtIdDetailDelete = $this->input->post('txtIdDetailDelete');
			if ($txtIdDetailDelete != ""){
				$data = explode("@",$txtIdDetailDelete);
				foreach($data as $xxx){
					if ($xxx != ""){
						$success = $this->M_detail_test_code->delete($xxx);
					}
				}
			}

		    	//edit test code
			$data['Id_Test_Code'] = $this->input->post('txtIdTestCode');
			$data['Kode'] = 'kode';
			$data['Deskripsi'] = $this->input->post('txtDeskripsi');
			$data['Stage'] = $this->input->post('cmbStage');
			$jenis = $this->input->post('cmbJenis');
			$data['Jenis'] = $jenis;
			$data['Prioritas'] = $this->input->post('cmbPrioritas');

			$success = $this->M_test_code->edit($data);

			
			  	//save test code detail
			$dataDetail = array();
			$dataDetailEdit = array();
			$jumlahDetail = $this->input->post('txtJumlahDetail');

			if ($jenis == 'measure'){
				for($i=0;$i<=$jumlahDetail;$i++){
					$idDetail = $this->input->post('txtDId'.$i);
					if ($idDetail == "0"){
						$Max = $this->input->post('txtDMax'.$i);
						$dataDetail[$i]['Max'] = str_replace('.',',',$Max);
						$Min = $this->input->post('txtDMin'.$i);
						$dataDetail[$i]['Min'] = str_replace('.',',',$Min);
						$dataDetail[$i]['Hasil'] = $this->input->post('txtDHasil'.$i);;
						$dataDetail[$i]['Range'] = $this->input->post('txtDRange'.$i);
						$dataDetail[$i]['IdTestCode'] = $this->input->post('txtIdTestCode');
					}else{
						$Max = $this->input->post('txtDMax'.$i);
						$dataDetailEdit[$i]['Max'] = str_replace('.',',',$Max);
						$Min = $this->input->post('txtDMin'.$i);
						$dataDetailEdit[$i]['Min'] = str_replace('.',',',$Min);
						$dataDetailEdit[$i]['Hasil'] = $this->input->post('txtDHasil'.$i);;
						$dataDetailEdit[$i]['Range'] = $this->input->post('txtDRange'.$i);
						$dataDetailEdit[$i]['IdTestCode'] = $this->input->post('txtIdTestCode');
						$dataDetailEdit[$i]['IdDetailTestCode'] = $idDetail;
					}
				}
			}

			if ($jenis == 'visibility'){
				for($i=0;$i<=$jumlahDetail;$i++){
					$idDetail = $this->input->post('txtDId'.$i);
					if ($idDetail == "0"){
						$dataDetail[$i]['Max'] = '';
						$dataDetail[$i]['Min'] = '';
						$dataDetail[$i]['Hasil'] = $this->input->post('txtDHasil'.$i);
						$dataDetail[$i]['Range'] = $this->input->post('txtDRange'.$i);
						$dataDetail[$i]['IdTestCode'] = $this->input->post('txtIdTestCode');
					}else{
						$dataDetailEdit[$i]['Max'] = '';
						$dataDetailEdit[$i]['Min'] = '';
						$dataDetailEdit[$i]['Hasil'] = $this->input->post('txtDHasil'.$i);
						$dataDetailEdit[$i]['Range'] = $this->input->post('txtDRange'.$i);
						$dataDetailEdit[$i]['IdTestCode'] = $this->input->post('txtIdTestCode');
						$dataDetailEdit[$i]['IdDetailTestCode'] = $idDetail;
					}
				}
			}

			if ($success){
				foreach($dataDetail as $isi){
					if ($isi['Max']!='' || $isi['Hasil']!='') {
						$success = $this->M_detail_test_code->editBaru($isi);
					}
				}
			}
			
			if ($success){
				foreach($dataDetailEdit as $isi){
					if ($isi['Max']!='' || $isi['Hasil']!='') {
						$success = $this->M_detail_test_code->editLama($isi);
					}
				}
			}
		}

		if($success){
			 	// $this->index();
			$_SESSION['pesan']='<font color="blue">Berhasil disimpan</font>';
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/master_parameter'>");

		}else{
			echo "error";
			exit();
		}
	} 


	public function edit(){   
	    	// print_r($_POST);
		$id = $this->input->post('id');
		$data['edit_test'] = $this->M_test_code->getTestById($id);

		  	// $data['xxx'] = $this->M_test_code->getMaxTestCode();
		    //  $data['detail'] = $this->M_test_code->getMaxDetailTestCode();
		$data['stage'] = $this->M_test_code->getMasterStage();
	        // $data['test_code'] = $this->M_test_code->getMasterTestCode();
		$data['all_data'] = $this->M_test_code->getAllData();
		
		$this->load->view('sgt/qc/v_master_parameter.php',$data);
	} 
}

?>