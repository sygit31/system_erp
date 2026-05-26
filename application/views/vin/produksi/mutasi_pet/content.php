
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
            <b><font color="White">MUTASI PET</font></b>
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

        

        
          <form role="form" method="POST" action="">
          
          <div class="card card-primary" id="bodyinput">
            <div class="card-body">

              <table>
                <tr>
                  <td>



                    <table id="tblUtama">
                      
                      <tr valign="top">
                        <td width="200"><label><font size = "5">Tanggal</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Tanggal Mutasi">
                            <input class="form-control" type="text" id="txtTanggal" name="txtTanggal" >
                          </div>
                        </td>
                      </tr>
					  <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Desain</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Desain">
                            <select name="cmbDesain"  id="cmbDesain"  class="form-control select2" >
                              <option value=''></option>
                              <?php foreach($data_desain as $row){ ?>
                                <option value='<?php echo $row->DESAIN; ?>'><?php echo $row->DESAIN ; ?></option>
                              <?php } ?> 
                            </select>
                          </div>
                        </td>
                      </tr>
											<tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Kode Flow</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Kode Flow">
                            <select name="cmbKodeFlow"  id="cmbKodeFlow"  class="form-control select2" >
                              <option value=''></option>
                            </select>
                          </div>
                        </td>
                      </tr>				
					  <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Proses Awal</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Proses Awal">
                            <select name="cmbProsesAwal"  id="cmbProsesAwal"  class="form-control select2">
                              <option value=''></option> 
                            </select>
							<input class="form-control" type="hidden" id="txtJenis" name="txtJenis"  >
                          </div>
                        </td>
                      </tr>
					   <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Proses Akhir</font></label></td>
                        <td width="400" colspan="3">
                            <div data-tip="Proses Akhir">
                            <input class="form-control" type="text" id="txtProsesAkhir" name="txtProsesAkhir" readonly>
                          </div>
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">KK</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih KK">
                            <select name="cmbKK"  id="cmbKK"  class="form-control select2">
                              <option value=''></option>
                            </select>
                          </div>
                        </td>
                      </tr>
					    <tr height="10"></tr>
                      <tr valign="top">
                        <td width="200"><label><font size = "5">No Mutasi</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="No. Mutasi">
                            <input class="form-control" type="text" id="txtNomer" name="txtNomer" readonly>
							<input class="form-control" type="hidden" id="txtNoUrut" name="txtUrut" >
                          </div>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Seri</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Seri">
                             <input class="form-control" type="text" id="txtSeri" name="txtSeri" readonly >
							 <input class="form-control" type="hidden" id="txtSeri2" name="txtSeri2"  >
                          </div>
                        </td>
                      </tr>
					   <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Pengirim</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Nama Pengirim">
                            <select name="cmbNamaPengirim"  id="cmbNamaPengirim"  class="form-control select2">
                              <option value='0'></option> 
                               <?php foreach($data_karyawan as $row){ ?>
                                <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA ; ?></option>
                              <?php } ?> 
                            </select>                            
						  </div>	
                        </td>
                      </tr>
					   <tr height="10"></tr>
                      <tr valign="middle">
                        <td width="200"><label><font size = "5">Penerima</font></label></td>
                        <td width="400" colspan="3">
                          <div data-tip="Pilih Nama Penerima">
                            <select name="cmbNamaPenerima"  id="cmbNamaPenerima"  class="form-control select2">
                              <option value='0'></option> 
                              <?php foreach($data_karyawan as $row){ ?>
                                <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA ; ?></option>
                              <?php } ?> 
                            </select>
                        </td>
                      </tr>
                      <tr height="10"></tr>
                      <tr valign="top">
                        <td><label><font size = "5">Jumlah</font></label></td>
                        <td width="300" colspan="2">
                          <div data-tip="Jumlah barang">
                            <input class="form-control" type="text" id="txtJumlah" name="txtJumlah" value="0" style="background-color : #F8FBBF;" readonly>
                          </div>
                        </td>
                        <td width="100">
                          <div data-tip="Satuan">
                            <input class="form-control" type="text" id="txtSatuan" name="txtSatuan" style="background-color : #F8FBBF;" readonly>
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
                  <td width="20" />
                  <td valign="top">


                  </td>
                </tr>
              </table>


                
              
                <!-- <font size="2">
                  <div id="DetailInfo"></div>
                </font> -->
                
                <br />

                <!-- <table class="table table-bordered" id="tblBarang" style="background: #17A2B8; color: white" name="tblParameters"> -->
                <table class="table table-bordered" id="tblBarang" name="tblBarang">
                  <thead>
                    <tr align="center">
					   <th style="width: 2%;"><font size="4">#</font></th>
			           <th hidden></th>
                      <th style="width: 20%;"><font size="4">Kode</font></th>
                      <th style="width: 48%;" ><font size="4">Nama</font></th>
                      <th style="width: 10%;" ><font size="4">Jml Roll</font></th>
                      <th style="width: 30%;" ><font size="4">Jumlah Meter</font></th>
                    </tr>
                    
                  </thead>
                  <tbody>
                    <!-- <tr align="center">
                      <td style="width: 30%;"><font size="4"><label id="lblParameter">Kode</label></font></td>
                      <td style="width: 50%;" ><font size="4"><label id="lblParameter">Nama</label></font></td>
                      <td style="width: 30%;" ><font size="4"><label id="lblParameter">Jumlah</label></font></td>
                    </tr> -->
                  
                  </tbody>
                </table>
            </div>
            <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan_hasil()">Simpan</button></td>
                  <td width="10"></td>
                  <td width="150"><a href="<?php echo site_url('vin/produksi/mutasi_pet'); ?>" class="btn btn-block btn-danger">Batal</a></td>
                </tr>
              </table>
            </div>
          </div>
          </form>



