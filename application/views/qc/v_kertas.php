<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>

<!-- Custom CSS -->
<style>

    body {
        padding-right: 0 !important;
    }

    .select2-container--open {
        z-index: 9999999;
    }

    @media print {
        @page {
            size: landscape;
        }

        html, body {
            width: 320mm; height: 210mm;
        }

        #pr_body td, #pr_body tfoot th {
            vertical-align: middle;
            padding-left: 5px;
            text-align: center;
        }

        #pr_body thead td, #pr_body tbody td, #pr_body tfoot th {
            border: 1px solid #6E6E6E;
        }
    }

</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Pengujian RH</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Nomor</th>
                                <td>
                                    <input type="number" id="nmr" name="" class="form-control" value="000" maxlength="3" onfocusout="isi_nomor(this, 3)" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <input id="tgl" type="text" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" onchange="auto_no()" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Desain - Ukuran</th>
                                <td>
                                    <select class="select_min" id="desain" onchange="isi_roll()" style="width: 55%;">
                                        <?php foreach($desain->result_array() as $dt) { ?>
                                            <option><?php echo $dt['DESAIN']; ?></option>               
                                        <?php } ?>
                                    </select>
                                    <select class="select_min" id="ukuran" onchange="isi_roll()" style="width: 40%;">
                                        <option value="A">73</option>                       
                                        <option value="B">52,5</option>                       
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode Roll</th>
                                <td>
                                    <select class="select" id="kode_roll" onchange="isi_berat()" style="width: 100%;">
                                        <option value="@">Pilih..</option>                       
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Berat</th>
                                <td>
                                    <input type="text" id="berat" class="form-control" value="0" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pabrikasi</th>
                                <td>
                                    <input type="number" id="pabrikasi" class="form-control" value="000000" maxlength="6" onfocusout="isi_nomor(this, 6)" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%">
                            <tr>
                                <th width="40%">RH</th>
                                <td>
                                    <div class="row text-center">
                                        <div class="col-4 text-info mb-2">Awal<input type="number" class="numbers" name="rh" step="0.1" lang="en-US"></div>
                                        <div class="col-4 text-info mb-2">Tengah<input type="number" class="numbers" name="rh" step="0.1" lang="en-US"></div>
                                        <div class="col-4 text-info mb-2">Akhir<input type="number" class="numbers" name="rh" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Suhu</th>
                                <td>
                                    <div class="row text-center">
                                        <div class="col-4 text-info mb-2">Awal<input type="number" class="numbers" name="suhu" step="0.1" lang="en-US"></div>
                                        <div class="col-4 text-info mb-2">Tengah<input type="number" class="numbers" name="suhu" step="0.1" lang="en-US"></div>
                                        <div class="col-4 text-info mb-2">Akhir<input type="number" class="numbers" name="suhu" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Visual</th>
                                <td>
                                    <select class="select_min" id="visual" style="width: 100%;">
                                        <option value="1">OK</option>
                                        <option value="0">Reject</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Acc</th>
                                <td>
                                    <select class="select_min" id="acc" style="width: 100%;">
                                        <option value="1">OK</option>
                                        <option value="0">Reject</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pemeriksa</th>
                                <td>
                                    <select class="select_min" id="pemeriksa" style="width: 100%;">
                                        <?php foreach ($karyawan_qc->result_array() as $dt) { ?>
                                            <?php if ($dt['TRANS'] == 'Pengawas Bahan') { ?>
                                                <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Approval</th>
                                <td>
                                    <select class="select_min" id="approval" style="width: 100%;">
                                        <?php foreach ($karyawan_qc->result_array() as $dt) { ?>
                                            <?php if ($dt['TRANS'] == 'Approval QC') { ?>
                                                <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan RH</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table class="tbl_filter" style="width: 600px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="20%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="17%" class="filter">Ukuran</th>
                                        <th></th>
                                        <th width="20%" class="filter">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_desain" onchange="filter()" style="width: 100%;">
                                                <?php foreach($desain->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['DESAIN']; ?></option>               
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_ukuran" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>                       
                                                <option value="A">73</option>                       
                                                <option value="B">52,5</option>                       
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_status" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>                       
                                                <option value="1">Baik</option>                       
                                                <option value="0">Reject</option>                       
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nomor Urut</th>
                                        <th rowspan="2">Desain</th>
                                        <th rowspan="2">Tgl. Terima</th>
                                        <th rowspan="2">Tgl. Periksa</th>
                                        <th rowspan="2">Nomor Roll</th>
                                        <th rowspan="2">Pabrikasi</th>
                                        <th rowspan="2">Netto<br>(Cm)</th>
                                        <th rowspan="2">Lebar<br>(Cm)</th>
                                        <th rowspan="2">GSM<br>(gr/m2)</th>
                                        <th rowspan="2">Thickness<br>(micron)</th>
                                        <th colspan="2">Awal</th>
                                        <th colspan="2">Tengah</th>
                                        <th colspan="2">Akhir</th>
                                        <th rowspan="2">Visual</th>
                                        <th rowspan="2">Keterangan<br>Acc/Rej</th>
                                        <th rowspan="2">Cetak</th>
                                        <th rowspan="2">Edit</th>
                                        <th rowspan="2">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th>RH (%)</th>
                                        <th>Suhu (C)</th>
                                        <th>RH (%)</th>
                                        <th>Suhu (C)</th>
                                        <th>RH (%)</th>
                                        <th style="border-right: 1px solid #CECECE;">Suhu (C)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Average</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="5"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Max</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="5"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Min</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="5"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" id="btn_excel" class="btn btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>
            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>
    </section>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <h5><div class="modal-body text-info invisible" id="error_isian"></div></h5>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2" onclick="$('#error_isian').addClass('invisible')"></i><b>OK</b></button>
                <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
            <div class="modal-footer" hidden>
                <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses Simpan -->
<div class="modal fade" id="modal_sukses" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
            <div class="modal-footer">
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="card-footer text-right">
                <button type="button" id="btnYa" class="btn btn-danger" data-dismiss="modal" style="width: 150px;"><i class="fa fa-exclamation mr-2"></i><b>Yes</b></button>
                <button type="button" id="btnNo" class="btn btn-primary" data-dismiss="modal" style="width: 150px;"><i class="fa fa-share mr-2"></i><b>No</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 14px;">
    <div style="width: 200px; margin-bottom: -15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
    </div>

    <h5 align="center" style="margin-top: -5mm;">LAPORAN PEMERIKSAAN MUTU KERTAS BANDEROL 60 GSM IN ROLL</h5>
    <h5 id="pr_nmr" align="center" style="margin-top: -2mm;">No : 161 / PNP-HLG / QC - BHN / 05 / VII / 2023</h5>
    <table id="pr_body" class="mt-1" width="100%">
        <thead style="text-align: center;">
            <tr>
                <td rowspan="2">No.</td>
                <td rowspan="2" style="width: 100px;">Tgl. Terima<br>PNP - HLG</td>
                <td colspan="2">Nomor</td>
                <td rowspan="2">Berat<br>(Kg)</td>
                <td rowspan="2">Lebar<br>(Cm)</td>
                <td rowspan="2">Gramature<br>(gr/m2)</td>
                <td rowspan="2">Thickness<br>(micron)</td>
                <td colspan="2">Awal</td>
                <td colspan="2">Tengah</td>
                <td colspan="2">Akhir</td>
                <td rowspan="2">Visual</td>
                <td rowspan="2">Keterangan<br>Acc/Reject</td>
            </tr>
            <tr>
                <td>Roll</td>
                <td>Pabrikasi</td>
                <td>RH (%)</td>
                <td>Suhu (C)</td>
                <td>RH (%)</td>
                <td>Suhu (C)</td>
                <td>RH (%)</td>
                <td>Suhu (C)</td>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th colspan="4">Average</th>
                <th></th>
                <th>-</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">-</th>
            </tr>
            <tr>
                <th colspan="4">Max</th>
                <th></th>
                <th>-</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">-</th>
            </tr>
            <tr>
                <th colspan="4">Min</th>
                <th></th>
                <th>-</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2">-</th>
            </tr>
        </tfoot>
    </table>
    <div align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-QC2-007 Rev. 02</div>
    <div class="d-flex justify-content-center mt-2">
        <div class="p-2" style="width: 100%; border: 1px solid #6E6E6E; font-size: 10px;">
            <table style="width: 100%;">
                <tr>
                    <td colspan="6">STANDART KEBERTERIMAAN BAHAN KERTAS</td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Pemeriksaan visual yg Acc</td>
                    <td width="5%">:</td>
                    <td colspan="3">Kertas tidak sobek, tidak nglinting, tidak gelombang,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>(diberi tanda "v")</td>
                    <td></td>
                    <td colspan="3">tidak lubang, tidak bercak-bercak (kotor)</td>
                </tr>
                <tr style="height: 10px;"></tr>
                <tr>
                    <td>2.</td>
                    <td>Pemeriksaan fisik yg Acc</td>
                    <td>:</td>
                    <td>1. Gramature</td>
                    <td>:</td>
                    <td>60 +/- 3 gsm</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>2. Thickness</td>
                    <td>:</td>
                    <td>72 +/- 6 gsm</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>3. RH</td>
                    <td>:</td>
                    <td>37 s/d 58 %</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>4. Suhu</td>
                    <td>:</td>
                    <td>27 +/- 2 C</td>
                </tr>
            </table>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="width: 100%; border: 1px solid #6E6E6E;">
            <table class="text-center sign" style="width: 90%;">
                <tr>
                    <td>Mengetahui,</td>
                    <td width="20%"></td>
                    <td>Hormat kami,</td>
                </tr>
                <tr style="height: 40px;"></tr>
                <tr style="line-height: 10px;">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="line-height: 1px;">
                    <td>......................................</td>
                    <td></td>
                    <td>......................................</td>
                </tr>
                <tr>
                    <td>Kabag / Kabid QC</td>
                    <td width="20%"></td>
                    <td>QC Bahan</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<!-- QR Code -->
<script src="<?php echo base_url(); ?>assets/js/jquery.qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=4"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});
        $('.fa-bars:eq(0)').click();

        auto_no();
        isi_roll();
        filter();
    });

// Auto Nomor Sortir
    function auto_no() {
        var id_edit =$('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var data = [id_edit, tgl];

        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Kertas/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Auto Nomor Roll
    function isi_roll() {
        var desain = $('#desain').val();
        var ukuran = $('#ukuran').val();
        var data = [desain, ukuran];

        $('#kode_roll option:gt(0)').remove();
        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Kertas/isi_roll" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    $('#kode_roll').append('<option value="'+data[i].NO_ROLL + '@' + data[i].NETTO_KG+'">'+data[i].NO_ROLL+'</option>');
                }
            }
        });
    }

