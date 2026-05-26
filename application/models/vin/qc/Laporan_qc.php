<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_qc extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_detail_penerimaan');
		$this->load->model('sgt/M_master_barang');
		$this->load->model('sgt/M_detail_test_code');
		$this->load->model('sgt/M_test_qc');
		$this->load->model('sgt/M_test_qc_detail');
		$this->load->model('sgt/M_nomer');
		session_start();
	}
	
	function index()
	{
		$data['laporan'] = $this->M_detail_penerimaan->getAllTest();
		$data['barang_masuk'] = $this->M_detail_penerimaan->getPenerimaanForCek();

		$this->load->view('sgt/qc/v_laporan_qc.php',$data);
	}

	
	public function getTest()
	{
		$id_detail_terima = $this->input->POST('id_detail_terima');
		$DetailTest = array();
		$DetailTest = $this->M_master_barang->DetailTestByIdDetailTerima($id_detail_terima,'1');
		print_r (json_encode($DetailTest));
	}


	public function getDetailTestCode()
	{
		$id_test_code = $this->input->POST('id_test_code');
		$DetailTest = array();
		$DetailTest = $this->M_detail_test_code->getByIdTestCode($id_test_code);
		print_r (json_encode($DetailTest));
	}


	public function getSaveTestQc()
	{
		$id_detail_terima = $this->input->POST('id_detail_terima');
		$SaveTest = array();
		$SaveTest = $this->M_test_qc_detail->getSaveTest($id_detail_terima);
		print_r (json_encode($SaveTest));
	}


	public function filter()
	{
	  		// print_r($_POST);
		$data['tanggalAwal'] = $this->input->POST('tanggalAwal');
		$data['tanggalAkhir'] = $this->input->POST('tanggalAkhir');

		$data['laporan'] = $this->M_detail_penerimaan->getAllTest($data,true);
		$data['barang_masuk'] = $this->M_detail_penerimaan->getPenerimaanForCek();

		$this->load->view('sgt/qc/v_laporan_qc.php',$data);
	}

	  // 	public function save()
	  // 	{
	  // 		// print_r($_POST);
	  // 		$CRE = explode('|',$_SESSION['logERP']);
			// $data['id_login'] = $CRE[0];
			// $data['id_detail_terima'] = $this->input->POST('txtIdDetailTerima');
			// $data['grade'] = $this->input->POST('txtGrade');
			// $data['nomer'] = '';
			// $data['id_stage'] = '1';
			// $status = $this->input->POST('cmbStatus');

			// //tahun barang
	  // 		$tmpTahun = $this->M_master_barang->getTahunByIdDetailTerima($data['id_detail_terima']);
	  // 		$Tahun = $tmpTahun[0]->TAHUN;
	  // 		$Kode = $tmpTahun[0]->KODE;

	  // 		$nomerTestQc = 0;
	  // 		if ($status === "CLOSE") {
	  // 			//nomer test qc
		 //  		$qwerty = $this->M_nomer->getNomerTestQc();
		 //  		$nomerTestQc = $qwerty[0]->TEST_QC;
			// 	$nomerTestQc += 1;
			// 	$FnomerTestQc = sprintf('%04d', $nomerTestQc);
			// 	$data['nomer'] = $FnomerTestQc."-".$Kode."-".$Tahun;
	  // 		}
	

	  // 		$dataDetail = array();
		 // 	$totalDetail = $this->input->post('txtNomorDetail');
		 // 	if($totalDetail > 0 || $totalDetail != ""){
			// 	for($i=0;$i<$totalDetail;$i++){
			// 		$dataDetail[$i]['id_test_code'] = $this->input->post('txtDIdTestCode_'.$i);
			// 		$hasil = $this->input->post('txtDHasil_'.$i);
			// 		$dataDetail[$i]['hasil_test'] = str_replace('.',',',$hasil);
			// 	}
			// }

			// //delete yang lama jika ada 
			// $xyz = $this->M_test_qc->getIdByIdDetailTerima($data['id_detail_terima']);
			// if (!empty($xyz)) {
			// 	$id_test_qc = $xyz[0]->ID;
			// 	$this->M_test_qc->delete($data['id_detail_terima']);
			// 	$this->M_test_qc_detail->delete($id_test_qc);
			// }
	
			// //simpan test dan detail
			// $success = true;
			// $success = $this->M_test_qc->save($data);

			// if(!$success){
			// 	echo "error";
			// 	exit();
			// }else{
			// 	if ($status === "CLOSE") {
		 //  			//update nomet test qc
			//   		$this->M_nomer->updateNomerTestQc($nomerTestQc);
		 //  		}
			// }

			// foreach ($dataDetail as $key) {
			// 	$success = $this->M_test_qc_detail->save($key);
			// 	if (!$success) {
			// 		echo "error";
			// 		exit();
			// 	}
			// }

			// if ($status === "CLOSE" && $data['grade'] <= 2) { //Close Grade 1 & 2
			// 	//update status detail penerimaan jadi 'TEST' dan beri nomor label
			// 	$pqrs = $this->M_nomer->getNomerLabel();
			// 	$nomerLabel = $pqrs[0]->LABEL_QC;
			// 	$nomerLabel += 1;

			// 	$FnomerLabel = sprintf('%04d', $nomerLabel);
			// 	$Fgrade = sprintf('%02d', $data['grade']);
			// 	$dataUpdate['KODE_ROLL'] = $FnomerLabel."-".$Fgrade."-".$Tahun;
			// 	$dataUpdate['STATUS_QC'] = 'T_OK';
			// 	$dataUpdate['GRADE'] = $data['grade'];
			// 	$dataUpdate['ID_DETAIL_TERIMA'] = $this->input->POST('txtIdDetailTerima');
			// 	$success = $this->M_detail_penerimaan->UpdateStatusKodeRoll($dataUpdate);
			// 	if ($success) {
			// 		$success = $this->M_nomer->updateNomerLabel($nomerLabel);
			// 	}else{
			// 		echo "error";
			// 		exit();
			// 	}
			// }

			// if ($status === "CLOSE" && $data['grade'] == 3) { //Close grade 3
			// 	$dataUpdate['STATUS_QC'] = 'T_FAIL';
			// 	$dataUpdate['KODE_ROLL'] = '';
			// 	$dataUpdate['GRADE'] = $data['grade'];
			// 	$dataUpdate['ID_DETAIL_TERIMA'] = $this->input->POST('txtIdDetailTerima');
			// 	$success = $this->M_detail_penerimaan->UpdateStatusKodeRoll($dataUpdate);
			// }

			// // $this->index();
			// $_SESSION['pesan']='<font color="blue">Berhasil disimpan</font>';
			// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/laporan_qc'>");

	  // 	}	
}
?>