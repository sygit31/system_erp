<?php
foreach($get_roll as $row){ 
$no_mutasi=$row->NOMOR_MUTASI; 
$tgl=$row->TGL;
$seri=$row->SERI;
$kk=$row->KK;
$dari=$row->DARI;
$ke=$row->KE;
$id_pengirim=$row->ID_PENGIRIM;
$id_penerima=$row->ID_PENERIMA;
$nama_penerima=$row->NAMA_PENERIMA;
$nama_pengirim=$row->NAMA_PENGIRIM;
}


?>

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
            <b><font color="White"> GABUNG ROLL MUTASI PET</font></b>
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
			<table width="100%">
					<tr>
						<th width="15%">No. Mutasi</th>
						<td width="40%">
						<input type="text" id="no_mutasi" name="no_mutasi" class="form-control" value="<?php echo $no_mutasi; ?>" style="width: 80%;" maxlength="50" autocomplete="off" readonly>
						<input type="hidden" id="no_mutasi_lama" name="no_mutasi_lama" class="form-control" value="<?php echo $no_mutasi; ?>" style="width: 60%;" maxlength="50" autocomplete="off">
						<input type="hidden" id="no_kk" name="no_kk" class="form-control" value="<?php echo $kk; ?>" style="width: 60%;" maxlength="50" autocomplete="off">
						<input type="hidden" id="id_pengirim" name="id_pengirim" class="form-control" value=<?php echo $id_pengirim; ?> style="width: 60%;" maxlength="50" autocomplete="off">
						<input type="hidden" id="id_penerima" name="id_penerima" class="form-control" value=<?php echo $id_penerima; ?> style="width: 60%;" maxlength="50" autocomplete="off">
						<input type="hidden" id="nm_pengirim" name="nm_pengirim" class="form-control" value="<?php echo $nama_pengirim; ?>">
						<input type="hidden" id="nm_penerima" name="nm_penerima" class="form-control" value="<?php echo $nama_penerima; ?>">
					    </td>
						<th width="15%">Tanggal Mutasi</th>
						<td width="50%">
							<input type="text" id="tanggal" name="tanggal" class="form-control" style="width: 90%;" maxlength="20" autocomplete="off" value="<?php  echo $tgl; ?>"  maxlength="30">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Seri</th>
						<td  width="30%">
							<input type="text" id="seri" name="seri" class="form-control" style="width: 30%;" value="<?php echo $seri; ?>" readonly>
						</td>
						<th>KK</th>
						<td>
					    <input type="text" id="no_kk" name="no_kk" class="form-control" value=<?php echo $kk; ?> style="width: 70%;" maxlength="50" autocomplete="off"  readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Proses Awal</th>
						<td>
							<input type="text" id="dari" name="dari" class="form-control" style="width: 40%;" value=<?php echo $dari; ?> readonly>
						</td>
						<th>Proses Akhir</th>
						<td>
							<input type="text" id="ke" name="ke" class="form-control" style="width: 40%;" value=<?php echo $ke; ?> readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Pengirim</th>
						<td>
						<select  id="cmbPengirim" name='cmbPengirim' style="width: 90%;" onchange="cari_pengirim()" class="select" disabled>
                            <?php foreach ($get_karyawan as $dt) : ?>
                                <option><?php echo $dt['NAMA']; ?></option>
                            <?php endforeach; ?>
                        </select>
						</td>
						<th>Penerima</th>
						<td>
						<select  id="cmbPenerima" name='cmbPenerima' style="width: 90%;" onchange="cari_penerima()" class="select" disabled>
                            <?php foreach ($get_karyawan_terima as $dm) : ?>
                                <option><?php echo $dm['NAMA']; ?></option>
                            <?php endforeach; ?>
                        </select>
						</td>
					</tr>
                    <tr style="height: 10px;"></tr>
					<tr>
                    <th>Kode Roll Gabungan</th>
						<td>
                        <input type="text" id="roll_gabungan" name="roll_gabungan" class="form-control" style="width: 80%;" value="" readonly>
						</td>
						<th>Jumlah Roll Gabungan</th>
						<td>
                        <input type="text" id="jumlah_gabungan" name="jumlah_gabungan" class="form-control" style="width: 80%;" value="" readonly>
						</td>
					</tr>
				</table>
			</div>
                </table>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150">
                        <button type="button" class="btn btn-block btn-primary" onclick="simpan_gabung_roll()"><i class="fa fa-save m-2"></i><b>Simpan</b>
                        </td>
                        <td width="10"></td>
                        <td width="150">
                           &nbsp;</button>
                        </td>
                        <td width="10"></td>
                        <td width="150">
                            <button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <table id="tabel_menu" class="table table-bordered">
                    <thead style="background-color: #06D288; color: #FFFFFF; font-weight: bold;">
                        <tr style="text-align: center;">
                            <td width="15%">Shift</td>
                            <td width="30%">Kode Roll</td>
                            <td width="15%">Panjang Meter</td>
                            <td hidden ></td>
                            <td  hidden></td>
                            <td  hidden></td>
                            <td  width="5%">Gabung Roll</td>
													</tr>
                     </thead>
												<?php 
												$no=1;
												foreach($get_roll as $rows)
												{
												?>
													<tr style="text-align: center;">
													<td width="15%"><input type="text" class="form-control" id="txtshift" name="txtshift" value="<?php echo $rows->SHIFT;?>" style="width: 100%; text-align: center;" readonly></td>
													<td width="30%"><input type="text" class="form-control" id="txtroll" name="txtroll" value="<?php echo $rows->KODE;?>" style="width: 100%; text-align: center;" readonly></td>
													<td width="15%"><input type="text" class="form-control" id="txtmeter" name="txtmeter" value="<?php echo $rows->HASIL;?>" style="width: 100%; text-align: center;" readonly></td>
													<td hidden><?php echo $rows->ID;?></td>
                                                    <td hidden><?php echo $rows->KODE;?></td>
                                                    <td hidden><?php echo $rows->HASIL;?></td>
													<td  width="5%"><input type="checkbox" name="pilih_roll"  name="pilih_roll"  class="checkBoxItem" style="cursor: pointer;"  onclick="update_kode_roll()"></td>
												   
												</tr>
												
												<?php
											  }	 
												?>
                </table>
				<br>
				<br>
				<table  width='80%'>
			 	                                <tr  style="text-align: center;">
												    <td style="text-align: center;"> TOTAL :</td>
													<td><input type="text" class="form-control" name="txttotal" id="txttotal" style="width: 100%; text-align: center;" readonly></td>
												</tr>	
			   </table>	
          </div>
          </form>

