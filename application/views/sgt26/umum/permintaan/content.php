
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

          
          <form role="form" method="POST" action="<?php echo site_url('sgt/umum/permintaan/simpan');?>" onsubmit="return validasi(this)" autocomplete="off">
          
          <div class="card card-primary" id="bodyinput">
            <div class="card-body">

              <table>
                <tr>
                  <td>



                    <table id="tblUtama">
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Nama Barang</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih barang">
                            <select name="cmbBarang"  id="cmbBarang"  class="form-control select2" onchange="pilihBarang()">
                              <option value=''></option>
                              <!-- <option value='0'>Tugas Pokok</option> -->
                              <?php foreach($data_barang as $row){ ?>
                                <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA." (".$row->SPESIFIKASI.")" ; ?></option>
                              <?php } ?> 
                            </select>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Jumlah</font></label></td>
                        <td width="300" colspan="2">
                          <div data-tip="Jumlah barang">
                            <input class="form-control" type="text" id="txtJumlah" name="txtJumlah" onkeydown="justNumber(event);">
                          </div>
                        </td>
                        <td width="100">
                          <div data-tip="Satuan">
                            <input class="form-control" type="text" id="txtSatuan" name="txtSatuan" readonly>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Keterangan</font></label></td>
                        <td colspan="3">
                          <div data-tip="Keterangan terkait kebutuhan">
                            <input class="form-control" type="text" id="txtKeterangan" name="txtKeterangan">
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr>
                        <td/>
                        <td width="50"><button type="button" class="btn btn-block btn-info" id="btnSimpan" onclick="tambahBarang()">Tambah</button></td>
                        <td colspan="2"/>
                      </tr>
                    </table>










                  </td>
                  <td width="20" />
                  <td valign="top">

                    <font color="blue">
                    <table id="tblOutstanding" border="1" style="display:none;">
                      <thead>
                        <tr align="center">
                          <th width="100">Tanggal</th>
                          <th width="200">SIP</th>
                          <th width="100">Outstanding</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- <tr>
                          <td align="center">22/22/2020</td>
                          <td align="center">45/2020/222222</td>
                          <td>45 Ton</td>
                        </tr>   -->
                      </tbody>       
                    </table>
                    </font>











                  </td>
                </tr>
              </table>


                
              
                <!-- <font size="2">
                  <div id="DetailInfo"></div>
                </font> -->
                
                <br />

                <table class="table table-bordered" id="tblBarang" style="background: #17A2B8; color: white" name="tblParameters">
                  <!-- <thead>
                    <tr align="center"> -->
                      <!-- <th width="300">Nama barang</th>
                      <th width="100">Jumlah</th>
                      <th width="100">Satuan</th>
                      <th width="150">Kelompok</th>
                      <th width="100">Kembali</th>
                      <th width="100">Cek IT</th>
                      <th>Keterangan</th>
                      <th width="10"></th>
                      <th hidden="true"></th> -->
                      <!-- <th width="400"><font size="5"><label id="lblParameter">Nama Barang</label></font></th>
                      <th width="30" ><font size="5"  data-tip="Total semua progres">Jumlah</font></th>
                      <th width="30" ><font size="5"  data-tip="Total semua progres">Keterangan</font></th>
                      <th width="20"></th> -->
                    <!-- </tr>
                    
                  </thead> -->
                  <tbody>
                    <tr align="center">
                      <td style="width: 40%;"><font size="4"><label id="lblParameter">Nama Barang</label></font></td>
                      <td style="width: 20%;" ><font size="4"><label id="lblParameter">Jumlah</label></font></td>
                      <td style="width: 35%;" ><font size="4"><label id="lblParameter">Keterangan</label></font></td>
                      <td style="width: 5%;"></td>
                    </tr>
                    <!-- <tr>
                      <td>
                        <div data-tip="Bagian dari tugas yang menunjukan kemajuan progres">
                          <input class="form-control" type="text" id="txtParameter[]" name="txtParameter[]"/>
                        </div>
                      </td>
                      <td>
                        <div data-tip="Presentase dari total 100%">
                          <input class="form-control" type="text" id="txtProgres[]" name="txtProgres[]" onkeydown="justNumber(event);" onkeyup="hitungPersen();" />
                        </div>
                      </td>
                      <td>
                        <div data-tip="Presentase dari total 100%">
                          <input class="form-control" type="text" id="txtProgres[]" name="txtProgres[]" onkeydown="justNumber(event);" onkeyup="hitungPersen();" />
                        </div>
                      </td>
                      <td width="10">
                        <div data-tip="&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hapus baris ini">
                          <button type="button" class="btn btn-block btn-danger" id="btnDellRow" onclick="hapusRow(this);">x</button>
                        </div>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
            </div>
            <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="submit" class="btn btn-block btn-primary" id="btnSimpan" )">Simpan</button></td>
                  <td width="10"></td>
                  <td width="150"><a href="<?php echo site_url('sgt/umum/permintaan'); ?>" class="btn btn-block btn-danger">Batal</a></td>
                </tr>
              </table>
            </div>
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