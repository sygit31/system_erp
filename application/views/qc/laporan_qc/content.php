
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
            <b><font color="White">Laporan Pengecekan QC</font></b>
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

          <form  method="POST" action="<?php echo site_url('qc/laporan_qc/filter');?>">
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
                <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('qc/laporan_qc');?>'" />
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
                      <th width="60">Nomer Test</th>
                      <th width="30">PO</th>
                      <th width="130">Nama</th>
                      <th width="70">Kode Label</th>
                      <th width="30">Barcode</th>
                      <th width="40">Tgl Diterima</th>
                      <th width="40">Tgl Test</th>
                      <th width="50">Qty</th>
                      <th width="20">Grade</th>
                      <th width="30"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- <?php //print_r($dOutstanding); ?> -->
                    <?php foreach($laporan as $row){ ?>
                      <tr>
                        <td><?php echo $row->NOMER_TEST_QC; ?></td>
                        <td align="center"><?php echo $row->NOMER; ?></td>
                        <td><?php echo $row->NAMA; ?></td>
                        <td><?php echo $row->KODE_ROLL; ?></td>
                        <td align="center"><?php echo $row->BARCODE; ?></td>
                        <td align="center"><?php echo $row->TGL_TERIMA; ?></td>
                        <td align="center"><?php echo $row->TANGGAL_QC; ?></td>
                        <td align="center"><?php echo $row->QTY_TERIMA. "&nbsp " .$row->SATUAN; ?></td>
                        <!-- <?php //echo $row->GRADE; ?> -->
                        <?php 
                          if ($row->GRADE == '1') {print_r("<td align='center' style='background-color: green;'><font color='white'>".$row->GRADE."</font></td>");}
                          if ($row->GRADE == '2') {print_r("<td align='center' style='background-color: gold;'><font color='black'>".$row->GRADE."</font></td>");}
                          if ($row->GRADE == '3') {print_r("<td align='center' style='background-color: red;'><font color='white'>".$row->GRADE."</font></td>");}
                          if ($row->GRADE == '') {print_r("<td>".$row->GRADE."</td>");}
                        ?>
                        

                        <td><button type="button" class="btn btn-block btn-warning btn-sm" id="<?php echo $row->ID_DETAIL_TERIMA."@".$row->BARCODE."@".$row->NAMA."@".$row->NOMER."@".$row->ID_BARANG; ?>" data-toggle="modal" data-target="#modal-laporan">Detail</button></td>
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





          <div class="modal fade bd-example-modal-lg" id="modal-laporan">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Nomer PO</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtNoPoL" name="txtNoPoL" readonly></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Barcode</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtBarcodeL" name="txtBarcodeL" readonly></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Material</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtMaterialL" name="txtMaterialL" readonly></td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            <table border="1" id="tblDetailTestL">
                              <tr align="center">
                                <td width="150"><b>Test</b></td>
                                <td width="100"><b>Prioritas</b></td>
                                <td width="250"><b>Hasil</b></td>
                              </tr>
                            </table>
                            <br />
                            <div id="syarat" style="text-align: center;"></div>
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                    <!-- <div class="modal-footer"></div> -->
                  <br>
                </div>
                      <!-- /.modal-content -->
            </div>
                    <!-- /.modal-dialog -->
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