<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sp extends CI_Controller
{
    function __construct() {
        parent::__construct();
        
        $this->load->model('pembelian/M_sp');
        session_start();
        
        if (!isset($_SESSION['logERP'])) {header("location:" . base_url());}
    }

    function index() {
        $data['unit'] = $this->M_sp->unit();
        $data['alokasi'] = $this->M_sp->alokasi();
        $data['supplier'] = $this->M_sp->supplier();
        $data['kategori'] = $this->M_sp->kategori();
        $data['kd_unit'] = $this->M_sp->kd_unit();
        $data['jenis'] = $this->M_sp->jenis();
        $data['nmr'] = $this->M_sp->nmr();

        $this->load->view('pembelian/v_sp.php', $data);
    }

    function cek_sp() {
        $data = $this->input->post('data');
        $id_sp_edit = $data[0];
        $no_sp = $data[1];
        $kd_unit = $data[2];

        $data = $this->M_sp->cek_sp($id_sp_edit, $no_sp, $kd_unit);
        print_r($data);
    }

    function data_po() {
        $data = $this->input->post('data');
        $id_supplier = $data[0];
        $kd_unit = $data[1];

        $data = $this->M_sp->data_po($id_supplier, $kd_unit);
        print_r(json_encode($data));
    }

    function total_datang() {
        $data = $this->input->post('data');
        $id_po_detail = $data[0];
        $id_sp_edit = $data[1];

        $data = $this->M_sp->total_datang($id_po_detail, $id_sp_edit);
        print_r($data);
    }

    function simpan() {
        $data = $this->input->post('data');
        $id_sp_edit = strtoupper($data[0]);
        $no_sp = strtoupper($data[1]);
        $tgl = date('d-m-Y', strtotime($data[2]));
        $no_kend = strtoupper($data[3]);
        $id_kary = $this->M_sp->id_kary();

        if ($id_sp_edit != '') {
            $this->hapus_hpd($id_sp_edit);

            $qty_lpb = $this->M_sp->hapus($id_sp_edit);
            if ($qty_lpb == '1') {return;}
        }

        $id_sp = $this->M_sp->urut_sp();

        $this->M_sp->simpan($id_sp, $no_sp, $tgl, $id_kary, $no_kend);
        for ($i = 0; $i < count($data[4][0]); $i++) {
            $id_sp_detail = $this->M_sp->urut_sp_detail();
            $id_po_detail = $data[4][0][$i];
            $qty_datang = str_replace('.', ',', $data[4][1][$i]);
            $nilai_beli = str_replace('.', ',', $data[4][2][$i]);

            $this->M_sp->simpan_detail($id_sp_detail, $id_sp, $id_po_detail, $qty_datang, $nilai_beli);

            // Close PO yang melebihi QTY
            $close_po = $data[4][3][$i];
            if ($close_po == 1) {
                $this->M_sp->close_po($id_po_detail);
            }else{
                $this->M_sp->open_po($id_po_detail);
            }
        }
        $this->upload_hpd($id_sp);
    }

    function filter() {
        $data = $this->input->post('data');
        $tgl1 = date('ymd', strtotime($data[0]));
        $tgl2 = date('ymd', strtotime($data[1]));
        $kd_unit = $data[2];
        $kategori = $data[3];
        $jenis = $data[4];
        $nmr = $data[5];

        $data['data'] = $this->M_sp->filter($tgl1, $tgl2, $kd_unit, $kategori, $jenis, $nmr);
        $this->load->view('pembelian/v_sp_table', $data);
    }

    function edit() {
        $id_detail = $this->input->post('data');
        $data = $this->M_sp->edit($id_detail);
        print_r(json_encode($data));
    }

    function cek_batal() {
        $id_detail = $this->input->post('data');
        $data = $this->M_sp->cek_batal($id_detail);
        print_r($data);
    }

    function batal() {
        $id_detail = $this->input->post('data');
        $this->batal_hpd($id_detail);
        $this->M_sp->batal($id_detail);
    }


    // ========================================  Menu Holo Perdana  ========================================
    // =====================================================================================================

    // Upload Data ke Holo Perdana
    function upload_hpd($id_sp) {
        $dt_sp = $this->M_sp->dt_sp($id_sp);

        if ($dt_sp[0]['KD_UNIT'] == '01') {
            foreach ($dt_sp as $dt) {
                $kode_gudang = '01';
                $kode_barang = $dt['KODE_BARANG'];
                $tanggal_stok = $dt['TGL'];
                $tanggal_transaksi = $dt['TGL'];
                $qty = $dt['QTY'];
                $satuan = $dt['SATUAN'];
                $harga = $dt['HARGA'];
                $userid = $dt['USERID'];
                $id_detail_sp = $dt['ID_DETAIL_SP'];

                $nomor_referensi = $this->M_sp->nomor_referensi();
                $this->M_sp->upload_hpd($kode_gudang, $kode_barang, $tanggal_stok, $nomor_referensi, $tanggal_transaksi, $qty, $satuan, $harga, $userid);
                $this->M_sp->update_sp($id_detail_sp, $nomor_referensi);
            }
        }

    }

    // Hapus Data Edit
    function hapus_hpd($id_sp_edit) {
        $dt_sp = $this->M_sp->dt_sp($id_sp_edit);   
        foreach ($dt_sp as $dt) {
            $nomor_referensi = $dt['NOMOR_REFERENSI'];
            $this->M_sp->hapus_hpd($nomor_referensi);
        }
    }

    // Batal Data HPD
    function batal_hpd($id_detail) {
        $nomor_referensi = $this->M_sp->dt_referensi($id_detail);            
        $this->M_sp->hapus_hpd($nomor_referensi);
    }

}