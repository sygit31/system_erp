<!-- date-picker -->
<script src="<?php echo base_url(); ?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>





<script type="text/javascript">
	$(document).ready(function() {
		var tglProses = $('input[name="tglProses"]');
		var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
		var options = {
			language: 'id',
			format: 'dd MM yyyy',
			container: container,
			todayHighlight: true,
			autoclose: true,
		};
		
		tglProses.datepicker(options);
	})


	$('#modal-detail').on('show.bs.modal', function(e) {
		var data = e.relatedTarget.id;
		// alert(data);

		data = data.split("@");
		$("#txtIdRisalah").val(data[0]);
		$("#txtNomer").val(data[1]);
		$("#txtNama").val(data[2]);
		$("#txtDesain").val(data[3]);
		$("#txtOutstanding").val(data[4]);
		$("#txtIdProses").val(data[5]);

		$("#tblGenerate").hide();

		// while (Parents.firstChild) {
		//     Parents.removeChild(Parents.firstChild);
		// }

		// var today = new Date();
		// Tanggal.value = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
		// $("#dmTanggal").datepicker("setDate", new Date()).datepicker({ dateFormat: "mm/dd/yy"});

		$("#txtOplah").val('');
		$("#tglProses").val('');
		
		setTimeout(function() {
			$("#txtOplah").focus();
		}, 300);
	})


	function generateKK() {
		var id_risalah = $("#txtIdRisalah").val();
		var id_proses = $("#txtIdProses").val();
		var oplah = $("#txtOplah").val();
		var tanggal = $("#tglProses").val();
		// var jkEmbos = $('#cmbJamKerjaEmbos option:selected').val();
		// var jkCoatingSensi = $('#cmbJamKerjaCoatingSensi option:selected').val();
		// var jkSensiRead = $('#cmbJamKerjaSensiReadible option:selected').val();
		// var jkBelah = $('#cmbJamKerjaSlitter option:selected').val();

		// console.log('id_risalah:'+id_risalah+',oplah:'+oplah+',tanggal:'+tanggal+',jkEmbos:'+jkEmbos+',jkCoatingSensi:'+jkCoatingSensi+',jkSensiRead:'+jkSensiRead+',jkBelah:'+jkBelah);
		// generateKK(id_risalah,oplah,tanggal,jkEmbos,jkCoatingSensi,jkSensiRead,jkBelah);

		getNomerKK($("#txtDesain").val(), tanggal);
		var macam = $("#txtNama").val() + ' TA ' + $("#txtDesain").val();
		$("#lblMacam").text(macam);
		var jmlPesanan = $("#txtOplah").val() + ' Meter';
		$("#lblKonversiKertas").text(jmlPesanan);
		var tglProses = $("#tglProses").val();
		$("#lblTglProses").text(tglProses);
		


		//konversi oplah ke kebutuhan
		getKebutuhan(id_proses,oplah);

		// // isi detail kk
		// $('#tblGenerate').find('tr:gt(16)').remove();

		// getDetailProsesBahan(id_proses);
	}


	function getDetailProsesBahan(id_proses,konversiKebutuhan) {
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/ppic/kk/generate'); ?>',
			// data:{id_risalah:id_risalah,id_proses:id_proses,oplah:oplah,tanggal:tanggal,jkEmbos:jkEmbos,jkCoatingSensi:jkCoatingSensi,jkSensiRead:jkSensiRead,jkBelah:jkBelah},
			data: {
				id_proses: id_proses
			},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success: function(data) {
				// console.log(data);
				// console.log(data['Station']);
				// console.log(data['BOM']);
				var ArrStation = data['Station'];
				var ArrBOM = data['BOM'];

				var appendText = "";
				for (let index = 0; index < ArrStation.length; index++) {
					var NamaStation = ArrStation[index]['NAMA'];
					var IdStation = ArrStation[index]['ID_STATION_FLOW'];
					appendText += "<tr height='20'><td colspan='2' /></tr>";
					appendText +=
						"<tr>\
						<td colspan='2'>\
							<b>Proses : " + NamaStation + "</b>\
						</td>\
					</tr>";

					var BOMperStation = ArrBOM[IdStation];
					if (BOMperStation.length > 0) {
						appendText +=
							"<tr>\
							<td colspan='2'>\
								Formula :\
							</td>\
						</tr>";
						for (let i = 0; i < BOMperStation.length; i++) {
							// console.log(BOMperStation[i]);
							var IDBOM = BOMperStation[i]['ID_BOM'];
							var IDBarang = BOMperStation[i]['ID_BARANG'];
							var NamaBarang = BOMperStation[i]['NAMA'];
							var QTYBarang = BOMperStation[i]['QTY'];
							var Satuan = BOMperStation[i]['SATUAN'];
							var Spesifikasi = BOMperStation[i]['SPESIFIKASI'];
							var Jenis = BOMperStation[i]['JENIS'];
							var Tahun = BOMperStation[i]['TAHUN'];

							var xxx = parseFloat(QTYBarang.replace(",", ".")) * konversiKebutuhan;
							// var xxx = konversiKebutuhan;
							// console.log(QTYBarang);
							appendText +=

								"<tr>\
								<td colspan='2'>\
									<table>\
										<tr>\
											<td width='80'/>\
											<td>- " + NamaBarang + " <td>\
											<td><font color='red'>" + xxx.toFixed(2) + " </font><td>\
											<td>" + Satuan + " <td>\
										</tr>\
									</table>\
								</td>\
							</tr>";
						}

					}
				}

				$("#tblGenerate").append(appendText);
				$("#tblGenerate").show();

			},
			error: function(request, error) {
				console.log(arguments);
				// alert("Can't do because : " + error);
			}
		});
	}


	function getNomerKK(tahun, tglProses) {
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/ppic/kk/getNoKK'); ?>',
			data: {
				tahun: tahun
			},
			// dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success: function(data) {
				var bulanS = tglProses.split(" ");
				var bulan = bulanS[1];
				bulan == 'Januari' ? bulan = 'I' : '';
				bulan == 'Februari' ? bulan = 'II' : '';
				bulan == 'Maret' ? bulan = 'III' : '';
				bulan == 'April' ? bulan = 'IV' : '';
				bulan == 'Mei' ? bulan = 'V' : '';
				bulan == 'Juni' ? bulan = 'VI' : '';
				bulan == 'Juli' ? bulan = 'VII' : '';
				bulan == 'Agustus' ? bulan = 'VIII' : '';
				bulan == 'September' ? bulan = 'IX' : '';
				bulan == 'Oktober' ? bulan = 'X' : '';
				bulan == 'November' ? bulan = 'XI' : '';
				bulan == 'Desember' ? bulan = 'XII' : '';

				var str = "" + data;
				var pad = "000";
				var ans = pad.substring(0, pad.length - str.length) + str;

				$nomerKK = ans + "/PNP-HLG/PPC/KKM/" + bulan + "/" + tahun;

				$("#lblNoKK").text($nomerKK);

			},
			error: function(request, error) {
				console.log(arguments);
			}
		});
	}

	function getKebutuhan(id_proses, oplah){
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/ppic/kk/getKebutuhan'); ?>',
			data: {
				id_proses : id_proses,
				oplah : oplah
			},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success: function(data) {
				// console.log(data);
				$("#lblWastePita").text(data['waste_pita'] + ' %');
				$("#lblWastePerekat").text(data['waste_perekatan'] +' %');
				$("#lblWasteBelah").text(data['waste_belah'] +' %');

				$("#lblBahanUtama").text(data['bahan_utama']);
				$("#lblPanjang").text(data['kebutuhan']+' '+data['satuan_bu']);

				//konversi roll
				var bulatkan = parseFloat(data['kebutuhan']) / 6000
				var Abulatkan = bulatkan.toFixed(1).toString().split(".");
				if (Abulatkan.length == 2) {
					bulatkan = Abulatkan[0];
					if (Abulatkan[1] >= 5){bulatkan = parseInt(bulatkan) + 1;}
					$("#lblKonversiRoll").text(bulatkan);
				}else{
					$("#lblKonversiRoll").text(bulatkan);
				}

				$("#lblBahanKonversi").text(bulatkan * 6000);
				
				
				// isi detail kk
				$('#tblGenerate').find('tr:gt(16)').remove();
				getDetailProsesBahan(id_proses,data['kebutuhan']);
			},
			error: function(request, error) {
				console.log(arguments);
			}
		});
	}

	var rupiah = document.getElementById('txtOplah');
	rupiah.addEventListener('keyup', function(e) {
		// tambahkan 'Rp.' pada saat form di ketik
		// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		rupiah.value = formatRupiah(this.value, 'Rp. ');
	});

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		// return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
	}
	
</script>