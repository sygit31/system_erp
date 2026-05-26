<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bastb extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('M_detail_penerimaan');
		$this->load->model('M_nomer');
		session_start();
	}
	
	function index() {
		$data['stok'] = $this->M_detail_penerimaan->getStok();
		
		$this->load->view('gudang/v_bastb.php',$data);
	}

	function terima_barang() {
		if(isset($_POST["cbTerima"]))
		{
	  			// print_r($_POST["cbTerima"]);
			$CRE = explode('|',$_SESSION['logERP']);
			$ArrIdDetailTerima = $this->input->POST('cbTerima');
			$nBASTB = $this->M_nomer->getNomerBASTB();

			$nomer = $nBASTB[0]->BASTB;

			$data['nomer'] = $nomer + 1;
			$data['id_input'] = $CRE[0];

				//Save Reject
			$success = true;
			$success = $this->m_bastb->save($data);

			if ($success) {
				
			}



		}
	}
}
?>