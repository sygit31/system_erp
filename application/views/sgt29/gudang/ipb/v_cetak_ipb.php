<!DOCTYPE>
<html>
<head>
	<title>Cetak Label</title>
	<style type="text/css">
		@media print{
			@page {
				size: portrait;
				};
			}

			/* body { */
				/* transform: scale(.5); */
				/* zoom:50%; */
				/* } */
	</style>

	<!-- <style type="text/css" media="print">
	    .page
	    {
	     -webkit-transform: rotate(-90deg); 
	     -moz-transform:rotate(-90deg);
	     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
	    }
	</style> -->

		<!-- <style type="text/css" media="print">
		    @page { 
		        size: portrait;
		    }
		    body { 
		        writing-mode: tb-rl;
		    }
		</style> -->
</head>
<body>
    
    <table style="font-weight: bold;font-size: 13px;">
        <tr>
            <td width="300" align="center">PT. PURA NUSAPERSADA</td>
        </tr>
        <tr>
            <td align="center">KUDUS</td>
        </tr>
    </table>

    <br />

    <table style="font-weight:bold;">
        <tr>
            <td width="700" align="center">IJIN PENGELUARAN BARANG PET</td>
        </tr>
        <tr>
            <td align="center"><?php echo  $data_cetak[0]->NOMER; ?></td>
        </tr>
    </table>

    <br />

    <table>
        <tr>
            <td width="50">Tanggal</td>
            <td width="10"> : </td>
            <td><?php echo $data_cetak[0]->TANGGAL; ?></td>
        </tr>
        <tr>
            <td>Seri</td>
            <td> : </td>
            <td><?php echo $data_cetak[0]->SERI; ?></td>
        </tr>
        <tr>
            <td>KK</td>
            <td> : </td>
            <td><?php echo $data_cetak[0]->NO_KK; ?></td>
        </tr>
    </table>

    <table>
        <tr><td>
        <table border="1" style="border-collapse: collapse;">
            <tr align="center">
                <td width="30">No.</td>
                <td width="350">Nama Barang</td>
                <td width="180">Kode Roll</td>
                <td width="140">Panjang (Meter)</td>
            </tr>
            <!-- looping barang -->
            <?php
                $nomer = 0;
                $total = 0;
                foreach ($data_cetak as $xxx) {
                    $nomer += 1;
                    $total += $xxx->QTY_TERIMA;
                    print_r("
                        <tr>
                            <td align='center'>". $nomer ."</td>
                            <td>". $xxx->NAMA ." ". $xxx->SPESIFIKASI ."</td>
                            <td align='center'>". $xxx->KODE_ROLL ."</td>
                            <td align='right'>". number_format($xxx->QTY_TERIMA,0,",",".") ."</td>
                        </tr>
                    ");
                }
            ?>

            <tr>
                <td align="right" colspan="3">Total : </td>
                <td align="right"><?php echo number_format($total,0,",","."); ?></td>
            </tr>
        </table>
        </tr></td>
        <tr><td align="right" style="font-size: 10px;">
            F-SMT-G2-011 Rev.1
        </tr></td>
    </table>


    <br />
    <br />

    <table style="border-collapse: collapse;">
        <tr>
            <td width="160" align="center">Yang Meminta</td>
            <td width="30" />
            <td width="160" align="center">Yang Memberi</td>
            <td width="30" />
            <td width="160 " align="center">Mengetahui</td>
            <td width="20" />
            <td width="140 " align="right" rowspan="4">
                <table border="1" style="border-collapse: collapse;">
                    <tr>
                        <td width="140" align="center"><i>Verifikator</i></td>
                    <tr>
                    <tr height="50"><td /></tr>
                    <tr>
                        <td align="center"><i>Ulil Albab</i></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td align="center">Bag. Emboss</td>
            <td />
            <td align="center">Bag. Gudang</td>
            <td />
            <td />
            <td />
        </tr>
        <tr height="50" />
        <tr>
            <td align="center"><b>( <?php 
			if($data_cetak[0]->PENERIMA == ""){
				echo "................"; 
			}else{
				echo $data_cetak[0]->PENERIMA;
			}
			?> )</b></td>
            <td />
            <td align="center"><b>( <?php 
				//echo $data_cetak[0]->PEMBERI; 
				if($data_cetak[0]->PEMBERI == ""){
					echo "................"; 
				}else{
					echo $data_cetak[0]->PEMBERI;
				}
			?> )</b></td>
            <td />
            <td align="center"><b>( <?php 
				//echo $data_cetak[0]->PENGAWAS; 
				if($data_cetak[0]->PENGAWAS == ""){
					echo "................"; 
				}else{
					echo $data_cetak[0]->PENGAWAS;
				}
			?> )</b></td>
            <td />

        </tr>
    </table>

	<script type="text/javascript">
        window.print();
    </script>

</body>
</html>