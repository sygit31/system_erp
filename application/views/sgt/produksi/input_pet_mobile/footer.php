<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- ================================= -->

<!-- <script src="<?php //echo base_url();?>assets/datatables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script src="<?php //echo base_url();?>assets/datatables/Select-1.3.0/js/dataTables.select.min.js"></script> -->

<!-- =================================== -->
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>

<!-- ========================================== -->

<script type="text/javascript">
	var pjgRoll = 0;

	$(document).ready(function() {  

		$('#txtTanggalMulai').Zebra_DatePicker({
			direction: 0,
			// pair: $('#txtTanggalSelesai'),
			// format: 'd-m-Y'
			format: 'Y-m-d H:i'
		});

		$('#txtTanggalSelesai').Zebra_DatePicker({
			direction: 0,
		    // pair: $('#tanggal_selesai'),
		    // format: 'd-m-Y'
			format: 'Y-m-d H:i'
		});

		$("#example2").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true
		});
	});


	function loadJumlah(){
		cmbBarangVal = cmbBarang.value.split("@");
		$("#txtJumlah").val(cmbBarangVal[2]);
		$("#txtSatuan").val(cmbBarangVal[3]);
		$("#txtSatuan2").val(cmbBarangVal[3]);
		$("#txtSatuan3").val(cmbBarangVal[3]);
	}


	function validasi(){
		if (txtTanggalMulai.value == "") {
			alertify.alert("Tanggal Mulai belum dipilih!!!");
			txtTanggalMulai.focus();
			return false;
		}else{
			if (txtTanggalSelesai.value == "") {
				alertify.alert("Tanggal Selesai belum dipilih!!!");
				txtTanggalSelesai.focus();
				return false;
			}else{
				if (cmbProses.value == "") {
					alertify.alert("Proses belum dipilih!!!");
					cmbProses.focus();
					return false;
				}else{
					if (cmbBarang.value == "") {
						alertify.alert("Barang belum dipilih!!!");
						cmbBarang.focus();
						return false;
					}else{
						if (cmbMesin.value == "") {
							alertify.alert("Mesin belum dipilih!!!");
							cmbMesin.focus();
							return false;
						}else{
							if (cmbShift.value == "") {
								alertify.alert("Shift belum dipilih!!!");
								cmbShift.focus();
								return false;
							}else{
								if (cmbPengawas.value == "") {
									alertify.alert("Pengawas belum dipilih!!!");
									cmbPengawas.focus();
									return false;
								}else{
									if (cmbOperator.value == "") {
										alertify.alert("Operator belum dipilih!!!");
										cmbOperator.focus();
										return false;
									}else{
										if (txtHasil.value == "") {
											alertify.alert("Hasil belum diisi!!!");
											txtHasil.focus();
											return false;
										}else{
											return true;
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	

</script>

