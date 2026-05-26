<table id="data_table_stok" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th>No.</th>
			<th>Jenis</th>
			<th>Nama Bahan</th>
			<th>Satuan</th>
			<th>Saldo Awal</th>
			<th>Terima</th>
			<th>Keluar</th>
			<th>Proses Lain</th>
			<th>Stok</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter_stok->result_array() as $dt):
			$urut++;
			$jenis = $dt['JENIS'];
			$nama = $dt['NAMA'];
			$satuan = $dt['SATUAN'];
			$stok_awal = $dt['STOK_AWAL'] == null ? 0 : str_replace(',', '.', $dt['STOK_AWAL']);
			$awal_bon = str_replace(',', '.', $dt['AWAL_BON']);
			$awal_produksi = str_replace(',', '.', $dt['AWAL_PRODUKSI']);
			$saldo_awal = $stok_awal + $awal_bon - $awal_produksi;
			$qty_bon = str_replace(',', '.', $dt['QTY_BON']);
			$qty_produksi = str_replace(',', '.', $dt['QTY_PRODUKSI']);
			$qty_produksi_lain = str_replace(',', '.', $dt['QTY_PRODUKSI_LAIN']);
			$sisa = $saldo_awal + $qty_bon - $qty_produksi - $qty_produksi_lain;
			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $nama; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($saldo_awal,2); ?></td>
				<td align="right"><?php echo number_format($qty_bon,2); ?></td>
				<td align="right"><?php echo number_format($qty_produksi,2); ?></td>
				<td align="right"><?php echo number_format($qty_produksi_lain,2); ?></td>
				<td align="right"><?php echo number_format($sisa,2); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
