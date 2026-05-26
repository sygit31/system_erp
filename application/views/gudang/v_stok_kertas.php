<?php $this->load->view('dashboard/header'); ?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<!-- Barcode Creator -->
<style> body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #000 !important;} .bg-blue {background-color: #12389A; color: #FFFFFF;}</style>

<div class="p-1">
	<div class="card card-dark m-4">
		<div class="card-header font-weight-bold p-3">
			<div class="text-center" style="margin: auto;">
				<div id="desain" style="font-size: 32px; margin-top: -15px; cursor: pointer;" title="Klik untuk mengubah DESAIN..">DASHBOARD STOK KERTAS DESAIN <?php echo date('Y'); ?></div>
				<div class="mt-2 periode">
					<select class="select" id="bulan" onchange="filter('');" style="width: 110px;">
						<?php for ($i=0; $i<12; $i++) { ?>
							<option <?php if (date('M') == date('M', strtotime(($i+1) .'/01/2022'))) {echo 'selected';} ?>><?php echo date('M', strtotime(($i+1) .'/01/2022')); ?></option>
						<?php } ?>
					</select>
					<?php $years = range(date('Y', strtotime('-4 years')), date('Y', strtotime('+1 month'))); ?>
					<select class="select" id="tahun" onchange="filter('');" style="width: 130px;">
						<?php foreach ($years as $dt) { ?>
							<option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
						<?php } ?>
					</select>
					<select class="select" id="tgl" onchange="filter('');" style="width: 160px;">
						<option value="01">Mid Month 1</option>
						<option value="16" <?php if (date('d') > 15) {echo 'selected';} ?>>Mid Month 2</option>
					</select>
				</div>
			</div>
		</div>
		<div class="card-body row" style="margin-top: -15px;">
			<div class="col-md-4">
				<div class="card bg-danger">
					<div class="table-responsive text-center font-weight-bold p-1" style="overflow: hidden;">
						<div class="row">
							<div class="col-md-3" style="font-size: 36px; margin-bottom: -10px;">
								<div class="card bg-danger m-2" style="height: 70px; width: 120px;">
									<font style="font-size: 20px; margin-bottom: -10px;">UK.</font><font>73</font>
								</div>
							</div>
							<div class="col-md-9 mt-1">
								<div id="saldo_awal_73" style="font-size: 22px;">Saldo Awal : 0 Kg</div>
								<div id="saldo_akhir_73" style="font-size: 34px;">Saldo Akhir : 0 Kg</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-blue">
					<div class="table-responsive text-center font-weight-bold p-1" style="overflow: hidden;">
						<div class="row">
							<div class="col-md-3" style="font-size: 36px; margin-bottom: -10px;">
								<div class="card bg-blue m-2" style="height: 70px; width: 120px;">
									<font style="font-size: 20px; margin-bottom: -10px;">UK.</font><font>52,5</font>
								</div>
							</div>
							<div class="col-md-9 mt-1">
								<div id="saldo_awal_52" style="font-size: 22px;">Saldo Awal : 0 Kg</div>
								<div id="saldo_akhir_52" style="font-size: 34px;">Saldo Akhir : 0 Kg</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-warning">
					<div class="table-responsive text-center font-weight-bold p-1" style="overflow: hidden;">
						<div class="row">
							<div class="col-md-3" style="font-size: 36px; margin-bottom: -10px;">
								<div class="card bg-warning m-2" style="height: 70px; width: 120px;">
									<font style="font-size: 20px; margin-bottom: -10px;">UK.</font><font>34,5</font>
								</div>
							</div>
							<div class="col-md-9 mt-1">
								<div id="saldo_awal_34" style="font-size: 22px;">Saldo Awal : 0 Kg</div>
								<div id="saldo_akhir_34" style="font-size: 34px;">Saldo Akhir : 0 Kg</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card card-body bg-dark table-responsive" style="margin-top: -5px; white-space: nowrap; font-size: 14px;">
				<div class="row">
					<div class="col-sm-4" style="margin-top: -10px;">
						<table id="tbl_73" class="table-bordered table-striped bg-light tbl" style="margin-left: 0;" width="100%">
							<thead style="text-align: center; line-height: 42px;">
								<tr class="bg-danger">
									<th>Tanggal</th>
									<th>Masuk</th>
									<th>Keluar</th>
									<th>Reject</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody style="text-align: center; line-height: 32px;"></tbody>
							<tfoot style="text-align: center; line-height: 32px;">
								<tr class="bg-danger">
									<th>Total</th>
									<th style="font-size: 18px;"></th>
									<th style="font-size: 18px;"></th>
									<th style="font-size: 18px;"></th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="col-sm-4" style="margin-top: -10px;">
						<table id="tbl_52" class="table-bordered table-striped bg-light tbl" style="margin-left: 0;" width="100%">
							<thead style="text-align: center; line-height: 42px;">
								<tr class="bg-blue">
									<th>Masuk</th>
									<th>Keluar</th>
									<th>Reject</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody style="text-align: center; line-height: 32px;"></tbody>
							<tfoot style="text-align: center; line-height: 32px;">
								<tr class="bg-blue">
									<th style="font-size: 18px;"></th>
									<th style="font-size: 18px;"></th>
									<th style="font-size: 18px;"></th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="col-sm-4" style="margin-top: -10px;">
						<table id="tbl_34" class="table-bordered table-striped bg-light tbl" style="margin-left: 0;" width="100%">
							<thead style="text-align: center; line-height: 42px;">
								<tr class="bg-warning">
									<th>Masuk</th>
									<th>Keluar</th>
									<th>Reject</th>
									<th>Saldo</th>
								</tr>
							</thead>
							<tbody style="text-align: center; line-height: 32px;"></tbody>
							<tfoot style="text-align: center; line-height: 32px;">
								<tr class="bg-warning">
									<th style="font-size: 18px;"></th>
									<th style="font-size: 18px;"></th>
									<th style="font-size: 18px;"></th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="col font-weight-bold">
				<div id="time" class="float-right text-dark blink" style="font-size: 18px; margin-top: -10px;">
					<?php echo date('h:i:s'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress" style="top: 30%;">
	<div class="modal-dialog modal-lg text-center" style="font-size: 40px; color: #FFF; font-weight: bold;">
		<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
		<!-- <div class="f11">Tekan F11 untuk start Full Screen..</div> -->
		<div class="modal-footer" hidden>
			<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
		</div>
	</div>
</div>

<!-- Ubah Desain -->
<div class="modal fade" id="modal_desain">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 28px; color: #D00101; font-weight: bold;"> Masukkan Desain : </div>
			<div class="modal-footer">
				<table width="100%">
					<tr>
						<th width="45%">Desain</th>
						<td width="55%">
							<select class="select" id="e_desain" style="width: 100%;">
								<?php foreach ($years as $dt) { ?>
									<option selected><?php echo $dt; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button id="ubah_desain" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>OK</b></button>
				<button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>Cancel</b></button>
				<button id="btn_desain" data-toggle="modal" data-target="#modal_desain" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=3"></script>

<script>

// Defined Variable
	var serverTime = new Date(new Date().getTime() + 7 * 60 * 60 * 1000), desain = $('#desain').html().substring($('#desain').html().length-4, $('#desain').html().length), terima = 0.1, bon = 0.1;
	var masuk_awal = 0, keluar_awal = 0;

// Update Jam
	function updateTime() {
		serverTime = new Date(serverTime.getTime() + 1000);
		second = new Date(serverTime).getSeconds();
		$('#time').html(serverTime.toGMTString().substring(0, (serverTime.toGMTString()).length-4));

		if (second == 59) {filter('time');}
	}

// Load Dokumen
	$(document).ready(function() {
		$('.select').select2({minimumResultsForSearch: -1});
		$('.datepicker').datepicker({ dateFormat: 'dd-M-yy' });
		filter('');

		updateTime();
		setInterval(updateTime, 1000);
	});

// Ubah Desain
	$('#desain').click(function() {
		$('#btn_desain').click();
	});
	$('#ubah_desain').click(function() {
		var desain = $('#e_desain').val();

		$('#desain').html('DASHBOARD STOK KERTAS DESAIN ' + desain);
		filter('');
	});

// Filter Data
	function filter(str) {
		var now = <?php echo json_encode(date('d-M-Y')); ?>;
		console.log(now);
		var tgl = $('#tgl').val();
		var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		var desain = $('#e_desain').val();
		var data = [bulan, tahun, desain, tgl];

		if (str == '') {$('#btnProgress').click(); $('.tbl tbody tr').remove();}
		$.ajax({
			type: 'POST',
			url:'<?php echo base_url(); ?>index.php/gudang/stok_kertas/filter',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);

				t_masuk_73 = 0, t_keluar_73 = 0, t_reject_73 = 0, t_masuk_52 = 0, t_keluar_52 = 0, t_reject_52 = 0, t_masuk_34 = 0, t_keluar_34 = 0, t_reject_34 = 0;
				s_akhir_73 = (Number(data[0].MASUK_AWAL_A.replace(',','.')) - Number(data[0].KELUAR_AWAL_A.replace(',','.')) - Number(data[0].REJECT_AWAL_A.replace(',','.'))).toFixed(2);
				s_akhir_52 = (Number(data[0].MASUK_AWAL_B.replace(',','.')) - Number(data[0].KELUAR_AWAL_B.replace(',','.')) - Number(data[0].REJECT_AWAL_B.replace(',','.'))).toFixed(2);
				s_akhir_34 = (Number(data[0].MASUK_AWAL_C.replace(',','.')) - Number(data[0].KELUAR_AWAL_C.replace(',','.')) - Number(data[0].REJECT_AWAL_C.replace(',','.'))).toFixed(2);

				if (str == 'time') {
					if (masuk_awal == Number(data[0].MASUK_AWAL.replace(',','.')) && keluar_awal == Number(data[0].KELUAR_AWAL.replace(',','.'))) {
						return;
					}else{
						$('#btnProgress').click();
						$('.tbl tbody tr').remove();
					}
				}

				masuk_awal = Number(data[0].MASUK_AWAL.replace(',','.'));
				keluar_awal = Number(data[0].KELUAR_AWAL.replace(',','.'));

				$('#saldo_awal_73').html('Saldo Awal : ' + format_number(s_akhir_73)) + ' Kg';
				$('#saldo_awal_52').html('Saldo Awal : ' + format_number(s_akhir_52)) + ' Kg';
				$('#saldo_awal_34').html('Saldo Awal : ' + format_number(s_akhir_34)) + ' Kg';

				for (var i=0; i<data.length; i++) {
					masuk_73 = data[i].MASUK_A == 0 ? '' : Number(data[i].MASUK_A.replace(',','.'));
					keluar_73 = data[i].KELUAR_A == 0 ? '' : Number(data[i].KELUAR_A.replace(',','.'));
					reject_73 = data[i].REJECT_A == 0 ? '' : Number(data[i].REJECT_A.replace(',','.'));
					s_akhir_73 = (Number(s_akhir_73) + Number(masuk_73) - Number(keluar_73) - Number(reject_73)).toFixed(2);

					t_masuk_73 = (Number(t_masuk_73) + Number(masuk_73)).toFixed(2);
					t_keluar_73 = (Number(t_keluar_73) + Number(keluar_73)).toFixed(2);
					t_reject_73 = (Number(t_reject_73) + Number(reject_73)).toFixed(2);

					b_73 = 'class="bg-danger" style="font-size: 18px; font-weight: bold;"';
					m_73 = masuk_73 == '' ? '' : b_73;
					k_73 = keluar_73 == '' ? '' : b_73;
					r_73 = reject_73 == '' ? '' : b_73;
					s_73 = b_73;

					$('#tbl_73 tbody').append('<tr><td style="font-style: italic;">'+format_date(data[i].TGL)+'</td><td '+m_73+'>'+format_number(masuk_73)+'</td><td '+k_73+'">'+format_number(keluar_73)+'</td><td '+r_73+'>'+format_number(reject_73)+'</td><td '+s_73+'>'+format_number(s_akhir_73)+'</td></tr>');


					masuk_52 = data[i].MASUK_B == 0 ? '' : Number(data[i].MASUK_B.replace(',','.'));
					keluar_52 = data[i].KELUAR_B == 0 ? '' : Number(data[i].KELUAR_B.replace(',','.'));
					reject_52 = data[i].REJECT_B == 0 ? '' : Number(data[i].REJECT_B.replace(',','.'));
					s_akhir_52 = (Number(s_akhir_52) + Number(masuk_52) - Number(keluar_52) - Number(reject_52)).toFixed(2);

					t_masuk_52 = (Number(t_masuk_52) + Number(masuk_52)).toFixed(2);
					t_keluar_52 = (Number(t_keluar_52) + Number(keluar_52)).toFixed(2);
					t_reject_52 = (Number(t_reject_52) + Number(reject_52)).toFixed(2);

					b_52 = 'class="bg-blue" style="font-size: 18px; font-weight: bold;"';
					m_52 = masuk_52 == '' ? '' : b_52;
					k_52 = keluar_52 == '' ? '' : b_52;
					r_52 = reject_52 == '' ? '' : b_52;
					s_52 = b_52;

					$('#tbl_52 tbody').append('<tr><td '+m_52+'>'+format_number(masuk_52)+'</td><td '+k_52+'">'+format_number(keluar_52)+'</td><td '+r_52+'>'+format_number(reject_52)+'</td><td '+s_52+'>'+format_number(s_akhir_52)+'</td></tr>');


					masuk_34 = data[i].MASUK_C == 0 ? '' : Number(data[i].MASUK_C.replace(',','.'));
					keluar_34 = data[i].KELUAR_C == 0 ? '' : Number(data[i].KELUAR_C.replace(',','.'));
					reject_34 = data[i].REJECT_C == 0 ? '' : Number(data[i].REJECT_C.replace(',','.'));
					s_akhir_34 = (Number(s_akhir_34) + Number(masuk_34) - Number(keluar_34) - Number(reject_34)).toFixed(2);

					t_masuk_34 = (Number(t_masuk_34) + Number(masuk_34)).toFixed(2);
					t_keluar_34 = (Number(t_keluar_34) + Number(keluar_34)).toFixed(2);
					t_reject_34 = (Number(t_reject_34) + Number(reject_34)).toFixed(2);

					b_34 = 'class="bg-warning" style="font-size: 18px; font-weight: bold;"';
					m_34 = masuk_34 == '' ? '' : b_34;
					k_34 = keluar_34 == '' ? '' : b_34;
					r_34 = reject_34 == '' ? '' : b_34;
					s_34 = b_34;

					$('#tbl_34 tbody').append('<tr><td '+m_34+'>'+format_number(masuk_34)+'</td><td '+k_34+'">'+format_number(keluar_34)+'</td><td '+r_34+'>'+format_number(reject_34)+'</td><td '+s_34+'>'+format_number(s_akhir_34)+'</td></tr>');
				}

				$('#tbl_73 tfoot th:eq(1)').html(format_number(t_masuk_73));
				$('#tbl_73 tfoot th:eq(2)').html(format_number(t_keluar_73));
				$('#tbl_73 tfoot th:eq(3)').html(format_number(t_reject_73));

				$('#tbl_52 tfoot th:eq(0)').html(format_number(t_masuk_52));
				$('#tbl_52 tfoot th:eq(1)').html(format_number(t_keluar_52));
				$('#tbl_52 tfoot th:eq(2)').html(format_number(t_reject_52));

				$('#tbl_34 tfoot th:eq(0)').html(format_number(t_masuk_34));
				$('#tbl_34 tfoot th:eq(1)').html(format_number(t_keluar_34));
				$('#tbl_34 tfoot th:eq(2)').html(format_number(t_reject_34));

				$('#saldo_akhir_73').html('Saldo Akhir : ' + format_number(s_akhir_73)) + ' Kg';
				$('#saldo_akhir_52').html('Saldo Akhir : ' + format_number(s_akhir_52)) + ' Kg';
				$('#saldo_akhir_34').html('Saldo Akhir : ' + format_number(s_akhir_34)) + ' Kg';

				setTimeout(function() {$('#btnOk').click();}, 1500);	
			}
		});
	} // End Filter

</script>