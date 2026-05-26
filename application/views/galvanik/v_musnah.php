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

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Input Pemusnahan PCH</div>
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
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Tanggal BA</th>
                                <td width="60%">
                                    <input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" onchange="auto_no(); isi_barang();" style="width: 100%; cursor: pointer; background-color: #FFFFFF;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>No. BA</th>
                                <td>
                                    <div class="input-group">
                                        <input type="text" id="nmr" value="000" class="form-control num text-center mr-2" tabindex="3" maxlength="3" autocomplete="off">
                                        <label id="kode_trans" style="width: 75%; margin-top: 5px;">-</label>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <font size="2">
                        <div class="card-body">
                            <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                                <table style="width: 700px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="20%" class="filter">Jenis</td>
                                            <td></td>
                                            <td width="15%" class="filter">Desain</td>
                                            <td hidden></td>
                                            <td width="15%" class="filter" hidden>Tipe</td>
                                            <td></td>
                                            <td width="30%" class="filter">Keterangan</td>
                                            <td></td>
                                            <td width="35%" class="filter">Produk PCH</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="jenis" onchange="isi_barang()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <option>Cukai</option>
                                                    <option>Non Cukai</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="desain" onchange="isi_barang()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($desain->result_array() as $dt) { ?>
                                                        <option><?php echo $dt['DESAIN']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td hidden></td>
                                            <td hidden>
                                                <select class="select" id="tipe" onchange="isi_barang()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <option>Produksi</option>
                                                    <option>Proof</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="keterangan" onchange="isi_barang()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <option>Ex. Produksi Emboss</option>
                                                    <option>Reject Galvanik</option>
                                                    <option>Ex. Produksi Galvanik</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="produk" onchange="isi_barang()" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($produk->result_array() as $dt) { ?>
                                                        <option><?php echo $dt['NAMA']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <table id="tabel_input" class="table table-bordered table-striped" width="100%">
                                <thead align="center" style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
                                    <tr style="text-align: center;">
                                        <td hidden></td>
                                        <td width="7%">No.</td>
                                        <td width="20%">Jenis PCH</td>
                                        <td width="10%">Tanggal ST</td>
                                        <td width="23%">No. Serah Terima/ No. Register</td>
                                        <td width="10%">Jumlah</td>
                                        <td width="15%">Kode Master</td>
                                        <td width="15%">Keterangan</td>
                                        <td>Pilih</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th colspan="4">Total</th>
                                        <th></th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </font>
                </div>
                <div class="float-right">
                    <button type="button" style="width: 120px;" class="btn btn-success" onclick="check()"><i class="fa fa-check-square-o m-2"></i><b>Check</b></button>
                    <button type="button" style="width: 120px;" class="btn btn-danger" onclick="uncheck()"><i class="fa fa-close m-2"></i><b>Uncheck</b></button>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" style="width: 150px;" class="btn btn-primary" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Laporan Pemusnahan PCH</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                                <table style="width: 400px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="30%" class="filter">Periode</td>
                                            <td></td>
                                            <td width="70%" class="filter">Produk</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="f_periode" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($periode->result_array() as $dt) { ?>
                                                        <option><?php echo $dt['PERIODE']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_produk" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($produk->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['ID_PRODUK'] . '@_@' . $dt['NAMA']; ?>"><?php echo $dt['NAMA']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <table id="data-table" class="table table-bordered table-striped" width="100%">
                                <thead align="center" style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
                                    <tr align="center">
                                        <th hidden></th>
                                        <th>No.</th>
                                        <th>Periode</th>
                                        <th>No. BA</th>
                                        <th>Jenis PCH</th>
                                        <th>Tanggal ST</th>
                                        <th>No. ST / Reg</th>
                                        <th>Kode PCH</th>
                                        <th>Qty</th>
                                        <th>Keterangan</th>
                                        <th>Batal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr style="text-align: center;">
                                        <th colspan="7">Total</th>
                                        <th>0</th>
                                        <th colspan="2"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </font>

                        <table class="mt-3">
                            <tr>
                                <td width="120"><button type="button" class="btn btn-block btn-warning" title="Cetak" onclick="cetak()"><i class="fa fa-print m-2"></i><b>Cetak</b></button></td>
                                <td></td>
                                <td width="120"><button type="button" class="btn btn-block btn-success" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
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

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <h5><div class="modal-body text-info invisible" id="error_isian"></div></h5>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2" onclick="$('#error_isian').addClass('invisible')"></i><b>OK</b></button>
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
                <button id="btnOk_progress" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
                <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
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
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Print Data Pemusnahan -->
<div id="printable" style="display: none; font-family: Geneva; vertical-align: middle;">
    <div align="center"><h4><b>Pemusnahan PCH Galvanik</b></h4></div>
    <div><h6 id="pr_periode"></h6></div>
    <div><h6 id="pr_tgl"></h6></div>
    <div><h6 id="pr_jenis"></h6></div>
    <table id="tbl_print" class="table-bordered mb-4" width="100%" style="font-size: 12px;">
        <thead>
            <tr align="center" style="height: 30px;">
                <th>No.</th>
                <th>No. BA</th>
                <th>Jenis PCH</th>
                <th>Tanggal ST</th>
                <th>No. Serah Terima/ No. Register</th>
                <th>Kode Master</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr style="text-align: center;">
                <th colspan="6">Total</th>
                <th>0</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    <table width="60%" style="text-align: center;">
        <tr>
            <td width="50%">Dibuat oleh,</td>
            <td width="50%">Mengatahui,</td>
        </tr>
        <tr style="height: 50px;"></tr>
        <tr>
            <td><u>Ruli Hermawanti</u></td>
            <td><u>Clamet Azzagaf</u></td>
        </tr>
        <tr>
            <td>Kabid Galvanik</td>
            <td>Manager Produksi</td>
        </tr>
    </table>
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
    var data_tabel, data_input, id_detail = '';
    var info_1 = 0, info_2 = 0;

// Resize Dokumen
    $(window).resize(function() {
        setTimeout(function() {
            data_tabel.columns.adjust().draw();
            data_input.columns.adjust().draw();
        }, 500);
    });

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        $(".datepicker").datepicker({
            dateFormat: 'dd-M-yy'
        });

        auto_no();
        isi_barang();
        filter();
    });

