
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
            <b><font color="White">IPB</font></b>
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

        

        
          <form role="form" method="POST" action="<?php echo site_url('sgt/gudang/ipb/simpan');?>" autocomplete="off" onsubmit="return validasi(this)">
          
          <div class="card card-primary" id="bodyinput">
            <div class="card-body">

              <table>
                <tr>
                  <td>



                    <table id="tblUtama">
                      
                      <tr valign="top">
                        <td width="200"><label><font size = "5">Tanggal</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Tanggal IPB">
                            <input class="form-control" type="text" id="txtTanggal" name="txtTanggal" >
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td width="200"><label><font size = "5">Nomer</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Nomer IPB">
                            <input class="form-control" type="text" id="txtNomer" name="txtNomer" >
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">KK</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih KK">
                            <select name="cmbKK"  id="cmbKK"  class="form-control select2" onchange="showBarang()">
                              <option value=''></option>
                              <?php foreach($data_kk as $row){ ?>
                                <option value='<?php echo $row->ID."@".$row->SERI; ?>'><?php echo $row->NOMER ; ?></option>
                              <?php } ?> 
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Barang</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Barang">
                            <select name="cmbBarang"  id="cmbBarang"  class="form-control select2" onchange="showStok()">
                              <option value=''></option>
                              
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Jumlah</font></label></td>
                        <td width="300" colspan="2">
                          <div data-tip="Jumlah barang">
                            <input class="form-control" type="text" id="txtJumlah" name="txtJumlah" style="background-color : #F8FBBF;" readonly>
                          </div>
                        </td>
                        <td width="100">
                          <div data-tip="Satuan">
                            <input class="form-control" type="text" id="txtSatuan" name="txtSatuan" style="background-color : #F8FBBF;" readonly>
                          </div>
                        </td>
                      </tr>
<!--                       
                      <tr height="10"></tr>
                      <tr>
                        <td/>
                        <td width="50"><button type="button" class="btn btn-block btn-info" id="btnSimpan" onclick="tambahBarang()">Tambah</button></td>
                        <td colspan="2"/>
                      </tr> -->
                    </table>



                  </td>
                  <td width="20" />
                  <td valign="top">


                  </td>
                </tr>
              </table>


                
              
                <!-- <font size="2">
                  <div id="DetailInfo"></div>
                </font> -->
                
                <br />

                <!-- <table class="table table-bordered" id="tblBarang" style="background: #17A2B8; color: white" name="tblParameters"> -->
                <table class="table table-bordered" id="tblBarang" name="tblBarang">
                  <thead>
                    <tr align="center">
                      <th style="width: 30%;"><font size="4">Kode</font></th>
                      <th style="width: 50%;" ><font size="4">Nama</font></th>
                      <th style="width: 30%;" ><font size="4">Jumlah</font></th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <!-- <tr align="center">
                      <td style="width: 30%;"><font size="4"><label id="lblParameter">Kode</label></font></td>
                      <td style="width: 50%;" ><font size="4"><label id="lblParameter">Nama</label></font></td>
                      <td style="width: 30%;" ><font size="4"><label id="lblParameter">Jumlah</label></font></td>
                    </tr> -->
                  
                  </tbody>
                </table>
            </div>
            <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="submit" class="btn btn-block btn-primary" id="btnSimpan" )">Simpan</button></td>
                  <td width="10"></td>
                  <td width="150"><a href="<?php echo site_url('sgt/gudang/ipb'); ?>" class="btn btn-block btn-danger">Batal</a></td>
                </tr>
              </table>
            </div>
          </div>
          </form>







          

                          










          

          <!-- ==================================ISI KONTEN================================== -->
                  
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer"><font color="Green" size="2">
            ERP @2019
        </font></div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->




    <!-- </section> -->
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->



















    <!-- ==============================================LAPORAN=========================================== -->
      <br />
      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Daftar IPB</font></b>
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

          <form  method="POST" action="<?php echo site_url('sgt/gudang/xxxx');?>">
            <div class="card card-info">
              <div class="card-body">

                <table>
                  <tr>
                    <td>Tanggal</td>
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
                <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('sgt/gudang/penerimaan_barang');?>'" />
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
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width=15%>Tanggal</th>
                    <th width=20%>Nomer IPB</th>
                    <th width=20%>Nomer KK</th>
                    <th width=10%>Seri</th>
                    <th width=20%>Kode Roll</th>
                    <th width=15%>Qty (Meter)</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($data_ipb_all as $row){ ?>
                    <tr align="center">
                      <td><?php echo $row->TANGGAL; ?></td>
                      <td><?php echo $row->NOMER; ?></td>
                      <td><?php echo $row->NO_KK; ?></td>
                      <td><?php echo $row->SERI; ?></td>
                      <td><?php echo $row->KODE_ROLL; ?></td>
                      <td><?php echo $row->QTY_TERIMA; ?></td>
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