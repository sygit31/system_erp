<?php 
class M_budget extends CI_Model {

	function get_periode() {
		return $this->db->query("Select distinct to_char(tgl_input,'MM/YYYY') periode from erp_ppic_budget");
	}

	function get_bagian() {
		$kary = explode('|',$_SESSION['logERP']);
		$id_kary = $kary[0];
		$query = $this->db->query("Select id_bagian from erp_karyawan where id='$id_kary'");
		$data = $query->row_array();
		return $data['ID_BAGIAN'];
	}

	function get_budget() {
		$id_bagian = $this->get_bagian();

		$query = $this->db->query("Select distinct ha.nama, hb.nama bagian, cg.id id_budget, cg.periode, cg.tgl_input, cg.nmr,
			(Select sum(approval_status) from erp_ppic_budget_app where id_budget=cg.id) status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id) qty_status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id and approval_status='0') reject_status,
			(Select replace(sum(budget_beli * harga),',','.') from erp_ppic_budget_detail where id_budget=cg.id) total
			from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
			where hb.id='$id_bagian'");
		return $query;		
	}

	function filter_budget($periode) {
		$query = $this->db->query("Select distinct ha.nama, hb.nama bagian, cg.id id_budget, cg.periode, cg.tgl_input, cg.nmr,
			(Select sum(approval_status) from erp_ppic_budget_app where id_budget=cg.id) status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id) qty_status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id and approval_status='0') reject_status,
			(Select replace(sum(budget_beli * harga),',','.') from erp_ppic_budget_detail where id_budget=cg.id) total
			from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
			where (case when '$periode'='All' then 'All' else to_char(tgl_input,'MM/YYYY') end)='$periode'");
		return $query;		
	}

	function show_budget($periode) {
		$query = $this->db->query("Select distinct pc.id, pc.nama nama_material, pc.satuan, pc.jenis, pc.min_stok,
			(select moq from erp_material_supply where id_barang=pc.id and rownum='1' and aktif='1') moq,
			(select harga from erp_material_supply where id_barang=pc.id and rownum='1' and aktif='1') harga,
			(select mata_uang from erp_material_supply where id_barang=pc.id and rownum='1' and aktif='1') mata_uang,
			(select replace(sum(rd2.qty*(ub2.qty+(case when uc2.qty is null then 0 else uc2.qty end))),',','.') from erp_rnd_bom rd2 join erp_cs_risalah_detail ub2 on ub2.id_proses=rd2.id_rnd_proses join erp_cs_risalah ua2 on ua2.id=ub2.id_risalah left join erp_cs_risalah_revisi uc2 on uc2.id_risalah_detail=ub2.id where rd2.id_barang=pc.id and to_char(ua2.tgl,'MM/YYYY')='$periode') qty,
			(select sum(distinct ub2.qty) from erp_cs_risalah_detail ub2 join erp_rnd_bom rd2 on rd2.id_rnd_proses=ub2.id_proses join erp_cs_risalah ua2 on ua2.id=ub2.id_risalah where rd2.id_barang=pc.id and to_char(ua2.tgl,'MM/YYYY')='$periode') risalah,
			(select sum(replace(gb2.qty_terima,'.',',')) from erp_penerimaan_detail gb2 join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang=pc.id and gb2.status_qc='T_OK') stok,
			(select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang=pc.id and pb2.status='OTW') qty_terima,
			(select sum(pb2.qty) from erp_po_detail pb2 join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang=pc.id and pb2.status='OTW') qty_po
			from erp_barang pc join erp_rnd_bom rd on rd.id_barang=pc.id join erp_rnd_proses rb on rb.id=rd.id_rnd_proses join erp_cs_risalah_detail ub on ub.id_proses=rb.id join erp_cs_risalah ua on ua.id=ub.id_risalah
			where pc.aktif='1' and to_char(ua.tgl,'MM/YYYY')='$periode'
			order by pc.jenis, pc.nama");
		return $query->result_array();
	}

	function urut_budget() {
		$year = date("y");
		$bln = $this->getRomawi(date("n"));

		$query = $this->db->query("Select max(id) id, max(substr(nmr,-3)) nmr from erp_ppic_budget where to_char(tgl_input,'YY')='$year'");
		$data = $query->row_array();
		$id_budget = (int)$data['ID'] + 1;
		$urut = sprintf("%'03d\n",$id_budget);

		$nmr = $year . '/' . 'BUDGET' . '/' . $bln . '/' . $urut;

		return array($id_budget,$nmr);
	}

	function simpan_budget($id_budget,$periode,$nmr,$unit,$bagian) {
		$kary = explode('|',$_SESSION['logERP']);
		$id_kary = $kary[0];
		$this->db->query("Insert into erp_ppic_budget values('$id_budget',sysdate,'$periode','$id_kary','$nmr','$unit','$bagian')");
	}

	function urut_budget_detail() {
		$query = $this->db->query("Select max(id) id from erp_ppic_budget_detail");
		$urut = $query->row_array();
		return $urut['ID'] + 1;      
	}

	function simpan_budget_detail($dt_budget_detail,$id_budget,$id_barang,$kebutuhan,$safety_stock,$saldo,$moq,$outstanding,$budget_beli,$harga,$mata_uang) {
		return $this->db->query("Insert into erp_ppic_budget_detail values('$dt_budget_detail','$id_budget','$id_barang','$kebutuhan','$safety_stock','$saldo','$moq','$outstanding','$budget_beli','$harga','$mata_uang')");
	}

	function urut_approval() {
		$query = $this->db->query("Select max(id) id from erp_ppic_budget_app");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function kary_approval() {
		return $this->db->query("Select ag.id_karyawan_approval from erp_adm_submission af join erp_adm_submission_detail ag on ag.id_submission=af.id where af.id_menu_detail='106'");
	}

	function simpan_budget_app($id_approval,$id_budget,$id_karyawan_approval) {
		$this->db->query("Insert into erp_ppic_budget_app values ('$id_approval','$id_budget','$id_karyawan_approval','','')");
	}

	function getRomawi($bln){
		switch ($bln){
			case 1: 
			return "I";
			break;
			case 2:
			return "II";
			break;
			case 3:
			return "III";
			break;
			case 4:
			return "IV";
			break;
			case 5:
			return "V";
			break;
			case 6:
			return "VI";
			break;
			case 7:
			return "VII";
			break;
			case 8:
			return "VIII";
			break;
			case 9:
			return "IX";
			break;
			case 10:
			return "X";
			break;
			case 11:
			return "XI";
			break;
			case 12:
			return "XII";
			break;
		}
	}

}
?>