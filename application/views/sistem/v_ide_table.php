<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>Id</th>
				<th width="5%">No.</th>
				<th width="10%">Tanggal</th>
				<th width="10%">Nomor</th>
				<th width="20%">Nama Karyawan</th>
				<th width="15%">Bagian</th>
				<th width="30%">Deskripsi Ide</th>
				<th width="10%">Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut=0;
			foreach ($ide->result_array() as $dt):
				$id = $dt['ID_IDE'];
				$urut++;
				$tgl = date('d-M-Y',strtotime($dt['TGL']));
				$nmr = $dt['NMR'];
				$nama = $dt['NAMA'];
				$bagian = $dt['BAGIAN'];
				$ide = $dt['IDE'];
				$status = $dt['STATUS'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $tgl; ?></td>
					<td align="center"><?php echo $nmr; ?></td>
					<td><?php echo $nama; ?></td>
					<td align="center"><?php echo $bagian; ?></td>
					<td><?php echo $ide; ?></td>
					<td align="center"><?php echo $status; ?></td>
					<td><button type="button" class="btn btn-block btn-success btn-sm" title="Print Data" onclick="cetak(this)"><b><i class="fa fa-print"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>