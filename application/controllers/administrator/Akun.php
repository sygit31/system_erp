<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('administrator/M_akun');
		session_start();
	}

	function index() {
		$id_akun='';
		$data['akses'] = $this->M_akun->get_akses($id_akun);
		$data['akun'] = $this->M_akun->show_akun();	       	
		$data['karyawan'] = $this->M_akun->show_karyawan();	       	
		$this->load->view('administrator/v_akun.php',$data);
	}

	function get_akses() {  	
		$id_akun = $this->input->post('data');
		$data['akses'] = $this->M_akun->get_akses($id_akun);       	
		$this->load->view('administrator/v_akun_akses.php',$data);
	}

	function filter_akun() {
		$cari = strtoupper($this->input->post('data'));
		$data['akun'] = $this->M_akun->filter_akun($cari);      	
		$this->load->view('administrator/v_akun_table.php',$data);
	}

	function simpan_akses() {  	
		$data = $this->input->post('data');
		$id_akun = $data[0];

		for ($i=0; $i<count($data[1]); $i++) {
			$id_menu_detail = $data[1][$i];
			$id_adm_akses = $data[2][$i];
			if ($data[3][$i] == 'false') {
				$status = '0';
			}else{
				$status = $data[4][$i];
			}

			if ($id_adm_akses == '') {
				$id_adm_akses = $this->M_akun->urut_adm_akses();

				if ($status == '1') {
					$this->M_akun->simpan_akses($id_adm_akses,$id_akun,$id_menu_detail,$status);
				}
			}else{
				$this->M_akun->update_akses($id_adm_akses,$id_akun,$id_menu_detail,$status);			
			}
		}
	}

	function show_menu() {
		$id_akun = $this->input->post('data');
		$menu = $this->M_akun->show_menu($id_akun);
		print_r(json_encode($menu));
	}

	function simpan_akun() {  	
		$data = $this->input->post('data');
		$username = $data[0];
		$password = md5("holografi");
		$id_karyawan = $data[1];
		$this->M_akun->simpan_akun($username,$password,$id_karyawan);
	}

}

?>