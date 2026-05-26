<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi_pet extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('vin/M_kk');
		$this->load->model('vin/M_mutasi_pet');
		$this->load->model('produksi/M_lap_mutasi_pet');
		$this->load->model('vin/M_detail_penerimaan');
		$this->load->model('vin/M_nomer_new');
		$this->load->model('vin/M_station_flow');
		$this->load->model('vin/M_ipb');
		$this->load->model('vin/M_karyawan');
		$this->load->model('vin/M_ipb_detail');
		$this->load->helper('url');
		session_start();
	}
	
	function index()
	{
		$data['data_desain'] = $this->M_station_flow->get_desain();
		$data['data_karyawan'] = $this->M_karyawan->getKaryawanKhususMutasiPET();
            //$data['mutasi_all'] = $this->M_mutasi_pet->show();
		$this->load->view('vin/produksi/v_mutasi_pet.php',$data);
			// print_r($data['nomer_ipb']);
	}
	
	public function filter()
	{
		$data = $this->input->POST('data');
		$tanggal_awal = $data[0];
		$tanggal_akhir = $data[1];
		if ($data[4]=='CENTANG')
		{
			$kode_roll = $data[5];
			if ($data[2]=='SEMUA')
			{
				$proses_awal = 'semua';
				$proses_akhir = '';
			}
			else
			{
				$proses_awal = $data[2];
				$proses_akhir = $data[3];
			}
		}
		else if ($data[4]=='')
		{
			if ($data[2]=='SEMUA')
			{
				$proses_awal = 'semua';
				$proses_akhir = '';
			}
			else
			{
				$proses_awal = $data[2];
				$proses_akhir = $data[3];
			};
		}
		
		$tanggal_awal = date('ymd', strtotime($tanggal_awal));
		$tanggal_akhir = date('ymd', strtotime($tanggal_akhir));
		$proses_akhir = $data[3];
		if($data[4] == '')
		{
			$dataX = $this->M_mutasi_pet->filter($tanggal_awal,$tanggal_akhir,$proses_awal,$proses_akhir);
		}
		else if ($data[4] == 'CENTANG')
		{
			$cek_roll='CENTANG';
			$dataX = $this->M_mutasi_pet->filter2($tanggal_awal,$tanggal_akhir,$proses_awal,$proses_akhir,$cek_roll,$kode_roll);	
		}
		print_r(json_encode(array($dataX)));
	}

	public function getBarang()
	{
		$id_kk = $this->input->POST('id_kk');
		$dataX = $this->M_kk->getBarangKK($id_kk);
		print_r(json_encode($dataX));
	}
	
	public function getIdPengirimPenerima()
	{
		$params = $this->input->POST('data');
		$dataX = $this->M_karyawan->get_id_karyawanMutasiPET($params);
		print_r(json_encode(array($dataX)));
	}

	public function getProsesAwal()
	{
		$kode_flow = $this->input->POST('data');
		$dataX = $this->M_lap_mutasi_pet->get_proses_awal($kode_flow);
		print_r(json_encode(array($dataX)));
	}
	
	public function getKodeFlow()
	{
		$desain = $this->input->POST('data');
		$dataX = $this->M_lap_mutasi_pet->get_kode_flow($desain);
		print_r(json_encode(array($dataX)));
	}

	public function getLastNoMutasi()
	{
		$data = $this->input->POST('data');
		$desain = $data[0];
		$seri = $data[1];
		$jenis = $data[2];
		$dataX = $this->M_nomer_new->getLastMutasiPet($desain,$seri,$jenis);
		print_r(json_encode(array($dataX)));
	}
	
	function getProsesAkhir()
	{
		$data = $this->input->post('data');
		$desain = $data[0];
		$nama_proses_awal = $data[1];
		$kode_flow = $data[2];
		$get_proses_akhir = $this->M_lap_mutasi_pet->get_proses_akhir($desain,$nama_proses_awal,$kode_flow);
		$get_kk = $this->M_mutasi_pet->get_kk_mutasi($nama_proses_awal,$desain);
		print_r(json_encode(array($get_proses_akhir,$get_kk)));
	}
	
	function getRoll()
	{
		$data = $this->input->post('data');
		$kk = $data[0];
		$nama_proses_awal = $data[1];
		$nama_proses_akhir = $data[2];
		$get_roll = $this->M_mutasi_pet->get_roll_mutasi($kk,$nama_proses_awal,$nama_proses_akhir);
		print_r(json_encode(array($get_roll)));
	} 
	
	function cekRollMutasi()
	{
		$data = $this->input->post('data');
		$dari = $data[0];
		$cek_roll = $this->M_mutasi_pet->cek_roll_edit_mutasi($dari);
		print_r(json_encode(array($cek_roll)));
	} 
	function getDetailMutasi()
	{
		$data = $this->input->post('data');
		$nomor_mutasi = $data[0];
		$tgl_mutasi = date('ymd', strtotime($data[1])); 
		$kk = $data[2];
		$get_roll = $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi,$kk);
		print_r(json_encode(array($get_roll)));
	} 
	function editDetailMutasi()
	{
		$data = $this->input->post('data'); 
		$nomor_mutasi = $data[0];
		$tgl_mutasi = date('ymd', strtotime($data[1])); 
		$kk = $data[2];
		$params=bin2hex($nomor_mutasi.'^'.$tgl_mutasi.'^'.$kk);
		//$params=$this->secure->encrypt_url($nomor_mutasi.'&'.$tgl_mutasi);
		print_r(json_encode(array($params)));
		//$datas['get_roll']= $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi);
		//$this->load->view('vin/produksi/mutasi_pet/v_edit_mutasi_pet.php',$datas);
	} 
	function gabungRollMutasi()
	{
		$data = $this->input->post('data'); 
		$nomor_mutasi = $data[0];
		$tgl_mutasi = date('ymd', strtotime($data[1])); 
		$kk = $data[2];
		$params=bin2hex($nomor_mutasi.'^'.$tgl_mutasi.'^'.$kk);
		//$params=$this->secure->encrypt_url($nomor_mutasi.'&'.$tgl_mutasi);
		print_r(json_encode(array($params)));
		//$datas['get_roll']= $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi);
		//$this->load->view('vin/produksi/mutasi_pet/v_edit_mutasi_pet.php',$datas);
	} 
	function tampileditDetailMutasi($param)
	{   
		//$coba=$this->uri->segment(5);
		
		$decod=hex2bin($param);
		//$decod=$this->secure->decrypt_url($coba);
		$parameter=explode('^',$decod);
		//$data['get_roll']=$decod;
		$nomor_mutasi=$parameter[0];
		$tgl_mutasi=$parameter[1];
		$kk=$parameter[2];
		$data['get_roll']= $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi,$kk);
		$data['get_kk_aja']= $this->M_mutasi_pet->get_kk_aja();
		$data['get_karyawan'] = $this->M_karyawan->get_karyawanMutasiPET();
		$data['get_karyawan_terima'] = $this->M_karyawan->get_karyawanMutasiPET();
		$data['tes']=json_encode($data);
		$this->load->view('vin/produksi/v_edit_mutasi_pet.php',$data);
	} 

	function tampilgabungRollMutasi($param)
	{   
		//$coba=$this->uri->segment(5);
		
		$decod=hex2bin($param);
		//$decod=$this->secure->decrypt_url($coba);
		$parameter=explode('^',$decod);
		//$data['get_roll']=$decod;
		$nomor_mutasi=$parameter[0];
		$tgl_mutasi=$parameter[1];
		$kk=$parameter[2];
		$data['get_roll']= $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi,$kk);
		$data['get_kk_aja']= $this->M_mutasi_pet->get_kk_aja();
		$data['get_karyawan'] = $this->M_karyawan->get_karyawanMutasiPET();
		$data['get_karyawan_terima'] = $this->M_karyawan->get_karyawanMutasiPET();
		$data['tes']=json_encode($data);
		$this->load->view('vin/produksi/v_gabung_roll_mutasi_pet.php',$data);
	} 

	function excelDetailMutasi()
	{
		$data = $this->input->post('data'); 
		$nomor_mutasi = $data[0];
		$tgl_mutasi = date('ymd', strtotime($data[1])); 
		$kk = $data[2];
		$params=bin2hex($nomor_mutasi.'^'.$tgl_mutasi.'^'.$kk);
		print_r(json_encode(array($params)));
		//$datas['get_roll']= $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi);
		//$this->load->view('vin/produksi/mutasi_pet/v_edit_mutasi_pet.php',$datas);
	} 
	function tampilexcelDetailMutasi($param)
	{   
		$decod=hex2bin($param);
		$parameter=explode('^',$decod);
		$nomor_mutasi=$parameter[0];
		$tgl_mutasi=$parameter[1];
		$kk=$parameter[2];
		$data['data_mutasi']= $this->M_mutasi_pet->get_detail_mutasi($nomor_mutasi,$tgl_mutasi,$kk);
		
		$this->load->view('vin/produksi/v_excel_mutasi_pet.php',$data);
	} 
	function exportExcelDetailAll()
	{
		$data = $this->input->post('data'); 
		$tanggal_awal = date('ymd', strtotime($data[0])); 
		$tanggal_akhir = date('ymd', strtotime($data[1])); 
		$proses_awal = $data[2];
		$proses_akhir = $data[3];
		$kode_flow = $data[4];
		$params=bin2hex($tanggal_awal.'^'.$tanggal_akhir.'^'.$proses_awal.'^'.$proses_akhir.'^'.$kode_flow);
		print_r(json_encode(array($params)));
	} 
	function tampilexcelDetailAll($param)
	{   
		$decod=hex2bin($param);
		$parameter=explode('^',$decod);
		$tanggal_awal =$parameter[0];
		$tanggal_akhir =$parameter[1];
		$proses_awal = $parameter[2];
		$proses_akhir = $parameter[3];
		$kode_flow = $parameter[4];
		$data['data_mutasi']= $this->M_mutasi_pet->get_export_excel_all($tanggal_awal,$tanggal_akhir,$proses_awal,$proses_akhir,$kode_flow);
		
		$this->load->view('vin/produksi/v_excel_detail_all.php',$data);
	} 
	function simpan_mutasi()
	{
		$data = $this->input->post('data');
		$nomor_mutasi = $data[0];
		$tgl_mutasi =  date('d-m-Y', strtotime($data[1]));
		$id_mutasi = $data[2];
		$seri = $data[3];
		$no_urut = $data[4];
		$desain = $data[5];
		$jenis = $data[6];
		$station_awal = $data[7];
		$station_akhir = $data[8];
		$pengirim = $data[9];
		$penerima = $data[10];
		//$urut = $this->M_mutasi_pet->urut();
		//$this->M_mutasi_pet->save_mutasi($urut,$nomor_mutasi,$tgl_mutasi,$id_mutasi,$station_awal,$station_akhir);

		// == ASLI ===========================
		// $this->M_mutasi_pet->update_prod_mutasi($id_mutasi,$nomor_mutasi,$tgl_mutasi,$pengirim,$penerima); 
		// $tes=$this->M_nomer_new->updateNomerMutasi($desain,$no_urut,$seri,$jenis);
		// print_r(json_encode(array($tes)));

		// == EDIT SYGIT ================

		$testos = $this->M_mutasi_pet->update_prod_mutasi($id_mutasi,$nomor_mutasi,$tgl_mutasi,$pengirim,$penerima); 
		$this->M_nomer_new->updateNomerMutasi($desain,$no_urut,$seri,$jenis);
		print_r($testos);
	}
	
	function simpanEditMutasi()
	{
		//print_r($_POST);
		$data = $this->input->post('data');
		$no_mutasi = $data[0][0];
		$kk = $data[0][1];
		$id_pengirim = $data[0][2];
		$id_penerima = $data[0][3];
		$no_mutasi_lama = $data[0][8];
		$tgl_mutasi = $data[0][9]; 
    //rubah semua aktif 2 jadi 3 
		$this->M_mutasi_pet->update_status_edit_mutasi ($no_mutasi_lama,$kk);
		
		for ($i=0; $i<count($data); $i++) {
			$shift = $data[$i][4];
			$kode_roll = $data[$i][5];
			$meter = $data[$i][6];
			$id_prod_mutasi = $data[$i][7];
			
			//$this->M_mutasi_pet->update_edit_mutasi_detail ($no_mutasi,$kk,$id_pengirim,$id_penerima,$shift,$kode_roll,$meter,$id_prod_mutasi,$no_mutasi_lama,$tgl_mutasi);	
			$this->M_mutasi_pet->update_edit_mutasi_detail ($no_mutasi,$id_pengirim,$id_penerima,$id_prod_mutasi,$tgl_mutasi,$kk);	
		}
		//print_r("<meta http-equiv='refresh' content='0; url=".site_url()."index.php/vin/produksi/mutasi_pet/'>");
		print_r(json_encode(array($data)));
         /*
		// Hapus Sub Menu yang tidak dipakai
		for ($i=0; $i<count($data[0][7]);$i++) {
			$id_hapus = $data[0][7][$i];
			$this->M_menu->hapus_menu_detail($id_hapus);
		}
		*/
	}
	
	function simpanGabungRoll()
	{
		//print_r($_POST);
		$data = $this->input->post('data');
		$no_mutasi = $data[0][0];
		$kk = $data[0][1];
		$id_pengirim = $data[0][2];
		$id_penerima = $data[0][3];
		$no_mutasi_lama = $data[0][8];
		$tgl_mutasi =  $data[0][9];
		$roll_gabungan = $data[0][10];
		$jumlah_gabungan = $data[0][11];
        $dari = $data[0][12];
		$ke = $data[0][13];
		$dummy_prod_mutasi = $data[0][7];
        
		// insert roll gabungan
	
		$urut = $this->M_mutasi_pet->urut();
		$id_kk = $this->M_mutasi_pet->cari_id_kk_aja($kk);
		$this->M_mutasi_pet->tambah_roll_gabungan_prod_mutasi($urut,$tgl_mutasi,$no_mutasi,$dari,$ke,$roll_gabungan,$jumlah_gabungan,$id_pengirim,$id_penerima,$id_kk);
		$urut_detail = $this->M_mutasi_pet->urut_detail();
		$id_dummy_prod_pet_detail = $this->M_mutasi_pet->cari_dummy_prod_pet_detail($dummy_prod_mutasi);
		$this->M_mutasi_pet->tambah_roll_gabungan_prod_mutasi_detail($urut_detail,$id_dummy_prod_pet_detail,$urut);

		for ($i=0; $i<count($data); $i++) {
			$shift = $data[$i][4];
			$kode_roll = $data[$i][5];
			$meter = $data[$i][6];
			$id_prod_mutasi = $data[$i][7];
			
			$tes=$this->M_mutasi_pet->update_gabung_roll_prod_mutasi($kode_roll,$urut,$no_mutasi) ;	
		}
		//print_r("<meta http-equiv='refresh' content='0; url=".site_url()."index.php/vin/produksi/mutasi_pet/'>");
		
		print_r(json_encode(array($tes)));
        
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
