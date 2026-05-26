







<script text="text/javascript">

    $('#modal-detail').on('show.bs.modal', function(e) {
		var data = e.relatedTarget.id;
		// data = data.split("@");
		$("#txtIdSIP").val(data);

		$("#tblDetailSIP").find("tr:gt(0)").remove(); //gt = kecuali, eq = terpilih
		getDetailSIP(data);
    })



    function getDetailSIP(id_sip){
		$.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/umum/sip/getDetailSIP');?>',
        data:{id_sip:id_sip},
        dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
        success:
        	function (data) {
        		// console.log(data);

				var markUp = "";
	            for (var i = 0; i < data.length; i++) {
					var nmr = i + 1;
					markUp+=`
					<tr>
						<td align="center">
							`+nmr+`
						</td>
						<td>
							`+data[i]['BAGIAN']+`
						</td>
						<td>
							`+data[i]['BARANG']+` `+data[i]['SPESIFIKASI']+`
						</td>
						<td align="center">
							<input class="form-control" type="text" id="txtJumlah_`+data[i]['ID_SIP_DETAIL']+`" name="txtJumlah_`+data[i]['ID_SIP_DETAIL']+`" value="`+data[i]['JUMLAH']+`" readonly="true" onkeydown="justNumber(event);"\>
						</td>
						<td align="center">
							`+data[i]['SATUAN']+`
						</td>
						<td>
							`+data[i]['KETERANGAN']+`
						</td>
						<td>
							<button type='button' class='btn btn-block btn-info btn-sm' id='`+data[i]['ID_SIP_DETAIL']+`'  onclick="revisi(this)">Revisi</button>
						</td>
					</tr>`;

					$("#lblTglSIP").text(data[i]['BAGIAN']);
	            }

				$("#tblDetailSIP").append(markUp);
	        }
        });
	}


	function revisi(btn){
		if ($(btn).html()=='Revisi') {
			//ubah button
			$(btn).removeAttr('class');
			$(btn).html('Simpan').toggleClass('btn btn-block btn-danger btn-sm');

			//input aktif
			var row = btn.parentNode.parentNode;
			$(row).each(function(){
				$(this).find("td").find("input").attr("readonly", false);
			})
		}else{
			var jumlah_revisi = 0;

			//input non aktif
			var row = btn.parentNode.parentNode;
			$(row).each(function(){
				jumlah_revisi = $(this).find("td").find("input").attr("readonly", true).val();
			})


			//ubah button
			$(btn).removeAttr('class');
			$(btn).html('Revisi').toggleClass('btn btn-block btn-info btn-sm');

			//revisi sip
			Revisi_SIP(btn.id,jumlah_revisi);
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


	function Revisi_SIP(id_sip_detail,jumlah){
		return $.ajax({
        type: 'post',
        url: '<?php echo site_url('sgt/umum/sip/revisi');?>',
        data:{id_sip_detail:id_sip_detail,jumlah:jumlah},
        // dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
		success:
        	function (data) {
        		if (data == 1) {
					alertify.alert('<font color="blue">Revisi Berhasil</font>');
				}else{
					alertify.alert('<font color="red">Revisi Gagal!!!</font>');
				}
	        }
        });
	}


	
</script>