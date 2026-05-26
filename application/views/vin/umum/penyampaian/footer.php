<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>


<!-- date-picker -->
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>
<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>









<script type="text/javascript">

    $(function() {
	    // $('.select2').select2()

		//Datatable
		// $("#tblPermintaan").DataTable();
		$("#tblPermintaan").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true
		});
	});

    $(document).ready(function(){
		$('#tanggal').Zebra_DatePicker({
		    direction: 1,
		    format: 'd-m-Y'
		});
	})

	function justNumber(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    }

	$('#modal-detail').on('show.bs.modal', function(e) {
		var data = e.relatedTarget.id;
		data = data.split("@");
		$("#lblBagian").text(data[1]);
		
		$('#tblPermintaan tbody').empty();

		var dPermintaan = <?php echo json_encode($data_permintaan_per_bagian); ?>;
		var markUp = '';

		dPermintaan.forEach(asd => {
			if (asd['ID_BAGIAN'] == data[0]) {
				markUp += `
				<tr align="center">
					<td >`+asd['TANGGAL']+`</td>
					<td >`+asd['BARANG']+` `+asd['SPESIFIKASI']+`</td>
					<td >`+asd['SATUAN']+`</td>
					<td ><font color="blue">`+asd['JUMLAH']+`</font></td>
					<td ><font color="red">`+asd['KEKURANGAN']+`</font></td>
					<td >
						<input class="form-control" type="hidden" id="txtIdSIPDetail[]" name="txtIdSIPDetail[]" value="`+asd['ID']+`">
						<input class="form-control" type="hidden" id="txtOutstanding[]" name="txtOutstanding[]" value="`+asd['KEKURANGAN']+`">
						<input class="form-control" type="text" id="txtJumlah[]" name="txtJumlah[]" onkeydown="justNumber(event);">
					</td>
				</tr>`
			}
		});

		$("#tblPermintaan tbody").append(markUp);
    })

</script>