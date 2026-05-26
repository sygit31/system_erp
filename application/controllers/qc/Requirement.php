<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requirement extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_master_barang');
		$this->load->model('M_test_code');
		$this->load->model('M_test_group');
		session_start();
	}
	
	function index(){
		$data['master_barang'] = $this->M_master_barang->SelectAll();
		$data['data_test'] = $this->M_test_code->getAllDataTestCodeOnly();

		$this->load->view('qc/v_requirement.php',$data);
	}

	
	public function getDetailtest()
	{
	  		# code...DetailTestById
		$id = $this->input->POST('id');
		$DetailTest = array();
		$DetailTest = $this->M_master_barang->DetailTestById($id);
		echo json_encode($DetailTest);
	}


	public function save(){
	  		// print_r($_POST);
		$success = true;

	  		//delete
		$ids_delete = $this->input->POST('txtIdGroupDelete');
		if ($ids_delete != ""){
			$data = explode("@",$ids_delete);
			foreach($data as $xxx){
				if ($xxx != ""){
					$success = $this->M_test_group->delete($xxx);
				}
			}
		}

	  		//simpan data baru
		$nomor_detail = $this->input->POST('txtNomorDetail');
		$dataDetail = array();
		for ($i=0; $i < $nomor_detail; $i++) { 
	  			if (isset($_POST['txtDIdGroup_'.$i])) { // variabel ada
					$IdGroup = $this->input->POST('txtDIdGroup_'.$i); // tanpa cek isset, tidak ada variabel akan menghasilkan ''
		  			if ($IdGroup == "") { // berarti baru
		  				$xxx = array(); //perlu deklarasi supaya tidak salah tafsir jadi huruf pertama saja
		  				$xxx['idTest'] = $this->input->POST('txtDIdTest_'.$i);
		  				$xxx['idBarang'] = $this->input->POST('txtIdBarang');

		  				$dataDetail[] = $xxx;
		  			}	
		  		}
		  		
		  	}

		  	if (!empty($dataDetail)) {
		  		if ($success) {
		  			foreach($dataDetail as $isi){
		  				$success = $this->M_test_group->save($isi);
		  			}
		  		}
		  	}
		  	
		  	if($success){
				// $this->index();
		  		$_SESSION['pesan']='<font color="blue">Berhasil disimpan</font>';
		  		print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/qc/requirement'>");

		  	}else{
		  		echo "error";
		  		exit();
		  	}
		  }



		}
		?>