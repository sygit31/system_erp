<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_its extends CI_Model 
{

	function show_kategori() {
		$data = $this->db->query("Select ib.*, ic.*, ic.id id_kategori_detail from erp_its_kategori ib join erp_its_kategori_detail ic on ic.id_kategori=ib.id where ic.aktif='1' order by ib.kategori, ic.sub_kategori");
		return $data;
	}

	function simpan_kategori($data) {
		$qty = 0;
		$id_kategori = $data[0][2];
		$kategori = $data[0][0];

		if ($id_kategori != 0) {
			$this->db->query("Update erp_its_kategori set kategori ='$kategori' where id='$id_kategori'");
			$this->db->query("Update erp_its_kategori_detail set aktif ='0' where id_kategori='$id_kategori'");
			for ($i=0; $i<count($data); $i++) {
				$sub_kategori = $data[$i][1];
				$id_kategori_detail = $data[$i][3];
				if ($id_kategori_detail > 0) {
					$this->db->query("Update erp_its_kategori_detail set id_kategori ='$id_kategori',sub_kategori='$sub_kategori',aktif='1' where id='$id_kategori_detail'");
					$qty = $qty + 1;
				}
			}
		}else{
			$nmr = $this->db->query("Select max(id) as id from erp_its_kategori");
			$urut = $nmr->row_array();
			$id_kategori = $urut['ID'] + 1;
			$this->db->query("Insert into erp_its_kategori values ('$id_kategori','$kategori','1')");
		}

		$nmr = $this->db->query("Select max(id) as id from erp_its_kategori_detail");
    	$urut = $nmr->row_array();
    	$id_kategori_detail = $urut['ID'] + 1;

    	if ($qty < count($data)) {
    		for ($i=$qty; $i<count($data); $i++) {
    			$sub_kategori = $data[$i][1];
    			$this->db->query("Insert into erp_its_kategori_detail values ('$id_kategori_detail','$id_kategori','$sub_kategori','1')");
    			$id_kategori_detail++;
    		}
    	}
	}

	function filter_kategori($cari) {
		$data = $this->db->query("Select ib.*, ic.*, ic.id id_kategori_detail from erp_its_kategori ib join erp_its_kategori_detail ic on ic.id_kategori=ib.id
			where ic.aktif='1' and upper(ib.kategori) like '%$cari%'
			order by ib.kategori, ic.sub_kategori");
		return $data;
	}

	function edit_kategori($id_kategori) {
		$data = $this->db->query("Select ib.*, ic.*, ic.id id_kategori_detail from erp_its_kategori ib join erp_its_kategori_detail ic on ic.id_kategori=ib.id
			where ic.id_kategori='$id_kategori' and ic.aktif='1' order by sub_kategori");
		return $data->result_array();
	}

	function hapus_kategori($id_kategori_detail) {
		$this->db->query("Update erp_its_kategori_detail set aktif ='0' where id='$id_kategori_detail'");
	}

	function show_data() {
		$data = $this->db->query("Select ia.*, ia.id id_data, ha.nama karyawan, ib.*, ic.*
		from erp_karyawan ha join erp_its_data ia on ia.id_karyawan=ha.id join erp_its_kategori_detail ic on ic.id=ia.id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori
		where ia.aktif='1'
		order by ia.jenis, ia.tahun, ib.kategori, ic.sub_kategori");
		return $data;
	}

	function auto_id_data() {
		$nmr = $this->db->query("Select max(id) as id from erp_its_data");
    	$urut = $nmr->row_array();
    	$id_data = $urut['ID'];
    	return $id_data;
	}

	function simpan_file($id,$id_karyawan,$jenis,$tahun,$id_kategori_detail,$filename,$tag) {
		$this->db->query("Insert into erp_its_data values ('$id','$id_karyawan','$filename','$jenis','$id_kategori_detail','$tahun','$tag','1')");
	}

	function filter_file($jenis,$tahun,$kategori,$cari) {
		$data = $this->db->query("Select ia.*, ia.id id_data, ha.nama karyawan, ib.*, ic.*
			from erp_karyawan ha join erp_its_data ia on ia.id_karyawan=ha.id join erp_its_kategori_detail ic on ic.id=ia.id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori
			where ia.aktif='1' and
			(case when '$jenis'='All' then 'All' else jenis end) like '$jenis' and (case when '$tahun'='All' then 'All' else tahun end) like '$tahun' and (case when '$kategori'='All' then 'All' else kategori end) like '$kategori' and (upper(nama_file) like '%$cari%' or upper(sub_kategori) like '%$cari%')
			order by ia.jenis, ia.tahun, ib.kategori, ic.sub_kategori");
		return $data;
	}

	function delete_file($filename,$id) {
		if (file_exists($filename)) {
			unlink($filename);
		}

		$this->db->query("Update erp_its_data set aktif='0' where id='$id'");
	}

	function ambil_file($id) {
		$dt = $this->db->query("Select ia.jenis, ib.kategori, ic.sub_kategori, ia.tahun from erp_its_data ia join erp_its_kategori_detail ic on ic.id=id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori where ia.id='$id'");
		
		$data = $dt->row_array();
		$jenis = $data['JENIS'];
		$kategori = $data['KATEGORI'];
		$sub_kategori = $data['SUB_KATEGORI'];
		$tahun = $data['TAHUN'];
		
		$file = $this->db->query("Select ia.jenis, ib.kategori, ic.sub_kategori, ia.tahun, ia.nama_file, ia.id id_data from erp_its_data ia join erp_its_kategori_detail ic on ic.id=id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori
			where ia.aktif='1' and ia.jenis='$jenis' and ib.kategori='$kategori' and ic.sub_kategori='$sub_kategori' and ia.tahun='$tahun'");

		return $file;
	}

	function show_komen($id) {
		$data = $this->db->query("Select ia.id id_data, id.note, id.tgl, ha.nama from erp_its_note id join erp_its_data ia on ia.id=id.id_data join erp_karyawan ha on ha.id=id.id_karyawan where id.aktif='1' and ia.id='$id'");
		return $data->result_array();
	}

	function simpan_comment($id_data,$id_kary,$note) {
		$nmr = $this->db->query("Select max(id) as id from erp_its_note");
    	$urut = $nmr->row_array();
    	$id_note = $urut['ID'] + 1;
    	$date = date_create(date('Y-m-d h:i:s'));
        $tgl = date_format($date,'d-m-Y hh24:mi:ss');

		$this->db->query("Insert into erp_its_note values ('$id_note','$id_data','$id_kary',to_date('".date('d/m/Y H:i:s')."', 'dd/mm/yyyy hh24:mi:ss'),'$note','1')");
	}

}
?>