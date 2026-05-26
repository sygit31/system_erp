<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Terima_bp extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_terima_bp');
		$this->load->model('administrator/M_akun');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['kd_menu'] = $_GET['kd_menu'];
		$id_akun = $_SESSION['id_akun'];
		
		$data['unit'] = $this->M_terima_bp->unit();	
		$data['bagian'] = $this->M_terima_bp->bagian();	
		$data['kd_unit'] = $this->M_terima_bp->dt_akun()[1];	
		$data['dt_sip'] = $this->M_terima_bp->dt_sip();	
		$data['dt_po'] = $this->M_terima_bp->dt_po();
		$data['jenis'] = $this->M_terima_bp->jenis($_GET['kd_menu']);		
		$kode_dept = $this->M_terima_bp->dt_akun()[0];
		$data['dt_barang'] = $this->M_terima_bp->dt_barang($data['kd_unit'], $kode_dept);
		$data['barang_non_tunai'] = $this->M_terima_bp->barang_non_tunai();	

		$data['kd_akses'] = $this->M_akun->kd_akses($id_akun, $data['kd_menu']);
		$data['dt_bagian'] = $this->M_terima_bp->dt_bagian($id_akun);
		
		$this->load->view('gudang/v_terima_bp.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kd_unit = $data[2];
		$jenis = $data[3];
		$sip = $data[4];
		$cari = $data[5];
		$po = $data[6];
		$dt_bagian = $data[7];
		$dt_unit = $data[8];
		$kd_akses = $data[9];
		$bagian = $data[10];

		$data = $this->M_terima_bp->filter($tgl1, $tgl2, $kd_unit, $jenis, $sip, $cari, $po, $dt_bagian, $dt_unit, $kd_akses, $bagian);
		print_r(json_encode($data));
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$thn = date('y', strtotime($data[1]));
		$kd_unit = $data[2];

		$data = $this->M_terima_bp->auto_no($id_edit, $thn, $kd_unit);
		print_r(json_encode($data));
	}

	function data_sip() {
		$data = $this->input->post('data');
		$id_barang = $data[0];
		$jenis = $data[1];
		$kd_unit = $data[2];

		$data = $this->M_terima_bp->data_sip($id_barang, $jenis, $kd_unit);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$tgl = date('d-m-Y',strtotime($data[2]));
		$kd_unit = $data[3];
		$nmr_sp = $data[4];
		$barang = $data[5];
		$no_kend = $data[6];
		$tipe = $data[7];

		if ($id_edit != '') {$this->M_terima_bp->batal($id_edit);}

		$id_akun = $this->M_terima_bp->dt_akun()[2];
		$id = $this->M_terima_bp->urut();
		$kd_bagian = $this->M_terima_bp->kd_bagian();
		$this->M_terima_bp->simpan($id, $kd_unit, $kd_bagian, $tgl, $nmr, $nmr_sp, $id_akun, $no_kend, $tipe);

		for ($i=0; $i<count($barang[0]); $i++) {
			$id_sip_detail = $barang[0][$i];
			$qty = str_replace('.', ',', $barang[1][$i]);
			$satuan = $barang[2][$i];
			$deskripsi = $barang[3][$i];

			if ($tipe == '1') {
				$id_barang = $this->M_terima_bp->id_barang($id_sip_detail)[0];
				$id_po_detail = $this->M_terima_bp->id_barang($id_sip_detail)[1];
			}else{
				$id_barang = $id_sip_detail;
				$id_sip_detail = 0; $id_po_detail = 0;
			}

			$id_detail = $this->M_terima_bp->urut_detail();
			$this->M_terima_bp->simpan_detail($id_detail, $id, $id_sip_detail, $id_barang, $qty, $satuan, $deskripsi, $id_po_detail);
		}

		$this->upload_sp($id, $id_edit);
	}

	function upload_sp($id, $id_edit) {
		
	}

	function hapus() {
		$id_detail = $this->input->post('data');
		$this->M_terima_bp->hapus($id_detail);
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_terima_bp->edit($id_edit);
		print_r(json_encode($data));
	}

	function cetak() {
		$dt_cetak = $this->input->post('data');
		$data = $this->M_terima_bp->cetak($dt_cetak);
		print_r(json_encode($data));
	}

}