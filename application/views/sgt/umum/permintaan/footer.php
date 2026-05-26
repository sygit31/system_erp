<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>


<script type="text/javascript">

    $(function () {
		//Initialize Select2 Elements
	    $('.select2').select2()

	    // $("#example2").DataTable({
	    //   "paging": true,
	    //   "lengthChange": true,
	    //   "searching": true,
	    //   "ordering": false,
	    //   "info": true,
	    //   "autoWidth": true
	    // });
	});



    function pilihBarang() {
        var idBarang = $('#cmbBarang').val();
        getDataById(idBarang);

        // munculkan outstanding
        $('#tblOutstanding tbody').empty();
        $('#tblOutstanding').css("display","none");
        
        get_outstanding_sip(idBarang);

        //Tampilkan Stok
    }

    function tambahBarang(){
        if ( cmbBarang.value == '') {
            alertify.alert("<font color='red'>Barang belum dipilih!!!</font>");
            // cmbBarang.focus();
        }else{
            if (txtJumlah.value == '') {
                alertify.alert("<font color='red'>Jumlah barang belum diisi!!!</font>");
                // txtJumlah.focus();
            }else{
                if (txtKeterangan.value == '') {
                    alertify.alert("<font color='red'>Keterangan belum diisi!!!</font>");
                    // txtKeterangan.focus();
                }else{
                    var appendText = "<tr> \
                      <td> \
                          <input class='form-control' type='hidden' id='ArrIdBarang[]' name='ArrIdBarang[]' value='"+ $("#cmbBarang option:selected").val() +"'/>\
                          <input class='form-control' type='text' id='ArrNamaBarang[]' name='ArrNamaBarang[]' value='"+ $("#cmbBarang option:selected").text() +"'/>\
                      </td>\
                      <td>\
                          <input class='form-control' type='text' id='ArrJumlah[]' name='ArrJumlah[]' value='"+ $("#txtJumlah").val() +"' />\
                      </td>\
                      <td>\
                          <input class='form-control' type='text' id='ArrKeterangan[]' name='ArrKeterangan[]' value='"+ $("#txtKeterangan").val() +"' />\
                      </td>\
                      <td width='10;'>\
                        <div data-tip='&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hapus baris ini'>\
                          <button type='button' class='btn btn-block btn-danger' id='btnDellRow' onclick='hapusRow(this);'>x</button>\
                        </div>\
                      </td>\
                    </tr>";

                    $("#tblBarang").append(appendText);
                    $("#cmbBarang").val('').trigger("change");
                    $("#txtJumlah").val('');
                    $("#txtSatuan").val('');
                    $("#txtKeterangan").val('');
                }
            }
        }
    }

    function getDataById(idBarang){
        var ArrBarang = <?php echo json_encode($data_barang); ?>;
        // console.log(ArrBarang);

        for (var i = 0; i < ArrBarang.length; i++) {
	    	if (ArrBarang[i].ID == idBarang){
	      		var xxx = ArrBarang[i]['SATUAN'];
                $("#txtSatuan").val(xxx);
                return true;
	      	}
	    }
    }

    function justNumber(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    }

    function hapusRow(xyz){
        //hapus
        var row = xyz.parentNode.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }


    function get_outstanding_sip(Aid_barang){
		return $.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/umum/permintaan/get_sip_outstanding');?>',
        data:{Aid_barang:Aid_barang},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
		success:
        	function (data) {
                // console.log(data);
                // 0:
                // JUMLAH: "2"
                // KEKURANGAN: "1"
                // NO_SIP: "44/sip/2020"
                // SATUAN: "DOS"
                // TANGGAL: "25-07-2020"

                var AppText = ""

                if (data.length != 0) {
                    for (let i = 0; i < data.length; i++) {
                        AppText += `
                        <tr>
                          <td align="center">`+data[i]['TANGGAL']+`</td>
                          <td align="center">`+data[i]['NO_SIP']+`</td>
                          <td>`+data[i]['KEKURANGAN']+` `+data[i]['SATUAN']+`</td>
                        </tr> 
                        `
                    }

                    $("#tblOutstanding tbody").append(AppText);
                    $('#tblOutstanding').css("display","block");
                }

	        }
        });
	}


</script>