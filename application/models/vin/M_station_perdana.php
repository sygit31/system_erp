<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_station_perdana extends CI_Model 
{

    function show_station_perdana() {
        return $this->db->query("Select * from p_station order by id desc");
    }

	function simpan_station_perdana($id_edit,$station) {
		if ($id_edit == '') {
			$query = $this->db->query("Select max(id) as id from p_station");
			$urut = $query->row_array();
			$id = $urut['ID'] + 1;
			
			$this->db->query("Insert into p_station (id,nama) values ('$id', upper('$station'))");
		}else{
			$this->db->query("Update p_station set nama=upper('$station') where id='$id_edit'");
		}
	}

	function filter_station($cari) {
		return $this->db->query("Select * from p_station where upper(nama) like '%$cari%'
			order by id desc");
	}

}
?>