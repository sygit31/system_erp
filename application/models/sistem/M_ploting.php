<?php

class M_ploting extends CI_Model
{

	function kd_unit() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		
		$query = $this->db->query("Select ha.kd_unit from erp_karyawan ha where ha.id='$id_kary'");
		$data = $query->row_array();
		return $data['KD_UNIT'];
	}

	function unit() {
		return $this->db->query("Select * from erp_hr_unit order by id");
	}

	function show_periode() {
		return $this->db->query("Select periode from (Select to_char(tanggal,'Mon-YY') periode from erp_sis_nilai where tanggal is not null order by tanggal desc)");
	}

	function show_bagian() {
		return $this->db->query("Select distinct nama from erp_bagian order by nama");
	}

	function ambil_tgl($periode) {
		$thn = substr($periode, -2);
		$bln = substr($periode, 0, 3);
		$arr_bln = array("Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des");
		$bln = sprintf('%02d', array_search($bln, $arr_bln) + 1);
		$tgl = $thn . $bln;

		return $tgl;
	}

	function show_nilai($periode) {
        // $tgl = $this->ambil_tgl($periode);

        // $data = $this->db->query("Select distinct to_char(sf.tanggal,'MM-YY') periode, ha.id id_karyawan, ha.nama, ha.nik, hb.nama bagian, hc.nama jabatan, sd.kategori,
        //     (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where se2.id_karyawan=ha.id and sd2.kategori=sd.kategori and to_char(sf2.tanggal,'Mon-YY')='$periode' and rownum='1') nilai,
        //     (Select gb.\"TotalAmfrah\" from S_GAJI gb join S_PERIODE gp on gp.\"Oid\"=gb.\"OidPeriodeGaji\" where gb.nik=ha.nik and to_char(TO_DATE(substr(gp.\"Periode\",14,10), 'DD/MM/YYYY'),'Mon-YY')='$periode') gaji,
        //     (Select replace(avg(replace(nilai,'.',',')),',','.') from (select sa.id_koordinator, sa.nilai, sa.nmr,(select (case when count(finish)<>count(nmr) then null else max(finish) end) from erp_sis_project where nmr=sa.nmr) finish from erp_sis_project sa) where id_koordinator=ha.id and to_char(finish,'Mon-YY')='$periode') reward,
        //     (Select nilai from erp_sis_nilai_plus where id_kary=ha.id and kategori='Jabatan' and to_char(tgl,'YYMMDD')< to_char(sf.tanggal,'YYMMDD') and rownum='1') n_jabatan,
        //     (Select replace(sum(replace(nilai,'.',',')),',','.') from erp_sis_nilai_plus where id_kary=ha.id and to_char(tgl,'Mon-YY')='$periode') n_plus
        //     from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_sis_kategori se on se.id_karyawan=ha.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_sis_penilai sd on sd.id=se.id_sis_penilai
        //     where sf.status='1' and to_char(sf.tanggal,'Mon-YY')='$periode' and (case when ha.tgl_keluar is null then '$tgl' else to_char(ha.tgl_keluar,'YYMM') end)>='$tgl' order by ha.nama");
        // return $data->result_array();
	}

	function filter_nilai($periode, $bagian, $kd_unit, $status) {
		$tgl = $this->ambil_tgl($periode);

		$status1 = '';
		$status2 = '';
		if ($status == 'Karyawan') {
			$status1 = 'KT';
			$status2 = 'BL';
		}

		$data = $this->db->query("Select distinct to_char(sf.tanggal,'MM-YY') periode, ha.id id_karyawan, ha.nama, ha.nik, hb.nama bagian, hc.nama jabatan, sd.kategori, 
			(select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.status='1' and se2.id_karyawan=ha.id and sd2.kategori=sd.kategori and to_char(sf2.tanggal,'Mon-YY')='$periode' and rownum='1') nilai,
			(Select gb.\"TotalAmfrah\" from S_GAJI gb join S_PERIODE gp on gp.\"Oid\"=gb.\"OidPeriodeGaji\" where gb.nik=ha.nik and to_char(TO_DATE(substr(gp.\"Periode\",14,10), 'DD/MM/YYYY'),'Mon-YY')='$periode') gaji,
			(Select replace(avg(replace(nilai,'.',',')),',','.') from (select sa.id_koordinator, sa.nilai, sa.nmr,(select (case when count(finish)<>count(nmr) then null else max(finish) end) from erp_sis_project where nmr=sa.nmr) finish from erp_sis_project sa) where id_koordinator=ha.id and to_char(finish,'Mon-YY')='$periode') reward,
			(Select nilai from erp_sis_nilai_plus where id_kary=ha.id and kategori='Jabatan' and to_char(tgl,'YYMMDD')< to_char(sf.tanggal,'YYMMDD') and id=(select max(id) from erp_sis_nilai_plus where id_kary=ha.id and kategori='Jabatan' and to_char(tgl,'YYMMDD')< to_char(sf.tanggal,'YYMMDD'))) n_jabatan,
			(Select replace(sum(replace(nilai,'.',',')),',','.') from erp_sis_nilai_plus where id_kary=ha.id and to_char(tgl,'Mon-YY')='$periode') n_plus
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_sis_kategori se on se.id_karyawan=ha.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_sis_penilai sd on sd.id=se.id_sis_penilai
			where sf.status='1' and to_char(sf.tanggal,'Mon-YY')='$periode' and (case when '$bagian'='All' then 'All' else hb.nama end) ='$bagian' and (case when '$kd_unit'='All' then 'All' else ha.kd_unit end) ='$kd_unit' and ((case when '$status'='All' then 'All' else ha.kd_status end) ='$status' or ha.kd_status ='$status1' or ha.kd_status ='$status2') and (case when ha.tgl_keluar is null then '$tgl' else to_char(ha.tgl_keluar,'YYMM') end)>='$tgl' and hb.nama<>'PWK'
			order by ha.nama");
		return $data->result_array();
	}

	function get_kategori($id_penilai) {
		$data = $this->db->query("Select distinct sd.kategori from erp_sis_penilai sd join erp_sis_kategori se on sd.id=se.id_sis_penilai where sd.id_penilai='$id_penilai' and se.aktif='1'
			order by sd.kategori");
		return $data->result_array();
	}

	function show_penilai() {
		return $this->db->query("Select distinct ha.nama, ha.id id_karyawan from erp_sis_penilai sd join erp_karyawan ha on ha.id=sd.id_penilai where ha.status='1' and (Select count(id) from erp_sis_kategori where id_sis_penilai=sd.id and aktif='1') > 0 order by ha.nama");
	}

	function get_detail_nilai($id_penilai, $periode, $kategori) {
		$data = $this->db->query("Select distinct sd.kategori, ha.nama nama_karyawan, ha.nik, se.id,
			(select to_char(tanggal,'Mon-YY') from erp_sis_nilai where status='1' and id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') periode,
			(select nilai from erp_sis_nilai where status='1' and id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') nilai,
			(select sh2.n1 from erp_sis_nilai_detail sh2 join erp_sis_nilai sf2 on sf2.id=sh2.id_sis_nilai where sf2.status='1' and sf2.id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') n1,
			(select sh2.n2 from erp_sis_nilai_detail sh2 join erp_sis_nilai sf2 on sf2.id=sh2.id_sis_nilai where sf2.status='1' and sf2.id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') n2,
			(select sh2.n3 from erp_sis_nilai_detail sh2 join erp_sis_nilai sf2 on sf2.id=sh2.id_sis_nilai where sf2.status='1' and sf2.id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') n3,
			(select sh2.n4 from erp_sis_nilai_detail sh2 join erp_sis_nilai sf2 on sf2.id=sh2.id_sis_nilai where sf2.status='1' and sf2.id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') n4,
			(select sh2.n5 from erp_sis_nilai_detail sh2 join erp_sis_nilai sf2 on sf2.id=sh2.id_sis_nilai where sf2.status='1' and sf2.id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') n5
			from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha on ha.id=se.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where ha.status='1' and sd.id_penilai='$id_penilai' and sd.kategori='$kategori' and to_char(se.tgl_input,'YYMM') <= '$periode' and
			(select to_char(tanggal,'Mon-YY') from erp_sis_nilai where status='1' and id_sis_kategori=se.id and to_char(tanggal,'YYMM') ='$periode' and rownum='1') is not null
			order by ha.nama");
		return $data->result_array();
	}

	function get_nama($periode2, $bagian, $kd_unit, $status, $cari) {
		$status1 = '';
		$status2 = '';
		if ($status == 'Karyawan') {
			$status1 = 'KT';
			$status2 = 'BL';
		}

		$data = $this->db->query("Select distinct ha.id, ha.nik, initcap(ha.nama) nama, hb.nama bagian, hc.nama jabatan
			from erp_karyawan ha join erp_sis_kategori se on se.id_karyawan=ha.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where (case when ha.tgl_keluar is null then '$periode2' else to_char(ha.tgl_keluar,'YYMM') end)>='$periode2' and to_char(sf.tanggal,'YYMM')='$periode2' and (case when '$bagian'='All' then 'All' else hb.nama end) ='$bagian' and (case when '$kd_unit'='All' then 'All' else ha.kd_unit end) ='$kd_unit' and ((case when '$status'='All' then 'All' else ha.kd_status end) ='$status' or ha.kd_status ='$status1' or ha.kd_status ='$status2') and (case when '$cari'='' then '' else upper(ha.nama) end) like '%$cari%'");
		return $data->result_array();
	}

	function get_laporan($periode1, $periode2, $bagian, $kd_unit, $status, $cari) {
		$status1 = '';
		$status2 = '';
		if ($status == 'Karyawan') {
			$status1 = 'KT';
			$status2 = 'BL';
		}

		$data = $this->db->query("Select ha.id, to_char(sf.tanggal,'Mon-YY') periode, sd.kategori, sf.nilai,
			(Select nilai from erp_sis_nilai_plus where id_kary=ha.id and kategori='Jabatan' and to_char(tgl,'YYMM')< to_char(sf.tanggal,'YYMM') and id=(select max(id) from erp_sis_nilai_plus where id_kary=ha.id and kategori='Jabatan' and to_char(tgl,'YYMM')< to_char(sf.tanggal,'YYMM'))) n_jabatan,
			(Select replace(sum(replace(nilai,'.',',')),',','.') from erp_sis_nilai_plus where id_kary=ha.id and to_char(tgl,'YYMM')='$periode2' and kategori='Khusus') n_khusus
			from erp_karyawan ha join erp_sis_kategori se on se.id_karyawan=ha.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_sis_penilai sd on sd.id=se.id_sis_penilai join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where sf.status='1' and to_char(sf.tanggal,'YYMM') between '$periode1' and '$periode2' and (case when '$bagian'='All' then 'All' else hb.nama end) ='$bagian' and (case when '$kd_unit'='All' then 'All' else ha.kd_unit end)='$kd_unit' and ((case when '$status'='All' then 'All' else ha.kd_status end) ='$status' or ha.kd_status ='$status1' or ha.kd_status ='$status2') and (case when '$cari'='' then '' else upper(ha.nama) end) like '%$cari%'
			order by ha.nama, sf.tanggal");
		return $data->result_array();
	}

    // Plotting Penilai
	function urut() {
		$data = $this->db->query("Select max(id) id from erp_sis_nilai");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function auto_nilai($periode, $id) {
		$tgl = '01/' . substr($periode, 2, 2) . '/' . substr($periode, 0, 2);
		$query = $this->db->query("Select ha.id, ha.nama, se.id id_sis_kategori
			from erp_karyawan ha join erp_sis_kategori se on se.id_karyawan=ha.id join erp_sis_penilai sd on sd.id=se.id_sis_penilai join erp_karyawan ha2 on ha2.id=sd.id_penilai
			where se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and to_char(se.tgl_input,'YYMM')<='$periode' and ha2.status='1' and
			(Select count(id) from erp_sis_nilai where id_sis_kategori=se.id and to_char(tanggal,'YYMM')='$periode')='0'
			order by ha.nama");
		foreach ($query->result_array() as $dt) {
			$id_sis_kategori = $dt['ID_SIS_KATEGORI'];
			$this->db->query("Insert into erp_sis_nilai(id,id_sis_kategori,tanggal,nilai,status) values('$id','$id_sis_kategori','$tgl','2.5','2')");

			$this->db->query("Insert into erp_sis_nilai_detail(id_sis_nilai,n5) values('$id','2.5')");
			$id++;
		}
	}

	function lock_nilai() {
		$this->db->query("Update erp_sis_unlock_nilai set status='0'");
	}

	function isi_penilai($periode, $unit) {
		$periode = '20' . $periode;
		$kd_unit = $unit == 'HOLOGRAFI' ? '12' : '01';
		$query = $this->db->query("Select distinct id_penilai, nik, penilai nama, bagian, jabatan, kategori from
			(select ha.id, ha.nama, sd.kategori, ha2.nik, ha2.nama penilai, sd.id_penilai, hb.nama bagian, hc.nama jabatan,
			(select count(sf2.id) from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai
			where se2.id_karyawan=ha.id and sd2.kategori=sd.kategori and to_char(tanggal, 'YYYYMM')='$periode') qty
			from erp_karyawan ha join erp_sis_kategori se on se.id_karyawan=ha.id join erp_sis_penilai sd on sd.id=se.id_sis_penilai join
			erp_karyawan ha2 on ha2.id=sd.id_penilai join erp_bagian hb on hb.id=ha2.id_bagian join erp_jabatan hc on hc.id=ha2.id_jabatan
			where se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and to_char(ha.tgl_masuk, 'YYYYMM')<'$periode' and ha.kd_unit='$kd_unit') tbl
			where qty=0
			order by penilai, kategori");
		return $query->result_array();
	}

	function isi_penilai2($periode,$unit) {
		$query = $this->db->query("Select distinct ha.id id_penilai, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan, sd.kategori
			from erp_karyawan ha join erp_sis_penilai sd on sd.id_penilai=ha.id join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
			where (case when '$unit'='ALL' then 'ALL' else hd.unit end)='$unit' and se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and
			(Select count(se2.id) from erp_sis_kategori se2 join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai join erp_karyawan ha2 on ha2.id=se2.id_karyawan where ha2.status='1' and sd2.id_penilai=ha.id and sd2.kategori=sd.kategori and se2.aktif='1' and to_char(ha2.tgl_masuk,'YYMM')<'$periode' and ha2.tgl_keluar is null)>(Select count(sf2.id) from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai join erp_karyawan ha2 on ha2.id=se2.id_karyawan where ha2.status='1' and sd2.id_penilai=ha.id and to_char(sf2.tanggal,'YYMM')='$periode' and se2.aktif='1' and sd2.kategori=sd.kategori and to_char(se2.tgl_input,'YYMM')<'$periode')
			order by ha.nama");
		return $query->result_array();
	}

	function isi_penilai_1($periode,$unit) {
		$query = $this->db->query("Select distinct ha.id id_penilai, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan, sd.kategori
			from erp_karyawan ha join erp_sis_penilai sd on sd.id_penilai=ha.id join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
			where (case when '$unit'='ALL' then 'ALL' else hd.unit end)='$unit' and se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and
			(Select count(se2.id) from erp_sis_kategori se2 join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai join erp_karyawan ha2 on ha2.id=se2.id_karyawan
			where ha2.status='1' and sd2.id_penilai=ha.id and sd2.kategori=sd.kategori and se2.aktif='1' and to_char(se2.tgl_input,'YYMM')<='$periode' and ha2.tgl_keluar is null)>(Select count(sf2.id) from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai join erp_karyawan ha2 on ha2.id=se2.id_karyawan where ha2.status='1' and sd2.id_penilai=ha.id and to_char(sf2.tanggal,'YYMM')='$periode' and se2.aktif='1' and sd2.kategori=sd.kategori and to_char(se2.tgl_input,'YYMM')<='$periode')
			order by ha.nama");
		return $query->result_array();
	}

	function isi_auto($periode) {
		$query = $this->db->query("Select distinct ha.id id_penilai, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan, sd.kategori
			from erp_karyawan ha join erp_sis_penilai sd on sd.id_penilai=ha.id join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and sf.status='2' and to_char(sf.tanggal,'YYMM')='$periode'
			order by ha.nama");
		return $query->result_array();
	}

	function detail_auto($id_penilai, $kategori, $periode) {
		$query = $this->db->query("Select distinct ha2.nik, ha2.nama, hb.nama bagian, hc.nama jabatan
			from erp_karyawan ha join erp_sis_penilai sd on sd.id_penilai=ha.id join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_karyawan ha2 on ha2.id=se.id_karyawan join erp_bagian hb on hb.id=ha2.id_bagian join erp_jabatan hc on hc.id=ha2.id_jabatan
			where se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and sf.status='2' and to_char(sf.tanggal,'YYMM')='$periode' and ha.id='$id_penilai' and sd.kategori='$kategori'
			order by ha2.nama");
		return $query->result_array();
	}

	function urut_unlock() {
		$data = $this->db->query("Select max(id) id from erp_sis_unlock_nilai");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function unlock_penilai($id, $id_penilai) {
		$this->db->query("Insert into erp_sis_unlock_nilai(id, id_penilai, tgl_input, status) values('$id','$id_penilai',sysdate,'1')");
	}

	function detail_outstanding($id_penilai, $kategori, $periode) {
		$query = $this->db->query("Select distinct ha2.nik, ha2.nama, hb.nama bagian, hc.nama jabatan
			from erp_karyawan ha join erp_sis_penilai sd on sd.id_penilai=ha.id join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha2 on ha2.id=se.id_karyawan join erp_bagian hb on hb.id=ha2.id_bagian join erp_jabatan hc on hc.id=ha2.id_jabatan
			where ha2.status<>0 and ha2.tgl_keluar is null and ha.id='$id_penilai' and sd.kategori='$kategori' and se.aktif='1' and ha.status='1' and ha.tgl_keluar is null and to_char(ha2.tgl_masuk,'YYMM')<'$periode' and
			(select count(sf2.id) from erp_sis_nilai sf2 where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYMM')='$periode')='0'
			order by ha2.nama");
		return $query->result_array();
	}

	function detail_penilai($nik) {
		$query = $this->db->query("Select ha.nama, sd.kategori
			from erp_sis_penilai sd join erp_karyawan ha on ha.id=sd.id_penilai join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha2 on ha2.id=se.id_karyawan
			where se.aktif='1' and ha.status='1' and ha2.nik='$nik'");
		return $query->result_array();
	}
}
