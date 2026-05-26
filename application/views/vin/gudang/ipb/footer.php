<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>




<script type="text/javascript">
	var pjgRoll = 0;

    $(document).ready(function() {  
        
		$('#txtTanggal').Zebra_DatePicker({
		    direction: 0,
		    // pair: $('#tanggal_selesai'),
		    format: 'd-m-Y'
		});

		$('#tanggalAwal').Zebra_DatePicker({
		    direction: 0,
		    pair: $('#tanggalAkhir'),
		    format: 'd-m-Y'
		});

		$('#tanggalAkhir').Zebra_DatePicker({
		    direction: 0,
		    // pair: $('#tanggal_selesai'),
		    format: 'd-m-Y'
		});


		$("#tblBarang").DataTable({
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


		$('#tblBarang tbody').on( 'click', 'tr', function () {

			if ( $(this).hasClass('selected') ) {
				// $(this).removeClass('selected');
				$(this).find("input:eq(1)").val("F");

				pjg = $(this).find("td:eq(2)").text().split(' ');
				if (pjg[0]!='') {
					pjgRoll -= parseInt(pjg[0]);
					txtJumlah.value = pjgRoll;
				}
			}
			else {
				// $(this).addClass('selected');
				$(this).find("input:eq(1)").val("T");

				pjg = $(this).find("td:eq(2)").text().split(' ');
				if (pjg[0]!='') {
					pjgRoll += parseInt(pjg[0]);
					txtJumlah.value = pjgRoll;
				}
			}
		} );


	} );


	function generateNomer(Xseri) {
		
		// dataNomer = <?php //echo json_encode($nomer_ipb); ?>;

		$.ajax({
		type: 'post',
		url: '<?php echo site_url('sgt/gudang/ipb/getNomer');?>',
		data:{seri:Xseri},
		dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
		success:
			function (data) {
				// console.log(data);
				// 0:
				// 	ID: "1"
				// 	KETERANGAN: "IPB PET 1"
				// 	NOMER: "17"
				// 	TAHUN: "2021"
				// ==========================================

				nomerIPB = parseInt(data[0]['NOMER'])+1;
				var pad = "000"
				var ans = pad.substring("0",pad.length - String(nomerIPB).length) + String(nomerIPB);
				
				var ket = data[0]['KETERANGAN'];
				var ketVal = '0';
				if (ket == 'IPB PET 1') {
					ketVal = '1';
				}
				if (ket == 'IPB PET 2') {
					ketVal = '2';
				}
				if (ket == 'IPB PET 3') {
					ketVal = '3';
				}
				if (ket == 'IPB PET M') {
					ketVal = 'M';
				}

				var d = new Date();
				var n = d.getMonth();
				romawiBulan = '';
				if (n == 0) {
					romawiBulan = 'I'
				}
				if (n == 1) {
					romawiBulan = 'II'
				}
				if (n == 2) {
					romawiBulan = 'III'
				}
				if (n == 3) {
					romawiBulan = 'IV'
				}
				if (n == 4) {
					romawiBulan = 'V'
				}
				if (n == 5) {
					romawiBulan = 'VI'
				}
				if (n == 6) {
					romawiBulan = 'VII'
				}
				if (n == 7) {
					romawiBulan = 'VIII'
				}
				if (n == 8) {
					romawiBulan = 'IX'
				}
				if (n == 9) {
					romawiBulan = 'X'
				}
				if (n == 10) {
					romawiBulan = 'XI'
				}
				if (n == 11) {
					romawiBulan = 'XII'
				}
				
				nomerSMT = String(ans)+"/"+ketVal+"/PNP-HLG/EMB/"+romawiBulan+"/"+d.getFullYear();
				
				txtNomer.value = nomerSMT;


			},
		error: 
			function (request, error) {
				console.log(arguments);
				alert("Can't do because : " + error);
			}
		});

	}

	function validasi(){
		var kembalian = false;

		if (txtTanggal.value != "") {
			if (txtNomer.value != "") {
				if (cmbKK.value != "") {
					if (cmbBarang.value != "") {
						if (txtJumlah.value != "") {
							kembalian = true;
						}else{
							alert("Barang belum dipilih !!!");
						}
					}else{
						alert("Barang belum dipilih !!!");
					}
				}else{
					alert("KK belum dipilih !!!");
				}
			}else{
				alert("Nomer belum dipilih !!!");
			}
		}else{
			alert("Tanggal belum dipilih !!!");
		}

		return (kembalian);
	}


    function showBarang() {
		if (cmbKK.value == '') {
			$('#cmbBarang').find('option:not(:first)').remove();
			$("#cmbBarang").val("").change(); 

			txtJumlah.value = '';
			txtSatuan.value = "";
			pjgRoll=0;
			txtNomer.value = "";
		}else{
			cmbKKval = cmbKK.value.split("@");

			generateNomer(cmbKKval[1]);

			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/gudang/ipb/getBarang');?>',
			data:{id_kk:cmbKKval[0]},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);
					// 0:
                    //     AKTIF: "2"
                    //     FLAG_PENERIMAAN: "LABEL"
                    //     FLAG_PENGELUARAN: "FIFO"
                    //     FLAG_PENGGUNAAN: "CONTINUE"
                    //     ID: "1093"
                    //     ID_BAHAN_BAKU: "1093"
                    //     ID_CS_RISALAH_DETAIL: "1"
                    //     ID_INPUT: "129"
                    //     ID_KK: "1"
                    //     ID_LOCATION: "1"
                    //     ID_PROSES: "0"
                    //     JENIS: "BB - BAHAN BAKU"
                    //     JUMLAH: "6000"
                    //     KATEGORI: "PRODUKSI"
                    //     KODE: "BB0020"
                    //     KODE_SIMPG: "12.299.03407"
                    //     MIN_STOK: "0"
                    //     NAMA: "PETM. 12 MIC R. BAND SOFT PALE GREEN"
                    //     NOMER: "036/PNP-HLG/PPC/KKM/X/2019"
                    //     NO_REKJURNAL: "1172.06"
                    //     QC_TEST: "1"
                    //     QTY: "6,0E+003"
                    //     SATUAN: "MTR"
                    //     SERI: "SERI I"
                    //     SPESIFIKASI: "TA 2021/ 73 CM"
                    //     STATUS: "OPEN"
                    //     TAHUN: "2021"
                    //     TGL_INPUT: "05-11-2020"
                    //     TGL_PROSES: "01-01-2021"
                    //     UKURAN: "-"
                    //     UPDATED: "05-11-2020"
                    //     UPDATED_STATUS: "0"
                    //     ID_KK_DETAIL: 1
					// ==========================================


					$('#cmbBarang').find('option:not(:first)').remove();
					$("#cmbBarang").val("").change(); 

					data.forEach(xx => {
						addVal = xx['ID'];
						addText = xx['NAMA'] + ' ' + xx['SPESIFIKASI'];
						addSautan = xx['SATUAN'];
						addIdKK_Detail = xx['ID_KK_DETAIL'];

						$('#cmbBarang').append(`<option value="${addVal}@${addSautan}@${addIdKK_Detail}">${addText}</option>`);

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




    function showStok() {
		txtSatuan.value = "";
		txtJumlah.value = '';
		pjgRoll=0;

		//kosongi tabel
		table = $(tblBarang).dataTable();
		table.fnClearTable(this);

		if (cmbBarang.value != '') {
           
			dataX = cmbBarang.value 
            dataY = dataX.split('@');
            txtSatuan.value = dataY[1];

			//isi tabel
			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/gudang/ipb/getStokByIdBarang');?>',
			data:{id_barang:dataY[0]},
			dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
			success:
				function (data) {
					// console.log(data);
					// 0:
					// 	BARCODE: "2121019600426000"
					// 	GRADE: "1"
					// 	ID_DETAIL_TERIMA: "1747"
					// 	ID_TERIMA: "670"
					// 	KODE_ROLL: "0196-00-00-01-2021"
					// 	QTY_TERIMA: "6000"
					// 	SATUAN: "MTR"
					// 	STATUS_QC: "T_OK"
					// 1:
					// 	BARCODE: "2121019700426000"
					// 	GRADE: "1"
					// 	ID_DETAIL_TERIMA: "1748"
					// 	ID_TERIMA: "670"
					// 	KODE_ROLL: "0197-00-00-01-2021"
					// 	QTY_TERIMA: "6000"
					// 	SATUAN: "MTR"
					// 	STATUS_QC: "T_OK"
					//	NAMA: "PETM. 12 MIC R. BAND SOFT PALE GREEN"
					// ======================================
					//tampung di tabel

					data.forEach(xx => {
						addidDetailTerima = xx['ID_DETAIL_TERIMA'];
						addKodeRoll = xx['KODE_ROLL'];
						addNama = xx['NAMA'];
						addQTY = xx['QTY_TERIMA'] + ' ' + xx['SATUAN'];

						table.fnAddData([
							addKodeRoll + '<input type="hidden" name="ArridDetailTerima[]" value="'+ addidDetailTerima +'" />' + '<input type="hidden" name="ArrPilih[]" value="F" />',
							addNama,
							addQTY
						]);
						
					});

					table.fnDraw();


				},
			error: 
				function (request, error) {
					console.log(arguments);
					alert("Can't do because : " + error);
				}
			});
			
		}
    }



</script>