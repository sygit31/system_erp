<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class Login extends CI_Controller
	{
				/**
		 * Index Page for this controller.
		 *
		 * Maps to the following URL
		 * 		http://example.com/index.php/welcome
		 *	- or -
		 * 		http://example.com/index.php/welcome/index
		 *	- or -
		 * Since this controller is set as the default controller in
		 * config/routes.php, it's displayed at http://example.com/
		 *
		 * So any other public methods not prefixed with an underscore will
		 * map to /index.php/welcome/<method_name>
		 * @see https://codeigniter.com/user_guide/general/urls.html
		 */
				public function __construct()
				{
					parent::__construct();

			// if ($this->session->userdata('SESS_AKUN_IS_LOGIN') && $this->session->userdata('SESS_AKUN_USER_PRIV') === 1) {
			// 	redirect(base_url('akun/dashboard'));
			// }
					
					$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
					$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
					$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
					$this->output->set_header('Pragma: no-cache');
					$this->load->model('M_akun');
			// $this->load->model('M_karyawan42');
					$this->load->model('M_karyawan');
					$this->load->model('M_akses');
					session_start();
			// $this->load->library('Userauth');
				}

				

				public function index()
				{
					$this->load->view('v_login.php');
				}


				public function cek_login(){
			// print_r($_POST);
					$data = array();
					$data['username'] = $this->input->post("username");
					$data['password'] = $this->input->post("password");
					$akun = $this->M_akun->login($data);
					if($akun != null){
				// $TampungKaryawan = $this->M_karyawan42->getKaryawanById($akun->ID_KARYAWAN);
						$TampungKaryawan = $this->M_karyawan->getKaryawanById($akun->ID_KARYAWAN);
						$TampungAkses = $this->M_akses->getAkses($akun->ID);
						$cre=$akun->ID_KARYAWAN."|".$TampungKaryawan->NAMA;
						$akses = array('_A' => $TampungAkses[0]->A,'_B' => $TampungAkses[0]->B,'_C' => $TampungAkses[0]->C,'_D' => $TampungAkses[0]->D,'_E' => $TampungAkses[0]->E,'_F' => $TampungAkses[0]->F,'_G' => $TampungAkses[0]->G,'_H' => $TampungAkses[0]->H,'_I' => $TampungAkses[0]->I,'_J' => $TampungAkses[0]->J,'_K' => $TampungAkses[0]->K,'_L' => $TampungAkses[0]->L,'_M' => $TampungAkses[0]->M,'_N' => $TampungAkses[0]->N,'_O' => $TampungAkses[0]->O,'_P' => $TampungAkses[0]->P,'_Q' => $TampungAkses[0]->Q,'_R' => $TampungAkses[0]->R,'_S' => $TampungAkses[0]->S,'_T' => $TampungAkses[0]->T,'_U' => $TampungAkses[0]->U,'_V' => $TampungAkses[0]->V,'_W' => $TampungAkses[0]->W,'_X' => $TampungAkses[0]->X,'_Y' => $TampungAkses[0]->Y,'_Z' => $TampungAkses[0]->Z,'_AA' => $TampungAkses[0]->AA,'_AB' => $TampungAkses[0]->AB,'_AC' => $TampungAkses[0]->AC,'_AD' => $TampungAkses[0]->AD,'_AE' => $TampungAkses[0]->AE,'_AF' => $TampungAkses[0]->AF,'_AG' => $TampungAkses[0]->AG,'_AH' => $TampungAkses[0]->AH,'_AI' => $TampungAkses[0]->AI,'_AJ' => $TampungAkses[0]->AJ,'_AK' => $TampungAkses[0]->AK,'_AL' => $TampungAkses[0]->AL,'_AM' => $TampungAkses[0]->AM,'_AN' => $TampungAkses[0]->AN,'_AO' => $TampungAkses[0]->AO,'_AP' => $TampungAkses[0]->AP,'_AQ' => $TampungAkses[0]->AQ,'_AR' => $TampungAkses[0]->AR,'_AT' => $TampungAkses[0]->AT,'_AU' => $TampungAkses[0]->AU,'_AV' => $TampungAkses[0]->AV,'_AW' => $TampungAkses[0]->AW,'_AX' => $TampungAkses[0]->AX,'_AY' => $TampungAkses[0]->AY,'_AZ' => $TampungAkses[0]->AZ);
						
						$_SESSION['logERP']=$cre;
						$_SESSION['logAkses']=$akses;
						$_SESSION['pesan']='';

				// print_r($akun);
						echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/dashboard'>";

				// require('dashboard.php');
				// $dashboard = new dashboard();
				// $dashboard->load->view('v_dashboard.php');
					}else{
				// exit();
						echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php'>";
					}
				}


				public function logout()
				{
					unset($_SESSION['logERP']);
					unset($_SESSION['logAkses']);
					unset($_SESSION['pesan']);
					echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php'>";
				}

				

			}
			?>