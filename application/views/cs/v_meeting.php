<?php
$this->load->view('dashboard/header');
// $this->load->view('dashboard/topbar');
// $this->load->view('dashboard/sidebar');
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

<!-- Custom CSS -->
<style type="text/css">
    .tgl {
        color: black;
        transition: .5s;
    }
    .tgl:hover {
        color: red;
        font-size: 40px;
    }
</style>

<div id="navigation">
    <section class="content-header"></section>
    <section class="content ml-2 mr-2" style="margin-top: -20px;">
        <div class="card">
            <div class="card-header" style="background-color: #1f1432;">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div>Jadwal Meeting</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_3" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus info_3"></i>
                    </button>
                    <button type="button" class="btn btn-tool info_3" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times info_3"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3 justify-content-center">
                        <button style="width: 200px;" type="button" class="btn btn-link" onclick="prev()"><i class="ion-arrow-left-a m-2"></i><b>Previous</b></button>
                        <?php $now = date('M-Y'); ?>
                        <div class="text-danger text-bold text-center periode"><?php echo $now; ?></div>
                        <button style="width: 200px;" type="button" class="btn btn-link" onclick="next()"><b>Next</b><i class="ion-arrow-right-a m-2"></i></button>
                    </div>
                    <div class="row">
                        <?php for ($i = 1; $i <= 31; $i++) { ?>
                            <div class="col-2 row-card">
                                <div class="card p-3 card-height border border-success" style="min-height: 50px;">
                                    <div class="row">
                                        <div class="col-m-2 mr-3 text-center">
                                            <div class="row">
                                                <div class="col">
                                                    <h2 class="tgl" ondblclick="baru(this)" title="<?php if ($status_menu == '2') {echo 'Double Click untuk tambah Agenda';} ?>" style="cursor: pointer;"><?php echo $i; ?></h2>
                                                </div>
                                                <div class="col">
                                                    <h6 class="day"></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row agenda_detail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="headerinput" class="card card-info" <?php if ($status_menu == '1') {echo 'hidden';} ?>><div class="card-header" style="background-color: #1f1432;">
            <h3 class="card-title">
                <b>
                    <font color="White">
                        <div>Input Planning Penggunaan R. Meeting</div>
                    </font>
                </b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus info_1"></i>
                </button>
                <button type="button" class="btn btn-tool info_1" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times info_1"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <table width="100%">
                <tr>
                    <th width="15%">Tanggal</th>
                    <td width="35%">
                        <input type="text" id="tgl" class="form-control datepicker" value="<?php echo date("d-M-Y"); ?>" onchange="auto_no()" style="width: 40%; cursor: pointer;">
                    </td>
                    <th width="15%">Nama Pemesan</th>
                    <td width="35%">
                        <select class="select" id="pic" style="width: 70%;">
                            <option value="">Pilih Karyawan..</option>
                            <?php $dt_kary = array(); ?>
                            <?php foreach ($pic->result_array() as $dt) { ?>
                                <option><?php echo $dt['NAMA']; ?></option>
                                <?php array_push($dt_kary, array($dt['ID'], $dt['BAGIAN'])); ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr style="height: 10px;"></tr>
                <tr>
                    <th>Nomor</th>
                    <td>
                        <input type="text" class="form-control" id="nmr" style="width: 50%;" readonly>
                    </td>
                    <th>Bagian</th>
                    <td>
                        <input type="text" class="form-control" id="bagian" style="width: 40%;" readonly>
                    </td>
                </tr>
                <tr style="height: 10px;"></tr>
                <tr>
                    <th>Waktu</th>
                    <td>
                        <input type="time" class="form-control" id="waktu" value="09:00" style="width: 35%; text-align: center;" tabindex="1">
                    </td>
                    <th>Kapasitas</th>
                    <td>
                        <input type="text" class="form-control" id="qty" style="width: 30%;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '')" tabindex="2">
                    </td>
                </tr>
                <tr style="height: 10px;"></tr>
                <tr>
                    <th>Ruang</th>
                    <td>
                        <select class="select" id="ruang" style="width: 50%; cursor: pointer;">
                            <option>Meeting Utama</option>
                            <option>Meeting Dalam</option>
                            <option>Meeting Luar</option>
                            <option>Holo Perdana</option>
                        </select>
                    </td>
                    <th>Agenda</th>
                    <td>
                        <textarea id="agenda" rows="3" maxlength="255" placeholder="Tulis agenda.." style="width: 70%;" tabindex="3"></textarea>
                    </td>
                </tr>
                <tr style="height: 10px;"></tr>
                <tr>
                    <th>Level</th>
                    <td>
                        <select class="select" id="lev" style="width: 50%; cursor: pointer;">
                            <option>Level 1</option>
                            <option>Level 2</option>
                            <option>Level 3</option>
                        </select>
                    </td>
                    <th>Fasilitas</th>
                    <td>
                        <textarea id="keterangan" rows="2" maxlength="100" placeholder="Tulis keterangan.." style="width: 70%;" tabindex="4"></textarea>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150" title="Kosongkan Isian"><button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info" <?php if ($status_menu == '1') {echo 'hidden';} ?>>
            <div class="card-header" style="background-color: #1f1432;">
                <h3 class="card-title">
                    <b>
                        <font color="White">Detail Penggunaan R. Meeting</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <table style="width: 400px; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="65%" colspan="2" class="filter">Periode Tanggal</td>
                                        <td></td>
                                        <td width="35%" class="filter">Divisi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" id="fTgl1" style="background-color: #FFFFFF; cursor: pointer;" class="form-control text-center datepicker" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly></td>
                                        <td><input type="text" id="fTgl2" style="background-color: #FFFFFF; cursor: pointer;" class="form-control text-center datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fDivisi" onchange="filter()" style="width: 100%;">
                                                <?php foreach($unit->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if($kd_unit==$dt['KD_UNIT']) {echo 'selected';} ?>><?php echo $dt['UNIT']; ?></option>      
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="data-table"></div>
                            <div class="col-2 mt-4">
                                <button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                            </div>
                        </font>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <font color="Green" size="2">ERP @2019</font>
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
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){location.reload();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-android-share m-2"></i><b>OK</b></button>
                <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Batal -->
<div class="modal fade" id="modal_batal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan membatalkan Agenda Meeting? </div>
            <div class="modal-footer">
                <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_batal" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Selesai -->
<div class="modal fade" id="modal_selesai">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #2fa243; font-weight: bold;"> Yakin Agenda Meeting selesai? </div>
            <div class="modal-footer">
                <button id="ya_selesai" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnSelesai" data-toggle="modal" data-target="#modal_selesai" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sign -->
<div class="modal fade" id="modal_sign">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
                    <h3 class="card-title m-3"><b><font color="White" style="font-size: 28px;">Daftar Hadir Meeting</font></b></h3>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="35%">Nama</th>
                        <td width="65%">
                            <select class="select" id="s_nama" style="width: 100%;">
                                <option value="">Pilih Karyawan..</option>
                                <?php foreach ($pic->result_array() as $dt) { ?>
                                    <option><?php echo $dt['NAMA']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr style='height: 10px;'></tr>
                    <tr>
                        <th>Bagian</th>
                        <td>
                            <input type="text" class="form-control" id="s_bagian" style="width: 100%;" readonly>                
                        </td>
                    </tr>
                    <tr style='height: 10px;'></tr>
                    <tr>
                        <th>Tanda Tangan</th>
                        <td>
                            <canvas id="sig-canvas" width="300" height="160" style="border: 2px dotted #CCCCCC; border-radius: 15px; cursor: crosshair;"></canvas>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-danger text-right mr-4 mb-2 invisible isian" style="font-weight: bold;">Isian belum lengkap..</div>
            <div class="modal-footer">
                <button onclick="simpan()" style="width: 50%;" type="button" class="btn btn-success"><i class="fa fa-save mr-2" tabindex="2"></i><b>Simpan</b></button>
                <button id="clearBtn" onclick="clearSign()" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal" tabindex="3"><i class="fa fa-ban mr-2"></i><b>Batal</b></button>
                <button id="clearBtn" type="button" class="btn btn-danger" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Digital Sign -->
<script src="<?php echo base_url();?>assets/js/sign.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>

<script>

// Define Variable
var data_table, id_edit = '';
var info_1 = 0, info_2 = 0, info_3 = 0;
var periode = <?php echo json_encode(date('ym')); ?>;
var bln, thn;

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    $(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

    thn = String(periode).substring(0, 2);
    bln = String(periode).substring(2, 4);

    auto_no();
    get_agenda(thn + bln);
    filter();

    $('.navbar').hide();
    $('#waktu').focus();
    $('html, body').stop().animate({scrollTop: $('#navigation').offset().top}, 1000);
});

// Pagination
function pagination() {
    data_table = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {
            "sSearch": "Cari :"
        },
        "info": false,
        "order": [
        [1, "asc"]
        ],
        "autoWidth": true,
        "scrollX": true,
        "scrollY": "400px",
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            },
            className: 'invisible excel',
            title: 'Laporan Data Penggunaan R. Meeting'
        }],
        "colReorder": true
    });

    setTimeout(function() {
        data_table.columns.adjust().draw();
    }, 500);
}

