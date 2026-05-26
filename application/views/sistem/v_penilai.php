<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- JQuery -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>.select2-container--open {z-index: 9999999;}</style>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Master Data Penilai</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Sistem - Manual Book Master Penilai.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="15%">Nama Penilai</th>
                        <td width="40%">
                            <select class="select" id="nama" style="width: 80%;">
                                <option value="">Pilih penilai..</option>
                            </select>
                        </td>
                        <th width="15%">Jabatan</th>
                        <td width="30%">
                            <input type="text" class="form-control" id="jabatan" style="width: 70%;" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Bagian</th>
                        <td>
                            <input type="text" class="form-control" id="bagian" style="width: 50%;" readonly>
                        </td>
                        <th>Kategori</th>
                        <td>
                            <select class="select" id="kategori" style="width: 70%;">
                                <option value="">Pilih kategori..</option>
                                <option>Atasan Langsung</option>
                                <option>Manajemen</option>
                                <option>Kolega</option>
                                <option>Kolega 1</option>
                                <option>Kolega 2</option>
                                <option>HR</option>
                                <option>IS</option>
                                <option>K3</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-block btn-success mb-3" id="addKaryawan" title="Tambah Karyawan" style="width:20%;"><i class="fa ion-person-add m-2"></i><b>Karyawan</b></button>
                <table id="tabel_karyawan" class="table table-bordered" width="100%">
                    <thead style="background-color: #069CB7; font-weight: bold; color: #FFFFFF;">
                        <tr style="text-align: center;">
                            <td width="10%">No</td>
                            <td width="15%">NIK</td>
                            <td width="35%">Nama Karyawan</td>
                            <td width="20%">Bagian</td>
                            <td width="20%">Jabatan</td>
                            <td hidden></td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" title="Simpan Data" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" title="Kosongkan Isian" onclick="kosong_all()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Data Penilai</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="50%"><button type="button" class="btn btn-block btn-warning tab-lap text-bold" onclick="tab_select(this)">Penilai</button></td>
                        <td width="50%"><button type="button" class="btn btn-block btn-default tab-lap text-bold" onclick="tab_select(this)">Karyawan</button></td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="tab1">
                            <table style="width: 30%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="100%" class="filter">Nama Penilai</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari_penilai" class="cari" onkeyup="filter()" placeholder="Cari nama penilai.." style="width: 100%;" autocomplete="off"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php $this->load->view('sistem/v_penilai_table'); ?>
                        </div>
                        <div class="tab2" style="display: none;">
                            <table style="width: 50%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="45%" class="filter">Nama Karyawan</td>
                                        <td></td>
                                        <td width="25%" class="filter">Unit</td>
                                        <td></td>
                                        <td width="30%" class="filter">Bagian</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari_karyawan" class="cari" onkeyup="filter()" placeholder="Cari nama karyawan.." style="width: 100%;" autocomplete="off">
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fUnit" style="width: 100%;" onchange="filter()">
                                                <option value="All">Pilih Unit..</option>
                                                <?php foreach ($unit->result_array() as $dt) { ?>
                                                    <option><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fBagian" style="width: 100%;" onchange="filter()">
                                                <option value="All">Pilih Bagian..</option>
                                                <?php foreach ($bagian->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php $this->load->view('sistem/v_penilai_table_detail'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body tab1">
                <table style="margin-top: -30px;">
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-success" title="Export to Excel" id="btnExcel"><i class="fa fa-clipboard m-2"></i><b>Export Excel</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" title="Informasi Lebih" id="btnPreview"><i class="fa ion-clipboard m-2"></i><b>More Info</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" title="Hapus Data" onclick="hapus_data()"><i class="fa ion-trash-a m-2"></i><b>Hapus</b></button></td>
                    </tr>
                </table>
            </div>

            <div class="card-body tab2" style="display: none;">
                <table style="margin-top: -30px;">
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-success" title="Export to Excel" id="btnExcel2"><i class="fa fa-clipboard m-2"></i><b>Export Excel</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card-footer">
            <font color="Green" size="2">ERP @2019</font>
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
<div class="modal fade" id="modal_hapus" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="ya_list" style="width: 50%; display: none;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="modal-preview" style="z-index: 9998;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
                <h3 class="card-title">
                    <b>
                        <font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">
                            <p id="judul">More Information</p>
                        </font>
                    </b>
                </h3>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="33.4%"><button type="button" class="btn btn-block btn-info tab">Atasan Langsung</button></td>
                        <td width="33.3%"><button type="button" class="btn btn-block btn-default tab">Manajemen</button></td>
                        <td width="33.3%"><button type="button" class="btn btn-block btn-default tab">Kolega</button></td>
                    </tr>
                    <tr style="height: 2px;"></tr>
                    <tr>
                        <td><button type="button" class="btn btn-block btn-default tab">HR</button></td>
                        <td><button type="button" class="btn btn-block btn-default tab">IS</button></td>
                        <td><button type="button" class="btn btn-block btn-default tab">K3</button></td>
                    </tr>
                    <tr style="height: 2px;"></tr>
                    <tr>
                        <td><button type="button" class="btn btn-block btn-default tab">Kolega 1</button></td>
                        <td><button type="button" class="btn btn-block btn-default tab">Kolega 2</button></td>
                    </tr>
                </table>
            </div>
            <div class="modal-body">
                <select class="select" id="tUnit" style="width: 150px;" onchange="tFilter()">
                    <option value="All">All Unit..</option>
                    <?php foreach ($unit->result_array() as $dt) { ?>
                        <option><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                    <?php } ?>
                </select>
                <table id="table_preview" class="table table-bordered mt-3" width="100%">
                    <thead>
                        <tr>
                            <th width="10%" style="text-align: center;">No</th>
                            <th width="15%" style="text-align: center;">NIK</th>
                            <th width="35%" style="text-align: center;">Nama Karyawan</th>
                            <th width="20%" style="text-align: center;">Bagian</th>
                            <th width="20%" style="text-align: center;">Jabatan</th>
                            <th></th>
                            <th hidden></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <div class="modal-footer">
                    <button style="width: 30%;" class="btn btn-success" data-dismiss="modal" onclick="edit()" hidden>Edit</button>
                    <button id="modal_tutup" style="width: 30%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Tutup</b></button>
                    <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
                </div>
            </div>
        </div>
    </div>
</div>

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
var id_penilai = '', id_penilai_edit = '', id_penilai_preview = '', tab = 'Penilai';
var arr_id_karyawan = [], arr_nik = [], arr_bagian = [], arr_jabatan = [];
var arr_kategori = ['Atasan Langsung', 'Manajemen', 'Kolega', 'HR', 'IS', 'K3', 'Kolega 1', 'Kolega 2'];
var info_1 = 0, info_2 = 0;

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    isi_combo();
    pagination();
    pagination_detail();
});

// Pagination
function pagination() {
    var qty_data = $('#data-table tr').length;

    if (qty_data == 1) {
        height = "100px";
    } else if (qty_data > 5) {
        height = "400px";
    } else {
        height = ((qty_data - 1) * 100) + "px";
    }

    $('#data-table').DataTable().destroy();
    var table = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "scrollX": true,
        "scrollY": height,
        "order": [[1, "asc"]],
        "info": false,
        "autoWidth": true,
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            },
            className: 'invisible btnExcel',
            title: 'Laporan Data Penilai'
        }]
    });
}

