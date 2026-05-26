
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
            <b><font color="White">Laporan</font></b>
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


          <form  method="POST" action="<?php echo site_url('gudang/laporan_gudang/filter');?>">
            <div class="card card-info">
              <div class="card-body">

                <!-- <table>
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
                </table> -->

                <!-- Bootstrap_datetimepicker_master -->
                <!-- <div class="input-group date form_date col-md-5" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="dtp_input2" value="" /><br/>
                -->

                <!-- glDatePicker -->
                <!-- <input type="text" id="mydate" gldp-id="mydate" />
                <div gldp-el="mydate"
                     style="width:400px; height:300px; position:absolute; top:70px; left:100px;">
                </div> -->
                      
                <!-- Zebra Datepicker -->
                <!-- <input type="text" id="mydate"/> -->
                <table>
                  <tr>
                    <td>Date Range</td>
                    <td width="50" align="center">:</td>
                    <td width="170">
                      <font size="2"></font>
                        <input type="text" class="form-control pull-right" id="tanggalAwal" name = "tanggalAwal" placeholder="Batas Awal">
                      </font>
                    </td>
                    <td width="50" align="center">to</td>
                    <td width="170">
                      <font size="2"></font>
                        <input type="text" class="form-control pull-right" id="tanggalAkhir" name = "tanggalAkhir" placeholder="Batas Akhir">
                      </font>
                    </td>
                  </tr>
                </table>










              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">&nbsp Filter &nbsp</button>
                <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('gudang/laporan_gudang');?>'" />
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
              <!-- <table id="example1" class="display nowrap" style="width:100%" border="1"> -->
              <!-- <table id="example1" class="ui celled table" style="width:100%"> -->
                <thead>
                  <tr align="center">
                    <th rowspan="4" width="100">Tanggal</th>
                    <th colspan="4">Penerimaan</th>
                    <th colspan="10">Pengeluaran</th>
                    <th colspan="2" rowspan="3">Saldo Akhir</th>
                  </tr>
                  <tr align="center">
                    <th colspan="2" rowspan="2">Supplier</th>
                    <th colspan="2" rowspan="2">Produksi</th>
                    <th colspan="8">Produksi</th>
                    <th colspan="2" rowspan="2">Reject</th>
                  </tr>
                  <tr align="center">
                    <th colspan="2">Seri 1</th>
                    <th colspan="2">Seri 2</th>
                    <th colspan="2">Seri 3</th>
                    <th colspan="2">MMEA</th>
                  </tr>
                  <tr align="center">
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                    <th width="25">R</th>
                    <th width="25">M</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($dOutstanding); ?> -->
                  <?php foreach($data as $row){ ?>
                    <tr>
                      <td><?=$row['tanggal']; ?></td>
                      <td><?=$row['InLpbRoll']; ?></td>
                      <td><?=$row['InLpbPanjang']; ?></td>
                      <td><?=$row['InProdRoll']; ?></td>
                      <td><?=$row['InProdPanjang']; ?></td>
                      <td><?=$row['OutSeriIRoll']; ?></td>
                      <td><?=$row['OutSeriIPanjang']; ?></td>
                      <td><?=$row['OutSeriIIRoll']; ?></td>
                      <td><?=$row['OutSeriIIPanjang']; ?></td>
                      <td><?=$row['OutSeriIIIRoll']; ?></td>
                      <td><?=$row['OutSeriIIIPanjang']; ?></td>
                      <td><?=$row['OutMMEARoll']; ?></td>
                      <td><?=$row['OutMMEAPanjang']; ?></td>
                      <td><?=$row['OutRejectRoll']; ?></td>
                      <td><?=$row['OutRejectPanjang']; ?></td>
                      <td><?=$row['SaldoRoll']; ?></td>
                      <td><?=$row['SaldoPanjang']; ?></td>
                    </tr>
                  <?php } ?>


                </tbody>
                <!-- <tfoot>
                  <tr align="center">
                    <th width="100">Nama</th>
                    <th width="100">Barcode</th>
                    <th width="100">Kode Roll</th>
                    <th width="50">Tgl Diterima</th>
                    <th width="50">Qty</th>
                    <th width="50">Satuan</th>
                  </tr>
                </tfood> -->
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