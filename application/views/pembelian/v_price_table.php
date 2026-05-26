<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>ID Price</th>
				<th>No.</th>
				<th>Nama Material</th>
				<th>Satuan</th>
				<th>No. Quotation</th>
				<th>Supplier</th>
				<th>Net Price</th>
				<th>Mata Uang</th>
				<th>Delivery Time</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			$material = '';
			foreach ($price->result_array() as $dt):
				
				if ($material == $dt['NAMA_MATERIAL']) {
					$nama_material='';
					$satuan='';
				}else{
					$urut=$urut+1;
					$nama_material = $dt['NAMA_MATERIAL'];
					$satuan = $dt['SATUAN'];
				}	

				$material = $dt['NAMA_MATERIAL'];
				$id_price = $dt['ID_PRICE'];
				$no_quotation = $dt['NO_QUOTATION'];
				$nama_supplier = $dt['NAMA_SUPPLIER'];
				$net_price = $dt['NET_PRICE'];
				$mata_uang = $dt['MATA_UANG'];
				$net_deltime = date('d-M-Y',strtotime($dt['NET_DELTIME']));
			?>
				<tr>
					<td hidden><?php echo $id_price; ?></td>
					<td align="center"><?php if($nama_material == "") {echo "";}else{echo $urut;} ?></td>
					<td><?php echo $nama_material; ?></td>
					<td align="center"><?php echo $satuan; ?></td>
					<td align="center"><?php echo $no_quotation; ?></td>
					<td><?php echo $nama_supplier; ?></td>
					<td align="right"><?php echo $net_price; ?></td>
					<td align="center"><?php echo $mata_uang; ?></td>
					<td align="center"><?php echo $net_deltime; ?></td>
					<td><button type="button" class="btn btn-block btn-info btn-sm" onclick="edit(this)">Edit</button></td>
					<td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="hapus(this)">Hapus</button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>