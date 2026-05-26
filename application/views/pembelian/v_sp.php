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

<div class="content-wrapper" id="non_printable">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div id="headerinput">Input Barang Datang</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" id="minimize" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus info_1"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <table width="100%" border="0">
                            <tr>
                                <th width="40%">No. Surat Pengantar</th>
                                <td width="60%">
                                    <input type="text" id="no_sp" class="form-control" style="width: 100%; text-transform: uppercase;" autocomplete="off" maxlength="12" tabindex="1">
                                </td>
                            </tr>
                            <tr style="height: 5px;"></tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <input type="text" id="tgl" class="form-control datepicker" tabindex="2" value="<?php echo date("d-M-Y"); ?>" style="width: 100%; background-color: #FFFFFF; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 5px;"></tr>
                            <tr>
                                <th>Supplier</th>
                                <td>
                                    <select class="select" id="supplier" onchange="hapus_tabel()" style="width: 100%;">
                                        <option value="">Pilih Supplier..</option>
                                        <?php foreach ($supplier->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 5px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%" border="0">
                            <tr>
                                <th width="40%">No. Kendaraan</th>
                                <td width="60%">
                                    <input type="text" id="no_kend" class="form-control" style="width: 100%; text-transform: uppercase;" value="-" tabindex="3" maxlength="8">
                                </td>
                            </tr>
                            <tr style="height: 5px;"></tr>
                            <tr>
                                <th>Divisi</th>
                                <td>
                                    <select class="select" id="unit" onchange="hapus_tabel()" style="width: 100%;">
                                        <?php foreach ($unit->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($kd_unit == $dt['KD_UNIT']) {echo 'selected';} ?>><?php echo $dt['UNIT']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 5px;"></tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>
                                    <input type="text" id="total_harga" class="form-control" style="width: 100%;" readonly>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div style="width: 1400px;">
                        <button type="button" class="btn btn-block" id="btn_material" style="width:130px; margin-bottom: 10px; color: #FFFFFF; font-size: 14px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Material</b></button>
                        <table id="tabel_material" class="table table-bordered" width="100%">
                            <thead style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
                                <tr style="text-align: center;">
                                    <td width="5%">No</td>
                                    <td width="7.5%">No. PO</td>
                                    <td width="20%">Nama Material</td>
                                    <td width="15%">Spesifikasi</td>
                                    <td width="10%">Satuan</td>
                                    <td width="7.5%">Qty Datang</td>
                                    <td width="7.5%">Qty PO</td>
                                    <td width="10%">Harga</td>
                                    <td width="7.5%">Mata Uang</td>
                                    <td width="10%">Total</td>
                                    <td hidden></td>
                                    <td hidden>Id PO Detail</td>
                                    <td hidden>Id SP Detail</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
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
                <h3 class="card-title"><b><font color="White">Laporan Data Barang Datang</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body" style="font-size: 13px;">
                        <div class="table-responsive">
                            <div style="width: 900px;">
                                <table style="width: 100%; margin-bottom: 15px; font-size: 13px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <th width="27.5%" colspan="2" class="filter">Periode</th>
                                            <td></td>
                                            <th width="15%" class="filter">Divisi</th>
                                            <td></td>
                                            <th width="15%" class="filter">Nomor SP</th>
                                            <td></td>
                                            <th width="22.5%" class="filter">Jenis Barang</th>
                                            <td></td>
                                            <th width="20%" class="filter">Kategori Barang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input id="f_Tgl1" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
                                            <td><input id="f_Tgl2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_unit" onchange="filter()" style="width: 100%;">
                                                    <?php foreach ($unit->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($kd_unit == $dt['KD_UNIT']) {echo 'selected';} ?>><?php echo $dt['UNIT']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_nmr" onchange="filter()" style="width: 100%;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($nmr->result_array() as $dt) { ?>
                                                        <option><?php echo $dt['NMR']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_jenis" onchange="filter()" style="width: 100%;">
                                                    <option>All..</option>
                                                    <?php foreach ($jenis->result_array() as $dt) { ?>
                                                        <option><?php echo $dt['JENIS']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_kategori" onchange="filter()" style="width: 100%;">
                                                    <option>All..</option>
                                                    <?php foreach ($kategori->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['KATEGORI']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="data-table" style="font-size: 12px;"></div>
                    </div>

                    <div class="card-footer">
                        <table>
                            <tr>
                                <td width="150"><button type="button" class="btn btn-block btn-success" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <font color="Green" size="2">ERP @2019</font>
        </div>
    </section>
</div>

<!-- Modal Data PO -->
<div class="modal fade" id="modal_po">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header m-2 rounded" style="cursor: all-scroll;">
                    <h3 class="card-title">
                        <b>
                            <font color="White">
                                <div id="headerinput">
                                    <h3>Data Purchase Order (SPP)</h3>
                                </div>
                            </font>
                        </b>
                    </h3>
                </div>
                <div class="card-body">
                    <table id="tbl_po" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
                        <thead>
                            <tr align="center">
                                <th>Pilih</th>
                                <th>No</th>
                                <th>Nomor SPP</th>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Qty PO</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Mata Uang</th>
                                <th hidden>ID PO Detail</th>
                            </tr>
                        </thead>
                        <tbody id="body_po">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer rounded">
                    <button style="width: 150px;" type="button" class="btn btn-warning" onclick="$('#btn_material').click()" title="Refresh Data PO"><i class="fa fa-archive m-2"></i><b>Refresh</b></button>
                    <button id='btn_pilih' style="width: 150px;" type="button" class="btn btn-success" data-dismiss="modal" title="Pilih Barang"><i class="fa ion-android-share m-2"></i><b>Pilih</b></button>
                    <button id="btn_po" data-toggle="modal" data-target="#modal_po" hidden></button>
                </div>
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

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <h5><div class="modal-body text-info invisible" id="error_isian"></div></h5>
            <div class="modal-footer">
                <button onclick="$('#error_isian').addClass('invisible')" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Batal SIP -->
<div class="modal fade" id="modal_batal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan membatalkan Transaksi? </div>
            <div class="modal-footer">
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_batal" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

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
var info_1 = 0, info_2 = 0;
var id_sp_edit = '', data_po = [];

// Load Dokumen
$(document).ready(function() {
    $('.fa-bars:eq(0)').click();
    $(".select").select2();
    $("#no_sp").focus();
    $(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

    filter();
});

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    var tbl_data = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "order": [[1, "asc"]],
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": "400px",
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {columns: ':visible'},
            className: 'invisible excel',
            filename: 'Laporan Data Barang Datang',
            title: ''
        }]
    });

    setTimeout(function() {tbl_data.columns.adjust().draw();}, 1000);
}

// Pagination
function pagination_input() {
    var tbl_po = $('#tbl_po').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "order": [[1, "asc"]],
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": "400px"
    });

    setTimeout(function() {tbl_po.columns.adjust().draw();}, 500);
}

