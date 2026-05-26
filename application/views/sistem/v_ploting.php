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
<style>.select2-container--open {z-index: 9999999;}</style>

<div class="content-wrapper" id="non_printable">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Hasil Penilaian</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Sistem - Manual Book Hasil Nilai.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <table style="width: 100%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="10%" class="filter">Periode</th>
                                        <td></td>
                                        <th width="15%" class="filter">Bagian</th>
                                        <td></td>
                                        <th width="10%" class="filter">Divisi</th>
                                        <td></td>
                                        <th width="15%" class="filter">Status</th>
                                        <td width="50%"></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fPeriode" style="width: 100%; cursor: pointer;">
                                                <?php $dt_periode = array(); ?>
                                                <?php foreach ($periode->result_array() as $dt) { ?>
                                                    <?php array_push($dt_periode, $dt['PERIODE']); ?>
                                                <?php } ?>

                                                <?php $periode = array_unique($dt_periode); ?>
                                                <?php foreach ($periode as $dt) { ?>
                                                    <option><?php echo $dt; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fBagian" style="width: 100%;">
                                                <option>All</option>
                                                <?php foreach ($bagian->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fUnit" style="width: 100%;">
                                                <option value="12">Holografi</option>
                                                <option value="01">Holo Perdana</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fStatus" style="width: 100%;">
                                                <option selected>Karyawan</option>
                                                <option>OS</option>
                                            </select>
                                        </td>
                                        <td class="text-right pr-3" hidden>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_default" data-backdrop="static" data-keyboard="false"><i class="fa ion-alert fa-lg mr-2"></i><b>Auto Nilai</b></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="card-body card-footer">
                                <button type="button" class="btn btn-warning" title="Click to View Data" onclick="filter()" style="width: 120px;"><i class="fa fa-book mr-2"></i><b>View</b></button>
                                <button type="button" class="btn btn-success btn_excel" title="Export to Excel" style="width: 120px;" onclick="(function(){ $('.excel_hasil').click(); })();"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
                            </div>

                            <div class="card-body">
                                <table width="100%">
                                    <tr>
                                        <td width="50%"><button type="button" class="btn btn-block btn-warning tab" onclick="tab(this)">Nilai</button></td>
                                        <td width="50%"><button type="button" class="btn btn-block btn-default tab" onclick="tab(this)">Grafik</button></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="nilai" style="overflow-x: auto; padding-bottom: 20px;">
                                <div class="data-table">
                                    <table id="data-table" class="table table-bordered table-striped" width="100%">
                                        <thead>
                                            <tr align="center">
                                                <th>No.</th>
                                                <th>NIK</th>
                                                <th>Nama Karyawan</th>
                                                <th>Jabatan</th>
                                                <th>Bagian</th>
                                                <th>Nilai</th>
                                                <th>Poin Jabatan</th>
                                                <th hidden>Poin Khusus</th>
                                                <th>Poin Reward</th>
                                                <th>Total</th>
                                                <th>Kategori Skor</th>
                                                <th>Kategori Kurva</th>
                                                <th>HR</th>
                                                <th>IS</th>
                                                <th>K3</th>
                                                <th>Atasan Langsung</th>
                                                <th>Manajemen</th>
                                                <th>Kolega</th>
                                                <th>Kolega I</th>
                                                <th>Kolega II</th>
                                                <th>Gaji</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="grafik" style="display: none;">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </font>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <?php $this->load->view('sistem/v_ploting_periode'); ?>

            <div class="card-footer">
                <font color="Green" size="2">ERP @2019</font>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card card-info">
                    <?php $this->load->view('sistem/v_plotting_penilai'); ?>
                </div>
            </div>
            <div class="col-6">
                <div class="card card-info">
                    <?php $this->load->view('sistem/v_plotting_auto'); ?>
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

<!-- Modal Auto Nilai -->
<div class="modal fade" id="modal_default" style="z-index: 9998;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan memberikan nilai 2.5 poin untuk penilai yang kosong? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="ya_default" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
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
                <button id="btnOkSukses" style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Penilai -->
<div class="modal fade" id="modal-penilai" style="z-index: 9999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header bg-info m-2" style="cursor: all-scroll; border-radius: 8px;">
                <div id="judul_penilai" style="font-size: 28px; color: #ffffff; font-weight: bold;"> Detail Nilai</div>
            </div>
            <div class="modal-body">
                <div>
                    <table id="tbl_penilai" class="table table-bordered" width="100%">
                        <tr>
                            <th width="40%">Atasan Langsung</th>
                            <td width="60%"></td>
                        </tr>
                        <tr>
                            <th>Manajemen</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kolega</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kolega 1</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kolega 2</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>HR</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>IS</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>K3</th>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer m-2">
                <button style="width: 150px;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-android-share mr-2"></i><b>Tutup</b></button>
                <button id="modal_penilai" data-toggle="modal" data-target="#modal-penilai" hidden></button>
            </div>
        </div>
    </div>
</div>

<style>
    #print_periode td,
    #print_periode th {
        border: 1px solid #ddd;
        padding: 2px;
        padding-left: 5px;
    }
</style>
<div id="printable" style="display: none;">
    <div id="kriteria_print" align="center">
        <h4><b>REKAPITULASI PENILAIAN KARYAWAN</b></h4>
    </div>
    <div align="center">
        <h5><b>UNIT HOLOGRAFI</b></h5>
    </div>
    <div style="height: 5mm;"></div>
    <table width="100%" id="print_periode">
        <thead>
            <tr align="center">
                <th>No.</th>
                <th>Nik</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Bagian</th>
                <th>Total</th>
                <th>Kurva</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div style="height: 10mm;"></div>
    <table width="100%">
        <tr>
            <td colspan="3" id="tgl_print">Kudus, 27-November-2020</td>
        </tr>
        <tr>
            <td width="35%">Dibuat Oleh :</td>
            <td width="30%">Mengetahui :</td>
            <td width="35%"></td>
        </tr>
        <tr style="height: 15mm;">
        </tr>
        <tr>
            <td>____________________</td>
            <td>____________________</td>
            <td></td>
        </tr>
    </table>
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

<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>

<script>

// Define Variable
    var data_table;
    var table = document.getElementById('data-table');
    var info_1 = 0, info_2 = 0, info_3 = 0, info_4 = 0;

// Load Dokumen
    $(document).ready(function() {
        var kd_unit = <?php echo json_encode($kd_unit); ?>;
        var unit = kd_unit == '01' ? 'Holo Perdana' : 'Holografi';

        $('#fUnit2').val(unit);
        $('#tUnit').val(unit);
        $('.info_2')[0].click();
        $('.info_3')[0].click();
        $('.info_4')[0].click();
        $('.fa-bars:eq(0)').click();

        $(".select").select2();
        pagination();
    });

// Filter Data
    function filter() {
        var periode = $('#fPeriode').val();
        var bagian = $('#fBagian').val();
        var kd_unit = $('#fUnit').val();
        var status = $('#fStatus').val();
        var data = [periode, bagian, kd_unit, status];
        $('#data-table tbody').hide();
        $('#data-table').DataTable().destroy();

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ploting/filter_nilai',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    data = JSON.parse(data);
                    isi_nilai(data);
                    pagination();

                    $('#data-table tbody').show();
                    $('#btnOk').click();
                    $('.tab')[0].click();
                }, 400);
            }
        });
    }

