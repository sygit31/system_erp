<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_nilai');
		session_start();
	}

	function show_nilai()	{
		// $this->load->view('administrator/v_error'); return;

		if(!isset($_SESSION['logERP'])) {header("location:". base_url());}
		
		$kary = explode('|',$_SESSION['logERP']);
		$id_kary = $kary[0];

		$data['nilai'] = $this->M_nilai->show_nilai($id_kary);
		$data['tanggal'] = $this->M_nilai->show_periode($id_kary);
		$data['unlock'] = $this->M_nilai->unlock($id_kary);
		$this->load->view('sistem/v_nilai',$data);
	}

	function preview_penilai() {
		$data = $this->input->post('data');
		$id_penilai = $data[0];
		$kategori = $data[1];
		$periode = date_format(date_create($data[2]),'Ym');
		$previous = $data[3];		
		$unit = $data[4];		
		$status = $data[5];		
		$last_periode = $this->M_nilai->ambil_periode_terakhir($id_penilai,$kategori,$periode);

		if ($previous == '0') {$previous = $periode;}else{$previous = $last_periode;}

		$data = $this->M_nilai->preview_penilai($id_penilai,$kategori,$periode,$previous,$unit,$status);
		print_r(json_encode($data));
	}

	function ambil_kategori()	{
		$id_kary = $this->input->post('data');

		$data = $this->M_nilai->ambil_kategori($id_kary);
		print_r(json_encode($data));
	}

	function filter_nilai()	{
		$data = $this->input->post('data');
		$id_kary = $data[0];
		$periode = $data[1];
		$kategori = $data[2];
		$cari = strtoupper($data[3]);

		$data['nilai'] = $this->M_nilai->filter_nilai($id_kary,$periode,$kategori,$cari);
		$this->load->view('sistem/v_nilai_table',$data);
	}

	function simpan_nilai()	{
		$data = $this->input->post('data');

		if (!isset($data[2])) {return;}
		$periode = date('d-m-Y',strtotime($data[2]));;
		$id_sis_nilai = $this->M_nilai->urut();

		for ($i=0; $i<count($data[0]); $i++) {
			if ($data[8][$i] != '') {
				$id_sis_kategori = $data[0][$i];
				$id_edit_nilai = $data[1][$i];
				$n1 = str_replace(',', '.', $data[3][$i]);
				$n2 = str_replace(',', '.', $data[4][$i]);
				$n3 = str_replace(',', '.', $data[5][$i]);
				$n4 = str_replace(',', '.', $data[6][$i]);
				$n5 = str_replace(',', '.', $data[7][$i]);
				$n_total = str_replace(',', '.', $data[8][$i]);
				if ($id_edit_nilai == '') {
					$this->M_nilai->simpan_nilai($id_sis_nilai,$id_sis_kategori,$periode,$n1,$n2,$n3,$n4,$n5,$n_total);
					$id_sis_nilai++;
				}else{
					$this->M_nilai->edit_nilai($id_edit_nilai,$id_sis_kategori,$periode,$n1,$n2,$n3,$n4,$n5,$n_total);
				}
			}
		}
	}

	function edit_nilai()	{
		$data = $this->input->post('data');
		$id_penilai = $data[0];
		$periode = $data[1];
		$kategori = $data[2];
		
		$data = $this->M_nilai->edit_nilai($id_penilai,$periode,$kategori);
		print_r(json_encode($data));
	}

}

?>