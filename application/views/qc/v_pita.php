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
                    <b><font color="White"><div>Pengujian Pita</div></font></b>
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
                                <th>Kode Roll</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <input type="text" class="form-control text-uppercase text-center" id="kode_foil" maxlength="5" autocomplete="off">
                                        <div class="m-2"></div>
                                        <select class="select_min" id="mesin" style="width: 100%;">
                                            <option value="1">Mesin 1</option>
                                            <option value="2">Mesin 2</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Ukuran Bahan</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Lebar<input type="text" id="lebar_bahan" class="numbers text-center" value="37,5" style="width: 95%; background-color: #F4F2F2;" readonly></div>
                                        <div class="text-info">Panjang<input type="number" id="panjang_bahan" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
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
                                <th width="40%">Pita</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Seri
                                            <select class="select_min" id="seri" onchange="isi_lebar()" style="width: 100%;">
                                                <option value="1">Seri 1</option>
                                                <option value="2">Seri 2</option>
                                                <option value="3">Seri 3</option>
                                                <option value="M">MMEA</option>
                                            </select>
                                        </div>
                                        <div class="text-info ml-2 mr-2">Lebar<input type="text" id="lebar" class="numbers text-center" value="7 mm" style="width: 95%; background-color: #F4F2F2;" readonly></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Data Uji</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Qty Roll<input type="number" id="qty_roll" class="numbers nums text-center" value="0" style="width: 95%;" step="1" lang="en-US"></div>
                                        <div class="text-info ml-2 mr-2">Panjang<input type="number" id="panjang" class="numbers nums text-center" value="0" style="width: 95%;" step="1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Hasil Uji</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Arah Baca<select class="select_min" id="arah_baca" style="width: 100%;">
                                            <option value="1">Terbaca</option>
                                            <option value="0">Terbalik</option>
                                        </select></div>
                                        <div class="text-info ml-2 mr-2">Kecerahan<select class="select_min" id="cerah" style="width: 100%;">
                                            <option value="1">OK</option>
                                            <option value="0">NO</option>
                                        </select></div>
                                        <div class="text-info ml-2 mr-2">Visual<select class="select_min" id="visual" style="width: 100%;">
                                            <option value="1">OK</option>
                                            <option value="0">NO</option>
                                        </select></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Keputusan</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="d-flex justify-content-between text-center">
                                            <div class="text-info">Acc Roll<input type="number" id="acc" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                            <div class="text-info ml-2 mr-2">Reject Roll<input type="number" id="reject" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        </div>
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
                    <b><font color="White" id="headerinput">Laporan Pita</font></b>
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
                            <table class="tbl_filter" style="width: 650px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="18%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="22%" class="filter">Seri</th>
                                        <th></th>
                                        <th width="20%" class="filter">Mesin</th>
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
                                            <select class="select_min" id="f_seri" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="1">Seri 1</option>
                                                <option value="2">Seri 2</option>
                                                <option value="3">Seri 3</option>
                                                <option value="M">MMEA</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_mesin" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="1">Mesin 1</option>
                                                <option value="2">Mesin 2</option>
                                            </select>
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
                                        <th rowspan="2">Mesin</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">Nomor Urut</th>
                                        <th rowspan="2">Jam</th>
                                        <th rowspan="2">Kode Roll</th>
                                        <th rowspan="2">Ukuran</th>
                                        <th rowspan="2">Seri</th>
                                        <th colspan="7">Inspeksi & Test</th>
                                        <th rowspan="2">Acc<br>Roll</th>
                                        <th rowspan="2">Reject<br>Roll</th>
                                        <th rowspan="2">Operator</th>
                                        <th rowspan="2">Pemeriksa</th>
                                        <th rowspan="2">Remark</th>
                                        <th rowspan="2">Cetak</th>
                                        <th rowspan="2">Edit</th>
                                        <th rowspan="2">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th>Lebar<br>mm</th>
                                        <th>Jumlah<br>Roll</th>
                                        <th>Panjang<br>Meter</th>
                                        <th>Total<br>Meter</th>
                                        <th>Arah Baca</th>
                                        <th>Kecerahan</th>
                                        <th>Visual</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="12" class="pl-3">Total</th><th></th><th colspan="11"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer btn_excel">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pengujian Pita')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
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

    <h6 align="center" style="margin-top: -13mm;">LAPORAN PEMANTAUAN PROSES SLITTING PITA</h6>
    <h6 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 000/PNP-HLG/QC-Pita/01/I/2025</div></h6>
    <table id="tbl_print" class="mt-2" style="width: 100%; font-size: 12px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="2">No.</td>
                <td rowspan="2">Mesin</td>
                <td rowspan="2">Jam</td>
                <td rowspan="2">Kode Roll</td>
                <td rowspan="2">Ukuran<br>Cm x Meter</td>
                <td rowspan="2">Seri</td>
                <td colspan="6">Inspeksi & Test</td>
                <td rowspan="2" width="8%">Acc<br>Roll</td>
                <td rowspan="2" width="8%">Reject<br>Roll</td>
                <td rowspan="2">Remark</td>
            </tr>
            <tr>
                <td width="8%">Lebar<br>(mm)</td>
                <td width="8%">Jumlah<br>(Roll)</td>
                <td width="8%">Panjang<br>(Meter)</td>
                <td width="8%">Arah Baca</td>
                <td width="8%">Kecerahan</td>
                <td width="8%">Visual</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot>
            <tr style="height: 65px; font-size: 17;">
                <td colspan="15" style="vertical-align: top;"><b>Remark :</b></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 10px; margin-bottom: 10px;">F-SMT-QC2-005 Rev. 02</div>
    <div class="row">
        <div class="col-4" style="margin-top: -20px; font-size: 10px;">
            <div>Keterangan :</div>
            <div>1. Tanda (&check;) = Sesuai standar</div>
            <div>2. Standar ukuran Pita :</div>
            <div style="padding-left: 10px;">- Seri I = 7,5 &plusmn;0,5 mm</div>
            <div style="padding-left: 10px;">- Seri II & III = 5,0 &plusmn;0,5 mm</div>
            <div style="padding-left: 10px;">- MMEA = 6,0 &plusmn;0,5 mm</div>

            <div class="mt-2">CC :</div>
            <div>1. Yth. Bag. Slitter</div>
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
                        <div>QC Slitter</div>
                    </td>
                    <td>
                        <div id="p_operator">( ...................... )</div>
                        <div>Operator</div>
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
<script src="<?php echo base_url(); ?>assets/js/script.js?=5"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() < 1200) {$('.fa-bars:eq(0)').click();}

        auto_no();
        filter();
    });

