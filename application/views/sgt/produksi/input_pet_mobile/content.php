
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
            <b><font color="White">Produksi PET</font></b>
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

          <form role="form" method="POST" action="<?php echo site_url('sgt/produksi/input_pet_mobile/simpan');?>" autocomplete="off" onsubmit="return validasi()">
          
          <div class="card card-primary" id="bodyinput">
            <div class="card-body">

              <table>
                <tr>
                  <td>

                    <table id="tblUtama">
                      <tr valign="top">
                        <td width="200"><label><font size = "5">Tanggal Mulai</font></label></td>
                        <td width="250" colspan="2">
                          <div data-tip="Tanggal Mulai">
                            <input class="form-control" type="text" id="txtTanggalMulai" name="txtTanggalMulai" >
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Tanggal Selesai</font></label></td>
                        <td colspan="2">
                        <div data-tip="Tanggal Selesai">
                            <input class="form-control" type="text" id="txtTanggalSelesai" name="txtTanggalSelesai" >
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td><label><font size = "5">Proses</font></label></td>
                        <td colspan="2">
                          <div data-tip="Pilih Proses">
                            <select name="cmbProses"  id="cmbProses"  class="form-control select2" onchange="loadJumlah()">
                              <option value=''></option>
                              <?php foreach($proses->result_array() as $dt){ ?>
                                <?php if ($dt['NEXT_PROSES'] != null) { ?>
                                  <option value='<?php echo $dt['PROSES']; ?>'><?php echo $dt['PROSES']; ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td ><label><font size = "5">Kode Roll</font></label></td>
                        <td colspan="2">
                          <div data-tip="Pilih Barang">
                            <select name="cmbBarang"  id="cmbBarang"  class="form-control select2" onchange="loadJumlah()">
                              <option value=''></option>
                              <?php foreach($dataROllBonProduksi as $row){ ?>
                                <option value="<?php echo $row->ID_DETAIL_TERIMA.'@'.$row->TAHUN.'@'.$row->QTY_TERIMA.'@'.$row->SATUAN.'@'.$row->KODE_ROLL.'@'.$row->ID_GUDANG_ORDER; ?>"><?php echo $row->KODE_ROLL ; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Jumlah</font></label></td>
                        <td width="150" >
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
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td ><label><font size = "5">Mesin</font></label></td>
                        <td  colspan="2">
                          <div data-tip="Pilih Mesin">
                            <select name="cmbMesin"  id="cmbMesin"  class="form-control select2">
                              <option value=''></option>
                              <option value='Emboss 1'>Emboss 1</option>
                              <option value='Emboss 2'>Emboss 2</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td ><label><font size = "5">Shift</font></label></td>
                        <td  colspan="2">
                          <div data-tip="Pilih Shift">
                            <select name="cmbShift"  id="cmbShift"  class="form-control select2">
                              <option value=''></option>
                              <option value='A'>A</option>
                              <option value='B'>B</option>
                              <option value='C'>C</option>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td ><label><font size = "5">Pengawas</font></label></td>
                        <td colspan="2">
                          <div data-tip="Pilih Pengawas">
                            <select name="cmbPengawas"  id="cmbPengawas"  class="form-control select2">
                              <option value=''></option>
                              <?php foreach ($pengawas->result_array() as $dt) { ?>
                                <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td ><label><font size = "5">Operator</font></label></td>
                        <td  colspan="2">
                          <div data-tip="Pilih Operator">
                            <select multiple class="form-control" name="cmbOperator[]" id="cmbOperator"  style="width: 100%;">
                              <?php foreach ($operator->result_array() as $dt) { ?>
                                <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Hasil</font></label></td>
                        <td >
                          <div data-tip="Hasil barang">

                            <input class="form-control" type="text" id="txtHasil" name="txtHasil" >
                          </div>
                        </td>
                        <td >
                          <div data-tip="Satuan">
                            <input class="form-control" type="text" id="txtSatuan2" name="txtSatuan2" >
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Reject</font></label></td>
                        <td >
                          <div data-tip="Reject barang">

                            <input class="form-control" type="text" id="txtReject" name="txtReject" value="0">
                          </div>
                        </td>
                        <td >
                          <div data-tip="Satuan">
                            <input class="form-control" type="text" id="txtSatuan3" name="txtSatuan3" >
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
                  <!-- <td width="20" />
                  <td valign="top">


                  </td> -->
                </tr>
              </table>


                
              
                <!-- <font size="2">
                  <div id="DetailInfo"></div>
                </font> -->
                
                <br />

                <!-- <table class="table table-bordered" id="tblBarang" name="tblBarang">
                  <thead>
                    <tr align="center">
                      <th style="width: 30%;"><font size="4">Kode</font></th>
                      <th style="width: 50%;" ><font size="4">Nama</font></th>
                      <th style="width: 30%;" ><font size="4">Jumlah</font></th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  </tbody>
                </table> -->

            </div>
            <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="submit" class="btn btn-block btn-primary" id="btnSimpan" )">Simpan</button></td>
                  <td width="10"></td>
                  <td width="150"><a href="<?php echo site_url('sgt/produksi/input_pet_mobile'); ?>" class="btn btn-block btn-danger">Batal</a></td>
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
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Daftar Produksi PET</font></b>
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

          <!-- <form  method="POST" action="<?php //echo site_url('sgt/gudang/ipb/filterLaporan');?>">
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
              <div class="card-footer">
                <button type="submit" class="btn btn-success">&nbsp Filter &nbsp</button>
                <input type="button" value="Lihat 3 Bulan Terakhir" class="btn btn-warning pull-right" onclick="window.location.href='<?php //echo site_url('sgt/gudang/ipb');?>'" />
              </div>
            </div>
          </form> -->


          <div class="card">
           
            <div class="card-body">
              <font size="2">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width=30%>Kode</th>
                    <th width=10%>Tanggal</th>
                    <th width=10%>Mulai</th>
                    <th width=10%>Selesai</th>
                    <th width=10%>Panjang</th>
                    <th width=10%>Hasil</th>
                    <th width=10%>Reject</th>
                    <th width=10%>Sisa</th>
                  </tr>
                </thead>
                <tbody>

                  <?php foreach($dataProdPet as $row){ ?>
                    <tr align="center">
                    <!-- <form role="form" method="POST" action="<?php //echo site_url('sgt/gudang/ipb/cetak_ulang_ipb');?>" target="_blank"> -->
                      <td><?php echo $row->KODE; ?></td>
                      <td><?php echo $row->TANGGAL; ?></td>
                      <td><?php echo $row->MULAI; ?></td>
                      <td><?php echo $row->SELESAI; ?></td>
                      <td><?php echo $row->PANJANG; ?></td>
                      <td><?php echo $row->HASIL; ?></td>
                      <td><?php echo $row->REJECT; ?></td>
                      <td><?php echo $row->SISA; ?></td>
                      <!-- <td>
                        <input name="txtIdIpb" type='hidden' value=<?php //echo $row->ID; ?> />
                        <button type="submit" class="btn btn-block btn-danger btn-sm">Print</button>
                      </td> -->
                    <!-- </form> -->
                    </tr>
                  <?php } ?>


                </tbody>
              
              </table>
            </font>
            </div>
          </div>
          






          <!-- ==================================ISI KONTEN================================== -->
                  
        </div>
        <div class="card-footer"><font color="Green" size="2">
            ERP @2019
        </font></div>
      </div>



    </section>
  </div>