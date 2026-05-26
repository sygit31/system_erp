<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class satuan extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('vin/m_satuan_perdana');
		session_start();
	}

	function show_satuan() {    
		$data['satuan'] = $this->m_satuan_perdana->show_satuan_perdana();   	
		$this->load->view('vin/rnd/perdana/master/satuan/v_satuan.php',$data);
	}

	function simpan_satuan_perdana() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$satuan = $data[1];
		
		
		$this->m_satuan_perdana->simpan_satuan_perdana($id_edit,$satuan);
	}

	function simpan_konversi_perdana() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$satuan_awal = $data[1];
		$nama_konversi = $data[2];
		$satuan_akhir = $data[3];
		$konversi = $data[4];
		$this->m_satuan_perdana->simpan_konversi_perdana($id_edit,$satuan_awal,$nama_konversi,$satuan_akhir,$konversi);
	}


	function filter_satuan() {
		$cari = strtoupper($this->input->post('data'));

		$data['satuan'] = $this->m_satuan_perdana->filter_satuan($cari);   	
		$this->load->view('vin/rnd/perdana/master/satuan/v_satuan_table',$data);
	}
     
	function filter_konversi() {
		$data = $this->input->post('data');
		$cari = $data[0];
		$id_awal = $data[1];

		$data['konversi'] = $this->m_satuan_perdana->filter_konversi($cari,$id_awal);   	
		$this->load->view('vin/rnd/perdana/master/satuan/v_konversi_table',$data);
	}


   function show_konversi() {  
	    $id = $this->input->GET('id'); 
		$data['satuans_awal'] = $this->input->GET('satuan_awal');   
		$data['konversi'] = $this->m_satuan_perdana->show_konversi_satuan($id);  
		$data['akhir'] = $this->m_satuan_perdana->show_satuan_akhir($id);
		$data['id_awal']=$id;
		//print_r($data); 
		
		$this->load->view('vin/rnd/perdana/master/satuan/v_konversi.php',$data);
		
	}
  function show_satuan_akhir() {    
		$data['satuan_akhir'] = $this->m_satuan_perdana->show_satuan_akhir();   	
	}
}

?>
