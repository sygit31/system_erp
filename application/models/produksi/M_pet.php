<?php class M_pet extends CI_Model {

	function pengawas() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where ha.tgl_keluar is null and ha.status='1' and af.trans='Pengawas Produksi' and af.kd_unit='12' order by ha.nama");
	}

	function operator() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha where ha.tgl_keluar is null and ha.status='1' and ha.id_jabatan=12 and ha.kd_unit='12' order by ha.nama");
	}

	function kode_flow() {
		return $this->db->query("Select distinct kode, deskripsi from erp_station_flow where active_flow_holo='Y' order by kode desc");
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)=4 order by desain desc");
	}

	function kk() {
		return $this->db->query("Select nomer kk from erp_kk where nomer not like '%PROOF%' order by id desc");
	}

	function proses() {
		return $this->db->query("Select distinct rf.nama proses, re.urut,
			(select urut from erp_station_flow where urut=re.urut+1 and kode=re.kode and rownum='1') next_proses
			from erp_station rf join erp_station_flow re on re.id_station=rf.id where re.kode='004' and re.active_flow_holo='Y' order by re.urut");
	}

	function proses_pita() {
		return $this->db->query("Select distinct rf.nama proses, re.urut,
			(select urut from erp_station_flow where urut=re.urut+1 and kode=re.kode and rownum='1') next_proses
			from erp_station rf join erp_station_flow re on re.id_station=rf.id where re.kode='004' and re.active_flow_holo='Y' and rf.nama = 'Pita' order by re.urut");
	}

	function get_seri() {
		return $this->db->query("Select distinct(seri) seri from erp_kk where length(seri)>3 order by seri");
	}

	function mesin() {
		return $this->db->query("Select distinct rf.nama proses, ta.nama_mesin
			from erp_station rf join erp_rnd_proses rb on rb.id_station=rf.id join erp_tek_mesin ta on ta.id=rb.id_mesin order by ta.nama_mesin");
	}

	function isi_proses($kode_flow) {
		$query = $this->db->query("Select rf.nama proses,
			(select urut from erp_station_flow where urut=re.urut+1 and kode=re.kode and rownum='1') next_proses
			from erp_station rf join erp_station_flow re on re.id_station=rf.id where re.kode='$kode_flow' and active_flow_holo='Y' order by re.urut");
		return $query->result_array();
	}

	function filter($tgl1, $tgl2, $proses, $kode_roll, $kk, $desain, $seri, $kode_flow) {
		return $this->db->query("Select dc.id, to_char(db.tanggal,'DD-Mon-YYYY') tgl, db.proses, db.nama_mesin, db.shift, to_char(dc.mulai,'YYYY-MM-DD hh24:mi:ss') mulai, to_char(dc.selesai,'DD-MM-YYYY hh24:mi') selesai, dc.kode, dc.panjang, dc.hasil, (dc.reject+dc.reject_konversi) reject, dc.sisa, dc.qty_roll, db.keterangan, db.kode_flow, db.tanggal, dc.teller, (concat(ca.seri,concat(' - ',ca.keterangan_penggunaan))) kk, nvl(dc.bahan, 0) bahan,
			(Select count(id) from erp_prod_pet_detail where kode=dc.kode and id>dc.id and aktif='1') next_proses,
			(select deskripsi from erp_station_flow where kode=db.kode_flow and rownum='1') deskripsi,
			(Select xmlagg(xmlelement(e,ha2.nama||', ')).extract('//text()') from erp_karyawan ha2 join erp_prod_kary ds2 on ds2.id_operator=ha2.id where ds2.status='1' and ds2.id_pet_detail=dc.id) operator,
			(Select nama from erp_karyawan where id=db.id_pengawas) pengawas
			from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join erp_gudang_order ca on ca.id=db.id_gudang_order
			where dc.aktif='1' and to_char(db.tanggal,'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$proses'='All' then 'All' else db.proses end)='$proses' and (case when '$kode_roll'='' then '' else to_char(dc.kode) end) like '%$kode_roll%' and
			(case when '$kk'='All' then 'All' else ca.keterangan_penggunaan end)='$kk' and ca.desain='$desain' and
			(case when '$seri'='All..' then 'All..' else ca.seri end)='$seri' and db.kode_flow='$kode_flow'
			order by ca.desain desc, dc.mulai desc");
	}

	function proses_awal($kode_flow) {
		$query = $this->db->query("Select rf.nama proses from erp_station rf join erp_station_flow re on re.id_station=rf.id where re.kode='$kode_flow' and re.urut='1'");
		$data = $query->row_array();
		return $data['PROSES'];
	}

	function get_roll($proses, $proses_awal, $kode_flow, $desain) {
		if ($proses == $proses_awal) {
			$query = $this->db->query("Select distinct gb.id_detail_terima, ca.id id_gudang_order, substr(ca.keterangan_penggunaan,0,3) kk, ca.seri, ca.desain, gb.kode_roll,
				(gb.qty_terima-(Select nvl(sum(dc2.hasil),0)+nvl(sum(dc2.reject),0) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_prod_proses da2 on da2.id=db2.id_prod_proses where dc2.aktif='1' and da2.proses='$proses' and gb.kode_roll=dc2.kode)) panjang
				from erp_penerimaan_detail gb join erp_penerimaan ga on ga.id_terima=gb.id_terima join erp_pengeluaran_detail gd on gd.id_detail_terima=gb.id_detail_terima join erp_pengeluaran gc on gc.id_keluar=gd.id_keluar join erp_gudang_order ca on ca.id=gc.id_gudang_order join erp_gdg_pet_emboss gu on gu.id_detail_terima=gb.id_detail_terima
				where ca.desain='$desain' and gb.status_qc='OUT' and to_char(gc.tgl_keluar,'YYMMDD')>='200423'
				and (gb.qty_terima-(Select nvl(sum(dc2.hasil),0)+nvl(sum(dc2.reject),0) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_prod_proses da2 on da2.id=db2.id_prod_proses where dc2.aktif='1' and da2.proses='$proses' and gb.kode_roll=dc2.kode))>0 and ca.desain>'2021'
				order by gb.id_detail_terima");
		}elseif ($proses == 'Pita' ) {
			$query = $this->db->query("Select distinct substr(ca.keterangan_penggunaan,0,3) kk, ca.seri, ca.id id_gudang_order, ca.desain, df.kode kode_roll,
				(Select id from erp_prod_mutasi where kode=df.kode and station_akhir='$proses' and rownum='1') id_detail_terima,
				(df.qty) panjang
				from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order
				where ca.desain='$desain' and df.station_akhir='$proses' and df.aktif='2' and (df.qty - df.qty_produksi)>0 and ca.desain>'2021' and
				(select db.kode_flow from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join
				erp_prod_mutasi_detail de on de.id_prod_pet_detail=dc.id where de.id_prod_mutasi=df.id and rownum='1')='$kode_flow'
				order by df.kode");
		}else{
			$query = $this->db->query("Select distinct substr(ca.keterangan_penggunaan,0,3) kk, ca.seri, ca.id id_gudang_order, ca.desain, df.kode kode_roll,
				(Select id from erp_prod_mutasi where kode=df.kode and station_akhir='$proses' and rownum='1') id_detail_terima,
				((Select sum(df2.qty) from erp_prod_mutasi df2 where df2.aktif='2' and df2.kode=df.kode and df2.station_akhir='$proses')-(Select nvl(sum(dc2.hasil),0)+nvl(sum(dc2.reject),0) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_prod_proses da2 on da2.id=db2.id_prod_proses where dc2.aktif='1' and dc2.kode=df.kode and da2.proses='$proses')) panjang
				from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order
				where ca.desain='$desain' and df.station_akhir='$proses' and df.aktif='2' and
				((Select sum(df2.qty) from erp_prod_mutasi df2 where df2.aktif='2' and df2.kode=df.kode and df2.station_akhir='$proses')-(Select nvl(sum(dc2.hasil),0)+nvl(sum(dc2.reject),0) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_prod_proses da2 on da2.id=db2.id_prod_proses where dc2.aktif='1' and dc2.kode=df.kode and da2.proses='$proses'))>0 and ca.desain>'2021' and
				(select db.kode_flow from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join
				erp_prod_mutasi_detail de on de.id_prod_pet_detail=dc.id where de.id_prod_mutasi=df.id and rownum='1')='$kode_flow'
				group by df.tgl, ca.keterangan_penggunaan, ca.desain, ca.seri, df.kode, ca.id
				order by df.kode");
		}
		return $query->result_array();
	}

	function ambil_roll_awal($id_prod_mutasi) {
		$query = $this->db->query("Select gb.kode_roll, gb.qty_terima
			from erp_penerimaan_detail gb join erp_prod_pet_detail_terima dd on dd.id_detail_terima=gb.id_detail_terima join erp_prod_mutasi_detail de on de.id_prod_pet_detail=dd.id_prod_pet_detail where de.id_prod_mutasi='$id_prod_mutasi'");
		return $query->result_array();
	}

	function id_prod_proses($proses, $nama_mesin, $shift) {
		$query = $this->db->query("Select id from erp_prod_proses where proses='$proses' and nama_mesin='$nama_mesin' and shift='$shift' order by desain desc, id");
		return $query->row_array()['ID'];
	}

	function dt_terima($id_prod_mutasi) {
		$query = $this->db->query("Select dd.id_detail_terima from erp_prod_pet_detail_terima dd join erp_prod_mutasi_detail de on de.id_prod_pet_detail=dd.id_prod_pet_detail where id_prod_mutasi='$id_prod_mutasi'");
		return $query->result_array();
	}

	function dt_pet_detail($id_prod_mutasi) {
		$query = $this->db->query("Select dc.kode, dc.hasil, dc.qty_roll from erp_prod_pet_detail dc join erp_prod_mutasi_detail de on de.id_prod_pet_detail=dc.id where id_prod_mutasi='$id_prod_mutasi'");
		return $query->result_array();
	}

	function id_gudang_order($id_detail_terima) {
		$query = $this->db->query("Select ca.id from erp_gudang_order ca join erp_pengeluaran gc on gc.id_gudang_order=ca.id join erp_pengeluaran_detail gd on gd.id_keluar=gc.id_keluar where gd.id_detail_terima='$id_detail_terima'");
		$data = $query->row_array();
		return $data['ID'];
	}

	function seri($id_gudang_order) {
		$query = $this->db->query("Select seri from erp_gudang_order where id='$id_gudang_order'");
		$data = $query->row_array();
		return $data['SERI'];
	}

	function urut_id_prod_pet() {
		$query = $this->db->query("Select max(id) urut from erp_prod_pet");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_header($id_prod_pet, $id_gudang_order, $tanggal, $keterangan, $kode_flow, $desain, $proses, $nama_mesin, $shift, $id_prod_proses, $pengawas) {
		$this->db->query("Insert into erp_prod_pet(id, id_gudang_order, tanggal, keterangan, kode_flow, desain, proses, nama_mesin, shift, id_prod_proses, id_pengawas) values('$id_prod_pet','$id_gudang_order','$tanggal','$keterangan','$kode_flow','$desain','$proses','$nama_mesin','$shift', '$id_prod_proses', '$pengawas')");
	}

	function urut_id_prod_pet_detail() {
		$query = $this->db->query("Select max(id) urut from erp_prod_pet_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail($id_prod_pet_detail, $id_prod_pet, $mulai, $selesai, $panjang, $hasil, $reject, $sisa, $kode, $teller, $qty_roll, $reject_konversi, $bahan) {
		$this->db->query("Insert into erp_prod_pet_detail(id, id_prod_pet, kode, mulai, selesai, panjang, hasil, reject, sisa, aktif, teller, qty_roll, reject_konversi, bahan) values('$id_prod_pet_detail','$id_prod_pet','$kode',to_date('$mulai','DD-MM-YYYY HH24:MI:SS'),to_date('$selesai','DD-MM-YYYY HH24:MI:SS'),'$panjang','$hasil','$reject','$sisa','1','$teller','$qty_roll','$reject_konversi','$bahan')");
	}

	function urut_prod_kary() {
		$query = $this->db->query("Select max(id) urut from erp_prod_kary");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_prod_kary($id_prod_kary, $id_pet_detail, $id_operator) {
		$this->db->query("Insert into erp_prod_kary(id, id_pet_detail, id_operator, status) values('$id_prod_kary','$id_pet_detail','$id_operator', '1')");
	}

	function id_prod_pet_detail_terima() {
		$query = $this->db->query("Select max(id) urut from erp_prod_pet_detail_terima");
		$data = $query->row_array();
		$urut = $data['URUT'] + 1;
		return $urut;
	}

	function simpan_detail_terima($id_prod_pet_detail_terima, $id_prod_pet_detail, $id_detail_terima) {
		$this->db->query("Insert into erp_prod_pet_detail_terima(id, id_prod_pet_detail, id_detail_terima) values('$id_prod_pet_detail_terima','$id_prod_pet_detail','$id_detail_terima')");
	}

	function cek_kode($kode,$station_awal) {
		$query = $this->db->query("Select kode from erp_prod_mutasi where kode like '%$kode%' and station_awal='$station_awal' order by id desc");
		return $query->row_array()['KODE'];
	}

	function urut_mutasi() {
		$query = $this->db->query("Select max(id) urut from erp_prod_mutasi");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_mutasi($id_prod_mutasi, $station_awal, $station_akhir, $kode, $panjang, $qty_roll, $id_gudang_order, $kode_flow, $gabung) {
		if ($station_awal == 'Belah' || $station_awal == 'Pita') {
			$cek_kode = $this->cek_kode($kode, $station_awal);

			if ($cek_kode != null) {
				if (substr($cek_kode, -2, 1) == '-') {
					$kode = $kode . '-' . (substr($cek_kode, -1) + 1);
				}elseif (substr($cek_kode, -2) >= 20) {
					$kode = $kode . '-1';
				}elseif (substr($cek_kode, -3, 1) == '-') {
					$kode = $kode . '-' . (substr($cek_kode, -2) + 1);					
				}
			}
		}

		$status = $kode_flow == '004' ? '1' : '1';
		$this->db->query("Insert into erp_prod_mutasi(id, station_awal, station_akhir, kode, qty, qty_produksi, aktif, qty_roll, id_gudang_order) values('$id_prod_mutasi','$station_awal','$station_akhir','$kode','$panjang', '0', '$status','$qty_roll','$id_gudang_order')");
	}

	function dt_proses($id_hapus) {
		$query = $this->db->query("Select db.proses, dc.kode, ca.seri from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order
			where dc.id='$id_hapus'");
		return $query->row_array();
	}

	function dt_produksi($proses, $kode) {
		$query = $this->db->query("Select df.kode, df.qty qty_awal,
			(select nvl(sum(dc.hasil+dc.reject), 0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet
			where db.proses=df.station_akhir and dc.kode=df.kode) qty_total,
			(select xmlagg(xmlelement(e, dc2.hasil || '@' || dc2.reject || '@' || dc2.qty_roll || '@' || dc2.reject_konversi || '@@')).extract('//text()') from
			erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet where db2.proses=df.station_akhir and dc2.kode=df.kode) qty_total_pita
			from erp_prod_mutasi df
			where df.station_akhir='$proses' and df.kode='$kode'");
		return $query->row_array();
	}

	function dt_produksi2($proses, $kode) {
		$query = $this->db->query("Select nvl(sum(dc.hasil+dc.reject), 0) qty_total,
			(select xmlagg(xmlelement(e, dc2.hasil || '@' || dc2.reject || '@' || dc2.qty_roll || '@' || dc2.reject_konversi || '@@')).extract('//text()') from
			erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet where db2.proses=db.proses and dc2.kode=dc.kode) qty_total_pita
			from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet
			where db.proses='$proses' and dc.kode='$kode'
			group by db.proses, dc.kode");
		return $query->row_array();
	}

	function update_mutasi($proses, $kode, $qty_produksi) {
		$query = $this->db->query("Select id, qty from erp_prod_mutasi where station_akhir='$proses' and kode='$kode' order by id");

		foreach ($query->result_array() as $dt) {
			if ($qty_produksi >= 0) {
				$id_mutasi = $dt['ID'];
				$qty = $dt['QTY'];

				if ($qty_produksi > $qty) {
					$qty_input = $qty;
					$qty_produksi = $qty_produksi - $qty;
				}else{
					$qty_input = $qty_produksi;
				}

				$qty_input = str_replace('.', ',', $qty_input);
				$this->db->query("Update erp_prod_mutasi set qty_produksi='$qty_input' where id='$id_mutasi'");
			}
		}
	}	

	function cetak($id_cetak, $proses) {
		$query = $this->db->query("Select distinct ca.desain, db.proses, db.nama_mesin, dc.mulai, pc.nama, pc.spesifikasi, pc.ukuran, ca.id id_gudang_order, ck.id_kk, ca.seri, ca.keterangan_penggunaan, to_char(mulai, 'YY') thn, db.tanggal, to_char(db.tanggal, 'DAY') hari, db.shift, dc.kode, dc.panjang, dc.hasil, dc.reject, dc.sisa, to_char(dc.mulai,'hh24:mi') mulai, to_char(dc.selesai,'hh24:mi') selesai, nvl(db.keterangan, ' ') keterangan, nvl(dc.bahan, 0) bahan, dc.qty_roll,
			(select count(distinct id_gudang_order) from erp_prod_pet where tanggal=db.tanggal and nama_mesin=db.nama_mesin) qty_kk,
			(select sum(qty) from erp_prod_mutasi where kode=dc.kode and station_awal=db.proses) mutasi,
			(select nama from erp_karyawan where id=db.id_pengawas) pengawas
			from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_barang pc on pc.id=ca.id_barang join erp_kk_detail ck on ck.id=ca.id_relasi
			where db.proses='$proses' and db.tanggal=(Select db2.tanggal from erp_prod_pet db2 join erp_prod_pet_detail dc2 on dc2.id_prod_pet=db2.id where dc2.id='$id_cetak') and db.nama_mesin=(Select db2.nama_mesin from erp_prod_pet db2 join erp_prod_pet_detail dc2 on dc2.id_prod_pet=db2.id where dc2.id='$id_cetak') and db.id_gudang_order=(Select db2.id_gudang_order from erp_prod_pet db2 join erp_prod_pet_detail dc2 on dc2.id_prod_pet=db2.id where dc2.id='$id_cetak') and
			(case when '$proses'='Pita' or '$proses'='Belah' then (Select db2.shift from erp_prod_pet db2 join erp_prod_pet_detail dc2 on dc2.id_prod_pet=db2.id where dc2.id='$id_cetak') else db.shift end)=db.shift	
			order by dc.mulai");
		$desain = $query->row_array()['DESAIN'];
		$proses = $query->row_array()['PROSES'];
		$tgl = $query->row_array()['TANGGAL'];
		$nama_mesin = $query->row_array()['NAMA_MESIN'];
		$id_kk = $query->row_array()['ID_KK'];
		$no_kk = $query->row_array()['KETERANGAN_PENGGUNAAN'];
		$shift = $query->row_array()['SHIFT'];

		$query_operator = $this->db->query("Select xmlagg(xmlelement(e,nama||', ')).extract('//text()') operator from
			(select distinct (nvl(ha.nick_name, ha.nama) || '@' || db.shift) nama, db.shift from erp_karyawan ha join erp_prod_kary ds on ds.id_operator=ha.id join erp_prod_pet_detail dc on dc.id=ds.id_pet_detail join
			erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_kk_detail ck on ck.id=ca.id_relasi where ds.status='1' and db.tanggal='$tgl' and db.nama_mesin='$nama_mesin' and
			ck.id_kk='$id_kk' order by db.shift) tbl");

		$query_log_emboss = $this->db->query("Select distinct db.tanggal, db.nama_mesin
			from erp_prod_pet db join erp_gudang_order ca on ca.id=db.id_gudang_order
			where db.proses='$proses' and ca.desain='$desain'
			order by db.tanggal, db.nama_mesin");

		$query_log_belah = $this->db->query("Select distinct db.tanggal, db.nama_mesin, db.shift
			from erp_prod_pet db join erp_gudang_order ca on ca.id=db.id_gudang_order
			where db.proses='$proses' and ca.desain='$desain'
			order by db.tanggal, db.nama_mesin");

		$query_bahan = $this->db->query("Select pc.nama, sum(gr.qty) qty, gr.satuan
			from erp_barang pc join erp_ipb_bp_realisasi gr on gr.id_barang=pc.id join erp_tek_mesin ta on ta.id=gr.id_mesin
			where gr.tgl='$tgl' and ta.nama_mesin='$nama_mesin' and gr.id_kk='$id_kk'
			group by pc.nama, gr.satuan
			order by pc.nama");

		$query_pch = $this->db->query("Select pc.nama, count(vc.id) qty, pc.satuan
			from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_galv_waktu va on va.id=vb.id_waktu
			join erp_barang pc on pc.id=va.id_produk
			where vc.tgl='$tgl' and vc.no_kk='$no_kk' and vc.aktif='2'
			group by pc.nama, pc.satuan");

		$query_downtime = $this->db->query("Select distinct to_char(dk.mulai,'hh24:mi') mulai, to_char(dk.selesai,'hh24:mi') selesai, dl.keterangan downtime, dk.keterangan, dk.mulai mulai_sort
			from erp_prod_downtime dk join erp_prod_mst_downtime dl on dl.id=dk.id_mst_downtime
			where dk.tgl='$tgl' and dk.proses='$proses' and dk.nama_mesin='$nama_mesin' and dk.id_kk='$id_kk' and
			(case when '$proses'='Pita' or '$proses'='Belah' then '$shift' else dk.shift end)=dk.shift
			order by dk.mulai");

		$query_kk = $this->db->query("Select distinct db.id_gudang_order, dc.mulai
			from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id
			where db.tanggal='$tgl' and db.nama_mesin='$nama_mesin' order by dc.mulai");

		return array($query->result_array(), $query_bahan->result_array(), $query_pch->result_array(), $query_downtime->result_array(), $query_kk->result_array(), $query_log_emboss->result_array(), $query_log_belah->result_array(), $query_operator->row_array(), $tgl, $nama_mesin, $id_kk, $proses, $shift);
	}

	function e_operator($desain, $nama_mesin, $shift) {
		$query = $this->db->query("Select da.id,
			(select xmlagg(xmlelement(e,ha.nama||', ')).extract('//text()') from erp_karyawan ha join erp_prod_proses_detail dg on dg.id_operator=ha.id where dg.id_prod_proses=da.id) opr
			from erp_prod_proses da
			where da.desain='$desain' and da.nama_mesin='$nama_mesin' and da.shift='$shift'");
		return $query->row_array();
	}	

	function e_mesin($proses) {
		$query = $this->db->query("Select distinct rf.nama proses, ta.nama_mesin
			from erp_station rf join erp_rnd_proses rb on rb.id_station=rf.id join erp_tek_mesin ta on ta.id=rb.id_mesin
			where rf.nama='$proses'
			order by ta.nama_mesin");
		return $query->result_array();
	}

	function edit($id_edit) {
		$query = $this->db->query("Select ca.desain, db.tanggal, db.proses, db.shift, to_char(dc.mulai,'hh24:mi') mulai, to_char(dc.selesai,'hh24:mi') selesai, dc.kode, dc.panjang, dc.hasil, dc.reject, dc.sisa, nvl(dc.bahan, 0) bahan, db.id_pengawas,
			(Select count(id) from erp_prod_pet_detail where kode=dc.kode and id>dc.id and aktif='1') qty_next,
			(Select xmlagg(xmlelement(e,id_operator||',')).extract('//text()') id from erp_prod_kary where status='1' and id_pet_detail=dc.id) id_operator
			from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join erp_gudang_order ca on ca.id=db.id_gudang_order
			where dc.id='$id_edit'");
		return $query->row_array();
	}

	function update_header($id_edit, $tgl, $mesin, $shift, $pengawas) {
		$this->db->query("Update erp_prod_pet set tanggal='$tgl', nama_mesin='$mesin', shift='$shift', id_pengawas='$pengawas' where id=(select id_prod_pet from erp_prod_pet_detail where id='$id_edit')");
	}

	function simpan_edit($id_edit, $mulai, $selesai, $hasil, $reject, $sisa, $bahan) {
		// Update ERP_PROD_MUTASI dan sesuaikan Roll Gabung
		$query = $this->db->query("Select dc.hasil, de.id_prod_mutasi from erp_prod_pet_detail dc join erp_prod_mutasi_detail de on de.id_prod_pet_detail=dc.id where dc.id='$id_edit'");
		$data = $query->row_array();
		$m_hasil = $hasil;
		$t_hasil = $data['HASIL'];
		$id_mutasi = $data['ID_PROD_MUTASI'];

		$query = $this->db->query("Select de.id,
			(select qty from erp_prod_mutasi where id=de.id_prod_mutasi) panjang_mutasi
			from erp_prod_mutasi_detail de where de.id_prod_mutasi='$id_mutasi'");
		$data = $query->row_array();
		if ($query->num_rows() > 1) {
			$m_hasil = $data['PANJANG_MUTASI'] - $t_hasil + $hasil;
		}

		$this->db->query("Update erp_prod_mutasi set qty='$m_hasil' where id='$id_mutasi'");
		$this->db->query("Update erp_prod_pet_detail set mulai=to_date('$mulai','DD-MM-YYYY HH24:MI:SS'), selesai=to_date('$selesai','DD-MM-YYYY HH24:MI:SS'), hasil='$hasil', reject='$reject', sisa='$sisa', bahan='$bahan' where id='$id_edit'");
	}	

	function dt_hapus($id_hapus) {
		$query = $this->db->query("Select * from erp_prod_mutasi where id='$id_hapus'");
		$data = $query->result_array();
		return array($data['KODE'], $data['QTY_PRODUKSI']);
	}	

	function hapus_operator($id_hapus) {
		$this->db->query("Delete from erp_prod_kary where status='1' and id_pet_detail='$id_hapus'");
	}

	function hapus($id_hapus) {
		$query = $this->db->query("Select count(id) qty
			from erp_prod_pet_detail where id_prod_pet=(Select id_prod_pet from erp_prod_pet_detail where id='$id_hapus')");
		$data = $query->row_array();
		$qty = $data['QTY'];

		if ($qty == 1) {
			$this->db->query("Delete from erp_prod_pet where id=(Select id_prod_pet from erp_prod_pet_detail where id='$id_hapus')");
		}
		$this->db->query("Delete from erp_prod_pet_detail where id='$id_hapus'");
		$this->db->query("Delete from erp_prod_pet_detail_terima where id_prod_pet_detail='$id_hapus'");

		$query = $this->db->query("Select id_prod_mutasi from erp_prod_mutasi_detail where id_prod_pet_detail='$id_hapus'");
		foreach ($query->result_array() as $dt) {
			$id_prod_mutasi = $dt['ID_PROD_MUTASI'];
			$this->hapus_mutasi($id_prod_mutasi);
		}
		$this->db->query("Delete from erp_prod_mutasi_detail where id_prod_pet_detail='$id_hapus'");
	}

	function hapus_mutasi($id_prod_mutasi) {
		$query = $this->db->query("Select * from erp_prod_mutasi_detail where id_prod_mutasi='$id_prod_mutasi'");
		if ($query->num_rows() == 1) {
			$this->db->query("Delete from erp_prod_mutasi where id='$id_prod_mutasi'");
		}
	}

	function kode_belah($kode) {
		$query = $this->db->query("Select max(substr(kode,20,1)) kode from erp_prod_mutasi where kode like '%$kode%'");
		$data = $query->row_array();
		return $data['KODE']+1;
	}

	function urut_mutasi_detail() {
		$query = $this->db->query("Select max(id) urut from erp_prod_mutasi_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_mutasi_detail($id_mutasi_detail, $id_prod_pet_detail, $id_prod_mutasi) {
		$this->db->query("Insert into erp_prod_mutasi_detail(id, id_prod_pet_detail, id_prod_mutasi) values('$id_mutasi_detail','$id_prod_pet_detail','$id_prod_mutasi')");
	}

	function get_operator($proses, $nama_mesin, $shift) {
		$query = $this->db->query("Select distinct ds.id_operator, ha.nama operator,
			(select max(tanggal) from erp_prod_pet where proses=db.proses and nama_mesin=db.nama_mesin and shift=db.shift) tgl_max
			from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join erp_prod_kary ds on ds.id_pet_detail=dc.id join erp_karyawan ha on ha.id=ds.id_operator
			where ds.status='1' and db.proses='$proses' and db.nama_mesin='$nama_mesin' and db.shift='$shift' and db.tanggal=(select max(tanggal) from erp_prod_pet where proses=db.proses and nama_mesin=db.nama_mesin and shift=db.shift)
			order by ha.nama");
		return $query->result_array();
	}

	function remove_duplicate() {
		$proses = 'Pita';
		$query = $this->db->query("Select df.* from erp_prod_mutasi df where df.station_awal='$proses' and (select count(id) from erp_prod_mutasi where station_awal=df.station_awal and kode=df.kode)>1
			order by df.kode desc");

		foreach ($query->result_array() as $dt) {
			$id = $dt['ID'];
			$t_kode = $dt['KODE'];
			$kode = $dt['KODE'];
			$dobel = 0;

			do {
				if (strlen($kode) == '18') {
					$kode = $t_kode . '-1';
				}elseif (substr($kode, -2, 1) == '-') {
					$kode = $t_kode . '-' . (substr($kode, -1) + 1);
				}elseif (substr($kode, -3, 1) == '-') {
					$kode = $t_kode . '-' . (substr($kode, -2) + 1);	
				}

				$query = $this->db->query("Select kode from erp_prod_mutasi where kode like '%$kode%' and station_awal='$proses' and id<>'$id'");
				$dobel = $query->num_rows();
				if ($dobel == 0) {
					$this->db->query("Update erp_prod_mutasi set kode='$kode' where id='$id'");
				}
			} while ($dobel != 0);
		}
	}

}