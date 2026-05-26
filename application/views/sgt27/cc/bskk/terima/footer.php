
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>


<script type="text/javascript">

    $(document).ready(function() {
		$('#txtTanggal').Zebra_DatePicker({
		    direction: 0,
		    // format: 'd-m-Y'
		    format: 'Y-m-d'
		});

		$("#tblData").DataTable({
			// "scrollY": "500px",
			"scrollX": "1300",
			"scrollCollapse": true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,	
			"autoWidth": true,
			// select: {
			// 	style: 'multi'
			// }
		});
	} );


    function formatNumber(numberString) {
		var commaIndex = numberString.indexOf(',');
		var int = numberString;
		var frac = '';

		if (~commaIndex) {
			int = numberString.slice(0, commaIndex);
			frac = ',' + numberString.slice(commaIndex + 1);
		}

		var firstSpanLength = int.length % 3;
		var firstSpan = int.slice(0, firstSpanLength);
		var result = [];

		if (firstSpan) {
			result.push(firstSpan);
		}

		int = int.slice(firstSpanLength);

		var restSpans = int.match(/\d{3}/g);

		if (restSpans) {
			result = result.concat(restSpans);
			return result.join('.') + frac;
		}

		return firstSpan + frac;
	}

	$('#txtJumlah').on('keyup', function() {
		var xyz = this.value.replaceAll(".", "");
		this.value=formatNumber(xyz);
	});

    function validasi(){
		xxx = true;
		if ($('#txtJenis').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Jenis belum diisi</font>');
		}

		if ($('#txtTanggal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Tanggal belum diisi</font>');
		}

		if ($('#txtJumlah').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Jumlah belum diisi</font>');
		}
		
		return xxx;
	}
</script>