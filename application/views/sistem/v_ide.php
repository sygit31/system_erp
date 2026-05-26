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

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Input Ide</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
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
                    <th width="15%">Nomor</th>
                    <td width="5%">:</td>
                    <td rowspan="3" width="30%"><input type="text" id="nmr" class="form-control" autocomplete="off" style="width: 40%;" readonly></td>

                    <th width="10%">Bagian</th>
                    <td width="5%">:</td>
                    <td width="35%"><input type="text" id="bagian" class="form-control" autocomplete="off" style="width: 40%;" readonly></td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td>
                            <?php $now = date('d-M-Y'); ?>
                            <input type="text" id="tgl" class="form-control" value="<?php echo $now; ?>" autocomplete="off" style="width: 40%;" readonly>
                        </td>
                        <th>Ide</th>
                        <td>:</td>
                        <td><textarea rows="2" type="text" id="ide" autocomplete="off" class="form-control" style="width: 90%;" tabindex="1"></textarea></td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Nama Karyawan</th>
                        <td>:</td>
                        <td>
                            <select id="karyawan" class="form-control select" style="width: 80%;">
                                <option value="">Pilih Nama..</option>
                                <?php $id_kary = array(); ?>
                                <?php $dt_bagian = array(); ?>
                                <?php foreach ($karyawan->result_array() as $pic) : ?>
                                    <option><?php echo $pic['NAMA']; ?></option>
                                    <?php array_push($id_kary, $pic['ID']); ?>
                                    <?php array_push($dt_bagian, $pic['BAGIAN']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <th>Status</th>
                        <td>:</td>
                        <td>
                            <input type="text" id="status" class="form-control" value="DIAJUKAN" autocomplete="off" style="width: 40%;" readonly>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" title="Simpan Data"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" title="Batal Isian"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-warning" onclick="logout()" title="Keluar Dari Program"><i class="fa ion-android-share m-2"></i><b>Keluar</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Laporan Ide</font>
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
                            <table style="width: 50%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="45%" class="filter bg-success">Nama Gagasan</td>
                                        <td></td>
                                        <td width="25%" class="filter bg-success">Tahun</td>
                                        <td></td>
                                        <td width="30%" class="filter bg-success">Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="cari" id="cari" onkeyup="filter()" placeholder="Cari deskripsi gagasan.." style="width: 100%;" autocomplete="off"></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fTahun" onchange="filter()" style="width: 100%;">
                                                <option>All</option>
                                                <?php foreach ($ide->result_array() as $dt) { ?>
                                                    <?php $dt_tahun[] = substr($dt['TGL'], -4); ?>
                                                <?php } ?>
                                                <?php $tahun = array_unique($dt_tahun); ?>
                                                <?php foreach ($tahun as $dt) { ?>
                                                    <option><?php echo $dt; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fStatus" onchange="filter()" style="width: 100%;">
                                                <option>All</option>
                                                <?php foreach ($ide->result_array() as $dt) { ?>
                                                    <?php $dt_status[] = $dt['STATUS']; ?>
                                                <?php } ?>
                                                <?php $status = array_unique($dt_status); ?>
                                                <?php foreach ($status as $dt) { ?>
                                                    <option><?php echo $dt; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div style="overflow-x: auto;">
                                <?php $this->load->view('sistem/v_ide_table'); ?>
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


<div id="printable" style="display: none; font-size: 20;">
    <h1 align="center" style="border: solid thin; line-height: 70px;">PENGAJUAN IDE (GAGASAN)</h1>
    <div style="border: solid thin; line-height: 70px; margin-top: -10px; padding-left: 10px;">
        <table id="header1" width="100%" style="line-height: 40px;">
            <tr>
                <th width="15%">No</th>
                <th width="5%">:</th>
                <td width="25%"></td>
                <th width="5%"></th>
                <th width="20%">Nama Karyawan</th>
                <th width="5%">:</th>
                <td width="25%"></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <th>:</th>
                <td></td>
                <th></th>
                <th>Bagian</th>
                <th>:</th>
                <td></td>
            </tr>
            <tr>
                <th>Deskripsi Ide</th>
                <th>:</th>
                <td></td>
                <th></th>
                <th>Status</th>
                <th>:</th>
                <td></td>
            </tr>
        </table>
    </div>
    <div style="border: solid thin; line-height: 70px; padding-left: 10px;">
        <table id="header3" class="m-3" width="100%" style="line-height: 40px;">
            <tr>
                <td></td>
                <td></td>
                <td align="center">Karyawan,</td>
                <td></td>
                <td align="center">Atasan,</td>
            </tr>
            <tr style="height: 60px;"></tr>
            <tr>
                <td></td>
                <td></td>
                <td align="center">( ................................ )</td>
                <td></td>
                <td align="center">( ................................ )</td>
            </tr>
        </table>
    </div>
    <div style="text-align:right;">F-SMT-SIS-000 Rev. 00</div>
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

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
    var id_karyawan = ''; // ID Karyawan yang akan disimpan
    var info_1 = 0,
        info_2 = 0; // Status Card Info

    // Load Dokumen
    $(document).ready(function() {
        $(".select").select2(); // Combo Live Search
        pagination();
        $('#ide').focus();

        // $('.info_1')[0].click();
        $('#hide_sidebar').click();

        $('#non_printable').removeClass('content-wrapper');
        $('.content').css('margin-top', '-20px');
        $('.content').addClass('ml-2 mr-2');

        $('.navbar').hide();
        $('.main-sidebar').hide();

        auto_no();
    });

    // Keluar Aplikasi
    function logout() {
        $("a:contains(Logout)")[0].click();
    }

    // Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        $('#data-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": 10,
            "oLanguage": {
                "sSearch": "Cari Nama Karyawan  :"
            },
            "order": [
                [1, "asc"]
            ],
            "info": false,
            "autoWidth": true,
            "scrollX": false
        });
    }

    // Auto No.
    function auto_no() {
        var year = ($('#tgl').val()).substr(-2);

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/ide/auto_no" ?>',
            data: {
                data: year
            },
            success: function(data) {
                document.getElementById('nmr').value = data;
            }
        });
    }

    // Pilih Karyawan
    $('#karyawan').on('change', function() {
        var indeks = document.getElementById('karyawan').selectedIndex - 1;
        var arr_id = <?php echo json_encode($id_kary); ?>;
        var arr_bagian = <?php echo json_encode($dt_bagian); ?>;

        id_karyawan = arr_id[indeks];
        $('#bagian').val(arr_bagian[indeks]);
    });

    // Kosong Isian
    function kosong() {
        $('#karyawan').val('').change();
        $('#bagian').val('');
        $('#ide').val('');
        $('#ide').focus();

        id_karyawan = '';
    }

    // Simpan Data
    function simpan() {
        var nmr = $('#nmr').val();
        var ide = $('#ide').val();
        var data = [nmr, id_karyawan, ide];

        if (ide != '' && id_karyawan != '') {
            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/sistem/ide/simpan_ide',
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
        } else {
            $('#btnIsian').click();
            return;
        }
    }

    // Filter Data Table
    function filter() {
        var cari = $('#cari').val();
        var tahun = $('#fTahun').val();
        var status = $('#fStatus').val();
        var data = [cari, tahun, status];

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ide/filter_ide',
            data: {
                data: data
            },
            success: function(data) {
                $('.data-table').html(data);
                pagination();
            }
        });
    }

    // Approval Ide
    function approve(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var id_ide = table.rows[row].cells[0].innerHTML;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ide/approve_ide',
            data: {
                data: id_ide
            },
            success: function(data) {
                filter();
                $('#btnSukses').click();
            }
        });
    }

    // Cetak Ide
    function cetak(btn) {
        var printable = document.getElementById('printable');
        var non_printable = document.getElementById('non_printable');
        var table = document.getElementById('data-table');
        var header1 = document.getElementById('header1');
        var row = $(btn).closest("tr").index() + 1;
        var tgl = table.rows[row].cells[2].innerHTML;
        var nmr = table.rows[row].cells[3].innerHTML;
        var nama = table.rows[row].cells[4].innerHTML;
        var bagian = table.rows[row].cells[5].innerHTML;
        var ide = table.rows[row].cells[6].innerHTML;
        var status = table.rows[row].cells[7].innerHTML;

        header1.rows[0].cells[2].innerHTML = nmr;
        header1.rows[1].cells[2].innerHTML = tgl;
        header1.rows[2].cells[2].innerHTML = ide;
        header1.rows[0].cells[6].innerHTML = nama;
        header1.rows[1].cells[6].innerHTML = bagian;
        header1.rows[2].cells[6].innerHTML = status;

        printable.style.display = "";
        non_printable.style.display = "none";
        window.print();

        printable.style.display = "none";
        non_printable.style.display = "";
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