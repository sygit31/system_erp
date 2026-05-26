<?php defined('BASEPATH') or exit('No direct script access allowed');

class Packing extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_packing');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_packing->desain();
		$data['pemeriksa'] = $this->M_packing->pemeriksa();
		$data['approval'] = $this->M_packing->approval();
		$data['pengawas'] = $this->M_packing->pengawas();

		$this->load->view('qc/v_packing.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$desain = $data[2];
		$tipe = $data[3];

		$data = $this->M_packing->auto_no($id_edit, $desain, $tgl, $tipe);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$produk = $data[3];
		$mesin = $data[4];

		$data = $this->M_packing->filter($tgl1, $tgl2, $desain, $produk, $mesin);
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
		$cutter = $data[7];
		$sortir = $data[8];
		$qc = $data[9];
		$packing = $data[10];
		$id_pemeriksa = $data[11];
		$id_approval = $data[12];
		$id_pengawas = $data[13];
		$hasil_baik = $data[14];
		$total = $data[15];
		$rim = $data[16];
		$sampling = $data[17];
		$plus = $data[18];
		$mins = $data[19];
		$ku = $data[20];
		$holo = $data[21];
		$kts = $data[22];
		$remark = $data[23];
		$tipe = $data[24];

		$jam = (int)date('Gi', strtotime($data[4]));
		if ($jam < 630) {
			$jam = $tomorrow . ' ' . $data[4];
		} else {
			$jam = $tgl . ' ' . $data[4];
		}

		if ($id_edit == '') {
			$urut = $this->M_packing->urut();
			$this->M_packing->simpan($urut, $nmr, $desain, $tgl, $jam, $mesin, $produk, $cutter, $sortir, $qc, $packing, $id_pemeriksa, $id_approval, $id_pengawas, $hasil_baik, $total, $rim, $sampling, $plus, $mins, $ku, $holo, $kts, $remark, $tipe);
		}else{
			$this->M_packing->update($id_edit, $nmr, $desain, $tgl, $jam, $mesin, $produk, $cutter, $sortir, $qc, $packing, $id_pemeriksa, $id_approval, $id_pengawas, $hasil_baik, $total, $rim, $sampling, $plus, $mins, $ku, $holo, $kts, $remark, $tipe);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_packing->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_packing->hapus($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$data = $this->M_packing->cetak($id_cetak);
		print_r(json_encode($data));
	}

	function s_filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$produk = $data[3];

		$data = $this->M_packing->s_filter($tgl1, $tgl2, $desain, $produk);
		print_r(json_encode($data));
	}

	function s_simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$produk = $data[3];
		$bahan = $data[4];
		$baik = $data[5];
		$temuan = $data[6];
		$remark = $data[7];

		if ($id_edit == '') {
			$urut = $this->M_packing->s_urut();
			$this->M_packing->s_simpan($urut, $desain, $tgl, $produk, $bahan, $baik, $temuan, $remark);
		}else{
			$this->M_packing->s_update($id_edit, $desain, $tgl, $produk, $bahan, $baik, $temuan, $remark);
		}
	}

	function s_edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_packing->s_edit($id_edit);
		print_r(json_encode($data));
	}

	function s_hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_packing->s_hapus($id_hapus);
	}

}