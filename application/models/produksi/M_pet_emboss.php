<?php class M_pet_emboss extends CI_Model {

	function akses($id_kary) {
		$query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_akun aa on aa.id=ab.id_akun where aa.id_karyawan='$id_kary'");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)=4 order by desain desc");
	}

	function filter($tgl1, $tgl2, $status, $kode, $desain) {
		$query = $this->db->query("Select * from
			(select distinct gb.id_detail_terima, pc.nama, pc.spesifikasi, to_char(gj.tanggal, 'DD-MM-YYYY') tgl, ga.no_sp, pa.nomer no_po, gb.barcode, gb.kode_roll, gb.qty_terima qty_terima_fix, gu.id, gu.qty_terima, gu.panjang, gu.teller, gu.barcode_awal
			from erp_penerimaan ga join erp_penerimaan_detail gb on gb.id_terima=ga.id_terima join erp_po_detail pb on pb.id=ga.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk left join erp_gdg_pet_emboss gu on gu.id_detail_terima=gb.id_detail_terima
			where gb.status_qc='OUT' and to_char(gj.tanggal, 'YYMMDD') between '$tgl1' and '$tgl2' and gb.kode_roll like '%$kode%' and cj.desain='$desain'
			order by gb.id_detail_terima) where
			(case when '$status'='All' then 'All' when '$status'<>'PR' then nvl(teller, 'P') else nvl2(teller, 'PR', 'P') end)='$status'");
		return $query->result_array();
	}

	function urut() {
		$data = $this->db->query("Select max(id) id from erp_gdg_pet_emboss");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan($urut, $id_detail_terima, $panjang_awal, $panjang_pnp, $teller, $barcode_awal) {
		$this->db->query("Insert into erp_gdg_pet_emboss(id, id_detail_terima, qty_terima, panjang, teller, barcode_awal) values('$urut', '$id_detail_terima', '$panjang_awal', '$panjang_pnp', '$teller', '$barcode_awal')");
	}

	function update($id_pet_emboss, $id_detail_terima, $panjang_awal, $panjang_pnp, $teller, $barcode_awal) {
		$this->db->query("Update erp_gdg_pet_emboss set qty_terima='$panjang_awal', panjang='$panjang_pnp', teller='$teller', barcode_awal='$barcode_awal' where id='$id_pet_emboss'");
	}

	function dt_terima($id_detail_terima) {
		$query = $this->db->query("Select barcode, qty_terima from erp_penerimaan_detail where id_detail_terima='$id_detail_terima'");
		return $query->row_array();
	}

	function update_terima($id_detail_terima, $barcode_final, $panjang_final) {
		$this->db->query("Update erp_penerimaan_detail set barcode='$barcode_final', qty_terima='$panjang_final' where id_detail_terima='$id_detail_terima'");
	}

}