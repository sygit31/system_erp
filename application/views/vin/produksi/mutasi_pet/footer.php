<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>




<script type="text/javascript">
	id_mutasi='';

	
	$(document).ready(function() {  
		
		$("#cmbKK").select2();
		$("#cmbNamaPengirim").select2();
		$("#cmbNamaPenerima").select2();
		$('#txtTanggal').Zebra_DatePicker({
			direction: 0,
		    // pair: $('#tanggal_selesai'),
		    format: 'd-m-Y'
		});

		$('#tanggalAwal').Zebra_DatePicker({
			direction: 0,
			pair: $('#tanggalAkhir'),
			format: 'd-m-Y'
		});

		$('#tanggalAkhir').Zebra_DatePicker({
			direction: 0,
		    // pair: $('#tanggal_selesai'),
		    format: 'd-m-Y'
		});
	} );
	
	 // $("#modal-preview").draggable({
      //  handle: ".card-header"
    //});
    
    function formatNumber(num) {
    	if (num == 0) {
    		return '';
    	} else {
    		return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    	}
    }
    
    function isi_tabel(get_roll) {
		//var total_bon = 0;
		$('#tblBarang').DataTable().destroy();
		$("#tblBarang tbody" ).find("tr").remove();
		
		for (var i = 0; i < get_roll.length; i++) {
			
		//alert(data_no_mutasi[i].SHIFT);
		kode_roll=get_roll[i].KODE;
		nama_barang=get_roll[i].NAMA;
		jumlah=get_roll[i].HASIL;
		id_mutasi=get_roll[i].ID;
		qty_roll=get_roll[i].QTY_ROLL;
		//alert(kode_roll);

		$("#tblBarang tbody").append('<tr class="row-select"><td align="center"><input type="checkbox" name="pilih_roll"  name="pilih_roll"  class="checkBoxItem" style="cursor: pointer;"  onclick="update_jumlah()"></td><td hidden class="select_id">' + id_mutasi + '</td><td align="center" class="select_kode">' + kode_roll + '</td><td align="center" class="select_nama">' + nama_barang + '</td><td align="center" class="select_qty">' + qty_roll + '</td><td align="center" class="select_meter">' + jumlah + '</td></tr>');	  
	}  	
}

function isi_tabel_mutasi(get_roll) {
		//var total_bon = 0;
		$('#tblMutasi').DataTable().destroy();
		$("#tblMutasi tbody" ).find("tr").remove();
		var n=1;
		for (var i = 0; i < get_roll.length; i++) {
			
		//alert(get_roll[i].TGL);
		tanggal=get_roll[i].TGL;
		kk=get_roll[i].KK;
		no_mutasi=get_roll[i].NOMOR_MUTASI;
		seri=get_roll[i].SERI;
		proses_awal=get_roll[i].DARI;
		proses_akhir=get_roll[i].KE;
		total=get_roll[i].TOTAL;
		//alert(total);
		button='<button type="button" class="btn btn-warning btn-sm" id="btnPreview"  style="font-weight: bold;" title="Informasi Lebih" onclick="get_action(this)"><i class="fa ion-clipboard m-2"></i><b>Detail</b></button>'
		button2='<button type="button" class="btn btn-info btn-sm" id="btnEdit"  style="font-weight: bold;" title="Edit Data" onclick="edit_data(this)"><i class="fa fa-archive m-2"></i><b>Edit</b></button>'  
		button3='<button type="button" class="btn btn-success btn-sm" id="btnExcel"  style="font-weight: bold;" title="Export Excel" onclick="export_excel_data(this)"><i class="fa fa-cut m-2"></i><b>Excel</b></button>'  
		button4='<button type="button" class="btn btn-dark btn-sm" id="btnGabung"  style="font-weight: bold;" title="Gabung Roll" onclick="gabung_roll(this)"><i class="fa fa-bars m-2"></i><b>Gabung Roll</b></button>'  
		if(proses_awal !='Belah')
		{
		$("#tblMutasi tbody").append('<tr><td align="center">' + formatNumber(n) + '</td><td align="center">' + tanggal + '</td><td align="center">' + kk + '</td><td align="center">' + no_mutasi + '</td><td align="center">' + seri + '</td><td align="center">' + proses_awal + '</td><td align="center">' + proses_akhir + '</td><td align="center">' + total + '</td><td align="center">' + button + '&nbsp;&nbsp;  ||  '+ button2 +'&nbsp;&nbsp;  ||  '+ button3 +'&nbsp;&nbsp;</td></tr>');	  
		}
		else
		{
			$("#tblMutasi tbody").append('<tr><td align="center">' + formatNumber(n) + '</td><td align="center">' + tanggal + '</td><td align="center">' + kk + '</td><td align="center">' + no_mutasi + '</td><td align="center">' + seri + '</td><td align="center">' + proses_awal + '</td><td align="center">' + proses_akhir + '</td><td align="center">' + total + '</td><td align="center">' + button + '&nbsp;&nbsp;  ||  '+ button2 +'&nbsp;&nbsp;  ||  '+ button3 +'&nbsp;&nbsp; || '+ button4 +'&nbsp;&nbsp; </td></tr>');	
		}
		n=n+1;
	}  	
}

