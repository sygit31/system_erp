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
<style>
	.select2-container--open {
		z-index: 9999999;
	}
</style>

<div class="content-wrapper" id="non_printable">
	<section class="content-header"></section>
	<section class="content">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Mutasi PET</font>
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
							<?php $this->load->view('produksi/v_lap_mutasi_pet_table'); ?>

							
							<button style="width: 120px;" type="button" onclick="cetak()" class="btn btn-danger ml-2" title="Export to Excel"><i class="fa fa-print mr-2"></i><b>Print</b></button>
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

<div id="printable" style="display: none;">
	<table id="data_header" class="mb-3" width="100%"  style="font-weight: bold; font-size: 16px;" >
		<tr>
			<td colspan='6' align='center'><font size='6'><b>MUTASI HASIL BAIK</b></font></td>
		</tr>
		
		<tr>
			<td colspan='6' align='center'><font size='6'><b>&nbsp;</b></font></td>
		</tr>
		<tr>
			<td colspan='6' align='center'><font size='6'><b>&nbsp;</b></font></td>
		</tr>
		<tr>
			<td width="20%">No. </td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">Tanggal </td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">Seri</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">KK</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">Desain</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
	</table>
  
	<table id="data-table" class="data-print" style="width:90%; border: 1px solid blue; font-size: 16px;">
		<thead align="center">
			<tr>
				<th>No</th>
				<!--<th>Shift</th>!-->
				<th>Kode Roll</th>
				<th>Ukuran</th>
				<th>Panjang(MTR)</th>
				<!--<th>Total</th>-->
				
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	
	<table id="data_footer" class="mb-3" width="100%"  style="font-weight: bold;font-size: 16px;" >
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%" colspan=2 align='center'  style="font-size: 12px;" ></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%" align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	</table>
</div>

<div id="printable_pita" style="display: none;">
	<table id="data_header_pita" class="mb-3" width="100%"  style="font-weight: bold; font-size: 16px;" >
		<tr>
			<td colspan='6' align='center'><font size='6'><b>MUTASI HASIL BAIK</b></font></td>
		</tr>
		
		<tr>
			<td colspan='6' align='center'><font size='6'><b>&nbsp;</b></font></td>
		</tr>
		<tr>
			<td colspan='6' align='center'><font size='6'><b>&nbsp;</b></font></td>
		</tr>
		<tr>
			<td width="20%">No. </td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">Tanggal </td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">Seri</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">KK</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td width="20%">Desain</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="20%">&nbsp;</td>
			<td width="1%">&nbsp;</td>
			<td width="4%">&nbsp;</td>
		</tr>
	</table>
	<table id="data-table_pita" class="data-print" style="width:90%; border: 1px solid blue; font-size: 16px;">
		<thead align="center">
		<tr>				
			<th>No</th>
			<th>Kode Roll</th>
			<th>Panjang(Mtr)</th>
			<th>Jumlah Roll</th>
			<th>Total Panjang(Mtr)</th>	
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<table id="data_footer_pita" class="mb-3" width="100%"  style="font-weight: bold;font-size: 16px;" >
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%" colspan=2 align='center'  style="font-size: 12px;" ></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%" align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'></td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'></td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	<tr>
			<td width="30%" colspan=3 align='center'>&nbsp;</td>
			<td width="20%">&nbsp;</td>
			<td width="10%">&nbsp;</td>
			<td width="40%"  align='center'>&nbsp; </td>
	</tr>
	</table>
</div>

<style>
	@media print {
		@page {
			size: portrait;
		}

		body {
			font-size: 12px;
			padding-top: 5mm;
			height: 100%;
			margin-left: 2.5cm;
			margin-right: 0.5cm;
		}
	}

	.data-print td,
	.data-print th {
		border: 1px solid #408080;
		padding-right: 8px;
	}
