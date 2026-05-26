<?php defined('BASEPATH') or exit('No direct script access allowed');

class Budget extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('cc/M_budget');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$id_kary = $this->M_budget->id_kary();
		$data['akses'] = $this->M_budget->akses($id_kary, $_GET['mn']);
		$data['unit'] = $this->M_budget->unit();
		$data['kd_jurnal'] = $this->M_budget->kd_jurnal();

		$this->load->view('cc/v_budget.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$periode1 = date('ym', strtotime($data[0]));
		$periode2 = date('ym', strtotime($data[1]));
		$kd_unit = $data[2];
		$id_rekening = $data[3];

		$data['budget'] = $this->M_budget->filter($periode1, $periode2, $kd_unit, $id_rekening);
		$this->load->view('cc/v_budget_table.php', $data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$periode = date('d-m-Y', strtotime($data[0]));
		$kd_unit = $data[1];
		$id_rekening = $data[2];
		$budget = $data[3];
		$no_rekjurnal = $data[4];
		$akses = $data[5];

		$id_add = '';
		$ket = '';
		$id_input = $this->M_budget->id_kary();

		if ($id_input == null || $id_input == '') {return;}
		$periode_edit = date('ym', strtotime($data[0]));
		$id_budget = $this->M_budget->id_budget($periode_edit, $id_rekening, $kd_unit);

		if ($akses == '3' && $id_budget == null) {
			print_r('Anda hanya diperkenankan melakukan addendum..');
			return;
		}

		if ($id_budget == null) {
			$id_budget = $this->M_budget->urut();
			$this->M_budget->simpan_budget($id_budget, $periode, $kd_unit, $id_rekening, $no_rekjurnal, $budget, $id_input);
		}else{
			$id_add = $this->M_budget->urut_add();
			$this->M_budget->simpan_add($id_add, $id_budget, $budget, $id_input, $ket);
		}
	}

	function upload_simpg($id_budget) {
		$data_budget =  $this->M_budget->data_budget($id_budget);
		$periode = $data_budget['PERIODE'];
		$periode_edit = $data_budget['PERIODE_EDIT'];
		$no_rekjurnal = trim($data_budget['NO_REKJURNAL']);
		$kd_unit = $data_budget['KD_UNIT'];
		$budget = $data_budget['BUDGET'];

		$this->M_budget->upload_simpg($periode, $periode_edit, $no_rekjurnal, $kd_unit, $budget);
	}

	function upload_manual_simpg() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$dt_id = $data[1];

		for ($i=0; $i<count($dt_id); $i++) {
			$id_budget = $dt_id[$i];

			$this->upload_simpg($id_budget);
		}
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$dt_budget = $this->M_budget->dt_budget($id_hapus);
		$kd_unit = $dt_budget['KD_UNIT'];
		$no_rekjurnal = $dt_budget['NO_REKJURNAL'];
		$periode = $dt_budget['PERIODE'];

		$this->M_budget->hapus_profits($id_hapus);
		$this->M_budget->hapus_simpg($kd_unit, $no_rekjurnal, $periode);
	}

	function view() {
		$id_view = $this->input->post('data');
		$data = $this->M_budget->view($id_view);
		print_r(json_encode($data));
	}

	function ubah() {
		$id_budget = $this->input->post('data');
		$data = $this->M_budget->ubah($id_budget);
		print_r(json_encode($data));
	}

	function isi_e_sisa() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$periode = $data[1];
		$kd_jurnal = $data[2];

		$data = $this->M_budget->isi_e_sisa($kd_unit, $periode, $kd_jurnal);
		print_r(json_encode($data));
	}

	function simpan_edit() {
		$data = $this->input->post('data');
		$kd_unit = $data[0];
		$periode = $data[1];
		$kode_awal = $data[2];
		$kode_akhir = $data[3];
		$nominal = $data[4];
		$id_rekening = $data[5];

		$id_input = $this->M_budget->id_kary();
		$id_budget_awal = $this->M_budget->id_budget_edit($periode, $kode_awal, $kd_unit);
		$id_budget_akhir = $this->M_budget->id_budget_edit($periode, $kode_akhir, $kd_unit);
		$periode = $this->M_budget->periode_edit($periode);

		if ($id_budget_akhir == null) {
			$id_budget_akhir = $this->M_budget->urut();
			$this->M_budget->simpan_budget($id_budget_akhir, $periode, $kd_unit, $id_rekening, $kode_akhir, $nominal, $id_input);
		}else{
			$id_add = $this->M_budget->urut_add();
			$ket = 'Dari ' . $kode_awal;
			$this->M_budget->simpan_add($id_add, $id_budget_akhir, $nominal, $id_input, $ket);
		}

		$id_add = $this->M_budget->urut_add();
		$ket = 'Ke ' . $kode_akhir;
		$this->M_budget->simpan_add($id_add, $id_budget_awal, -$nominal, $id_input, $ket);
	}

	function isi_add() {
		$data = $this->input->post('data');
		$periode1 = date('ym', strtotime($data[0]));
		$periode2 = date('ym', strtotime($data[1]));

		$data = $this->M_budget->isi_add($periode1, $periode2);
		print_r(json_encode($data));
	}

}
