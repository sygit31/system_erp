<?php class M_update_stok extends CI_Model {

	function getdata() {
		return $this->db->query("Select aa.id, to_char(aa.tanggal,'YYYY-MM-DD') tanggal, aa.jumlah, aa.satuan, aa.seri, aa.id_bagian, hb.nama nama_bagian
			from erp_prod_update_stok aa
			join erp_bagian hb on hb.id=aa.id_bagian
			order by aa.tanggal desc")->result_array();
	}

	function get_bagian() {
		return $this->db->query("Select id, nama from erp_bagian where produksi = 'Y' order by nama")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_prod_update_stok");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($tanggal, $jumlah, $satuan, $seri, $id_bagian) {
		$id = $this->urut();
		$this->db->query("Insert into erp_prod_update_stok(id, tanggal, jumlah, satuan, seri, id_bagian) values('$id', to_date('$tanggal','YYYY-MM-DD'), '$jumlah', '$satuan', '$seri', '$id_bagian')");
	}

	function cek_data($tanggal, $seri, $id_bagian) {
		$query = $this->db->query("Select count(*) jumlah
			from erp_prod_update_stok
			where trunc(tanggal)=to_date('$tanggal','YYYY-MM-DD')
				and upper(trim(seri))=upper(trim('$seri'))
				and id_bagian='$id_bagian'");
		$data = $query->row_array();
		return $data['JUMLAH'];
	}

	function update($id, $tanggal, $jumlah, $satuan, $seri, $id_bagian) {
		$this->db->query("Update erp_prod_update_stok
			set tanggal=to_date('$tanggal','YYYY-MM-DD'),
				jumlah='$jumlah',
				satuan='$satuan',
				seri='$seri',
				id_bagian='$id_bagian'
			where id='$id'");
	}

	function hapus($id) {
		$this->db->query("Delete from erp_prod_update_stok where id='$id'");
	}

	function lap_stok($tanggal) {
		return $this->db->query("Select hb.nama bagian,
				hb.produksi_group,
				hb.produksi_group_detail,
				min(aa.satuan) satuan,
				sum(aa.jumlah) jumlah,
				sum(case when upper(trim(aa.seri))='I' then aa.jumlah else 0 end) seri_i,
				sum(case when upper(trim(aa.seri))='II' then aa.jumlah else 0 end) seri_ii,
				sum(case when upper(trim(aa.seri))='III' then aa.jumlah else 0 end) seri_iii,
				sum(case when upper(trim(aa.seri))='MMEA' then aa.jumlah else 0 end) seri_mmea
			from erp_prod_update_stok aa
			join erp_bagian hb on hb.id=aa.id_bagian
			where hb.produksi_group='1'
			and trunc(aa.tanggal)=to_date('$tanggal','YYYY-MM-DD')
			group by hb.id, hb.nama, hb.produksi_group, hb.produksi_group_detail
			order by hb.produksi_group,hb.produksi_group_detail,hb.nama")->result_array();
	}


	function lap_pelekatan($tanggal) {
		return $this->db->query("Select hb.nama bagian,
				hb.produksi_group,
				hb.produksi_group_detail,
				min(aa.satuan) satuan,
				sum(aa.jumlah) jumlah,
				sum(case when upper(trim(aa.seri))='I' then aa.jumlah else 0 end) seri_i,
				sum(case when upper(trim(aa.seri))='II' then aa.jumlah else 0 end) seri_ii,
				sum(case when upper(trim(aa.seri))='III' then aa.jumlah else 0 end) seri_iii,
				sum(case when upper(trim(aa.seri))='MMEA' then aa.jumlah else 0 end) seri_mmea
			from erp_prod_update_stok aa
			join erp_bagian hb on hb.id=aa.id_bagian
			where hb.produksi_group='2'
			and trunc(aa.tanggal)=to_date('$tanggal','YYYY-MM-DD')
			group by hb.id, hb.nama, hb.produksi_group, hb.produksi_group_detail
			order by hb.produksi_group,hb.produksi_group_detail,hb.nama")->result_array();
	}

}
