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



<script type="text/javascript">

    $(function() {
		$('.select2').select2()

		$("#tblBSKK").DataTable({
			"scrollY": "300px",
			"scrollCollapse": true,
			"paging": false,
			"lengthChange": true,
			"searching": false,
			"ordering": false,
			"info": true,	
			"autoWidth": true,
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
		
		$('#txtTanggalE').Zebra_DatePicker({
		    direction: 0,
		    // pair: $('#tanggal_selesai'),
		    // format: 'd-m-Y'
		    format: 'Y-m-d'
		});
		
		// // CLEAVE
		// var cleave = new Cleave('#txtDebet', {
		//     delimiter: '.',
		//     blocks: [3, 3, 3, 3],
		//     uppercase: true
		// });
	} );


	$('#modal-detail').on('show.bs.modal', function(e) {
		var data = e.relatedTarget.id;
		$("#txtId_Bskk").val(data);
		getBSKKbyId(data);
	
    })

	function getBSKKbyId(IdBskk) {
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/cc/bskk/getBSKKbyId');?>',
			data:{id_bskk:IdBskk},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);
					// 0:
					// 	alokasi: "5A"
					// 	debet: "37500"
					// 	departemen: "26"
					// 	id_bskk: "12336"
					// 	id_departement: "26"
					// 	invest: null
					// 	kabag_departement: "Yahya Indarto"
					// 	keterangan: "PAKET HOLOREADER KE PWK JAKARTA"
					// 	kode_departement: "2P6"
					// 	kode_rekening: "5301.15"
					// 	nama_departement: "Pengembangan R&D"
					// 	no_bpkk: "JDK048"
					// 	tanggal: "2021-01-09"
					// 	unit: "Holo II"
					
					// =========================================================
					// =========================================================
					// Unit dan Departement ====================================
					UnitDepartement(data[0]['departemen']);
					
					// =========================================================
					// =========================================================

					$("#txtNomerBPKKE").val(data[0]['no_bpkk']);
					$("#txtTanggalE").val(data[0]['tanggal']);
					$("#cmbInvestE").val(data[0]['invest']).change();
					$("#TxtKodeRekeningE").val(data[0]['kode_rekening']);
					$("#txtKeteranganE").val(data[0]['keterangan']);

					// numDebt = Number(data[0]['debet']);
					// $("#txtDebetE").val(numDebt.toFixed(2));
					$("#txtDebetE").val(data[0]['debet']);


				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
		});	
	}

	//binding unit dan departement
	var idDeptBinding = ''
	function UnitDepartement(idDepartement) {
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/cc/lpblpj/getDataDepartementById');?>',
			data:{id_departement:idDepartement},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);
					// 0:
					// 	alokasi: "5A"
					// 	id_departement: "12"
					// 	kabag_departement: "Clamet Azagaf"
					// 	kode_departement: "2P2"
					// 	nama_departement: "Gudang"
					// 	unit: "Holo II"

					addVal = data[0]['id_departement'];
					addText = data[0]['nama_departement'];
					addKode = data[0]['kode_departement'];
					addAlokasi = data[0]['alokasi'];
					idDeptBinding = addText+'@'+addKode+'@'+addVal;

					$("#cmbUnitE").val(data[0]['unit']).change();

				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
		});	
	}

	function showDepartementE() {
		// alert("a");
		if (cmbUnitE.value == '') {
			$('#cmbDepartementE').find('option:not(:first)').remove();
			$("#cmbDepartementE").val("").change(); 
		}else{
			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/cc/bskk/getDepartemen');?>',
			data:{id_unit:cmbUnitE.value},
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
					// ================================

					$('#cmbDepartementE').find('option:not(:first)').remove();
					$("#cmbDepartementE").val("").change(); 

					data.forEach(xx => {
						// console.log(xx['NAMA_DEPARTEMENT'])
						addVal = xx['ID_DEPARTEMENT'];
						addText = xx['NAMA_DEPARTEMENT'];
						addKode = xx['KODE_DEPARTEMENT'];

						$('#cmbDepartementE').append(`<option value="${addText}@${addKode}@${addVal}">${addText}</option>`);

					});

					if (idDeptBinding !== '') {
						$("#cmbDepartementE").val(idDeptBinding).change(); 
						idDeptBinding = '';
					}
				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
			});
			
		}
	}

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
					// ================================

					$('#cmbDepartement').find('option:not(:first)').remove();
					$("#cmbDepartement").val("").change(); 

					data.forEach(xx => {
						// console.log(xx['NAMA_DEPARTEMENT'])
						addVal = xx['ID_DEPARTEMENT'];
						addText = xx['NAMA_DEPARTEMENT'];
						addKode = xx['KODE_DEPARTEMENT'];

						$('#cmbDepartement').append(`<option value="${addText}@${addKode}@${addVal}">${addText}</option>`);

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

	function tambahBSKK() {
		if (cekTambah()) {
			XnoBPKK = txtNomerBPKK.value;
			Xtanggal = txtTanggal.value;
			Xinvest = cmbInvest.value;
			XkodeRekening = TxtKodeRekening.value;
			Xunit = cmbUnit.value.split("@");
			Xdepartemen = cmbDepartement.value.split("@");
			// Xbiaya = txtBiaya.value;
			Xketerangan = txtKeterangan.value;
			Xdebet = txtDebet.value;
			XbuttonHapus = "";

			// =====================================================================
			table = $(tblBSKK).dataTable();
			// oSettings = table.fnSettings();

			// table.fnClearTable(this);
			
			// table.oApi._fnAddData(oSettings, data[i]['NIK']+','+data[i]['NAMA']);
			// table.fnAddData([data[i]['ID'],data[i]['NIK'],data[i]['NAMA']]);

			table.fnAddData([
				XnoBPKK + `<input type="hidden" name="ArrNoBpkk[]" value="`+ XnoBPKK +`" />`,
				Xtanggal + `<input type="hidden" name="ArrTanggal[]" value="`+ Xtanggal +`" />`,
				Xinvest  + `<input type="hidden" name="ArrInvest[]" value="`+ Xinvest +`" />`,
				XkodeRekening  + `<input type="hidden" name="ArrRekening[]" value="`+ XkodeRekening +`" />`,
				// Xunit[0] + ' (' + Xunit[1] + `)<input type="hidden" name="ArrUnit[]" value="`+ Xunit[0] +`" />`,
				Xunit[0] + `<input type="hidden" name="ArrUnit[]" value="`+ Xunit[0] +`" />`,
				Xdepartemen[0]  + ' (' + Xdepartemen[1] + `)<input type="hidden" name="ArrDepartemen[]" value="`+ Xdepartemen[2] +`" />`,
				Xketerangan  + `<input type="hidden" name="ArrKeterangan[]" value="`+ Xketerangan +`" />`,
				Xdebet  + `<input type="hidden" name="ArrDebet[]" value="`+ Xdebet +`" />`,
				"<button type='button' class='btn btn-block btn-danger' id='btnDellRow' onclick='hapusRow(this);'>Hapus</button>"
			]);

			// oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
			table.fnDraw();

			kosong();
		}
		
	}

	function hapusRow(xyz){
		table = $(tblBSKK).dataTable();

        var row = xyz.parentNode.parentNode;

		var nRow = row[0];
		table.fnDeleteRow(row);
    }

	function kosong(){
		$('#txtNomerBPKK').val('')
		$("#txtTanggal").val("");
		$("#cmbInvest").val("").change();
		$("#TxtKodeRekening").val("");
		$("#cmbUnit").val("").change();
		$("#txtKeterangan").val("");
		$("#txtDebet").val("");
	}

	function cekTambah(){
		xxx = true;
		if ($('#txtNomerBPKK').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Nomer BPKK belum diisi</font>');
		}

		if ($('#txtTanggal').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Tanggal belum diisi</font>');
		}

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

		if ($('#txtKeterangan').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Keterangan belum diisi</font>');
		}

		if ($('#txtDebet').val()=='' && xxx) {
			xxx = false;
			alertify.alert('<font color="red">Debet belum diisi</font>');
		}

		return xxx;
	}

	function batalkan(){
		$("#cmbInvest").val("").change();
		$("#cmbUnit").val("").change();
	}

	function validasi(){
		var rowCount = $("#tblBSKK tbody tr").length;
		var colCount = $("#tblBSKK tbody tr td").length;
		if (rowCount == 1 && colCount == 1) {
			alertify.alert('<font color="red">Datatable masih kosong!!!</font>')
			return false
		}else{return true}
	}

	$('#txtNomerBPKK').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
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

	$('#txtDebet').on('keyup', function() {
		var $this = $(this);
		// alert($this.val());
		var xyz = $this.val().replaceAll(".", "");
		// alert(xyz);
		$this.val(formatNumber(xyz));
	});

</script>