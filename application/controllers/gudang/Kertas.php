<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kertas extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('gudang/M_kertas');
		session_start();
	}

	function index() {
		$data['desain'] = $this->M_kertas->desain();
		$data['bahan'] = $this->M_kertas->bahan();
		$data['spp'] = $this->M_kertas->spp();
		$data['toleransi'] = $this->M_kertas->toleransi();
		$this->load->view('gudang/v_terima_kertas.php', $data);
	}

	function isi_bahan() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$lebar = $data[1];

		$kode_bahan = $this->M_kertas->isi_bahan($desain, $lebar);
		$no_spp = $this->M_kertas->no_spp($kode_bahan);
		print_r(json_encode(array($kode_bahan, $no_spp)));
	}

	function f_filter()	{
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$ukuran = $data[2];
		$status = $data[3];
		$desain = $data[4];

		$data = $this->M_kertas->f_filter($tgl1, $tgl2, $ukuran, $status, $desain);
		print_r(json_encode($data));
	}

	function filter()	{
		$data = $this->input->post('data');
		$gudang['terima_kertas'] = $this->M_kertas->filter($data);
		$this->load->view('gudang/v_terima_kertas_table.php',$gudang);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$barcode = $data[1];
		$tgl = date('Y-m-d', strtotime($data[2]));
		$desain = $data[3];
		$kode_bahan = $data[4];
		$spp = $data[5];
		$no_npk = $data[6];
		$kode_roll = $data[7] . '/' . $desain;
		$berat_pdl = $data[8];
		$berat_pnp = $data[9];
		$netto = $data[10];
		$id_toleransi = $data[11];
		$id_timbang_ulang = $data[12];

		if ($id_edit == '') {
			$id_edit = $this->M_kertas->urut();
			$this->M_kertas->simpan($id_edit, $barcode, $tgl, $desain, $kode_bahan, $spp, $no_npk, $kode_roll, $berat_pdl, $berat_pnp, $netto, $id_toleransi);
		}else{
			$this->M_kertas->update($id_edit, $barcode, $tgl, $desain, $kode_bahan, $spp, $no_npk, $kode_roll, $berat_pdl);
		}

		$this->upload_timbang($id_timbang_ulang, $id_edit, $kode_roll, $berat_pnp);
	}

	function upload_timbang($id_timbang_ulang, $id_masuk, $kode_roll, $berat_pnp) {
		if ($berat_pnp == '') {
			if ($id_timbang_ulang != '') {$this->M_kertas->hapus_timbang($id_timbang_ulang);}
			return;
		}else{
			$id_toleransi = $this->M_kertas->id_toleransi($kode_roll)[0];
			$uk = $this->M_kertas->id_toleransi($kode_roll)[1];
			$berat_timbangan = $berat_pnp + $uk;

			if ($id_timbang_ulang == '') {
				$id_timbang_ulang = $this->M_kertas->urut_timbang();
				$this->M_kertas->simpan_timbang($id_timbang_ulang, $id_masuk, $berat_pnp, $berat_timbangan, $id_toleransi);
			}else{
				$this->M_kertas->update_timbang($id_timbang_ulang, $id_masuk, $berat_pnp, $berat_timbangan, $id_toleransi);
			}
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');

		$data = $this->M_kertas->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_kertas->hapus($id_hapus);
	}

	function ekspedisi_kertas() {  	
		$data['ekspedisi_kertas'] = $this->M_kertas->ekspedisi_kertas();	    	
		$this->load->view('gudang/v_ekspedisi.php',$data);
	}

	function filter_ekspedisi() {
		$data = $this->input->post('data');
		$date1 = date_create($data[0]);
		$date2 = date_create($data[1]);
		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');
		$ukuran = $data[2];
		if ($ukuran == '73 Cm') {$ukuran = 'A';}else{$ukuran = 'B';}

		$data['ekspedisi_kertas']=$this->M_kertas->filter_ekspedisi($tgl1, $tgl2, $ukuran);
		$this->load->view('gudang/v_ekspedisi_table',$data);
	}

}