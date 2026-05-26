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

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Input RH Meterai</div></font></b>
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
                                <th width="40%">Tanggal</th>
                                <td>
                                    <input id="tgl" type="text" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Nomor Rim</th>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <select class="select" id="rim" onchange="isi_tabel_rim()" style="width: 100%;">
                                            <option value="">Pilih..</option>                                      
                                        </select>
                                        <button type="button" id="btn_qr" class="btn btn-secondary ml-2" data-toggle="modal" data-target="#modal_scan" data-backdrop="static" data-keyboard="false"><i class="fa fa-qrcode"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <table width="100%">
                            <tr>
                                <th width="40%">Qty Rim</th>
                                <td>
                                    <input type="number" id="qty" class="numbers text-left pl-3" onchange="isi_tabel_rim()" value="20" step="1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>

                <div class="card-body table-responsive mt-3">
                    <div class="tbl_input" style="width: 700px; height: 400px; display: none;">
                        <table id="tbl_input" class="table table-bordered table-striped" style="width: 100%;">
                            <thead class="text-center">
                                <tr>
                                    <th width="15%">No.</th>
                                    <th>Nomor Rim</th>
                                    <th width="20%">RH</th>
                                    <th width="20%">Suhu</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                    <b><font color="White" id="headerinput">Laporan RH Meterai</font></b>
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
                            <table class="tbl_filter" style="width: 450px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="45%" class="filter">Kode</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
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
                            <div class="card card-body">
                                <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="20%">Nomor Rim</th>
                                            <th width="15%">Kode Cutter</th>
                                            <th>Pallet</th>
                                            <th>RH</th>
                                            <th>Suhu</th>
                                            <th width="5%">Edit</th>
                                            <th width="5%">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th colspan="5" class="text-left pl-3">Average</th><th></th><th></th><th colspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-left pl-3">Max</th><th></th><th></th><th colspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-left pl-3">Min</th><th></th><th></th><th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" onclick="excel('tbl', 'Data RH Finishing')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
                                </div>
                            </div>
                            <div class="card card-body">
                                <table id="tbl_pallet" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="5%">No.</th>
                                            <th width="15%">Tanggal Kirim</th>
                                            <th width="20%">Nomor SP</th>
                                            <th width="10%">Pallet</th>
                                            <th>Nomor Rim</th>
                                            <th width="10%">RH</th>
                                            <th width="10%">Suhu</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="text-center">
                                        <tr>
                                            <th colspan="5" class="text-left pl-3">Average</th><th></th><th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-left pl-3">Max</th><th></th><th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="5" class="text-left pl-3">Min</th><th></th><th></th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-success" onclick="excel('tbl_pallet', 'Data RH Kiriman')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
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

<!-- Modal Confirm Scan -->
<div class="modal fade" id="modal_scan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;">
                <div id="reader" style="width: 100%; height: auto;"></div>
            </div>
            <div class="modal-footer row">
                <div class="col">
                    <a href="#" id="btn_request" class="text-info text-left"><u>Get permission?</u></a>
                </div>
                <div class="col text-right">
                    <button id="btn_stop" style="width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-stop mr-2"></i>Stop</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit RH -->
<div class="modal fade" id="modal_edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">Edit Data</h4></b>
            </div>
            <div class="card-body card m-3">
                <table width="100%">
                    <tr>
                        <th width="40%">Tanggal</th>
                        <td>
                            <input id="e_tgl" type="text" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>No Rim</th>
                        <td>
                            <input type="text" id="e_rim" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>RH</th>
                        <td>
                            <input type="number" id="e_rh" class="numbers text-left pl-3" value="0" step="0.1" lang="en-US">
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Suhu</th>
                        <td>
                            <input type="number" id="e_suhu" class="numbers text-left pl-3" value="0" step="0.1" lang="en-US">
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                </table>
            </div>
            <div class="card-footer rounded m-1 text-center">
                <button style="width: 150px;" type="button" class="btn btn-success" title="Simpan Data" onclick="e_simpan()" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button style="width: 150px;" type="button" class="btn btn-secondary" title="Kembali" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
                <button id="btn_edit" data-toggle="modal" data-target="#modal_edit" data-backdrop="static" data-keyboard="false" hidden></button>
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
<script src="<?php echo base_url(); ?>assets/js/html5-qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=4"></script>

