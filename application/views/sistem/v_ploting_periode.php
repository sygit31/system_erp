<?php

$dt_periode = array();
foreach ($periode->result_array() as $dt) {
    array_push($dt_periode, $dt['PERIODE']);
}
$periode = array_unique($dt_periode);

$dt_periode = array();
foreach ($periode as $dt) {
    array_push($dt_periode, $dt);
}

$th = 'Jan-' . date('y');

?>

<div class="card-header">
    <h3 class="card-title">
        <b>
            <font color="White">Laporan Periode</font>
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
                <table style="width: 60%; margin-bottom: 10px;">
                    <thead>
                        <tr align="center" style="line-height: 30px;">
                            <th width="30%" class="filter" colspan="2">Periode</th>
                            <td></td>
                            <th width="20%" class="filter">Bagian</th>
                            <td></td>
                            <th width="15%" class="filter">Unit</th>
                            <td></td>
                            <th width="15%" class="filter">Status</th>
                            <td></td>
                            <th width="20%" class="filter">Nama Karyawan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="select" id="fPeriode1" onchange="get_laporan()" style="width: 100%; cursor: pointer;">
                                    <option value="">Periode Awal..</option>
                                    <?php foreach ($periode as $dt) { ?>
                                        <option><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>
                                <select class="select" id="fPeriode2" onchange="get_laporan()" style="width: 100%; cursor: pointer;">
                                    <option value="">Periode Akhir..</option>
                                    <?php foreach ($periode as $dt) { ?>
                                        <option><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td></td>
                            <td>
                                <select class="select" id="fBagian2" style="width: 100%;" onchange="get_laporan()">
                                    <option>All</option>
                                    <?php foreach ($bagian->result_array() as $dt) { ?>
                                        <option><?php echo $dt['NAMA']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td></td>
                            <td>
                                <select class="select" id="fUnit2" style="width: 100%;" onchange="get_laporan()">
                                    <option>All</option>
                                    <?php foreach ($unit->result_array() as $dt) { ?>
                                        <option><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td></td>
                            <td>
                                <select class="select" id="fStatus2" style="width: 100%;" onchange="get_laporan()">
                                    <option>Karyawan</option>
                                    <option>OS</option>
                                </select>
                            </td>
                            <td></td>
                            <td><input type="text" id="cari" autocomplete="off" onkeyup="get_laporan()" placeholder="Cari.." style="width: 100%;"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td width="50%"><button type="button" class="btn btn-block btn-danger tabPeriode" onclick="tabPeriode(this)">Nilai</button></td>
                            <td width="50%"><button type="button" class="btn btn-block btn-default tabPeriode" onclick="tabPeriode(this)">Grafik</button></td>
                        </tr>
                    </table>
                </div>

                <div class="nilai_periode" style="overflow-x: auto; padding-bottom: 20px;">
                    <div class="data-table">
                        <table id="data-periode" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Nik</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Bagian</th>
                                    <th>Nilai</th>
                                    <th>Poin Khusus</th>
                                    <th>Total</th>
                                    <th>Skor</th>
                                    <th>Kurva</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="grafik_periode" style="display: none;">
                    <canvas id="lineChartPeriode"></canvas>
                </div>
            </font>

            <button style="width: 10%;" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel_periode').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
            <button style="width: 10%;" class="btn btn-info" title="Cetak Laporan" onclick="cetak();"><i class="fa fa-print m-2"></i><b>Print</b></button>
            <button style="width: 10%;" class="btn btn-warning" title="Refresh Data" onclick="(function(){ get_laporan(); })();"><i class="fa fa-archive m-2"></i><b>Refresh</b></button>
        </div>
    </div>
</div>

<script>

// Define Variable
    var tabel_periode = document.getElementById('data-periode');
    var tbl_periode;

// Print Dokumen
    function cetak() {
        var qty_data = tabel_periode.rows.length;
        var status = $('#fStatus2').val();

        $("#print_periode tbody").find("tr").remove();
        if (status == 'OS') {
            status = 'OUT SOURCHING';
        } else {
            status = 'KARYAWAN';
        }
        if (qty_data == 2) {
            return;
        }

        $('#kriteria_print').html('<h4><b>REKAPITULASI PENILAIAN ' + status + '</h4></b>');
        $('#tgl_print').html('Kudus, ' + <?php echo json_encode(date('d-M-Y')); ?>);
        for (var i = 0; i < qty_data - 1; i++) {
            nik = tabel_periode.rows[i + 1].cells[1].innerHTML;
            nama = tabel_periode.rows[i + 1].cells[2].innerHTML;
            jabatan = tabel_periode.rows[i + 1].cells[3].innerHTML;
            bagian = tabel_periode.rows[i + 1].cells[4].innerHTML;
            nilai = tabel_periode.rows[i + 1].cells[7].innerHTML;
            kurva = tabel_periode.rows[i + 1].cells[9].innerHTML;

            $('#print_periode').append('<tr style="height: 10px;"><td align="center">' + (i + 1) + '</td><td>' + nik + '</td><td>' + nama + '</td><td>' + jabatan + '</td><td>' + bagian + '</td><td align="center">' + nilai + '</td><td align="center">' + kurva + '</td></tr>')
        }

        setTimeout(function() {
            var printable = document.getElementById('printable');
            var non_printable = document.getElementById('non_printable');

            printable.style.display = "";
            non_printable.style.display = "none";
            window.print();

            printable.style.display = "none";
            non_printable.style.display = "";
        }, 1000);
    }

// Load Dokumen
    $(document).ready(function() {
        pagination_periode();
    });

// Pagination
    function pagination_periode() {
        tbl_periode = $('#data-periode').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sSearch": "Cari Nama Karyawan  :"
            },
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'excel_periode invisible',
                title: 'Laporan Data Penilaian Karyawan'
            }, ],
            "colReorder": true
        });

        setTimeout(function() {
            tbl_periode.columns.adjust().draw();
        }, 500);
    }

