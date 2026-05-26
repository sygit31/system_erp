

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

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div id="headerinput">Risalah Rapat</div></font></b>
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
                <table width="100%">
                    <tr>
                        <td width="15%">No. Risalah</td>
                        <td width="3%">:</td>
                        <td width="39%"><input type="text" class="form-control" id="no_risalah" style="width: 90%;" maxlength="20" tabindex="1"></td>
                        <td width="15%">Delivery</td>
                        <td width="3%">:</td>
                        <td width="25%"><input type="text" class="form-control datepicker" id="delivery" autocomplete="off" style="width: 80%; background-color: #FFFFFF;" tabindex="3" readonly></td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>:</td>
                        <td><input type="text" id="tanggal" class="form-control datepicker" autocomplete="off" style="width: 40%; background-color: #FFFFFF;" tabindex="2" readonly></td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-warning" id="btnSimpan" onclick="tambah_produk()">+ Tambah</button>
                        </td>
                        <td width="10"></td>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()">Simpan</button>
                        </td>
                        <td width="10"></td>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()">Batal</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <table id="tabel_produk" class="table table-bordered">
                    <thead style="background-color: #06D288; color: #FFFFFF; font-weight: bold;">
                        <tr style="text-align: center;">
                            <td width="65%">Nama Produk</td>
                            <td width="35%">Qty</td>
                            <td hidden></td>
                            <td hidden>Id Produk</td>
                            <td hidden>Qty</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Risalah Rapat</font></b>
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
                                        <td width="40%" colspan="2" class="filter">Filter Tanggal</td>
                                        <td></td>
                                        <td width="20%" class="filter">Desain</td>
                                        <td></td>
                                        <td width="40%" class="filter">Nomor Risalah</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" id="fTgl1" style="background-color: #FFFFFF;" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-30 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                        <td><input type="text" id="fTgl2" style="background-color: #FFFFFF;" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                                <option>2020</option>
                                                <option>2021</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td><input type="text" class="cari" id="cari" onkeyup="filter()" placeholder="Cari nomor Risalah.." autocomplete="off" style="width: 100%;"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('cs/v_risalah_table'); ?>

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
                        <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
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
var id_edit, jml_produk, tabel_produk;
var arrId_Proses = new Array();

// Load Dokumen
$(document).ready(function() {
    $(".select").select2(); // Combo Live Search
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
    pagination();

    tabel_produk =  document.getElementById('tabel_produk');
    tabel_produk.style.width = '50%';

    $('#no_risalah').focus();
}); 

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    $('#data-table').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": false,
        "order": false,
        "info": false,
        "autoWidth": true
    });
}

// Kosongkan isian
function kosong() {
    document.getElementById("no_risalah").value = "";
    document.getElementById("delivery").value = "";
    document.getElementById("tanggal").value = "";
    $("#tabel_produk").find("tr:gt(0)").remove();

    $('#no_risalah').focus();
}

//Tambah PIC
function tambah_produk() {
    jml_produk += 1;
    $('#tabel_produk').append(
        '<tr>' +
        '<td><select class="select" style="width: 95%;" onchange="produk(this)">' +
        '<option>Pilih Produk..</option> ' +

        '<?php foreach ($produk->result_array() as $dt): ?>' +
        '<option><?php echo $dt['NAMA'] . ' ' . $dt['DESAIN']; ?></option>' +
        arrId_Proses.push(<?php echo $dt['ID']; ?>) +
        '<?php endforeach; ?>' +

        '</select></td>' +
        '<td><input type="text" id="qty" class="form-control" onkeyup="t_qty(this)" oninput="this.value = this.value.replace(/[^0-9]/g, \'\')" autocomplete="off" style="width: 95%; text-align: center;"></td>' +

        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Produk" onclick="hapus_produk(this)" style="margin-top: 0;">X</button></td>' +

        '<td hidden></td>' +
        '<td hidden></td>' +
        '</tr>')
    $(".select").select2();
    $(".datepicker").datepicker({ dateFormat: 'dd-M-yy' });
}

// Hapus Produk
function hapus_produk(btn) {
    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
};

// Isi Tabel Sementara (data yang akan disimpan)
function produk(btn) {
    row = $(btn).closest("tr").index() + 1;
    index_produk = btn.selectedIndex;
    id_produk = arrId_Proses[index_produk - 1];
    tabel_produk.rows[row].cells[3].innerHTML = id_produk;
}
function t_qty(btn) {
    row = $(btn).closest("tr").index() + 1;
    tabel_produk.rows[row].cells[4].innerHTML = btn.value;
}

// Simpan Data
function simpan() {
    var arrData = new Array();
    no_risalah = document.getElementById('no_risalah').value;
    tgl = document.getElementById('tanggal').value;
    delivery = document.getElementById('delivery').value;

    // Validasi isian
    if (no_risalah == '' || tgl == '' || delivery == '' || tabel_produk.rows.length == "1") {return false;}
    for(var i=1; i<tabel_produk.rows.length; i++){
        if (tabel_produk.rows[i].cells[3].innerHTML == "" || tabel_produk.rows[i].cells[4].innerHTML == "") {
            return false;
        };
    }

    for(var i=1; i<tabel_produk.rows.length; i++){
        id_produk = tabel_produk.rows[i].cells[3].innerHTML;
        qty = tabel_produk.rows[i].cells[4].innerHTML;

        var project = {
            'no_risalah' : no_risalah,
            'tgl' : tgl,
            'delivery' : delivery,
            'id_produk' : id_produk,
            'qty' : qty
        }
        arrData.push(project);
    }

    $.ajax({
        data: {data:arrData},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/cs/risalah/simpan_risalah',
        success: function() {            
            $('#btnSukses').click();
        }
    });
}

// Reload Page
$('#btnOk').click(function() {
    location.reload();
});

// Filter Tabel
function filter() {
    var tgl1 = document.getElementById('fTgl1').value;
    var tgl2 = document.getElementById('fTgl2').value;
    var desain = document.getElementById('fDesain').value;
    var cari = document.getElementById('cari').value;
    var arrData = [tgl1, tgl2, desain, cari];

    $.ajax({
        data: {data: arrData},
        type: 'POST',
        url: '<?php echo base_url()."index.php/cs/risalah/filter_risalah" ?>',
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    }); 
}

</script>