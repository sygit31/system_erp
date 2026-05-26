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
            size: portrait;
        }

        html, body {
            width: 210mm; height: 330mm;
        }

        .tbl_print td {
            height: 30px;
            vertical-align: middle;
            padding-left: 5px;
        }

        .tbl_print thead td, .tbl_print tbody td, .tbl_print tfoot td {
            border: 1px solid #6C6C6C;
        }
    }

</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Pemeriksaan RH</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-md-6"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Desain</th>
                                <td>
                                    <?php $years = range(date('Y', strtotime('-1 years')), date('Y', strtotime('+1 years'))); ?>
                                    <select class="select_min" id="desain" onchange="isi_rim()" style="width: 100%;">
                                        <?php foreach ($years as $dt) { ?>
                                            <option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal Kirim</th>
                                <td>
                                    <input id="tgl" type="text" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Nomor Rim</th>
                                <td>
                                    <select class="select" id="rim" name="" style="width: 100%;">
                                        <option value="">Pilih..</option>                                      
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <table width="100%">
                            <tr>
                                <th width="40%">Seri</th>
                                <td>
                                    <input id="seri" type="text" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>RH</th>
                                <td>
                                    <input type="number" class="numbers text-left pl-3" id="rh" step="0.1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Suhu</th>
                                <td>
                                    <input type="number" class="numbers text-left pl-3" id="suhu" step="0.1" lang="en-US">
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
                    <b><font color="White" id="headerinput">Laporan RH Kiriman</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
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
                                        <th width="35%" class="filter">Kode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
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
                                            <input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari kode Rim" style="width: 100%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <table id="tbl_excel" hidden></table>
                            <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th width="5%">No.</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="20%">Nomor Rim</th>
                                        <th>Pallet</th>
                                        <th>Seri</th>
                                        <th>RH</th>
                                        <th>Suhu</th>
                                        <th width="5%">Cetak</th>
                                        <th width="5%">Edit</th>
                                        <th width="5%">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="5" class="text-left pl-3">Average</th><th></th><th></th><th colspan="3"></th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-left pl-3">Max</th><th></th><th></th><th colspan="3"></th></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-left pl-3">Min</th><th></th><th></th><th colspan="3"></th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Data RH Kiriman')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Data Kiriman</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table class="tbl_filter" style="width: 900px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="15%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="15%" class="filter">Seri</th>
                                        <th></th>
                                        <th width="22%" class="filter">Nomor SP</th>
                                        <th></th>
                                        <th width="20%" class="filter">Pallet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="p_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter_p()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="p_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter_p()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="p_desain" onchange="filter_p()" style="width: 100%;">
                                                <?php foreach($desain->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['DESAIN']; ?></option>               
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="p_seri" onchange="filter_p()" style="width: 100%;">
                                                <option value="All">All..</option>              
                                                <?php foreach($seri->result_array() as $dt) { ?>
                                                    <?php $seri = $dt['SERI'] == '1' ? 'I' : ($seri = $dt['SERI'] == '2' ? 'II' : ($seri = $dt['SERI'] == '3' ? 'III' : 'MMEA')); ?>
                                                    <option value="<?php echo $dt['SERI']; ?>"><?php echo $seri; ?></option>               
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="cari" id="p_sp" autocomplete="off" onchange="filter_p()" placeholder="Cari Nomor SP" style="width: 100%;">
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="cari" id="p_pallet" autocomplete="off" onchange="filter_p()" placeholder="Cari kode Pallet" style="width: 100%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 table-responsive" style="width: 100%; max-width: 1000px; font-size: 13px;">
                            <table id="tbl_p" class="table table-bordered table-striped" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th width="8%">No.</th>
                                        <th>Tanggal</th>
                                        <th>Nomor SP</th>
                                        <th width="12%">Pallet</th>
                                        <th>Nomor SPP</th>
                                        <th width="12%">Qty</th>
                                        <th width="12%">Seri</th>
                                        <th width="8%">View</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr align="center">
                                        <th colspan="5">Total</th>
                                        <th></th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-success" onclick="excel('tbl_p', 'Data Pallet Kiriman')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
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

<!-- Modal View Kode Rim -->
<div class="modal fade" id="modal_rim">
    <div class="modal-dialog" style="max-width: 700px;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">Data Pallet Kiriman</h4></b>
            </div>
            <div class="card-body card m-3">
                <table id="tbl_rim" class="table table-bordered table-striped" style="width: 100%;">
                    <thead class="text-center">
                        <tr>
                            <th width="20%">No.</th>
                            <th width="35%">Nomor Pallet</th>
                            <th>Nomor RIM</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="card-footer rounded m-1 text-center">
                <button style="width: 150px;" type="button" class="btn btn-secondary" title="Kembali" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 13px;">
    <h4 align="center" style="margin-top: -1mm;">Data Pemeriksaan RH (%) Kertas Banderol</h4>
    <h5><div id="desain_print">Desain : 2025</div></h5>
    <h5><div id="tgl_print">Kiriman Tanggal : 01 Januari 2025</div></h5>
    <div class="row">
        <div class="col-sm-6">
            <table class="mt-2 tbl_print" width="100%" style="font-size: 16px;">
                <thead style="text-align: center; font-weight: bold;">
                    <tr style="height: 50px;">
                        <td>No.</td>
                        <td>Seri</td>
                        <td>Kode Pallet</td>
                        <td>Barcode</td>
                        <td>RH (%)</td>
                        <td>Suhu (&deg;C)</td>
                    </tr>
                </thead>
                <tbody align="center"></tbody>
                <tfoot>
                    <tr align="center">
                        <td colspan="4"  align="left">Average</td>
                        <td></td><td></td>
                    </tr>
                    <tr align="center">
                        <td colspan="4"  align="left">Max</td>
                        <td></td><td></td>
                    </tr>
                    <tr align="center">
                        <td colspan="4"  align="left">Min</td>
                        <td></td><td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="input-group input_ttd mt-4">
                <table class="table-bordered mt-1 mr-5" style="width: 500px; font-size: 16px;">
                    <tr align="center" style="height: 10mm;">
                        <td width="50%">Hormat kami,</td>
                        <td width="50%">Mengetahui,</td>
                    </tr>
                    <tr style="height: 30mm;">
                        <td>
                            <div style="height: 40px; vertical-align: bottom; ">
                                <div style="height: 30px;"></div>
                                <div id="pengawas_qc" align="center" style="height: 10px;">( ... Syaiful Ichsan ... )</div>
                                <div align="center" style="margin-top: 10px;">Pengawas QC</div>
                            </div>
                        </td>
                        <td>
                            <div style="height: 40px;">
                                <div style="height: 30px;"></div>
                                <div id="kabid_qc" align="center" style="height: 10px;">( ....... Ali Nafi ...... )</div>
                                <div align="center" style="margin-top: 10px;">Kabid QC</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <table class="mt-2 tbl_print" width="100%" style="font-size: 16px;">
                <thead style="text-align: center; font-weight: bold;">
                    <tr style="height: 50px;">
                        <td>No.</td>
                        <td>Seri</td>
                        <td>Kode Pallet</td>
                        <td>Barcode</td>
                        <td>RH (%)</td>
                        <td>Suhu (&deg;C)</td>
                    </tr>
                </thead>
                <tbody align="center"></tbody>
                <tfoot>
                    <tr align="center">
                        <td colspan="4"  align="left">Average</td>
                        <td></td><td></td>
                    </tr>
                    <tr align="center">
                        <td colspan="4"  align="left">Max</td>
                        <td></td><td></td>
                    </tr>
                    <tr align="center">
                        <td colspan="4"  align="left">Min</td>
                        <td></td><td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="input-group input_ttd mt-4">
                <table class="table-bordered mt-1 mr-5" style="width: 500px; font-size: 16px;">
                    <tr align="center" style="height: 10mm;">
                        <td width="50%">Hormat kami,</td>
                        <td width="50%">Mengetahui,</td>
                    </tr>
                    <tr style="height: 30mm;">
                        <td>
                            <div style="height: 40px; vertical-align: bottom; ">
                                <div style="height: 30px;"></div>
                                <div id="pengawas_qc" align="center" style="height: 10px;">( ... Syaiful Ichsan ... )</div>
                                <div align="center" style="margin-top: 10px;">Pengawas QC</div>
                            </div>
                        </td>
                        <td>
                            <div style="height: 40px;">
                                <div style="height: 30px;"></div>
                                <div id="kabid_qc" align="center" style="height: 10px;">( ....... Ali Nafi ...... )</div>
                                <div align="center" style="margin-top: 10px;">Kabid QC</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
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
<script src="<?php echo base_url(); ?>assets/js/script.js?=4"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() < 960) {$('.fa-bars:eq(0)').click();}

        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        isi_rim();
        filter();
        filter_p();
    });

