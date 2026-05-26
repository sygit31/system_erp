<div class="data-table">
	<?php $filter = ""; ?>

	<?php foreach ($data->result_array() as $dt):

		if ($filter != $dt['TAHUN'] . $dt['JENIS'] . $dt['KATEGORI'] . $dt['SUB_KATEGORI']) { ?>

			<?php $ext = strtoupper(pathinfo($dt['NAMA_FILE'], PATHINFO_EXTENSION)); ?>
			<?php $nama_file = base_url() . "images/bank_data/" . $dt['ID_DATA'] . '.' . $ext; ?>

			<?php if ($ext == 'PPT' || $ext == 'PPTX') {$nama_file = base_url() . "images/bank_data/assets/ppt.jpg";} ?>
			<?php if ($ext == 'PDF') {$nama_file = base_url() . "images/bank_data/assets/pdf.jpg";} ?>

			<div class="box">
				<img style="cursor: pointer; border-radius: 20px;" name="album" onclick="view_album(this)" src="<?php echo $nama_file ?>" width="100%" height="100%">
				<input type="text" name="id_album" value="<?php echo $dt['ID_DATA'] ?>" hidden>
				<span class="keterangan"><?php echo $dt['SUB_KATEGORI'] . ' ' . $dt['TAHUN']; ?></span>
			</div>

		<?php } ?>

		<?php
		$filter = $dt['TAHUN'] . $dt['JENIS'] . $dt['KATEGORI'] . $dt['SUB_KATEGORI'];
		?>

	<?php endforeach; ?>
</div>

