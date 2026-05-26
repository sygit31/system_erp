
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
            <b><font color="White">Ijin Invest</font></b>
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


        <form role="form" method="POST" action="<?php echo site_url('sgt/cc/ijin_invest/simpan');?>" onsubmit="return validasi()" autocomplete="off">

            <table style="background-color: #EFECE9; filter: alpha(opacity=40); opacity: 0.95;border:3px #B8B7B6 solid;">

            <tr valign="top" height="255">
                <td width="10" />
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
                    <tr valign="top">
                    <td><label><font size = "4">No. Proposal</font></label></td>
                    <td colspan="3">
                        <div data-tip="Nomor Proposal">
                        <input class="form-control" type="text" id="txtNoProposal" name="txtNoProposal">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">No. Surat Ijin</font></label></td>
                    <td colspan="3">
                        <div data-tip="Nomor Surat Ijin">
                        <input class="form-control" type="text" id="txtNoSuratIjin" name="txtNoSuratIjin">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Jenis Investasi</font></label></td>
                    <td colspan="3">
                        <div data-tip="Jenis Investasi">
                        <input class="form-control" type="text" id="txtJenisInvest" name="txtJenisInvest">
                        </div>
                    </td>
                    </tr>
                    <tr height="10" />
                    <tr valign="top">
                    <td><label><font size = "4">Jumlah</font></label></td>
                    <td colspan="3">
                        <div data-tip="Jumlah">
                        <input class="form-control" type="number" id="txtJumlah" name="txtJumlah">
                        </div>
                    </td>
                    </tr>
                    
                    
                </table>
                </td>
                <td width="20" />
                <td>
                <table>
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Rencana Biaya</font></label></td>
                    <td colspan="3" width="300">
                        <div data-tip="Rencana Biaya">
                        <input class="form-control" type="text" id="txtBiaya" name="txtBiaya">
                        </div>
                    </td>
                    </tr>

                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Pengajuan</font></label></td>
                    <td width="97">
                        <div data-tip="Pilih Unit">
                        <select name="cmbPengajuanUnit"  id="cmbPengajuanUnit"  class="form-control select2" onchange="showDepartementPengajuan()">
                            <option value=''></option>
                            <?php foreach($data_unit as $row){ ?>
                            <!-- <option value='<?php //echo $row->UNIT.'@'. $row->ALOKASI; ?>'><?php //echo $row->UNIT ; ?></option> -->
                            <option value='<?php echo $row->UNIT; ?>'><?php echo $row->UNIT ; ?></option>
                            <?php } ?> 
                        </select>
                        </div>
                    </td>
                    <td width="3" />
                    <td width="200">
                        <div data-tip="Pilih Departemen">
                        <select name="cmbPengajuanDepartemen"  id="cmbPengajuanDepartemen"  class="form-control select2">
                            <option value=''></option>
                        </select>
                        </div>
                    </td>
                    </tr>
                    
                    <tr height="10" />
                    <tr valign="middle">
                    <td width="150"><label><font size = "4">Pemohon</font></label></td>
                    <td width="97">
                        <div data-tip="Pilih Unit">
                        <select name="cmbPemohonUnit"  id="cmbPemohonUnit"  class="form-control select2" onchange="showDepartementPemohon()">
                            <option value=''></option>
                            <?php foreach($data_unit as $row){ ?>
                            <!-- <option value='<?php //echo $row->UNIT.'@'. $row->ALOKASI; ?>'><?php //echo $row->UNIT ; ?></option> -->
                            <option value='<?php echo $row->UNIT; ?>'><?php echo $row->UNIT ; ?></option>
                            <?php } ?> 
                        </select>
                        </div>
                    </td>
                    <td width="3" />
                    <td width="200">
                        <div data-tip="Pilih Departemen">
                        <select name="cmbPemohonDepartemen"  id="cmbPemohonDepartemen"  class="form-control select2">
                            <option value=''></option>
                        </select>
                        </div>
                    </td>
                    </tr>

                    
                    
                </table>
                </td>
                <td width="10" />
            </tr>
            </table>


            <table>
            <tr height='10' />
            <tr>
                <td width="150"><button type="submit" class="btn btn-block btn-success" id="btnSimpan" >Simpan</button></td>
                <td width="10" />
                <td width="150"><button type="reset" class="btn btn-block btn-danger" id="btnBatal" onclick="batalkan()">Batal</button></td>
            </tr>
            </table>

        </form>





            <br />
            <br />

            <font size="2">
            <table id="tblIjinInvest" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                    <!-- <th style="width: 100px;">Tanggal</th>
                    <th style="width: 100px;">No. Proposal</th>
                    <th style="width: 200px;">No. Surat Ijin</th>
                    <th style="width: 300px;">Jenis investasi</th>
                    <th style="width: 50px;">Jumlah</th>
                    <th style="width: 100px;">Rencana Biaya</th>
                    <th style="width: 100px;">Mengajukan</th>
                    <th style="width: 100px;">Pemohon</th> -->

                    <th style="width: 100px;">Tanggal</th>
                    <th style="width: 100px;">No. Proposal</th>
                    <th style="width: 200px;">No. Surat Ijin</th>
                    <th style="width: 300px;">Jenis investasi</th>
                    <th style="width: 100px;">Jumlah</th>
                    <th style="width: 100px;">Rencana Biaya</th>
                    <th style="width: 200px;">Mengajukan</th>
                    <th style="width: 200px;">Pemohon</th>
                </tr>
                </thead>
                <tbody>
                
            
                    <?php foreach($data_invest as $row){ ?>
                      <tr>
                        <td align="center">
                          <?php echo $row->TANGGAL_IJIN_INVEST; ?>
                        </td>
                        <td align="center"><?php echo $row->KODE_INVEST; ?></td>
                        <td align="center"><?php echo $row->NOMOR_IJIN_INVEST; ?></td>
                        <td align="center"><?php echo $row->JENIS_INVEST; ?></td>
                        <td align="right"><?php echo $row->JUMLAH; ?></td>
                        <td align="right"><?php echo $row->RENCANA_BIAYA; ?></td>
                        <td align="left"><?php echo $row->AJU_UNIT .' - '. $row->AJU_DEPT; ?></td>
                        <td align="left"><?php echo $row->MOH_UNIT .' - '. $row->MOH_DEPT; ?></td>
                        <!-- <td align="center">
                          <button type="button" class="btn btn-block btn-warning btn-sm" 
                          id=<?php// echo $row->ID; ?> 
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