// Cek Nomor SP
function cek_sp(no_sp) {
    var kd_unit = $('#unit').val();
    var data = [id_sp_edit, no_sp, kd_unit];

    $.ajax({
        data: {data: data},
        type: 'POST',
        async: false,
        url: '<?php echo base_url() . "index.php/pembelian/sp/cek_sp" ?>',
        success: function(data) {
            if (data != 0 && no_sp != '') {err_isian('Nomor SP sudah terpakai..');}
        }
    });
}

// Kosongkan Isian
function kosong() {
    $('#no_sp').val('').change();
    $('#tgl').val(<?php echo json_encode(date("d-M-Y")); ?>).change();
    $('#supplier').val('').change();
    $('#no_kend').val('-').change();
    $('#total_harga').val('').change();
    id_sp_edit = '';

    hapus_tabel();
}

function hapus_tabel() {
    $("#tabel_material").find("tr:gt(0)").remove();
}

// Tambah Material SIP
$('#btn_material').on('click', function() {
    var id_supplier = $('#supplier').val();
    var kd_unit = $('#unit').val();

    if (id_supplier == '') {err_isian('Supplier belum dipilih..');} 
    $.ajax({
        data: {data: [id_supplier, kd_unit]},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/sp/data_po" ?>',
        success: function(data) {
            data_po = JSON.parse(data);
            isi_data_po(data_po);

            pagination_input();
            $('#btn_po').click();
        }
    });
});

