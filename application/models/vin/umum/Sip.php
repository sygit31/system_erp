<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sip extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_umum_sip');
		$this->load->model('sgt/M_umum_sip_revisi');
		session_start();
	}
	
	function index(){
		$data['data_sip_last'] = $this->M_umum_sip->getSIPLast();

		$this->load->view('sgt/umum/v_sip.php',$data);
	}

	function getDetailSIP(){
		$id_sip = $this->input->POST('id_sip');
		$detailSIP = array();
		$detailSIP = $this->M_umum_sip->getSipDetailByIdSip($id_sip);
		print_r (json_encode($detailSIP));
	}

	
	public function cetak_sip(){
		$id_sip = $this->input->POST('txtIdSIP');
		$detailSIP = $this->M_umum_sip->getSipDetailByIdSip($id_sip);

		$detailOlahSIP = array();

		for ($i=0; $i < COUNT($detailSIP); $i++) { 
			if (array_key_exists($detailSIP[$i]->ID_BARANG, $detailOlahSIP)) {
					//ada
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['ID_SIP_DETAIL'].= "@".$detailSIP[$i]->ID_SIP_DETAIL;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['KETERANGAN'].= ",".$detailSIP[$i]->BAGIAN."-".$detailSIP[$i]->KETERANGAN;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['JUMLAH']+=$detailSIP[$i]->JUMLAH;
					// $detailOlahSIP[$detailSIP[$i]->ID_BARANG]['BAGIAN'].= "@".$detailSIP[$i]->BAGIAN;
			}else{
					//tidak ada
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['ID_SIP']=$detailSIP[$i]->ID_SIP;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['ID_SIP_DETAIL']=$detailSIP[$i]->ID_SIP_DETAIL;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['TANGGAL']=$detailSIP[$i]->TANGGAL;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['NO_SIP']=$detailSIP[$i]->NO_SIP;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['BARANG']=$detailSIP[$i]->BARANG;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['JUMLAH']=$detailSIP[$i]->JUMLAH;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['SATUAN']=$detailSIP[$i]->SATUAN;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['KETERANGAN']=$detailSIP[$i]->BAGIAN."-".$detailSIP[$i]->KETERANGAN;
					// $detailOlahSIP[$detailSIP[$i]->ID_BARANG]['BAGIAN']=$detailSIP[$i]->BAGIAN;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['ID_BARANG']=$detailSIP[$i]->ID_BARANG;
				$detailOlahSIP[$detailSIP[$i]->ID_BARANG]['SPESIFIKASI']=$detailSIP[$i]->SPESIFIKASI;
			}
		}

			// foreach ($detailOlahSIP as $food)  {
			// 	print_r("<p />");
			// 	print_r($food);
			// }



			// ======================================
	  		// $data['detailSIP'] = $this->M_umum_sip->getSipDetailByIdSip($id_sip);
		$data['detailSIP'] = $detailOlahSIP;

		$this->load->view('sgt/umum/sip/cetak_sip.php',$data);
	}

	function revisi(){
		$data['id_sip_detail'] = $this->input->POST('id_sip_detail');
		$data['jumlah'] = $this->input->POST('jumlah');

		$success = true;
		$success = $this->M_umum_sip_revisi->update($data);

		print_r($success);
	}
}
?>