<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th hidden>Id Detail</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Pemesan</th>
			<th>Bagian</th>
			<th>Nomor IPB</th>
			<th>Jenis</th>
			<th>Nama Bahan</th>
			<th>Satuan</th>
			<th>Qty</th>
			<th>Status</th>
			<th>Keterangan</th>
			<th>Print</th>
			<th>Edit</th>
			<th>Approve</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$total = 0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$id_detail = $dt['ID_DETAIL'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$pemesan = ucwords(strtolower($dt['PEMESAN']));
			$bagian = $dt['BAGIAN'];
			$nmr = $dt['NMR'];
			$jenis = $dt['JENIS'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$bahan = strlen($spesifikasi) > 3 ? $dt['NAMA'] . ' - ' . $spesifikasi : $dt['NAMA'];
			$satuan = $dt['SATUAN'];
			$qty = str_replace(',', '.', $dt['QTY']);
			$status = $dt['STATUS'];
			$keterangan = $dt['KETERANGAN'];
			$total = $total + $qty;

			if ($status == '0') {
				$status = 'Batal';
			}elseif ($status == '1') {
				$status = 'Submit';
			}elseif ($status == '2') {
				$status = 'Close';
			}
			?>
			<tr>
				<td hidden><?php echo $id_detail; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $pemesan; ?></td>
				<td><?php echo $bagian; ?></td>
				<td><?php echo $nmr; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $bahan; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($qty,2); ?></td>
				<td align="center"><?php echo $status; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-info btn-sm" style="width: 50px;" name="cetak" title="Print Data" onclick="cetak(this)" <?php if ($status != 'Close') {echo 'hidden';} ?>><i class="fa fa-print"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="edit" title="Edit Data" onclick="edit(this)" <?php if ($status != 'Submit') {echo 'hidden';} ?>><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="app" title="Approve Data" onclick="app(this)" <?php if ($status != 'Submit') {echo 'hidden';} ?>><i class="fa fa-send-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="rej" title="Hapus Data" onclick="app(this)" <?php if ($status != 'Submit') {echo 'hidden';} ?>><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<th colspan="8">Total</th>
		<th align="right"><?php echo number_format($total,2); ?></th>
		<th colspan="6"></th>
	</tfoot>
</table>