// Isi Data Material
function isi_data_po(data_po) {
    $('#tbl_po').DataTable().destroy();
    $("#body_po").find("tr").remove();

    for (var i = 0; i < data_po.length; i++) {
        no_po = data_po[i].NO_PO;
        nama_barang = data_po[i].NAMA_BARANG;
        spesifikasi = data_po[i].SPESIFIKASI;
        qty_po = desimal(data_po[i].QTY_PO);
        satuan = data_po[i].SATUAN;
        harga = desimal(data_po[i].HARGA);
        mata_uang = data_po[i].MATA_UANG;
        id_po_detail = data_po[i].ID_PO_DETAIL;

        $('#body_po').append('<tr><td align="center"><input type="checkbox" name="pilih_barang" style="cursor: pointer;"></td><td align="center">' + (i + 1) + '</td><td>' + no_po + '</td><td>' + nama_barang + '</td><td>' + spesifikasi + '</td><td align="right">' + format_number(qty_po) + '</td><td align="center">' + satuan + '</td><td align="right">' + format_number(harga) + '</td><td align="center">' + mata_uang + '</td><td hidden>' + id_po_detail + '</td></tr>');
    }
}

// Isi Material PO
$('#btn_pilih').click(function() {
    $('#tbl_po').DataTable().destroy();

    var tabel_material = document.getElementById('tabel_material');
    var tbl_po = document.getElementById('tbl_po');
    var qty_datang = '';
    var qty_data = tbl_po.rows.length;

    if (tbl_po.rows[1].cells[1].innerHTML != '1') {
        return;
    }
    for (var i = 0; i < qty_data - 1; i++) {
        var status = document.getElementsByName('pilih_barang')[i].checked;

        ganda = 0;
        if (status == true) {
            no_po = tbl_po.rows[i + 1].cells[2].innerHTML;
            nama_barang = tbl_po.rows[i + 1].cells[3].innerHTML;
            spesifikasi = tbl_po.rows[i + 1].cells[4].innerHTML;
            qty_po = tbl_po.rows[i + 1].cells[5].innerHTML;
            satuan = tbl_po.rows[i + 1].cells[6].innerHTML;
            harga = tbl_po.rows[i + 1].cells[7].innerHTML;
            mata_uang = tbl_po.rows[i + 1].cells[8].innerHTML;
            id_po_detail = tbl_po.rows[i + 1].cells[9].innerHTML;

            // Cegah material ganda
            for (var j = 0; j < tabel_material.rows.length - 1; j++) {
                t_id_po_detail = tabel_material.rows[j + 1].cells[11].innerHTML;

                if (t_id_po_detail == id_po_detail) {ganda++;}
            }

            if (ganda == 0) {
                isi_material(no_po, nama_barang, spesifikasi, qty_po, satuan, harga, mata_uang, id_po_detail, qty_datang);
            }
        }
    }
});

