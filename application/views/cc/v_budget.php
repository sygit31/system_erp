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
<style>body {padding-right: 0 !important;} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #6D6C6C !important;}</style>

<div class="content-wrapper" id="non_printable">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info" <?php if ($akses == '2') {echo 'hidden';} ?>>
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Input Budget Pembelian</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" id="minimize" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
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
                                <th width="40%">Periode</th>
                                <td width="60%">
                                    <input id="periode" type="text" class="form-control datepicker bg-white" value="<?php echo date('M-Y'); ?>" style="width: 100%; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Unit</th>
                                <td>
                                    <select class="select" id="unit" style="width: 100%;">
                                        <option value="">Pilih Unit..</option>
                                        <?php foreach ($unit->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%" border="0">
                            <tr>
                                <th width="40%">Kode Rekening</th>
                                <td width="60%">
                                    <div style="max-width: 450px;">
                                        <select class="select" id="jurnal" style="width: 100%;">
                                            <option value="">Pilih Rekening..</option>
                                            <?php foreach ($kd_jurnal->result_array() as $dt) { ?>
                                                <option value="<?php echo $dt['ID'] . '@' . $dt['NO_REKJURNAL']; ?>"><?php echo $dt['NO_REKJURNAL'] . ' ' . $dt['NAMA']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Budget</th>
                                <td class="form-inline">
                                    <input type="text" class="form-control num" id="budget" value="0" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>                       
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Laporan Data Budget Pembelian</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table style="width: 650px; margin-bottom: 20px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="35%" colspan="2" class="filter">Periode</th>
                                        <td></td>
                                        <th width="25%" class="filter">Unit</th>
                                        <td></td>
                                        <th class="filter">Rekening Jurnal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_periode" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('M-Y'); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
                                        <td><input id="f_periode2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('M-Y'); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="f_unit" onchange="filter()" style="width: 100%;">
                                                <?php foreach ($unit->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div style="width: 280px;"><select class="select" id="f_jurnal" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach ($kd_jurnal->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NO_REKJURNAL'] . ' ' . $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="data-table" style="font-size: 14px;"></div>
                    </div>

                    <div class="card-footer">
                        <table>
                            <tr>
                                <td width="150"><button type="button" class="btn btn-block btn-success" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                                <td width="10"></td>
                                <td width="150"><button type="button" class="btn btn-block btn-danger" onclick="isi_add()" data-toggle="modal" data-target="#modal_add" data-backdrop="static" data-keyboard="false"><i class="fa fa-book m-2"></i><b>List Addendum</b></button></td>
                                <td width="10"></td>
                                <td width="150" hidden><button type="button" onclick="upload_simpg()" class="btn btn-block btn-warning" title="Upload to SIMPG" style="width: 150px;"><i class="fa fa-upload m-2"></i><b>SIMPG</b></button></td>
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
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2" onclick="$('#error_isian').addClass('invisible')"></i><b>OK</b></button>
                <button id="btnIsian" name="" data-toggle="modal" data-target="#modal_isian" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus" style="z-index: 9998;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button id="btnNo" style="width: 50%;" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="btnHapus" name="" data-toggle="modal" data-target="#modal_hapus" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ubah Budget -->
<div class="modal fade" id="modal_ubah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">Transfer Budget</h4></b>
            </div>
            <div class="card-body card m-3">
                <table width="100%">
                    <tbody>
                        <tr>
                            <th width="40%">Divisi</th>
                            <th><input type="text" id="e_divisi" name="" class="form-control" readonly></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Periode</th>
                            <th><input type="text" id="e_periode" name="" class="form-control" readonly></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Kode Rekening Asal</th>
                            <th><input type="text" id="e_kode" name="" class="form-control" readonly></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Sisa Budget</th>
                            <th><input type="text" id="e_sisa" name="" class="form-control" readonly></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Kode Rekening Tujuan</th>
                            <th><div style="width: 500px;"><select class="select" id="e_jurnal" name="" onchange="isi_e_sisa()" style="width: 100%;">
                                <option value="">Pilih..</option>
                                <?php foreach ($kd_jurnal->result_array() as $dt) { ?>
                                    <option value="<?php echo $dt['ID'] . '@' . $dt['NO_REKJURNAL']; ?>"><?php echo $dt['NO_REKJURNAL'] . ' ' . $dt['NAMA']; ?></option>
                                <?php } ?>
                            </select></div></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Sisa Budget</th>
                            <th><input type="text" id="e_sisa_tujuan" value="0" class="form-control" readonly></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Nominal Budget</th>
                            <th><input type="text" id="e_nominal" value="0" onkeyup="isi_total()" class="form-control num" autocomplete="off"></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Total Budget</th>
                            <th><input type="text" id="e_total" value="0" class="form-control" readonly></th>
                        </tr>
                        <tr style="height: 10px;"></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer rounded m-1 text-center">
                <button style="width: 150px;" type="button" class="btn btn-success" title="Simpan Perubahan" onclick="simpan_edit()" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button style="width: 150px;" type="button" class="btn btn-danger" onclick="kosong_edit()" title="Kembali" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
                <button id="btn_edit" data-toggle="modal" data-target="#modal_ubah" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Data Realisasi Budget -->
<div class="modal fade" id="modal_view" style="z-index: 9999999;">
    <div class="modal-dialog" style="max-width: 900px; margin: auto;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">Data Realisasi Budget</h4></b>
            </div>
            <div class="card-body">
                <table id="tbl_view" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Supplier</th>
                            <th>Nomor PO</th>
                            <th>Nama Barang</th>
                            <th>Qty PO</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Mata Uang</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr class="font-weight-bold">
                            <td align="center" colspan="7">Total</td>
                            <td align="right"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer rounded">
                <button style="width: 150px;" type="button" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel_view').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                <button style="width: 150px;" type="button" class="btn btn-danger" title="Kembali" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Data Addendum Budget -->
<div class="modal fade" id="modal_add" style="z-index: 9999999;">
    <div class="modal-dialog" style="max-width: 900px; margin: auto; margin-top: 30px;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">List Addendum Budget</h4></b>
            </div>
            <div class="card-body">
                <table id="tbl_add" width="100%" class="table table-bordered table-striped" style="font-size: 14px;">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Tanggal Addendum</th>
                            <th>Nama User</th>
                            <th>Nomor Jurnal</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr class="font-weight-bold">
                            <td align="center" colspan="4">Total</td>
                            <td align="right"></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer rounded">
                <button style="width: 150px;" type="button" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel_add').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                <button style="width: 150px;" type="button" class="btn btn-danger" title="Kembali" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
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
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
    var akses = <?php echo json_encode($akses); ?>;

// Load Dokumen
    $(document).ready(function() {
        $('.select').select2();
        $('.datepicker').datepicker({dateFormat: 'M-yy'});

        filter();
    });

// Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        var tbl_data = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "ordering": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'invisible excel',
                title: 'Laporan Data Budget Pembelian'
            }],
            "colReorder": true
        });

        setTimeout(function() {tbl_data.columns.adjust().draw();}, 500);
    }

