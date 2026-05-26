<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr style="text-align: center; font-weight: bold;">
				<td>No.</td>
				<td hidden></td>
				<td>Tanggal</td>
				<td>Desain</td>
				<td>Nomer</td>
				<td>Delivery</td>
				<td>Produk</td>
				<td>Satuan</td>
				<td>Qty</td>
				<td>Qty Add.</td>
				<td>Total</td>
				<td>Terkirim</td>
				<td>Outstanding</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$id_risalah = "";
			$urut = 1;
			foreach ($risalah->result_array() as $dt):

				// Hide cells with same nomor risalah
				if($id_risalah == $dt['ID_RISALAH'] && $urut != 1) {
					$nmr = '';
					$tgl = "";
					$tahun = "";
					$nomer = "";
					$delivery = "";
				}else{
					$nmr = $urut++;
					$tgl=date('d-M-Y',strtotime($dt['TGL']));
					$tahun=$dt['DESAIN'];
					$nomer=$dt['NMR'];
					$delivery=date('M-y',strtotime($dt['DELIVERY']));
				}

				$id_risalah = $dt['ID_RISALAH'];
				$id_detail = $dt['ID_DETAIL'];
				$nama=$dt['NAMA'];
				$satuan=$dt['SATUAN'];
				$qty=number_format($dt['QTY'],0);
				$qty_rev=number_format($dt['QTY_REV'],0);
				if ($qty_rev == 0) {$qty_rev = '';}
				$total = number_format($dt['QTY'] + $dt['QTY_REV'],0);
			?>
				<tr>
					<td align="center"><?php echo $nmr; ?></td>
					<td hidden><?php echo $id_detail; ?></td>
					<td align="center"><?php echo $tgl; ?></td>
					<td align="center"><?php echo $tahun; ?></td>
					<td align="center"><?php echo $nomer; ?></td>
					<td align="center"><?php echo $delivery; ?></td>
					<td><?php echo $nama; ?></td>
					<td align="center"><?php echo $satuan; ?></td>
					<td align="center"><?php echo $qty; ?></td>
					<td align="center"><?php echo $qty_rev; ?></td>
					<td align="center"><?php echo $total; ?></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>
			<?php endforeach; ?>
		</tbody>			
	</table>
</div>