// Isi KK Berdasarkan Desain
    function isi_rim() {
        var desain = $('#desain').val();

        $('#rim option:gt(0)').remove();
        $.ajax({
            async: false,
            type: 'POST',
            data: {data: desain},
            url: '<?php echo base_url()."index.php/qc/Rh_fin/isi_rim" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    $('#rim').append('<option value="'+data[i].KODE_RIM + '@' + data[i].SERI+'">'+data[i].KODE_RIM+'</option>');
                }
            }
        });
    }

// Isi Seri Berdasarkan RIM
    $('#rim').change(function() {
        var seri = $('#rim').val() == '' ? '' : $('#rim').val().split('@')[1];

        $('#seri').val(seri);
    });

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var kode = $('#cari').val();
        var data = [tgl1, tgl2, desain, kode];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_fin/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    ar_rh = [], ar_suhu = [];
                    for (var i=0; i<data.length; i++) {
                        hidden = data[i].KIRIM == null ? 'hidden' :'';
                        pallet = data[i].PALLET == null ? '' : data[i].PALLET;

                        $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+data[i].RIM+'</td><td align="center">'+pallet+'</td><td align="center">'+data[i].SERI+'</td><td align="center" style=\'mso-number-format:\\@;\'>'+format_number(data[i].RH)+'</td><td align="center" style=\'mso-number-format:\\@;\'>'+format_number(data[i].SUHU)+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)" '+hidden+'><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)" '+hidden+'><i class="fa fa-trash"></i></button></td></tr>');

                        ar_rh.push(data[i].RH);
                        ar_suhu.push(data[i].SUHU);
                    }

                    $('#tbl tfoot tr:eq(0) th:eq(1)').html(calc_avg(ar_rh)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(1)').html(calc_avg(ar_rh)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(1)').html(calc_avg(ar_rh)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(2)').html(calc_avg(ar_suhu)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(2)').html(calc_avg(ar_suhu)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(2)').html(calc_avg(ar_suhu)[2]);

                    setTimeout(function() {$('#btnOk').click(); page('tbl');}, 500);
                }
            }); 
        }, 500);
    }

