<!DOCTYPE>
<html>
<head>
	<title>Cetak Label</title>
	<style type="text/css">
		/* @media print{@page {size: portrait;}} */
		@media print{@page {size: landscape;}}
	</style>
</head>
<body>
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->

	<?php 
		// $nomer = 0;
		// foreach ($cetak as $key => $value) { 
		// 	$nomer ++;
		// 	if ($nomer == 1) {
		// 		print_r("<table style='page-break-before: always'>");
		// 	}

		// 	if ($nomer == 1 || $nomer == 3 || $nomer == 5) {
		// 		print_r("<tr>");
		// 	}
	?>


	<!-- ============================================================================================================ -->

			<?php //print_r("<td width='500'>"); ?>
				<!-- <br />
		
				<table border="1">
					<tr><td>

						<table border="1">
							<tr valign="center">
						        <td width="450" align="center" 
						        <?php
						        	//if ($value[7] == '1') {print_r("style='background-color: green;color: white;'");}
						        	//if ($value[7] == '2') {print_r("style='background-color: gold;'");}
						        	//if ($value[7] == '3') {print_r("style='background-color: red;'");}
						        ?>
						        ><font size="9"><b><?php //echo $value[0]; ?></b></font></td>
					        </tr>
						</table>

						<br />

						<font size="6">
							<table> 
						        <tr valign="center">
						          	<td width="100">&nbsp &nbsp &nbsp &nbsp &nbsp Tanggal</td>
						          	<td width="20" align="center">:</td>
						          	<td width="310"><?php //echo "(IN) ".$value[1]." / (QC) ".$value[2]; ?></td>
						        </tr>
						        <tr valign="center">
						          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Nama</td>
						          	<td align="center">:</td>
						          	<td><?php //echo $value[3]; ?></td>
						        </tr>
						        <tr valign="center">
						          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Tahun</td>
						          	<td align="center">:</td>
						          	<td><?php //echo $value[4]; ?></td>
						        </tr>
						        <tr>
						          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Panjang</td>
						          	<td align="center">:</td>
						          	<td><?php //echo $value[5]; ?> Meter</td>
						        </tr>
						        <tr>
						          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Barcode</td>
						          	<td align="center">:</td>
						          	<td><?php //echo $value[6]; ?></td>
						        </tr>
							</table>
						</font>

						<br />
					</td></tr>
				</table> -->
					
				<!-- <br /> -->
			<?php //print_r("</td>"); ?>

	<!-- ============================================================================================================ -->

	<?php 
		// if ($nomer == 2 || $nomer == 4 || $nomer == 6) {
		// 		print_r("</tr>");
		// 	}

		// 	if ($nomer == 6) {
		// 		print_r("</table>");
		// 		$nomer = 0;
		// 	}
		// } 
	?>

	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->

	<?php 
		//foreach ($cetak as $key => $value) { 
	?>

	<!-- ============================================================================================================ -->

		<!-- <div style="page-break-before: always">
			<br />
			<br />
			<br />
			<table border="1">
				<tr><td>

					<table border="1">
						<tr valign="center" height="80">
					        <td width="550" align="center" 
					        <?php
					        	// if ($value[7] == '1') {print_r("style='background-color: green;color: white;'");}
					        	// if ($value[7] == '2') {print_r("style='background-color: gold;'");}
					        	// if ($value[7] == '3') {print_r("style='background-color: red;'");}
					        ?>
					        ><font size="11"><b><?php //echo $value[0]; ?></b></font></td>
				        </tr>
					</table>

					<br />

					<font size="8">
						<table> 
					        <tr valign="center">
					          	<td width="100">&nbsp &nbsp &nbsp &nbsp &nbsp Tanggal</td>
					          	<td width="20" align="center">:</td>
					          	<td width="410"><?php //echo "(IN) ".$value[1]." / (QC) ".$value[2]; ?></td>
					        </tr>
					        <tr valign="center">
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Nama</td>
					          	<td align="center">:</td>
					          	<td><?php //echo $value[3]; ?></td>
					        </tr>
					        <tr valign="center">
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Tahun</td>
					          	<td align="center">:</td>
					          	<td><?php //echo $value[4]; ?></td>
					        </tr>
					        <tr>
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Panjang</td>
					          	<td align="center">:</td>
					          	<td><?php //echo $value[5]; ?> Meter</td>
					        </tr>
					        <tr>
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Barcode</td>
					          	<td align="center">:</td>
					          	<td><?php //echo $value[6]; ?></td>
					        </tr>
						</table>
					</font>

					<br />
				</td></tr>
			</table>

		</div> -->

			<table>
				<tr>
					<td colspan="2" align="center">
						<font size="6"><b>Form Pengajuan Kinerja</b></font>
					</td>
				</tr>
				<tr height="20">
					<td colspan="2" />
				</tr>
				<tr>
					<td colspan="2">


						<table id="example2" class="table table-bordered table-striped" border="1">
							<thead>
							<tr align="center" height = "30" valign="center">
								<th width="60">Bagian</th>
								<th width="80">Nama</th>
								<th width="80">PIC</th>
								<th width="190">Project</th>
								<th width="100">Tugas</th>
								<th width="80">Target (%)</th>
								<th width="40">Nilai</th>
								<th width="40">Approve</th>
							</tr>
							</thead>
							<tbody>

							<?php foreach($cetak as $value){ ?>
								<tr>
								<?php
									$i=0;
									foreach ($value as $row) {
										if ($i == '5' || $i == '6' || $i == '0') {
											print_r(
												'<td align="center">'.$row.'</>'
											);
										}else{
											print_r(
												'<td>'.$row.'</>'
											);
										}

										$i += 1;
									}
									
									print_r(
										'<td align="center">...</td>'
									);
								?>
								</tr>
							<?php } ?>

							</tbody>
						</table>

					</td>
				</tr>
				<tr height="20">
					<td />
					<td />
				</tr>
				<tr>
					<td width="800" />
					<td>
						<table align="center">
							<tr>
								<td align="center">
									Management
								</td>
							</tr>
							<tr height="50">
								<td />
							</tr>
							<tr>
								<td align="center">
									............................
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>	

			

	<!-- ============================================================================================================ -->

	<?php 
		//} 
	?>



	<script type="text/javascript">
        window.print();
    </script>

</body>
</html>