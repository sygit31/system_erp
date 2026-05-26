<?php defined('BASEPATH') or exit('No direct script access allowed');

class Musnah extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('galvanik/M_musnah');		
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function get_romawi($bln) {
		$romawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
		return $romawi[$bln];
	}

	function id_kary() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];
	}

	function index() {
		$data['produk'] = $this->M_musnah->produk();
		$data['desain'] = $this->M_musnah->desain();
		$data['periode'] = $this->M_musnah->periode();

		$this->load->view('galvanik/v_musnah', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$periode = $data[0];
		$id_produk = $data[1];
		
		$data_emboss = $this->M_musnah->filter_emboss($periode, $id_produk);
		$data_galvanik = $this->M_musnah->filter_galvanik($periode, $id_produk);
		print_r(json_encode(array($data_emboss, $data_galvanik)));
	}

	function auto_no() {
		$data = $this->input->post('data');
		$thn = $data[0];
		$tgl = substr($data[1], 0, 2);
		$bln = (int)date('m', strtotime($data[1]));
		$romawi = $this->get_romawi($bln - 1);
		
		$urut = $this->M_musnah->auto_no($thn);
		$kode = '/PNP-HLG/BA/' . $tgl . '/' . $romawi . '/' . $thn;

		print_r(json_encode(array($urut,$kode)));
	}

	function isi_barang() {
		$data = $this->input->post('data');
		$periode = date('ymd', strtotime($data[0]));
		$jenis = $data[1];
		$desain = $data[2];
		$tipe = $data[3];
		$keterangan = $data[4];
		$produk = $data[5];
		
		$ex_emboss = $this->M_musnah->ex_emboss($periode, $jenis, $desain, $tipe, $keterangan, $produk);
		$ex_reject = $this->M_musnah->ex_reject($periode, $jenis, $desain, $tipe, $keterangan, $produk);
		$ex_produksi = $this->M_musnah->ex_produksi($periode, $jenis, $desain, $tipe, $keterangan, $produk);
		print_r(json_encode(array($ex_emboss, $ex_reject, $ex_produksi)));
	}

	function cek_nomor() {
		$data = $this->input->post('data');
		$nmr = $data[0];
		$bln = date('m', strtotime($data[1]));
		$urut = substr($nmr,0,3);
		$th = substr($nmr,-4);

		$duplikat = $this->M_musnah->cek_nomor($urut, $th, $bln);
		print_r($duplikat);
	}

	function simpan() {
		$data = $this->input->post('data');
		$tgl = date('d-m-Y', strtotime($data[0]));
		$nmr = strtoupper($data[1]);
		$id_kary = $this->id_kary();

		for ($i = 0; $i < count($data[4]); $i++) {
			$id_galv_proses = $data[2][$i];
			$no_serah_terima = $data[3][$i];
			$keterangan = $data[4][$i];

			if ($id_galv_proses == '') {
				$dt_galv_proses = $this->M_musnah->dt_galv_proses($no_serah_terima);
				foreach ($dt_galv_proses as $dt) {
					$id_musnah = $this->M_musnah->urut();
					$id_galv_proses = $dt['ID_GALV_PROSES'];
					$this->M_musnah->simpan($id_musnah, $tgl, $nmr, $id_galv_proses, $id_kary, $keterangan);
				}
			}else{
				$id_musnah = $this->M_musnah->urut();
				$this->M_musnah->simpan($id_musnah, $tgl, $nmr, $id_galv_proses, $id_kary, $keterangan);
			}
		}
	}

	function hapus() {
		$data = $this->input->post('data');
		$data = explode('/',$data);
		$id = $data[0];	
		$keterangan = $data[1];

		if ($keterangan == 'Ex. Produksi Emboss') {
			$dt_id = $this->M_musnah->dt_id($id);

			foreach ($dt_id as $dt) {
				$id = $dt['ID'];
				$this->M_musnah->hapus($id);
			}
		}else{
			$this->M_musnah->hapus($id);
		}
	}

}