// Kosong Isian
    function kosong() {
        $('#periode').val(<?php echo json_encode(date("M-Y")); ?>).change();
        $('#unit').val('').change();
        $('#jurnal').val('').change();
        $('#budget').val('0').change();
    }

    function filter() {
        var periode = document.getElementById('f_periode').value;
        var periode2 = document.getElementById('f_periode2').value;
        var kd_unit = $('#f_unit').val();
        var id_rekening = $('#f_jurnal').val();
        var data = [periode, periode2, kd_unit, id_rekening];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                async: false,
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url() . "index.php/cc/budget/filter" ?>',
                success: function(data) {
                    $('.data-table').html(data);

                    if (akses == '2') {
                        $('#data-table th:nth-child(12), #data-table th:nth-child(13), #data-table td:nth-child(12), #data-table td:nth-child(13)').hide();
                    }
                    if (akses == '3') {
                        $('#data-table th:nth-child(13), #data-table td:nth-child(13)').hide();
                    }
                    setTimeout(function() {
                        $('#btnOk').click();
                        pagination();
                    }, 500);
                }
            });
        }, 500);
    }

// Error Isian
    function error_isian(str) {
        $('#error_isian').removeClass('invisible');
        $('#error_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Simpan Data
    function simpan() {
        var periode = document.getElementById('periode').value;
        var budget = angka(document.getElementById('budget').value);
        var kd_unit = document.getElementById('unit').value;

        if (kd_unit == '') {error_isian('Kode Unit belum diisi..');}
        if ($('#jurnal').val() == '') {error_isian('Kode Rekening belum diisi..');}
        if (budget < 1) {error_isian('Nominal Budget salah..');}

        var id_jurnal = $('#jurnal').val().split('@')[0];
        var no_rekjurnal = $('#jurnal').val().split('@')[1].trim();
        var data = [periode, kd_unit, id_jurnal, budget, no_rekjurnal, akses];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data },
                type: 'POST',
                url: '<?php echo base_url() . "index.php/cc/budget/simpan" ?>',
                success: function(data) {
                    if (data != '') {
                        $('#btnOk').click();
                        setTimeout(function() {error_isian(data);}, 500);
                        return;
                    }

                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        filter();
                        kosong();
                    }, 500);
                }
            });
        }, 500);
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
                url: '<?php echo base_url() . "index.php/cc/budget/hapus" ?>',
                data: {data: id_hapus},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        filter();
                    }, 500);

                    id_hapus = '';
                }
            });
        });

        $('#btnNo').on('click', function() {
            if (id_hapus == '') {return;}
            id_hapus = '';
        });
    }

