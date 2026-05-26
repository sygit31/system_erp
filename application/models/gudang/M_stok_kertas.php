<?php class M_stok_kertas extends CI_Model {

	function filter($desain, $tgl1, $tgl2) {
		return $this->db->query("select tbl.tgl,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where se2.desain='$desain' and se2.lebar='73') masuk_awal,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where se2.desain='$desain' and se2.lebar='73') keluar_awal,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sa2.tgl_npk, 'YYMMDD')<'$tgl1' and se2.desain='$desain' and se2.lebar='73') masuk_awal_A,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sa2.tgl_npk, 'YYMMDD')<'$tgl1' and se2.desain='$desain' and se2.lebar='52,5') masuk_awal_B,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sa2.tgl_npk, 'YYMMDD')<'$tgl1' and se2.desain='$desain' and se2.lebar='34,5' and sa2.status='0') masuk_awal_C,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sb2.tgl_bon, 'YYMMDD')<'$tgl1' and se2.desain='$desain' and se2.lebar='73') keluar_awal_A,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sb2.tgl_bon, 'YYMMDD')<'$tgl1' and se2.desain='$desain' and se2.lebar='52,5') keluar_awal_B,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sb2.tgl_bon, 'YYMMDD')<'$tgl1' and se2.desain='$desain' and se2.lebar='34,5') keluar_awal_C,
			(select nvl(sum(sf2.rusak_kg),0) from tbl_gdg_rsk_kredit sf2 join tbl_terima sa2 on sa2.no_roll=sf2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sf2.tgl_bon, 'YYMMDD')<'$tgl1'and se2.desain='$desain' and se2.lebar='73') reject_awal_A,
			(select nvl(sum(sf2.rusak_kg),0) from tbl_gdg_rsk_kredit sf2 join tbl_terima sa2 on sa2.no_roll=sf2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sf2.tgl_bon, 'YYMMDD')<'$tgl1'and se2.desain='$desain' and se2.lebar='52,5') reject_awal_B,
			(select nvl(sum(sf2.rusak_kg),0) from tbl_gdg_rsk_kredit sf2 join tbl_terima sa2 on sa2.no_roll=sf2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where to_char(sf2.tgl_bon, 'YYMMDD')<'$tgl1'and se2.desain='$desain' and se2.lebar='34,5') reject_awal_C,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sb2.tgl_bon=tbl.tgl and se2.desain='$desain' and se2.lebar='73') keluar_A,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sb2.tgl_bon=tbl.tgl and se2.desain='$desain' and se2.lebar='52,5') keluar_B,
			(select nvl(sum(sb2.pakai_kg),0) from tbl_keluar sb2 join tbl_terima sa2 on sa2.no_roll=sb2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sb2.tgl_bon=tbl.tgl and se2.desain='$desain' and se2.lebar='34,5') keluar_C,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sa2.tgl_npk=tbl.tgl and se2.desain='$desain' and se2.lebar='73') masuk_A,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sa2.tgl_npk=tbl.tgl and se2.desain='$desain' and se2.lebar='52,5') masuk_B,
			(select nvl(sum(sa2.netto_kg),0) from tbl_terima sa2 join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sa2.tgl_npk=tbl.tgl and se2.desain='$desain' and se2.lebar='34,5' and sa2.status='0') masuk_C,
			(select nvl(sum(sf2.rusak_kg),0) from tbl_gdg_rsk_kredit sf2 join tbl_terima sa2 on sa2.no_roll=sf2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sf2.tgl_bon=tbl.tgl and se2.desain='$desain' and se2.lebar='73') reject_A,
			(select nvl(sum(sf2.rusak_kg),0) from tbl_gdg_rsk_kredit sf2 join tbl_terima sa2 on sa2.no_roll=sf2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sf2.tgl_bon=tbl.tgl and se2.desain='$desain' and se2.lebar='52,5') reject_B,
			(select nvl(sum(sf2.rusak_kg),0) from tbl_gdg_rsk_kredit sf2 join tbl_terima sa2 on sa2.no_roll=sf2.no_roll join tbl_master_bahan se2 on se2.kode_bahan=sa2.kode_bahan where sf2.tgl_bon=tbl.tgl and se2.desain='$desain' and se2.lebar='34,5') reject_C
			from (select (start_date + (level - 1)) as tgl from (select case when to_number(to_char(to_date('$tgl2', 'dd-mm-yyyy'), 'dd')) <= 15 
			then trunc(to_date('$tgl2', 'dd-mm-yyyy'), 'mm') else trunc(to_date('$tgl2', 'dd-mm-yyyy'), 'mm') + 15 end as start_date,
			case when to_number(to_char(to_date('$tgl2', 'dd-mm-yyyy'), 'dd')) <= 15 then trunc(to_date('$tgl2', 'dd-mm-yyyy'), 'mm') + 14 
			else last_day(to_date('$tgl2', 'dd-mm-yyyy')) end as end_date from dual) connect by level <= (end_date - start_date + 1)) tbl")->result_array();
	} // End Query

}