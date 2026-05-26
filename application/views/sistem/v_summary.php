

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<div id="non_printable" class="content-wrapper" style="display: block;">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Data Project Holografi</font></b>
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

							<table style="width: 50%; margin-bottom: 10px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<td width="35%" class="filter">Periode</td>
										<td></td>
										<td width="65%" class="filter">Nama Karyawan</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<select class="select" id="fPeriode" onchange="filter()" style="width: 100%;">
												<option>All</option>
												<option>2017</option>
												<option>2018</option>
												<option>2019</option>
												<option>2020</option>
											</select>
										</td>
										<td></td>
										<td>
											<?php $id_kary = array(); ?>
											<select class="select" id="fKaryawan" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option value="All">Pilih Karyawan..</option>
												<?php foreach ($karyawan->result_array() as $dt) { ?>
													<option><?php echo $dt['NAMA']; ?></option>
													<?php array_push($id_kary, $dt['ID']); ?>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>

							<?php $this->load->view('sistem/v_summary_table'); ?>			

						</font>
					</div>
				</div>
			</div>
			<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
		</div>

		<!-- Modal Rincian Project -->
		<div class="modal fade" id="modal_rincian" style="z-index: 9999;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div id="content_print">
						<h1 id="judul_hlm" class="modal-header" style="color: #FEFEFE; background-color: #0F999B; line-height: 50px; border-radius: 5px; padding-left: 10px; margin: 5px;">Rincian Project</h1>
						<h1 id="periode_judul" class="modal-header">Periode</h1>

						<table id="tbl_detail" class="table table-bordered table-striped" style="font-size: 14px; width: 99%; margin: 5px;">
							<thead style="text-align: center;">
								<tr>
									<th width="5%">No.</th>
									<th width="10%">No. Project</th>
									<th width="10%">Tanggal</th>
									<th width="15%">Nama Project</th>
									<th width="10%">Nilai</th>
									<th width="15%">PIC</th>
									<th width="15%">Tugas</th>
									<th width="10%">Deadline</th>
									<th width="10%">Finish</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>

					</div>
					<div class="modal-footer mt-2">
						<button id="btnTutup" style="width: 20%;" class="btn btn-primary" data-dismiss="modal">Tutup</button>
						<button id="btnRincian" data-toggle="modal" data-target="#modal_rincian" hidden></button>
					</div>
				</div>
			</div>
		</div>

	</section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
	$(".select").select2(); // Combo Live Search
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

// Pagination Detail
function pagination_detail() {
	$('#tbl_detail').DataTable().destroy();
	$('#tbl_detail').DataTable( {
		"paging": true,
		"lengthChange": false,
		"pageLength": 10,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": true
	});
}

// Filter Tabel
function filter() {
	var periode = document.getElementById('fPeriode').value;
	var id_kary = <?php echo json_encode($id_kary); ?>;
	var index = document.getElementById('fKaryawan').selectedIndex - 1;
	id_kary = id_kary[index];
	if (index == -1) {id_kary = 'All';}
	var data = [periode,id_kary];

	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/sistem/summary_project/filter" ?>',
		success: function(data) {
			$('.data-table').html(data);
			pagination();
		}
	});
}

// Show Modal
function pic_project(btn) {
	var table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	var id = table.rows[row].cells[0].innerHTML;
	var periode = document.getElementById('fPeriode').value;
	var nama_pic = table.rows[row].cells[2].innerHTML;
	var data = [id, periode];

	document.getElementById('judul_hlm').innerHTML = 'Rincian Project ' + nama_pic;
	document.getElementById('periode_judul').innerHTML = 'Periode ' + periode;

	$('#tbl_detail').DataTable().destroy();
	$("#tbl_detail").find("tr:gt(0)").remove();

	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/sistem/summary_project/summary_pic" ?>',
		success: function(data) {
			data = JSON.parse(data);
			show_detail(data);

			$("#btnRincian").click();
			pagination_detail();
		}
	});

	function show_detail(data) {
		var tbl_detail = document.getElementById('tbl_detail');

		for (var i=0; i<data.length; i++) {
			$('#tbl_detail').append(
				'<tr><td align="center"></td><td align="center"></td><td align="center"></td><td></td><td align="center"></td><td></td><td></td><td align="center"></td><td align="center"></td></tr>')
		}

		var nmr_project = '', qty = 1;
		for (var i=0; i<data.length; i++) {

			if (nmr_project == data[i]['NMR']) {
				urut = '';
				nmr = '';
				tgl = '';
				nama = '';
				nilai = '';
			}else{
				urut = qty++;
				nmr = data[i]['NMR'];
				tgl = data[i]['TGL'];
				nama = data[i]['NAMA'];
				nilai = Number(data[i]['NILAI']).toFixed(2);
			}
			if (nilai == 0) {nilai = '';}
			
			nmr_project = data[i]['NMR'];
			pic = data[i]['PIC'];
			tugas = data[i]['TUGAS'];
			deadline = data[i]['MAX_DATE'];
			finish = data[i]['FINISH'];

			tbl_detail.rows[i+1].cells[0].innerHTML = urut;
			tbl_detail.rows[i+1].cells[1].innerHTML = nmr;
			tbl_detail.rows[i+1].cells[2].innerHTML = format_date(tgl);
			tbl_detail.rows[i+1].cells[3].innerHTML = nama;
			tbl_detail.rows[i+1].cells[4].innerHTML = nilai;
			tbl_detail.rows[i+1].cells[5].innerHTML = pic;
			tbl_detail.rows[i+1].cells[6].innerHTML = tugas;
			tbl_detail.rows[i+1].cells[7].innerHTML = format_date(deadline);
			tbl_detail.rows[i+1].cells[8].innerHTML = format_date(finish);
		}
	}

	function format_date(num) {
		if (num == null || num == '') {return '';}

		var date = num.substring(0, 2);
		var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var month = dt_month[parseInt(num.substring(3, 5))-1];
		var year = num.substring(6, 10);
		return date + '-' + month + '-' + year;
	}
}

</script>