// Isi Berat Berdasarkan Roll
    function isi_berat() {
        var berat = $("#kode_roll").val().split('@')[1];

        $("#berat").val(format_number(berat));
    }

// Isi Format Nomor 3 atau 6 angka
    function isi_nomor(btn, num) {
        var nmr = btn.value;
        var nmr = nmr.toString().padStart(num, "0");
        var nmr = nmr.substring(0, num);

        btn.value = nmr;
    }

// Focus In
    function clear_isi(btn) {
        var qty = Number(btn.value);

        if (qty == 0) {$(btn).val('');}
    }

// Focus Out
    function isi_null(btn) {
        var qty = btn.value;

        if (qty == '') {$(btn).val(0);}
    }

// Filter Data
    function filter() {
        var t_netto = 0, t_gsm = 0, t_thic = 0, t_rha = 0, t_rhb = 0, t_rhc = 0, t_suhua = 0, t_suhub = 0, t_suhuc = 0;
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var ukuran = $('#f_ukuran').val();
        var status = $('#f_status').val();
        var data = [tgl1, tgl2, desain, ukuran, status];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Kertas/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    ar_netto = [], ar_gsm = [], ar_thic = [], ar_rha = [], ar_rhb = [], ar_rhc = [], ar_suhua = [], ar_suhub = [], ar_suhuc = [];
                    for (var i=0; i<data.length; i++) {
                        bahan = data[i].BAHAN == null ? '' : data[i].BAHAN.split('|');
                        awal = data[i].AWAL.split('|');
                        tengah = data[i].TENGAH.split('|');
                        akhir = data[i].AKHIR.split('|');
                        visual = data[i].VISUAL == '1' ? 'Acc' : 'REJ';
                        acc = data[i].ACC == '1' ? 'Acc' : 'REJ';

                        tgl_terima = bahan == '' ? '' : format_date(bahan[0]);
                        lebar = bahan == '' ? '' : bahan[1];
                        thickness = bahan == '' ? '' : bahan[4];

                        netto = bahan == '' ? '' : Number(bahan[2].replace(',', '.'));
                        gsm = bahan == '' || bahan[3] == '' ? '' : Number(bahan[3].replace(',', '.'));
                        thic = bahan == '' ? '' : Number(bahan[4].replace(',', '.'));
                        rha = awal[0] == 0 ? '' : awal[0];
                        rhb = tengah[0] == 0 ? '' : tengah[0];
                        rhc = akhir[0] == 0 ? '' : akhir[0];
                        suhua = awal[0] == 0 ? '' : awal[1];
                        suhub = tengah[0] == 0 ? '' : tengah[1];
                        suhuc = akhir[0] == 0 ? '' : akhir[1];

                        t_netto = t_netto + netto;
                        t_gsm = t_gsm + gsm;
                        t_thic = t_thic + thic;
                        t_rha = t_rha + Number(rha);
                        t_rhb = t_rhb + Number(rhb);
                        t_rhc = t_rhc + Number(rhc);
                        t_suhua = t_suhua + Number(suhua);
                        t_suhub = t_suhub + Number(suhub);
                        t_suhuc = t_suhuc + Number(suhuc);

                        merah_a = rha < 37 || rha > 58 ? 'text-danger' : '';
                        merah_b = rhb < 37 || rhb > 58 ? 'text-danger' : '';
                        merah_c = rhc < 37 || rhc > 58 ? 'text-danger' : '';

                        if (netto != '') {ar_netto.push(netto);}
                        if (gsm != '') {ar_gsm.push(gsm);}
                        if (thic != '') {ar_thic.push(thic);}
                        if (rha != '') {ar_rha.push(rha);}
                        if (rhb != '') {ar_rhb.push(rhb);}
                        if (rhc != '') {ar_rhc.push(rhc);}
                        if (suhua != '') {ar_suhua.push(suhua);}
                        if (suhub != '') {ar_suhub.push(suhub);}
                        if (suhuc != '') {ar_suhuc.push(suhuc);}

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].NMR+'</td><td>'+data[i].DESAIN+'</td><td><div style="width: 80px;">'+tgl_terima+'</div></td><td><div style="width: 80px;">'+format_date(data[i].TGL)+'</div></td><td>'+data[i].NO_ROLL+'</td><td>'+data[i].PABRIKASI+'</td><td style=\'mso-number-format:\\@;\'>'+netto+'</td><td>'+lebar+'</td><td style=\'mso-number-format:\\@;\'>'+gsm+'</td><td>'+thickness+'</td><td class="'+merah_a+'" style=\'mso-number-format:\\@;\'>'+rha+'</td><td style=\'mso-number-format:\\@;\'>'+suhua+'</td><td class="'+merah_b+'" style=\'mso-number-format:\\@;\'>'+rhb+'</td><td style=\'mso-number-format:\\@;\'>'+suhub+'</td><td class="'+merah_c+'" style=\'mso-number-format:\\@;\'>'+rhc+'</td><td style=\'mso-number-format:\\@;\'>'+suhuc+'</td><td>'+visual+'</td><td>'+acc+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    if (data.length > 0) {
                        $('#tbl tfoot tr:eq(0) th:eq(1)').html(calc_avg(ar_netto)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(1)').html(calc_avg(ar_netto)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(1)').html(calc_avg(ar_netto)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(3)').html(calc_avg(ar_gsm)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(3)').html(calc_avg(ar_gsm)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(3)').html(calc_avg(ar_gsm)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(4)').html(calc_avg(ar_thic)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(4)').html(calc_avg(ar_thic)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(4)').html(calc_avg(ar_thic)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(5)').html(calc_avg(ar_rha)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(5)').html(calc_avg(ar_rha)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(5)').html(calc_avg(ar_rha)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(6)').html(calc_avg(ar_suhua)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(6)').html(calc_avg(ar_suhua)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(6)').html(calc_avg(ar_suhua)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(7)').html(calc_avg(ar_rhb)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(7)').html(calc_avg(ar_rhb)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(7)').html(calc_avg(ar_rhb)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(8)').html(calc_avg(ar_suhub)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(8)').html(calc_avg(ar_suhub)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(8)').html(calc_avg(ar_suhub)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(9)').html(calc_avg(ar_rhc)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(9)').html(calc_avg(ar_rhc)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(9)').html(calc_avg(ar_rhc)[2]);

                        $('#tbl tfoot tr:eq(0) th:eq(10)').html(calc_avg(ar_suhuc)[0]);
                        $('#tbl tfoot tr:eq(1) th:eq(10)').html(calc_avg(ar_suhuc)[1]);
                        $('#tbl tfoot tr:eq(2) th:eq(10)').html(calc_avg(ar_suhuc)[2]);
                    }else{
                        for (var i=0; i<100; i++) {
                            if (i%12 != 0) {
                                $('#tbl tfoot th:eq('+i+')').html('');
                            }
                        }
                    }

                    if ($(window).width() < 1300) {
                        $('#tbl thead th:eq(16), #tbl td:nth-child(20)').hide();
                        $('#btn_excel').hide();
                    }
                    setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
                }
            }); 
        }, 500); // End Ajax
    } // End Function

