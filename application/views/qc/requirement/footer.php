<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
	var nomorDetail = 0;

	$(function () {
		//Initialize Select2 Elements
	    $('.select2').select2()

	    $("#example2").DataTable({
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
	 	var id = xyz[0];
	 	txtIdBarang.value = id;
	 	txtIdGroupDelete.value = "";
	 	nomorDetail = 0;
	 	txtNomorDetail.value = nomorDetail;

	 	txtKode.value = xyz[1];
	 	txtNama.value = xyz[2];
	 	txtJenis.value = xyz[3];

	 	bindingTest();
	 	$("#cmbTest").val("").trigger("change");

	 	$("#tblDetailTest").find("tr:gt(0)").remove(); //gt = kecuali, eq = terpilih
	 	getDetailtest(id); //ambil detail test
	})


	function getDetailtest(id){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('qc/requirement/getDetailtest');?>',
        data:{id:id},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
	            // mengeluarkan data data[0];
	            for (var i = 0; i < data.length; i++) {
	            	var markup = "<tr><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + data[i]['TEST_CODE'] + "' name='txtDKode_"+nomorDetail+"' readonly></td><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + data[i]['TEST_DESCRIPTION'] + "' name='txtDDescription_"+nomorDetail+"' readonly></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + data[i]['PRIORITAS'] + "' name='txtDPrioritas_"+nomorDetail+"'></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + data[i]['JENIS'] + "' name='txtDJenis_"+nomorDetail+"'></td><td><input type='button' value='x' class='btn btn-block btn-danger btn-sm' onclick='hapusTest(this)'><input type='hidden' value='" + data[i]['ID_TEST_GROUP'] + "' name='txtDIdGroup_"+nomorDetail+"'><input type='hidden' value='" + data[i]['ID_TEST_CODE'] + "' name='txtDIdTest_"+nomorDetail+"'></td></tr>";
                    $("#tblDetailTest").append(markup);

                    nomorDetail ++;
                    txtNomorDetail.value = nomorDetail;
	            }
	        }
        });

        $('#txtJmlRoll').val("");
	}


	function bindingTest() {
		$('#cmbTest').children('option:not(:first)').remove();

	    var data_test = <?php echo json_encode($data_test); ?>;

	    for (var i = 0; i < data_test.length; i++) {
	    	var $option = $("<option/>", {
			    value: data_test[i]['ID_TEST_CODE'],
			    text: data_test[i]['TEST_DESCRIPTION'] + " [" + data_test[i]['TEST_CODE'] + "]" + " [" + data_test[i]['STAGE_NAME'] + "]"
			});
			$("#cmbTest").append($option);
	    }
	}


	function tambahTest(){
		if (cmbTest.value == ""){
			alert("Pilih Test dulu!!!");
			$('#cmbTest').focus();
		}else{
			var adaValue = false;
			
			$('#tblDetailTest tr').each(function(){
                var sew = $(this).find("td:eq(4)").find("input:eq(2)").attr("value"); 
                if (typeof sew != 'undefined'){
                	if (cmbTest.value == sew){
                		adaValue = true;
                	}
                }
            })

			if (adaValue){
				alert("Test Sudah dipilih, silahkan pilih yang lain");
				$('#cmbTest').focus();
			}else{

			    var data_test = <?php echo json_encode($data_test); ?>;
			    var test_detail = getByValue(data_test,cmbTest.value);
			    // console.info(test_detail);

            	var markup = "<tr><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + test_detail['TEST_CODE'] + "' name='txtDKode_"+nomorDetail+"' readonly></td><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + test_detail['TEST_DESCRIPTION'] + "' name='txtDDescription_"+nomorDetail+"' readonly></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + test_detail['PRIORITAS'] + "' name='txtDPrioritas_"+nomorDetail+"'></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + test_detail['JENIS'] + "' name='txtDJenis_"+nomorDetail+"'></td><td><input type='button' value='x' class='btn btn-block btn-danger btn-sm' onclick='hapusTest(this)'><input type='hidden' value='' name='txtDIdGroup_"+nomorDetail+"'><input type='hidden' value='" + test_detail['ID_TEST_CODE'] + "' name='txtDIdTest_"+nomorDetail+"'></td></tr>";

		        $("#tblDetailTest").append(markup);
		        $('#cmbTest').val('').trigger('change');

		        nomorDetail ++;
                txtNomorDetail.value = nomorDetail;
			}
		}
	}

	function getByValue(arr, value) {
	    var xxx = []
	    for (var i=0, iLen=arr.length; i<iLen; i++) {
	      	if (arr[i].ID_TEST_CODE == value){
	      		// xxx.push(arr[i]);
	      		xxx = arr[i];
	      	}
	    }
	    return xxx;
	}

	function hapusTest(btn){
        var row = btn.parentNode.parentNode;
        var idGroup = $(row).find("td:eq(4)").find("input:eq(1)").attr("value"); 
        if (idGroup != ""){
        	txtIdGroupDelete.value += "@"+idGroup;
        }

        row.parentNode.removeChild(row);
    }

</script>