<!-- Modal Data -->
<div class="modal fade" id="modal_rolls">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header m-2 rounded" style="cursor: all-scroll;">
					<h3 class="card-title">
						<b>
							<font color="White">
								<div id="headerinput">
									<h3>Data Roll</h3>
								</div>
							</font>
						</b>
					</h3>
				</div>
				<div class="card-body">
					<table id="tbl_roll" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
						<thead>
							<tr align="center">
								<th>Pilih</th>
								<th >No</th>
								<th >Shift</th>
								<th >Kode Roll</th>
								<th >Panjang Meter</th>
								<th hidden></th>
							</tr>
						</thead>
						<tbody id="body_roll">
						</tbody>
					</table>
				</div>
				<div class="modal-footer rounded">
					<button style="width: 150px;" type="button" class="btn btn-warning" onclick="klik_roll()" title="Refresh Data"><i class="fa fa-archive m-2"></i><b>Refresh</b></button>
					<button id='btn_pilih' style="width: 150px;" type="button" class="btn btn-success" title="Pilih Roll" data-dismiss="modal"><i class="fa ion-android-share m-2"></i><b>Pilih</b></button>
					<button id="btn_roll" data-toggle="modal" data-target="#modal_rolls" hidden></button>
				</div>
			</div>
		</div>
	</div>
</div>

    <!-- Modal Error Isian -->
	<div class="modal fade" id="modal_isian">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
                    <div id="keterangan_isian" class="modal-body" style="font-size: 20px; color: #0c1ac5; font-weight: bold;"></div>
					<div class="modal-footer">
				      <button onclick="$('#keterangan_isian').html('');" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
			         <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
			        </div>
                </div>
            </div>
        </div>

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
     
          

          <!-- ==================================ISI KONTEN================================== -->
        

          
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
