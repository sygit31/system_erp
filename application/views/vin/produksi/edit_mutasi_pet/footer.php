<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>

<!-- jquery -->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<script type="text/javascript">
var tabel_menu =  document.getElementById('tabel_menu');
var  id_hapus = [];
var kk=document.getElementById('no_kk').value;
var nama_penerima=document.getElementById('nm_penerima').value;
var nama_pengirim=document.getElementById('nm_pengirim').value;
var data_roll = [];
//console.log(nama_pengirim);
//console.log(nama_penerima);
// Load Dokumen

$(document).ready(function() {
   // $("#cmbKK").select2(); // Combo Live Search
	$("#cmbPengirim").select2();
	$("#cmbPenerima").select2();
	//$('#cmbKK').val(kk).change();

	$('#tanggal').Zebra_DatePicker({
		    direction: 0,
		    // pair: $('#tanggal_selesai'),
		    format: 'd/m/Y'
		});
	id_mutasi=document.getElementById("no_mutasi").value;
	tanggal=document.getElementById("tanggal").value;
	var data = [id_mutasi,tanggal,kk];
        $.ajax({
          data:{data:data},
            type: 'POST',
            url: '<?php echo site_url('vin/produksi/mutasi_pet/getDetailMutasi');?>',
            success: function(data) {
				//console.log(data);
                data = JSON.parse(data);
				$('#cmbPengirim').val(nama_pengirim).change();
	            $('#cmbPenerima').val(nama_penerima).change();
				isi_total();
				//console.log(data[0]["DARI"]);
				//datas=data[0];
				//show_data_mutasi(data);
            }
        });	
	//pagination();
   // $('#judul').focus();
    $('#tabel_menu').width('90%');
}); 



// Pagination
function pagination() {
    var qty_data = $('#data-table tr').length;

    if (qty_data == 1) {
        height = "100px";
    }else if (qty_data > 5) {
        height = "400px";
    }else{
        height = ((qty_data-1) * 100) + "px";
    }
    
    $('#data-table').DataTable().destroy();
    var data_table = $('#data-table').DataTable( {
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": height,
        "columnDefs": [{"orderable": false,"targets": "_all"}],
        "order": []
    });

    setTimeout(function() {data_table.columns.adjust().draw();}, 100);
}

function pagination_input() {
	var datatable_roll = $('#tbl_roll').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"order": [[1, "asc"]],
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px"
	});

	setTimeout(function() {
		datatable_roll.columns.adjust().draw();
	}, 500);
}



function klik_roll(){
	var  dari = document.getElementById('dari').value;
 
	$.ajax({
		data: {
			data: [dari]
		},
		type: 'POST',
		url: '<?php echo site_url('vin/produksi/mutasi_pet/cekRollMutasi') ?>',
		success: function(data) {
			datas = JSON.parse(data);
			data_roll=datas[0];
			//console.log(data_roll);
			isi_data_roll(data_roll);
			pagination_input();
			$('#btn_roll').click();
		}
	});
}

// Hapus menu
function hapus_roll(btn) {
    var row = $(btn).closest("tr").index() + 1;
    id_prod_mutasi = tabel_menu.rows[row].cells[3].innerHTML;
    id_hapus.push(id_prod_mutasi);

    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
	isi_total();
}

$("#modal_rolls").draggable({
	handle: ".card-header"
});

function isi_data_roll(data_roll) {
	$('#tbl_roll').DataTable().destroy();
	$("#body_roll").find("tr").remove();
    //console.log(data_roll);
	var urut = 0;
	for (var i = 0; i < data_roll.length; i++) {
		shift = data_roll[i].SHIFT;
		kode_roll = data_roll[i].KODE;
		meter = data_roll[i].HASIL;
		id_prod_mutasi = data_roll[i].ID;
		urut++;
		$('#body_roll').append('<tr><td align="center"><input type="checkbox" name="pilih_barang" style="cursor: pointer;"></td><td>' + urut + '</td><td>' + shift + '</td><td>' + kode_roll + '</td><td>' + meter + '</td><td hidden>' + id_prod_mutasi + '</td></tr>');
		
	}
}

