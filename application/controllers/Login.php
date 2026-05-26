<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller {

		public function __construct() {
			parent::__construct();			
			$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
			$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
			$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
			$this->output->set_header('Pragma: no-cache');
			$this->load->model('M_akun');
			$this->load->model('M_karyawan');
			$this->load->model('M_akses');
			session_start();
			
			$this->load->model('administrator/M_log');
		}       	

		public function index()	{
			$this->load->view('v_login.php');
		}

		public function cek_login() {
			$data = array();
			$data['username'] = $this->input->post("username");
			$data['password'] = $this->input->post("password");
			$akun = $this->M_akun->login($data);
			if($akun != null){
				$TampungKaryawan = $this->M_karyawan->getKaryawanById($akun->ID_KARYAWAN);
				$TampungAkses = $this->M_akses->getAkses($akun->ID);
				$cre=$akun->ID_KARYAWAN."|".$TampungKaryawan->NAMA;
				$_SESSION['logERP']=$cre;
				$_SESSION['pesan']='';
				$_SESSION['cetak']='';
				$_SESSION['id_akun']=$akun->ID;

				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/dashboard'>";

				$this->M_log->simpan_log($_SESSION['id_akun']);
			}else{
				echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php'>";
			}
		}

		public function logout() {
			unset($_SESSION['logERP']);
			unset($_SESSION['logAkses']);
			unset($_SESSION['pesan']);
			unset($_SESSION['cetak']);
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php'>";
		}

	}
?>