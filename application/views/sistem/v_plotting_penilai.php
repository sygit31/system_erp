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
            <font color="White">Outstanding Penilai</font>
        </b>
    </h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool info_3" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_3"></i></button>
        <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
    </div>
</div>
<div class="card-body">
    <div class="card">
        <div class="card-body">
            <font size="2">
                <table style="width: 45%; margin-bottom: 10px;">
                    <thead>
                        <tr align="center" style="line-height: 30px;">
                            <th width="45%" class="filter">Periode Penilaian</th>
                            <td></td>
                            <th width="55%" class="filter">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="select" id="tPeriode" style="width: 100%; cursor: pointer;">
                                    <option value="">Periode..</option>
                                    <?php foreach ($periode as $dt) { ?>
                                        <option><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td></td>
                            <td>
                                <select class="select" id="tUnit" style="width: 100%;">
                                    <?php foreach ($unit->result_array() as $dt) { ?>
                                        <option><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-body card-footer">
                    <button type="button" class="btn btn-warning" title="Click to View Data" onclick="isiPenilai()" style="width: 120px;"><i class="fa fa-book mr-2"></i><b>View</b></button>
                    <button type="button" class="btn btn-success btn_excel" title="Export to Excel" style="width: 120px;" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
                </div>

                <div style="overflow-x: auto; padding-bottom: 20px;">
                    <div class="data-table">
                        <table id="tabel_penilai" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr align="center">
                                    <th>No.</th>
                                    <th>Nik</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jabatan</th>
                                    <th>Bagian</th>
                                    <th>Kategori</th>
                                    <th>Info</th>
                                    <th hidden>ID Penilai</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </font>

        </div>
    </div>
</div>

<!-- Modal Detail Outstanding Nilai -->
<div class="modal fade" id="modal-outstanding">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
                <h3 class="card-title">
                    <b>
                        <font id="nama_outstanding_nilai" color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">Detail Outstanding Nilai</font>
                    </b>
                </h3>
            </div>

            <div class="card-body">
                <table id="tabel_outstanding" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr align="center">
                            <th>No.</th>
                            <th>Nama Karyawan</th>
                            <th>Bagian</th>
                            <th>Jabatan</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button style="width: 25%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Tutup</b></button>
            </div>
        </div>
    </div>
</div>

<script>

// Define Variable
    var tabel_penilai = document.getElementById('tabel_penilai');
    var tbl_penilai;

// Load Dokumen
    $(document).ready(function() {
        pagination_penilai();
    });

// Pagination
    function pagination_penilai() {
        var qty_data = $('#tabel_penilai tr').length;

        if (qty_data == 1) {
            height = "100px";
        } else if (qty_data > 5) {
            height = "400px";
        } else {
            height = ((qty_data - 1) * 100) + "px";
        }

        tbl_penilai = $('#tabel_penilai').DataTable({
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
            tbl_penilai.columns.adjust().draw();
        }, 500);
    }

// Isi Nama Penilai
    function isiPenilai() {
        var periode = $('#tPeriode').val();
        var unit = $('#tUnit').val();
        var data = [periode,unit];

        $('#tabel_penilai').DataTable().destroy();
        $("#tabel_penilai tbody").find("tr").remove();

        if (periode == '') {pagination_penilai(); return;}
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ploting/isi_penilai',
            data: {data: data},
            success: function(data) {
                data = JSON.parse(data);

                isi_data_penilai(data);
                setTimeout(function() {
                    $('#btnOk').click();
                    pagination_penilai();
                }, 2000);
            }
        });
    }

// Isi Data Penilai
    function isi_data_penilai(data) {
        for (var i=0; i<data.length; i++) {
            nik = data[i].NIK;
            nama = data[i].NAMA.toUpperCase();
            bagian = data[i].BAGIAN;
            jabatan = data[i].JABATAN;
            kategori = data[i].KATEGORI;
            id_penilai = data[i].ID_PENILAI;

            $('#tabel_penilai').append('<tr><td align="center">' + (i+1) + '</td><td align="center">' + nik + '</td><td>' + nama + '</td><td>' + jabatan + '</td><td>' + bagian + '</td><td>' + kategori + '</td><td><button type="button" class="btn btn-block btn-info btn-sm" title="Info Penilai" onclick="get_outstanding(this)" data-toggle="modal" data-target="#modal-outstanding"><b><i class="fa fa-chain-broken"></i></button></td><td hidden>' + id_penilai + '</td></tr>')
        }
    }

// Ambil Detail Auto Nilai
    function get_outstanding(btn) {
        var row = $(btn).closest("tr").index() + 1;
        var id_penilai = tabel_penilai.rows[row].cells[7].innerHTML;
        var nama_penilai = tabel_penilai.rows[row].cells[2].innerHTML;
        var kategori_penilai = tabel_penilai.rows[row].cells[5].innerHTML;
        var periode_outstanding = $('#tPeriode').val();

        document.getElementById('nama_outstanding_nilai').innerHTML = 'Outstanding Nilai <u>' + ' ' + nama_penilai + '</u> Periode <u>' + periode_outstanding + '</u>';

        $('#tabel_outstanding').DataTable().destroy();
        $("#tabel_outstanding tbody").find("tr").remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/sistem/ploting/detail_outstanding',
            data: {
                data: [id_penilai, kategori_penilai, periode_outstanding]
            },
            success: function(data) {
                data = JSON.parse(data);
                isi_detail_outstanding(data,kategori_penilai);

                setTimeout(function() {
                    $('#btnOk').click();
                    pagination_outstanding();
                }, 500);
            }
        });

        $('#btn_outstanding').click();
    }

// Isi Data Penilai
    function isi_detail_outstanding(data,kategori_penilai) {
        for (var i = 0; i < data.length; i++) {
            urut = i + 1;
            nama = data[i].NAMA;
            bagian = data[i].BAGIAN;
            jabatan = data[i].JABATAN;

            $('#tabel_outstanding').append('<tr><td align="center">' + urut + '</td><td>' + nama + '</td><td>' + bagian + '</td><td>' + jabatan + '</td><td>' + kategori_penilai + '</td></tr>')
        }
    }

// Pagination Detail Auto Nilai
    function pagination_outstanding() {
        $('#tabel_outstanding').DataTable().destroy();

        var qty_data = $('#tabel_outstanding tr').length;

        if (qty_data == 1) {
            height = "100px";
        } else if (qty_data > 5) {
            height = "400px";
        } else {
            height = ((qty_data - 1) * 100) + "px";
        }

        tabel_outstanding = $('#tabel_outstanding').DataTable({
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
            tabel_outstanding.columns.adjust().draw();
        }, 500);
    }
</script>