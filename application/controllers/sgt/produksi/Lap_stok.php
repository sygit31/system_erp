<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_stok extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('produksi/M_update_stok');
        session_start();
    }

    function index() {
        $data['tanggalAwal'] = '';
        $data['records'] = array();

        $this->load->view('sgt/produksi/v_lap_stok', $data);
    }

    function filter() {
        $tanggalAwal = $this->input->post('tanggalAwal');

        if (empty($tanggalAwal)) {
            redirect('sgt/produksi/lap_stok');
        }

        $tanggal = DateTime::createFromFormat('d-m-Y', $tanggalAwal);
        $tanggalFormat = $tanggal ? $tanggal->format('Y-m-d') : $tanggalAwal;

        $data['tanggalAwal'] = $tanggalAwal;
        $data['records'] = $this->M_update_stok->lap_stok($tanggalFormat);
        $data['records_pelekatan'] = $this->M_update_stok->lap_pelekatan($tanggalFormat);

        $this->load->view('sgt/produksi/v_lap_stok', $data);
    }
}