// Hide Sidebar
    $('#hide_sidebar').click(function() {
        setTimeout(function() {
            data_tabel.columns.adjust().draw();
            data_input.columns.adjust().draw();
        }, 500);
    });

// Format Nomor 000
    $('#nmr').focusout(function() {
        var nmr = '000'+$('#nmr').val();
        nmr = nmr.substring(nmr.length-3,nmr.length);

        $('#nmr').val(nmr);
    });

// Auto Nomor
    function auto_no() {
        var tgl = $('#tgl').val();
        var thn = tgl.substring(7,12);
        var data = [thn, tgl];

        $.ajax({
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url(); ?>index.php/galvanik/musnah/auto_no',
            success: function(data) {
                data = JSON.parse(data);
                urut = data[0];
                kode = data[1];

                $('#nmr').val(urut);
                $('#kode_trans').html(kode);
            }
        });
    }

// Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        data_tabel = $('#data-table').DataTable({
            "paging": false,
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
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
                title: 'LAPORAN PEMUSNAHAN PCH'
            }],
            "colReorder": true
        });
        setTimeout(function() {
            data_tabel.columns.adjust().draw();
        }, 1000);
    }

// Pagination Tabel Input
    function pagination_input() {
        data_input = $('#tabel_input').DataTable().destroy();
        data_input = $('#tabel_input').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": '400px',
            "colReorder": true,
            "columnDefs": [{
                "orderable": false,
                "targets": "_all"
            }],
            "order": []
        });
        setTimeout(function() {
            data_input.columns.adjust().draw();
        }, 500);
    }

