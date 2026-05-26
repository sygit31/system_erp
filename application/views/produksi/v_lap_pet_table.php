
<div class="text-center mb-5"><h2 id="judul">Monitoring Kartu Kerja Mesin</h2></div>
<table width="100%" style="font-size: 14px; margin-bottom: 20px;">
	<tr>
		<th width="10%">No.</th><th width="5%">:</th>
		<td width="50%">
			<select class="select" id="kk" style="width: 40%;">				
				<option value="">Pilih No. KK</option>
				<?php foreach($kk->result_array() as $dt) { ?>
					<option><?php echo $dt['KK']; ?></option>							
				<?php } ?>
			</select>	
		</td>
		<th width="10%">Oplah</th><th width="5%">:</th>
		<td width="20%">
			<input id="oplah" type="text" class="form-control" style="width: 70%;" readonly>
		</td>
	</tr>
	<tr style="height: 5px;"></tr>
	<tr>
		<th>Seri</th><th>:</th>
		<td>
			<input id="seri" type="text" class="form-control" style="width: 40%;" readonly>
		</td>
		<th>Realisasi</th><th>:</th>
		<td>
			<input id="realisasi" type="text" class="form-control" style="width: 70%;" readonly>
		</td>
	</tr>
	<tr style="height: 5px;"></tr>
	<tr>
		<th>Tanggal</th><th>:</th>
		<td>
			<input id="tanggal" type="text" class="form-control" style="width: 40%;" readonly>
		</td>
		<th>Deltime</th><th>:</th>
		<td>
			<input id="deltime" type="text" class="form-control" style="width: 70%;" readonly>
		</td>
	</tr>
</table>

<table id="data-table" class="table table-bordered table-striped" style="width:100%">
	<thead align="center">
		<tr>				
			<th colspan="2">Gudang</th>
			<th colspan="4">Emboss</th>
			<th colspan="2">Metalize</th>
			<th colspan="2">Coating Sensitize</th>
			<th colspan="2">Coating Readable</th>
			<th colspan="2">Sliter Belah</th>
			<th colspan="2">Pita (37.5 cm)</th>
		</tr>
		<tr>
			<th>Tanggal</th>
			<th>Bon</th>
			<th>Hasil Baik</th>
			<th>Reject</th>
			<th>Selisih Teller</th>
			<th>PCH Terpakai</th>
			<th>Hasil Baik</th>
			<th>Waste</th>
			<th>Hasil Baik</th>
			<th>Waste</th>
			<th>Hasil Baik</th>
			<th>Waste</th>
			<th>Hasil Baik</th>
			<th>Waste</th>
			<th>Hasil Baik</th>
			<th>Waste</th>
		</tr>
	</thead>
	<tbody></tbody>
	<tfoot style="font-weight: bold;"><tr></tr><tr></tr></tfoot>
</table>
