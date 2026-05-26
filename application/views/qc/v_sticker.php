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

        #tbl_print td {
            height: 20px;
            vertical-align: middle;
            padding-left: 5px;
        }

        #tbl_print thead td, #tbl_print tbody td, #tbl_print tfoot td {
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
                    <b><font color="White"><div>Pengujian Sticker</div></font></b>
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
                                    <div class="d-flex justify-content-between text-center">
                                        <input type="number" id="nmr" name="" class="form-control" value="0000" maxlength="4" onfocusout="isi_nomor(this, 4)" autocomplete="off">
                                        <div class="m-2"></div>
                                        <?php $years = range(date('Y', strtotime('-1 years')), date('Y', strtotime('+1 years'))); ?>
                                        <select class="select_min" id="desain" onchange="auto_no()" style="width: 100%;">
                                            <?php foreach ($years as $dt) { ?>
                                                <option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <input id="tgl" type="text" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                        <div class="m-2"></div>
                                        <input type="time" class="form-control" id="jam" value="07:00" style="width: 70%;">
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode Kertas</th>
                                <td>
                                    <input type="text" class="form-control text-uppercase" id="kode_kertas" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Ukuran</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Lebar<input type="number" id="lebar_kertas" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info">Panjang<input type="number" id="panjang_kertas" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pemeriksa</th>
                                <td>
                                    <select class="select_min" id="pemeriksa" style="width: 100%;">
                                        <?php foreach ($pemeriksa->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>" <?php if ($dt['ID'] == '293') {echo 'selected';} ?>><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Approval</th>
                                <td>
                                    <select class="select_min" id="approval" style="width: 100%;">
                                        <?php foreach ($approval->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Operator</th>
                                <td>
                                    <select class="select_min" id="operator" style="width: 100%;">
                                        <?php foreach ($operator->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%">
                            <tr>
                                <th width="40%">Kertas Banderol</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">GSM<input type="number" id="gsm_kertas" class="numbers nums text-center" value="0" style="width: 95%;" onchange="isi_gsm_lem()" step="0.1" lang="en-US"></div>
                                        <div class="text-info ml-2 mr-2">Thickness<input type="number" id="thickness_kertas" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Hotmelt</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Jenis<input type="text" class="form-control text-uppercase text-center" id="jenis_lem" autocomplete="off"></div>
                                        <div class="text-info ml-2 mr-2">GSM<input type="text" id="gsm_lem" class="form-control text-center" value="0" style="width: 95%;" readonly></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>SRP</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">GSM<input type="number" id="gsm_srp" class="numbers nums text-center" value="0" style="width: 95%;" onchange="isi_gsm_lem()" step="0.1" lang="en-US"></div>
                                        <div class="text-info ml-2 mr-2">Thickness<input type="number" id="thickness_srp" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Sticker</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="d-flex justify-content-between text-center">
                                            <div class="text-info">GSM<input type="number" id="gsm_total" class="numbers nums text-center" onchange="isi_gsm_lem()" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                            <div class="text-info ml-2 mr-2">Thickness<input type="number" id="thickness_total" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                            <div class="text-info ml-2 mr-2">Daya Rekat<input type="number" id="daya_rekat" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">ACC<input type="number" id="acc_meter" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info ml-2 mr-2">Reject<input type="number" id="reject_meter" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Remark</th>
                                <td>
                                    <textarea id="remark" class="form-control" rows="2" style="width: 100%;" maxlength="100" autocomplete="off"></textarea>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" id="simpan" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Sticker</font></b>
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
                                        <th width="43%" class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="25%" class="filter">Desain</th>
                                        <th></th>
                                        <th class="filter">Cari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_desain" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach($desain->result_array() as $dt) { ?>
                                                    <option selected><?php echo $dt['DESAIN']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari Remark.." style="width: 100%;">
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
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Desain</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">Nomor Urut</th>
                                        <th rowspan="2">Jam</th>
                                        <th rowspan="2">Kode Roll</th>
                                        <th colspan="4">KERTAS BANDEROL</th>
                                        <th colspan="3">HOTMELT</th>
                                        <th colspan="2">SRP</th>
                                        <th colspan="3">KERTAS STICKER</th>
                                        <th colspan="2">KETERANGAN</th>
                                        <th rowspan="2">Operator</th>
                                        <th rowspan="2">Pemeriksa</th>
                                        <th rowspan="2">Remark</th>
                                        <th rowspan="2">Cetak</th>
                                        <th rowspan="2">Edit</th>
                                        <th rowspan="2">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th>Lebar<br>(cm)</th>
                                        <th>Panjang<br>(meter)</th>
                                        <th>Gramature<br>(gsm)</th>
                                        <th>Thickness<br>(micron)</th>
                                        <th>Jenis Hotmelt</th>
                                        <th>Gramature<br>(gsm)</th> 
                                        <th>Thickness<br>(micron)</th>
                                        <th>Gramature<br>(gsm)</th> 
                                        <th>Thickness<br>(micron)</th>
                                        <th>Ttl Gramature<br>(gsm)</th> 
                                        <th>Ttl Thickness<br>(micron)</th> 
                                        <th>Daya Rekat<br>(kgf/15 mm)</th> 
                                        <th>Acc<br>(meter)</th>
                                        <th>Reject<br>(meter)</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Average</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Max</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Min</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer btn_excel">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pengujian Sticker')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
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

<div id="printable" style="display: none; overflow: hidden; font-size: 13px; margin-left: 27mm;">
    <div style="width: 200px;  margin-bottom: 15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 10mm; width: auto;">
    </div>

    <h6 align="center" style="margin-top: -13mm;">LAPORAN PEMERIKSAAN PROSES STICKER MMEA</h6>
    <h6 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 000/PNP-HLG/QC-STICKER/01/I/2025</div></h6>
    <table id="tbl_print" class="mt-2" style="width: 100%; font-size: 12px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="2">No.</td>
                <td rowspan="2">Jam</td>
                <td rowspan="2">Kode Roll</td>
                <td colspan="2">UKURAN</td>
                <td colspan="2">KERTAS BANDEROL</td>
                <td colspan="2">HOTMELT</td>
                <td colspan="2">SRP</td>
                <td colspan="3">KERTAS STICKER</td>
                <td colspan="2">Keterangan</td>
            </tr>
            <tr>
                <td>Lebar<br>(cm)</td>
                <td>Panjang<br>(meter)</td>
                <td>GSM</td>
                <td>Thickness<br>(mikron)</td>
                <td>Jenis-Hotmelt</td>
                <td>GSM</td>
                <td>GSM</td>
                <td>Thickness<br>(mikron)</td>
                <td>Ttl GSM</td>
                <td>Ttl Thick.<br>(mikron)</td>
                <td>Daya Rekat<br>(kgf/15 mm)</td>
                <td>Acc<br>(meter)</td>
                <td>Reject<br>(meter)</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot>
            <tr style="height: 25px; font-size: 17;">
                <td colspan="22" style="vertical-align: top;"><b>Remark :</b></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 10px; margin-bottom: 10px;">F-SMT-QC2-043 Rev. 03</div>
    <div class="row">
        <div class="col-4" style="margin-top: -20px; font-size: 10px;">
            <div>Spesifikasi Standar Grammature (gsm) :</div>
            <div>1. GSM Total : 160 - 170 gsm</div>
            <div>2. GSM Kertas : 57 - 63 gsm</div>
            <div>3. Lem : 18 - 22 gsm</div>
            <div>4. SRP Yellow : 82 - 88 gsm</div>
            <div>5. Daya Rekat : >= 0.77 kgf/15 mm</div>

            <div class="mt-2">CC :</div>
            <div>1. Yth. Bag. Emboss & Converting</div>
            <div>2. File</div>
        </div>
        <div class="col-1"></div>
        <div class="col-7">
            <table class="table-borderless mt-1 mr-5" style="width: 100%; height: 90px;">
                <tr style="line-height: 5px;">
                    <td>Mengetahui,</td>
                    <td width="33%">Pemeriksa,</td>
                    <td width="33%">Operator,</td>
                </tr>
                <tr>
                    <td></td>
                    <td>1.</td>
                    <td>2.</td>
                </tr>
                <tr style="vertical-align: bottom;">
                    <td>
                        <div id="p_approval">( ...................... )</div>
                        <div>Kabag / Kabid QC</div>
                    </td>
                    <td>
                        <div id="p_pemeriksa">( ...................... )</div>
                        <div>QC Emboss-Conv</div>
                    </td>
                    <td>
                        <div id="p_operator">( ...................... )</div>
                        <div>Mesin Sticker</div>
                    </td>
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
<script src="<?php echo base_url(); ?>assets/js/script.js?=4"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() < 1200) {$('.fa-bars:eq(0)').click();}

        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        auto_no();
        filter();
    });

// Isi GSM Total
    function isi_gsm_lem() {
        var gsm_kertas = angka($('#gsm_kertas').val());
        var gsm_srp = angka($('#gsm_srp').val());
        var gsm_total = angka($('#gsm_total').val());
        var gsm_lem = gsm_total - gsm_kertas - gsm_srp;

        $('#gsm_lem').val(gsm_lem.toFixed(1));
    }

// Auto Nomor
    function auto_no() {
        var id_edit =$('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var desain = $('#desain').val();
        var data = [id_edit, tgl, desain];

        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Sticker/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var cari = huruf($('#cari').val());
        var data = [tgl1, tgl2, desain, cari];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Sticker/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    ar_panjang = [], ar_gsm_k = [], ar_thickness_k = [], ar_gsm_h = [], ar_thickness_h = [], ar_gsm_s = [], ar_thickness_s = [], ar_gsm_t = [], ar_thickness_t = [], ar_rekat = [];
                    for (var i=0; i<data.length; i++) {
                        remark = data[i].REMARK == null ? '' : data[i].REMARK;

                        ar_panjang.push(desimal(data[i].PANJANG_KERTAS));
                        ar_gsm_k.push(desimal(data[i].GSM_KERTAS, 1));
                        ar_thickness_k.push(desimal(data[i].THICKNESS_KERTAS));
                        ar_gsm_h.push(desimal(data[i].GSM_LEM, 1));
                        ar_thickness_h.push(desimal(data[i].THICKNESS_LEM));
                        ar_gsm_s.push(desimal(data[i].GSM_SRP, 1));
                        ar_thickness_s.push(desimal(data[i].THICKNESS_SRP));
                        ar_gsm_t.push(desimal(data[i].GSM_TOTAL, 1));
                        ar_thickness_t.push(desimal(data[i].THICKNESS_TOTAL));
                        ar_rekat.push(desimal(data[i].DAYA_REKAT, 2));

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].DESAIN+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>'+data[i].JAM+'</td><td>'+data[i].KODE_KERTAS+'</td><td>'+data[i].LEBAR_KERTAS+'</td><td>'+format_number(data[i].PANJANG_KERTAS)+'</td><td>'+desimal(data[i].GSM_KERTAS, 1)+'</td><td>'+data[i].THICKNESS_KERTAS+'</td><td>'+data[i].JENIS_LEM+'</td><td>'+desimal(data[i].GSM_LEM, 1)+'</td><td>'+data[i].THICKNESS_LEM+'</td><td>'+desimal(data[i].GSM_SRP, 1)+'</td><td>'+data[i].THICKNESS_SRP+'</td><td>'+desimal(data[i].GSM_TOTAL, 1)+'</td><td>'+data[i].THICKNESS_TOTAL+'</td><td>'+desimal(data[i].DAYA_REKAT, 2)+'</td><td>'+format_number(data[i].ACC_METER)+'</td><td>'+format_number(data[i].REJECT_METER)+'</td><td align="left">'+data[i].OPERATOR+'</td><td align="left">'+data[i].PEMERIKSA+'</td><td align="left">'+remark+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    $('#tbl tfoot tr:eq(0) th:eq(1)').html(format_number(calc_avg(ar_panjang, 0)[0]));
                    $('#tbl tfoot tr:eq(1) th:eq(1)').html(format_number(calc_avg(ar_panjang, 0)[1]));
                    $('#tbl tfoot tr:eq(2) th:eq(1)').html(format_number(calc_avg(ar_panjang, 0)[2]));
                    $('#tbl tfoot tr:eq(0) th:eq(2)').html(calc_avg(ar_gsm_k)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(2)').html(calc_avg(ar_gsm_k)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(2)').html(calc_avg(ar_gsm_k)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(3)').html(calc_avg(ar_thickness_k)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(3)').html(calc_avg(ar_thickness_k)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(3)').html(calc_avg(ar_thickness_k)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(5)').html(calc_avg(ar_gsm_h)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(5)').html(calc_avg(ar_gsm_h)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(5)').html(calc_avg(ar_gsm_h)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(6)').html(calc_avg(ar_thickness_h)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(6)').html(calc_avg(ar_thickness_h)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(6)').html(calc_avg(ar_thickness_h)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(7)').html(calc_avg(ar_gsm_s)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(7)').html(calc_avg(ar_gsm_s)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(7)').html(calc_avg(ar_gsm_s)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(8)').html(calc_avg(ar_thickness_s)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(8)').html(calc_avg(ar_thickness_s)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(8)').html(calc_avg(ar_thickness_s)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(9)').html(calc_avg(ar_gsm_t)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(9)').html(calc_avg(ar_gsm_t)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(9)').html(calc_avg(ar_gsm_t)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(10)').html(calc_avg(ar_thickness_t)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(10)').html(calc_avg(ar_thickness_t)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(10)').html(calc_avg(ar_thickness_t)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(11)').html(calc_avg(ar_rekat, 2)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(11)').html(calc_avg(ar_rekat, 2)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(11)').html(calc_avg(ar_rekat, 2)[2]);

                    if ($(window).width() < 1200) {
                        $('#tbl thead th:eq(14), #tbl tbody td:nth-child(23)').hide();
                        $('.btn_excel').hide();
                    }

                    setTimeout(function() {
                        $('#btnOk').click();
                        page('tbl');
                    }, 500);
                }
            }); 
}, 500);
}

