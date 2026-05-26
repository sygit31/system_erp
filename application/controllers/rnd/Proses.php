<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('rnd/M_proses');
		session_start();
	}

	function input_proses() {
		$data['produk'] = $this->M_proses->show_produk();  	
		$data['mesin'] = $this->M_proses->show_mesin(); 
		$data['material'] = $this->M_proses->show_material();
		$data['proses'] = $this->M_proses->show_proses();
		$data['flow'] = $this->M_proses->show_flow();	
		$this->load->view('rnd/v_proses.php',$data);
	}

	function ambil_station() {
		$kode = $this->input->post('data');

		$data = $this->M_proses->ambil_station($kode);
		print_r(json_encode($data));
	}

	function simpan_proses()	{
		$data = $this->input->post('data');
		$id_edit_proses = $data[0];
		$id_produk = $data[1];
		$kode = $data[2];
		$desain = $data[3];

		// Simpan Proses
		if ($id_edit_proses == '') {
			$id_proses = $this->M_proses->urut_proses();
			$this->M_proses->simpan_proses($id_proses,$id_produk,$kode,$desain);
		}else{
			$this->M_proses->edit_proses($id_edit_proses,$id_produk,$kode,$desain);
		}

		// Hapus Current Mesin & Material saat edit data
		for ($i=0; $i<count($data[15]); $i++) {
			$id_hapus_mesin = $data[15][$i];
			$this->M_proses->hapus_mesin($id_hapus_mesin);
		}
		for ($i=0; $i<count($data[16]); $i++) {
			$id_hapus_material = $data[16][$i];
			$this->M_proses->hapus_material($id_hapus_material);
		}

		// Simpan R&D Mesin
		$id_proses = $id_edit_proses;
		$id_rnd_mesin = $this->M_proses->urut_rnd_mesin();
		for ($i=0; $i<count($data[4]); $i++) {
			$id_station = $data[4][$i];
			$id_mesin = $data[5][$i];
			$speed = $data[6][$i];
			$naik = $data[7][$i];
			$suhu = $data[8][$i];
			$tekanan = $data[9][$i];
			$id_edit_mesin = $data[10][$i];
			if ($id_edit_mesin == '') {
				$this->M_proses->simpan_rnd_mesin($id_rnd_mesin,$id_proses,$id_station,$id_mesin,$speed,$naik,$suhu,$tekanan);
				$id_rnd_mesin++;
			}else{
				$this->M_proses->update_rnd_mesin($id_edit_mesin,$id_proses,$id_station,$id_mesin,$speed,$naik,$suhu,$tekanan);
			}
		}

		// Simpan R&D Material
		$id_rnd_bom = $this->M_proses->urut_rnd_bom();
		for ($i=0; $i<count($data[11]); $i++) {
			$id_station = $data[11][$i];
			$id_material = $data[12][$i];
			$qty = $data[13][$i];
			$id_edit_bom = $data[14][$i];
			if ($id_edit_bom == '') {
				$this->M_proses->simpan_rnd_bom($id_rnd_bom,$id_proses,$id_station,$id_material,$qty);
				$id_rnd_bom++;
			}else{
				$this->M_proses->update_rnd_bom($id_edit_bom,$id_proses,$id_station,$id_material,$qty);
			}
		}
	}

	function filter_proses() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$cari = strtoupper($data[1]);

		$data['proses'] = $this->M_proses->filter_proses($desain,$cari);
		$this->load->view('rnd/v_proses_table.php',$data);
	}

	function preview_mesin() {
		$id_proses = $this->input->post('data');

		$data = $this->M_proses->preview_mesin($id_proses);
		print_r(json_encode($data));
	}

	function preview_material() {
		$id_proses = $this->input->post('data');

		$data = $this->M_proses->preview_material($id_proses);
		print_r(json_encode($data));
	}

}

?>