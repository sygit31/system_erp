<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_log extends CI_Model {

	function show_log() {
		$date1 = date_create(date('Y-m-d', strtotime('-0 days')));
		$date2 = date_create(date('Y-m-d'));

		$tgl1 = date_format($date1,'d-m-Y');
		$tgl2 = date_format($date2,'d-m-Y');

		$data = $this->db->query("Select ae.id id_log, ha.nama, hb.nama bagian, hc.nama jabatan, to_char(ae.tgl,'dd-Mon-yy hh24:mi:ss') tgl, ae.ip_comp
			from erp_adm_log ae join erp_akun aa on aa.id = ae.id_akun join erp_karyawan ha on ha.id=aa.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where to_date(ae.tgl,'dd-mm-yyyy') between '$tgl1' and '$tgl2'
			order by ae.tgl desc");
		return $data;
	}

	function filter_log($tgl1,$tgl2,$cari) {
		$data = $this->db->query("Select ae.id id_log, ha.nama, hb.nama bagian, hc.nama jabatan, to_char(ae.tgl,'dd-Mon-yy hh24:mi:ss') tgl, ae.ip_comp
			from erp_adm_log ae join erp_akun aa on aa.id = ae.id_akun join erp_karyawan ha on ha.id=aa.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where to_date(ae.tgl,'dd-mm-yyyy') between '$tgl1' and '$tgl2' and upper(ha.nama) like '%$cari%'
			order by ae.tgl desc");
		return $data;
	}

	public function simpan_log($id_akun) {		
		$dt = $this->db->query("Select max(id) as id from erp_adm_log")->row_array();
		$id_log = $dt['ID'] + 1;

		$ip = $this->info_client_ip_getenv();

		$this->db->query("Insert into erp_adm_log values('$id_log','$id_akun',sysdate,'$ip')");
	}

	// Detect IP
	function info_client_ip_getenv() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';

		return $ipaddress; 
	}

	// Jika ada kendala di NLS Setting
	public function set_nls_global() {		
		$this->db_perdana = $this->load->database('perdana', TRUE);

		$this->db_perdana->query("Alter session set nls_date_format = 'dd-mm-yyyy'");
		$this->db->query("Alter session set nls_date_format = 'dd-mm-yyyy'");

		$this->db_perdana->query("Alter session set nls_numeric_characters = ',.'");
		$this->db->query("Alter session set nls_numeric_characters = ',.'");
	}

}

?>