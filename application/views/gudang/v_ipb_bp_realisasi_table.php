<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th hidden>Id Detail</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nomor IPB</th>
			<th>Jenis</th>
			<th>Nama Bahan</th>
			<th>Satuan</th>
			<th>Qty Bon</th>
			<th>Qty Produksi</th>
			<th>Keterangan</th>
			<th>Pakai</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$id_detail = $dt['ID_DETAIL'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$nmr = $dt['NMR'];
			$jenis = $dt['JENIS'];
			$bahan = $dt['BAHAN'];
			$satuan = $dt['SATUAN'];
			$qty = str_replace(',', '.', $dt['QTY']);
			$qty_produksi = str_replace(',', '.', $dt['QTY_PRODUKSI']);
			$keterangan = $dt['KETERANGAN'];
			$status = $dt['STATUS'];
			?>
			<tr>
				<td hidden><?php echo $id_detail; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nmr; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $bahan; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($qty,2); ?></td>
				<td align="right"><?php echo number_format($qty_produksi,2); ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-info btn-sm" style="width: 50px;" title="Gunakan Bahan" onclick="pakai(this)" <?php if ($qty_produksi >= $qty) {echo 'hidden';} ?>><i class="fa fa-hand-o-left"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>