// Pagination
    function pagination() {
        data_table = $('#data-table').DataTable({
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
                className: 'excel_hasil invisible',
                title: 'Laporan Data Penilaian Karyawan'
            }, ],
            "colReorder": true
        });

        setTimeout(function() {
            data_table.columns.adjust().draw();
        }, 500);
    }

// Get Data
    function get_data() {
    // $('#btnProgress').click();

    // setTimeout(function() {
    //     var periode = $('#fPeriode').val();

    //     $.ajax({
    //         type: 'POST',
    //         url: '<?php echo base_url(); ?>index.php/sistem/ploting/get_data',
    //         data: {data: periode},
    //         success: function(data) {
    //             data = JSON.parse(data);
    //             isi_nilai(data);
    //             pagination();

    //             $('#btnOk').click();
    //         }
    //     });
    // }, 400);
    }

// Isi Data
    function isi_nilai(data) {

    // Hapus data sementara
        $("#data-table tbody").find("tr").remove();

    // Ambil data dari database dan simpan sementara ke array
        var id_karyawan = '', baris = 0;
        var arr_id = [], arr_nik = [], arr_nama = [], arr_jabatan = [], arr_bagian = [], arr_gaji = [];
    var arr_poin = [], arr_khusus = [], arr_reward = []; // Penambahan Nilai
    var arr_data = [];
    var tr = table.getElementsByTagName('tbody')[0].getElementsByTagName("tr");

    for (var i = 0; i < data.length; i++) {
        if (id_karyawan != data[i]['ID_KARYAWAN']) {
            arr_id[baris] = data[i]['ID_KARYAWAN'];
            arr_nik[baris] = data[i]['NIK'];
            arr_nama[baris] = data[i]['NAMA'];
            arr_jabatan[baris] = data[i]['JABATAN'];
            arr_bagian[baris] = data[i]['BAGIAN'];
            arr_gaji[baris] = data[i]['GAJI'];
            arr_poin[baris] = Number(data[i]['N_JABATAN']);
            arr_khusus[baris] = Number(data[i]['N_PLUS']);
            arr_reward[baris] = Number(data[i]['REWARD']);

            baris = baris + 1;
        }
        id_karyawan = data[i]['ID_KARYAWAN'];
    }

    // Isi table dengan data dari array sementara
    for (var i = 0; i < baris; i++) {
        n_hr = 0, n_is = 0, n_k3 = 0, n_al = 0, n_mj = 0, n_kl = 0, n_kl1 = 0, n_kl2 = 0;
        for (var j = 0; j < data.length; j++) {
            if (data[j]['ID_KARYAWAN'] == arr_id[i]) {
                if (data[j]['KATEGORI'] == 'HR') {
                    n_hr = (Number(n_hr) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'IS') {
                    n_is = (Number(n_is) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'K3') {
                    n_k3 = (Number(n_k3) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Atasan Langsung') {
                    n_al = (Number(n_al) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Manajemen') {
                    n_mj = (Number(n_mj) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Kolega') {
                    n_kl = (Number(n_kl) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Kolega 1') {
                    n_kl1 = (Number(n_kl1) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Kolega 2') {
                    n_kl2 = (Number(n_kl2) + Number(data[j]['NILAI'])).toFixed(2);
                }
            }
        }
        if (n_hr == 0) {
            n_hr = '';
        }
        if (n_is == 0) {
            n_is = '';
        }
        if (n_k3 == 0) {
            n_k3 = '';
        }
        if (n_al == 0) {
            n_al = '';
        }
        if (n_mj == 0) {
            n_mj = '';
        }
        if (n_kl == 0) {
            n_kl = '';
        }
        if (n_kl1 == 0) {
            n_kl1 = '';
        }
        if (n_kl2 == 0) {
            n_kl2 = '';
        }

        kategori = isi_kategori(n_hr, n_is, n_k3, n_al, n_mj, n_kl, n_kl1, n_kl2, arr_poin[i], arr_khusus[i], arr_reward[i]);

        nik = arr_nik[i];
        nama = arr_nama[i];
        jabatan = arr_jabatan[i];
        bagian = arr_bagian[i];
        nilai = kategori[0];
        n_jabatan = kategori[2];
        n_khusus = kategori[3];
        n_reward = kategori[4];
        n_total = kategori[5];
        kategori = kategori[1];
        gaji = arr_gaji[i];

        arr_data.push([nik, nama, jabatan, bagian, nilai, n_jabatan, n_khusus, n_reward, n_total, kategori, n_hr, n_is, n_k3, n_al, n_mj, n_kl, n_kl1, n_kl2, gaji]);
    }

    arr_data.sort(function(a, b) {
        return b[8] - a[8];
    });

    // Isi kategori kurva normal
    var ks = Math.round(10 / 100 * baris);
    var k = Math.round(20 / 100 * baris);
    var b = Math.round(20 / 100 * baris);
    var bs = Math.round(10 / 100 * baris);
    var c = baris - ks - k - b - bs;
    var qty_potong_premi = Math.round(2.5 / 100 * baris);
    var i = 0;

    arr_data.forEach(function(e) {
        i = i + 1;

        if ((i) <= bs) {
            kurva = 'BS';
        } else if ((i) <= (bs + b)) {
            kurva = 'B';
        } else if ((i) <= (bs + b + c)) {
            kurva = 'C';
        } else if ((i) <= (bs + b + c + k)) {
            kurva = 'K';
        } else if ((i) <= (bs + b + c + k + ks)) {
            kurva = 'KS';
        }

        nik = e[0];
        nama = e[1].toUpperCase();
        jabatan = e[2].toUpperCase();
        bagian = e[3].toUpperCase();

        e[4] == '0.00' ? nilai = '' : nilai = e[4];
        e[5] == '0.00' ? n_jabatan = '' : n_jabatan = e[5].toFixed(2);
        e[6] == '0.00' ? n_khusus = '' : n_khusus = e[6].toFixed(2);
        e[7] == '0.00' ? n_reward = '' : n_reward = e[7].toFixed(2);

        n_total = e[8];
        kategori = e[9];
        n_hr = e[10];
        n_is = e[11];
        n_k3 = e[12];
        n_al = e[13];
        n_mj = e[14];
        n_kl = e[15];
        n_kl1 = e[16];
        n_kl2 = e[17];
        gaji = formatNumber(e[18]);

        color_potong_premi = '';
        if (i > (baris - qty_potong_premi)) {
            color_potong_premi = "#FFB2B2";
        }

        color_belum_lengkap = '';
        qty_nilai = [n_hr, n_is, n_k3, n_al, n_mj, n_kl, n_kl1, n_kl2];
        empties = qty_nilai.length - qty_nilai.filter(String).length;
        if (empties > 2) {
            color_belum_lengkap = "#F80404";
        }

        $('#data-table').append('<tr style="background-color:' + color_potong_premi + ';" ondblclick="detail_penilai(this)"><td align="center">' + i + '</td><td align="center">' + nik + '</td><td style="color:' + color_belum_lengkap + ';">' + nama + '</td><td>' + jabatan + '</td><td>' + bagian + '</td><td align="center">' + nilai + '</td><td align="center">' + n_jabatan + '</td><td align="center" hidden>' + n_khusus + '</td><td align="center">' + n_reward + '</td><td align="center" style="font-weight: bold;">' + n_total + '</td><td align="center">' + kategori + '</td><td align="center">' + kurva + '</td><td align="center">' + n_hr + '</td><td align="center">' + n_is + '</td><td align="center">' + n_k3 + '</td><td align="center">' + n_al + '</td><td align="center">' + n_mj + '</td><td align="center">' + n_kl + '</td><td align="center">' + n_kl1 + '</td><td align="center">' + n_kl2 + '</td><td>' + gaji + '</td></tr>')
    });

    function formatNumber(num) {
        if (num == null) {
            return '';
        } else {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
    }
}

// Kategori Nilai
function isi_kategori(n_hr, n_is, n_k3, n_al, n_mj, n_kl, n_kl1, n_kl2, n_poin, n_khusus, n_reward) {
    pal = ((100 / 75) * 40) / 100;
    pmj = ((100 / 75) * 20) / 100;
    pkl = ((100 / 75) * 15) / 100;
    pkl1 = ((100 / 75) * 20) / 100;
    pkl2 = ((100 / 75) * 15) / 100;

    hrisk3 = ((Number(n_hr) + Number(n_is) + Number(n_k3)) / 3).toFixed(2);
    nilai_total = Number(n_al * pal) + Number(n_mj * pmj) + Number(n_kl * pkl) + Number(n_kl1 * pkl1) + Number(n_kl2 * pkl2);
    nilai = ((hrisk3 * 25 / 100) + (nilai_total * 75 / 100)).toFixed(2);

    n_total = (Number(nilai) + Number(n_poin) + Number(n_reward)).toFixed(2);
    if (n_total > 5) {
        n_total = 5;
    }

    // Kategori Nilai
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

    return [nilai, kategori, n_poin, n_khusus, n_reward, n_total];
}

// Chart
function chart() {
    var rows = data_table.rows().data().length;
    var ks = Math.round(10 / 100 * rows);
    var k = Math.round(20 / 100 * rows);
    var b = Math.round(20 / 100 * rows);
    var bs = Math.round(10 / 100 * rows);
    var c = rows - ks - k - b - bs;

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

// Tab Selection
function tab(e) {
    $('.tab').removeClass("btn-info").addClass("btn-default");
    e.classList.remove("btn-default");
    e.classList.add("btn-warning");

    if (e.innerText.trim() == 'Nilai') {
        $('.nilai').css('display', 'block');
        $('.grafik').css('display', 'none');
    } else {
        $('.nilai').css('display', 'none');
        $('.grafik').css('display', 'block');
        chart();
    }
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
    if (data_table == undefined) {
        return;
    }
    setTimeout(function() {
        data_table.columns.adjust().draw();
    }, 500);
});
$('.info_2:eq(0)').on('click', function() {
    if (info_2 == 0) {
        $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_2 = 1;
    } else {
        $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_2 = 0;
    }

    setTimeout(function() {
        tbl_periode.columns.adjust().draw();
    }, 500);
});
$('.info_3:eq(0)').on('click', function() {
    if (info_3 == 0) {
        $('.info_3:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_3 = 1;
    } else {
        $('.info_3:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_3 = 0;
    }

    setTimeout(function() {
        tbl_penilai.columns.adjust().draw();
    }, 500);
});
$('.info_4:eq(0)').on('click', function() {
    if (info_4 == 0) {
        $('.info_4:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_4 = 1;
    } else {
        $('.info_4:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_4 = 0;
    }

    setTimeout(function() {
        tbl_auto.columns.adjust().draw();
    }, 500);
});

// Auto Nilai (>tgl 20)
$('#ya_default').on('click', function() {
    var periode = $('#fPeriode').val();

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/ploting/auto_nilai',
        data: {
            data: periode
        },
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
            }, 1000);
        }
    });
});

// Sukses Simpan
$('#btnOkSukses').click(function() {
    filter();
});

// Lihat Penilai
function detail_penilai(btn) {
    var row = $(btn).closest("tr").index();
    var nik = table.rows[row + 1].cells[1].innerHTML;
    var nama = table.rows[row + 1].cells[2].innerHTML;
    var tbl_penilai = document.getElementById('tbl_penilai');

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/ploting/detail_penilai',
        data: {data: nik},
        success: function(data) {
            data = JSON.parse(data);

            $('#judul_penilai').html('Nama Penilai ' + nama);
            for (var i=0; i<tbl_penilai.rows.length; i++) {
                tbl_penilai.rows[i].cells[1].innerHTML = '';
            }
            for (var i=0; i<data.length; i++) {
                for (var j=0; j<tbl_penilai.rows.length; j++) {
                    if (tbl_penilai.rows[j].cells[0].innerHTML == data[i].KATEGORI) {
                        tbl_penilai.rows[j].cells[1].innerHTML = data[i].NAMA.toUpperCase();
                    }
                }
            }

            $('#modal_penilai').click();
        }
    });
}

// Drag Div Document
$("#modal-penilai").draggable({handle: ".card-header"});

</script>