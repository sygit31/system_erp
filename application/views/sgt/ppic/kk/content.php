
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
            <b><font color="White">Kartu Kerja</font></b>
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
                    <th width="50">Nomer</th>
                    <th width="30">Tgl</th>
                    <th width="50">Tgl Delivery</th>
                    <th width="60">Nama</th>
                    <th width="30">Tahun</th>
                    <th width="50">Order</th>
                    <th width="50">Revisi</th>
                    <th width="50">Total</th>
                    <th width="50">Kirim</th>
                    <th width="50">Outstanding</th>
                    <th width="30"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($dOutstanding); ?> -->
                  <?php foreach($data_risalah as $row){ ?>
                    <tr>
                      <td align="center"><?php echo $row['NMR']; ?></td>
                      <td align="center"><?php echo $row['TGL_RISALAH']; ?></td>
                      <td align="center"><?php echo $row['TGL_DELIVERY']; ?></td>
                      <td align="center"><?php echo $row['NAMA']; ?></td>
                      <td align="center"><?php echo $row['TAHUN']; ?></td>
                      <td align="center"><?php echo $row['ORDER']; ?></td>
                      <td align="center"><?php echo $row['REVISI']; ?></td>
                      <td align="center"><?php echo $row['TOTAL']; ?></td>
                      <td align="center"><?php echo $row['KIRIM']; ?></td>
                      <td align="center"><?php echo $row['OUTSTANDING']; ?></td>
                      
                      <td><button type="button" class="btn btn-block btn-warning" id="<?php echo $row['ID'].'@'.$row['NMR'].'@'.$row['NAMA'].'@'.$row['TAHUN'].'@'.$row['OUTSTANDING'].'@'.$row['ID_PROSES']; ?>" data-toggle="modal" data-target="#modal-detail">Buat KK</button></td>
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
                  <form role="form" method="POST" action="<?php echo site_url('sgt/');?>" onsubmit="return validasi(this)" autocomplete="off">
                    <input type="hidden" id="txtIdRisalah" name="txtIdRisalah">
                    <input type="hidden" id="txtIdProses" name="txtIdProses">
                    <input type="hidden" id="txtIdProduk" name="txtIdProduk">
                    
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="center">
                          <td width="100"><label>No. Risalah</label></td>
                          <td width="20"></td>
                          <td width="300">
                            <input type="text" id="txtNomer" name="txtNomer" class="form-control" readonly="true">
                          </td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Nama</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtNama" name="txtNama" readonly="true"></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Desain</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtDesain" name="txtDesain" readonly="true"></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Outstanding</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtOutstanding" name="txtOutstanding" readonly="true"></td>
                        </tr>
                      </table>
                      
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            <table>
                              <tr valign="top">
                                <td width="150"><label>&nbsp Oplah</label></td>
                                <td width="10"></td>
                                <td width="300"><input class="form-control" type="text" id="txtOplah" name="txtOplah"></td>
                              </tr>
                              <tr height="10"></tr>
                              <tr valign="top">
                                <td width="150"><label>&nbsp Tanggal Proses</label></td>
                                <td width="10"></td>
                                <td width="300">
                                  <font size="2"></font>
                                    <input type="text" class="form-control pull-right" id="tglProses" name = "tglProses" required>
                                  </font>
                                </td>
                              </tr>
                              <tr height="10"></tr>
                              <!-- HARUSNYA PERULANGAN MENGAMBIL DARI MASTER URUTAN STATION DAN JAM KERJA -->
                              <!-- <tr valign="top">
                                <td width="250"><label>&nbsp Jam Kerja Emboss</label></td>
                                <td width="10"></td>
                                <td width="200">
                                  <select class="form-control select" style="width: 100%;" id="cmbJamKerjaEmbos" name ="cmbJamKerjaEmbos">
                                    <option value='' selected="selected"></option>
                                    <option value='7'>7</option>
                                    <option value='10'>10</option>
                                    <option value='14'>14</option>
                                    <option value='17'>17</option>
                                    <option value='20'>20</option>
                                    <option value='24'>24</option>
                                  </select>
                                </td>
                              </tr>
                              <tr height="10"></tr>
                              <tr valign="top">
                                <td width="250"><label>&nbsp Jam Kerja Coating Sensitizing</label></td>
                                <td width="10"></td>
                                <td width="200">
                                  <select class="form-control select" style="width: 100%;" id="cmbJamKerjaCoatingSensi" name ="cmbJamKerjaCoatingSensi">
                                    <option value='' selected="selected"></option>
                                    <option value='7'>7</option>
                                    <option value='10'>10</option>
                                    <option value='14'>14</option>
                                    <option value='17'>17</option>
                                    <option value='20'>20</option>
                                    <option value='24'>24</option>
                                  </select>
                                </td>
                              </tr>
                              <tr height="10"></tr>
                              <tr valign="top">
                                <td width="250"><label>&nbsp Jam Kerja Sensitizing Readible</label></td>
                                <td width="10"></td>
                                <td width="200">
                                  <select class="form-control select" style="width: 100%;" id="cmbJamKerjaSensiReadible" name ="cmbJamKerjaSensiReadible">
                                    <option value='' selected="selected"></option>
                                    <option value='7'>7</option>
                                    <option value='10'>10</option>
                                    <option value='14'>14</option>
                                    <option value='17'>17</option>
                                    <option value='20'>20</option>
                                    <option value='24'>24</option>
                                  </select>
                                </td>
                              </tr>
                              <tr height="10"></tr>
                              <tr valign="top">
                                <td width="250"><label>&nbsp Jam Kerja Slitter</label></td>
                                <td width="10"></td>
                                <td width="200">
                                  <select class="form-control select" style="width: 100%;" id="cmbJamKerjaSlitter" name ="cmbJamKerjaSlitter">
                                    <option value='' selected="selected"></option>
                                    <option value='7'>7</option>
                                    <option value='10'>10</option>
                                    <option value='14'>14</option>
                                    <option value='17'>17</option>
                                    <option value='20'>20</option>
                                    <option value='24'>24</option>
                                  </select>
                                </td>
                              </tr>
                              <tr height="10"></tr> -->
                              <tr>
                                <td></td>
                                <td></td>
                                <td>
                                  <!-- PERLU ADANYA MASTER YANG MENYATAKAN KEPERLUAN BARANG DISETIAP STATION -->
                                  <!-- PERLU ADANYA MASTER YANG MENYATAKAN PROSES URUTAN STATION DI BOM -->
                                   <input type="button" value="Generate" onclick="generateKK()" class="btn btn-warning pull-left" style="font-weight: bold;"/>
                                </td>
                              </tr>
                            </table>

                            <br />

                            <table id="tblGenerate">
                              <tr>
                                <td width="1000" colspan="2" valign="bottom" align="center">  
                                  <b><label style="font-size: 20px;"><u>Kartu Kerja</u></label></b>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="2" valign="top">
                                  <center><b><label style="font-size: 15px;" id="lblNoKK">No. KK : 11/PNP-HLG/PPIC/KKM/../...</label></b></center>
                                </td>
                              </tr>
                              <tr height="20"><td colspan="2"/></tr>
                              <tr>
                                <td>
                                  <table>
                                    <tr>
                                      <td width="150">No. BAPOB</td>
                                      <td width="20">:</td>
                                      <td width="330">-</td>
                                    </tr>
                                    <tr>
                                      <td>Macam</td>
                                      <td>:</td>
                                      <td><label id="lblMacam"/></td>
                                    </tr>
                                    <tr>
                                      <td>Konversi Kertas</td>
                                      <td>:</td>
                                      <td><label id="lblKonversiKertas"/></td>
                                    </tr>
                                    <tr>
                                      <td>Jml Pesanan</td>
                                      <td>:</td>
                                      <td><label id="lblJmlPesanan"/></td>
                                    </tr>
                                    <tr>
                                      <td>Waste Pita</td>
                                      <td>:</td>
                                      <td><label id="lblWastePita"/></td>
                                    </tr>
                                    <tr>
                                      <td>Waste Perekat</td>
                                      <td>:</td>
                                      <td><label id="lblWastePerekat"/></td>
                                    </tr>
                                    <tr>
                                      <td>Hasil Belah</td>
                                      <td>:</td>
                                      <td>-</td>
                                    </tr>
                                  </table>
                                </td>
                                <td valign="Top"> 
                                <table>
                                    <tr>
                                      <td width="150">Tanggal Proses</td>
                                      <td width="20">:</td>
                                      <td width="330"><label id="lblTglProses"/></td>
                                    </tr>
                                    <tr>
                                      <td>Bahan Utama</td>
                                      <td>:</td>
                                      <td><label id="lblBahanUtama"/></td>
                                    </tr>
                                    <tr>
                                      <td>Panjang</td>
                                      <td>:</td>
                                      <td><label id="lblPanjang"/></td>
                                    </tr>
                                    <tr>
                                      <td>Konversi Roll</td>
                                      <td>:</td>
                                      <td><label id="lblKonversiRoll"/></td>
                                    </tr>
                                    <tr>
                                      <td>Bahan Konversi</td>
                                      <td>:</td>
                                      <td><label id="lblBahanKonversi"/></td>
                                    </tr>
                                    <tr>
                                      <td>Waste Belah</td>
                                      <td>:</td>
                                      <td><label id="lblWasteBelah"/></td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>



                            <br />




                            
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <!-- <br /> -->
                        <table>
                          <tr>
                            <td width="500">
                              <button class="btn btn-success pull-left">Simpan</button> 
                              &nbsp &nbsp
                              <button class="btn btn-danger" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
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