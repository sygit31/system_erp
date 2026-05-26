<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Budget extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		$this->load->model('ppic/M_budget');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$data['periode'] = $this->M_budget->get_periode();
		$data['budget'] = $this->M_budget->get_budget();
		$this->load->view('ppic/v_budget.php',$data);
	}

	function show_budget() {
		$periode = $this->input->post('data');

		$data = $this->M_budget->show_budget($periode);
		print_r(json_encode($data));
	}

	function simpan_budget() {
		$data = $this->input->post('data');
		$unit = $data[0];
		$bagian = $data[1];
		$periode = $data[2];

		$dt_budget = $this->M_budget->urut_budget();
		$id_budget = $dt_budget[0];
		$nmr = $dt_budget[1];

		$query = $this->M_budget->simpan_budget($id_budget,$periode,$nmr,$unit,$bagian);

		$id_budget_detail = $this->M_budget->urut_budget_detail();
		for ($i=0; $i<count($data[3]); $i++) {
			$id_barang = $data[3][$i];
			$kebutuhan = str_replace('.',',',$data[4][$i]);
			$safety_stock = str_replace('.',',',$data[5][$i]);
			$saldo = str_replace('.',',',$data[6][$i]);
			$moq = str_replace('.',',',$data[7][$i]);
			$outstanding = str_replace('.',',',$data[8][$i]);
			$budget_beli = str_replace('.',',',$data[9][$i]);
			$harga = str_replace('.',',',$data[10][$i]);
			$mata_uang = $data[11][$i];

			$this->M_budget->simpan_budget_detail($id_budget_detail,$id_budget,$id_barang,$kebutuhan,$safety_stock,$saldo,$moq,$outstanding,$budget_beli,$harga,$mata_uang);
			$id_budget_detail++;
		}

		$id_approval = $this->M_budget->urut_approval();
		$id_kary_approval = $this->M_budget->kary_approval();		
		foreach ($id_kary_approval->result_array() as $dt):
			$id_karyawan_approval = $dt["ID_KARYAWAN_APPROVAL"];
			$this->M_budget->simpan_budget_app($id_approval,$id_budget,$id_karyawan_approval);
			$id_approval++;
		endforeach;
	}

	function filter_budget() {
		$periode = $this->input->post('data');
		
		$data['budget'] = $this->M_budget->filter_budget($periode);
		$this->load->view('ppic/v_budget_table.php',$data);
	}

}

?>