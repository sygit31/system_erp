<!-- Select2 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- date-picker -->
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url();?>assets/plus/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.id.js"></script>
<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>



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


  $(document).ready(function(){
		// //Datepicker
		// var tanggalAwal=$('input[name="tanggalAwal"]'); 
		// var tanggalAkhir=$('input[name="tanggalAkhir"]'); 
		// var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		// var options={
		//     language:'id',
		//     format: 'dd MM yyyy',
		//     container: container,
		//     todayHighlight: true,
		//     autoclose: true,
		// };
		
		// tanggalAwal.datepicker(options);
		// tanggalAkhir.datepicker(options);

    $('#tanggalAwal').Zebra_DatePicker({
		    // direction: true,
		    pair: $('#tanggalAkhir'),
		    format: 'd-m-Y'
		});
		 
		$('#tanggalAkhir').Zebra_DatePicker({
		    direction: 1,
		    format: 'd-m-Y'
		});
	})


  $(document).ready(function(){ 
      // $("#lblTotalProgress").text("999");

      // $( "#btnAddRow" ).click(function() {
      //     tambahRow();
      // });

  });


  function tambahRow(xyz){
      //cek data row tidak kosong

      //tambah row
      var appendText = 
                  '<tr>\
                    <td>\
                        <div data-tip="Bagian dari tugas yang menunjukan kemajuan progres">\
                          <input class="form-control" type="text" id="txtParameter[]" name="txtParameter[]"/>\
                        </div>\
                      </td>\
                      <td>\
                        <div data-tip="Presentase dari total 100%">\
                          <input class="form-control" type="text" id="txtProgres[]" name="txtProgres[]" onkeydown="justNumber(event);" onkeyup="hitungPersen();" />\
                        </div>\
                      </td>\
                    <!-- <td width="10">\
                      <button type="button" class="btn btn-block btn-primary" id="btnAddRow" onclick="tambahRow(this);">+</button>\
                    </td> -->\
                    <td width="10">\
                      <div data-tip="&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hapus baris ini">\
                        <button type="button" class="btn btn-block btn-danger" id="btnDellRow" onclick="hapusRow(this);">x</button>\
                      </div>\
                    </td>\
                  </tr>';
      $("#tblParameters").append(appendText);


      //hitung ulang
      hitungPersen();

      //matikan button
      // xyz.disabled = true;
  }

    function hapusRow(xyz){
        //konfirmasi

        //hapus
        var row = xyz.parentNode.parentNode.parentNode;
        row.parentNode.removeChild(row);

        //hitung ulang
        hitungPersen();

        //nyalakan button terakhir

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

    function hitungPersen() {
      var total = 0;
      $('#tblParameters tbody tr').each(function(){
          var sew = $(this).find("td:eq(1)").find("input").val(); 
          // console.log(sew);
          if (sew == '') {
            sew = 0;
          }
          total += parseInt(sew);
      });

      $("#lblTotalProgress").text(total);
      // console.log('rr');
    }

    $('#frmData').on('reset', function(){
      $("#lblTotalProgress").text('0');

      $('#tblParameters tr:not(:first-child)').each(function(){
        this.remove();
      });

      $("#cmbTipe").val('').trigger("change");
      $("#cmbKaryawan").val('').trigger("change");

    });

    function validasi(abc,xyz) {
      if (tanggalAwal.value == "") {
        alertify.alert("<font color='red'>Tanggal awal periode belum diisi!!!</font>");
        tanggalAwal.focus();
        return false;
      }else{
        if (tanggalAkhir.value == "") {
          alertify.alert("<font color='red'>Tanggal akhir periode belum diisi!!!</font>");
          tanggalAkhir.focus();
          return false;
        }else{
          if (cmbTipe.value == "") {
            alertify.alert("<font color='red'>Project belum diisi!!!</font>");
            cmbTipe.focus();
            return false;
          }else{
            if (cmbPIC.value == "") {
              alertify.alert("<font color='red'>PIC belum diisi!!!</font>");
              cmbPIC.focus();
              return false;
            }else{
              if (cmbKaryawan.value=="") {
                alertify.alert("<font color='red'>Karyawan belum diisi!!!</font>");
                cmbKaryawan.focus();
                return false;
              }else{
                if (txtTugas.value == "") {
                  alertify.alert("<font color='red'>Tugas belum diisi!!!</font>");
                  txtTugas.focus();
                  return false;
                }else{
                  if (txtTarget.value == "") {
                    alertify.alert("<font color='red'>Target belum diisi!!!</font>");
                    txtTarget.focus();
                    return false;
                  }else{
                    if (txtNilai.value == "") {
                      alertify.alert("<font color='red'>Nilai belum diisi!!!</font>");
                      txtNilai.focus();
                      return false;
                    }else{
                      if (lblTotalProgress.innerHTML !== "100") {
                        alertify.alert("<font color='red'>Total Presentase harus 100%!!!</font>");
                        return false;
                      }else{
                        var respon = true;
                        $('#tblParameters tbody tr').each(function(){
                            var sew = $(this).find("td:eq(0)").find("input").val(); 
                            // console.log(sew);
                            if (sew == '') {
                              respon = false;
                            }
                        });

                        if (respon == false) {
                          alertify.alert("<font color='red'>Tidak boleh ada parameter yang kosong!!!</font>");
                          return false;
                        }else{
                          abc.preventDefault();
                          alertify.confirm("yakin akan disimpan?", function (e) {
                              if (e) {xyz.submit();}
                          });
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }

    // $('#xxx').submit(function(event) {
    //     event.preventDefault();
    //     var currentForm = this;
    //     alertify.confirm("yakin akan disimpan?", function (e) {
    //         if (e) {currentForm.submit();}
    //     });
    // });

    function pilihProject() {
      var idx = $("#cmbTipe option:selected").val();
      var idxS = idx.split("-");
      $("#cmbPIC").val(idxS[1]).trigger("change");
    }
  
    

  </script>