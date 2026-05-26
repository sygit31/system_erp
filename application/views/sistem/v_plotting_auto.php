<?php

$dt_periode = array();
foreach ($periode->result_array() as $dt) {
    array_push($dt_periode, $dt['PERIODE']);
}
$periode = array_unique($dt_periode);

?>

<div class="card-header">
    <h3 class="card-title">
        <b>
            <font color="White">Data Auto Nilai</font>
        </b>
    </h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool info_4" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_4"></i></button>
        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
    </div>
</div>
<div class="card-body">
    <div class="card">
        <div class="card-body">
            <font size="2">
                <table style="width: 10%; margin-bottom: 10px;">
                    <thead>
                        <tr align="center" style="line-height: 30px;">
                            <th width="45%" class="filter" colspan="2">Periode</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="select" id="auto_periode" onchange="isi_auto()" style="width: 100%; cursor: pointer;">
                                    <option value="">Periode..</option>
                                    <?php foreach ($periode as $dt) { ?>
                                        <option><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div style="overflow-x: auto; padding-bottom: 20px;">
                    <div class="data-table">
                        <table id="tabel_auto" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Nik</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Bagian</th>
                                    <th>Kategori</th>
                                    <th>Info</th>
                                    <th>Unlock</th>
                                    <th hidden>ID Penilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <button style="width: 20%;" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </font>

        </div>
    </div>
</div>

<!-- Modal Konfirmasi Unlock Nilai -->
<div class="modal fade" id="modal_unlock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan membuka nilai? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="ya_unlock" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Auto Nilai -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
                <h3 class="card-title">
                    <b>
                        <font id="nama_auto_nilai" color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">Detail Auto Nilai</font>
                    </b>
                </h3>
            </div>

            <div class="card-body">
                <table id="tabel_detail" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Periode</th>
                            <th>Kategori</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button id="btnTutup" style="width: 25%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Tutup</b></button>
                <button id="btn_detail" type="button" class="btn btn-block btn-warning" data-toggle="modal" data-target="#modal-detail" hidden></button>
            </div>
        </div>
    </div>
</div>

<script>
    // Define Variable
    var tabel_auto = document.getElementById('tabel_auto');
    var tbl_auto;

    // Load Dokumen
    $(document).ready(function() {
        pagination_auto();
    });

    // Pagination
    function pagination_auto() {
        $('#tabel_auto').DataTable().destroy();

        var qty_data = $('#tabel_auto tr').length;

        if (qty_data == 1) {
            height = "100px";
        } else if (qty_data > 5) {
            height = "400px";
        } else {
            height = ((qty_data - 1) * 100) + "px";
        }

        tbl_auto = $('#tabel_auto').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sSearch": "Cari Nama Karyawan  :"
            },
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
                className: 'invisible excel',
                title: 'Laporan Data Penilai'
            }],
            "colReorder": true
        });

        setTimeout(function() {
            tbl_auto.columns.adjust().draw();
        }, 500);
    }

    // Isi Auto Nilai
    function isi_auto() {
        $('#tabel_auto').DataTable().destroy();
        $("#tabel_auto tbody").find("tr").remove();

        if ($('#auto_periode').val() == '') {
            pagination_auto();
            return;
        }
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ploting/isi_auto',
            data: {
                data: $('#auto_periode').val()
            },
            success: function(data) {
                data = JSON.parse(data);
                isi_data_auto(data);

                setTimeout(function() {
                    $('#btnOk').click();
                    pagination_auto();
                }, 1000);
            }
        });
    }

    // Isi Data Penilai
    function isi_data_auto(data) {
        for (var i = 0; i < data.length; i++) {
            urut = i + 1;
            nik = data[i].NIK;
            nama = data[i].NAMA;
            bagian = data[i].BAGIAN;
            jabatan = data[i].JABATAN;
            kategori = data[i].KATEGORI;
            id_penilai = data[i].ID_PENILAI;

            $('#tabel_auto').append('<tr><td align="center">' + urut + '</td><td align="center">' + nik + '</td><td>' + nama + '</td><td>' + jabatan + '</td><td>' + bagian + '</td><td>' + kategori + '</td><td><button type="button" class="btn btn-block btn-info btn-sm" title="Info Penilai" onclick="get_detail(this)" data-toggle="modal" data-target="#modal-detail"><b><i class="fa fa-chain-broken"></i></button></td><td><button type="button" class="btn btn-block btn-success btn-sm" title="Unlock Penilai" onclick="unlock(this)" data-toggle="modal" data-target="#modal_unlock" data-backdrop="static" data-keyboard="false"><b><i class="fa fa-check-square-o"></i></button></td><td hidden>' + id_penilai + '</td></tr>')
        }
    }

    // Ambil Detail Auto Nilai
    function get_detail(btn) {
        var row = $(btn).closest("tr").index() + 1;
        var id_penilai = tabel_auto.rows[row].cells[8].innerHTML;
        var nama_penilai = tabel_auto.rows[row].cells[2].innerHTML;
        var kategori_penilai = tabel_auto.rows[row].cells[5].innerHTML;
        var periode_detail = $('#auto_periode').val();

        document.getElementById('nama_auto_nilai').innerHTML = 'Detail Auto Nilai ' + nama_penilai;

        $('#tabel_detail').DataTable().destroy();
        $("#tabel_detail tbody").find("tr").remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ploting/detail_auto',
            data: {
                data: [id_penilai, kategori_penilai, periode_detail]
            },
            success: function(data) {
                data = JSON.parse(data);
                isi_detail_auto(data, periode_detail, kategori_penilai);

                setTimeout(function() {
                    $('#btnOk').click();
                    pagination_detail();
                }, 1000);
            }
        });

        $('#btn_detail').click();
    }

    // Isi Data Penilai
    function isi_detail_auto(data, periode_detail, kategori_penilai) {
        for (var i = 0; i < data.length; i++) {
            urut = i + 1;
            nama = data[i].NAMA;
            bagian = data[i].BAGIAN;
            jabatan = data[i].JABATAN;

            $('#tabel_detail').append('<tr><td align="center">' + urut + '</td><td>' + nama + '</td><td>' + bagian + '</td><td>' + jabatan + '</td><td>' + periode_detail + '</td><td>' + kategori_penilai + '</td><td>2.50</td></tr>')
        }
    }

    // Ambil Id Penilai untuk Unlock Nilai
    function unlock(btn) {
        var row = $(btn).closest("tr").index() + 1;
        var id_penilai = tabel_auto.rows[row].cells[8].innerHTML;

        $('#ya_unlock').click(function() {
            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/sistem/ploting/unlock_penilai',
                data: {
                    data: id_penilai
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        isiPenilai();
                    }, 1000);
                }
            });
            throw '';
        });
    }

    // Pagination Detail Auto Nilai
    function pagination_detail() {
        $('#tabel_detail').DataTable().destroy();

        var qty_data = $('#tabel_detail tr').length;

        if (qty_data == 1) {
            height = "100px";
        } else if (qty_data > 5) {
            height = "400px";
        } else {
            height = ((qty_data - 1) * 100) + "px";
        }

        tabel_detail = $('#tabel_detail').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sSearch": "Cari Nama Karyawan  :"
            },
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": height,
            "colReorder": true
        });

        setTimeout(function() {
            tabel_detail.columns.adjust().draw();
        }, 500);
    }
</script>