
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

    var akses = <?php echo json_encode( $_SESSION['logAkses']); ?>;
    
    if (akses._A == 1) {$("#menu_gudang").show();}
        if (akses._B == 1) {$("#menu_gudang_sub_penerimaan_barang").show();}
        if (akses._C == 1) {$("#menu_gudang_sub_stok_barang").show();}
        if (akses._D == 1) {$("#menu_gudang_sub_stok_reject").show();}
        if (akses._E == 1) {$("#menu_gudang_sub_pengeluaran_barang").show();}
        if (akses._F == 1) {$("#menu_gudang_sub_laporan_gudang").show();}
            if (akses._G == 1) {$("#menu_gudang_sub_laporan_gudang_sub_mutasi_pet").show();}

    if (akses._Y == 1) {$("#gdg_kertas").show();} // Menu Kertas
        if (akses._Z == 1) {$("#gdg_terima_kertas").show();} // Menu Penerimaan Kertas
        if (akses._AA == 1) {$("#gdg_ekspedisi_kertas").show();} // Menu Ekspedisi Kertas

    if (akses._H == 1) {$("#menu_pembelian").show();}
        if (akses._I == 1) {$("#menu_pembelian_sub_outstanding_order").show();}
        if (akses._AO == 1) {$("#pemb_master").show();}
            if (akses._AP == 1) {$("#pemb_material").show();}


    if (akses._J == 1) {$("#menu_qc").show();}
        if (akses._K == 1) {$("#menu_qc_sub_master_qc").show();}
            if (akses._L == 1) {$("#menu_qc_sub_master_qc_sub_parameter").show();}
            if (akses._M == 1) {$("#menu_qc_sub_master_qc_sub_test_requirement").show();}
        if (akses._N == 1) {$("#menu_qc_sub_check_qc").show();}  
        if (akses._W == 1) {$("#menu_qc_sub_cetak_label").show();}  
        if (akses._O == 1) {$("#menu_qc_sub_laporan_qc").show();}
            if (akses._S == 1) {$("#menu_qc_sub_laporan_qc_sub_test").show();}
            $("#menu_qc_sub_laporan_qc_sub_test_table").show();

    if (akses._P == 1) {$("#menu_sistem").show();}
        if (akses._AB == 1) {$("#sis_input_project").show();}
        if (akses._AC == 1) {$("#sis_summary_project").show();}
        if (akses._AD == 1) {$("#sis_project").show();}
        if (akses._AQ == 1) {$("#sis_ide").show();}

    if (akses._T == 1) {$("#menu_rnd").show();}
        if (akses._U == 1) {$("#menu_rnd_sub_setting").show();}
            if (akses._V == 1) {$("#menu_rnd_sub_mesin").show();}
            if (akses._X == 1) {$("#menu_rnd_sub_formula").show();}
        if (akses._AE == 1) {$("#menu_rnd_setting").show();}

    if (akses._AF == 1) {$("#menu_ppc").show();}
        if (akses._AG == 1) {$("#ppc_kp").show();}
        if (akses._AH == 1) {$("#ppc_produk").show();}

    if (akses._AI == 1) {$("#menu_cs").show();}
        if (akses._AJ == 1) {$("#cs_risalah").show();}
        if (akses._AK == 1) {$("#cs_revisi").show();}

    if (akses._AL == 1) {$("#menu_teknisi").show();}
        if (akses._AM == 1) {$("#tek_master").show();}
            if (akses._AN == 1) {$("#tek_master_mesin").show();}

    if (akses._AR == 1) {$("#menu_hrd").show();}
        if (akses._AT == 1) {$("#hrd_karyawan").show();}
        if (akses._AU == 1) {$("#hrd_master").show();}
            if (akses._AV == 1) {$("#hrd_master_bagian").show();}
            if (akses._AW == 1) {$("#hrd_master_jabatan").show();}

    if (akses._Q == 1) {$("#menu_administrator").show();}
        if (akses._R == 1) {$("#menu_administrator_sub_kelola_akun").show();}

</script> 

<?php
    if ($_SESSION['pesan'] != "") {
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