// Input Baru
function baru(btn) {
    var tanggal = (btn.innerText).toString().padStart(2, "0");
    var bulan = format_tanggal(bln - 1);
    var waktu = tanggal + '-' + bulan + '-20' + thn;
    var status_menu = <?php echo json_encode($status_menu); ?>;

    if (status_menu == '1') {
        return;
    }

    if (info_1 == 1) {
        $('.info_1')[0].click();
        $('.info_3')[0].click();
    }
    $('#tgl').val(waktu).change();

    $('html, body').animate({scrollTop: $("#headerinput").offset().top}, 1000);
    $('#waktu').focus();
}

// Auto Number
function auto_no() {
    var tgl = $('#tgl').val();

    $.ajax({
        type: 'POST',
        data: {
            data: tgl
        },
        url: '<?php echo base_url(); ?>index.php/cs/meeting/auto_no',
        success: function(data) {
            $('#nmr').val(data);
        }
    });
}

// Kosongkan isian
function kosong() {
    $('#pic').val('').change();
    $('#bagian').val('').change();
    $('#waktu').val('09:00').change();
    $('#agenda').val('').change();
    $('#ruang').val('Meeting Dalam').change();
    $('#keterangan').val('').change();
    $('#lev').val('Level 1').change();
    $('#qty').val('').change();

    auto_no();
    id_edit = '';
    $('#waktu').focus();
}

