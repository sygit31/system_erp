<?php defined('BASEPATH') or exit('No direct script access allowed');

class Po extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('pembelian/M_po');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['satuan'] = $this->M_po->satuan();
		$data['unit'] = $this->M_po->unit();
		$data['supplier'] = $this->M_po->supplier();
		$data['bayar'] = $this->M_po->bayar();
		$data['no_po'] = $this->M_po->no_po();
		$data['jenis'] = $this->M_po->jenis();
		$data['jenis_bahan'] = $this->M_po->jenis_bahan();
		$data['kategori'] = $this->M_po->kategori();
		$data['bahan'] = $this->M_po->bahan();

		$data['data_deadline'] = $this->M_po->data_deadline();
		$this->load->view('pembelian/v_po.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$supplier = $data[2];
		$nmr_po = $data[3];
		$kd_unit = $data[4];
		$jenis = $data[5];
		$kategori_hpd = $data[6];
		$kategori = $data[7];
		$id_barang = $data[8];

		$data['data'] = $this->M_po->filter($tgl1, $tgl2, $supplier, $nmr_po, $kd_unit, $jenis, $kategori_hpd, $kategori, $id_barang);
		$this->load->view('pembelian/v_po_table.php', $data);
	}

	function filter_deadline() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$supplier = $data[2];
		$nmr_po = $data[3];
		$unit = $data[4];
		$jenis = $data[5];
		$cari = strtoupper($data[6]);
		$kategori = $data[7];

		$data['data_deadline'] = $this->M_po->filter_deadline($tgl1, $tgl2, $supplier, $nmr_po, $unit, $jenis, $cari, $kategori);
		$this->load->view('pembelian/v_po_deadline_table.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$bln = date('m', strtotime($data[1]));
		$thn = date('y', strtotime($data[1]));
		$jenis = $data[2];
		$id_supplier = $data[3];
		$kd_unit = trim($data[4], ' ');
		$kd_transaksi = $data[5];
		$kd_jenis = $data[6];

		$nmr_po = $this->M_po->auto_no($id_edit, $bln, $thn, $jenis, $id_supplier, $kd_unit, $kd_transaksi, $kd_jenis);
		$investasi = $this->M_po->investasi($kd_unit);

		print_r(json_encode(array($nmr_po, $investasi)));
	}

	function data_sip() {
		$data = $this->input->post('data');
		$id_supplier = $data[0];
		$kd_unit = $data[1];

		$data = $this->M_po->data_sip($id_supplier, $kd_unit);
		print_r(json_encode($data));
	}

	function cek_budget() {
		$data = $this->input->post('data');
		$kode_unit = $data[0];
		$periode = date('ym', strtotime($data[1]));
		$dt_material = $data[2];
		$dt_harga = $data[3];
		$id_edit = $data[4];

		$dt_rekjurnal = array();
		for ($i=0; $i<count($dt_material); $i++) {
			$id = $dt_material[$i];
			$rekjurnal = $this->M_po->rekjurnal($id);
			array_push($dt_rekjurnal, $rekjurnal);
		}

		for ($i=0; $i<count($dt_rekjurnal); $i++) {
			$rekjurnal = $dt_rekjurnal[$i];
			$total_harga = 0;	
			$urut = 0;		

			// Total harga untuk semua rekening jurnal terkait
			foreach ($dt_rekjurnal as $dt) {
				if ($rekjurnal == $dt) {
					$total_harga = $total_harga + $dt_harga[$urut];
				}
				$urut++;
			}

			$sisa_budget = $this->M_po->sisa_budget($kode_unit, $periode, $rekjurnal);
			$sisa_budget = $sisa_budget == null ? 0 : $sisa_budget;
			$harga_edit = $this->M_po->harga_edit($id_edit, $rekjurnal);
			$sisa = str_replace(',','.',$sisa_budget) + str_replace(',','.',$harga_edit) - $total_harga;

			if ($sisa < 0) {
				$kurang = abs($sisa);
				print_r(json_encode(array($rekjurnal,$sisa)));
				return;
			}
		}
	}

	function cek_nomor() {
		$data = $this->input->post('data');
		$nmr_po = $data[0];
		$kode_unit = $data[1];
		$id_edit = $data[2];
		$id_supplier = $data[3];
		$investasi = $data[4];
		$tgl = date('ymd', strtotime($data[5]));
		$kode_keuangan = $data[6];

		$urut_po = substr($nmr_po,0,6);
		$thn = substr($nmr_po,-2);
		$jenis = substr($nmr_po,15,1);
		$nmr_sakti = $thn . $urut_po . $jenis;

		$data = $this->M_po->cek_nomor($urut_po, $kode_unit, $thn, $id_edit, $nmr_po, $jenis);
		$cek_validasi = $this->M_po->cek_validasi($nmr_sakti, $kode_unit);
		$cek_npwp_supplier = $this->M_po->cek_npwp_supplier($id_supplier);
		$cek_investasi = $this->M_po->cek_kadaluarsa_investasi($kode_unit, $investasi, $tgl);
		$cek_pkp = $this->M_po->cek_pkp($kode_keuangan, $jenis);
		print_r(json_encode(array($data, $cek_validasi, $cek_npwp_supplier, $cek_investasi, $cek_pkp)));
	}

	function simpan() {
		$data = $this->input->post('data');
		$nmr = $data[1];
		$tanggal = date('d-m-Y', strtotime($data[2]));
		$id_bayar = $data[3];
		$investasi = $data[4];
		$kode_unit = trim($data[5], ' ');
		$top = $data[6];
		$discount = $data[7];
		$ppn = $data[8];
		$id_edit = $data[9];
		$id_supplier = $data[10];
		$lokal = $data[11];
		$kurs = str_replace('.', ',', $data[12]);
		$karyawan = $this->M_po->karyawan();
		$id_kary = $karyawan[4];
		$id_bagian = $karyawan[2];

		$nmr_simpg = '';
		$nomor_urut = '';

		if ($id_edit != '') {		
			$nomor_urut = $this->M_po->nomor_urut($id_edit);	
			$this->M_po->hapus_profits($id_edit);
		}

		$id_po = $this->M_po->urut_po();
		$this->M_po->simpan($id_po, $nmr, $tanggal, $id_bagian, $id_bayar, $id_kary, $investasi, $kode_unit, $discount, $top, $ppn, $nomor_urut, $id_supplier, $lokal, $kurs);

		for ($i = 0; $i < count($data[0][0]); $i++) {
			$id_material_supply = $data[0][0][$i];
			$qty = $data[0][1][$i];
			$harga = $data[0][2][$i];
			$mata_uang = $data[0][3][$i];
			$del_time = date('d-m-Y', strtotime($data[0][4][$i]));
			$satuan = $data[0][5][$i];
			$id_sip_detail = $data[0][6][$i];
			$id_po_detail = $data[0][7][$i];
			$qty = str_replace('.', ',', $qty);
			$harga = str_replace('.', ',', $harga);

			$id_po_detail = $this->M_po->urut_po_detail();
			$no_rekjurnal = $this->M_po->no_rekjurnal($id_sip_detail);
			$this->M_po->simpan_detail($id_po_detail, $id_po, $qty, $harga, $mata_uang, $del_time, $satuan, $id_material_supply, $id_sip_detail, $no_rekjurnal);
		}

		$this->upload_sakti($nmr);
	}

	function cetak() {
		$nmr = $this->input->post('data');
		$data = $this->M_po->cetak($nmr);
		print_r(json_encode($data));
	}

	function edit() {
		$id_edit = $this->input->post('data');

		$data = $this->M_po->edit($id_edit);
		print_r(json_encode($data));
	}

	function batal() {
		$data = $this->input->post('data');
		$id_detail = $data[0];
		$id_edit = $data[1];
		$nmr = $data[2];

		$cek_sakti = $this->cek_sakti($nmr);

		if ($cek_sakti != 0) {
			print_r('1'); return;
		}

		$this->M_po->batal($id_detail, $id_edit);
		$this->upload_sakti($nmr);
	}

	function cek_sakti($nmr) {
		$kode_unit = $this->M_po->kode_unit($nmr);
		$year = substr($nmr, -2);
		$urut = substr($nmr, 0, 6);
		$kode = substr($nmr, 15, 1);
		$nmr_sakti = $year . $urut . $kode;

		$cek_sakti = $this->M_po->cek_validasi($nmr_sakti, $kode_unit);
		return $cek_sakti;
	}

	function upload_manual_simpg() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$dt_po = $data[1];

		for ($i=0; $i<count($dt_po); $i++) {
			$nmr = $dt_po[$i];
			$cek_simpg = $this->M_po->cek_simpg($kd_unit, $nmr);

			if ($cek_simpg == 0) {
				$this->upload_simpg($nmr);
			}
		}
	}


	// ========================================  Menu SIMPG  ========================================
	// ==============================================================================================

	function hapus_simpg($nmr) {
		$this->M_po->hapus_simpg($nmr);
	}

	function upload_simpg($nmr) {
		$this->M_po->hapus_simpg($nmr);

		$data_po = $this->M_po->data_po($nmr);
		if (count($data_po) == 0) {return;}

		$nmr = $data_po[0]['NOMER'];
		$nomor_urut = $data_po[0]['NOMOR_URUT_SAKTI'];
		$kode_supplier_simpg = $data_po[0]['KODE_SIMPG'];
		$kode_bayar = $data_po[0]['KODE'];
		$tanggal = $data_po[0]['TGL'];
		$discount = $data_po[0]['DISCOUNT'];
		$top = $data_po[0]['TOP'];
		$ppn = $data_po[0]['PPN'];
		$username = strtoupper($data_po[0]['USERNAME']);
		$kode_unit = $data_po[0]['KD_UNIT'];
		$investasi = $data_po[0]['NO_INVESTASI'];
		$kurs = $data_po[0]['KURS'];

		$keterangan = '';
		$value_pph = '';
		$kode_saksi = '';
		$nmr_internal = '';
		$upload = '';
		$nomor_spp = '';
		$valid_fa = '';
		$kode_proyek = 'REG';
		$pendanaan = '1';

		$kode_pembelian = '00003';
		$kode_akuntan = '00002';
		if ($kode_unit == '01') {
			$kode_pimpinan = '0001';
			$sub_unit = '4';
		}else{
			$kode_pimpinan = '00001';
			$sub_unit = '2';
		}

		$this->M_po->simpan_simpg($nmr, $kode_supplier_simpg, $kode_bayar, $tanggal, $discount, $keterangan, $top, $ppn, $value_pph, $kode_akuntan, $kode_pimpinan, $kode_saksi, $kode_pembelian, $username, $kode_unit, $kode_proyek, $sub_unit, $nmr_internal, $upload, $investasi, $nomor_spp, $valid_fa, $nomor_urut, $pendanaan);

		for ($i=0; $i<count($data_po); $i++) {
			$nomer_sip = $data_po[$i]['NO_SIP'];
			$kode_barang = $data_po[$i]['KODE_BARANG'];
			$kode_satuan = $data_po[$i]['SATUAN'];
			$no_rekjurnal = $data_po[$i]['NO_REKJURNAL'];
			$harga = $data_po[$i]['HARGA'];
			$nilai_beli = $data_po[$i]['NILAI_BELI'];
			$deadline = $data_po[$i]['DEADLINE'];
			$qty = $data_po[$i]['QTY'];
			$mata_uang = $data_po[$i]['MATA_UANG'];

			if ($mata_uang == 'IDR') {
				$kode_currency = '01';
			}else{
				$kode_currency = $this->M_po->kode_currency($mata_uang);
			}
			
			$terkirim = '0';
			$final = 'F';
			$qty_disc = '0';
			$batal = 'F';
			$urut = $i + 1;

			$this->M_po->simpan_detail_simpg($kode_unit, $nmr, $nomer_sip, $kode_barang, $kode_satuan, $no_rekjurnal, $kode_currency, $harga, $kurs, $nilai_beli, $terkirim, $final,  $qty_disc, $batal, $username, $urut);
			$this->M_po->simpan_simpg_subdetail($kode_unit, $nmr, $kode_barang, $deadline, $qty, $no_rekjurnal, $kode_satuan, $nomer_sip);
		}
	}


	// ========================================  Menu SAKTI  ========================================
	// ==============================================================================================

	function upload_sakti($nmr) {
		$year = substr($nmr, -2);
		$urut = substr($nmr, 0, 6);
		$kode = substr($nmr, 15, 1);
		if ($nmr != '') {
			$nmr_sakti = $year . $urut . $kode;
			$this->M_po->hapus_sakti($nmr, $nmr_sakti);
		}

		$data_po = $this->M_po->data_po($nmr);
		if (count($data_po) == 0) {return;}

		$kode_unit = $data_po[0]['KD_UNIT'];		
		$nmr = $data_po[0]['NOMER'];
		$nomor_urut = $data_po[0]['NOMOR_URUT_SAKTI'];
		$nomor_spp = substr($nmr,-2).substr($nmr,0,6).substr($nmr,15,1);
		if (substr($nmr,15,1) == 'I') {
			$lokalimpor = 'I';
			$jenis_bayar = '1';
		}else{
			$lokalimpor = 'L';
			$jenis_bayar = '';
		}
		$mata_uang = substr($data_po[0]['MATA_UANG'],0,3);
		$kode_supplier = $data_po[0]['KODE_KEUANGAN'];
		$tanggal_spp = $data_po[0]['TGL'];
		$cara_bayar = $data_po[0]['CARA_BAYAR'];
		$limit = $data_po[0]['TOP'];
		$kurs_kalkulasi = $data_po[0]['KURS'];
		if (substr($nmr,15,1) == 'R') {
			$jenis_ppn = 'E';
			$pkp_non_pkp = '1';
		}else{
			$jenis_ppn = '';
			$pkp_non_pkp = '0';
		}
		$users = strtoupper($data_po[0]['USERNAME']);
		$nomor_investasi = $data_po[0]['NO_INVESTASI'];

		$saksi_ahli = '';
		$tt_supplier = '';
		$nomor_um = '';
		$pendanaan = '1';
		$kode_proyek = '';
		$jenis_spp = '';
		$tanggal_ver = '';
		$verifikator = '';
		$alamat_kirim = '';
		$migrasi = '';
		$keterangan = '';

		if ($nomor_urut == '') {
			$nomor_urut = $this->M_po->spp_urut($year);
			$this->M_po->simpan_spp_urut($nomor_urut, $users);
		}
		$this->M_po->simpan_sakti($kode_unit, $nomor_spp, $kode_supplier, $tanggal_spp, $mata_uang, $cara_bayar, $saksi_ahli, $limit, $tt_supplier, $nomor_um, $pendanaan, $kode_proyek, $jenis_ppn, $jenis_spp, $tanggal_ver, $verifikator, $users, $lokalimpor, $jenis_bayar, $pkp_non_pkp, $alamat_kirim, $migrasi, $nomor_investasi, $keterangan, $nomor_urut, $kurs_kalkulasi);

		for ($i=0; $i<count($data_po); $i++) {
			$nomer_sip = $data_po[$i]['NO_SIP'];
			$nomor_sip = substr($nomer_sip,-2).substr($nomer_sip,0,4).substr($nomer_sip,13,2);
			$item_sip =  sprintf('%02d', $data_po[$i]['URUT_SIP']);
			$kode_rekening = $data_po[$i]['NO_REKJURNAL'];
			$qty = $data_po[$i]['QTY'];
			$harga = $data_po[$i]['HARGA'];
			$tanggal_kirim = $data_po[$i]['DEADLINE'];

			$migrasi = '';

			$this->M_po->simpan_sakti_detail($kode_unit, $nomor_spp, $nomor_sip, $item_sip, $kode_rekening, $qty, $harga, $users, $migrasi, $tanggal_kirim);
		}

		$this->M_po->update_nmr_profits($nmr, $nomor_urut);
	}

}