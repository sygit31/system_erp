<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kk extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_kk');
		$this->load->model('sgt/M_kk_detail_jadwal');
		$this->load->model('sgt/M_kk_jadwal');
		$this->load->model('sgt/M_station_flow');
		$this->load->model('sgt/M_rnd_bom');
		$this->load->model('sgt/M_nomer');
		$this->load->model('sgt/M_rnd_produk_detail');
		$this->load->model('sgt/M_waste');
		
		session_start();
	}
	
	function index(){
		$data['data_risalah'] = $this->getDataIndex();

	    	// print_r($data['data_risalah']);

		$this->load->view('sgt/ppic/v_kk.php',$data);
	}


	function getDataIndex()
	{
		$data_risalah = $this->M_kk->get_risalah();

		$data = array();
		for($i=0;$i<count($data_risalah);$i++){
				// //AMBIL TOTAL (SUM) PENERIMAAN DARI TABEL DETAIL PENERIMAAN SESUAI ID_DETAIL_PO
		  // 		$QTYx = $this->m_detail_penerimaan->getQTYbyDetailPO($po_otw[$i]->ID);
		  // 		// print_r($QTYx);
		  // 		$QTYz = $QTYx[0]->QTY;
				// if ($QTYz == "") {
				// 	$QTYz = 0;
				// }
				// $outstanding = $po_otw[$i]->QTY - $QTYz;
				// $outstandingToleransiBawah = ($po_otw[$i]->QTY - ($po_otw[$i]->QTY * 10 / 100)) - $QTYz;
				// $outstandingToleransiAtas = ($po_otw[$i]->QTY + ($po_otw[$i]->QTY * 10 / 100)) - $QTYz;
				// // print_r($po_otw[$i]->QTY ." ". $QTYz. " = " .$outstanding . " <br>");

			$order = $data_risalah[$i]->QTY;
			$revisi = (int)$data_risalah[$i]->QTY_REVISI;
			$total = $order + $revisi;
			$kirim = 0;
			$outstanding = $total - $kirim;

			$data[$i]['ID'] = $data_risalah[$i]->ID;
			$data[$i]['NMR'] = $data_risalah[$i]->NMR;
			$data[$i]['TGL_RISALAH'] = $data_risalah[$i]->TGL_RISALAH;
			$data[$i]['TGL_DELIVERY'] = $data_risalah[$i]->TGL_DELIVERY;
			$data[$i]['NAMA'] = $data_risalah[$i]->NAMA;
			$data[$i]['TAHUN'] = $data_risalah[$i]->DESAIN;
			$data[$i]['ORDER'] = $order;
			$data[$i]['REVISI'] = $revisi;
			$data[$i]['TOTAL'] = $total;
			$data[$i]['KIRIM'] = $kirim;
			$data[$i]['OUTSTANDING'] = $outstanding;
			$data[$i]['ID_PROSES'] = $data_risalah[$i]->ID_PROSES;
		}

		return $data;
	}

	public function cekJadwal()
	{
		try {
				//   print_r("ok");
			$id_risalah = $this->input->post('id_risalah');
			$oplah = $this->input->post('oplah');
			$tanggal = $this->input->post('tanggal');
				// $tanggal = str_replace();
			$jkEmbos = $this->input->post('jkEmbos');
			$jkCoatingSensi = $this->input->post('jkCoatingSensi');
			$jkSensiRead = $this->input->post('jkSensiRead');
			$jkSlitter = $this->input->post('jkBelah');


			print_r($tanggal);



				// //cek jam kerja di tanggal
				// $date = new DateTime($tanggal);
				// $totalProduksi = 0;

				// while ($totalProduksi <= $oplah) {
				// 	//cek di tanggal dan di proses
		  		// 	$JadwalNow = $this->M_kk_jadwal->cekByTanggal($date->format('d-m-Y'));
				// 	print_r($JadwalNow);

				// 	//next
				// 	$date->modify('+1 day');

				// }
			
		} catch (Exception $e) {
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	}
	
	
	public function generate()
	{
		$id_proses = $this->input->post('id_proses');
			// $oplah = $this->input->post('oplah');
			// $tanggal = $this->input->post('tanggal');
			// $tanggal = strtolower($tanggal);

			// $txt = array("januari", "februari", "maret","april","mei","juni","juli","agustus","september","oktober","november","desember"," ");
			// $angk = array("1","2","3","4","5","6","7","8","9","10","11","12","/");

			// $tanggal = str_replace($txt, $angk, $tanggal);

		$flow_station =  $this->M_station_flow->get_flow($id_proses);

		$ArrStation = Array();
		$ArrBOM = Array();

		foreach ($flow_station as $key => $value) {
				// print_r($value);
				// stdClass Object
				// 	(
				// 		[ID_STATION_FLOW] => 9
				// 		[NAMA] => Hitung
				// 		[URUT] => 10
				// 	)

			array_push($ArrStation,$value);

			$bomArr =  $this->M_rnd_bom->getBOM($id_proses,$value->ID_STATION_FLOW);
			$ArrBOM[$value->ID_STATION_FLOW] = $bomArr;
		}

		$ArrReturn['Station'] = $ArrStation;
		$ArrReturn['BOM'] = $ArrBOM;

		print_r(json_encode($ArrReturn));
	}


	public function getNoKK(){
		$tahun = $this->input->post('tahun');

		$nomerS = $this->M_nomer->getNomerKK($tahun);
		$nomer = $nomerS[0]->KK;
		print_r($nomer + 1);
	} 

	public function getKebutuhan(){
		$id_proses = $this->input->post('id_proses');
		$oplah = $this->input->post('oplah');
		$oplah = str_replace(".","",$oplah);
		$BahanUtama = $this->M_rnd_bom->getBarangCountinueByProses($id_proses);

		$DataProdukDetail = $this->M_rnd_produk_detail->getDataByIdProses($id_proses);
			// Array(
			// 	[0] => stdClass Object
			// 		(
			// 			[ID] => 3
			// 			[ID_PRODUK] => 2
			// 			[LINE] => 4
			// 			[UKURAN] => ,5
			// 			[PITA_UK_SERI] => 146
			// 			[PANJANG] => 1,04
			// 			[DESAIN] => 2020
			// 		))

		$DataWaste = $this->M_waste->getDataByIdProses($DataProdukDetail[0]->DESAIN);
			// Array(
			// [0] => stdClass Object
			// 	(
			// 		[ID] => 1
			// 		[WASTE_PEREKATAN] => 5
			// 		[WASTE_PITA] => 9
			// 		[WASTE_BELAH] => 5
			// 		[TAHUN] => 2020
			// 	))
		
		$waste_perekatan = $DataWaste[0]->WASTE_PEREKATAN / 100 ;
		$panjang = $DataProdukDetail[0]->PANJANG;
		$panjang = str_replace(",",".",$panjang);

		$kebutuhanKertas = (1 + $waste_perekatan) * $oplah * $panjang;
		$kebutuhanFoil = $kebutuhanKertas * $DataProdukDetail[0]->LINE;
		$kebutuhanStamping = round($kebutuhanFoil / $DataProdukDetail[0]->PITA_UK_SERI,2);
		$kebutuhanBelah = round($kebutuhanStamping * ($DataWaste[0]->WASTE_PITA/100),2) + $kebutuhanStamping;
		$kebutuhanGudang = round($kebutuhanBelah * ($DataWaste[0]->WASTE_BELAH/100),2) + $kebutuhanBelah;
		
		$Respon['kebutuhan'] = $kebutuhanGudang;
		$Respon['waste_pita'] = $DataWaste[0]->WASTE_PITA;
		$Respon['waste_perekatan'] = $DataWaste[0]->WASTE_PEREKATAN;
		$Respon['waste_belah'] = $DataWaste[0]->WASTE_BELAH;
		$Respon['bahan_utama'] = $BahanUtama[0]->NAMA.' '.$BahanUtama[0]->SPESIFIKASI;
		$Respon['satuan_bu'] = $BahanUtama[0]->SATUAN;

		print_r (json_encode($Respon));
	} 

}
?>