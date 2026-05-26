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

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Laporan Data BMI</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <table style="width: 70%; margin-bottom: 10px;">
                            <thead>
                                <tr align="center" style="line-height: 30px;">
                                    <th width="20%" class="filter">Tahun</th>
                                    <td></td>
                                    <th width="25%" class="filter">Unit</th>
                                    <td></td>
                                    <th width="20%" class="filter">Bagian</th>
                                    <td></td>
                                    <th width="35%" class="filter">Kategori</th>
                                    <td hidden></td>
                                    <td hidden width="30%" class="filter">Nama Karyawan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="select" id="fTahun" onchange="filter_data()" style="width: 100%; cursor: pointer;">
                                            <option>All</option>
                                            <?php foreach ($periode->result_array() as $dt) { ?>
                                                <option selected=><?php echo $dt['TAHUN']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fUnit" onchange="filter_data()" style="width: 100%; cursor: pointer;">
                                            <option>All</option>
                                            <option value="12">Holografi</option>
                                            <option value="01">Holo Perdana</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fBagian" onchange="filter_data()" style="width: 100%; cursor: pointer;">
                                            <option>All</option>
                                            <?php foreach ($bagian->result_array() as $dt) { ?>
                                                <option><?php echo $dt['BAGIAN']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <?php
                                        $kategori = array('Sangat Terlalu Kurus', 'Terlalu Kurus Level 3', 'Terlalu Kurus Level 2', 'Terlalu Kurus Level 1', 'Agak Terlalu Kurus Level 3', 'Agak Terlalu Kurus Level 2', 'Agak Terlalu Kurus Level 1', 'Ideal Slim Level 3', 'Ideal Slim Level 2', 'Ideal Slim', 'Ideal Super', 'Ideal Jumbo', 'Ideal Jumbo Level 2', 'Ideal Jumbo Level 3', 'Kelebihan Berat Level 1', 'Kelebihan Berat Level 2', 'Kelebihan Berat Level 3', 'Kegemukan Berlebih Level 1', 'Kegemukan Berlebih Level 2', 'Kegemukan Berlebih Level 3', 'Sangat Kegemukan Berlebih Level 1', 'Sangat Kegemukan Berlebih Level 2', 'Sangat Kegemukan Berlebih Level 3'); ?>
                                        <select class="select" id="fKategori" onchange="filter_data()" style="width: 100%; cursor: pointer;">
                                            <option>All</option>
                                            <?php foreach ($kategori as $dt) { ?>
                                                <option><?php echo $dt; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td hidden></td>
                                    <td hidden>
                                        <input type="text" id="cari" onkeyup="filter_data()" placeholder="Cari nama karyawan.." style="width: 100%;" autocomplete="off"></td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php $this->load->view('sistem/v_laporan_bmi_table'); ?>

                    </div>
                    <div class="card-body">
                        <button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <font color="Green" size="2">ERP @2019</font>
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

    </section>
</div>

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
    var tabel;
    var data_table = document.getElementById('data-table');
    var arr_bmi = [16, 16.33, 16.67, 16.99, 17.5, 18.01, 18.5, 19.34, 20.17, 21, 22.43, 23.27, 24.07, 24.99, 26.66, 28.3, 29.99, 31.66, 33.3, 34.99, 36.66, 38.3, 40];
    var arr_kategori = ['Sangat Terlalu Kurus', 'Terlalu Kurus Level 3', 'Terlalu Kurus Level 2', 'Terlalu Kurus Level 1', 'Agak Terlalu Kurus Level 3', 'Agak Terlalu Kurus Level 2', 'Agak Terlalu Kurus Level 1', 'Ideal Slim Level 3', 'Ideal Slim Level 2', 'Ideal Slim', 'Ideal Super', 'Ideal Jumbo', 'Ideal Jumbo Level 2', 'Ideal Jumbo Level 3', 'Kelebihan Berat Level 1', 'Kelebihan Berat Level 2', 'Kelebihan Berat Level 3', 'Kegemukan Berlebih Level 1', 'Kegemukan Berlebih Level 2', 'Kegemukan Berlebih Level 3', 'Sangat Kegemukan Berlebih Level 1', 'Sangat Kegemukan Berlebih Level 2', 'Sangat Kegemukan Berlebih Level 3'];
    var arr_poin = ['-7', '-6', '-5', '-4', '-3', '-2', '0', '2', '3', '4', '5', '4', '3', '2', '0', '-1', '-2', '-3', '-4', '-5', '-6', '-7', '-8'];

    // Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        get_data();
    });

    // Pagination
    function pagination() {
        var qty_data = $('#data-table tr').length;

        if (qty_data == 1) {
            height = "100px";
        } else if (qty_data > 5) {
            height = "500px";
        } else {
            height = ((qty_data - 1) * 100) + "px";
        }

        tabel = $("#data-table").DataTable().destroy();
        tabel = $('#data-table').DataTable({
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
            "scrollY": height,
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'invisible excel',
                title: 'Laporan Data Material'
            }],
            "colReorder": true
        });

        setTimeout(function() {
            tabel.columns.adjust().draw();
        }, 1000);
    }

    // Get Data
    function get_data() {
        $('#btnProgress').click();
        var year = $('#fTahun').val();

        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/sistem/bmi/get_data',
                data: {
                    data: year
                },
                success: function(data) {
                    isi_data(data);
                    pagination();
                    $('#btnOk').click();
                }
            });
        }, 300);
    }

    // Isi Data
    function isi_data(data) {
        var id = '';
        var id_karyawan = '';
        var dt_periode = [];
        var rows = data_table.rows;
        data = JSON.parse(data);

        // Isi Periode
        for (var i = 0; i < data['periode'].length; i++) {
            dt_periode.push(data['periode'][i]['PERIODE']);
        }
        periode = dt_periode.filter(onlyUnique);
        td_width = 40 / (periode.length * 3) + '%';

        for (var i = 0; i < periode.length; i++) {
            $("#data-table .row_1").append(
                '<th colspan="4" width=' + td_width + '>' + periode[i] + '</th>');
            $("#data-table .row_2").append('<th>Berat</th><th>BMI</th><th>Kategori</th><th>Poin</th>');
        }
        $("#data-table .row_1").append('<th rowspan="2">Total Point</th><th rowspan="2">Deviasi</th>');

        // Isi nama karyawan
        var nmr = 0;
        for (var i = 0; i < data['laporan'].length; i++) {
            id_karyawan = data['laporan'][i]['ID_KARYAWAN'];
            nik = data['laporan'][i]['NIK'];
            nama = data['laporan'][i]['NAMA_KARYAWAN'];
            bagian = data['laporan'][i]['BAGIAN'];
            jkel = data['laporan'][i]['JKEL'];
            tinggi = data['laporan'][i]['TINGGI'];
            if (jkel == 'P') {
                jkel = 'Pria';
            } else {
                jkel = 'Wanita';
            }

            if (data['laporan'][i]['ID_KARYAWAN'] != id) {
                nmr = nmr + 1;
                $("#data-table tbody").append('<tr><td hidden>' + id_karyawan + '</td><td align="center">' + nmr + '</td><td>' + nik + '</td><td>' + nama + '</td><td>' + bagian + '</td><td align="center">' + jkel + '</td><td align="center">' + tinggi + '</td>');
            }

            id = data['laporan'][i]['ID_KARYAWAN'];
        }
        for (var i = 0; i < periode.length; i++) {
            $("#data-table tbody tr").append('<td></td><td></td><td></td><td></td>');
        }
        $("#data-table tbody tr").append('<td></td><td></td>');

        // Isi BMI
        for (var i = 1; i < data_table.rows.length; i++) {
            total_poin = 0;
            num = [];

            for (var j = 0; j < data['laporan'].length; j++) {
                tinggi = data['laporan'][j]['TINGGI'];
                berat = data['laporan'][j]['BERAT'];
                bmi = ((berat - 0.7) / (tinggi * tinggi)).toFixed(2);
                kategori = isi_kategori(bmi);
                indeks = arr_kategori.indexOf(kategori);
                poin = arr_poin[indeks];

                if (data['laporan'][j]['ID_KARYAWAN'] == data_table.rows[i].cells[0].innerHTML) {
                    for (var k = 0; k < periode.length; k++) {
                        if (data['laporan'][j]['PERIODE'] == data_table.rows[0].cells[k + 7].innerHTML) {
                            data_table.rows[i].cells[(k * 4) + 7].innerHTML = berat;
                            data_table.rows[i].cells[(k * 4) + 8].innerHTML = bmi;
                            data_table.rows[i].cells[(k * 4) + 9].innerHTML = kategori;
                            data_table.rows[i].cells[(k * 4) + 10].innerHTML = poin;
                            total_poin = Number(total_poin) + Number(poin);
                            if (poin != '') {
                                num.push(Number(poin));
                            }
                        }
                    }
                }
            }

            if (i > 1) {
                if (num.length > 1) {
                    data_table.rows[i].cells[(periode.length * 4) + 8].innerHTML = StandardDeviation(num).toFixed(2);
                }
                data_table.rows[i].cells[(periode.length * 4) + 7].innerHTML = total_poin;
            }
        }
    }

    // Perhitungan Standard Deviasi
    function StandardDeviation(num) {
        var total = 0;
        var total_num_kuadrat = 0;
        var total_kuadrat = 0;

        for (var key in num) {
            total_num_kuadrat += num[key] * num[key];
            total_kuadrat += num[key];
        }
        avg = (total_kuadrat * total_kuadrat) / num.length;
        dev = total_num_kuadrat - avg;
        var result = Math.sqrt(dev / (num.length - 1));

        return result;
    }

    // Array Unique
    function onlyUnique(value, index, self) {
        return self.indexOf(value) === index;
    }

    // Isi Kategori
    function isi_kategori(bmi) {
        for (var i = 0; i < arr_bmi.length; i++) {
            if (bmi <= arr_bmi[i]) {
                indeks = i;
                break;
            }
        }
        return arr_kategori[indeks];
    }

    // Filter Data
    function filter_data() {
        var year = $('#fTahun').val();
        var unit = $('#fUnit').val();
        var bagian = $('#fBagian').val();
        var kategori = $('#fKategori').val();
        var nama = $('#cari').val();
        var indeks = arr_kategori.indexOf(kategori);
        var max = arr_bmi[indeks];
        var min = arr_bmi[indeks - 1];
        if (kategori == 'All') {
            max = 100;
            min = 0;
        }
        if (indeks == 0) {
            min = 0;
        }
        var data = [year, unit, bagian, min, max, nama];
        
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/bmi/filter_data',
            data: {data: data},
            success: function(data) {
                $('#btnProgress').click();

                setTimeout(function() {
                    if ($.fn.DataTable.isDataTable('#data-table')) {
                        $("#data-table").DataTable().destroy();
                    }
                    $("#data-table tbody").find("tr").remove();
                    $("#data-table .row_1").find('th:gt(6)').remove();
                    $("#data-table .row_2").find('th:gt(0)').remove();
                    $("#data-table").find('th:gt(6)').remove();

                    if (JSON.parse(data)['periode'].length == 0) {
                        return;
                    }

                    isi_data(data);
                    pagination();

                    $('#btnOk').click();
                }, 500);
            }
        });
    }
</script>