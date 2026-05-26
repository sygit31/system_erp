<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permintaan extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_barang');
		$this->load->model('sgt/M_karyawan');
		$this->load->model('sgt/M_permintaan');
		$this->load->model('sgt/M_permintaan_detail');
		$this->load->model('sgt/M_umum_sip');
		
		session_start();
	}
	
	function index(){
		$data['data_barang'] = $this->M_barang->getAllBarangUmum();

	    	// print_r($data['data_risalah']);

		$this->load->view('sgt/umum/v_permintaan.php',$data);
	}

	function simpan(){
			// print_r($_POST);

		$CRE = explode('|',$_SESSION['logERP']);
		$DataKaryawan = $this->M_karyawan->getKaryawanById($CRE[0]);
		
		$data['id_karyawan'] = $CRE[0];
		$data['id_bagian'] = $DataKaryawan->ID_BAGIAN;

		$success = true;
		$success = $this->M_permintaan->save($data);


			// ======================================
		if ($success) {
			$ArrIdBarang = $this->input->post('ArrIdBarang');
			$ArrJumlah = $this->input->post('ArrJumlah');
			$ArrKeterangan = $this->input->post('ArrKeterangan');

			for ($i=0; $i < count($ArrIdBarang); $i++) { 
					// print_r($ArrIdBarang[$i]."<br/>");
				$dataDetail['id_barang'] = $ArrIdBarang[$i];
				$dataDetail['jumlah'] = $ArrJumlah[$i];
				$dataDetail['keterangan'] = $ArrKeterangan[$i];
				$dataDetail['status'] = 'ORDER';

				$success = $this->M_permintaan_detail->save($dataDetail);
			}
		}
		
		if($success){
				// $this->index();
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
				// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/pengeluaran_barang'>");
			redirect('sgt/umum/permintaan', "refresh");
		}else{
			echo "error";
			exit();
		}
			// print_r($data['id_bagian']);
	}

	
	function get_sip_outstanding(){
			// print_r($_POST);
			// Array
			// (
			// 	[v] => 885
			// )

		$CRE = explode('|',$_SESSION['logERP']);
		$DataKaryawan = $this->M_karyawan->getKaryawanById($CRE[0]);
		
		$id_bagian = $DataKaryawan->ID_BAGIAN;
		$id_barang = $this->input->post('Aid_barang');
		
		$Outstanding = $this->M_umum_sip->getSIPOutstandingByBagianDanIdBarang($id_bagian,$id_barang);

		print_r(json_encode($Outstanding));
	}


}
?>