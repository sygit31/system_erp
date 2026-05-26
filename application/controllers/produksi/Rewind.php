<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rewind extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('produksi/M_rewind');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_rewind->desain();
		$data['operator'] = $this->M_rewind->operator();
		$data['kk'] = $this->M_rewind->kk();
		$data['desain'] = $this->M_rewind->desain();
		$data['proses'] = $this->M_rewind->proses();
		$data['seri'] = $this->M_rewind->seri();
		$data['kode'] = $this->M_rewind->kode();

		$this->load->view('produksi/v_rewind.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];

		$data = $this->M_rewind->auto_no($id_edit, $desain);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$id_gudang_order = $data[3];
		$proses = $data[4];
		$seri = $data[5];
		$kode = $data[6];

		$data = $this->M_rewind->filter($tgl1, $tgl2, $desain, $id_gudang_order, $proses, $seri, $kode);
		print_r(json_encode($data));
	}

	function isi_operator() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$shift = $data[1];
		$proses = $data[2];

		$data = $this->M_rewind->isi_operator($desain, $shift, $proses);
		print_r(json_encode($data));
	}

	function isi_kode() {
		$data = $this->input->post('data');
		$proses = $data[0];
		$id_gudang_order = $data[1];

		$data = $this->M_rewind->isi_kode($proses, $id_gudang_order);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$tomorrow = date('d-m-Y', strtotime("+1 days", strtotime($data[2])));
		$shift = $data[3];
		$proses = $data[4];
		$operator = $data[5];
		$id_gudang_order = $data[6];
		$bahan = $data[7];
		$nmr = $data[8];

		if ($id_edit != '') {$this->M_rewind->hapus($id_edit);}

		for ($i=0; $i<count($bahan[0]); $i++) {
			$id = $this->M_rewind->urut();
			$kode = $bahan[0][$i];
			$time_mulai = (int)date('Gi', strtotime($bahan[1][$i]));
			$time_selesai = (int)date('Gi', strtotime($bahan[2][$i]));
			$mulai = $time_mulai < 630 ? $tomorrow . ' ' . $bahan[1][$i] : $tgl . ' ' . $bahan[1][$i];
			$selesai = $time_selesai < 630 ? $tomorrow . ' ' . $bahan[2][$i] : $tgl . ' ' . $bahan[2][$i];
			$panjang = $bahan[3][$i];
			$baik = $bahan[4][$i];
			$reject = $bahan[5][$i];
			$sisa = $bahan[6][$i];

			$this->M_rewind->simpan($id, $desain, $tgl, $shift, $proses, $id_gudang_order, $kode, $mulai, $selesai, $panjang, $baik, $reject, $sisa, $nmr);

			for ($j=0; $j<count($operator); $j++) {
				$id_opt = $this->M_rewind->urut_opt();
				$id_operator = $operator[$j];
				$this->M_rewind->simpan_opt($id_opt, $id, $id_operator);
			}
		}
	}

	function cetak() {
		$id_cetak = $this->input->post('data');
		$data = $this->M_rewind->cetak($id_cetak);
		print_r(json_encode($data));
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_rewind->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_rewind->hapus($id_hapus);
	}

}