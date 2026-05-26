
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
            <b><font color="White">Serah Terima Waste Tidak Standar</font></b>
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
          
          
          
          <form  method="POST" action="<?php echo site_url('sgt/umum/kirim_waste/simpan');?>" onsubmit="return validasi()">
            <div class="card card-info">
              <div class="card-body">

              <table id="tblUtama">
                <tr valign="top">
                  <td width="200"><label><font size = "5">Tanggal</font></label></td>
                  <td width="400">
                    <font size="2"></font>
                      <div data-tip="Tanggal Kirim">
                        <input type="text" class="form-control pull-right" id="tanggal" name = "tanggal" style="background: white;">
                      </div>
                    </font>
                  </td>
                </tr>
                <tr height="10"></tr>
                <!-- <tr valign="top">
                  <td><label><font size = "5">Nomer SP</font></label></td>
                  <td>
                    <div data-tip="Nomer SP">
                      <input class="form-control" type="text" id="txtNoSP" name="txtNoSP">
                    </div>
                  </td>
                </tr> -->
                <tr height="10"></tr>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                <button type="submit" class="btn btn-success">&nbsp Simpan &nbsp</button>
                <input type="button" value="&nbsp &nbsp Batal &nbsp &nbsp" class="btn btn-danger" onclick="window.location.href='<?php //echo site_url('sgt/umum/cek_permintaan');?>'" />
              </div> -->
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
                    <th width="75">SPP</th>
                    <th width="75">Seri</th>
                    <th width="100">Tgl</th>
                    <th width="75">Tahun</th>
                    <th width="200">Jenis</th>
                    <th width="75">No. Bal</th>
                    <th width="75">Mutasi</th>
                    <th width="75">Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($data_stok as $row){ ?>
                  <?php
                    $kode_bahan = explode("-",$row->KODE_BAHAN);
                    
                    $seri = '';
                    if($kode_bahan[2] == '001'){
                      $seri = 'Seri 1';
                    }elseif($kode_bahan[2] == '002'){
                      $seri = 'Seri 2';
                    }elseif($kode_bahan[2] == '003'){
                      $seri = 'Seri 3';
                    }elseif($kode_bahan[2] == '004'){
                      $seri = 'MMEA';
                    }

                    $jenis = '';
                    if($row->JENIS_WASTE == 'A'){
                      $jenis = 'Rusak Holo Tidak Standar';
                    }elseif ($row->JENIS_WASTE == 'B') {
                      $jenis = 'Rusak Kertas Polos';
                    }elseif ($row->JENIS_WASTE == 'C') {
                      $jenis = 'Waste Sisiran Polos';
                    }elseif ($row->JENIS_WASTE == 'D') {
                      $jenis = 'Waste Sisiran Berholo';
                    }elseif ($row->JENIS_WASTE == 'E') {
                      $jenis = 'Waste Sisiran Bersticker';
                    }
                  ?>
                    <tr>
                      <td align="center">
                        <input type="checkbox" name="cbNoUrutWaste[]" 
                        value="<?php echo $row->NO_SPP.'@'.$row->TGL_DELTIME_SPP.
                        '@'.$row->JENIS_WASTE.'@'.$row->RUSAK_KG.'@'.$row->KODE_BAHAN.
                        '@'.$row->KODE_WASTE;?>">
                      </td>
                      <td align="center"><?php echo $row->NO_SPP; ?></td>
                      <td align="center"><?php echo $seri; ?></td>
                      <td align="center"><?php echo $row->TGL_WASTE; ?></td>
                      <td align="center"><?php echo $kode_bahan[1]; ?></td>
                      <td align="center"><?php echo $jenis; ?></td>
                      <td align="center"><?php echo $row->NO_BAL; ?></td>
                      <td align="center"><?php echo $row->NOMOR_MUTASI; ?></td>
                      <td><?php echo $row->RUSAK_KG; ?></td>
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
              <div class="card-footer">
                <button type="submit" class="btn btn-success">&nbsp Simpan &nbsp</button>
                <input type="button" value="&nbsp &nbsp Batal &nbsp &nbsp" class="btn btn-danger" onclick="window.location.href='<?php echo site_url('sgt/umum/kirim_waste');?>'" />
              </div>
              <!-- /.card-footer -->
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


  