<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th>No.</th>
				<th>No. Risalah</th>
				<th>Tanggal Rev.</th>
				<th>Desain</th>
				<th>Nomer Rev.</th>
				<th>Delivery</th>
				<th>Produk</th>
				<th>Satuan</th>
				<th>Qty Add.</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$id_risalah = "";
			$urut = 0;
			foreach ($rev_risalah->result_array() as $dt):
				$urut++;
				$no_risalah=$dt['NMR_RISALAH'];
				$tgl=date('d-M-Y',strtotime($dt['TGL']));
				$tahun=$dt['DESAIN'];
				$nomer=$dt['NMR'];
				$delivery=date('M-y',strtotime($dt['DELIVERY']));
				$nama=$dt['NAMA'];
				$satuan=$dt['SATUAN'];
				$qty=number_format($dt['QTY'],0);
			?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $no_risalah; ?></td>
					<td align="center"><?php echo $tgl; ?></td>
					<td align="center"><?php echo $tahun; ?></td>
					<td align="center"><?php echo $nomer; ?></td>
					<td align="center"><?php echo $delivery; ?></td>
					<td><?php echo $nama; ?></td>
					<td align="center"><?php echo $satuan; ?></td>
					<td align="center"><?php echo $qty; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>			
	</table>
</div>