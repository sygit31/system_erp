<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_akun extends CI_Controller{
	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('M_akses');
		$this->load->model('M_bagian');
		$this->load->model('M_karyawan');
		$this->load->model('M_akun');
		session_start();
	}
	
	function index()
	{
		$data['hak_akses'] = $this->M_akses->getAllAkses();
		$data['dBagian'] = $this->M_bagian->getAllBagian();
		$data['dKaryawan'] = $this->M_karyawan->getAllKaryawan();
		
		$this->load->view('administrator/v_kelola_akun.php',$data);
	}

	public function edit()
	{
	 		// print_r($_POST);
		$akses = array('ID_AKUN'=>$this->input->post('txtIdAkun'),'A'=>'0','B'=>'0','C'=>'0','D'=>'0','E'=>'0','F'=>'0','G'=>'0','H'=>'0','I'=>'0','J'=>'0','K'=>'0','L'=>'0','M'=>'0','N'=>'0','O'=>'0','P'=>'0','Q'=>'0','R'=>'0','S'=>'0','T'=>'0','U'=>'0','V'=>'0');

		$TempHakAkses = $this->input->post('HakAkses');
		foreach($TempHakAkses as $value){
	 			// print_r($value . "<br />");
			if ($value == 'cbGudang') {$akses['A']='1';}
			if ($value == 'cbGudang_Penerimaan') {$akses['A']='1';$akses['B']='1';}
			if ($value == 'cbGudang_Stok') {$akses['A']='1';$akses['C']='1';}
			if ($value == 'cbGudang_Reject') {$akses['A']='1';$akses['D']='1';}
			if ($value == 'cbGudang_Pengeluaran') {$akses['A']='1';$akses['E']='1';}
			if ($value == 'cbGudang_Laporan') {$akses['A']='1';$akses['F']='1';}
			if ($value == 'cbGudang_Laporan_MutasiPET') {$akses['A']='1';$akses['F']='1';$akses['G']='1';}

			if ($value == 'cbPembelian') {$akses['H']='1';}
			if ($value == 'cbPembelian_Outstanding') {$akses['H']='1';$akses['I']='1';}

			if ($value == 'cbQc') {$akses['J']='1';}
			if ($value == 'cbQc_Master') {$akses['J']='1';$akses['K']='1';}
			if ($value == 'cbQc_Master_Parameter') {$akses['J']='1';$akses['K']='1';$akses['L']='1';}
			if ($value == 'cbQc_Master_TestRequirement') {$akses['J']='1';$akses['K']='1';$akses['M']='1';}
			if ($value == 'cbQc_Cek') {$akses['J']='1';$akses['N']='1';}
			if ($value == 'cbQc_Cetak') {$akses['J']='1';$akses['W']='1';}
			if ($value == 'cbQc_LaporanQc') {$akses['J']='1';$akses['O']='1';}
			if ($value == 'cbQc_LaporanQc_Test') {$akses['J']='1';$akses['O']='1';$akses['S']='1';}

			if ($value == 'cbKinerja') {$akses['P']='1';}

			if ($value == 'cbRnD') {$akses['T']='1';}
			if ($value == 'cbRnD_SetMesin') {$akses['T']='1';$akses['U']='1';}
			if ($value == 'cbRnD_SetFormula') {$akses['T']='1';$akses['V']='1';}

			if ($value == 'cbAdministrator') {$akses['Q']='1';}
			if ($value == 'cbAdministrator_KelolaAkun') {$akses['Q']='1';$akses['R']='1';}
		}

			// print_r($akses);
		$success = true;
		$success = $this->M_akses->edit($akses);
		
		if($success){
				// $this->index();
				// redirect($this->index(), 'refresh');
				// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/administrator/kelola_akun'>");

			$_SESSION['pesan']='<font color="blue">Berhasil di edit</font>';
			redirect('administrator/kelola_akun', "activetab");

		}else{
			echo "error";
			exit();
		}
	}


	public function save()
	{
	 		// print_r($_POST);
		
	 		// cek apakah sudah ada akun ini
		$id_karyawan = $this->input->post('cmbKaryawan');
		$TmpKaryawan = $this->M_karyawan->getKaryawanById($id_karyawan);
		$akun = $this->M_akun->getAkun($id_karyawan);

		if ($akun == 0) {
			$nama = $TmpKaryawan->NAMA;

			$dataAkun['username'] = substr(strtolower($nama),0,10);
			$dataAkun['password'] = md5('holografi');
			$dataAkun['id_karyawan'] = $id_karyawan;

			$success = true;
			$success = $this->M_akun->simpan($dataAkun);

			
			if ($success) {
				$akses = array('A'=>'0','B'=>'0','C'=>'0','D'=>'0','E'=>'0','F'=>'0','G'=>'0','H'=>'0','I'=>'0','J'=>'0','K'=>'0','L'=>'0','M'=>'0','N'=>'0','O'=>'0','P'=>'0','Q'=>'0','R'=>'0','S'=>'0','T'=>'0','U'=>'0','V'=>'0','W'=>'0');

				$TempHakAkses = $this->input->post('HakAksesAdd');
				if (isset($TempHakAkses)) {
		 				// print_r("ada akses");
					foreach($TempHakAkses as $value){
						if ($value == 'cbGudangAdd') {$akses['A']='1';}
						if ($value == 'cbGudang_PenerimaanAdd') {$akses['A']='1';$akses['B']='1';}
						if ($value == 'cbGudang_StokAdd') {$akses['A']='1';$akses['C']='1';}
						if ($value == 'cbGudang_RejectAdd') {$akses['A']='1';$akses['D']='1';}
						if ($value == 'cbGudang_PengeluaranAdd') {$akses['A']='1';$akses['E']='1';}
						if ($value == 'cbGudang_LaporanAdd') {$akses['A']='1';$akses['F']='1';}
						if ($value == 'cbGudang_Laporan_MutasiPETAdd') {$akses['A']='1';$akses['F']='1';$akses['G']='1';}

						if ($value == 'cbPembelianAdd') {$akses['H']='1';}
						if ($value == 'cbPembelian_OutstandingAdd') {$akses['H']='1';$akses['I']='1';}

						if ($value == 'cbQcAdd') {$akses['J']='1';}
						if ($value == 'cbQc_MasterAdd') {$akses['J']='1';$akses['K']='1';}
						if ($value == 'cbQc_Master_ParameterAdd') {$akses['J']='1';$akses['K']='1';$akses['L']='1';}
						if ($value == 'cbQc_Master_TestRequirementAdd') {$akses['J']='1';$akses['K']='1';$akses['M']='1';}
						if ($value == 'cbQc_CekAdd') {$akses['J']='1';$akses['N']='1';}
						if ($value == 'cbQc_CetakAdd') {$akses['J']='1';$akses['W']='1';}
						if ($value == 'cbQc_LaporanQcAdd') {$akses['J']='1';$akses['O']='1';}
						if ($value == 'cbQc_LaporanQc_TestAdd') {$akses['J']='1';$akses['O']='1';$akses['S']='1';}

						if ($value == 'cbKinerjaAdd') {$akses['P']='1';}

						if ($value == 'cbRnDAdd') {$akses['T']='1';}
						if ($value == 'cbRnD_SetMesinAdd') {$akses['T']='1';$akses['U']='1';}
						if ($value == 'cbRnD_SetFormulaAdd') {$akses['T']='1';$akses['V']='1';}


						if ($value == 'cbAdministratorAdd') {$akses['Q']='1';}
						if ($value == 'cbAdministrator_KelolaAkunAdd') {$akses['Q']='1';$akses['R']='1';}
					}
				}

				$success = $this->M_akses->save($akses);
				
				if ($success) {
					$_SESSION['pesan']='<font color="blue">Berhasil di Simpan</font><p />Username : '. $dataAkun['username']. '<br />Password : holografi<p /><font color="red">Segera Ubah Username dan Password!!!</font>';
					redirect('administrator/kelola_akun', "refresh");
				}else{
		 				//gagal simpan akses
					echo "error";
					exit();
				}
			}else{
					//gagal buat akun
				echo "error";
				exit();
			}
		}else{
	 			//sudah ada akun
			$_SESSION['pesan']= '<font color="red">'.$TmpKaryawan->NAMA. ' Sudah Ada Akun</font>';
			redirect('administrator/kelola_akun', "refresh");
		}
	}

}
?>