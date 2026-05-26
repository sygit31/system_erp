

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

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Input Rekening Jurnal</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
            <div class="card-body">
                <table width="70%">
                    <tr>
                        <td width="30%"><label><font size = "3">Nomor Rekening</font></label></td>
                        <td width="70%">
                            <input type="text" class="form-control" id="nomor" style="width: 50%;" autocomplete="off" tabindex="1" maxlength="7">
                        </td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <td><label><font size = "3">Nama Rekening</font></label></td>
                        <td>
                            <input type="text" class="form-control" id="nama" autocomplete="off" style="width: 80%;" tabindex="2" maxlength="50">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer">
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
                    <b><font color="White">Laporan Data Rekening Jurnal</font></b>
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
                                        <td width="100%" class="filter">Cari Nama</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama Rekening.." style="width: 100%;" autocomplete="off">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('cc/v_rekening_table'); ?>

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

        <!-- Modal Confirm Aktif -->
        <div class="modal fade" id="modal_aktif" style="z-index: 9999;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin ubah? </div>
                    <div class="modal-footer">
                        <button type="button" id="no" style="width: 50%;" class="btn btn-primary" data-dismiss="modal">NO</button>
                        <button type="button" id="ya" style="width: 50%;" class="btn btn-danger">YES</button>
                        <button id="btnAktif" data-toggle="modal" data-target="#modal_aktif" hidden></button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var id_rekening, aktif;

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
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
      "ordering": true,
      "info": false,
      "autoWidth": true
  });
}

// Kosong Isian
function kosong() {
    $('#nomor').val('');
    $('#nama').val('');
    $('#nomor').focus();
}

// Simpan Data
function simpan() {
    var nomor = $('#nomor').val();
    var nama = $('#nama').val();
    var data = [nomor, nama];

    if (nomor == '' || nama == '') {return;}
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/cc/rekening/simpan_rekening',
        data: {data: data},
        success: function(data) {alert(data);
            filter();
            kosong(); 
            $('#btnSukses').click();
        }
    });
}

// Filter Data Table
function filter() {
    var cari = $('#cari').val();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/cc/rekening/filter_rekening',
        data: {data: cari},
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

// Aktif Rekening
function status(btn) {
    $('#btnAktif').click();    

    var data_table = document.getElementById('data-table');

    row = $(btn).closest("tr").index();
    id_rekening = data_table.rows[row+1].cells[0].innerHTML;

    if (btn.checked == false) {btn.checked = true; aktif='0';}else{btn.checked = false; aktif='1';}
}

// Simpan Aktif Rekening
$('#ya').on('click', function() {
    var data = [id_rekening, aktif];

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/cc/rekening/aktif_rekening',
        data: {data: data},
        success: function(data) {
            $('#no').click();
            filter();
        }
    });
});

</script>