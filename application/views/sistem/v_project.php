

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
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/help_project')"><i class="fa fa-binoculars" title="Help"></i></button>
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
										<td width="25%" class="filter">Periode</td>
										<td></td>
										<td width="25%" class="filter">Status</td>
										<td></td>
										<td width="50%" class="filter">Nama Project atau PIC</td>
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
											<select class="select" id="fStatus" onchange="filter()" style="width: 100%;">
												<option>All</option>
												<option selected>Open</option>
												<option>Close</option>
											</select>
										</td>
										<td></td>
										<td>
											<input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama project atau PIC.." style="width: 100%;" autocomplete="off"></td>
										</td>
									</tr>
								</tbody>
							</table>

							<div style="overflow-x: auto;">
								<?php $this->load->view('sistem/v_project_table'); ?>
							</div>

						</font>
					</div>
				</div>
			</div>

			<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
		</div>
	</section>
</div>

<div id="printable" style="display: none;">
	<h1 align="center" style="border: solid thin; line-height: 70px;">PROJECT EVALUATION</h1>
	<div style="border: solid thin; line-height: 70px; margin-top: -10px; padding-left: 10px;">
		<table id="header1" width="100%" style="line-height: 40px;">
			<tr>
				<td width="15%">No</td>
				<td width="5%">:</td>
				<td width="25%"></td>
				<td width="5%"></td>
				<td width="20%">Date</td>
				<td width="5%">:</td>
				<td width="25%"></td>
			</tr>
			<tr>
				<td>Project Name</td>
				<td>:</td>
				<td></td>
				<td></td>
				<td>Project Coordinator</td>
				<td>:</td>
				<td></td>
			</tr>
		</table>
	</div>
	<div style="border: solid thin; line-height: 70px; padding-left: 10px;">
		<table id="header2" width="100%" style="line-height: 40px;">
			<tr>
				<td width="15%">PIC Name</td>
				<td width="5%">:</td>
				<td width="25%"></td>
				<td width="5%"></td>
				<td width="20%">Deadline</td>
				<td width="5%">:</td>
				<td width="25%"></td>
			</tr>
			<tr>
				<td>Job</td>
				<td>:</td>
				<td></td>
				<td></td>
				<td>Project Level</td>
				<td>:</td>
				<td></td>
			</tr>
		</table>
	</div>
	<div style="border: solid thin; line-height: 70px; background-color: #E6E5E5; padding-left: 10px;">
		<table width="100%" style="line-height: 40px; font-size: 20px;">
			<tr>
				<td>EVALUATION</td>
			</tr>
		</table>
	</div>
	<div style="border: solid thin; line-height: 70px; padding-left: 10px;">
		<table id="header3" width="100%" style="line-height: 40px;">
			<tr>
				<td width="15%">Finish Date</td>
				<td width="5%">:</td>
				<td width="20%"></td>
				<td width="10%"></td>
				<td></td>
			</tr>
			<tr style="height: 100px; vertical-align: top;">
				<td>Notes</td>
				<td>:</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center">PIC Project,</td>
				<td></td>
				<td align="center">User Verification,</td>
			</tr>
			<tr style="height: 50px;"></tr>
			<tr>
				<td></td>
				<td></td>
				<td align="center">( ............................. )</td>
				<td></td>
				<td align="center">( ............................. )</td>
			</tr>
		</table>
	</div>
	<div style="text-align:right;">F-SMT-SIS-048 Rev 0</div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
	$(".select").select2(); // Combo Live Search
	$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' }); // DatePicker
	pagination();
	// $('#hide_sidebar').click();
});


// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	tabel = $('#data-table').DataTable( {
		"paging": true,
		"lengthChange": false,
		"pageLength": 5,
		"searching": false,
		"order": [[ 0, "asc" ]],
		"info": false,
		"autoWidth": true
	});
}


// Filter Tabel
function filter() {
	var periode = document.getElementById('fPeriode').value;
	var status = document.getElementById('fStatus').value;
	var cari = document.getElementById('cari').value;
	var arrData = [periode, status, cari];

	$.ajax({
		data: {data: arrData},
		type: 'POST',
		url: '<?php echo base_url()."index.php/sistem/data_project/filter" ?>',
		success: function(data) {
			$('.data-table').html(data);
			pagination();
		}
	});
}

function isi_table (btn) {
	var table = document.getElementById('data-table');
	var header1 = document.getElementById('header1');
	var header2 = document.getElementById('header2');
	var header3 = document.getElementById('header3');
	var row = $(btn).closest("tr").index() + 1;  	
	var project_no = table.rows[row].cells[1].innerHTML;
	var project_name = table.rows[row].cells[3].innerHTML;
	var date = table.rows[row].cells[2].innerHTML;
	var koordinator = table.rows[row].cells[4].innerHTML;
	var pic = table.rows[row].cells[5].innerHTML;
	var job = table.rows[row].cells[6].innerHTML;
	var deadline = table.rows[row].cells[7].innerHTML;
	var target2 = table.rows[row].cells[10].innerHTML;
	var target3 = table.rows[row].cells[11].innerHTML;
	var project_level = table.rows[row].cells[12].innerHTML;

	if (target3 != '') {
		deadline = target3;
	}else if(target2 != '') {
		deadline = target2;
	}
	if (project_level == '1') {
		project_level = 'Sangat Tinggi';
	}else if(project_level == '2') {
		project_level = 'Tinggi';
	}else{
		project_level = 'Sedang';
	}

	header1.rows[0].cells[2].innerHTML = project_no;
	header1.rows[1].cells[2].innerHTML = project_name;
	header1.rows[0].cells[6].innerHTML = date;
	header1.rows[1].cells[6].innerHTML = koordinator;

	header2.rows[0].cells[2].innerHTML = pic;
	header2.rows[1].cells[2].innerHTML = job;
	header2.rows[0].cells[6].innerHTML = deadline;
	header2.rows[1].cells[6].innerHTML = project_level;

	cetak_submit();
}

function cetak_submit () {
	var printable = document.getElementById('printable');
	var non_printable = document.getElementById('non_printable');

	printable.style.display = "";
	non_printable.style.display = "none";
	window.print();

	printable.style.display = "none";
	non_printable.style.display = "";
}

</script>