// View Data
    function view(btn) {
        var id_view = btn.name;

        $('#tbl_view').DataTable().destroy();
        $('#tbl_view tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/cc/budget/view" ?>',
            data: {data: id_view},
            success: function(data) {
                data = JSON.parse(data);

                t_total = 0;
                for (var i=0; i<data.length; i++) {
                    nmr_po = data[i].NMR_PO + '<br> (' + format_date(data[i].TGL_PO) + ')';
                    barang = data[i].NAMA + ' - ' + data[i].SPESIFIKASI;
                    qty_po = data[i].QTY_PO.replaceAll(',', '.');
                    harga = data[i].HARGA.replaceAll(',', '.');
                    total = (qty_po * harga).toFixed(0);
                    t_total = Number(t_total) + Number(total);

                    $('#tbl_view tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].SUPPLIER+'</td><td>'+nmr_po+'</td><td>'+barang+'</td><td align="center">'+format_number(qty_po)+'</td><td align="center">'+data[i].SATUAN+'</td><td align="right">'+format_number(harga)+'</td><td align="right">'+format_number(total)+'</td><td align="center">'+data[i].MATA_UANG+'</td></tr>');
                    $('#modal_view h4:eq(0)').html('Data Realisasi Budget - ' + data[i].NO_REKJURNAL + ' (' + proper(data[i].UNIT) + ' ' + data[i].PERIODE + ')');
                }
                $('#tbl_view tfoot td:eq(1)').html(format_number(t_total.toFixed(2)));
                pagination_view();
            }
        });
    }

// Pagination View
    function pagination_view() {
        $('#tbl_view').DataTable().destroy();
        var datatable = $('#tbl_view').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "ordering": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "350px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'invisible excel_view',
                title: 'Realisasi Budget Pembelian'
            }],
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Ubah Budget
    function ubah(btn) {
        var id_budget = btn.name;

        $('#btn_edit').click();
        isi_budget_awal(id_budget);
    }

// Isi Budget Awal
    function isi_budget_awal(id_budget) {
        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url() . "index.php/cc/budget/ubah" ?>',
            data: {data: id_budget},
            success: function(data) {
                data = JSON.parse(data);

                e_sisa = Number(data.BUDGET.replace(',', '.')) + Number(data.ADDENDUM.replace(',', '.')) - Number(data.REALISASI.replace(',', '.'));
                $('#e_divisi').val(data.UNIT);
                $('#e_divisi').attr('name', data.KD_UNIT);
                $('#e_periode').val(data.PERIODE);
                $('#e_periode').attr('name', id_budget);
                $('#e_kode').val(data.NO_REKJURNAL + ' - ' + data.NAMA.trim());
                $('#e_kode').attr('name', data.NO_REKJURNAL.trim());
                $('#e_sisa').val(format_number(e_sisa.toFixed(2)));
                $('#e_sisa').attr('name', e_sisa);
            }
        });
    }

// Isi Sisa Budget
    function isi_e_sisa() {
        var kd_unit = $('#e_divisi').attr('name');
        var periode = $('#e_periode').val();
        var kd_jurnal = $('#e_jurnal').val() == '' ? '' : $('#e_jurnal').val().split('@')[1].trim();
        var data = [kd_unit, periode, kd_jurnal];

        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url() . "index.php/cc/budget/isi_e_sisa" ?>',
            data: {data: data},
            success: function(data) {
                data = JSON.parse(data);
                
                e_sisa = kd_jurnal == '' || data == null ? 0 : Number(data.BUDGET.replace(',', '.')) + Number(data.ADDENDUM.replace(',', '.')) - Number(data.REALISASI.replace(',', '.'));
                $('#e_sisa_tujuan').val(format_number(e_sisa.toFixed(2)));
                isi_total();
            }
        });
    }

