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

<div id="non_printable" class="content-wrapper" style="display: block;">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info" <?php if($status_menu=='2'){echo "hidden";} ?>>
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">
                            <div id="headerinput">Input Pengembalian PCH</div>
                        </font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="15%">Tanggal</th>
                        <td width="35%">
                            <input type="text" id="tgl" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" style="width: 40%; cursor: pointer;" autocomplete="off">
                        </td>
                        <th width="15%">No. IPB</th>
                        <td width="35%">
                            <select class="select" id="ipb" style="width: 60%;">
                                <option value="">Pilih IPB..</option>
                            </select>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>No. Serah Terima</th>
                        <td>
                            <div class="input-group">
                                <input type="text" id="nmr" value="000" class="form-control text-center mr-2" tabindex="2" maxlength="4">
                                <label id="kode_trans" style="width: 80%; margin-top: 5px;">-</label>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <table id="tabel_input" class="table table-bordered table-striped" width="100%">
                    <thead align="center" style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
                        <tr style="text-align: center;">
                            <td width="5%">No.</td>
                            <td width="20%">Jenis PCH</td>
                            <td width="20%">No. Register</td>
                            <td width="25%">No. Bon</td>
                            <td width="10%">Kondisi</td>
                            <td width="20%">Keterangan</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                        <font color="White">Data Pengembalian PCH</font>
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
                        <table style="width: 500px; margin-bottom: 10px;">
                            <thead>
                                <tr align="center" style="line-height: 30px;">
                                    <td width="50%" colspan="2" class="filter">Periode</td>
                                    <td></td>
                                    <td width="25%" class="filter">Desain</td>
                                    <td></td>
                                    <td width="25%" class="filter">Seri</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input id="fTgl1" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                    <td><input id="fTgl2" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
                                            <?php foreach ($desain->result_array() as $dt) { ?>
                                                <option><?php echo $dt['DESAIN']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fSeri" onchange="filter()" style="width: 100%; cursor: pointer;">
                                            <option>All..</option>
                                            <?php foreach ($seri->result_array() as $dt) { ?>
                                                <option><?php echo $dt['SERI']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="data-table" style="font-size: 13px;"></div>

                        <button type="button" class="btn btn-block btn-success" style="width: 150px;" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="card-footer text-right pr-4">
        <font color="Green" size="2">ERP @2019</font>
    </div>
</div>

<div id="printable" style="display: none; overflow-y: hidden;">
    <h3 align="center">TANDA SERAH TERIMA PCH HABIS PAKAI</h3>
    <h5 id="nmr_reject" align="center" class="mb-4">XXX/XX/XX-XX/XXX</h5>

    <h5>Telah diserah terimakan PCH habis pakai bagian Prod - SC kepada bagian Galvanik sbb :</h5>
    <table id="tabel_print" class="table table-bordered" style="font-size: 14px;">
        <thead>
            <tr align="center">
                <td>No.</td>
                <td>Nama PCH</td>
                <td>Baik</td>
                <td>Bekas</td>
                <td>Ukuran</td>
                <td>No. Bon</td>
                <td>No. Register</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <div align="right" style="font-size: 10px; margin-top: -10px; margin-bottom: 10px;">F-SMT-P2-003 Rev. 01</div>

    <div style="font-size: 14px;">
        <div id="tgl_print" class="mb-3" style="margin-left: 100px;">Kudus, 16 September 2020</div>
        <table id="print_footer" width="80%" style="line-height: 10px; margin-left: auto; margin-right: auto;">
            <tr>
                <td width="25%">Yang menyerahkan,</td>
                <td align="center" width="25%">Yang menerima,</td>
                <td align="center" width="50%" colspan="2">Mengetahui,</td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td width="25%">Bagian Emboss</td>
                <td align="center" width="25%">Bag. Galvanik</td>
                <td align="center" width="25%">Kabid Prod.</td>
                <td align="center" width="25%">IS</td>
            </tr>
            <tr style="height: 50px;"></tr>
            <tr style="letter-spacing: 3px;">
                <td width="25%">( .................... )</td>
                <td align="center" width="25%">( .................... )</td>
                <td align="center" width="25%">( .................... )</td>
                <td align="center" width="25%">( .................... )</td>
            </tr>
        </table>
    </div>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="salah_isian" class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <div id="keterangan_isian" class="modal-body" style="font-size: 20px; color: #0c1ac5; font-weight: bold;"></div>
            <div class="modal-footer">
                <button onclick="$('#keterangan_isian').html('');" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
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
                <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){data_tabel.columns.adjust().draw();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
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

<!-- Modal Confirm Approve -->
<div class="modal fade" id="modal_approve" style="z-index: 9997;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan Approve data? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="ya_approve" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="btnApprove" data-toggle="modal" data-target="#modal_approve" hidden></button>
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
    var status_menu = <?php echo json_encode($status_menu); ?>;
    var dt_nmr_ipb = [];
    var desain = '', nmr_ipb = '', nmr_reject = '';
    var data_tabel;

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        $(".datepicker").datepicker({
            dateFormat: 'dd-M-yy'
        });

        filter();
        isi_ipb();
    });

