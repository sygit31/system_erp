<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_satuan_perdana extends CI_Model 
{

    function show_satuan_perdana() {
        return $this->db->query("Select * from p_satuan order by id desc");
    }

	function simpan_satuan_perdana($id_edit,$satuan) {
		if ($id_edit == '') {
			$query = $this->db->query("Select max(id) as id from p_satuan");
			$urut = $query->row_array();
			$id = $urut['ID'] + 1;
			
			$this->db->query("Insert into p_satuan (id,nama) values ('$id', upper('$satuan'))");
		}else{
			$this->db->query("Update p_satuan set nama=upper('$satuan') where id='$id_edit'");
		}
	}

	function simpan_konversi_perdana($id_edit,$satuan_awal,$nama_konversi,$satuan_akhir,$konversi) {
		if ($id_edit == '') {
			$query = $this->db->query("Select max(id) as id from p_satuan_konversi");
			$urut = $query->row_array();
			$id = $urut['ID'] + 1;
			
			$this->db->query("Insert into p_satuan_konversi (id,nama,id_satuan_awal,id_satuan_akhir,konversi) values ('$id', '$nama_konversi','$satuan_awal','$satuan_akhir','$konversi')");
		}else{
			$this->db->query("Update p_satuan_konversi set nama='$nama_konversi',id_satuan_akhir='$satuan_akhir',konversi='$konversi' where id='$id_edit'");
		}
	}

	function filter_satuan($cari) {
		return $this->db->query("Select * from p_satuan where upper(nama) like '%$cari%'
			order by id desc");
	}

	function filter_konversi($cari,$id_awal) {
		$query = $this->db->query("Select a.*,b.nama_satuan_awal,c.nama_satuan_akhir from p_satuan_konversi a,
		(select distinct(b.id) as id_awal,b.nama as nama_satuan_awal  from p_satuan_konversi a,p_satuan b  where a.id_satuan_awal=b.id) b,
		(select distinct(b.id) as id_akhir,b.nama as nama_satuan_akhir  from p_satuan_konversi a,p_satuan b  where a.id_satuan_akhir=b.id) c 
		where a.id_satuan_awal=b.id_awal and a.id_satuan_akhir = c.id_akhir and a.id_satuan_awal='$id_awal' and a.nama like '%$cari%' order by a.id desc ");
		return $query->result();
	}
	function show_satuan_akhir($id) {
        $query = $this->db->query("Select * from p_satuan where id !='$id' order by id desc");
		return $query->result();
	}
   function show_konversi_satuan($id) {
	   $query = $this->db->query("Select a.*,b.nama_satuan_awal,c.nama_satuan_akhir from p_satuan_konversi a,
	   (select distinct(b.id) as id_awal,b.nama as nama_satuan_awal  from p_satuan_konversi a,p_satuan b  where a.id_satuan_awal=b.id) b,
	   (select distinct(b.id) as id_akhir,b.nama as nama_satuan_akhir  from p_satuan_konversi a,p_satuan b  where a.id_satuan_akhir=b.id) c 
	   where a.id_satuan_awal=b.id_awal and a.id_satuan_akhir = c.id_akhir and a.id_satuan_awal='$id'  order by a.id desc ");
       return $query->result();
	}
}
?>
