<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_stok extends CI_Controller {

    function __construct() {
        parent::__construct();
        session_start();
    }

    function index() {
        $this->load->view('produksi/v_update_stok');
    }
}
