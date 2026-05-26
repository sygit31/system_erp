<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirim_waste extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_waste_tdk_standar');
		$this->load->model('sgt/M_kirim_waste');
		$this->load->model('sgt/M_kirim_waste_detail');
		
		session_start();
	}
	
	function index(){
		$data['data_stok'] = $this->M_waste_tdk_standar->get_stok_waste();
		
		$this->load->view('sgt/umum/v_kirim_waste.php',$data);
		// print_r($data['nextval']);
	}

	function simpan(){
		// print_r($_POST);
		// Array
		// (
		// 	[txtNoKirim] => KRMW-6737
		// 	[tanggal] => 23-09-2022
		// 	[txtNoSP] => 123456
		// 	[cbNoUrutWaste] => Array
		// 		(
		// 			[0] => 1202205@31-05-2022@A@33,75@BJ-2022-001@A-25516
		// 			[1] => 1202206@30-06-2022@A@18,8@BJ-2022-001@A-25518
		// 			[2] => 1202207@31-07-2022@C@83,65@BJ-2022-001@B-25517
		// 		)
		// )

		$ArrNoSppJenis = array();
		$ArrData = $this->input->post('cbNoUrutWaste');
		//collect nomer spp & jenis
		for ($i=0; $i < count($ArrData); $i++) { 
			$ArrDataSplit = explode("@",$ArrData[$i]);
			if (!in_array(array($ArrDataSplit[0],$ArrDataSplit[2]), $ArrNoSppJenis)){
				array_push($ArrNoSppJenis,array($ArrDataSplit[0],$ArrDataSplit[2]));
			}
		}

		//looping $ArrNoSppJenis dan total jumlah kemudian simpan
		$jumlah_kirim = 0;
		for ($x=0; $x < count($ArrNoSppJenis); $x++) { 
			$data = array();
			$data['NO_URUT'] = $this->M_kirim_waste->nextval();
			$data['NO_URUT_KIRIM'] = 'KRMW-'.$data['NO_URUT'];
			$data['TGL_KIRIM'] = $this->input->post('tanggal');
			// $data['NOMOR_SP_KIRIMAN'] = $this->input->post('txtNoSP');
			$data['NOMOR_SP_KIRIMAN'] = '';
			$data['JENIS'] = 'NON STANDAR';
			

			for ($y=0; $y < count($ArrData); $y++) { 
				$ArrDataSplit = explode("@",$ArrData[$y]);
				//jika no_spp dan jenis waste sama ditotal jumlahnya
				if($ArrDataSplit[0] == $ArrNoSppJenis[$x][0] && $ArrDataSplit[2] == $ArrNoSppJenis[$x][1]){
					$jumlah_kirim += str_replace(',', '.', $ArrDataSplit[3]);
				
					$data['NO_SPP'] = $ArrDataSplit[0];
					$data['TGL_DELTIME_SPP'] = $ArrDataSplit[1];
					$data['JENIS_WASTE'] = $ArrDataSplit[2];
					$data['KODE_BAHAN'] = $ArrDataSplit[4];

					
					// =======================================
					$KODE_WASTE = $ArrDataSplit[5];

					//simpan TBL_KIRIM_WASTE_DETAIL
					$dataDetail['ID']=$this->M_kirim_waste_detail->nextval();
					$dataDetail['NO_URUT_KIRIM']=$data['NO_URUT_KIRIM'];
					$dataDetail['KODE_WASTE']=$KODE_WASTE;
					$this->M_kirim_waste_detail->save($dataDetail);

					//update flag di waste_tdk_standar
					$this->M_waste_tdk_standar->non_aktif($KODE_WASTE);
				}
			}

			// print_r($ArrNoSppJenis[$x][0] .'->'.$ArrNoSppJenis[$x][1].'->'.$jumlah_kirim.'<br/>');
			$data['JUMLAH_KIRIM'] = $jumlah_kirim;
			// print_r($data);

			//simpan
			// $this->M_kirim_waste->save($data);

			$jumlah_kirim = 0;
		}

		// -// -// //update flag di waste_tdk_standar
		// // // for ($z=0; $z < count($ArrData); $z++) { 
		// // // 	$ArrDataSplit = explode("@",$ArrData[$z]);
		// // // 	$KODE_WASTE = $ArrDataSplit[5];

		// // // 	$this->M_waste_tdk_standar->non_aktif($KODE_WASTE);
		// // // 	// print_r($KODE_WASTE.'<br />');
		// // // }

	}
	


}
?>