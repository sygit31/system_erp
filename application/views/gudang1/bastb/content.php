
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Daftar Barang Lolos Tes QC</font></b>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          

          <!-- ==================================ISI KONTEN================================== -->

          <form id="frm_input" method="POST" action="<?php echo site_url('gudang/bastb/terima_barang');?>" onsubmit="return validasi()">
          <button type="submit" class="btn btn-block btn-danger" onclick="return confirm('apakah anda yakin ingin mereject?')" style="width:25%;"><b><font size="3">Terima</font></b></button>

          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <font size="2">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width="5">Pilih</th>
                    <th width="145">Nama</th>
                    <th width="100">Barcode</th>
                    <th width="100">Kode Roll</th>
                    <th width="50">Tgl Diterima</th>
                    <th width="50">Qty</th>
                    <th width="50">Satuan</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php print_r($dOutstanding); ?> -->
                  <?php foreach($stok as $row){ ?>
                    <tr>
                      <td align="center"><input type="checkbox" name="cbTerima[]" value="<?php echo $row->ID_DETAIL_TERIMA;?>"></td>
                      <td><?php echo $row->NAMA; ?></td>
                      <td><?php echo $row->BARCODE; ?></td>
                      <?php
                        if ($row->GRADE == '1') {print_r("<td align='center' style='background-color: green;'><font color='white'>".$row->KODE_ROLL."</font></td>");}
                        if ($row->GRADE == '2') {print_r("<td align='center' style='background-color: gold;'><font color='black'>".$row->KODE_ROLL."</font></td>");}
                        if ($row->GRADE == '3') {print_r("<td align='center' style='background-color: red;'><font color='white'>".$row->KODE_ROLL."</font></td>");}
                        if ($row->GRADE == '') {print_r("<td>".$row->KODE_ROLL."</td>");}
                      ?>
                      <td align="center"><?php echo $row->TGL_TERIMA; ?></td>
                      <td align="right"><?php echo $row->QTY_TERIMA; ?></td>
                      <td><?php echo $row->SATUAN; ?></td>
                    </tr>
                  <?php } ?>


                </tbody>
                  <!--  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Browser</th>
                      <th>Platform(s)</th>
                      <th>Engine version</th>
                      <th>CSS grade</th>
                    </tr>
                  </tfoot> -->
              </table>
              </font>
            </div>
            <!-- /.card-body -->
          </div>
          </form>


          

          <!-- ==================================ISI KONTEN================================== -->
                  
        </div>
        <!-- /.card-body -->
        <div class="card-footer"><font color="Green" size="2">
            ERP @2019
        </font></div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->