// Isi Data Barang
    function isi_barang() {
        var periode = $('#tgl').val();
        var jenis = $('#jenis').val().substring(0, 1);
        var desain = $('#desain').val();
        var tipe = $('#tipe').val();
        var keterangan = $('#keterangan').val();
        var produk = $('#produk').val();
        var t_total = 0;
        var data = [periode, jenis, desain, tipe, keterangan, produk];

        $('#tabel_input').DataTable().destroy();
        $("#tabel_input tbody").find("tr").remove();

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url(); ?>index.php/galvanik/musnah/isi_barang',
            success: function(data) {
                var data = JSON.parse(data);
                var ex_emboss = keterangan == 'All' || keterangan == 'Ex. Produksi Emboss' ? data[0] : [];
                var ex_reject = keterangan == 'All' || keterangan == 'Reject Galvanik' ? data[1] : [];
                var ex_produksi = keterangan == 'All' || keterangan == 'Ex. Produksi Galvanik' ? data[2] : [];

                t_total = isi_ex_emboss(ex_emboss, t_total);
                t_total = isi_ex_reject(ex_reject, ex_emboss.length, t_total);
                isi_ex_produksi(ex_produksi, ex_emboss.length+ex_reject.length, t_total);
                setTimeout(function() {
                    pagination_input();
                    $('#btnOk_progress').click();
                }, 500);
            }
        });
    }

// Isi tabel Ex. Emboss
    function isi_ex_emboss(data, t_total) {
        data.forEach(function(item, index) {
            nama = item.NAMA;
            tgl = item.TGL;
            nmr = item.NMR;
            kode = item.MASTER + ' - ' + item.KODE_MASTER;
            qty_pch = item.QTY_PCH;
            keterangan = 'Ex. Produksi Emboss';
            t_total = t_total + Number(qty_pch);

            $('#tabel_input tbody').append('<tr><td hidden></td><td align="center">' + (index + 1) + '</td><td>' + nama + '</td><td align="center">' + tgl + '</td><td>' + nmr + '</td><td align="center">' + qty_pch + '</td><td>' + kode + '</td><td>' + keterangan + '</td><td align="center"><input type="checkbox" name="pilih" style="cursor: pointer;" checked></td></tr>')
        });
        return t_total;
    }

// Isi tabel Ex. Produksi
    function isi_ex_reject(data, qty, t_total) {
        data.forEach(function(item, index) {
            id = item.ID;
            nama = item.NAMA;
            tgl = item.TGL;
            no_reg = item.NO_REG;
            kode = item.MASTER + ' - ' + item.KODE_MASTER;
            keterangan = 'Reject Galvanik';
            t_total = t_total + 1;

            $('#tabel_input tbody').append('<tr><td hidden>' + id + '</td><td align="center">' + (qty + index + 1) + '</td><td>' + nama + '</td><td align="center">' + tgl + '</td><td>' + no_reg + '</td><td align="center">1</td><td>' + kode + '</td><td>' + keterangan + '</td><td align="center"><input type="checkbox" name="pilih" style="cursor: pointer;" checked></td></tr>')
        });
        return t_total;
    }

// Isi tabel Ex. Produksi
    function isi_ex_produksi(data, qty, t_total) {
        data.forEach(function(item, index) {
            id = item.ID;
            nama = item.NAMA;
            tgl = item.TGL;
            no_reg = item.NO_REG;
            kode = item.MASTER + ' - ' + item.KODE_MASTER;
            keterangan = 'Ex. Produksi Galvanik';
            t_total = t_total + 1;

            $('#tabel_input tbody').append('<tr><td hidden>' + id + '</td><td align="center">' + (qty + index + 1) + '</td><td>' + nama + '</td><td align="center">' + tgl + '</td><td>' + no_reg + '</td><td align="center">1</td><td>' + kode + '</td><td>' + keterangan + '</td><td align="center"><input type="checkbox" name="pilih" style="cursor: pointer;" checked></td></tr>')
        });
        $('#tabel_input tfoot th:eq(1)').html(format_number(t_total));
    }

// Reset Isian
    function check() {
        var qty_data = $('#tabel_input tbody tr').length;

        for (var i=0; i<qty_data; i++) {
            document.getElementsByName('pilih')[i].checked = true;
        }
    }
    function uncheck() {
        var qty_data = $('#tabel_input tbody tr').length;

        for (var i=0; i<qty_data; i++) {
            document.getElementsByName('pilih')[i].checked = false;
        }
    }

