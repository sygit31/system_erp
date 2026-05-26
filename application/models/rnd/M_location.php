<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_location extends CI_Model 
{

	function show_location() {
		return $this->db->query("Select * from erp_rnd_location where aktif<>'0' order by pic");
	}

	function simpan_location($id_edit,$lokasi,$pic,$telp,$keterangan) {
		if ($id_edit == '') {
			$query = $this->db->query("Select max(id) as id from erp_rnd_location");
			$urut = $query->row_array();
			$id = $urut['ID'] + 1;
			
			$this->db->query("Insert into erp_rnd_location (id,location,pic,telp,note,aktif) values ('$id','$lokasi','$pic','$telp','$keterangan','1')");
		}else{
			$this->db->query("Update erp_rnd_location set location='$lokasi',pic='$pic',telp='$telp',note='$keterangan' where id='$id_edit'");
		}
	}

	function filter_location($cari) {
		return $this->db->query("Select * from erp_rnd_location where aktif<>'0' and upper(location) like '%$cari%'
			order by pic");
	}

}
?>