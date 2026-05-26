    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/input-mask/jquery.inputmask.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="<?php echo base_url(); ?>assets/adminlte/plugins/input-mask/jquery.inputmask.extensions.js"></script>





    <script type="text/javascript">
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })

            //Money Euro
            $('[data-mask]').inputmask()

            //Datatable
            // $("#example1").DataTable();
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
            var data = e.relatedTarget.id;
            // alert(data);
            // 16
            // @IT
            // @Rifki Ovta Pianus
            // @Emmanuel Vanny
            // @Kebutuhan Insfratuktur (CCTV, Poster, Foto, Gambar)
            // @Instalasi Server
            // @100
            // @4

            data = data.split("@");
            var id_tugas = data[0];
            $("#txtIdTugas").val(data[0]);
            $("#txtBagian").val(data[1]);
            $("#txtNama").val(data[2]);
            $("#txtPIC").val(data[3]);
            $("#txtProject").val(data[4]);
            $("#txtTugas").val(data[5]);
            // $("#lblIOutstanding").text("Outstanding : " + data[2]).css("color", "red").css("font-size", "12px");
            // $("#lblIOutstandingBawah").text("-10% : " + data[3]).css("color", "green").css("font-size", "12px");
            // $("#lblIOutstandingAtas").text("+10% : " + data[4]).css("color", "blue").css("font-size", "12px");

            $("#tblProgres").find("tr:gt(0)").remove();

            var dParameters = <?php echo json_encode($dataParameter); ?>;

            var appText = '<tbody>';
            for (var i=0, iLen=dParameters.length; i<iLen; i++) {
                if (dParameters[i].ID_TUGAS == id_tugas){
                    appText += 
                        '<tr>\
                            <td>&nbsp;'+ dParameters[i].PARAMETER +'</td>\
                            <td>\
                                <input class="form-control" type="text" name="txtProgress[]" onkeydown="justNumber(event);">\
                            </td>\
                            <td>\
                                <input class="form-control" type="text" name="txtCatatans[]">\
                                <input class="form-control" type="hidden" name="txtIdTugasParameter[]" value="'+dParameters[i].ID+'">\
                            </td>\
                        </tr>';  
                }
            }
            appText += '</tbody>'
            $("#tblProgres").append(appText);
            
            setTimeout(function() {
                var date = new Date();
                $("#dmTanggal").val(date);
                $("#dmTanggal").focus();
            }, 300);
        })



        function validasi(ths,evn){
            var respon = true;
            var selesai = true;
            var kosong = false;
            $('#tblProgres tbody tr').each(function(){
                var sew = $(this).find("td:eq(1)").find("input").val(); 
                if (sew == '') {
                    kosong=true;
                }
                var valu = '0';
                sew!==''?valu=sew:'';
                if (parseInt(valu) > 100) {
                    respon = false;
                }
                if (parseInt(valu) < 100) {
                    selesai = false;
                }
            });

            evn.preventDefault();
            if (!respon){
                alertify.alert("<font color='red'>Progres maksimal 100%!!!</font>");
            }else{
                if (kosong){
                    alertify.alert("<font color='red'>Progres tidak boleh ada yang kosong!!!</font>");
                }else{
                    if(selesai){
                        alertify.confirm("Tugas sudah selesai?", function (e) {
                            if (e) {$("#txtStatus").val('close');ths.submit();}
                        });
                    }else{
                        ths.submit();
                    }
                }
            }
        }



        function justNumber(event) {
            // Allow only backspace and delete
            if (event.keyCode == 46 || event.keyCode == 8) {
                // let it happen, don't do anything
            } else {
                // Ensure that it is a number and stop the keypress
                if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
                }
            }
        }


    </script>