
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Laporan Penerimaan Barang</font></b>
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

          <form  method="POST" action="<?php echo site_url('laporan/penerimaan_barang/tampil');?>">
            <div class="card card-info">
              <div class="card-body">

                <table>
                  <tr>
                    <td>Date Range</td>
                    <td width="50" align="center">:</td>
                    <td width="170">
                      <font size="2"></font>
                        <input type="text" class="form-control pull-right" id="tanggalAwal" name = "tanggalAwal" placeholder="Batas Awal" required>
                      </font>
                    </td>
                    <td width="50" align="center">to</td>
                    <td width="170">
                      <font size="2"></font>
                        <input type="text" class="form-control pull-right" id="tanggalAkhir" name = "tanggalAkhir" placeholder="Batas Akhir" required>
                      </font>
                    </td>
                  </tr>
                </table>
                           
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">&nbsp Filter &nbsp</button>
                <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('laporan/penerimaan_barang');?>'" />
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </form>


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
                    <th width="70">Tanggal</th>
                    <th width="100">Nomer PO</th>
                    <th width="100">Nomer SP</th>
                    <th width="100">Supplier</th>
                    <th width="100">Material</th>
                    <th width="100">Barcode</th>
                    <th width="50">Quantity</th>
                    <th width="50">Satuan</th>
                    <th width="50">Status</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php print_r($penerimaan_barang); ?> -->
                  <?php foreach($penerimaan_barang as $row){ ?>
                    <tr>
                      <td><?php echo $row->TGL_TERIMA; ?></td>
                      <td><?php echo $row->NOMER; ?></td>
                      <td><?php echo $row->NO_SP; ?></td>
                      <td><?php echo $row->NAMA_SUPPLIER; ?></td>
                      <td><?php echo $row->NAMA_BARANG; ?></td>
                      <td><?php echo $row->BARCODE; ?></td>
                      <td><?php echo $row->QTY_TERIMA; ?></td>
                      <td><?php echo $row->SATUAN; ?></td>
                      <td><?php echo $row->STATUS_QC; ?></td>
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