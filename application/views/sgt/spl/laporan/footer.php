<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>



<script type="text/javascript">

	$(function() {
		$("#example2").DataTable({
			// "scrollY": "400px",
        	// "scrollCollapse": true,
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

	});


</script>