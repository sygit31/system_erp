<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_mutasi_pet extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/m_lap_mutasi_pet');
		session_start();
	}

	function index() {
		$data['desain'] = $this->m_lap_mutasi_pet->get_desain();

		$this->load->view('produksi/v_lap_mutasi_pet.php',$data);
		
	}
	
	function get_kode_flow()
	{
		$desain = $this->input->post('data');
		$get_kode = $this->m_lap_mutasi_pet->get_kode_flow($desain);
		
		print_r(json_encode(array($get_kode)));
		
	}

	function get_proses_awal()
	{
		$kode_flow = $this->input->post('data');
		$get_proses_awal = $this->m_lap_mutasi_pet->get_proses_awal($kode_flow);
		
		print_r(json_encode(array($get_proses_awal)));
		
	}
	
	function get_proses_akhir()
	{
		$data = $this->input->post('data');
		$desain = $data[0];
		$nama_proses_awal = $data[1];
		$kode_flow = $data[3];
		$get_proses_akhir = $this->m_lap_mutasi_pet->get_proses_akhir($desain,$nama_proses_awal,$kode_flow);
		$tanggal = date('ymd', strtotime($data[2]));
		$get_kk = $this->m_lap_mutasi_pet->get_kk($nama_proses_awal,$tanggal);
		print_r(json_encode(array($get_proses_akhir,$get_kk)));
	}
	
	function get_info_kk_per_mutasi()
	{
		$data = $this->input->post('data');
		$nama_proses_awal = $data[0];
		$tanggal = date('ymd', strtotime($data[1]));
		$kk = $data[2];
		$get_nomor_mutasi = $this->m_lap_mutasi_pet->get_nomor_mutasi($nama_proses_awal,$tanggal,$kk);
		print_r(json_encode(array($get_nomor_mutasi)));
	}
	
	function info_kk() {
		$kk = $this->input->post('data');
		$info_kk = $this->m_lap_pet->info_kk($kk);
		$info_roll = $this->m_lap_pet->info_roll($kk);

		print_r(json_encode(array($info_kk,$info_roll)));
	}
	
	function info_no_mutasi() {
		$data = $this->input->post('data');
		$nama_proses_awal = $data[0];
		$tanggal = date('ymd', strtotime($data[1]));
		$kk = $data[2];
		$no_mutasi = $data[3];
		$info_no_mutasi = $this->m_lap_mutasi_pet->info_no_mutasi($nama_proses_awal,$tanggal,$kk,$no_mutasi);
		
		print_r(json_encode(array($info_no_mutasi)));
	}

}
?>
