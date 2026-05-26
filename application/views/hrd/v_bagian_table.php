<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped">
		<thead>
			<tr align="center">
				<th hidden>Id</th>
				<th width="10%">No.</th>
				<th width="40%">Kode</th>
				<th width="60%">Nama Bagian</th>
				<td></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($bagian->result_array() as $dt):
				$id=$dt['ID'];
				$urut++;
				$kode=$dt['KODE'];
				$nama=$dt['NAMA'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $kode; ?></td>
					<td><?php echo $nama; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>