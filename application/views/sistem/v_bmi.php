<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>

<!-- Select Live Search -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>body {padding-right: 0 !important}</style>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White"><div id="headerinput">Input Data BMI</div></font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div style="width: 450px;">
                            <table style="width: 100%; margin-bottom: 15px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="50%" class="filter">Bagian</th>
                                        <td></td>
                                        <td width="50%" class="filter">Unit</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fBagian" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All</option>
                                                <?php foreach ($bagian->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['BAGIAN']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fUnit" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All</option>
                                                <?php foreach ($unit->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['UNIT']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td hidden>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama karyawan.." style="width: 100%;" autocomplete="off"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="datatable"></div>

                        <div class="card-body" style="position: absolute; top: -10000px;">
                            <table id="data-excel" class="table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr>
                                        <td>No.</td>
                                        <td>Nama Karyawan</td>
                                        <td>Bagian</td>
                                        <td>Jenis Kelamin</td>
                                        <td>Tinggi Badan</td>
                                        <td>Berat Badan</td>
                                        <td>BMI</td>
                                        <td>Kategori</td>
                                        <td>Poin</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="card-footer ml-2 mt-5">
                            <table>
                                <tr>
                                    <td width="150"><button type="button" class="btn btn-block btn-primary" title="Simpan All" onclick="simpan_all()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                                    <td width="10"></td>
                                    <td width="150"><button type="button" class="btn btn-block btn-success" title="Export to Excel" onclick="export_excel()" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                                </tr>
                            </table>
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

<!-- Modal Sukses Simpan -->
<div class="modal fade" id="modal_sukses">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" hidden></button>
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

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
    var data_table;

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        filter();
    });

// Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        var data_table = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "order": [[2, "asc"]],
            "autoWidth": true,
            "scrollX": true,
            "scrollY": '400px'
        });

        setTimeout(function() {
            data_table.columns.adjust().draw();
        }, 1000);
    }

// Pagination Excel
    function pagination_excel() {
        $('#data-excel').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "order": [1, "asc"],
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'invisible excel',
                filename: 'Laporan Data BMI',
                title: ''
            }],
            "colReorder": true
        });
    }

// Error Isian
    function error_isian(str) {
        $('#error_isian').removeClass('invisible');
        $('#error_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

    function submit(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index();
        var id_karyawan = table.rows[row + 1].cells[0].innerHTML;
        var id_bmi = table.rows[row + 1].cells[1].innerHTML;
        var tinggi = Number(document.getElementsByName('tinggi')[row].value);
        var berat = Number(document.getElementsByName('berat')[row].value);
        var data = [id_karyawan, id_bmi, tinggi, berat];
        var bmi = (berat - 0.7) / (tinggi * tinggi);

        if (tinggi == '') {error_isian('TInggi Badan belum diisi..');}
        if (berat == '') {error_isian('Berat Badan belum diisi..');}

        document.getElementsByName('submit')[row].setAttribute('hidden', '');
        document.getElementsByName('edit')[row].removeAttribute('hidden', '');
        document.getElementsByName('tinggi')[row].setAttribute('readonly', '');
        document.getElementsByName('berat')[row].setAttribute('readonly', '');

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/bmi/simpan_bmi',
            data: {data: data},
            success: function(data) {
                $('#btnSukses').click();
                table.rows[row + 1].cells[9].innerHTML = bmi.toFixed(2);
                document.getElementsByName('tinggi')[row].value = tinggi.toFixed(2);
                document.getElementsByName('berat')[row].value = berat.toFixed(2);

                var kategori = isi_kategori(bmi);
                table.rows[row + 1].cells[10].innerHTML = kategori;
                table.rows[row + 1].cells[11].innerHTML = isi_point(kategori);
                table.rows[row + 1].cells[1].innerHTML = data;
            }
        });
    }

// Isi Kategori
    function isi_kategori(bmi) {
        if (bmi <= 16) {
            kategori = 'Sangat Terlalu Kurus';
        } else if (bmi <= 16.33) {
            kategori = 'Terlalu Kurus Level 3';
        } else if (bmi <= 16.67) {
            kategori = 'Terlalu Kurus Level 2';
        } else if (bmi <= 16.99) {
            kategori = 'Terlalu Kurus Level 1';
        } else if (bmi <= 17.55) {
            kategori = 'Agak Terlalu Kurus Level 3';
        } else if (bmi <= 18.01) {
            kategori = 'Agak Terlalu Kurus Level 2';
        } else if (bmi <= 18.5) {
            kategori = 'Agak Terlalu Kurus Level 1';
        } else if (bmi <= 19.34) {
            kategori = 'Ideal Slim Level 3';
        } else if (bmi <= 20.17) {
            kategori = 'Ideal Slim Level 2';
        } else if (bmi <= 21) {
            kategori = 'Ideal Slim';
        } else if (bmi <= 22.43) {
            kategori = 'Ideal Super';
        } else if (bmi <= 23.7) {
            kategori = 'Ideal Jumbo';
        } else if (bmi <= 24.07) {
            kategori = 'Ideal Jumbo Level 2';
        } else if (bmi <= 24.99) {
            kategori = 'Ideal Jumbo Level 3';
        } else if (bmi <= 26.66) {
            kategori = 'Kelebihan Berat Level 1';
        } else if (bmi <= 28.3) {
            kategori = 'Kelebihan Berat Level 2';
        } else if (bmi <= 29.99) {
            kategori = 'Kelebihan Berat Level 3';
        } else if (bmi <= 31.66) {
            kategori = 'Kegemukan Berlebih Level 1';
        } else if (bmi <= 33.3) {
            kategori = 'Kegemukan Berlebih Level 2';
        } else if (bmi <= 34.99) {
            kategori = 'Kegemukan Berlebih Level 3';
        } else if (bmi <= 36.66) {
            kategori = 'Sangat Kegemukan Berlebih Level 1';
        } else if (bmi <= 38.3) {
            kategori = 'Sangat Kegemukan Berlebih Level 2';
        } else if (bmi <= 40) {
            kategori = 'Sangat Kegemukan Berlebih Level 3';
        }
        return kategori;
    }

