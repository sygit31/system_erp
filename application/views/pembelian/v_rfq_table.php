<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>ID RFQ</th>
				<th>No.</th>
				<th>No. RFQ</th>
				<th>Tanggal Request</th>
				<th>Quotation Deadline</th>
				<th>Supplier</th>
				<th>Delivery Time</th>
				<th>Nama Material</th>
				<th>Satuan</th>
				<th>Qty Request</th>
				<th>Storage Location</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			foreach ($rfq->result_array() as $dt):
				$id = $dt['ID_RFQ'];
				$urut = $urut+1;
				$nmr = $dt['NMR'];
				$tgl = date('d-M-Y',strtotime($dt['TGL']));
				$deadline = date('d-M-Y',strtotime($dt['DEADLINE']));
				$supplier = $dt['NAMA_SUPPLIER'];
				$deltime = date('d-M-Y',strtotime($dt['DELTIME']));
				$material = $dt['NAMA_MATERIAL'] . '-' . $dt['SPESIFIKASI'];
				$satuan = $dt['SATUAN'];
				$qty = $dt['QTY'];
				$storage = $dt['STORAGE'];
			?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $nmr; ?></td>
					<td align="center"><?php echo $tgl; ?></td>
					<td align="center"><?php echo $deadline; ?></td>
					<td><?php echo $supplier; ?></td>
					<td align="center"><?php echo $deltime; ?></td>
					<td><?php echo $material; ?></td>
					<td align="center"><?php echo $satuan; ?></td>
					<td align="center"><?php echo $qty; ?></td>
					<td align="center"><?php echo $storage; ?></td>
					<td><button type="button" class="btn btn-block btn-info btn-sm" onclick="edit(this)">Edit</button></td>
					<td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="hapus(this)">Hapus</button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>