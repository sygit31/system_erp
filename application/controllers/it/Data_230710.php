<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{

	function __construct() {
		parent::__construct();
		
		$this->load->model('it/M_its');
		session_start();

		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function show_kategori() {
		$data['kategori'] = $this->M_its->show_kategori();
		$this->load->view('it/v_kategori.php', $data);
	}

	function simpan_kategori() {
		$data = $this->input->post('data');
		$id_kategori = $data[0];
		$kategori = strtoupper(trim($data[1]," "));

		if ($id_kategori == '') {
			$id_kategori = $this->M_its->urut_kategori();
			$this->M_its->simpan_kategori($id_kategori, $kategori);
		} else {
			$this->M_its->update_kategori($id_kategori, $kategori);
		}

		for ($i = 0; $i < count($data[2]); $i++) {
			$id_sub_kategori = $data[2][$i];
			$sub_kategori = strtoupper(trim($data[3][$i]," "));

			if ($id_sub_kategori == '') {
				$id_sub_kategori = $this->M_its->urut_kategori_detail();
				$this->M_its->simpan_sub_kategori($id_sub_kategori, $id_kategori, $sub_kategori);
			} else {
				$this->M_its->update_sub_kategori($id_sub_kategori, $sub_kategori);
			}
		}
	}

	function filter_kategori() {
		$cari = strtoupper($this->input->post('data'));

		$data['kategori'] = $this->M_its->filter_kategori($cari);
		$this->load->view('it/v_kategori_table', $data);
	}

	function edit_kategori() {
		$id_kategori = $this->input->post('data');

		$data = $this->M_its->edit_kategori($id_kategori);
		print_r(json_encode($data));
	}

	function hapus_kategori() {
		$data = $this->input->post('data');
		$id_kategori_detail = $data;

		$data = $this->M_its->hapus_kategori($id_kategori_detail);
	}


	// -----------------------------  Upload Bank Data  ------------------------------ //
	function historis() {
		$karyawan = $this->M_its->get_karyawan();
		$akses = $karyawan[1];
		$_SESSION['akses'] = $akses;
		$this->load->view('it/v_historis.php');
	}

	function show_data() {
		$data['all_kategori'] = $this->M_its->show_kategori();
		$data['tahun'] = $this->M_its->show_tahun();
		$data['karyawan'] = $this->M_its->show_karyawan();
		$data['pemilik'] = $this->M_its->pemilik();

		$this->load->view('it/v_data.php', $data);
	}

	function simpan_file() {
		$data = explode(",", $_POST['data']);
		$id_karyawan = $data[0];
		$jenis = $data[1];
		$tahun = $data[2];
		$id_kategori_detail = $data[3];
		$kategori = $data[4];
		$sub_kategori = $data[5];
		$qty_data = $data[6];
		$target_dir = "images/bank_data/";

		$id = $this->M_its->auto_id_data();
		for ($i=0; $i<$qty_data; $i++) {
			if (!isset($_FILES['file_' . $i])) {
				$id_edit = explode(' ', $_POST['id_edit_' . $i])[1];
				$judul = $_POST['filename_' . $i];
				$tag = $_POST['tag_' . $i];

				$this->M_its->update_file($id_edit, $id_karyawan, $jenis, $tahun, $id_kategori_detail, $judul, $tag);
			}else{
				$id++;
				$ext = pathinfo($_FILES['file_' . $i]['name'], PATHINFO_EXTENSION);
				$tmp = $_FILES['file_' . $i]['tmp_name'];
				$judul = $_POST['filename_' . $i];
				$tag = $_POST['tag_' . $i];

				move_uploaded_file($tmp, $target_dir . $id . '.' . $ext);
				$this->M_its->simpan_file($id, $id_karyawan, $jenis, $tahun, $id_kategori_detail, $judul, $tag, $ext);
			}
		}
	}

	function filter_file() {
		$data = $this->input->post('data');
		$jenis = $data[0];
		$tahun = $data[1];
		$kategori = $data[2];
		$cari = strtoupper($data[3]);
		$view = $data[4];
		$karyawan = $data[5];
		$approved = $data[6];
		$sub_kategori = $data[7];

		$data['data'] = $this->M_its->filter_file($jenis, $tahun, $kategori, $cari, $karyawan, $approved, $sub_kategori);

		switch ($view) {
			case 'Album':
			$this->load->view('it/v_data_preview', $data);
			break;
			case 'Detail':
			$this->load->view('it/v_data_table', $data);
			break;
		}
	}

	function download_file() {
		header("Content-Type: application/octet-stream");
		header("Content-Disposition: attachment; filename=" . $_GET['path']);
		readfile($_GET['path']);
	}

	function delete_file() {
		$data = $this->input->post('data');
		$id = $data[0];
		$filename = $data[1];

		$this->M_its->delete_file($id, $filename);
	}

	function show_preview() {
		$id = $this->input->get('id');
		$data['file'] = $this->M_its->ambil_file($id);
		$data['komen'] = $this->M_its->show_komen($id);
		$data['id'] = $id;

		$this->load->view('it/v_show_preview.php', $data);
	}

	function show_komen() {
		$id = $this->input->post('data');
		$data['komen'] = $this->M_its->show_komen($id);

		$this->load->view('it/v_show_preview_coment', $data);
	}

	function simpan_comment() {
		$data = $this->input->post('data');
		$id_data = $data[0];
		$id_kary = $data[1];
		$note = $data[2];

		$this->M_its->simpan_comment($id_data, $id_kary, $note);
	}

	function approve() {
		$id_data = $this->input->post('data');

		$this->M_its->approve($id_data);
	}

	function next() {
		$data = $this->input->post('data');
		$jenis = $data[0];
		$kategori = $data[1];
		$sub_kategori = $data[2];
		$tahun = $data[3];

		$data = $this->M_its->next($jenis, $kategori, $sub_kategori, $tahun);
		print_r(json_encode($data));
	}

	function status() {
		$data = $this->input->post('data');
		$id_data = $data[0];
		$status = $data[1];

		$id_data = $this->M_its->status($id_data, $status);
		print_r($id_data);
	}

	function cek_file() {
		$id_data = $this->input->post('data');

		$aktif = $this->M_its->cek_file($id_data);
		print_r($aktif);
	}

	function buka_offline() {
		$id_data = $this->input->post('data');
		$nama_file = $this->M_its->buka_offline($id_data);
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);

		$source_file = base_url() . 'images/bank_data/' . $id_data . '.' . $ext;		
		$target_file = "//192.168.17.42/bank_data/" . $nama_file;

		// Delete temporary file
		$files = glob('//192.168.17.42/bank_data/*');
		foreach ($files as $file) { // iterate files
			if (is_file($file))
				unlink($file); // delete file
		}
		copy($source_file, $target_file);
	}

	function edit() {
		$id_data = $this->input->post('data');
		$data = $this->M_its->edit($id_data);

		print_r(json_encode($data));
	}

}
