<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID Detail</th>
			<th hidden>ID</th>
			<th>No.</th>
			<th>Supplier</th>
			<th>Tanggal</th>
			<th>No. PO</th>
			<th>Kategori</th>
			<th>Jenis</th>
			<th>Nama Barang</th>
			<th>Spesifikasi</th>
			<th>Satuan</th>
			<th>Qty</th>
			<th>Harga</th>
			<th>Total</th>
			<th>Mata Uang</th>
			<th>Deadline</th>
			<th>Qty Datang</th>
			<th>Status</th>
			<th>Print</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$sub_total = 0;
		foreach ($data->result_array() as $dt) :
			$id_detail_po = $dt['ID_DETAIL_PO'];
			$id_po = $dt['ID_PO'];
			$urut = $urut + 1;
			$supplier = $dt['SUPPLIER'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$nomer = $dt['NOMER'];
			$kategori = $dt['KATEGORI'];
			$jenis = $dt['JENIS'];
			$nama_barang = $dt['NAMA_BARANG'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$satuan = $dt['SATUAN'];
			$qty = str_replace(',', '.', $dt['QTY']);
			$harga = str_replace(',', '.', $dt['HARGA']);
			$total = $qty * $harga;
			$mata_uang = $dt['MATA_UANG'];
			$del_time = date('d-M-Y', strtotime($dt['DEL_TIME']));
			$qty_datang = $dt['QTY_DATANG'];
			if ($qty_datang == null) {$qty_datang = 0;}
			$qty_datang = str_replace(',', '.', $qty_datang);
			$qty_sp = $dt['QTY_SP'];
			if ($qty - $qty_datang <= 0 || $dt['STATUS'] == 'FINISH') {
				$status = 'Close';
			} else {
				$status = 'Open';
			}

			$sub_total = $sub_total + $total;
			?>
			<tr>
				<td hidden><?php echo $id_detail_po; ?></td>
				<td hidden><?php echo $id_po; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $supplier; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nomer; ?></td>
				<td><?php echo $kategori; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $nama_barang; ?></td>
				<td><?php echo $spesifikasi; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($qty,1); ?></td>
				<td align="right"><?php echo number_format($harga,2); ?></td>
				<td align="right"><?php echo number_format($total,2); ?></td>
				<td align="center"><?php echo $mata_uang; ?></td>
				<td align="center"><?php echo $del_time; ?></td>
				<td align="right"><?php echo number_format($qty_datang,2); ?></td>
				<td align="center" <?php if ($status == 'Open') {echo "style='color: red; font-weight: bold;'";} ?>><?php echo $status; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" title="Print Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)" <?php if ($qty_sp != 0) {echo "hidden";} ?>><i class="fa fa-check-square-o"></i></button></td>
				<td><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="batal(this)" <?php if ($qty_sp != 0) {echo "hidden";} ?>><i class="fa fa-trash"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<th colspan="10" class="text-center">Total</th>			
		<td align="right"><b><?php echo number_format($sub_total,2); ?></b></td>		
		<th colspan="8" class="text-center"></th>	
	</tfoot>
</table>
