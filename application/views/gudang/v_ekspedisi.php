

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap4.min.css">

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
					<b><font color="White"><div id="headerinput">Pemeriksaan Mutu</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table style="width: 600px; margin-bottom: 10px;">
						<tr align="center" style="line-height: 30px;">
							<td width="18%" class="filter">Desain</td>
							<td></td>
							<td colspan="2" class="filter">Tanggal</td>
							<td></td>
							<td width="20%" class="filter">Ukuran</td>
							<td></td>
							<td width="20%" class="filter">Status</td>
						</tr>
						<tr>					
							<td>
								<?php $years = range(2030, 2023); ?>
								<select class="select" id="f_desain" onchange="f_filter()" style="width: 100%;">
									<?php foreach ($years as $dt) { ?>
										<option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
									<?php } ?>
								</select>
							</td>
							<td></td>	
							<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="f_filter()" style="background-color: white; cursor: pointer;" readonly></td>
							<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="f_filter()" style="background-color: white; cursor: pointer;" readonly></td>
							<td></td>						
							<td>
								<select id="f_ukuran" class="select_min" onchange="f_filter()" style="cursor: pointer; width: 100%;">
									<option value="A">73</option>
									<option value="B">52.5 Cm</option>
									<option value="C">34.5 Cm</option>
								</select>
							</td>
							<td></td>						
							<td>
								<select id="f_status" class="select_min" onchange="f_filter()" style="cursor: pointer; width: 100%;">
									<option value="All">Semua</option>
									<option value="1">Terkirim</option>
									<option value="0">On Stok</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
					<div style="width: 1000px;">
						<table id="tbl_excel" hidden></table>
						<table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
							<thead class="text-center">
								<tr>
									<th rowspan="2">No.</th>
									<th width="13%" rowspan="2">Tanggal Produksi</th>
									<th width="10%" rowspan="2">Penolakan QC</th>
									<th rowspan="2">Bon</th>
									<th rowspan="2">Kode Roll</th>
									<th colspan="2">Netto</th>
									<th rowspan="2" width="25%">Keterangan</th>
								</tr>
								<tr>
									<th>In Roll</th>
									<th>In Deres</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot>
								<tr align="center">
									<th colspan="5">Total</th>
									<th style="mso-number-format:\'\@\';"></th>
									<th style="mso-number-format:\'\@\';"></th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>

					<div class="card-footer">
						<button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pemeriksaan Mutu')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-info" hidden>
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Pengeluaran Kertas Banderoll</div></font></b>
				</h3>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table style="width: 500px; margin-bottom: 10px;">
						<tr align="center" style="line-height: 30px;">
							<td width="50%" colspan="2" width="60%" class="filter">Tanggal</td>
							<td></td>
							<td width="25%" class="filter">Ukuran</td>
							<td></td>
							<td width="25%" class="filter">No. IPB</td>
						</tr>
						<tr>
							<td>
								<input id="tgl1" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly>
							</td>
							<td>
								<input id="tgl2" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly>
							</td>
							<td></td>						
							<td>
								<select id="ukuran" class="select_min" onchange="filter()" style="cursor: pointer; width: 100%;">
									<option>52.5 Cm</option>
									<option>73 Cm</option>
								</select>
							</td>
							<td></td>						
							<td>
								<input type="text" id="no_ipb" class="form-control" style="width: 100%; height: 40px; text-align: center;"></td>
							</td>
						</tr>
					</table>
				</div>

				<font size="2" class="data-table" id="content">
					<?php $this->load->view('gudang/v_ekspedisi_table'); ?>
				</font>

				<div class="card-footer">
					<button type="button" class="btn btn-success" onclick="cetak()" style="width: 110px;"><i class="fa fa-print mr-2"></i><b>Print</b></button>
				</div>
			</div>
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

