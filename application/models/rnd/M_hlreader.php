<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hlreader extends CI_Model {

	function hlreader() {
		return $this->db->query("Select no_register from erp_rnd_hlreader order by no_register desc");
	}

	function location() {
		return $this->db->query("Select * from erp_rnd_location where aktif<>'0' order by location");
	}

	function tahun() {
		return $this->db->query("Select distinct tahun from erp_rnd_hlreader where tahun is not null order by tahun desc");
	}

	function simpan($id_edit,$tahun,$no_register,$kondisi,$keterangan) {
		if ($id_edit == '') {
			$query = $this->db->query("Select max(id) as id from erp_rnd_hlreader");
			$urut = $query->row_array();
			$id = $urut['ID'] + 1;
			
			$this->db->query("Insert into erp_rnd_hlreader (id,tahun,no_register,kondisi,note,status,tgl) values ('$id','$tahun','$no_register','$kondisi','$keterangan','1',sysdate)");
		}else{
			$this->db->query("Update erp_rnd_hlreader set tahun='$tahun',no_register='$no_register',kondisi='$kondisi',note='$keterangan',tgl=sysdate where id='$id_edit'");
		}
	}

	function filter($tahun,$cari,$kondisi,$upgrade,$hlreader) {
		if ($cari == '') {$cari = 'null';}

		return $this->db->query("Select ri.*, rh.location from erp_rnd_hlreader ri left join erp_rnd_location rh on rh.id=ri.id_location
			where (case when '$hlreader'='All' then 'All' else ri.no_register end)='$hlreader' and (case when '$tahun'='All' then 'All' else ri.tahun end)='$tahun' and (case when '$kondisi'='All' then 'All' else ri.kondisi end)='$kondisi' and (case when '$cari'='All' then 'All' when (ri.id_location is null and '$cari'='null') then 'null' else rh.location end) like '$cari' and (case when '$upgrade'='All' then 'All' else ri.upgrade end)='$upgrade' and ri.status<>'2'
			order by ri.no_register desc");
	}

	function hapus($id_hapus) {
		$this->db->query("Update erp_rnd_hlreader set status='2' where id ='$id_hapus'");
	}

}