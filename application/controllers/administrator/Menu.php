<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('administrator/M_menu');
		session_start();
	}

	function index()
	{  	
		$data['menu'] = $this->M_menu->show_menu();	       	
		$data['akses'] = $this->M_menu->show_akses();	       	
		$this->load->view('administrator/v_menu.php',$data);
	}

	function simpan_menu() {
		$data = $this->input->post('data');
		$id_menu = $data[0][0];
		$judul = $data[0][1];
		
		if ($id_menu == '') {
			$id_menu = $this->M_menu->urut_id();
			$this->M_menu->simpan_menu($id_menu,$judul);
		}else{
			$this->M_menu->update_menu($id_menu,$judul);
		}

		for ($i=0; $i<count($data); $i++) {
			$kode = $data[$i][2];
			$nama = $data[$i][3];
			$level = $data[$i][4];
			$urut = $data[$i][5];
			$id_menu_detail = $data[$i][6];

			if ($id_menu_detail == '') {
				$id_menu_detail = $this->M_menu->urut_id_detail();
				$this->M_menu->simpan_menu_detail($id_menu_detail,$id_menu,$kode,$nama,$level,$urut);
			}else{
				$this->M_menu->update_menu_detail($id_menu_detail,$id_menu,$kode,$nama,$level,$urut);
			}
		}

		// Hapus Sub Menu yang tidak dipakai
		for ($i=0; $i<count($data[0][7]);$i++) {
			$id_hapus = $data[0][7][$i];
			$this->M_menu->hapus_menu_detail($id_hapus);
		}
	}

	function filter_menu() {
		$data = $this->input->post('data');
		$level = $data[0];
		$cari = strtoupper($data[1]);

		$data['menu'] = $this->M_menu->filter_menu($level,$cari);
		$this->load->view('administrator/v_menu_table',$data);
	}

	function show_edit()
	{  	
		$id_menu = $this->input->post('data');
		$data = $this->M_menu->show_edit($id_menu);
		print_r(json_encode($data));
	}

	function hapus_detail()
	{  	
		$id_detail = $this->input->post('data');
		$this->M_menu->hapus_detail($id_detail);
	}

}

?>