// Pagination Detail Preview
function pagination_detail() {
    var qty_data = $('#data-detail tr').length;

    if (qty_data == 1) {
        height = "100px";
    } else if (qty_data > 5) {
        height = "400px";
    } else {
        height = ((qty_data - 1) * 100) + "px";
    }

    $('#data-detail').DataTable().destroy();
    var table = $('#data-detail').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari Nama Karyawan  :"},
        "scrollX": true,
        "scrollY": height,
        "order": [[0, "asc"]],
        "info": false,
        "autoWidth": true,
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            },
            className: 'invisible btnExcel2',
            title: 'Laporan Data Penilai'
        }]
    });
}

// Kosong Isian
function kosong() {
    $('#bagian').val('');
    $('#jabatan').val('');
    $('#kategori').val('').change();

    arr_id_karyawan = [], arr_nik = [], arr_bagian = [], arr_jabatan = [];
    id_penilai = '';
}

function kosong_all() {
    $('#nama').val('').change();
    $("#tabel_karyawan").find("tr:gt(0)").remove();
    $(".action").prop('checked', false);
    $('#judul').html('More Information');
}

// Isi Combo Karyawan
function isi_combo() {
    var arr_id_penilai = [],
    arr_bagian_penilai = [],
    arr_jabatan_penilai = [];

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/data_karyawan',
        success: function(data) {
            data = JSON.parse(data);
            var select = document.getElementById('nama');
            for (var i = 0; i < data.length; i++) {
                select.options[select.options.length] = new Option(data[i]['NAMA'].toUpperCase());
                arr_id_penilai.push(data[i]['ID_KARYAWAN']);
                arr_bagian_penilai.push(data[i]['BAGIAN']);
                arr_jabatan_penilai.push(data[i]['JABATAN']);
            }
        }
    });

    // Isi Bagian dan Jabatan
    $('#nama').on('change', function() {
        var indeks = document.querySelector('#nama').selectedIndex - 1;

        kosong();
        if (indeks != '-1') {
            id_penilai = arr_id_penilai[indeks];
            $('#bagian').val(arr_bagian_penilai[indeks]);
            $('#jabatan').val(arr_jabatan_penilai[indeks]);
        }
    });

}

