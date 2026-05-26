<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pet_emboss extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('produksi/M_pet_emboss');
		session_start();
		
		if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
	}

	function index() {
		$id_kary = explode('|', $_SESSION['logERP'])[0];
		$data['akses'] = $this->M_pet_emboss->akses($id_kary);
		$data['desain'] = $this->M_pet_emboss->desain();
		$data['menu'] = $_GET['mn'];
		$this->load->view('produksi/v_pet_emboss.php', $data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$status = $data[2];
		$kode = $data[3];
		$desain = $data[4];

		$data = $this->M_pet_emboss->filter($tgl1, $tgl2, $status, $kode, $desain);
		print_r(json_encode($data));
	}

	function simpan() {
		$data = $this->input->post('data');
		$t_id_pet_emboss = $data[0];
		$t_id_detail_terima = $data[1];
		$t_panjang_awal = $data[2];
		$t_panjang_pnp = $data[3];
		$t_teller = $data[4];
		$t_barcode_awal = $data[5];
		$t_panjang_final = $data[6];
		$t_barcode_final = $data[7];

		$urut = $this->M_pet_emboss->urut();
		for ($i=0; $i<count($t_id_detail_terima); $i++) {
			$id_pet_emboss = $t_id_pet_emboss[$i];
			$id_detail_terima = $t_id_detail_terima[$i];
			$panjang_awal = $t_panjang_awal[$i];
			$panjang_pnp = $t_panjang_pnp[$i];
			$teller = $t_teller[$i] == 0 ? '0' : ($t_teller[$i] <= 25 ? '1' : '2');
			$barcode_awal = $t_barcode_awal[$i];
			$panjang_final = $t_panjang_final[$i];
			$barcode_final = $t_barcode_final[$i];

			if ($id_pet_emboss != 'null') {
				$this->M_pet_emboss->update($id_pet_emboss, $id_detail_terima, $panjang_awal, $panjang_pnp, $teller, $barcode_awal);
			}else{
				$this->M_pet_emboss->simpan($urut, $id_detail_terima, $panjang_awal, $panjang_pnp, $teller, $barcode_awal);
				$urut++;
			}

			$barcode_final = $teller == '2' ? $barcode_final : $barcode_awal;
			$panjang_final = $teller == '2' ? $panjang_final : $panjang_awal;
			$this->M_pet_emboss->update_terima($id_detail_terima, $barcode_final, $panjang_final);
		}
	}

}