// Kosongkan Isian
    function kosong() {
        $('#rim').attr('name', '');
        $('#rim').val('').change();
        $('#rh').val('');
        $('#suhu').val('');
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
        var id_edit = $('#rim').attr('name');
        var desain = $('#desain').val();
        var tgl = $("#tgl").val();
        var rim = $("#rim").val().split('@')[0];
        var seri = $("#seri").val();
        var rh = $("#rh").val();
        var suhu = $("#suhu").val();

        if (rim == '') {error_isian('Nomor Rim belum diisi..');}
        if (seri == '') {error_isian('Seri belum diisi..');}
        if (rh == '' || rh == '0') {error_isian('RH belum diisi..');}
        if (suhu == '' || suhu == '0') {error_isian('Suhu belum diisi..');}

        var data = [id_edit, desain, tgl, rim, seri, rh, suhu];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_fin/simpan" ?>',
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        kosong();
                        filter();
                    }, 500);
                }
            });
        }, 500);
    }

// Edit Data
    function edit(btn) {
        var id_edit = btn.name;

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_fin/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#rim').attr('name', id_edit);
                    $('#desain').val(data.DESAIN).change();
                    $("#tgl").val(format_date(data.TGL));
                    $('#rim').val(data.RIM + '@' + data.SERI).change();
                    $("#rh").val(data.RH);
                    $("#suhu").val(data.SUHU);

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
                url: '<?php echo base_url()."index.php/qc/Rh_fin/hapus" ?>',
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
        var numbers_1 = [], numbers_2 = [], numbers_3 = [], numbers_4 = [];

        $('.tbl_print tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Rh_fin/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                urut_1 = '1', urut_3 = '1';
                ar_rh_1 = [], ar_suhu_1 = [], ar_rh_3 = [], ar_suhu_3 = [];

                $('#desain_print').html('Desain : ' + data[0].DESAIN);
                $('#tgl_print').html('Kiriman Tanggal : ' + format_date(data[0].TGL));
                for (var i=0; i<data.length; i++) {
                    pallet = data[i].PALLET == null ? '' : data[i].PALLET;
                    seri = data[i].SERI;
                    rh = recon_rh(desimal(data[i].RH));
                    tbl = data[i].SERI == '1' ? '0' : '1';
                    urut = data[i].SERI == '1' ? urut_1++ : urut_3++;

                    $('.tbl_print:eq('+tbl+') tbody').append('<tr><td align="center">'+urut+'</td><td align="center">'+data[i].SERI+'</td><td align="center">'+pallet+'</td><td align="center">'+data[i].RIM+'</td><td align="center">'+rh+'</td><td align="center">'+data[i].SUHU+'</td></tr>');

                    if (seri == '1') {
                        ar_rh_1.push(rh), ar_suhu_1.push(data[i].SUHU);
                    }else{
                        ar_rh_3.push(rh), ar_suhu_3.push(data[i].SUHU);
                    }
                }

                $('.input_ttd').show();
                if (urut_1 > urut_3) {$('.input_ttd:eq(0)').hide();}else{$('.input_ttd:eq(1)').hide();}

                $('.tbl_print tbody').append('<tr style="height: 10px;"><th colspan="5"></th></tr>');
                $('.tbl_print:eq(0) tfoot tr:eq(0) td:eq(1)').html(calc_avg(ar_rh_1)[0]);
                $('.tbl_print:eq(0) tfoot tr:eq(1) td:eq(1)').html(calc_avg(ar_rh_1)[1]);
                $('.tbl_print:eq(0) tfoot tr:eq(2) td:eq(1)').html(calc_avg(ar_rh_1)[2]);
                $('.tbl_print:eq(0) tfoot tr:eq(0) td:eq(2)').html(calc_avg(ar_suhu_1)[0]);
                $('.tbl_print:eq(0) tfoot tr:eq(1) td:eq(2)').html(calc_avg(ar_suhu_1)[1]);
                $('.tbl_print:eq(0) tfoot tr:eq(2) td:eq(2)').html(calc_avg(ar_suhu_1)[2]);

                $('.tbl_print:eq(1) tfoot tr:eq(0) td:eq(1)').html(calc_avg(ar_rh_3)[0]);
                $('.tbl_print:eq(1) tfoot tr:eq(1) td:eq(1)').html(calc_avg(ar_rh_3)[1]);
                $('.tbl_print:eq(1) tfoot tr:eq(2) td:eq(1)').html(calc_avg(ar_rh_3)[2]);
                $('.tbl_print:eq(1) tfoot tr:eq(0) td:eq(2)').html(calc_avg(ar_suhu_3)[0]);
                $('.tbl_print:eq(1) tfoot tr:eq(1) td:eq(2)').html(calc_avg(ar_suhu_3)[1]);
                $('.tbl_print:eq(1) tfoot tr:eq(2) td:eq(2)').html(calc_avg(ar_suhu_3)[2]);

                var printable = document.getElementById('printable');
                var non_printable = document.getElementById('non_printable');

                printable.style.display = "";
                non_printable.style.display = "none";

                window.scrollTo({top: 0,left: 0});
                window.print();

                printable.style.display = "none";
                non_printable.style.display = "";
            }
        });        
    }

