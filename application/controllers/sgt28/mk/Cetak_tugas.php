<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_tugas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_tugas');

		session_start();
	}

	function index()
	{
		$CRE = explode('|', $_SESSION['logERP']);
		$IdKaryawan = $CRE[0];
		$data['DataUsulan'] = $this->M_tugas->getTugasanByIdKaryawanStatus($IdKaryawan, 'usul');

		$this->load->view('sgt/mk/v_cetak_tugas.php', $data);
	}


	function cetak()
	{
		// print_r($_POST);
		// Array ( 
		//     [example2_length] => 10 
		//     [cbCetak] => Array ( 
		//         [0] => IT@Abdullah Ibnu Hasan@Emmanuel Vanny@Tugas Pokok@Maintenance CCTV@100@3 
		//         [1] => IT@Rifki Ovta Pianus@Emmanuel Vanny@Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar)@Memasang Jaringan@100@5 
		//         [2] => SISTEM@Daud Parabang@Jumadi@Barcode stamping s/d finishings@aaaa@11@1 
		//     ) 
		// )

		$TempCetak = $this->input->POST('cbCetak');

		if (isset($TempCetak)) {
			$data['cetak'] = array();
			foreach ($TempCetak as $key => $value) {
				$dataLabel =  explode("@", $value);
				array_push($data['cetak'], $dataLabel);
			}

			// print_r($data);
			// Array ( 
			//  	[cetak] => Array ( 
			// 		[0] => Array ( 
			// 			[0] => IT 
			// 			[1] => Rifki Ovta Pianus 
			// 			[2] => Emmanuel Vanny 
			// 			[3] => Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar) 
			// 			[4] => Memasang Jaringan 
			// 			[5] => 100 
			// 			[6] => 5 
			// 		) 
			// 		[1] => Array ( 
			// 			[0] => SISTEM 
			// 			[1] => Daud Parabang 
			// 			[2] => Jumadi 
			// 			[3] => Barcode stamping s/d finishings 
			// 			[4] => aaaa 
			// 			[5] => 11 
			// 			[6] => 1 
			// 		) 
			// 	) 
			// )

			$this->load->view('sgt/mk/cetak_tugas.php', $data);
		} else {
			print_r("<h1>Tidak ada data yang dipilih</h1>");
		}
	}
}