// Kosongkan table saat kategori dipilih
$('#kategori').on('change', function() {
    $("#tabel_karyawan").find("tr:gt(0)").remove();
});

// + Tambah Karyawan
$('#addKaryawan').on('click', function() {
    var kategori = $('#kategori').val();

    arr_id_karyawan = [], arr_nik = [], arr_bagian = [], arr_jabatan = [];
    if (kategori == '') {
        return;
    }

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/ambil_karyawan',
        data: {data: kategori},
        success: function(data) {
            data = JSON.parse(data);
            $('#tabel_karyawan').append(
                '<tr>' +
                '<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
                '<td><input type="text" class="form-control" name="nik" style="width: 100%; text-align: center;" readonly></td>' +
                '<td><select class="form-control select" style="width: 100%;" name="nama" onchange="isi_data(this)">' +
                '<option value="">Pilih karyawan..</option>' +
                '<td><input type="text" class="form-control" name="bagian" style="width: 100%; text-align: center;" readonly></td>' +
                '<td><input type="text" class="form-control" name="jabatan" style="width: 100%; text-align: center;" readonly></td>' +
                '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Karyawan" onclick="hapus_karyawan(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
                '<td hidden></td>' +
                '<td hidden></td>' +
                '</tr>')

            var select = document.getElementsByName('nama')[$('#tabel_karyawan tr').length - 2];
            for (var i = 0; i < data.length; i++) {
                select.options[select.options.length] = new Option(data[i]['NAMA'].toUpperCase());
                arr_id_karyawan.push(data[i]['ID_KARYAWAN']);
                arr_nik.push(data[i]['NIK']);
                arr_bagian.push(data[i]['BAGIAN']);
                arr_jabatan.push(data[i]['JABATAN']);
            }

            $(".select").select2();
            urut_karyawan();
        }
    });
});

// Isi Data Karyawan
function isi_data(btn) {
    var row = $(btn).closest("tr").index();
    var index = btn.selectedIndex - 1;

    document.getElementsByName('nik')[row].value = arr_nik[index];
    document.getElementsByName('bagian')[row].value = arr_bagian[index];
    document.getElementsByName('jabatan')[row].value = arr_jabatan[index];
    tabel_karyawan.rows[row + 1].cells[6].innerText = arr_id_karyawan[index];
}

// Isi Nomor Karyawan
function urut_karyawan() {
    for (var i = 0; i < tabel_karyawan.rows.length - 1; i++) {
        document.getElementsByName('nmr')[i].value = i + 1;
    }
}

// Hapus Karyawan
function hapus_karyawan(btn) {
    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    urut_karyawan();
};

// Simpan Data
function simpan() {
    var kategori = $('#kategori').val();
    var id_karyawan = [],
    id_kategori_edit = [];

    if (id_penilai == '' || kategori == '' || tabel_karyawan.rows.length == 1) {
        $('#btnIsian').click();
        return;
    }

    // Array Karyawan
    for (var i = 0; i < tabel_karyawan.rows.length - 1; i++) {
        if (tabel_karyawan.rows[i + 1].cells[6].innerHTML == '') {
            $('#btnIsian').click();
            return;
        }

        id_karyawan.push(tabel_karyawan.rows[i + 1].cells[6].innerHTML);
        id_kategori_edit.push(tabel_karyawan.rows[i + 1].cells[7].innerHTML);
    }

    var data = [id_penilai_edit, id_penilai, kategori, id_karyawan, id_kategori_edit];
    $('#btnProgress').click();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/simpan_penilai',
        data: {
            data: data
        },
        success: function(data) {
            setTimeout(function() {
                kosong_all();
                filter();

                $('#btnOk').click();
                $('#btnSukses').click();
            }, 500);
        }
    });
}

