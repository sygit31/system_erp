<div class="data-table1">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>Id</th>
				<th width="5%">No.</th>
				<th width="10%">NIK</th>
				<th width="35%">Nama</th>
				<th width="25%">Bagian</th>
				<th width="25%">Jabatan</th>
				<td></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($penilai->result_array() as $dt):
				$urut++;
				$id = $dt['ID_PENILAI'];
				$nik = $dt['NIK'];
				$nama = strtoupper($dt['NAMA']);
				$bagian = strtoupper($dt['BAGIAN']);
				$jabatan = strtoupper($dt['JABATAN']);
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nik; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $bagian; ?></td>
					<td><?php echo $jabatan; ?></td>
					<td><input type="radio" class="action" name="action" onclick="get_action(this)" style="cursor: pointer;"></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>