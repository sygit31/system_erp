<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th>No.</th>
			<th>Desain</th>
			<th>Tanggal</th>
			<th>Shift</th>
			<th>Mesin</th>
			<th>No. PP</th>
			<th>Kode Roll</th>
			<th>Seri</th>
			<th>Ukuran</th>
			<th>Panjang</th>
			<th>Gramature</th>
			<th>Operator</th>
			<th>QC</th>
			<th>Pengawas</th>
			<th>Urut PP</th>
			<th>Cetak</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($stamping->result_array() as $dt):
			$urut++;
			$desain = $dt['DESAIN'];
			$tgl_proses_stamp = $dt['TGL_PROSES_STAMP'];
			$shift_stamp = $dt['SHIFT_STAMP'];
			$nomesin_stamp = $dt['NOMESIN_STAMP'];
			$nomor_pp = $dt['NOMOR_PP'];
			$no_roll = $dt['NO_ROLL'];
			$bahan = $dt['BAHAN'];
			if ($bahan == '1') {
				$seri = 'SERI I';
				$ukuran = '72';
			}elseif($bahan == '2') {
				$seri = 'SERI II';
				$ukuran = '72';
			}elseif($bahan == '3') {
				$seri = 'SERI III';
				$ukuran = '51,5';
			}else{
				$seri = 'MMEA';
				$ukuran = '33';
			}
			$panjang = number_format($dt['PANJANG'],0,',','.');
			$gramature = $dt['GRAMATURE'];
			$nm_operator = $dt['NM_OPERATOR'];
			$nm_qc = $dt['NM_QC'];
			$nm_pengawas = $dt['NM_PENGAWAS'];
			$urut_pp = $dt['URUT_PP'];
			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td align="center"><?php echo $tgl_proses_stamp; ?></td>
				<td align="center"><?php echo $shift_stamp; ?></td>
				<td align="center"><?php echo $nomesin_stamp; ?></td>
				<td align="center"><?php echo $nomor_pp; ?></td>
				<td align="center"><?php echo $no_roll; ?></td>
				<td align="center"><?php echo $seri; ?></td>
				<td align="center"><?php echo $ukuran; ?></td>
				<td align="center"><?php echo $panjang; ?></td>
				<td align="center"><?php echo $gramature; ?></td>
				<td><?php echo $nm_operator; ?></td>
				<td><?php echo $nm_qc; ?></td>
				<td><?php echo $nm_pengawas; ?></td>
				<td align="center"><?php echo $urut_pp; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>