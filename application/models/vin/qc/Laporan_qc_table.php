<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_qc_table extends CI_Controller{
	
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
		$dataX = $this->M_detail_penerimaan->getAllTest();

	    	// $this->load->view('sgt/qc/v_laporan_qc_table.php',$data);
	    	// print_r($dataX);
		$dataCollect['laporan'] = array();
		foreach ($dataX as $key => $value) {
			$data = array();
			$data['nomer'] = $value->NOMER_TEST_QC;
			$data['tgl_terima'] = $value->TGL_TERIMA;
			$data['tgl_test'] = $value->TANGGAL_QC;
			$data['panjang'] = $value->QTY_TERIMA;
			$data['barcode'] = $value->BARCODE;
			$data['kode_roll'] = $value->KODE_ROLL;
			$data['grade'] = $value->GRADE;

			$DetailTest = $this->M_test_qc->getHasiltestByIdDetailTerima($value->ID_DETAIL_TERIMA);
			foreach ($DetailTest as $Xkey => $Xvalue) {
	    			// print_r($Xvalue->TEST_DESCRIPTION . "<br />");
				if ($Xvalue->ID_TEST_CODE == '87') {$data['warna'] = $Xvalue->HASIL;}
				if ($Xvalue->ID_TEST_CODE == '88') {$data['invisible'] = $Xvalue->HASIL;}
				if ($Xvalue->ID_TEST_CODE == '89') {$data['gsm'] = $Xvalue->HASIL_TEST;}
				if ($Xvalue->ID_TEST_CODE == '90') {$data['ketebalan'] = $Xvalue->HASIL_TEST;}
				if ($Xvalue->ID_TEST_CODE == '91') {$data['tape'] = $Xvalue->HASIL;}
				if ($Xvalue->ID_TEST_CODE == '92') {$data['gulungan'] = $Xvalue->HASIL;}
			}

			array_push($dataCollect['laporan'],$data);
		}

	    	// print_r($dataCollect['laporan']);
		$this->load->view('sgt/qc/v_laporan_qc_table.php',$dataCollect);

	}


	public function filter()
	{
	  		// print_r($_POST);
		$dataY['tanggalAwal'] = $this->input->POST('tanggalAwal');
		$dataY['tanggalAkhir'] = $this->input->POST('tanggalAkhir');

		$dataX = $this->M_detail_penerimaan->getAllTest($dataY,true);

		$dataCollect['laporan'] = array();
		foreach ($dataX as $key => $value) {
			$data = array();
			$data['nomer'] = $value->NOMER_TEST_QC;
			$data['tgl_terima'] = $value->TGL_TERIMA;
			$data['tgl_test'] = $value->TANGGAL_QC;
			$data['panjang'] = $value->QTY_TERIMA;
			$data['barcode'] = $value->BARCODE;
			$data['kode_roll'] = $value->KODE_ROLL;
			$data['grade'] = $value->GRADE;

			$DetailTest = $this->M_test_qc->getHasiltestByIdDetailTerima($value->ID_DETAIL_TERIMA);
			foreach ($DetailTest as $Xkey => $Xvalue) {
				if ($Xvalue->ID_TEST_CODE == '87') {$data['warna'] = $Xvalue->HASIL;}
				if ($Xvalue->ID_TEST_CODE == '88') {$data['invisible'] = $Xvalue->HASIL;}
				if ($Xvalue->ID_TEST_CODE == '89') {$data['gsm'] = $Xvalue->HASIL_TEST;}
				if ($Xvalue->ID_TEST_CODE == '90') {$data['ketebalan'] = $Xvalue->HASIL_TEST;}
				if ($Xvalue->ID_TEST_CODE == '91') {$data['tape'] = $Xvalue->HASIL;}
				if ($Xvalue->ID_TEST_CODE == '92') {$data['gulungan'] = $Xvalue->HASIL;}
			}

			array_push($dataCollect['laporan'],$data);
		}

		$this->load->view('sgt/qc/v_laporan_qc_table.php',$dataCollect);
	}
}
?>