<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Monitoring Stok PCH</font>
					</b>
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
							<div class="table-responsive">
								<table style="width: 500px; margin-bottom: 10px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<td width="50%" colspan="2" class="filter">Filter Tanggal</td>
											<td></td>
											<td width="50%" class="filter">Produk</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<?php $tgl = date('Y-m-01', strtotime('-0 days')); ?>
											<?php $minDate = date('Y-m-d', strtotime('10/01/2020')); ?>
											<?php if ($tgl < $minDate) {
												$tgl = $minDate;
											} ?>

											<td><input id="fTgl1" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime($tgl)); ?>" onchange="filter()" autocomplete="off" readonly></td>
											<td><input id="fTgl2" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
											<td></td>
											<td>
												<div style="width: 250px;"><select class="select" id="fProduk" onchange="filter()" style="width: 100%;">
													<?php foreach ($produk->result_array() as $dt) { ?>
														<option><?php echo $dt['NAMA']; ?></option>
													<?php } ?>
												</select></div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="data-table">
								<table id="data-table" class="table table-bordered table-striped" width="100%">
									<thead>
										<tr align="center">
											<th rowspan="3">Tanggal</th>
											<th colspan="3">Saldo Awal</th>
											<th colspan="3">Masuk</th>
											<th colspan="4">Keluar</th>
											<th colspan="3">Saldo Akhir</th>
										</tr>
										<tr align="center">
											<th rowspan="2">Baik</th>
											<th rowspan="2">Reject</th>
											<th rowspan="2">Ex. Emboss</th>
											<th colspan="2">Hasil E.F</th>
											<th rowspan="2">Ex. Emboss</th>
											<th rowspan="2">Bon Emboss</th>
											<th colspan="3">Pemusnahan</th>
											<th rowspan="2">Baik</th>
											<th rowspan="2">Reject</th>
											<th rowspan="2">Ex. Emboss</th>
										</tr>
										<tr align="center">
											<th>Baik</th>
											<th>Reject</th>
											<th>Baik</th>
											<th>Reject</th>
											<th style="border-right: 1px solid #D0D0D5;">Ex. Emboss</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<table>
								<tr>
									<td width="120"><button type="button" id="btn_excel" class="btn btn-block btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
								</tr>
							</table>

						</font>
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
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;">
				<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
				<font style="position: relative; top: -30px;"><b>Menghitung..</b></font>
			</div>
			<div class="modal-footer" hidden>
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>

<script>

// Export To Excel
	function XLExport(tableId) {
		var tab_text = "<table border='1px'><tr>";
		var tab = document.getElementById(tableId);
		for (j=0; j<tab.rows.length; j++) {
			tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
		}

		tab_text = tab_text + "</table>";
		sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
		return (sa);
	}
	$('#btn_excel').click(function() {
		$('#data-table').DataTable().destroy();
		XLExport('data-table');
		pagination();
	});

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy',
			minDate: new Date('<?php echo $minDate; ?>')
		});
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy'
		});

		filter();
	});

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		var data_table = $('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {
					columns: ':visible'
				},
				className: 'excel invisible',
				title: 'REKAPITULASI PLAT CETAK HOLOGRAM'
			}],
			"colReorder": true,
			"columnDefs": [{
				"orderable": false,
				"targets": "_all"
			}],
			"order": []
		});

		setTimeout(function() {
			data_table.columns.adjust().draw();
		}, 500);
	}

// Filter Data
	function filter() {
		var dt_id = <?php echo json_encode($produk->result_array()); ?>;
		var index = document.getElementById("fProduk").selectedIndex;
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var id = dt_id[index].ID;
		var data = [tgl1, tgl2, id];

		$('#btnProgress').click();
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/galvanik/pch/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);

				setTimeout(function() {
					isi_data(data);
					isi_saldo_akhir();
					isi_total();
					pagination();

					$('#btnOk').click();
				}, 500);
			}
		});
	}

