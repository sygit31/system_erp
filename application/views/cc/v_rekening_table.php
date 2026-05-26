<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead style="text-align: center;">
			<tr align="center">
				<th hidden>ID Rekening</th>
				<th width="20%">No.</th>
				<th width="25%">Nomor</th>
				<th width="55%">Rekening</th>
				<th>Aktif</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			foreach ($rekening->result_array() as $dt):
				$urut++;
				$id = $dt['ID'];
				$no_rekjurnal = $dt['NO_REKJURNAL'];
				$nama = $dt['NAMA'];
				$aktif = $dt['STATUS'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $no_rekjurnal; ?></td>
					<td><?php echo $nama; ?></td>
					<td>
						<input type="checkbox" class="akses" name="akses" onclick="status(this)" style="cursor: pointer;" <?php if($aktif=='1'){echo 'checked';} ?>>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>