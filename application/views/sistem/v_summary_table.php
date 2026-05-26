<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped data-table" style="font-size: 14px; width: 100%;">
		<thead style="text-align: center;">
			<tr>
				<th hidden>ID PIC</th>
				<th width="10%">No.</th>
				<th width="30%">Nama PIC</th>
				<th width="20%">Jabatan</th>
				<th width="20%">Bagian</th>
				<th width="10%">Qty Project</th>
				<th width="10%">Qty Open</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			foreach ($project->result_array() as $dt):
				$urut ++;
				$id_pic = $dt['ID_PIC'];
				$nama = $dt['NAMA'];
				$jabatan = $dt['JABATAN'];
				$bagian = $dt['BAGIAN'];
				$qty_project = $dt['QTY_PROJECT'];
				$qty_open = $dt['QTY_OPEN'];
				?>
				
				<tr>
					<td hidden><?php echo $id_pic; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td style="text-align: left;"><?php echo $nama; ?></td>
					<td><?php echo $jabatan; ?></td>
					<td><?php echo $bagian; ?></td>
					<td align="center"><?php echo $qty_project; ?></td>
					<td align="center"><?php echo $qty_open; ?></td>
					<td><input type="button" class="btn btn-block btn-info" onclick="pic_project(this)" value="Detail"></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>