<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>



<script type="text/javascript">

	$(function () {

	    //Datatable
	    $("#example1").DataTable({"ordering": false});
	   
	});


	$('#frm_input').submit(function(event) {
		event.preventDefault();
		var currentForm = this;
		alertify.confirm("Ingin Cetak Label?", function (e) {
			if (e) {currentForm.submit();}
		});
	});

</script>