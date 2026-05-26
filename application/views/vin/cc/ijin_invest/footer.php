<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script> -->


<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>


<script type="text/javascript">

    $(function() {
		$('.select2').select2()

		$("#tblIjinInvest").DataTable({
			// "scrollY": "300px",
			"scrollX": "1300",
			"scrollCollapse": true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,	
			"autoWidth": false,
			// select: {
			// 	style: 'multi'
			// }
		});
    });


    $(document).ready(function() {
		$('#txtTanggal').Zebra_DatePicker({
		    direction: 0,
		    // pair: $('#tanggal_selesai'),
		    // format: 'd-m-Y'
		    format: 'Y-m-d'
		});
	} );


    function showDepartementPengajuan() {
		if (cmbPengajuanUnit.value == '') {
			$('#cmbPengajuanDepartemen').find('option:not(:first)').remove();
			$("#cmbPengajuanDepartemen").val("").change(); 
		}else{
			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/cc/bskk/getDepartemen');?>',
			data:{id_unit:cmbPengajuanUnit.value},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);
					// 0:
					// 	ALOKASI: "4A"
					// 	ID_DEPARTEMENT: "29"
					// 	KABAG_DEPARTEMENT: "Budi Haryo"
					// 	KODE_DEPARTEMENT: "1P3"
					// 	NAMA_DEPARTEMENT: "Roto VB"
					// 	UNIT: "Holo I"
					
					$('#cmbPengajuanDepartemen').find('option:not(:first)').remove();
					$("#cmbPengajuanDepartemen").val("").change(); 

					data.forEach(xx => {
						// console.log(xx['NAMA_DEPARTEMENT'])
						addVal = xx['ID_DEPARTEMENT'];
						addText = xx['NAMA_DEPARTEMENT'];
						addKode = xx['KODE_DEPARTEMENT'];

						$('#cmbPengajuanDepartemen').append(`<option value="${addVal}">${addText}</option>`);

					});
				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
			});
			
		}
	}


    function showDepartementPemohon() {
		if (cmbPemohonUnit.value == '') {
			$('#cmbPemohonDepartemen').find('option:not(:first)').remove();
			$("#cmbPemohonDepartemen").val("").change(); 
		}else{
			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/cc/bskk/getDepartemen');?>',
			data:{id_unit:cmbPemohonUnit.value},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);
					// 0:
					// 	ALOKASI: "4A"
					// 	ID_DEPARTEMENT: "29"
					// 	KABAG_DEPARTEMENT: "Budi Haryo"
					// 	KODE_DEPARTEMENT: "1P3"
					// 	NAMA_DEPARTEMENT: "Roto VB"
					// 	UNIT: "Holo I"
					
					$('#cmbPemohonDepartemen').find('option:not(:first)').remove();
					$("#cmbPemohonDepartemen").val("").change(); 

					data.forEach(xx => {
						// console.log(xx['NAMA_DEPARTEMENT'])
						addVal = xx['ID_DEPARTEMENT'];
						addText = xx['NAMA_DEPARTEMENT'];
						addKode = xx['KODE_DEPARTEMENT'];

						$('#cmbPemohonDepartemen').append(`<option value="${addVal}">${addText}</option>`);

					});
				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
			});
			
		}
	}

    $('#txtBiaya').on('keyup', function() {
		var xyz = this.value.replaceAll(".", "");
		this.value=formatNumber(xyz);
	});

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

	function batalkan(){
		$("#cmbPengajuanUnit").val("").change();
		$("#cmbPemohonUnit").val("").change();
	}

	function validasi(){
		xxx = true;
		if ($('#txtTanggal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Tanggal belum diisi</font>');
		}

		if ($('#txtNoProposal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Nomor Proposal belum diisi</font>');
		}

		if ($('#txtNoSuratIjin').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Nomor Surat Ijin belum diisi</font>');
		}

		if ($('#txtJenisInvest').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Jenis Invest belum diisi</font>');
		}

        if ($('#txtJumlah').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Jumlah belum diisi</font>');
		}

		if ($('#txtBiaya').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Biaya belum diisi</font>');
		}

		if ($('#cmbPengajuanUnit').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Unit Pengajuan belum diisi</font>');
		}

		if ($('#cmbPengajuanDepartemen').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Departemen Pengajuan belum diisi</font>');
		}

        if ($('#cmbPemohonUnit').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Unit Pemohon belum diisi</font>');
		}

        if ($('#cmbPemohonDepartemen').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Departemen Pemohon belum diisi</font>');
		}

		return xxx;
	}
    
</script>