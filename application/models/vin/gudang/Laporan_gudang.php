<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_gudang extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_log_mutasi_pet');
		$this->load->model('sgt/M_log_mutasi_pet_stok');
		session_start();
	}
	
	function indexCoba()
	{
	  		// ini di log perubahan nantinya
		$this->M_log_mutasi_pet_stok->UpdateStok('+','5','32100');
	}

	function index()
	{
		$data = array();
		
		for ($i=30; $i >= 0; $i--) { 
			$currentDateTime = date("d-m-Y", strtotime("-".$i." day"));
	  			// print_r($currentDateTime ."<br />");

	  			//get In LPB
			$dataInLPB = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'IN','LPB');
			$jmlInLPB = 0;
			$panjangInLpb = 0;
			if (count($dataInLPB) !== 0) {
				foreach ($dataInLPB as $value) {
					$jmlInLPB += 1;
	  					// print_r($value->QTY_TERIMA ."<br />");

					$panjang = $value->QTY_TERIMA;
					$panjangInLpb += $panjang;
				}
			}

	  			//get In Retour
			$jmlInRetour = 0;
			$panjangInRetour = 0;

	  			//get Out Seri I
			$dataOutSeri1 = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Seri I');
			$jmlOutSeri1 = 0;
			$panjangOutSeri1 = 0;
			if (count($dataOutSeri1) !== 0) {
				foreach ($dataOutSeri1 as $value) {
					$jmlOutSeri1 += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutSeri1 += $panjang;
				}
			}

	  			//get Out Seri II
			$dataOutSeri2 = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Seri II');
			$jmlOutSeri2 = 0;
			$panjangOutSeri2 = 0;
			if (count($dataOutSeri2) !== 0) {
				foreach ($dataOutSeri2 as $value) {
					$jmlOutSeri2 += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutSer2 += $panjang;
				}
			}

	  			//get Out Seri III
			$dataOutSeri3 = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Seri III');
			$jmlOutSeri3 = 0;
			$panjangOutSeri3 = 0;
			if (count($dataOutSeri3) !== 0) {
				foreach ($dataOutSeri3 as $value) {
					$jmlOutSeri3 += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutSeri3 += $panjang;
				}
			}

	  			//get Out MMEA
			$dataOutMMEA = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','MMEA');
			$jmlOutMMEA = 0;
			$panjangOutMMEA = 0;
			if (count($dataOutMMEA) !== 0) {
				foreach ($dataOutMMEA as $value) {
					$jmlOutMMEA += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutMMEA += $panjang;
				}
			}

	  			//get Out Reject
			$dataOutReject = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Reject');
			$jmlOutReject = 0;
			$panjangOutReject = 0;
			if (count($dataOutReject) !== 0) {
				foreach ($dataOutReject as $value) {
					$jmlOutReject += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutReject += $panjang;
				}
			}

	  			//get Saldo
			$dataSaldo = $this->M_log_mutasi_pet_stok->getLogByDate($currentDateTime);
			if (empty($dataSaldo)) {
				$dataSaldo = $this->M_log_mutasi_pet_stok->getLogMaxDateBefore($currentDateTime);
			}

			$SRoll = 0;
			$SPanjang = 0;
			if (!empty($dataSaldo)) {
				$SRoll = $dataSaldo[0]->STOK_ROLL;
				$SPanjang = $dataSaldo[0]->STOK_METER;
			}

	  			//===============================================================
			$data[$i]['tanggal'] = $currentDateTime;
			$data[$i]['InLpbRoll'] = $jmlInLPB;
			$data[$i]['InLpbPanjang'] = $panjangInLpb;
			$data[$i]['InProdRoll'] = $jmlInRetour;
			$data[$i]['InProdPanjang'] = $panjangInRetour;
			$data[$i]['OutSeriIRoll'] = $jmlOutSeri1;
			$data[$i]['OutSeriIPanjang'] = $panjangOutSeri1;
			$data[$i]['OutSeriIIRoll'] = $jmlOutSeri2;
			$data[$i]['OutSeriIIPanjang'] = $panjangOutSeri2;
			$data[$i]['OutSeriIIIRoll'] = $jmlOutSeri3;
			$data[$i]['OutSeriIIIPanjang'] = $panjangOutSeri3;
			$data[$i]['OutMMEARoll'] = $jmlOutMMEA;
			$data[$i]['OutMMEAPanjang'] = $panjangOutMMEA;
			$data[$i]['OutRejectRoll'] = $jmlOutReject;
			$data[$i]['OutRejectPanjang'] = $panjangOutReject;
			$data[$i]['SaldoRoll'] = $SRoll;
			$data[$i]['SaldoPanjang'] = $SPanjang;
		}

	  		// print_r($data);
		$dataX['data'] = $data;
		$this->load->view('sgt/gudang/v_laporan_gudang.php',$dataX);
	}

	public function filter()
	{
	  		// print_r($_POST);
		$startTime = $this->input->post("tanggalAwal"); 
		$endTime = $this->input->post("tanggalAkhir"); 

			// Loop between timestamps, 1 day at a time 
		$data = array();

		$i = 0;
		do {
			$currentDateTime = date("d-m-Y", strtotime("+".$i++." days", strtotime($startTime)));

	  			//get In LPB
			$dataInLPB = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'IN','LPB');
			$jmlInLPB = 0;
			$panjangInLpb = 0;
			if (count($dataInLPB) !== 0) {
				foreach ($dataInLPB as $value) {
					$jmlInLPB += 1;
	  					// print_r($value->QTY_TERIMA ."<br />");

					$panjang = $value->QTY_TERIMA;
					$panjangInLpb += $panjang;
				}
			}

	  			//get In Retour
			$jmlInRetour = 0;
			$panjangInRetour = 0;

	  			//get Out Seri I
			$dataOutSeri1 = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Seri I');
			$jmlOutSeri1 = 0;
			$panjangOutSeri1 = 0;
			if (count($dataOutSeri1) !== 0) {
				foreach ($dataOutSeri1 as $value) {
					$jmlOutSeri1 += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutSeri1 += $panjang;
				}
			}

	  			//get Out Seri II
			$dataOutSeri2 = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Seri II');
			$jmlOutSeri2 = 0;
			$panjangOutSeri2 = 0;
			if (count($dataOutSeri2) !== 0) {
				foreach ($dataOutSeri2 as $value) {
					$jmlOutSeri2 += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutSer2 += $panjang;
				}
			}

	  			//get Out Seri III
			$dataOutSeri3 = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Seri III');
			$jmlOutSeri3 = 0;
			$panjangOutSeri3 = 0;
			if (count($dataOutSeri3) !== 0) {
				foreach ($dataOutSeri3 as $value) {
					$jmlOutSeri3 += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutSeri3 += $panjang;
				}
			}

	  			//get Out MMEA
			$dataOutMMEA = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','MMEA');
			$jmlOutMMEA = 0;
			$panjangOutMMEA = 0;
			if (count($dataOutMMEA) !== 0) {
				foreach ($dataOutMMEA as $value) {
					$jmlOutMMEA += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutMMEA += $panjang;
				}
			}

	  			//get Out Reject
			$dataOutReject = $this->M_log_mutasi_pet->getLogByDate($currentDateTime,'OUT','Reject');
			$jmlOutReject = 0;
			$panjangOutReject = 0;
			if (count($dataOutReject) !== 0) {
				foreach ($dataOutReject as $value) {
					$jmlOutReject += 1;

					$panjang = $value->QTY_TERIMA;
					$panjangOutReject += $panjang;
				}
			}

	  			//get Saldo
			$dataSaldo = $this->M_log_mutasi_pet_stok->getLogByDate($currentDateTime);
			if (empty($dataSaldo)) {
				$dataSaldo = $this->M_log_mutasi_pet_stok->getLogMaxDateBefore($currentDateTime);
			}

			$SRoll = 0;
			$SPanjang = 0;
			if (!empty($dataSaldo)) {
				$SRoll = $dataSaldo[0]->STOK_ROLL;
				$SPanjang = $dataSaldo[0]->STOK_METER;
			}

	  			//===============================================================
			$data[$i]['tanggal'] = $currentDateTime;
			$data[$i]['InLpbRoll'] = $jmlInLPB;
			$data[$i]['InLpbPanjang'] = $panjangInLpb;
			$data[$i]['InProdRoll'] = $jmlInRetour;
			$data[$i]['InProdPanjang'] = $panjangInRetour;
			$data[$i]['OutSeriIRoll'] = $jmlOutSeri1;
			$data[$i]['OutSeriIPanjang'] = $panjangOutSeri1;
			$data[$i]['OutSeriIIRoll'] = $jmlOutSeri2;
			$data[$i]['OutSeriIIPanjang'] = $panjangOutSeri2;
			$data[$i]['OutSeriIIIRoll'] = $jmlOutSeri3;
			$data[$i]['OutSeriIIIPanjang'] = $panjangOutSeri3;
			$data[$i]['OutMMEARoll'] = $jmlOutMMEA;
			$data[$i]['OutMMEAPanjang'] = $panjangOutMMEA;
			$data[$i]['OutRejectRoll'] = $jmlOutReject;
			$data[$i]['OutRejectPanjang'] = $panjangOutReject;
			$data[$i]['SaldoRoll'] = $SRoll;
			$data[$i]['SaldoPanjang'] = $SPanjang;

		} while ($currentDateTime < $endTime);

			// print_r($data);
		$dataX['data'] = $data;
		$this->load->view('sgt/gudang/v_laporan_gudang.php',$dataX);
	}

}
?>