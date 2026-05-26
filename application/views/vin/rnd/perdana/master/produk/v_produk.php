

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<style>
    .ion-arrow-up-a:hover{
        color: #EA6212;
    }
    .ion-arrow-down-a:hover{
        color: #EA6212;
    }
</style>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div id="headerinput">Input Data Menu Program</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table width="50%">
                      <tr>
                        <th width="30%">Judul Modul</th>
                        <td width="10%">:</td>
                        <td width="60%"><input type="text" class="form-control" id="judul" autocomplete="off" style="width: 100%;" tabindex="1"></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-warning" onclick="tambah_menu()"><i class="fa fa-plus-square m-2"></i><b>Menu</b></button>
                        </td>
                        <td width="10"></td>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-primary" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                        </td>
                        <td width="10"></td>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <table id="tabel_menu" class="table table-bordered">
                    <thead style="background-color: #06D288; color: #FFFFFF; font-weight: bold;">
                        <tr style="text-align: center;">
                            <td width="35%">Kode Menu</td>
                            <td width="50%">Nama Menu</td>
                            <td width="15%">Level Menu</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Menu Program</font></b>
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
                            <table style="width: 70%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="30%" class="filter">Level Menu</td>
                                        <td></td>
                                        <td width="70%" class="filter">Judul Modul</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fLevel" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari Modul.." style="width: 100%;" autocomplete="off">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('administrator/v_menu_table'); ?>

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

        <!-- Modal Confirm Hapus -->
        <div class="modal fade" id="modal_hapus">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
                    <div class="modal-footer">
                        <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                        <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">YES</button>
                        <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Hak Akses -->
        <div class="modal fade" id="modal_akses">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Setting Hak Akses </div>
                    <div class="modal-body">
                        <?php $this->load->view('administrator/v_menu_akses'); ?>
                    </div>
                    <div class="modal-footer">
                        <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                        <button id="btnAkun" data-toggle="modal" data-target="#modal_akses" hidden></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Error Isian -->
        <div class="modal fade" id="modal_isian">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
                    <div class="modal-footer">
                        <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
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
                        <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        <button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
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
var tabel_menu =  document.getElementById('tabel_menu');
var id_edit = '', id_hapus = [];

// Load Dokumen
$(document).ready(function() {
    $(".select").select2(); // Combo Live Search
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
    pagination();
    $('#judul').focus();
    $('#tabel_menu').width('80%');
}); 

// Pagination
function pagination() {
    var qty_data = $('#data-table tr').length;

    if (qty_data == 1) {
        height = "100px";
    }else if (qty_data > 5) {
        height = "400px";
    }else{
        height = ((qty_data-1) * 100) + "px";
    }
    
    $('#data-table').DataTable().destroy();
    var data_table = $('#data-table').DataTable( {
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": height,
        "columnDefs": [{"orderable": false,"targets": "_all"}],
        "order": []
    });

    setTimeout(function() {data_table.columns.adjust().draw();}, 100);
}

//Tambah PIC
function tambah_menu() {
    $('#tabel_menu').append(
        '<tr>' +
        '<td><input type="text" class="form-control" autocomplete="off" name="kode" style="width: 95%;"></td>' +
        '<td><input type="text" class="form-control" autocomplete="off" name="nama" style="width: 95%;"></td>' +
        '<td><select class="select" name="level" style="width: 95%;">' +
        '<option>Level..</option> ' +
        '<option>1</option>' +
        '<option>2</option>' +
        '<option>3</option>' +
        '</select></td>' +
        '<td><i class="ion-arrow-up-a up" onclick="move(this)" title="Menu Naik" style="cursor: pointer;"></i><i class="ion-arrow-down-a down" onclick="move(this)" title="Menu Turun" style="cursor: pointer;"></i></td>' +
        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus menu" onclick="hapus_menu(this)" style="margin-top: 0; text-align: center;"><i class="fa ion-trash-a"></i></button></td>' +
        '<td hidden></td>' +
        '</tr>')
    $(".select").select2();
}

