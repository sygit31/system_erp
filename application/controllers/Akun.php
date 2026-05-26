<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	    //Codeigniter : Write Less Do More
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('M_akun');
		session_start();
	}
	
	function index()
	{
		$this->load->view('v_akun.php');
	}

	function update()
	{
		$id_karyawan = $this->input->post("txtIDkaryawan");
		$userBaru = $this->input->post("txtUserBaru");
		$pass1 = $this->input->post("txtPassBaru1");
		$pass2 = $this->input->post("txtPassBaru2");
		$pass = $this->input->post("txtPass");

		$data = array();
		$data['id_karyawan'] = $id_karyawan;
		$data['password'] = $pass;
		$user = $this->M_akun->getData($data);
		if($user != null){
				// ubah user
			if ($userBaru != "") {
				$data['id'] = $user->ID;
				$data['userbaru'] = $userBaru;
				$this->M_akun->UpdateUser($data);
			}

				// ubah password
			if ($pass1 != "") {
				$data['id'] = $user->ID;
				$data['password'] = $pass1;
				$this->M_akun->UpdatePass($data);
			}

				// berhasil update dan login lagi untuk membuat credential baru
			echo "<script type='text/javascript'>alert('Data berhasil diubah, Silahkan Login kembali');</script>";
			echo "<meta http-equiv='refresh' content='0; url=".site_url('login/logout')."'>";
		}else{
				// data tidak ada
				// $this->index();
			print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/akun'>");
			echo "<script type='text/javascript'>alert('Password Salah!');</script>";
		}
	}

}
?>