// Cetak Data
    function cetak2(btn) {
        var id_cetak = btn.name;
        var numbers_1 = [], numbers_2 = [], numbers_3 = [], numbers_4 = [];

        $('.tbl_print tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Rh_fin/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                urut_1 = '1', urut_3 = '1';
                ar_rh_1 = [], ar_suhu_1 = [], ar_rh_3 = [], ar_suhu_3 = [];

                $('#desain_print').html('Desain : ' + data[0].DESAIN);
                $('#tgl_print').html('Kiriman Tanggal : ' + format_date(data[0].TGL));
                for (var i=0; i<data.length; i++) {
                    pallet = data[i].PALLET == null ? '' : data[i].PALLET;
                    seri = data[i].SERI;
                    rh = recon_rh(desimal(data[i].RH));
                    tbl = data[i].SERI == '1' ? '0' : '1';
                    urut = data[i].SERI == '1' ? urut_1++ : urut_3++;

                    $('.tbl_print:eq('+tbl+') tbody').append('<tr><td align="center">'+urut+'</td><td align="center">'+data[i].SERI+'</td><td align="center">'+pallet+'</td><td align="center">'+data[i].RIM+'</td><td align="center">'+rh+'</td><td align="center">'+data[i].SUHU+'</td></tr>');

                    if (seri == '1') {
                        ar_rh_1.push(rh), ar_suhu_1.push(data[i].SUHU);
                    }else{
                        ar_rh_3.push(rh), ar_suhu_3.push(data[i].SUHU);
                    }
                }

                $('.input_ttd').show();
                if (urut_1 > urut_3) {$('.input_ttd:eq(0)').hide();}else{$('.input_ttd:eq(1)').hide();}

                $('.tbl_print tbody').append('<tr style="height: 10px;"><th colspan="5"></th></tr>');
                $('.tbl_print:eq(0) tfoot tr:eq(0) td:eq(1)').html(calc_avg(ar_rh_1)[0]);
                $('.tbl_print:eq(0) tfoot tr:eq(1) td:eq(1)').html(calc_avg(ar_rh_1)[1]);
                $('.tbl_print:eq(0) tfoot tr:eq(2) td:eq(1)').html(calc_avg(ar_rh_1)[2]);
                $('.tbl_print:eq(0) tfoot tr:eq(0) td:eq(2)').html(calc_avg(ar_suhu_1)[0]);
                $('.tbl_print:eq(0) tfoot tr:eq(1) td:eq(2)').html(calc_avg(ar_suhu_1)[1]);
                $('.tbl_print:eq(0) tfoot tr:eq(2) td:eq(2)').html(calc_avg(ar_suhu_1)[2]);

                $('.tbl_print:eq(1) tfoot tr:eq(0) td:eq(1)').html(calc_avg(ar_rh_3)[0]);
                $('.tbl_print:eq(1) tfoot tr:eq(1) td:eq(1)').html(calc_avg(ar_rh_3)[1]);
                $('.tbl_print:eq(1) tfoot tr:eq(2) td:eq(1)').html(calc_avg(ar_rh_3)[2]);
                $('.tbl_print:eq(1) tfoot tr:eq(0) td:eq(2)').html(calc_avg(ar_suhu_3)[0]);
                $('.tbl_print:eq(1) tfoot tr:eq(1) td:eq(2)').html(calc_avg(ar_suhu_3)[1]);
                $('.tbl_print:eq(1) tfoot tr:eq(2) td:eq(2)').html(calc_avg(ar_suhu_3)[2]);

                var printable = document.getElementById('printable');
                var non_printable = document.getElementById('non_printable');

                printable.style.display = "";
                non_printable.style.display = "none";

                window.scrollTo({top: 0,left: 0});
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

// Filter Data Pallet
    function filter_p() {
        var tgl1 = $('#p_tgl1').val();
        var tgl2 = $('#p_tgl2').val();
        var desain = $('#p_desain').val();
        var seri = $('#p_seri').val();
        var sp = $('#p_sp').val();
        var pallet = $('#p_pallet').val();
        var data = [tgl1, tgl2, desain, seri, sp, pallet];

        $('#tbl_p').DataTable().destroy();
        $('#tbl_p tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_fin/filter_p" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    t_lembar = 0;
                    for (var i=0; i<data.length; i++) {
                        seri = data[i].SERI == '1' ? 'I' : (data[i].SERI == '2' ? 'II' : (data[i].SERI == '3' ? 'III' : 'MMEA')); 
                        t_lembar = t_lembar + Number(data[i].LEMBAR);

                        $('#tbl_p tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(data[i].SHIPMENT_DATE)+'</td><td align="center">'+data[i].NO_SP+'</td><td align="center">'+data[i].KODE_PALETTE+'</td><td align="center">'+data[i].NOMOR_SOP+'</td><td align="center">'+format_number(data[i].LEMBAR)+'</td><td align="center">'+seri+'</td><td align="center"><button type="button" class="btn btn-block btn-secondary btn-sm" style="width: 50px;" name="'+(data[i].KODE_PALETTE+'@'+data[i].TAHUN_PALETTE+'@'+data[i].NOMOR_SOP)+'" title="View Rim" onclick="view(this)" data-toggle="modal" data-target="#modal_rim" data-backdrop="static" data-keyboard="false"><i class="fa fa-book"></i></button></td></tr>');
                    }
                    $('#tbl_p tfoot th:eq(1)').html(format_number(t_lembar));

                    setTimeout(function() {$('#btnOk').click(); page('tbl_p');}, 500);
                }
            }); 
        }, 500);
    }

// View Nomor RIM
    function view(btn) {
        var kode_palette = btn.name.split('@')[0];
        var tahun_palette = btn.name.split('@')[1];
        var nomor_sop = btn.name.split('@')[2];
        var data = [kode_palette, tahun_palette, nomor_sop];

        $('#tbl_rim').DataTable().destroy();
        $('#tbl_rim tbody tr').remove();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Rh_fin/view" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    $('#tbl_rim tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+kode_palette+'</td><td align="center">'+data[i].KODE_RIM+'</td></tr>');
                }

                setTimeout(function() {page('tbl_rim');}, 500);
            }
        }); 
    }

</script>