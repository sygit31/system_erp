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
        url: '<?php //echo site_url('gudang/pengeluaran_barang/list_barang');?>',
        data:{id_barang:yyy,outstanding:zzz},
        success:
        	function (response) {
	            // We get the element having id of display_info and put the response inside it
	            $( '#tblDetailPenengeluaran' ).html(response);
	        }
        });
        */
	})

	
	function getRoll()
	{
	 	var XjmlRoll = $('#txtJmlRoll').val();

		$.ajax({
        type: 'post',
        url: '<?php echo site_url('gudang/pengeluaran_barang/list_barang');?>',
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
        url: '<?php echo site_url('gudang/pengeluaran_barang/all_barang');?>',
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