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
                        <font color="White">Detail Penilaian</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Sistem - Manual Book Detail Nilai.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <table width="100%" style="margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="50%" class="filter">Nama Penilai</td>
                                            <td></td>
                                            <th width="20%" class="filter">Periode</th>
                                            <td></td>
                                            <th width="30%" class="filter">Kategori</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="fPenilai" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="">Pilih Nama Penilai..</option>
                                                    <?php $id_karyawan = array(); ?>
                                                    <?php foreach ($penilai->result_array() as $dt) { ?>
                                                        <?php $id_karyawan[] = $dt['ID_KARYAWAN']; ?>
                                                        <option><?php echo $dt['NAMA']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <?php $dt_periode = array(); ?>
                                                <?php foreach ($periode->result_array() as $dt) { ?>
                                                    <?php array_push($dt_periode, $dt['PERIODE']); ?>
                                                <?php } ?>

                                                <?php $periode = array_unique($dt_periode); ?>
                                                <select class="select" id="fPeriode" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($periode as $dt) { ?>
                                                        <option><?php echo $dt; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="fKategori" style="width: 100%;" onchange="filter()">
                                                    <option selected>Pilih kategori..</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" id="btn_qty" class="btn btn-danger" style="width: 200px;"><i class="fa fa-cog fa-3x fa-fw"></i><b>Qty Salah</b></button>
                                <button type="button" id="btn_kurva" class="btn btn-danger" style="width: 200px;"><i class="fa fa-refresh fa-3x fa-fw"></i><b>Kurva Salah</b></button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table width="100%">
                            <tr>
                                <td width="50%"><button type="button" class="btn btn-block btn-warning tab" onclick="tab(this)">Nilai</button></td>
                                <td width="50%"><button type="button" class="btn btn-block btn-default tab" onclick="tab(this)">Grafik</button></td>
                            </tr>
                        </table>
                    </div>

                    <?php $this->load->view('sistem/v_detail_nilai_table'); ?>

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
                        <button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
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
var data_table = document.getElementById('data-table');
var tabel;

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
        height = "400px";
    } else {
        height = ((qty_data - 1) * 100) + "px";
    }

    tabel = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "pageLength": 10,
        "oLanguage": {
            "sSearch": "Cari Nama Karyawan  :"
        },
        "order": [
        [0, "asc"]
        ],
        "info": false,
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
            className: 'btn btn-primary mt-5 mb-4 ml-3',
            title: 'Laporan Data Penilaian Karyawan'
        },
        {
            text: 'Export PDF',
            extend: 'pdf',
            exportOptions: {
                columns: ':visible'
            },
            className: 'btn btn-success mt-5 mb-4 ml-3',
            title: 'Laporan Data Penilaian Karyawan',
            orientation: 'landscape',
            pageSize: 'LEGAL'
        }
        ]
    });
}

// Tab Selection
function tab(e) {
    $('.tab').removeClass("btn-info").addClass("btn-default");
    e.classList.remove("btn-default");
    e.classList.add("btn-warning");

    if ((e.innerText).trim() == 'Nilai') {
        $('.data-table').css('display', 'block');
        $('.grafik').css('display', 'none');
    } else {
        $('.data-table').css('display', 'none');
        $('.grafik').css('display', 'block');
        isi_chart();
    }
}

// Isi Chart
function isi_chart() {
    var rows = document.getElementsByName('kategori').length;
    var kategori = '',
    ks = 0,
    k = 0,
    c = 0,
    b = 0,
    bs = 0;
    var rows = tabel.rows().data().length;

    if (rows > 1) {
        for (var i = 0; i < rows; i++) {
            try {
                kategori = tabel.rows(i).data()[0][14];
                if (kategori == 'KS') {
                    ks++;
                } else if (kategori == 'K') {
                    k++;
                } else if (kategori == 'C') {
                    c++;
                } else if (kategori == 'B') {
                    b++;
                } else if (kategori == 'BS') {
                    bs++;
                }
            } catch (e) {}
        }
    }

    chart(ks, k, c, b, bs);
}

