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
        $data['records_pelekatan'] = array();
        $data['total_stok'] = $this->buildTotals(array());
        $data['total_pelekatan'] = $this->buildTotals(array());

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
        $data['total_stok'] = $this->buildTotals($data['records']);
        $data['total_pelekatan'] = $this->buildTotals($data['records_pelekatan']);

        $this->load->view('sgt/produksi/v_lap_stok', $data);
    }

    private function buildTotals($records) {
        $totals = array(
            'seri_i' => 0,
            'seri_ii' => 0,
            'seri_iii' => 0,
            'seri_mmea' => 0,
        );

        if (!empty($records)) {
            foreach ($records as $row) {
                $totals['seri_i'] += (float) $row['SERI_I'];
                $totals['seri_ii'] += (float) $row['SERI_II'];
                $totals['seri_iii'] += (float) $row['SERI_III'];
                $totals['seri_mmea'] += (float) $row['SERI_MMEA'];
            }
        }

        return $totals;
    }
}