<!-- Print -->
<div id="printable"	style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px; display: none;">
	<table class="header-table" width="100%">
		<tr>
			<td colspan="3" align="center" style="font-size: 1.7em; line-height: 50px;">Data Mutasi Kertas Ke Stamping</td>
		</tr>			
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td width="86.1%"><input type="text" id="tgl_print" readonly></td>
		</tr>
		<tr>
			<td>No. IPB</td>
			<td>:</td>
			<td><input type="text" id="ipb_print"></td>
		</tr>
	</table>
	<font size="2" class="data-table" id="content-print">
		<?php $this->load->view('gudang/v_ekspedisi_table'); ?>
	</font>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?v=2"></script>

<script>

// Load Dokumen
	$(document).ready(function() {
		$('.select').select2();
		$('.select_min').select2({minimumResultsForSearch: -1});
		$('.datepicker').datepicker({ dateFormat: 'dd-M-yy' });
		
		filter();
		f_filter();
	});

// Filter Tabel Reject QC
	function f_filter() {		
		var tgl1 = $('#f_tgl1').val();
		var tgl2 = $('#f_tgl2').val();
		var ukuran = $('#f_ukuran').val();
		var status = $('#f_status').val();
		var desain = $('#f_desain').val();
		var data = [tgl1, tgl2, ukuran, status, desain];

		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		$('#tbl').hide();
		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/kertas/f_filter" ?>',
				success: function(data) {
					data = JSON.parse(data);

					t_deres = 0, t_roll = 0;
					for (var i=0; i<data.length; i++) {
						nmr = data[i].NO_PENOLAKAN_QC == null ? '' : data[i].NO_PENOLAKAN_QC;
						bon = data[i].BON == null ? '' : data[i].BON;
						t_deres = t_deres + Number(data[i].IN_DERES);
						t_roll = t_roll + Number(data[i].IN_ROLL);
						color = nmr == '' ? 'bg-danger' : '';

						$('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+format_date(data[i].TGL_BON)+'</td><td class="'+color+'">'+nmr+'</td><td>'+bon+'</td><td>'+data[i].NO_ROLL+'</td><td style="mso-number-format:\'\@\';">'+data[i].IN_ROLL+'</td><td style="mso-number-format:\'\@\';">'+desimal(data[i].IN_DERES, 2)+'</td><td align="left">'+data[i].KETERANGAN+'</td></tr>');
					}
					$('#tbl tfoot th:eq(1)').html(format_number(t_roll.toFixed(2)));
					$('#tbl tfoot th:eq(2)').html(format_number(t_deres.toFixed(2)));

					$('#tbl').show();
					setTimeout(function() {$('#btnOk').click(); page('tbl');}, 500);
				}
			});
		}, 300);
	}

// Filter Tabel
	function filter() {		
		var tgl1 = document.getElementById('tgl1').value;
		var tgl2 = document.getElementById('tgl2').value;
		var ukuran = document.getElementById('ukuran').value;
		arrData = [tgl1, tgl2, ukuran];

		var content = document.getElementById('content');
		var content_print = document.getElementById('content-print');

		$('#btnProgress').click();
		$.ajax({
			data: {data: arrData},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/kertas/filter_ekspedisi" ?>',
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
				}, 500);

				$('.data-table').html(data);
				content_print.innerHTML = content.innerHTML;
			}
		});
	}

// Print Tabel
	function cetak() {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var table_non_print = document.getElementsByClassName('table_non_print')[1];
		var table_print = document.getElementsByClassName('table_print')[1];

		document.getElementById('tgl_print').value = document.getElementById('tgl2').value;
		document.getElementById('ipb_print').value = document.getElementById('no_ipb').value;

		non_printable.style.display = "none";
		printable.style.display = "";
		table_non_print.style.display = "none";
		table_print.style.display = "";
		window.print();

		non_printable.style.display = "";
		printable.style.display = "none";
		table_non_print.style.display = "";
		table_print.style.display = "none";
	}

</script>