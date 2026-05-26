<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/iCheck/icheck.min.js"></script>
<!-- date-picker -->
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>

<script type="text/javascript">
	var Xid_barang = "";
	var Xoutstanding = "";
	var nomorDetail=0;
	var jumlahDetail=0;
	var totalBarang=0;

	$(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()

	    //Datemask dd/mm/yyyy
	    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
	  
	    //Money Euro
	    $('[data-mask]').inputmask()

	    //Datatable
	    $("#example1").DataTable({"ordering": false});
	    $("#example2").DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": false,
	      "info": true,
	      "autoWidth": true
	    });

	    //Colorpicker
	    $('.my-colorpicker1').colorpicker()
	    //color picker with addon
	    $('.my-colorpicker2').colorpicker()


	    //iCheck for checkbox and radio inputs
	    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
	      checkboxClass: 'icheckbox_minimal-blue',
	      radioClass   : 'iradio_minimal-blue'
	    })
	    //Red color scheme for iCheck
	    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
	      checkboxClass: 'icheckbox_minimal-red',
	      radioClass   : 'iradio_minimal-red'
	    })
	    //Flat red color scheme for iCheck
	    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
	      checkboxClass: 'icheckbox_flat-green',
	      radioClass   : 'iradio_flat-green'
	    })
	});

	$(document).ready(function(){
		var tanggalAwal=$('input[name="tanggalAwal"]'); 
		var tanggalAkhir=$('input[name="tanggalAkhir"]'); 
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		var options={
		    language:'id',
		    format: 'dd MM yyyy',
		    container: container,
		    todayHighlight: true,
		    autoclose: true,
		};
		
		tanggalAwal.datepicker(options);
		tanggalAkhir.datepicker(options);
	})

	$('#modal-detail').on('show.bs.modal', function(e) {
	 	var abc = e.relatedTarget.id;

	 	var xxx = abc.split("@");
	 	var yyy = xxx[0];
	 	var zzz = xxx[1];
	 	var id_gudang_order = xxx[2];

	 	$('#txtNomerIPB').val("");
	 	$('#txtJmlRoll').val("");
	 	$('#txtIdGudangOrder').val(id_gudang_order);
	 	$('#txtSeri').val(xxx[4]);
	 	$('#txtOutstanding').val(zzz);

		$('#cmbIPBX').empty();
		$('#cmbIPBX').append(`<option value=""></option>`).val("").trigger("change");
		$('#cmbPenerima').val("").trigger("change");
		$('#cmbPemberi').val("").trigger("change");
		$('#cmbPengawas').val("").trigger("change");


	 	var Parents = document.getElementById('tblDetailPengeluaran');
	    while (Parents.firstChild) {
	        Parents.removeChild(Parents.firstChild);
	    }
        $("#lblJumlah").text("Jumlah : 0");
        $("#lblOutstanding").text("Outstanding : " + xxx[3]);

	 	Xid_barang = yyy;
	 	Xoutstanding = zzz;
   		
   		/*
		$.ajax({
        type: 'post',
        url: '<?php //echo site_url('sgt/gudang/pengeluaran_barang/list_barang');?>',
        data:{id_barang:yyy,outstanding:zzz},
        success:
        	function (response) {
	            // We get the element having id of display_info and put the response inside it
	            $( '#tblDetailPenengeluaran' ).html(response);
	        }
        });
        */



		//binding IPB aktif 

		// console.log(xxx);
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/gudang/pengeluaran_barang/getIpbOrderByIdKKDetail');?>',
        data:{id_kk_detail:xxx[5]},
        dataType: "json",
        success:
        	function (response) {
				// console.log(response);
				// 0:
				// ID: "18"
				// NOMER: "007"

				// 1:
				// ID: "19"
				// NOMER: "008"

				response.forEach(xx => {
						addVal = xx['ID'];
						addText = xx['NOMER'];

						$('#cmbIPBX').append(`<option value="${addVal}">${addText}</option>`);
					});
	        }
        });

	})



	function showBarang() {
		//kosongi table
		$("#tblDetailPengeluaran").empty();


		if (cmbIPBX.value != '') {
			$.ajax({
			type: 'post',
			url: '<?php echo site_url('sgt/gudang/pengeluaran_barang/getBarangByIdIpb');?>',
			data:{id_ipb:cmbIPBX.value},
			dataType: "json",
			success:
				function (response) {
					console.log(response);
					// 0:
					// 	BARCODE: "2121023300805740"
					// 	GRADE: "1"
					// 	ID: "31"
					// 	ID_DETAIL_TERIMA: "1784"
					// 	ID_IPB: "18"
					// 	ID_TERIMA: "678"
					// 	KODE_ROLL: "0233-00-00-01-2021"
					// 	QTY_TERIMA: "5740"
					// 	SATUAN: "MTR"
					// 	STATUS: "ORDER"
					// 	STATUS_QC: "BOOKING"
					// 1:
					// 	BARCODE: "2121023400806000"
					// 	GRADE: "1"
					// 	ID: "32"
					// 	ID_DETAIL_TERIMA: "1785"
					// 	ID_IPB: "18"
					// 	ID_TERIMA: "678"
					// 	KODE_ROLL: "0234-00-00-01-2021"
					// 	QTY_TERIMA: "6000"
					// 	SATUAN: "MTR"
					// 	STATUS: "ORDER"
					// 	STATUS_QC: "BOOKING"
					// ======================================================

					i=0;
					total_barang=0;


					response.forEach(xx => {
						dataTable =
				    	`<tr>
				    		<td hidden><input type='text' id='txtIdDetailTerima`+i+`' name='txtIdDetailTerima`+i+`' class='form-control' value='`+xx['ID_DETAIL_TERIMA']+`'></td>
				    		<td width = '175'><input type='text' id='txtBarcode`+i+`' name='txtBarcode`+i+`' class='form-control' value='`+xx['KODE_ROLL']+`' readonly></td>
				    		<td width = '175'><input type='text' id='txtQty`+i+`' name='txtQty`+i+`' class='form-control' value='`+xx['QTY_TERIMA']+`' readonly style='text-align:right;'></td>
				    		<td width = '150'><input type='text' id='txtSatuan`+i+`' name='txtSatuan`+i+`' class='form-control' value='`+xx['SATUAN']+`' readonly></td>
				    	</tr>`;

						$("#tblDetailPengeluaran").append(dataTable);

						total_barang += parseInt(xx['QTY_TERIMA']);
						i++;
					});

					dataInfo =
						`<input type='hidden' id='txtTotalBarang' name='txtTotalBarang' class='form-control' value=`+total_barang+`>
						<input type='hidden' id='txtTotalList' name='txtTotalList' class='form-control' value=`+i+`>`;

					$("#infoTable").html(dataInfo);
					
					$("#lblJumlah").text("Jumlah : " + $("#txtTotalBarang").val());
				}
			});
		}

	}
	


	function getRoll()
	{
	 	var XjmlRoll = $('#txtJmlRoll').val();

		$.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/gudang/pengeluaran_barang/list_barang');?>',
        data:{id_barang:Xid_barang,outstanding:Xoutstanding,jmlRoll:XjmlRoll},
        dataType: "json",
        success:
        	function (response) {
	            // We get the element having id of display_info and put the response inside it
	            $("#tblDetailPengeluaran").empty();
	            $("#tblDetailPengeluaran").append(response['dataTable']);
	            $("#infoTable").html(response['dataInfo']);
        		$("#lblJumlah").text("Jumlah : " + $("#txtTotalBarang").val());
        		// console.log(response);
	        }
        });

        $('#txtJmlRoll').val("");
	}



	// function loaddata()
	// {
	//     var name=document.getElementById( "username" );
	//     if(name)
	//     {
	// 	    $.ajax({
	//             type: 'post',
	//             url: 'tampildata.php',
	//             data:{user_name:name,},
	//             success:
	//             	function (response) {
	// 		            // We get the element having id of display_info and put the response inside it
	// 		            $( '#display_info' ).html(response);
	// 		        }
	//         });
	//     }
	//     else
	//     {
	//     	$( '#display_info' ).html("Please Enter Some Words");
	//     }
 	//   }


 	function validasi(form){

		var jml_totalBarang = $("#txtTotalBarang").val();
		var jml_outstanding = $("#txtOutstanding").val();

		if ($('#txtNomerIPB').val() == ""){
			alert("Nomer IPB belum diisi!!!");
			$("#txtNomerIPB").focus();
			return (false);							
		}

		if (jml_totalBarang == "0" || typeof jml_totalBarang == 'undefined'){
			alert("Tidak ada barang yang dikeluarkan!");
			return (false);								
		}
		
		if (parseFloat(jml_totalBarang) >= parseFloat(jml_outstanding)){
		 	$("#txtStatusGudangOrder").val("CLOSE");
		}

		return (true);
	}

	function validasiIpb(){
		var kembalian = false;

		if (cmbIPBX.value != "") {
			if (cmbPenerima.value != "") {
				if (cmbPemberi.value != "") {
					if (cmbPengawas.value != "") {
						kembalian = true;
					}else{
						alert("Pengawas belum dipilih !!!");
					}
				}else{
					alert("Pemberi belum dipilih !!!");
				}
			}else{
				alert("Penerima belum dipilih !!!");
			}
		}else{
			alert("IPB belum dipilih !!!");
		}

		return (kembalian);
	}

	function validasiManual(form){
		if ($('#txtMNomerIPB').val() == ""){
			alert("Nomer IPB belum diisi!!!");
			$("#txtMNomerIPB").focus();
			return (false);							
		}

		if (jumlahDetail == "0"){
			alert("Tidak ada barang yang dikeluarkan!");
			return (false);								
		}
		
		if (parseFloat(totalBarang) >= parseFloat($("#txtMOutstanding").val())){
		 	$("#txtMStatusGudangOrder").val("CLOSE");
		}

		return (true);
	}

	function tambahDetail(){
		// alert(cmbMBarang.value);
		if (cmbMBarang.value == ""){
			alert("Pilih Barcode dulu!!!");
			$('#cmbMBarang').focus();
		}else{
			if (totalBarang < $('#txtMOutstanding').val()){
				var dStok = <?php echo json_encode($stokBarang); ?>;
			    var listStok = getByValue(dStok,cmbMBarang.value);
				// console.log(listStok);
				var markup = "<tr><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + listStok[0]['BARCODE'] + "' name='txtDBarcode"+nomorDetail+"' id='txtDBarcode"+nomorDetail+"'><input type='hidden' readonly class='form-control form-control-sm' value='" + listStok[0]['ID_DETAIL_TERIMA'] + "' name='txtDIdDTerima"+nomorDetail+"' id='txtDIdDTerima"+nomorDetail+"'></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + listStok[0]['QTY_TERIMA'] + "' name='txtDJumlah"+nomorDetail+"' id='txtDJumlah"+nomorDetail+"'></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + listStok[0]['SATUAN'] + "' name='txtDSatuan"+nomorDetail+"'></td><td><input type='button' value='x' class='btn btn-block btn-danger btn-sm' onclick='hapusDetail(this)' id='btnHapus_"+nomorDetail+"'></td></tr>";

		        $("#tblMDetailPengeluaran").append(markup);
		        $("#cmbMBarang option[value='"+ listStok[0]['ID_DETAIL_TERIMA'] +"']").remove();
		        $('#cmbMBarang').val('').trigger('change');

		        txtNomorDetail.value = nomorDetail;
		        nomorDetail++;
		        jumlahDetail++;
		        totalBarang += parseFloat(listStok[0]['QTY_TERIMA']);
			 	$('#lblMJumlah').text("Total Barang : "+totalBarang);
			}else{
				alert("Total Barang melebihi Outstanding");
				$('#cmbMBarang').val('').trigger('change').focus();
			}
		}
	}

	function getByValue(arr, value) {
	    var xxx = []
	    for (var i=0, iLen=arr.length; i<iLen; i++) {
	      	if (arr[i].ID_DETAIL_TERIMA == value){
	      	xxx.push(arr[i]);}
	    }
	    return xxx;
	}


	function getAllRoll(data_id_gudang_order)
	{
		$("#cmbMBarang").html("");
	
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/gudang/pengeluaran_barang/all_barang');?>',
        data:{id_gudang_order:data_id_gudang_order},
        success:
        	function (response) {
	            // We get the element having id of display_info and put the response inside it
	            $( '#cmbMBarang' ).append(response).trigger('change');
	        }
        });
	}


	$('#modal-manual').on('show.bs.modal', function(e) {
	 	var abc = e.relatedTarget.id;

	 	var xxx = abc.split("@");
	 	var yyy = xxx[0];
	 	var zzz = xxx[1];
	 	// var id_gudang_order = xxx[2];
	 	getAllRoll(zzz);

	 	$('#txtMNomerIPB').val("");
	 	$('#txtMOutstanding').val(yyy);
	 	$('#txtMIdGudangOrder').val(zzz);

	  	$("#tblMDetailPengeluaran").find("tr:not(:first)").remove();
        // $("#lblJumlah").text("Jumlah : 0");

	 	// Xid_barang = yyy;
	 	// Xoutstanding = zzz;
	 	jumlahDetail = 0;
	 	nomorDetail = 0;
	 	totalBarang = 0;
	 	$('#txtNomorDetail').val(nomorDetail);
	 	$('#lblMJumlah').text("Total Barang : "+totalBarang);
	 	$('#lblOutstanding').text("Outstanding : "+yyy);
	})


	function hapusDetail(btn){
		idbtn = btn.id;
		var xxx = idbtn.split("_");
	 	var nomer = xxx[1];
	 	
	    var newOption = new Option($('#txtDBarcode'+nomer).val(), $('#txtDIdDTerima'+nomer).val(), true, true);
	    $('#cmbMBarang').append(newOption).val('').trigger('change');
		
	  	totalBarang -= parseFloat($('#txtDJumlah'+nomer).val());
	 	$('#lblMJumlah').text("Total Barang : "+totalBarang);

	 	var row = btn.parentNode.parentNode;
	  	row.parentNode.removeChild(row);
	  	jumlahDetail--;
	}

	
	
</script>



<?php
	if (isset($_SESSION['cetak'])) {
		if ($_SESSION['cetak'] != "") {
			print_r("
				<script type='text/javascript'>
					window.open('".$_SESSION['cetak']."', '_blank');
				</script>
			");
			$_SESSION['cetak'] = "";
		}
	}
?>