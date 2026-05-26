<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>


<script type="text/javascript">

    $(function () {
		//Initialize Select2 Elements
	    $('.select2').select2()

	    $("#example2").DataTable({
	      "paging": false,
	      "lengthChange": true,
	      "searching": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": true
	    });

		$(document).ready(function(){
			$('#tanggal').Zebra_DatePicker({
				// direction: 1,
				format: 'd-m-Y'
			});
		})


	});


</script>