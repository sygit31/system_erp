<!-- date-picker -->
<script src="<?php echo base_url(); ?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>





<script type="text/javascript">
	$(document).ready(function() {
		var tglProses = $('input[name="tglProses"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		var options = {
			language: 'id',
			format: 'dd MM yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		};
		
		tglProses.datepicker(options);
	})

	
</script>