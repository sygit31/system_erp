<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Nomor KK</th>
			<th>Proses</th>
			<th>Nama Mesin</th>
			<th>Shift</th>
			<th>Pengawas</th>
			<th>Operator</th>
			<th>Mulai</th>
			<th>Selesai</th>
			<th>Durasi (Menit)</th>
			<th>Kode Roll</th>
			<th>Panjang Bahan</th>
			<th>Hasil</th>
			<th>Waste</th>
			<th>Sisa</th>
			<th>Alu Wire (Gr)</th>
			<th>Keterangan</th>
			<th>Cetak</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$t_hasil = 0;
		$t_waste = 0;
		$t_sisa = 0;
		$t_bahan = 0;
		foreach ($pet->result_array() as $dt) :
			$id = $dt['ID'];
			$urut++;
			$tgl = $dt['TGL'];
			$kk = $dt['KK'];
			$kode_flow = $dt['DESKRIPSI'];
			$proses = $dt['PROSES'];
			$nama_mesin = $dt['NAMA_MESIN'];
			$shift = $dt['SHIFT'];
			$pengawas = $dt['PENGAWAS'];
			$operator = $dt['OPERATOR'] == null ? '' : substr($dt['OPERATOR'], 0, strlen($dt['OPERATOR'])-2);
			$mulai = date('H:i', strtotime($dt['MULAI']));
			$selesai = date('H:i', strtotime($dt['SELESAI']));
			$durasi = round(abs(strtotime($dt['MULAI']) - strtotime($dt['SELESAI'])) / 60,2);
			$kode = $dt['KODE'];
			$hasil = $dt['HASIL'];
			$reject = $dt['REJECT'] == null ? 0 : $dt['REJECT'];
			$sisa = number_format(str_replace(',','.', $dt['SISA']));
			$qty_terima = number_format(str_replace(',','.', $dt['PANJANG']));
			$qty_roll = $dt['QTY_ROLL'];
			if ($proses == 'Pita') {
				$hasil = number_format(str_replace(',','.',$hasil),2) . ' </br>(' . $qty_roll . ' Roll)';
				$reject = number_format(str_replace(',','.',$reject),2);
			}else{
				$hasil = number_format($hasil);
				$reject = number_format($reject);
			}
			$keterangan = $dt['KETERANGAN'];
			$teller = $dt['TELLER'];
			if ($teller == '1') {$reject = $reject . ' (teller)';}

			$next_proses = $dt['NEXT_PROSES'];
			$dec = $proses == 'Emboss' ? 0 : 2;
			$bahan = str_replace(',','.', $dt['BAHAN']);

			$t_hasil = $t_hasil + str_replace(',','.',$dt['HASIL']);
			$t_waste = $t_waste + ($dt['REJECT'] == 0 ? 0 :  str_replace(',','.', $dt['REJECT']));
			$t_sisa = $t_sisa + ($dt['SISA'] == 0 ? 0 :  str_replace(',','.', $dt['SISA']));
			$t_bahan = $t_bahan + $bahan;
			$scroll = strlen($operator) > 60 ? 'scroll' : '';

			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $kk . ' (' . $kode_flow . ')'; ?></td>
				<td><?php echo $proses; ?></td>
				<td><?php echo $nama_mesin; ?></td>
				<td align="center"><?php echo $shift; ?></td>
				<td align="center"><?php echo $pengawas; ?></td>
				<td><div style="width: 150px; height: 60px; overflow-y: <?php echo $scroll; ?>;"><?php echo ucwords(strtolower($operator)); ?></div></td>
				<td align="center"><?php echo $mulai; ?></td>
				<td align="center"><?php echo $selesai; ?></td>
				<td align="center"><?php echo $durasi; ?></td>
				<td align="center"><?php echo $kode; ?></td>
				<td align="right"><?php echo $qty_terima; ?></td>
				<td align="right"><?php echo $hasil; ?></td>
				<td align="right"><?php echo $reject; ?></td>
				<td align="right"><?php echo $sisa; ?></td>
				<td align="right"><?php echo number_format($bahan, $dec); ?></td>
				<td><?php echo $keterangan; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" name="<?php echo $id . '@' . $proses; ?>" title="Cetak Data" style="width: 50px;" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" name="<?php echo $id; ?>" title="Edit Data" style="width: 50px;" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td><button type="button" class="btn btn-block btn-danger btn-sm" name="<?php echo $id; ?>" title="Hapus Data" style="width: 50px;" onclick="hapus(this)" <?php if ($next_proses > 0) {echo 'hidden';} ?>><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<td colspan="13" align="center"><b>Total</b></td>
		<td align="right" class="font-weight-bold"><?php echo number_format($t_hasil, 0); ?></td>
		<td align="right" class="font-weight-bold"><?php echo number_format($t_waste, 0); ?></td>
		<td align="right" class="font-weight-bold"><?php echo number_format($t_sisa, 0); ?></td>
		<td align="right" class="font-weight-bold"><?php echo number_format($t_bahan, 2); ?></td>
		<td colspan="4"></td>
	</tfoot>
</table>