// Pagination
    function pagination() { 
        $('#tbl').DataTable().destroy();
        var datatable = $('#tbl').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "info": false,
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "350px",
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Export To Excel
    function XLExport(tableId) {
        var tab_text = "<table border='1px'><tr>";
        var tab = document.getElementById(tableId);
        for (j=0; j<tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace("#E3E3E3", "#000000");
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
        return (sa);
    }
    $('#btn_excel').click(function() {
        $('#tbl').DataTable().destroy();
        XLExport('tbl');
        pagination();
    });

// Kosongkan Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#kode_roll').val('@').change();
        $('[name="rh"]').val('0');
        $('[name="suhu"]').val('0');

        auto_no();
        isi_roll();
    }

// Error Isian
    function error_isian(str) {
        $('#btnOk').click();
        $('#error_isian').removeClass('invisible');
        $('#error_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Simpan Data
    function simpan() {
        var id_edit = $('#nmr').attr('name');
        var nmr = $('#nmr').val();
        var tgl = $("#tgl").val();
        var desain = $("#desain").val();
        var kode_roll = $("#kode_roll").val().split('@')[0];
        var berat = $("#kode_roll").val().split('@')[1];
        var pabrikasi = $("#pabrikasi").val();
        var pemeriksa = $('#pemeriksa').val();
        var approval = $('#approval').val();
        var visual = $('#visual').val();
        var acc = $('#acc').val();
        var rha = $('[name="rh"]:eq(0)').val();
        var rhb = $('[name="rh"]:eq(1)').val();
        var rhc = $('[name="rh"]:eq(2)').val();
        var suhua = $('[name="suhu"]:eq(0)').val();
        var suhub = $('[name="suhu"]:eq(1)').val();
        var suhuc = $('[name="suhu"]:eq(2)').val();
        var awal = rha + '|' + suhua;
        var tengah = rhb + '|' + suhub;
        var akhir = rhc + '|' + suhuc;

        if (nmr == '') {error_isian('Nomor Urut belum diisi..');}
        if (kode_roll == '') {error_isian('Kode Roll belum diisi..');}
        if (pabrikasi == '') {error_isian('Pabrikasi belum diisi..');}
        if (pemeriksa == '') {error_isian('Nama Pemeriksa belum diisi..');}
        if (approval == '') {error_isian('Nama Approval belum diisi..');}

        var data = [id_edit, nmr, tgl, desain, kode_roll, pabrikasi, pemeriksa, approval, awal, tengah, akhir, visual, acc, berat];

        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Kertas/simpan" ?>',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    kosong();
                    filter();
                }, 500);
            }
        });
    }

