<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead align="center" style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
		<tr align="center">
			<th hidden></th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>No. Serah Terima</th>
			<th>Jenis PCH</th>
			<th>No. Register</th>
			<th>IPB</th>
			<th>KK</th>
			<th>Seri</th>
			<th>Kondisi</th>
			<th>Keterangan</th>
			<th><?php if ($status_menu == '1') {echo "Cetak";}else{echo "Approve";} ?></th>
			<th>Batal</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;

		foreach ($reject->result_array() as $dt) :
			$urut = $urut + 1;
			$id = $dt['ID'];
			$tgl = $dt['TGL'];
			$nmr = $dt['NMR'];
			$jenis = $dt['NAMA'];
			$ipb = $dt['NO_IPB'];
			$kk = $dt['NO_KK'];
			$seri = $dt['SERI'];
			$no_reg = $dt['NO_REG'];
			$kondisi = $dt['KONDISI'];
			$keterangan = $dt['KETERANGAN'];
			$status = $dt['STATUS'];
			?> 
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nmr; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $no_reg; ?></td>
				<td><?php echo $ipb; ?></td>
				<td><?php echo $kk; ?></td>
				<td><?php echo $seri; ?></td>
				<td><?php echo $kondisi; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td>
					<button type="button" class="btn btn-block btn-success btn-sm" title="Print" onclick="cetak(this)" <?php if ($status_menu != '1') {echo "";} ?>><i class="fa fa-print"></i></button>
					<button type="button" class="btn btn-block btn-success btn-sm" title="Approve" onclick="approve(this)" <?php if ($status == '2' || $status_menu != '2') {echo "hidden";} ?>><i class="fa fa-send-o"></i></button>
				</td>
				<td>
					<button type="button" class="btn btn-block btn-danger btn-sm" title="Batal Reject" onclick="hapus(this)" <?php if ($status == '2') {echo "hidden";} ?>><i class="fa ion-trash-a"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>