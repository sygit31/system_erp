<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sticker extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_sticker');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['desain'] = $this->M_sticker->desain();
		$data['operator'] = $this->M_sticker->operator();
		$data['pengawas'] = $this->M_sticker->pengawas();
		$data['pp'] = $this->M_sticker->pp();
		$data['no_roll'] = $this->M_sticker->no_roll();

		$this->load->view('produksi/v_sticker.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$thn = date('Y', strtotime($data[1]));

		$data = $this->M_sticker->auto_no($id_edit, $thn);
		print_r(json_encode($data));
	}

	function last_opt() {
		$data = $this->M_sticker->last_opt();
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$pp = $data[3];

		$data = $this->M_sticker->filter($tgl1, $tgl2, $desain, $pp);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$nmr = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$shift = $data[4];
		$id_pengawas = $data[5];
		$tom = date('d-m-Y', strtotime('+1 days', strtotime($data[3])));

		$time_mulai = (int)date('Gi', strtotime($data[6]));
		if ($time_mulai < 630) {
			$mulai = $tom . ' ' . $data[6];
		}else{
			$mulai = $tgl . ' ' . $data[6];
		}

		$time_selesai = (int)date('Gi', strtotime($data[7]));
		if ($time_selesai < 630) {
			$selesai = $tom . ' ' . $data[7];
		}else{
			$selesai = $tgl . ' ' . $data[7];
		}

		$pp = $data[8];
		$no_roll = $data[9];
		$lebar = $data[10];
		$panjang = $data[11];
		$hasil = $data[12];
		$operator = $data[13];
		$keterangan = $data[14];
		$srp = $data[15];

		if ($id_edit != '') {$this->M_sticker->batal($id_edit);}

		$urut = $this->M_sticker->urut();
		$id_mesin = 5;
		$this->M_sticker->simpan($urut, $desain, $nmr, $tgl, $shift, $id_pengawas, $pp, $id_mesin, $mulai, $selesai, $no_roll, $lebar, $panjang, $hasil, $keterangan);

		$urut_opt = $this->M_sticker->urut_opt();
		for ($i=0; $i<count($operator); $i++) {
			$id_operator = $operator[$i];
			$this->M_sticker->simpan_opt($urut_opt, $urut, $id_operator);
			$urut_opt++;
		}

		$urut_srp = $this->M_sticker->urut_srp();
		for ($i=0; $i<count($srp); $i++) {
			$t_srp = explode('@@', $srp[$i]);
			$t_kode = $t_srp[0];
			$t_lebar = $t_srp[1];
			$t_panjang = $t_srp[2];
			$t_hasil = $t_srp[3];
			$t_reject = $t_srp[4];
			$t_sisa = $t_srp[5];

			$this->M_sticker->simpan_srp($urut_srp, $urut, $t_kode, $t_lebar, $t_panjang, $t_hasil, $t_reject, $t_sisa);
			$urut_opt++;
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');

		$data = $this->M_sticker->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_sticker->batal($id_hapus);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$data = $this->M_sticker->cetak($id_cetak);
		print_r(json_encode($data));
	}

}