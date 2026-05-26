<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th hidden>Id Detail</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>IPB</th>
			<th>Mesin</th>
			<th>PP</th>
			<th>Kode Roll</th>
			<th>KK</th>
			<th>Seri</th>
			<th>Qty Roll</th>
			<th>Panjang</th>
			<th>Operator</th>
			<th>Pengawas Slitter</th>
			<th>Pengawas Stamping</th>
			<th>Print</th>
			<th>Edit</th>
			<th>Hapus</th>
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
			$mesin = $dt['MESIN'];
			$nmr_pp = $dt['NMR_PP'];
			$kode_roll = $dt['KODE_ROLL'];
			$kk = $dt['KK'];
			$seri = $dt['SERI'];
			$qty_roll = $dt['QTY_ROLL'] == null ? 0 : str_replace(',', '.', $dt['QTY_ROLL']);
			$panjang = str_replace(',', '.', $dt['PANJANG']);
			$operator = ucwords(strtolower(substr($dt['OPERATOR'],0,strlen($dt['OPERATOR'])-2)));
			$pengawas_slitter = ucwords(strtolower($dt['PENGAWAS_SLITTER']));
			$pengawas_stamping = ucwords(strtolower($dt['PENGAWAS_STAMPING']));
			$status = $dt['STATUS'];
			?>
			<tr>
				<td hidden><?php echo $id_detail; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nmr; ?></td>
				<td><?php echo $mesin; ?></td>
				<td><?php echo $nmr_pp; ?></td>
				<td><?php echo $kode_roll; ?></td>
				<td><?php echo $kk; ?></td>
				<td align="center"><?php echo $seri; ?></td>
				<td align="right"><?php echo number_format($qty_roll); ?></td>
				<td align="right"><?php echo number_format($panjang,1); ?></td>
				<td><?php echo $operator; ?></td>
				<td><?php echo $pengawas_slitter; ?></td>
				<td><?php echo $pengawas_stamping; ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-info btn-sm" style="width: 50px;" title="Print Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Data" onclick="batal(this)"><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
