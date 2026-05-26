<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_spl extends CI_Controller{
	
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
			// print_r($_SESSION['data_cetak']);
			// Array
			// (
			// 	[mulai] => 22-11-2020   10:03
			// 	[selesai] => 23-11-2020   10:03
			// 	[id_bagian] => 19
			// 	[tujuan] => sdfsfsd
			// 	[status] => pengajuan
			// 	[bagian] => KIRIMAN
			// 	[NIK] => Array
			// 		(
			// 			[0] => 00139716
			// 			[1] => 94246
			// 		)

			// 	[Nama] => Array
			// 		(
			// 			[0] => Ahmad Riza Taufiqur Rohman
			// 			[1] => Andri Kurniawan
			// 		)

			// 	[Total] => Array
			// 		(
			// 			[0] => 0 Jam 0 Menit
			// 			[1] => 0 Jam 0 Menit
			// 		)

			// )





		$data = $_SESSION['data_cetak'];

		$this->load->view('sgt/spl/v_cetak.php',$data);
	}

	

	function cetak_ulang(){
			// print_r($_POST);

			// Array
			// (
			// 	[cbId] => Array
			// 		(
			// 			[0] => 36
			// 			[1] => 41
			// 			[2] => 47
			// 			[3] => 45
			// 			[4] => 34
			// 			[5] => 17
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

			// 	[cbBagian] => Array
			// 		(
			// 			[0] => CONVERTING
			// 			[1] => CONVERTING
			// 			[2] => EMBOSS
			// 			[3] => EMBOSS
			// 			[4] => EMBOSS
			// 			[5] => FINISHING
			// 		)

			// 	[cbNama] => Array
			// 		(
			// 			[0] => Cholid Muchoyyar
			// 			[1] => Cholid Muchoyyar
			// 			[2] => Wijanarko
			// 			[3] => Muhtadi
			// 			[4] => Kamal Yazid
			// 			[5] => Catur Indah Fitriyani
			// 		)

			// 	[cbMulai] => Array
			// 		(
			// 			[0] => 24-11-2020 13:30
			// 			[1] => 27-11-2020 14:28
			// 			[2] => 23-11-2020 09:58
			// 			[3] => 23-11-2020 15:32
			// 			[4] => 27-11-2020 15:30
			// 			[5] => 16-11-2020 09:44
			// 		)

			// 	[cbSelesai] => Array
			// 		(
			// 			[0] => 24-11-2020 20:30
			// 			[1] => 27-11-2020 14:29
			// 			[2] => 24-11-2020 09:58
			// 			[3] => 24-11-2020 15:32
			// 			[4] => 27-11-2020 19:30
			// 			[5] => 18-11-2020 09:44
			// 		)

			// 	[cbTujuan] => Array
			// 		(
			// 			[0] => aaaaa
			// 			[1] => aaaaa
			// 			[2] => hjhkhjhk
			// 			[3] => xxxxx
			// 			[4] => Pemenuhan kirim
			// 			[5] => test
			// 		)

			// 	[cbStatus] => Array
			// 		(
			// 			[0] => pengajuan
			// 			[1] => pengajuan
			// 			[2] => pengajuan
			// 			[3] => pengajuan
			// 			[4] => pengajuan
			// 			[5] => pengajuan
			// 		)
			// )

		$dataPilih = $this->input->POST('cbPilih');
		$dataBagian = $this->input->POST('cbBagian');
		$dataNama = $this->input->POST('cbNama');
		$dataMulai = $this->input->POST('cbMulai');
		$dataSelesai = $this->input->POST('cbSelesai');
		$dataTujuan = $this->input->POST('cbTujuan');
		$dataStatus = $this->input->POST('cbStatus');
		
		$dataX['bagian'] = array();
		$dataX['nama'] = array();
		$dataX['mulai'] = array();
		$dataX['selesai'] = array();
		$dataX['tujuan'] = array();
		$dataX['status'] = array();

		for ($i=0; $i < count($dataPilih); $i++) { 
			if ($dataPilih[$i] == 'T') {
					//tampung data
				array_push($dataX['bagian'],$dataBagian[$i]);
				array_push($dataX['nama'],$dataNama[$i]);
				array_push($dataX['mulai'],$dataMulai[$i]);
				array_push($dataX['selesai'],$dataSelesai[$i]);
				array_push($dataX['tujuan'],$dataTujuan[$i]);
				array_push($dataX['status'],$dataStatus[$i]);
			}
		}

		$this->load->view('sgt/spl/v_cetak_ulang.php',$dataX);
	}
	
}
?>