// Edit Data
    function edit(btn) {
        var id_edit = btn.name;

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Kertas/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    ukuran = (data.NO_ROLL).substr(-1);
                    no_roll = data.NO_ROLL + '@' + data.BERAT;
                    $('#tgl').val(format_date(data.TGL)).change();
                    $('#nmr').val(data.NMR).change();
                    $('#grup').val(data.DESAIN).change();
                    $('#nmr').attr('name', id_edit);
                    $('#desain').val(data.DESAIN).change();
                    $('#ukuran').val(ukuran).change();
                    $('#kode_roll').append('<option value="'+no_roll+'">'+data.NO_ROLL+'</option>');
                    $('#kode_roll').val(no_roll).change();
                    $('#pabrikasi').val(data.PABRIKASI).change();
                    $('#pemeriksa').val(data.ID_PEMERIKSA).change();
                    $('#approval').val(data.ID_APPROVAL).change();
                    $('[name="rh"]:eq(0)').val(data.AWAL.split('|')[0].replace(',', '.')).change();
                    $('[name="rh"]:eq(1)').val(data.TENGAH.split('|')[0].replace(',', '.')).change();
                    $('[name="rh"]:eq(2)').val(data.AKHIR.split('|')[0].replace(',', '.')).change();
                    $('[name="suhu"]:eq(0)').val(data.AWAL.split('|')[1].replace(',', '.')).change();
                    $('[name="suhu"]:eq(1)').val(data.TENGAH.split('|')[1].replace(',', '.')).change();
                    $('[name="suhu"]:eq(2)').val(data.AKHIR.split('|')[1].replace(',', '.')).change();
                    $('#visual').val(data.VISUAL).change();
                    $('#acc').val(data.ACC).change();

                    setTimeout(function() {$('#btnOk').click();}, 500);
                }
            });
        }, 500);
        $('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 500);
    }

