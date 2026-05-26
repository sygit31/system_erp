<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID KK Detail</th>
			<th>No.</th>
			<th>Desain</th>
			<th>Nomor KK</th>
			<th>Seri</th>
			<th>Tanggal Prod.</th>
			<th>Deadline</th>
			<th>Nama Bahan</th>
			<th>Qty</th>
			<th>Realisasi</th>
			<th>Satuan</th>
			<th>Status</th>
			<th>Close</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$t_qty = 0;
		$t_realisasi = 0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$id_detail = $dt['ID_DETAIL'];
			$desain = $dt['DESAIN'];
			$nomer = $dt['NOMER'];
			$seri = $dt['SERI'];
			$tgl = date('d-M-Y', strtotime($dt['TGL_PROSES']));
			$deadline = date('d-M-Y', strtotime($dt['DEADLINE']));
			$nama = $dt['NAMA'];
			$spesifikasi = ($dt['SPESIFIKASI']) < 5 ? '' : ' - ' . $dt['SPESIFIKASI'];
			$bahan = $nama . $spesifikasi;
			$qty = $dt['QTY'];
			$realisasi = $dt['REALISASI'];
			$satuan = $dt['SATUAN'];
			$status = $dt['STATUS'];
			$t_qty = $t_qty + $qty;
			$t_realisasi = $t_realisasi + $realisasi;
			?>
			<tr>
				<td hidden><?php echo $id_detail; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td><?php echo $nomer; ?></td>
				<td align="center"><?php echo $seri; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td align="center"><?php echo $deadline; ?></td>
				<td><?php echo $bahan; ?></td>
				<td align="right"><?php echo number_format($qty,1); ?></td>
				<td align="right"><?php echo number_format($realisasi,1); ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="center"><?php echo $status; ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" title="Close KK" onclick="hapus(this)" <?php if ($status == 'CLOSE') {echo 'hidden';} ?>><i class="fa fa-close"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" title="Edit Data" onclick="edit(this)" <?php if ($status == 'CLOSE') {echo 'hidden';} ?>><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Data" onclick="hapus(this)" <?php if ($status == 'CLOSE') {echo 'hidden';} ?>><i class="fa fa-trash"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<th colspan="7">Total</th>
		<th align="right"><?php echo number_format($t_qty,1); ?></th>
		<th align="right"><?php echo number_format($t_realisasi,1); ?></th>
		<th colspan="5"></th>
	</tfoot>
</table>