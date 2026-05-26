<?php defined('BASEPATH') or exit('No direct script access allowed');

class Polar extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_polar');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_polar->desain();
		$data['pemeriksa'] = $this->M_polar->pemeriksa();
		$data['approval'] = $this->M_polar->approval();
		$data['operator'] = $this->M_polar->operator();

		$this->load->view('qc/v_polar.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$desain = $data[2];
		$tipe = $data[3];

		$data = $this->M_polar->auto_no($id_edit, $desain, $tgl, $tipe);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$produk = $data[3];
		$mesin = $data[4];

		$data = $this->M_polar->filter($tgl1, $tgl2, $desain, $produk, $mesin);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$desain = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$tomorrow = date('d-m-Y', strtotime('+1 days', strtotime($data[3])));
		$mesin = $data[5];
		$produk = $data[6];
		$rh_ruang = str_replace('.', ',', $data[7]);
		$sh_ruang = str_replace('.', ',', $data[8]);
		$id_pemeriksa = $data[9];
		$id_approval = $data[10];
		$id_operator = $data[11];
		$label_cutter = $data[12];
		$kode_sortir = $data[13];
		$kode_qc = $data[14];
		$qty_bahan = $data[15];
		$qty_sampling = $data[16];
		$qty_sisipan = $data[17];
		$siku = $data[18];
		$miss_reg = $data[19];
		$qty_acc = $data[20];
		$qty_rej = $data[21];
		$ku = $data[22];
		$holo = $data[23];
		$kertas = $data[24];
		$remark = $data[25];
		$tipe = $data[26];

		$jam = (int)date('Gi', strtotime($data[4]));
		if ($jam < 630) {
			$jam = $tomorrow . ' ' . $data[4];
		} else {
			$jam = $tgl . ' ' . $data[4];
		}

		if ($id_edit == '') {
			$urut = $this->M_polar->urut();
			$this->M_polar->simpan($urut, $nmr, $desain, $tgl, $jam, $mesin, $produk, $rh_ruang, $sh_ruang, $id_pemeriksa, $id_approval, $id_operator, $label_cutter, $kode_sortir, $kode_qc, $qty_bahan, $qty_sampling, $qty_sisipan, $siku, $miss_reg, $qty_acc, $qty_rej, $ku, $holo, $kertas, $remark, $tipe);
		}else{
			$this->M_polar->update($id_edit, $nmr, $desain, $tgl, $jam, $mesin, $produk, $rh_ruang, $sh_ruang, $id_pemeriksa, $id_approval, $id_operator, $label_cutter, $kode_sortir, $kode_qc, $qty_bahan, $qty_sampling, $qty_sisipan, $siku, $miss_reg, $qty_acc, $qty_rej, $ku, $holo, $kertas, $remark, $tipe);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_polar->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_polar->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$data = $this->M_polar->cetak($id_cetak);
		print_r(json_encode($data));
	}

}