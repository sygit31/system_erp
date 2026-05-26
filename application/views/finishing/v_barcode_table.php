<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th width="5%">No.</th>
			<th width="10%">Nomor Cutter</th>
			<th width="10%">Tanggal</th>
			<th width="5%">Shift</th>
			<th width="10%">No. SPP</th>
			<th width="10%">No. PP</th>
			<th width="10%">Seri</th>
			<th width="10%">Kode Roll</th>
			<th width="10%">Panjang</th>
			<th width="10%">Lembar</th>
			<th width="10%">Berat</th>
			<th>Cetak</th>
			<th hidden>Desain</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($finishing->result_array() as $dt):
			$urut++;
			$pp_cutter = $dt['NOMOR_PP_CUTTER'];
			$tgl = date('d-M-Y',strtotime($dt['TGL_PROSES_CUTTER']));
			$shift = $dt['SHIFT'];
			$spp = $dt['NO_SPP'];
			$pp = $dt['NOMOR_PP'];
			$seri = $dt['BAHAN'];
			if ($seri == '1') {
				$seri = 'SERI I';
			}elseif($seri == '2') {
				$seri = 'SERI II';
			}elseif($seri == '3') {
				$seri = 'SERI III';
			}else{
				$seri = 'MMEA';
			}
			$no_roll = $dt['NO_ROLL'];
			$panjang = $dt['BAIK_SHT'];
			$lembar = $dt['BAIK_CUTTER'];
			$berat = $dt['PAKAI_KG'];
			$desain = $dt['DESAIN'];
			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $pp_cutter; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td align="center"><?php echo $shift; ?></td>
				<td align="center"><?php echo $spp; ?></td>
				<td align="center"><?php echo $pp; ?></td>
				<td align="center"><?php echo $seri; ?></td>
				<td align="center"><?php echo $no_roll; ?></td>
				<td align="center"><?php echo $panjang; ?></td>
				<td align="center"><?php echo $lembar; ?></td>
				<td align="center"><?php echo $berat; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td hidden><?php echo $desain; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>