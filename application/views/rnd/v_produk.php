<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Input Data Produk</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>


            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Kode</th>
                                <td>
                                    <input class="form-control" type="text" id="kode" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Jenis</th>
                                <td>
                                    <select class="select" id="jenis" style="width: 100%; cursor: pointer;" enabled>
                                        <option value="">Pilih Jenis..</option>
                                        <option>Cukai</option>
                                        <option selected>Non Cukai</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>
                                    <input class="form-control" type="text" id="nama" maxlength="50" style="text-transform: uppercase;" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%">
                            <tr>
                                <th width="40%">Deskripsi</th>
                                <td>
                                    <input class="form-control" type="text" id="deskripsi" maxlength="50" style="text-transform: uppercase;" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Satuan</th>
                                <td>
                                    <select class="select" id="satuan" style="width: 100%;">
                                        <option value="">Satuan..</option>
                                        <option>LBR</option>
                                        <option>PCS</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Ukuran</th>
                                <td>
                                    <input class="form-control" type="text" id="ukuran" style="text-transform: uppercase;" autocomplete="off">
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
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" tabindex="4"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10">
                        </td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" tabindex="5"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Laporan Data Produk</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table style="width: 400px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="35%" class="filter">Jenis</td>
                                        <td></td>
                                        <td class="filter">Nama Produk</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fJenis" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option value="">All</option>
                                                <option>Cukai</option>
                                                <option>Non Cukai</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama produk.." style="width: 100%;" autocomplete="off" tabindex="6"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <div class="data-table"></div>
                        </div>
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
            <div id="keterangan_isian" class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
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
            <div class="modal-body confirm" style="font-size: 36px; color: #D00101; font-weight: bold;"> Yakin akan menonaktifkan produk ini? </div>
            <div class="modal-footer">
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
                <button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
    var id_edit = '', kode_edit = '';

// Document load
    $(document).ready(function() {
        filter();
        $(".select").select2();
        $('#nama').focus();
        $('#jenis').change();
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
        $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sSearch": "Cari :"
            },
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": height,
            "order": [
                [1, "asc"]
                ],
            "colReorder": true
        });
    }

// Kosong Isian
    function kosong() {
        $('#kode').val('');
        $('#jenis').val('Non Cukai').change();
        $('#nama').val('');
        $('#deskripsi').val('');
        $('#satuan').val('').change();
        $('#ukuran').val('');
        id_edit = '';
        kode_edit = '';

        $('#nama').focus();
    }

// Auto Kode
    $('#jenis').on('change', function() {
        var jenis = $('#jenis').val();
        if (jenis == '') {
            $('#kode').val('');
            return;
        }

        (jenis == 'Cukai') ? kode = 'C': kode = 'N';

        if (id_edit == '' || (kode_edit.substring(0, 1) != kode) && jenis != '') {
            $.ajax({
                type: 'POST',
                data: {
                    data: kode
                },
                url: '<?php echo base_url() . "index.php/rnd/produk/auto_kode" ?>',
                success: function(data) {
                    $('#kode').val(kode + data);
                }
            });
        } else {
            $('#kode').val(kode_edit);
        }
    });

// Tampilkan error isian
    function error_isian(str) {
        $('#keterangan_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Simpan Data
    function simpan() {
        var kode = $('#kode').val();
        var jenis = $('#jenis').val();
        var nama = $('#nama').val().toUpperCase();
        var deskripsi = $('#deskripsi').val().toUpperCase();
        var satuan = $('#satuan').val();
        var ukuran = $('#ukuran').val().toUpperCase();
        var data = [id_edit, kode, jenis, nama, deskripsi, satuan, ukuran];

        if (kode == '') {error_isian('Kode belum diisi..');}
        if (jenis == '') {error_isian('Jenis belum diisi..');}
        if (nama == '') {error_isian('Nama Produk belum diisi..');}
        if (deskripsi == '') {error_isian('Deskripsi belum diisi..');}
        if (satuan == '') {error_isian('Satuan belum diisi..');}
        if (ukuran == '') {error_isian('Ukuran belum diisi..');}

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/rnd/produk/simpan_produk',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                }, 500);
            }
        });
    }

// Filter Data
    function filter() {
        var jenis = document.getElementById("fJenis").value;
        var cari = document.getElementById("cari").value;
        var data = [jenis.substring(0, 1), cari];

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/rnd/produk/filter_produk',
            data: {data: data},
            success: function(data) {
                $('.data-table').html(data);
                pagination();
            }
        });
    }

// Edit Data
    function edit(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var nama = table.rows[row].cells[4].innerHTML;

        id_edit = table.rows[row].cells[0].innerHTML;
        kode_edit = table.rows[row].cells[2].innerHTML;
        $('#kode').val(table.rows[row].cells[2].innerHTML);
        $('#jenis').val(table.rows[row].cells[3].innerHTML).change();
        $('#nama').val(htmlDecode(nama));
        $('#deskripsi').val(table.rows[row].cells[5].innerHTML);
        $('#satuan').val(table.rows[row].cells[6].innerHTML).change();
        $('#ukuran').val(table.rows[row].cells[7].innerHTML);

        $('#nama').focus();
        $('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
    }

// Hapus Data
    function hapus(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var id_hapus = table.rows[row].cells[0].innerHTML;

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}
            
            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/rnd/produk/hapus',
                data: {data: id_hapus},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        filter();
                        id_hapus = [];
                    }, 500);
                }
            });
        });

        $('#btnNo').on('click', function() {
            if (id_hapus == '') {return;}
            id_hapus = '';
        });
    }

</script>