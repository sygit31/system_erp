    <!-- DataTables -->
    <script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>





    <script type="text/javascript">



        $(function () {
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

            $("#dataTugas").empty();

            
            // setTimeout(function() {
            //     var date = new Date();
            //     $("#dmTanggal").val(date);
            //     $("#dmTanggal").focus();
            // }, 300);


            $.ajax({
                type: 'post',
                url: '<?php echo site_url('sgt/mk/laporan/getTugas');?>',
                data:{id_tugas:id_tugas},
                dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
                success:
                    function (data) {
                        console.log(data);
                        var appText = '';
                        if (data[0].length == 0) {
                            appText += '<table>\
                                <tr>\
                                    <td align="center" width="800px">\
                                        <h5><b>Belum ada input data</b></h3>\
                                    </td>\
                                <tr></table>';
                        }else{

                            for (let i = 0; i < data[0].length; i++) {
                                appText += '<table>\
                                <tr>\
                                    <td align="center">\
                                        <h5><b>Tanggal '+data[0][i]+'</b></h3>\
                                    </td>\
                                <tr>';

                                appText +=
                                '<tr>\
                                    <td>\
                                        <table border="1">\
                                            <thead>\
                                                <tr align="center">\
                                                    <td width="400"><b>Parameter</b></td>\
                                                    <td width="100"><b>Progres (%)</b></td>\
                                                    <td width="300"><b>Catatan</b></td>\
                                                </tr>  \
                                            </thead>   \
                                            <tbody>'; 
                                    
                                for (let x = 0; x < data[1][i].length; x++) {
                                    var parameter = '-';
                                    if(data[1][i][x].PARAMETER!==null){parameter=data[1][i][x].PARAMETER}

                                    var progres = '-';
                                    if(data[1][i][x].PROGRES!==null){progres=data[1][i][x].PROGRES}

                                    var catatan = '-';
                                    if(data[1][i][x].CATATAN!==null){catatan=data[1][i][x].CATATAN}

                                    appText +=
                                    '<tr>\
                                        <td>&nbsp;'+parameter+'</td>\
                                        <td align="center">'+progres+'</td>\
                                        <td>&nbsp;'+catatan+'</td>\
                                    </tr>';
                                }

                                appText +=
                                            '</tbody> \
                                        </table> \
                                    </td> \
                                </tr>';

                                appText += '</table><br />';
                            }
                        }

                        $("#dataTugas").append(appText);

                    },
                error: 
                    function (request, error) {
                        console.log(arguments);
                        // alert("Can't do because : " + error);
                    }
            });



        })





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


       


    </script>