// Isi Data Neraca
	function isi_data(data) {
		$('#data-table').DataTable().destroy();
		$("#data-table tbody").find("tr").remove();
		$("#data-table tfoot").remove();
		for (var i=0; i<data.length; i++) {
			saldo_awal_baik = Number(data[i].GDG_AWAL) + Number(data[i].EF_BAIK_AWAL) - Number(data[i].IPB_AWAL);
			saldo_awal_reject = Number(data[i].EF_REJECT_AWAL) - Number(data[i].MUSNAH_REJECT_AWAL);
			saldo_awal_emboss = Number(data[i].EX_EMBOSS_AWAL) - Number(data[i].MUSNAH_EMBOSS_AWAL);
			musnah_baik = Number(data[i].MUSNAH_BAIK) - Number(data[i].MUSNAH_EMBOSS);

			$('#data-table tbody').append('<tr><td align="center">' + format_tgl(data[i].DT) + '</td><td align="center" class="bg-success" style="font-size: 14px;">' + saldo_awal_baik + '</td><td align="center">'+ saldo_awal_reject +'</td><td align="center">'+ saldo_awal_emboss +'</td><td align="center">'+ data[i].EF_BAIK +'</td><td align="center">'+ data[i].EF_REJECT +'</td><td align="center">'+ data[i].EX_EMBOSS +'</td><td align="center">'+ data[i].IPB +'</td><td align="center">'+ musnah_baik +'</td><td align="center">'+ data[i].MUSNAH_REJECT +'</td><td align="center">'+ data[i].MUSNAH_EMBOSS +'</td><td align="center" class="bg-success" style="font-size: 14px;"></td><td align="center"></td><td align="center"></td></tr>');
		}
	}

	function isi_saldo_akhir() {
		var data_table = document.getElementById('data-table');

		for (var i=3; i<data_table.rows.length; i++) {
			sa_baik = data_table.rows[i].cells[1].innerText;
			sa_reject = data_table.rows[i].cells[2].innerText;
			sa_emboss = data_table.rows[i].cells[3].innerText;
			ef_baik = data_table.rows[i].cells[4].innerText;
			ef_reject = data_table.rows[i].cells[5].innerText;
			ex_emboss = data_table.rows[i].cells[6].innerText;
			ipb = data_table.rows[i].cells[7].innerText;
			musnah_baik = data_table.rows[i].cells[8].innerText;
			musnah_reject = data_table.rows[i].cells[9].innerText;
			musnah_emboss = data_table.rows[i].cells[10].innerText;

			sa_baik = Number(sa_baik) + Number(ef_baik) - Number(ipb) - Number(musnah_baik);
			sa_reject = Number(sa_reject) + Number(ef_reject) - Number(musnah_reject);
			sa_emboss = Number(sa_emboss) + Number(ex_emboss) - Number(musnah_emboss);

			data_table.rows[i].cells[11].innerText = sa_baik;
			data_table.rows[i].cells[12].innerText = sa_reject;
			data_table.rows[i].cells[13].innerText = sa_emboss;

			if (i+1 < data_table.rows.length) {data_table.rows[i+1].cells[1].innerText = sa_baik;}
			if (i+1 < data_table.rows.length) {data_table.rows[i+1].cells[2].innerText = sa_reject;}
			if (i+1 < data_table.rows.length) {data_table.rows[i+1].cells[3].innerText = sa_emboss;}
		}
	}

	function isi_total() {
		var data_table = document.getElementById('data-table');
		var ef_baik = 0, ef_reject = 0, ex_emboss = 0, ipb = 0, musnah_baik = 0, musnah_reject = 0, musnah_emboss = 0;

		for (var i=3; i<data_table.rows.length; i++) {
			t_ef_baik = Number(data_table.rows[i].cells[4].innerText);
			t_ef_reject = Number(data_table.rows[i].cells[5].innerText);
			t_ex_emboss = Number(data_table.rows[i].cells[6].innerText);
			t_ipb = Number(data_table.rows[i].cells[7].innerText);
			t_musnah_baik = Number(data_table.rows[i].cells[8].innerText);
			t_musnah_reject = Number(data_table.rows[i].cells[9].innerText);
			t_musnah_emboss = Number(data_table.rows[i].cells[10].innerText);

			ef_baik = ef_baik + t_ef_baik;
			ef_reject = ef_reject + t_ef_reject;
			ex_emboss = ex_emboss + t_ex_emboss;
			ipb = ipb + t_ipb;
			musnah_baik = musnah_baik + t_musnah_baik;
			musnah_reject = musnah_reject + t_musnah_reject;
			musnah_emboss = musnah_emboss + t_musnah_emboss;
		}

		$('#data-table').append('<tfoot><tr><td></td><td></td><td></td><td></td><td align="center">'+ ef_baik +'</td><td align="center">'+ ef_reject +'</td><td align="center">'+ ex_emboss +'</td><td align="center">'+ ipb +'</td><td align="center">'+ musnah_baik +'</td><td align="center">'+ musnah_reject +'</td><td align="center">'+ musnah_emboss +'</td><td></td><td></td><td></td></tfoot></tr>');
		for (var i=0; i<$('#data-table tfoot td').length; i++) {
			if ($('#data-table tfoot td:eq('+i+')').html() != '') {
				$('#data-table tfoot td:eq('+i+')').addClass('bg-secondary').css('font-size', '14px');
			}
		}
	}

// Ubah Format Tanggal
	function format_tgl(date) {
		var tgl = date.substring(4, 6);
		var month = parseInt(date.substring(2, 4)) - 1;
		var thn = date.substring(0, 2);
		var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

		return tgl + '-' + bln[month] + '-' + thn;
	}

</script>