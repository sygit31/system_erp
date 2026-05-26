<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>



<script type="text/javascript">

	$(function () {

	    //Datatable
	    $("#example1").DataTable({"ordering": false});
	    $("#example2").DataTable({"ordering": false});
	   
	});

	var aksi = "";
	function btnTerima() {
		aksi = "<font color='blue'><b>Menerima</b></font>";
		txtAksi.value = "terima";
	}

	function btnTolak() {
		aksi = "<font color='red'><b>Menolak</b></font>";
		txtAksi.value = "tolak";
	}

	$('#frm_input').submit(function(event) {
		event.preventDefault();
		var currentForm = this;
		alertify.confirm("Yakin akan "+aksi+" barang ini?", function (e) {
			if (e) {currentForm.submit();}
		});
	});

	$('#modal-detail').on('show.bs.modal', function(e) {
	 	var abc = e.relatedTarget.id;

	 	var xyz = abc.split("@");
	 	var id_detail_terima = xyz[0];

	 	txtIdD.value = id_detail_terima;
	 	txtStatusQc.value = xyz[5];
	 	txtJml.value = xyz[6];
	 	txtBarcode.value = xyz[1];
	 	txtMaterial.value = xyz[2];
	 	txtNoPo.value = xyz[3];
	 	txtNote.value = "";

	 	$("#tblDetailTest").find("tr:gt(0)").remove(); //gt = kecuali, eq = terpilih
	 	
	 	getTest(id_detail_terima);
	 	getSyarat(xyz[4]);
	})

	// $('#modal-reject').on('show.bs.modal', function(e) {
	//  	var abc = e.relatedTarget.id;

	//  	var xyz = abc.split("@");
	//  	var id_reject = xyz[0];
	 	
	//  	txtRNomer.value = xyz[1];
	//  	txtRTanggal.value = xyz[2];
	//  	txtRNoPo.value = xyz[3];

	// 	var dRejectDetail = <?php //echo json_encode($reject_detail); ?>;
	// 	var listRejectDetail = getByValue(dRejectDetail,id_reject);

	// 	// console.log(listRejectDetail);

	// 	$("#tblDetailReject").find("tr:gt(0)").remove();

	// 	var i = 0;
	// 	while (i < listRejectDetail.length) {
	// 		var markup = "<tr align='center'>";
 //            markup += "<td>"+(i+1)+"</td>";
 //            markup += "<td>"+listRejectDetail[i].BARCODE+"</td>";
 //            markup += "<td>"+listRejectDetail[i].NO_SP+"</td>";
 //            markup += "<td>"+listRejectDetail[i].QTY_TERIMA+"</td>";
 //            markup += "<td>"+listRejectDetail[i].SATUAN+"</td>";
 //            markup += "<td>"+listRejectDetail[i].NOMER_QC+"</td>";
 //            markup += "</tr>";

	// 	  	$("#tblDetailReject").append(markup);
	// 	  	i++;
	// 	}

	// })


	function getTest(id_detail_terima){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/gudang/stok_bayangan/getTest');?>',
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


	            	$("#tblDetailTest").append(markup);
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
        url: '<?php echo site_url('sgt/gudang/stok_bayangan/getHasilMeasure');?>',
        data:{hasil_test:hasil_test,id_test_code:id_test_code},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        async: false
        }).responseText;
	}


	function validasi() {
		var tunggal = true;
        var no_po = "";
		$('#example1 > tbody  > tr').each(function(){
            // var sew = $(this).find("td:eq(0)").find("input:eq(0)").attr("value"); 
            var zzz = $(this).find("td:eq(0)").find("input:eq(0)").prop("checked");
            // console.log(sew);

            if (zzz) {
            	var xxx = $(this).find("td:eq(1)").text();
            	if (no_po === "") {no_po = xxx;}
        		else{
        			if (no_po !== xxx) {tunggal = false;}
            	}
            }
        })

        if (tunggal === false) {alert('1 Surat Reject hanya boleh 1 Nomor PO !!!');}

        return tunggal;
	}


	function getByValue(arr, value) {
	    var xxx = []
	    for (var i=0, iLen=arr.length; i<iLen; i++) {
	      	if (arr[i].ID_REJECT == value){
	      	xxx.push(arr[i]);}
	    }
	    return xxx;
	}

	function getSyarat(id_barang){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/gudang/stok_bayangan/getSyarat');?>',
        data:{id_barang:id_barang},
        //dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
	        	$("#syarat").html(data);
	        },
	    error: 
	    	function (request, error) {
        		console.log(arguments);
        		alert("Can't do because : " + error);
    		}
        });
	}

</script>