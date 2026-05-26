<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajuan_spl extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('sgt/M_spl');
		
		session_start();
	}
	
	function index(){
		$data['data_spl'] = $this->M_spl->getSPLpengajuan();

		$this->load->view('sgt/spl/v_pengajuan_spl.php',$data);
	}

	function simpan(){
			// print_r($_POST);
			// Array
			// (
			// 	[cbId] => Array
			// 		(
			// 			[0] => 13
			// 			[1] => 14
			// 		)

			// 	[cbPilih] => Array
			// 		(
			// 			[0] => F
			// 			[1] => T
			// 		)

			// 	[txtAksi] => setuju
			// )

		$aksi = $this->input->POST('txtAksi');
		$ArrId = $this->input->POST('cbId');
		$ArrPilih = $this->input->POST('cbPilih');

		for ($i=0; $i < count($ArrId); $i++) { 
			if ($ArrPilih[$i] == 'T') {
				$data['id'] = $ArrId[$i];
				$data['status'] = $aksi;

				$this->M_spl->setStatus($data);
			}
		}

		if ($aksi == 'setuju') {
			$_SESSION['pesan'].='<font color="blue">SPL berhasil disetujui</font>';
		}else{
			$_SESSION['pesan'].='<font color="blue">SPL berhasil ditolak</font>';
		}
		redirect('sgt/spl/pengajuan_spl', "refresh");
	}
	

	function ubah(){
			// print_r($_POST);
			// Array
			// (
			// 	[Uid] => 16
			// 	[Utanggal_mulai] => 17-10-2020   09:44
			// 	[Utanggal_selesai] => 18-10-2020   15:00
			// )
		
		$data['id'] = $this->input->POST('Uid');
		$data['mulai'] = $this->input->POST('Utanggal_mulai');
		$data['selesai'] = $this->input->POST('Utanggal_selesai');
		
		$success = $this->M_spl->ubah($data);
		if ($success) {
			$_SESSION['pesan'].='<font color="#1F618D">SPL berhasil diubah</font>';
			redirect('sgt/spl/pengajuan_spl', "refresh");
		}
	}

	function getById(){
		$idx = $this->input->POST('id_spl');
		$data = $this->M_spl->getSPLpengajuanById($idx);
		print_r(JSON_ENCODE($data));
	}
}
?>