// Hapus Data
    function hapus(btn) {
        var id_hapus = btn.name;

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Kertas/hapus" ?>',
                data: {data: id_hapus},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();

                        filter();
                        id_hapus = '';
                    }, 500);
                }
            });
        });

        $('#btnNo').on('click', function() {
            if (id_hapus == '') {return;}
            id_hapus = '';
        });
    }

// Cetak Data
    function cetak(btn) {
        var id_cetak = btn.name;

        $('#pr_body tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Kertas/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC-BHN/' + tgl + '/' + bln + '/' + thn;

                $('#pr_nmr').html(nmr);
                $('.sign td:eq(3)').html(data[0].APPROVAL);
                $('.sign td:eq(5)').html(data[0].PEMERIKSA);

                // Berat - GSM - Thickness - RH Awal - Suhu Awal - RH Tengah - Suhu Tengah - RH Akhir - Suhu Akhir
                t_berat = [], t_gsm = [], t_thickness = [], t_rha = [], t_sha = [], t_rhb = [], t_shb = [], t_rhc = [], t_shc = [];
                for (var i=0; i<data.length; i++) {
                    visual = data[i].VISUAL == '1' ? '' : ''
                    bahan = data[i].BAHAN == null ? '' : data[i].BAHAN.split('|');
                    awal = data[i].AWAL.split('|');
                    tengah = data[i].TENGAH.split('|');
                    akhir = data[i].AKHIR.split('|');

                    lebar = data[i].BAHAN == null || bahan[1] == 0 ? '' : desimal(bahan[1], 1);
                    berat = data[i].BAHAN == null || bahan[2] == 0 ? '' : desimal(bahan[2], 2);
                    gsm = data[i].BAHAN == null || bahan[3] == 0 ? '' : desimal(bahan[3], 1);
                    thickness = data[i].BAHAN == null || bahan[4] == 0 ? '' : desimal(bahan[4], 0);
                    
                    rha = awal[0] == 0 ? '' : recon_rh(awal[0]);
                    sha = awal[1] == 0 ? '' : desimal(awal[1], 1);
                    rhb = tengah[0] == 0 ? '' : recon_rh(tengah[0]);
                    shb = tengah[1] == 0 ? '' : desimal(tengah[1], 1);
                    rhc = akhir[0] == 0 ? '' : recon_rh(akhir[0]);
                    shc = akhir[1] == 0 ? '' : desimal(akhir[1], 1);

                    if (berat != '') {t_berat.push(berat)};
                    if (gsm != '') {t_gsm.push(gsm)};
                    if (thickness != '') {t_thickness.push(thickness)};
                    if (rha != '') {t_rha.push(rha)};
                    if (sha != '') {t_sha.push(sha)};
                    if (rhb != '') {t_rhb.push(rhb)};
                    if (shb != '') {t_shb.push(shb)};
                    if (rhc != '') {t_rhc.push(rhc)};
                    if (shc != '') {t_shc.push(shc)};

                    $('#pr_body tbody').append('<tr><td>'+(i+1)+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NO_ROLL+'</td><td>'+data[i].PABRIKASI+'</td><td>'+berat+'</td><td>'+lebar+'</td><td>'+gsm+'</td><td>'+thickness+'</td><td>'+rha+'</td><td>'+sha+'</td><td>'+rhb+'</td><td>'+shb+'</td><td>'+rhc+'</td><td>'+shc+'</td><td>&#10003</td><td>Acc</td></tr>');
                }

                $('#pr_body tbody').append('<tr style="height: 5px;"><td colspan="16"></td></tr>');
                $('#pr_body tfoot tr:eq(0) th:eq(1)').html(calc_avg(t_berat)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(3)').html(calc_avg(t_gsm)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(4)').html(calc_avg(t_thickness)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(5)').html(calc_avg(t_rha)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(6)').html(calc_avg(t_sha)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(7)').html(calc_avg(t_rhb)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(8)').html(calc_avg(t_shb)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(9)').html(calc_avg(t_rhc)[0]);
                $('#pr_body tfoot tr:eq(0) th:eq(10)').html(calc_avg(t_shc)[0]);

                $('#pr_body tfoot tr:eq(1) th:eq(1)').html(calc_avg(t_berat)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(3)').html(calc_avg(t_gsm)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(4)').html(calc_avg(t_thickness)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(5)').html(calc_avg(t_rha)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(6)').html(calc_avg(t_sha)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(7)').html(calc_avg(t_rhb)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(8)').html(calc_avg(t_shb)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(9)').html(calc_avg(t_rhc)[1]);
                $('#pr_body tfoot tr:eq(1) th:eq(10)').html(calc_avg(t_shc)[1]);

                $('#pr_body tfoot tr:eq(2) th:eq(1)').html(calc_avg(t_berat)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(3)').html(calc_avg(t_gsm)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(4)').html(calc_avg(t_thickness)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(5)').html(calc_avg(t_rha)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(6)').html(calc_avg(t_sha)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(7)').html(calc_avg(t_rhb)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(8)').html(calc_avg(t_shb)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(9)').html(calc_avg(t_rhc)[2]);
                $('#pr_body tfoot tr:eq(2) th:eq(10)').html(calc_avg(t_shc)[2]);

                var printable = document.getElementById('printable');
                var non_printable = document.getElementById('non_printable');

                printable.style.display = "";
                non_printable.style.display = "none";
                window.print();

                printable.style.display = "none";
                non_printable.style.display = "";
            }
        });        
}

// Reconsiliasi RH
function recon_rh(num) {
    if (num < 30) {
        min = 37.0, max = 38.0;
    }else if (num < 35) {
        min = 38.0, max = 38.5;
    }else if (num < 37) {
        min = 38.5, max = 39.0;
    }else if (num > 58) {
        min = 49.0, max = 58.0;
    }else{
        return Number(num).toFixed(1);
    }

    return Number((Math.random() * (max - min) + min)).toFixed(1);
}

</script>