// Clear Sign
function clearSign() {
    $('#s_nama').val('').change();
    $('#s_bagian').val('').change();
}

// Isi Bagian Sign
$('#s_nama').change(function() {
    var dt_kary = <?php echo json_encode($dt_kary); ?>;
    var index = document.getElementById("s_nama").selectedIndex - 1;
    var s_bagian = index == -1 ? '' : dt_kary[index][1];

    $('#s_bagian').val(s_bagian).change();
});

// Pilih Karyawan
$('#pic').change(function() {
    var dt_kary = <?php echo json_encode($dt_kary); ?>;
    var index = document.getElementById("pic").selectedIndex - 1;
    if (index == '-1') {
        var bagian = '';
        return;
    }
    var bagian = dt_kary[index][1];

    $('#bagian').val(bagian).change();
});

// Simpan Data
$('#btnSimpan').click(function() {
    var dt_kary = <?php echo json_encode($dt_kary); ?>;
    var index = document.getElementById("pic").selectedIndex - 1;
    var id_kary = dt_kary[index][0];
    var nmr = document.getElementById("nmr").value;
    var tgl = document.getElementById("tgl").value;
    var waktu = document.getElementById("waktu").value;
    var ruang = document.getElementById("ruang").value;
    var qty = document.getElementById("qty").value;
    var agenda = document.getElementById("agenda").value;
    var lev = document.getElementById("lev").value;
    var keterangan = document.getElementById("keterangan").value;
    var data = [nmr, tgl, waktu, ruang, qty, agenda, lev, id_kary, keterangan, id_edit];

    if (index == '-1' || qty == '' || agenda == '') {
        $('#btnIsian').click();
        return;
    }

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/cs/meeting/simpan',
        data: {
            data: data
        },
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
            }, 500);
        }
    });
});

