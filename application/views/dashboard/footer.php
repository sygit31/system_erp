
<!-- jQuery -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/adminlte/dist/js/demo.js"></script>

<script type="text/javascript">

    var id_akun = <?php echo json_encode( $_SESSION['id_akun']); ?>;
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url()."index.php/administrator/Akun/show_menu" ?>',
        data: {data: id_akun},
        success: function(data) {
            var data = JSON.parse(data);
            for (var i=0; i<data.length; i++) {
                var menu = data[i]['KODE_MENU'];
                var status = data[i]['STATUS'];

                if (status != '0') {
                    $('#' + menu).show();
                }
            }
        }
    });

</script> 

<?php
if (isset($_SESSION['pesan']) && $_SESSION['pesan'] != "") {
    print_r("
      <script type='text/javascript'>
      alertify.alert('".$_SESSION['pesan']."');
      </script>
      ");
    $_SESSION['pesan'] = "";
}
?>

</body>
</html>

