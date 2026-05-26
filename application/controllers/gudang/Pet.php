<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pet extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_pet');
		session_start();
	}

	function index() {
		$data['desain'] = $this->M_pet->desain();	     	
		$data['material'] = $this->M_pet->material();	  	
		$this->load->view('gudang/v_pet',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$periode_sp = date('ym', strtotime($data[0]));
		$desain = $data[2];
		$tgl[] = '';

		$period = new DatePeriod(
			new DateTime(date('Y-m-d', strtotime($data[0]))),
			new DateInterval('P1D'),
			new DateTime(date('Y-m-d', strtotime($data[1])) . '+1 day')
		);
		foreach ($period as $dt) {
			$tgl[] = $dt->format('d-M-Y');
		}

		$id_barang = $this->M_pet->id_barang($desain);
		$saldo_awal = $this->M_pet->saldo_awal($tgl1, $id_barang);
		$saldo_masuk = $this->M_pet->saldo_masuk($tgl1, $id_barang);
		$saldo_keluar = $this->M_pet->saldo_keluar($tgl1, $id_barang);
		$masuk = $this->M_pet->masuk($tgl1,$tgl2,$id_barang);
		$keluar = $this->M_pet->keluar($tgl1,$tgl2,$id_barang);
		$retur_produksi = $this->M_pet->retur_produksi($tgl1,$tgl2,$id_barang);
		$retur_suppplier = $this->M_pet->retur_suppplier($tgl1,$tgl2,$id_barang);

		print_r(json_encode(array($tgl,$saldo_awal,$saldo_masuk,$saldo_keluar,$masuk,$keluar,$retur_produksi,$retur_suppplier)));
	}

}