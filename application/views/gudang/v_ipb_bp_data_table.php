<table id="data-table2" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th hidden>Id Detail</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nomor IPB</th>
			<th>KK</th>
			<th>Mesin</th>
			<th>Nama Bahan</th>
			<th>Satuan</th>
			<th>Qty Produksi</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		$t_prod = 0;
		foreach ($filter_data->result_array() as $dt):
			$urut++;
			$id_detail = $dt['ID_DETAIL'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$tgl_ipb = date('d-M-Y', strtotime($dt['TGL_IPB']));
			$nmr_ipb = $dt['NMR_IPB'];
			$status = $dt['STATUS'];
			
			$kk = $dt['KK'];
			$mesin = $dt['MESIN'];
			if ($status == '1') {$kk = '-- Other --';}
			if ($status == '0' && $kk == null) {$kk = '-- Tanpa KK --';}
			if ($status == '0' && $mesin == null) {$mesin = '-- Tanpa Mesin --';}

			$bahan = $dt['BAHAN'];
			$satuan = $dt['SATUAN'];
			$qty = str_replace(',', '.', $dt['QTY']);
			$t_prod = $t_prod + $qty;

			$edit = '1';
			if (date('ym') > date('ym', strtotime($dt['TGL'])) && floor((strtotime(date("d-M-Y")) - strtotime($dt['TGL'])) / 60 / 60 / 24) > 7) {
				// $edit = '0';
			}

			?>
			<tr>
				<td hidden><?php echo $id_detail; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nmr_ipb . '<br>(' . $tgl_ipb . ')'; ?></td>
				<td><?php echo $kk; ?></td>
				<td><?php echo $mesin; ?></td>
				<td><?php echo $bahan; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($qty, 3); ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Bahan" onclick="hapus(this)" <?php if ($edit == '0') {echo 'hidden';} ?>><i class="fa fa-trash"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot class="text-bold">
		<td></td>
		<td colspan="4" align="center">Total</td>
		<td align="right"><?php echo number_format($t_prod,1); ?></td>
		<td></td>
	</tfoot>
</table>
