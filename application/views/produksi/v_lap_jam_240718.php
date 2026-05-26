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
				<h3 class="card-title"><b><font color="White">Laporan Downtime Produksi</font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
							<table style="width: 1000px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="25%" colspan="2" class="filter">Periode Tanggal</th>
										<td></td>
										<th width="10%" class="filter">Desain</th>
										<td></td>
										<th width="10%" class="filter">Seri</th>
										<td></td>
										<th width="20%" class="filter">Nomor KK</th>
										<td></td>
										<th width="15%" class="filter">Proses</th>
										<td></td>
										<th class="filter">Nama Mesin</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select_min" id="fDesain" onchange="filter()" style="width: 100%;">
												<?php foreach($desain->result_array() as $dt) { ?>
													<option selected><?php echo $dt['DESAIN']; ?></option>				
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select_min" id="fSeri" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>	
												<?php foreach($seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fKk" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach($kk->result_array() as $dt) { ?>
													<option><?php echo $dt['NOMER']; ?></option>				
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select_min" id="fProses" onchange="isi_mesin(); filter();" style="width: 100%;">
												<?php foreach($proses->result_array() as $dt) { ?>
													<option><?php echo $dt['PROSES']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<div style="max-width: 200px;"><select class="select_min" id="fMesin" onchange="filter()" style="width: 100%;">
											</select></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card mt-2 table-responsive p-3" style="width: 100%; font-size: 13px;">
							<table id="data-table" class="table table-bordered table-striped" style="width:100%">
								<thead align="center">
									<tr>				
										<th width="10%">Tanggal</th>
										<th width="5%">Nomor KK</th>
										<th width="5%">Jam Efektif</th>
										<th width="5%">Jam Produksi</th>
										<?php foreach($jenis->result_array() as $dt) { ?>
											<th><?php echo ucwords(strtolower($dt['KODE'])) . '<br>' . ucwords(strtolower($dt['KETERANGAN'])); ?></th>						
										<?php } ?>
										<th width="5%">Hasil<br>(Meter)</th>
										<th width="5%">Speed</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot class="text-right text-bold">
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<?php foreach($jenis->result_array() as $dt) { ?>
											<td></td>						
										<?php } ?>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

					<div class="col-2 m-4">
						<button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
					</div>
				</div>
			</div>

			<div class="card-footer">
				<font color="Green" size="2">ERP @2019</font>
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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
	var get_filter = 1;

// Load Dokumen
	$(document).ready(function() {
		$('.fa-bars:eq(0)').click();
		$('.select').select2();
		$('.select_min').select2({minimumResultsForSearch: -1});
		$('.datepicker').datepicker({dateFormat: 'dd-M-yy'});
		isi_mesin();
		filter();
	});

// Pagination
	function pagination() {	
		var data_table = $('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"columnDefs": [{
				"orderable": false,
				"targets": "_all"
			}],
			"order": [],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Summary Data Downtime',
				title: ''
			}],
			"colReorder": true
		});

		setTimeout(function() {
			data_table.columns.adjust().draw();
		}, 1000);
	}

