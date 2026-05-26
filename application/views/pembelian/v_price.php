

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
					<b><font color="White"><div id="headerinput">Price Comparison</div></font></b>
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
						<td width="40%">
							<?php $dt_id_rfq = array(); ?>
							<?php $dt_nama_supplier = array(); ?>
							<?php $dt_nama_material = array(); ?>
							<?php $dt_satuan = array(); ?>
							<select class="select" id="no_rfq" style="width: 80%;" onchange="autofill()">
								<option value="">Pilih Nomor RFQ..</option>
								<?php foreach ($rfq->result_array() as $dt) { ?>
									<?php $dt_id_rfq[] = $dt['ID_RFQ']; ?>
									<?php $dt_nama_material[] = $dt['NAMA_MATERIAL'] . ' - ' . $dt['SPESIFIKASI']; ?>
									<?php $dt_nama_supplier[] = $dt['NAMA_SUPPLIER']; ?>
									<?php $dt_satuan[] = $dt['SATUAN']; ?>
									<option><?php echo $dt['NMR'] . ' (' . $dt['NAMA_MATERIAL'] . '-' . $dt['SPESIFIKASI'] . ' Supplier ' . $dt['NAMA_SUPPLIER'] . ')'; ?></option>
								<?php } ?>
							</select>
							<?php $nama_supplier = array_unique($dt_nama_supplier); ?>
							<?php $nama_material = array_unique($dt_nama_material); ?>
							<?php $satuan = array_unique($dt_satuan); ?>
						</td>
						<th width="15%">No. Quotation</th>
						<td width="30%">
							<input type="text" id="no_quotation" class="form-control" style="width: 50%;" maxlength="10" autocomplete="off">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Nama Supplier</th>
						<td>
							<input type="text" id="nama_supplier" class="form-control" style="width: 80%;" readonly>
						</td>
						<th>Net Price</th>
						<td>
							<input type="text" id="net_price" class="form-control" style="width: 50%;" maxlength="10" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Nama Barang</th>
						<td>
							<input type="text" id="nama_material" class="form-control" style="width: 80%;" readonly>
						</td>
						<th>Mata Uang</th>
						<td>
							<select class="form-control select" style="width: 50%;" id="mata_uang">' +
								<option>AUD</option>
								<option>CNY</option>
								<option selected>IDR</option>
								<option>JPY</option>
								<option>KRW</option>
								<option>MYR</option>
								<option>SGD</option>
								<option>USD</option>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Satuan</th>
						<td>
							<input type="text" id="satuan" class="form-control" style="width: 30%;" readonly>
						</td>
						<th>Delivery Time</th>
						<td>
							<input type="text" id="deltime" class="form-control datepicker" style="width: 50%; background-color: #FFFFFF;" readonly>
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
					<b><font color="White">Data Price Comparison</font></b>
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
							<table style="width: 20%; margin-bottom: 10px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th class="filter">Nama Material</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" class="cari" id="cari_material" autocomplete="off" onkeyup="filter()" placeholder="Cari Nama Material.." style="width: 100%;"></td>
									</tr>
								</tbody>
							</table>

							<?php $this->load->view('pembelian/v_price_table'); ?>

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
                        <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
let id_price = '', id_rfq = '', dt_id_rfq = [];
let no_rfq = document.getElementById('no_rfq');

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
    pagination();
    $('#no_quotation').focus();	

	dt_id_rfq = <?php echo json_encode($dt_id_rfq); ?>;
});

