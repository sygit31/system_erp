<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pet extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_pet');
		session_start();
	}

	function index() {
		// $this->load->view('v_maintain'); return; // Dalam Perbaikan
		// $data['kode_duplikat'] = $this->M_pet->remove_duplicate();

		$data['pengawas'] = $this->M_pet->pengawas();
		$data['operator'] = $this->M_pet->operator();
		$data['kode_flow'] = $this->M_pet->kode_flow();
		$data['desain'] = $this->M_pet->desain();
		$data['kk'] = $this->M_pet->kk();
		$data['proses'] = $this->M_pet->proses();
		$data['proses_pita'] = $this->M_pet->proses_pita();
		$data['seri'] = $this->M_pet->get_seri();
		$data['mesin'] = $this->M_pet->mesin();

		$this->load->view('produksi/v_pet.php', $data);
	}

	function isi_proses() {
		$kode_flow = $this->input->post('data');
		$data = $this->M_pet->isi_proses($kode_flow);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$proses = $data[2];
		$kode_roll = $data[3];
		$kk = $data[4];
		$desain = $data[5];
		$seri = $data[6];
		$kode_flow = $data[7];

		$data['pet'] = $this->M_pet->filter($tgl1, $tgl2, $proses, $kode_roll, $kk, $desain, $seri, $kode_flow);
		$this->load->view('produksi/v_pet_table', $data);
	}

	function get_roll() {
		$data = $this->input->post('data');
		$proses = $data[0];
		$kode_flow = $data[1];
		$desain = $data[2];
		$proses_awal = $this->M_pet->proses_awal($kode_flow);

		$get_roll = $this->M_pet->get_roll($proses, $proses_awal, $kode_flow, $desain);
		print_r(json_encode($get_roll));
	}

	function get_rnd_mesin() {
		$proses = $this->input->post('data');
		$data = $this->M_pet->get_rnd_mesin($proses);
		print_r(json_encode($data));
	}

	function ambil_roll_awal() {
		$id_prod_mutasi = $this->input->post('data');
		$data = $this->M_pet->ambil_roll_awal($id_prod_mutasi);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$tanggal = date('d-m-Y', strtotime($data[0]));
		$tomorrow = date('d-m-Y', strtotime("+1 days", strtotime($data[0])));
		$keterangan = $data[1];
		$proses = $data[2];
		$station_awal = $proses;
		$station_akhir = $data[3];
		$kode_gabung = $data[4];
		$panjang_gabung = $data[5];
		$gabung = $data[6];
		$id_gudang_order = $data[7];
		$kode_flow = $data[8];
		$material = $data[9];
		$desain = $data[10];
		$proses = $data[11];
		$nama_mesin = $data[12];
		$shift = $data[13];
		$operator = $data[14];
		$pengawas = $data[15];

		$id_prod_proses = $this->M_pet->id_prod_proses($proses, $nama_mesin, $shift);
		$id_detail_terima = $material[8][0];
		if ($proses != 'Emboss') {
			$dt_terima = $this->M_pet->dt_terima($id_detail_terima);
			$id_detail_terima = $dt_terima[0]['ID_DETAIL_TERIMA'];
		}
		$seri = $this->M_pet->seri($id_gudang_order);
		
		$id_prod_pet = $this->M_pet->urut_id_prod_pet();
		$this->M_pet->simpan_header($id_prod_pet, $id_gudang_order, $tanggal, $keterangan, $kode_flow, $desain, $proses, $nama_mesin, $shift, $id_prod_proses, $pengawas);

		for ($i=0; $i<count($material[0]); $i++) {
			$id_prod_pet_detail = $this->M_pet->urut_id_prod_pet_detail();
			$batas_shift = $proses == 'Metalize' ? 530 : 630;

			$time_mulai = (int)date('Gi', strtotime($material[1][$i]));
			$mulai = $time_mulai < $batas_shift ? $tomorrow . ' ' . $material[1][$i] : $tanggal . ' ' . $material[1][$i];

			$time_selesai = (int)date('Gi', strtotime($material[2][$i]));
			$selesai = $time_selesai < $batas_shift ? $tomorrow . ' ' . $material[2][$i] : $tanggal . ' ' . $material[2][$i];

			$kode = $material[0][$i];
			$panjang = str_replace('.', ',', $material[3][$i]);
			$hasil = $material[4][$i];
			$reject = $material[5][$i];
			$sisa_pita = $material[11][$i];
			$reject_konversi = 0;
			$qty_roll = $material[9][$i];
			$bahan = str_replace('.', ',', $material[10][$i]);

			if ($proses == 'Pita' && $sisa_pita == '0') {
				$sisa = '0';
				if ($seri == 'SERI I') {
					$lebar = '0.7';
				} elseif ($seri == 'SERI II' || $seri == 'SERI III') {
					$lebar = '0.5';
				} else {
					$lebar = '0.6';
				}

				$hasil = $hasil * $qty_roll * ($lebar/100);
				$reject = $reject * $qty_roll * ($lebar/100);

				$dt_produksi = $this->M_pet->dt_produksi($proses, $kode);
				$dt_pita = explode('@@', $dt_produksi['QTY_TOTAL_PITA']);
				$t_awal = $dt_produksi['QTY_AWAL'] * (37.5/100);
				foreach ($dt_pita as $dt) {
					if ($dt != '') {
						$t_hasil = explode('@', $dt)[0];
						$t_reject = explode('@', $dt)[1];
						$t_qty_roll = explode('@', $dt)[2];

						$hasil = $hasil + $t_hasil * $t_qty_roll * ($lebar/100);
						$reject = $reject + $t_reject * $t_qty_roll * ($lebar/100);
					}
				}
				$reject_konversi = str_replace('.', ',', ($t_awal - $hasil - $reject) / (37.5/100));
			}else{
				$sisa = str_replace('.', ',', $material[6][$i]);
			}
			$hasil = str_replace('.', ',', $material[4][$i]);
			$reject = str_replace('.', ',', $material[5][$i]);

			if ($material[7][$i] == 'true') {$teller = '1';}else{$teller = '';}
			$id_detail_terima = $material[8][$i];

			$this->M_pet->simpan_detail($id_prod_pet_detail, $id_prod_pet, $mulai, $selesai, $panjang, $hasil, $reject, $sisa, $kode, $teller, $qty_roll, $reject_konversi, $bahan);
			$this->simpan_detail_terima($proses, $id_prod_pet_detail, $id_detail_terima);

			if ($gabung == 'true') {$kode = $kode_gabung; $hasil = $panjang_gabung;}
			$this->simpan_mutasi($station_awal, $station_akhir, $kode, $hasil, $qty_roll, $id_prod_pet_detail, $gabung, $i, $id_gudang_order, $id_detail_terima, $kode_flow);
			if ($proses != 'Emboss') {
				$this->update_mutasi($proses, $seri, $material[0][$i]);
			}

			$this->simpan_operator($id_prod_pet_detail, $operator);
		}
	}

	function update_mutasi($proses, $seri, $kode) {
		$dt_produksi = $this->M_pet->dt_produksi($proses, $kode);
		$qty_total = $dt_produksi['QTY_TOTAL'];
		$qty_total_pita = $dt_produksi['QTY_TOTAL_PITA'];

		$qty_produksi = 0;
		if ($proses == 'Pita') {
			$dt_pita = explode('@@', $qty_total_pita);
			foreach ($dt_pita as $dt) {
				if ($dt != '') {
					$hasil = explode('@', $dt)[0];
					$reject = explode('@', $dt)[1];
					$qty_roll = explode('@', $dt)[2];
					$konversi = str_replace(',', '.', explode('@', $dt)[3]);

					if ($seri == 'SERI I') {
						$lebar = '0.7';
					} elseif ($seri == 'SERI II' || $seri == 'SERI III') {
						$lebar = '0.5';
					} else {
						$lebar = '0.6';
					}

					$hasil = $hasil * $qty_roll * ($lebar/100);
					$reject = $reject * $qty_roll * ($lebar/100);
					$total_produksi = $hasil + $reject + $konversi;
					$qty_produksi = $qty_produksi + ($total_produksi / (37.5/100));
				}
			}
		}else{
			$qty_produksi = $qty_total;
		}

		$this->M_pet->update_mutasi($proses, $kode, $qty_produksi);
	}

	function simpan_operator($id_pet_detail, $operator) {
		$id_prod_kary = $this->M_pet->urut_prod_kary();
		for ($i=0; $i<count($operator); $i++) {
			$id_operator = $operator[$i];
			$this->M_pet->simpan_prod_kary($id_prod_kary, $id_pet_detail, $id_operator);
			$id_prod_kary++;
		}

	}

	function simpan_detail_terima($proses, $id_prod_pet_detail, $id_detail_terima) {
		if ($proses == 'Emboss') {
			$id_prod_pet_detail_terima = $this->M_pet->id_prod_pet_detail_terima();
			$this->M_pet->simpan_detail_terima($id_prod_pet_detail_terima, $id_prod_pet_detail, $id_detail_terima);
		}else{
			$dt_terima = $this->M_pet->dt_terima($id_detail_terima);
			foreach ($dt_terima as $dt) {
				$id_detail_terima = $dt['ID_DETAIL_TERIMA'];
				$id_prod_pet_detail_terima = $this->M_pet->id_prod_pet_detail_terima();
				$this->M_pet->simpan_detail_terima($id_prod_pet_detail_terima, $id_prod_pet_detail, $id_detail_terima);
			}
		}
	}

	function simpan_mutasi($station_awal, $station_akhir, $kode, $hasil, $qty_roll, $id_prod_pet_detail, $gabung, $i, $id_gudang_order, $id_detail_terima, $kode_flow) {
		if ($station_awal == 'Belah') {
			$qty = 2;
		}else{
			$qty = 1;
		}
		
		if ($gabung == 'true') {
			if ($i == 0) {
				for ($i=0; $i<$qty; $i++) {
					$id_mutasi = $this->M_pet->urut_mutasi();
					$this->M_pet->simpan_mutasi($id_mutasi, $station_awal, $station_akhir, $kode, $hasil, $qty_roll, $id_gudang_order, $kode_flow, $gabung);

					$id_mutasi_detail = $this->M_pet->urut_mutasi_detail();
					$this->M_pet->simpan_mutasi_detail($id_mutasi_detail, $id_prod_pet_detail, $id_mutasi);
				}
			}else{
				$id_mutasi = $this->M_pet->urut_mutasi();
				$id_mutasi_detail = $this->M_pet->urut_mutasi_detail();
				$this->M_pet->simpan_mutasi_detail($id_mutasi_detail, $id_prod_pet_detail, $id_mutasi-1);
			}
		}

		if ($gabung == 'false') {
			for ($i=0; $i<$qty; $i++) {
				$id_mutasi = $this->M_pet->urut_mutasi();
				$this->M_pet->simpan_mutasi($id_mutasi, $station_awal, $station_akhir, $kode, $hasil, $qty_roll, $id_gudang_order, $kode_flow, $gabung);

				$id_mutasi_detail = $this->M_pet->urut_mutasi_detail();
				$this->M_pet->simpan_mutasi_detail($id_mutasi_detail, $id_prod_pet_detail, $id_mutasi);
			}
		}	
	}

	function cetak() {
		$data = $this->input->post('data');
		$id_cetak = $data[0];
		$proses = $data[1];

		$data = $this->M_pet->cetak($id_cetak, $proses);
		print_r(json_encode($data));
	}

	function edit() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$proses = $data[1];

		$mesin = $this->M_pet->e_mesin($proses);
		$data = $this->M_pet->edit($id_edit);
		print_r(json_encode(array($data, $mesin)));
	}

	function isi_e_operator() {
		$data = $this->input->post('data');		
		$desain = $data[0];
		$nama_mesin = $data[1];
		$shift = $data[2];
		$operator = $this->M_pet->e_operator($desain, $nama_mesin, $shift);

		print_r(json_encode($operator));
	}

	function simpan_edit() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$bsk = date('d-m-Y', strtotime("+1 days", strtotime($data[1])));
		$shift = $data[2];
		$batas_shift = $data[12] == 'Metalize' ? 530 : 630;

		$time_mulai = (int)date('Gi', strtotime($data[3]));
		$mulai = $time_mulai < $batas_shift ? $bsk . ' ' . $data[3] : $tgl . ' ' . $data[3];

		$time_selesai = (int)date('Gi', strtotime($data[4]));
		$selesai = $time_selesai < $batas_shift ? $bsk . ' ' . $data[4] : $tgl . ' ' . $data[4];

		$hasil = $data[5];
		$reject = $data[6];
		$sisa = $data[7];
		$bahan = str_replace('.', ',', $data[8]);
		$mesin = $data[9];
		$operator = $data[10];
		$pengawas = $data[11];

		$this->M_pet->update_header($id_edit, $tgl, $mesin, $shift, $pengawas);
		$this->M_pet->simpan_edit($id_edit, $mulai, $selesai, $hasil, $reject, $sisa, $bahan);
		$this->M_pet->hapus_operator($id_edit);
		$this->simpan_operator($id_edit, $operator);
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$dt_proses = $this->M_pet->dt_proses($id_hapus);
		$proses = $dt_proses['PROSES'];
		$seri = $dt_proses['SERI'];
		$kode = $dt_proses['KODE'];

		$this->M_pet->hapus($id_hapus);
		$this->M_pet->hapus_operator($id_hapus);
		$this->update_mutasi($proses, $seri, $kode);
	}

	function get_operator() {
		$data = $this->input->post('data');
		$proses = $data[0];
		$nama_mesin = $data[1];
		$shift = $data[2];

		$data = $this->M_pet->get_operator($proses, $nama_mesin, $shift);
		print_r(json_encode($data));
	}
	
}