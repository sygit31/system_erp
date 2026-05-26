

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
					<b><font color="White"><div id="headerinput">Input Request For Quotation</div></font></b>
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
				<table width="100%">
					<tr>
						<th width="15%">No. RFQ</th>
						<td width="35%">
							<input type="text" id="no_rfq" class="form-control" style="width: 40%;" readonly>
						</td>
						<th width="15%">Nama Material</th>
						<td width="25%">
							<?php $dt_id_material = array(); ?>
							<?php $dt_satuan = array(); ?>
							<select class="select" id="material" style="width: 80%;">
								<option value="">Pilih Material..</option>
								<?php foreach ($barang->result_array() as $dt) { ?>
									<?php $dt_id_material[] = $dt['ID']; ?>
									<?php $dt_satuan[] = $dt['SATUAN']; ?>
									<option><?php echo $dt['NAMA'] . '-' . $dt['SPESIFIKASI']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>RFQ Date</th>
						<td>
                            <?php $tanggal = date('d-M-Y', strtotime('-0 days')); ?>
							<input type="text" id="tanggal" class="form-control datepicker" onchange="auto_no()" value="<?php echo $tanggal; ?>" style="width: 40%; background-color: #FFFFFF;" readonly>
						</td>
                        <th>Satuan</th>
                        <td>
                            <input type="text" id="satuan" class="form-control" style="width: 50%;" readonly>
                        </td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Quotation Deadline</th>
						<td>
                            <?php $deadline = date('d-M-Y', strtotime('+7 days')); ?>
							<input type="text" id="deadline" class="form-control datepicker" value="<?php echo $deadline; ?>" style="width: 40%; background-color: #FFFFFF;" readonly>
						</td>
						<th>RFQ Qty</th>
						<td>
							<input type="text" id="rfq_qty" class="form-control" style="width: 50%;" tabindex="1" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Nama Supplier</th>
						<td>
							<?php $dt_id_supplier = array(); ?>
							<select class="select" id="supplier" style="width: 70%;">
								<option value="">Pilih Supplier..</option>
								<?php foreach ($supplier->result_array() as $dt) { ?>
									<?php $dt_id_supplier[] = $dt['ID']; ?>
									<option><?php echo $dt['NAMA']; ?></option>
								<?php } ?>
							</select>
						</td>
						<th>Storage Location</th>
						<td>
							<input type="text" id="storage" class="form-control" value="000" style="width: 50%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Delivery Time</th>
						<td>
                            <?php $deltime = date('d-M-Y', strtotime('+30 days')); ?>
							<input type="text" id="deltime" class="form-control datepicker" value="<?php echo $deltime; ?>" style="width: 40%; background-color: #FFFFFF;" readonly>
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
					<b><font color="White">Data Request For Quotation</font></b>
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
							<table style="width: 60%; margin-bottom: 10px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="40%" colspan="2" class="filter">Filter Tanggal</th>
										<td></td>
										<th width="30%" class="filter">Nama Material</th>
										<td></td>
										<th width="30%" class="filter">Nama Supplier</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-30 days')); ?>" onchange="filter()" autocomplete="off"></td>
										<td><input id="fTgl2" type="text" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off"></td>
										<td></td>
										<td><input type="text" class="cari" id="cari_material" autocomplete="off" onkeyup="filter()" placeholder="Cari Nama Material.." style="width: 100%;"></td>
										<td></td>
										<td><input type="text" class="cari" id="cari_supplier" autocomplete="off" onkeyup="filter()" placeholder="Cari Nama Supplier.." style="width: 100%;"></td>
									</tr>
								</tbody>
							</table>

							<?php $this->load->view('pembelian/v_rfq_table'); ?>

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
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
                    <div class="modal-footer">
                        <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                        <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">YES</button>
                        <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
                    </div>
                </div>
            </div>
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

	</section>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
let id_rfq = '';

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
    pagination();
    auto_no();
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

// Auto No. RFQ
function auto_no() {
	let tgl = $('#tanggal').val();
	let year = tgl.substring(9, 12);

	$.ajax({
		data: {data: year},
		type: 'POST',
		url: '<?php echo base_url()."index.php/pembelian/rfq/auto_no" ?>',
		success: function(urut) {
			document.getElementById('no_rfq').value = year + '-' + urut;
		}
	}); 

}

// Kosong Isian
function kosong() {
    $('#tanggal').val(<?php echo json_encode($tanggal); ?>).change();
    $('#deadline').val(<?php echo json_encode($deadline); ?>).change();
    $('#supplier').val('').change();
    $('#deltime').val(<?php echo json_encode($deltime); ?>).change();
    $('#material').val('').change();
    $('#satuan').val('').change();
    $('#rfq_qty').val('').change();
    $('#storage').val('000').change();
    id_rfq = '';
}

// Ambil Data Satuan
$('#material').on('change',function() {
	let indeks = document.getElementById('material').selectedIndex - 1;
	let arr_satuan = <?php echo json_encode($dt_satuan); ?>;
	$('#satuan').val(arr_satuan[indeks]);
});

// Simpan Data
function simpan() {
	let indeks_supplier = document.getElementById('supplier').selectedIndex - 1;
	let indeks_material = document.getElementById('material').selectedIndex - 1;
	let dt_id_supplier = <?php echo json_encode($dt_id_supplier); ?>;
	let dt_id_material = <?php echo json_encode($dt_id_material); ?>;

	let no_rfq = document.getElementById("no_rfq").value;
	let tanggal = document.getElementById("tanggal").value;
	let deadline = document.getElementById("deadline").value;
	let id_supplier = dt_id_supplier[indeks_supplier];
	let deltime = document.getElementById("deltime").value;
	let id_material = dt_id_material[indeks_material];
	let rfq_qty = document.getElementById("rfq_qty").value;
	let storage = document.getElementById("storage").value;

	let data = [no_rfq,tanggal,deadline,id_supplier,deltime,id_material,rfq_qty,storage,id_rfq];

    if (indeks_supplier == '-1' || material == '' || rfq_qty == '') {return;}

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/pembelian/rfq/simpan_rfq',
        data: {data: data},
        success: function(data) {
            kosong();
            filter();
            $('#btnSukses').click();
        }
    });
}

