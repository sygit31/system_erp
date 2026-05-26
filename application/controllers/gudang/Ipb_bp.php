<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ipb_bp extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_ipb_bp');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$kd_menu = $_GET['kd_menu'];
		$data['menu'] = $_GET['stat'];

		$kd_unit = $this->M_ipb_bp->kd_unit()[0];
		$id_kary = $this->M_ipb_bp->kd_unit()[1];
		$id_bagian = $this->M_ipb_bp->kd_unit()[2];
		$data['kd_status'] = $this->M_ipb_bp->kd_status($kd_menu, $id_kary);

		$data['unit'] = $this->M_ipb_bp->unit();	
		$data['jenis'] = $this->M_ipb_bp->jenis();		
		$data['nomor'] = $this->M_ipb_bp->nomor();		
		$data['dt_bagian'] = $this->M_ipb_bp->bagian($kd_menu, $id_kary);
		$data['dt_barang'] = $this->M_ipb_bp->barang();
		$data['cek_user'] = array($kd_unit, $id_bagian);

		$data['approve'] = $this->M_ipb_bp->approve($kd_unit);
		$data['receive'] = $this->M_ipb_bp->receive($kd_unit);
		
		$this->load->view('gudang/v_ipb_bp.php',$data);
	}

	function bahan() {
		$jenis = $this->input->post('data');
		$data = $this->M_ipb_bp->bahan($jenis);
		print_r(json_encode($data));
	}

	function isi_nama() {
		$id_bagian = $this->input->post('data');
		$kd_unit = $this->M_ipb_bp->kd_unit()[0];
		$data = $this->M_ipb_bp->isi_nama($id_bagian, $kd_unit);
		
		print_r(json_encode($data));
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$thn = date('y', strtotime($data[1]));
		$bln = date('m', strtotime($data[1]));
		$romawi = $this->get_romawi($bln - 1);
		$kd_unit = $data[2];
		$jenis = $data[3];
		$bagian = $data[4];

		$data = $this->M_ipb_bp->auto_no($id_edit, $thn, $romawi, $kd_unit, $jenis, $bagian);
		print_r(json_encode($data));
	}

	function get_romawi($bln) {
		$romawi = array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
		return $romawi[$bln];
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$kd_unit = $data[2];
		$id_bagian = $data[3];
		$jenis = $data[4];
		$id_barang = $data[5];

		$data['filter'] = $this->M_ipb_bp->filter($tgl1, $tgl2, $kd_unit, $id_bagian, $jenis, $id_barang);
		$this->load->view('gudang/v_ipb_bp_table',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$kd_unit = $data[1];
		$tgl = date('d-m-Y',strtotime($data[2]));
		$nmr = $data[3];
		$id_order = $data[4];
		$id_approve = $data[5];
		$isi_tabel = $data[6];
		$jenis = $data[7];
		$id_bagian = $data[8];

		if ($id_edit != '') {$this->M_ipb_bp->batal($id_edit);}

		$id_akun = $this->M_ipb_bp->kd_unit()[1];
		$id_ipb = $this->M_ipb_bp->urut();
		$this->M_ipb_bp->simpan($id_ipb, $kd_unit, $tgl, $nmr, $id_akun, $id_order, $id_approve, $jenis, $id_bagian);

		for ($i=0; $i<count($isi_tabel[0]); $i++) {
			$id_barang = $isi_tabel[0][$i];
			$satuan = $isi_tabel[1][$i];
			$qty = str_replace('.', ',', $isi_tabel[2][$i]);
			$keterangan = $isi_tabel[3][$i];

			$id_detail = $this->M_ipb_bp->urut_detail();
			$this->M_ipb_bp->simpan_detail($id_detail, $id_ipb, $id_barang, $satuan, $qty, $keterangan);
		}
	}

	function edit() {
		$data = $this->input->post('data');
		$action = $data[0];
		$id_edit = $data[1];
		$status = $action == 'edit' ? '1' : '2';

		$data = $this->M_ipb_bp->edit($status, $id_edit);
		print_r(json_encode($data));
	}

	function app() {
		$data = $this->input->post('data');
		$id = $data[0];
		$status = $data[1];
		$id_receive = $data[2];

		$this->M_ipb_bp->app($id, $status, $id_receive);
	}

}