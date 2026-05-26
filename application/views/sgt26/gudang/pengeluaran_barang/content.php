
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
          <b><font color="White">Pengeluaran Barang</font></b>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <!-- <th width="150">Tanggal</th> -->
                      <th width="50">Penggunaan</th>
                      <th width="50">Bagian</th>
                      <th width="50">Perintah</th>
                      <th width="100">Surat Perintah</th>
                      <th width="30">Seri</th>
                      <th width="150">Barang</th>
                      <th width="30">QTY</th>
                      <th width="30">Realisasi</th>
                      <th width="30">Kekurangan</th>
                      <th width="30">Satuan</th>
                      <th width="30"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- <?php print_r($data); ?> -->
                    <?php foreach($order as $row){ ?>
                      <tr>
                        <!-- <td><?php //echo $row->TANGGAL; ?></td> -->
                        <td align="center"><?php echo $row['TANGGAL_PENGGUNAAN']; ?></td>
                        <td align="center"><?php echo $row['BAGIAN']; ?></td>
                        <td align="center"><?php echo $row['RELASI']; ?></td>
                        <td><?php echo $row['KETERANGAN_PENGGUNAAN']; ?></td>
                        <td><?php echo $row['SERI']; ?></td>
                        <td><?php echo $row['BARANG']; ?></td>
                        <td align="right"><?php echo $row['QTY']; ?></td>
                        <td align="right"><?php echo $row['REALISASI']; ?></td>
                        <td align="right"><font color="red"><?php echo $row['OUTSTANDING']; ?></font></td>
                        <td><?php echo $row['SATUAN']; ?></td>
                        <td><button type="button" class="btn btn-block btn-warning btn-sm" 
                          id="<?php echo $row['ID_BARANG'].'@'.$row['OUTSTANDING'].'@'.$row['ID_GUDANG_ORDER'].'@'.$row['OUTSTANDING'].'@'.$row['SERI'].'@'. $row['ID_RELASI'];; ?>"
                          data-toggle="modal" data-target="#modal-detail">Penuhi</button></td>
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
            <div class="modal-dialog">
              <div class="modal-content">
                <form role="form" method="POST" action="<?php echo site_url('sgt/gudang/pengeluaran_barang/penuhi');?>" onsubmit="return validasiIpb()">
                  <input type="hidden" id="txtOutstanding" name="txtOutstanding">
                  <input type="hidden" id="txtIdGudangOrder" name="txtIdGudangOrder">
                  <input type="hidden" id="txtSeri" name="txtSeri">
                  <input type="hidden" id="txtStatusGudangOrder" name="txtStatusGudangOrder" value="OPEN">
                  <div class="modal-header" style="background-color: #E6E6E6;">
                    
                    Pengeluaran Barang
                    
                  </div>
                  <div class="modal-body">
                    <div class="box box-info">
                      <div class="box-body">
                        <!-- ISI -->
                        
                        <table>

                          <tr>
                            <td width="100"><label>Nomer IPB</label></td>
                            <td width="20"></td>
                            <td width="300">
                              <select name="cmbIPBX"  id="cmbIPBX"  class="form-control select2" onchange="showBarang()" style="width: 100%;">
                                <option value=''></option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td width="100"><label>Penerima</label></td>
                            <td width="20"></td>
                            <td width="300">
                              <select name="cmbPenerima"  id="cmbPenerima"  class="form-control select2" style="width: 100%;">
                                <option value=''></option>
                                <option value='Noorkhan'>Noorkhan</option> <!-- Jumadi 03-Dec-21 -->
                                <option value='Kamal Yazid'>Kamal Yazid</option>
                                <option value='Sutrasno'>Sutrasno</option>
                                <option value='Rita Purwati'>Rita Purwati</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td width="100"><label>Pemberi</label></td>
                            <td width="20"></td>
                            <td width="300">
                              <select name="cmbPemberi"  id="cmbPemberi"  class="form-control select2" style="width: 100%;">
                                <option value=''></option>
                                <option value='M. Taufiq'>M. Taufiq</option>
                                <option value='Agus S.'>Agus S.</option>
                                <option value='Jamini'>Jasmini</option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td width="100"><label>Mengetahui</label></td>
                            <td width="20"></td>
                            <td width="300">
                              <select name="cmbPengawas"  id="cmbPengawas"  class="form-control select2" style="width: 100%;">
                                <option value=''></option>
                                <option value='Sutono'>Sutono</option>
                                <option value='Sugito'>Sugito</option>
                                <option value='Imam Suroso'>Imam Suroso</option>
                              </select>
                            </td>
                          </tr>

                        </table>
                        <br>
                        <table border="2">
                          <tr align="center">
                            <td width="175"><b>Kode Roll</b></td>
                            <td width="175"><b>Jumlah Barang</b></td>
                            <td width="150"><b>Satuan Barang</b></td>
                          </tr>
                        </table>
                        <table id="tblDetailPengeluaran">
                          
                        </table>
                        <div id="infoTable"></div>
                        <table>
                          <tr>
                            <td width="250"><label id="lblJumlah" name="lblJumlah" style="color:blue;">Total Barang : 0</label></td>
                            <td align="right" width="250"><label id="lblOutstanding" name="lblOutstanding" align="right" style="color:red;" /></td>
                          </tr>
                        </table>
                        
                        <!-- ISI -->
                      </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success pull-left">Simpan</button>
                      <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                    </div>
                  </div>
                  <!-- <div class="modal-footer"></div> -->
                </form>
                <br>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


          






          







          <div class="modal fade bd-example-modal-lg" id="modal-manual">
            <!-- <div class="modal-dialog modal-lg"> -->
              <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/gudang/pengeluaran_barang/penuhiManual');?>" onsubmit="return validasiManual(this)">
                    <input type="hidden" id="txtMIdGudangOrder" name="txtMIdGudangOrder">
                    <input type="hidden" id="txtMOutstanding" name="txtMOutstanding">
                    <input type="hidden" id="txtMStatusGudangOrder" name="txtMStatusGudangOrder" value="OPEN">
                    <input type="hidden" id="txtNomorDetail" name="txtNomorDetail" value="0">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Nomer IPB</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtMNomerIPB" name="txtMNomerIPB"></td>
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
                          <table>
                            <tr valign="top">
                              <td width="110"><label>&nbsp Kode Barcode</label></td>
                              <td width="10"></td>
                              <td width="350" colspan="2">
                                <select class="form-control select2" style="width: 100%;" id="cmbMBarang">
                                    <!-- <option value='' selected="selected"></option>
                                    <?php foreach($stokBarang as $row){ ?>
                                      <option value='<?php echo $row->ID_DETAIL_TERIMA; ?>'><?php echo $row->BARCODE ; ?></option>
                                      <?php } ?> -->
                                    </select>
                                  </td>
                                </tr>
                              <!-- <tr valign="top">
                                <td width="110"><label>&nbsp Jumlah</label></td>
                                <td width="10"></td>
                                <td width="200"><input class="form-control" type="text" id="txtJumlahBarang" name="txtJumlahBarang"></td>
                                <td width="150"><input class="form-control" type="text" id="txtSatuanBarang" name="txtSatuanBarang" readonly="true"></td>
                              </tr> -->
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                 <input type="button" value="Tambah" onclick="tambahDetail()" class="btn btn-warning pull-right">
                               </td>
                             </tr>
                           </table>
                            <!-- <table>
                              <tr valign="center">
                                <td width="100"><label>Jumlah Roll</label></td>
                                <td width="20"></td>
                                <td width="250"><input class="form-control" type="text" id="txtJmlRoll" name="txtJmlRoll"></td>
                                <td width="50"><input type="button" class="btn btn-success pull-left" value="Ok" onclick=getRoll()></td>
                              </tr>
                            </table> -->
                            <br>
                            <table border="2" id="tblMDetailPengeluaran">
                              <tr align="center">
                                <td width="200"><b>Kode Roll</b></td>
                                <td width="200"><b>Jumlah Barang</b></td>
                                <td width="150"><b>Satuan Barang</b></td>
                                <td width="30"></td>
                              </tr>
                            </table>
                            <table>
                              <tr>
                                <td width="300"><label id="lblMJumlah" name="lblMJumlah"></label></td>
                                <td width="280" align="right"><label id="lblOutstanding" style="color:#8B0000;"></label></td>
                              </tr>
                            </table>
                            
                            <!-- ISI -->
                          </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success pull-left">Simpan</button>
                          <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                        </div>
                      </div>
                      <!-- <div class="modal-footer"></div> -->
                    </form>
                    <br>
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


        <!-- ==============================================LAPORAN=========================================== -->

        <!-- Default box -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">
              <b><font color="White">Laporan Pengeluaran Barang</font></b>
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

                <form  method="POST" action="<?php echo site_url('sgt/gudang/pengeluaran_barang/tampil');?>">
                  <div class="card card-info">
                    <div class="card-body">

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
                    <tr height='10'></tr>
                    <tr>
                      <td>Seri</td>
                      <td width="50" align="center">:</td>
                      <td width="170" colspan="3">
                        <select id="cmbSeri" name="cmbSeri" class="form-control select" style="width: 100%;">
                          <option value=""></option>
                          <option value="Seri I">Seri I</option>
                          <option value="Seri II">Seri II</option>
                          <option value="Seri III">Seri III</option>
                          <option value="MMEA">MMEA</option>
                        </select>
                      </td>
                    </tr>
                  </table>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">&nbsp Filter &nbsp</button>
                  <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('sgt/gudang/pengeluaran_barang');?>'" />
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
                      <th width="20">Tanggal</th>
                      <th width="60">Nomer IPB</th>
                      <th width="85">Kode Roll</th>
                      <th width="90">Nama Barang</th>
                      <th width="30">Tahun</th>
                      <th width="20">Qty</th>
                      <th width="60">Bagian</th>
                      <th width="75">Penggunaan</th>
                      <th width="35">Seri</th>
                      <th width="30"></th>
                    </tr>
                  </thead>
                  <tbody>

                  <!-- <?php print_r($penerimaan_barang); ?> -->
                  <?php foreach($laporan_pengeluaran as $row){ ?>
                  <tr>
                    <form role="form" method="POST" action="<?php echo site_url('sgt/gudang/ipb/cetak_ulang_ipb');?>" target="_blank">
                      <td align="center">
                        <?php //echo $row->TGL_KELUAR; 
                        
                        if ($row->TANGGAL_IPB == ""){
                          echo $row->TGL_KELUAR;
                        }else{
                          echo $row->TANGGAL_IPB;
                        }
                        ?>
                      </td>
                      <td align="center">
                        <?php
                          // if ($row->NO_IPB == ""){
                          //   echo $row->NOMER;
                          // }else{
                          //   echo $row->NO_IPB;
                          // }

                        if ($row->NOMER == ""){
                          echo $row->NO_IPB;
                        }else{
                          echo $row->NOMER;
                        }
                        ?>
                      </td>
                      <td align="center"><?php echo $row->KODE_ROLL; ?></td>
                      <td><?php echo $row->BARANG; ?></td>
                      <td align="center"><?php echo $row->TAHUN; ?></td>
                      <td align="right"><?php echo $row->QTY; ?></td>
                      <td><?php echo $row->BAGIAN; ?></td>
                      <td><?php echo $row->KETERANGAN_PENGGUNAAN; ?></td>
                      <td><?php echo $row->SERI; ?></td>
                      <td>
                        <input name="txtIdIpb" type='hidden' value=<?php echo $row->ID_IPB; ?> />
                        <button type="submit" class="btn btn-block btn-danger btn-sm">Print</button>
                      </td>
                    </form>
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