// Filter Data
    function filter() {
        var tgl1 = document.getElementById('fTgl1').value;
        var tgl2 = document.getElementById('fTgl2').value;
        var kd_unit = <?php echo json_encode($kd_unit) ?>;
        var seri = document.getElementById('fSeri').value;
        var desain = document.getElementById('fDesain').value;
        var data = [tgl1, tgl2, kd_unit, status_menu, seri, desain];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url() . "index.php/galvanik/reject/filter" ?>',
                success: function(data) {
                    $('.data-table').html(data);
                    
                    setTimeout(function() {
                        $('#btnOk_progress').click();
                        pagination();
                    }, 500);
                }
            });
        }, 500);
    }

// Pagination
    function pagination() {
        data_tabel = $('#data-table').DataTable().destroy();
        data_tabel = $('#data-table').DataTable({
            "paging": false,
            "ordering": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": '350px',
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'invisible excel',
                title: 'LAPORAN PENGEMBALIAN PCH GALVANIK'
            }],
            "colReorder": true
        });
    }

// Format Nomor 000
    $('#nmr').focusout(function() {
        var nmr = '000'+$('#nmr').val();
        nmr = nmr.substring(nmr.length-3,nmr.length);

        $('#nmr').val(nmr);
    });

// Auto Nomor IPB
    function auto_no() {
        var nmr_ipb = $('#ipb').val();
        var tgl = $('#tgl').val();
        var kd_unit = <?php echo json_encode($kd_unit) ?>;
        var data = [nmr_ipb, tgl, kd_unit, desain];

        $.ajax({
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url(); ?>index.php/galvanik/reject/auto_no',
            success: function(data) {
                data = JSON.parse(data);
                urut = nmr_ipb == '' ? '000' : data[0];
                kode = nmr_ipb == '' ? '-' : data[1];

                $('#nmr').val(urut);
                $('#kode_trans').html(kode);
            }
        });
    }

// Isi Nomor IPB
    function isi_ipb() {
        var kd_unit = <?php echo json_encode($kd_unit) ?>;
        var ipb = document.getElementById("ipb");

        dt_nmr_ipb = [];
        $("#ipb").empty();
        $('#ipb').append(new Option('Pilih IPB..'));
        $('#ipb').val('Pilih IPB..').change();

        $.ajax({
            type: 'POST',
            data: {data: kd_unit},
            url: '<?php echo base_url(); ?>index.php/galvanik/reject/isi_ipb',
            success: function(data) {
                var data = JSON.parse(data);

                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement("option");

                    option.text = data[i].NMR;
                    ipb.add(option);
                    dt_nmr_ipb.push(data[i].NMR);
                }
            }
        });
    }

// Isi Tabel PCH
    $('#ipb').change(function() {
        var indeks = $("#ipb")[0].selectedIndex - 1;

        $("#tabel_input tbody").find("tr").remove();
        if (indeks == -1) {
            $('#nmr').val('000');
            return;
        }

        nmr_ipb = dt_nmr_ipb[indeks];
        $.ajax({
            data: {data: nmr_ipb},
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/reject/isi_pch',
            success: function(data) {
                data = JSON.parse(data);
                isi_tabel(data);
                auto_no();
            }
        });
    });

// Isi Tabel PCH
    function isi_tabel(data) {
        if (data.length == 0) {
            return;
        }

        desain = data[0].DESAIN;
        data.forEach(function(item, index) {
            id = item.ID;
            jenis = item.NAMA;
            no_reg = item.NO_REG;
            no_bon = item.NO_IPB;
            kondisi = 'Bekas';

            $('#tabel_input tbody').append('<tr><td hidden>' + id + '</td><td align="center">' + (index + 1) + '</td><td>' + jenis + '</td><td>' + no_reg + '</td><td>' + no_bon + '</td><td>' + kondisi + '</td><td><input type="text" class="form-control" name="keterangan" style="width: 100%;" maxlength="30"></td></tr>')
        });
    }

