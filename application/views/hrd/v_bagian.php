

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
					<b><font color="White"><div id="headerinput">Input Data Bagian</div></font></b>
				</h3>
				<div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="50%">
                    <tr>
                        <td width="30%"><label><font size = "3">Kode</font></label></td>
                        <td width="70%">
                            <input type="text" class="form-control" id="kode" style="width: 80%; text-transform: uppercase;" autocomplete="off" tabindex="1">
                        </td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <td><label><font size = "3">Nama Bagian</font></label></td>
                        <td>
                            <input type="text" class="form-control" id="bagian" autocomplete="off" style="width: 80%; text-transform: uppercase;" tabindex="2">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" tabindex="3"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" tabindex="4"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Bagian</font></b>
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
                            <table style="width: 30%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="100%" class="filter">Cari Nama</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama Bagian.." style="width: 100%;" autocomplete="off">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('hrd/v_bagian_table'); ?>

                        </font>
                    </div>
                </div>
            </div>
        </div>  
        <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>      
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

<!-- Modal Sukses Simpan -->
<div class="modal fade" id="modal_sukses" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
            <div class="modal-footer">
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
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

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var info_1 = 0, info_2 = 0;
var id_edit = 0;

// Load Dokumen
$(document).ready(function() {
    pagination();
    $('#kode').focus();
});

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "order": [1, "asc"],
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
            className: 'excel invisible',
            title: 'Data Surat Pembelian Luar (SPL)'
        }]
    });
}

// Kosong Isian
function kosong() {
    $('#kode').val('');
    $('#bagian').val('');
    $('#kode').focus();
    id_edit = 0;
}

// Filter Data Table
function filter() {
    var cari = $('#cari').val();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/hrd/bagian/filter',
        data: {data: cari},
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

// Simpan Data
function simpan() {
    var kode = $('#kode').val().toUpperCase();
    var bagian = $('#bagian').val().toUpperCase();
    var data = [kode, bagian, id_edit];

    if (kode == '' || bagian == '') {
        $('#btnIsian').click();
        return;
    }

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/hrd/bagian/simpan',
        data: {data: data},
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
            }, 500);
            filter();
            kosong();
        }
    });
}

// Edit Data
function edit(btn) {
    var table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id = table.rows[row].cells[0].innerHTML;
    var kode = table.rows[row].cells[2].innerHTML;
    var bagian = table.rows[row].cells[3].innerHTML;

    $('#kode').val(kode);
    $('#bagian').val(bagian);

    id_edit = id;
    $('#kode').focus();
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