// Chart
function chart(ks, k, c, b, bs) {
    var chrt = document.getElementById("lineChart").getContext('2d');
    var line = new Chart(chrt, {
        type: 'line',
        data: {
            labels: ["KS", "K", "C", "B", "BS"],
            datasets: [{
                label: "GRAFIK PENILAIAN KARYAWAN UNIT HOLOGRAFI",
                data: [ks, k, c, b, bs],
                backgroundColor: [
                'rgba(105, 0, 132, .2)',
                ],
                borderColor: [
                'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true
        }
    });
}

// Get Data
function get_data() {
    if ($.fn.DataTable.isDataTable('#data-table')) {
        $("#data-table").DataTable().destroy();
    }
    $("#data-table tbody").find("tr").remove();
    $('#btnProgress').click();

    setTimeout(function() {

        var penilai = $('#fPenilai').val();
        var periode = $('#fPeriode').val();
        var kategori = $('#fKategori').val();

        if (penilai == '') {
            $('#btnOk').click();
            pagination();
            return;
        }

        var dt_karyawan = <?php echo json_encode($id_karyawan); ?>;
        var indeks = document.getElementById('fPenilai').selectedIndex - 1;
        var id_penilai = dt_karyawan[indeks];

        var data = [id_penilai, periode, kategori];

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ploting/get_detail_nilai',
            data: {
                data: data
            },
            success: function(data) {
                data = JSON.parse(data);
                isi_data(data);
                pagination();
                cek_kurva();

                $('#btnOk').click();
            }
        });

    }, 400);
}

// Filter Data
function filter() {
    $('.tab')[0].click();
    kategori = $('#fKategori').val();
    if (kategori == 'Pilih kategori..') {
        if ($.fn.DataTable.isDataTable('#data-table')) {
            $("#data-table").DataTable().destroy();
            $("#data-table tbody").find("tr").remove();
            pagination();
            return;
        }
    }
    get_data();
}

// Isi List Kategori
$('#fPenilai').on('change', function() {
    var dt_karyawan = <?php echo json_encode($id_karyawan); ?>;
    var indeks = document.getElementById('fPenilai').selectedIndex - 1;
    var id_penilai = dt_karyawan[indeks];
    var penilai = $('#fPenilai').val();

    $('#fKategori').val('Pilih kategori..').change();
    $('#fKategori option:not(:first)').remove();

    if (penilai == '') {
        return;
    }
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/ploting/get_kategori',
        data: {
            data: id_penilai
        },
        success: function(data) {
            data = JSON.parse(data);

            for (var i = 0; i < data.length; i++) {
                option = document.createElement("option");
                option.text = data[i]['KATEGORI'];
                document.getElementById("fKategori").add(option);
            }
        }
    });
});

// Isi Data Karyawan
function isi_data(data) {
    for (var i = 0; i < data.length; i++) {
        total = 0;
        qty = 0;

        periode = $('#fPeriode').val();
        kategori = data[i]['KATEGORI'];
        nama = data[i]['NAMA_KARYAWAN'];
        nik = data[i]['NIK'];
        n1 = data[i]['N1'];
        if (n1 == null) {
            n1 = '';
        } else {
            n1 = Number(n1).toFixed(2);
        }
        n2 = data[i]['N2'];
        if (n2 == null) {
            n2 = '';
        } else {
            n2 = Number(n2).toFixed(2);
        }
        n3 = (data[i]['N3']);
        if (n3 == null) {
            n3 = '';
        } else {
            n3 = Number(n3).toFixed(2);
        }
        n4 = data[i]['N4'];
        if (n4 == null) {
            n4 = '';
        } else {
            n4 = Number(n4).toFixed(2);
        }
        n5 = data[i]['N5'];
        if (n5 == null) {
            n5 = '';
        } else {
            n5 = Number(n5).toFixed(2);
        }
        hr = '';
        nis = '';
        k3 = '';

        if (kategori == 'HR') {
            hr = data[i]['NILAI'];
            if (hr == null) {
                hr = '';
            } else {
                hr = Number(hr).toFixed(2);
            }
        } else if (kategori == 'IS') {
            nis = data[i]['NILAI'];
            if (nis == null) {
                nis = '';
            } else {
                nis = Number(nis).toFixed(2);
            }
        } else if (kategori == 'K3') {
            k3 = data[i]['NILAI'];
            if (k3 == null) {
                k3 = '';
            } else {
                k3 = Number(k3).toFixed(2);
            }
        }

        $('#data-table').find('tbody').append("<tr><td align='center'>" + (i + 1) + "</td><td align='center'>" + periode + "</td><td>" + kategori + "</td><td>" + nama + "</td><td>" + nik + "</td><td align='center'>" + n1 + "</td><td align='center'>" + n2 + "</td><td align='center'>" + n3 + "</td><td align='center'>" + n4 + "</td><td align='center'>" + n5 + "</td><td align='center'>" + hr + "</td><td align='center'>" + nis + "</td><td align='center'>" + k3 + "</td><td align='center'></td><td align='center'></td></tr>");

        for (var j = 5; j <= 12; j++) {
            if (data_table.rows[i + 1].cells[j].innerHTML != '') {
                total = total + Number(data_table.rows[i + 1].cells[j].innerHTML);
                qty = qty + 1;
            }
        }

        avg = (total / qty).toFixed(2);
        avg_kategori = isi_kategori((total / qty).toFixed(2));

        if (total == 0) {
            avg = '';
            avg_kategori = '';
        }
        data_table.rows[i + 1].cells[13].innerHTML = avg;
        data_table.rows[i + 1].cells[14].innerHTML = avg_kategori;
    }
}

