<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_permintaan extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_permintaan');
		$this->load->model('sgt/M_permintaan_detail');
		$this->load->model('sgt/M_permintaan_filter');
		$this->load->model('sgt/M_umum_sip');
		$this->load->model('sgt/M_umum_sip_detail');
		$this->load->model('sgt/M_umum_sip_revisi');
		
		session_start();
	}
	
	function index(){
		$data['data_bagian'] = $this->M_permintaan->getBagian();
		$data['data_permintaan_per_bagian'] = $this->M_permintaan->getPermintaanDetail();
		$data['data_permintaan_filter'] = $this->M_permintaan_filter->getPermintaanFilter();

	    	// print_r($data['data_risalah']);

		$this->load->view('sgt/umum/v_cek_permintaan.php',$data);
	}

	function simpan(){
			// print_r($_POST);
			// Array
			// (
			// 	[tblPermintaan_length] => 10
			// 	[txtIdPermintaanDetail] => Array
			// 		(
			// 			[0] => 3
			// 			[1] => 2
			// 			[2] => 1
			// 			[3] => 5
			// 			[4] => 4
			// 		)

			// 	[txtJumlah] => Array
			// 		(
			// 			[0] => 222
			// 			[1] => 333
			// 			[2] => 0
			// 			[3] => 
			// 			[4] => 
			// 		)

			// )
		
		$ArrIdPermintaanDetail = $this->input->post('txtIdPermintaanDetail');
		$ArrJumlah = $this->input->post('txtJumlah');
		for ($i=0; $i < count($ArrIdPermintaanDetail); $i++) { 
			$success = true;
			if ($ArrJumlah[$i] !== '') {
				$data['id_permintaan_detail'] = $ArrIdPermintaanDetail[$i];
				$data['jumlah'] = $ArrJumlah[$i];
				if ($ArrJumlah[$i] == '0') {
					$data['status'] = 'gagal';
				}else{
					$data['status'] = 'seleksi';
				}
				
				$success = $this->M_permintaan_filter->save($data);

				if ($success) {
					$success = $this->M_permintaan_detail->UpdateStatus($data);
				}
			}

			if (!$success) {
				echo "error";
				exit();
			}
		}

			// $this->index();
		$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/pengeluaran_barang'>");
		redirect('sgt/umum/cek_permintaan', "refresh");
	}

	function simpanSIP(){
			// print_r($_POST);
			// Array
			// (
			// 	[tanggal] => 30-06-2020
			// 	[txtNoSIP] => 11/V/2020
			// 	[cbSIP] => Array
			// 		(
			// 			[0] => 13@ALKOHOL 90%@2@LTR@bbbb
			// 			[1] => 15@HEATSEAL GENERAL WHITE@2@KG@bbbbbbb
			// 			[2] => 16@SUPER SILICONE OIL@3@LTR@bbbbbb
			// 			[3] => 17@TEFLON BELT@4@BH@bbbbb
			// 		)
			// )
		
		$data['id_bagian'] = '1';
		$data['no_sip'] = $this->input->post('txtNoSIP');
		$data['tanggal'] = $this->input->post('tanggal');

		$success = true;
		$success = $this->M_umum_sip->save($data);

		if ($success) {
			$ArrSipDetail = $this->input->post('cbSIP');
			for ($i=0; $i < count($ArrSipDetail); $i++) { 
				$DD = explode('@',$ArrSipDetail[$i]);
				$dataDetail['id_pf'] = $DD[0];
				$dataDetail['jumlah'] = $DD[2];
				$dataDetail['status'] = 'sip';
				
				$success = $this->M_umum_sip_detail->save($dataDetail);
				if ($success) {
					$this->M_permintaan_filter->UpdateStatus($dataDetail);
					
					$this->M_umum_sip_revisi->save($dataDetail['jumlah']);
				}
			}
		}

		if ($success) {
			$_SESSION['cetak']='cek_permintaan/cetak_sip_saat_simpan';
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			redirect('sgt/umum/cek_permintaan', "refresh");
		}else{
			echo "error";
			exit();
		}

	}

	public function cetak_sip_saat_simpan(){
		$id_sip = $this->M_umum_sip->getMaxId();
		$detailSIP = $this->M_umum_sip->getSipDetailByIdSip($id_sip[0]->ID);

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
	
}
?>