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
    <table>
        <tr>
            <td align="center" colspan="3" width="500">
                <b>SURAT PERINTAH LEMBUR</b>
            </td>
        </tr>

        <tr height = "15" />
      <!--   <tr>
            <td width="100">Bagian</td>
            <td>
                : <? //echo $bagian; ?>
            </td>
            <td />
        </tr>
        <tr>
            <td>Mulai</td>
            <td>
                : <? //echo $mulai; ?>
            </td>
            <td />
        </tr>
        <tr>
            <td>Selesai</td>
            <td>
                : <? //echo $selesai; ?>
            </td>
            <td />
        </tr>
        <tr>
            <td>Tujuan</td>
            <td>
                : <? //echo $tujuan; ?>
            </td>
            <td />
        </tr>

        <tr height = "15" />
        <tr>
            <td colspan="3">
                <table border="1">
                    <tr>
                        <th width="150">NIK</th>
                        <th width="200">Nama</th>
                        <th width="150">Total SPL bulan ini</th>
                    </tr>
                    <?php
                        // for ($i=0; $i < count($NIK); $i++) { 
                        //     print_r("
                        //         <tr>
                        //             <td>". $NIK[$i] ."</td>
                        //             <td>". $Nama[$i] ."</td>
                        //             <td>". $Total[$i] ."</td>
                        //         </tr>
                        //     ");
                        // }
                    ?>
                </table>
            </td>
        </tr> -->


        <tr>
            <td colspan="3">
                <table border="1">
                    <tr>
                        <th width="50">Bagian</th>
                        <th width="150">Nama</th>
                        <th width="100">Mulai</th>
                        <th width="100">Selesai</th>
                        <th width="75">Tujuan</th>
                        <th width="25">Status</th>
                    </tr>
                    <?php
                        for ($i=0; $i < count($bagian); $i++) { 
                            print_r("
                                <tr>
                                    <td>". $bagian[$i] ."</td>
                                    <td>". $nama[$i] ."</td>
                                    <td>". $mulai[$i] ."</td>
                                    <td>". $selesai[$i] ."</td>
                                    <td>". $tujuan[$i] ."</td>
                                    <td>". $status[$i] ."</td>
                                </tr>
                            ");
                        }
                    ?>
                </table>        
            </td>
        </tr>

        <tr height = "10" />
        <tr>
            <td colspan="3">
                <table>
                    <tr>
                        <td colspan="3">Kudus , .... - .... - 20....</td>
                    </tr>
                    <tr>
                        <td width="200">Hormat kami,</td>
                        <td width="100" />
                        <td width="200" align="center">Mengetahui,</td>
                    </tr>
                    <tr height = "50" />
                    <tr>
                        <td>......................</td>
                        <td />
                        <td align="center">Alf. Hendro</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>







	<script type="text/javascript">
        window.print();
    </script>

</body>
</html>