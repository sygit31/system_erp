

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-danger">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Import Data dari File Excel</font></b>
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
        <!-- Load File jquery.min.js yang ada difolder js -->
        <script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>

        <?php if(isset($_POST['btnPreview'])){ ?>
          <script> 
            $(document).ready(function(){
              $('#dImport').show();
            });
            </script>
        <?php  }else{ ?>
          <script> 
            $(document).ready(function(){
              $('#dPreview').show();
            }); 
          </script>
        <?php  } ?>


        <div id="dPreview" style='display:none;'>
          <form role="form" method="POST" action="<?php echo site_url('sgt/cc/lpblpj/preview');?>" autocomplete="off"  enctype="multipart/form-data">
            <table>
                <tr height="5"></tr>
                <tr>
                    <td colspan="2" width="400">
                      <b>Pilih File</b> &nbsp; &nbsp; <input name="fileLpb" type="file" required="required">
                    </td>
                    <td>
                      <button type="submit" class="btn btn-block btn-danger" id="btnPreview" name="btnPreview">Preview</button>
                    </td>
                </tr>
            </table>
          </form>
        </div>


        <div id="dImport" style='display:none;'>
          <?php
            if(isset($upload_error)){ // Jika proses upload gagal
              echo "<br /><div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
              // die; // stop skrip
            }

            if(isset($sheet)){
              // Buat sebuah tag form untuk proses import data ke database
              echo "<form method='post' action='". site_url('sgt/cc/lpblpj/import') ."'>";
              
              
              print_r("
                <div id='dBtnImport' style='display:none;'>
                  <table>
                    <tr>
                      <td width='100'><button type='submit' class='btn btn-block btn-danger' id='btnImport' name='btnImport'>Simpan</button></td>
                      <td width='10' />
                      <td width='100'><a href='".site_url('sgt/cc/lpblpj/lpb')."' class='btn btn-block btn-warning'>Batal</a></td>
                    <tr>
                    <tr height='10'/>
                  </table>
                </div>
              ");



              // Buat sebuah div untuk alert validasi kosong
              echo "<div style='color: red;display:none;' id='kosong'>
              Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
              </div>";
              
              echo "<table border='1' id='tblPreview' class='table table-bordered table-striped'>
              <thead>
              <tr>
                <th>No.</th>
                <th>Supplier</th>
                <th>No. LPB Int</th>
                <th>No. LPB Ext</th>
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Rekening</th>
                <th>Alokasi</th>
                <th>Departement</th>
                <th>Jumlah Barang</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Jumlah Rupiah</th>
                <th>PPN</th>
                <th>PPH</th>
                <th>Total</th>
                <th>Tanggal Kerja</th>
              </tr>
              </thead>
              <tbody>";
              
              $numrow = 1;
              $kosong = 0;
              
              // Lakukan perulangan dari data yang ada di excel
              // $sheet adalah variabel yang dikirim dari controller
              foreach($sheet as $row){ 
                // Ambil data pada excel sesuai Kolom
                $no = $row['A']; // Ambil data NIS
                $supplier = $row['B']; // Ambil data nama
                $no_lpb_internal = $row['C']; // Ambil data jenis kelamin
                $no_lpb_external = $row['D']; // Ambil data alamat
                $tanggal = $row['E']; // Ambil data alamat
                $barang = $row['F']; // Ambil data alamat
                $rekening = $row['G']; // Ambil data alamat
                $alokasi = $row['H']; // Ambil data alamat
                $departement = $row['I']; // Ambil data alamat
                $jumlah_barang = $row['J']; // Ambil data alamat
                $satuan = $row['K']; // Ambil data alamat
                $harga = $row['L']; // Ambil data alamat
                $jumlah_rupiah = $row['M']; // Ambil data alamat
                $ppn = $row['N']; // Ambil data alamat
                $pph = $row['O']; // Ambil data alamat
                $total = $row['P']; // Ambil data alamat
                $tgl_kerja = $row['Q']; // Ambil data alamat
                
                // Cek jika semua data tidak diisi
                if($no == "" && $supplier == "" && $no_lpb_internal == "" && $no_lpb_external == "" && $tanggal == "" && $barang == "" && $rekening == "" && $alokasi == "" && $departement == "" && $jumlah_barang == "" && $satuan == "" && $harga == "" && $jumlah_rupiah == "" && $ppn == "" && $pph == "" && $total == "" && $tgl_kerja == "" )
                  continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
                
                // Cek $numrow apakah lebih dari 1
                // Artinya karena baris pertama adalah nama-nama kolom
                // Jadi dilewat saja, tidak usah diimport
                if($numrow > 5){
                  // Validasi apakah semua data telah diisi
                  $no_td = ( ! empty($no))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                  $supplier_td = ( ! empty($supplier))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                  $no_lpb_internal_td = ( ! empty($no_lpb_internal))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $no_lpb_external_td = ( ! empty($no_lpb_external))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $tanggal_td = ( ! empty($tanggal))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $barang_td = ( ! empty($barang))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $rekening_td = ( ! empty($rekening))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $alokasi_td = ( ! empty($alokasi))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $departement_td = ( ! empty($departement))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $jumlah_barang_td = ( ! empty($jumlah_barang))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $satuan_td = ( ! empty($satuan))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $harga_td = ( ! empty($harga))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $jumlah_rupiah_td = ( ! empty($jumlah_rupiah))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $ppn_td = ( ! empty($ppn))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $pph_td = ( ! empty($pph))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $total_td = ( ! empty($total))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $tgl_kerja_td = ( ! empty($tgl_kerja))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  
                  // Jika salah satu data ada yang kosong
                  if($no == "" or $supplier == "" or $no_lpb_internal == "" or $no_lpb_external == "" or $tanggal == "" or $barang == "" or $rekening == "" or $alokasi == "" or $departement == "" or $jumlah_barang == "" or $satuan == "" or $harga == "" or $jumlah_rupiah == "" or $ppn == "" or $pph == "" or $total == "" or $tgl_kerja == ""){
                    $kosong++; // Tambah 1 variabel $kosong
                  }
                  
                  echo "<tr>";
                  echo "<td".$no_td.">".$no."</td>";
                  echo "<td".$supplier_td.">".$supplier."</td>";
                  echo "<td".$no_lpb_internal_td.">".$no_lpb_internal."</td>";
                  echo "<td".$no_lpb_external_td.">".$no_lpb_external."</td>";
                  echo "<td".$tanggal_td.">".$tanggal."</td>";
                  echo "<td".$barang_td.">".$barang."</td>";
                  echo "<td".$rekening_td.">".$rekening."</td>";
                  echo "<td".$alokasi_td.">".$alokasi."</td>";
                  echo "<td".$departement_td.">".$departement."</td>";
                  echo "<td".$jumlah_barang_td.">".$jumlah_barang."</td>";
                  echo "<td".$satuan_td.">".$satuan."</td>";
                  echo "<td".$harga_td.">".$harga."</td>";
                  echo "<td".$jumlah_rupiah_td.">".$jumlah_rupiah."</td>";
                  echo "<td".$ppn_td.">".$ppn."</td>";
                  echo "<td".$pph_td.">".$pph."</td>";
                  echo "<td".$total_td.">".$total."</td>";
                  echo "<td".$tgl_kerja_td.">".$tgl_kerja."</td>";
                  echo "</tr>";
                }
                
                $numrow++; // Tambah 1 setiap kali looping
              }
              
              echo "</tbody></table>";
              
              // Cek apakah variabel kosong lebih dari 0
              // Jika lebih dari 0, berarti ada data yang masih kosong
              if($kosong > 0){
          ?>	
                <script>
                  $(document).ready(function(){
                    // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                    $('#jumlah_kosong').html('<?php echo $kosong; ?>');
                  
                    $('#kosong').show(); // Munculkan alert validasi kosong
                  });
                </script>
          <?php
              }else{ // Jika semua data sudah diisi
                echo "<hr>";
          ?>
                <script>
                  $(document).ready(function(){
                    $('#dBtnImport').show();
                  });
                </script>
          <?php
              }
              
              echo "</form>";
            }
          ?>
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




















  
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Export Data ke File Excel</font></b>
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

        <div id="dExport">
          <form role="form" method="POST" action="<?php echo site_url('sgt/cc/lpblpj/export');?>" autocomplete="off"  enctype="multipart/form-data">
            <table>
                <tr height="5"></tr>
                <tr>
                    <td colspan="2" width="200">
                      <div data-tip="Tanggal">
                        <input class="form-control" type="text" id="txtTanggalExport" name="txtTanggalExport">
                      </div>
                    </td>
                    <td width="10" />
                    <td width="100">
                      <button type="submit" class="btn btn-block btn-success" id="btnExport" name="btnExport">Export</button>
                    </td>
                </tr>
            </table>
          </form>
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
            <b><font color="White">LPB</font></b>
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

            
        <form role="form" method="POST" action="<?php echo site_url('sgt/cc/lpblpj/simpanLpb');?>" onsubmit="return validasi()" autocomplete="off">

            <table style="background-color: #EFECE9; filter: alpha(opacity=40); opacity: 0.95;border:3px #B8B7B6 solid;">

            <tr valign="top" height="320">
                <td width="10" />
                <td>
                <table>
                    <tr height="10" />
                    <tr valign="middle">
                        <td width="150"><label><font size = "4">Nomer Invest</font></label></td>
                        <td width="300" colspan="3">
                            <div data-tip="Pilih Invest">
                            <select name="cmbInvest"  id="cmbInvest"  class="form-control select2">
                                <option value=''></option>
                                <?php foreach($data_invest as $row){ ?>
                                <option value='<?php //echo $row->KODE_INVEST; ?>'><?php //echo $row->KODE_INVEST." (".$row->JENIS_INVEST.")" ; ?></option>
                                <option value='<?php echo $row->KODE_INVEST; ?>'><?php echo $row->KODE_INVEST ; ?></option>
                                <?php } ?> 
                            </select>
                            </div>
                        </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Kode Rekening</font></label></td>
                    <td colspan="3">
                        <div data-tip="Kode Rekening">
                        <input class="form-control" type="text" id="TxtKodeRekening" name="TxtKodeRekening">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Unit</font></label></td>
                    <td width="300" colspan="3">
                        <div data-tip="Pilih Unit">
                        <select name="cmbUnit"  id="cmbUnit"  class="form-control select2" onchange="showDepartement()">
                            <option value=''></option>
                            <?php foreach($data_unit as $row){ ?>
                            <!-- <option value='<?php //echo $row->UNIT.'@'. $row->ALOKASI; ?>'><?php //echo $row->UNIT ; ?></option> -->
                            <option value='<?php echo $row->UNIT; ?>'><?php echo $row->UNIT ; ?></option>
                            <?php } ?> 
                        </select>
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Departement</font></label></td>
                    <td width="300" colspan="3">
                        <div data-tip="Pilih Departemen">
                        <select name="cmbDepartement"  id="cmbDepartement"  class="form-control select2">
                            <option value=''></option>
                        </select>
                        </div>
                    </td>
                    </tr>
                    <!-- <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Alokasi Biaya</font></label></td>
                    <td colspan="3">
                        <div data-tip="Alokasi Biaya">
                        <input class="form-control" type="text" id="txtBiaya" name="txtBiaya">
                        </div>
                    </td> 
                    </tr> -->
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Jenis</font></label></td>
                    <td width="300" colspan="3">
                        <div data-tip="Pilih Jenis">
                        <select name="cmbJenis"  id="cmbJenis"  class="form-control select2">
                            <option value=''></option>
                            <option value='POLOS'>Polos</option>
                            <option value='RESMI'>Resmi</option>
                        </select>
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Sumber</font></label></td>
                    <td width="300" colspan="3">
                        <div data-tip="Pilih Sumber">
                        <select name="cmbSumber"  id="cmbSumber"  class="form-control select2">
                            <option value=''></option>
                            <option value='LOKAL'>Lokal</option>
                            <option value='IMPORT'>Import</option>
                        </select>
                        </div>
                    </td>
                    </tr>
                </table>
                </td>
                <td width="20" />
                <td>
                <table>
                    <tr height="10" />
                    <tr valign="top">
                    <td width="150"><label><font size = "4">Tanggal</font></label></td>
                    <td width="300" colspan="3">
                        <div data-tip="Tanggal">
                        <input class="form-control" type="text" id="txtTanggal" name="txtTanggal">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="middle">
                    <td><label><font size = "4">Suplier</font></label></td>
                    <td colspan="3">
                        <div data-tip="Supplier">
                        <input class="form-control" type="text" id="txtSupplier" name="txtSupplier">
                        </div>
                    </td>
                    </tr>
                    
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Keterangan</font></label></td>
                    <td colspan="3">
                        <div data-tip="Keterangan">
                        <input class="form-control" type="text" id="txtKeterangan" name="txtKeterangan">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Nomor LPB</font></label></td>
                    <td width="148">
                        <div data-tip="Internal">
                        <input class="form-control" type="text" id="txtNoLpbInternal" name="txtNoLpbInternal" placeholder="Internal">
                        </div>
                    </td>
                    <td width="4" />
                    <td width="148">
                        <div data-tip="External">
                        <input class="form-control" type="text" id="txtNoLpbExternal" name="txtNoLpbExternal" placeholder="External">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Quantity</font></label></td>
                    <td width="148">
                        <div data-tip="Jumlah">
                        <input class="form-control" type="number" id="txtQuantity" name="txtQuantity" placeholder="Jumlah">
                        </div>
                    </td>
                    <td width="4" />
                    <td width="148">
                        <div data-tip="Satuan">
                        <input class="form-control" type="text" id="txtSatuan" name="txtSatuan" placeholder="Satuan">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Harga</font></label></td>
                    <td width="148">
                        <div data-tip="Harga">
                        <input class="form-control" type="text" id="txtHarga" name="txtHarga" placeholder="Harga">
                        </div>
                    </td>
                    <td width="4" />
                    <td width="148">
                        <div data-tip="Debet">
                        <input class="form-control" type="text" id="txtDebet" name="txtDebet" placeholder="Debet" readonly style="background-color: #FB5C4B;color:blue;">
                        </div>
                    </td>
                    </tr>
                </table>
                </td>
                <td width="10" />
            </tr>
            </table>


            <table>
            <tr height="5"></tr>
            <tr>
                <td />
                <td width="150"><button type="button" class="btn btn-block btn-info" id="btnSimpan" onclick="tambahLPB()" style="background-color: #0C1A7D;">Tambah</button></td>
                <td colspan="2"/>
            </tr>
            </table>

            <br />

            <font size="2">
            <table id="tblLpb" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                    <th style="width: 100px;">No. Invest</th>
                    <th style="width: 100px;">Rekening</th>
                    <th style="width: 100px;">Alokasi</th>
                    <th style="width: 100px;">Jenis</th>
                    <th style="width: 100px;">Sumber</th>
                    <th style="width: 100px;">Tanggal</th>
                    <th style="width: 100px;">Suplier</th>
                    <th style="width: 100px;">Keterangan</th>
                    <th style="width: 100px;">No. LPB Internal</th>
                    <th style="width: 100px;">No. LPB External</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Harga</th>
                    <th style="width: 100px;">Debet</th>
                    <th style="width: 20px;"></th>
                </tr>
                </thead>
                <tbody>
                <!-- isi -->
                </tbody>
            </table>
            </font>
            

            <br />                  
            <table>
            <tr>
                <td width="150"><button type="submit" class="btn btn-block btn-success" id="btnSimpan" >Simpan</button></td>
                <td width="10" />
                <td width="150"><button type="reset" class="btn btn-block btn-danger" id="btnBatal" onclick="batalkan()">Batal</button></td>
            </tr>
            </table>

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

    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->










































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
            <b><font color="White">Data LPB</font></b>
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

    


          
          
         
          <font size="3">
            <table id="tblData" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <th style="width: 30px !important;"></th>
                  <th style="width: 100px !important;">Tanggal</th>
                  <th style="width: 100px !important;">Rekening</th>
                  <th style="width: 100px !important;">Alokasi</th>
                  <th style="width: 100px !important;">Departemen</th>
                  <th style="width: 200px !important;">Nomer Invest</th>
                  <th style="width: 100px !important;">Jenis</th>
                  <th style="width: 100px !important;">Sumber</th>
                  <th style="width: 300px !important;">Supplier</th>
                  <th style="width: 300px !important;">Keterangan</th>
                  <th style="width: 100px !important;">LPB Internal</th>
                  <th style="width: 100px !important;">LPB External</th>
                  <th style="width: 100px !important;">Jumlah</th>
                  <th style="width: 100px !important;">Satuan</th>
                  <th style="width: 100px !important;">Harga</th>
                  <th style="width: 100px !important;">Debet</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach($data_last as $row){ ?>
                  <tr>
                    <td align="center">
                      <button type="button" class="btn btn-block btn-warning btn-sm" 
                      id=<?php echo $row->id_lpb; ?> 
                      data-toggle='modal' data-target='#modal-detail' >
                        Ubah
                      </button>
                    </td>
                    <td align="center"><?php echo $row->tanggal_format; ?></td>
                    <td align="center"><?php echo $row->kode_rekening; ?></td>
                    <td align="center"><?php echo $row->alokasi; ?></td>
                    <td align="center"><?php echo $row->kode_departement; ?></td>
                    <td align="center"><?php echo $row->kode_invest; ?></td>
                    <td align="center"><?php echo $row->status; ?></td>
                    <td align="center"><?php echo $row->sumber_barang; ?></td>
                    <td align="center"><?php echo $row->suplier; ?></td>
                    <td align="center"><?php echo $row->keterangan; ?></td>
                    <td align="center"><?php echo $row->no_lpb_internal; ?></td>
                    <td align="center"><?php echo $row->no_lpb_eksternal; ?></td>
                    <td align="center"><?php echo $row->jumlah; ?></td>
                    <td align="center"><?php echo $row->satuan; ?></td>
                    <td align="center"><?php echo $row->harga_satuan; ?></td>
                    <td align="center"><?php echo $row->debet; ?></td>
                   
                  </tr>
                <?php } ?>


              </tbody>
            </table>
          </font>










                          
          
          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/cc/lpblpj/ubahLpb');?>" autocomplete="off">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <div class="modal-title"><h5><b>Ubah LPB</b></h5></div>
                      <input class="form-control" type="hidden" id="txtIdLpb" name="txtIdLpb">

                      <!-- <table>
                        <tr valign="center">
                          <td>
                            <label id='lblBagian' style="font-size: 50px;color: blue;"/>
                          </td>
                        </tr>
                      </table> -->
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> -->
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            






                          <table style="background-color: #EFECE9; filter: alpha(opacity=40); opacity: 0.95;border:3px #B8B7B6 solid;">

                            <tr valign="top" height="320">
                                <td width="10" />
                                <td>
                                <table>
                                    <tr height="10" />
                                    <tr valign="middle">
                                        <td width="100"><label><font size = "4">No. Invest</font></label></td>
                                        <td width="300" colspan="3">
                                            <div data-tip="Pilih Invest">
                                            <select name="cmbInvestE"  id="cmbInvestE"  class="form-control select2">
                                                <option value=''></option>
                                                <?php foreach($data_invest as $row){ ?>
                                                <option value='<?php //echo $row->KODE_INVEST; ?>'><?php //echo $row->KODE_INVEST." (".$row->JENIS_INVEST.")" ; ?></option>
                                                <option value='<?php echo $row->KODE_INVEST; ?>'><?php echo $row->KODE_INVEST ; ?></option>
                                                <?php } ?> 
                                            </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="top">
                                    <td><label><font size = "4">K. Rekening</font></label></td>
                                    <td colspan="3">
                                        <div data-tip="Kode Rekening">
                                        <input class="form-control" type="text" id="TxtKodeRekeningE" name="TxtKodeRekeningE">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="middle">
                                    <td width="100"><label><font size = "4">Unit</font></label></td>
                                    <td width="300" colspan="3">
                                        <div data-tip="Pilih Unit">
                                        <select name="cmbUnitE"  id="cmbUnitE"  class="form-control select2" onchange="showDepartementE()">
                                            <option value=''></option>
                                            <?php foreach($data_unit as $row){ ?>
                                            <!-- <option value='<?php //echo $row->UNIT.'@'. $row->ALOKASI; ?>'><?php //echo $row->UNIT ; ?></option> -->
                                            <option value='<?php echo $row->UNIT; ?>'><?php echo $row->UNIT ; ?></option>
                                            <?php } ?> 
                                        </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="middle">
                                    <td width="100"><label><font size = "4">Departement</font></label></td>
                                    <td width="300" colspan="3">
                                        <div data-tip="Pilih Departemen">
                                        <select name="cmbDepartementE"  id="cmbDepartementE"  class="form-control select2">
                                            <option value=''></option>
                                        </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <!-- <tr height="10" />
                                    <tr valign="top">
                                    <td><label><font size = "4">Alokasi Biaya</font></label></td>
                                    <td colspan="3">
                                        <div data-tip="Alokasi Biaya">
                                        <input class="form-control" type="text" id="txtBiaya" name="txtBiaya">
                                        </div>
                                    </td> 
                                    </tr> -->
                                    <tr height="10" />
                                    <tr valign="middle">
                                    <td width="100"><label><font size = "4">Jenis</font></label></td>
                                    <td width="300" colspan="3">
                                        <div data-tip="Pilih Jenis">
                                        <select name="cmbJenisE"  id="cmbJenisE"  class="form-control select2">
                                            <option value=''></option>
                                            <option value='POLOS'>Polos</option>
                                            <option value='RESMI'>Resmi</option>
                                        </select>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="middle">
                                    <td width="100"><label><font size = "4">Sumber</font></label></td>
                                    <td width="300" colspan="3">
                                        <div data-tip="Pilih Sumber">
                                        <select name="cmbSumberE"  id="cmbSumberE"  class="form-control select2">
                                            <option value=''></option>
                                            <option value='LOKAL'>Lokal</option>
                                            <option value='IMPORT'>Import</option>
                                        </select>
                                        </div>
                                    </td>
                                    </tr>
                                </table>
                                </td>
                                <td width="20" />
                                <td>
                                <table>
                                    <tr height="10" />
                                    <tr valign="top">
                                    <td width="100"><label><font size = "4">Tanggal</font></label></td>
                                    <td width="300" colspan="3">
                                        <div data-tip="Tanggal">
                                        <input class="form-control" type="text" id="txtTanggalE" name="txtTanggalE">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="middle">
                                    <td><label><font size = "4">Suplier</font></label></td>
                                    <td colspan="3">
                                        <div data-tip="Supplier">
                                        <input class="form-control" type="text" id="txtSupplierE" name="txtSupplierE">
                                        </div>
                                    </td>
                                    </tr>
                                    
                                    <tr height="10" />
                                    <tr valign="top">
                                    <td><label><font size = "4">Keterangan</font></label></td>
                                    <td colspan="3">
                                        <div data-tip="Keterangan">
                                        <input class="form-control" type="text" id="txtKeteranganE" name="txtKeteranganE">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="top">
                                    <td><label><font size = "4">Nomor LPB</font></label></td>
                                    <td width="148">
                                        <div data-tip="Internal">
                                        <input class="form-control" type="text" id="txtNoLpbInternalE" name="txtNoLpbInternalE" placeholder="Internal">
                                        </div>
                                    </td>
                                    <td width="4" />
                                    <td width="148">
                                        <div data-tip="External">
                                        <input class="form-control" type="text" id="txtNoLpbExternalE" name="txtNoLpbExternalE" placeholder="External">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="top">
                                    <td><label><font size = "4">Quantity</font></label></td>
                                    <td width="148">
                                        <div data-tip="Jumlah">
                                        <input class="form-control" type="number" id="txtQuantityE" name="txtQuantityE" placeholder="Jumlah">
                                        </div>
                                    </td>
                                    <td width="4" />
                                    <td width="148">
                                        <div data-tip="Satuan">
                                        <input class="form-control" type="text" id="txtSatuanE" name="txtSatuanE" placeholder="Satuan">
                                        </div>
                                    </td>
                                    </tr>
                                    <tr height="10" />
                                    <tr valign="top">
                                    <td><label><font size = "4">Harga</font></label></td>
                                    <td width="148">
                                        <div data-tip="Harga">
                                        <input class="form-control" type="text" id="txtHargaE" name="txtHargaE" placeholder="Harga">
                                        </div>
                                    </td>
                                    <td width="4" />
                                    <td width="148">
                                        <div data-tip="Debet">
                                        <input class="form-control" type="text" id="txtDebetE" name="txtDebetE" placeholder="Debet" readonly style="background-color: #FB5C4B;color:blue;">
                                        </div>
                                    </td>
                                    </tr>
                                </table>
                                </td>
                                <td width="10" />
                            </tr>
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












