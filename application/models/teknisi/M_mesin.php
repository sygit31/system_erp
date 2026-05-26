<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mesin extends CI_Model {
	
	function show_mesin() {
		return $this->db->query("Select ta.*,
			(select xmlagg(xmlelement(e,value_master||', ')).extract('//text()') from erp_tek_parameter where id_mesin=ta.id) kapasitas
			from erp_tek_mesin ta order by ta.nama_mesin");
		return $show_mesin;
	}

	function show_material() {
		return $this->db->query("Select * from erp_barang where jenis='SP - SPARE PART' and aktif='1' order by nama");
	}

	function simpan_mesin($data) {
		$nama_mesin = $data[0];
		$deskripsi = $data[1];
		$tahun = $data[2];
		$status = $data[3];
		$nomor = $data[4];
		$kapasitas = $data[5];
		$id_mesin = $data[6];

		// Simpan Mesin
		if ($id_mesin > 0) {
			$id = $id_mesin;
			$this->db->query("Update erp_tek_mesin set nama_mesin='$nama_mesin',deskripsi='$deskripsi',tahun='$tahun',status='$status',nomor='$nomor',kapasitas='$kapasitas' where id='$id_mesin'");
			$this->db->query("Update erp_tek_part set aktif='0' where id_mesin='$id_mesin'");
		}else{
			$nmr = $this->db->query("Select max(id) as id from erp_tek_mesin");
			$urut = $nmr->row_array();
			$id = $urut['ID'] + 1;
			$this->db->query("Insert into erp_tek_mesin values('$id','$nama_mesin','$deskripsi','$status','$tahun','$nomor','$kapasitas','1')");
		}

		// Simpan Part Mesin
		$nmr = $this->db->query("Select max(id) as id from erp_tek_part");
		$urut = $nmr->row_array();
		$id_tek_part = $urut['ID'] + 1;

		// Utama
		$qty_utama = 0;
		if (isset($data[9])) {
			for ($i=0; $i<count($data[9]); $i++) {
				$id_part = $data[9][$i];
				$lingkup = $data[11][$i];
				if ($data[7][$i] != '') {
					$id_edit_part = $data[7][$i];
					$this->db->query("Update erp_tek_part set id_part='$id_part',komponen='Utama',lingkup='$lingkup',aktif='1' where id='$id_edit_part'");
					$qty_utama++;
				}else{
					$this->db->query("Insert into erp_tek_part values('$id_tek_part','$id','$id_part','Utama','$lingkup','1')");
					$id_tek_part++;
				}
			}
		}

		// Pendukung
		$qty_pendukung = 0;
		if (isset($data[10])) {
			for ($i=0; $i<count($data[10]); $i++) {
				$id_part = $data[10][$i];
				$lingkup = $data[12][$i];
				if ($data[8][$i] != '') {
					$id_edit_part = $data[8][$i];
					$this->db->query("Update erp_tek_part set id_part='$id_part',komponen='Pendukung',lingkup='$lingkup',aktif='1' where id='$id_edit_part'");
					$qty_pendukung++;
				}else{
					$this->db->query("Insert into erp_tek_part values('$id_tek_part','$id','$id_part','Pendukung','$lingkup','1')");
					$id_tek_part++;
				}
			}
		}
	}

	function filter_mesin($data) {
		$tahun = $data[0];
		$cari = strtoupper($data[1]);

		$mesin = $this->db->query("Select ta.*,
			(select xmlagg(xmlelement(e,value_master||', ')).extract('//text()') from erp_tek_parameter where id_mesin=ta.id) kapasitas
			from erp_tek_mesin ta
			where (case when '$tahun'='All' then 'All' else tahun end) like '$tahun' and upper(nama_mesin) like '%$cari%'
			order by nama_mesin");
		return $mesin;
	}

	function show_part($id) {
		$show_part = $this->db->query("Select pc.id id_part, pc.nama, pc.spesifikasi, pc.kode, pc.satuan, tb.id id_tek_part, tb.komponen, tb.lingkup, ta.nomor, ta.nama_mesin, ta.deskripsi, ta.kapasitas, ta.tahun, ta.status,
			(select count(komponen) from erp_tek_part where id_mesin='$id' and komponen='Utama' and aktif='1') qty_utama,
			(select count(komponen) from erp_tek_part where id_mesin='$id' and komponen='Pendukung' and aktif='1') qty_pendukung
			from erp_barang pc join erp_tek_part tb on tb.id_part=pc.id right join erp_tek_mesin ta on ta.id=tb.id_mesin where ta.id='$id' and
			(case when (select count(komponen) from erp_tek_part where id_mesin='$id' and aktif='1')=0 then '1' else tb.aktif end)='1'
			order by pc.nama");

		$part = $show_part->result_array();
		return $part;
	}

}