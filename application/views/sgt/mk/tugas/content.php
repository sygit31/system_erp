
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
            <b><font color="White">Input Tugas</font></b>
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

          
          
          <form id="frmData" role="form" method="POST" action="<?php echo site_url('sgt/mk/tugas/simpan');?>" onsubmit="return validasi(event,this)">
          <!-- <input type="hidden" id="txtJumlahDetail" name="txtJumlahDetail"> -->
          <div class="card card-primary" id="bodyinput">
            <div class="card-body">
                <table id="tblUtama">
                  <tr valign="top">
                    <td width="200"><label><font size = "5">Periode</font></label></td>
                    <td width="170">
                      <font size="2"></font>
                        <div data-tip="Tanggal mulai">
                          <input type="text" class="form-control pull-right" id="tanggalAwal" name = "tanggalAwal" style="background: white;">
                        </div>
                      </font>
                    </td>
                    <td width="50" align="center">to</td>
                    <td width="170" colspan="2">
                      <font size="2"></font>
                        <div data-tip="Tanggal selesai">
                          <input type="text" class="form-control pull-right" id="tanggalAkhir" name = "tanggalAkhir" style="background: white;">
                        </div>
                      </font>
                    </td>
                  </tr>
                  <tr height="10"></tr>

                  <tr valign="middle">
                    <td><label><font size = "5">Project</font></label></td>
                    <td colspan="4">
                      <div data-tip="Tipe tugas">
                        <select name="cmbTipe"  id="cmbTipe"  class="form-control select2" onchange="pilihProject()">
                          <option value=''></option>
                          <option value='0'>Tugas Pokok</option>
                          <?php foreach($DaftarProject as $row){ ?>
                            <option value='<?php echo $row->ID."-".$row->ID_KARY; ?>'><?php echo $row->NAMA ; ?></option>
                          <?php } ?> 
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="middle">
                    <td><label><font size = "5">PIC</font></label></td>
                    <td colspan="4">
                      <div data-tip="PIC terhadap jalannya tugas">
                        <select class="form-control select2" id="cmbPIC" name="cmbPIC">
                          <option value=""></option>
                          <?php foreach($DaftarStruktural as $row){ ?>
                            <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA ; ?></option>
                          <?php } ?> 
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="middle">
                    <td><label><font size = "5">Karyawan</font></label></td>
                    <td colspan="4">
                      <!-- <select name="cmbPrioritas"  id="cmbPrioritas"  class="form-control select2" style="width: 100%;" required>
                        <option value=''></option>
                        <option value='critical'>Critical</option>
                        <option value='optional'>Optional</option>
                      </select> -->
                      <div data-tip="Karyawan yang mengerjakan tugas">
                        <select class="form-control select2" id="cmbKaryawan" name="cmbKaryawan">
                          <option value=""></option>
                          <?php foreach($DaftarKaryawan as $row){ ?>
                            <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA ; ?></option>
                          <?php } ?> 
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="top">
                    <td><label><font size = "5">Tugas</font></label></td>
                    <td colspan="3">
                      <div data-tip="Tugas yang akan dikerjakan">
                        <input class="form-control" type="text" id="txtTugas" name="txtTugas" style="width: 98%;">
                      </div>
                    </td>
                    <td width="50">
                      <div data-tip="&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Daftar tugas lama">
                        <button type="button" class="btn btn-block btn-success" id="btnCallProject"> ... </button>
                      </div>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="top">
                    <td><label><font size = "5">Target (%)</font></label></td>
                    <td colspan="4">
                      <div data-tip="Target bagian dari project di periode ini">
                        <input class="form-control" type="text" id="txtTarget" name="txtTarget" onkeydown="justNumber(event);">
                      </div>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="top">
                    <td><label><font size = "5">Nilai</font></label></td>
                    <td colspan="4">
                      <div data-tip="Nilai yang diajukan untuk tugas ini">
                        <input class="form-control" type="text" id="txtNilai" name="txtNilai" onkeydown="justNumber(event);">
                      </div>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                </table>
              
                <!-- <font size="2">
                  <div id="DetailInfo"></div>
                </font> -->
                
            </div>
            <!-- <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="submit" class="btn btn-block btn-primary" id="btnSimpan" )">Simpan</button></td>
                  <td width="10"></td>
                  <td width="150"><a href="<?php //echo site_url('sgt/qc/'); ?>" class="btn btn-block btn-danger">Batal</a></td>
                </tr>
              </table>
            </div> -->







          <!-- Horizontal Form -->
          <div class="card card-info" style="width: 75%">
            <!-- form start -->
            <!-- <form class="form-horizontal">  -->
              <div class="card-body">
                <!-- <table class="table table-bordered" id="tblBarang" style="background: #17a2b8; color: white"> -->
                <table class="table table-bordered" id="tblParameters" style="background: #28A745; color: white" name="tblParameters">
                  <thead>
                    <tr align="center">
                      <!-- <th width="300">Nama barang</th>
                      <th width="100">Jumlah</th>
                      <th width="100">Satuan</th>
                      <th width="150">Kelompok</th>
                      <th width="100">Kembali</th>
                      <th width="100">Cek IT</th>
                      <th>Keterangan</th>
                      <th width="10"></th>
                      <th hidden="true"></th> -->
                      <th width="400"><font size="5"><label id="lblParameter">Parameter</label></font></th>
                      <th width="30" ><font size="5"  data-tip="Total semua progres">Progress (<label id="lblTotalProgress" name="lblTotalProgress">0</label> %)</font></th>
                      <th width="20"></th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <tr>
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
                      <!-- <td width="10">
                        <button type="button" class="btn btn-block btn-primary" id="btnAddRow" onclick="tambahRow(this);">+</button>
                      </td> -->
                      <td width="10">
                        <div data-tip="&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Hapus baris ini">
                          <button type="button" class="btn btn-block btn-danger" id="btnDellRow" onclick="hapusRow(this);">x</button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <br />
                <table>
                  <tr>
                    <td width="100">
                      <button type="button" class="btn btn-block btn-success" id="btnAddRow" onclick="tambahRow(this);">Tambah</button>
                    </td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
            <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="submit" class="btn-lg btn-block btn-primary" id="btnSimpan" )">Simpan</button></td>
                  <td width="10"></td>
                  <!-- <td width="150"><a href="<?php echo site_url('sgt/qc/'); ?>" class="btn-lg btn-block btn-danger" style="text-align: center;">Batal</a></td> -->
                  <td width="150"><button type="reset" class="btn-lg btn-block btn-danger" id="btnHapus">Batal</button></td>
                </tr>
              </table>
            </div>
            <!-- </form> -->
            </form>
          </div>
          <!-- /.card -->


          </div>
          

                          












          
          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/');?>" onsubmit="return validasi(this)" autocomplete="off">
                    <input type="hidden" id="txtIdRisalah" name="txtIdRisalah">
                    <input type="hidden" id="txtIdProses" name="txtIdProses">
                    
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
                                  <center><b><label style="font-size: 15px;">No. KK : .../PNP-HLG/PPIC/KKM/../...</label></b></center>
                                </td>
                              </tr>
                              <tr height="20"><td colspan="2"/></tr>
                              <tr>
                                <td>
                                  <table>
                                    <tr>
                                      <td width="150">No. BAPOB</td>
                                      <td width="20">:</td>
                                      <td width="330">XXX</td>
                                    </tr>
                                    <tr>
                                      <td>Macam</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Konversi Kertas</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Jml Pesanan</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Waste Pita</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Waste Perekat</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Hasil Belah</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                  </table>
                                </td>
                                <td valign="Top"> 
                                <table>
                                    <tr>
                                      <td width="150">Tanggal Proses</td>
                                      <td width="20">:</td>
                                      <td width="330">XXX</td>
                                    </tr>
                                    <tr>
                                      <td>Bahan</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Panjang</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Konversi Roll</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Bahan Konversi</td>
                                      <td>:</td>
                                      <td>YYY</td>
                                    </tr>
                                    <tr>
                                      <td>Waste Belah</td>
                                      <td>:</td>
                                      <td>YYY</td>
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