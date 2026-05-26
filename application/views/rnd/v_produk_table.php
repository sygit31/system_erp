<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID Produk</th>
			<th width="5%">No.</th>
			<th width="10%">Kode</th>
			<th width="10%">Jenis</th>
			<th width="25%">Nama Produk</th>
			<th width="30%">Deskripsi</th>
			<th width="10%">Satuan</th>
			<th width="10%">Ukuran</th>
			<th>Edit</th>
			<th>Disabled</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($produk->result_array() as $dt) :
			$id = $dt['ID'];
			$urut++;
			$kode = $dt['KODE'];
			$jenis = $dt['JENIS'];
			($jenis == 'C') ? $jenis = 'Cukai' : $jenis = 'Non Cukai';
			$nama = $dt['NAMA'];
			$deskripsi = $dt['DESKRIPSI'];
			$satuan = $dt['SATUAN'];
			$ukuran = $dt['UKURAN'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $kode; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $deskripsi; ?></td>
				<td><?php echo $satuan; ?></td>
				<td><?php echo $ukuran; ?></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Produk" style="width: 50px;" onclick="edit(this)"><b><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
