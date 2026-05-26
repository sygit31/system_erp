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
		<div class="card <?php if ($kd_unit == '12') {echo "card-info";}else{echo 'card-danger';} ?>">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Monitoring Proses Produksi</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus info_1"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive ml-2 mb-3">
							<table style="width: 1100px; margin-bottom: 10px; font-size: 13px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<?php $bg =  $kd_unit == '12' ? 'bg-info' : 'bg-danger'; ?>
										<td width="22.5%" colspan="2" class="filter <?php echo $bg; ?>">Filter Tanggal</td>
										<td></td>
										<td width="10%" class="filter <?php echo $bg; ?>">Desain</td>
										<td></td>
										<td width="10%" class="filter <?php echo $bg; ?>">Tipe</td>
										<td></td>
										<td width="12.5%" class="filter <?php echo $bg; ?>">Tahap</td>
										<td></td>
										<td width="17.5%" class="filter <?php echo $bg; ?>">Nomor KP</td>
										<td></td>
										<td width="10%" class="filter <?php echo $bg; ?>">Quality</td>
										<td></td>
										<td width="17.5%" class="filter <?php echo $bg; ?>">Nama Produk</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
										<td><input id="fTgl2" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
												<?php foreach ($tahun->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fTipe" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option>Produksi</option>
												<option>Proof</option>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fTahap" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option>All</option>
												<option>Silver</option>
												<option>Matrix</option>
												<option>Madle</option>
												<option>PCH</option>
											</select>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari.." style="width: 100%;"></td>
										<td></td>
										<td>
											<select class="select" id="fQuality" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option>All</option>
												<option>Baik</option>
												<option>Reject</option>
											</select>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="fNama" autocomplete="off" onchange="filter()" placeholder="Cari.." style="width: 100%;"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="data-table"></div>

						<div class="card-footer">
							<button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success ml-2" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
						</div>
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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
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

// Load Dokumen
	$(document).ready(function() {
		if ($(window).width() > 960) {$('.fa-bars:eq(0)').click();}
		$(".select").select2();
		$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
		filter();
	});

// Pagination
	function pagination() {    
		$('#data-table').DataTable().destroy();
		var data_table = $('#data-table').DataTable( {
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari  :"},
			"order": [[ 0, "asc" ]],
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "350px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Data Proses Galvanik',
				title: ''
			}],
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

	function filter() {
		var kd_unit = <?php echo json_encode($kd_unit); ?>;
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var desain = document.getElementById('fDesain').value;
		var tipe = document.getElementById('fTipe').value;
		var tahap = document.getElementById('fTahap').value;
		var cari = document.getElementById('cari').value;
		var quality = document.getElementById('fQuality').value;
		var nama = document.getElementById('fNama').value;
		var data = [kd_unit, tgl1, tgl2, desain, tipe, tahap, cari, quality, nama];

		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url()."index.php/galvanik/proses/filter" ?>',
				success: function(data) {
					$('.data-table').html(data);

					setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
				}
			}); 
		}, 300);
	}

// Expands & Collapse Card Info
	var info_1 = 0;
	$('.info_1:eq(0)').on('click', function() {
		if (info_1 == 0) {
			$('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
			info_1 = 1;
		} else {
			$('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
			info_1 = 0;
		}
	});

</script>