$('#btn_pilih').click(function() {
	$('#tbl_roll').DataTable().destroy();

	var tabel_roll = document.getElementById('tabel_menu');
	var tbl_roll = document.getElementById('tbl_roll');
	var qty_data = tbl_roll.rows.length;

	if (tbl_roll.rows[1].cells[1].innerHTML != '1') {
		return;
	}

	for (var i = 0; i < qty_data - 1; i++) {
		var status = document.getElementsByName('pilih_barang')[i].checked;

		ganda = 0;
		if (status == true) {
			shift = tbl_roll.rows[i + 1].cells[2].innerHTML;
			kode_roll = tbl_roll.rows[i + 1].cells[3].innerHTML;
			meter = tbl_roll.rows[i + 1].cells[4].innerHTML;
			id_prod_mutasi = tbl_roll.rows[i + 1].cells[5].innerHTML;
            console.log(id_prod_mutasi);
			// Cegah material ganda
			
            for (var j = 0; j < tabel_menu.rows.length - 1; j++) {
            	t_id_prod_mutasi = tabel_menu.rows[j + 1].cells[3].innerHTML;
            	console.log (tabel_menu.rows[j+1].cells[3].innerHTML);
				if (t_id_prod_mutasi == id_prod_mutasi) {ganda++;}
            }

            if (ganda == 0) {			
            	isi_rolls(shift,kode_roll, meter,id_prod_mutasi);
            }
           isi_total();
		}

    }
});

function isi_rolls(shift,kode_roll, meter,id_prod_mutasi) {

	
	$('#tabel_menu').append(
		'<tr>' +
		'<td><input type="text" class="form-control" value="' + shift + '" title="' + shift + '" name="txtshift" style="width: 100%; text-align: center;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + kode_roll + '" title="' + kode_roll + '" name="txtroll" style="width: 100%; text-align: center;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + meter + '" title="' + meter + '" name="txtmeter" style="width: 100%;text-align: center;" readonly></td>' +
		'<td hidden>' + id_prod_mutasi + '</td>' +
		'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Roll" onclick="hapus_roll(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></button></td>' +
		'</tr>');
}



// Kosongkan isian
function kosong() {
    window.location.href="<?php echo site_url(); ?>/vin/produksi/mutasi_pet/"; 
    id_hapus = [];
}

function isi_total() {
	var qty_data = $('#tabel_menu tr').length;
	var sub_total = 0;
	//console.log(qty_data);
	for (var i=0; i<qty_data-1; i++) {
		meter = document.getElementsByName('txtmeter')[i].value;
		if (meter == '' ) {
			subtotal = 0;
		} 
		//console.log(meter);
		sub_total = sub_total + Number(meter);
	}
	$('#txttotal').val(parseInt(sub_total));
}

function error_isian(str) {
	$('#keterangan_isian').html(str);
	$('#btnIsian').click();
}

function cari_pengirim() {
		  var nama_pengirim = document.getElementById('cmbPengirim').value; 
		  
		  $.ajax({
			type: 'POST',
			url: '<?php echo site_url('vin/produksi/mutasi_pet/getIdPengirimPenerima') ?>',
			data: {
					data: nama_pengirim
				},
			success:function(data) {
					data = JSON.parse(data);
					//console.log(data);

					id_pengirim =  data[0][0];
					$('#id_pengirim').val(id_pengirim.ID);

					
				}
			});
		
	   }

	   function cari_penerima() {
		  var nama_penerima = document.getElementById('cmbPenerima').value; 
		  
		  $.ajax({
			type: 'POST',
			url: '<?php echo site_url('vin/produksi/mutasi_pet/getIdPengirimPenerima') ?>',
			data: {
					data: nama_penerima
				},
			success:function(data) {
					data = JSON.parse(data);
					//console.log(data);

					id_penerima =  data[0][0];
					$('#id_penerima').val(id_penerima.ID);

					
				}
			});
		
	   }   

// Simpan Data
function simpan_edit_mutasi() {
	var no_mutasi_lama = document.getElementById('no_mutasi_lama').value;
    var no_mutasi = document.getElementById('no_mutasi').value;
	var kk = document.getElementById('no_kk').value;
    var id_pengirim = document.getElementById('id_pengirim').value;
	var id_penerima = document.getElementById('id_penerima').value;
	var tanggal = document.getElementById('tanggal').value;
	var data = [];

    // Validasi isian
    if (no_mutasi == '' || tabel_menu.rows.length == "1") {error_isian('Nomor tidak boleh kosong..'); return;}
    for(var i=0; i<tabel_menu.rows.length - 1; i++){
        var shift = document.getElementsByName('txtshift')[i].value;
        var kode_roll = document.getElementsByName('txtroll')[i].value;
        var meter = document.getElementsByName('txtmeter')[i].value;
        var id_prod_mutasi = $('#tabel_menu tbody tr:eq('+ i + ')').find("td").eq(3).html();
        var menu = [no_mutasi,kk,id_pengirim,id_penerima,shift,kode_roll,meter,id_prod_mutasi,no_mutasi_lama,tanggal,id_hapus];
        data.push(menu);
    }
	

    $('#btnProgress').click();
    $.ajax({
       data: {
			data: data
		},
        type: 'POST',
		url: '<?php echo site_url('vin/produksi/mutasi_pet/simpanEditMutasi') ?>',
        success: function(data) {
			data = JSON.parse(data);
			//console.log(data);
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click(); 
                kosong();
            },1000);  
        }
    });
}



</script>

