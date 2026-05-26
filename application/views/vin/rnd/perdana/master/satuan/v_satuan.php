

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
					<b><font color="White"><div id="headerinput">Master Data Satuan dan Konversi Satuan</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                     <i class="fa fa-minus"></i></button>
                     <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <th width="15%">Nama Satuan</th>
                            <td width="30%">
                                <input class="form-control" type="text" id="satuan" style="width: 70%;" tabindex="1" autocomplete="off" maxlength="50">
                            </td>
                        </tr>
                        
                    </table>
                </div>

            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" tabindex="4">Simpan</button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" tabindex="5">Batal</button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Data Master Satuan</font></b>
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
                            <table style="width: 30%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="50%" class="filter">Nama Satuan</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari Nama Satuan.." style="width: 100%;" autocomplete="off" tabindex="5"></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('vin/rnd/perdana/master/satuan/v_satuan_table.php'); ?>

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

    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var id_edit = '';

// Document load
$(document).ready(function() {
    pagination();
    $(".select").select2(); // Combo Live Search
    $('#satuan').focus();
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

// Kosong Isian
function kosong() {
    $('#satuan').val('');
    id_edit = '';

    $('#satuan').focus();
}

// Simpan Data
function simpan() {
    var satuan = $('#satuan').val();
    var data = [id_edit, satuan];

    if (satuan == '') {$('#satuan').focus(); return;}
   // console.log(satuan);
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/vin/rnd/perdana/master/satuan/satuan/simpan_satuan_perdana',
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
    var cari = document.getElementById("cari").value;

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/vin/rnd/perdana/master/satuan/satuan/filter_satuan',
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
    $('#satuan').val(table.rows[row].cells[2].innerHTML).change();
    

    $('#satuan').focus();
}

function konversi(btn) { 
    var table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;

    id_edit = table.rows[row].cells[0].innerHTML;
	satuan = table.rows[row].cells[2].innerHTML;
	var id = [id_edit];
	var satuan_awal = [satuan];
	window.location.href="<?php echo base_url();?>index.php/vin/rnd/perdana/master/satuan/satuan/show_konversi?id="+id+"&satuan_awal="+satuan_awal;   
}

</script>