// Get No RFQ
$('#no_rfq').on('change', function() {
	let indeks = no_rfq.selectedIndex - 1;
	id_rfq = dt_id_rfq[indeks];
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

// Kosong Isian
function kosong() {
    $('#no_rfq').val('').change();
    $('#nama_supplier').val('');
    $('#nama_barang').val('');
    $('#satuan').val('');
    $('#no_quotation').val('');
    $('#net_price').val('');
    $('#mata_uang').val('IDR').change();
    $('#deltime').val('');

    id_price = '';
    id_rfq = '';
    $('#no_quotation').focus();
}

// Autofill Data RFQ
function autofill() {
	let indeks = document.getElementById('no_rfq').selectedIndex - 1;
	let arr_nama_supplier = <?php echo json_encode($dt_nama_supplier); ?>;
	let arr_nama_material = <?php echo json_encode($dt_nama_material); ?>;
	let arr_satuan = <?php echo json_encode($dt_satuan); ?>;

	$('#nama_supplier').val(arr_nama_supplier[indeks]);
	$('#nama_material').val(arr_nama_material[indeks]);
	$('#satuan').val(arr_satuan[indeks]);
}

// Simpan Data
function simpan() {
	let no_quotation = document.getElementById("no_quotation").value;
	let net_price = document.getElementById("net_price").value;
	let mata_uang = document.getElementById("mata_uang").value;
	let deltime = document.getElementById("deltime").value;

	let data = [id_rfq,no_quotation,net_price,mata_uang,deltime,id_price];

    if (id_rfq == '' || no_quotation == '' || net_price == '' || mata_uang == '' || deltime == '') {return;}

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/pembelian/price/simpan_price',
        data: {data: data},
        success: function(data) {
            filter();
            $('#btnSukses').click();

            no_rfq.remove(no_rfq.selectedIndex);
            for (let i=0; i<dt_id_rfq.length; i++){ 
            	if (dt_id_rfq[i] == id_rfq) {
            		dt_id_rfq.splice(i, 1); 
            	}
            }

            kosong();
        }
    });
}

// Filter Data
function filter() {
	let cari_material = document.getElementById('cari_material').value;
	let data = [cari_material];

	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/pembelian/price/filter_price" ?>',
		success: function(data) {
			$('.data-table').html(data);
			pagination();
		}
	}); 
}

// Hapus Data
function hapus(btn) {    
    let data_table = document.getElementById('data-table');
    let row = $(btn).closest("tr").index() + 1;
    let id_hapus_price = data_table.rows[row].cells[0].innerHTML;

    $('#btnHapus').click();
    $('#ya').on('click', function() {
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/pembelian/price/hapus_price',
            data: {data: id_hapus_price},
            success: function(data) {
                filter();
            }
        });
    });
}

// Edit Data
function edit(btn) {
	let data_table = document.getElementById('data-table');
	let row = $(btn).closest("tr").index() + 1;
	id_price = data_table.rows[row].cells[0].innerHTML;

	$.ajax({
		type: 'POST',
		url:'<?php echo base_url(); ?>index.php/pembelian/price/edit_price',
		data: {data: id_price},
		success: function(data) {
			data = JSON.parse(data);
			id_price = data['ID_PRICE'];
			nmr = data['NO_RFQ'] + ' (' + data['NAMA_MATERIAL'] + '-' + data['SPESIFIKASI'] + ' Supplier ' + data['NAMA_SUPPLIER'] + ')';

			// Add Option Value
			let option = document.createElement("option");
			option.text = nmr;
			no_rfq.add(option);

			$('#no_rfq').val(nmr).change();
			$('#nama_supplier').val(data['NAMA_SUPPLIER']);
			$('#nama_material').val(data['NAMA_MATERIAL']);
			$('#satuan').val(data['SATUAN']);
			$('#no_quotation').val(data['NO_QUOTATION']);
			$('#net_price').val(data['NET_PRICE']);
			$('#mata_uang').val(data['MATA_UANG']).change();
			$('#deltime').val(format_date(data['NET_DELTIME']));
			id_rfq = data['ID_RFQ'];
		}
	});

	$('#no_quotation').focus();
}

// Format Date
function format_date(num) {
	let date = num.substring(0, 2);
	let dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	let month = dt_month[parseInt(num.substring(3, 5))-1];
	let year = num.substring(6, 10);
	return date + '-' + month + '-' + year;
}

</script>