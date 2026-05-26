<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center" style="font-weight: bold; background-color: #D9D9D9;">
			<td width="2%"><input type="checkbox" id="pilih" onclick="pilih_semua(this)" style="cursor: pointer;"><i class="fa fa-arrow-down"></i></td>
			<td width="10%">Preview</td>
			<td width="5%">No.</td>
			<td width="10%">Kategori</td>
			<td width="10%">Sub Kategori</td>
			<td width="10%">Tahun</td>
			<td width="15%">Pemilik Dokumen</td>
			<td width="10%">Jenis</td>
			<td width="25%">Judul File</td>
			<td hidden>ID Data</td>
			<td>View</td>
			<td>Unduh</td>
			<td <?php if($_SESSION['akses'] == '1') {echo 'hidden';} ?> hidden>Approve</td>
			<td hidden>Nama File</td>
			<td hidden>Ext.</td>
			<td>Edit</td>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;

		foreach ($data->result_array() as $dt):
			$urut++;
			$karyawan = $dt['KARYAWAN'];
			$tahun = $dt['TAHUN'];
			$jenis = $dt['JENIS'];
			$nama_file = $dt['NAMA_FILE'];
			$kategori = $dt['KATEGORI'];
			$sub_kategori = $dt['SUB_KATEGORI'];
			$id_data = $dt['ID_DATA'];
			$ext = $dt['EXT'];
			$aktif = $dt['AKTIF'];
			$file = base_url() . "images/bank_data/" . $id_data . '.' . $ext;
			?>
			<tr>
				<td><input type="checkbox" name="pilih" onclick="pilih_satu()" style="cursor: pointer;"></td>
				<td>
					<img class="img-thumbnail" src="<?php if ($ext != 'JPG') {echo base_url() . "images/bank_data/assets/no_preview.jpg";}else{echo $file;} ?>" onclick="preview_tabel(this)" data-toggle="modal" data-target="#modal_image" title="Lihat Thumbnail" name="<?php echo $file; ?>">
				</td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo trim($kategori); ?></td>
				<td><?php echo trim($sub_kategori); ?></td>
				<td align="center"><?php echo $tahun; ?></td>
				<td><?php echo $karyawan; ?></td>
				<td><?php echo trim($jenis); ?></td>
				<td><?php echo $nama_file; ?></td>
				<td hidden><?php echo $id_data; ?></td>
				<td align="center"><button type="button" class="btn btn-info" onclick="preview(this)" title="Buka" name="<?php echo $id_data . '.' . $ext; ?>"><i class="fa fa-tv"></i></button></td>
				<td align="center"><button type="button" class="btn btn-success" onclick="download(this)" title="Download"><i class="fa fa-download"></i></button></td>
				<a id="my_download" href="" download></a>
				<td <?php if($_SESSION['akses'] == '1') {echo 'hidden';} ?> hidden><button type="button" class="btn btn-warning" onclick="approve(this)" <?php if($aktif == '2') {echo 'hidden';} ?> title="Approve"><i class="fa fa-check-square-o"></i></button></td>
				<td hidden><?php echo $file; ?></td>
				<td hidden><?php echo $ext; ?></td>
				<td align="center"><button type="button" class="btn btn-secondary" onclick="edit(this)" title="Edit Data" name="<?php echo $id_data; ?>"><i class="fa fa-edit"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