// Filter Data
function filter() {
    var cari_penilai = document.getElementById("cari_penilai").value;
    var cari_karyawan = document.getElementById("cari_karyawan").value;
    var i_bagian = document.getElementById('fBagian').selectedIndex-1;
    var dt_bagian = <?php echo json_encode($bagian->result_array()); ?>;
    i_bagian == -1 ? id_bagian = 'All' : id_bagian = dt_bagian[i_bagian].ID;  
    var i_unit = document.getElementById('fUnit').selectedIndex-1;
    var dt_unit = <?php echo json_encode($unit->result_array()); ?>; 
    i_unit == -1 ? kd_unit = 'All' : kd_unit = dt_unit[i_unit].KD_UNIT;
    var data = [cari_penilai, cari_karyawan, tab, id_bagian, kd_unit];
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/filter_nilai',
        data: {
            data: data
        },
        success: function(data) {
            if (tab == 'Penilai') {
                $('.data-table1').html(data);
                pagination();
            } else {
                $('.data-table2').html(data);
                pagination_detail();
            }
        }
    });
}

// Tab Selection Laporan
function tab_select(e) {
    $('.tab-lap').removeClass("btn-info").addClass("btn-default");
    e.classList.remove("btn-default");
    e.classList.add("btn-warning");

    if ((e.innerText).trim() == 'Penilai') {
        tab = 'Penilai';
        $('.tab1').css('display', 'block');
        $('.tab2').css('display', 'none');
        pagination();
    } else {
        tab = 'Karyawan';
        $('.tab1').css('display', 'none');
        $('.tab2').css('display', 'block');
        pagination_detail();
    }
}

// Hapus Data
function hapus_data() {
    if (id_penilai_preview == '') {
        return;
    }
    $('#btnHapus').click();
    $('#ya').css('display', 'block');
    $('#ya_list').css('display', 'none');
}
$('#ya').on('click', function() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/hapus_penilai',
        data: {
            data: id_penilai_preview
        },
        success: function(data) {
            filter();
        }
    });
});

// Tab Selection Laporan
function tab_select(e) {
    $('.tab-lap').removeClass("btn-info").addClass("btn-default");
    e.classList.remove("btn-default");
    e.classList.add("btn-warning");

    if ((e.innerText).trim() == 'Penilai') {
        tab = 'Penilai';
        $('.tab1').css('display', 'block');
        $('.tab2').css('display', 'none');
        pagination();
    } else {
        tab = 'Karyawan';
        $('.tab1').css('display', 'none');
        $('.tab2').css('display', 'block');
        pagination_detail();
    }
}

// Ambil ID Sistem Penilai
function get_action(btn) {
    var data_table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    id_penilai_preview = data_table.rows[row].cells[0].innerHTML;
    nama = data_table.rows[row].cells[3].innerHTML;

    $('#judul').html('Informasi Penilai ' + nama);
}

// Info Penilai
$('#btnPreview').on('click', function() {
    $('#modal_preview').click();
    $('.tab')[0].click();

    if (id_penilai_preview == '') {
        return;
    }
});

// Export Excel Penilai
$('#btnExcel').on('click', function() {
    $('.btnExcel1')[0].click();
});

// Export Excel Detail Penilai
$('#btnExcel2').on('click', function() {
    $('.btnExcel2')[0].click();
});

// Tab Selection
$('.tab').on('click', function(e) {
    $('#table_preview').DataTable().destroy();
    index_tab = $(this).index('.tab');
    $('.tab').removeClass("btn-info").addClass("btn-default");
    e.target.classList.remove("btn-default");
    e.target.classList.add("btn-info");

    isi_karyawan(arr_kategori[index_tab]);
});

// Filter Modal Penilai
function tFilter() {
    isi_karyawan(arr_kategori[index_tab]);
}

// Isi Karyawan yang Dinilai
function isi_karyawan(kategori) {
    var unit = $('#tUnit').val().toUpperCase();
    var data = [id_penilai_preview, kategori, unit];

    $('#table_preview').DataTable().destroy();
    $("#table_preview").find("tr:gt(0)").remove();

    $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/preview_penilai',
        data: {data: data},
        success: function(data) {
            data = JSON.parse(data);
            if (data.length == 0) {return;}

            for (var i = 0; i < data.length; i++) {
                nik = data[i]['NIK'];
                nama = data[i]['NAMA'].toUpperCase();
                bagian = data[i]['BAGIAN'].toUpperCase();
                jabatan = data[i]['JABATAN'].toUpperCase();
                id_sis_kategori = data[i]['ID_SIS_KATEGORI'];
                $('#table_preview').append(
                    '<tr>' +
                    '<td align="center">' + (i + 1) + '</td>' +
                    '<td align="center">' + nik + '</td>' +
                    '<td>' + nama + '</td>' +
                    '<td>' + bagian + '</td>' +
                    '<td>' + jabatan + '</td>' +
                    '<td><button type="button" class="btn btn-block btn-danger" title="Hapus List" onclick="hapus_list(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
                    '<td hidden>' + id_sis_kategori + '</td>' +
                    '</tr>')
            }
        }
    });
    pagination_preview();
}