<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
            <div class="modal-footer" hidden>
                <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Sukses Simpan -->
<div class="modal fade" id="modal_sukses" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
            <div class="modal-footer">
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){location.reload();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
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




    <!-- </section> -->
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->



















    <!-- ==============================================LAPORAN=========================================== -->
      <br />
      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">List Mutasi PET</font></b>
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

          <form  method="POST" action="">
            <div class="card card-info">
              <div class="card-body">

                <table border=0>
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
				   <tr height="10"></tr>
				    <tr>
                    <td><input type="checkbox" id="cek_semua" />&nbsp;&nbsp;&nbsp;Semua Proses</td>
                    <td width="2" align="center">&nbsp;</td>
                    <td width="20">
                     &nbsp;
                    </td>
					</tr>
				  <tr height="10"></tr>
				    <tr>
                    <td>Desain</td>
                    <td width="50" align="center">:</td>
                    <td width="170">
                      <font size="2"></font>
                      <div data-tip="Pilih Desain">
                            <select name="cmbDesainFilter"  id="cmbDesainFilter"  class="form-control">
                              <option value=''></option>
                              <?php foreach($data_desain as $row){ ?>
                                <option value='<?php echo $row->DESAIN; ?>'><?php echo $row->DESAIN ; ?></option>
                              <?php } ?> 
							</select>
                          </div>
                      </font>
                    </td>
                    <td width="50" align="center"></td>
                    <td width="170">
                    </td>
                  </tr>
						
									<tr height="10"></tr>
				    <tr>
                    <td>Kode Flow</td>
                    <td width="50" align="center">:</td>
                    <td width="170">
                      <font size="2"></font>
                      <div data-tip="Pilih Kode Flow">
                            <select name="cmbKodeFlowFilter"  id="cmbKodeFlowFilter"  class="form-control">
                              <option value=''></option>
						        	</select>
                          </div>
                      </font>
                    </td>
                    <td width="50" align="center"></td>
                    <td width="170">
                    </td>
                  </tr>			
				   <tr height="10"></tr>
				    <tr>
                    <td>Proses Awal</td>
                    <td width="50" align="center">:</td>
                    <td width="170">
                      <font size="2"></font>
                       <div data-tip="Pilih Proses Awal">
                            <select name="cmbProsesAwalFilter"  id="cmbProsesAwalFilter"  class="form-control">
                              <option value=''></option>
							</select>
                          </div> 
                      </font>
                    </td>
                    <td width="50" align="center">&nbsp;</td>
                    <td width="170">
                      <font size="2"></font>
                          <input type="text" class="form-control pull-right" id="txtProsesAkhirFilter" name = "txtProsesAkhirFilter" readonly>
                      </font>
                    </td>
                  </tr>
									<tr>
                    <td>&nbsp;</td>
                    <td width="2" align="center">&nbsp;</td>
                    <td width="3">
                    <input type="checkbox" id="cek_koderoll" />&nbsp;&nbsp;&nbsp;Cari Kode Roll
                    </td>
										<td width="5" align="center">&nbsp;</td>
                    <td width="8">
                      <font size="2"></font>
                          <input type="text" class="form-control pull-right" id="txtKodeRollFilter" name = "txtKodeRollFilter" disabled>
                      </font>
                    </td>
					</tr>
                </table>
                           
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="button"  class="btn btn-success" onclick='filter_table()'>&nbsp; Filter &nbsp;</button>
               
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
              <table class="table table-bordered" id="tblMutasi" name="tblMutasi" width='120%'>
                <thead>
                  <tr align="center">
				    <th width=5%>No</th>
                    <th width=5%>Tanggal</th>
                    <th width=10%>Nomer KK</th>
					<th width=0%>Nomor Mutasi</th>
                    <th width=10%>Seri</th>
                    <th width=10%>Proses Awal</th>
					<th width=10%>Proses Akhir</th>
                    <th width=10%>Total Qty (Meter)</th>
					 <th width=30%>#</th>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
            </font>
            </div>
            <!-- /.card-body -->
           
						<div class="card-footer">
                        <table>
                            <tr>
                                <td width="150"><button type="button" class="btn btn-block btn-success" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                                <td>&nbsp;</td>
																<td>&nbsp;</td>
														    <td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td>&nbsp;</td>
																<td width="150"><button type="button" class="btn btn-block btn-success"  id="btnExcel2"  onclick="export_excel_detail()"><i class="fa fa-clipboard m-2"></i><b>Excel Detail</b></button></td>
															</tr>
                        </table>
            </div>

          </div>
          
<div class="modal fade" id="modal-preview" style="z-index: 9999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
                <h3 class="card-title">
                    <b>
                        <font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">Info Detail Mutasi</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button id="btnClose" type="button" class="close" title="Close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div class="tab1" style="overflow-y: scroll; height: 400px;">
                    <table id="tabel_header_preview"  width="100%" border='0' style="font-weight: bold; font-size: 13px;" >
                        <tr>
                            <th colspan='3'></th>
                        </tr>
						  <tr>
                            <th colspan='3'>&nbsp;</th>
                        </tr>
                        <tr>
                            <td width='20%'>No. Mutasi</td>
							 <td width='10%'>:</th>
                            <td width='70%'></td>
                        </tr>
                        <tr>
                            <td width='20%'>Tanggal</td>
                            <td width='10%'>:</td>
							<td width='70%'></td>
                        </tr>
                        <tr>
                            <td width='20%'>Seri</td>
                            <td width='10%'>:</td>
							<td width='70%'></td>
                        </tr>
                        <tr>
                            <td width='20%'>KK</th>
                            <td width='10%'>:</td>
							<td width='70%'></td>
                        </tr>
                    </table>
					 <table id="tabel_detail_preview" class="table table-bordered" width="100%" style="font-weight: bold; font-size: 11px;">
                        <thead>
                            <tr>
                               <th>No</th>
				               <th>Shift</th>
				               <th>Kode Roll</th>
				               <th>Panjang(MTR)</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button id="btnTutup" style="width: 30%;" class="btn btn-danger" data-dismiss="modal" title="Tutup Informasi"><i class="fa fa-ban m-2"></i><b>Tutup</b></button>
                    <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
                </div>
            </div>
        </div>
    </div>
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
