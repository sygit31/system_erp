
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>




<script type="text/javascript">

    $(document).ready(function() {
		$('#txtTanggal').Zebra_DatePicker({
		    direction: 0,
		    format: 'm-Y'
		});


	} );


    

    function validasi(){
		xxx = true;
		

		if ($('#txtTanggal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Tanggal belum diisi</font>');
		}

		
		
		return xxx;
	}
</script>