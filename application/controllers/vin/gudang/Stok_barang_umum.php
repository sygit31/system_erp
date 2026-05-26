<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_barang_umum extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_detail_penerimaan');
		session_start();
	}
	
	function index()
	{
		$data['stok'] = $this->M_detail_penerimaan->getStok();
		$data['stok'] = $this->M_detail_penerimaan->getStok();
		
		$this->load->view('sgt/gudang/v_stok_barang_umum.php',$data);
	}


	public function print_label(){
		$id = $this->input->GET('id');
		$data['cetak'] =  explode("@", $id);
			// print_r($data['cetak']);

		$this->load->view('sgt/gudang/stok_barang/cetak_label.php',$data);
	}


	public function cetak_terpilih(){
	  		// print_r($_POST);
		$TempCetak = $this->input->POST('cbCetak');

		if (isset($TempCetak)) {
			$data['cetak'] = array();
			foreach ($TempCetak as $key => $value) {
				$dataLabel =  explode("@", $value);
				array_push($data['cetak'],$dataLabel);
			}

			$this->load->view('sgt/gudang/stok_barang/cetak_array.php',$data);
		}else{
			print_r("<h1>Tidak ada data yang dipilih</h1>");
		}
	}
}
?>