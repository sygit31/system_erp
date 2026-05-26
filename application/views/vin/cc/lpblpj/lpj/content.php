
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
            <b><font color="White">LPJ</font></b>
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

            
        <form role="form" method="POST" action="<?php echo site_url('sgt/cc/lpblpj/simpanLpj');?>" onsubmit="return validasi()" autocomplete="off">

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
                                <!-- <option value='<?php // echo $row->KODE_INVEST; ?>'><?php //echo $row->KODE_INVEST." (".$row->JENIS_INVEST.")" ; ?></option> -->
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
                    <!-- <tr height="10" />
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
                    </tr> -->
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Tanggal</font></label></td>
                    <td colspan="3">
                        <div data-tip="Tanggal">
                        <input class="form-control" type="text" id="txtTanggal" name="txtTanggal" style="background:#FFFFFF;">
                        </div>
                    </td>
                    </tr>
                </table>
                </td>
                <td width="20" />
                <td>
                <table>
                    <!-- <tr height="10" />
                    <tr valign="top">
                    <td width="150"><label><font size = "4">Tanggal</font></label></td>
                    <td width="300" colspan="3">
                        <div data-tip="Tanggal">
                        <input class="form-control" type="text" id="txtTanggal" name="txtTanggal">
                        </div>
                    </td> -->
                    </tr>
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Suplier</font></label></td>
                    <td colspan="3" width="300">
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
                    <td><label><font size = "4">Nomor LPJ</font></label></td>
                    <td width="148">
                        <div data-tip="Internal">
                        <input class="form-control" type="text" id="txtNoLpjInternal" name="txtNoLpjInternal" placeholder="Internal">
                        </div>
                    </td>
                    <td width="4" />
                    <td width="148">
                        <div data-tip="External">
                        <input class="form-control" type="text" id="txtNoLpjExternal" name="txtNoLpjExternal" placeholder="External">
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
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Pph</font></label></td>
                    <td colspan="3">
                        <div data-tip="Pph">
                        <input class="form-control" type="text" id="txtPph" name="txtPph">
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
            <table id="tblLpj" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                    <th style="width: 100px;">No. Invest</th>
                    <th style="width: 100px;">Rekening</th>
                    <th style="width: 100px;">Alokasi</th>
                    <th style="width: 100px;">Jenis</th>
                    <th style="width: 100px;">Tanggal</th>
                    <th style="width: 100px;">Suplier</th>
                    <th style="width: 100px;">Keterangan</th>
                    <th style="width: 100px;">No. LPB Internal</th>
                    <th style="width: 100px;">No. LPB External</th>
                    <th style="width: 100px;">Quantity</th>
                    <th style="width: 100px;">Harga</th>
                    <th style="width: 100px;">Debet</th>
                    <th style="width: 100px;">Pph</th>
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
            <b><font color="White">Data LPJ</font></b>
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
                  <th style="width: 100px !important;">Tanggal</th>
                  <th style="width: 100px !important;">Rekening</th>
                  <th style="width: 100px !important;">Alokasi</th>
                  <th style="width: 100px !important;">Departemen</th>
                  <th style="width: 200px !important;">Nomer Invest</th>
                  <th style="width: 100px !important;">Jenis</th>
                  <th style="width: 300px !important;">Supplier</th>
                  <th style="width: 300px !important;">Keterangan</th>
                  <th style="width: 100px !important;">LPB Internal</th>
                  <th style="width: 100px !important;">LPB External</th>
                  <th style="width: 100px !important;">Jumlah</th>
                  <th style="width: 100px !important;">Satuan</th>
                  <th style="width: 100px !important;">Harga</th>
                  <th style="width: 100px !important;">Debet</th>
                  <th style="width: 100px !important;">Pph</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach($data_last as $row){ ?>
                  <tr>
                    <td align="center"><?php echo $row->tanggal_format; ?></td>
                    <td align="center"><?php echo $row->kode_rekening; ?></td>
                    <td align="center"><?php echo $row->alokasi; ?></td>
                    <td align="center"><?php echo $row->kode_departement; ?></td>
                    <td align="center"><?php echo $row->kode_invest; ?></td>
                    <td align="center"><?php echo $row->status; ?></td>
                    <td align="center"><?php echo $row->suplier; ?></td>
                    <td align="center"><?php echo $row->keterangan; ?></td>
                    <td align="center"><?php echo $row->no_lpj_internal; ?></td>
                    <td align="center"><?php echo $row->no_lpj_eksternal; ?></td>
                    <td align="center"><?php echo $row->jumlah; ?></td>
                    <td align="center"><?php echo $row->satuan; ?></td>
                    <td align="center"><?php echo $row->harga_satuan; ?></td>
                    <td align="center"><?php echo $row->debet; ?></td>
                    <td align="center"><?php echo $row->pph; ?></td>
                   

                    <!-- <td align="center">
                      <button type="button" class="btn btn-block btn-warning btn-sm" 
                      id=<?php //echo $row->ID; ?> 
                      data-toggle='modal' data-target='#modal-detail' >
                        Ubah
                      </button>
                    </td> -->
                  </tr>
                <?php } ?>


              </tbody>
            </table>
          </font>






          


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