</style>

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
	// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy'
		});
		//pagination();
		document.getElementById('data-table_pita').style.visibility = "hidden";
	    document.getElementById('data-table').style.visibility = "hidden";
	});

	// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		$('#data-table').DataTable({
			"paging": false,
			
			"lengthChange": false,
			"searching": false,
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
				className: 'invisible excel',
				title: 'Laporan Mutasi PET'
			}],
			"colReorder": true
		});
	}
	
	$('#tanggal').change(function() {
	document.getElementById('desain').disabled=false;
	});

	// Isi Detail KK
	$('#nomor_mutasi').change(function() {
	   var tanggal = document.getElementById('tanggal').value;
		var proses_awal = document.getElementById('proses_awal').value;
		var kk = document.getElementById('kk').value;
		
		
		var no_mutasi =document.getElementById('nomor_mutasi').value;
		var data = [ proses_awal,tanggal,kk,no_mutasi];

		$('#data-table').DataTable().destroy();
		$("#data-table tbody").find("tr").remove();
		
		$('#data-table_pita').DataTable().destroy();
		$("#data-table_pita tbody").find("tr").remove();

		if (no_mutasi == '') {
			kosong();
			pagination();
			return;
		}
		else{
		//$('#nomor_mutasi').find('option:not(:first)').remove();
		   if (document.getElementById('proses_awal').value == 'Pita' )
		   {
			document.getElementById('data-table_pita').style.visibility = "visible";
		    document.getElementById('data-table').style.visibility = "hidden";
		   } 
		   else
           {
            document.getElementById('data-table_pita').style.visibility = "hidden";
		    document.getElementById('data-table').style.visibility = "visible";
		   }
		$.ajax({
			data: {
				data: data
			},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/lap_mutasi_pet/info_no_mutasi" ?>',
			success: function(data) {

				data = JSON.parse(data);
				console.log(data);
				data_no_mutasi = data[0];
				data_header = data[0][0];
				//alert(data_no_mutasi.NOMOR_MUTASI);
				//alert(data_no_mutasi.TGL);
				//data_tanggal = data[1][0];
				//data_roll = data[1][1];
               
				$('#pengirim').val(data_header.NAMA_PENGIRIM);
				$('#penerima').val(data_header.NAMA_PENERIMA);
				//$('#tanggal').val(data_no_mutasi.TGL);
				//$('#seri').val(data_no_mutasi.SERI);
				//$('#kk').val(data_no_mutasi.KK);
			    	

				isi_tabel(data_no_mutasi);
				//pagination();
				
				
			}
		});
	   
	}
	});

	// Format Nomor
	function formatNumber(num) {
		if (num == 0) {
			return '';
		} else {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
		}
	}

	// Format Date :
	function format_date(num) {
		var date = num.substring(0, 2);
		var dt_month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var month = dt_month[parseInt(num.substring(3, 5)) - 1];
		var year = num.substring(6, 10);

		return date + '-' + month + '-' + year;
	}

	// Kosong Isian
	function kosong() {
		$('#no_mutasi').val('');
		$('#tanggal').val('');
		$('#seri').val('');
		$('#kk').val('');
		
	}

	function isi_tabel(data_no_mutasi) {
		var roll = [];
		var lama='';
		var subs='';
		var roll_meter='';
		var subs_roll='';
		var subs_roll_meter='';
		var tot_meter=0;
		var tot_roll=0;
		var nomor=1;
	    var jml_roll='';
		var tot_roll_meter=0;
	
		kosong='&nbsp;';

		$('#data-table').DataTable().destroy();
		$("#data-table tbody" ).find("tr").remove();

		$('#data-table_pita').DataTable().destroy();
		$("#data-table_pita tbody" ).find("tr").remove();
		
		var proses_awal2 = document.getElementById('proses_awal').value;
		for (var i = 0; i < data_no_mutasi.length; i++) {
		
		//alert(data_no_mutasi[i].SHIFT);
		var baru=data_no_mutasi[i].SHIFT;
		var asal=data_no_mutasi[i].DARI; 
		var desain = document.getElementById('desain').value;
		//alert (asal);
			//alert(subs);
			 if ((parseInt(subs) ==0 || subs =='' ))
			  {
			  keterangan = '&nbsp;';
			  }
			  
			
			 //alert(subs); 
			 subs = 0;
			 subs_roll = 0;
			      
			 	
				     //shift = data_no_mutasi[i].SHIFT;			
					 rolls = data_no_mutasi[i].KODE;
				if(desain <=2023)
				{	
					if(asal != 'Belah')
				   {
					 ukuran = '73 CM';
					 
					if(asal == 'Pita')
				    {
					 
					 jml_roll = data_no_mutasi[i].QTY_ROLL;
					 roll_meter = (data_no_mutasi[i].HASIL)*(jml_roll);
				    }  
				   }
				   else if(asal == 'Belah')
				   {
				   	ukuran = '36.5 CM';
				   } 
				}	
				else{
					if(asal != 'Belah')
				   {
					 ukuran = '75 CM';
					 
					if(asal == 'Pita')
				    {
					 
					 jml_roll = data_no_mutasi[i].QTY_ROLL;
					 roll_meter = (data_no_mutasi[i].HASIL)*(jml_roll);
				    }  
				   }
				   else if(asal == 'Belah')
				   {
				   	ukuran = '37.5 CM';
				   } 
				}
				   
					 
				    panjang = data_no_mutasi[i].HASIL; 
					 ttl_panjang = panjang;
					 //nomor=nomor+1;
					 if (asal != 'Pita')
					 {
			          $("#data-table tbody").append('<tr><td align="center">' + formatNumber(nomor) + '</td><td align="center">' + rolls + '</td><td align="center">' + ukuran + '</td><td align="center">' + formatNumber(panjang) + '</td></tr>');	 
					  nomor=nomor+1;
			          subs = parseInt(panjang) + subs;
			          tot_meter=parseInt(tot_meter) + parseInt(panjang); 
					 }
					 else
					 {
						$("#data-table_pita tbody").append('<tr><td align="center">' + formatNumber(nomor) + '</td><td align="center">' + rolls + '</td><td align="center">' + formatNumber(panjang) + '</td><td align="center">' + formatNumber(jml_roll) + '</td><td align="center">' + formatNumber(roll_meter) + '</td></tr>');	 	
					    nomor=nomor+1;
			            subs = parseInt(panjang) + subs;
			            tot_meter=parseInt(tot_meter) + parseInt(panjang); 
					    subs_roll = parseInt(jml_roll) + subs_roll;
			            tot_roll=parseInt(tot_roll) + parseInt(jml_roll); 
						subs_roll_meter = parseInt(roll_meter) + subs_roll_meter;
			            tot_roll_meter=parseInt(tot_roll_meter) + parseInt(roll_meter); 
					}
			
			//alert(subs);
		}
	  if(proses_awal2 !='Pita')
	  {
      $("#data-table tbody").append('<tr><td align="center">' + ' TOTAL MUTASI' + '</td><td align="center">' + kosong  + '</td><td align="center">' + kosong + '</td><td align="center">' + formatNumber(tot_meter) + '</td></tr>');	 
	  }
	  else
	  {
		$("#data-table_pita tbody").append('<tr><td align="center">' + ' TOTAL MUTASI' + '</td><td align="center">' + kosong  + '</td><td align="center">' + kosong + '</td><td align="center">' + formatNumber(tot_roll) + '</td><td align="center">' + formatNumber(tot_roll_meter) + '</td></tr>');	 
	  }	
	}

	// Isi Tabel Laporan
	/* tabel memakai shift
	function isi_tabel(data_no_mutasi) {
		var roll = [];
		var lama='';
		var subs='';
		var tot_meter=0;
	
		kosong='&nbsp;';

		$('#data-table').DataTable().destroy();
		$("#data-table tbody" ).find("tr").remove();
			
		for (var i = 0; i < data_no_mutasi.length; i++) {
		
		//alert(data_no_mutasi[i].SHIFT);
		var baru=data_no_mutasi[i].SHIFT;
		var asal=data_no_mutasi[i].DARI; 
		//alert (asal);
			if (baru != lama ) {
			//alert(subs);
			 if ((parseInt(subs) ==0 || subs =='' ))
			  {
			  keterangan = '&nbsp;';
			  }
			  else if (subs != 0)
			  {
			  keterangan = 'SUB TOTAL';
			 }
			  $("#data-table tbody").append('<tr><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + keterangan + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' +  formatNumber(subs) + '</td></tr>');	        
			 //alert(subs); 
			 subs = 0;
			 nomor=1;
			      
			 shift = data_no_mutasi[i].SHIFT;			
				   rolls = data_no_mutasi[i].KODE;
				   if(asal != 'Belah')
				   {
					 ukuran = '73 CM';
				   }
				   else
				   {
				   	ukuran = '36.5 CM';
				   } 	 
					 jumlah_roll = '1 roll';
					 panjang = data_no_mutasi[i].HASIL; 
					 ttl_panjang = panjang;
					 	 
			$("#data-table tbody").append('<tr><td align="center">' + formatNumber(nomor) + '</td><td align="center">' + shift + '</td><td align="center">' + rolls + '</td><td align="center">' + ukuran + '</td><td align="center">' + jumlah_roll + '</td><td align="center">' + formatNumber(panjang) + '</td><td align="center">' + kosong + '</td></tr>');	 
			 
	 		  var lama=baru;
			 // alert(lama);
				  //nomor=nomor+1;
				  //alert(subs); 
				}
				else if (baru == lama ) {	
				     shift = data_no_mutasi[i].SHIFT;			
					 rolls = data_no_mutasi[i].KODE;
					if(asal != 'Belah')
				   {
					 ukuran = '73 CM';
				   }
				   else
				   {
				   	ukuran = '36.5 CM';
				   } 
					 
					 jumlah_roll = '1 roll';
					 panjang = data_no_mutasi[i].HASIL; 
					 ttl_panjang = panjang;
					 //nomor=nomor+1;
			    $("#data-table tbody").append('<tr><td align="center">' + formatNumber(nomor) + '</td><td align="center">' + shift + '</td><td align="center">' + rolls + '</td><td align="center">' + ukuran + '</td><td align="center">' + jumlah_roll + '</td><td align="center">' + formatNumber(panjang) + '</td><td align="center">' + kosong + '</td></tr>');	 
				}
			//total_bon = Number(bon) + total_bon;
			nomor=nomor+1;
			subs = parseInt(panjang) + subs;
			tot_meter=parseInt(tot_meter) + parseInt(panjang); 
			//alert(subs);
		}
	   $("#data-table tbody").append('<tr><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + 'SUB TOTAL' + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + formatNumber(subs) + '</td></tr>');	        	
      $("#data-table tbody").append('<tr><td align="center">' + ' TOTAL MUTASI' + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong  + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + kosong + '</td><td align="center">' + formatNumber(tot_meter) + '</td></tr>');	 
	  	
	}
	*/
    

	$('#desain').on('change', function() {
		var desain = document.getElementById('desain').value;
		//kosong_isian();
		

		if (desain == '') {
		 alert('Tahun Desain harus dipilih');
		 document.getElementById('kode_flow').disabled=true;
			return;
		} else {
		  document.getElementById('kode_flow').disabled=false;
		  //$('#proses_awal').empty();
			$.ajax({
				data: {
					data: desain
				},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/lap_mutasi_pet/get_kode_flow" ?>',
				success: function(data) {
					data = JSON.parse(data);
					console.log(data);

					data_kode_flow = data[0];
					//data_kk =data[1];
					//data_roll = data[1];

					for (var i = 0; i < data_kode_flow.length; i++) {
						kode_flow.options[kode_flow.options.length] = new Option(data_kode_flow[i].DESKRIPSI);
					}
					
					
				}
			});
		}
	});

	$('#kode_flow').on('change', function() {
		var kode_flow = document.getElementById('kode_flow').value;
		//kosong_isian();
		

		if ( kode_flow== '') {
		 alert('Kode Flow harus dipilih');
		 document.getElementById('proses_awal').disabled=true;
		 $('#proses_awal').find('option:not(:first)').remove();
			return;
		} else {
			$('#proses_awal').find('option:not(:first)').remove();	
		  document.getElementById('proses_awal').disabled=false;
		  //$('#proses_awal').empty();
			$.ajax({
				data: {
					data: kode_flow
				},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/lap_mutasi_pet/get_proses_awal" ?>',
				success: function(data) {
					data = JSON.parse(data);
					console.log(data);

					data_station_awal = data[0];
					//data_kk =data[1];
					//data_roll = data[1];

					for (var i = 0; i < data_station_awal.length; i++) {
						proses_awal.options[proses_awal.options.length] = new Option(data_station_awal[i].NAMA);
					}
					
					
				}
			});
		}
	});
	
	$('#proses_awal').on('change', function() {
	    var desain = document.getElementById('desain').value;
		var tanggal = document.getElementById('tanggal').value;
		var proses_awal = document.getElementById('proses_awal').value;
		var kode_flow = document.getElementById('kode_flow').value;
		 var data = [ desain, proses_awal,tanggal,kode_flow];
		if (proses_awal == '') {
			return;
			 alert('Proses Awal harus dipilih');
		     document.getElementById('kk').disabled=true;
			 
		} else {
		     document.getElementById('kk').disabled=false;
			 //$('#proses_akhirs').empty();
			 $('#kk').find('option:not(:first)').remove();
			$.ajax({
				data: {
					data: data
				},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/lap_mutasi_pet/get_proses_akhir" ?>',
				success: function(data) {
					data = JSON.parse(data);
					console.log(data);
					
                     //alert(data[0]);       
	            	proses_akhir = data[0][0];
					data_kk=data[1];
					//alert(proses_akhir.NAMA);
					$('#proses_akhirs').val(proses_akhir.NAMA);
					
					//for (j = data_kk.length-1; j >= 0; j--) {
                     //kk.options[j] = null;
                    //}
                    
					for (var i = 0; i < data_kk.length; i++) {
						//$('#kk').empty().append(
						kk.options[kk.options.length] = new Option(data_kk[i].KK)
						//);
					} 
				}
			});
		}
	});
	
	//$('#kk').empty();
	
	$('#kk').on('change', function() {
	    var desain = document.getElementById('desain').value;
		var tanggal = document.getElementById('tanggal').value;
		var proses_awal = document.getElementById('proses_awal').value;
		var kk = document.getElementById('kk').value;
		//$('#kk').empty();
		 var data = [ proses_awal,tanggal,kk];
		if (kk == '') {
		     alert('KK harus dipilih');
		     document.getElementById('nomor_mutasi').disabled=true;
			return;
		} else {
		     document.getElementById('nomor_mutasi').disabled=false;
			 // $('#nomor_mutasi').empty();
			$.ajax({
				data: {
					data: data
				},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/lap_mutasi_pet/get_info_kk_per_mutasi" ?>',
				success: function(data) {
					data = JSON.parse(data);
					console.log(data);
                     //alert(data[0]);       
	            	
					data_no_mutasi=data[0];
					$('#seri').val(data_no_mutasi[0].SERI);
					//alert(proses_akhir.NAMA);
					
					
					//for (j = data_kk.length-1; j >= 0; j--) {
                     //kk.options[j] = null;
                    //}

					for (var i = 0; i < data_no_mutasi.length; i++) {
					
						nomor_mutasi.options[nomor_mutasi.options.length] = new Option(data_no_mutasi[i].NOMOR_MUTASI);
					}
				}
			});
		}
	});


	// Cetak Laporan
	function cetak() {
		var printable = document.getElementById('printable');
		var printable2 = document.getElementById('printable_pita');
		var non_printable = document.getElementById('non_printable');
		var data_header = document.getElementById('data_header');
		var data_header2 = document.getElementById('data_header_pita');
        var akhir=$('#proses_akhirs').val();
		var awal=$('#proses_awal').val();
		if (akhir == 'Pita')
		{
			akhir='Gudang WIP';
		}
		else if (akhir == 'Belah')
		{
			akhir='Slitter Belah';
		}

		if (awal == 'Pita')
		{
			awal='Slitter Pita';
		}
		else if (awal == 'Belah')
		{
			awal='Slitter Belah';
		}

		if (awal == 'Metalize')
		{
			nomor='F-SMT-METZ-004 Rev.0';
		}
		else
		{
			nomor='F-SMT-P2-009 Rev.2';
		}
        data_header.rows[1].cells[0].innerHTML =  '<strong style="font-size: 20px;">'+ awal + '&nbsp;&nbsp;&nbsp;&nbsp; ke &nbsp;&nbsp;&nbsp;&nbsp;' +  akhir + '<strong>';
				
		data_header.rows[3].cells[2].innerHTML = $('#nomor_mutasi').val();
		data_header.rows[4].cells[2].innerHTML = $('#tanggal').val();
		data_header.rows[5].cells[2].innerHTML = $('#seri').val();
		data_header.rows[6].cells[2].innerHTML = $('#kk').val();
		data_header.rows[7].cells[2].innerHTML = $('#desain').val();
		
		var data_footer = document.getElementById('data_footer');

		data_footer.rows[0].cells[3].innerHTML = nomor;
		data_footer.rows[1].cells[0].innerHTML = 'Bagian '+awal;
		data_footer.rows[1].cells[3].innerHTML = 'Bagian '+akhir;
		data_footer.rows[5].cells[0].innerHTML = $('#pengirim').val();
		data_footer.rows[5].cells[3].innerHTML = $('#penerima').val();
        data_footer.rows[1].cells[2].innerHTML = 'Verifikasi'; 
		data_footer.rows[5].cells[2].innerHTML = 'Ulil Albab A.'; 
		
		        data_header2.rows[1].cells[0].innerHTML =  '<strong style="font-size: 20px;">'+ awal + '&nbsp;&nbsp;&nbsp;&nbsp; ke &nbsp;&nbsp;&nbsp;&nbsp;' +  akhir + '<strong>';
				
				data_header2.rows[3].cells[2].innerHTML = $('#nomor_mutasi').val();
				data_header2.rows[4].cells[2].innerHTML = $('#tanggal').val();
				data_header2.rows[5].cells[2].innerHTML = $('#seri').val();
				data_header2.rows[6].cells[2].innerHTML = $('#kk').val();
				data_header2.rows[7].cells[2].innerHTML = $('#desain').val();
				
				var data_footer2 = document.getElementById('data_footer_pita');
		
				data_footer2.rows[0].cells[3].innerHTML = nomor;
				data_footer2.rows[1].cells[0].innerHTML = 'Bagian '+awal;
				data_footer2.rows[1].cells[3].innerHTML = 'Bagian '+akhir;
				data_footer2.rows[5].cells[0].innerHTML = $('#pengirim').val();
				data_footer2.rows[5].cells[3].innerHTML = $('#penerima').val();
				data_footer2.rows[1].cells[2].innerHTML = 'Verifikasi'; 
				data_footer2.rows[5].cells[2].innerHTML = 'Ulil Albab A.'; 

		if($('#proses_awal').val() == 'Pita')
		{
			 
			
			printable2.style.display = "";
		    non_printable.style.display = "none";
		    window.print();

		    printable2.style.display = "none";
		    non_printable.style.display = "";
		}
		else
		{	
		printable.style.display = "";
		non_printable.style.display = "none";
		window.print();

		printable.style.display = "none";
		non_printable.style.display = "";
		}
	}
</script>