// Get Data
    function get_laporan() {
        var periode1 = $('#fPeriode1').val();
        var periode2 = $('#fPeriode2').val();
        var bagian = $('#fBagian2').val(); 
        var i_unit = document.getElementById('fUnit2').selectedIndex-1;
        var dt_unit = <?php echo json_encode($unit->result_array()); ?>; 
        i_unit == -1 ? kd_unit = 'All' : kd_unit = dt_unit[i_unit].KD_UNIT;
        var status = $('#fStatus2').val();
        var cari = $('#cari').val();
        var data = [periode1, periode2, bagian, kd_unit, status, cari];

        if (periode1 == '' || periode2 == '') {
            return;
        }
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/sistem/ploting/get_laporan',
                data: {
                    data: data
                },
                success: function(data) {
                    data = JSON.parse(data);
                    
                    $("#data-periode").DataTable().destroy();
                    $("#data-periode tbody").find("tr").remove();
                    $("#data-periode thead").find('th:gt(9)').remove();

                    isi_periode(data);
                    isi_nilai_periode(data, tabel_periode.rows[0].cells.length - 10);

                    $('#btnOk').click();
                    pagination_periode();
                }
            });
        }, 400);
    }

// Isi Periode Laporan
    function isi_periode(data) {
        var dt_periode = <?php echo json_encode($dt_periode); ?>;
        var indeks1 = dt_periode.indexOf($('#fPeriode1').val());
        var indeks2 = dt_periode.indexOf($('#fPeriode2').val());
        var qty_periode = indeks1 - indeks2;

        dt_periode.forEach(function(e) {
            indeks = dt_periode.indexOf(e);

            if (indeks <= indeks1 && indeks >= indeks2) {
                periode = dt_periode[indeks];
                $('#data-periode thead tr').append('<th>' + periode + '</th>');
            }

        });
    }

    function isi_nilai_periode2(data, qty_periode) {
        var dt_nilai = [];
        var dt_id = data[0];
        var data = data[1];

        console.log(data);
    }

    function isi_nilai_periode(data, qty_periode) {
        var dt_nilai = [];
        var dt_id = data[0];
        var data = data[1];

        for (var i = 0; i < dt_id.length; i++) {

            id = dt_id[i].ID;
            nik = dt_id[i].NIK;
            nama = dt_id[i].NAMA;
            jabatan = dt_id[i].JABATAN;
            bagian = dt_id[i].BAGIAN;
            nilai = [];
            t_nilai = 0;
            t_periode = 0;
            nilai_khusus = 0;

            for (var k = 0; k < qty_periode; k++) {
                periode = tabel_periode.rows[0].cells[k + 10].innerHTML;
                n_hr = 0;
                n_hr = 0;
                n_is = 0;
                n_k3 = 0;
                n_al = 0;
                n_mj = 0;
                n_kl = 0;
                n_kl1 = 0;
                n_kl2 = 0;
                n_jabatan = 0, n_khusus = 0;

                for (var j = 0; j < data.length; j++) {

                    if (id == data[j].ID && data[j].KATEGORI == 'HR' && periode == data[j].PERIODE) {
                        n_hr = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'IS' && periode == data[j].PERIODE) {
                        n_is = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'K3' && periode == data[j].PERIODE) {
                        n_k3 = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'Atasan Langsung' && periode == data[j].PERIODE) {
                        n_al = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'Manajemen' && periode == data[j].PERIODE) {
                        n_mj = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'Kolega' && periode == data[j].PERIODE) {
                        n_kl = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'Kolega 1' && periode == data[j].PERIODE) {
                        n_kl1 = data[j].NILAI;
                    }
                    if (id == data[j].ID && data[j].KATEGORI == 'Kolega 2' && periode == data[j].PERIODE) {
                        n_kl2 = data[j].NILAI;
                    }
                    if (id == data[j].ID && periode == data[j].PERIODE) {
                        n_jabatan = data[j].N_JABATAN;
                        n_khusus = Number(data[j].N_KHUSUS);
                    }
                }

                if (n_khusus != 0) {
                    nilai_khusus = n_khusus; 
                }

                n_other = (Number(n_hr) + Number(n_is) + Number(n_k3)) / 3;
                n_total = ((40 / 100 * n_al) + (20 / 100 * n_mj) + (15 / 100 * n_kl) + (25 / 100 * n_other) + (20 / 100 * n_kl1) + (15 / 100 * n_kl2)).toFixed(2);

                n_nilai = (Number(n_total) + Number(n_jabatan)).toFixed(2);
                t_nilai = t_nilai + Number(n_nilai);
                nilai.push(n_nilai);

                if (n_nilai > 0) {
                    t_periode++;
                }
            }

            avg_nilai = (t_nilai / (t_periode)).toFixed(2);
            nilai_khusus = (nilai_khusus == 0) ? '' : nilai_khusus.toFixed(2);
            total_nilai = (Number(avg_nilai) + Number(nilai_khusus)).toFixed(2);
            kategori = dt_kategori(total_nilai);

            dt_nilai.push([id, nik, nama, jabatan, bagian, avg_nilai, nilai_khusus, total_nilai, kategori, nilai]);

        }

        dt_nilai.sort(function(a, b) {
            return b[7] - a[7];
        });

        isi_table(dt_nilai);
    }

    function isi_table(data) {
        for (var i = 0; i < data.length; i++) {
            nik = data[i][1];
            nama = data[i][2];
            jabatan = data[i][3];
            bagian = data[i][4];
            data[i][5] == 'NaN' ? nilai = '' : nilai = data[i][5];
            khusus = data[i][6];
            data[i][7] == 'NaN' ? total = '' : total = data[i][7];
            skor = data[i][8];
            skor == '' ? kurva = '' : kurva = dt_kurva(i + 1, data.length);

            $('#data-periode').append('<tr><td align="center">' + (i + 1) + '</td><td align="center">' + nik + '</td><td>' + nama + '</td><td>' + jabatan + '</td><td>' + bagian + '</td>' + '<td align="center">' + nilai + '</td>' + '<td align="center">' + khusus + '</td>' + '<td align="center">' + total + '</td>' + '<td align="center">' + skor + '</td><td align="center">' + kurva + '</td></tr>');

            for (var j = 0; j < data[i][9].length; j++) {
                data[i][9][j] == '0.00' ? nilai_periode = '' : nilai_periode = data[i][9][j];
                $('#data-periode tbody tr:eq(' + i + ')').append('<td align="center">' + nilai_periode + '</td>');
            }
        }
    }

    function dt_kurva(i, qty_data) {
        var ks = Math.round(10 / 100 * qty_data);
        var k = Math.round(20 / 100 * qty_data);
        var b = Math.round(20 / 100 * qty_data);
        var bs = Math.round(10 / 100 * qty_data);
        var c = qty_data - ks - k - b - bs;

        if (i <= bs) {
            kurva = 'BS';
        } else if (i <= (bs + b)) {
            kurva = 'B';
        } else if (i <= (bs + b + c)) {
            kurva = 'C';
        } else if (i <= (bs + b + c + k)) {
            kurva = 'K';
        } else if (i <= (bs + b + c + k + ks)) {
            kurva = 'KS';
        }
        return kurva;
    }

    function dt_kategori(n_total) {
        if (n_total <= 2.6) {
            kategori = 'KS';
        } else if (n_total <= 3.3) {
            kategori = 'K';
        } else if (n_total <= 3.9) {
            kategori = 'C';
        } else if (n_total <= 4.4) {
            kategori = 'B';
        } else if (n_total > 4.4) {
            kategori = 'BS';
        } else {
            kategori = '';
        }
        return kategori;
    }

// Tab Selection Periode
    function tabPeriode(e) {
        $('.tabPeriode').removeClass("btn-info").addClass("btn-default");

        e.classList.remove("btn-default");
        e.classList.add("btn-danger");

        if (e.innerText.trim() == 'Nilai') {
            $('.nilai_periode').css('display', 'block');
            $('.grafik_periode').css('display', 'none');
        } else {
            $('.nilai_periode').css('display', 'none');
            $('.grafik_periode').css('display', 'block');
            chart_periode();
        }
    }

// Chart
    function chart_periode() {
        var rows = tbl_periode.rows().data().length;
        var ks = Math.round(10 / 100 * rows);
        var k = Math.round(20 / 100 * rows);
        var b = Math.round(20 / 100 * rows);
        var bs = Math.round(10 / 100 * rows);
        var c = rows - ks - k - b - bs;

        var chrt = document.getElementById("lineChartPeriode").getContext('2d');
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
</script>