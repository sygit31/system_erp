
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
					<b><font color="White"><div id="headerinput">Master Setting Proses</div></font></b>
				</h3>
				<div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="20%">Nama Produk</th>
                        <td width="40%">
                            <select class="select" id="produk" style="width: 70%; cursor: pointer;">
                                <option value="">Pilih Produk..</option>
                                <?php $id_produk = array(); ?>
                                <?php foreach ($produk->result_array() as $dt): ?>
                                    <option><?php echo $dt['NAMA']; ?></option>
                                    <?php array_push($id_produk, $dt['ID']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <th width="15%">Kode Flow</th>
                        <td width="25%">
                            <select class="select" id="kode" style="width: 70%; cursor: pointer;">
                                <option value="">Pilih Flow..</option>
                                <?php foreach ($flow->result_array() as $dt): ?>
                                    <option><?php echo $dt['KODE']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Tahun</th>
                        <td>
                            <?php $years = range(2030, 2019); ?>
                            <?php $tahun = date("Y"); ?>
                            <select class="select" id="tahun" style="width: 30%;">
                                <option value="">Tahun..</option>
                                <?php foreach ($years as $dt) { ?>
                                    <option <?php if ($dt == $tahun) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td>
                            <button type="button" class="btn btn-block btn-info" id="btnMesin">Mesin</button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-block btn-default" id="btnBom">Material</button>
                        </td>
                        <td>
                    </tr>
                </table>             
            </div>
            <div class="card-footer" id="mesin">
                <button type="button" class="btn btn-block btn-success" id="addMesin" style="width:15%; margin-bottom: 10px;">+ Add</button>
                <table id="tabel_mesin" class="table table-bordered" width="100%">
                    <thead style="background-color: #0EB147; font-weight: bold; color: #FFFFFF;">
                        <tr style="text-align: center;">
                            <td width="5%">No.</td>
                            <td width="5%">Kode Mesin</td>
                            <td width="15%">Proses</td>
                            <td width="25%">Nama</td>
                            <td width="12.5%">Speed</td>
                            <td width="12.5%">Persiapan</td>
                            <td width="12.5%">Suhu</td>
                            <td width="12.5%">Tekanan</td>
                            <td hidden></td>
                            <td hidden>Id Mesin</td>
                            <td hidden>Id Proses Mesin</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card-footer" id="bom" style="display: none;">
                <button type="button" class="btn btn-block btn-warning" id="addBom" style="width:15%; margin-bottom: 10px;">+ Add</button>
                <table id="tabel_material" class="table table-bordered" width="100%">
                    <thead style="background-color: #ECC929; font-weight: bold;">
                        <tr style="text-align: center;">
                            <td width="10%">No.</td>
                            <td width="10%">Kode Bahan</td>
                            <td width="20%">Proses</td>
                            <td width="30%">Nama</td>
                            <td width="15%">Qty</td>
                            <td width="15%">Satuan</td>
                            <td hidden></td>
                            <td hidden>Id Produk</td>
                            <td hidden>Id Rnd BOM</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="card card-footer" style="margin: 20px;">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()">Simpan</button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()">Batal</button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Setting Proses</font></b>
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
                            <table style="width: 50%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="35%" class="filter">Desain</td>
                                        <td></td>
                                        <td width="65%" class="filter">Nama Produk</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fDesain" onchange="filter()" style="width: 100%;">
                                                <option>All</option>
                                                <option>2019</option>
                                                <option>2020</option>
                                                <option>2021</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama produk.." style="width: 100%;" autocomplete="off"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('rnd/v_proses_table'); ?>
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
                        <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" hidden></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Preview -->
        <div class="modal fade" id="modal-preview" style="z-index: 9999;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"><div class="card-header" style="background-color: #0A86BF;">
                    <h3 class="card-title">
                        <b><font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;"><p id="judul">More Information</p></font></b>
                    </h3>
                    <div class="card-tools">
                        <button id="btnClose" type="button" class="close" title="Close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td>
                                <button type="button" class="btn btn-block btn-info tab">Mesin</button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-block btn-default tab">Material</button>
                            </td>
                        </tr>
                    </table>             
                </div>
                <div class="modal-body">
                    <div class="tab1">
                        <table id="preview_mesin" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%" style="text-align: center;">No</th>
                                    <th width="15%" style="text-align: center;">Proses</th>
                                    <th width="30%" style="text-align: center;">Nama Mesin</th>
                                    <th width="15%" style="text-align: center;">Speed</th>
                                    <th width="10%" style="text-align: center;">Persiapan</th>
                                    <th width="10%" style="text-align: center;">Suhu</th>
                                    <th width="10%" style="text-align: center;">Tekanan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="tab2" style="display: none;">
                        <table id="preview_material" class="table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="10%" style="text-align: center;">No</th>
                                    <th width="20%" style="text-align: center;">Proses</th>
                                    <th width="40%" style="text-align: center;">Nama Material</th>
                                    <th width="15%" style="text-align: center;">Qty</th>
                                    <th width="15%" style="text-align: center;">Satuan</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button style="width: 30%;" class="btn btn-success" data-dismiss="modal" onclick="edit()">Edit</button>
                        <button style="width: 30%;" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
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
var tabel_mesin = document.getElementById('tabel_mesin');
var tabel_material = document.getElementById('tabel_material');

var id_produk = '', id_edit_proses = '', nama_edit = '', tahun_edit = '', kode_edit = '';

var preview_mesin = document.getElementById('preview_mesin');
var preview_material = document.getElementById('preview_material');

var nama_station = [], arr_id_station = [], arr_urut = [];

var arr_id_mesin = [], arr_kode_mesin = [], arr_id_material = [], arr_kode_material = [], arr_satuan_material = [];

var cur_mesin = [], cur_material = [];

// Document Load
$(document).ready(function() {
    $(".select").select2(); // Combo Live Search
    pagination();
});

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    $('#data-table').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": false,
        "order": [[ 1, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Pagination
function pagination_mesin() {
    $('#preview_mesin').DataTable().destroy();
    $('#preview_mesin').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "oLanguage": {
            "sSearch": "Cari Nama Mesin  :"},
        "order": [[ 0, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Pagination
function pagination_material() {
    $('#preview_material').DataTable().destroy();
    $('#preview_material').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "oLanguage": {
            "sSearch": "Cari Nama Material  :"},
        "order": [[ 0, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Isi ID Produk
$('#produk').on('change', function() {
    var index = document.getElementById('produk').selectedIndex;
    if (index == 0) {id_produk = ''; return;}

    var dt_id_produk = <?php echo json_encode($id_produk); ?>;
    id_produk = dt_id_produk[index-1];
});

// Isi station sesuai flow kode
$('#kode').on('change', function() {
    var kode = $('#kode').val();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/ambil_station',
        data: {data: kode},
        success: function(data) {
            var data = JSON.parse(data);
            data.forEach(function(e) {
                nama_station.push(e['NAMA']);
                arr_id_station.push(e['ID_STATION_FLOW']);
            });
        }
    });
});

// Kosong Isian
function kosong() {
    var tahun = new Date().getFullYear();

    $('#produk').val('').change();
    $('#tahun').val(tahun).change();
    $('#kode').val('').change();
    $("#tabel_mesin").find("tr:gt(0)").remove();
    $("#tabel_material").find("tr:gt(0)").remove();
    $('#btnMesin').click();

    id_produk = '', id_edit_proses = '', nama_edit = '', tahun_edit = '', kode_edit = '';
    cur_mesin = [], cur_material = [];
}

// Cek input angka
function cek_numeric(num) {    
    num.value = num.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g);
}

// Tab Selection
$('#btnMesin').on('click', function() {
    $('#mesin').attr("style","display:block");
    $('#bom').attr("style","display:none");

    $('#btnMesin').attr('class','btn btn-block btn-info');
    $('#btnBom').attr('class','btn btn-block btn-default');
});
$('#btnBom').on('click', function() {
    $('#mesin').attr("style","display:none");
    $('#bom').attr("style","display:block");

    $('#btnMesin').attr('class','btn btn-block btn-default');
    $('#btnBom').attr('class','btn btn-block btn-info');
});

// Tambah Mesin
$('#addMesin').on('click', function() {
    if ($('#kode').val()==''){return;}
    $('#tabel_mesin').append(
        '<tr>' +
        '<td><input type="text" class="form-control" name="nmr_mesin" style="width: 100%; text-align:center;" readonly></td>' +
        '<td><input type="text" class="form-control" name="kode_mesin" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><select class="form-control select" style="width: 100%;" name="proses_ms" onchange="id_station_mesin(this)">' +
        '<option value="">Pilih Proses..</option> ' +
        '</select></td>' +
        '<td><select class="form-control select" style="width: 100%;" name="nama_mesin" onchange="isi_kode_mesin(this)">' +
        '<option value="">Pilih Mesin..</option> ' +
        '<?php foreach ($mesin->result_array() as $dt): ?>' +
        '<option><?php echo $dt['NAMA_MESIN']; ?></option>' +
        arr_id_mesin.push(<?php echo json_encode($dt['ID']); ?>) +
        arr_kode_mesin.push(<?php echo json_encode($dt['NOMOR']); ?>) +
        '<?php endforeach; ?>' +
        '</select></td>' +
        '<td><input type="text" class="form-control" name="speed" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
        '<td><input type="text" class="form-control" name="naik" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
        '<td><input type="text" class="form-control" name="suhu" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
        '<td><input type="text" class="form-control" name="tekanan" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_mesin(this)" style="margin-top: 0;">X</button></td>' +
        '<td hidden></td>' +
        '<td hidden></td>' +
        '<td hidden></td>' +
        '</tr>')
    $(".select").select2();

    // Tambah option proses
    var rows = tabel_mesin.rows.length - 2;
    nama_station.forEach(function(e) {
        option = document.createElement("option");
        option.text = e;
        document.getElementsByName("proses_ms")[rows].add(option);
    });

    urut_mesin();
});

// Isi Nomor Urut
function urut_mesin() {
    for (var i=0; i<tabel_mesin.rows.length-1; i++) {
        document.getElementsByName('nmr_mesin')[i].value = i+1;
    }   
}

// Isi Station
function id_station_mesin(btn) {
    var row = $(btn).closest("tr").index();
    var index = btn.selectedIndex - 1;
    var id_station = arr_id_station[index];

    tabel_mesin.rows[row].cells[11].innerHTML = id_station; 
}

// Isi Kode Mesin
function isi_kode_mesin(btn) {
    var row = $(btn).closest("tr").index();
    var index = btn.selectedIndex - 1;
    var id_mesin = arr_id_mesin[index];
    var kode_mesin = arr_kode_mesin[index];

    document.getElementsByName('kode_mesin')[row-1].value = kode_mesin;
    tabel_mesin.rows[row].cells[9].innerHTML = id_mesin;
}

// Hapus List Mesin
function hapus_mesin(btn) {
    row = $(btn).closest("tr").index();
    if (tabel_mesin.rows[row].cells[10].innerHTML != '') {
        row = $(btn).closest("tr").index();
        cur_mesin.push(tabel_mesin.rows[row].cells[10].innerHTML);
    }

    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    urut_mesin();
};

// Tambah Produk
$('#addBom').on('click', function() {
    if ($('#kode').val()==''){return;}
    $('#tabel_material').append(
        '<tr>' +
        '<td><input type="text" class="form-control" name="nmr_material" style="width: 100%; text-align:center;" readonly></td>' +
        '<td><input type="text" class="form-control" name="kode_material" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><select class="form-control select" style="width: 100%;" name="proses_m" onchange="id_station_material(this)">' +
        '<option value="">Pilih Proses..</option>' +
        '</select></td>' +
        '<td><select class="form-control select" style="width: 100%;" name="nama_material" onchange="isi_kode_material(this)">' +
        '<option value="">Pilih Material..</option> ' +
        '<?php foreach ($material->result_array() as $dt): ?>' +
        '<option><?php echo $dt['NAMA']; ?></option>' +
        arr_id_material.push(<?php echo json_encode($dt['ID']); ?>) +
        arr_kode_material.push(<?php echo json_encode($dt['KODE']); ?>) +
        arr_satuan_material.push(<?php echo json_encode($dt['SATUAN']); ?>) +
        '<?php endforeach; ?>' +
        '</select></td>' +
        '<td><input type="text" class="form-control" name="qty" style="width: 100%;" autocomplete="off" maxlength="12" oninput="cek_numeric(this)"></td>' +
        '<td><input type="text" class="form-control" name="satuan" style="width: 100%; text-align: center;" readonly></td>' +
        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_material(this)" style="margin-top: 0;">X</button></td>' +
        '<td hidden></td>' +
        '<td hidden></td>' +
        '<td hidden></td>' +
        '</tr>')
    $(".select").select2();

    // Tambah option proses
    var rows = tabel_material.rows.length - 2;
    nama_station.forEach(function(e) {
        option = document.createElement("option");
        option.text = e;
        document.getElementsByName("proses_m")[rows].add(option);
    });

    urut_material();
});

// Isi Nomor Urut
function urut_material() {
    for (var i=0; i<tabel_material.rows.length-1; i++) {
        document.getElementsByName('nmr_material')[i].value = i+1;
    }
}

// Isi Station
function id_station_material(btn) {
    var row = $(btn).closest("tr").index();
    var index = btn.selectedIndex - 1;
    var id_station = arr_id_station[index];

    tabel_material.rows[row].cells[9].innerHTML = id_station; 
}

// Isi Kode Material
function isi_kode_material(btn) {
    var row = $(btn).closest("tr").index();
    var index = btn.selectedIndex - 1;
    var id_material = arr_id_material[index];
    var kode_material = arr_kode_material[index];
    var satuan_material = arr_satuan_material[index];

    document.getElementsByName('kode_material')[row-1].value = kode_material;
    document.getElementsByName('satuan')[row-1].value = satuan_material;
    tabel_material.rows[row].cells[7].innerHTML = id_material;
}

// Hapus List Material
function hapus_material(btn) {
    row = $(btn).closest("tr").index();
    if (tabel_material.rows[row].cells[8].innerHTML != '') {
        row = $(btn).closest("tr").index();
        cur_material.push(tabel_material.rows[row].cells[8].innerHTML);
    }
    
    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    urut_material();
}

// Simpan Data
function simpan() {
    var desain = document.getElementById("tahun").value;
    var kode = document.getElementById("kode").value;

    var id_station_ms = [], id_mesin = [], speed = [], naik = [], suhu = [], tekanan = [], id_edit_mesin = [];
    var id_station_m = [], id_material = [], qty = [], id_edit_bom = [];    
    if (id_produk == '' || desain == '' || kode == '' || tabel_mesin.rows.length == 1 || tabel_material.rows.length == 1) {return;}

    // Array R&D Mesin
    for (var i=0; i<tabel_mesin.rows.length-1; i++) {
        if (document.getElementsByName('proses_ms')[i].value == '') {return;}
        if (document.getElementsByName('nama_mesin')[i].value == '') {return;}
        if (document.getElementsByName('speed')[i].value == '') {return;}
        if (document.getElementsByName('naik')[i].value == '') {return;}
        if (document.getElementsByName('suhu')[i].value == '') {return;}
        if (document.getElementsByName('tekanan')[i].value == '') {return;}

        id_station_ms.push(tabel_mesin.rows[i+1].cells[11].innerHTML);
        id_mesin.push(tabel_mesin.rows[i+1].cells[9].innerHTML);
        speed.push(document.getElementsByName('speed')[i].value);
        naik.push(document.getElementsByName('naik')[i].value);
        suhu.push(document.getElementsByName('suhu')[i].value);
        tekanan.push(document.getElementsByName('tekanan')[i].value);
        id_edit_mesin.push(tabel_mesin.rows[i+1].cells[10].innerHTML);
    }

    // Array R&D BOM
    for (var i=0; i<tabel_material.rows.length-1; i++) {
        if (document.getElementsByName('proses_m')[i].value == '') {return;}
        if (document.getElementsByName('nama_material')[i].value == '') {return;}
        if (document.getElementsByName('qty')[i].value == '') {return;}

        id_station_m.push(tabel_material.rows[i+1].cells[9].innerHTML);
        id_material.push(tabel_material.rows[i+1].cells[7].innerHTML);
        qty.push(document.getElementsByName('qty')[i].value);
        id_edit_bom.push(tabel_material.rows[i+1].cells[8].innerHTML);
    }

    var data = [id_edit_proses, id_produk, kode, desain, id_station_ms, id_mesin, speed, naik, suhu, tekanan, id_edit_mesin, id_station_m, id_material, qty, id_edit_bom, cur_mesin, cur_material];

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/simpan_proses',
        data: {data: data},
        success: function(data) {
            kosong();
            filter();
            $('#btnSukses').click();
            setTimeout(function() {$('#btnOk').click();},1500);  
        }
    });
}

// Filter Data
function filter() {
    var desain = document.getElementById("fDesain").value;
    var cari = document.getElementById("cari").value;
    var data = [desain, cari];

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/filter_proses',
        data: {data: data},
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

// Preview Mesin dan BOM
function preview(btn) {
    var data_table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_preview = data_table.rows[row].cells[0].innerHTML;
    var desain = data_table.rows[row].cells[3].innerHTML;
    var nama = data_table.rows[row].cells[4].innerHTML;

    id_edit_proses = id_preview;
    nama_edit = nama;
    tahun_edit = desain;
    kode_edit = data_table.rows[row].cells[2].innerHTML;

    $('#preview_mesin').DataTable().destroy();
    $("#preview_mesin").find("tr:gt(0)").remove();

    $('#preview_material').DataTable().destroy();
    $("#preview_material").find("tr:gt(0)").remove();

    $('#judul').html('Informasi Produk ' + nama + ' ' + desain);
    $('#modal_preview').click();
    $('.tab')[0].click();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/preview_mesin',
        data: {data: id_preview},
        success: function(data) {
            var data = JSON.parse(data);
            show_mesin(data);
            pagination_mesin();
        }
    });

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/preview_material',
        data: {data: id_preview},
        success: function(data) {
            var data = JSON.parse(data);
            show_material(data);
            pagination_material();
        }
    });

    function show_mesin(data) {
        for (var i=0; i<data.length; i++) {
            $('#preview_mesin').append(
                '<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>')
        }

        for (var i=0; i<data.length; i++) {
            preview_mesin.rows[i+1].cells[0].innerHTML = i+1;
            preview_mesin.rows[i+1].cells[1].innerHTML = data[i]['NAMA'];
            preview_mesin.rows[i+1].cells[2].innerHTML = data[i]['NAMA_MESIN'];
            preview_mesin.rows[i+1].cells[3].innerHTML = data[i]['SPEED'];
            preview_mesin.rows[i+1].cells[4].innerHTML = data[i]['NAIK'];
            preview_mesin.rows[i+1].cells[5].innerHTML = data[i]['SUHU'];
            preview_mesin.rows[i+1].cells[6].innerHTML = data[i]['TEKANAN'];
        }
    }

    function show_material(data) {
        for (var i=0; i<data.length; i++) {
            $('#preview_material').append(
                '<tr><td></td><td></td><td></td><td></td><td></td></tr>')
        }

        for (var i=0; i<data.length; i++) {
            preview_material.rows[i+1].cells[0].innerHTML = i+1;
            preview_material.rows[i+1].cells[1].innerHTML = data[i]['NAMA'];
            preview_material.rows[i+1].cells[2].innerHTML = data[i]['NAMA_MATERIAL'];
            preview_material.rows[i+1].cells[3].innerHTML = data[i]['QTY'];
            preview_material.rows[i+1].cells[4].innerHTML = data[i]['SATUAN'];
        }
    }
}

// Tab Selection
$('.tab').on('click', function(e) {
    $('.tab').removeClass("btn-info");
    e.target.classList.remove("btn-default");
    e.target.classList.add("btn-info");

    var tab = e.target.innerHTML;
    switch(tab) {
        case "Mesin":
            $('.tab1').css('display','block');
            $('.tab2').css('display','none');
        break;
        case "Material":
            $('.tab1').css('display','none');
            $('.tab2').css('display','block');
        break;
    }
});

// Edit Data
function edit() {
    $('#produk').val(nama_edit).change();
    $('#kode').val(kode_edit).change();
    $('#tahun').val(tahun_edit).change();
    $("#tabel_mesin").find("tr:gt(0)").remove();
    $("#tabel_material").find("tr:gt(0)").remove();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/preview_mesin',
        data: {data: id_edit_proses},
        success: function(data) {
            var data = JSON.parse(data);
            isi_tabel_mesin(data);
        }
    });

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/proses/preview_material',
        data: {data: id_edit_proses},
        success: function(data) {
            var data = JSON.parse(data);
            isi_tabel_bom(data);
        }
    });
}

