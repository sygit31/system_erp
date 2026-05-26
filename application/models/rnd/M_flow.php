<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_flow extends CI_Model 
{

    function show_station() {
        return $this->db->query("Select * from erp_station where status='Y'");
    }

    function show_flow() {
        return $this->db->query("Select re.id, re.kode, rf.nama, re.urut
            from erp_station_flow re join erp_station rf on re.id_station=rf.id
            where rf.status='Y' and re.status='T' order by re.urut");
    }

    function filter_flow($cari) {
        return $this->db->query("Select re.id, re.kode, rf.nama, re.urut
            from erp_station_flow re join erp_station rf on re.id_station=rf.id
            where rf.status='Y' and re.status='T' and upper(re.kode) like '%$cari%' order by re.urut");
    }

    function show_proses() {
        return $this->db->query("Select id, nama from erp_station where status='Y' order by nama");
    }

    function simpan_station($nama_station) {
        $query = $this->db->query("Select max(id) as id from erp_station");        
        $result = $query->row_array();
        $id_station = $result['ID'] + 1;

        $this->db->query("Insert into erp_station (id,nama,status) values ('$id_station','$nama_station','Y')");
    }

    function urut_flow() {
      $query = $this->db->query("Select max(id) as id from erp_station_flow");		
      $result = $query->row_array();
      return $result['ID'] + 1;
  }

  function simpan_flow($id_flow,$kode,$id_station,$urut) {
      $this->db->query("Insert into erp_station_flow (id,urut,id_station,status,kode) values ('$id_flow','$urut','$id_station','T','$kode')");
  }

}
?>