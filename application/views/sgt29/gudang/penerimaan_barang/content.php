
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
  </section>
  
  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-info" <?php if ($kd_akses == '2') {echo 'hidden';} ?>>   <!-- Jumadi 05-Apr-22 -->
      <div class="card-header">
        <h3 class="card-title">
          <b><font color="White">Penerimaan Barang</font></b>
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
                      <th width="150">Nomer PO</th>
                      <th width="100">Tanggal</th>
                      <th width="200">Supplier</th>
                      <th width="250">Material</th>
                      <th width="120">QTY Order</th>
                      <th width="120">Outstanding</th>
                      <th width="80">Satuan</th>
                      <th width="20"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- <?php //print_r($dOutstanding); ?> -->
                    <?php foreach($dOutstanding as $row){ ?>
                      <tr>
                        <td align="center"><?php echo $row['NOMER']; ?></td>
                        <td align="center"><?php echo $row['TGL']; ?></td>
                        <td><?php echo $row['NAMA_SUPPLIER']; ?></td>
                        <td><?php echo $row['NAMA_BARANG']; ?></td>
                        <td><?php echo $row['QTY']; ?></td>
                        <!-- <td><font color="red"><?php echo $row['OUTSTANDING']; ?></font><font color="green"> &nbsp [<?php echo $row['OUTSTANDING_TOLERANSI_BAWAH']; ?>]</font><font color="blue"> &nbsp [<?php echo $row['OUTSTANDING_TOLERANSI_ATAS']; ?>]</font></td> -->
                        <td><font color="red"><?php echo $row['OUTSTANDING']; ?></font></td>
                        <td><?php echo $row['SATUAN']; ?></td>
                        <!-- <td><button type="button" class="btn btn-block btn-warning" id="<?php //echo $row['ID'].'@'.$row['SATUAN'].'@'.$row['OUTSTANDING'].'@'.$row['OUTSTANDING_TOLERANSI_BAWAH'].'@'.$row['OUTSTANDING_TOLERANSI_ATAS']; ?>" data-toggle="modal" data-target="#modal-detail">Terima</button></td> -->
                        <?php
                        if ($row['FLAG_PENERIMAAN'] == 'LABEL') {
                          print_r("<td><button type='button' class='btn btn-block btn-warning' id='".$row['ID']."@".$row['SATUAN']."@".$row['OUTSTANDING']."@".$row['OUTSTANDING_TOLERANSI_BAWAH']."@".$row['OUTSTANDING_TOLERANSI_ATAS']."' data-toggle='modal' data-target='#modal-detail'>Terima</button></td>");
                        }else{
                          print_r("<td><button type='button' class='btn btn-block btn-warning' id='".$row['ID']."@".$row['SATUAN']."@".$row['OUTSTANDING']."@".$row['OUTSTANDING_TOLERANSI_BAWAH']."@".$row['OUTSTANDING_TOLERANSI_ATAS']."' data-toggle='modal' data-target='#modal-lain'>Terima</button></td>");
                        }
                        ?>
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
                  <form role="form" method="POST" action="<?php echo site_url('sgt/gudang/penerimaan_barang/terima');?>" onsubmit="return validasi(this)" autocomplete="off">
                    <input type="hidden" id="txtIdPoDetail" name="txtIdPoDetail">
                    <input type="hidden" id="txtOutstanding" name="txtOutstanding">
                    <input type="hidden" id="txtOutstandingBawah" name="txtOutstandingBawah">
                    <input type="hidden" id="txtOutstandingAtas" name="txtOutstandingAtas">
                    <input type="hidden" id="txtJumlahDetail" name="txtJumlahDetail">
                    <input type="hidden" id="txtStatusPoDetail" name="txtStatusPoDetail" value="OTW">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Tanggal</label></td>
                          <td width="20"></td>
                          <td width="300">
                            <input type="text" id="dmTanggal" name="dmTanggal" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
                          </td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Nomer SP</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtNomerSP" name="txtNomerSP"></td>
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
                              <td width="350" colspan="2"><input class="form-control" type="text" id="txtKodeBarcode" name="txtKodeBarcode"></td>
                            </tr>
                            <tr height = "10"/>
                            <tr valign="top">
                              <td width="110"><label>&nbsp Jumlah</label></td>
                              <td width="10"></td>
                              <td width="200"><input class="form-control" type="text" id="txtJumlahBarang" name="txtJumlahBarang"></td>
                              <td width="150"><input class="form-control" type="text" id="txtSatuanBarang" name="txtSatuanBarang" readonly="true"></td>
                            </tr>
                            <tr height = "10"/>
                            <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>
                                <input type="button" value="Tambah" onclick="tambahTerima()" class="btn btn-warning pull-right">
                              </td>
                            </tr>
                          </table>
                          <p />
                          <table>
                            <tr>
                              <td width="190"><label id="lblIOutstanding"></label></td>
                              <td width="150"><label id="lblIOutstandingBawah"></label></td>
                              <td width="250"><label id="lblIOutstandingAtas"></label></td>
                            </tr>
                          </table>
                          <table border="2">
                            <tr align="center">
                              <td width="200"><b>Nomer Barcode</b></td>
                              <td width="200"><b>Jumlah Barang</b></td>
                              <td width="150"><b>Satuan Barang</b></td>
                              <td width="40"><b></b></td>
                            </tr>
                          </table>
                          <table id="tblDetailPenerimaan"></table>
                          <label id="lblMJumlah" name="lblMJumlah" />
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <!-- <br /> -->
                        <table>
                          <tr>
                            <td width="80">Status PO :</td>
                            <td width="120">
                              <select class="form-control select" style="width: 90%;" id="cmbStatusPoDetail" name ="cmbStatusPoDetail" disabled="true";>
                                <option value='OTW' selected="selected">OPEN</option>
                                <option value='FINISH'>CLOSE</option>
                              </select>
                            </td>
                            <td width="300">
                              <button class="btn btn-success pull-left">Simpan</button>
                              <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                            </td>
                          </tr>
                        </table>
                        
                      </div>
                    </div>
                    <!-- <div class="modal-footer"></div> -->
                  </form>
                  <!-- <br> -->
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>


            
            <!-- BARANG LAIN ================================================= -->

            
            <div class="modal fade bd-example-modal-lg" id="modal-lain">
              <!-- <div class="modal-dialog modal-lg"> -->
                <div class="modal-dialog">
                  <div class="modal-content">
                    <form role="form" method="POST" action="<?php echo site_url('sgt/gudang/penerimaan_barang/terima_lain');?>" autocomplete="off" onsubmit="return validasiL(this)">
                      <input type="hidden" id="txtIdPoDetailL" name="txtIdPoDetailL">
                      <input type="hidden" id="txtOutstandingL" name="txtOutstandingL">
                      <input type="hidden" id="txtOutstandingBawahL" name="txtOutstandingBawahL">
                      <input type="hidden" id="txtOutstandingAtasL" name="txtOutstandingAtasL">
                      <input type="hidden" id="txtJumlahDetailL" name="txtJumlahDetailL">
                      <input type="hidden" id="txtStatusPoDetailL" name="txtStatusPoDetailL" value="OTW">
                      <div class="modal-header" style="background-color: #E6E6E6;">
                        <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                        <table>
                          <tr valign="center">
                            <td width="100"><label>Tanggal</label></td>
                            <td width="20"></td>
                            <td width="300">
                              <input type="text" id="dmTanggalL" name="dmTanggalL" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask >
                            </td>
                          </tr>
                          <tr valign="center">
                            <td width="100"><label>Nomer SP</label></td>
                            <td width="20"></td>
                            <td width="300"><input class="form-control" type="text" id="txtNomerSPL" name="txtNomerSPL"></td>
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
                              <td width="110"><label>&nbsp Jumlah</label></td>
                              <td width="10"></td>
                              <td width="200"><input class="form-control" type="text" id="txtJumlahBarangL" name="txtJumlahBarangL"></td>
                              <td width="150"><input class="form-control" type="text" id="txtSatuanBarangL" name="txtSatuanBarangL" readonly="true"></td>
                            </tr>
                          </table>
                          <p />
                          <table>
                            <tr>
                              <td width="190"><label id="lblIOutstandingL"></label></td>
                              <td width="150"><label id="lblIOutstandingBawahL"></label></td>
                              <td width="250"><label id="lblIOutstandingAtasL"></label></td>
                            </tr>
                          </table>
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <!-- <br /> -->
                        <table>
                          <tr>
                            <td width="80">Status PO :</td>
                            <td width="120">
                              <select class="form-control select" style="width: 90%;" id="cmbStatusPoDetailL" name ="cmbStatusPoDetailL" disabled="true";>
                                <option value='OTW' selected="selected">OPEN</option>
                                <option value='FINISH'>CLOSE</option>
                              </select>
                            </td>
                            <td width="300">
                              <button class="btn btn-success pull-left">Simpan</button>
                              <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                            </td>
                          </tr>
                        </table>
                        
                      </div>
                    </div>
                    <!-- <div class="modal-footer"></div> -->
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



        <!-- ==============================================LAPORAN=========================================== -->

        <!-- Default box -->
        <div class="card card-info">
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

                <form  method="POST" action="<?php echo site_url('sgt/gudang/penerimaan_barang/tampil');?>">
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
                        <tr>
                          <td>Tahun</td>
                          <td width="50" align="center">:</td>
                          <td colspan=3>
                            <font size="2"></font>
                              <input type="text" class="form-control pull-right" id="txtTahun" name = "txtTahun" placeholder="Tahun" required>
                            </font>
                          </td>
                        </tr>
                      </table>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">&nbsp Filter &nbsp</button>
                  <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('sgt/gudang/penerimaan_barang?kd_menu=menu_gudang_sub_penerimaan_barang');?>'" />  <!-- Jumadi 05-Apr-22 -->
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
                      <th width="70">Tanggal</th>
                      <th width="50">Nomer PO</th>
                      <th width="50">Nomer SP</th>
                      <th width="100">Supplier</th>
                      <th width="200">Material</th>
                      <th width="30">Tahun</th>
                      <th width="100">Barcode</th>
                      <th width="35">Quantity</th>
                      <th width="35">Satuan</th>
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
                        <td align="center"><?php echo $row->TAHUN; ?></td>
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