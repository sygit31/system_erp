

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
					<b><font color="White"><div id="headerinput">Master Data Konversi Satuan</div></font></b>
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
							<th width="15%">Nama Konversi</th>
					        <td width="45%">
						    <input type="text" class="form-control" id="nama_konversi" style="width: 40%;">
							<input type="hidden" class="form-control" id="id_satuan_awal" value='<?php echo $id_awal; ?>' style="width: 40%;">
					       </td>
                        </tr>
						<tr height="10"></tr>
                        <tr>
					   <th width="15%">Satuan Awal</th>
					   <td width="25%">
						<input type="text" class="form-control" value="<?php echo $satuans_awal;?>" id="satuan awal" style="width: 40%;" readonly>
					   </td>
					    <th width="15%">Satuan Akhir</th>
					    <td width="25%">
						
						  <select class="select" id="id_satuan_akhir"  style="width: 100%;">
								<option value='0'>Pilih Satuan Akhir</option>
								<?php foreach ($akhir as $dt) { ?>      
									<option value='<?php echo $dt->ID; ?>'> <?php echo $dt->NAMA; ?></option>
							<?php } ?>
						 </select>
					 </td>
				   </tr>
				       <tr>
							<th width="15%">Konversi</th>
					        <td width="45%">
						    <input type="text" class="form-control" id="konversi"  onkeypress="return isNumber(event)" style="width: 40%;">
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
                    <b><font color="White">Laporan Data Master Konversi Satuan</font></b>
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

                            <?php $this->load->view('vin/rnd/perdana/master/satuan/v_konversi_table.php'); ?>

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
    $('#nama_konversi').val('');
	$('#id_satuan_akhir').val('');
	$('#konversi').val('');
    id_edit = '';

    $('#nama_koversi').focus();
}

// Simpan Data
function simpan() {
    var nama_konversi = $('#nama_konversi').val();
	var id_satuan_awal = $('#id_satuan_awal').val();
	var id_satuan_akhir = $('#id_satuan_akhir').val();
	var konvers = $('#konversi').val();
    var data = [id_edit,id_satuan_awal, nama_konversi,id_satuan_akhir,konvers];

    if (nama_konversi == '') {$('#satuan').focus(); return;}
	if (id_satuan_akhir == '') {$('#id_satuan_akhir').focus(); return;}
	if (konvers == '') {$('#konversi').focus(); return;}
   console.log(konvers);
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/vin/rnd/perdana/master/satuan/satuan/simpan_konversi_perdana',
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
	var id_sat = document.getElementById("id_satuan_awal").value;
    var data = [cari, id_sat];
	$.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/vin/rnd/perdana/master/satuan/satuan/filter_konversi',
        data: {data: data},
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

// Edit Data
function edit(btn) { 
    var table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;

    id_edit = table.rows[row].cells[0].innerHTML;
    $('#nama_konversi').val(table.rows[row].cells[2].innerHTML).change();
	$('#konversi').val(table.rows[row].cells[5].innerHTML).change();
	$('#id_satuan_akhir').val(table.rows[row].cells[6].innerHTML).change();
    $('#nama_konversi').focus();
}



</script>