// Filter Data
function filter() {
	let tgl1 = document.getElementById('fTgl1').value;
	let tgl2 = document.getElementById('fTgl2').value;
	let cari_material = document.getElementById('cari_material').value;
	let cari_supplier = document.getElementById('cari_supplier').value;
	let data = [tgl1, tgl2, cari_material, cari_supplier];

	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/pembelian/rfq/filter_rfq" ?>',
		success: function(data) {
			$('.data-table').html(data);
			pagination();
		}
	}); 
}

// Edit Data
function edit(btn) {
	let data_table = document.getElementById('data-table');
    let row = $(btn).closest("tr").index() + 1;

    id_rfq = data_table.rows[row].cells[0].innerHTML;
	$('#no_rfq').val(data_table.rows[row].cells[2].innerHTML);
	$('#tanggal').val(data_table.rows[row].cells[3].innerHTML);
	$('#deadline').val(data_table.rows[row].cells[4].innerHTML);
	$('#supplier').val(data_table.rows[row].cells[5].innerHTML).change();
	$('#deltime').val(data_table.rows[row].cells[6].innerHTML);
	$('#material').val(data_table.rows[row].cells[7].innerHTML).change();
	$('#satuan').val(data_table.rows[row].cells[8].innerHTML);
	$('#rfq_qty').val(data_table.rows[row].cells[9].innerHTML);
	$('#storage').val(data_table.rows[row].cells[10].innerHTML);

	$('#no_rfq').focus();
}

// Hapus Data
function hapus(btn) {    
    let data_table = document.getElementById('data-table');
    let row = $(btn).closest("tr").index() + 1;
    let id_hapus_rfq = data_table.rows[row].cells[0].innerHTML;

    $('#btnHapus').click();
    $('#ya').on('click', function() {
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/pembelian/rfq/hapus_rfq',
            data: {data: id_hapus_rfq},
            success: function(data) {
                filter();
            }
        });
    });
}

</script>