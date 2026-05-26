
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
            <b><font color="White">Laporan Pengecekan QC Table</font></b>
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

          <form  method="POST" action="<?php echo site_url('qc/laporan_qc_table/filter');?>">
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
                <button type="submit" class="btn btn-success">&nbsp Filter &nbsp</button>
                <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('qc/laporan_qc_table');?>'" />
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
                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                <table id="example1" class="display" style="width:100%" border="1">
                  <thead>
                    <tr align="center" valign="center">
                      <!-- <th rowspan="2">Nomer Test</th>
                      <th colspan="2">Tanggal</th>
                      <th rowspan="2">Panjang</th>
                      <th rowspan="2">Barcode</th>
                      <th rowspan="2">Kode Roll</th>
                      <th colspan="6">Hasil Inspeksi & Test</th>
                      <th rowspan="2">Grade</th> -->
                    </tr>
                    <tr valign="center" align="center">
                      <th width="200">Nomer Test</th>
                      <th width="100">Tgl Terima</th>
                      <th width="100">Tgl Test</th>
                      <th width="100">Panjang</th>
                      <th width="100">Barcode</th>
                      <th width="200">Kode Roll</th>
                      <th width="200">Gulungan</th>
                      <th width="100">Warna</th>
                      <th width="50">Gramature</th>
                      <th width="100">Tape Test</th>
                      <th width="50">Ketebalan</th>
                      <th width="100">Invisible Ink</th>
                      <th width="50">Grade</th>
                      <th width="50">Acc</th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- <?php //print_r($dOutstanding); ?> -->
                    <?php foreach($laporan as $row){ ?>
                      <tr>
                        <td align="center"><?php echo $row['nomer']; ?></td>
                        <td align="center"><?php echo $row['tgl_terima']; ?></td>
                        <td align="center"><?php echo $row['tgl_test']; ?></td>
                        <td align="center"><?php echo $row['panjang']." Meter"; ?></td>
                        <td align="center"><?php echo $row['barcode']; ?></td>
                        <td align="center"><?php echo $row['kode_roll']; ?></td>
                        <td align="center"><?php echo $row['gulungan']; ?></td>
                        <td align="center"><?php echo $row['warna']; ?></td>
                        <td align="center"><?php echo $row['gsm']; ?></td>
                        <td align="center"><?php echo $row['tape']; ?></td>
                        <td align="center"><?php echo $row['ketebalan']; ?></td>
                        <td align="center"><?php echo $row['invisible']; ?></td>
                        <td align="center"><?php echo $row['grade']; ?></td>
                        <td align="center">
                          <?php 
                            if ($row['grade'] == '1' || $row['grade'] == '2') {
                              echo "Ya";
                            }else{
                              echo "Tidak";
                            }
                          ?>
                        </td>
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