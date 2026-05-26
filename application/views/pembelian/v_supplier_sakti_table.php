<table id="tbl_supplier" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
	<thead>
		<tr align="center">
			<th>Pilih</th>
			<th>No</th>
			<th>Kode</th>
			<th>Nama Supplier</th>
			<th>Telepon</th>
			<th>Email</th>
			<th>Fax</th>
			<th>Kontak Person</th>
			<th>NPWP</th>
			<th>Alamat</th>
			<th>Kota</th>
			<th>Negara</th>
			<th>Kode Pos</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($supplier_sakti->result_array() as $dt) :
			$urut++;
			$kode = $dt['KODE'];
			$supplier = $dt['NAMA'];
			$telp = $dt['TELEPON'];
			$email = $dt['EMAIL_KEU'];
			$fax = $dt['FAX'];
			$person = $dt['CNT_PERSON'];
			$npwp = $dt['NPWP'];
			$alamat = $dt['ALAMAT'];
			$kota = $dt['KOTA'];
			$negara = $dt['NEGARA'];
			$kode_pos = $dt['KODE_POS'];
			?>
			<tr>
				<td align="center"><button onclick="pilih_supplier_sakti(this)" type="button" class="btn btn-block btn-warning btn-sm" title="Pilih Supplier"><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $kode; ?></td>
				<td><?php echo $supplier; ?></td>
				<td><?php echo $telp; ?></td>
				<td><?php echo $email; ?></td>
				<td><?php echo $fax; ?></td>
				<td><?php echo $person; ?></td>
				<td><?php echo $npwp; ?></td>
				<td><?php echo $alamat; ?></td>
				<td><?php echo $kota; ?></td>
				<td><?php echo $negara; ?></td>
				<td><?php echo $kode_pos; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>