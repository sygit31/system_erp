<!DOCTYPE>
<html>
<head>
	<title>Cetak Label</title>
	<style type="text/css">
		@media print{@page {size: portrait;}}
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
		foreach ($cetak as $key => $value) { 
	?>

	<!-- ============================================================================================================ -->

		<div style="page-break-before: always">
			<br />
			<br />
			<br />
			<table border="1">
				<tr><td>

					<table border="1">
						<tr valign="center" height="80">
					        <td width="550" align="center" 
					        <?php
					        	if ($value[7] == '1') {print_r("style='background-color: green;color: white;'");}
					        	if ($value[7] == '2') {print_r("style='background-color: gold;'");}
					        	if ($value[7] == '3') {print_r("style='background-color: red;'");}
					        ?>
					        ><font size="11"><b><?php echo $value[0]; ?></b></font></td>
				        </tr>
					</table>

					<br />

					<font size="8">
						<table> 
					        <tr valign="center">
					          	<td width="100">&nbsp &nbsp &nbsp &nbsp &nbsp Tanggal</td>
					          	<td width="20" align="center">:</td>
					          	<td width="410"><?php echo "(IN) ".$value[1]." / (QC) ".$value[2]; ?></td>
					        </tr>
					        <tr valign="center">
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Nama</td>
					          	<td align="center">:</td>
					          	<td><?php echo $value[3]; ?></td>
					        </tr>
					        <tr valign="center">
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Tahun</td>
					          	<td align="center">:</td>
					          	<td><?php echo $value[4]; ?></td>
					        </tr>
					        <tr>
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Panjang</td>
					          	<td align="center">:</td>
					          	<td><?php echo $value[5]; ?> Meter</td>
					        </tr>
					        <tr>
					          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Barcode</td>
					          	<td align="center">:</td>
					          	<td><?php echo $value[6]; ?></td>
					        </tr>
						</table>
					</font>

					<br />
				</td></tr>
			</table>
			<!-- <br /> -->

		</div>

	


	<!-- ============================================================================================================ -->

	<?php 
		} 
	?>



	<script type="text/javascript">
        window.print();
    </script>

</body>
</html>