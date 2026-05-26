
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
            <b><font color="White">Permintaan Kebutuhan</font></b>
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

          
          <div class="card" style="width: 50%;">
            <!-- <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <font size="2">
              <table id="tblBagian" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width="470"><h3><b>Bagian</b></h3></th>
                    <th width="30"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($data_permintaan); ?> -->
                  <?php foreach($data_bagian as $row){ ?>
                    <tr align="center">
                      <td ><font color='#DC3545'><h5><b><?php echo $row->BAGIAN; ?></b></h5></font></td>
                      <td ><button type="button" class="btn btn-block btn-danger btn-sm" 
                          id=<?php echo $row->ID_BAGIAN.'@'.$row->BAGIAN; ?> data-toggle='modal' data-target='#modal-detail'>Detail</button></td>
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
            






          

                          
          
          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/umum/cek_permintaan/simpan');?>" autocomplete="off">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="center">
                          <td>
                            <label id='lblBagian' style="font-size: 50px;color: blue;"/>
                          </td>
                        </tr>
                      </table>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> -->
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            


                          <table id="tblPermintaan" class="table table-bordered table-striped">
                            <thead>
                              <tr align="center">
                                <th width="100">Tanggal</th>
                                <th width="300">Barang</th>
                                <th width="75">Jumlah</th>
                                <th width="50">Satuan</th>
                                <th width="200">Keterangan</th>
                                <th width="75">Acc</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php //foreach($data_permintaan_per_bagian as $asd){ 
                               
                                    // if ($asd->ID_BAGIAN === '6') {
                                    //   print_r('<tr align="center">');
                                    //   print_r('<td >'.$asd->TANGGAL.'</td>');
                                    //   print_r('<td >'.$asd->BARANG.'</td>');
                                    //   print_r('<td ><font color="red">'.$asd->JUMLAH.'</font></td>');
                                    //   print_r('<td >'.$asd->SATUAN.'</td>');
                                    //   print_r('<td >'.$asd->KETERANGAN.'</td>');
                                    //   print_r('<td >
                                    //   <input class="form-control" type="hidden" id="txtIdPermintaanDetail[]" name="txtIdPermintaanDetail[]" value="'.$asd->ID.'">
                                    //   <input class="form-control" type="text" id="txtJumlah[]" name="txtJumlah[]" onkeydown="justNumber(event);">
                                    //   </td>');
                                    //   print_r('</tr>');
                                    // }
                                  
                              //} ?>


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




                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                      <table>
                        <tr>
                          <td width="800">
                            <button class="btn btn-success pull-left" type="submit">Simpan</button>
                            <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                          </td>
                        </tr>
                      </table>


                    </div>
                  </form>
                  <!-- <br> -->
                </div>
                      <!-- /.modal-content -->
            </div>
                    <!-- /.modal-dialog -->
          </div>










          

          






          <!-- ==================================ISI KONTEN================================== -->
                  
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer"><font color="Green" size="2">
            ERP @2019
        </font></div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->














  <!-- ==============================================Cetak SIP=========================================== -->

     
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Buat SIP</font></b>
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

          
          <form  method="POST" action="<?php echo site_url('sgt/umum/cek_permintaan/simpanSIP');?>" onsubmit="return validasi()">
            <div class="card card-info">
              <div class="card-body">

              <table id="tblUtama">
                <tr valign="top">
                  <td width="200"><label><font size = "5">Tanggal</font></label></td>
                  <td width="400">
                    <font size="2"></font>
                      <div data-tip="Tanggal SIP">
                        <input type="text" class="form-control pull-right" id="tanggal" name = "tanggal" style="background: white;">
                      </div>
                    </font>
                  </td>
                </tr>
                <tr height="10"></tr>
                <tr valign="top">
                  <td><label><font size = "5">No. SIP</font></label></td>
                  <td>
                    <div data-tip="Nomer SIP">
                      <input class="form-control" type="text" id="txtNoSIP" name="txtNoSIP">
                    </div>
                  </td>
                </tr>
                <tr height="10"></tr>
                </table>
                           
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-success">&nbsp Simpan &nbsp</button>
                <input type="button" value="&nbsp &nbsp Batal &nbsp &nbsp" class="btn btn-danger" onclick="window.location.href='<?php echo site_url('sgt/umum/cek_permintaan');?>'" />
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->


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
                    <th width="30">Pilih</th>
                    <th width="100">Bagian</th>
                    <th width="75">Tanggal</th>
                    <th width="200">Barang</th>
                    <th width="75">Jumlah Order</th>
                    <th width="75">Jumlah Acc</th>
                    <th width="75">Satuan</th>
                    <th width="150">Keterangan</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($data_permintaan_filter as $row){ ?>
                    <tr>
                      <td align="center"><input type="checkbox" name="cbSIP[]" value='<?php echo $row->ID_PF.'@'.$row->BARANG.'@'.$row->JUMLAH_ACC.'@'.$row->SATUAN.'@'.$row->KETERANGAN;?>'></td>
                      <td><?php echo $row->BAGIAN; ?></td>
                      <td><?php echo $row->TANGGAL_PENGAJUAN; ?></td>
                      <td><?php echo $row->BARANG. " " . $row->SPESIFIKASI; ?></td>
                      <td><?php echo $row->JUMLAH_ORDER; ?></td>
                      <td><?php echo $row->JUMLAH_ACC; ?></td>
                      <td><?php echo $row->SATUAN; ?></td>
                      <td><?php echo $row->KETERANGAN; ?></td>
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
