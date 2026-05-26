<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_sip extends CI_Controller{

	function __construct() {
		parent::__construct();
		
		$this->load->model('pembelian/M_lap_sip');
		session_start();
	}

	function index() {
		$data['karyawan'] = $this->M_lap_sip->karyawan();
		$data['bagian'] = $this->M_lap_sip->show_bagian();
		$data['kd_kategori'] = $this->M_lap_sip->kd_kategori();
		$data['unit'] = $this->M_lap_sip->unit();
		$data['nmr'] = $this->M_lap_sip->nmr();
		$data['bahan'] = $this->M_lap_sip->bahan();

		$this->load->view('pembelian/v_lap_sip.php',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$nmr = $data[2];
		$bagian = $data[3];
		$id_kary = $data[4];
		$status = $data[5];
		$kd_unit = $data[6];
		$kd_kategori = $data[7];
		if ($status == 'Open') {
			$final = 'F';
		}elseif ($status == 'Close') {
			$final = 'T';
		}else{
			$final = 'All';
		}
		$id_barang = $data[8];

		$data['filter'] = $this->M_lap_sip->filter($tgl1, $tgl2, $nmr, $bagian, $id_kary, $final, $kd_unit, $kd_kategori, $id_barang);
		$this->load->view('pembelian/v_lap_sip_table.php',$data);
	}

	function finals() {
		$data = $this->input->post('data');
		$id_sip_detail = $data[0];
		$tgl = $data[1];
		$nmr = $data[2];

		if ($nmr == '') {print_r('0'); return;}
		$id_sip_bskk = $this->M_lap_sip->id_sip_bskk();
		$this->M_lap_sip->finals($id_sip_bskk,$id_sip_detail,$tgl,$nmr);
	}

	function upload_manual_simpg() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$dt_sip = $data[1];

		for ($i=0; $i<count($dt_sip); $i++) {
			$nmr = $dt_sip[$i];
			$cek_simpg = $this->M_lap_sip->cek_simpg($kd_unit, $nmr);

			if ($cek_simpg == 0) {
				$this->upload_simpg($nmr);
			}
		}
	}

	function upload_simpg($nmr) {
		$this->M_lap_sip->hapus_simpg($nmr);		

		$data_sip = $this->M_lap_sip->data_sip($nmr);
		if (count($data_sip) == 0) {return;}

		$nmr_sip = $data_sip[0]['NO_SIP'];
		$kode_departemen = $data_sip[0]['KODE_DEPARTEMEN'];
		$tanggal = $data_sip[0]['TANGGAL'];
		$username = strtoupper($data_sip[0]['USERNAME']);
		$kode_unit = $data_sip[0]['KD_UNIT'];
		$kode_proyek = 'REG';

		if ($kode_unit == '01') {
			$kode_sub_unit = '4';
			$alokasi = '3A';
		}else{
			$kode_sub_unit = '2';
			$alokasi = '2A';;
		}

		$this->M_lap_sip->simpan_header_simpg($nmr_sip, $kode_departemen, $tanggal, $username, $kode_unit, $kode_proyek, $kode_sub_unit);

		$urut_sip = 0;
		foreach ($data_sip as $dt) {
			$urut_sip = sprintf('%02d', $dt['URUT_SIP']);
			$nmr_sip = $dt['NO_SIP'];
			$kode_barang = $dt['KODE_SIMPG'];
			$satuan = $dt['SATUAN'];
			$nomer_rekjurnal = $dt['NO_REKJURNAL'];
			$qty = $dt['QTY'];
			$deadline = $dt['DEADLINE'];
			$keterangan = $dt['KETERANGAN'];

			$final = 'F';
			$no_rekkredit = '2101.01';

			$this->M_lap_sip->simpan_detail_simpg($nmr_sip, $kode_barang, $satuan, $nomer_rekjurnal, $qty, $final, $alokasi, $urut_sip, $no_rekkredit, $deadline, $keterangan, $kode_unit);
		}

		$this->M_lap_sip->update_upload($nmr_sip, $kode_unit);
	}

}