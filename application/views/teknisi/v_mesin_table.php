<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th width="5%">No.</th>
				<th hidden>Id Mesin</th>
				<th width="12.5%">Nomor Mesin</th>
				<th width="12.5%">Tahun Mesin</th>
				<th width="20%">Nama Mesin</th>
				<th width="30%">Deskripsi</th>
				<th width="10%">Kapasitas</th>
				<th width="10%">Status</th>
				<th width="5%">Part</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($mesin->result_array() as $dt):
				$urut++;
				$id = $dt['ID'];
				$nomor = $dt['NMR_MESIN'];
				$tahun = $dt['TAHUN'];
				$nama = $dt['NAMA_MESIN'];
				$deskripsi = $dt['DESKRIPSI'];
				$kapasitas = $dt['KAPASITAS'];
				$status = $dt['STATUS'] == '1' ? 'Aktif' : 'Non Aktif';
				?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $nomor; ?></td>
					<td align="center"><?php echo $tahun; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $deskripsi; ?></td>
					<td align="center"><?php echo $kapasitas; ?></td>
					<td align="center"><?php echo $status; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="show_part(this)"><i class="fa fa-wrench"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>