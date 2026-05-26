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


        $('#frmData').submit(function(event) {
            event.preventDefault();
            var currentForm = this;
            alertify.confirm("yakin akan disimpan?", function (e) {
                if (e) {currentForm.submit();}
            });
        });


    </script>