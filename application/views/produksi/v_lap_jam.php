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
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NOMER']; ?></option>				
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
							<table id="tbl" class="table table-bordered table-striped" style="width:100%">
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
										<th width="5%">Speed (Mtr/Mnt)</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
								<tfoot class="text-center text-bold">
									<tr>
										<td colspan="2">Total</td>
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
		var data_table = $('#tbl').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
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

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Isi Data Summary Jam
	function filter() {
		var qty_kode = $('#tbl th').length-2;
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var desain = $('#fDesain').val();
		var kk = $('#fKk').val();
		var proses = $('#fProses').val();
		var mesin = $('#fMesin').val();
		var seri = $('#fSeri').val();
		var data = [tgl1, tgl2, desain, kk, proses, mesin, seri];

		if (get_filter == 0) {return;}
		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/lap_jam/filter" ?>',
				success: function(data) {			
					var data = JSON.parse(data);

					t_ef = 0, t_prod= 0, t_a = 0, t_b = 0, t_c = 0, t_d = 0, t_e = 0, t_f = 0, t_g = 0, t_h = 0, t_i = 0, t_j = 0, t_hasil = 0, t_hasil_e = 0;
					for (var i=0; i<data.length; i++) {
						kk = data[i].KK == null ? '' : data[i].KK.substring(0, 3);
						da = data[i].DA == null ? '' : (desimal(data[i].DA)/60).toFixed(2);
						db = data[i].DB == null ? '' : (desimal(data[i].DB)/60).toFixed(2);
						dc = data[i].DC == null ? '' : (desimal(data[i].DC)/60).toFixed(2);
						dd = data[i].DD == null ? '' : (desimal(data[i].DD)/60).toFixed(2);
						de = data[i].DE == null ? '' : (desimal(data[i].DE)/60).toFixed(2);
						df = data[i].DF == null ? '' : (desimal(data[i].DF)/60).toFixed(2);
						dg = data[i].DG == null ? '' : (desimal(data[i].DG)/60).toFixed(2);
						dh = data[i].DH == null ? '' : (desimal(data[i].DH)/60).toFixed(2);
						di = data[i].DI == null ? '' : (desimal(data[i].DI)/60).toFixed(2);
						dj = data[i].DJ == null ? '' : (desimal(data[i].DJ)/60).toFixed(2);
						
						if (proses == 'Sticker') {
							sticker = data[i].STICKER;
							efektif = sticker == null ? '' : (desimal(sticker.split('@')[0])/60).toFixed(2);
							hasil = sticker == null ? '' : sticker.split('@')[1];
						}else if (proses == 'Rewind 1' || proses == 'Rewind 2') {
							rewind = data[i].REWIND;
							efektif = rewind == null ? '' : (desimal(rewind.split('@')[0])/60).toFixed(2);
							hasil = rewind == null ? '' : rewind.split('@')[1];
						}else{
							efektif = data[i].EFEKTIF == null ? '' : (desimal(data[i].EFEKTIF)/60).toFixed(2);
							hasil_e = data[i].HASIL == null ? 0 : (data[i].HASIL.split('@')[0]);
							hasil_p = data[i].HASIL == null ? 0 : (data[i].HASIL.split('@')[1]);
							hasil = proses == 'Pita' ? hasil_p : hasil_e;
							speed_pita = hasil == 0 ? '' : (Number(angka(hasil_e)) / efektif / 60).toFixed(2);
						} 

						produksi = efektif == '' && da == '' ? '' : (Number(efektif) + Number(da)).toFixed(2);

						t_ef = t_ef + Number(efektif);
						t_prod = t_prod + Number(produksi);
						t_a = t_a + Number(da);
						t_b = t_b + Number(db);
						t_c = t_c + Number(dc);
						t_d = t_d + Number(dd);
						t_e = t_e + Number(de);
						t_f = t_f + Number(df);
						t_g = t_g + Number(dg);
						t_h = t_h + Number(dh);
						t_i = t_i + Number(di);
						t_j = t_j + Number(dj);
						t_hasil = t_hasil + Number(hasil);

						speed = hasil == 0 ? '' : (Number(angka(hasil)) / produksi / 60).toFixed(2);
						t_hasil_e = t_hasil_e + Number(hasil);

						// speed = proses == 'Pita' ? speed_pita : speed;
						// t_hasil_e = t_hasil_e + (proses == 'Pita' ? Number(hasil_e) : Number(hasil));

						$('#tbl tbody').append('<tr><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+kk+'</td><td align="center">'+efektif+'</td><td align="center">'+produksi+'</td><td align="center">'+da+'</td><td align="center">'+db+'</td><td align="center">'+dc+'</td><td align="center">'+dd+'</td><td align="center">'+de+'</td><td align="center">'+df+'</td><td align="center">'+dg+'</td><td align="center">'+dh+'</td><td align="center">'+di+'</td><td align="center">'+dj+'</td><td align="center">'+format_number(hasil)+'</td><td align="center">'+format_number(speed)+'</td></tr>');
					}

					t_speed = t_prod == 0 ? 0 : t_hasil_e / t_prod / 60;
					$('#tbl tfoot td:eq(1)').html(t_ef.toFixed(2));
					$('#tbl tfoot td:eq(2)').html(t_prod.toFixed(2));
					$('#tbl tfoot td:eq(3)').html(t_a.toFixed(2));
					$('#tbl tfoot td:eq(4)').html(t_b.toFixed(2));
					$('#tbl tfoot td:eq(5)').html(t_c.toFixed(2));
					$('#tbl tfoot td:eq(6)').html(t_d.toFixed(2));
					$('#tbl tfoot td:eq(7)').html(t_e.toFixed(2));
					$('#tbl tfoot td:eq(8)').html(t_f.toFixed(2));
					$('#tbl tfoot td:eq(9)').html(t_g.toFixed(2));
					$('#tbl tfoot td:eq(10)').html(t_h.toFixed(2));
					$('#tbl tfoot td:eq(11)').html(t_i.toFixed(2));
					$('#tbl tfoot td:eq(12)').html(t_j.toFixed(2));
					$('#tbl tfoot td:eq(13)').html(format_number(t_hasil.toFixed(0)));
					$('#tbl tfoot td:eq(14)').html(t_speed.toFixed(2));

					setTimeout(function() {
						pagination();
						$('#btnOk').click();
					}, 500);
				}
			});
		}, 500); // End Ajax
	} // End Filter

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

		if ($("#fMesin").val() == null) {$("#fMesin").val('').change();}
		get_filter = 1;
	}

</script>