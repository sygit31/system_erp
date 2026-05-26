<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wip_pet extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_wip_pet');
		session_start();
	}

	function index() {
		$data['seri'] = $this->M_wip_pet->seri();
		$data['kk'] = $this->M_wip_pet->kk();
		$data['pengawas_produksi'] = $this->M_wip_pet->pengawas_produksi();
		$data['pengawas_gudang'] = $this->M_wip_pet->pengawas_gudang();
		$data['approval'] = $this->M_wip_pet->approval();
		$data['desain'] = $this->M_wip_pet->desain();

		$this->load->view('produksi/v_wip_pet.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$seri = $data[2];
		$kk = $data[3];
		$desain = $data[4];

		$data['filter'] = $this->M_wip_pet->filter($tgl1, $tgl2, $seri, $kk, $desain);
		$this->load->view('produksi/v_wip_pet_table', $data);
	}

	function simpan_ipb() {
		$data = $this->input->post('data');
		$nmr_mutasi = $data[0];
		$nmr_ipb = $data[1];
		$tgl = date('d-m-Y', strtotime($data[2]));
		$id_pengawas_produksi = $data[3];
		$id_pengawas_gudang = $data[4];
		$id_approval = $data[5];
		$nama_barang = 'Foil BCRI Uk. 37.5 Cm';

		$dt_roll = $this->M_wip_pet->dt_roll($nmr_mutasi);
		for ($i=0; $i<count($dt_roll); $i++) {
			$urut = $this->M_wip_pet->urut();
			$id_prod_mutasi = $dt_roll[$i]['ID'];

			$this->M_wip_pet->simpan_ipb($urut,  $tgl, $nama_barang, $nmr_mutasi, $nmr_ipb, $id_prod_mutasi,$id_pengawas_produksi, $id_pengawas_gudang, $id_approval);
		}
	}

	function cetak() {
		$data = $this->input->post('data');
		$kk = $data[0];
		$ipb = $data[1];

		$data = $this->M_wip_pet->cetak($kk, $ipb);
		print_r(json_encode($data));
	}

}
