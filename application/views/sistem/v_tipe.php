<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;}</style>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Tipe Document</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body" style="width: 100%;">
                        <div class="mt-2 table-responsive" style="width: 900px; font-size: 12px;">
                            <table id="tbl" class="table table-bordered table-striped" style="width: 850px;">
                                <thead>
                                    <tr align="center">
                                        <th width="10%">No.</th>
                                        <th width="15%">Kode</th>
                                        <th width="35%">Tipe</th>
                                        <th width="15%">Group</th>
                                        <th width="15%">Distribusi</th>
                                        <th width="5%">Edit</th>
                                        <th width="5%">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <button type="button" id="btn_tambah" class="btn btn-warning" onclick="hide_scroll()" style="width: 120px;" title="Upload dokumen baru" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus mr-2"></i><b>Baru</b></button>
                        <button type="button" class="btn btn-success" style="width: 120px;" title="Export to Excel" onclick="$('.excel').click()"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>
    </div>
</section>
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
            <div class="modal-body confirm" style="font-size: 36px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
                <button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Tipe Dokumen -->
<div class="modal fade" id="modal_tambah" style="overflow-x: hidden; z-index: 9999999;">
    <div class="modal-dialog modal-large">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white judul_sop">Tambah</h4></b>
            </div>
            <div class="modal-body" style="font-size: 13px;">
                <div class="card-body card">
                    <table width="100%">
                        <tr>
                            <th width="40%">Kode</th>
                            <td width="60%">
                                <input type="text" id="kode" class="form-control" name="" style="text-transform: uppercase;" maxlength="2" autocomplete="off">
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Tipe</th>
                            <td>
                                <input type="text" id="tipe" class="form-control" maxlength="30" autocomplete="off">
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th >Group</th>
                            <td>
                                <select class="select" id="group" style="width: 100%;">
                                    <option value="">Pilih..</option>
                                    <option>DID</option>
                                    <option>DIF</option>
                                    <option value="OTH">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Distribusi</th>
                            <td>
                                <select class="select" id="distribusi" style="width: 100%;">
                                    <option value="1">All</option>
                                    <option value="2">Bagian</option>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                    </table>
                </div>
            </div>
            <font><h3 class="error_isian invisible ml-3 text-danger font-weight-bold">Error isian..</h3></font>
            <div class="modal-footer rounded ml-3 mr-3">
                <button style="width: 120px;" type="button" class="btn btn-sm btn-success" onclick="simpan()" title="Simpan Tipe Dokumen"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button id="btn_tutup" style="width: 120px;" type="button" class="btn btn-sm btn-danger" onclick="show_scroll()" title="Tutup Tipe Dokumen" data-dismiss="modal"><i class="fa fa-refresh m-2"></i><b>Tutup</b></button>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
    $('.fa-bars:eq(0)').click();
    $(".select").select2();
    $(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
    filter();
});

// Error Isian
function error_isian(str) {
    $('.error_isian').removeClass('invisible');
    $('.error_isian').html(str);
    $('#btnIsian').click();
    setTimeout(function() {$('.error_isian').addClass('invisible');}, 4000);
    throw new Error("Isian salah..");
}

// Pagination Data
function pagination() {
    $('#tbl').DataTable().destroy();
    var tbl = $('#tbl').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": "400px",
        "colReorder": true,
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {columns: ':visible'},
            className: 'excel invisible',
            title: 'Data Tipe Document'
        }],
        "columnDefs": [{"orderable": false, "targets": "_all"}],
        "order": []
    });

    setTimeout(function() {tbl.columns.adjust().draw();}, 500);
}

// Filter Data
function filter() {
    $('#tbl').DataTable().destroy();
    $('#tbl tbody tr').remove();
    $('#btnProgress').click();
    setTimeout(function() {
        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/tipe/filter" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    distribusi = data[i].DISTRIBUSI == '1' ? 'All' : 'Bagian';
                    $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+data[i].KODE+'</td><td>'+data[i].TIPE+'</td><td>'+data[i].GRUP+'</td><td>'+distribusi+'</td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" style="width: 50px;" onclick="edit(this)" name="'+data[i].ID+'"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" style="width: 50px;" onclick="hapus(this)" name="'+data[i].ID+'"><i class="fa fa-trash"></i></button></td></tr>');
                    if (data[i].QTY != 0) {$('#tbl tbody tr:eq('+i+') button:gt(0)').hide();}
                }
                setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
            }
        });
    }, 300);
}

// Kosong Isian
function kosong() {
    $('#kode').attr('name','');
    $('#kode').val('').change();
    $('#tipe').val('').change();
    $('#group').val('').change();
}

// Simpan Dokumen
function simpan() {
    var id_edit = $('#kode').attr('name');
    var kode = $('#kode').val().toUpperCase();
    var tipe = $('#tipe').val();
    var group = $('#group').val();
    var distribusi = $('#distribusi').val();
    var data = [id_edit, kode, tipe, group, distribusi];

    if (kode == '') {error_isian('Kode Dokumen belum diisi..');}
    if (tipe == '') {error_isian('Tipe Dokumen belum diisi..');}
    if (group == '') {error_isian('Group Dokumen belum diisi..');}

    cek_kode(id_edit, kode, tipe);
    $('#btn_tutup').click();
    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url() . "index.php/sistem/tipe/simpan" ?>',
        data: {data: data},
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

// Cek Kode dan Tipe Dokumen
function cek_kode(id_edit, kode, tipe) {
    var data = [id_edit, kode, tipe];

    $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo base_url() . "index.php/sistem/tipe/cek_kode" ?>',
        data: {data: data},
        success: function(data) {
            data = JSON.parse(data);

            if (data[0] != 0) {error_isian('Kode Dokumen sudah ada..');}
            if (data[1] != 0) {error_isian('Tipe Dokumen sudah ada..');}
        }
    });    
}

// Tutup Dokumen
$('#btn_tutup').click(function() {
    if ($('#kode').attr('name') != '') {
        kosong();
    }
});

// Edit Data Dokumen
function edit(btn) {
    var id_edit = $(btn).attr('name');

    $('#kode').attr('name', id_edit);
    $('#btn_tambah').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url() . "index.php/sistem/tipe/edit" ?>',
        data: {data: id_edit},
        success: function(data) {
            data = JSON.parse(data);

            $('#kode').val(data.KODE).change();
            $('#tipe').val(data.TIPE).change();
            $('#group').val(data.GRUP).change();
            $('#distribusi').val(data.DISTRIBUSI).change();
        }
    });
}

// Notifikasi Hapus Data
function hapus(btn) {
    var id_hapus = $(btn).attr('name');

    $('#btnHapus').click();
    $('#btnYa').on('click', function() {
        if (id_hapus == '') {return;}
        
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/tipe/hapus" ?>',
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

// Drag Div Document
$("#modal_view").draggable({handle: ".card-header"});
$("#modal_tambah").draggable({handle: ".card-header"});

// Show Scroll Body
function show_scroll() {
    $('html, body').css('overflow', '');
}

// Hide Scroll Body
function hide_scroll() {
    $('html, body').css('overflow', 'hidden');
}

// Expands & Collapse Card Info
var info_1 = 0;
$('.info_1:eq(0)').on('click', function() {
    if (info_1 == 0) {
        $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_1 = 1;
    } else {
        $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_1 = 0;
    }
});
var info_2 = 0;
$('.info_2:eq(0)').on('click', function() {
    if (info_2 == 0) {
        $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_2 = 1;
    } else {
        $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_2 = 0;
    }
});

</script>