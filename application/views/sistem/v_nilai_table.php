<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th>No.</th>
				<th>Periode</th>
				<th>Kategori</th>
				<th>Nama Karyawan</th>
				<th>NIK</th>
				<th>Motivasi Kerja</th>
				<th>Komunikasi & Kerjasama</th>
				<th>Pemahaman & Penguasaan Pekerjaan</th>
				<th>Pengembangan Diri</th>
				<th>Hasil Kerja</th>
				<th>HR</th>
				<th>IS</th>
				<th>K3</th>
				<th>Total</th>
				<th>Kategori</th>
			</tr>
		</thead>
			<?php
			$urut = 0;
			foreach ($nilai->result_array() as $dt):
				$urut=$urut+1;				
				$tanggal=$dt['TANGGAL'];
				$kategori=$dt['KATEGORI'];	
				$nama=$dt['NAMA'];
				$nik=$dt['NIK'];
				$n1=$dt['N1']; if ($n1 != '') {$n1 = number_format($n1,2);}
				$n2=$dt['N2']; if ($n2 != '') {$n2 = number_format($n2,2);}
				$n3=$dt['N3']; if ($n3 != '') {$n3 = number_format($n3,2);}
				$n4=$dt['N4']; if ($n4 != '') {$n4 = number_format($n4,2);}
				$n5=$dt['N5']; if ($n5 != '') {$n5 = number_format($n5,2);}
				$n6 = ''; if (isset($dt['N6'])) {$n6=number_format($dt['N6'],2);}
				$n7 = ''; if (isset($dt['N7'])) {$n7=number_format($dt['N7'],2);}
				$n8 = ''; if (isset($dt['N8'])) {$n8=number_format($dt['N8'],2);}
				$totals = 0;
				$qty = 0;
				$nilai = '';
				$total = array($n1,$n2,$n3,$n4,$n5,$n6,$n7,$n8);
				foreach ($total as $dt) {
					if ($dt != '') {
						$totals = $totals+$dt;
						$qty = $qty+1;
					}
				}
				if ($qty>0) {$nilai = number_format($totals / $qty,2);}

				if ($nilai > 4.40) {
					$kategori = 'BS';
				}elseif ($nilai > 3.9) {
					$kategori = 'B';
				}elseif ($nilai > 3.3) {
					$kategori = 'C';
				}elseif ($nilai > 2.6) {
					$kategori = 'K';
				}elseif ($nilai > 0 && $nilai <= 2.6) {
					$kategori = 'KS';
				}

			?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $tanggal; ?></td>
					<td align="center"><?php echo $kategori; ?></td>
					<td><?php echo $nama; ?></td>
					<td align="center"><?php echo $nik; ?></td>
					<td align="center"><?php echo $n1; ?></td>
					<td align="center"><?php echo $n2; ?></td>
					<td align="center"><?php echo $n3; ?></td>
					<td align="center"><?php echo $n4; ?></td>
					<td align="center"><?php echo $n5; ?></td>
					<td align="center"><?php echo $n6; ?></td>
					<td align="center"><?php echo $n7; ?></td>
					<td align="center"><?php echo $n8; ?></td>
					<td align="center"><?php echo $nilai; ?></td>
					<td align="center"><?php echo $kategori; ?></td>
				</tr>
			<?php endforeach; ?>

		<tbody>
		</tbody>
	</table>
</div>