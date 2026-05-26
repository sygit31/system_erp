<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_barang_umum extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	    	//Codeigniter : Write Less Do More
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
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