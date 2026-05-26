

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
					<b><font color="White"><div id="headerinput">Master Data Lokasi</div></font></b>
				</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="15%">Lokasi</th>
                        <td width="30%">
                            <input class="form-control" type="text" id="lokasi" style="width: 70%;" tabindex="1" autocomplete="off" maxlength="50">
                        </td>
                        <th width="15%">Telp/ HP</th>
                        <td width="40%">
                            <input class="form-control" type="text" id="telp" style="width: 70%;" tabindex="3" autocomplete="off" maxlength="50">
                        </td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <th>PIC</th>
                        <td>
                            <input class="form-control" type="text" id="pic" style="width: 70%;" tabindex="2" autocomplete="off" maxlength="50">
                        </td>
                        <th>Keterangan</th>
                        <td>
                            <input class="form-control" type="text" id="keterangan" style="width: 70%;" tabindex="4" autocomplete="off" maxlength="50">
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" tabindex="4"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" tabindex="5"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Data Master Lokasi</font></b>
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
                            <table style="width: 300px; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="50%" class="filter">Lokasi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari Lokasi.." style="width: 100%;" autocomplete="off" tabindex="5"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="data-table table-responsive"></div>

                            <button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success ml-2" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                        </font>
                    </div>
                </div>
            </div>
            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
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

<!-- Modal Sukses Simpan -->
<div class="modal fade" id="modal_sukses" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
            <div class="modal-footer">
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" onclick="filter()" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
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

<!-- Export Excel -->
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>

<script>

// Define Variable
var id_edit = '', info_1 = 0, info_2 = 0;

// Document load
$(document).ready(function() {
    $(".select").select2();
    $('#lokasi').focus();
    filter();
});

// Resize Dokumen
$(window).on('resize', function() {
    pagination();
});

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    var data_table = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "info": false,
        "order": [1, "asc"],
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
            className: 'invisible excel',
            title: 'Laporan Data Lokasi Distribusi'
        }],
        "colReorder": true
    });

    setTimeout(function() {
        data_table.columns.adjust().draw();
    }, 1000);
}

// Kosong Isian
function kosong() {
    $('#lokasi').val('');
    $('#pic').val('');
    $('#telp').val('');
    $('#keterangan').val('');
    id_edit = '';

    $('#lokasi').focus();
}

// Tampilkan error isian
function error_isian(str) {
    $('#keterangan_isian').html(str);
    $('#btnIsian').click();
    throw new Error("Isian salah..");
}

// Simpan Data
function simpan() {
    var lokasi = $('#lokasi').val();
    var pic = $('#pic').val();
    var telp = $('#telp').val();
    var keterangan = $('#keterangan').val();
    var data = [id_edit, lokasi, pic, telp, keterangan];

    if (lokasi == '') {error_isian('Lokasi belum diisi..');}
    if (pic == '') {error_isian('PIC belum diisi..');}
    if (telp == '') {error_isian('Telp belum diisi..');}

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/location/simpan_location',
        data: {data: data},
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                kosong();
            }, 500);      
        }
    });
}

// Filter Data
function filter() {
    var cari = document.getElementById("cari").value;

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/rnd/location/filter_location',
        data: {data: cari},
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
    $('#lokasi').val(table.rows[row].cells[2].innerHTML).change();
    $('#pic').val(table.rows[row].cells[3].innerHTML);
    $('#telp').val(table.rows[row].cells[4].innerHTML).change();
    $('#keterangan').val(table.rows[row].cells[5].innerHTML);

    $('html, body').animate({scrollTop: $(".sidebar-mini").offset().top}, 1000);
    $('#lokasi').focus();
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

    setTimeout(function() {
        pagination();
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
        pagination();
    }, 500);
});

</script>