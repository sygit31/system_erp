<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_tugas');
		$this->load->model('sgt/M_tugas_parameter');
		$this->load->model('sgt/M_tugas_monitoring');
		
		session_start();
	}
	
	function index(){
		$data['dataTugas'] = $this->M_tugas->getTugasByStatus('acc');
		$data['dataParameter'] = $this->M_tugas_parameter->getTugasParameterByStatusTugasNDate('acc');

		$this->load->view('sgt/mk/v_monitoring.php',$data);
	}

	
	function simpan(){
			// print_r($_POST);
			// Array ( 
			//  [txtIdTugas] => 1
			//  [txtStatus] => close
			// 	[dmTanggal] => 12/02/2020 
			// 	[txtBagian] => IT [txtNama] => Rifki Ovta Pianus 
			// 	[txtPIC] => Emmanuel Vanny 
			// 	[txtProject] => Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar) 
			// 	[txtTugas] => Instalasi Server 
			// 	[txtProgres] => Array ( 
			// 		[0] => 100 
			// 		[1] => 30 
			// 		[2] => 100 
			// 	) 
			// 	[txtCatatans] => Array ( 
			// 		[0] => Sudah 
			// 		[1] => Baru proses penarikan 
			// 		[2] => Sudah 
			// 	) 
			// 	[txtIdTugasParameter] => Array ( 
			// 		[0] => 19 
			// 		[1] => 20 
			// 		[2] => 18 
			// 	) 
			// )

		$idTugas = $this->input->POST('txtIdTugas');	
		$status = $this->input->POST('txtStatus');	
		$tanggal = $this->input->POST('dmTanggal');	

		$idTugasParameters = $this->input->post('txtIdTugasParameter');
		$progress = $this->input->post('txtProgress');
		$catatans = $this->input->post('txtCatatans');

		$success = true;
		for ($i=0; $i < count($idTugasParameters); $i++) { 
			if ($success) {
				$data['id']=$idTugasParameters[$i];
				$data['progres']=$progress[$i];
				$data['catatan']=$catatans[$i];
				$data['tanggal']=$tanggal;
				$data['progres']!==''?$success=$this->M_tugas_monitoring->save($data):'';
			}
		}

		if ($success) {
			$_SESSION['pesan'] .= '<font color="blue">Berhasil disimpan</font>';
		}else{
			$_SESSION['pesan'] .= '<font color="red">Data gagal disimpan!!!! <br /> Hubungi Programmer Segera</font><br />';
		}

			//JIKA STATUS CLOSE MAKA TUTUP TUGAS	
		$status=='close'?$this->M_tugas->updateStatus($idTugas,$status):'';		
		
		print_r("<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/sgt/mk/monitoring'>");
	}

}
?>