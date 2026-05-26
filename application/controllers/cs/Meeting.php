<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting extends CI_Controller
{
    function __construct() {
        parent::__construct();
        
        $this->load->model('cs/M_meeting');
        session_start();
    }

    function index() {
        if (!isset($_SESSION['logERP'])) {
            header("location:" . base_url());
        }

        $this->M_meeting->cek_status();
        $data['pic'] = $this->M_meeting->pic();
        $data['status_menu'] = $this->status_menu();
        $data['unit'] = $this->M_meeting->unit();
        $data['kd_unit'] = $this->kd_unit();

        $this->load->view('cs/v_meeting', $data);
    }

    function kd_unit() {
        $kary = explode('|', $_SESSION['logERP']);
        $id_kary = $kary[0];
        return $this->M_meeting->kd_unit($id_kary);
    }

    function status_menu() {
        $kary = explode('|', $_SESSION['logERP']);
        $id_kary = $kary[0];
        $id_menu_detail = '146';
        return $this->M_meeting->status_menu($id_menu_detail, $id_kary);
    }

    function auto_no() {
        $data = $this->input->post('data');
        $tahun = date('y', strtotime($data));

        $urut = $this->M_meeting->auto_no($tahun);
        print_r($tahun . '-' . $urut);
    }

    function simpan() {
        $data = $this->input->post('data');
        $nmr = $data[0];
        $tgl = date('d-m-Y', strtotime($data[1]));
        $jam = $tgl . ' ' . $data[2];
        $ruang = $data[3];
        $qty = $data[4];
        $agenda = $data[5];
        $lev = substr($data[6], -1);
        $id_kary = $data[7];
        $keterangan = $data[8];
        $id_edit = $data[9];
        $kd_unit = $this->kd_unit();

        if ($id_edit == '') {
            $id = $this->M_meeting->urut();
            $this->M_meeting->simpan($id, $nmr, $tgl, $jam, $ruang, $qty, $agenda, $lev, $id_kary, $keterangan, $kd_unit);
        } else {
            $this->M_meeting->edit($id_edit, $tgl, $jam, $ruang, $qty, $agenda, $lev, $id_kary, $keterangan, $kd_unit);
        }
    }

    function filter() {
        $data = $this->input->post('data');
        $tgl1 = date('ymd', strtotime($data[0]));
        $tgl2 = date('ymd', strtotime($data[1]));
        $kd_unit = $data[2];

        $data['meeting'] = $this->M_meeting->filter($tgl1, $tgl2, $kd_unit);
        $data['status_menu'] = $this->status_menu();
        $this->load->view('cs/v_meeting_table', $data);
    }

    function batal() {
        $id = $this->input->post('data');
        $this->M_meeting->batal($id);
    }

    function selesai() {
        $id = $this->input->post('data');
        $this->M_meeting->selesai($id);
    }

    function get_agenda() {
        $periode = $this->input->post('data');
        $data = $this->M_meeting->get_agenda($periode);
        print_r(json_encode($data));
    }
}