// Isi Data Summary Jam
	function filter() {
		var qty_kode = $('#data-table th').length-2;
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var desain = $('#fDesain').val();
		var kk = $('#fKk').val();
		var proses = $('#fProses').val();
		var mesin = $('#fMesin').val();
		var seri = $('#fSeri').val();
		var data = [tgl1, tgl2, desain, kk, proses, mesin, seri];

		if (get_filter == 0) {return;}
		$('#data-table').DataTable().destroy();
		$('#data-table tbody tr').remove();
		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/lap_jam/filter" ?>',
			success: function(data) {			
				var data = JSON.parse(data);
				var dt_tgl_prod = data[0];
				var dt_downtime = data[1];
				var dt_hasil_p = [];

				setTimeout(function() {
					$('#btnOk').click();

					for (var i=0; i<dt_tgl_prod.length; i++) {
						tgl = format_date(dt_tgl_prod[i].TGL);
						kk = dt_tgl_prod[i].KK.substring(0,3);
						prod = dt_tgl_prod[i].PROD == null ? '' : (desimal(dt_tgl_prod[i].PROD)/60).toFixed(2);
						hasil_e = dt_tgl_prod[i].HASIL == null ? 0 : (dt_tgl_prod[i].HASIL.split('@')[0]);
						hasil_p = dt_tgl_prod[i].HASIL == null ? 0 : (dt_tgl_prod[i].HASIL.split('@')[1]);
						hasil = proses == 'Pita' ? hasil_p : hasil_e;
						dt_hasil_p.push(hasil_e);

						$('#data-table tbody').append('<tr><td align="center">'+tgl+'</td><td align="center">'+kk+'</td><td align="center">'+prod+'</td><td align="center"></td>');
						for (var j=0; j<qty_kode-4; j++) {
							$('#data-table tbody tr:eq('+i+')').append('<td align="center"></td>');
						}
						$('#data-table tbody tr:eq('+i+')').append('<td align="center">'+format_number(hasil)+'</td><td align="center"></td>');
					}

					var qty_tgl = $('#data-table tr').length;

					for (var i=0; i<dt_downtime.length; i++) {
						t_kk = dt_downtime[i].KK.substring(0,3);
						t_kode = dt_downtime[i].KODE;
						t_tgl = format_date(dt_downtime[i].TGL);
						t_downtime = dt_downtime[i].DOWNTIME == null ? 0 : (desimal(dt_downtime[i].DOWNTIME)/60).toFixed(2);

						for (var j=4; j<qty_kode; j++) {
							kode = $('#data-table th:eq('+j+')').html().substring(0,1);

							for (var k=0; k<qty_tgl; k++) {
								tgl = $('#data-table tbody tr:eq('+k+') td:eq(0)').html();
								kk = $('#data-table tbody tr:eq('+k+') td:eq(1)').html();

								if (kode == t_kode && tgl == t_tgl && kk == t_kk && t_downtime != 0) {
									$('#data-table tbody tr:eq('+k+') td:eq('+j+')').html(t_downtime);
								}
							}
						}
					}

				// Isi Total Jam (Horizontal)
					for (var i=0; i<qty_tgl-2; i++) {
						dt_jam = 0;
						hasil = dt_hasil_p[i];
						jam_prod = $('#data-table tbody tr:eq('+i+') td:eq(2)').html();
						jam_persiapan = $('#data-table tbody tr:eq('+i+') td:eq(4)').html();
						jam_efektif = Number(jam_prod) + Number(jam_persiapan);
						speed = hasil == 0 ? '' : (Number(angka(hasil)) / jam_efektif / 60).toFixed(2);

						$('#data-table tbody tr:eq('+i+') td:eq(3)').html(jam_efektif.toFixed(2));
						$('#data-table tbody tr:eq('+i+') td:eq(15)').html(speed);
					}

				// Isi Total Jam (Vertikal)
					for (var i=2; i<qty_kode+2; i++) {
						dt_jam = 0;
						for (var j=0; j<qty_tgl-2; j++) {
							jam = $('#data-table tbody tr:eq('+j+') td:eq('+i+')').html();
							if (jam != '') {
								dt_jam = dt_jam + Number(angka(jam));
							}
						}
						qty_desimal = i != qty_kode ? 2 : 0;
						$('#data-table tfoot tr:eq(0) td:eq('+i+')').html(format_number(dt_jam.toFixed(qty_desimal)));
					}
					t_hasil = dt_hasil_p.reduce(function(dt_hasil_p, b) { return dt_hasil_p + Number(b); }, 0);;
					t_jam = angka($('#data-table tfoot tr:eq(0) td:eq(2)').html());
					t_speed = t_jam == 0 ? 0 : t_hasil / t_jam / 60;
					$('#data-table tfoot tr:eq(0) td:eq('+(qty_kode+1)+')').html(format_number(t_speed.toFixed(2)));

					pagination();
				}, 500);
			}
		});
	}

// Isi Mesin Berdasarkan Proses
	function isi_mesin() {
		var proses = $('#fProses').val();
		var dt_mesin = <?php echo json_encode($nama_mesin->result_array()); ?>;

		get_filter = 0;
		$("#fMesin").empty();
		for (var i=0; i<dt_mesin.length; i++) {
			t_proses = dt_mesin[i].PROSES;

			if (t_proses == proses) {
				$("#fMesin").append('<option>'+dt_mesin[i].NAMA_MESIN+'</option>');
				$('#fMesin').val(dt_mesin[i].NAMA_MESIN).change();
			}
		}

		var nama_mesin = $("#fMesin").val();
		if (nama_mesin == null) {$("#fMesin").val('').change();}
		get_filter = 1;
	}

</script>