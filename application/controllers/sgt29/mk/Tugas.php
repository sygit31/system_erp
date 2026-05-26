<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tugas extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_karyawan');
		$this->load->model('sgt/M_sis_project');
		$this->load->model('sgt/M_tugas');
		$this->load->model('sgt/M_tugas_parameter');

		session_start();
	}

	function index()
	{
		$CRE = explode('|', $_SESSION['logERP']);
		$data['IdKaryawan'] = $CRE[0];
		$data['DaftarKaryawan'] = $this->M_karyawan->getAllKaryawanByIdBagian($data['IdKaryawan']);
		// $data['DaftarProject'] = $this->M_sis_project->getProjectOpen();
		$data['DaftarProject'] = $this->M_sis_project->getProjectOpenByIdBagianVerDept($data['IdKaryawan']);
		$data['DaftarStruktural'] = $this->M_karyawan->getAllKaryawanByIdBagianVerdeptStruktur($data['IdKaryawan']);

		$this->load->view('sgt/mk/v_tugas.php', $data);
	}


	public function simpan()
	{
		// print_r($_POST);

		// Array ( 
		// 	[tanggalAwal] => 24-03-2020 
		// 	[tanggalAkhir] => 25-03-2020 
		// 	[cmbTipe] => 28 
		// 	[cmbPIC] => 28 
		// 	[cmbKaryawan] => 302 
		// 	[txtTugas] => aaaaa 
		// 	[txtTarget] => 11 
		// 	[txtNilai] => 3 
		//	------------------------------------------------------
		// 	[txtParameter] => Array (
		// 					 		[0] => ffff 
		// 							[1] => gggg 
		// 						) 
		// 	[txtProgres] => Array ( 
		// 							[0] => 10 
		// 							[1] => 90 
		// 						) 
		// )

		$data['tanggal_awal'] = $this->input->post('tanggalAwal');
		$data['tanggal_akhir'] = $this->input->post('tanggalAkhir');
		$getProject = $this->input->post('cmbTipe');
		$getProjectS = explode("-", $getProject);
		$data['project'] = $getProjectS[0];
		$data['pic'] = $this->input->post('cmbPIC');
		$data['karyawan'] = $this->input->post('cmbKaryawan');
		$data['tugas'] = $this->input->post('txtTugas');
		$data['target'] = $this->input->post('txtTarget');
		$data['nilai'] = $this->input->post('txtNilai');
		$data['nilai_app'] = '0';
		$data['status'] = 'usul';

		$parameters = $this->input->post('txtParameter');
		$progress = $this->input->post('txtProgres');

		$succes = true;

		try {
			$succes =  $this->M_tugas->save($data);
		} catch (Exception $e) {
			$succes = false;
			$_SESSION['pesan'] .= '<font color="red">Data gagal disimpan!!!! <br /> Hubungi Programmer Segera</font><br />';
		}

		if ($succes) {
			for ($i = 0; $i < count($parameters); $i++) {
				$dataDetail['parameter'] = $parameters[$i];
				$dataDetail['progres'] = $progress[$i];

				try {
					if ($succes) {
						$succes =  $this->M_tugas_parameter->save($dataDetail);

						if (!$succes) {
							$_SESSION['pesan'] .= '<font color="red">Parameter gagal disimpan!!!! <br /> Hubungi Programmer Segera</font><br />';
						}
					}
				} catch (Exception $e) {
					$succes = false;
					$_SESSION['pesan'] .= '<font color="red">Parameter gagal disimpan!!!! <br /> Hubungi Programmer Segera</font><br />';
				}
			}
		} else {
			$_SESSION['pesan'] .= '<font color="red">Data gagal disimpan!!!! <br /> Hubungi Programmer Segera</font><br />';
		}


		if ($succes) {
			$_SESSION['pesan'] .= '<font color="blue">Berhasil disimpan</font>';
		}

		print_r("<meta http-equiv='refresh' content='0; url=" . base_url() . "index.php/sgt/mk/tugas'>");
	}
}
