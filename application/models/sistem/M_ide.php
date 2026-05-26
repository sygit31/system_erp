<?php 

class M_ide extends CI_Model{

    function show_karyawan() {
        return $this->db->query("Select ha.id, ha.nama, hb.nama bagian from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan where ha.status='1' order by ha.nama");
    }

    function show_ide() {
        $kary = explode('|',$_SESSION['logERP']);
        $id_kary = $kary[0];
        
        return $this->db->query("Select sc.id id_ide, sc.tgl, sc.nmr, sc.ide, sc.status, ha.id id_kary, ha.nama, hb.nama bagian
            from erp_sis_ide sc join erp_karyawan ha on ha.id=sc.id_kary join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            order by sc.tgl desc");
    }

    function filter_ide($cari,$tahun,$status) {
        $kary = explode('|',$_SESSION['logERP']);
        $id_kary = $kary[0];

        return $this->db->query("Select sc.id id_ide, sc.tgl, sc.nmr, sc.ide, sc.status, ha.id id_kary, ha.nama, hb.nama bagian
            from erp_sis_ide sc join erp_karyawan ha on ha.id=sc.id_kary join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where (case when '$tahun'='All' then 'All' else to_char(sc.tgl,'YYYY') end) ='$tahun' and (case when '$status'='All' then 'All' else sc.status end) ='$status' and upper(sc.ide) like '%$cari%'
            order by sc.tgl desc");
    }

    function auto_no($tahun){
        $query = $this->db->query("Select max(substr(nmr,-4)) as nmr from erp_sis_ide where to_char(tgl,'yy')='$tahun'");
        $nmr = $query->row_array();
        $nmr = $tahun.'-'.sprintf("%'04d\n", $nmr['NMR'] + 1);     
        return $nmr;
    }

    function simpan_ide($nmr,$id_karyawan,$ide) {

        // Simpan Ide
        $query = $this->db->query("Select max(id) as id from erp_sis_ide");
        $urut = $query->row_array();
        $id_ide = $urut['ID'] + 1;    
        $this->db->query("Insert into erp_sis_ide values ('$id_ide','$nmr',sysdate,'$id_karyawan','$ide','DIAJUKAN')");
    }

}

?>