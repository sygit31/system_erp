<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID SIP Detail</th>
			<th hidden>ID SIP</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>No. SIP</th>
			<th>Sifat</th>
			<th>Nama Pemesan</th>
			<th>Jabatan</th>
			<th>Bagian</th>
			<th>Nama Pesanan</th>
			<th>Satuan</th>
			<th>Qty</th>
			<th>Deadline</th>
			<th>Qty PO</th>
			<th>Qty Datang</th>
			<th>Status</th>
			<th>Keterangan</th>
			<th>Kategori</th>
			<th>Cetak</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($sip->result_array() as $dt) :
			$urut = $urut + 1;
			$id_detail_sip = $dt['ID_DETAIL_SIP'];
			$id = $dt['ID'];
			$kd_unit = $dt['KD_UNIT'];
			$tanggal = date('d-M-Y', strtotime($dt['TANGGAL']));
			$no_sip = $dt['NO_SIP'];
			$sip_sakti_holo = $dt['SIP_SAKTI_HOLO'];
			$sip_sakti_perdana = $dt['SIP_SAKTI_PERDANA'];
			$sifat = $dt['SIFAT'];
			$nama_pemesan = $dt['NAMA_PEMESAN'];
			$jabatan = $dt['JABATAN'];
			$bagian = $dt['BAGIAN'];
			$nama_material = $dt['NAMA_MATERIAL'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$kode = $dt['KODE'];
			$satuan = $dt['SATUAN'];
			$keterangan = $dt['PERSEDIAAN'] . ' - ' . $dt['KETERANGAN'];
			$kategori = $dt['KATEGORI'];
			$qty = str_replace(',', '.', $dt['QTY']);
			$deadline = date('d-M-Y', strtotime($dt['DEADLINE']));
			$datang = str_replace(',', '.', $dt['DATANG']);
			$qty_po = str_replace(',', '.', $dt['QTY_PO']);
			$nmr_po = substr($dt['NMR_PO'],0,strlen($dt['NMR_PO'])-2);
			$final = $dt['FINAL'];
			$po = $dt['PO'];
			$toleransi = 10/100*$qty;

			// if ($final == '0' || $qty_po < ($qty-$toleransi)) {
			if ($final == '1' || $qty == $datang) {
				$status = 'Close';
				$color = 'black';
			}else{
				$status = 'Open';
				$color = 'red';
			}
			if ($nmr_po != '') {$status = 'PO Number : ' . $nmr_po;}

			if ($tanggal < date('d-M-Y',strtotime('-14 days'))) {
				// $po = '1';
			}

				// Cek Upload Sakti
			if ($kd_unit == '12') {
				$nomor_sip = $sip_sakti_holo;
			}else{
				$nomor_sip = $sip_sakti_perdana;
			}

			?>
			<tr>
				<td hidden><?php echo $id_detail_sip; ?></td>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tanggal; ?></td>
				<td><?php echo $no_sip; ?></td>
				<td align="center"><?php echo $sifat; ?></td>
				<td><?php echo $nama_pemesan; ?></td>
				<td><?php echo $jabatan; ?></td>
				<td><?php echo $bagian; ?></td>
				<td><?php echo $nama_material . ' -- ' . $spesifikasi . ' (' . $kode . ')'; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="center"><?php echo number_format($qty,1); ?></td>
				<td align="center"><?php echo $deadline; ?></td>
				<td align="center"><?php echo number_format($qty_po,1); ?></td>
				<td align="center"><?php echo number_format($datang,1); ?></td>
				<td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td><?php echo $kategori; ?></td>
				<td>
					<button type="button" class="btn btn-block btn-success btn-sm" title="Print Data" onclick="cetak(this)" <?php if ($status == 'Close' || $nomor_sip == '') {echo "hidden";} ?>><b><i class="fa fa-print"></i>
					</button>
				</td>
				<td>
					<button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)" <?php if ($po != 0) {echo "hidden";} ?>><b><i class="fa fa-check-square-o"></i>
					</button>
				</td>
				<td>
					<button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="batal(this)" <?php if ($po != 0) {echo "hidden";} ?>><b><i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>