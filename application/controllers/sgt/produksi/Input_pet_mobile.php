<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_pet_mobile extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	    	//Codeigniter : Write Less Do More
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('sgt/M_detail_penerimaan');
		$this->load->model('produksi/M_pet');
		$this->load->model('sgt/M_prod_pet');
		$this->load->model('sgt/M_prod_pet_detail');
		$this->load->model('sgt/M_prod_pet_detail_terima');
		$this->load->model('sgt/M_prod_mutasi');
		$this->load->model('sgt/M_prod_mutasi_detail');
		$this->load->model('sgt/M_prod_kary');
		session_start();
	}
	
	function index()
	{
		$data['dataROllBonProduksi'] = $this->M_detail_penerimaan->getRollBonProduksi();
		$data['pengawas'] = $this->M_pet->pengawas();
		$data['operator'] = $this->M_pet->operator();
		$data['proses'] = $this->M_pet->proses();
		$data['dataProdPet'] = $this->M_prod_pet->getDataProdPet();
		
		// print_r($data['pengawas']->result_array());
		$this->load->view('sgt/produksi/v_input_pet_mobile.php',$data);
	}

	function simpan()
	{
		// print_r($_POST);
		// SIMPAN OKE
		// PENYELESAIAN
		$success = true;

		$tampungBarang = $this->input->post('cmbBarang');
		$ArrBarang = explode("@",$tampungBarang);
		$idProdPet = $this->M_prod_pet->nextval();

		$tglMulai = strtotime($this->input->post('txtTanggalMulai'));
		$tglSelesai = strtotime($this->input->post('txtTanggalSelesai'));
		$tglOnly = date('d-m-Y', $tglMulai);
		$ConTglMulai = date('d-m-Y H:i:00', $tglMulai);
		$ConTglSelesai = date('d-m-Y H:i:00', $tglSelesai);

		// SIMPAN ERP_PROD_PET
		$dataProdPet['ID'] = $idProdPet;
		$dataProdPet['ID_PROD_PROSES'] = '112';
		$dataProdPet['DESAIN'] = $ArrBarang[1];
		$dataProdPet['PROSES'] = 'Emboss';
		$dataProdPet['NAMA_MESIN'] = $this->input->post('cmbMesin');
		$dataProdPet['SHIFT'] = $this->input->post('cmbShift');
		$dataProdPet['ID_GUDANG_ORDER'] = $ArrBarang[5];
		$dataProdPet['TANGGAL'] = $tglOnly;
		$dataProdPet['KETERANGAN'] = '';
		$dataProdPet['KODE_FLOW'] = '004';
		$dataProdPet['NMR'] = '';
		$dataProdPet['ID_PENGAWAS'] = $this->input->post('cmbPengawas');

		$success = $this->M_prod_pet->save($dataProdPet);
		// =========================
		//SIMPAN ERP_PROD_PET_DETAIL

		$idProdPetDetail = $this->M_prod_pet_detail->nextval();
		$panjang = $this->input->post('txtJumlah');
		$hasil = $this->input->post('txtHasil');
		$reject = $this->input->post('txtReject');
		$sisa = (float)$panjang - ((float)$hasil + (float)$reject);

		$dataProdPetDetail['ID'] = $idProdPetDetail;
		$dataProdPetDetail['ID_PROD_PET'] = $idProdPet;
		$dataProdPetDetail['KODE'] = $ArrBarang[4];
		$dataProdPetDetail['MULAI'] = $ConTglMulai;
		$dataProdPetDetail['SELESAI'] = $ConTglSelesai;
		$dataProdPetDetail['PANJANG'] = $panjang;
		$dataProdPetDetail['HASIL'] = $hasil;
		$dataProdPetDetail['REJECT'] = $reject;
		$dataProdPetDetail['SISA'] = $sisa;
		$dataProdPetDetail['AKTIF'] = '1';
		$dataProdPetDetail['TELLER'] = '';
		$dataProdPetDetail['QTY_ROLL'] = '1';
		$dataProdPetDetail['REJECT_KONVERSI'] = '0';
		$dataProdPetDetail['BAHAN'] = '';

		if ($success) {
			$success = $this->M_prod_pet_detail->save($dataProdPetDetail);
		}else{
			$success = false;
		}
		// ================================
		//SIMPAN ERP_PROD_PET_DETAIL_TERIMA

		$dataProdPetDetailTerima['ID'] = $this->M_prod_pet_detail_terima->nextval();
		$dataProdPetDetailTerima['ID_PROD_PET_DETAIL'] = $idProdPetDetail;
		$dataProdPetDetailTerima['ID_DETAIL_TERIMA'] = $ArrBarang[0];;

		if ($success) {
			$success = $this->M_prod_pet_detail_terima->save($dataProdPetDetailTerima);
		}else {
			$success = false;
		}
		// ====================================

		// SIMPAN ERP_PROD_MUTASI
		$dataProdMutasi['ID'] = $this->M_prod_mutasi->nextval();
		$dataProdMutasi['TGL'] = '';
		$dataProdMutasi['NMR'] = '';
		$dataProdMutasi['STATION_AWAL'] = 'Emboss';
		$dataProdMutasi['STATION_AKHIR'] = 'Metalize';
		$dataProdMutasi['KODE'] = $ArrBarang[4];
		$dataProdMutasi['QTY'] = $hasil;
		$dataProdMutasi['QTY_PRODUKSI'] = '0';
		$dataProdMutasi['QTY_ROLL'] = '1';
		$dataProdMutasi['ID_PENGIRIM'] = '';
		$dataProdMutasi['ID_PENERIMA'] = '';
		$dataProdMutasi['ID_GUDANG_ORDER'] = $ArrBarang[5];
		$dataProdMutasi['AKTIF'] = '1';

		if ($success) {
			$success = $this->M_prod_mutasi->save($dataProdMutasi);
		}else {
			$success = false;
		}
		// ====================================

		// SIMPAN ERP_PROD_MUTASI_DETAIL
		$dataProdMutasiDetail['ID'] = $this->M_prod_mutasi_detail->nextval();
		$dataProdMutasiDetail['ID_PROD_PET_DETAIL'] = $idProdPetDetail;
		$dataProdMutasiDetail['ID_PROD_MUTASI'] = $dataProdMutasi['ID'];

		if ($success) {
			$success = $this->M_prod_mutasi_detail->save($dataProdMutasiDetail);
		}else {
			$success = false;
		}
		// ===================================

		//SIMPAN ERP_PROD_KARY
		$ArrOperator = $this->input->post('cmbOperator');

		// print_r(count($ArrOperator));
		for ($x=0; $x < count($ArrOperator); $x++) { 
			// print_r($ArrOperator[$x]);
			$dataProdKary['ID'] = $this->M_prod_kary->nextval();
			$dataProdKary['ID_PET_DETAIL'] = $idProdPetDetail;
			$dataProdKary['ID_OPERATOR'] = $ArrOperator[$x];

			if ($success) {
				$success = $this->M_prod_kary->save($dataProdKary);
			}else {
				$success = false;
			}
		}
		

		if($success){
			// $this->index();
			// $_SESSION['cetak']='ipb/cetak_ipb?id='.$dataIPB['ID'];
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/pengeluaran_barang'>");
			redirect('sgt/produksi/input_pet_mobile', "refresh");
		}else{
			echo "error";
			exit();
		}
	}

}
?>