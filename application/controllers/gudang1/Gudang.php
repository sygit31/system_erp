<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('M_gudang');
		session_start();
	}

	function terima_kertas()
	{  	
		$data['terima_kertas'] = $this->M_gudang->terima_kertas();	    	
		$this->load->view('gudang/v_terima_kertas.php',$data);
	}

	function filter_terima_kertas()	{
		$data = $this->input->post('data');
		$gudang['terima_kertas'] = $this->M_gudang->filter_terima_kertas($data);
		$this->load->view('gudang/v_terima_kertas_table.php',$gudang);
	}

	function ekspedisi_kertas()
	{  	
		$data['ekspedisi_kertas'] = $this->M_gudang->ekspedisi_kertas();	    	
		$this->load->view('gudang/v_ekspedisi.php',$data);
	}

	function filter_ekspedisi_kertas() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');
		$ukuran = $data[2];
		if ($ukuran == '73 Cm') {$ukuran = 'A';}else{$ukuran = 'B';}

		$data['ekspedisi_kertas']=$this->M_gudang->filter_ekspedisi_kertas($tgl1, $tgl2, $ukuran);
		$this->load->view('gudang/v_ekspedisi_table',$data);
	}

}

?>