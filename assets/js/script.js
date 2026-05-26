
$(document).ready(function() {
	onlynumeric();
	$(".select").select2();
	$('.select_min').select2({minimumResultsForSearch: -1});
	$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
});

function onlynumeric() {
	$('.num, .num2').on('focus', function() {
		this.value = this.value.replace(/,/g, '');
	});
	$('.num, .num2').on('input', function() {
		this.value = this.value.replace(/[^0-9.]/g, '');
	});
	$('.num, .num2').on('focusout', function() {
		if ($.isNumeric(angka(this.value)) == false && this.value != '') {
			$(this).focus();
			$(this).addClass('border-danger');
			return;
		}
		this.value = this.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		$(this).removeClass('border-danger');
	});
	$('.num').on('focusout', function() {
		if (angka(this.value) % 1 !=0) {
			this.value = Number(angka(this.value)).toFixed(3);
		}else{
			this.value = this.value.replace('.', '');
		}
	});
	$('.num2').on('focusout', function() {
		if (angka(this.value) % 1 !=0) {
			this.value = Number(angka(this.value)).toFixed(2);
		}
	});

	$('.nums').on('focus', function() {
		this.value = this.value.replaceAll(',', '');
		this.type = 'number';
	});
	$('.nums').on('focusout', function() {
		this.type = 'text';
		if (angka(this.value) % 1 !=0) {this.value = Number(angka(this.value)).toFixed(2);}
		this.value = this.value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	});
}

