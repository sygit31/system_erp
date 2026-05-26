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
<style>
    .modal-dialog {
        z-index: 9999;
    }
</style>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Kelola Akun</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <button style="width: 15%; font-weight: bold; margin-bottom: 20px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_tambah"><i class="fa ion-person-add mr-3"></i><b>Tambah Akun</b></button>
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <table style="width: 30%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td class="filter">Nama Karyawan</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari Nama Karyawan.." style="width: 100%;" autocomplete="off">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('administrator/v_akun_table'); ?>

                        </font>
                    </div>
                </div>
            </div>

            <!-- Modal Sukses Simpan -->
            <div class="modal fade" id="modal_sukses" style="z-index: 9999;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
                        <div class="modal-footer">
                            <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){tabel.columns.adjust().draw();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                            <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Hak Akses -->
            <div class="modal fade" id="modal_akun">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div id="nama_akun" class="modal-body" style="font-size: 40px; color: #0B36D5; font-weight: bold;"></div>
                        <div class="modal-body">
                            <?php $this->load->view('administrator/v_akun_akses'); ?>
                        </div>
                        <div class="modal-footer">
                            <button style="width: 50%;" type="button" id="simpan_akses" class="btn btn-info" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                            <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Keluar</b></button>
                            <button id="btnAkun" data-toggle="modal" data-target="#modal_akun" hidden></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Sukses Tambah Akun -->
            <div class="modal fade" id="modal_sukses_akun">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div id="nama_akun" class="modal-body" style="font-size: 40px; color: #0B36D5; font-weight: bold;">
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                            <button id="btnAkun" data-toggle="modal" data-target="#modal_akun" hidden></button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Akun -->
            <div class="modal fade" id="modal_tambah">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <table width="100%">
                                <tr>
                                    <td width="30%"><label>
                                            <font size="3">Username</font>
                                        </label></td>
                                    <td width="10%"></td>
                                    <td width="60%">
                                        <input type="text" class="form-control" id="username" autocomplete="off" style="width: 80%;" tabindex="1">
                                    </td>
                                </tr>
                                <tr height="10"></tr>
                                <tr>
                                    <?php foreach ($karyawan->result_array() as $dt) {
                                        $dt_bagian[] = $dt['BAGIAN'];
                                        $dt_nama[] = $dt['NAMA'];
                                        $dt_id[] = $dt['ID'];
                                    } ?>
                                    <?php $bagian = array_unique($dt_bagian); ?>
                                    <?php sort($bagian); ?>
                                    <?php $nama = array_unique($dt_nama); ?>
                                    <?php sort($nama); ?>
                                    <td><label>
                                            <font size="3">Bagian</font>
                                        </label></td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="bagian" style="width: 100%;">
                                            <option value="">Pilih Bagian..</option>
                                            <?php foreach ($bagian as $dt) { ?>
                                                <option><?php echo $dt; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr height="10"></tr>
                                <tr>
                                    <td><label>
                                            <font size="3">Karyawan</font>
                                        </label></td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="karyawan" style="width: 100%;">
                                            <option value="">Pilih Karyawan..</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button style="width: 50%;" type="button" id="simpan_akun" class="btn btn-info" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                            <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Keluar</b></button>
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
                            <button id="btnOk_progress" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                            <button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
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


<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
    // Define Variable
    var id_akun = 0;
    var table_akses, tabel;

    // Load Dokumen
    $(document).ready(function() {
        $(".select").select2(); // Combo Live Search
        $(".datepicker").datepicker({
            dateFormat: 'dd-M-yy'
        });
        pagination();
        $('#judul').focus();
    });

    // Kosing Isian
    function kosong() {
        $('#bagian').val('Pilih Bagian..').change();
        $('#karyawan').val('Pilih Karyawan..').change();
    }

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
        tabel = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": height,
            "columnDefs": [{
                "orderable": false,
                "targets": "_all"
            }],
            "order": []
        });

        setTimeout(function() {
            tabel.columns.adjust().draw();
        }, 100);
    }

    // Pagination Akses
    function pagination_akses() {
        var qty_data = $('#data-table-akses tr').length;

        if (qty_data == 1) {
            height = "100px";
        } else if (qty_data > 5) {
            height = "400px";
        } else {
            height = ((qty_data - 1) * 100) + "px";
        }

        $('#data-table-akses').DataTable().destroy();
        table_akses = $('#data-table-akses').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": height,
            "columnDefs": [{
                "orderable": false,
                "targets": "_all"
            }],
            "order": []
        });

        setTimeout(function() {
            table_akses.columns.adjust().draw();
        }, 100);
    }

    // Filter Tabel
    function filter() {
        var cari = document.getElementById('cari').value;

        $.ajax({
            data: {
                data: cari
            },
            type: 'POST',
            url: '<?php echo base_url() . "index.php/administrator/akun/filter_akun" ?>',
            success: function(data) {
                $('.data-table-akun').html(data);
                pagination();
            }
        });
    }

    // Set Akses
    function akses(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        id_akun = table.rows[row].cells[5].innerHTML;
        nama_akun = table.rows[row].cells[1].innerHTML;

        $('input:checkbox').removeAttr('checked');
        $('#data-table-akses').DataTable().destroy();

        $.ajax({
            data: {
                data: id_akun
            },
            type: 'POST',
            url: '<?php echo base_url() . "index.php/administrator/akun/get_akses" ?>',
            success: function(data) {
                $('.data-table-akses').html(data);
                hide_uncheck();
                pagination_akses();
            }
        });

        $('#btnAkun').click();
        document.getElementById('nama_akun').innerHTML = nama_akun;
    }

    // Hide Uncheck Level
    function hide_uncheck() {
        var data_tabel_akses = document.getElementById('data-table-akses');
        var qty_row = data_tabel_akses.rows.length;

        for (var i = 0; i < qty_row - 1; i++) {
            level1 = data_tabel_akses.rows[i].cells[6].innerHTML;
            level2 = data_tabel_akses.rows[i + 1].cells[6].innerHTML;

            if (level1 < level2) {
                document.getElementsByName('status')[i-1].setAttribute("hidden", "");
            }
        }
    }

    // Ubah Akses
    function ubah_akses(btn) {
        var table = document.getElementById('data-table-akses');
        var row = $(btn).closest("tr").index();
        var akses = document.getElementsByName('akses')[row].checked;
        var elemen = document.getElementsByName('status')[row];

        if (akses == false) {
            elemen.setAttribute("hidden", "");
        } else {
            elemen.removeAttribute("hidden");
            if (elemen.value == '' || elemen.value == '0') {
                elemen.value = '1';
            }
        }
    }

    // Simpan Akses
    $('#simpan_akses').on('click', function() {
        var id_menu_detail = [],
            id_adm_akses = [],
            akses = [],
            status = [];
        var qty_row = table_akses.rows().data().length - 1;

        for (var i = 0; i < qty_row; i++) {
            akses.push(document.getElementsByName('akses')[i].checked);
            id_menu_detail.push(table_akses.rows(i).data()[0][3]);
            id_adm_akses.push(table_akses.rows(i).data()[0][4]);
            status.push(document.getElementsByName('status')[i].value);
        }

        var data = [id_akun, id_menu_detail, id_adm_akses, akses, status];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/administrator/akun/simpan_akses" ?>',
            data: {
                data: data
            },
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk_progress').click();
                    $('#btnSukses').click();
                }, 500);
            }
        });
    });

    // Simpan Akun
    $('#simpan_akun').on('click', function() {
        var username = $('#username').val();
        var nama = $('#karyawan').val();
        var dt_id = <?php echo json_encode($dt_id); ?>;
        var dt_nama = <?php echo json_encode($dt_nama); ?>;
        var indeks = dt_nama.indexOf(nama);
        var id_karyawan = dt_id[indeks];
        var data = [username, id_karyawan];

        if (username == '' || $('#bagian').val() == 'Pilih Bagian..' || $('#karyawan').val() == 'Pilih Karyawan..') {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/administrator/akun/simpan_akun" ?>',
            data: {
                data: data
            },
            success: function(data) {
                kosong();
                filter();
                $('#btnSukses').click();
            }
        });

        alertify.alert("Username = " + username + " dan Password = holografi");
    });

    // Validasi Karyawan dan Bagian
    $('#bagian').on('change', function() {
        var dt_bagian = <?php echo json_encode($dt_bagian); ?>;
        var dt_nama = <?php echo json_encode($dt_nama); ?>;
        var bagian = $('#bagian').val();

        $("#karyawan").empty();
        $('#karyawan').append(new Option('Pilih Karyawan..'));
        $('#karyawan').val('Pilih Karyawan..').change();

        for (var i = 0; i < dt_bagian.length; i++) {
            if (bagian == dt_bagian[i]) {
                $(new Option(dt_nama[i])).appendTo('#karyawan');
            }
        }
    });
</script>