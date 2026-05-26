<!DOCTYPE>
<html>

<head>
	<title>Cetak Label</title>
	<style type="text/css">
		/* @media print{@page {size: portrait;}} */
		@media print {
			@page {
				/* size: landscape; */
				size: portrait;
			}
		}
	</style>
</head>

<body>
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->
	<!-- ============================================================================================================ -->



	<table >
		<tr>
			<td colspan="3" align="center">
				<font size="6"><b>Form Monitoring</b></font>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center">
				Tanggal : .... / .... / 20....
			</td>
		</tr>
		<tr height="20"/>
		<tr>
			<td colspan="3">

				<table >
					<?php
					foreach ($cetak as $value) {
						$id_tugas = 0;
						$i = 0;
						foreach ($value as $row) {
							if ($i == 0) {
								$id_tugas = $row;
							}

							if ($i == 1) {
								print_r("
									<tr>
										<td width='100'>Bagian</td>
										<td width='10'>:</td>
										<td>$row</td>
									</tr>
								");
							}

							if ($i == 2) {
								print_r("
									<tr>
										<td>Nama</td>
										<td>:</td>
										<td><b><i>$row</i></b></td>
									</tr>
								");
							}

							if ($i == 3) {
								print_r("
									<tr>
										<td>PIC</td>
										<td>:</td>
										<td>$row</td>
									</tr>
								");
							}

							if ($i == 4) {
								print_r("
									<tr>
										<td>Project</td>
										<td>:</td>
										<td>$row</td>
									</tr>
								");
							}

							if ($i == 5) {
								print_r("
									<tr>
										<td>Tugas</td>
										<td>:</td>
										<td><b><i>$row</i></b></td>
									</tr>
								");
							}
							$i += 1;
						}


						print_r("
						<tr height='5' />
						<tr>
							<td colspan='2' />
							<td>
								<table border='1'>
									<tr>
										<th width='300px'>Parameter</th>
										<th>Progress (%)</th>
										<th width='200px'>Catatan</th>
									<tr>");
									
									foreach ($dataParameter as $xxx) {
										if ($xxx->ID_TUGAS == $id_tugas) {
											print_r("
												<tr>
													<td>". $xxx->PARAMETER ."</td>
													<td align='center'>...</td>
													<td align='center'>...</td>
												</tr>
											");
										}
									}
						
						print_r("</table>
							</td>
						</tr>
						<tr height='20' />
						");

					}
					?>
				</table>
			</td>
		</tr>
		<tr height="20"/>
		<tr>
			<td>
				<table align="center">
					<tr>
						<td align="center">
							<b>Tim Monitor</b>
						</td>
					</tr>
					<tr height="50"/>
					<tr>
						<td align="center">
							............................
						</td>
					</tr>
				</table>
			</td>
			<td width="200" />
			<td>
				<table align="center">
					<tr>
						<td align="center">
							<b>Management</b>
						</td>
					</tr>
					<tr height="50"/>
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



	<script type="text/javascript">
		window.print();
	</script>

</body>

</html>