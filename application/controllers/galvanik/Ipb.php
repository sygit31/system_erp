<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ipb extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('galvanik/m_ipb');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function id_kary() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];
	}

	function index() {
		$id_kary = $this->id_kary();		
		$kd_unit = $_GET['div'] == 'hlg' ? '12' : '01';

		$data['kd_unit'] = $kd_unit;
		$data['status_menu'] = $this->m_ipb->status_menu($_GET['kode_menu'], $id_kary);
		$data['kk'] = $this->m_ipb->kk($kd_unit);
		$data['nama_pengawas'] = $this->m_ipb->nama_pengawas($kd_unit);
		$data['nama_is'] = $this->m_ipb->nama_is($kd_unit);
		$data['seri'] = $this->m_ipb->seri();
		$data['desain'] = $this->m_ipb->desain();

		$this->load->view('galvanik/v_ipb', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$status_menu = $data[2];
		$kd_unit = $data[3];
		$desain = $data[4];
		$seri = $data[5];
		$cari = strtoupper($data[6]);

		$data['status_menu'] = $status_menu;
		$data['ipb'] = $this->m_ipb->filter($tgl1, $tgl2, $kd_unit, $desain, $seri, $cari);

		$this->load->view('galvanik/v_ipb_table', $data);
	}

	function isi_barang() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$tipe = $data[1];
		$desain = $data[2];

		$data = $this->m_ipb->isi_barang($kd_unit, $tipe, $desain);
		print_r(json_encode($data));
	}

	function auto_no() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$tgl = substr($data[1], 0, 2);
		$bln = (int)date('m', strtotime($data[1]));
		$romawi = $this->get_romawi($bln - 1);
		$tahun = date('Y', strtotime($data[1]));
		$kd_unit = $data[2];
		$tipe = $data[3];
		$urut = $this->m_ipb->auto_no($desain, $kd_unit, $tipe, $tahun);

		if ($kd_unit == '12') {
			$kode_trans = '/PNP-HLG/EMB/';
		} else {
			$kode_trans = '/PNP-HPD/EMB/';
		}

		$kode = $kode_trans . $tgl . '/' . $romawi . '/' . $tahun;
		print_r(json_encode(array($urut, $kode)));
	}

	function get_romawi($bln) {
		$romawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
		return $romawi[$bln];
	}

	function isi_pch() {
		$data = $this->input->post('data');
		$qty_ipb = $data[0];
		$id_barang = $data[1];

		$data = $this->m_ipb->isi_pch($qty_ipb, $id_barang);
		print_r(json_encode($data));
	}

	function cek_nomor() {
		$data = $this->input->post('data');
		$nmr = $data[0];
		$desain = $data[1];
		$tipe = $data[2];
		$kd_unit = $data[3];
		$urut = substr($nmr,0,3);
		$th = substr($nmr,-4);

		$data = $this->m_ipb->cek_nomor($desain, $tipe, $kd_unit, $urut, $th);
		print_r($data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$tgl = date('d-m-Y', strtotime($data[0]));
		$nmr = strtoupper($data[1]);
		$no_kk = strtoupper($data[3]);
		$id_kary = $this->id_kary();
		$tipe = $data[5];
		$kd_unit = $data[6];

		for ($i = 0; $i < count($data[2]); $i++) {
			$id_ipb = $this->m_ipb->urut();
			$id_galv_proses = $data[2][$i];
			$ukuran = strtoupper($data[4][$i]);
			$this->m_ipb->simpan($id_ipb, $tgl, $nmr, $id_galv_proses, $no_kk, $id_kary, $ukuran, $tipe, $kd_unit);
		}
	}

	function hapus() {
		$id = $this->input->post('data');
		$this->m_ipb->hapus($id);
	}

	function approve() {
		$nmr = $this->input->post('data');
		$this->m_ipb->approve($nmr);
	}
	
}