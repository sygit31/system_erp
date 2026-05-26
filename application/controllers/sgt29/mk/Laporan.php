<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_tugas');
		$this->load->model('sgt/M_tugas_monitoring');

		session_start();
	}

	function index()
	{
		$CRE = explode('|', $_SESSION['logERP']);
		$IdKaryawan = $CRE[0];
		$data['DataTugas'] = $this->M_tugas->getTugasanByIdKaryawanStatus($IdKaryawan, 'acc');

		$this->load->view('sgt/mk/v_laporan.php',$data);
	}
	

	function getTugas()
	{
		$id_tugas = $this->input->POST('id_tugas');

		$monitorings = $this->M_tugas_monitoring->getMonitoringByIdTugas($id_tugas);

		$xTanggal = array();
		$xMonitorings = array();
		foreach($monitorings as $row){
			array_push($xTanggal, $row->TANGGAL);

			$dMonitorings = $this->M_tugas_monitoring->getMonitoringByIdTugasDANtanggal($id_tugas,$row->TANGGAL);
			array_push($xMonitorings, $dMonitorings);
		}

		$data = array($xTanggal,$xMonitorings);

		print_r(json_encode($data));
	}


}
