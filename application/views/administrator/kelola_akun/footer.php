	<!-- DataTables -->
	<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
	<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
	<!-- Treeview -->
	<script src="<?php echo base_url();?>assets/vakata-jstree-c9d7c14/dist/jstree.min.js"></script>







	<script type="text/javascript">
	
		$(function () {
		    //Datatable
		    $("#example1").DataTable({
		      "paging": true,
		      "lengthChange": true,
		      "searching": true,
		      "ordering": false,
		      "info": true,
		      "autoWidth": true
		    });
		});


		$(function() { //Treeview

			$('input[type="checkbox"]').change(checkboxChanged);

			function checkboxChanged() {
			    var $this = $(this),
			        checked = $this.prop("checked"),
			        container = $this.parent(),
			        siblings = container.siblings();

			    container.find('input[type="checkbox"]')
			    	.prop({
			        	indeterminate: false,
			        	checked: checked
			    	})
			    	.siblings('label')
			    	.removeClass('custom-checked custom-unchecked custom-indeterminate')
			    	.addClass(checked ? 'custom-checked' : 'custom-unchecked');

			    checkSiblings(container, checked);
			}

		  	function checkSiblings($el, checked) {
			    var parent = $el.parent().parent(),
			        all = true,
			        indeterminate = false;

			    $el.siblings().each(function() {
			      	return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
			    });

			    if (all && checked) {
			      	parent.children('input[type="checkbox"]')
			      		.prop({
			          		indeterminate: false,
			          		checked: checked
			      		})
			      		.siblings('label')
			      		.removeClass('custom-checked custom-unchecked custom-indeterminate')
			      		.addClass(checked ? 'custom-checked' : 'custom-unchecked');

			      	checkSiblings(parent, checked);
			    } 
			    else if (all && !checked) {
			      	indeterminate = parent.find('input[type="checkbox"]:checked').length > 0;

			      	parent.children('input[type="checkbox"]')
			      		.prop("checked", checked)
			      		.prop("indeterminate", indeterminate)
			      		.siblings('label')
			      		.removeClass('custom-checked custom-unchecked custom-indeterminate')
			      		.addClass(indeterminate ? 'custom-indeterminate' : (checked ? 'custom-checked' : 'custom-unchecked'));

			      	checkSiblings(parent, checked);
			    } 
			    else {
			      	$el.parents("li").children('input[type="checkbox"]')
			      		.prop({
			          		indeterminate: true,
			          		checked: false
			      		})
			      		.siblings('label')
			      		.removeClass('custom-checked custom-unchecked custom-indeterminate')
			      		.addClass('custom-indeterminate');
			    }
		  	}
		});



		$('#modal-tambah-akun').on('show.bs.modal', function(e) {
	        $('#cmbBagian').val('').change();

        	$("#MenuAksesAdd").each(function() {
			  	$(this)
			  		.find('input[type="checkbox"]')
			  		.prop('checked', false);
			  	$(this)
			  		.find('label')
			  		.removeClass('custom-checked custom-unchecked custom-indeterminate')
			    	.addClass('custom-unchecked');
			});

		})



		$('#modal-detail').on('show.bs.modal', function(e) {
		 	var data = e.relatedTarget.id;
	        // alert(data);
	        $('#txtIdAkun').val(data);

		 	// $('#cbGudang').prop('checked', false);
			 // 	$('#cbGudang_Penerimaan').prop('checked', false);
			 // 	$('#cbGudang_Stok').prop('checked', false);
			 // 	$('#cbGudang_Reject').prop('checked', false);
			 // 	$('#cbGudang_Pengeluaran').prop('checked', false);
			 // 	$('#cbGudang_Laporan').prop('checked', false);
				//  	$('#cbGudang_Laporan_MutasiPET').prop('checked', false);
		 	// $('#cbPembelian').prop('checked', false);
			 // 	$('#cbPembelian_Outstanding').prop('checked', false);
		 	// $('#cbQc').prop('checked', false);
			 // 	$('#cbQc_Master').prop('checked', false);
				//  	$('#cbQc_Master_Parameter').prop('checked', false);
				//  	$('#cbQc_Master_TestRequirement').prop('checked', false);
			 // 	$('#cbQc_Cek').prop('checked', false);
			 // 	$('#cbQc_LaporanTest').prop('checked', false);
		 	// $('#cbKinerja').prop('checked', false);
		 	// $('#cbAdministrator').prop('checked', false);
			 // 	$('#cbAdministrator_KelolaAkun').prop('checked', false);


        	$("#MenuAkses").each(function() {
			  	$(this)
			  		.find('input[type="checkbox"]')
			  		.prop('checked', false);
			  	$(this)
			  		.find('label')
			  		.removeClass('custom-checked custom-unchecked custom-indeterminate')
			    	.addClass('custom-unchecked');
			});


        	var dAkses = <?php echo json_encode($hak_akses); ?>;
        	var hak_akses = getByValue(dAkses,data);
        	// console.log(hak_akses);
        	$("#lblHeader").text(hak_akses['NAMA']);

        	if (hak_akses['A'] == '1') {$('#cbGudang').prop('checked', true);$("label[for=cbGudang]").removeClass('custom-unchecked').addClass('custom-checked');}
	        	if (hak_akses['B'] == '1') {$('#cbGudang_Penerimaan').prop('checked', true);$("label[for=cbGudang_Penerimaan]").removeClass('custom-unchecked').addClass('custom-checked');}
	        	if (hak_akses['C'] == '1') {$('#cbGudang_Stok').prop('checked', true);$("label[for=cbGudang_Stok]").removeClass('custom-unchecked').addClass('custom-checked');}
	        	if (hak_akses['D'] == '1') {$('#cbGudang_Reject').prop('checked', true);$("label[for=cbGudang_Reject]").removeClass('custom-unchecked').addClass('custom-checked');}
	        	if (hak_akses['E'] == '1') {$('#cbGudang_Pengeluaran').prop('checked', true);$("label[for=cbGudang_Pengeluaran]").removeClass('custom-unchecked').addClass('custom-checked');}
	        	if (hak_akses['F'] == '1') {$('#cbGudang_Laporan').prop('checked', true);$("label[for=cbGudang_Laporan]").removeClass('custom-unchecked').addClass('custom-checked');}
		        	if (hak_akses['G'] == '1') {$('#cbGudang_Laporan_MutasiPET').prop('checked', true);$("label[for=cbGudang_Laporan_MutasiPET]").removeClass('custom-unchecked').addClass('custom-checked');}

		    if (hak_akses['H'] == '1') {$('#cbPembelian').prop('checked', true);$("label[for=cbPembelian]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['I'] == '1') {$('#cbPembelian_Outstanding').prop('checked', true);$("label[for=cbPembelian_Outstanding]").removeClass('custom-unchecked').addClass('custom-checked');}

		    if (hak_akses['J'] == '1') {$('#cbQc').prop('checked', true);$("label[for=cbQc]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['K'] == '1') {$('#cbQc_Master').prop('checked', true);$("label[for=cbQc_Master]").removeClass('custom-unchecked').addClass('custom-checked');}
				    if (hak_akses['L'] == '1') {$('#cbQc_Master_Parameter').prop('checked', true);$("label[for=cbQc_Master_Parameter]").removeClass('custom-unchecked').addClass('custom-checked');}
				    if (hak_akses['M'] == '1') {$('#cbQc_Master_TestRequirement').prop('checked', true);$("label[for=cbQc_Master_TestRequirement]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['N'] == '1') {$('#cbQc_Cek').prop('checked', true);$("label[for=cbQc_Cek]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['W'] == '1') {$('#cbQc_Cetak').prop('checked', true);$("label[for=cbQc_Cetak]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['O'] == '1') {$('#cbQc_LaporanQc').prop('checked', true);$("label[for=cbQc_LaporanQc]").removeClass('custom-unchecked').addClass('custom-checked');}
			    	if (hak_akses['S'] == '1') {$('#cbQc_LaporanQc_Test').prop('checked', true);$("label[for=cbQc_LaporanQc_Test]").removeClass('custom-unchecked').addClass('custom-checked');}

		    if (hak_akses['P'] == '1') {$('#cbKinerja').prop('checked', true);$("label[for=cbKinerja]").removeClass('custom-unchecked').addClass('custom-checked');}

		    if (hak_akses['T'] == '1') {$('#cbRnD').prop('checked', true);$("label[for=cbRnD]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['U'] == '1') {$('#cbRnD_SetMesin').prop('checked', true);$("label[for=cbRnD_SetMesin]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['V'] == '1') {$('#cbRnD_SetFormula').prop('checked', true);$("label[for=cbRnD_SetFormula]").removeClass('custom-unchecked').addClass('custom-checked');}

		    if (hak_akses['Q'] == '1') {$('#cbAdministrator').prop('checked', true);$("label[for=cbAdministrator]").removeClass('custom-unchecked').addClass('custom-checked');}
			    if (hak_akses['R'] == '1') {$('#cbAdministrator_KelolaAkun').prop('checked', true);$("label[for=cbAdministrator_KelolaAkun]").removeClass('custom-unchecked').addClass('custom-checked');}

		})


		function getByValue(arr, value) {
		    var xxx = [];
		    for (var i=0, iLen=arr.length; i<iLen; i++) {
		      	if (arr[i].ID_AKUN == value){
		      		// xxx.push(arr[i]);
		      		xxx = arr[i];
		      	}
		    }
		    return xxx;
		}

		function getByValueKaryawan(arr, value) {
		    var xxx = []
		    for (var i=0, iLen=arr.length; i<iLen; i++) {
		      if (arr[i].ID_BAGIAN == value)
		      xxx.push(arr[i]);
		    }
		    return xxx;
		}

		function showKaryawan(){
		    var e = document.getElementById("cmbBagian");

		    var dKaryawan= <?php echo json_encode($dKaryawan); ?>;

		    var idBagian;
		    if(e.options[e.selectedIndex].value != ""){
		      	idBagian = e.options[e.selectedIndex].value;
		    }

		    var f = document.getElementById("cmbKaryawan");
		    f.options.length = 0;

		    var listKaryawan = getByValueKaryawan(dKaryawan,idBagian);

		    for (var i=0; i<listKaryawan.length; i++) {
		    	var opt = document.createElement('option');
		        opt.value = listKaryawan[i]['ID'];
		        opt.innerHTML = listKaryawan[i]['NAMA'];
		        f.appendChild(opt);
		    }
		}

		function validasi() {
			if ($("#cmbBagian").children("option:selected").val() == "") {
				$("#cmbBagian").focus();
				alertify.alert("Bagian belum dipilih!!!");
				return false;
			}

			if (typeof ($("#cmbKaryawan").children("option:selected").val()) == "undefined"){
				$("#cmbKaryawan").focus();
				alertify.alert("Karyawan belum dipilih!!!");
				return false;
			}

			return true;
		}

	</script>