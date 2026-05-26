<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rfq extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('pembelian/M_rfq');
		session_start();
	}

	function index() {
		$data['rfq'] = $this->M_rfq->show_rfq();
		$data['supplier'] = $this->M_rfq->show_supplier();
		$data['barang'] = $this->M_rfq->show_barang();
		$this->load->view('pembelian/v_rfq.php',$data);
	}

	function auto_no() {
		$tahun = $this->input->post('data');
		$urut = $this->M_rfq->auto_no($tahun);
		print_r(sprintf('%03d', $urut));
	}

	function simpan_rfq()	{
		$data = $this->input->post('data');
		$nmr = $data[0];
		$tgl = date('d-m-Y',strtotime($data[1]));
		$deadline = date('d-m-Y',strtotime($data[2]));
		$id_supplier  = $data[3];
		$deltime = date('d-m-Y',strtotime($data[4]));
		$id_material  = $data[5];
		$qty = $data[6];
		$storage = $data[7];
		$id_rfq = $data[8];

		if ($id_rfq == '') {
			$id_rfq = $this->M_rfq->urut_rfq();
			$this->M_rfq->simpan_rfq($id_rfq,$nmr,$tgl,$deadline,$id_supplier,$deltime,$id_material,$qty,$storage,$id_rfq);
		}else{
			$this->M_rfq->update_rfq($id_rfq,$nmr,$tgl,$deadline,$id_supplier,$deltime,$id_material,$qty,$storage,$id_rfq);
		}
	}

	function filter_rfq() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');
		$cari_material = strtoupper($data[2]);
		$cari_supplier = strtoupper($data[3]);

		$data['rfq'] = $this->M_rfq->filter_rfq($tgl1,$tgl2,$cari_material,$cari_supplier);
		$this->load->view('pembelian/v_rfq_table.php',$data);
	}

}

?>