// Hapus menu
function hapus_menu(btn) {
    var row = $(btn).closest("tr").index() + 1;
    id_menu_detail = tabel_menu.rows[row].cells[5].innerHTML;
    id_hapus.push(id_menu_detail);

    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

// Move Row
function move(btn) {
    row = $(btn).closest("tr");
    if ($(btn).hasClass('up'))
        row.prev().before(row);
    else
        row.next().after(row);
}

// Kosongkan isian
function kosong() {
    document.getElementById("judul").value = "";
    $("#tabel_menu").find("tr:gt(0)").remove();
    $('#judul').focus();

    id_edit = '';
    id_hapus = [];
}

// Simpan Data
function simpan() {
    var judul = document.getElementById('judul').value;
    var data = [];

    // Validasi isian
    if (judul == '' || tabel_menu.rows.length == "1") {$('#btnIsian').click(); return;}
    for(var i=0; i<tabel_menu.rows.length - 1; i++){
        var kode = document.getElementsByName('kode')[i].value;
        var nama = document.getElementsByName('nama')[i].value;
        var level = document.getElementsByName('level')[i].value;
        var urut = i+1;
        var id_menu_detail = $('#tabel_menu tbody tr:eq('+ i + ')').find("td").eq(5).html();
        var menu = [id_edit,judul,kode,nama,level,urut,id_menu_detail,id_hapus];

        if (kode == '' || nama == '' || level == 'Level..') {$('#btnIsian').click(); return;}
        data.push(menu);
    }

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/administrator/menu/simpan_menu',
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click(); 
                kosong();
                filter();
            },500);  
        }
    });
}

// Filter Tabel
function filter() {
    var level = document.getElementById('fLevel').value;
    var cari = document.getElementById('cari').value;
    var arrData = [level, cari];

    $.ajax({
        data: {data: arrData},
        type: 'POST',
        url: '<?php echo base_url()."index.php/administrator/menu/filter_menu" ?>',
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

// Edit Data
function edit(btn) {
    var table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;

    id_edit = table.rows[row].cells[0].innerHTML;
    $("#tabel_menu").find("tr:gt(0)").remove();
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/administrator/menu/show_edit',
        data: {data: id_edit},
        success: function(data) {
            var data = JSON.parse(data);

            document.getElementById('judul').value = data[0]['JUDUL_MENU'];
            document.getElementById('judul').focus();
            isi_data(data);
        }
    });
}

// Isi Data yang diedit
function isi_data(data) {
    for (var i=0; i<data.length; i++) {
        kode = data[i]['KODE_MENU'];
        nama = data[i]['NAMA_MENU'];
        level = data[i]['LEVEL_MENU'];
        id_detail = data[i]['ID_DETAIL'];

        $('#tabel_menu').append(
            '<tr>' +
            '<td><input type="text" class="form-control" autocomplete="off" name="kode" value='+ kode +' style="width: 95%;"></td>' +
            '<td><input type="text" class="form-control" autocomplete="off" name="nama" style="width: 95%;"></td>' +
            '<td><select class="select" id="level" name="level" style="width: 95%;">' +
            '<option>Level..</option> ' +
            '<option>1</option>' +
            '<option>2</option>' +
            '<option>3</option>' +
            '</select></td>' +
            '<td><i class="ion-arrow-up-a up" onclick="move(this)" title="Menu Naik" style="cursor: pointer;"></i><i class="ion-arrow-down-a down" onclick="move(this)" title="Menu Turun" style="cursor: pointer;"></i></td>' +
            '<td><button type="button" class="btn btn-block btn-danger" title="Hapus menu" onclick="hapus_menu(this)" style="margin-top: 0; text-align: center;"><i class="fa ion-trash-a"></i></button></td>' +
            '<td hidden>'+ id_detail +'</td>' +
            '</tr>')

        document.getElementsByName('nama')[i].value = nama;
        document.getElementsByName('level')[i].value = level;
        $(".select").select2();
    }
}

// Hapus Data
function hapus(btn) {
    var table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_hapus = table.rows[row].cells[1].innerHTML;

    $('#btnHapus').click();
    $('#ya').on('click',function() {
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/administrator/menu/hapus_detail',
            data: {data: id_hapus},
            success: function(data) {
                setTimeout(function() {
                    kosong();
                    filter();
                    $('#btnOk').click();
                    $('#btnSukses').click();
                },500);  
                return;
            }
        });
    });
}

// Kelola Akun
function akses(btn) {
    var table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    id_edit = table.rows[row].cells[1].innerHTML;

    $('#btnAkun').click();
}

</script>