<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_spl extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_karyawan');
		$this->load->model('sgt/M_bagian');
		$this->load->model('sgt/M_spl');
		$this->load->helper('url');

		session_start();
	}
	
	function index(){
		$data['data_bagian'] = $this->M_bagian->getAllBagian();
		$data['dataSPL'] = $this->M_spl->getSPLBelumLewat();

		$this->load->view('sgt/spl/v_input_spl.php',$data);
	}

	function simpan(){
			// print_r($_POST);
			// Array
			// (
			// 	[tanggal_mulai] => 02-11-2020   15:42
			// 	[tanggal_selesai] => 26-11-2020   15:42
			// 	[cmbBagian] => 9
			// 	[cbId] => Array
			// 		(
			// 			[0] => 80
			// 			[1] => 81
			// 			[2] => 414
			// 			[3] => 76
			// 			[4] => 390
			// 			[5] => 415
			// 		)

			// 	[cbPilih] => Array
			// 		(
			// 			[0] => T
			// 			[1] => T
			// 			[2] => F
			// 			[3] => T
			// 			[4] => F
			// 			[5] => F
			// 		)

			// 	[cbTotal] => Array
			// 		(
			// 			
			// 		)
			// )

		$data['mulai'] = $this->input->POST('tanggal_mulai');
		$data['selesai'] = $this->input->POST('tanggal_selesai');
		$data['id_bagian'] = $this->input->POST('cmbBagian');
		$data['tujuan'] = $this->input->POST('txtTujuan');
		$data['status'] = 'pengajuan';

		$dataX = $data;
		$dataX['bagian'] = $this->input->POST('txtBagian');
		$dataX['NIK'] = array();
		$dataX['Nama'] = array();
		$dataX['Total'] = array();

		
		$ArrId = $this->input->POST('cbId');
		$ArrPilih = $this->input->POST('cbPilih');
		$ArrNik = $this->input->POST('cbNik');
		$ArrNama = $this->input->POST('cbNama');
		$ArrTotal = $this->input->POST('cbTotal');
		
		for ($i=0; $i < count($ArrPilih); $i++) { 
			if ($ArrPilih[$i]=='T') {
				$data['id_karyawan'] = $ArrId[$i];

				$this->M_spl->save($data);

					// binding untuk di print
				array_push($dataX['NIK'],$ArrNik[$i]);
				array_push($dataX['Nama'],$ArrNama[$i]);
				array_push($dataX['Total'],$ArrTotal[$i]);
			}
		}

		$_SESSION['cetak'] = True;
		$_SESSION['data_cetak'] = $dataX;
		$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
		redirect('sgt/spl/input_spl', "refresh");
	}

	function getKaryawan()
	{
		$id_bagian = $this->input->POST('id_bagian');
			// $data_karyawan = $this->M_karyawan->getKaryawanByIdBagian($id_bagian);
		$data_karyawan = $this->M_karyawan->getKaryawanByIdBagianTotalLemburan($id_bagian);
		print_r(json_encode($data_karyawan));
			// print_r($data_karyawan);
	}
	
	


}
?>