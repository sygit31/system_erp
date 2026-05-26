<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sortir extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qc/M_sortir');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['mn'] = isset($_GET['mn']) ? $_GET['mn'] : '';
		$data['desain'] = $this->M_sortir->desain();
		$data['pengawas_sortir'] = $this->M_sortir->pengawas_sortir();
		$data['pengawas_qc'] = $this->M_sortir->pengawas_qc();
		$data['approval_qc'] = $this->M_sortir->approval_qc();
		$data['waste'] = $this->M_sortir->waste();

		$this->load->view('qc/v_sortir.php', $data);
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$desain = $data[1];

		$data = $this->M_sortir->auto_no($id_edit, $desain);
		print_r(json_encode($data));
	}

	function isi_label() {
		$desain = $this->input->post('data');
		$data = $this->M_sortir->isi_label($desain);
		print_r(json_encode($data));
	}

	function isi_mesin() {
		$data = $this->input->post('data');
		$desain = $data[0];
		$label = $data[1];

		$data = $this->M_sortir->isi_mesin($desain, $label);
		print_r(json_encode($data));
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$desain = $data[2];
		$seri = $data[3];
		$id_pemeriksa = $data[4];

		if ($tgl1 > $tgl2) {return;}

		$tgl = $this->ambil_tgl($data[0], $data[1]);
		$data = $this->M_sortir->filter($tgl1, $tgl2, $desain, $seri, $id_pemeriksa);
		print_r(json_encode(array($data, $tgl[0], $tgl[1])));
	}

	function ambil_tgl($tgl1, $tgl2) {
		$tgl1 = date('d-M-y', strtotime($tgl1));
		$tgl2 = date('d-M-y', strtotime($tgl2));
		
		$tgl = array();
		$dt_tgl = array();
		$s_tgl = $tgl1;
		$e_tgl = date('d-M-y', strtotime('+1 day', strtotime($tgl2)));
		do {
			array_push($tgl, date('d-M', strtotime($s_tgl)));
			array_push($dt_tgl, date('d-M-Y', strtotime($s_tgl)));
			$s_tgl = date('d-M-y', strtotime('+1 day', strtotime($s_tgl)));
		}
		while ($s_tgl != $e_tgl);

		return array($tgl, $dt_tgl);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = $data[1];
		$grup = $data[2];
		$desain = $data[3];
		$tgl = date('d-m-Y', strtotime($data[4]));
		$tom = date('d-m-Y', strtotime('+1 days', strtotime($data[4])));

		$time_mulai = (int)date('Gi', strtotime($data[5]));
		if ($time_mulai < 630) {
			$jam_mulai = $tom . ' ' . $data[5];
		}else{
			$jam_mulai = $tgl . ' ' . $data[5];
		}

		$time_selesai = (int)date('Gi', strtotime($data[6]));
		if ($time_selesai < 630) {
			$jam_selesai = $tom . ' ' . $data[6];
		}else{
			$jam_selesai = $tgl . ' ' . $data[6];
		}

		$label_cutter = $data[7];
		$ms_stamping = $data[8];
		$shift_stamping = $data[9];
		$pp = $data[10];
		$seri = $data[11];
		$baik = $data[12];
		$r_holo = $data[13];
		$r_kertas = $data[14];
		$temuan_lbr = $data[15];
		$kode_sortir = $data[16];
		$keterangan = $data[17];
		$id_pemeriksa = $data[18];
		$id_pengawas = $data[19];
		$id_approval = $data[20];
		$remark = $data[21];
		$qty_holo = $data[22];
		$qty_kertas = $data[23];
		$aql = $data[24];
		$urut = $id_edit == '' ? $this->M_sortir->urut() : $id_edit;

		$this->M_sortir->simpan($urut, $id_edit, $desain, $nmr, $tgl, $grup, $jam_mulai, $jam_selesai, $label_cutter, $ms_stamping, $shift_stamping, $pp, $seri, $baik, $r_holo, $r_kertas, $temuan_lbr, $kode_sortir, $keterangan, $id_pemeriksa, $id_pengawas, $id_approval, $remark, $aql);

		$this->simpan_detail($urut, $qty_holo, $qty_kertas);
	}

	function simpan_ed() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$r_holo = $data[1];
		$r_kertas = $data[2];
		$qty_holo = $data[3];
		$qty_kertas = $data[4];

		$this->M_sortir->simpan_ed($id_edit, $r_holo, $r_kertas);
		$this->simpan_detail($id_edit, $qty_holo, $qty_kertas);
	}

	function simpan_detail($urut, $qty_holo, $qty_kertas) {
		$urut_detail = $this->M_sortir->urut_detail();
		foreach ($qty_holo as $dt) {
			$lbr = explode('@', $dt)[0];
			$kd_reject = explode('@', $dt)[1];
			$cek_kode = $this->M_sortir->cek_kode($urut, $kd_reject);

			if ($lbr == 0) {
				$this->M_sortir->hapus_detail($urut, $kd_reject);
			}else{
				if ($cek_kode == 0) {
					$this->M_sortir->simpan_detail($urut_detail, $urut, $kd_reject, $lbr);
					$urut_detail++;
				}else{
					$this->M_sortir->update_detail($urut, $kd_reject, $lbr);
				}
			}
		}
		foreach ($qty_kertas as $dt) {
			$lbr = explode('@', $dt)[0];
			$kd_reject = explode('@', $dt)[1];
			$cek_kode = $this->M_sortir->cek_kode($urut, $kd_reject);

			if ($lbr == 0) {
				$this->M_sortir->hapus_detail($urut, $kd_reject);
			}else{
				if ($cek_kode == 0) {
					$this->M_sortir->simpan_detail($urut_detail, $urut, $kd_reject, $lbr);
					$urut_detail++;
				}else{
					$this->M_sortir->update_detail($urut, $kd_reject, $lbr);
				}
			}
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');

		$data = $this->M_sortir->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$data = $this->input->post('data');
		$id_hapus = $data[0];
		$str = $data[1];

		$this->M_sortir->hapus($id_hapus, $str);
	}

	function cetak() {
		$id_cetak = $this->input->post('data');

		$data = $this->M_sortir->cetak($id_cetak);
		print_r(json_encode($data));
	}

	function master() {
		$data = $this->M_sortir->waste();
		print_r(json_encode($data->result_array()));
	}

	function cek_kode_r() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$kode = $data[1];
		$reject = $data[2];

		$cek_kode = $this->M_sortir->cek_kode_r($id_edit, $kode, $reject);
		print_r($cek_kode);
	}

	function simpan_reject() {
		$data = json_decode($_POST['data']);
		$id_edit = $data[0];
		$bahan = $data[1];
		$kode = $data[2];
		$reject = $data[3];
		$deskripsi = $data[4];
		$file = $data[5];

		if ($id_edit == '') {
			$urut_r = $this->M_sortir->urut_r();
			$this->M_sortir->simpan_r($urut_r, $bahan, $kode, $reject, $deskripsi);
		}else{
			$urut_r = $id_edit;
			$this->M_sortir->update_r($id_edit, $bahan, $kode, $reject, $deskripsi);
		}

		$this->hapus_tmp_file($file, $urut_r);
		$this->upload_foto($_FILES, $urut_r);
	}

	function hapus_tmp_file($file, $urut_r) {
		$path = "assets/images/qc/reject/";

		if (file_exists($path . $urut_r . '.jpg') == 1 && $file == 'no_preview.jpg') {
			!unlink($path . $urut_r . '.jpg');
		}
	}

	function upload_foto($file, $urut_r) {
		$target_dir = "assets/images/qc/reject/";
		$file = '';

		if (isset($_FILES['file'])) {
			$tmp_foto = $_FILES['file']['tmp_name'];
			$file = $urut_r . '.jpg';

			move_uploaded_file($tmp_foto, $target_dir . $file);
		}
	}

	function edit_r() {
		$id_edit = $this->input->post('data');

		$data = $this->M_sortir->edit_r($id_edit);
		print_r(json_encode($data));
	}

}