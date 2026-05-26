<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak_monitoring extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_tugas');
		$this->load->model('sgt/M_tugas_parameter');
		
		session_start();
	}
	
	function index(){
		$data['dataTugas'] = $this->M_tugas->getTugasByStatus('acc');

		$this->load->view('sgt/mk/v_cetak_monitoring.php',$data);
	}

	
	function cetak(){
			// print_r($_POST);
			// Array ( 
			// 	[example2_length] => 10 
			// 	[cbCetak] => Array ( 
			// 		[0] => 15@IT@Abdullah Ibnu Hasan@Emmanuel Vanny@Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar)@Memasang CCTV@100@3 
			// 		[1] => 16@IT@Rifki Ovta Pianus@Emmanuel Vanny@Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar)@Instalasi Server@100@4
			// 	) 
			// )

		$TempCetak = $this->input->POST('cbCetak');

		if (isset($TempCetak)) {
			$data['cetak'] = array();
			$id_tugas = ''	;

			foreach ($TempCetak as $key => $value) {
				$dataLabel =  explode("@", $value);
				array_push($data['cetak'],$dataLabel);
				$id_tugas .= $dataLabel[0].",";
			}
			$id_tugas = substr($id_tugas, 0, -1);
			
				// print_r($data);
				// Array ( 
				// 	[cetak] => Array ( 
				// 		[0] => Array ( 
				// 			[0] => 15 
				// 			[1] => IT 
				// 			[2] => Abdullah Ibnu Hasan 
				// 			[3] => Emmanuel Vanny 
				// 			[4] => Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar) 
				// 			[5] => Memasang CCTV 
				// 			[6] => 100 
				// 			[7] => 3 
				// 		) 
				// 		[1] => Array ( 
				// 			[0] => 16 
				// 			[1] => IT
				// 			[2] => Rifki Ovta Pianus 
				// 			[3] => Emmanuel Vanny 
				// 			[4] => Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar) 
				// 			[5] => Instalasi Server 
				// 			[6] => 100 
				// 			[7] => 4 
				// 		) 
				// 	) 
				// )
			
			$data['dataParameter'] = $this->M_tugas_parameter->getTugasParameterByIdTugas($id_tugas);

			$this->load->view('sgt/mk/cetak_monitoring.php',$data);
		}else{
			print_r("<h1>Tidak ada data yang dipilih</h1>");
		}
	}
	

}
?>