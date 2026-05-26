
<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div id="headerinput">Master Flow Proses</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="50%">
                    <tr>
                        <th width="30%">Kode Proses</th>
                        <td width="70%">
                            <input type="text" class="form-control" id="kode" style="width: 30%;" maxlength="3" tabindex="1">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="proses">
                <button type="button" class="btn btn-block btn-success" id="addProses" style="width:15%; margin-bottom: 10px;">+ Add</button>
                <table id="tabel_proses" class="table table-bordered" width="70%">
                    <thead style="background-color: #0EB147; font-weight: bold; color: #FFFFFF;">
                        <tr style="text-align: center;">
                            <td width="10%">No</td>
                            <td width="30%">Nama Proses</td>
                            <td width="10%">Urut Proses</td>
                            <td hidden></td>
                            <td hidden>Id Station</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()">Simpan</button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()">Batal</button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-warning" data-toggle="modal" data-target="#modal_tambah">+ New Station</button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Flow Proses</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <table style="width: 20%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="35%" class="filter">Kode Proses</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari kode proses.." style="width: 100%;" autocomplete="off"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('rnd/v_flow_table'); ?>
                        </font>
                    </div>
                </div>
            </div>
            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
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

        <!-- Modal Tambah Station -->
        <div class="modal fade" id="modal_tambah">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <b><font color="White">Master Data Station</font></b>
                                </h3>
                            </div>
                            <div class="card-body">
                                <table width="100%">
                                    <tr>
                                        <th width="30%">Nama Station</th>
                                        <td width="70%">
                                            <input type="text" class="form-control" id="nama_station" style="width: 50%;" maxlength="30">
                                        </td>
                                    </tr>
                                </table>                                
                            </div>
                            <div class="modal-footer">
                                <button style="width: 50%;" type="button" id="simpan_station" class="btn btn-info">Simpan</button>
                                <button style="width: 50%;" type="button" id="keluar_station" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                            </div>
                            <div class="card-body">
                                <div class="data-table">
                                    <table id="data_station" class="table table-bordered table-striped" width="100%">
                                        <thead>
                                            <tr align="center">
                                                <th hidden>ID Station</th>
                                                <th width="25%">No.</th>
                                                <th width="75%">Nama Station</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $urut = 0;
                                            foreach ($station->result_array() as $dt):
                                                $id=$dt['ID'];
                                                $urut++;
                                                $nama=$dt['NAMA'];
                                                ?>
                                                <tr>
                                                    <td hidden><?php echo $id; ?></td>
                                                    <td align="center"><?php echo $urut; ?></td>
                                                    <td><?php echo $nama; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var tabel_proses = document.getElementById('tabel_proses');
var arr_id_proses = [];
var tabel;

// Document Load
$(document).ready(function() {
    $(".select").select2(); // Combo Live Search
    pagination();
    pagination_station();

    $('#tabel_proses').width('50%');
    $('#kode').focus();
});

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    tabel = $('#data-table').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": false,
        "order": [[ 1, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Pagination Station
function pagination_station() {
    $('#data_station').DataTable().destroy();
    $('#data_station').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "oLanguage": {
            "sSearch": "Cari Nama Station  :"},
        "order": [[ 1, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Tambah Station Baru
$('#simpan_station').on('click', function() {
    var nama_station = $('#nama_station').val();

    if (nama_station == '') {return;}

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/flow/simpan_station',
        data: {data: nama_station},
        success: function(data) {
            $('#keluar_station').click();
            $('#btnSukses').click();

            setTimeout(function() {
                location.reload();
            },1000);
        }
    });
});

// Tambah Proses
$('#addProses').on('click', function() {
    $('#tabel_proses').append(
        '<tr>' +
        '<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
        '<td><select class="form-control select" style="width: 100%;" name="proses" onchange="isi_id_station(this)">' +
        '<option value="">Pilih Proses..</option>' +
        '<?php foreach ($proses->result_array() as $dt): ?>' +
        '<option><?php echo $dt['NAMA']; ?></option>' +
        arr_id_proses.push(<?php echo json_encode($dt['ID']); ?>) +
        '<?php endforeach; ?>' +
        '</select></td>' +
        '<td><select class="form-control select" style="width: 100%;" name="urut">' +
        '<option value="">Pilih Urut..</option>' +
        '<option>1</option>' +
        '<option>2</option>' +
        '<option>3</option>' +
        '<option>4</option>' +
        '<option>5</option>' +
        '<option>6</option>' +
        '<option>7</option>' +
        '<option>8</option>' +
        '<option>9</option>' +
        '<option>10</option>' +
        '<option>11</option>' +
        '<option>12</option>' +
        '</select></td>' +
        '<td width="5%"><button type="button" class="btn btn-block btn-danger" title="Hapus Proses" onclick="hapus_station(this)" style="margin-top: 0;">x</button></td>' +
        '<td hidden></td>' +
        '</tr>')
    $(".select").select2();
    urut_station();
});

// Isi ID Station
function isi_id_station(btn) {
    var row = $(btn).closest("tr").index();
    var index = btn.selectedIndex - 1;
    var id_proses = arr_id_proses[index];

    tabel_proses.rows[row].cells[4].innerHTML = id_proses;
}

// Hapus Station
function hapus_station(btn) {
    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    urut_station();
};

// Isi Nomor Station
function urut_station() {
    for (var i=0; i<tabel_proses.rows.length-1; i++) {
        document.getElementsByName('nmr')[i].value = i+1;
    }
}

// Kosong Isian
function kosong() {
    $('#kode').val('');
    $("#tabel_proses").find("tr:gt(0)").remove();
    $('#kode').focus();
}

// Simpan Data
function simpan() {
    var kode = $('#kode').val();
    var id_station = [], urut = [];

    // Cek Duplicate Kode
    var qty_data = tabel.rows().data().length;
    for (var i=0; i<qty_data; i++) {
        if (tabel.rows(i).data()[0][2] == kode) {
            return;           
        }
    }

    // Cek isian
    if (kode == '' || tabel_proses.rows.length == 1) {return;}

    for (var i=0; i<tabel_proses.rows.length-1; i++) {
        if (document.getElementsByName('proses')[i].value == '') {return;}
        if (document.getElementsByName('urut')[i].value == '') {return;}
        if (tabel_proses.rows[i+1].cells[4].innerHTML == '') {return;}

        urut.push(document.getElementsByName('urut')[i].value);
        id_station.push(tabel_proses.rows[i+1].cells[4].innerHTML);
    }

    var data = [kode, id_station, urut];

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/flow/simpan_flow',
        data: {data: data},
        success: function(data) {
            $('#btnSukses').click();
            kosong();
            filter();
        }
    });
}

// Filter Data
function filter() {
    var cari = document.getElementById("cari").value;

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/flow/filter_flow',
        data: {data: cari},
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}


</script>