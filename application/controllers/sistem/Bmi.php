<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bmi extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_bmi');
		$this->load->model('hrd/M_karyawan');
		session_start();
	}

	function show_bmi()	{
		$data['bagian'] = $this->M_bmi->show_bagian();
		$data['unit'] = $this->M_bmi->unit();

		$this->load->view('sistem/v_bmi',$data);
	}

	function simpan_bmi() {
		$data = $this->input->post('data');
		$id_karyawan = $data[0];
		$id_bmi = $data[1];
		$tinggi = $data[2];
		$berat = $data[3];

		if ($id_bmi == '') {
			$id_bmi = $this->M_bmi->urut_bmi();
			$this->M_bmi->simpan_bmi($id_bmi,$id_karyawan,$tinggi,$berat);
		}else{
			$this->M_bmi->edit_bmi($id_bmi,$id_karyawan,$tinggi,$berat);			
		}
		print_r($id_bmi);
	}

	function simpan_all() {
		$data = $this->input->post('data');

		for ($i=0; $i<count($data[0]); $i++) {
			$id_karyawan = $data[0][$i];
			$id_bmi = $data[1][$i];
			$tinggi = $data[2][$i];
			$berat = $data[3][$i];

			if ($id_bmi == '') {
				$id_bmi = $this->M_bmi->urut_bmi();
				$this->M_bmi->simpan_bmi($id_bmi, $id_karyawan, $tinggi, $berat);
			}else{
				$this->M_bmi->edit_bmi($id_bmi, $id_karyawan, $tinggi, $berat);			
			}
		}
	}

	function filter_bmi()	{
		$data = $this->input->post('data');
		$bagian = $data[0];
		$unit = $data[1];

		$data['bmi'] = $this->M_bmi->filter_bmi($bagian, $unit);	 
		$this->load->view('sistem/v_bmi_table',$data);
	}

	function laporan_bmi()	{
		$data['periode'] = $this->M_bmi->get_year();
		$data['bagian'] = $this->M_bmi->show_bagian();
		$this->load->view('sistem/v_laporan_bmi',$data);
	}

	function get_data()	{
		$year = $this->input->post('data');
		$data['periode'] = $this->M_bmi->periode_bmi($year);
		$data['laporan'] = $this->M_bmi->laporan_bmi($year);
		print_r(json_encode($data));
	}

	function filter_data()	{
		$data = $this->input->post('data');
		$year = $data[0];
		$unit = $data[1];
		$bagian = $data[2];
		$min = str_replace('.',',',$data[3]);
		$max = str_replace('.',',',$data[4]);
		$nama = strtoupper($data[5]);
		
		$data = array($min,$max);
		$data['periode'] = $this->M_bmi->filter_periode_bmi($year);
		$data['laporan'] = $this->M_bmi->filter_laporan_bmi($year,$unit,$bagian,$min,$max,$nama);
		print_r(json_encode($data));
	}

}

?>