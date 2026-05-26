<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script type="text/javascript">
    var jumlahDetail=0;
    var totalDetail=0;
    var edit_test = <?php echo json_encode($edit_test); ?>;

    $(function () {
        //Datatable
        $("#example1").DataTable();
        $("#example2").DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": true
        });
    });
    
       
    function pilihTest(xyz){
        if (txtFlagEdit.value == "yes"){
            $('#tblDetailTest tr').each(function(){
                var sew = $(this).find("td:eq(4)").find("input").attr("id"); 
                if (typeof sew != 'undefined'){
                    if (sew != '0'){
                        txtIdDetailDelete.value += "@"+sew;
                    }
                }
            })
        }


        //=====================================================================

        var Parents = document.getElementById('DetailInfo');
        while (Parents.firstChild) {
            Parents.removeChild(Parents.firstChild);
        }
        jumlahDetail = 0;
        totalDetail = 0;

        if (xyz.value == "measure"){
            var table_body = "<div class='card card-info'><div class='card-header'><b><font color='White' size='3'>Measure Test Detail</font></b></div><div class='card-body'><table>";

            table_body += "<tr valign='top'><td width='100'><label><font color='red'>Hasil</font></label></td><td><input class='form-control' type='text' id='txtHasil' name='txtHasil'></td></tr>";

            table_body += "<tr height='10'></tr><tr valign='top'><td width='100'><label><font color='red'>Min</font></label></td><td><input class='form-control' type='text' id='txtMin' name='txtMin' onkeypress='validateNomer(event)'></td></tr>";

            table_body += "<tr height='10'></tr><tr valign='top'><td><label><font color='red'>Max</font></label></td><td width='400'><input class='form-control' type='text' id='txtMax' name='txtMax' onkeypress='validateNomer(event)'></td></tr>";

            table_body += "<tr height='10'></tr><tr valign='top'><td><label><font color='red'>Range</font></label></td><td><select name='cmbRange' id='cmbRange' class='form-control select2' style='width: 100%;'><option value=''></option><option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select></td></tr>";

            table_body += "<tr height='10'></tr><tr><td></td><td><button type='button' class='btn btn-info' onclick='tambahMeasure(0)'>Tambah</button></td></tr></table>";

            table_body += "<br><table id='tblDetailTest' style='background: #17a2b8; color: white' border='1' bordercolor='white'><tr align='center'><th width='150'>Hasil</th><th width='120'>Min</th><th width='120'>Max</th><th width='90'>Range</th><th width='20'></th></tr></table>";

            table_body += "</div></div>";

            $('#DetailInfo').html(table_body);
        }


        if (xyz.value == "visibility"){
            var table_body = "<div class='card card-info'><div class='card-header'><b><font color='White' size='3'>Visibility Test Detail</font></b></div><div class='card-body'><table>";

            table_body += "<tr valign='top'><td width='100'><label><font color='red'>Hasil</font></label></td><td width='400'><input class='form-control' type='text' id='txtHasil' name='txtHasil'></td></tr>";

            table_body += "<tr height='10'></tr><tr valign='top'><td><label><font color='red'>Range</font></label></td><td><select name='cmbRange' id='cmbRange' class='form-control select2' style='width: 100%;'><option value=''></option><option value='0'>0</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option></select></td></tr>";

            table_body += "<tr height='10'></tr><tr><td></td><td><button type='button' class='btn btn-info' onclick='tambahVisibility(0)'>Tambah</button></td></tr></table>";

            table_body += "<br><table id='tblDetailTest' style='background: #17a2b8; color: white' border='1' bordercolor='white'><tr align='center'><th width='350'>Hasil</th><th width='130'>Range</th><th width='20'></th></tr></table>";

            table_body += "</div></div>";

            $('#DetailInfo').html(table_body);
        }
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


    $( "#btnBatal" ).click(function() {
        var Parents = document.getElementById('tblTest');
        while (Parents.firstChild) {
            Parents.removeChild(Parents.firstChild);
        }
        jumlahDetail = 0;
        totalDetail = 0;
    });

    

    function tambahMeasure(id_detail){
        var hasil = $("#txtHasil").val();
        var max = $("#txtMax").val();
        var min = $("#txtMin").val();
        var range = $("#cmbRange").val();

        if (hasil == ""){
            alert("Hasil belum diisi!!!");
            txtHasil.focus();
        }else{
            if (max == ""){
                alert("Nilai Max belum diisi!!!");
                txtMax.focus();
            }else{
                if (min == ""){
                    alert("Nilai Min belum diisi!!!");
                    txtMin.focus();
                }else{
                    if (range == ""){
                        alert("Nilai Range belum diisi!!!");
                        cmbRange.focus();
                    }else{
                        var markup = "<tr><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + hasil + "' name='txtDHasil"+jumlahDetail+"'></td><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + min + "' name='txtDMin"+jumlahDetail+"' onkeypress='validateNomer(event)'></td><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + max + "' name='txtDMax"+jumlahDetail+"' onkeypress='validateNomer(event)'></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + range + "' name='txtDRange"+jumlahDetail+"'></td><td><input type='button' value='x' class='btn btn-block btn-danger btn-sm' onclick='hapusDetail(this)' id="+id_detail+"><input type='hidden' value='" + id_detail + "' name='txtDId"+jumlahDetail+"'></td></tr>";
                        $("#tblDetailTest").append(markup);

                        txtJumlahDetail.value = jumlahDetail;
                        jumlahDetail += 1;
                        totalDetail += 1;

                        $("#txtHasil").val("");
                        $("#txtMax").val("");
                        $("#txtMin").val("");
                        $("#cmbRange").val("");
                    }
                }
            }
        }
    }


    function tambahVisibility(id_detail){
        var hasil = $("#txtHasil").val();
        var range = $("#cmbRange").val();

        if (hasil == ""){
            alert("Nilai Hasil belum diisi!!!");
            txtHasil.focus();
        }else{
            if(range == ""){
                alert("Nilai Range belum diisi!!!");
                cmbRange.focus();
            }else{
                var markup = "<tr><td><input type='text' class='form-control form-control-sm' style='text-align:center;' value='" + hasil + "' name='txtDHasil"+jumlahDetail+"'></td><td><input type='text' readonly class='form-control form-control-sm' style='text-align:center;' value='" + range + "' name='txtDRange"+jumlahDetail+"'></td><td><input type='button' value='x' class='btn btn-block btn-danger btn-sm' onclick='hapusDetail(this)' id="+id_detail+"><input type='hidden' value='" + id_detail + "' name='txtDId"+jumlahDetail+"'></td></tr>";
                $("#tblDetailTest").append(markup);

                txtJumlahDetail.value = jumlahDetail;
                jumlahDetail += 1;
                totalDetail += 1;
                    
                $("#txtHasil").val("");
                $("#cmbRange").val("");
            }
        }
    }
    
    
    function hapusDetail(btn){
        if (btn.id != "0"){
            txtIdDetailDelete.value += "@"+btn.id;
        }

        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        totalDetail -= 1;
    }


    function validasi(){
        if (totalDetail == 0){
            alert("Belum ada data detail !!!");
            cmbJenis.focus();
            return false;
        }
        return true;
    }

    // Find and remove selected table rows
    // $(".delete-row").click(function(){
    //     $("table tbody").find('input[name="record"]').each(function(){
    //         if($(this).is(":checked")){
    //             $(this).parents("tr").remove();
    //         }
    //     });
    // });


    if (edit_test.length > 0) {             
        //proses edit data
        $("#bodyinput").css('background-color', '#FAB8B8');
        $("#headerinput").html('<span class="kedip">EDIT &nbsp '+edit_test[0]['TEST_CODE']+'</span>');

        //binding data
        txtFlagEdit.value = "yes";
        txtIdTestCode.value = edit_test[0]['ID_TEST_CODE'];

        cmbStage.value = edit_test[0]['STAGE'];
        txtDeskripsi.value = edit_test[0]['TEST_DESCRIPTION'];
        $("#cmbPrioritas").val(edit_test[0]['PRIORITAS']).trigger("change");
        $("#cmbJenis").val(edit_test[0]['JENIS']).trigger("change");
        
        if (edit_test[0]['JENIS'] == 'measure'){
            for (var i=0; i<edit_test.length; i++) {
                txtHasil.value = edit_test[i]['HASIL'];
                txtMin.value = edit_test[i]['MIN'];
                txtMax.value = edit_test[i]['MAX'];
                cmbRange.value = edit_test[i]['RANGE'];
                tambahMeasure(edit_test[i]['ID_DETAIL_TEST_CODE']);
            }
        }
        
        if (edit_test[0]['JENIS'] == 'visibility'){
            for (var i=0; i<edit_test.length; i++) {
                txtHasil.value = edit_test[i]['HASIL'];
                cmbRange.value = edit_test[i]['RANGE'];
                tambahVisibility(edit_test[i]['ID_DETAIL_TEST_CODE']);
            }
        }
    }

</script>