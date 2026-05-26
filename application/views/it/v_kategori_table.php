<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th width="10%">No.</th>
				<th width="40%">Kategori</th>
				<th width="40%">Sub Kategori</th>
				<td width="5%"></td>
				<td width="5%"></td>
				<td hidden>Id Kategori</td>
				<td hidden>Id Kategori Detail</td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($kategori->result_array() as $dt):
				$urut++;
				$kategori=$dt['KATEGORI'];
				$sub_kategori=$dt['SUB_KATEGORI'];
				$id_kategori=$dt['ID_KATEGORI'];
				$id_sub_kategori=$dt['ID_KATEGORI_DETAIL'];
				?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $kategori; ?></td>
					<td><?php echo $sub_kategori; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Kategori" onclick="edit(this)"><b><i class="fa fa-check-square-o"></i></button></td>
					<td><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Kategori" onclick="hapus(this)"><b><i class="fa ion-trash-a"></i></button></td>
					<td hidden><?php echo $id_kategori; ?></td>
					<td hidden><?php echo $id_sub_kategori; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>