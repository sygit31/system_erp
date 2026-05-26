
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
            <b><font color="White">Kelola Akun</font></b>
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

          <button type="button" class="btn btn-block btn-danger"style="width:15%;"><b><font size="3" data-toggle="modal" data-target="#modal-tambah-akun">Tambah Akun</font></b></button>
          <br />
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
                    <th width="200">Nama</th>
                    <th width="200">Bagian</th>
                    <th width="100"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($hak_akses); ?> -->
                  <?php foreach($hak_akses as $row){ ?>
                    <tr>
                      <td align="center"><?php echo $row->NAMA; ?></td>
                      <td align="center"><?php echo $row->NAMA_BAGIAN; ?></td>
                      <td><button type="button" class="btn btn-block btn-warning" id="<?php echo $row->ID_AKUN; ?>" data-toggle="modal" data-target="#modal-detail">Hak Akses</button></td>
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





          <div class="modal fade bd-example-modal-lg" id="modal-tambah-akun">
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('administrator/kelola_akun/save');?>" onsubmit="return validasi()">
                    <div class="modal-header" style="background-color: #DC3545;color: white;">
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Bagian</label></td>
                          <td width="20"></td>
                          <td width="300">
                            <!-- <div class="form-group"> -->
                              <select name="cmbBagian" id="cmbBagian" onChange="showKaryawan()" class="form-control select2" style="width: 100%;">
                                <option value=''>-- Pilih Bagian --</option>;
                                <?php foreach($dBagian as $row){ ?>
                                  <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA; ?></option>;
                                <?php } ?>
                              </select>
                            <!-- </div> -->
                          </td>
                        </tr>
                        <tr height="10"></tr>
                        <tr valign="center">
                          <td width="100"><label>Karyawan</label></td>
                          <td width="20"></td>
                          <td width="300">
                            <select name="cmbKaryawan" id="cmbKaryawan" class="form-control select2" style="width: 100%;">
                              <option value=''></option>;
                            </select>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-body" style="background-color: #FFCCFF;">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            



                            
                             <ul class="treeview" id="MenuAksesAdd">
                                <li>
                                    <input type="checkbox" name="HakAksesAdd[]" id="cbGudangAdd" value="cbGudangAdd">
                                    <label for="cbGudangAdd" class="custom-unchecked">Gudang</label>
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbGudang_PenerimaanAdd" value="cbGudang_PenerimaanAdd">
                                             <label for="cbGudang_PenerimaanAdd" class="custom-unchecked">Penerimaan Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbGudang_StokAdd" value="cbGudang_StokAdd">
                                             <label for="cbGudang_StokAdd" class="custom-unchecked">Stok Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbGudang_RejectAdd" value="cbGudang_RejectAdd">
                                             <label for="cbGudang_RejectAdd" class="custom-unchecked">Reject</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbGudang_PengeluaranAdd" value="cbGudang_PengeluaranAdd">
                                             <label for="cbGudang_PengeluaranAdd" class="custom-unchecked">Pengeluaran Barang</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbGudang_LaporanAdd" value="cbGudang_LaporanAdd">
                                             <label for="cbGudang_LaporanAdd" class="custom-unchecked">Laporan Gudang</label>
                                             <ul>
                                                 <li class="last">
                                                     <input type="checkbox" name="HakAksesAdd[]" id="cbGudang_Laporan_MutasiPETAdd" value="cbGudang_Laporan_MutasiPETAdd">
                                                     <label for="cbGudang_Laporan_MutasiPETAdd" class="custom-unchecked">Mutasi PET</label>
                                                 </li>
                                             </ul>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAksesAdd[]" id="cbPembelianAdd" value="cbPembelianAdd">
                                    <label for="cbPembelianAdd" class="custom-unchecked">Pembelian</label>
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbPembelian_OutstandingAdd" value="cbPembelian_OutstandingAdd">
                                             <label for="cbPembelian_OutstandingAdd" class="custom-unchecked">Outstanding Order</label>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAksesAdd[]" id="cbQcAdd" value="cbQcAdd">
                                    <label for="cbQcAdd" class="custom-unchecked">Quality Control</label>
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbQc_MasterAdd" value="cbQc_MasterAdd">
                                             <label for="cbQc_MasterAdd" class="custom-unchecked">Master QC</label>
                                             <ul>
                                                 <li>
                                                     <input type="checkbox" name="HakAksesAdd[]" id="cbQc_Master_ParameterAdd" value="cbQc_Master_ParameterAdd">
                                                     <label for="cbQc_Master_ParameterAdd" class="custom-unchecked">Parameter</label>
                                                 </li>
                                                 <li class="last">
                                                     <input type="checkbox" name="HakAksesAdd[]" id="cbQc_Master_TestRequirementAdd" value="cbQc_Master_TestRequirementAdd">
                                                     <label for="cbQc_Master_TestRequirementAdd" class="custom-unchecked">Test Requirement</label>
                                                 </li>
                                             </ul>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbQc_CekAdd" value="cbQc_CekAdd">
                                             <label for="cbQc_CekAdd" class="custom-unchecked">Check QC</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbQc_CetakAdd" value="cbQc_CetakAdd">
                                             <label for="cbQc_CetakAdd" class="custom-unchecked">Cetak Label</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbQc_LaporanQcAdd" value="cbQc_LaporanQcAdd">
                                             <label for="cbQc_LaporanQcAdd" class="custom-unchecked">Laporan QC</label>
                                             <ul>
                                                <li class="last">
                                                     <input type="checkbox" name="HakAksesAdd[]" id="cbQc_LaporanQc_TestAdd" value="cbQc_LaporanQc_TestAdd">
                                                     <label for="cbQc_LaporanQc_TestAdd" class="custom-unchecked">Test QC</label>
                                                </li>
                                             </ul>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAksesAdd[]" id="cbKinerjaAdd" value="cbKinerjaAdd">
                                    <label for="cbKinerjaAdd" class="custom-unchecked">Kinerja</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAksesAdd[]" id="cbRnDAdd" value="cbRnDAdd">
                                    <label for="cbRnDAdd" class="custom-unchecked">R&D</label>
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbRnD_SetMesinAdd" value="cbRnD_SetMesinAdd">
                                             <label for="cbRnD_SetMesinAdd" class="custom-unchecked">Setting Mesin</label>
                                         </li>
                                    </ul>
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbRnD_SetFormulaAdd" value="cbRnD_SetFormulaAdd">
                                             <label for="cbRnD_SetFormulaAdd" class="custom-unchecked">Setting Formula</label>
                                         </li>
                                    </ul>
                                </li>
                                <li class="last">
                                    <input type="checkbox" name="HakAksesAdd[]" id="cbAdministratorAdd" value="cbAdministratorAdd">
                                    <label for="cbAdministratorAdd" class="custom-unchecked">Administrator</label>
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAksesAdd[]" id="cbAdministrator_KelolaAkunAdd" value="cbAdministrator_KelolaAkunAdd">
                                             <label for="cbAdministrator_KelolaAkunAdd" class="custom-unchecked">Kelola Akun</label>
                                         </li>
                                    </ul>
                                </li>
                            </ul>
                      





                          <!-- ISI -->
                        </div><!-- /.box-body -->
                      </div><!-- /.box-info -->
                    </div><!-- /.modal-body -->
                    <div class="modal-footer" style="background-color: #FFCCFF;">
                      
                        <br />
                       
                        <table>
                          <tr>
                            <td width="500">
                              <button type="submit" class="btn btn-success pull-left">Simpan</button>
                              <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                            </td>
                          </tr>
                        </table>
                    </div>
                  </form>
                </div>
                      <!-- /.modal-content -->
            </div>
                    <!-- /.modal-dialog -->
          </div>





          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('administrator/kelola_akun/edit');?>">
                    <input type="hidden" name="txtIdAkun" id="txtIdAkun" value="" />
                    <div class="modal-header" style="background-color: #17A2B8;color: white;">
                      <h3><b><label id="lblHeader" /></b></h3>
                    </div>
                    <div class="modal-body" style="background-color: #CCFFFF;">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                         


  

                         <!--    
                             <ul class="treeview" id="MenuAkses">
                                <li>
                                    <input type="checkbox" name="HakAkses[]" value="A">
                                    <label class="custom-unchecked">Gudang</label>
                                    
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" value="B">
                                             <label class="custom-unchecked">Penerimaan Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" value="C">
                                             <label class="custom-unchecked">Stok Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" value="D">
                                             <label class="custom-unchecked">Reject</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" value="E">
                                             <label class="custom-unchecked">Pengeluaran Barang</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" value="F">
                                             <label class="custom-unchecked">Laporan Gudang</label>
                                             <ul>
                                                 <li class="last">
                                                     <input type="checkbox" name="HakAkses[]" value="G">
                                                     <label class="custom-unchecked">Mutasi PET</label>
                                                 </li>
                                             </ul>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" value="H">
                                    <label class="custom-unchecked">Pembelian</label>
                                    
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" value="I">
                                             <label class="custom-unchecked">Outstanding Order</label>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" value="J">
                                    <label class="custom-unchecked">Quality Control</label>
                                    
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" value="K">
                                             <label class="custom-unchecked">Master QC</label>
                                             <ul>
                                                 <li>
                                                     <input type="checkbox" name="HakAkses[]" value="L">
                                                     <label class="custom-unchecked">Parameter</label>
                                                 </li>
                                                 <li class="last">
                                                     <input type="checkbox" name="HakAkses[]" value="M">
                                                     <label class="custom-unchecked">Test Requirement</label>
                                                 </li>
                                             </ul>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" value="N">
                                             <label class="custom-unchecked">Check QC</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" value="O">
                                             <label class="custom-unchecked">Laporan QC</label>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" value="P">
                                    <label class="custom-unchecked">Kinerja</label>
                                </li>
                                <li class="last">
                                    <input type="checkbox" name="HakAkses[]" value="Q">
                                    <label class="custom-unchecked">Administrator</label>
                                    
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" value="R">
                                             <label class="custom-unchecked">Kelola Akun</label>
                                         </li>
                                    </ul>
                                </li>
                            </ul> -->
                      
















                          <!--   
                             <ul class="treeview">
                                <li>
                                    <input type="checkbox" name="cbGudang" id="cbGudang">
                                    <label for="cbGudang" class="custom-unchecked">Gudang</label>
                                    
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="cbGudang_Penerimaan" id="cbGudang_Penerimaan">
                                             <label for="cbGudang_Penerimaan" class="custom-unchecked">Penerimaan Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="cbGudang_Stok" id="cbGudang_Stok">
                                             <label for="cbGudang_Stok" class="custom-unchecked">Stok Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="cbGudang_Reject" id="cbGudang_Reject">
                                             <label for="cbGudang_Reject" class="custom-unchecked">Reject</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="cbGudang_Pengeluaran" id="cbGudang_Pengeluaran">
                                             <label for="cbGudang_Pengeluaran" class="custom-unchecked">Pengeluaran Barang</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="cbGudang_Laporan" id="cbGudang_Laporan">
                                             <label for="cbGudang_Laporan" class="custom-unchecked">Laporan Gudang</label>
                                             <ul>
                                                 <li class="last">
                                                     <input type="checkbox" name="cbGudang_Laporan_MutasiPET" id="cbGudang_Laporan_MutasiPET">
                                                     <label for="cbGudang_Laporan_MutasiPET" class="custom-unchecked">Mutasi PET</label>
                                                 </li>
                                             </ul>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="cbPembelian" id="cbPembelian">
                                    <label for="cbPembelian" class="custom-unchecked">Pembelian</label>
                                    
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="cbPembelian_Outstanding" id="cbPembelian_Outstanding">
                                             <label for="cbPembelian_Outstanding" class="custom-unchecked">Outstanding Order</label>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="cbQc" id="cbQc">
                                    <label for="cbQc" class="custom-unchecked">Quality Control</label>
                                    
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="cbQc_Master" id="cbQc_Master">
                                             <label for="cbQc_Master" class="custom-unchecked">Master QC</label>
                                             <ul>
                                                 <li>
                                                     <input type="checkbox" name="cbQc_Master_Parameter" id="cbQc_Master_Parameter">
                                                     <label for="cbQc_Master_Parameter" class="custom-unchecked">Parameter</label>
                                                 </li>
                                                 <li class="last">
                                                     <input type="checkbox" name="cbQc_Master_TestRequirement" id="cbQc_Master_TestRequirement">
                                                     <label for="cbQc_Master_TestRequirement" class="custom-unchecked">Test Requirement</label>
                                                 </li>
                                             </ul>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="cbQc_Cek" id="cbQc_Cek">
                                             <label for="cbQc_Cek" class="custom-unchecked">Check QC</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="cbQc_LaporanTest" id="cbQc_LaporanTest">
                                             <label for="cbQc_LaporanTest" class="custom-unchecked">Laporan QC</label>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="cbKinerja" id="cbKinerja">
                                    <label for="cbKinerja" class="custom-unchecked">Kinerja</label>
                                </li>
                                <li class="last">
                                    <input type="checkbox" name="cbAdministrator" id="cbAdministrator">
                                    <label for="cbAdministrator" class="custom-unchecked">Administrator</label>
                                    
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="cbAdministrator_KelolaAkun" id="cbAdministrator_KelolaAkun">
                                             <label for="cbAdministrator_KelolaAkun" class="custom-unchecked">Kelola Akun</label>
                                         </li>
                                    </ul>
                                </li>
                            </ul>
                      
 -->




                            
                             <ul class="treeview" id="MenuAkses">
                                <li>
                                    <input type="checkbox" name="HakAkses[]" id="cbGudang" value="cbGudang">
                                    <label for="cbGudang" class="custom-unchecked">Gudang</label>
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbGudang_Penerimaan" value="cbGudang_Penerimaan">
                                             <label for="cbGudang_Penerimaan" class="custom-unchecked">Penerimaan Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbGudang_Stok" value="cbGudang_Stok">
                                             <label for="cbGudang_Stok" class="custom-unchecked">Stok Barang</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbGudang_Reject" value="cbGudang_Reject">
                                             <label for="cbGudang_Reject" class="custom-unchecked">Reject</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbGudang_Pengeluaran" value="cbGudang_Pengeluaran">
                                             <label for="cbGudang_Pengeluaran" class="custom-unchecked">Pengeluaran Barang</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" id="cbGudang_Laporan" value="cbGudang_Laporan">
                                             <label for="cbGudang_Laporan" class="custom-unchecked">Laporan Gudang</label>
                                             <ul>
                                                 <li class="last">
                                                     <input type="checkbox" name="HakAkses[]" id="cbGudang_Laporan_MutasiPET" value="cbGudang_Laporan_MutasiPET">
                                                     <label for="cbGudang_Laporan_MutasiPET" class="custom-unchecked">Mutasi PET</label>
                                                 </li>
                                             </ul>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" id="cbPembelian" value="cbPembelian">
                                    <label for="cbPembelian" class="custom-unchecked">Pembelian</label>
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" id="cbPembelian_Outstanding" value="cbPembelian_Outstanding">
                                             <label for="cbPembelian_Outstanding" class="custom-unchecked">Outstanding Order</label>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" id="cbQc" value="cbQc">
                                    <label for="cbQc" class="custom-unchecked">Quality Control</label>
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbQc_Master" value="cbQc_Master">
                                             <label for="cbQc_Master" class="custom-unchecked">Master QC</label>
                                             <ul>
                                                 <li>
                                                     <input type="checkbox" name="HakAkses[]" id="cbQc_Master_Parameter" value="cbQc_Master_Parameter">
                                                     <label for="cbQc_Master_Parameter" class="custom-unchecked">Parameter</label>
                                                 </li>
                                                 <li class="last">
                                                     <input type="checkbox" name="HakAkses[]" id="cbQc_Master_TestRequirement" value="cbQc_Master_TestRequirement">
                                                     <label for="cbQc_Master_TestRequirement" class="custom-unchecked">Test Requirement</label>
                                                 </li>
                                             </ul>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbQc_Cek" value="cbQc_Cek">
                                             <label for="cbQc_Cek" class="custom-unchecked">Check QC</label>
                                         </li>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbQc_Cetak" value="cbQc_Cetak">
                                             <label for="cbQc_Cetak" class="custom-unchecked">Cetak Label</label>
                                         </li>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" id="cbQc_LaporanQc" value="cbQc_LaporanQc">
                                             <label for="cbQc_LaporanQc" class="custom-unchecked">Laporan QC</label>
                                             <ul>
                                                <li class="last">
                                                     <input type="checkbox" name="HakAkses[]" id="cbQc_LaporanQc_Test" value="cbQc_LaporanQc_Test">
                                                     <label for="cbQc_LaporanQc_Test" class="custom-unchecked">Test QC</label>
                                                </li>
                                             </ul>
                                         </li>
                                    </ul>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" id="cbKinerja" value="cbKinerja">
                                    <label for="cbKinerja" class="custom-unchecked">Kinerja</label>
                                </li>
                                <li>
                                    <input type="checkbox" name="HakAkses[]" id="cbRnD" value="cbRnD">
                                    <label for="cbRnD" class="custom-unchecked">R&D</label>
                                    <ul>
                                         <li>
                                             <input type="checkbox" name="HakAkses[]" id="cbRnD_SetMesin" value="cbRnD_SetMesin">
                                             <label for="cbRnD_SetMesin" class="custom-unchecked">Setting Mesin</label>
                                         </li>
                                    </ul>
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" id="cbRnD_SetFormula" value="cbRnD_SetFormula">
                                             <label for="cbRnD_SetFormula" class="custom-unchecked">Setting Formula</label>
                                         </li>
                                    </ul>
                                </li>
                                <li class="last">
                                    <input type="checkbox" name="HakAkses[]" id="cbAdministrator" value="cbAdministrator">
                                    <label for="cbAdministrator" class="custom-unchecked">Administrator</label>
                                    <ul>
                                         <li class="last">
                                             <input type="checkbox" name="HakAkses[]" id="cbAdministrator_KelolaAkun" value="cbAdministrator_KelolaAkun">
                                             <label for="cbAdministrator_KelolaAkun" class="custom-unchecked">Kelola Akun</label>
                                         </li>
                                    </ul>
                                </li>
                            </ul>
                      







                         
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                    <div class="modal-footer" style="background-color: #CCFFFF;">
                        
                        <br />
                       
                        <table>
                          <tr>
                            <td width="500">
                              <button type="submit" class="btn btn-success pull-left">Simpan</button>
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