<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lpb extends CI_Controller
{
    function __construct() {
        parent::__construct();
        
        $this->load->model('pembelian/M_lpb');

        session_start();
        if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
    }

    function index() {
        $data['unit'] = $this->M_lpb->unit();
        $data['jenis'] = $this->M_lpb->jenis();
        $data['kategori'] = $this->M_lpb->kategori();
        $data['nmr'] = $this->M_lpb->nmr();

        $this->load->view('pembelian/v_lpb.php', $data);
    }

    function filter() {
        $data = $this->input->post('data');
        $tgl1 = date('ymd', strtotime($data[0]));
        $tgl2 = date('ymd', strtotime($data[1]));
        $kd_unit = $data[2];
        $jenis = $data[3];

        $data['filter'] = $this->M_lpb->filter($tgl1, $tgl2, $kd_unit, $jenis);
        $this->load->view('pembelian/v_lpb_table', $data);
    }

    function filter_detail() {
        $data = $this->input->post('data');
        $tgl1 = date('ymd', strtotime($data[0]));
        $tgl2 = date('ymd', strtotime($data[1]));
        $kd_unit = $data[2];
        $resmi = substr($data[3],0,1);
        $jenis = $data[4];
        $kategori = $data[5];
        $nmr = $data[6];

        $data['filter_detail'] = $this->M_lpb->filter_detail($tgl1, $tgl2, $kd_unit, $resmi, $jenis, $kategori, $nmr);
        $this->load->view('pembelian/v_lpb_table_report', $data);
    }

    function auto_no() {
        $data = $this->input->post('data');
        $kode_unit = $data[0];
        $resmi_polos = $data[1];

        if ($resmi_polos == 'R') {
            $kode_HD = '1';
        } else {
            $kode_HD = '0';
        }

        $urut_lpb = $this->M_lpb->nomor_lpb($kode_unit, $kode_HD);
        print_r($urut_lpb);
    }

    function cek_nomer() {
        $data = $this->input->post('data');
        $kd_unit = $data[0];
        $nomer_lpb = $data[1];
        $resmi_polos = $data[2];
        $dt_no_sp = $data[3];
        $qty_sp = 0;

        $qty_nomer = $this->M_lpb->cek_nomer($kd_unit, $nomer_lpb, $resmi_polos);

        for ($i=0; $i<count($dt_no_sp); $i++) {
            $no_sp = $dt_no_sp[$i];
            $t_qty_sp = $this->M_lpb->cek_sp($kd_unit, $no_sp);
            $qty_sp = $qty_sp + $t_qty_sp;
        }

        print_r(json_encode(array($qty_nomer,$qty_sp)));
    }

    function simpan() {
        $data = $this->input->post('data');
        $dt_sp = $data[0];
        $kode_unit = $data[1];
        $tanggal_lpb = date('d-m-Y', strtotime($data[2]));
        $urut_lpb = $data[3];
        $kode_trans = $data[4];
        $resmi_polos = substr($kode_trans,1,1);
        $nomer_lpb = $urut_lpb . $kode_trans;
        $kode_HD = $resmi_polos == 'R' ? '1' : '0';      

        $id_input = $this->M_lpb->id_kary();
        $id_lpb = $this->M_lpb->urut_lpb();
        $nomor_lpb = 'HD' . $kode_HD . $kode_unit . str_pad($urut_lpb, 12, '0', STR_PAD_LEFT);
        $this->M_lpb->simpan($id_lpb, $nomer_lpb, $id_input, $nomor_lpb, $tanggal_lpb, $kode_unit);

        for ($i=0; $i<count($dt_sp); $i++) {
            $id_sp = $dt_sp[$i];
            $id = $this->M_lpb->urut_lpb_detail();
            $this->M_lpb->simpan_detail($id, $id_lpb, $id_sp);

            $nomor_sj = $this->M_lpb->nomor_sj($kode_unit);
            $nomor_sj = 'SJ' . $kode_unit . sprintf('%08d', $nomor_sj);
            $this->M_lpb->update_sj_intern($id_sp,$nomor_sj);
        }

        print_r($nomer_lpb);

        $this->upload_sakti($nomer_lpb); // Upload Ke Sakti
    }

    function batal() {
        $nmr = $this->input->post('data');
        $this->batal_sakti($nmr);

        $data_hapus = $this->M_lpb->data_hapus($nmr);
        foreach ($data_hapus->result_array() as $dt) {
            $id_sp = $dt['ID_SP'];
            $this->M_lpb->hapus_sj_intern($id_sp);
        }
        $this->M_lpb->batal_profits($nmr);
        $this->batal_simpg($nmr);
    }

    function cetak() {
        $no_lpb = $this->input->post('data');
        $data = $this->M_lpb->cetak($no_lpb);
        print_r(json_encode($data));
    }

    function filter_rekap() {
        $data = $this->input->post('data');
        $tgl1 = date('ymd', strtotime($data[0]));
        $tgl2 = date('ymd', strtotime($data[1]));
        $kd_unit = $data[2];
        $resmi = $data[3];

        $data['filter_rekap'] = $this->M_lpb->filter_rekap($tgl1, $tgl2, $kd_unit, $resmi);
        $this->load->view('pembelian/v_lpb_table_rekap', $data);
    }

    function detail_sp() {
        $data = $this->input->post('data');
        $id_detail = $data[0];
        $rekap = $data[1];

        $data = $this->M_lpb->detail_sp($id_detail,$rekap);
        print_r(json_encode($data));
    }
    

    // ========================================  Menu Sakti  ========================================
    // ==============================================================================================

    function f_upload_sakti() {
        $nmr_lpb = $this->input->post('data');
        $this->upload_sakti($nmr_lpb);
    }

    function upload_sakti($nomer_lpb) {
        $dt_sp = $this->M_lpb->dt_sp($nomer_lpb);
        $this->sj_sakti($dt_sp);
        $this->lpb_sakti($nomer_lpb);
    }

    function sj_sakti($dt_sp) {
        $id_kary = $this->M_lpb->id_kary();
        $users = $this->M_lpb->username($id_kary);

        for ($i=0; $i<count($dt_sp); $i++) {
            $id_sp = $dt_sp[$i]['ID_SP'];
            $data_sj = $this->M_lpb->data_sj($id_sp);

            $nomor_sj = substr($data_sj['NOMOR_SJ'], 0, 12);
            $kode_supplier = $data_sj['KODE_SUPPLIER'];
            $tanggal_dok = $data_sj['TANGGAL_DOK'];
            $kd_unit = $data_sj['KD_UNIT'];
            $supplier_kendaraan = 'NONE';

            $this->M_lpb->simpan_sj_head($nomor_sj, $kode_supplier, $tanggal_dok, $users, $supplier_kendaraan, $kd_unit);

            $data_sj_detail = $this->M_lpb->data_detail_sp($id_sp);
            for ($j = 0; $j < count($data_sj_detail); $j++) {
                $nomor_sj = substr($data_sj_detail[$j]['NOMER_SP'], 0, 12);
                $nomor_spp = $data_sj_detail[$j]['NOMER_SPP'];
                $nomor_sip = $data_sj_detail[$j]['NOMER_SIP'];
                $item_sip = $data_sj_detail[$j]['ITEM_SIP'];
                $qty = $data_sj_detail[$j]['QTY'];
                $kd_unit = $data_sj_detail[$j]['KD_UNIT'];
                $nomor_lpb = $data_sj_detail[$j]['NMR_SAKTI'];

                $nomor_spp = substr($nomor_spp, 20, 2) . substr($nomor_spp, 0, 6) . substr($nomor_spp, 15, 1);
                $nomor_sip = substr($nomor_sip, 19, 2) . substr($nomor_sip, 0, 4) . substr($nomor_sip, 13, 2);
                $item_sip = sprintf('%02d', $item_sip);

                $this->M_lpb->simpan_sj_item($nomor_sj, $nomor_spp, $nomor_sip, $item_sip, $qty, $nomor_lpb, $kd_unit);
            }
        }
    }

    function lpb_sakti($nomer_lpb) {
        $data_lpb = $this->M_lpb->data_lpb($nomer_lpb);
        $kode_supplier = $data_lpb['KODE_SUPPLIER'];
        $kode_jenis = $data_lpb['KODE_JENIS'];
        $mata_uang = $data_lpb['MATA_UANG'];
        $limit = $data_lpb['TOP'];
        $nomor_urut = $data_lpb['NOMOR_URUT'] == null ? $data_lpb['THN'] . '000000001' : $data_lpb['NOMOR_URUT'];
        $tgl_lpb = $data_lpb['TGL_LPB'];
        $kd_unit = $data_lpb['KD_UNIT'];
        $nomor_lpb = $data_lpb['NOMOR_LPB'];

        if (substr($nomor_lpb, 1, 1) == 'J') {
            $barang_jasa = 'J';
        } else {
            $barang_jasa = 'B';
        }
        if ($kode_jenis == '4') {
            $lokal_impor = 'I';
        } else {
            $lokal_impor = 'L';
        }

        $id_kary = $this->M_lpb->id_kary();
        $users = $this->M_lpb->username($id_kary);

        $this->M_lpb->simpan_lpb_head($nomor_lpb, $kode_supplier, $tgl_lpb, $barang_jasa, $users, $lokal_impor, $mata_uang, $limit, $nomor_urut, $kd_unit);

        $this->M_lpb->update_lpb($nomor_lpb,$nomor_urut);

        $data_lpb_detail = $this->M_lpb->data_lpb_detail($nomer_lpb);
        for ($i = 0; $i < count($data_lpb_detail); $i++) {
            $nomor_spp = $data_lpb_detail[$i]['NOMOR_SPP'];
            $nomor_sip = $data_lpb_detail[$i]['NOMOR_SIP'];
            $item_sip = $data_lpb_detail[$i]['ITEM_SIP'];
            $qty = $data_lpb_detail[$i]['QTY'];
            $nomor_sj = substr($data_lpb_detail[$i]['NOMOR_SJ'], 0, 12);
            $pph = '0';

            $nomor_spp = substr($nomor_spp, 20, 2) . substr($nomor_spp, 0, 6) . substr($nomor_spp, 15, 1);
            $nomor_sip = substr($nomor_sip, 19, 2) . substr($nomor_sip, 0, 4) . substr($nomor_sip, 13, 2);
            $item_sip = sprintf('%02d', $item_sip);

            $this->M_lpb->simpan_lpb_item($nomor_lpb, $nomor_spp, $nomor_sip, $item_sip, $qty, $nomor_sj, $pph, $kd_unit);
        }
    }

    function batal_sakti($nmr) {
        $data_lpb = $this->M_lpb->data_lpb($nmr);
        $kd_unit = $data_lpb['KD_UNIT'];
        $nomor_lpb = $data_lpb['NOMOR_LPB'];
        $lpb_urut = $data_lpb['LPB_URUT'];

        $this->M_lpb->hapus_lpb_urut($lpb_urut);
        $this->M_lpb->hapus_lpb_sakti($kd_unit, $nomor_lpb);

        $dt_sp = $this->M_lpb->dt_sp($nmr);
        for ($i=0; $i<count($dt_sp); $i++) {
            $nomor_sj = $dt_sp[$i]['NMR_SJ'];
            $this->M_lpb->hapus_sj_sakti($kd_unit, $nomor_sj);
        }
    }
    

    // ========================================  Menu SIMPG  ========================================
    // ==============================================================================================

    function upload_simpg() {
        $data = $this->input->post('data');
        $kd_unit = $data[0];
        $dt_lpb = $data[1];

        for ($i=0; $i<count($dt_lpb); $i++) {
            $nmr_lpb = $dt_lpb[$i];

            $qty_upload = $this->M_lpb->cek_simpg($kd_unit, $nmr_lpb);
            if ($qty_upload == '0') {
                $data_sp = $this->M_lpb->dt_sp($nmr_lpb);
                $dt_sp = array();

                foreach ($data_sp as $dt) {
                    array_push($dt_sp, $dt['ID_SP']);
                }

                $this->sp_simpg($dt_sp);
                $this->lpb_simpg($nmr_lpb);
            }
        }
    }

    function sp_simpg($dt_sp) {
        $id_kary = $this->M_lpb->id_kary();
        for ($i=0; $i<count($dt_sp); $i++) {
            $id_sp = $dt_sp[$i];

            $data_sp = $this->M_lpb->data_sj($id_sp);
            $nomer_sp = $data_sp['NOMOR_SJ'];
            $nomer_lpb = $data_sp['NMR_LPB'];
            $no_kendaraan = $data_sp['KEND'];
            $tanggal_sp = $data_sp['TGL_SP'];
            $kode_sub_unit = $data_sp['KODE_SUB_UNIT'];
            $tanggal_terima = $data_sp['TGL_TERIMA'];
            $kode_unit = $data_sp['KD_UNIT'];
            $nomor_lpb = $data_sp['NMR_SAKTI'];
            $tgl_lpb = $data_sp['TGL_LPB'];
            $nomor_sj = $data_sp['SP_INTERN'];
            $username = $this->M_lpb->username($id_kary);

            $kode_proyek = 'REG';
            $status = 'F';
            $upload = 'T';
            $no_lc = '';
            $f_buat_lpb = 'F';


            $this->M_lpb->simpan_sp_simpg($nomer_sp, $nomer_lpb, $no_kendaraan, $tanggal_sp, $username, $kode_unit, $kode_proyek, $kode_sub_unit, $status, $upload, $nomor_sj, $tanggal_terima, $nomor_lpb, $no_lc, $f_buat_lpb, $tgl_lpb);

            $this->simpan_sp_simpg_detail($id_sp);
        }
    }

    function simpan_sp_simpg_detail($id_sp) {
        $nomer_urut_sp = '0';
        $data_detail_sp = $this->M_lpb->data_detail_sp($id_sp);

        foreach ($data_detail_sp as $dt) {
            $nomer_urut_sp++;
            $nomer_spp = $dt['NOMER_SPP'];
            $nomer_sp = $dt['NOMER_SP'];
            $kode_barang = $dt['KODE_BARANG'];
            $nomer_rekjurnal = $dt['NOMER_REKJURNAL'];
            $nilaibeli = $dt['NILAIBELI'];
            $qty1 = $dt['QTY'];
            $qty2 = $dt['QTY'];
            $kode_satuan = $dt['KODE_SATUAN'];
            $nomer_sip = $dt['NOMER_SIP'];
            $satuan_harga = $dt['SATUAN_HARGA'];

            $kd_unit = $dt['KD_UNIT'];
            $jenis = $dt['JENIS'];
            if ($kd_unit == '12' && $jenis == 'BB') {
                $kode_gudang = '01';
            } else if ($kd_unit == '12' && $jenis == 'BP') {
                $kode_gudang = '02';
            } else if ($jenis == 'SP') {
                $kode_gudang = '03';
            } else if ($jenis == 'GA') {
                $kode_gudang = '04';
            } else if ($kd_unit == '01' && $jenis == 'BP') {
                $kode_gudang = '05';
            } else if ($kd_unit == '01') {
                $kode_gudang = '06';
            } else {
                $kode_gudang = '99';
            }

            $kurs = '1';
            $nomer_lpb = '';

            $this->M_lpb->simpan_sp_simpg_detail($kd_unit, $nomer_spp, $nomer_sp, $kode_barang, $kode_gudang, $nomer_rekjurnal, $kurs, $nilaibeli, $qty1, $qty2, $kode_satuan, $nomer_sip, $nomer_urut_sp, $satuan_harga, $nomer_lpb);
        }
    }

    function lpb_simpg($nmr_lpb) {
        $data_lpb = $this->M_lpb->data_lpb($nmr_lpb);
        $kode = $data_lpb['KODE'];
        $nilai_dpp = str_replace(',', '.', $data_lpb['NILAI_DPP']);
        $top = $data_lpb['TOP'];
        $kode_unit = $data_lpb['KD_UNIT'];
        $kode_sub_unit = $data_lpb['KODE_SUB_UNIT'];
        $ppn = $data_lpb['PPN'];
        $nomer_lpb = $data_lpb['NOMER_LPB'];
        $tgl_lpb = $data_lpb['TGL_LPB'];
        $nomor_lpb_urut = $data_lpb['LPB_URUT'];
        $thn = substr($tgl_lpb, -2);
        $nilai_ppn = $nilai_dpp * $ppn / 100;
        $nilai_dpp = str_replace('.', ',', $nilai_dpp);
        $nilai_ppn = str_replace('.', ',', $nilai_ppn);
        $nilai_pph = '0';
        $debet = '0';
        $kode_rekkredit = '2101.01';
        $kode_rekdebet = '';
        $adjusment = 'F';
        $kurs = '1';
        $nomer_tt = '';
        $tanggal_tt = '';
        $kode_proyek = 'REG';
        $upload = 'T';
        $nomor_lpb = '';
        $f_cetak = 'F';

        $this->M_lpb->simpan_simpg_lpb($nomer_lpb, $tgl_lpb, $kode, $nilai_dpp, $nilai_ppn, $nilai_pph, $debet, $top, $kode_rekkredit, $kode_rekdebet, $adjusment, $kurs, $nomer_tt, $tanggal_tt, $kode_unit, $kode_proyek, $kode_sub_unit, $upload, $nomor_lpb, $nomor_lpb_urut, $f_cetak);
    }

    function batal_simpg($nmr_lpb) {
        $this->M_lpb->hapus_lpb_simpg($nmr_lpb);
    }

}