// Filter Data
function filter() {
    var tgl1 = document.getElementById('fTgl1').value;
    var tgl2 = document.getElementById('fTgl2').value;
    var unit = $('#fDivisi').val();
    var data = [tgl1, tgl2, unit];

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/cs/meeting/filter',
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

// Edit Data
function edit(btn) {
    var tabel = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var tgl = tabel.rows[row].cells[4].innerHTML;
    var nmr = tabel.rows[row].cells[2].innerHTML;
    var waktu = tabel.rows[row].cells[5].innerHTML;
    var ruang = tabel.rows[row].cells[6].innerHTML;
    var qty = tabel.rows[row].cells[7].innerHTML;
    var agenda = tabel.rows[row].cells[8].innerHTML;
    var lev = tabel.rows[row].cells[9].innerHTML;
    var pic = tabel.rows[row].cells[10].innerHTML.toUpperCase();
    var bagian = tabel.rows[row].cells[11].innerHTML;
    var keterangan = tabel.rows[row].cells[13].innerHTML;

    $('#tgl').val(tgl).change();
    $('#waktu').val(waktu).change();
    $('#ruang').val(ruang).change();
    $('#lev').val('Level ' + lev).change();
    $('#pic').val(pic).change();
    $('#bagian').val(bagian).change();
    $('#qty').val(qty).change();
    $('#agenda').val(agenda).change();
    $('#keterangan').val(keterangan).change();

    id_edit = tabel.rows[row].cells[0].innerHTML;

    $('#nmr').val(nmr).change();
    $('html, body').animate({scrollTop: $("#headerinput").offset().top}, 1000);
    $('#waktu').focus();
}

// Edit Data
function batal(btn) {
    var row = $(btn).closest("tr").index() + 1;
    var tabel = document.getElementById('data-table');
    var id = tabel.rows[row].cells[0].innerHTML;

    $('#btnHapus').click();
    $('#ya').on('click', function() {
        $.ajax({
            data: {
                data: id
            },
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/cs/meeting/batal',
            success: function(data) {
                filter();
            }
        });
    });
}

// Edit Data
function selesai(btn) {
    var row = $(btn).closest("tr").index() + 1;
    var tabel = document.getElementById('data-table');
    var id = tabel.rows[row].cells[0].innerHTML;

    $('#btnSelesai').click();
    $('#ya_selesai').on('click', function() {
        $.ajax({
            data: {
                data: id
            },
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/cs/meeting/selesai',
            success: function(data) {
                filter();
            }
        });
    });
}

// Ambil Agenda
function get_agenda(periode) {
    $.ajax({
        data: {
            data: periode
        },
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/cs/meeting/get_agenda',
        success: function(data) {
            data = JSON.parse(data);
            isi_agenda(data);
        }
    });
}

// Isi Agenda
function isi_agenda(dt_agenda) {
    var weekday = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    var month = new Date(bln + '-01-' + thn);
    var card_height = $('.card-height:eq(0)').height();
    month = month.getMonth();

    for (var i = 1; i <= 31; i++) {
        d = new Date(bln + '-' + i + '-' + thn);
        day = weekday[d.getDay()];

        // Tanda merah jika minggu
        if (day == 'Minggu') {
            $('.day:eq(' + (i - 1) + ')').addClass("text-danger text-bold").removeClass("text-default");
        } else {
            $('.day:eq(' + (i - 1) + ')').addClass("text-default").removeClass("text-danger text-bold");
        }

        // 30 atau 31 Hari
        if (d.getMonth() != month) {
            $('.row-card:eq(' + (i - 1) + ')').hide();
        } else {
            $('.row-card:eq(' + (i - 1) + ')').show();
        }

        $('.day:eq(' + (i - 1) + ')').text(day);
        for (var j = 0; j < dt_agenda.length; j++) {
            if ((dt_agenda[j].URUT_TGL).trim() == i) {
                ruang = dt_agenda[j].RUANG;
                waktu = dt_agenda[j].WAKTU;
                agenda = dt_agenda[j].AGENDA;
                pic = dt_agenda[j].PIC;
                status = dt_agenda[j].STATUS;
                qty = dt_agenda[j].QTY_PERSON;
                dt_agenda[j].NOTE == null ? note = '' : note = dt_agenda[j].NOTE;

                if (status == '1') {
                    st = 'Open';
                    warna = '#52FA95';
                    warna_waktu = 'green';
                } else if (status == '0') {
                    st = 'Batal';
                    warna = '#F3C923';
                    warna_waktu = 'green';
                } else {
                    st = 'Close';
                    warna = '#FEC8C8';
                    warna_waktu = 'red';
                }
                title = "Peserta : " + qty + "\n" + "Fasilitas : " + note;
                $('.agenda_detail:eq(' + (i - 1) + ')').append(
                    '<div class="col">' +
                    '<div class="card p-3" style="background-color: ' + warna + '; cursor: pointer;" title="' + title + '">' +
                    '<div class="row text-bold">' + ruang + '</div>' +
                    '<div class="row text-bold" style="color: ' + warna_waktu + ';">' + waktu + ' (' + st + ')</div>' +
                    '<div class="row text-bold" style="font-size: 12px;">' + agenda + '</div>' +
                    '<div class="row" style="font-size: 12px;">' + pic + '</div>' +
                    '<div class="row hadir" hidden><button type="button" class="btn btn-warning btn-sm mt-3" title="Daftar Hadir" data-toggle="modal" data-target="#modal_sign"><b><i class="fa fa-check-square-o"></i></button></div></div></div>');
            }
            if (status != '1') {
                $('.hadir').addClass('invisible');
            }
        }

       // Arrange Height Card
       current_card_height = $('.agenda_detail:eq(' + (i - 1) + ')').height() + 20;
       if (current_card_height > card_height) {
        card_height = current_card_height;
    }
    if (i % 6 == 0) {
        for (var j = (i - 1); j >= (i - 6); j--) {
            $('.card-height:eq(' + j + ')').height(card_height);
        }
        card_height = 46;
    }
    $('.card-height:eq(30)').height(card_height);
}
}

// Format Bulan
function format_tanggal(bln) {
    var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return month[bln];
}

// Previous Month
function prev() {
    for (var i = 0; i <= 31; i++) {
        $('.agenda_detail:eq(' + i + ')').html('');
        $('.card-height:eq(' + i + ')').height(46);
    }

    bln = bln - 1;
    if (bln == '00') {
        bln = '12';
        thn = thn - 1;
    }
    periode = String(thn) + String(bln.toString().padStart(2, "0"));
    get_agenda(periode);

    periode = format_tanggal(Number(bln) - 1);
    $('.periode').html(periode + '-20' + thn);
}

// Next Month
function next() {
    for (var i = 0; i <= 31; i++) {
        $('.agenda_detail:eq(' + (i) + ')').html('');
        $('.card-height:eq(' + i + ')').height(46);
    }

    bln = Number(bln) + 1;
    if (bln == '13') {
        bln = '1';
        thn = Number(thn) + 1;
    }
    periode = String(thn) + String(bln.toString().padStart(2, "0"));
    get_agenda(periode);

    periode = format_tanggal(Number(bln) - 1);
    $('.periode').html(periode + '-20' + thn);
}

// Expands & Collapse Card Info
$('.info_1:eq(0)').on('click', function() {
    if (info_1 == 0) {
        $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_1 = 1;
    } else {
        $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_1 = 0;
    }
});
$('.info_2:eq(0)').on('click', function() {
    if (info_2 == 0) {
        $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_2 = 1;
    } else {
        $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_2 = 0;
    }
    setTimeout(function() {
        data_table.columns.adjust().draw();
    }, 500);
});
$('.info_3:eq(0)').on('click', function() {
    if (info_3 == 0) {
        $('.info_3:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_3 = 1;
    } else {
        $('.info_3:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_3 = 0;
    }
});
</script>