function format_number(num) {
	return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function angka(num) {
	num = num.replace(/,/g,'');
	return Number(num);
}

function desimal(num, str) {
	var dec = str == undefined ? 0 : str;

	num = num.replace(',','.');
	return Number(num).toFixed(dec);
}

function numeric() {
	$('.num').on('focus', function() {
		this.value = this.value.replace(/,/g, '');
	});
	$('.num').on('input', function() {
		this.value = this.value.replace(/[^0-9.]/g, '');
	});
	$('.num').on('focusout', function() {
		if ($.isNumeric(angka(this.value)) == false && this.value != '') {
			$(this).focus();
			$(this).addClass('border-danger');
			return;
		}
		if (angka(this.value) % 1 !=0) {
			this.value = Number(angka(this.value)).toFixed(2);
		}else{
			this.value = this.value.replace('.', '');
		}
		this.value = this.value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		$(this).removeClass('border-danger');
	});
}

$('.form-control').on('input', function() {
	$(this).val($(this).val().replace(/[\']/gi, ''));
});

function proper(str) {
	return str.replace(
		/\w\S*/g,
		function(txt) {
			return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
		}
		);
}

// Format Tanggal DD-MMM-YYYY
function format_date(date) {
	try {
		var tgl = date.substring(0, 2);
		var month = parseInt(date.substring(3, 5)) - 1;
		var thn = date.substring(6);

		var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var bln = bln[month];
		return tgl + '-' + bln + '-' + thn;
	} catch (err) {}
}

// Format Tanggal DD-MMM-YY
function f_date(date) {
	try {
		var tgl = date.substring(0, 2);
		var month = parseInt(date.substring(3, 5)) - 1;
		var thn = date.substring(8);

		var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var bln = bln[month];
		return tgl + '-' + bln + '-' + thn;
	} catch (err) {}
}

function huruf(str) {
	return str.replace(/\s\s+/g, ' ').trim();
}

function htmlDecode(input) {
	var doc = new DOMParser().parseFromString(input, "text/html");
	return doc.documentElement.textContent;
}

function format_text(str, num) {
	len = str.length;
	if (len == num) {
		return str;
	}else{
		t_str = '';
		for (var i=0; i<num; i++) {
			t_str = t_str + '0';
		}
		str = t_str + str;
		return str.substring(str.length-num, str.length);
	}
}

// Get Romawi Bulan
function get_romawi(str) {
	var dt_romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
	var bln = str.substring(3,6);
	var dt_bln = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var indeks = dt_bln.indexOf(bln);
	var kd_bln = dt_romawi[indeks];

	return kd_bln;
}

// Expands & Collapse Card Info
function collapse(btn) {
	var index = $(btn).index('.btn_collapse');
	var str = $(btn).find('i')[0].className;

	if (str.includes('fa-minus') == true) {
		$(btn).find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
	}else{
		$(btn).find('i').addClass('fa fa-minus').addClass('fa fa-plus');
	}
}

// Menghitung Rata-Rata
function calc_avg(array, str) {
	var dec = str == undefined ? 1 : str;

	if (array == '') {return ['', '', '', ''];}

	var total = array.reduce((sum, number) => sum + Number(number), 0);
	var avg = (total / array.length).toFixed(dec);
	var max = Math.max(...array).toFixed(dec);
	var min = Math.min(...array).toFixed(dec);

	avg = avg == 'NaN' ? '' : avg;
	max = max == '-Infinity' ? '' : max;
	min = min == 'Infinity' ? '' : min;
	return [avg, max, min, total];
}

// Drag Div Document
$('.modal').draggable({handle: '.card-header'});
$('.modal').css('z-index', '9999');
$('.select2-container--open').css('z-index', '9999999');

// Menu Fullscreen
function openFullscreen() {
	if (document.fullscreenElement) {
		if (document.exitFullscreen) {
			document.exitFullscreen();
    	}else if (document.mozCancelFullScreen) { // Firefox
    		document.mozCancelFullScreen();
    	}else if (document.webkitExitFullscreen) { // Chrome, Safari and Opera
    		document.webkitExitFullscreen();
    	}else if (document.msExitFullscreen) { // IE/Edge
    		document.msExitFullscreen();
    	}
    }else{
    	if (document.documentElement.requestFullscreen) {
    		document.documentElement.requestFullscreen();
    	}else if (document.documentElement.mozRequestFullScreen) { // Firefox
    		document.documentElement.mozRequestFullScreen();
    	}else if (document.documentElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
    		document.documentElement.webkitRequestFullscreen();
    	}else if (document.documentElement.msRequestFullscreen) { // IE/Edge
    		document.documentElement.msRequestFullscreen();
    	}
    }
}

function page(tbl, hei) {
	var height = hei == undefined ? '350px' : hei + 'px';
	
	$('#' + tbl).DataTable().destroy();
	var datatable = $('#' + tbl).DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {
			"sSearch": "Cari :",
			"emptyTable": "Tidak ada data"
		},
		"info": false,
		"columnDefs": [{"orderable": false, "targets": "_all"}],
		"order": [],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": height,
		"colReorder": true
	});

	setTimeout(function() {datatable.columns.adjust().draw();}, 500);
}

// Export To Excel
function XLExport(tableId, judul) {
	var tab_text = '<div>'+judul+'</div><table border="1px"><tr>';
	var tab = document.getElementById(tableId);
	for (j=0; j<tab.rows.length; j++) {
		tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
	}

	tab_text = tab_text + "</table>";
	sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
	return (sa);
}
function excel(tbl, judul) {
	$('#' + tbl).DataTable().destroy();
	tabel = $('#' + tbl).html().replaceAll(',','');
	page(tbl);

	$('#tbl_excel').html(tabel);
	XLExport('tbl_excel', judul);
}
function excels(tbl, judul) {
	tabel = $('#' + tbl).html().replaceAll(',','');
	$('#tbl_excel').html(tabel);
	XLExport('tbl_excel', judul);
}

// Isian Number
$('.numbers').focus(function() {
	if ($(this).val() == 0) {$(this).val('');}
});
$('.numbers').focusout(function() {
	if ($(this).val() == '') {$(this).val('0');}
});

// Isi Format Nomor 3 atau 6 angka
function isi_nomor(btn, num) {
	var nmr = btn.value;
	var nmr = nmr.toString().padStart(num, "0");
	var nmr = nmr.substring(0, num);

	btn.value = nmr;
}