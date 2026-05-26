<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_bayangan extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('M_detail_penerimaan');
		$this->load->model('M_test_qc');
		$this->load->model('M_detail_test_code');
		$this->load->model('M_nomer');
		$this->load->model('M_po');
		$this->load->model('M_po_detail');
		$this->load->model('M_reject');
		$this->load->model('M_reject_detail');
		$this->load->model('M_test_group');
		$this->load->model('M_log_mutasi_pet_stok');
		session_start();
	}
	
	function index(){
		$data['stok'] = $this->M_detail_penerimaan->getStokBayangan();
		$data['reject'] = $this->M_reject->getReject();
		$data['reject_detail'] = $this->M_reject_detail->getRejectDetail();
		
		$this->load->view('gudang/v_stok_bayangan.php',$data);
	}

	public function getSyarat(){
		$id_barang = $this->input->POST('id_barang');
		$markup = "<div style='width:465px; height:5px; background-color:black;' />";
		$markup .= "<b>Standar Pengecekan QC Incoming</b><br />";
		$markup .= "<div style='width:465px; height:5px; background-color:black;' /><br />";

		$ArrTestCode = $this->M_test_group->getTestCodeByIdBarang($id_barang);
		foreach($ArrTestCode as $row) {
			$markup .= "<font size=3><b>Test = ". $row->TEST_DESCRIPTION ."</b></font><br />";

			if ($row->JENIS === 'measure') {
				$markup .= "<table border='1' style='border:1px solid black;margin-left:auto;margin-right:auto;'><tr><th>Hasil</th><th>Max</th><th>Min</th><th>Range</th></tr>";
				$ArrDetailTest = $this->M_detail_test_code->getByIdTestCode($row->ID_TEST_CODE);
				foreach ($ArrDetailTest as $xxx) {
					$markup .= "<tr><td>".$xxx->HASIL."</td><td>".$xxx->MAX."</td><td>".$xxx->MIN."</td><td>".$xxx->RANGE."</td></tr>";
				}
				$markup .= "</table><br />";
			}else{
				$markup .= "<table border='1' style='border:1px solid black;margin-left:auto;margin-right:auto;'><tr><th>Hasil</th><th>Range</th></tr>";
				$ArrDetailTest = $this->M_detail_test_code->getByIdTestCode($row->ID_TEST_CODE);
				foreach ($ArrDetailTest as $xxx) {
					$markup .= "<tr><td>".$xxx->HASIL."</td><td>".$xxx->RANGE."</td></tr>";
				}
				$markup .= "</table><br />";
			}
		}
		print_r($markup);
	}

	public function getTest(){
		$id_detail_terima = $this->input->POST('id_detail_terima');
		$DetailTest = array();
		$DetailTest = $this->M_test_qc->getTestByIdDetailTerima($id_detail_terima);
		print_r(json_encode($DetailTest));
	}

	public function getHasilMeasure(){
		$hasil_test = $this->input->POST('hasil_test');
		$id_test_code = $this->input->POST('id_test_code');
		$DataTest = array();
		$DataTest = $this->M_detail_test_code->getByIdTestCode($id_test_code);

	  		// $hasil = "<font color=red>Tidak ditemukan</font>";
		$hasil = "Tidak ditemukan";
		$range = '0';
		for ($i=0; $i < count($DataTest) ; $i++) { 
			$hasil_test = str_replace(",", ".", $hasil_test);
			$max = str_replace(",", ".", $DataTest[$i]->MAX);
			$min = str_replace(",", ".", $DataTest[$i]->MIN);

	  			// $hasil_test = $hasil_test;
	  			// $max = $DataTest[$i]->MAX;
	  			// $min = $DataTest[$i]->MIN;

	  			//PHP . dan , BISA SEMUA
			if ($hasil_test >= $min && $hasil_test <= $max){
				$hasil = $DataTest[$i]->HASIL;
				$range = $DataTest[$i]->RANGE;
			}
		}

		if ($range === '0') {print_r("<font color=red>" . $hasil_test . " (" . $hasil . ")" . "</font>");}
	  		// if ($range === '1') {print_r("<font color=orange>" . $hasil_test . " (" . $hasil . ")" . "</font>");}
	  		// if ($range === '2') {print_r("<font color=green>" . $hasil_test . " (" . $hasil . ")" . "</font>");}
	  		// if ($range === '3') {print_r("<font color=blue>" . $hasil_test . " (" . $hasil . ")" . "</font>");}

		if ($range === '1') {print_r( $hasil_test . " (" . $hasil . ")" );}
		if ($range === '2') {print_r( $hasil_test . " (" . $hasil . ")" );}
		if ($range === '3') {print_r( $hasil_test . " (" . $hasil . ")" );}
	}


	public function reject(){
	  		// print_r($_POST);
		if(isset($_POST["cbReject"]))
		{
			$CRE = explode('|',$_SESSION['logERP']);
			$ArrIdDetailTerima = $this->input->POST('cbReject');
			$nReject = $this->M_nomer->getNomerReject();

			$nomer = $nReject[0]->REJECT;

			$data['nomer'] = $nomer + 1;
			$getNomerPO = $this->M_po->getNomerPOByIdDetailTerima($ArrIdDetailTerima[0]);
			$data['nomer_po'] = $getNomerPO[0]->NOMER;
			$data['id_input'] = $CRE[0];

				//Save Reject
			$success = true;
			$success = $this->M_reject->save($data);

			if ($success) {
		  			//Update Nomer Reject
				$this->M_nomer->updateNomerReject($nomer + 1);
				
				foreach($ArrIdDetailTerima as $row){
						//Save Detail Reject
					$this->M_reject_detail->save($row);

						//log stok
					try {
						$ArrDetailPenerimaan = $this->M_detail_penerimaan->getById($row);
						$this->M_log_mutasi_pet_stok->UpdateStok('-',$ArrDetailPenerimaan[0]->QTY_TERIMA,'1');
					} catch (Exception $e) {
						$_SESSION['pesan'].='<font color="red">Log Stok Harian gagal disimpan!!!! <br /> Hubungi Programmer Segera</font> <br />';
					}

						// Update Status di tabel Detail Penerimaan
					$dataX["STATUS_QC"] = "REJECT";
					$dataX["KODE_ROLL"] = "";
					$dataX["ID_DETAIL_TERIMA"] = $row;

					$this->M_detail_penerimaan->UpdateStatusKodeRoll($dataX);
				}
			}

		  		//Cek jika jumlah barang yang diterima (tanpa yang reject) lebih kecil dari order PO maka PO akan Open lagi dengan status 'OTW'
			$ArrPoDetail = $this->M_po_detail->getPoDetailByIdDetailTerima($ArrIdDetailTerima[0]);
			$QTY_order = $ArrPoDetail[0]->QTY;
			$ArrQTY_terima = $this->M_detail_penerimaan->getQTYbyDetailPO($ArrPoDetail[0]->ID);
			$QTY_terima = $ArrQTY_terima[0]->QTY;

			if ($QTY_terima < $QTY_order) {
		  			//update status po detail jadi 'OTW'
				$dataY['id'] = $ArrPoDetail[0]->ID;
				$dataY['status'] = "OTW";
				$this->M_po_detail->updateStatus($dataY);
			}

		  		// $this->index();
			$_SESSION['pesan'].='<font color="blue">Berhasil direject</font>';
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/gudang/stok_bayangan'>");

		}else{
				// $this->index();
			$_SESSION['pesan'].='<font color="red">Tidak ada barang yang dipilih</font>';
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/gudang/stok_bayangan'>");
		}
	}


	public function print_reject(){
		$id = $this->input->GET('id');
		$data['reject'] = $this->M_reject->getRejectById($id);
		$data['hasil_test'] = array();

		foreach ($data['reject'] as $row) {
			$hasil_test = $this->M_test_qc->getTestByIdDetailTerima($row->ID_DETAIL_TERIMA);

			foreach ($hasil_test as $key) {
				if ($key->JENIS === "measure") {
					$data_detail_test_code = $this->M_detail_test_code->getByIdTestCode($key->ID_TEST_CODE);

					$getHasil = $key->HASIL_TEST." (Tidak Sesuai)";
					foreach ($data_detail_test_code as $xxx) {
						if ($key->HASIL_TEST <= $xxx->MAX && $key->HASIL_TEST >= $xxx->MIN) {
							$getHasil = $key->HASIL_TEST." (" .$xxx->HASIL. ")";
						}
					}
					$key->HASIL = $getHasil;
				}
			}

			array_push($data['hasil_test'],$hasil_test);
		}

		$this->load->view('gudang/stok_bayangan/cetak_reject.php',$data);
	}

}
?>