<script>

// Defined Variable
    var select_rim = [[], []];

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() < 960) {$('.fa-bars:eq(0)').click();}

        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        isi_rim();
        filter();
    });

// Isi Kode Rim
    function isi_rim() {
        $('#rim option:gt(0)').remove();
        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Rh_met/isi_rim" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    $('#rim').append('<option>'+data[i].KODE_RIM+'</option>');
                    select_rim[0].push(data[i].KODE_RIM);
                    select_rim[1].push(data[i].RH);
                }
            }
        });
    }

// Isi Seri Berdasarkan RIM
    function isi_tabel_rim() {
        var rim = Number($('#rim').val().substr(-9));
        var kode = $('#rim').val().substr(0, 1);
        var qty = $('#qty').val();

        $('#tbl_input').DataTable().destroy();
        $('#tbl_input tbody tr').remove();
        $('.tbl_input').hide();

        if (rim == '') {return;}

        $('#btnProgress').click();
        for (var i=0; i<qty; i++) {
            urut = kode + rim;

            var index = $.inArray(urut, select_rim[0]);
            if (index !== -1) {
                rh = select_rim[1][index] == null ? '' : desimal(select_rim[1][index].split('@')[0]);
                suhu =select_rim[1][index] == null ? '' : desimal(select_rim[1][index].split('@')[1]);

                $('#tbl_input tbody').append('<tr><td><input type="text" class="form-control text-center" name"urut" value="'+(i+1)+'" readonly></td><td><input type="text" class="form-control" name="rim" value="'+urut+'" readonly></td><td><input type="number" name="rh" class="numbers text-center" value="'+rh+'" step="0.1" lang="en-US"></td><td><input type="number" name="suhu" class="numbers text-center" value="'+suhu+'" step="0.1" lang="en-US"></td></tr>');
                rim++;
            }
        }

        setTimeout(function() {
            $('#btnOk').click();
            $('.tbl_input').show();
            page('tbl_input');
        }, 500);
    }

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var kode = $('#cari').val();
        var data = [tgl1, tgl2, kode];

        $('#tbl, #tbl_pallet').DataTable().destroy();
        $('#tbl tbody tr, #tbl_pallet tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_met/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);
                    dt_rim = data[0];
                    dt_pallet = data[1];

                    ar_rh = [], ar_suhu = [];
                    for (var i=0; i<dt_rim.length; i++) {
                        pallet = dt_rim[i].PALLET == null ? '' : dt_rim[i].PALLET;
                        
                        $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(dt_rim[i].TGL)+'</td><td align="center">'+dt_rim[i].RIM+'</td><td align="center">'+dt_rim[i].KODE_CUTTER+'</td><td align="center">'+pallet+'</td><td align="center" style=\'mso-number-format:\\@;\'>'+desimal(dt_rim[i].RH, 1)+'</td><td align="center" style=\'mso-number-format:\\@;\'>'+desimal(dt_rim[i].SUHU, 1)+'</td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+dt_rim[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+dt_rim[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');

                        ar_rh.push(dt_rim[i].RH);
                        ar_suhu.push(dt_rim[i].SUHU);
                    }

                    $('#tbl tfoot tr:eq(0) th:eq(1)').html(calc_avg(ar_rh)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(1)').html(calc_avg(ar_rh)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(1)').html(calc_avg(ar_rh)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(2)').html(calc_avg(ar_suhu)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(2)').html(calc_avg(ar_suhu)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(2)').html(calc_avg(ar_suhu)[2]);

                    isi_pallet(dt_pallet);
                    setTimeout(function() {page('tbl');}, 500);
                }
            }); 
        }, 500);
    }