// Isi Tabel Mesin
function isi_tabel_mesin(data) {
    for (var i=0; i<data.length; i++) {
        kode_mesin = data[i]['NOMOR'];
        nama = data[i]['NAMA_MESIN'];
        proses = data[i]['NAMA'];
        speed = data[i]['SPEED'];
        naik = data[i]['NAIK'];
        suhu = data[i]['SUHU'];
        tekanan = data[i]['TEKANAN'];
        id_mesin= data[i]['ID_MESIN'];
        id_edit_mesin = data[i]['ID_RND_MESIN'];
        id_station = data[i]['ID_STATION_FLOW'];

        $('#tabel_mesin').append(
            '<tr>' +
            '<td><input type="text" class="form-control" name="nmr_mesin" value="' + (i+1) + '" style="width: 100%; text-align:center;" readonly></td>' +
            '<td><input type="text" class="form-control" name="kode_mesin" value="' + kode_mesin + '" style="width: 100%; text-align: center;" readonly></td>' +
            '<td><select class="form-control select" style="width: 100%;" name="proses_ms" onchange="id_station_mesin(this)">' +
            '<option value="">Pilih Proses..</option> ' +
            '</select></td>' +
            '<td><select class="form-control select" style="width: 100%;" name="nama_mesin" onchange="isi_kode_mesin(this)">>' +
            '<option value="">Pilih Mesin..</option> ' +
            '<?php foreach ($mesin->result_array() as $dt): ?>' +
            '<option><?php echo $dt['NAMA_MESIN']; ?></option>' +
            arr_id_mesin.push(<?php echo json_encode($dt['ID']); ?>) +
            arr_kode_mesin.push(<?php echo json_encode($dt['NOMOR']); ?>) +
            '<?php endforeach; ?>' +
            '</select></td>' +
            '<td><input type="text" class="form-control" name="speed" value="' + speed + '" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
            '<td><input type="text" class="form-control" name="naik" value="' + naik + '" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
            '<td><input type="text" class="form-control" name="suhu" value="' + suhu + '" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
            '<td><input type="text" class="form-control" name="tekanan" value="' + tekanan + '" style="width: 100%;" autocomplete="off" maxlength="15"></td>' +
            '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_mesin(this)" style="margin-top: 0;">X</button></td>' +
            '<td hidden>' + id_mesin + '</td>' +
            '<td hidden>' + id_edit_mesin + '</td>' +
            '<td hidden></td>' +
            '</tr>')

        // Tambah option proses
        nama_station.forEach(function(e) {
            option = document.createElement("option");
            option.text = e;
            document.getElementsByName("proses_ms")[i].add(option);
        });

        document.getElementsByName('nama_mesin')[i].value = nama;
        document.getElementsByName('proses_ms')[i].value = proses;
        tabel_mesin.rows[i+1].cells[11].innerHTML = id_station;
    }

    $(".select").select2();
}

