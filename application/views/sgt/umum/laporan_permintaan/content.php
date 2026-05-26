
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
            <b><font color="White">Laporan Permintaan</font></b>
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

          
         




          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <font size="2">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <!-- <th width="30">Pilih</th> -->
                    <th style="width: 8%;">Bagian</th>
                    <th style="width: 7%;">Tanggal</th>
                    <th style="width: 20%;">Barang</th>
                    <th style="width: 9%;">Jumlah Order</th>
                    <th style="width: 16%;">Keterangan</th>
                    <th style="width: 12%;">SIP</th>
                    <th style="width: 7%;">Jml SIP</th>
                    <th style="width: 7%;">Revisi</th>
                    <th style="width: 7%;">Pemenuhan</th>
                    <th style="width: 7%;">Kekurangan</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($laporan_permintaan_track as $row){ ?>
                    <tr>
                      <!-- <td align="center"><input type="checkbox" name="cbSIP[]" value="<?php echo $row->ID_PF.'@'.$row->BARANG.'@'.$row->JUMLAH_ACC.'@'.$row->SATUAN.'@'.$row->KETERANGAN;?>"></td> -->
                      <td><?php echo $row->BAGIAN; ?></td>
                      <td align="center"><?php echo $row->TANGGAL; ?></td>
                      <td><?php echo $row->BARANG. " " . $row->SPESIFIKASI; ?></td>
                      <td align="center"><?php echo $row->JUMLAH. " " . $row->SATUAN; ?></td>
                      <td><?php echo $row->KETERANGAN; ?></td>
                      <td><?php echo $row->NO_SIP; ?></td>
                      <td><?php echo $row->JUMLAH_SIP; ?></td>
                      <td><?php echo $row->JUMLAH_REVISI; ?></td>
                      <td><?php echo $row->PEMENUHAN; ?></td>
                      <td><?php echo $row->KEKURANGAN; ?></td>
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