// Isi Tabel Pallet
    function isi_pallet(dt_pallet) {
        var ar_rh = [], ar_suhu = [];
        
        for (var i=0; i<dt_pallet.length; i++) {
            rim = dt_pallet[i].RIM.replaceAll(',', ', ');
            rh = dt_pallet[i].RH == null ? '' : dt_pallet[i].RH;
            suhu = dt_pallet[i].SUHU == null ? '' : dt_pallet[i].SUHU;

            $('#tbl_pallet tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(dt_pallet[i].SHIPMENT_DATE)+'</td><td align="center">'+dt_pallet[i].NO_SP+'</td><td align="center">'+dt_pallet[i].KODE_PALETTE+'</td><td align="center">'+rim+'</td><td align="center" style=\'mso-number-format:\\@;\'>'+format_number(rh)+'</td><td align="center" style=\'mso-number-format:\\@;\'>'+format_number(suhu)+'</td></tr>');

            rh != '' ? ar_rh.push(dt_pallet[i].RH) : null;
            suhu != '' ? ar_suhu.push(dt_pallet[i].SUHU) : null;
        }

        $('#tbl_pallet tfoot tr:eq(0) th:eq(1)').html(calc_avg(ar_rh)[0]);
        $('#tbl_pallet tfoot tr:eq(1) th:eq(1)').html(calc_avg(ar_rh)[1]);
        $('#tbl_pallet tfoot tr:eq(2) th:eq(1)').html(calc_avg(ar_rh)[2]);
        $('#tbl_pallet tfoot tr:eq(0) th:eq(2)').html(calc_avg(ar_suhu)[0]);
        $('#tbl_pallet tfoot tr:eq(1) th:eq(2)').html(calc_avg(ar_suhu)[1]);
        $('#tbl_pallet tfoot tr:eq(2) th:eq(2)').html(calc_avg(ar_suhu)[2]);

        setTimeout(function() {$('#btnOk').click(); page('tbl_pallet');}, 500);
    }

// Kosongkan Isian
    function kosong() {
        $('#rim').attr('name', '');
        $('#rim').val('').change();
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
        var tgl = $("#tgl").val();
        var rim = $("#rim").val();
        var qty = angka($("#qty").val());
        var qty_input = $('#tbl_input tbody tr').length;
        var dt_rim = [];

        if (rim == '') {error_isian('Nomor Rim belum diisi..');}
        if (qty == 0) {error_isian('Qty Rim belum diisi..');}

        for (var i=0; i<qty_input; i++) {
            rim = $('[name="rim"]:eq('+i+')').val();
            rh = angka($('[name="rh"]:eq('+i+')').val());
            suhu = angka($('[name="suhu"]:eq('+i+')').val());

            if (rh == 0 && suhu != 0) {error_isian('RH Nomor Urut '+(i+1)+' belum diisi..');}
            if (rh != 0 && suhu == 0) {error_isian('Suhu Nomor Urut '+(i+1)+' belum diisi..');}

            if (rh != 0 && suhu != 0) {
                dt_rim.push([rim, rh, suhu]);
            }
        }

        if (dt_rim.length == 0) {error_isian('Tidak ada data tersimpan..');}

        var data = [tgl, dt_rim];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_met/simpan" ?>',
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

        $('#btn_edit').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Rh_met/edit" ?>',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);

                $('#e_tgl').val(format_date(data.TGL));
                $('#e_rim').val(data.RIM);
                $("#e_rh").val(desimal(data.RH, 1));
                $("#e_suhu").val(desimal(data.SUHU, 1));
            }
        });
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
                url: '<?php echo base_url()."index.php/qc/Rh_met/hapus" ?>',
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

// Simpan Data Edit
    function e_simpan() {
        var tgl = $('#e_tgl').val();
        var rim = $('#e_rim').val();
        var rh = $('#e_rh').val();
        var suhu = $('#e_suhu').val();
        var data = [tgl, rim, rh, suhu];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Rh_met/e_simpan" ?>',
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        filter();
                    }, 500);
                }
            });
        }, 500);
    }

// QR Scanner
    $('#btn_qr').click(function() {
        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", { fps: 10, facingMode: "environment" }, false);
        html5QrcodeScanner.render(onScanSuccess);

        $('#reader').show();
        $('#reader div:eq(0), #reader__dashboard').css('display', 'none');
        $('#html5-qrcode-anchor-scan-type-change').css('display', 'none');
        setTimeout(function() {
            $('#html5-qrcode-button-camera-permission').click();
            $('#html5-qrcode-button-camera-start').click();
        });
    });
    $('#btn_stop').click(function() {
        $('#html5-qrcode-button-camera-stop').click();
    });
    $('#btn_request').click(function() {
        $('#html5-qrcode-button-camera-permission').click();
    });
    function onScanSuccess(decodedText, decodedResult) {
        var data = decodedText.split('id.')[1].replace(')', '');

        $('#rim').val(data).change();
        $('#btn_stop').click();
    }

</script>