// Kosongkan Isian
function kosong() {
    $('#nmr').attr('name', '');
    $('#jam').val('07:00');
    $('#kode_kertas').val('');
    $('#panjang_kertas').val('0');
    $('#gsm_kertas').val('0');
    $('#thickness_kertas').val('0');
    $('#gsm_srp').val('0');
    $('#thickness_srp').val('0');
    $('#gsm_total').val('0');
    $('#thickness_total').val('0');
    $('#daya_rekat').val('0');
    $('#acc_meter').val('0');
    $('#reject_meter').val('0');
    $('#remark').val('');

    isi_gsm_lem();
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
    var desain = $("#desain").val();
    var tgl = $("#tgl").val();
    var jam = $("#jam").val();
    var kode_kertas = $("#kode_kertas").val();
    var lebar_kertas = angka($("#lebar_kertas").val());
    var panjang_kertas = angka($("#panjang_kertas").val());
    var id_pemeriksa = $("#pemeriksa").val();
    var id_approval = $("#approval").val();
    var id_operator = $("#operator").val();
    var gsm_kertas = angka($("#gsm_kertas").val());
    var thickness_kertas = angka($("#thickness_kertas").val());
    var jenis_lem = $("#jenis_lem").val();
    var gsm_lem = angka($("#gsm_lem").val());
    var gsm_srp = angka($("#gsm_srp").val());
    var thickness_srp = angka($("#thickness_srp").val());
    var gsm_total = angka($("#gsm_total").val());
    var thickness_total = angka($("#thickness_total").val());
    var daya_rekat = angka($("#daya_rekat").val());
    var acc_meter = angka($("#acc_meter").val());
    var reject_meter = angka($("#reject_meter").val());
    var remark = huruf($("#remark").val());

    if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
    if (jam == '') {error_isian('Jam belum diisi..');}
    if (kode_kertas == '') {error_isian('Kode Kertas belum diisi..');}
    if (lebar_kertas == '0') {error_isian('Lebar Kertas belum diisi..');}
    if (panjang_kertas == '0') {error_isian('Panjang Kertas belum diisi..');}
    if (gsm_kertas == '0') {error_isian('GSM Kertas belum diisi..');}
    if (thickness_kertas == '0') {error_isian('Thickness Kertas belum diisi..');}
    if (jenis_lem == '') {error_isian('Jenis Lem belum diisi..');}
    if (gsm_lem == '0') {error_isian('GSM Lem belum diisi..');}
    if (gsm_srp == '0') {error_isian('GSM SRP belum diisi..');}
    if (thickness_srp == '0') {error_isian('Thickness SRP belum diisi..');}
    if (gsm_total == '0') {error_isian('GSM Total belum diisi..');}
    if (thickness_total == '0') {error_isian('Thickness Total belum diisi..');}
    if (daya_rekat == '0') {error_isian('Daya Rekat belum diisi..');}
    if (acc_meter == '0' && reject_meter == '0') {error_isian('Acc atau Reject (Meter) belum diisi..');}

    var data = [id_edit, nmr, desain, tgl, jam, kode_kertas, lebar_kertas, panjang_kertas, id_pemeriksa, id_approval, id_operator, gsm_kertas, thickness_kertas, jenis_lem, gsm_lem, gsm_srp, thickness_srp, gsm_total, thickness_total, daya_rekat, acc_meter, reject_meter, remark];

    $('#btnProgress').click();   
    setTimeout(function() {
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sticker/simpan" ?>',
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
            url: '<?php echo base_url()."index.php/qc/Sticker/edit" ?>',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);

                $('#nmr').attr('name', id_edit);
                $('#nmr').val(data.NMR).focus();
                $("#tgl").val(format_date(data.TGL));
                $('#desain').val(data.DESAIN).change();
                $('#jam').val(data.JAM).change();
                $('#kode_kertas').val(data.KODE_KERTAS).change();
                $('#lebar_kertas').val(data.LEBAR_KERTAS.replace(',', '.')).change();
                $('#panjang_kertas').val(data.PANJANG_KERTAS.replace(',', '.')).change().focus();
                $('#pemeriksa').val(data.ID_PEMERIKSA).change();
                $('#approval').val(data.ID_APPROVAL).change();
                $('#operator').val(data.ID_OPERATOR).change();                
                $('#gsm_kertas').val(data.GSM_KERTAS.replace(',', '.')).change();
                $('#thickness_kertas').val(data.THICKNESS_KERTAS.replace(',', '.')).change();
                $('#jenis_lem').val(data.JENIS_LEM).change();
                $('#gsm_lem').val(data.GSM_LEM.replace(',', '.')).change();
                $('#gsm_srp').val(data.GSM_SRP.replace(',', '.')).change();
                $('#thickness_srp').val(data.THICKNESS_SRP.replace(',', '.')).change();
                $('#gsm_total').val(data.GSM_TOTAL.replace(',', '.')).change();
                $('#thickness_total').val(data.THICKNESS_TOTAL.replace(',', '.')).change();
                $('#daya_rekat').val(data.DAYA_REKAT.replace(',', '.')).change();
                $('#acc_meter').val(data.ACC_METER.replace(',', '.')).change().focus();
                $('#reject_meter').val(data.REJECT_METER.replace(',', '.')).change().focus();
                $('#remark').val(data.REMARK).change();
                $('#simpan').focus();

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
            url: '<?php echo base_url()."index.php/qc/Sticker/hapus" ?>',
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

    $('#tbl_print tbody tr').remove();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url()."index.php/qc/Sticker/cetak" ?>',
        data: {data: id_cetak},
        success: function(data) {
            data = JSON.parse(data);

            tgl = data[0].TGL.split('-')[0];         
            thn = data[0].TGL.split('-')[2];         
            bln = get_romawi(format_date(data[0].TGL));
            nmr = data[0].NMR + '/PNP-HLG/QC2-Sticker/' + tgl + '/' + bln + '/' + thn;
            ket = '<b>Remark :</b><br>';

            $('#nmr_print').html('No : ' + nmr);
            $('#p_approval').html('<b><u>' + data[data.length-1].APPROVAL + '</u></b>');
            $('#p_pemeriksa').html('<b><u>' + data[data.length-1].PEMERIKSA + '</u></b>');
            $('#p_operator').html('<b><u>' + data[data.length-1].OPERATOR.replaceAll(',', ', ') + '</u></b>');

            for (var i=0; i<data.length; i++) {
                t_ket = data[i].REMARK == null ? '' : (i+1) + '. ' + data[i].REMARK + '; ';
                ket = ket + t_ket;

                $('#tbl_print tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].JAM+'</td><td>'+data[i].KODE_KERTAS+'</td><td>'+data[i].LEBAR_KERTAS+'</td><td>'+format_number(data[i].PANJANG_KERTAS)+'</td><td>'+desimal(data[i].GSM_KERTAS, 1)+'</td><td>'+data[i].THICKNESS_KERTAS+'</td><td>'+data[i].JENIS_LEM+'</td><td>'+desimal(data[i].GSM_LEM, 1)+'</td><td>'+desimal(data[i].GSM_SRP, 1)+'</td><td>'+data[i].THICKNESS_SRP+'</td><td>'+desimal(data[i].GSM_TOTAL, 1)+'</td><td>'+data[i].THICKNESS_TOTAL+'</td><td>'+desimal(data[i].DAYA_REKAT, 2)+'</td><td>'+format_number(data[i].ACC_METER)+'</td><td>'+format_number(data[i].REJECT_METER)+'</td></tr>');
            }

            $('#tbl_print tfoot tr:eq(0) td:eq(0)').html(ket);

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

</script>