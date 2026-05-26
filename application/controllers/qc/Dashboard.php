<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('qc/M_dashboard');
	}

	function index() {
		$data['komplain'] = $this->M_dashboard->komplain();
		$data['desain'] = $this->M_dashboard->desain();
		$this->load->view('qc/v_dashboard.php', $data);
	}

	function filter_k() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$seri = $data[2];

		$data = $this->M_dashboard->filter_k($tgl1, $tgl2, $seri);
		print_r(json_encode($data));
	}

	function filter_m() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));

		$data = $this->M_dashboard->filter_m($tgl1, $tgl2);
		print_r(json_encode($data));
	}

	function filter_s() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));

		$data = $this->M_dashboard->filter_s($tgl1, $tgl2);
		print_r(json_encode($data));
	}

	function filter_r() {
		$data = $this->input->post('data');
		$tgl1 = date('Y-m-d', strtotime($data[0]));
		$tgl2 = date('Y-m-d', strtotime($data[1]));
		$ukuran = $data[2];

		$data = $this->M_dashboard->filter_r($tgl1, $tgl2, $ukuran);
		print_r(json_encode($data));
	}

	function auto_no() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tahun = date('y', strtotime($data[1]));
		$tgl = date('d-m-Y', strtotime($data[1]));

		$data = $this->M_dashboard->auto_no($id_edit, $tahun, $tgl);
		print_r(json_encode($data));
	}

	function filter_komplain() {
		$desain = $this->input->post('data');
		$data = $this->M_dashboard->filter_komplain($desain);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = json_decode($_POST['data']);
		$id_edit = $data[0];
		$desain = $data[1];
		$nmr = $data[2];
		$tgl = date('d-m-Y', strtotime($data[3]));
		$problem = $data[4];
		$root_cause = $data[5];
		$preventive = $data[6];
		$img = $data[7];

		if ($id_edit == '') {
			$urut = $this->M_dashboard->urut();
			$this->M_dashboard->simpan($urut, $desain, $nmr, $tgl, $problem, $root_cause, $preventive);
		}else{
			$urut = $id_edit;
			$this->M_dashboard->update($id_edit, $desain, $nmr, $tgl, $problem, $root_cause, $preventive);
		}

		$this->upload_foto($_FILES, $urut, $img);
	}

	function upload_foto($file, $urut, $img) {
		$target_dir = "assets/images/qc/awareness/";
		$file = '';

		if ($img == 'no_preview') {
			$target_dir = "assets/images/qc/awareness/";
			!unlink($target_dir . $urut . '.jpg');
		}

		if (isset($_FILES['file'])) {
			$tmp_foto = $_FILES['file']['tmp_name'];
			$file = $urut . '.jpg';
			move_uploaded_file($tmp_foto, $target_dir . $file);
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_dashboard->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_dashboard->hapus($id_hapus);

		$target_dir = "assets/images/qc/awareness/";
		!unlink($target_dir . $id_hapus . '.jpg');
	}

}