<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ijin_invest extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_master_invest');
		$this->load->model('sgt/M_master_departemen');
		session_start();
	}

	
	function index()
	{
		$data['data_unit'] = $this->M_master_departemen->getUnit();	
		$data['data_invest'] = $this->M_master_invest->getInvestJoin();	

		$this->load->view('sgt/cc/v_ijin_invest.php',$data);
	}
	
	function simpan()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[txtTanggal] => 22-12-2020
		// 	[txtNoProposal] => ccccccccccc
		// 	[txtNoSuratIjin] => bbbbbbbbb
		// 	[txtJenisInvest] => aaaaaaaaaaaa
		// 	[txtJumlah] => 4
		// 	[txtBiaya] => 33.444
		// 	[cmbPengajuanUnit] => Holo I@4A
		// 	[cmbPengajuanDepartemen] => 29
		// 	[cmbPemohonUnit] => Holo II@5A
		// 	[cmbPemohonDepartemen] => 13
		// )

		$data['KODE_INVEST'] = $this->input->post('txtNoProposal');
		$data['NOMOR_IJIN_INVEST'] = $this->input->post('txtNoSuratIjin');
		$data['JENIS_INVEST'] = $this->input->post('txtJenisInvest');
		$data['JUMLAH'] = $this->input->post('txtJumlah');
		$data['DIAJUKAN_OLEH'] = $this->input->post('cmbPengajuanDepartemen');
		$data['RENCANA_BIAYA'] = str_replace(".","",$this->input->post('txtBiaya'));
		$data['PEMOHON'] = $this->input->post('cmbPemohonDepartemen');
		$data['TANGGAL_IJIN_INVEST'] = $this->input->post('txtTanggal');

		$success = $this->M_master_invest->save($data);	

		if ($success) {
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			redirect('sgt/cc/ijin_invest', "refresh");
		}else{
			echo " Penyimpanan Ijin Invest Error!!!!";
		}
	}

	


}

?>