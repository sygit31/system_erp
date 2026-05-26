<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_barang extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('M_detail_penerimaan');
		session_start();
	}
	
	function index() {
		$data['penerimaan_barang'] = $this->M_detail_penerimaan->getPenerimaanBarang();

		$this->load->view('laporan/v_penerimaan_barang.php',$data);
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
		$this->load->view('laporan/v_penerimaan_barang.php',$dataX);
	}
}
?>