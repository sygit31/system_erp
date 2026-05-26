

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Data Pengajuan Budget</font></b>
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
                            <table style="width: 15%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="15%" class="filter">Periode</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fPeriode" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option value="All">Pilih Periode..</option>
                                                <?php foreach ($periode->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['PERIODE']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="pb-3" style="overflow-x: scroll; font-size: 12px;">
                                <?php $this->load->view('cc/v_budget_app_table'); ?>
                            </div>

                        </font>
                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>

        <!-- Modal Confirm Hapus -->
        <div class="modal fade" id="modal_hapus">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin ubah status? </div>
                    <div class="modal-footer">
                        <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                        <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">YES</button>
                        <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Preview -->
        <div class="modal fade" id="modal-preview" style="z-index: 9999;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"><div class="card-header" style="background-color: #0A86BF;">
                    <h3 class="card-title">
                        <b><font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;"><p id="judul">Detail Pengajuan</p></font></b>
                    </h3>
                    <div class="card-tools">
                        <button id="btnClose" type="button" class="close" title="Close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body" style="margin-left: 10px; margin-right: 20px; overflow-x: scroll;">
                    <font size="2">
                        <table id="preview_pengajuan" class="table table-bordered table-striped" width="100%">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Satuan</th>
                                    <th>Safety Stock</th>
                                    <th>Saldo</th>
                                    <th>Min Order</th>
                                    <th>Outstanding</th>
                                    <th>Budget Beli</th>
                                    <th>Harga</th>
                                    <th>Mata Uang</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </font>
                </div>
                <div class="modal-footer">
                    <button style="width: 20%;" class="btn btn-info" onclick="cetak()">Cetak</button>
                    <button style="width: 20%;" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
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
var info_1 = 0, info_2 = 0; // Status Card Info
var id_budget = '', app_status = '';

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
      "order": [[ 1, "asc" ]],
      "info": false,
      "autoWidth": true
  });
}

// Pagination Preview
function pagination_preview() {
    $('#preview_pengajuan').DataTable().destroy();
    $('#preview_pengajuan').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": false,
        "autoWidth": true
    });
}

// Lihat Rincian Budget
function preview(btn) {
    $('#modal_preview').click();

    var tabel = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    id_budget = tabel.rows[row].cells[0].innerText;

    $('#preview_pengajuan').DataTable().destroy();
    $("#preview_pengajuan").find("tr:gt(0)").remove();

    $.ajax({
        data: {data: id_budget},
        type: 'POST',
        url: '<?php echo base_url()."index.php/cc/budget/preview_budget" ?>',
        success: function(data) {
            data = JSON.parse(data);
            isi_preview(data);
            pagination_preview();
        }
    });
}

// Isi data ke dalam tabel
function isi_preview(data) {
    var grand_total = 0;

    for (var i=0; i<data.length; i++) {

        nama_material = data[i]['NAMA_MATERIAL'] + ' - ' + data[i]['SPESIFIKASI'];
        satuan = data[i]['SATUAN'];
        safety_stock = format(data[i]['SAFETY_STOCK']);
        saldo = format(data[i]['SALDO']);
        moq = format(data[i]['MOQ']);
        outstanding = format(data[i]['OUTSTANDING']);
        budget_beli = format(data[i]['BUDGET_BELI']);
        harga = data[i]['HARGA'];
        if (harga != null) {
            harga = format(harga);
            total = format(angka(budget_beli) * angka(harga));
        }else{
            harga = 0;
            total = 0;
        }
        mata_uang = data[i]['MATA_UANG'];
        if (mata_uang == null) {mata_uang = '';}

        $('#preview_pengajuan').find('tbody').append(
            '<tr><td align="center">' + (i+1) + '</td><td>' + nama_material + '</td><td align="center">' + satuan + '</td><td align="right">' + safety_stock + '</td><td align="right">' + saldo + '</td><td align="right">' + moq + '</td><td align="right">' + outstanding + '</td><td align="right">' + budget_beli + '</td><td align="right">' + harga + '</td><td align="right">' + mata_uang + '</td><td align="right">' + total + '</td></tr>')
    }

}

// Format Angka
function format(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function angka(num) {
    return Number(num.replace(/,/g,''));
}

// Filter Data Table
function filter() {
	var periode = $('#fPeriode').val();

	$.ajax({
		type: 'POST',
		url:'<?php echo base_url(); ?>index.php/cc/budget_app/filter_budget',
		data: {data: periode},
		success: function(data) {
			$('.data-table').html(data);
			pagination();
		}
	});
}

// Ubah Status
function status(btn) {
    var tabel = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    id_budget = tabel.rows[row].cells[0].innerText;
    app_status = btn.innerHTML;

    $('#btnHapus').click();
}
$('#ya').click(function() {
    $.ajax({
        data: {data: [id_budget,app_status]},
        type: 'POST',
        url: '<?php echo base_url()."index.php/cc/budget_app/status" ?>',
        success: function(data) {
            filter();
        }
    });
});

// Expands & Collapse Card Info
$('.info_1:eq(0)').on('click', function() {
    if (info_1 == 0) {
        $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_1 = 1;
    }else{
        $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_1 = 0;
    }
});
$('.info_2:eq(0)').on('click', function() {
    if (info_2 == 0) {
        $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_2 = 1;
    }else{
        $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_2 = 0;
    }
});

</script>