function simpan_hasil() {
	var qty_data = tblBarang.rows.length;
	  //alert(qty_data);
	  var nomor_mutasi = document.getElementById('txtNomer').value;
	  var tgl_mutasi = document.getElementById('txtTanggal').value;
	  var seri = document.getElementById('txtSeri2').value;
	  var nomor_urut = document.getElementById('txtNoUrut').value;
	  var desain = document.getElementById('cmbDesain').value;
	  var jenis = document.getElementById('txtJenis').value;
	  var pengirim = document.getElementById('cmbNamaPengirim').value;
	  var penerima = document.getElementById('cmbNamaPenerima').value;
	  
	  var station_awal = document.getElementById('cmbProsesAwal').value;
	  var station_akhir = document.getElementById('txtProsesAkhir').value;
      //alert (pengirim);
	  if(pengirim == penerima)
	  {
	  	alert('Nama Pengirim dan Nama Penerima tidak bole sama');
	  	exit;
	  }
	  if(pengirim == '0')
	  {
	  	alert('Nama Pengirim tidak boleh kosong');
	  	exit;
	  }
	  
	    if(penerima == '0')
	  {
	  	alert('Nama Penerima tidak boleh kosong');
	  	exit;
	  } 
	 else 
      {
	  for (var i = 0; i < qty_data - 1; i++) {
	  	var status = document.getElementsByName('pilih_roll')[i].checked;
			//alert(status);
			if (status == true) {
				id_mutasi=tblBarang.rows[i + 1].cells[1].innerHTML;
				var data = [nomor_mutasi,tgl_mutasi,id_mutasi,seri,nomor_urut,desain,jenis,station_awal,station_akhir,pengirim,penerima]; 
			//alert(id_mutasi);
			$.ajax({
				data:{data:data},
				type: 'POST',
				url: '<?php echo site_url('vin/produksi/mutasi_pet/simpan_mutasi');?>',
				success: function(data) {
					console.log(data);
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
					}, 500);
				}
			});
          } //if  status true
      }
	}
  }

  
  
  function get_action(btn) {
  	var data_table = document.getElementById('tblMutasi');
  	var row = $(btn).closest("tr").index() + 1;
		//alert(row);
		id_mutasi = data_table.rows[row].cells[3].innerHTML;
		var tanggal = data_table.rows[row].cells[1].innerHTML;
		kk = data_table.rows[row].cells[2].innerHTML;
		//alert (id_mutasi);
		//alert(tanggal);
		//alert(kk);
		var data = [id_mutasi,tanggal,kk];
		$.ajax({
			data:{data:data},
			type: 'POST',
			url: '<?php echo site_url('vin/produksi/mutasi_pet/getDetailMutasi');?>',
			success: function(data) {
				console.log(data);
				
				$('#modal_preview').click();
				data = JSON.parse(data);
				datas=data[0];
				show_preview(datas);
				
				
			}
		});
	}

	function export_excel_data(btn) {
		var data_table = document.getElementById('tblMutasi');
		var row = $(btn).closest("tr").index() + 1;
		//alert(row);
		id_mutasi = data_table.rows[row].cells[3].innerHTML;
		var tanggal = data_table.rows[row].cells[1].innerHTML;
		var kk = data_table.rows[row].cells[2].innerHTML;
		//alert (id_mutasi);
		//alert(tanggal);
		var data = [id_mutasi,tanggal,kk];
		$.ajax({
			data:{data:data},
			type: 'POST',
			url: '<?php echo site_url('vin/produksi/mutasi_pet/excelDetailMutasi');?>',
			success: function(data) {
				console.log(data);
				
				data = JSON.parse(data);
				datas=data[0];
				console.log(datas);
				window.location.href =  '<?php echo site_url('vin/produksi/Mutasi_pet/tampilexcelDetailMutasi/') ?>'+datas;
				
				
			}
		});
	}


	function edit_data(btn) {
		var data_table = document.getElementById('tblMutasi');
		var row = $(btn).closest("tr").index() + 1;
		//alert(row);
		id_mutasi = data_table.rows[row].cells[3].innerHTML;
		var tanggal = data_table.rows[row].cells[1].innerHTML;
		var kk = data_table.rows[row].cells[2].innerHTML;
		//alert (id_mutasi);
		//alert(tanggal);
		//alert(kk);
		var data = [id_mutasi,tanggal,kk];
		$.ajax({
			data:{data:data},
			type: 'POST',
			url: '<?php echo site_url('vin/produksi/Mutasi_pet/editDetailMutasi');?>',
			success: function(data) {
			  // console.log(data);
			  data = JSON.parse(data);
			  datas=data[0];
			  console.log(datas);
			  window.location.href =  '<?php echo site_url('vin/produksi/Mutasi_pet/tampileditDetailMutasi/') ?>'+datas;
			   
			}
		});
	}		

	function gabung_roll(btn) {
		var data_table = document.getElementById('tblMutasi');
		var row = $(btn).closest("tr").index() + 1;
		//alert(row);
		id_mutasi = data_table.rows[row].cells[3].innerHTML;
		var tanggal = data_table.rows[row].cells[1].innerHTML;
		var kk = data_table.rows[row].cells[2].innerHTML;
		var data = [id_mutasi,tanggal,kk];
		$.ajax({
			data:{data:data},
			type: 'POST',
			url: '<?php echo site_url('vin/produksi/Mutasi_pet/gabungRollMutasi');?>',
			success: function(data) {
			  // console.log(data);
			  data = JSON.parse(data);
			  datas=data[0];
			  console.log(datas);
			  window.location.href =  '<?php echo site_url('vin/produksi/Mutasi_pet/tampilgabungRollMutasi/') ?>'+datas;
			  
			  
			}
		});
	}	

	function show_preview(datas) {
		tabel_header_preview.rows[0].cells[0].innerHTML = datas[0].DARI+'&nbsp;&nbsp;&nbsp;&nbsp; ke &nbsp;&nbsp;&nbsp;&nbsp;'+datas[0].KE ;
		tabel_header_preview.rows[2].cells[2].innerHTML = datas[0].NOMOR_MUTASI;
		tabel_header_preview.rows[3].cells[2].innerHTML = datas[0].TGL;
		tabel_header_preview.rows[4].cells[2].innerHTML = datas[0].SERI;
		tabel_header_preview.rows[5].cells[2].innerHTML = datas[0].KK;
            //alert(datas[0].DARI);

            $('#tabel_detail_preview').DataTable().destroy();
            $("#tabel_detail_preview tbody").find("tr").remove();
            for (var i = 0; i < datas.length; i++) {
            	if (datas[i].NOMOR_MUTASI != null) {
            		$('#tabel_detail_preview tbody').append('<tr><td align="center"></td><td align="center"></td><td align="center"></td><td></tr>')
            		tabel_detail_preview.rows[i + 1].cells[0].innerHTML = i + 1;
            		tabel_detail_preview.rows[i + 1].cells[1].innerHTML = datas[i].SHIFT;
            		tabel_detail_preview.rows[i + 1].cells[2].innerHTML = datas[i].KODE;
            		tabel_detail_preview.rows[i + 1].cells[3].innerHTML = datas[i].HASIL;
            		
            	}
            }
        }
        

        
        function update_jumlah()
        {
			var pjgRoll=0;
        	var qty_data = tblBarang.rows.length;
        	for (var i = 0; i < qty_data - 1; i++) {
        		var status = document.getElementsByName('pilih_roll')[i].checked;
        		var status2 = document.getElementsByName('pilih_roll')[i].unchecked;
			  if (cmbProsesAwal.value != 'Pita') 
			  {	
				if (status == true) {
        			panjang=tblBarang.rows[i + 1].cells[5].innerHTML;
        			pjgRoll=pjgRoll+parseInt(panjang);
	                //alert(pjgRoll);
	                txtJumlah.value=pjgRoll;
	                txtSatuan.value='MTR';
	             }
	           else if (status2 == true)	
	            {
		         panjang=tblBarang.rows[i + 1].cells[5].innerHTML;
		         pjgRoll=pjgRoll-parseInt(panjang);
	              //alert(pjgRoll);
	             txtJumlah.value=pjgRoll;
	             txtSatuan.value='MTR';
	            } 	  //akhir else status2
			 } // not if
			 else
			 {
			   if (status == true) {
        			panjang=tblBarang.rows[i + 1].cells[5].innerHTML;
        			pjgRoll=pjgRoll+parseInt(panjang);
	                //alert(pjgRoll);
	                txtJumlah.value=pjgRoll;
	                txtSatuan.value='MTR';
	             }
	           else if (status2 == true)	
	            {
		         panjang=tblBarang.rows[i + 1].cells[5].innerHTML;
		         pjgRoll=pjgRoll-parseInt(panjang);
	              //alert(pjgRoll);
	             txtJumlah.value=pjgRoll;
	             txtSatuan.value='MTR';
	            }
			 }	

       }// end for
	
	}
