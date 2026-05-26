<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sip extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('ppic/M_sip');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function show_sip() {
		$data['satuan'] = $this->M_sip->satuan();
		$data['karyawan'] = $this->M_sip->karyawan();
		$data['bagian'] = $this->M_sip->bagian();
		$data['unit'] = $this->M_sip->unit();
		$data['no_sip'] = $this->M_sip->no_sip();
		$data['material'] = $this->M_sip->material();
		$data['kd_kategori'] = $this->M_sip->kd_kategori();

		$this->load->view('ppic/v_sip', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$cari = strtoupper($data[2]);
		$status = $data[3];
		if ($status == 'Open') {
			$final = 'F';
		} elseif ($status == 'Close') {
			$final = 'T';
		} else {
			$final = 'All';
		}
		$kd_unit = $data[4];
		$no_sip = $data[5];
		$kd_kategori = $data[6];
		
		$data['sip'] = $this->M_sip->filter($tgl1, $tgl2, $cari, $final, $kd_unit, $no_sip, $kd_kategori);
		$this->load->view('ppic/v_sip_table', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$year = date('y', strtotime($data[0]));
		$month = date('m', strtotime($data[0]));
		$kd_unit = $data[1];
		$id_sip = $data[2];
		$kode_dept = $data[3];
		
		$urut_sip = $this->M_sip->auto_no($year, $kode_dept, $kd_unit, $id_sip);
		print_r(json_encode(array($urut_sip, $kode_dept, $month, $year)));
	}

	function ck_nmr() {
		$no_sip = $this->input->post('data');		
		$dt_sip = $this->M_sip->ck_nmr($no_sip);
		$dt_po = $this->M_sip->ck_po($no_sip);
		print_r(json_encode(array($dt_sip, $dt_po)));
	}

	function ck_block() {
		$id_materials = $this->input->post('data');		
		$dt_block = $this->M_sip->ck_block_id_barang($id_materials);
		print_r(json_encode($dt_block));	
	}

	function simpan() {
		$data = $this->input->post('data');
		$tanggal = date('d-m-Y', strtotime($data[0]));
		$nmr_sip = $data[1];
		$sifat = $data[2];
		$kd_unit = $data[3];
		$material = $data[4];
		$id_sip = $data[5];
		$persediaan = $data[6];

		$kary = $this->M_sip->karyawan();
		$id_kary = $kary[4];

		if ($id_sip != '') {
			$this->M_sip->hapus_sip($id_sip, $nmr_sip);
		}

		$id_sip = $this->M_sip->urut_sip();
		$this->M_sip->simpan($id_sip, $tanggal, $id_kary, $nmr_sip, $sifat, $kd_unit, $persediaan);

		for ($i = 0; $i < count($material[0]); $i++) {
			$urut_sip = $i + 1;
			$id_material = $material[0][$i];
			$qty = $material[1][$i];
			$deadline = date('d-m-Y', strtotime($material[2][$i]));
			$keterangan = $material[3][$i];
			$satuan = $material[4][$i];
			$kd_kategori = $material[5][$i];

			$id_sip_detail = $this->M_sip->urut_sip_detail();
			$this->M_sip->simpan_detail($id_sip_detail, $id_sip, $id_material, $qty, $deadline, $urut_sip, $keterangan, $satuan, $kd_kategori);
		}

		$this->upload_sakti($nmr_sip);
		$this->upload_simpg($nmr_sip);
	}

	function edit() {
		$id_sip_detail = $this->input->post('data');
		$data = $this->M_sip->edit($id_sip_detail);
		print_r(json_encode($data));
	}

	function batal() {
		$data = $this->input->post('data');
		$id_sip_detail = $data[0];
		$id_sip = $data[1];
		$nmr = $data[2];

		$this->M_sip->batal($id_sip_detail, $id_sip);
		$this->upload_sakti($nmr);
	}

	function cetak() {
		$id_sip_detail = $this->input->post('data');

		$data = $this->M_sip->cetak($id_sip_detail);
		print_r(json_encode($data));
	}

	function upload_manual_simpg() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$dt_sip = $data[1];

		for ($i=0; $i<count($dt_sip); $i++) {
			$nmr = $dt_sip[$i];
			$cek_simpg = $this->M_sip->cek_simpg($kd_unit, $nmr);

			if ($cek_simpg == 0) {$this->upload_simpg($nmr);}
		}
	}


	// ========================================  Menu SIMPG  ========================================
	// ==============================================================================================

	function upload_simpg($nmr) {
		$this->M_sip->hapus_simpg($nmr);		

		$data_sip = $this->M_sip->data_sip($nmr);
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

		$this->M_sip->simpan_header_simpg($nmr_sip, $kode_departemen, $tanggal, $username, $kode_unit, $kode_proyek, $kode_sub_unit);

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

			$this->M_sip->simpan_detail_simpg($nmr_sip, $kode_barang, $satuan, $nomer_rekjurnal, $qty, $final, $alokasi, $urut_sip, $no_rekkredit, $deadline, $keterangan, $kode_unit);
		}
	}


	// ========================================  Menu SAKTI  ========================================
	// ==============================================================================================

	function upload_sakti($nmr) {
		
		if ($nmr != '') {
			$year = substr($nmr, -2);
			$urut = substr($nmr, 0, 4);
			$kode_departemen = substr($nmr, 13, 2);
			$nmr_sakti = $year . $urut . $kode_departemen;
			$this->M_sip->hapus_sakti($nmr, $nmr_sakti);
		}
       
		$data_sip = $this->M_sip->data_sip($nmr);
		
		if (count($data_sip) == 0) {return;}
		
		$tanggal = $data_sip[0]['TANGGAL'];
		$no_sip = trim($data_sip[0]['NO_SIP']);
		$kode_unit = $data_sip[0]['KD_UNIT'];
		$kode_departemen = $data_sip[0]['KODE_DEPARTEMEN'];
		$username = strtoupper($data_sip[0]['USERNAME']);
		$year = substr($tanggal, -2);
		$urut = substr($no_sip, 0, 4);
		$nmr_sip = $year . $urut . $kode_departemen;

		$this->M_sip->simpan_header_sakti($tanggal, $nmr_sip, $kode_unit, $kode_departemen, $username);

		foreach ($data_sip as $dt) {
			$urut_sip = sprintf('%02d', $dt['URUT_SIP']);
			$nama_barang = substr($dt['NAMA_BARANG'] . ' ' . $dt['SPESIFIKASI'],0,60);
			$qty = str_replace('.', ',', $dt['QTY']);
			$satuan = $dt['SATUAN'];
			$kode_barang = $dt['KODE_SIMPG'];
			$spesifikasi = $dt['SPESIFIKASI'];

			$this->M_sip->simpan_detail_sakti($kode_unit, $nmr_sip, $urut_sip, $nama_barang, $qty, $satuan, $kode_barang, $spesifikasi);
		}
      
		$this->M_sip->update_upload($no_sip, $kode_unit);
     
	}
     
}