// Isi Data Material
function isi_material(no_po, nama_barang, spesifikasi, qty_po, satuan, harga, mata_uang, id_po_detail, qty_datang) {
    var option = document.createElement('option');

    if (data_po.length == 0) {
        return;
    }
    $('#tabel_material').append(
        '<tr>' +
        '<td><input type="text" class="form-control" name="urut" style="width: 100%; text-align:center;" readonly></td>' +
        '<td><input type="text" class="form-control" value="' + no_po + '" title="' + no_po + '" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><input type="text" class="form-control" value="' + nama_barang + '" style="width: 100%;" readonly></td>' +
        '<td><input type="text" class="form-control" value="' + spesifikasi + '" style="width: 100%;" readonly></td>' +
        '<td><input type="text" class="form-control" value="' + satuan + '" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><input type="text" class="form-control" name="qty_datang" value="' + qty_datang + '" style="width: 100%; text-align: center;" autocomplete="off" onkeyup="isi_total()" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
        '<td><input type="text" class="form-control" name="qty_po" value="' + qty_po + '" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><input type="text" class="form-control" name="harga" value="' + harga + '" style="width: 100%; text-align: right;" readonly></td>' +
        '<td><input type="text" class="form-control" value="' + mata_uang + '" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><input type="text" class="form-control" name="total" style="width: 100%; text-align: right;" readonly></td>' +
        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Material" onclick="hapus_material(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></button></td>' +
        '<td hidden>' + id_po_detail + '</td>' +
        '<td hidden></td>' +
        '</tr>')
    urut();
    isi_total();
}

// Isi Nomor Urut Material
function urut() {
    var tabel_material = document.getElementById('tabel_material');

    for (var i = 0; i < tabel_material.rows.length - 1; i++) {
        document.getElementsByName('urut')[i].value = i + 1;
    }
}

// Hapus List Material
function hapus_material(btn) {
    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    urut();
};

// Isi Total Harga
function isi_total() {
    var sub_total = 0;
    for (var i = 0; i < tabel_material.rows.length - 1; i++) {
        qty_datang = angka(document.getElementsByName('qty_datang')[i].value);
        harga = angka(document.getElementsByName('harga')[i].value);
        total = qty_datang * harga;
        sub_total = sub_total + total;

        document.getElementsByName('total')[i].value = format_number(Number(total).toFixed(2));
    }
    $('#total_harga').val(format_number(Number(sub_total).toFixed(2)));
}

// Cek Qty Datang
function total_datang(id_po_detail) {
    var total = 0;
    var data = [id_po_detail, id_sp_edit];

    $.ajax({
        async: false,
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/sp/total_datang" ?>',
        success: function(data) {
            total = data;
        }
    });
    return total;
}

// Error Isian
function err_isian(str) {
    $('#error_isian').html(str);
    $('#error_isian').removeClass('invisible');
    $('#btnIsian').click();
    throw new Error("Isian salah..");
}

// Simpan Data
function simpan() {
    var tabel_material = document.getElementById('tabel_material');
    var no_sp = $('#no_sp').val().toUpperCase();
    var tgl = $('#tgl').val();
    var no_kend = $('#no_kend').val();
    var supplier = $('#supplier').val();
    var unit = $('#unit').val();
    var cek = cek_sp(no_sp.trim());
    var id_po_detail = [], qty_datang = [], nilai_beli = [], close_po = [];

    if (no_sp == '' || supplier == '' || unit == '' || tabel_material.rows.length == 1 || cek == '0') {
        if (tabel_material.rows.length == 1) {err_isian('Material belum diisi..');}
        if (unit == '') {err_isian('Unit belum diisi..');}
        if (supplier == '') {err_isian('Supplier belum diisi..');}
        if (no_sp == '') {err_isian('Nomor SP belum diisi..');}
    }


    for (var i = 0; i < tabel_material.rows.length - 1; i++) {
        t_id_po_detail = tabel_material.rows[i + 1].cells[11].innerHTML;
        t_qty_datang = document.getElementsByName('qty_datang')[i].value;
        t_qty_po = document.getElementsByName('qty_po')[i].value;
        t_nilai_beli = document.getElementsByName('total')[i].value;
        t_po_close = 0;

        if (t_id_po_detail == '' || t_qty_datang == '' || t_nilai_beli == '') {
            if (t_qty_datang == '') {err_isian('Qty Datang belum diisi..');}
        }

        // if (Number(t_qty_po)+Number(t_qty_po*10/100) < Number(t_qty_datang)+Number(total_datang(t_id_po_detail))) {err_isian('Qty barang datang melibihi toleransi 10%');}

        // Close PO
        if (Number(t_qty_po) <= Number(t_qty_datang)+Number(total_datang(t_id_po_detail))) {
            t_po_close = 1;
        }

        close_po.push(t_po_close);
        id_po_detail.push(t_id_po_detail);
        qty_datang.push(angka(t_qty_datang));
        nilai_beli.push(angka(t_nilai_beli));
    }

    var detail = [id_po_detail, qty_datang, nilai_beli, close_po];
    var data = [id_sp_edit, no_sp, tgl, no_kend, detail];

    $('#btnProgress').click();
    $.ajax({
        async: false,
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/sp/simpan" ?>',
        success: function(data) {
            console.log(data);
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                kosong();
                filter();
            }, 500);
        }
    });
}

