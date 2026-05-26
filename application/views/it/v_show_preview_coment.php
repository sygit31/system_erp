<div class="data_komen">

	<?php foreach ($komen->result_array() as $dt) {?>
		
		<div class="card">
			<div class="row ml-1 mt-1">
				<div class="col-md-1">
					<img src="<?php echo base_url() . "images/bank_data/assets/people.jpg"; ?>" class="img-circle" width="50" height="50">
				</div>
				<div class="col-md-10" align="right">
					<table style="text-align: right; font-family: aria-label;">
						<tr><th style="font-size: 12px;"><?php echo $dt['NAMA']; ?></th></tr>
						<tr><td style="font-size: 10px; color: #0303A7;"><?php echo $dt['TGL']; ?></td></tr>
						<tr><td style="font-size: 10px; color: #0303A7;"><?php echo $dt['JAM']; ?></td></tr>
					</table>
				</div>
			</div>
			<table>
				<tr><td class="table table-borderless text-justify p-1" style="font-size: 12px; text-align: left;"><?php echo $dt['NOTE']; ?></td></tr>
			</table>
		</div>

	<?php } ?>

</div>