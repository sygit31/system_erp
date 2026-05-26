<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('M_po_detail');
		$this->load->model('M_penerimaan');
		$this->load->model('M_detail_penerimaan');
		$this->load->model('M_log_mutasi_pet_stok');
		session_start();
	}
	
	function index()
	{
		$dataX['dOutstanding'] = $this->getDataIndex();
		$dataX['penerimaan_barang'] = $this->getDatalaporan();

			// print_r($dataX);
		$this->load->view('gudang/v_penerimaan_barang.php',$dataX);
	}


	function getDataIndex()
	{
		$po_otw = $this->M_po_detail->getPOoutstanding();

		$data = array();
		for($i=0;$i<count($po_otw);$i++){
				//AMBIL TOTAL (SUM) PENERIMAAN DARI TABEL DETAIL PENERIMAAN SESUAI ID_DETAIL_PO
			$QTYx = $this->M_detail_penerimaan->getQTYbyDetailPO($po_otw[$i]->ID);
		  		// print_r($QTYx);
			$QTYz = $QTYx[0]->QTY;
			if ($QTYz == "") {
				$QTYz = 0;
			}
			$outstanding = $po_otw[$i]->QTY - $QTYz;
			$outstandingToleransiBawah = ($po_otw[$i]->QTY - ($po_otw[$i]->QTY * 10 / 100)) - $QTYz;
			$outstandingToleransiAtas = ($po_otw[$i]->QTY + ($po_otw[$i]->QTY * 10 / 100)) - $QTYz;
				// print_r($po_otw[$i]->QTY ." ". $QTYz. " = " .$outstanding . " <br>");

			$data[$i]['ID'] = $po_otw[$i]->ID;
			$data[$i]['NOMER'] = $po_otw[$i]->NOMER;
			$data[$i]['NAMA_SUPPLIER'] = $po_otw[$i]->NAMA_SUPPLIER;
			$data[$i]['NAMA_BARANG'] = $po_otw[$i]->NAMA_BARANG;
			$data[$i]['QTY'] = $po_otw[$i]->QTY;
			$data[$i]['OUTSTANDING'] = $outstanding;
			$data[$i]['OUTSTANDING_TOLERANSI_BAWAH'] = $outstandingToleransiBawah;
			$data[$i]['OUTSTANDING_TOLERANSI_ATAS'] = $outstandingToleransiAtas;
			$data[$i]['SATUAN'] = $po_otw[$i]->SATUAN;
			$data[$i]['TGL'] = $po_otw[$i]->TGL;
		}

		return $data;
	}

	function getDatalaporan()
	{
		$data = $this->M_detail_penerimaan->getPenerimaanBarang();

		return $data;
	}

	
	public function terima()
	{
	  		// print_r($_POST);
		$CRE = explode('|',$_SESSION['logERP']);
		$data['IdLogin'] = $CRE[0];
		$data['IdPoDetail'] = $this->input->post('txtIdPoDetail');
		$data['Tanggal'] = $this->input->post('dmTanggal');
		$data['NomerSP'] = $this->input->post('txtNomerSP');
		 	// print_r($data);

		$jmlRoll = 0;
		$jmlMeter = 0;
		$dataDetail = array();
		$totalBarang = $this->input->post('txtJumlahDetail');
		if($totalBarang > 0 || $totalBarang != ""){
			for($i=1;$i<=$totalBarang;$i++){
				$dataDetail[$i]['QTY_TERIMA'] = $this->input->post('txtJumlahBarang'.$i);
				$dataDetail[$i]['SATUAN'] = $this->input->post('txtSatuanBarang'.$i);
				$dataDetail[$i]['BARCODE'] = $this->input->post('txtKodeBarcode'.$i);

					//untuk log stok harian
				$jmlRoll += 1;
				$jmlMeter += $dataDetail[$i]['QTY_TERIMA'];
			}
		}

		$success = true;
			// print_r($dataDetail);
		$success = $this->M_penerimaan->save($data);
		
		if($success){
			$success = $this->M_detail_penerimaan->save($dataDetail);

				//log stok
			try {
				$this->M_log_mutasi_pet_stok->UpdateStok('+',$jmlRoll,$jmlMeter);
			} catch (Exception $e) {
				$_SESSION['pesan'].='<font color="red">Log Stok Harian gagal disimpan!!!! <br /> Hubungi Programmer Segera</font><br />';
			}
		}else{
			echo "error";
			exit();
		}

		if($success){
		 		// $status = $this->input->post('txtStatusPoDetail');
			$status = $this->input->post('cmbStatusPoDetail');
		 		// print_r($status);
			if ($status == "FINISH"){
				$datax['status'] = $status;
				$datax['id'] = $data['IdPoDetail'];
				$success = $this->M_po_detail->updateStatus($datax);
					// print_r($status);
			}
		}else{
			echo "error";
			exit();
		}

		if($success){
				// $this->index();
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/gudang/penerimaan_barang'>");

		}else{
			echo "error";
			exit();
		}
	}


	public function tampil(){
		$data = array();
		$data['tanggalAwal'] = "";
		$data['tanggalAkhir'] = "";
		$tanggalAwal = $this->input->post("tanggalAwal");
		$tanggalAkhir = $this->input->post("tanggalAkhir");
			// print_r($data);
		$Xtanggal = explode(' ',$tanggalAwal); 
		$Bulan = $Xtanggal[1];
		if ($Bulan == 'Januari'){$data['tanggalAwal'] = $Xtanggal[0] . "/01/" . $Xtanggal[2];}
		if ($Bulan == 'Februari'){$data['tanggalAwal'] = $Xtanggal[0] . "/02/" . $Xtanggal[2];}
		if ($Bulan == 'Maret'){$data['tanggalAwal'] = $Xtanggal[0] . "/03/" . $Xtanggal[2];}
		if ($Bulan == 'April'){$data['tanggalAwal'] = $Xtanggal[0] . "/04/" . $Xtanggal[2];}
		if ($Bulan == 'Mei'){$data['tanggalAwal'] = $Xtanggal[0] . "/05/" . $Xtanggal[2];}
		if ($Bulan == 'Juni'){$data['tanggalAwal'] = $Xtanggal[0] . "/06/" . $Xtanggal[2];}
		if ($Bulan == 'Juli'){$data['tanggalAwal'] = $Xtanggal[0] . "/07/" . $Xtanggal[2];}
		if ($Bulan == 'Agustus'){$data['tanggalAwal'] = $Xtanggal[0] . "/08/" . $Xtanggal[2];}
		if ($Bulan == 'September'){$data['tanggalAwal'] = $Xtanggal[0] . "/09/" . $Xtanggal[2];}
		if ($Bulan == 'Oktober'){$data['tanggalAwal'] = $Xtanggal[0] . "/10/" . $Xtanggal[2];}
		if ($Bulan == 'November'){$data['tanggalAwal'] = $Xtanggal[0] . "/11/" . $Xtanggal[2];}
		if ($Bulan == 'Desember'){$data['tanggalAwal'] = $Xtanggal[0] . "/12/" . $Xtanggal[2];}

		$Xtanggal = explode(' ',$tanggalAkhir); 
		$Bulan = $Xtanggal[1];
		if ($Bulan == 'Januari'){$data['tanggalAkhir'] = $Xtanggal[0] . "/01/" . $Xtanggal[2];}
		if ($Bulan == 'Februari'){$data['tanggalAkhir'] = $Xtanggal[0] . "/02/" . $Xtanggal[2];}
		if ($Bulan == 'Maret'){$data['tanggalAkhir'] = $Xtanggal[0] . "/03/" . $Xtanggal[2];}
		if ($Bulan == 'April'){$data['tanggalAkhir'] = $Xtanggal[0] . "/04/" . $Xtanggal[2];}
		if ($Bulan == 'Mei'){$data['tanggalAkhir'] = $Xtanggal[0] . "/05/" . $Xtanggal[2];}
		if ($Bulan == 'Juni'){$data['tanggalAkhir'] = $Xtanggal[0] . "/06/" . $Xtanggal[2];}
		if ($Bulan == 'Juli'){$data['tanggalAkhir'] = $Xtanggal[0] . "/07/" . $Xtanggal[2];}
		if ($Bulan == 'Agustus'){$data['tanggalAkhir'] = $Xtanggal[0] . "/08/" . $Xtanggal[2];}
		if ($Bulan == 'September'){$data['tanggalAkhir'] = $Xtanggal[0] . "/09/" . $Xtanggal[2];}
		if ($Bulan == 'Oktober'){$data['tanggalAkhir'] = $Xtanggal[0] . "/10/" . $Xtanggal[2];}
		if ($Bulan == 'November'){$data['tanggalAkhir'] = $Xtanggal[0] . "/11/" . $Xtanggal[2];}
		if ($Bulan == 'Desember'){$data['tanggalAkhir'] = $Xtanggal[0] . "/12/" . $Xtanggal[2];}
		

		$dataX['penerimaan_barang'] = $this->M_detail_penerimaan->getPenerimaanBarangFilter($data);
		$dataX['dOutstanding'] = $this->getDataIndex();
		
		$this->load->view('gudang/v_penerimaan_barang.php',$dataX);
	}

}
?>