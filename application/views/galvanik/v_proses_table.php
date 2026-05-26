<table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 13px;">
	<thead>
		<tr align="center">
			<th>No.</th>
			<th>Tipe</th>
			<th>Desain</th>
			<th>Tanggal Proses</th>
			<th>No. Bak</th>
			<th>Waktu (Menit)</th>
			<th>Realisasi (Menit)</th>
			<th>Mulai</th>
			<th>Selesai</th>
			<th>No. KP</th>
			<th>Master</th>
			<th>Nama Produk</th>
			<th>Result</th>
			<th>No. Register</th>
			<th>Pesan</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($proses->result_array() as $dt):
			$urut=$urut+1;	
			$tipe=$dt['TIPE'];				
			$desain=$dt['DESAIN'];				
			$tgl_proses=date('d-M-Y',strtotime($dt['TGL_PROSES']));
			$no_bak=$dt['NO_BAK'];
			$waktu=$dt['WAKTU'];
			$realisasi=$dt['TIMER_STOP'];
			$mulai=$dt['MULAI'];
			$selesai=$dt['SELESAI'];
			$no_kp=$dt['NO_KP'];
			$master=$dt['MASTER'];
			$nama_produk=$dt['NAMA_PRODUK'];
			$result=$dt['RESULT'];
			$no_reg=$dt['NO_REG'];
			$note=$dt['NOTE'];
			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tipe; ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td align="center"><?php echo $tgl_proses; ?></td>
				<td align="center"><?php echo $no_bak; ?></td>
				<td align="center"><?php echo $waktu; ?></td>
				<td align="center"><?php echo $realisasi; ?></td>
				<td align="center"><?php echo $mulai; ?></td>
				<td align="center"><?php echo $selesai; ?></td>
				<td align="center"><?php echo $no_kp; ?></td>
				<td align="center"><?php echo $master; ?></td>
				<td><?php echo $nama_produk; ?></td>
				<td align="center"><?php echo $result; ?></td>
				<td align="center"><?php echo $no_reg; ?></td>
				<td><?php echo $note; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
