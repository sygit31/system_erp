<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pdd extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_pdd');

		session_start();
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$user = $this->M_pdd->user();
		$data['pengesah'] = $this->M_pdd->pengesah();
		$data['bagian'] = $this->M_pdd->bagian();
		$data['nmr'] = $this->M_pdd->nmr();
		$data['tipe'] = $this->M_pdd->tipe();
		$data['unit'] = $this->M_pdd->unit();
		$data['user'] = $user;
		$data['mn'] = $this->M_pdd->status_menu($_GET['mn'], $user[1]);
		$data['dist'] = $this->M_pdd->filter_new($data['mn'], $user[3]);

		$this->load->view('sistem/v_pdd', $data);
	}

	function isi_nama() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$id_bagian = $data[1];

		$data = $this->M_pdd->isi_nama($kd_unit, $id_bagian);
		print_r(json_encode($data));
	}

	function isi_revisi() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$nmr = strtoupper($data[1]);

		$data = $this->M_pdd->isi_revisi($id_edit, $nmr);
		print_r(json_encode($data));
	}

	function view() {
		$id_view = $this->input->post('data');

		$dt_master = $this->M_pdd->dt_master($id_view);
		$dt_komen = $this->M_pdd->dt_komen($id_view);
		$dt_lamp = $this->M_pdd->dt_lamp($id_view);
		print_r(json_encode(array($dt_master, $dt_komen, $dt_lamp)));
	}

	function post_komen() {
		$data = $this->input->post('data');
		$id_view = $data[0];
		$teks = $data[1];

		$urut_komen = $this->M_pdd->urut_komen();
		$id_kary = $this->M_pdd->user()[1];

		$this->M_pdd->post_komen($urut_komen, $id_view, $id_kary, $teks);
		$dt_komen = $this->M_pdd->dt_komen($id_view);
		print_r(json_encode($dt_komen));
	}

	function filter() {
		$data = $this->input->post('data');
		$bagian = $data[0];
		$tipe = $data[1];
		$status = $data[2];
		$unit = $data[3];
		$id_kary = $data[4];
		$lev_kary = $data[5];
		$id_bagian_pic = $data[6];
		$lingkup = $data[7];
		$nmr = $data[8];
		$cari = $data[9];
		$menu = $data[10];

		$data = $this->M_pdd->filter($bagian, $tipe, $status, $unit, $id_kary, $lev_kary, $id_bagian_pic, $lingkup, $nmr, $cari, $menu);
		print_r(json_encode($data));

		// $this->update_file();
	}

	function update_file() {
		$dir_new = 'assets/pdd/';
		$data = $this->M_pdd->data_update();

		for ($i=0; $i<count($data); $i++) {
			$old_file = $dir_new . 'D-' . $data[$i]['NMR'] . '.' . sprintf('%02d', $data[$i]['REV']) . '.pdf';
			$new_file = $dir_new . $data[$i]['ID'] . '.pdf';

			if (file_exists($old_file) == 1) {
				rename($old_file, $new_file);
			}
		}
	}

	function simpan() {
		$data = json_decode($_POST['data']);
		$id_edit = $data[0];
		$tgl = date('d-m-Y', strtotime($data[1]));
		$kd_unit = $data[2];
		$id_bagian = $data[3];
		$tipe = $data[4];
		$nmr = $data[5];
		$revisi = $data[6];
		$nama = $data[7];
		$pemilik = $data[8];
		$pengesah = $data[9];
		$sifat = $data[10];
		$lingkup = $data[11];
		$qty_lamp = $data[12];
		$dt_hapus_lamp = $data[13];
		$ext = '.pdf';
		$keterangan = '';
		$id_input = explode('|', $_SESSION['logERP'])[0];

		if ($id_edit == '') {
			$this->M_pdd->kadaluarsa($nmr);

			$id_edit = $this->M_pdd->urut();
			$id_file = $id_edit;
			$this->M_pdd->simpan($id_edit, $kd_unit, $lingkup, $sifat, $nmr, $tgl, $tipe, $nama, $revisi, $id_bagian, $pemilik, $pengesah, $ext, $keterangan);
		}else{
			if (isset($_FILES['file']) == '1') {$this->hapus_file($id_edit);}else{$this->rename_file($id_edit);}
			
			$id_file = $id_edit;
			$this->M_pdd->update($id_edit, $kd_unit, $lingkup, $sifat, $nmr, $tgl, $tipe, $nama, $revisi, $id_bagian, $pemilik, $pengesah, $ext, $keterangan);
			$this->M_pdd->hapus_dist($id_edit);
		}

		$this->upload_foto($id_file, $qty_lamp, $dt_hapus_lamp);
		$this->dist($id_edit, $id_input, $kd_unit);
	}

	function upload_foto($id_file, $qty_lamp, $dt_hapus_lamp) {
		$target_dir = 'assets/pdd/';

		if (isset($_FILES['file'])) {
			$tmp_foto = $_FILES['file']['tmp_name'];
			$file = $id_file . '.pdf';
			move_uploaded_file($tmp_foto, $target_dir . $file);
		}

		$target_dir = 'assets/pdd/lampiran/';
		for ($i=0; $i<count($dt_hapus_lamp); $i++) {
			$hapus_lamp = explode('@_', $dt_hapus_lamp[$i]);
			$filelamp = $hapus_lamp[0] . '.' . $hapus_lamp[1];
			
			print_r($hapus_lamp[0]);
			$this->M_pdd->hapus_lamp($hapus_lamp[0]);
			if (file_exists($target_dir . $filelamp) == 1) {!unlink($target_dir . $filelamp);}
		}

		$urut_lamp = $this->M_pdd->urut_lamp();
		for ($i=0; $i<$qty_lamp; $i++) {
			$judul = $_POST['filename_' . $i];

			if (isset($_FILES['filelamp_' . $i]['name'])) {
				$ext = pathinfo($_FILES['filelamp_' . $i]['name'], PATHINFO_EXTENSION);
				$tmp = $_FILES['filelamp_' . $i]['tmp_name'];
				$filelamp = $urut_lamp . '.' . $ext;

				$this->M_pdd->simpan_lamp($urut_lamp, $id_file, $judul, $ext);
				move_uploaded_file($tmp, $target_dir . $filelamp);
				$urut_lamp++;
			}else{
				$id_edit = $_POST['edit_' . $i];
				$this->M_pdd->update_lamp($id_edit, $judul);
			}
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_pdd->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$data = $this->input->post('data');
		$id_hapus = $data[0];
		$act = $data[1];
		$id_input = $data[2];
		$kd_unit = $data[3];
		$mn = $data[4];
		$id_bagian = $data[5];

		if ($act == 'del' || $act == 'sub_del') {
			$this->hapus_file($id_hapus);
			$this->M_pdd->hapus($id_hapus);
			$this->hapus_lamp($id_hapus);
		}else{
			if ($mn == '1') {
				$this->M_pdd->rec_data($id_hapus, $id_input, $id_bagian, $kd_unit);
			}else{
				$this->dist($id_hapus, $id_input, $kd_unit);
				$this->M_pdd->submit_data($id_hapus);
			}
		}
	}

	function hapus_lamp($id_hapus) {
		$target_dir = 'assets/pdd/lampiran/';
		$dt_hapus = $this->M_pdd->dt_hapus($id_hapus);
		foreach ($dt_hapus as $dt) {
			$id_hapus = $dt['ID'];
			$ext = $dt['EXT'];
			$this->M_pdd->hapus_lamp($id_hapus);
			
			$filelamp = $id_hapus . '.' . $ext;
			if (file_exists($target_dir . $filelamp) == 1) {!unlink($target_dir . $filelamp);}
		}
	}

	function dist($id_hapus, $id_input, $kd_unit) {
		$data_bagian = $this->M_pdd->dt_bagian($kd_unit);

		$urut_dist = $this->M_pdd->urut_dist();
		$tipe_dist = $this->M_pdd->tipe_dist($id_hapus)['DISTRIBUSI'];
		if ($tipe_dist == '1') {
			foreach ($data_bagian as $dt) {
				$id_bagian = $dt['ID_BAGIAN'];
				$this->M_pdd->dist($urut_dist, $id_hapus, $id_input, $id_bagian, $kd_unit);
				$urut_dist++;
			}
		}else{
			$id_bagian = $this->M_pdd->tipe_dist($id_hapus)['ID_BAGIAN'];
			$this->M_pdd->dist($urut_dist, $id_hapus, $id_input, $id_bagian, $kd_unit);
		}
	}

	function hapus_file($id_hapus) {
		$file = $id_hapus . '.pdf';
		$target_dir = 'assets/pdd/';

		if (file_exists($target_dir . $file) == 1) {!unlink($target_dir . $file);}
	}

	function rename_file($id_edit) {
		$target_dir = 'assets/pdd/';
		$file = $target_dir . $id_edit . '.pdf';
		$newfile = $target_dir . $id_edit . '.pdf';

		if (file_exists($file) == 1) {
			rename($file, $newfile);
		}
	}

	function filter_new() {
		$data = $this->input->post('data');
		$mn = $data[0];
		$id_bagian = $data[1];

		$data = $this->M_pdd->filter_new($mn, $id_bagian);
		print_r(json_encode($data));
	}

	function cetak_dist() {
		$id_cetak = $this->input->post('data');
		$data = $this->M_pdd->cetak_dist($id_cetak);
		print_r(json_encode($data));
	}

	// Jika ingin distribusi semua
	function dist_all($id_input, $kd_unit) {
		$kd_unit = '12';
		$data_bagian = $this->M_pdd->dt_bagian($kd_unit);
		$dt_dist = $this->M_pdd->dt_dist($kd_unit);
		$urut_dist = $this->M_pdd->urut_dist();

		foreach ($dt_dist->result_array() as $dt) {
			$id_hapus = $dt['ID'];
			$tipe_dist = $this->M_pdd->tipe_dist($id_hapus)['DISTRIBUSI'];
			if ($tipe_dist == '1') {
				foreach ($data_bagian as $dt) {
					$id_bagian = $dt['ID_BAGIAN'];
					$this->M_pdd->dist($urut_dist, $id_hapus, $id_input, $id_bagian, $kd_unit);
					$urut_dist++;
				}
			}else{
				$id_bagian = $this->M_pdd->tipe_dist($id_hapus)['ID_BAGIAN'];
				$this->M_pdd->dist($urut_dist, $id_hapus, $id_input, $id_bagian, $kd_unit);
				$urut_dist++;
			}

		}
	}

	function filter_d() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$tipe = $data[1];

		$data = $this->M_pdd->filter_d($kd_unit, $tipe);
		print_r(json_encode($data));
	}

}