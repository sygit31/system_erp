<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-picker -->
<script src="<?php echo base_url(); ?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>
<!-- cleave -->
<script src="<?php echo base_url(); ?>assets/cleave/dist/cleave.min.js"></script>



<script type="text/javascript">
	var totalDetailTerima = 0;
	var banyakBarang = 0;
	var flagSubmit = true;



	$(function() {
		//Initialize Select2 Elements
		$('.select2').select2()

		//Datemask dd/mm/yyyy
		$('#datemask').inputmask('dd/mm/yyyy', {
			'placeholder': 'dd/mm/yyyy'
		})

		//Money Euro
		$('[data-mask]').inputmask()

		//Datatable
		$("#example1").DataTable();
		$("#example2").DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": true
		});
	});

	$(document).ready(function() {
		//Datepicker
		var tanggalAwal = $('input[name="tanggalAwal"]');
		var tanggalAkhir = $('input[name="tanggalAkhir"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		var options = {
			language: 'id',
			format: 'dd MM yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		};

		tanggalAwal.datepicker(options);
		tanggalAkhir.datepicker(options);

		//CLEAVE
		var cleave = new Cleave('#txtKodeBarcode', {
			delimiter: '-',
			blocks: [2, 6, 4, 5],
			uppercase: true
		});
	})


	$('#modal-detail').on('show.bs.modal', function(e) {
		var data = e.relatedTarget.id;
		// alert(data);

		data = data.split("@");
		$("#txtIdPoDetail").val(data[0]);
		$("#txtOutstanding").val(data[2]);
		$("#txtOutstandingBawah").val(data[3]);
		$("#txtOutstandingAtas").val(data[4]);
		$("#txtSatuanBarang").val(data[1]);
		$("#lblIOutstanding").text("Outstanding : " + data[2]).css("color", "red").css("font-size", "12px");
		$("#lblIOutstandingBawah").text("-10% : " + data[3]).css("color", "green").css("font-size", "12px");
		$("#lblIOutstandingAtas").text("+10% : " + data[4]).css("color", "blue").css("font-size", "12px");


		var Tanggal = document.getElementById('dmTanggal');
		var NomerSP = document.getElementById('txtNomerSP');
		var KodeBarcode = document.getElementById('txtKodeBarcode');
		var JumlahBarang = document.getElementById('txtJumlahBarang');
		var Parents = document.getElementById('tblDetailPenerimaan');

		while (Parents.firstChild) {
			Parents.removeChild(Parents.firstChild);
		}

		var today = new Date();
		Tanggal.value = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
		// $("#dmTanggal").datepicker("setDate", new Date()).datepicker({ dateFormat: "mm/dd/yy"});
		NomerSP.value = "";
		KodeBarcode.value = "";
		JumlahBarang.value = "";
		$("#lblMJumlah").text("Jumlah : " + getTotalBarang());
		if (parseFloat(getTotalBarang()) < parseFloat($("#txtOutstandingBawah").val())) {
			$("#cmbStatusPoDetail").val("OTW").attr("disabled", true);
		}

		setTimeout(function() {
			$("#txtKodeBarcode").focus();
		}, 300);
	})


	$('#modal-lain').on('show.bs.modal', function(e) {
		var data = e.relatedTarget.id;
		// alert(data);

		data = data.split("@");
		$("#txtIdPoDetailL").val(data[0]);
		$("#txtOutstandingL").val(data[2]);
		$("#txtOutstandingBawahL").val(data[3]);
		$("#txtOutstandingAtasL").val(data[4]);
		$("#txtSatuanBarangL").val(data[1]);
		$("#lblIOutstandingL").text("Outstanding : " + data[2]).css("color", "red").css("font-size", "12px");
		$("#lblIOutstandingBawahL").text("-10% : " + data[3]).css("color", "green").css("font-size", "12px");
		$("#lblIOutstandingAtasL").text("+10% : " + data[4]).css("color", "blue").css("font-size", "12px");


		var Tanggal = document.getElementById('dmTanggalL');
		var NomerSP = document.getElementById('txtNomerSPL');
		// var KodeBarcode = document.getElementById('txtKodeBarcodeL');
		var JumlahBarang = document.getElementById('txtJumlahBarangL');
		var Parents = document.getElementById('tblDetailPenerimaanL');

		// while (Parents.firstChild) {
		//     Parents.removeChild(Parents.firstChild);
		// }

		var today = new Date();
		Tanggal.value = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
		// $("#dmTanggal").datepicker("setDate", new Date()).datepicker({ dateFormat: "mm/dd/yy"});
		NomerSP.value = "";
		// KodeBarcode.value = "";
		JumlahBarang.value = "";
		$("#lblMJumlahL").text("Jumlah : " + getTotalBarang());
		if (parseFloat(getTotalBarang()) < parseFloat($("#txtOutstandingBawahL").val())) {
			$("#cmbStatusPoDetailL").val("OTW").attr("disabled", true);
		}

		setTimeout(function() {
			$("#txtKodeBarcodeL").focus();
		}, 300);
	})


	function tambahTerima() {
		//ambil data
		var KodeBarcode = document.getElementById('txtKodeBarcode');
		var JumlahBarang = document.getElementById('txtJumlahBarang');
		var SatuanBarang = document.getElementById('txtSatuanBarang');
		var JumlahDetail = document.getElementById('txtJumlahDetail');
		var ValKodeBarcode = KodeBarcode.value.replace(/\-/g, "");

		if (ValKodeBarcode == "" || ValKodeBarcode.length > 17) {
			alert("[KODE BARCODE] maksimal 17 Digit!");
			KodeBarcode.focus();
		} else {
			if (JumlahBarang.value == "") {
				alert("[JUMLAH BARANG] harus diisi!");
				JumlahBarang.focus();
			} else {
				if ((parseFloat(getTotalBarang()) + parseFloat($("#txtJumlahBarang").val())) > parseFloat($("#txtOutstandingAtas").val())) {
					alert("Total Barang melebihi Toleransi Order!!!!");
					$("#txtJumlahBarang").focus();
				} else {
					if ((parseFloat(getTotalBarang()) + parseFloat($("#txtJumlahBarang").val())) >= parseFloat($("#txtOutstandingBawah").val())) {
						$("#cmbStatusPoDetail").attr("disabled", false);
					}

					totalDetailTerima++;
					var Parents = document.getElementById('tblDetailPenerimaan');
					var tr = document.createElement("tr");
					var tdKodeBarcode = document.createElement("td");
					tdKodeBarcode.width = "200";
					var tdJumlahBarang = document.createElement("td");
					tdJumlahBarang.width = "200";
					var tdSatuanBarang = document.createElement("td");
					tdSatuanBarang.width = "150";
					var tdBtn = document.createElement("td");
					tdBtn.width = "30";

					var Tkode = document.createElement("input");
					Tkode.type = "text";
					Tkode.id = "txtKodeBarcode" + totalDetailTerima;
					Tkode.name = "txtKodeBarcode" + totalDetailTerima;
					Tkode.readOnly = true;
					Tkode.value = ValKodeBarcode;
					Tkode.className = "form-control";

					var Tjml = document.createElement("input");
					Tjml.type = "text";
					Tjml.id = "txtJumlahBarang" + totalDetailTerima;
					Tjml.name = "txtJumlahBarang" + totalDetailTerima;
					Tjml.readOnly = true;
					Tjml.value = JumlahBarang.value;
					Tjml.className = "form-control";
					Tjml.style = "text-align:right;";

					var Tsatuan = document.createElement("input");
					Tsatuan.type = "text";
					Tsatuan.id = "txtSatuanBarang" + totalDetailTerima;
					Tsatuan.name = "txtSatuanBarang" + totalDetailTerima;
					Tsatuan.readOnly = true;
					Tsatuan.value = SatuanBarang.value;
					Tsatuan.className = "form-control";

					var Tbutton = document.createElement("input");
					Tbutton.type = "button";
					Tbutton.value = "x";
					Tbutton.className = "btn btn-block btn-danger btn-sm";
					Tbutton.onclick = function() {
						hapusBaris(this);
						return false;
					};

					Parents.appendChild(tr);
					tr.appendChild(tdKodeBarcode);
					tr.appendChild(tdJumlahBarang);
					tr.appendChild(tdSatuanBarang);
					tr.appendChild(tdBtn);

					tdKodeBarcode.appendChild(Tkode);
					tdJumlahBarang.appendChild(Tjml);
					tdSatuanBarang.appendChild(Tsatuan);
					tdBtn.appendChild(Tbutton);

					JumlahDetail.value = totalDetailTerima;
					KodeBarcode.value = "";
					JumlahBarang.value = "";
					KodeBarcode.focus();

					$("#lblMJumlah").text("Jumlah : " + getTotalBarang());
					banyakBarang++;
				}
			}
		}
	}


	function hapusBaris(btn) {
		var row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);

		$("#lblMJumlah").text("Jumlah : " + getTotalBarang());
		if (parseFloat(getTotalBarang()) < parseFloat($("#txtOutstandingBawah").val())) {
			$("#cmbStatusPoDetail").val("OTW").attr("disabled", true);
		}

		banyakBarang--;
	}

	function validasi(form) {
		if (flagSubmit) {

			var Tanggal = document.getElementById('dmTanggal');
			if (Tanggal.value == "") {
				alert("Tanggal belum diisi!");
				Tanggal.focus();
				return (false);
			}

			var NomerSP = document.getElementById('txtNomerSP');
			if (NomerSP.value == "") {
				alert("Nomer SP belum diisi!");
				NomerSP.focus();
				return (false);
			}

			if (banyakBarang == 0) {
				alert("Tabel masih kosong!");
				document.getElementById('txtKodeBarcode').focus();
				return (false);
			}

			//cek jumlah penerimaan dan outstanding
			// var totalBarang = 0;
			// for (var i = 1; i <= totalDetailTerima; i++) {
			// 	var bla = $("#txtJumlahBarang"+i).val();

			// 	if (typeof bla !== 'undefined') {
			// 		totalBarang += parseFloat(bla);
			// 	}
			// }

			// =============>>>FILTER BARANG LEBIH (SAAT SUBMIT)
			// var jml_outstanding = $("#txtOutstanding").val();
			// var jml_outstandingAtas = $("#txtOutstandingAtas").val();

			// if (parseFloat(totalBarang) > parseFloat(jml_outstandingAtas)){
			// 	// alert("Jumlah Penerimaan Melebihi Outstanding!");
			// 	alert("Jumlah Penerimaan Melebihi Toleransi Order!");
			// 	return (false);
			// }else if(parseFloat(totalBarang) == parseFloat(jml_outstanding)){
			//  	$("#txtStatusPoDetail").val("FINISH");
			// }

			// =============>>>FILTER KURANG TAPI DI CLOSE (SAAT SUBMIT)
			// var jml_outstandingBawah = $("#txtOutstandingBawah").val();
			// if (parseFloat(totalBarang) < parseFloat(jml_outstandingBawah) && $("#cmbStatusPoDetail").val() == "FINISH"){
			// 	alert("Total Barang belum memenuhi Toleransi Order, belum bisa di Close!!!");
			// 	return (false);
			// }

			return (true);
		} else {
			flagSubmit = true;
			return false;
		}
	}

	function validasiL(form) {
		var NomerSP = document.getElementById('txtNomerSPL');
		if (NomerSP.value == "") {
			alertify.alert("<font color='red'>Nomer SP belum diisi!</font>");
			NomerSP.focus();
			return (false);
		}

		var JmlBarang = document.getElementById('txtJumlahBarangL');
		if (JmlBarang.value == "") {
			alertify.alert("<font color='red'>Jumlah Barang belum diisi!</font>");
			JmlBarang.focus();
			return (false);
		}
	}

	function getTotalBarang() {
		var totalBarang = 0;
		for (var i = 1; i <= totalDetailTerima; i++) {
			var bla = $("#txtJumlahBarang" + i).val();

			if (typeof bla !== 'undefined') {
				totalBarang += parseFloat(bla);
			}
		}

		return totalBarang;
	}



	$('#txtJumlahBarang').keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			flagSubmit = false;
			tambahTerima();
		}
	});

	$('#txtKodeBarcode').keypress(function(event) {
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if (keycode == '13') {
			flagSubmit = false;
			var KB = $('#txtKodeBarcode').val().replace(/\-/g, "");
			if (KB.length > 17) {
				alert("Panjang Barcode Maksimal 17 Digit");
				$('#txtKodeBarcode').focus();
			} else {
				// $('#txtNomerSP').val(KB.substr(KB.length-3));
				// $('#txtJumlahBarang').focus();
				$('#txtNomerSP').val(KB.substr(8, 4));
				$('#txtJumlahBarang').val(KB.substr(12));
				tambahTerima();
			}
		}
	});


	$("#txtJumlahBarang").keydown(function(event) {
		// Allow only backspace and delete
		if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 13) {
			// let it happen, don't do anything
		} else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57) {
				event.preventDefault();
			}
		}
	});

	$("#txtJumlahBarangL").keydown(function(event) {
		// Allow only backspace and delete
		if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 13) {
			// let it happen, don't do anything
		} else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57) {
				event.preventDefault();
			}
		}
	});


	$("#txtJumlahBarangL").keyup(function(event) {
		var batas_atasS = $("#lblIOutstandingAtasL").text().split(":");
		var batas_atas = batas_atasS[1];

		var batas_bawahS = $("#lblIOutstandingBawahL").text().split(":");
		var batas_bawah = batas_bawahS[1];


		if (parseFloat($("#txtJumlahBarangL").val()) < parseFloat(batas_bawah)) {
			$("#cmbStatusPoDetailL").val("OTW").attr("disabled", true);
		}
		if (parseFloat($("#txtJumlahBarangL").val()) > parseFloat(batas_atas)) {
			alertify.alert("<font color='red'>Jumlah melebihi batas toleransi +10 %!!!</font>");
			$("#txtJumlahBarangL").val("").focus();
		}
		if (parseFloat($("#txtJumlahBarangL").val()) >= parseFloat(batas_bawah) && parseFloat($("#txtJumlahBarangL").val()) <= parseFloat(batas_atas)) {
			$("#cmbStatusPoDetailL").val("OTW").attr("disabled", false);
		}
	});


	$("#txtNomerSP").keydown(function(event) {
		// Allow only backspace and delete
		if (event.keyCode == 46 || event.keyCode == 8) {
			// let it happen, don't do anything
		} else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57) {
				event.preventDefault();
			}
		}
	});

	// window.addEventListener('keydown', function(e) {
	//        if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
	//            if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
	//                e.preventDefault();
	//                return false;
	//            }
	//        }
	//    }, true);
</script>