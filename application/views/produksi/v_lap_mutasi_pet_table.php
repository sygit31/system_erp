
<div class="text-center mb-5"><h2>Laporan Mutasi PET</h2></div>
<table width="100%" style="font-size: 14px; margin-bottom: 20px;">
	<tr>
	    <th width="15%">Tanggal</th> <th width="5%">:</th>
						<td width="35%">
							<input type="text" id="tanggal" class="form-control datepicker"  style="width: 40%; background-color: white; cursor: pointer;" readonly>
						</td>
		<th width="10%">Desain</th><th width="5%">:</th>
		<td width="50%">
			<select class="select" id="desain" style="width: 40%;" disabled='true'>				
				<option value="">Pilih Desain</option>
				<?php foreach($desain->result_array() as $dt) { ?>
					<option><?php echo $dt['DESAIN']; ?></option>							
				<?php } ?>
			</select>	
		</td>
		<tr style="height: 5px;"></tr>
	<tr>
		<th>Kode Flow</th><th>:</th>
		<td>
			<select class="select" id="kode_flow" style="width: 90%;" disabled='true'>			
				<option value="">Pilih Kode Flow</option>
			</select>	
		</td>
	</tr>	
	<tr style="height: 5px;"></tr>
	<tr>
		<th>Proses Awal</th><th>:</th>
		<td>
				<select class="select" id="proses_awal" style="width: 70%;" disabled='true'>
								<option value="">Pilih Proses Awal</option>
							</select>
		</td>
		<th>Proses Akhir</th><th>:</th>
		<td>
			<input id="proses_akhirs" type="text" class="form-control" style="width: 70%;" readonly>
		</td>
	</tr>
	<tr style="height: 5px;"></tr>
	<tr>
		<th>KK</th><th>:</th>
		<td>
			<select class="select" id="kk" style="width: 90%;" disabled='true'>			
				<option value="">Pilih KK</option>
			</select>	
		</td>
		<th>Seri</th><th>:</th>
		<td>
			<input id="seri"  name='seri' type="text" class="form-control" style="width: 40%;" disabled='true'>
		</td>
	</tr>
	<tr style="height: 5px;"></tr>
	<tr>
		<th>Nomor Mutasi</th><th>:</th>
		<td>
			<select class="select" id="nomor_mutasi" style="width: 100%;" disabled='true'>			
				<option value="">Pilih No. Mutasi</option>
			</select>	
		<input id="pengirim"  name='pengirim' type="hidden" class="form-control" style="width: 40%;" disabled='true'>	
		<input id="penerima"  name='penerima' type="hidden" class="form-control" style="width: 40%;" disabled='true'>
		</td>
	</tr>
</table>

<table id="data-table" class="table table-bordered table-striped" style="width:100%">
	<thead align="center">
		<tr>				
			<th>No</th>
			<!--<th>Shift</th> !-->
			<th>Kode Roll</th>
			<th>Ukuran</th>
			<!--<th>Jumlah Roll</th>!-->
			<th>Panjang(Mtr)</th>
			<!--<th>Total</th>!-->
			
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>

<table id="data-table_pita" class="table table-bordered table-striped" style="width:100%">
	<thead align="center">
		<tr>				
			<th>No</th>
			<th>Kode Roll</th>
			<th>Panjang(Mtr)</th>
			<th>Jumlah Roll</th>
			<th>Total Panjang(Mtr)</th>
			
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