// Isi Tabel Material
function isi_tabel_bom(data) {
    for (var i=0; i<data.length; i++) {
        kode_material = data[i]['KODE_MATERIAL'];
        nama_material = data[i]['NAMA_MATERIAL'];
        proses_m = data[i]['PROSES_M'];
        qty = data[i]['QTY'];
        satuan = data[i]['SATUAN'];
        id_edit_bom = data[i]['ID_RND_BOM'];
        id_material = data[i]['ID_MATERIAL'];
        id_station = data[i]['ID_STATION_FLOW'];

        $('#tabel_material').append(
            '<tr>' +
            '<td><input type="text" class="form-control" name="nmr_material" value="' + (i+1) + '" style="width: 100%; text-align:center;" readonly></td>' +
            '<td><input type="text" class="form-control" name="kode_material" value="' + kode_material + '" style="width: 100%; text-align: center;" readonly></td>' +
            '<td><select class="form-control select" style="width: 100%;" name="proses_m" onchange="id_station_material(this)">' +
            '<option value="">Pilih Proses..</option>' +
            '</select></td>' +
            '<td><select class="form-control select" style="width: 100%;" name="nama_material" onchange="isi_kode_material(this)">' +
            '<option value="">Pilih Material..</option> ' +
            '<?php foreach ($material->result_array() as $dt): ?>' +
            '<option><?php echo $dt['NAMA']; ?></option>' +
            arr_id_material.push(<?php echo json_encode($dt['ID']); ?>) +
            arr_kode_material.push(<?php echo json_encode($dt['KODE']); ?>) +
            arr_satuan_material.push(<?php echo json_encode($dt['SATUAN']); ?>) +
            '<?php endforeach; ?>' +
            '</select></td>' +
            '<td><input type="text" class="form-control" name="qty" value="' + qty + '" style="width: 100%;" autocomplete="off" maxlength="12" oninput="cek_numeric(this)"></td>' +
            '<td><input type="text" class="form-control" name="satuan" value="' + satuan + '" style="width: 100%; text-align: center;" readonly></td>' +
            '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_material(this)" style="margin-top: 0;">X</button></td>' +
            '<td hidden>' + id_material + '</td>' +
            '<td hidden>' + id_edit_bom + '</td>' +
            '<td hidden></td>' +
            '</tr>')

        // Tambah option proses
        nama_station.forEach(function(e) {
            option = document.createElement("option");
            option.text = e;
            document.getElementsByName("proses_m")[i].add(option);
        });

        document.getElementsByName('nama_material')[i].value = nama_material;
        document.getElementsByName('proses_m')[i].value = proses_m;
        tabel_material.rows[i+1].cells[9].innerHTML = id_station;
    }

    $(".select").select2();
}

</script>