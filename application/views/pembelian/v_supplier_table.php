<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id Supplier</th>
			<th>No.</th>
			<th>Kode PO</th>
			<th>Jenis</th>
			<th>Nama Supplier</th>
			<th>Phone</th>
			<th>Fax</th>
			<th>Alamat</th>
			<th>Kota</th>
			<th>Kontak Person</th>
			<th>Title</th>
			<th>Pilih</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($supplier->result_array() as $dt):
			$urut++;
			$id = $dt['ID'];
			$kode = $dt['KODE'];
			$kode_keuangan = $dt['KODE_KEUANGAN'];
			$jenis = $dt['JENIS'];
			$nama = $dt['NAMA'];
			$phone = $dt['PHONE'];
			$fax = $dt['FAX'];
			$alamat = $dt['ALAMAT'];
			$kota = $dt['KOTA'];
			$contact = $dt['CONTACT'];
			$contact_title = $dt['CONTACT_TITLE'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $kode . '<br>' . $kode_keuangan; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $phone; ?></td>
				<td><?php echo $fax; ?></td>
				<td><?php echo $alamat; ?></td>
				<td><?php echo $kota; ?></td>
				<td><?php echo $contact; ?></td>
				<td><?php echo $contact_title; ?></td>
				<td><input type="radio" class="action" name="action" onclick="get_action(this)" style="cursor: pointer;"></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
