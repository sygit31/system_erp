<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('sistem/M_project');
		session_start();
	}

	function input_project()	{
		$sistem['show_pic'] = $this->M_project->show_pic();
		$sistem['ide'] = $this->M_project->show_ide();
		$sistem['show_bobot'] = $this->M_project->show_bobot();

		$this->load->view('sistem/v_input_project',$sistem);
	}

	function filter_project() {
		$data = $this->input->post('data');
		$cari = strtoupper($data[0]);
		$periode = $data[1];
		$status = $data[2];
		
		if (isset($data[3])) {
			$sistem['project'] = $this->M_project->filter_project($cari,$periode,$status);
			$this->load->view('sistem/v_project_table',$sistem);
		}else{
			$sistem['project'] = $this->M_project->filter_project($cari,$periode,$status);
			$this->load->view('sistem/v_input_project_table',$sistem);
		}
	}

	function auto_no() {
		$tahun = $this->input->post('data');
		$no_project = $this->M_project->auto_no($tahun);
		print_r($no_project);
	}

	function simpan_project() {
		$data = $this->input->post('data');
		$no_project = $data[0];
		$tgl = date('d-m-Y',strtotime($data[1]));
		$nama_project = $data[2];
		$level = $data[6];
		$id_ide = $data[8];
		$id_koordinator = $data[9];

		// Non-aktifkan data jika ada yang dihapus dari list PIC
		if (isset($data[10])) {
			for ($i=0; $i<count($data[10]); $i++) {
				$id_project = $data[10][$i];
				$this->M_project->non_aktif_project($id_project);
			}
		}

		// Simpan atau edit data
		$id_project = $this->M_project->urut_id();
		for ($i=0; $i<count($data[3]); $i++) {
			$id_pic = $data[3][$i];
			$tugas = $data[4][$i];
			$deadline = date('d-m-Y',strtotime($data[5][$i]));
			$id_edit = $data[7][$i];
			if ($id_edit == '') {
				$this->M_project->simpan_project($id_project,$no_project,$tgl,$nama_project,$id_pic,$tugas,$deadline,$level,$id_ide,$id_koordinator);
				$id_project++;
			}else{
				$this->M_project->edit_project($id_edit,$no_project,$tgl,$nama_project,$id_pic,$tugas,$deadline,$level,$id_ide,$id_koordinator);
			}

		}

		// Update status ide jadi project
		if ($id_ide != '') {
			$this->M_project->update_status_ide($id_ide);
		}
	}

	function simpan_bobot() {
		$data = $this->input->post('data');

		$this->M_project->non_aktif_bobot();
		$id_bobot = $this->M_project->urut_id_bobot();
		$lev = array('1','2','3');
		for ($i=0; $i<count($lev); $i++) {
			$level = $lev[$i];
			$n1 = $data[$i][0];
			$n2 = $data[$i][1];
			$n3 = $data[$i][2];
			$n4 = $data[$i][3];
			$this->M_project->simpan_bobot($id_bobot,$level,$n1,$n2,$n3,$n4);
			$id_bobot++;
		}
	}

	function ambil_project() {
		$id_project = $this->input->post('data');

		$data = $this->M_project->ambil_project($id_project);
		if (count($data)>0) {print_r(json_encode($data));}
	}

	function simpan_revisi() {
		$data = $this->input->post('data');
		$id_project = $data[0];
		$target2 = date('d-m-Y',strtotime($data[1]));
		if ($data[2] == '') {
			$target3 = null;
		}else{
			$target3 = date('d-m-Y',strtotime($data[2]));
		}
		
		$this->M_project->simpan_revisi($id_project,$target2,$target3);
	}

	function hapus_revisi() {
		$id_project = $this->input->post('data');

		$this->M_project->hapus_revisi($id_project);
	}

	function ambil_gambar() {
		$id_project = $this->input->post('data');

		$data = $this->M_project->ambil_gambar($id_project);
		print_r(json_encode($data));
	}

	function simpan_finish() {

		// Ambil Data dari Form
		$id_project = $_POST['id_project'];
		$finish = date('d-m-Y',strtotime($_POST['finish']));
		$fin = date('ymd',strtotime($_POST['finish']));
		$target_dir = "images/Project/";

		// Set File
		if (isset($_FILES['img'])) {
			$img = $_FILES['img'];

			// Simpan File ke Direktori Server
			$id_gambar = $this->M_project->urut_id_gambar();
			for ($i=0; $i<count($img['name']); $i++) {
				$tmp = $img['tmp_name'][$i];
				$info = pathinfo($img['name'][$i]);
				$extension = $info['extension'];
				$filename = $id_gambar . '.' . $extension;
				move_uploaded_file($tmp, $target_dir . $filename);

				// Simpan File Name ke Table Gambar
				$this->M_project->simpan_gambar($id_gambar,$id_project,$filename);
				$id_gambar++;
			}
		}

		// Simpan Finish Date
		$this->M_project->simpan_finish($id_project,$finish);

		// Hapus Gambar Yang Tidak Digunakan
		$gambar_hapus = $_POST['gambar_hapus'];
		$gambar_hapus = explode(',', $gambar_hapus);

		for ($i=0; $i<count($gambar_hapus); $i++) {
			$filename = $gambar_hapus[$i];

			if ($filename != '') {
				if (!unlink($target_dir . $filename)){};
				$this->M_project->gambar_hapus($gambar_hapus[$i]);
			}
		}
		
		// Simpan Nilai Reward
		$this->reward_project($id_project,$fin);
	}

	function reward_project($id_project,$fin) {

		// Ambil Deadline
		$target = $this->M_project->ambil_deadline($id_project);
		$deadline = date('ymd',strtotime($target['DEADLINE']));
		$target2 = date('ymd',strtotime($target['TARGET2']));
		$target3 = date('ymd',strtotime($target['TARGET3']));

		// Ambil nilai reward
		$nilai = $this->M_project->ambil_nilai($id_project);
		$n1 = $nilai['NILAI1'];
		$n2 = $nilai['NILAI2'];
		$n3 = $nilai['NILAI3'];
		$n4 = $nilai['NILAI4'];

		// Hasil nilai
		if ($fin <= $deadline) {
			$nilai = $n1;
		}elseif ($fin <= $target2) {
			$nilai = $n2;
		}elseif ($fin <= $target3) {
			$nilai = $n3;
		}elseif ($fin > $target3) {
			$nilai = $n4;
		}else{
			$nilai = '';
		}		

		// Simpan Reward Project
		$this->M_project->simpan_reward($id_project,$nilai);
	}

	function hapus_project() {
		$id_project = $_POST['data'];
		$this->M_project->hapus_project($id_project);
	}

	function failed_project() {
		$id_project = $_POST['data'];

		// Ambil nilai reward
		$nilai = $this->M_project->ambil_nilai($id_project);
		$nilai_fail = $nilai['NILAI4'];
		
		// Simpan Nilai Reward
		$this->M_project->failed_project($id_project,$nilai_fail);	
	}

	function batal_ide() {
		$id_ide = $_POST['data'];
		$this->M_project->batal_ide($id_ide);
	}

}

?>