<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyampaian extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_permintaan');
		$this->load->model('sgt/M_permintaan_filter');
		$this->load->model('sgt/M_umum_sip_pemenuhan');
		$this->load->model('sgt/M_umum_sip_detail');
		session_start();
	}
	
	function index(){
		$data['data_bagian'] = $this->M_permintaan->getBagianSIP();
		$data['data_permintaan_per_bagian'] = $this->M_permintaan->getPermintaanDetailSIP();
			// $data['data_permintaan_filter'] = $this->M_permintaan_filter->getPermintaanFilter();

		$this->load->view('sgt/umum/v_penyampaian.php',$data);
	}
	

	function simpan(){
			// print_r($_POST);
			// Array
			// (
			// 	[txtIdSIPDetail] => Array
			// 		(
			// 			[0] => 16
			// 			[1] => 14
			// 			[2] => 15
			// 		)

			// 	[txtOutstanding] => Array
			// 		(
			// 			[0] => 1
			// 			[1] => 2
			// 			[2] => 5
			// 		)

			// 	[txtJumlah] => Array
			// 		(
			// 			[0] => 2
			// 			[1] => 1
			// 			[2] => 
			// 		)
			// )

		$success = true;

		$ArrIdSIPDetail = $this->input->post('txtIdSIPDetail');
		$ArrOutstanding = $this->input->post('txtOutstanding');
		$ArrJumlah = $this->input->post('txtJumlah');

		for ($i=0; $i < count($ArrIdSIPDetail); $i++) { 
			$sisa = $ArrOutstanding[$i] - $ArrJumlah[$i];
			if ($success && $ArrJumlah[$i] != 0) {
				$data['id_sip_detail'] = $ArrIdSIPDetail[$i];
				$data['jumlah'] = $ArrJumlah[$i];

				$success = $this->M_umum_sip_pemenuhan->save($data);

				if ($success && $sisa == 0) {
						// update status SIP
					$dataSIP['id'] = $ArrIdSIPDetail[$i];
					$dataSIP['status'] = 'selesai';
					$success = $this->M_umum_sip_detail->update($dataSIP);
				}
			}
		}

		if($success){
				// $this->index();
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
				// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/pengeluaran_barang'>");
			redirect('sgt/umum/penyampaian', "refresh");
		}else{
			echo "error";
			exit();
		}
	}

}
?>