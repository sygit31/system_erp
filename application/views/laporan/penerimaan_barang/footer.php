<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- date-picker -->
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>


<script type="text/javascript">
	$(function () {
	    //Datatable
	    $("#example1").DataTable();
	});


	$(document).ready(function(){
		var tanggalAwal=$('input[name="tanggalAwal"]'); 
		var tanggalAkhir=$('input[name="tanggalAkhir"]'); 
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		var options={
		    language:'id',
		    format: 'dd MM yyyy',
		    container: container,
		    todayHighlight: true,
		    autoclose: true,
		};
		
		tanggalAwal.datepicker(options);
		tanggalAkhir.datepicker(options);
	})


</script>