function pagination() {
	$('#tblBarang').DataTable().destroy();
	$('#tblBarang').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": true,
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"oLanguage": {
			"sSearch": "Cari Roll :"
		},
		"dom": 'frtipB',
		"colReorder": true
	});
}

function pagination_mutasi() {
	$('#tblMutasi').DataTable().destroy();
	$('#tblMutasi').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": true,
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"oLanguage": {
			"sSearch": "Cari No Mutasi :"
		},
		"dom": 'frtipB',
		"colReorder": true,
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {
				columns: ':visible'
			},
			className: 'excel invisible',
			title: 'Data Mutasi PET'
		}]
	});
	
}



function generateNomer(Xdesain,Xseri,Xjenis) {
	
		// dataNomer = <?php //echo json_encode($nomer_ipb); ?>;
		var data = [Xdesain,Xseri,Xjenis];
		$.ajax({
			type: 'post',
			url: '<?php echo site_url('vin/produksi/mutasi_pet/getLastNoMutasi');?>',
			data:{data:data},
		dataType: "json", // Set the data type so jQuery can parse it for you, and catch array json
		success:
		function (data) {
			console.log(data);
				// 0:
				// 	ID: "1"
				// 	KETERANGAN: "IPB PET 1"
				// 	NOMER: "17"
				// 	TAHUN: "2021"
				// ==========================================
				cari_nomor = data[0][0];
				nomerMutasi = parseInt(cari_nomor.NOMOR)+1;
				var pad = "000"
				var ans = pad.substring("0",pad.length - String(nomerMutasi).length) + String(nomerMutasi);
				
				var ket = Xjenis;
				var ketVal='';
				if (ket == '1') {
					ketVal = 'MHB-EMB';
				}
				if (ket == '2') {
					ketVal = 'MHB-Coat sens';
				}
				if (ket == '3') {
					ketVal = 'MHB-Coat Read';
				}
				if (ket == '4') {
					ketVal = 'MHB-Slit Belah';
				}
				if (ket == '5') {
					ketVal = 'MHB-SLT';
				}
				if (ket == '6') {
					ketVal = 'MHB-MET';
				}
				if (ket == '7') {
					ketVal = 'MHB-Coat sens';
				}
				if (ket == '8') {
					ketVal = 'MHB-Coat Read';
				}
				if (ket == '9') {
					ketVal = 'MHB-EMB';
				}
				if (ket == '10') {
					ketVal = 'MHB/SLIT-PITA';
				}

				var d =  document.getElementById('txtTanggal').value;
				//alert (d.substr(3,2));
				var n = (d.substr(3,2));
				romawiBulan = '';
				if (n == '01') {
					romawiBulan = 'I'
				}
				if (n == '02') {
					romawiBulan = 'II'
				}
				if (n == '03') {
					romawiBulan = 'III'
				}
				if (n == '04') {
					romawiBulan = 'IV'
				}
				if (n == '05') {
					romawiBulan = 'V'
				}
				if (n == '06') {
					romawiBulan = 'VI'
				}
				if (n == '07') {
					romawiBulan = 'VII'
				}
				if (n == '08') {
					romawiBulan = 'VIII'
				}
				if (n == '09') {
					romawiBulan = 'IX'
				}
				if (n == '10') {
					romawiBulan = 'X'
				}
				if (n == '11') {
					romawiBulan = 'XI'
				}
				if (n == '12') {
					romawiBulan = 'XII'
				}
				
				nomerSMT = String(ans)+"/PNP-HLG/"+ketVal+"/"+romawiBulan+"/"+d.substr(-4,4);
				
				txtNomer.value = nomerSMT;
				txtNoUrut.value = nomerMutasi;
				txtSeri2.value = Xseri;
				txtJenis.value = Xjenis;

			},
			error: 
			function (request, error) {
				console.log(arguments);
				alert("Can't do because : " + error);
			}
		});

	}

	function validasi(){
		var kembalian = false;

		if (txtTanggal.value != "") {
			if (txtNomer.value != "") {
				if (cmbKK.value != "") {
					if (cmbBarang.value != "") {
						if (txtJumlah.value != "") {
							kembalian = true;
						}else{
							alert("Barang belum dipilih !!!");
						}
					}else{
						alert("Barang belum dipilih !!!");
					}
				}else{
					alert("KK belum dipilih !!!");
				}
			}else{
				alert("Nomer belum dipilih !!!");
			}
		}else{
			alert("Tanggal belum dipilih !!!");
		}

		return (kembalian);
	}
	
	
	
	$('#cmbDesainFilter').change(function() {
		if (cmbDesainFilter.value == '') {
			$('#cmbKodeFlowFilter').find('option:not(:first)').remove();
			

			//txtJumlah.value = '';
			//txtSatuan.value = "";
			//pjgRoll=0;
			//txtNomer.value = "";
		}else{
			var desain = document.getElementById('cmbDesainFilter').value;
			$('#cmbKodeFlowFilter').find('option:not(:first)').remove();
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getKodeFlow');?>',
		  	data: {
		  		data: desain
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);

		  		data_kode_flow = data[0];
					//data_kk =data[1];
					//data_roll = data[1];

					for (var i = 0; i < data_kode_flow.length; i++) {
						cmbKodeFlowFilter.options[cmbKodeFlowFilter.options.length] = new Option(data_kode_flow[i].DESKRIPSI);
					}
				}
			});
		}
	});		    
	
	
	$('#cmbDesain').change(function() {
		if (cmbDesain.value == '') {
			$('#cmbKodeFlow').find('option:not(:first)').remove();
			
		}else{
			var  desain= document.getElementById('cmbDesain').value;
			$('#cmbKodeFlow').find('option:not(:first)').remove();
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getKodeFlow');?>',
		  	data: {
		  		data: desain
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);

		  		data_kode_flow = data[0];
					//data_kk =data[1];
					//data_roll = data[1];

					for (var i = 0; i < data_kode_flow.length; i++) {
						cmbKodeFlow.options[cmbKodeFlow.options.length] = new Option(data_kode_flow[i].DESKRIPSI);
					}
				}
			});
		}
	});		   

	$('#cmbKodeFlow').change(function() {
		if (cmbKodeFlow.value == '') {
			$('#cmbProsesAwal').find('option:not(:first)').remove();
		}else{
			var kode_flow = document.getElementById('cmbKodeFlow').value;
			$('#cmbProsesAwal').find('option:not(:first)').remove();
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getProsesAwal');?>',
		  	data: {
		  		data: kode_flow
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);

		  		data_station_awal = data[0];
					//data_kk =data[1];
					//data_roll = data[1];

					for (var i = 0; i < data_station_awal.length; i++) {
						cmbProsesAwal.options[cmbProsesAwal.options.length] = new Option(data_station_awal[i].NAMA);
					}
				}
			});
		}
	});

	$('#cmbKodeFlowFilter').change(function() {
		if (cmbKodeFlowFilter.value == '') {
			$('#cmbProsesAwalFilter').find('option:not(:first)').remove();
			
		}else{
			var kode_flow = document.getElementById('cmbKodeFlowFilter').value;
			$('#cmbProsesAwalFilter').find('option:not(:first)').remove();
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getProsesAwal');?>',
		  	data: {
		  		data: kode_flow
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);

		  		data_station_awal = data[0];
					//data_kk =data[1];
					//data_roll = data[1];

					for (var i = 0; i < data_station_awal.length; i++) {
						cmbProsesAwalFilter.options[cmbProsesAwalFilter.options.length] = new Option(data_station_awal[i].NAMA);
					}
				}
			});
		}
	});
	
	$('#cmbProsesAwal').change(function() {
		if (cmbProsesAwal.value == '') {
			$('#cmbProsesAwal').find('option:not(:first)').remove();
		}else{
			var proses_awal = document.getElementById('cmbProsesAwal').value;
			var desain = document.getElementById('cmbDesain').value;
			var kode_flow = document.getElementById('cmbKodeFlow').value;
			var data = [ desain, proses_awal,kode_flow];
			$('#cmbKK').find('option:not(:first)').remove();
			$('#txtNomer').val('');
			$('#txtSeri').val('');
			$('#txtProsesAkhir').val('');
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getProsesAkhir');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);

		  		proses_akhir = data[0][0];
		  		data_kk=data[1];
		  		$('#txtProsesAkhir').val(proses_akhir.NAMA);
					//data_kk =data[1];
					//data_roll = data[1];
					for (var i = 0; i < data_kk.length; i++) {
						//$('#kk').empty().append(
						cmbKK.options[cmbKK.options.length] = new Option(data_kk[i].KK)
						//);
					}
					
				}
			});
		}
	});	   

	$('#cmbProsesAwalFilter').change(function() {
		if (cmbProsesAwalFilter.value == '') {
			$('#cmbProsesAwalFilter').find('option:not(:first)').remove();
		}else{
			var proses_awal = document.getElementById('cmbProsesAwalFilter').value;
			var desain = document.getElementById('cmbDesainFilter').value;
			var kode_flow = document.getElementById('cmbKodeFlowFilter').value;
			var data = [ desain, proses_awal,kode_flow];
			$('#txtProsesAkhirFilter').val('');
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getProsesAkhir');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);

		  		proses_akhir = data[0][0];
		  		data_kk=data[1];
		  		$('#txtProsesAkhirFilter').val(proses_akhir.NAMA);
					//data_kk =data[1];
					//data_roll = data[1];
					
					
				}
			});
		}
	});	   

	
	$('#cmbKK').change(function() {
		if (cmbKK.value == '') {
			$('#cmbKK').find('option:not(:first)').remove();
		}else{
			var kk = document.getElementById('cmbKK').value;
			var proses_awal = document.getElementById('cmbProsesAwal').value;
			var proses_akhir = document.getElementById('txtProsesAkhir').value;  
			var desain = document.getElementById('cmbDesain').value;  
			var jenis='';
			if(proses_awal == 'Emboss' && proses_akhir =='Coating Sensitizing')
			{
				jenis ='1';
			}
			else if(proses_awal == 'Coating Sensitizing')
			{
				jenis = '2';
			}			
			else if(proses_awal == 'Coating Readable')
			{
				jenis = '3';
			}	
			else if(proses_awal == 'Belah')
			{
				jenis = '4';
			}
			else if(proses_awal == 'Emboss' && proses_akhir =='Rewind 1')
			{
				jenis ='5';
			}
			//history wkt masi ada rewind 1
			//else if(proses_awal == 'Rewind 1')
            //{
			//jenis = '6';
            //}
			//else if(proses_awal == 'Metalize')
            //{
			//jenis = '7';
            //}
			//else if(proses_awal == 'Rewind 2')
            //{
			//jenis = '8';
           // }
           else if(proses_awal == 'Pita')
           {
           	jenis ='10';
           } 
		   else if(proses_awal == 'Emboss' && proses_akhir =='Metalize')
           {
           	jenis ='9';
           }
           else if(proses_awal == 'Metalize')
           {
           	jenis = '6';
           }
           else if(proses_awal == 'Coating Sensitizing')
           {
           	jenis = '7';
           }
           else if(proses_awal == 'Coating Readible')
           {
           	jenis = '8';
           }
           
           var data = [ kk, proses_awal,proses_akhir];
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/getRoll');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);
		  		
		  		
		  		get_roll = data[0][0];
		  		datas =data[0];
		  		var seri=get_roll.SERI;
		  		var seriX='';	
		  		if(seri == 'SERI I')
		  		{
		  			seriX='1';
		  		}
		  		else if(seri == 'SERI II')
		  		{
		  			seriX='2';
		  		}
		  		else if(seri == 'SERI III')
		  		{
		  			seriX='3';
		  		}
		  		if(seri == 'MMEA')
		  		{
		  			seriX='4';
		  		}
		  		$('#txtSeri').val(get_roll.SERI);
		  		generateNomer(desain,seriX,jenis);					
		  		isi_tabel(datas);
		  		pagination();
		  	}
		  });
		}
	});	
	function export_excel_detail(btn) {
		if(tanggalAwal.value == '')
		{
			alert('Tanggal Awal harus diisi');
			return;
		}
		if(tanggalAkhir.value == '')
		{
			alert('Tanggal Akhir harus diisi');
			return;
		}
		if(cek_semua.checked == false)
		{		
			if (cmbDesainFilter.value == '') 
			{
				alert('Desain harus dipilih');
			}	
			if(cmbProsesAwalFilter.value == '')
			{
				alert('Proses Awal harus dipilih');
			}
			if(cmbKodeFlowFilter.value == '')
			{
				alert('Kode Flow harus dipilih');
			}	
			if(cmbDesainFilter.value != '' && tanggalAwal.value != '' &&  tanggalAkhir.value != '' &&  cmbProsesAwalFilter.value != ''  &&  cmbKodeFlowFilter.value != '' )
			{
				var tanggal_awal = document.getElementById('tanggalAwal').value;
				var tanggal_akhir = document.getElementById('tanggalAkhir').value;
				var proses_awal = document.getElementById('cmbProsesAwalFilter').value;
				var proses_akhir = document.getElementById('txtProsesAkhirFilter').value;  
				var kode_flow = document.getElementById('cmbKodeFlowFilter').value;  
				
				var data = [ tanggal_awal,tanggal_akhir, proses_awal,proses_akhir,kode_flow];
				
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/exportExcelDetailAll');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		datas=data[0];
		  		console.log(datas);
		  		window.location.href =  '<?php echo site_url('vin/produksi/Mutasi_pet/tampilexcelDetailAll/') ?>'+datas;		
		  		
		  	}
		  });
		} //if tidak kosong
	   }// if checked true	
	   else if(cek_semua.checked == true)
	   {
	   	var tanggal_awal = document.getElementById('tanggalAwal').value;
	   	var tanggal_akhir = document.getElementById('tanggalAkhir').value;
	   	var kode_flow = document.getElementById('cmbKodeFlowFilter').value; 
	   	var proses_awal = 'SEMUA';
	   	
	   	var data = [ tanggal_awal,tanggal_akhir, proses_awal,kode_flow];
	   	
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/exportExcelDetailAll');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		datas=data[0];
		  		console.log(datas);
		  		window.location.href =  '<?php echo site_url('vin/produksi/Mutasi_pet/tampilexcelDetailAll/') ?>'+datas;				
		  	}
		  });
		}
	}
	
	
	$("#cek_semua").click(function () { 
		if ($(this).prop("checked")) { 
			document.getElementById('cmbDesainFilter').disabled=true;
			document.getElementById('cmbProsesAwalFilter').disabled=true;
			document.getElementById('cmbKodeFlowFilter').disabled=true;
		} 
		else { 
			document.getElementById('cmbDesainFilter').disabled=false;
			document.getElementById('cmbProsesAwalFilter').disabled=false;
			document.getElementById('cmbKodeFlowFilter').disabled=false;
			
		} 
	}); 
	
	$("#cek_koderoll").click(function () { 
		if ($(this).prop("checked")) { 
			document.getElementById('txtKodeRollFilter').disabled=false;
		} 
		else { 
			document.getElementById('txtKodeRollFilter').disabled=true;
		} 
	}); 
	
	function filter_table() {
		if(tanggalAwal.value == '')
		{
			alert('Tanggal Awal harus diisi');
			return;
		}
		if(tanggalAkhir.value == '')
		{
			alert('Tanggal Akhir harus diisi');
			return;
		}
		if(cek_semua.checked == false)
		{		
			if (cmbDesainFilter.value == '') 
			{
				alert('Desain harus dipilih');
			}	
			if(cmbProsesAwalFilter.value == '')
			{
				alert('Proses Awal harus dipilih');
			}
			if(cmbDesainFilter.value != '' && tanggalAwal.value != '' &&  tanggalAkhir.value != '' &&  cmbProsesAwalFilter.value != '' &&  cek_koderoll.checked == false  )
			{
				var tanggal_awal = document.getElementById('tanggalAwal').value;
				var tanggal_akhir = document.getElementById('tanggalAkhir').value;
				var proses_awal = document.getElementById('cmbProsesAwalFilter').value;
				var proses_akhir = document.getElementById('txtProsesAkhirFilter').value;  
				var cek_roll='';
				
				var data = [ tanggal_awal,tanggal_akhir, proses_awal,proses_akhir,cek_roll];
				
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/filter');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);
		  		datas =data[0];				
		  		isi_tabel_mutasi(datas);
		  		pagination_mutasi();
		  	}
		  });
		} //if tidak kosong
		else if(cmbDesainFilter.value != '' && tanggalAwal.value != '' &&  tanggalAkhir.value != '' &&  cmbProsesAwalFilter.value != '' &&  cek_koderoll.checked == true )
	   {
	   	var tanggal_awal = document.getElementById('tanggalAwal').value;
	   	var tanggal_akhir = document.getElementById('tanggalAkhir').value;
	    var  proses_awal ='';
		var cek_roll='CENTANG';
		var koderoll = document.getElementById('txtKodeRollFilter').value;
	   	var proses_akhir = '';
		  
	   	
	   	var data = [ tanggal_awal,tanggal_akhir, proses_awal,proses_akhir,cek_roll,koderoll];
	   	
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/filter');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);
		  		datas =data[0];				
		  		isi_tabel_mutasi(datas);
		  		pagination_mutasi();
		  	}
		  });
		}
	   }// if checked true	
	   
	   else if(cek_koderoll.checked == true)
	   {
	   	var tanggal_awal = document.getElementById('tanggalAwal').value;
	   	var tanggal_akhir = document.getElementById('tanggalAkhir').value;
	    var  proses_awal ='';
		var cek_roll='CENTANG';
		var koderoll = document.getElementById('txtKodeRollFilter').value;
	   	var proses_akhir = '';
	   	
	   	var data = [ tanggal_awal,tanggal_akhir, proses_awal,proses_akhir,cek_roll,koderoll];
	   	
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/filter');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);
		  		datas =data[0];				
		  		isi_tabel_mutasi(datas);
		  		pagination_mutasi();
		  	}
		  });
		}
		else if(cek_semua.checked == true)
	   {
	   	var tanggal_awal = document.getElementById('tanggalAwal').value;
	   	var tanggal_akhir = document.getElementById('tanggalAkhir').value;
	   	var proses_awal = 'SEMUA';
	   	var proses_akhir = '';
		var cek_roll='';
		
	   	
	   	var data = [ tanggal_awal,tanggal_akhir, proses_awal,proses_akhir,cek_roll];
	   	
		  //alert(desain);
		  $.ajax({
		  	type: 'POST',
		  	url: '<?php echo site_url('vin/produksi/mutasi_pet/filter');?>',
		  	data: {
		  		data: data
		  	},
		  	success:function(data) {
		  		data = JSON.parse(data);
		  		console.log(data);
		  		datas =data[0];				
		  		isi_tabel_mutasi(datas);
		  		pagination_mutasi();
		  	}
		  });
		}
	}	 
	
	



</script>
