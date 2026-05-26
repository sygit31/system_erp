<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th hidden>Id Detail</th>
			<th width="5%">No.</th>
			<th width="10%">Pemilik Arsip</th>
			<th width="10%">Bagian</th>
			<th width="5%">Kode Rak</th>
			<th width="5%">Nomor Rak</th>
			<th width="10%">Nomor Box</th>
			<th width="10%">Tanggal Arsip</th>
			<th width="40%">Isi Box</th>
			<th width="5%">Retensi<br>(Tahun)</th>
			<th>Edit</th>
			<th>Ambil</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$id_detail = $dt['ID_DETAIL'];
			$nama = ucwords(strtolower($dt['NAMA']));
			$bagian = $dt['BAGIAN'];
			$kode_rak = $dt['KODE_RAK'];
			$nomor_rak = substr($kode_rak, 0, 2);
			$urut_box = $dt['URUT_BOX'];
			$kode_box = $dt['KODE_BOX'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$isi = str_replace("\n","<br>",$dt['ISI']);
			$retensi = $dt['RETENSI'];
			?>
			<tr>
				<td hidden><?php echo $id_detail; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $bagian; ?></td>
				<td align="center"><?php echo $kode_rak; ?></td>
				<td align="center"><?php echo $nomor_rak; ?></td>
				<td align="center"><?php echo $kode_box . '-' . $urut_box; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><div style="width:100%; height:150px; overflow-y: scroll;"><?php echo $isi; ?></div></td>
				<td align="center"><?php echo $retensi; ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-grad btn-sm" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-grad btn-sm" style="width: 50px;" title="Ambil Dokumen" onclick="hapus(this)"><i class="fa fa-download"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>