// Filter Data SP
function filter() {
    var tgl1 = document.getElementById('f_Tgl1').value;
    var tgl2 = document.getElementById('f_Tgl2').value;
    var kd_unit = document.getElementById('f_unit').value;
    var kategori = document.getElementById('f_kategori').value;
    var jenis = document.getElementById('f_jenis').value;
    var nmr = document.getElementById('f_nmr').value;
    var data = [tgl1, tgl2, kd_unit, kategori, jenis, nmr];

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/sp/filter" ?>',
        success: function(data) {
            $('.data-table').html(data);

            if (kd_unit == '12') {
                $('#data-table th:nth-child(8), #data-table td:nth-child(8)').hide();
            }else{
                $('#data-table th:nth-child(8), #data-table td:nth-child(8)').show();
            }

            setTimeout(function() {
                $('#btnOk').click();
                pagination();
            }, 500);
        }
    });
}

// Cek di LPB
function cek_batal(id_detail) {
    $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/pembelian/sp/cek_batal',
        data: {data: id_detail},
        success: function(data) {
            if (data != '0') {err_isian('Data sudah masuk LPB..');} 
        }
    });
}

// Notifikasi Hapus Data
function batal(btn) {
    var data_table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_hapus = data_table.rows[row].cells[0].innerHTML;
    var b_batal = cek_batal(id_hapus);

    $('#btnHapus').click();
    $('#btnYa').on('click', function() {
        if (id_hapus == '') {return;}
        b_batal = cek_batal(id_hapus);

        $('#btnProgress').click();
        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/pembelian/sp/batal',
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

// Notifikasi Hapus Data
function edit(btn) {
    var data_table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_detail = data_table.rows[row].cells[0].innerHTML;
    var b_batal = cek_batal(id_detail);

    $.ajax({
        async: false,
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/pembelian/sp/edit',
        data: {data: id_detail},
        success: function(data) {
            data = JSON.parse(data);
            data_po = data;

            id_sp_edit = data[0].ID_SP;
            no_sp = data[0].NMR;
            tgl = format_date(data[0].TGL);
            supplier = data[0].SUPPLIER;
            no_kend = data[0].KEND;
            kd_unit = data[0].KD_UNIT;

            $('#no_sp').val(no_sp).change();
            $('#tgl').val(tgl).change();
            $('#supplier').val(supplier).change();
            $('#no_kend').val(no_kend).change();
            $('#unit').val(kd_unit).change(); 

            for (var i=0; i<data.length; i++) {
                no_po = data[i].NMR_PO;
                nama_barang = data[i].BARANG;
                spesifikasi = data[i].SPESIFIKASI;
                qty_po = format_number(data[i].QTY_PO);
                satuan = data[i].SATUAN;
                harga = format_number(data[i].HARGA);
                mata_uang = data[i].MATA_UANG;
                id_po_detail = data[i].ID_PO_DETAIL;
                qty_datang = format_number(data[i].QTY_DATANG);

                isi_material(no_po, nama_barang, spesifikasi, qty_po, satuan, harga, mata_uang, id_po_detail, qty_datang);
            }
        }
    });
    $('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
}

// Format Tanggal DD-MMM-YYYY
function format_date(date) {
    try {
        var tgl = date.substring(0, 2);
        var month = parseInt(date.substring(3, 5)) - 1;
        var thn = date.substring(6);

        var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
        var bln = bln[month];
        return tgl + '-' + bln + '-' + thn;
    } catch (err) {}
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

// Drag Div Document
$("#modal_po").draggable({
    handle: ".card-header"
});

</script>
