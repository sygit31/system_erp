<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- datetimepicker custom -->
<script src="<?php echo base_url();?>assets/datetimepickersgt/build/jquery.datetimepicker.full.min.js"></script>


<script type="text/javascript">

    $(function() {
		$('#Utanggal_mulai').datetimepicker({
			format:'d-m-Y   H:i',
			// inline:true,
			lang:'ru'
		});
		$('#Utanggal_selesai').datetimepicker({
			format:'d-m-Y   H:i',
			// inline:true,
			lang:'ru'
		});

		$("#example2").DataTable({
			"scrollY": "400px",
        	"scrollCollapse": true,
			"paging": false,
			"lengthChange": true,
			"searching": false,
			"ordering": false,
			"info": false,	
			"autoWidth": true,
			select: {
				style: 'multi'
			}
		});
	});


	$(document).ready(function() {
		


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


		$('#btnAll').on( 'click', function () {
			if ($(this).text() == 'Select All') {
				$(this).text('Diselect All');
				
				$('#example2 tbody tr').each(function(){
					if ( $(this).hasClass('selected') ) {
						// $(this).removeClass('selected');
						// $(this).find("input:eq(1)").val("F");
					}
					else {
						$(this).addClass('selected');
						$(this).find("input:eq(1)").val("T");
					}
				});	
			} else {
				$(this).text('Select All');

				$('#example2 tbody tr').each(function(){
					if ( $(this).hasClass('selected') ) {
						$(this).removeClass('selected');
						$(this).find("input:eq(1)").val("F");
					}
					else {
						// $(this).addClass('selected');
						// $(this).find("input:eq(1)").val("T");
					}
				});	
			}

			
		} );


		$('#btnSetuju').on( 'click', function () {
			$('#txtAksi').val("setuju");
		});

		$('#btnTolak').on( 'click', function () {
			$('#txtAksi').val("tolak");
		});
	} );
	

	$('#modal-detail').on('show.bs.modal', function(e) {
		var idx = e.relatedTarget.id;
		
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/spl/pengajuan_spl/getById');?>',
			data:{id_spl:idx},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data[0]);
					// BAGIAN: "FINISHING"
					// ID: "16"
					// KARYAWAN: "Candra Adhi Pradana"
					// MULAI: "2020-11-16 09:44"
					// SELESAI: "2020-11-18 09:44"

					$('#Uid').val(data[0]['ID']);
					$('#lblUBagian').text(data[0]['BAGIAN']);
					$('#lblUNama').text(data[0]['KARYAWAN']);

					var tglMulai = new Date(data[0]['MULAI']);
					$('#Utanggal_mulai').val(
						tglMulai.getDate() +'-'+
						tglMulai.getMonth() +'-'+
						tglMulai.getFullYear() +'   '+
						tglMulai.getHours() +':'+
						tglMulai.getMinutes()
					);

					var tglSelesai = new Date(data[0]['SELESAI']);
					$('#Utanggal_selesai').val(
						tglSelesai.getDate() +'-'+
						tglSelesai.getMonth() +'-'+
						tglSelesai.getFullYear() +'   '+
						tglSelesai.getHours() +':'+
						tglSelesai.getMinutes()
					);
				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
		});

    })
	
	
</script>