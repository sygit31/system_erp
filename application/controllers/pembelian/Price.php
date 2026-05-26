<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('pembelian/M_price');
		session_start();
	}

	function index() {
		$data['rfq'] = $this->M_price->show_rfq();
		$data['price'] = $this->M_price->show_price();
		$this->load->view('pembelian/v_price.php',$data);
	}

	function filter_price() {
		$data = $this->input->post('data');
		$cari_material = strtoupper($data[0]);

		$data['price'] = $this->M_price->filter_price($cari_material);
		$this->load->view('pembelian/v_price_table.php',$data);
	}

	function simpan_price()	{
		$data = $this->input->post('data');
		$id_rfq = $data[0];
		$no_quotation = $data[1];
		$net_price = $data[2];
		$mata_uang = $data[3];
		$deltime = date('d-m-Y',strtotime($data[4]));
		$id_price = $data[5];

		if ($id_price == '') {
			$id_price = $this->M_price->urut_price();
			$this->M_price->simpan_price($id_price,$id_rfq,$no_quotation,$net_price,$mata_uang,$deltime);
		}else{
			$this->M_price->update_price($id_price,$id_rfq,$no_quotation,$net_price,$mata_uang,$deltime);
		}
	}

	function hapus_price() {
		$data = $this->input->post('data');
		$id_hapus_price = $data[0];

		$data = $this->M_price->hapus_price($id_hapus_price);
	}

	function edit_price() {
		$data = $this->input->post('data');
		$id_price = $data[0];

		$data = $this->M_price->edit_price($id_price);
		print_r(json_encode($data));
	}

}

?>