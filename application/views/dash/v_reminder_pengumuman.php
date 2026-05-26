<table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 12px;">
	<thead>
		<tr align="center">
			<th colspan="8"><h3>PENGUMUMAN</h3></th>
		</tr>
	</thead>
</table>

<?php 
$content = array();
foreach ($isi_box->result_array() as $dt) {
	$content[] = $dt['CONTENT'];
}
?>

<div class="inner bg-light">
	<p align="justify" style="font-size: 40px; text-indent: 100px;"><?php echo $content[2]; ?></br></p>
</div>