// Auto Nomor
    function auto_no() {
        var id_edit = $('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var desain = $('#desain').val();
        var data = [id_edit, tgl, desain];

        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Pita/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Auto Lebar Pita sesuai Seri
    function isi_lebar() {
        var seri = $('#seri').val();
        var lebar = seri == '1' ? '7' : (seri == '2' || seri == '3' ? '5' : '6');

        $('#lebar').val(lebar + ' mm');
    }

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var seri = $('#f_seri').val();
        var mesin = $('#f_mesin').val();
        var data = [tgl1, tgl2, desain, seri, mesin];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Pita/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    ar_total = [];
                    for (var i=0; i<data.length; i++) {
                        ukuran = data[i].LEBAR_BAHAN + ' x ' + format_number(data[i].PANJANG_BAHAN);
                        total = Number(data[i].QTY_ROLL) * Number(data[i].PANJANG);
                        arah_baca = data[i].ARAH_BACA == '1' ? 'Terbaca' : 'Terbalik';
                        cerah = data[i].CERAH == '1' ? 'OK' : 'NO';
                        visual = data[i].VISUAL == '1' ? 'OK' : 'NO';
                        remark = data[i].REMARK == null ? '' : data[i].REMARK;
                        ar_total.push(total);

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].DESAIN+'</td><td>'+data[i].MESIN+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>'+data[i].JAM+'</td><td>'+data[i].KODE_FOIL+'</td><td>'+ukuran+'</td><td>'+data[i].SERI+'</td><td>'+data[i].LEBAR+'</td><td>'+data[i].QTY_ROLL+'</td><td>'+format_number(data[i].PANJANG)+'</td><td>'+format_number(total)+'</td><td>'+arah_baca+'</td><td>'+cerah+'</td><td>'+visual+'</td><td>'+format_number(data[i].ACC)+'</td><td>'+format_number(data[i].REJECT)+'</td><td align="left">'+data[i].OPERATOR+'</td><td align="left">'+data[i].PEMERIKSA+'</td><td align="left">'+remark+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    $('#tbl tfoot th:eq(1)').html(format_number(calc_avg(ar_total, 0)[3]));

                    if ($(window).width() < 1200) {
                        $('#tbl thead th:eq(15), #tbl tbody td:nth-child(22)').hide();
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
        $('#kode_foil').val('');
        $('#panjang_bahan').val('0');
        $('#qty_roll').val('0');
        $('#panjang').val('0');
        $('#arah_baca').val('1').change();
        $('#cerah').val('1').change();
        $('#visual').val('1').change();
        $('#acc').val('0');
        $('#reject').val('0');
        $('#remark').val('');
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
        var desain = $("#desain").val();
        var nmr = $('#nmr').val();
        var tgl = $("#tgl").val();
        var mesin = $("#mesin").val();
        var jam = $("#jam").val();
        var kode_foil = $("#kode_foil").val();
        var panjang_bahan = angka($("#panjang_bahan").val());
        var lebar_bahan = $("#lebar_bahan").val();
        var seri = $("#seri").val();
        var lebar = $("#lebar").val().replace(' mm', '');
        var qty_roll = $("#qty_roll").val();
        var panjang = angka($("#panjang").val());
        var arah_baca = $("#arah_baca").val();
        var cerah = $("#cerah").val();
        var visual = $("#visual").val();
        var acc = angka($("#acc").val());
        var reject = angka($("#reject").val());
        var id_operator = $("#operator").val();
        var id_pemeriksa = $("#pemeriksa").val();
        var id_approval = $("#approval").val();
        var remark = huruf($("#remark").val());

        if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
        if (jam == '') {error_isian('Jam belum diisi..');}
        if (kode_foil == '') {error_isian('Kode Foil belum diisi..');}
        if (panjang_bahan == '0') {error_isian('Panjang Bahan belum diisi..');}
        if (qty_roll == '0') {error_isian('Qty Roll belum diisi..');}
        if (panjang == '0') {error_isian('Panjang Hasil belum diisi..');}
        if (acc == '0' && reject == '0') {error_isian('Acc atau Reject (Meter) belum diisi..');}
        if (Number(acc) + Number(reject) != Number(qty_roll)) {error_isian('Qty Acc/Reject tidak sama dengan Qty Roll..');}

        var data = [id_edit, desain, nmr, tgl, mesin, jam, kode_foil, panjang_bahan, lebar_bahan, seri, lebar, qty_roll, panjang, arah_baca, cerah, visual, acc, reject, id_operator, id_pemeriksa, id_approval, remark];

        $('#btnProgress').click();   
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Pita/simpan" ?>',
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
                url: '<?php echo base_url()."index.php/qc/Pita/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#nmr').val(data.NMR).focus();
                    $('#desain').val(data.DESAIN).change();
                    $("#tgl").val(format_date(data.TGL));
                    $('#jam').val(data.JAM).change();
                    $('#kode_foil').val(data.KODE_FOIL).change();
                    $('#mesin').val(data.MESIN).change();
                    $('#lebar_bahan').val(data.LEBAR_BAHAN.replace(',', '.')).change();
                    $('#panjang_bahan').val(data.PANJANG_BAHAN.replace(',', '.')).change().focus();
                    $('#pemeriksa').val(data.ID_PEMERIKSA).change();
                    $('#approval').val(data.ID_APPROVAL).change();
                    $('#operator').val(data.ID_OPERATOR).change();                
                    $('#seri').val(data.SERI).change();                
                    $('#lebar').val(data.LEBAR + ' mm').change();
                    $('#qty_roll').val(data.QTY_ROLL).change();
                    $('#panjang').val(data.PANJANG.replace(',', '.')).change().focus();
                    $('#arah_baca').val(data.ARAH_BACA).change();
                    $('#cerah').val(data.CERAH).change();
                    $('#visual').val(data.VISUAL).change();
                    $('#acc').val(data.ACC.replace(',', '.')).change();
                    $('#reject').val(data.REJECT.replace(',', '.')).change();
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
                url: '<?php echo base_url()."index.php/qc/Pita/hapus" ?>',
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
            url: '<?php echo base_url()."index.php/qc/Pita/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC-Slitter/' + tgl + '/' + bln + '/' + thn;

                $('#nmr_print').html('No : ' + nmr);
                $('#p_approval').html('<b><u>' + data[data.length-1].APPROVAL + '</u></b>');
                $('#p_pemeriksa').html('<b><u>' + data[data.length-1].PEMERIKSA + '</u></b>');
                $('#p_operator').html('<b><u>' + data[data.length-1].OPERATOR.replaceAll(',', ', ') + '</u></b>');

                for (var i=0; i<data.length; i++) {
                    ukuran = data[i].LEBAR_BAHAN + ' x ' + format_number(data[i].PANJANG_BAHAN);
                    arah_baca = data[i].ARAH_BACA == '1' ? 'Terbaca' : 'Terbalik';
                    cerah = data[i].CERAH == '1' ? '&check;' : 'X';
                    visual = data[i].VISUAL == '1' ? '&check;' : 'X';
                    remark = data[i].REMARK == null ? '' : data[i].REMARK;

                    $('#tbl_print tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].MESIN+'</td><td>'+data[i].JAM+'</td><td>'+data[i].KODE_FOIL+'</td><td>'+ukuran+'</td><td>'+data[i].SERI+'</td><td>'+data[i].LEBAR+'</td><td>'+data[i].QTY_ROLL+'</td><td>'+format_number(data[i].PANJANG)+'</td><td>'+arah_baca+'</td><td>'+cerah+'</td><td>'+visual+'</td><td>'+format_number(data[i].ACC)+'</td><td>'+format_number(data[i].REJECT)+'</td><td align="left">'+remark+'</td></tr>');
                }

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