// Cek duplikat nomor
    function cek_nomor(nmr, tgl) {
        var duplikat = 0;
        var data = [nmr, tgl];

        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/musnah/cek_nomor',
            data: {data: data},
            success: function(data) {
                duplikat = data;
            }
        });
        return duplikat;
    }

// Simpan Data
    function simpan() {
        var qty_data = $('#tabel_input tbody tr').length;
        var tgl = document.getElementById("tgl").value;
        var urut = $('#nmr').val();
        var kode_trans = $('#kode_trans').html();
        var nmr = urut + kode_trans;
        var pilih = 0;
        var duplikat = cek_nomor(nmr, tgl);
        var id_galv_proses = [], no_serah_terima = [], keterangan = [];

        for (var i=0; i<qty_data; i++) {
            if (document.getElementsByName('pilih')[i].checked == true) {
                id_galv_proses.push(tabel_input.rows[i + 1].cells[0].innerHTML);
                no_serah_terima.push(tabel_input.rows[i + 1].cells[4].innerHTML);
                keterangan.push(tabel_input.rows[i + 1].cells[7].innerHTML);

                pilih = pilih + 1;
            };
        }

        if (urut == '000' || duplikat != 0 || pilih == 0) {

            if (pilih == 0) {$('#error_isian').html('Tidak ada PCH yang dipilih..');}
            if (duplikat != 0) {$('#error_isian').html('Nomor BA sudah terpakai..');}
            if (urut == '000') {$('#error_isian').html('Nomor BA salah..');}

            $('#error_isian').removeClass('invisible');
            $('#btnIsian').click();
            return;
        }

        var data = [tgl, nmr, id_galv_proses, no_serah_terima, keterangan];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/musnah/simpan',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk_progress').click();
                    $('#btnSukses').click();
                }, 500);
                isi_barang();
                filter();
                auto_no();
            },
            error: function (err) {
                console.log(err.responseText);
            }
        });
    }

// Konfirmasi Hapus
    function hapus(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        id_detail = data_table.rows[row].cells[0].innerHTML + '/' + data_table.rows[row].cells[9].innerHTML;

        $('#btnHapus').click();
    }

// Hapus Data
    $('#ya').on('click', function() {
        $('#btnProgress').click();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/musnah/hapus',
            data: {data: id_detail},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk_progress').click();
                    $('#btnSukses').click();
                }, 500);

                id_detail = '';
                isi_barang();
                filter();
            }
        });
    });

// Filter Data
    function filter() {
        var periode = document.getElementById('f_periode').value;
        var id_produk = document.getElementById('f_produk').value.split('@_@')[0];
        var data = [periode, id_produk];

        $('#data-table').DataTable().destroy();
        $("#data-table tbody").find("tr").remove();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/galvanik/musnah/filter" ?>',
            success: function(data) {
                data = JSON.parse(data);
                data_emboss = data[0];
                data_galvanik = data[1];

                urut_emboss = data_emboss.length;
                t_total = isi_data_emboss(data_emboss);
                isi_data_galvanik(data_galvanik, urut_emboss, t_total);
                pagination();
            }
        });
    }

// Isi tabel Pemusnahan Ex. Emboss
    function isi_data_emboss(data) {
        var c_periode = <?php echo json_encode(date('ym')); ?>;
        var t_total = 0;

        data.forEach(function(item, index) {
            id = item.ID;
            tgl_musnah = item.TGL_MUSNAH;
            periode = item.PERIODE;
            t_periode = item.T_PERIODE;
            nmr = item.NMR;
            master = item.MASTER;
            tgl_st = item.TGL_ST;
            nmr_st = item.NMR_ST;
            no_master = item.NO_MASTER;
            qty = item.QTY;
            keterangan = item.KETERANGAN;
            t_total = t_total + Number(qty);

            $('#data-table tbody').append('<tr><td hidden>' + id + '</td><td align="center">' + (index + 1) + '</td><td align="center">' + periode + '</td><td>' + nmr + '</td><td align="center">' + master + '</td><td align="center">' + format_date(tgl_st) + '</td><td>' + nmr_st + '</td><td align="center">' + no_master + '</td><td align="center">' + qty + '</td><td>' + keterangan + '</td><td><button type="button" class="btn btn-block btn_hapus btn-danger btn-sm" title="Batal Reject" onclick="hapus(this)"><b><i class="fa ion-trash-a"></i></button></td></tr>');
            // if (t_periode < c_periode) {$('.btn_hapus:eq('+index+')').hide();}

            $('#pr_tgl').html('Tanggal BA : ' + format_date(tgl_musnah));
        });
        return t_total;
    }

