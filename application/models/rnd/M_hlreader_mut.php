<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hlreader_mut extends CI_Model 
{

	function filter_mutasi($jenis,$hlreader,$location,$kondisi,$aktif,$tahun) {
		return $this->db->query("Select rg.id, to_char(rg.tgl,'dd-mm-yyyy') tgl, rg.mutasi, rg.nomor, ri.no_register, ri2.no_register no_register2, rh.location, rh.pic, rg.upgrade, rg.kondisi, rg.note, rg.id_location, rg.id_hlreader, rg.id_hlreader_new, ha.nama, rg.aktif,
			(select count(id) from erp_rnd_hlreader_mut where (id_hlreader=ri.id or id_hlreader_new=ri.id or id_hlreader=ri2.id or id_hlreader_new=ri2.id) and id>rg.id and aktif<>'0') qty_data
			from erp_rnd_hlreader ri join erp_rnd_hlreader_mut rg on rg.id_hlreader=ri.id left join erp_rnd_location rh on rh.id=rg.id_location left join erp_rnd_hlreader ri2 on ri2.id=rg.id_hlreader_new left join erp_rnd_location rh2 on rh2.id=ri.id_location left join erp_karyawan ha on ha.id=rg.id_karyawan_pinjam
			where to_char(rg.tgl,'YYYY')='$tahun' and rg.aktif='$aktif' and (case when '$jenis'='All' then 'All' else rg.mutasi end) ='$jenis' and ((case when '$hlreader'='All' then 'All' else ri.no_register end) ='$hlreader' or (case when '$hlreader'='All' then 'All' else ri2.no_register end) ='$hlreader') and (case when '$location'='All' then 'All' else rh.location end) ='$location' and (case when '$kondisi'='All' then 'All' else rg.kondisi end) ='$kondisi'
			order by rg.tgl desc, rg.id desc, ri.no_register desc");
	}

	function tahun() {
		return $this->db->query("Select distinct to_char(tgl,'YYYY') tahun from erp_rnd_hlreader_mut order by to_char(tgl,'YYYY') desc");
	}

	function location_mutasi() {
		return $this->db->query("Select distinct rh.location from erp_rnd_location rh join erp_rnd_hlreader_mut rg on rg.id_location=rh.id order by rh.location");
	}

	function hlreader_mutasi() {
		return $this->db->query("Select distinct ri.no_register from erp_rnd_hlreader ri join erp_rnd_hlreader_mut rg on rg.id_hlreader=ri.id order by ri.no_register desc");
	}

	function hlreader_distribusi() {
		return $this->db->query("Select ri.id, ri.no_register from erp_rnd_hlreader ri where ri.status='1' or
			(select aktif from erp_rnd_location where id=ri.id_location)='2'
			order by ri.no_register desc");
	}

	function location_distribusi() {
		return $this->db->query("Select id,location from erp_rnd_location where aktif<>'0' order by location");
	}

	function hlreader_upgrade() {
		return $this->db->query("Select id,no_register,id_location from erp_rnd_hlreader order by no_register desc");
	}

	function hlreader_tukar() {
		return $this->db->query("Select id,no_register,id_location from erp_rnd_hlreader where status='0' order by no_register desc");
	}

	function hlreader_pinjam() {
		return $this->db->query("Select distinct ri.id, ri.no_register, ri.id_location from erp_rnd_hlreader ri join erp_rnd_hlreader_mut rg on ri.id=rg.id_hlreader where ri.status='0' and rg.mutasi='Pinjam' order by ri.no_register desc");
	}

	function show_karyawan() {
		return $this->db->query("Select id, nama from erp_karyawan where nama<>'Super Admin' and status='1'
			order by nama");
	}

	function urut_mutasi() {
		$query = $this->db->query("Select max(id) as id from erp_rnd_hlreader_mut");
		$urut = $query->row_array();
		$id = $urut['ID'] + 1;
		return $id;
	}

	function simpan_mutasi($id_mutasi,$id_hlreader,$id_hlreader_new,$id_karyawan,$jenis,$no_surat,$tanggal,$id_location,$tahun,$kondisi,$keterangan,$id_karyawan_pinjam) {
		$this->db->query("Insert into erp_rnd_hlreader_mut values('$id_mutasi','$id_hlreader','$id_hlreader_new','$id_karyawan','$jenis','$no_surat','$tanggal','$id_location','$tahun','$kondisi','$keterangan','$id_karyawan_pinjam','1')");
	}

	function area_kembali($hlreader_kembali) {
		$query = $this->db->query("Select rh.location from erp_rnd_hlreader ri join erp_rnd_location rh on rh.id=ri.id_location where ri.no_register='$hlreader_kembali'");
		$data = $query->row_array();
		return $data['LOCATION'] ;
	}

	function area_tukar($hlreader_tukar) {
		$query = $this->db->query("Select rh.location from erp_rnd_hlreader ri join erp_rnd_location rh on rh.id=ri.id_location where ri.no_register='$hlreader_tukar'");
		$data = $query->row_array();
		return $data['LOCATION'] ;
	}

	function update_lokasi($jenis,$id_location,$id_hlreader,$tahun,$kondisi,$id_hlreader_new) {
		if ($jenis == 'Distribusi') {
			$this->db->query("Update erp_rnd_hlreader set id_location='$id_location', status='0', kondisi='$kondisi' where id='$id_hlreader'");
		}elseif($jenis == 'Upgrade') {
			$this->db->query("Update erp_rnd_hlreader set upgrade='$tahun', kondisi='$kondisi' where id='$id_hlreader'");
		}elseif($jenis == 'Tukar') {
			$query = $this->db->query("Select id_location from erp_rnd_hlreader where id='$id_hlreader'");
			$dt = $query->row_array();
			$id_location = $dt['ID_LOCATION'];
			$this->db->query("Update erp_rnd_hlreader set id_location='', status='1', kondisi='$kondisi' where id='$id_hlreader'");
			$this->db->query("Update erp_rnd_hlreader set id_location='$id_location', status='0' where id='$id_hlreader_new'");
		}elseif($jenis == 'Kembali') {
			$this->db->query("Update erp_rnd_hlreader set id_location='', status='1', kondisi='$kondisi' where id='$id_hlreader'");
		}elseif($jenis == 'Pinjam') {
			$this->db->query("Update erp_rnd_hlreader set id_location='', status='0', kondisi='$kondisi' where id='$id_hlreader'");
		}
	}

	function hapus_mutasi($id_mutasi,$jenis,$id_hlreader,$kondisi,$hlreader_new,$id_location) {
		if ($jenis == 'Distribusi') {
			$this->db->query("Update erp_rnd_hlreader set id_location='', status='1', kondisi='$kondisi' where id='$id_hlreader'");
		}elseif ($jenis == 'Upgrade') {
			$this->db->query("Update erp_rnd_hlreader set upgrade='', id_location='$id_location' where id='$id_hlreader'");
		}elseif ($jenis == 'Tukar') {
			$this->db->query("Update erp_rnd_hlreader set id_location='$id_location', status='0' where id='$id_hlreader'");
			$this->db->query("Update erp_rnd_hlreader set id_location='', status='1' where id='$hlreader_new'");
		}elseif ($jenis == 'Kembali') {
			$this->db->query("Update erp_rnd_hlreader set id_location='$id_location', status='0' where id='$id_hlreader'");
		}elseif ($jenis == 'Pinjam') {
			$this->db->query("Update erp_rnd_hlreader set status='1' where id='$id_hlreader'");
		}

		$this->db->query("Update erp_rnd_hlreader_mut set aktif='0' where id='$id_mutasi'");
	}

}
?>