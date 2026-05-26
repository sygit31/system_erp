<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Attention -->
<script src="<?php echo base_url();?>assets/attention/dist/attention.js"></script>
<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>



<script type="text/javascript">
	var nomorDetail = 0;
	var nomorC = [];
	var nomorO = [];
	var parameters = [];
	var SaveTestQc = [];

	$(function () {
		$('#tanggalAwal').Zebra_DatePicker({
		    // direction: true,
		    pair: $('#tanggalAkhir'),
		    format: 'd-m-Y'
		});
		 
		$('#tanggalAkhir').Zebra_DatePicker({
		    direction: 1,
		    format: 'd-m-Y'
		});
	    
	    $("#example2").DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": false,
	      "info": true,
	      "autoWidth": true
	    });
	    $("#example1").DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": false,
	      "info": true,
	      "autoWidth": true
	    });
	});


	$('#modal-detail').on('show.bs.modal', function(e) {
	 	var abc = e.relatedTarget.id;

	 	var xyz = abc.split("@");
	 	var id_detail_terima = xyz[0];
	 	getSaveTestQc(id_detail_terima);

	 	txtIdDetailTerima.value = id_detail_terima;
	 	txtNoSp.value = xyz[1];
	 	txtBarcode.value = xyz[2];
	 	txtMaterial.value = xyz[3];
	 	OpenClose();

	 	$("#tblDetailTest").find("tr:gt(0)").remove(); //gt = kecuali, eq = terpilih
	 	nomorDetail = 0;
	 	
	 	getTest(id_detail_terima);
	})

	$('#modal-laporan').on('show.bs.modal', function(e) {
	 	var abc = e.relatedTarget.id;

	 	var xyz = abc.split("@");
	 	var id_detail_terima = xyz[0];

	 	txtBarcodeL.value = xyz[1];
	 	txtMaterialL.value = xyz[2];
	 	txtNoPoL.value = xyz[3];

	 	$("#tblDetailTestL").find("tr:gt(0)").remove(); //gt = kecuali, eq = terpilih
	 	
	 	getTestL(id_detail_terima);
	 	// getSyarat(xyz[4]);
	})

	function getTest(id_detail_terima){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('qc/cek_qc/getTest');?>',
        data:{id_detail_terima:id_detail_terima},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
	            // mengeluarkan data data[0];
	            for (var i = 0; i < data.length; i++) {
	            	var markup = "<tr><td><input name='txtDIdTestCode_"+nomorDetail+"' id='txtDIdTestCode_"+nomorDetail+"' value='" + data[i]['ID_TEST_CODE'] + "' type='hidden'><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + data[i]['TEST_DESCRIPTION'] + "' name='txtDDescription_"+nomorDetail+"' readonly></td><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + data[i]['PRIORITAS'] + "' name='txtDPrioritas_"+nomorDetail+"' readonly></td>";

            		getParameters(data[i]['ID_TEST_CODE']); //tampung parameters di array

	            	if (data[i]['JENIS'] == "visibility") {
	            		markup += "<td><input name='txtDJenis_"+nomorDetail+"' id='txtDJenis_"+nomorDetail+"' value='" + data[i]['JENIS'] + "' type='hidden'><select style='width: 100%;' id='txtDHasil_"+nomorDetail+"' name='txtDHasil_"+nomorDetail+"' onchange='OpenClose()'><option value=''></option></select></td>"; 
	            		
	            		getDetailTestCode(data[i]['ID_TEST_CODE'],nomorDetail);
	            	}else {
	            		markup += "<td><input name='txtDJenis_"+nomorDetail+"' id='txtDJenis_"+nomorDetail+"' value='" + data[i]['JENIS'] + "' type='hidden'><input type='text' class='form-control form-control-sm' style='text-align:center;' name='txtDHasil_"+nomorDetail+"' id='txtDHasil_"+nomorDetail+"' onkeypress='validateNomer(event)' onkeyup='OpenClose()'></td>"
	            	}
	            	markup += "</tr>";

                    $("#tblDetailTest").append(markup);

                    $tyu = getByValueSaveTest(SaveTestQc,data[i]['ID_TEST_CODE']); //binding data tersimpan measure
                    if($tyu !== null){
			        	$("#txtDHasil_"+nomorDetail).val($tyu); 
					}
			        

                    //bedakan row critical dan optional
                    if (data[i]['PRIORITAS'] == "critical") {
                    	nomorC.push(nomorDetail);
                    } else {
                    	nomorO.push(nomorDetail);
                    }

                    nomorDetail ++;
                    txtNomorDetail.value = nomorDetail;
	            }
	            // $('#btnSimpan').attr("disabled", false);
	        },
	    error: 
	    	function (request, error) {
        		console.log(arguments);
        		alert("Can't do because : " + error);
    		}
        });
	}

	function getTestL(id_detail_terima){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('gudang/stok_bayangan/getTest');?>',
        data:{id_detail_terima:id_detail_terima},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
	            // mengeluarkan data data[0];

	            for (var x = 0; x < data.length; x++) {
	            	var markup = "<tr align='center'><td>"+data[x]['TEST_DESCRIPTION']+"</td>";
	            	markup += "<td>"+data[x]['PRIORITAS']+"</td>";

	            	if (data[x]['JENIS'] == 'visibility'){
	            		var hasil = data[x]['HASIL'];
	            		var range = data[x]['RANGE'];
	            		if (hasil == null || hasil === "") {markup += "<td /></tr>";} else {
	            			markup += "<td>";

	            			if (range === '0') {markup += "<font color=red>"+hasil+"</font>";}
	            			// if (range === '1') {markup += "<font color=orange>"+hasil+"</font>";}
	            			// if (range === '2') {markup += "<font color=green>"+hasil+"</font>";}
	            			// if (range === '3') {markup += "<font color=blue>"+hasil+"</font>";}

	            			if (range === '1') {markup += hasil;}
	            			if (range === '2') {markup += hasil;}
	            			if (range === '3') {markup += hasil;}

	            			markup += "</td></tr>";}
	            	}else{
	            		var hasil_test = data[x]['HASIL_TEST'];
	            		if (hasil_test == null || hasil_test === "") {markup += "<td /></tr>";} else {
	            			// var xxx = JSON.parse(.....); // pakai JASON.parse untuk merubah ke array
	            			var xxx = getHasilMeasure(hasil_test,data[x]['ID_TEST_CODE']);
	            			// console.log(xxx);
	            			markup += "<td>"+xxx+"</td></tr>"
	            		}
	            	}


	            	$("#tblDetailTestL").append(markup);
	            }
	        },
	    error: 
	    	function (request, error) {
        		console.log(arguments);
        		alert("Can't do because : " + error);
    		}
        });
	}


	function getHasilMeasure(hasil_test,id_test_code){
		return $.ajax({
        type: 'post',
        url: '<?php echo site_url('gudang/stok_bayangan/getHasilMeasure');?>',
        data:{hasil_test:hasil_test,id_test_code:id_test_code},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        async: false
        }).responseText;
	}

	function getDetailTestCode(id_test_code,nmr){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('qc/cek_qc/getDetailTestCode');?>',
        data:{id_test_code:id_test_code},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
        		// console.log(data);
	            for (var i = 0; i < data.length; i++) {
	            	$("#txtDHasil_"+nmr).append("<option value="+data[i]['ID_DETAIL_TEST_CODE']+">"+data[i]['HASIL']+"</option>");
	            }
	            $("#txtDHasil_"+nmr).val(getByValueSaveTest(SaveTestQc,id_test_code)); //binding data tersimpan visibility, disini karena nunggu binding option dari ajax
	 			OpenClose(); //disable enable open close
	        }
        });
	}


	function getParameters(id_test_code) {
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('qc/cek_qc/getDetailTestCode');?>',
        data:{id_test_code:id_test_code},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
        		var parameter = [];
        		for (var i = 0; i < data.length; i++) {
	        		param = [data[i]['ID_DETAIL_TEST_CODE'],data[i]['RANGE'],data[i]['HASIL'],data[i]['MAX'],data[i]['MIN']];
	        		parameter.push(param);
	            }
	            parameters[id_test_code]=parameter;
	        }
        });
	}

	function getSaveTestQc(id_detail_terima) {
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('qc/cek_qc/getSaveTestQc');?>',
        data:{id_detail_terima:id_detail_terima},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
        		SaveTestQc = data;
        		// console.log(SaveTestQc);
	        }
        });
	}

	// async : eksekusi bebarengan
	// sync : eksekusi berurutan
	// function simpan(form) {
	$('#frm_input').submit(function(event) {
		event.preventDefault();
		var currentForm = this;
		if ($("#cmbStatus").val() == "CLOSE") {
			// console.log(parameters);
			//loop table dan baca apakah ada critical yang 0
			try{
				var grade = 1; //tentukan grade
				$('#tblDetailTest tr:not(:first-child)').each(function(){
		        	var idTest = $(this).find("td:eq(0)").find("input:eq(0)").val(); 
		            var prioritas = $(this).find("td:eq(1)").find("input").attr("value"); 
		            var jenis = $(this).find("td:eq(2)").find("input:eq(0)").attr("value"); 
		            
		            if (jenis == 'visibility'){
		            	var isi = $(this).find("td:eq(2)").find("option:selected").val(); 
		            	
		            	var parameter = parameters[idTest]; //ambil parameter
		            	// console.log(idTest);
		            	// console.log(parameter);
		            	var range = getByValueV(parameter,isi); //ambil range sesuai isi
		            	// console.log(range);
		            	if (range != ''){
			            	if (range == 1 && grade < 2){grade = 2;}
			            	if (range == 0 && grade < 3){grade = 3;}
			            }
		            }else{
		            	var isi = $(this).find("td:eq(2)").find("input:eq(1)").val(); 
		            	
		            	var parameter = parameters[idTest]; //ambil parameter
		            	var range = getByValueM(parameter,isi); //ambil range sesuai isi
		            	// console.log(parameter);
		            	// console.log(range);
		            	if (range != ''){
			            	if (range == 1 && grade < 2){grade = 2;}
			            	if (range == 0 && grade < 3){grade = 3;}
			            }
		            }
		        })	

		    	$("#txtGrade").val(grade);

				// A confirm dialog
				// new Attention.Confirm({
	            //     title: 'Nice confirm',
		        //     content: 'This is my content',
	            //     onCancel: function(component) {
	            //     		return false;
                //     },
                //     onConfirm: function(component) {
                //        	currentForm.submit();
                //     }
                // });

    			alertify.confirm("Barang masuk grade <font color='red'><b>"+grade+"</b></font> , yakin akan disimpan?", function (e) {
					if (e) {currentForm.submit();}
				});
			}catch(err){
                return false;
			}
		}else{
			currentForm.submit();
		}
	});

	function getByValueV(arr, value) {
	    var xxx = '';
	  
	    for (var i = 0; i < arr.length; i++) {
	    	if (arr[i][0] == value){
	      		xxx = arr[i][1];
	      	}
	    }
	    return xxx;
	}

	function getByValueM(arr, value) {
	    var xxx = '';
	    for (var i=0, iLen=arr.length; i<iLen; i++) {
	      	if (value != '' && parseFloat(value) <= parseFloat(arr[i][3].replace(',', '.')) && parseFloat(value) >= parseFloat(arr[i][4].replace(',', '.'))){
	      		xxx = arr[i][1];
	      	}
	    }
	    return xxx;
	}

	function getByValueSaveTest(arr, value) {
	    var xxx = '';
	  
	    for (var i = 0; i < arr.length; i++) {
	    	if (arr[i]['ID_TEST_CODE'] == value){
	      		xxx = arr[i]['HASIL_TEST'];
	      	}
	    }
	    return xxx;
	}

	function validateNomer(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

    function OpenClose() {
    	$("#cmbStatus").val("OPEN");
    	$("#cmbStatus").attr("disabled",true);

    	var flag = true;

    	$('#tblDetailTest tr:not(:first-child)').each(function(){
	        var prioritas = $(this).find("td:eq(1)").find("input").attr("value"); 
        	
	        if (prioritas == 'critical') {
	        	if ($(this).find("td:eq(2)").children().eq(1).val() == ''){flag = false}
	        }
        })	

        if (flag) {$("#cmbStatus").attr("disabled",false)}
    }
    
    
</script>