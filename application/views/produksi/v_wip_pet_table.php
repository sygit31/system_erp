<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID</th>
			<th>No.</th>
			<th>Desain</th>
			<th>Tanggal</th>
			<th>Nomor KK</th>
			<th>Seri</th>
			<th>Nomor Mutasi</th>
			<th>Nomor IPB</th>
			<th>Kode Bahan</th>
			<th>Panjang</th>
			<th>Cetak</th>
			<th>IPB</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($filter->result_array() as $dt) :
			$urut++;
			$id = $dt['ID'];
			$desain = substr($dt['TGL'],-4);
			$tgl = date('d-M-Y',strtotime($dt['TGL']));
			$kk = $dt['KK'];
			$seri = $dt['SERI'];
			$nmr_mutasi = $dt['NMR_MUTASI'];
			$nmr_ipb = $dt['NMR_IPB'];
			$kode = $dt['KODE'];
			$panjang = $dt['PANJANG'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $kk; ?></td>
				<td align="center"><?php echo $seri; ?></td>
				<td><?php echo $nmr_mutasi; ?></td>
				<td><?php echo $nmr_ipb; ?></td>
				<td align="center"><?php echo $kode; ?></td>
				<td align="right"><?php echo number_format($panjang); ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" title="Cetak Data" onclick="cetak(this)" <?php if($nmr_ipb=='') {echo "hidden";} ?>><i class="fa fa-print"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-success btn-sm" title="Simpan IPB" onclick="ipb(this)" <?php if($nmr_ipb!='') {echo "hidden";} ?>><i class="fa fa-send-o"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>