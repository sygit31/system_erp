<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_bayangan extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('sgt/M_detail_penerimaan');
		$this->load->model('sgt/M_test_qc');
		$this->load->model('sgt/M_detail_test_code');
		$this->load->model('sgt/M_nomer');
		$this->load->model('sgt/M_po');
		$this->load->model('sgt/M_po_detail');
		$this->load->model('sgt/M_reject');
		$this->load->model('sgt/M_reject_detail');
		$this->load->model('sgt/M_test_group');
		$this->load->model('sgt/M_log_mutasi_pet_stok');
		$this->load->model('sgt/M_master_barang');
		$this->load->model('sgt/M_qc_validasi');
		session_start();
	}
	
	function index(){
		$data['stok'] = $this->M_detail_penerimaan->getStokBayangan();
		$data['reject'] = $this->M_reject->getReject();
		$data['reject_detail'] = $this->M_reject_detail->getRejectDetail();
		
		$this->load->view('sgt/gudang/v_stok_bayangan.php',$data);
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
			$tmpTahun = $this->M_master_barang->getTahunByIdDetailTerima($ArrIdDetailTerima[0]);
			$Tahun = $tmpTahun[0]->TAHUN;
				// $nReject = $this->M_nomer->getNomerReject();
			$nReject = $this->M_nomer->getNomerRejectByTahun($Tahun);

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
				$this->M_nomer->updateNomerRejectByTahun($nomer + 1,$Tahun);
				
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
					$dataX["ID_DETAIL_TERIMA"] = $row;

					$this->M_detail_penerimaan->UpdateStatus($dataX);
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
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/stok_bayangan'>");

		}else{
				// $this->index();
			$_SESSION['pesan'].='<font color="red">Tidak ada barang yang dipilih</font>';
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/stok_bayangan'>");
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

		$this->load->view('sgt/gudang/stok_bayangan/cetak_reject.php',$data);
	}


	public function recode()
	{
	  		// print_r($_POST);
	  		// Array ( [txtIdD] => 734 [txtStatusQc] => QC_R__1 [txtKode] => 0614-11-01-02-2019 [txtNote] => coba )

		$status_qc = $this->input->POST('txtStatusQc');

		if ($status_qc == 'QC_R') {
	  			//reject income

	  			//rubah kode ke kode baru income dan status_qc supaya masuk stok
			$id_detail_terima = $this->input->POST('txtIdD');

	  			// update status,kode_roll,grade di erp_penerimaan_detail
			$tmpTahun = $this->M_master_barang->getTahunByIdDetailTerima($id_detail_terima);
			$Tahun = $tmpTahun[0]->TAHUN;

			$pqrs = $this->M_nomer->getNomerLabelByTahun($Tahun);
			$nomerLabel = $pqrs[0]->LABEL_QC;
			$nomerLabel += 1;
			$FnomerLabel = sprintf('%04d', $nomerLabel);

			$data['ID_DETAIL_TERIMA'] = $id_detail_terima;
		  		$data['STATUS_QC'] = "T_OK"; // T_OK = Test Ok
		  		$data['GRADE'] = "2";
		  		$Fgrade = sprintf('%02d', $data['GRADE']);
		  		$data['KODE_ROLL'] = $FnomerLabel."-00-00-".$Fgrade."-".$Tahun;

		  		$success = $this->M_detail_penerimaan->UpdateStatusKodeRoll($data);
		  		if ($success) {
		  			$success = $this->M_nomer->updateNomerLabelByTahun($nomerLabel,$Tahun);
		  		}else{
		  			$_SESSION['pesan'].='<font color="red">Gagal disimpan</font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
		  		}


	  			//simpan catatan penerimaan
		  		$dataX['ID_DETAIL_TERIMA'] = $id_detail_terima;
		  		$dataX['STATUS_QC'] = $status_qc."->".$data['STATUS_QC'];
		  		$dataX['CATATAN'] = $this->input->POST('txtNote');
		  		$CRE = explode('|',$_SESSION['logERP']);
		  		$dataX['ID_INPUT'] = $CRE[0];
		  		$dataX['KATEGORI'] = "T";
		  		$dataX['MUTASI_ID_DETAIL_TERIMA'] = $id_detail_terima;

		  		$success = $this->M_qc_validasi->save($dataX);
		  		if ($success) {
		  			$_SESSION['pesan'].='<font color="blue"><b>Barang berhasil di recode. <br /> Kode : '.$data['KODE_ROLL'].'</b></font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/stok_bayangan'>");
		  		}else{
		  			$_SESSION['pesan'].='<font color="red">Error!!!</font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/stok_bayangan'>");
		  		}


		  	}else{
	  			//reject produksi

	  			// update kode, dan status_qc supaya masuk stok lagi
		  		$id_detail_terima = $this->input->POST('txtIdD');

		  		$kodeOld = $this->input->POST('txtKode');
		  		$kodeOld_split = explode("-",$kodeOld);

		  		$status_qc_split = explode("__",$status_qc);

		  		$kodebaik = '0'.$status_qc_split[1];
		  		$dataPD['KODE_ROLL'] = $kodeOld_split[0]."-".$kodebaik."-".$kodeOld_split[2]."-".$kodeOld_split[3]."-".$kodeOld_split[4];

	  			$dataPD['STATUS_QC'] = "RM__".$status_qc_split[1]; //RM = retour mutasi
	  			$dataPD['GRADE'] = (int)$kodeOld_split[3];
	  			$dataPD['ID_DETAIL_TERIMA'] = $id_detail_terima;

	  			$success = $this->M_detail_penerimaan->UpdateStatusKodeRoll($dataPD);


		  		// simpan catatan penerimaan
	  			$dataX['ID_DETAIL_TERIMA'] = $id_detail_terima;
	  			$dataX['STATUS_QC'] = $status_qc."->".$dataPD['STATUS_QC'];
	  			$dataX['CATATAN'] = $this->input->POST('txtNote');
	  			$CRE = explode('|',$_SESSION['logERP']);
	  			$dataX['ID_INPUT'] = $CRE[0];
	  			$dataX['KATEGORI'] = "T";
	  			$dataX['MUTASI_ID_DETAIL_TERIMA'] = $id_detail_terima;

	  			$success = $this->M_qc_validasi->save($dataX);
	  			if ($success) {
	  				$_SESSION['pesan'].='<font color="blue"><b>Barang berhasil di recode. <br /> Kode : '.$dataPD['KODE_ROLL'].'</b></font>';
	  				print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/stok_bayangan'>");
	  			}else{
	  				$_SESSION['pesan'].='<font color="red">Error!!!</font>';
	  				print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/stok_bayangan'>");
	  			}

	  		}
	  		

	  	}

	  }
	  ?>