// Isi tabel Pemusnahan Reject Galvanik
    function isi_data_galvanik(data, urut_emboss, t_total) {
        var c_periode = <?php echo json_encode(date('ym')); ?>;

        data.forEach(function(item, index) {
            urut = urut_emboss + index + 1;
            id = item.ID;
            tgl_musnah = item.TGL_MUSNAH;
            periode = item.PERIODE;
            t_periode = item.T_PERIODE;
            nmr = item.NMR;
            master = item.MASTER;
            tgl_st = item.TGL_MASTER == null ? item.TGL_ST : item.TGL_MASTER;
            nmr_st = item.NMR_ST;
            no_master = item.NO_MASTER;
            qty = item.QTY;
            keterangan = item.KETERANGAN;
            t_total = t_total + Number(qty);

            $('#data-table tbody').append('<tr><td hidden>' + id + '</td><td align="center">' + urut + '</td><td align="center">' + periode + '</td><td>' + nmr + '</td><td align="center">' + master + '</td><td align="center">' + format_date(tgl_st) + '</td><td>' + nmr_st + '</td><td align="center">' + no_master + '</td><td align="center">' + qty + '</td><td>' + keterangan + '</td><td><button type="button" class="btn btn-block btn_hapus btn-danger btn-sm" title="Batal Reject" onclick="hapus(this)"><b><i class="fa ion-trash-a"></i></button></td></tr>');
            // if (t_periode < c_periode) {$('.btn_hapus:eq('+(urut-1)+')').hide();}

            $('#pr_tgl').html('Tanggal BA : ' + format_date(tgl_musnah));
        });
        $('#data-table tfoot th:eq(1)').html(format_number(t_total));
    }

// Print BA
    function cetak() {
        var periode = $('#f_periode').val();
        var jenis = $('#f_produk').val().split('@_@')[1];
        var data_table = document.getElementById('data-table');
        var qty_data = data_table.rows.length;
        var total = 0;
        if (qty_data == 2) {return;}

        $('#pr_periode').html('Periode : ' + periode);
        $('#pr_jenis').html('Jenis : ' + jenis);
        $("#tbl_print tbody tr").remove();

        for (var i=1; i<qty_data-1; i++) {
            no_ba = data_table.rows[i].cells[3].innerHTML;
            jenis = data_table.rows[i].cells[4].innerHTML;
            tgl_st = data_table.rows[i].cells[5].innerHTML;
            nmr_st = data_table.rows[i].cells[6].innerHTML;
            kode = data_table.rows[i].cells[7].innerHTML;
            jml = data_table.rows[i].cells[8].innerHTML;
            keterangan = data_table.rows[i].cells[9].innerHTML;
            total = total + Number(jml);

            $('#tbl_print tbody').append('<tr style="height: 25px;"><td align="center">'+i+'</td><td class="pl-2">'+no_ba+'</td><td class="pl-2">'+jenis+'</td><td align="center">'+tgl_st+'</td><td class="pl-2">'+nmr_st+'</td><td align="center">'+kode+'</td><td align="center">'+jml+'</td><td class="pl-2">'+keterangan+'</td></tr>');
            $('#tbl_print tfoot tr:eq(0) th:eq(1)').html(total);
        }

        setTimeout(function() {
            var printable = document.getElementById('printable');
            var non_printable = document.getElementById('non_printable');

            printable.style.display = "";
            non_printable.style.display = "none";
            window.print();

            printable.style.display = "none";
            non_printable.style.display = "";
        }, 700);
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