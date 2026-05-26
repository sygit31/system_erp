<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script> -->



<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>


<script type="text/javascript">

    $(function() {
        $('.select2').select2()

		$("#example2").DataTable({
			"scrollY": "300px",
        	"scrollCollapse": true,
			"paging": false,
			"lengthChange": true,
			"searching": false,
			"ordering": false,
			"info": true,	
			"autoWidth": true,
			select: {
				style: 'multi'
			}
		});

		$("#tblSPL").DataTable({
			"scrollY": "400px",
        	"scrollCollapse": true,
			"paging": false,
			"lengthChange": true,
			"searching": false,
			"ordering": true,
			"info": false,	
			"autoWidth": true,
			select: {
				style: 'multi'
			}
		});
	});


	$(document).ready(function() {
		$('#tanggal_mulai').Zebra_DatePicker({
		    direction: 0,
		    // pair: $('#tanggal_selesai'),
		    format: 'd-m-Y   H:i'
		});

		$('#tanggal_selesai').Zebra_DatePicker({
		    direction: 0,
		    format: 'd-m-Y   H:i'
		});


		var table = $('#example2').DataTable();
		$('#example2 tbody').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) {
				// $(this).removeClass('selected');
				$(this).find("input:eq(1)").val("F");
			}
			else {
				// $(this).addClass('selected');
				$(this).find("input:eq(1)").val("T");
			}
		} );


		$('#tblSPL tbody').on( 'click', 'tr', function () {
			if ( $(this).hasClass('selected') ) {
				// $(this).removeClass('selected');
				$(this).find("input:eq(1)").val("F");
			}
			else {
				// $(this).addClass('selected');
				$(this).find("input:eq(1)").val("T");
			}
		} );
	} );
	


	function showKaryawan() {
		// var t = $('#example2').DataTable();
		// var counter = 1;
	
		// t.row.add( [
		// 	counter +'.1',
		// 	counter +'.2',
		// 	counter +'.3',
		// ] ).draw( false );

		// counter++;

		// ======================================
		$('#txtBagian').val($('#cmbBagian option:selected').text());

		if (cmbBagian.value == '') {
			table.fnClearTable(this);
		}else{

			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/spl/input_spl/getKaryawan');?>',
			data:{id_bagian:cmbBagian.value},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);

					// $("#example2 tbody").find("tr").remove();


					// for (let i = 0; i < data.length; i++) {
					// 	// console.log(data[i]['NAMA']);

					// 	var txt = `
					// 	<tr>
					//         <td align="center"><input type="checkbox" name="cbPilih[]" value="`+ data[i]['ID'] +`"></td>
					//         <td align="center">`+ data[i]['NIK'] +`</td>
					//         <td >`+ data[i]['NAMA'] +`</td>
					//     </tr>`;

					// 	$("#example2 tbody").append(txt);

					// }

					// ==========================================================
					
					table = $(example2).dataTable();
					// oSettings = table.fnSettings();

					table.fnClearTable(this);
					
					for (var i = 0; i < data.length; i++) {
						// table.oApi._fnAddData(oSettings, data[i]['NIK']+','+data[i]['NAMA']);
						// table.fnAddData([data[i]['ID'],data[i]['NIK'],data[i]['NAMA']]);
						var TotalLembur = parseInt(data[i]['TOTAL_LEMBUR'] / 60) + ' Jam ' +
							data[i]['TOTAL_LEMBUR'] % 60 + ' Menit'

						table.fnAddData([
							'<input type="hidden" name="cbId[]" value="'+ data[i]['ID'] +'" /><input type="hidden" name="cbPilih[]" value="F" />' +
							data[i]['NIK'] + '<input type="hidden" name="cbNik[]" value="'+ data[i]['NIK'] +'" />',
							data[i]['NAMA']  + '<input type="hidden" name="cbNama[]" value="'+ data[i]['NAMA'] +'" />',
							TotalLembur + '<input type="hidden" name="cbTotal[]" value="'+ TotalLembur +'" />'
						]);
					}
					// oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
					table.fnDraw();
					

				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
			});
			
		}
	}
	
	
</script>


<?php
    if ($_SESSION['cetak']) {
		$_SESSION['cetak'] = False;
		$ctk = site_url('sgt/spl/cetak_spl');
        print_r("
          <script type='text/javascript'>
		 	window.open('$ctk');
          </script>
        ");
    }
?>