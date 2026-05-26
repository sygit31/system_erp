<!-- DataTables -->
<!-- <script src="<?php //echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script> -->
<!-- <script src="<?php //echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script> -->

<script src="<?php echo base_url();?>assets/datatables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script src="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Select-1.3.0/js/dataTables.select.min.js"></script>

<!-- SEMANTIC UI -->
<script src="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/js/dataTables.semanticui.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.semanticui.min.js"></script>

<!-- Attention -->
<script src="<?php echo base_url();?>assets/attention/dist/attention.js"></script>
<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>



<script type="text/javascript">

	$(function () {
		$('#tanggalAwal').Zebra_DatePicker({
		    // direction: true,
		    pair: $('#tanggalAkhir'),
		    format: 'd-m-Y'
		});
		 
		$('#tanggalAkhir').Zebra_DatePicker({
		    direction: 1,
		    format: 'd-m-Y'
		});
	    //==========================================
	    // $("#example2").DataTable({
	    //   "paging": true,
	    //   "lengthChange": true,
	    //   "searching": true,
	    //   "ordering": false,
	    //   "info": true,
	    //   "autoWidth": true
	    // });
	    // $("#example1").DataTable({
	    //   "paging": true,
	    //   "lengthChange": true,
	    //   "searching": true,
	    //   "ordering": false,
	    //   "info": true,
	    //   "autoWidth": true
	    // });
	    //==========================================

	     $('#example1').DataTable( {
	     	scrollX: true,
	        dom: 'Bfrtip',
	        lengthMenu: [
	            [ 10, 25, 50, -1 ],
	            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
	        ],
	        buttons: [
	            'pageLength',
	            {text: 'Copy', extend: 'copy', exportOptions: {columns: ':visible'}},
	            {text: 'Print', extend: 'print', exportOptions: {columns: ':visible'}},
	            {text: 'Visibility', extend: 'colvis'},
	            {text: 'Export', extend: 'collection' , buttons: [
	            	{text: 'Excel', extend: 'excel', exportOptions: {columns: ':visible'}},
	            	{text: 'CSV', extend: 'csv', exportOptions: {columns: ':visible'}},
	            	{text: 'PDF', extend: 'pdf', exportOptions: {columns: ':visible'}}
	            ]}
	        ],

	     // 	scrollY:     400,
		    // scroller: {
		    //     loadingIndicator: true
		    // }

	        // select: true

	        // buttons: [
	        //     {
	        //         extend: 'collection',
	        //         text: 'Table control',
	        //         buttons: [
	        //             {
	        //                 text: 'Toggle start date',
	        //                 action: function ( e, dt, node, config ) {
	        //                     dt.column( -2 ).visible( ! dt.column( -2 ).visible() );
	        //                 }
	        //             },
	        //             {
	        //                 text: 'Toggle salary',
	        //                 action: function ( e, dt, node, config ) {
	        //                     dt.column( -1 ).visible( ! dt.column( -1 ).visible() );
	        //                 }
	        //             },
	        //             {
	        //                 collectionTitle: 'Visibility control',
	        //                 extend: 'colvis'
	        //             }
	        //         ]
	        //     }
	        // ],

	    } );
	});


    
</script>