// Pagination Modal Penilai
function pagination_preview() {
    $('#table_preview').DataTable({
        "paging": true,
        "lengthChange": false,
        "pageLength": 8,
        "searching": true,
        "oLanguage": {"sSearch": "Cari :"},
        "order": [[0, "asc"]],
        "info": false,
        "autoWidth": true
    });
}

// Hapus List Karyawan
function hapus_list(btn) {
    var table_preview = document.getElementById('table_preview');
    var row = $(btn).closest("tr").index() + 1;
    id_sis_kategori = table_preview.rows[row].cells[6].innerHTML;

    $('#btnHapus').click();
    $('#ya').css('display', 'none');
    $('#ya_list').css('display', 'block');
};
$('#ya_list').on('click', function() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/hapus_sis_kategori',
        data: {
            data: id_sis_kategori
        },
        success: function(data) {
            $('#kategori').val('').change();
            isi_karyawan(arr_kategori[index_tab]);
        }
    });
});

// Edit Data
function edit() {
    var data = [id_penilai_preview, arr_kategori[index_tab]];
    kosong_all();

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/penilai/preview_penilai',
        data: {
            data: data
        },
        success: function(data) {
            data = JSON.parse(data);

            if (data.length == 0) {
                return;
            }
            $('#nama').val(data[0]['NAMA_PENILAI']).change();
            $('#kategori').val(data[0]['KATEGORI']).change();

            $('#btnProgress').click();
            setTimeout(function() {
                for (var i = 0; i < data.length; i++) {
                    nik = data[i]['NIK'];
                    nama = data[i]['NAMA'];
                    bagian = data[i]['BAGIAN'];
                    jabatan = data[i]['JABATAN'];
                    id_karyawan = data[i]['ID_KARYAWAN'];
                    id_sis_penilai = data[i]['ID_SIS_PENILAI'];
                    id_sis_kategori = data[i]['ID_SIS_KATEGORI'];
                    $('#tabel_karyawan').append(
                        '<tr>' +
                        '<td><input type="text" class="form-control" name="nmr" value=' + (i + 1) + ' style="width: 100%; text-align:center;" readonly></td>' +
                        '<td><input type="text" class="form-control" name="nik" value=' + nik + ' style="width: 100%; text-align: center;" readonly></td>' +
                        '<td><select class="form-control select" style="width: 100%;" name="nama" onchange="isi_data(this)" disabled>' +
                        '<option value="">Pilih karyawan..</option> ' +
                        '<?php foreach ($karyawan->result_array() as $dt) : ?>' +
                        '<option><?php echo $dt['NAMA']; ?></option>' +
                        arr_id_karyawan.push(<?php echo json_encode($dt['ID_KARYAWAN']); ?>) +
                        arr_nik.push(<?php echo json_encode($dt['NIK']); ?>) +
                        arr_bagian.push(<?php echo json_encode($dt['BAGIAN']); ?>) +
                        arr_jabatan.push(<?php echo json_encode($dt['JABATAN']); ?>) +
                        '<?php endforeach; ?>' +
                        '<td><input type="text" class="form-control" name="bagian" value=' + bagian + ' style="width: 100%; text-align: center;" readonly></td>' +
                        '<td><input type="text" class="form-control" name="jabatan" value=' + jabatan + ' style="width: 100%; text-align: center;" readonly></td>' +
                        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Karyawan" onclick="hapus_karyawan(this)" style="margin-top: 0;">X</button></td>' +
                        '<td hidden>' + id_karyawan + '</td>' +
                        '<td hidden>' + id_sis_kategori + '</td>' +
                        '</tr>')
                    document.getElementsByName('nama')[i].value = nama;
                }
                $(".select").select2();
                $('#btnOk').click();
            }, 1000);
        }
    });
}

// Drag Div Document
$("#modal-preview").draggable({
    handle: ".card-header"
});

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