// Isi Kategori Nilai
function isi_kategori(total_nilai) {
    if (total_nilai <= 2.6) {
        return 'KS';
    } else if (total_nilai <= 3.3) {
        return 'K';
    } else if (total_nilai <= 3.9) {
        return 'C';
    } else if (total_nilai <= 4.4) {
        return 'B';
    } else if (total_nilai > 4.4) {
        return 'BS';
    }
}

// Cek Kurva Normal
function cek_kurva() {
    var qty_kary = tabel.rows().data().length;
    var qty = 0,
    BS = 0,
    B = 0,
    C = 0,
    K = 0,
    KS = 0;
    var kategori = '',
    kurva = 0;

    if (qty_kary == 0) {
        return '1';
    }
    for (var i = 0; i < qty_kary; i++) {
        nilai = tabel.rows(i).data()[0][13];
        kategori = tabel.rows(i).data()[0][14];
        if (nilai != '') {
            qty++;
        }
        if (kategori == 'BS') {
            BS++;
        }
        if (kategori == 'B') {
            B++;
        }
        if (kategori == 'C') {
            C++;
        }
        if (kategori == 'K') {
            K++;
        }
        if (kategori == 'KS') {
            KS++;
        }
    }

    // Ketentuan Kurva
    n_BS = Math.round(10 / 100 * qty_kary);
    n_B = Math.round(20 / 100 * qty_kary);
    n_K = Math.round(20 / 100 * qty_kary);
    n_KS = Math.round(10 / 100 * qty_kary);

    if (qty_kary == 2) {
        n_B = 1;
        n_K = 1;
    }

    n_C = qty_kary - n_BS - n_B - n_K - n_KS;

    if (qty_kary == 1) {
        if (BS + B + C + K + KS == 1) {
            kurva = '1';
        }
    } else if (qty_kary <= 5) {
        if (BS + B + C == C + K + KS) {
            kurva = '1';
        }
    } else if (qty_kary <= 9) {
        if (((BS + B + C == C + K + KS) || (BS + B + C + 1 == C + K + KS) || (BS + B + C == C + K + KS + 1)) && BS > 0 && B > 0 && C > 0 && K > 0 && KS > 0) {
            kurva = '1';
        }
    } else if (qty_kary > 9) {
        if (BS >= n_BS && B >= n_B && C >= n_C && K >= n_K && KS >= n_KS) {
            kurva = '1';
        }
    } else {
        kurva = 0;
    };

    if (BS + B + C + K + KS == 0) {
        kurva = '0';
    }

    if (kurva == 0) {
        $('#btn_kurva').addClass("btn-danger");
        $('#btn_kurva').removeClass("btn-success");
        $('#btn_kurva b').text("Kurva Salah");
    } else {
        $('#btn_kurva').removeClass("btn-danger");
        $('#btn_kurva').addClass("btn-success");
        $('#btn_kurva b').text('Kurva Benar');
    }

    if (qty_kary != qty) {
        $('#btn_qty').addClass("btn-danger");
        $('#btn_qty').removeClass("btn-success");
        $('#btn_qty b').text("Qty Salah");
    } else {
        $('#btn_qty').removeClass("btn-danger");
        $('#btn_qty').addClass("btn-success");
        $('#btn_qty b').text('Qty Benar');
    }
}
</script>