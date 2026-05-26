<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('stamping/M_stamping');
		session_start();
		if (!isset($_SESSION['pesan'])) {header("location:" . base_url());}
	}

	function index() {
		$data['nm_qc'] = $this->M_stamping->nm_qc();
		$data['nm_operator'] = $this->M_stamping->nm_operator();
		$data['nm_pengawas'] = $this->M_stamping->nm_pengawas();
		
		$this->load->view('stamping/v_barcode',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'ymd');
		$tgl2 = date_format($date2,'ymd');
		$nm_operator = strtoupper($data[2]);
		$nm_qc = strtoupper($data[3]);
		$nm_pengawas = strtoupper($data[4]);
		$seri = strtoupper($data[5]);

		$data['stamping'] = $this->M_stamping->filter($tgl1,$tgl2,$nm_operator,$nm_qc,$nm_pengawas,$seri);	
		$this->load->view('stamping/v_barcode_table',$data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$kode_roll = $data[0];
		$id_operator = $data[1];
		$id_qc = $data[2];
		$urut_pp = $data[3];
		$ukuran = $data[4];
		$id_pengawas = $data[5];

		$qty_edit = $this->M_stamping->qty_edit($kode_roll);
		if ($qty_edit == 0) {
			$urut = $this->M_stamping->urut();
			$this->M_stamping->simpan($urut, $kode_roll, $id_operator, $id_qc, $urut_pp, $ukuran, $id_pengawas);
		}else{
			$this->M_stamping->update($kode_roll, $id_operator, $id_qc, $urut_pp, $ukuran, $id_pengawas);
		}
	}

	function cutter() {
		$data = $this->input->post('data');
		$pp_cutter = $data[0];
		$desain = $data[1];

		$data = $this->M_stamping->cutter($pp_cutter,$desain);	
		print_r(json_encode($data));
	}

}

?>