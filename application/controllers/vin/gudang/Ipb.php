<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ipb extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_kk');
		$this->load->model('sgt/M_detail_penerimaan');
		$this->load->model('sgt/M_nomer_new');
		$this->load->model('sgt/M_ipb');
		$this->load->model('sgt/M_ipb_detail');
		session_start();
	}
	
	function index()
	{
		$data['data_kk'] = $this->M_kk->getKKAktif();

			// $dataY['KETERANGAN'] = 'IPB PET GUDANG';
			// $dataY['TAHUN'] = "TO_CHAR(sysdate,'YYYY')";
			// $data['nomer_ipb'] = $this->M_nomer_new->getLastIpbPetGudang($dataY);

		$data['data_ipb_all'] = $this->M_ipb->getAllIPB();
		
		$this->load->view('sgt/gudang/v_ipb.php',$data);
			// print_r($data['nomer_ipb']);
	}


	public function getBarang()
	{
		$id_kk = $this->input->POST('id_kk');
		$dataX = $this->M_kk->getBarangKK($id_kk);
		print_r(json_encode($dataX));
	}

	public function getStokByIdBarang()
	{
		$id_barang = $this->input->POST('id_barang');
		$dataX = $this->M_detail_penerimaan->getListStokByIdBarang($id_barang);
			// print_r($_POST);
		print_r(json_encode($dataX));
	}


	public function simpan()
	{
			// print_r($_POST);
			// Array
			// (
			// 	[txtTanggal] => 01/12/2020
			// 	[txtNomer] => 002
			// 	[cmbKK] => 1
			// 	[cmbBarang] => 1093@MTR@2
			// 	[txtJumlah] => 
			// 	[txtSatuan] => MTR
			// 	[ArridDetailTerima] => Array
			// 		(
			// 			[0] => 1753
			// 			[1] => 1754
			// 			[2] => 1755
			// 			[3] => 1756
			// 			[4] => 1757
			// 			[5] => 1758
			// 		)

			// 	[ArrPilih] => Array
			// 		(
			// 			[0] => T
			// 			[1] => F
			// 			[2] => F
			// 			[3] => T
			// 			[4] => F
			// 			[5] => F
			// 		)
			// )

		$dumpBarang = explode('@',$this->input->post('cmbBarang'));
		$dataIPB['NOMER'] = $this->input->post('txtNomer');
		$dataIPB['TANGGAL'] = $this->input->post('txtTanggal');
		$dataIPB['ID_KK_DETAIL'] = $dumpBarang[2];
		$success = $this->M_ipb->save($dataIPB);

		if ($success) {
			$ArrIdDetailTerima = $this->input->post('ArridDetailTerima');
			$ArrPilih = $this->input->post('ArrPilih');
			for ($i=0; $i < count($ArrIdDetailTerima); $i++) { 
				if ($ArrPilih[$i] == 'T') {
					$dataDetail['ID_DETAIL_TERIMA'] = $ArrIdDetailTerima[$i];
					$dataDetail['STATUS'] = 'ORDER';
					$this->M_ipb_detail->save($dataDetail);

						//update status penerimaan detail
					$dataX['ID_DETAIL_TERIMA'] = $ArrIdDetailTerima[$i];
					$dataX['STATUS_QC'] = 'BOOKING';
					$this->M_detail_penerimaan->UpdateStatus($dataX);
				}
			}	
		}

			//update nomer ipb
		$dataY['TAHUN'] = "TO_CHAR(sysdate,'YYYY')";

		$splitNomer = explode("/",$dataIPB['NOMER']);
		$dataY['KETERANGAN'] = "IPB PET ". $splitNomer[1];

		$dataNomer = $this->M_nomer_new->getLastIpbPetGudang($dataY);
		$dataY['NOMER'] = $dataNomer[0]->NOMER + 1;
		$this->M_nomer_new->updateNomer($dataY);
		
		$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
		print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/ipb'>");
	}

	public function cetak_ipb(){
			// print_r($_GET);
			// Array ( [id] => 26 )

		$data['data_cetak'] = $this->M_ipb->getCetakById($this->input->get('id'));

			// print_r($data);
		$this->load->view('sgt/gudang/ipb/v_cetak_ipb.php',$data);
	}
	
	public function getNomer()
	{
		$seri = $this->input->POST('seri');

		$dataY['TAHUN'] = "TO_CHAR(sysdate,'YYYY')";
		$dataY['KETERANGAN'] = "";
		if ($seri == 'SERI I') {
			$dataY['KETERANGAN'] = 'IPB PET 1';
		}
		if ($seri == 'SERI II') {
			$dataY['KETERANGAN'] = 'IPB PET 2';
		}
		if ($seri == 'SERI III') {
			$dataY['KETERANGAN'] = 'IPB PET 3';
		}
		if ($seri == 'MMEA') {
			$dataY['KETERANGAN'] = 'IPB PET M';
		}

		$dataX = $this->M_nomer_new->getLastIpbPetGudang($dataY);
			// print_r($dataX);
		print_r(json_encode($dataX));
	}
}
?>