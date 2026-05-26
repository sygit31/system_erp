
<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/chart.js"></script>

<div class="row">
	<div class="col-10 box_chart" style="height: 85vh; overflow-y: scroll;">
		<div class="small-box">
			<div class="inner">
				<h3 class="box-title mb-4">Total Yield</h3>
				<canvas id="chart_yield" height="70"></canvas>
			</div>
		</div>
		<div class="small-box">
			<div class="inner">
				<h3 class="box-title mb-4">Total Waste</h3>
				<canvas id="chart_waste" height="70"></canvas>
			</div>
		</div>
		<div class="small-box">
			<div class="inner">
				<h3 class="box-title mb-4">Total Downtime</h3>
				<canvas id="chart_downtime" height="70"></canvas>
			</div>
		</div>
		<div class="small-box">
			<div class="inner">
				<h3 class="box-title mb-4">Quality Index</h3>
				<canvas id="chart_quality" height="70"></canvas>
			</div>
		</div>
	</div>
	<div class="col-2">
		<div class="info-box bg-info">
			<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><h4>Inventory</h4></span>
				<span class="info-box-number">PET</span>
				<span class="info-box-text">55,900 Meter</span>
			</div>
		</div>
		<div class="info-box bg-danger">
			<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><h4>Inventory</h4></span>
				<span class="info-box-number">Kertas Uk. 73 Cm</span>
				<span class="info-box-text">40,250 Kg</span>
			</div>
		</div>
		<div class="info-box bg-warning">
			<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><h4>Inventory</h4></span>
				<span class="info-box-number">Kertas Uk. 52.5 Cm</span>
				<span class="info-box-text">77,775 Kg</span>
			</div>
		</div>
		<div class="info-box bg-success">
			<span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><h4>Inventory</h4></span>
				<span class="info-box-number">Sisa Hasil Baik Seri I</span>
				<span class="info-box-text">1,250 Lembar</span>
			</div>
		</div>
	</div>
</div>

<script>

// Load Dokumen
$(document).ready(function() {
	chart_yield();
	chart_waste();
	chart_downtime();
	chart_quality();
});

// Auto Scroll
function chart_scroll() {
	div_scroll = $('.box_chart:eq(0)')[0];
}

// Chart
function chart_yield() {
	var rows = 100;
	var ordinat = ['18750','17000','18750','16850','12950','12115','15023'];
	var axis = ['01-May','02-May','03-May','04-May','05-May','06-May','07-May'];

	var chrt = document.getElementById("chart_yield").getContext('2d');
	var line = new Chart(chrt, {
		type: 'line',
		data: {
			labels: axis,
			datasets: [{
				data: ordinat,
				backgroundColor: [
				'rgba(105, 0, 132, .2)',
				],
				borderColor: [
				'rgba(200, 99, 132, .7)',
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			legend: {display: false}
		}
	});
}

function chart_waste() {
	var rows = 100;
	var ordinat = ['3.5','3.25','4.75','5.9','3.88','4.21','4.33'];
	var axis = ['01-May','02-May','03-May','04-May','05-May','06-May','07-May'];

	var chrt = document.getElementById("chart_waste").getContext('2d');
	var line = new Chart(chrt, {
		type: 'line',
		data: {
			labels: axis,
			datasets: [{
				data: ordinat,
				backgroundColor: [
				'rgba(105, 0, 132, .2)',
				],
				borderColor: [
				'rgba(200, 99, 132, .7)',
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			legend: {display: false}
		}
	});
}

function chart_downtime() {
	var rows = 100;
	var ordinat = ['4.4','4.31','4.29','6.78','4.21','5.11','4.25'];
	var axis = ['01-May','02-May','03-May','04-May','05-May','06-May','07-May'];

	var chrt = document.getElementById("chart_downtime").getContext('2d');
	var line = new Chart(chrt, {
		type: 'line',
		data: {
			labels: axis,
			datasets: [{
				data: ordinat,
				backgroundColor: [
				'rgba(105, 0, 132, .2)',
				],
				borderColor: [
				'rgba(200, 99, 132, .7)',
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			legend: {display: false}
		}
	});
}

function chart_quality() {
	var rows = 100;
	var ordinat = ['80','85','84','83','82','81','90'];
	var axis = ['01-May','02-May','03-May','04-May','05-May','06-May','07-May'];

	var chrt = document.getElementById("chart_quality").getContext('2d');
	var line = new Chart(chrt, {
		type: 'line',
		data: {
			labels: axis,
			datasets: [{
				data: ordinat,
				backgroundColor: [
				'rgba(105, 0, 132, .2)',
				],
				borderColor: [
				'rgba(200, 99, 132, .7)',
				],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			legend: {display: false}
		}
	});
}

</script>
