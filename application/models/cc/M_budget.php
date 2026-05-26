<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_budget extends CI_Model {

    function db_perdana() {
        $perdana = $this->load->database('perdana', TRUE);
        return $perdana;
    }

    function id_kary() {
        $kary = explode('|', $_SESSION['logERP']);
        return $kary[0];
    }

    function akses($id_kary, $mn) {
        $query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_akun aa on aa.id=ab.id_akun join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail
            where aa.id_karyawan='$id_kary' and ad.kode_menu='$mn'");
        return $query->row_array()['STATUS'];
    }

    function unit() {
        return $this->db->query("Select * from erp_hr_unit where status<>'0' order by unit");
    }

    function kd_jurnal() {
        return $this->db->query("Select * from erp_cc_rekening where status<>'0' order by no_rekjurnal");
    }

    function filter($periode1, $periode2, $kd_unit, $id_rekening) {
        return $this->db->query("Select cc.id, to_char(cc.periode,'DD-MM-YYYY') periode, ca.no_rekjurnal, ca.nama, cc.budget, ha.nama karyawan, hd.unit, to_char(cc.periode,'YYMM') t_periode, 
            (Select sum(budget) from erp_cc_budget_add where id_budget=cc.id) adendum,
            (Select sum(pb.qty * pb.harga) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_barang pc on pc.id=cf.id_barang join erp_ppic_sip ce on ce.id=cf.id_sip where ce.kd_unit=cc.kd_unit and pc.no_rekjurnal=ca.no_rekjurnal and to_char(pa.tgl,'YYMM')=to_char(cc.periode,'YYMM')) realisasi
            from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal join erp_karyawan ha on ha.id=cc.id_input join erp_hr_unit hd on hd.kd_unit=cc.kd_unit
            where cc.status<>'0' and to_char(cc.periode,'YYMM') between '$periode1' and '$periode2' and (case when '$kd_unit'='All' then 'All' else to_char(cc.kd_unit) end)='$kd_unit' and (case when '$id_rekening'='All' then 'All' else to_char(cc.id_jurnal) end)='$id_rekening'
            order by cc.periode desc, cc.kd_unit, ca.no_rekjurnal");

        // return $this->db->query("Select cc.id, to_char(cc.periode,'DD-MM-YYYY') periode, ca.no_rekjurnal, ca.nama, cc.budget, ha.nama karyawan, hd.unit, to_char(cc.periode,'YYMM') t_periode, 
        //     (Select sum(budget) from erp_cc_budget_add where id_budget=cc.id) adendum,
        //     (Select sum(pb.qty * pb.harga) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po where pa.kd_unit=cc.kd_unit and pb.no_rekjurnal=ca.no_rekjurnal and to_char(pa.tgl,'YYMM')=to_char(cc.periode,'YYMM')) realisasi
        //     from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal join erp_karyawan ha on ha.id=cc.id_input join erp_hr_unit hd on hd.kd_unit=cc.kd_unit
        //     where cc.status<>'0' and to_char(cc.periode,'YYMM') between '$periode1' and '$periode2' and (case when '$kd_unit'='All' then 'All' else to_char(cc.kd_unit) end)='$kd_unit' and (case when '$id_rekening'='All' then 'All' else to_char(cc.id_jurnal) end)='$id_rekening'
        //     order by cc.periode desc, cc.kd_unit, ca.no_rekjurnal");
    }

    function urut() {
        $query = $this->db->query("Select max(id) id from erp_cc_budget");
        $urut = $query->row_array();
        return $urut['ID'] + 1;
    }

    function id_budget($periode_edit, $id_rekening, $kd_unit) {
        $query = $this->db->query("Select id from erp_cc_budget where to_char(periode,'YYMM')='$periode_edit' and id_jurnal='$id_rekening' and kd_unit='$kd_unit'");
        $data = $query->row_array();
        return $data['ID'];
    }

    function simpan_budget($id_budget, $periode, $kd_unit, $id_rekening, $no_rekjurnal, $budget, $id_input) {
        $this->db->query("Insert into erp_cc_budget(id, kd_unit, id_jurnal, no_rekjurnal, periode, budget, tgl_input, id_input, status) values('$id_budget','$kd_unit','$id_rekening','$no_rekjurnal','$periode','$budget',sysdate,'$id_input','1')");
    }

    function urut_add() {
        $query = $this->db->query("Select max(id) id from erp_cc_budget_add");
        $urut = $query->row_array();
        return $urut['ID'] + 1;
    }

    function simpan_add($id_add, $id_budget, $budget, $id_input, $ket) {
        $this->db->query("Insert into erp_cc_budget_add(id, id_budget, budget, tgl_input, id_input, status, keterangan) values('$id_add','$id_budget','$budget',sysdate,'$id_input','1', '$ket')");
    }

    function data_budget($id_budget) {
        $query = $this->db->query("Select cc.periode, to_char(cc.periode,'YYMM') periode_edit, ca.no_rekjurnal, cc.kd_unit,
            (cc.budget + (Select nvl(sum(budget),0) from erp_cc_budget_add where id_budget=cc.id)) budget
            from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal
            where cc.id='$id_budget'");
        return $query->row_array();
    }

    function upload_simpg($periode, $periode_edit, $no_rekjurnal, $kd_unit, $budget) {
        if ($kd_unit == '01') {
            $query = $this->db_perdana()->query("Select * from tbl_budget_pembelian where periode='$periode' and nomer_rekjurnal='$no_rekjurnal'");
            if ($query->num_rows() == 0) {
                $this->db_perdana()->query("Insert into tbl_budget_pembelian(periode, nomer_rekjurnal, budget, status) values('$periode','$no_rekjurnal','$budget','F')");
            }else{
                $this->db_perdana()->query("Update tbl_budget_pembelian set budget='$budget', status='F' where periode='$periode' and nomer_rekjurnal='$no_rekjurnal'");
            }   
        }else{
            $query = $this->db->query("Select * from tbl_budget_pembelian where periode='$periode' and nomer_rekjurnal='$no_rekjurnal'");
            if ($query->num_rows() == 0) {
                $this->db->query("Insert into tbl_budget_pembelian(periode, nomer_rekjurnal, budget, status) values('$periode','$no_rekjurnal','$budget','F')");
            }else{
                $this->db->query("Update tbl_budget_pembelian set budget='$budget', status='F' where periode='$periode' and nomer_rekjurnal='$no_rekjurnal'");
            }               
        }
    }

    function edit_simpg($periode, $periode_edit, $budget, $no_rekjurnal, $kd_unit, $qty_edit) {
        if ($kd_unit == '12') {
            $admin = $this->load->database('admin', TRUE);
            $admin->query("Update tbl_budget_pembelian set budget='$budget' where to_char(periode,'YYMM')='$periode_edit' and nomer_rekjurnal='$no_rekjurnal'");
        }else{
            $perdana = $this->load->database('perdana', TRUE);
            $perdana->query("Update tbl_budget_pembelian set budget='$budget' where to_char(periode,'YYMM')='$periode_edit' and nomer_rekjurnal='$no_rekjurnal'");          
        }
    }

    function dt_budget($id_hapus) {
        $query = $this->db->query("Select cc.kd_unit, ca.no_rekjurnal, to_char(cc.periode, 'YYMM') periode
            from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal
            where cc.id='$id_hapus'");
        return $query->row_array();
    }

    function hapus_profits($id_hapus) {
        $this->db->query("Delete from erp_cc_budget where id='$id_hapus'");
        $this->db->query("Delete from erp_cc_budget_add where id_budget='$id_hapus'");
    }

    function hapus_simpg($kd_unit, $no_rekjurnal, $periode) {
        if ($kd_unit == '12') {
            $this->db->query("Delete from tbl_budget_pembelian where to_char(periode,'YYMM')='$periode' and nomer_rekjurnal='$no_rekjurnal'");
        }else{
            $this->db_perdana()->query("Delete from tbl_budget_pembelian where to_char(periode,'YYMM')='$periode' and nomer_rekjurnal='$no_rekjurnal'");        
        }
    }

    function view($id_view) {
        $query = $this->db->query("Select distinct pa.nomer nmr_po, to_char(pa.tgl, 'DD-MM-YYYY') tgl_po, pe.nama supplier, pc.nama, pc.spesifikasi, pb.qty qty_po, pb.satuan, pb.harga, pb.mata_uang, pa.tgl, pa.nomer, pc.no_rekjurnal, hd.unit, to_char(pa.tgl, 'Mon-YY') periode
            from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_supplier pe on pe.id=pa.id_supplier join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_barang pc on pc.id=cf.id_barang join erp_hr_unit hd on hd.kd_unit=pa.kd_unit
            where to_char(pa.tgl, 'YYMM')=(select to_char(periode, 'YYMM') from erp_cc_budget where id='$id_view')
            and pc.no_rekjurnal=(select no_rekjurnal from erp_cc_budget where id='$id_view')
            and pa.kd_unit=(select kd_unit from erp_cc_budget where id='$id_view')
            order by pa.tgl desc, pa.nomer desc");
        return $query->result_array();
    }

    function ubah($id_budget) {
        // $query = $this->db->query("Select distinct ca.id id_jurnal, to_char(cc.periode, 'Mon-YYYY') periode, cc.budget, cc.no_rekjurnal, ca.nama,
        //     (select nvl(sum(budget), 0) from erp_cc_budget_add where id_budget=cc.id) addendum, cc.kd_unit, hd.unit,
        //     (select nvl(sum(pb.qty*pb.harga), 0) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po where pa.kd_unit=cc.kd_unit and pb.no_rekjurnal=cc.no_rekjurnal and to_char(pa.tgl, 'YYMM')=to_char(cc.periode, 'YYMM')) realisasi
        //     from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal join erp_hr_unit hd on hd.kd_unit=cc.kd_unit
        //     where cc.id='$id_budget'");
        $query = $this->db->query("Select distinct ca.id id_jurnal, to_char(cc.periode, 'Mon-YYYY') periode, cc.budget, cc.no_rekjurnal, ca.nama,
            (select nvl(sum(budget), 0) from erp_cc_budget_add where id_budget=cc.id) addendum, cc.kd_unit, hd.unit,
            (select nvl(sum(pb.qty*pb.harga), 0) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_barang pc on pc.id=cf.id_barang where pa.kd_unit=cc.kd_unit and pc.no_rekjurnal=cc.no_rekjurnal and to_char(pa.tgl, 'YYMM')=to_char(cc.periode, 'YYMM')) realisasi
            from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal join erp_hr_unit hd on hd.kd_unit=cc.kd_unit
            where cc.id='$id_budget'");
        return $query->row_array();
    }

    function isi_e_sisa($kd_unit, $periode, $kd_jurnal) {
        $query = $this->db->query("Select distinct cc.id, cc.no_rekjurnal, cc.budget,
            (select nvl(sum(budget), 0) from erp_cc_budget_add where id_budget=cc.id) addendum,
            (select nvl(sum(pb.qty*pb.harga), 0) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po where pa.kd_unit=cc.kd_unit and pb.no_rekjurnal=cc.no_rekjurnal and to_char(pa.tgl, 'YYMM')=to_char(cc.periode, 'YYMM')) realisasi
            from erp_cc_budget cc join erp_cc_rekening ca on ca.id=cc.id_jurnal join erp_hr_unit hd on hd.kd_unit=cc.kd_unit
            where cc.kd_unit='$kd_unit' and to_char(cc.periode, 'Mon-YYYY')='$periode' and cc.no_rekjurnal='$kd_jurnal'");
        return $query->row_array();
    }

    function id_budget_edit($periode, $no_rekjurnal, $kd_unit) {
        $query = $this->db->query("Select id from erp_cc_budget where to_char(periode, 'Mon-YYYY')='$periode' and kd_unit='$kd_unit' and no_rekjurnal='$no_rekjurnal'");
        return $query->row_array()['ID'];
    }

    function periode_edit($periode) {
        $query = $this->db->query("Select periode from erp_cc_budget where to_char(periode, 'Mon-YYYY')='$periode'");
        return $query->row_array()['PERIODE'];
    }

    function isi_add($periode1, $periode2) {
        $query = $this->db->query("Select ha.nama, cd.tgl_input, cc.no_rekjurnal, ca.nama nama_jurnal, cd.budget, cd.keterangan, to_char(cd.tgl_input, 'YYMM') tgl_periode, substr(keterangan, 1, instr(keterangan, ' ', -1, 1) -1) ket,
            (select nama from erp_cc_rekening where trim(no_rekjurnal)=(substr(keterangan, instr(keterangan, ' ', -1, 1) +1))) ket_jurnal
            from erp_cc_budget_add cd join erp_karyawan ha on ha.id=cd.id_input join erp_cc_budget cc on cc.id=cd.id_budget join erp_cc_rekening ca on ca.id=cc.id_jurnal
            where to_char(cd.tgl_input, 'YYMM') between '$periode1' and '$periode2'
            order by cd.tgl_input desc");
        return $query->result_array();
    }

}