// Kosong Isian
    function kosong() {
        isi_ipb();

        $('#nmr').val('000');
        $('#kode_trans').html('-');
        $('#ipb').val('Pilih IPB..').change();
        $("#tabel_input").find("tr:gt(0)").remove();

        dt_nmr_ipb = [];
    }

// Cek duplikat nomor
    function cek_nomor(urut) {
        var duplikat = 0;
        var nmr_ipb = $('#ipb').val();
        var data = [urut, nmr_ipb];

        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/reject/cek_nomor',
            data: {data: data},
            success: function(data) {
                duplikat = data;
            }
        });
        return duplikat;
    }

// Tampilkan error isian
    function error_isian(str) {
        $('#keterangan_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Error isian!");
    }

// Simpan Data
    function simpan() {
        var tabel_input = $('#tabel_input')[0];
        var tgl = $('#tgl').val();
        var urut = $('#nmr').val();
        var kode_trans = $('#kode_trans').html();
        var nmr = urut + kode_trans;
        var ipb = document.getElementById("ipb").value;
        var duplikat = cek_nomor(urut);
        var id_galv_ipb = [], kondisi = [], keterangan = [];

        if (ipb == 'Pilih IPB..' || tabel_input.rows.length == 1) {error_isian('Tidak ada PCH yang dipilih..');}
        if (urut == '000') {error_isian('Nomor Serah Terima salah..');}
        if (duplikat != 0) {error_isian('Nomor Serah Terima sudah terpakai..');}

        for (var i = 0; i < tabel_input.rows.length - 1; i++) {
            id_galv_ipb.push(tabel_input.rows[i + 1].cells[0].innerHTML);
            kondisi.push(tabel_input.rows[i + 1].cells[5].innerHTML);
            keterangan.push(document.getElementsByName('keterangan')[i].value);
        }

        var data = [tgl, nmr, id_galv_ipb, kondisi, keterangan];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/reject/simpan',
            data: {
                data: data
            },
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk_progress').click();
                    $('#btnSukses').click();
                }, 500);

                kosong();
                filter();
            }
        });
    }

// Hapus IPB
    function hapus(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        nmr_reject = data_table.rows[row].cells[3].innerHTML;

        $('#btnHapus').click();
        $('#ya').on('click', function() {
            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/galvanik/reject/hapus',
                data: {data: nmr_reject},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk_progress').click();
                        $('#btnSukses').click();
                    }, 500);

                    filter();
                    isi_ipb();

                    nmr_reject = '';
                }
            });
            throw new Error("Proses hapus selesai..");
        });
    }

// Approve IPB
    function approve(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        nmr_reject = data_table.rows[row].cells[3].innerHTML;

        $('#btnApprove').click();
        $('#ya_approve').on('click', function() {
            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/galvanik/reject/approve',
                data: {data: nmr_reject},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk_progress').click();
                        $('#btnSukses').click();
                    }, 500);

                    filter();
                }
            });
            throw new Error("Proses approve selesai..");
        });
    }

// Cetak IPB
    function cetak(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var nmr = data_table.rows[row].cells[3].innerHTML;

        $("#tabel_print tbody").find("tr").remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/galvanik/reject/isi_print',
            data: {
                data: nmr
            },
            success: function(data) {
                data = JSON.parse(data);

                $('#nmr_reject').text(data[0].NMR);
                $('#tgl_print').text('Kudus, ' + data[0].TGL);

                data.forEach(function(item, index) {
                    nama = item.NAMA;
                    ukuran = item.UKURAN;
                    kondisi = item.KONDISI;
                    no_ipb = item.NO_IPB;
                    baik = '';
                    bekas = '';
                    kondisi == 'Baik' ? baik = 'V' : bekas = 'V';
                    no_reg = item.NO_REG;

                    $('#tabel_print tbody').append('<tr><td align="center">' + (index + 1) + '</td><td>' + nama + '</td><td align="center">' + baik + '</td><td align="center">' + bekas + '</td><td>' + ukuran + '</td><td>' + no_ipb + '</td><td>' + no_reg + '</td></tr>')
                });

            // Print Area Table
                var printable = document.getElementById('printable');
                var non_printable = document.getElementById('non_printable');

                printable.style.display = "";
                non_printable.style.display = "none";
                window.print();

                printable.style.display = "none";
                non_printable.style.display = "";
            }
        });
    }
</script>