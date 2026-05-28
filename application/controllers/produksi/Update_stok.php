<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_stok extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('produksi/M_update_stok');
    }

    function index() {
        $data['records'] = $this->M_update_stok->getdata();
        $data['bagian'] = $this->M_update_stok->get_bagian();

        $this->load->view('produksi/v_update_stok', $data);
    }

    function simpan() {
        $id = $this->input->post('id');
        $flag = $this->input->post('flag');
        $tanggal = $this->input->post('tanggal');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $seri = $this->input->post('seri');
        $id_bagian = $this->input->post('id_bagian');

        if ($flag == 'edit') {
            $this->M_update_stok->update($id, $tanggal, $jumlah, $satuan, $seri, $id_bagian);
        } else {
            if ($this->M_update_stok->cek_data($tanggal, $seri, $id_bagian) > 0) {
                $_SESSION['pesan'] = '<font color="red">Data tanggal, bagian, dan seri yang sama sudah ada.</font>';
                redirect('produksi/update_stok');
            }

            $this->M_update_stok->simpan($tanggal, $jumlah, $satuan, $seri, $id_bagian);
        }

        redirect('produksi/update_stok');
    }

    function hapus() {
        $id = $this->input->post('id');
        $this->M_update_stok->hapus($id);
        redirect('produksi/update_stok');
    }
}
