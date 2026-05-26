<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retur extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_retur');
		session_start();
	}

	function index() {
		$data['supplier'] = $this->M_retur->supplier();		
		$this->load->view('gudang/v_retur.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$supplier = strtoupper($data[2]);
		$cari = strtoupper($data[3]);
		
		$data['filter'] = $this->M_retur->filter($tgl1, $tgl2, $supplier, $cari);		
		$this->load->view('gudang/v_retur_table.php', $data);
	}

	function get_romawi($bln) {
		$romawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
		return $romawi[$bln];
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_detail = $data[0];
		$bln = intval(date('m', strtotime($data[1])));
		$tahun = date('Y', strtotime($data[1]));
		$bln_romawi = $this->get_romawi($bln - 1);

		$urut = $this->M_retur->auto_no($id_detail, $tahun, $bln_romawi);
		print_r($urut);
	}

	function data_retur() {
		$data = $this->M_retur->data_retur();
		print_r(json_encode($data));
	}

	function cek_nmr() {
		$data = $this->input->post('data');
		$id_detail = $data[0];
		$urut = $data[1];
		$tahun = date('Y', strtotime($data[2]));

		$data = $this->M_retur->cek_nmr($id_detail,$urut,$tahun);
		print_r($data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_detail = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$nmr = $data[2];
		$id_supplier = $data[3];
		$no_kend = $data[4];
		$penerima = $data[5];
		$material = $data[6];

		if ($id_detail != '') {
			$this->M_retur->hapus($id_detail);
		}

		$urut = $this->M_retur->urut();
		$id_karyawan = $this->M_retur->id_karyawan();
		$this->M_retur->simpan($urut, $tgl, $nmr, $id_supplier, $no_kend, $id_karyawan, $penerima);

		for ($i = 0; $i < count($material[0]); $i++) {
			$urut_detail = $this->M_retur->urut_detail();
			$id_prod_retur_detail = $material[0][$i];
			$id_barang = $material[1][$i];
			$id_po_detail = $material[2][$i];
			$kode = $material[3][$i];
			$qty = $material[4][$i];
			$satuan = $material[5][$i];
			$urut_detail_retur = $this->M_retur->urut_detail_retur();

			$this->M_retur->simpan_detail($urut_detail, $urut, $id_barang, $id_po_detail, $kode, $qty, $satuan);
			$this->M_retur->simpan_detail_retur($urut_detail_retur, $urut_detail, $id_prod_retur_detail);
		}
	}

	function edit() {
		$id_detail = $this->input->post('data');
		$data = $this->M_retur->edit($id_detail);
		print_r(json_encode($data));
	}

	function batal() {
		$id_detail = $this->input->post('data');
		$this->M_retur->batal($id_detail);
	}

}
