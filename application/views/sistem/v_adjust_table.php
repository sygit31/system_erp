<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th width="5%">No.</th>
			<th width="10%">Periode</th>
			<th width="20%">Penilai</th>
			<th width="20%">Nama Karyawan</th>
			<th width="10%">Bagian</th>
			<th width="10%">Jabatan</th>
			<th width="10%">Nilai</th>
			<th width="15%">Keterangan</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter->result_array() as $dt):
			$id = $dt['ID'];
			$urut++;
			$tgl = date('d-M-Y',strtotime($dt['TGL']));
			$penilai = $dt['PENILAI'];
			$nama = $dt['NAMA'];
			$bagian = $dt['BAGIAN'];
			$jabatan = $dt['JABATAN'];
			$nilai = $dt['NILAI'];
			$keterangan = $dt['KETERANGAN'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $penilai; ?></td>
				<td><?php echo $nama; ?></td>
				<td align="center"><?php echo $bagian; ?></td>
				<td align="center"><?php echo $jabatan; ?></td>
				<td align="center"><?php echo $nilai; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>