// Isi Point
    function isi_point(kategori) {
        var dt_kategori = ['Sangat Terlalu Kurus', 'Terlalu Kurus Level 3', 'Terlalu Kurus Level 2', 'Terlalu Kurus Level 1', 'Agak Terlalu Kurus Level 3', 'Agak Terlalu Kurus Level 2', 'Agak Terlalu Kurus Level 1', 'Ideal Slim Level 3', 'Ideal Slim Level 2', 'Ideal Slim', 'Ideal Super', 'Ideal Jumbo', 'Ideal Jumbo Level 2', 'Ideal Jumbo Level 3', 'Kelebihan Berat Level 1', 'Kelebihan Berat Level 2', 'Kelebihan Berat Level 3', 'Kegemukan Berlebih Level 1', 'Kegemukan Berlebih Level 2', 'Kegemukan Berlebih Level 3', 'Sangat Kegemukan Berlebih Level 1', 'Sangat Kegemukan Berlebih Level 2', 'Sangat Kegemukan Berlebih Level 3'];
        var point = ['-7', '-6', '-5', '-4', '-3', '-2', '0', '2', '3', '4', '5', '4', '3', '2', '0', '-1', '-2', '-3', '-4', '-5', '-6', '-7', '-8'];

        return point[dt_kategori.indexOf(kategori)];
    }

//Edit Data
    function edit(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index();

        document.getElementsByName('submit')[row].removeAttribute('hidden', '');
        document.getElementsByName('edit')[row].setAttribute('hidden', '');
        document.getElementsByName('tinggi')[row].removeAttribute('readonly', '');
        document.getElementsByName('berat')[row].removeAttribute('readonly', '');
    }

// Filter Data
    function filter() {
        var bagian = document.getElementById('fBagian').value;
        var unit = document.getElementById('fUnit').value;
        var data = [bagian, unit];

        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/bmi/filter_bmi" ?>',
            success: function(data) {
                $('.datatable').html(data);
                pagination();

                setTimeout(function() {$('#btnOk_progress').click();}, 500);
            }
        });
    }

// Simpan Data
    function simpan_all() {
        var id_karyawan = [], id_bmi = [], tinggi = [], berat = [];
        var table = document.getElementById('data-table');

        for (var i=0; i<table.rows.length-1; i++) {
            t_id_karyawan = table.rows[i+1].cells[0].innerHTML;
            t_id_bmi = table.rows[i+1].cells[1].innerHTML;
            t_tinggi = Number(document.getElementsByName('tinggi')[i].value);
            t_berat = Number(document.getElementsByName('berat')[i].value);

            if (t_berat != '') {
                id_karyawan.push(t_id_karyawan);
                id_bmi.push(t_id_bmi);
                tinggi.push(t_tinggi);
                berat.push(t_berat);
            }
        }

        var data = [id_karyawan, id_bmi, tinggi, berat];

        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/bmi/simpan_all" ?>',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    filter();
                }, 500);
            }
        });
    }

// Export Excel
    function export_excel() {
        var table = document.getElementById('data-table');

        $('#data-excel').DataTable().destroy();
        $('#data-excel tbody tr').remove();
        for (var i=0; i<table.rows.length-1; i++) {
            t_no = table.rows[i+1].cells[2].innerHTML;
            t_nama = table.rows[i+1].cells[4].innerHTML;
            t_bagian = table.rows[i+1].cells[5].innerHTML;
            t_jekel = table.rows[i+1].cells[6].innerHTML;
            t_bmi = table.rows[i+1].cells[9].innerHTML;
            t_kategori = table.rows[i+1].cells[10].innerHTML;
            t_poin = table.rows[i+1].cells[11].innerHTML;
            t_tinggi = document.getElementsByName('tinggi')[i].value;
            t_berat = document.getElementsByName('berat')[i].value;

            $('#data-excel tbody').append('<tr><td>'+t_no+'</td><td>'+t_nama+'</td><td>'+t_bagian+'</td><td>'+t_jekel+'</td><td>'+t_tinggi+'</td><td>'+t_berat+'</td><td>'+t_bmi+'</td><td>'+t_kategori+'</td><td>'+t_poin+'</td></tr>');
        }

        pagination_excel();
        $('.excel').click();
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

</script>