// Isi Total Budget Tujuan
    function isi_total() {
        var sisa = $('#e_sisa').attr('name');
        var sisa_tujuan = angka($('#e_sisa_tujuan').val());
        var nominal = angka($('#e_nominal').val());
        var total = Number(sisa_tujuan) + Number(nominal);
        var sisa_awal = sisa - nominal;

        $('#e_total').val(format_number(total.toFixed(2)));
        $('#e_sisa').val(format_number(sisa_awal.toFixed(2)));
    }

// Buka Kembali Modal Edit
    $('#modal_isian button:eq(0)').click(function() {
        if ($('#btnIsian').attr('name') == 'edit') {$('#btn_edit').click();}
        $('#btnIsian').attr('name', '');
    });

// Simpan Edit Budget
    function simpan_edit() {
        var id_budget = $('#e_periode').attr('name');
        var kd_unit = $('#e_divisi').attr('name');
        var periode = $('#e_periode').val();
        var kode_awal = $('#e_kode').attr('name');
        var kode_akhir = $('#e_jurnal').val() == '' ? '' : $('#e_jurnal').val().split('@')[1].trim();
        var id_rekening = $('#e_jurnal').val() == '' ? '' : $('#e_jurnal').val().split('@')[0].trim();
        var nominal = angka($('#e_nominal').val());
        var sisa = angka($('#e_sisa').val());
        var data = [kd_unit, periode, kode_awal, kode_akhir, nominal, id_rekening];

        isi_budget_awal(id_budget);
        isi_e_sisa();

        $('#btnIsian').attr('name', 'edit');
        if (kode_akhir == '') {error_isian('Kode Rekening Tujuan belum diisi..');}
        if (kode_awal == kode_akhir) {error_isian('Kode Rekening Tujuan nggak boleh sama..');}
        if (nominal == 0) {error_isian('Nominal belum diisi..');}
        if (sisa < 0) {error_isian('Isian nominal budget salah..');}

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/cc/budget/simpan_edit" ?>',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    filter();
                    kosong();
                    kosong_edit();
                }, 500);
            }
        });
    }

// Kosongkan Isian Edit
    function kosong_edit() {
        $('#e_jurnal').val('').change();
        $('#e_nominal').val('0').change();
    }

// Isi Daftar Addendum
    function isi_add() {
        var periode1 = document.getElementById('f_periode').value;
        var periode2 = document.getElementById('f_periode2').value;
        var data = [periode1, periode2];

        $('#tbl_add').DataTable().destroy();
        $('#tbl_add tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/cc/budget/isi_add" ?>',
            data: {data: data},
            success: function(data) {
                data = JSON.parse(data);

                total = 0;
                for (var i=0; i<data.length; i++) {
                    jurnal = data[i].NO_REKJURNAL + ' ' + data[i].NAMA_JURNAL;
                    ket = data[i].KET == null ? '' : data[i].KET + ' ' + data[i].KET_JURNAL;
                    $('#tbl_add tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(data[i].TGL_INPUT)+'</td><td>'+data[i].NAMA+'</td><td>'+jurnal+'</td><td align="right">'+format_number(data[i].BUDGET)+'</td><td>'+ket+'</td></tr>');
                    total = total + Number(data[i].BUDGET);
                }
                $('#tbl_add tfoot td:eq(1)').html(format_number(total));

                pagination_add();
            }
        });
    }

// Pagination Addendum
    function pagination_add() {
        $('#tbl_add').DataTable().destroy();
        var datatable = $('#tbl_add').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "350px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'invisible excel_add',
                title: 'Realisasi Budget Pembelian'
            }],
            "columnDefs": [{width: 75, targets: 2}, {width: 200, targets: 3}, {"orderable": false, "targets": "_all"}],
            "order": [],
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Upload Ke SIMPG
    function upload_simpg() {
        var datatable = $('#data-table tbody')[0];
        var qty_data = datatable.rows.length;
        var kd_unit = $('#f_unit').val();
        var dt_id = [];

        if (datatable.rows[0].cells[0].innerHTML == 'No data available in table') {error_isian('Tidak ada PO yang terupload ke SIMPG..');}
        for (var i=0; i<qty_data; i++) {
            id_budget = datatable.rows[i].cells[0].innerHTML;
            dt_id.push(id_budget);
        }

        var data = [kd_unit, [...new Set(dt_id)]];

        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/cc/budget/upload_manual_simpg" ?>',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                }, 500);
            }
        });
    }

// Drag Div Document
    $("#modal_view").draggable({handle: ".card-header"});
    $("#modal_ubah").draggable({handle: ".card-header"});
    $("#modal_add").draggable({handle: ".card-header"});

</script>