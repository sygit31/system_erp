<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Downtime extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta"); 
		
		$this->load->model('produksi/M_downtime');
		session_start();
	}

	function index() {
		$data['desain'] = $this->M_downtime->desain();		
		$data['seri'] = $this->M_downtime->seri();		
		$data['dt_kk'] = $this->M_downtime->kk();		
		$data['proses'] = $this->M_downtime->proses();		
		$data['jenis_downtime'] = $this->M_downtime->jenis_downtime();
		$data['nama_mesin'] = $this->M_downtime->nama_mesin();
		$data['operator'] = $this->M_downtime->operator();
		
		$this->load->view('produksi/v_downtime.php',$data);
	}

	function filter() {
		$data = $this->input->post('data');
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$proses = $data[2];
		$nama_mesin = $data[3];
		$desain = $data[4];
		$kk = $data[5];
		$seri = $data[6];

		$data['downtime'] = $this->M_downtime->filter($tgl1, $tgl2, $proses, $nama_mesin, $desain, $kk, $seri);
		$this->load->view('produksi/v_downtime_table', $data);
	}

	function isi_operator() {
		$data = $this->input->post('data');
		$proses = $data[0];
		$desain = $data[1];
		$nama_mesin = $data[2];
		$shift = $data[3];

		$data = $this->M_downtime->isi_operator($proses, $desain, $nama_mesin, $shift);
		print_r($data);
	}

	function simpan() {
		$data = $this->input->post('data');
		$id_edit = $data[0];
		$tanggal = date('d-m-Y',strtotime($data[1]));
		$tomorrow = date('d-m-Y',strtotime("+1 days",strtotime($data[1])));
		$proses = $data[2];
		$id_kk = $data[3];
		$nama_mesin = $data[4];
		$shift = $data[5];
		$dt_downtime = $data[6];
		$desain = $data[7];
		$pp = $data[8];
		$operator = $data[9];
		$id_prod_proses = $this->M_downtime->id_prod_proses($proses,$nama_mesin,$shift);

		if ($id_edit != '') {$this->M_downtime->hapus($id_edit);}

		$urut_opt = $this->M_downtime->urut_opt();
		for ($i=0; $i<count($dt_downtime[0]); $i++) {
			$id_jenis = $dt_downtime[0][$i];

			$time_mulai = (int)date('Gi',strtotime($dt_downtime[1][$i]));
			if ($time_mulai < 630) {
				$mulai = $tomorrow . ' ' . $dt_downtime[1][$i];
			}else{
				$mulai = $tanggal . ' ' . $dt_downtime[1][$i];				
			}			

			$time_selesai = (int)date('Gi',strtotime($dt_downtime[2][$i]));
			if ($time_selesai < 630) {
				$selesai = $tomorrow . ' ' . $dt_downtime[2][$i];
			}else{
				$selesai = $tanggal . ' ' . $dt_downtime[2][$i];				
			}

			$keterangan = $dt_downtime[3][$i];
			$id_downtime = $this->M_downtime->urut_downtime();
			$this->M_downtime->simpan($id_downtime, $id_kk, $id_jenis, $id_prod_proses, $tanggal, $proses, $nama_mesin, $shift, $mulai, $selesai, $keterangan, $desain, $pp);

			for ($j=0; $j<count($operator); $j++) {
				$id_operator = $operator[$j];
				$status = '2';
				$this->M_downtime->simpan_opt($urut_opt, $id_downtime, $id_operator, $status);
				$urut_opt++;
			}
		}
	}

	function edit() {
		$id_edit = $this->input->post('data');
		$data = $this->M_downtime->edit($id_edit);
		print_r(json_encode($data));
	}

	function hapus() {
		$id_hapus = $this->input->post('data');
		$this->M_downtime->hapus($id_hapus);
	}

}