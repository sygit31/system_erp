<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_qc_gagal extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_detail_penerimaan');
		$this->load->model('sgt/M_reject');
		$this->load->model('sgt/M_reject_detail');
		$this->load->model('sgt/M_nomer');
		$this->load->model('sgt/M_master_barang');
		$this->load->model('sgt/M_qc_validasi');
		session_start();
	}
	
	function index(){
		$data['stok'] = $this->M_detail_penerimaan->getFailtest();
		
		$this->load->view('sgt/qc/v_cek_qc_gagal.php',$data);
	    	// print_r($data['stok']);
	}

	
	public function terima($id_detail_terima="",$catatan="",$status_qc="")
	{
		if (strpos($status_qc, '__') !== false) {
			    // dari produksi
			
				// ubah status dari T_FAIL(test fail) ke P(produksi)
			$status_qc_split = explode("__",$status_qc);
	  			$dataPD['STATUS_QC'] = "P__".$status_qc_split[1]; // P = produksi
	  			$dataPD['ID_DETAIL_TERIMA'] = $id_detail_terima;
	  			$success = $this->M_detail_penerimaan->UpdateStatus($dataPD);

	  			// simpan catatan penerimaan
	  			$dataX['ID_DETAIL_TERIMA'] = $id_detail_terima;
	  			$dataX['STATUS_QC'] = $status_qc."->".$dataPD['STATUS_QC'];
	  			$dataX['CATATAN'] = $catatan;
	  			$CRE = explode('|',$_SESSION['logERP']);
	  			$dataX['ID_INPUT'] = $CRE[0];
	  			$dataX['KATEGORI'] = "T";
	  			$dataX['MUTASI_ID_DETAIL_TERIMA'] = $id_detail_terima;

	  			$success = $this->M_qc_validasi->save($dataX);
	  			if ($success) {
	  				$_SESSION['pesan'].='<font color="blue"><b>Barang masih bagus, dan bisa di proses kembali.</b></font>';
	  				print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
	  			}else{
	  				$_SESSION['pesan'].='<font color="red">Error!!!</font>';
	  				print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
	  			}
	  			
	  		}else{
				// income


		  		// $id_detail_terima = $this->input->POST('cbCetak');
		  		// $catatan = $this->input->POST('txtNote');

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

		  		// simpan catatan penerimaan
		  		$dataX['ID_DETAIL_TERIMA'] = $id_detail_terima;
		  		$dataX['STATUS_QC'] = $status_qc."->".$data['STATUS_QC'];
		  		$dataX['CATATAN'] = $catatan;
		  		$CRE = explode('|',$_SESSION['logERP']);
		  		$dataX['ID_INPUT'] = $CRE[0];
		  		$dataX['KATEGORI'] = "T";
		  		$dataX['MUTASI_ID_DETAIL_TERIMA'] = $id_detail_terima;

		  		$success = $this->M_qc_validasi->save($dataX);
		  		if ($success) {
		  			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan di Stok <br/> Nomer Label : <b>'.$data['KODE_ROLL'].'</b></font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
		  		}else{
		  			$_SESSION['pesan'].='<font color="red">Gagal disimpan!!!</font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
		  		}
		  	}




		  }







		  public function tolak($id_detail_terima="",$catatan="",$status_qc="",$jml="")
		  {
		  	if (strpos($status_qc, '__') !== false) {
				//dari produksi

				//====> harus buat barang baru turunan di detail penerimaan karena ada opsi penggunaan barang beberapa
				//====> jadi gak bisa cuma dirubah status.
				//====> harus ada barang baru turunan, relasi dengan penerimana aslinya

				//binding data lama by id_detail_terima
		  		$dataZ = $this->M_detail_penerimaan->getDetailPenerimaanById($id_detail_terima);

				//buat barang baru di detail penerimaan dengan status "gagal tes produksi masuk gudang"
		  		$kode_roll_old = $dataZ[0]->KODE_ROLL;
		  		$kode_roll_old_split = explode("-",$kode_roll_old);

		  		$status_qc_split = explode("__",$status_qc);

		  		$kode_retour = '1'.$status_qc_split[1];

		  		$kode_roll_new = "";
		  		if (count($kode_roll_old_split) == 4) {
		  			$kode_roll_new = $kode_roll_old_split[0]."-".$kode_retour."-01-".$kode_roll_old_split[2]."-".$kode_roll_old_split[3];
		  		}else{
		  			$turunan = (int)$kode_roll_old_split[2];
		  			$turunan += 1;
		  			$turunan = sprintf('%02d',$turunan);

		  			$kode_roll_new = $kode_roll_old_split[0]."-".$kode_retour."-".$turunan."-".$kode_roll_old_split[2]."-".$kode_roll_old_split[3];
		  		}

		  		$dataY['QTY_TERIMA']=$jml;
		  		$dataY['ID_TERIMA']=$dataZ[0]->ID_TERIMA;
		  		$dataY['SATUAN']=$dataZ[0]->SATUAN;
		  		$dataY['BARCODE']=$dataZ[0]->BARCODE;
				$dataY['STATUS_QC']='QC_R__'.$status_qc_split[1]; // QC_R__ = QC REJECT
				$dataY['KODE_ROLL']=$kode_roll_new;
				$dataY['GRADE']=$dataZ[0]->GRADE;
				$success = $this->M_detail_penerimaan->saveSingle($dataY);


				//update jumlah,status di erp_penerimaan_detail (barang lama)
				$dataYY['ID_DETAIL_TERIMA'] = $id_detail_terima;
				$dataYY['STATUS_QC'] = "X__".$dataZ[0]->STATUS_QC;
	  			$dataYY['QTY_TERIMA'] = (int)$dataZ[0]->QTY_TERIMA - (int)$jml; //sisa = jml awal - jumlah retour
	  			$success = $this->M_detail_penerimaan->UpdateStatusDanJumlah($dataYY);
	  			
				//log barang masuk apakah perlu? {log sudah disimpan bersamaan insert di atas, jumlah lama juga ikut terupdate karena pencatatan link di "ID Detail Terima" nya}
	  			
	  			
				// simpan catatan penerimaan
	  			$dataX['ID_DETAIL_TERIMA'] = $id_detail_terima;
	  			$dataX['STATUS_QC'] = $status_qc."->".$dataY['STATUS_QC'];
	  			$dataX['CATATAN'] = $catatan;
	  			$CRE = explode('|',$_SESSION['logERP']);
	  			$dataX['ID_INPUT'] = $CRE[0];
	  			$dataX['KATEGORI'] = "F";
	  			$dataX['MUTASI_ID_DETAIL_TERIMA'] = "SEQ_DETAIL_PENERIMAAN.CURRVAL";


	  			$success = $this->M_qc_validasi->save($dataX);
	  			if ($success) {
	  				$_SESSION['pesan'].='<font color="blue">Berhasil disimpan <br />Kode Roll : <b>'.$dataY['KODE_ROLL'].'</b></font>';
	  				print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
	  			}else{
	  				$_SESSION['pesan'].='<font color="red">Error!!!</font>';
	  				print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
	  			}

				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				/////////////////////PERBEDAAN PERSEPSI VALIDASI LANGSUNG BAGUS///////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
	  			
				// // buat stok baru di detail terima dengan "id,kode_label,qty" baru
				// $dataZ = $this->M_detail_penerimaan->getDetailPenerimaanById($id_detail_terima);
	  			
				// $kode_roll_old = $dataZ[0]->KODE_ROLL;
				// $kode_roll_old_split = explode("-",$kode_roll_old);
				// $status_qc_split = explode("__",$status_qc);
				// $kode_retour = '0'.$status_qc_split[1];
				// $kode_roll_new = $kode_roll_old_split[0]."-".$kode_retour."-".$kode_roll_old_split[2]."-".$kode_roll_old_split[3];
	  			
				// $dataY['qty_terima']=$jml;
				// $dataY['satuan']=$dataZ[0]->SATUAN;
				// $dataY['barcode']=$dataZ[0]->BARCODE;
				// $dataY['status_qc']='RETOUR_OK_'.$status_qc_split[1];
				// $dataY['kode_roll']=$kode_roll_new;
				// $dataY['grade']=$dataZ[0]->GRADE;
	  			
				// // simpan log barang masuk gudang
	  			
	  			
	  	// 		// update jumlah,status di erp_penerimaan_detail
	  	// 		$dataYY['id_detail_terima'] = $id_detail_terima;
	  	// 		$dataYY['status'] = $dataZ[0]->STATUS_QC."_".$kode_roll_new;
	  	// 		$dataYY['jumlah'] = (int)$dataZ[0]->QTY_TERIMA - (int)$jml;

				// // simpan catatan penerimaan

	  			//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////
				//////////////////////////////////////////////////////////////////////////////////////


	  		}else{
				//dari income

				// $id_detail_terima = $this->input->POST('cbCetak');
		  		// $catatan = $this->input->POST('txtNote');

		  		// update status,kode_roll,grade di erp_penerimaan_detail
	  			$tmpTahun = $this->M_master_barang->getTahunByIdDetailTerima($id_detail_terima);
	  			$Tahun = $tmpTahun[0]->TAHUN;

	  			$pqrs = $this->M_nomer->getNomerQCrejectByTahun($Tahun);
	  			$nomerLabel = $pqrs[0]->LABEL_QC_REJECT;
	  			$nomerLabel += 1;
	  			$FnomerLabel = sprintf('%04d', $nomerLabel);

	  			$data['ID_DETAIL_TERIMA'] = $id_detail_terima;
		  		$data['STATUS_QC'] = "QC_R"; // QC_R__ = QC REJECT
		  		$data['GRADE'] = "3";
		  		$Fgrade = sprintf('%02d', $data['GRADE']);
		  		$data['KODE_ROLL'] = $FnomerLabel."-QC-R-".$Tahun;

		  		$success = $this->M_detail_penerimaan->UpdateStatusKodeRoll($data);
		  		if ($success) {
		  			$success = $this->M_nomer->updateNomerQCrejectByTahun($nomerLabel,$Tahun);
		  		}else{
		  			$_SESSION['pesan'].='<font color="red">Gagal disimpan!!!</font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
		  		}


				// simpan catatan penerimaan
		  		$dataX['ID_DETAIL_TERIMA'] = $id_detail_terima;
		  		$dataX['STATUS_QC'] = $status_qc."->".$data['STATUS_QC'];
		  		$dataX['CATATAN'] = $catatan;
		  		$CRE = explode('|',$_SESSION['logERP']);
		  		$dataX['ID_INPUT'] = $CRE[0];
		  		$dataX['KATEGORI'] = "F";
		  		$dataX['MUTASI_ID_DETAIL_TERIMA'] = $id_detail_terima;


		  		$success = $this->M_qc_validasi->save($dataX);
		  		if ($success) {
		  			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan <br />Kode : <b>'.$data['KODE_ROLL'].'</b></font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
		  		}else{
		  			$_SESSION['pesan'].='<font color="red">Gagal disimpan!!!</font>';
		  			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/qc/cek_qc_gagal'>");
		  		}

		  	}
		  	
		  }




		  public function validasi()
		  {
	  		// print_r($_POST);
		  	$id_detail_terima = $this->input->POST('txtIdD');
		  	$catatan = $this->input->POST('txtNote');
		  	$status_qc = $this->input->POST('txtStatusQc');
	  		$jml = $this->input->POST('txtJml'); // jumlah adalah jumlah yang dikembalikan

	  		$tangkap = $this->input->POST('txtAksi');
	  		if ($tangkap == 'terima') {
	  			$this->terima($id_detail_terima,$catatan,$status_qc);
	  		}else{
	  			$this->tolak($id_detail_terima,$catatan,$status_qc,$jml);
	  		}
	  	}


	  }
	  ?>