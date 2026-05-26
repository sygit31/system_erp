<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID SIP</th>
			<th hidden>ID SIP Detail</th>
			<th hidden>ID Material</th>
			<th hidden>Kode</th>
			<th>No.</th>
			<th width="7.5%">Tanggal</th>
			<th>Nomor SIP</th>
			<th>Sifat</th>
			<th>Nama Pemesan</th>
			<th>Bagian</th>
			<th hidden>Jenis Bahan</th>
			<th>Nama Pesanan</th>
			<th>Satuan</th>
			<th>Qty</th>
			<th>Deadline</th>
			<th>Status</th>
			<th>Nomor PO</th>
			<th>Qty PO</th>
			<th>Qty Datang</th>
			<th>Kategori</th>
			<th>Close<br>(Tunai)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($filter->result_array() as $dt) :
			$urut = $urut + 1;
			$id_sip = $dt['ID_SIP'];
			$id_sip_detail = $dt['ID_SIP_DETAIL'];
			$id_material = $dt['ID_MATERIAL'];
			$kode = $dt['KODE'];
			$tanggal = date('d-M-Y', strtotime($dt['TANGGAL']));
			$no_sip = $dt['NO_SIP'];
			$sifat = $dt['SIFAT'];
			$nama_pemesan = $dt['NAMA_PEMESAN'];
			$bagian = ucwords(strtolower($dt['BAGIAN']));
			$jenis = $dt['JENIS'];
			$nama_material = $dt['NAMA_MATERIAL'] . ' ' . $dt['SPESIFIKASI'] . ' (' . $dt['NO_REKJURNAL'] . ')';
			$satuan = $dt['SATUAN'];
			$nomer_po = $dt['NOMER_PO'];
			$qty = str_replace(',', '.', $dt['QTY']);
			$qty_po = str_replace(',','.',$dt['QTY_PO']);
			$qty_datang = str_replace(',','.',$dt['QTY_DATANG']);
			$deadline = date('d-M-Y', strtotime($dt['DEADLINE']));
			$kategori = $dt['KATEGORI'];

			$outs = $qty - $qty_po;

			if ($qty_po == '0' || $outs > 0) {
				$status = 'Open';
			}else{
				$status = 'Close';
			}

			if (date('ymd') > date('ymd', strtotime($dt['DEADLINE'])) && $status == 'Open') {
				$warna = '#E60404';
			}else{
				$warna = '#030000';
			}

			?>
			<tr>
				<td hidden><?php echo $id_sip; ?></td>
				<td hidden><?php echo $id_sip_detail; ?></td>
				<td hidden><?php echo $id_material; ?></td>
				<td hidden><?php echo $kode; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tanggal; ?></td>
				<td><?php echo $no_sip; ?></td>
				<td align="center"><?php echo $sifat; ?></td>
				<td><?php echo $nama_pemesan; ?></td>
				<td><?php echo $bagian; ?></td>
				<td hidden><?php echo $jenis; ?></td>
				<td><?php echo $nama_material; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="right"><?php echo number_format($qty, 1); ?></td>
				<td align="center" style="color: <?php echo $warna; ?>"><?php echo $deadline; ?></td>
				<td align="center" style="color: <?php if ($status == 'Open') {echo 'red';} ?>;"><?php echo $status; ?></td>
				<td><?php echo $nomer_po; ?></td>
				<td align="right"><?php echo number_format($qty_po,1); ?></td>
				<td align="right"><?php echo $qty_datang; ?></td>
				<td><?php echo $kategori; ?></td>
				<td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="final(this)" <?php if ($status != 'Open') {echo "hidden";} ?>><i class="fa fa-money"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>