<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ipb_realisasi extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_ipb_realisasi');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];

		$data['bagian'] = $this->M_ipb_realisasi->bagian($id_kary);	
		$data['kk'] = $this->M_ipb_realisasi->kk();	
		$data['mesin'] = $this->M_ipb_realisasi->mesin();
		$data['jenis'] = $this->M_ipb_realisasi->jenis();

		$this->load->view('gudang/v_ipb_realisasi.php',$data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$thn = date('y', strtotime($data[1]));

		$data = $this->M_ipb_realisasi->auto_no($id_edit, $thn);
		print_r(json_encode($data));
	}

	function isi_mesin() {
		$id_bagian = $this->input->post('data');
		$data = $this->M_ipb_realisasi->isi_mesin($id_bagian);
		$dt_brang = $this->M_ipb_realisasi->isi_barang($id_bagian);
		print_r(json_encode(array($data, $dt_brang)));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$id_bagian = $data[2];
		$kk = $data[3];
		$id_mesin = $data[4];
		$jenis = $data[5];
		$cari = $data[6];

		$data = $this->M_ipb_realisasi->filter($tgl1, $tgl2, $id_bagian, $kk, $id_mesin, $jenis, $cari);
		print_r(json_encode($data));
	}

	function isi_stok() {
		$data = $this->input->post('data');
		$id_bagian = $data[0];
		$id_barang = $data[1];

		$data = $this->M_ipb_realisasi->isi_stok($id_bagian, $id_barang);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$thn = date('y', strtotime($data[2]));
		$nmr = $id_edit != '' ? $data[1] : $this->M_ipb_realisasi->auto_no($id_edit, $thn);
		$id_bagian = $data[3];
		$id_kk = $data[4];
		$id_mesin = $data[5];
		$isi_tabel = $data[6];

		if ($id_edit != '') {$this->M_ipb_realisasi->batal($id_edit);}
		$id_ipb = $this->M_ipb_realisasi->urut();
		for ($i=0; $i<count($isi_tabel[0]); $i++) {
			$id_barang = $isi_tabel[0][$i];
			$satuan = $isi_tabel[1][$i];
			$qty = str_replace('.', ',', $isi_tabel[2][$i]);

			$this->M_ipb_realisasi->simpan($id_ipb, $nmr, $tgl, $id_bagian, $id_kk, $id_mesin, $id_barang, $satuan, $qty);
			$id_ipb++;
		}
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_ipb_realisasi->hapus($id_hapus);
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_ipb_realisasi->edit($id_edit);
		print_r(json_encode($data));
	}

	function s_filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$id_bagian = $data[2];
		$jenis = $data[3];
		$cari = $data[4];

		$data = $this->M_ipb_realisasi->s_filter($tgl1, $tgl2, $id_bagian, $jenis, $cari);
		print_r(json_encode($data));
	}

}