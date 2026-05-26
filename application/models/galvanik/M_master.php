<?php 
class M_master extends CI_Model {

	function produk() {
		return $this->db->query("Select distinct pc.nama, cc.desain
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_barang pc on pc.id=cc.id_produk
			where substr(vb.kode_proses,0,1)='C' and vb.result='Baik' and cd.master<>'PCH' and cc.tipe='Produksi' and cc.kd_unit='12' and vb.status='1'
			order by cc.desain desc, pc.nama desc");
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_ppic_kp where desain>='2021' order by desain");
	}

	function filter($tgl1, $tgl2, $produk, $desain) {
		return $this->db->query("Select vb.id id_galv_proses, cc.tipe, cc.desain, to_char(vb.mulai, 'dd-mm-yyyy') tgl_proses, cc.nmr no_kp, cd.master, pc.nama nama_produk, vb.no_reg, vb.result,
			(select to_char(tgl_bon, 'dd-mm-yyyy') from erp_galv_bon where id_galv_proses=vb.id) tgl_bon,
			(select to_char(tgl_kembali, 'dd-mm-yyyy') from erp_galv_bon where id_galv_proses=vb.id) tgl_kembali
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_barang pc on pc.id=cc.id_produk
			where to_char(vb.mulai,'YYMMDD') between '$tgl1' and '$tgl2' and substr(vb.kode_proses,0,1)='C' and cd.master<>'PCH' and cc.tipe='Produksi' and (case when '$produk'='All' then 'All' else pc.nama end)='$produk' and vb.status='1' and cc.desain='$desain' and cc.desain>='2021'
			order by pc.nama desc, vb.mulai");
	}

	function urut() {
		$data = $this->db->query("Select max(id) id from erp_galv_bon");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan($id, $menu, $id_galv_proses, $tgl) {
		if ($menu == 'Bon') {
			$this->db->query("Insert into erp_galv_bon(id, id_galv_proses, tgl_bon) values('$id','$id_galv_proses','$tgl')");
		}else{
			$this->db->query("Update erp_galv_bon set tgl_kembali='$tgl' where id_galv_proses='$id_galv_proses'");
		}
	}

}
?>