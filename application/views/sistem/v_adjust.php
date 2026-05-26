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

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Input Nilai Khusus</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Sistem - Manual Book Adjust Nilai.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus info_1"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table width="100%">
                    <th width="15%">Tanggal</th>
                    <td width="5%">:</td>
                    <td rowspan="3" width="30%"><input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="width: 40%; background-color: #FFFFFF; cursor: pointer;" readonly></td>
                    <th width="10%">Nilai</th>
                    <td width="5%">:</td>
                    <td width="35%"><input type="text" id="nilai" onfocusout="cek_isian(this)" class="form-control" autocomplete="off" style="width: 30%;" oninput="this.value = this.value.replace(/[^0-9.-]/g, '').replace(/(\..*)\./g, '$1');" maxlength="5" tabindex="1"></td>
                </tr>
                <tr style="height: 15px;"></tr>
                <tr>
                    <tr>
                        <th>Nama Karyawan</th>
                        <td>:</td>
                        <td>
                            <select id="karyawan" class="form-control select" style="width: 80%;">
                                <option value="">Pilih Nama..</option>
                                <?php $id_kary = array(); ?>
                                <?php $bagian = array(); ?>
                                <?php foreach ($karyawan->result_array() as $pic) : ?>
                                    <option><?php echo $pic['NAMA']; ?></option>
                                    <?php array_push($id_kary, $pic['ID']); ?>
                                    <?php array_push($bagian, $pic['BAGIAN']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <th>Kategori</th>
                        <td>:</td>
                        <td>
                            <select class="select" id="kategori" style="width: 50%;">
                                <option selected>Khusus</option>
                                <option <?php if ($level > 20) {echo "disabled";} ?>>Jabatan</option>
                            </select>
                        </td>
                    </tr>
                    <tr style="height: 15px;"></tr>
                    <tr>
                        <th>Bagian</th>
                        <td>:</td>
                        <td><input type="text" id="bagian" class="form-control" autocomplete="off" style="width: 60%;" readonly></td>
                        <th>Keterangan</th>
                        <td>:</td>
                        <td><input type="text" id="keterangan" class="form-control" autocomplete="off" maxlength="50" style="width: 90%;" tabindex="2"></td>
                    </tr>
                </table>
            </div>

            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Laporan Data Nilai Khusus</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="50%"><button type="button" class="btn btn-block btn-warning tab-lap" onclick="tab_select(this)">Khusus</button></td>
                        <td width="50%"><button type="button" class="btn btn-block btn-default tab-lap" onclick="tab_select(this)">Jabatan</button></td>
                    </tr>
                </table>
            </div>

            <div class="card-body tab1">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 11px; overflow-y: hidden;">
                                <table style="width: 250px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td colspan="2" class="filter">Filter Tanggal</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" id="fTgl1" class="form-control datepicker" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" style="cursor: pointer; background-color: #FFFFFF; text-align: center;" readonly></td>
                                            <td><input type="text" id="fTgl2" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" onchange="filter()" style="cursor: pointer; background-color: #FFFFFF; text-align: center;" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-2 table-responsive" style="width: 100%; font-size: 12px;">
                                <div class="datatable"></div>
                            </div>

                            <button width="150" type="button" class="btn btn-success" title="Export to Excel" onclick="$('.btnExcel2:eq(0)').click()"><i class="fa fa-clipboard m-2"></i><b>Export Excel</b></button>

                        </font>
                    </div>
                </div>
            </div>

            <div class="card-body tab2" style="display: none;">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <div class="mt-2 table-responsive" style="width: 100%; font-size: 12px;">
                                <div class="datatable_jabatan"></div>
                            </div>
                        </font>
                        <button width="150" type="button" class="btn btn-success" title="Export to Excel" onclick="$('.btnExcel:eq(0)').click()"><i class="fa fa-clipboard m-2"></i><b>Export Excel</b></button>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <font color="Green" size="2">ERP @2019</font>
            </div>

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

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
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

<!-- Data Tables -->
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

var info_1 = 0, info_2 = 0; // Status Card Info
var id_nilai_plus = ''; // Edit Data

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    $(".datepicker").datepicker({
        dateFormat: 'dd-M-yy'
    });
    $('#nilai').focus();
    filter();
    filter_jabatan();
});

// Cek isian selain format number
function cek_isian(btn) {
    var isian = btn.value;
    if (isNaN(isian) || isian > 5) {
        btn.focus();
    }
}

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    var table = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari Nama Karyawan  :"},
        "info": false,
        "order": [1, "asc"],
        "autoWidth": true,
        "scrollX": true,
        "scrollY": '350px',
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            orientation: 'landscape',
            exportOptions: {
                columns: ':visible'
            },
            className: 'invisible btnExcel2',
            title: 'Laporan Data Nilai Khusus'
        }],
        "colReorder": true
    });

    setTimeout(function() {table.columns.adjust().draw();}, 500);
}

