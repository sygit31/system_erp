<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_budget_app extends CI_Model {

    function show_budget() {
        $kary = explode('|',$_SESSION['logERP']);
        $id_kary = $kary[0];

        $query = $this->db->query("Select cg.id, cg.nmr, ha.nama karyawan, cg.periode, hb.nama bagian, cg.tgl_input,
            (select approval_status from erp_ppic_budget_app where id_budget=cg.id and id_kary='$id_kary' and rownum=1) approval_status,
            (select sum(harga*budget_beli) from erp_ppic_budget_detail where id_budget=cg.id) total
            from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
            order by cg.tgl_input desc");
        return $query;  
    }

    function filter_budget($periode) {
        $kary = explode('|',$_SESSION['logERP']);
        $id_kary = $kary[0];

        $query = $this->db->query("Select cg.id, cg.nmr, ha.nama karyawan, cg.periode, hb.nama bagian, cg.tgl_input,
            (select approval_status from erp_ppic_budget_app where id_budget=cg.id and id_kary='$id_kary' and rownum=1) approval_status,
            (select sum(harga*budget_beli) from erp_ppic_budget_detail where id_budget=cg.id) total
            from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
            where (case when '$periode'='All' then 'All' else cg.periode end)='$periode'
            order by cg.tgl_input desc");
        return $query;      
    }

    function urut_budget_app() {
        $query = $this->db->query("Select max(id) id from erp_ppic_budget_app");
        $urut = $query->row_array();
        return $urut['ID'] + 1;      
    }

    function status($id_budget_app,$id_budget,$app_status) {
        $kary = explode('|',$_SESSION['logERP']);
        $id_kary = $kary[0];

        $query = $this->db->query("Select id from erp_ppic_budget_app where id_budget='$id_budget' and id_kary='$id_kary'");
        $data = $query->num_rows();

        if ($data == 0) {
            $this->db->query("Insert into erp_ppic_budget_app values('$id_budget_app','$id_budget','$id_kary','$app_status',sysdate)");
        }else{
            $data = $query->row_array();
            $id_budget_app = $data['ID'];

            $this->db->query("Update erp_ppic_budget_app set approval_status='$app_status' where id='$id_budget_app'");
        }
        
    }

}

?>