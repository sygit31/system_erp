<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Foil_stamping extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_foil_stamping');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['dt_desain'] = $this->M_foil_stamping->dt_desain();
		$data['dt_kk'] = $this->M_foil_stamping->dt_kk();
		$data['dt_pp'] = $this->M_foil_stamping->dt_pp();
		$data['dt_seri'] = $this->M_foil_stamping->dt_seri();
		$data['dt_pengawas'] = $this->M_foil_stamping->dt_pengawas();
		$data['menu'] = $_GET['stat'];
		
		$this->load->view('produksi/v_foil_stamping.php',$data);
	}

	function isi_kode_kertas() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$seri = $data[1];

		$data = $this->M_foil_stamping->isi_kode_kertas($desain, $seri);
		print_r(json_encode($data));
	}

	function isi_kode_foil() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$seri = $data[1];

		$data = $this->M_foil_stamping->isi_kode_foil($desain, $seri);
		print_r(json_encode($data));
	}

	function isi_foil() {
		$data = $this->input->post('data');
		$id_mutasi = $data[0];
		$id_detail = $data[1];
		$kode_asal = $data[2];
		$id_asal = $data[3];

		$data = $this->M_foil_stamping->isi_foil($id_mutasi, $id_detail, $kode_asal, $id_asal);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$kk = $data[3];
		$pp = $data[4];
		$seri = $data[5];
		$shift = $data[6];
		$pengawas = $data[7];
		$mesin = $data[8];
		$kode = $data[9];

		$data = $this->M_foil_stamping->filter($tgl1, $tgl2, $desain, $kk, $pp, $seri, $shift, $pengawas, $mesin, $kode);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];
		$tgl = date('d-m-Y',strtotime($data[2]));
		$delivery = date('d-m-Y',strtotime($data[3]));
		$id_pengawas_stamping = $data[4];
		$isi_tabel = $data[5];

		if ($id_edit != '') {$this->M_foil_stamping->batal($id_edit);}

		$id_foil = $this->M_foil_stamping->urut();
		$id_detail = $this->M_foil_stamping->urut_detail();
		$this->M_foil_stamping->simpan($id_foil, $desain, $tgl, $delivery, $id_pengawas_stamping);

		for ($i=0; $i<count($isi_tabel[0]); $i++) {
			$shift = $isi_tabel[0][$i];
			$mesin = $isi_tabel[1][$i];
			$nmr_pp = $isi_tabel[2][$i];
			$kode_kertas = $isi_tabel[3][$i];
			$panjang_kertas = $isi_tabel[4][$i];
			$id_mutasi = $isi_tabel[5][$i];
			$id_gudang_order = $isi_tabel[6][$i];
			$kode_foil = $isi_tabel[7][$i];
			$panjang_foil = str_replace('.', ',', $isi_tabel[8][$i]);
			$qty_roll = $isi_tabel[9][$i];
			$hasil = str_replace('.', ',', $isi_tabel[10][$i]);
			$waste = str_replace('.', ',', $isi_tabel[11][$i]);
			$sisa = str_replace('.', ',', $isi_tabel[12][$i]);
			$keterangan = $isi_tabel[13][$i];
			$kode_asal = $isi_tabel[14][$i];
			$id_asal = $isi_tabel[15][$i];

			$this->M_foil_stamping->simpan_detail($id_detail, $id_foil, $nmr_pp, $mesin, $shift, $id_mutasi, $kode_foil, $qty_roll, $panjang_foil, $id_gudang_order, $kode_kertas, $panjang_kertas, $hasil, $waste, $sisa, $id_asal, $keterangan);

			$this->simpan_sisa($id_detail, $id_mutasi, $sisa, $qty_roll);
			$id_detail++;
		}
	}

	function simpan_sisa($id_detail, $id_mutasi, $sisa, $qty_roll) {
		$sisa_mutasi = $this->M_foil_stamping->sisa_mutasi($id_mutasi);
		$roll_sisa = $sisa_mutasi[0];
		$panjang_sisa = $sisa_mutasi[1];

		if ($sisa_mutasi > 0) {
			$id_sisa = $this->M_foil_stamping->urut_sisa();
			$this->M_foil_stamping->simpan_sisa($id_sisa, $id_detail, $roll_sisa, $panjang_sisa);
		}

		if ($sisa != 0) {
			$id_sisa = $this->M_foil_stamping->urut_sisa();
			$panjang_sisa = str_replace('.', ',', $sisa / $qty_roll);
			print_r($panjang_sisa);

			$this->M_foil_stamping->simpan_sisa($id_sisa, $id_detail, $qty_roll, $panjang_sisa);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_foil_stamping->edit($id_edit);
		print_r(json_encode($data));
	}

	function cetak() {
		$id_cetak = $this->input->post('data');
		$data = $this->M_foil_stamping->cetak($id_cetak);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_detail = $this->input->post('data');
		$this->M_foil_stamping->hapus($id_detail);
	}

}