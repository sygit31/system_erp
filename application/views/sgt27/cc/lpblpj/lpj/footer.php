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

<!-- cleave -->
<script src="<?php echo base_url();?>assets/cleave/dist/cleave.min.js"></script>

<!-- Export Excel (Jumadi) -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>


<script type="text/javascript">

	$(function() {
		$('.select2').select2()

		$("#tblLpj").DataTable({
			// "scrollY": "300px",
			"scrollX": "2000",
			"scrollCollapse": true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,	
			// "autoWidth": true,
			// select: {
			// 	style: 'multi'
			// }
		});

		$("#tblData").DataTable({
			// "scrollY": "500px",
			"scrollX": "1300",
			"scrollCollapse": true,
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,	
			"autoWidth": true,
			"dom": 'frtipB', // Export Excel (Jumadi)
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {
					columns: ':visible'
				},
				className: 'btn btn-success',
				title: 'Laporan Data LPB'
			}]
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
		    format: 'm/d/Y'
		});
		
		// // CLEAVE
		// var cleave = new Cleave('#txtDebet', {
		//     delimiter: '.',
		//     blocks: [3, 3, 3, 3],
		//     uppercase: true
		// });
	} );



	function showDepartement() {
		// $('#txtBagian').val($('#cmbBagian option:selected').text());

		if (cmbUnit.value == '') {
			$('#cmbDepartement').find('option:not(:first)').remove();
			$("#cmbDepartement").val("").change(); 
		}else{
			$.ajax({
				type: 'post',
				url: '<?php echo site_url('sgt/cc/bskk/getDepartemen');?>',
				data:{id_unit:cmbUnit.value},
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
					
					$('#cmbDepartement').find('option:not(:first)').remove();
					$("#cmbDepartement").val("").change(); 

					data.forEach(xx => {
						// console.log(xx['NAMA_DEPARTEMENT'])
						addVal = xx['ID_DEPARTEMENT'];
						addText = xx['NAMA_DEPARTEMENT'];
						addKode = xx['KODE_DEPARTEMENT'];
						// ===============
						addAlokasi = xx['ALOKASI'];

						// $('#cmbDepartement').append(`<option value="${addText}@${addKode}@${addVal}">${addText}</option>`);
						$('#cmbDepartement').append(`<option value="${addText}@${addKode}@${addVal}@${addAlokasi}">${addText}</option>`);

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

	function batalkan(){
		$("#cmbInvest").val("").change();
		$("#cmbUnit").val("").change();
		$("#cmbJenis").val("").change();
		// $("#cmbSumber").val("").change();
	}

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

	$('#txtHarga').on('keyup', function() {
		var xyz = this.value.replaceAll(".", "");

		jml = 0;
		if (txtQuantity.value != '') {
			jml = txtQuantity.value;
		}

		hrg = 0;
		if (xyz != '') {
			hrg = xyz;
		}

		dbt = jml * xyz;
		txtDebet.value = formatNumber(String(dbt));

		this.value=formatNumber(xyz);
	});


	$('#txtQuantity').on('keyup', function() {
		jml = 0;
		if (this.value != '') {
			jml = this.value;
		}

		hrg = 0;
		if (txtHarga.value != '') {
			hrg = txtHarga.value.replaceAll(".", "");
		}

		dbt = jml * hrg;
		txtDebet.value = formatNumber(String(dbt));
	});

	$('#txtPph').on('keyup', function() {
		var xyz = this.value.replaceAll(".", "");
		this.value=formatNumber(xyz);
	});

	function tambahLPB() {
		if (cekTambah()) {
			Xinvest = cmbInvest.value;
			XkodeRekening = TxtKodeRekening.value;
			Xunit = cmbUnit.value.split("@");
			Xdepartemen = cmbDepartement.value.split("@");
			Xjenis = cmbJenis.value;
			Xtanggal = txtTanggal.value;
			Xsupplier = txtSupplier.value;
			Xketerangan = txtKeterangan.value;
			XNoLpjInternal = txtNoLpjInternal.value;
			XNoLpjExternal = txtNoLpjExternal.value;
			Xquantity = txtQuantity.value;
			Xsatuan = txtSatuan.value;
			Xharga = txtHarga.value;
			Xdebet = txtDebet.value;
			Xpph = txtPph.value;
			XbuttonHapus = "";

			// =====================================================================
			table = $(tblLpj).dataTable();
			// oSettings = table.fnSettings();

			// table.fnClearTable(this);
			
			// table.oApi._fnAddData(oSettings, data[i]['NIK']+','+data[i]['NAMA']);
			// table.fnAddData([data[i]['ID'],data[i]['NIK'],data[i]['NAMA']]);

			table.fnAddData([
				Xinvest + `<input type="hidden" name="ArrInvest[]" value="`+ Xinvest +`" />`,
				XkodeRekening + `<input type="hidden" name="ArrRekening[]" value="`+ XkodeRekening +`" />`,
				// Xunit[1]   + ' (' + Xdepartemen[1] + `)<input type="hidden" name="ArrUnit[]" value="`+ Xunit[1]  +`" /><input type="hidden" name="ArrDepartemen[]" value="`+  Xdepartemen[2]  +`" />`,
				Xdepartemen[3]   + ' (' + Xdepartemen[1] + `)<input type="hidden" name="ArrUnit[]" value="`+ Xdepartemen[3]  +`" /><input type="hidden" name="ArrDepartemen[]" value="`+  Xdepartemen[2]  +`" />`,
				Xjenis + `<input type="hidden" name="ArrJenis[]" value="`+ Xjenis +`" />`,
				Xtanggal  + `<input type="hidden" name="ArrTanggal[]" value="`+ Xtanggal +`" />`,
				Xsupplier  + `<input type="hidden" name="ArrSupplier[]" value="`+ Xsupplier +`" />`,
				Xketerangan  + `<input type="hidden" name="ArrKeterangan[]" value="`+ Xketerangan +`" />`,
				XNoLpjInternal  + `<input type="hidden" name="ArrLpjInt[]" value="`+ XNoLpjInternal +`" />`,
				XNoLpjExternal  + `<input type="hidden" name="ArrIpjExt[]" value="`+ XNoLpjExternal +`" />`,
				Xquantity  + ' (' + Xsatuan + `)<input type="hidden" name="Arrqty[]" value="`+ Xquantity +`" /><input type="hidden" name="ArrSatuan[]" value="`+ Xsatuan +`" />`,
				Xharga  + `<input type="hidden" name="ArrHarga[]" value="`+ Xharga +`" />`,
				Xdebet  + `<input type="hidden" name="ArrDebet[]" value="`+ Xdebet +`" />`,
				Xpph + `<input type="hidden" name="ArrPph[]" value="`+ Xpph +`" />`,
				"<button type='button' class='btn btn-block btn-danger' id='btnDellRow' onclick='hapusRow(this);'>Hapus</button>"
				]);

			// oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
			table.fnDraw();

			kosong();
		}
		
	}


	function cekTambah(){
		xxx = true;
		if ($('#TxtKodeRekening').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Kode Rekening belum diisi</font>');
		}

		if ($('#cmbUnit').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Unit belum diisi</font>');
		}

		if ($('#cmbDepartement').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Departement belum diisi</font>');
		}

		if ($('#cmbJenis').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Tipe belum diisi</font>');
		}
		
		if ($('#txtTanggal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Tanggal belum diisi</font>');
		}

		if ($('#txtSupplier').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Supplier belum diisi</font>');
		}

		if ($('#txtKeterangan').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Keterangan belum diisi</font>');
		}

		if ($('#txtNoLpjInternal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">No. LPJ internal belum diisi</font>');
		}

		if ($('#txtNoLpjExternal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">No. LPJ Eksternal belum diisi</font>');
		}

		if ($('#txtQuantity').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Quantity belum diisi</font>');
		}

		if ($('#txtSatuan').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Satuan belum diisi</font>');
		}

		if ($('#txtHarga').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Harga belum diisi</font>');
		}

		if ($('#txtPph').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Pph belum diisi</font>');
		}

		return xxx;
	}


	function kosong(){
		$("#cmbInvest").val("").change();
		$("#TxtKodeRekening").val("");
		$("#cmbUnit").val("").change();
		$("#cmbJenis").val("").change();
		$("#txtTanggal").val("");
		$("#txtSupplier").val("");
		$("#txtKeterangan").val("");
		$("#txtNoLpjInternal").val("");
		$("#txtNoLpjExternal").val("");
		$("#txtQuantity").val("");
		$("#txtSatuan").val("");
		$("#txtHarga").val("");
		$("#txtDebet").val("");
		$("#txtPph").val("");
	}

	function hapusRow(xyz){
		table = $(tblLpj).dataTable();

		var row = xyz.parentNode.parentNode;

		var nRow = row[0];
		table.fnDeleteRow(row);
	}

	function validasi(){
		var rowCount = $("#tblLpj tbody tr").length;
		var colCount = $("#tblLpj tbody tr td").length;
		if (rowCount == 1 && colCount == 1) {
			alertify.alert('<font color="red">Data masih kosong!!!</font>')
			return false
		}else{return true}
	}


</script>