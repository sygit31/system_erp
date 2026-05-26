<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nama Material</th>
			<th>Spesifikasi</th>
			<th>Satuan</th>
			<th>Saldo Awal</th>
			<th>Harga</th>
			<th>Total Harga</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($filter->result_array() as $dt):
			$id=$dt['ID'];
			$urut++;
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$nama = $dt['NAMA'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$satuan = $dt['SATUAN'];
			$saldo = $dt['SALDO'] == '' ? 0 : str_replace(',', '.', $dt['SALDO']);
			$harga = $dt['HARGA'] == '' ? 0 : str_replace(',', '.', $dt['HARGA']);
			$total = $saldo * $harga;
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $spesifikasi; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($saldo,2); ?></td>
				<td align="right"><?php echo number_format($harga,2); ?></td>
				<td align="right"><?php echo number_format($total,2); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
