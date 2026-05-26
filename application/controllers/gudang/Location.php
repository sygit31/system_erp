<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_location');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$kary = explode('|', $_SESSION['logERP']);
		$data['id_kary'] = $kary[0];
		$data['mn'] = $this->M_location->status_menu($_GET['mn'], $kary[0]);
		$data['unit'] = $this->M_location->unit();
		$data['pic'] = $this->M_location->pic();
		$data['material'] = $this->M_location->material();
		$data['lokasi'] = $this->M_location->lokasi($data['id_kary']);
		
		$this->load->view('gudang/v_location.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$nama = strtoupper($data[1]);
		$pic = strtoupper($data[2]);

		$data = $this->M_location->filter($kd_unit, $nama, $pic);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nama = $data[1];
		$jenis = $data[2];
		$kd_unit = $data[3];
		$pic = $data[4];

		$cek_nama = $this->M_location->cek_nama($id_edit, $nama);
		if ($cek_nama != 0) {print_r(1); return;}

		if ($id_edit == '') {
			$urut = $this->M_location->urut();
			$this->M_location->simpan($urut, $nama, $jenis, $kd_unit);
		}else{
			$urut = $id_edit;
			$this->M_location->update($id_edit, $nama, $jenis, $kd_unit);

			$dt_pic = $this->M_location->dt_pic($id_edit);
			foreach ($dt_pic as $dt) {
				$id_kary = $dt['ID_KARYAWAN'];
				if (!in_array($id_kary, $pic)) {
					$this->M_location->hapus_pic($id_edit, $id_kary);
				}
			}
		}

		for ($i=0; $i<count($pic); $i++) {
			$urut_pic = $this->M_location->urut_pic();
			$this->M_location->simpan_pic($urut_pic, $urut, $pic[$i]);
		}
	}

	function edit() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$str = $data[1];

		if ($str == 'lokasi') {
			$data = $this->M_location->edit($id_edit);
		}else{
			$data = $this->M_location->edit_barang($id_edit);
		}
		print_r(json_encode($data));
	}

	function hapus() {
		$data = $this->input->post('data');
		$id_hapus = $data[0];
		$str = $data[1];
		$id_location = $data[2];

		if ($str == 'lokasi') {
			$this->M_location->hapus($id_hapus);
		}else{
			$this->M_location->hapus_barang($id_hapus);
		}
	}

	function info() {
		$data = $this->input->post('data');
		$id_location = $data[0];
		$tipe = $data[1];
		$nama = strtolower($data[2]);
		$status = $data[3];
		$no_lokasi = $data[4];

		$data = $this->M_location->info($id_location, $tipe, $nama, $status, $no_lokasi);
		print_r(json_encode($data));
	}

	function simpan_p() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$id_location = $data[1];
		$tipe = $data[2];
		$id_barang = $data[3];
		$status = $data[4];
		$no_lokasi = $data[5];
		$min_stok = $data[6];

		if ($id_edit == '') {
			$urut_brg = $this->M_location->urut_brg();
			$this->M_location->simpan_p($urut_brg, $id_location, $tipe, $id_barang, $status, $no_lokasi, $min_stok);
		}else{
			$this->M_location->update_p($id_edit, $id_location, $tipe, $id_barang, $status, $no_lokasi, $min_stok);			
		}
	}

}