// Pagination
function pagination_jabatan() {
    $('#data-table-jabatan').DataTable().destroy();
    var table = $('#data-table-jabatan').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari Nama Karyawan  :"},
        "info": false,
        "order": [1, "asc"],
        "autoWidth": true,
        "scrollX": true,
        "scrollY": '350px',
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            orientation: 'landscape',
            exportOptions: {
                columns: ':visible'
            },
            className: 'invisible btnExcel',
            title: 'Laporan Data Nilai Jabatan'
        }],
        "colReorder": true,
        "columnDefs": [{width: 10, targets: 8}]
    });

    setTimeout(function() {table.columns.adjust().draw();}, 500);
}

// Pilih Karyawan
$('#karyawan').on('change', function() {
    var indeks = document.getElementById('karyawan').selectedIndex - 1;
    var bagian = <?php echo json_encode($bagian); ?>;

    $('#bagian').val(bagian[indeks]);
});

// Kosong Isian
function kosong() {
    $('#karyawan').val('').change();
    $('#bagian').val('');
    $('#nilai').val('');
    $('#keterangan').val('');
    $('#nilai').focus();

    id_kary = '';
    id_nilai_plus = '';
}

// Simpan Data
function simpan() {
    var indeks = document.getElementById('karyawan').selectedIndex - 1;
    var id_kary = <?php echo json_encode($id_kary); ?>;
    var tgl = $('#tgl').val();
    var bagian = $('#bagian').val();
    var nilai = $('#nilai').val();
    id_kary = id_kary[indeks];
    var keterangan = $('#keterangan').val();
    var kategori = $('#kategori').val();
    var data = [id_kary, nilai, keterangan, kategori, tgl, id_nilai_plus];
    var variable = ["bagian", "nilai", "keterangan", "kategori"];

    if (bagian == '') {
        $('#bagian').css('border-color', '#ff0000');
        setTimeout(function() {
            $('#bagian').css('border-color', '#d2cbcb');
        }, 2000);
    }
    if (nilai == '') {
        $('#nilai').css('border-color', '#ff0000');
        setTimeout(function() {
            $('#nilai').css('border-color', '#d2cbcb');
        }, 2000);
    }
    if (keterangan == '' && kategori == 'Khusus') {
        $('#keterangan').css('border-color', '#ff0000');
        setTimeout(function() {
            $('#keterangan').css('border-color', '#d2cbcb');
        }, 2000);
    }

    if (bagian == '' || nilai == '' || (keterangan == '' && kategori == 'Khusus')) {
        $('#btnIsian').click();
        return;
    }

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/adjust/simpan',
        data: {data: data},
        success: function(data) {
            $('.datatable').html(data);

            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();

                kosong();
                filter();
            }, 500);
        }
    });
}

// Filter Data Table
function filter() {
    var tgl1 = document.getElementById('fTgl1').value;
    var tgl2 = document.getElementById('fTgl2').value;
    var data = [tgl1, tgl2];

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/sistem/adjust/filter" ?>',
        success: function(data) {
            $('.datatable').html(data);
            pagination();
        }
    });
}

// Filter Data Jabatan
function filter_jabatan() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url() . "index.php/sistem/adjust/filter_jabatan" ?>',
        success: function(data) {
            $('.datatable_jabatan').html(data);
            pagination_jabatan();
        }
    });
}

// Tab Selection Laporan
function tab_select(e) {
    $('.tab-lap').removeClass("btn-info").addClass("btn-default");
    e.classList.remove("btn-default");
    e.classList.add("btn-warning");

    if ((e.innerText).trim() == 'Khusus') {
        tab = 'Khusus';
        $('.tab1').css('display', 'block');
        $('.tab2').css('display', 'none');
        pagination();
    } else {
        tab = 'Jabatan';
        $('.tab1').css('display', 'none');
        $('.tab2').css('display', 'block');
        setTimeout(function() {pagination_jabatan();}, 100);
    }
}

// Hapus Data
function hapus(btn) {
    var data_table = document.getElementById('data-table-jabatan');
    var row = $(btn).closest("tr").index() + 1;
    var id = data_table.rows[row].cells[0].innerHTML;

    $('#btnHapus').click();
    $('#btnYa').on('click', function() {
        if (id == '') {return;}

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/adjust/hapus" ?>',
            data: {data: id},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    id = '';
                    filter_jabatan();
                }, 500);
            }
        });
    });

    $('#btnNo').on('click', function() {
        if (id == '') {return;}
        id = '';
    });
}

// Edit Data
function edit(btn) {
    var data_table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var tgl = data_table.rows[row].cells[2].innerHTML;
    var nama = data_table.rows[row].cells[4].innerHTML;
    var bagian = data_table.rows[row].cells[5].innerHTML;
    var nilai = data_table.rows[row].cells[7].innerHTML;
    var keterangan = data_table.rows[row].cells[8].innerHTML;

    id_nilai_plus = data_table.rows[row].cells[0].innerHTML;

    $('#tgl').val(tgl).change();
    $('#karyawan').val(nama).change();
    $('#bagian').val(bagian).change();
    $('#nilai').val(nilai).change();
    $('#kategori').val('Khusus').change();
    $('#keterangan').val(keterangan).change();
    $('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
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
});
</script>