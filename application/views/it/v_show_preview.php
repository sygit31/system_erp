<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/footer');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<?php
$urut = 0;
$id_data_detail = $id;
$id_data = array();
$prev = array();
$judul = array();
$tag = array();
foreach ($file->result_array() as $dt) :

	$tag[] = $dt['TAG'];
	$jenis = $dt['JENIS'];
	$kategori = $dt['KATEGORI'];
	$sub_kategori = $dt['SUB_KATEGORI'];
	$tahun = $dt['TAHUN'];
	$nama_file = $dt['NAMA_FILE'];
	$ext = $dt['EXT'];
	$id_data[] = $dt['ID_DATA'];

	$prev[] = base_url() . "images/bank_data/" . $dt['ID_DATA'] . "." . $ext;
	$judul[] = str_replace('.' . $ext, '', $nama_file);
	if ($id_data_detail == $dt['ID_DATA']) {
		$indeks = $urut;
	}
	$urut++;

endforeach; ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 10px;">
	<a href="<?php echo base_url(); ?>index.php/dashboard" class="brand-link bg-info">
		<img src="<?php echo base_url(); ?>assets\images\historis.jpg" alt="adminlte Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight"><b>&nbsp Data Historis</b></span>
	</a>

	<div class="sidebar">
		<?php foreach ($prev as $dt) { ?>
			<?php $ext = strtolower(pathinfo($dt, PATHINFO_EXTENSION)); ?>
			<?php if ($ext == 'pdf') { ?>

				<img src="<?php echo base_url() . "images/bank_data/assets/pdf.jpg"; ?>" class="list img-thumbnail mt-2" name='pdf' style="cursor: pointer;">

			<?php } elseif ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') { ?>

				<img src="<?php echo $dt; ?>" class="list img-thumbnail mt-2" name="jpg" style="cursor: pointer;">

			<?php } elseif ($ext == 'mp4' || $ext == 'mpeg' || $ext == '3gp' || $ext == 'avi' || $ext == 'wmp') { ?>

				<img src="<?php echo base_url() . "images/bank_data/assets/no_preview.jpg"; ?>" class="list img-thumbnail mt-2" name='pdf' style="cursor: pointer;">

			<?php } else { ?>

				<img src="<?php echo base_url() . "images/bank_data/assets/no_preview.jpg"; ?>" class="list img-thumbnail mt-2" name='other' style="cursor: pointer;">
			<?php } ?>

		<?php } ?>
	</div>
</aside>

<div class="content-wrapper">
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput"><?php echo $kategori . ' &#8658 ' . $sub_kategori . ' &#8658 ' . $tahun ?></div>
						</font>
					</b>
				</h3>
			</div>
			<div class="row h-100 ">
				<div class="col-md-10">
					<div class="card mdb-color lighten-2 text-center z-depth-2 bg-dark mt-1">
						<div class="card-body">

							<iframe id="file_pdf" class='embed-responsive-item' style="height: 100%; width: 80%;" hidden></iframe>
							<img id="file_jpg" class="img-responsive img-thumbnail" style="height: 100%; max-width: 80%;" hidden>
							<a class="carousel-control-prev" href="javascript:show_previous()" role="button">
								<span class="carousel-control-prev-icon"></span>
							</a>
							<a class="carousel-control-next" href="javascript:show_next()" role="button">
								<span class="carousel-control-next-icon"></span>
							</a>

						</div>
						<div class="caption mr-3" class="" align="right"></div>
						<div class="caption mr-3 mb-2" class="" align="right"></div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="card mdb-color lighten-2 text-center z-depth-2 mt-1" style="height: 95%;">
						<div class="card-body" style="overflow-y: scroll;">
							<div class="widget-area no-padding blank">
								<div class="status-upload mb-3">
									<form>
										<textarea id="teks" rows="4" maxlength="250" placeholder="Tulis sesuatu.." style="width: 100%; font-size: 10pt; font-family: aria-label"></textarea>
										<button type="button" class="btn btn-block btn-success" id="post_comment"><i class="fa fa-share"></i><b> Post</b></button>
									</form>
								</div>

								<?php $this->load->view('it/v_show_preview_coment'); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-right">
				<button type="button" class="btn btn-primary mr-2" style="width: 150px;" onclick="aprove(this)" hidden><i class="fa fa-save m-2"></i><b>Aprove</b></button>
				<button type="button" class="btn btn-danger mr-2" style="width: 150px;" onclick="aprove(this)" hidden><i class="fa fa-ban m-2"></i><b>Delete</b></button>
				<button type="button" class="btn btn-secondary mr-2" style="width: 150px;" onclick="keluar()"><i class="fa fa-share m-2"></i><b>Keluar</b></button>
			</div>
		</div>

		<!-- Modal Error Isian -->
		<div class="modal fade" id="modal_isian">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
					<div class="modal-footer">
						<button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
						<button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Confirm Hapus -->
		<div class="modal fade" id="modal_hapus" style="z-index: 9998;">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin ubah status? </div>
					<div class="modal-footer">
						<button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
						<button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">YES</button>
						<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Sukses Ubah -->
		<div class="modal fade" id="modal_sukses">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Status Dokumen Diubah.. </div>
					<div class="modal-footer">
						<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
						<button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
					</div>
				</div>
			</div>
		</div>

	</section>
</div>

<script>

	// Define Variable
	var id_data = <?php echo $id_data_detail; ?>;
	var aktif_image;

	// Document Load
	$(document).ready(function() {
		var indeks = <?php echo json_encode($indeks); ?>;

		$('.list')[indeks].click();
		isi_comment(id_data);

		$('#hide_sidebar').click();
		$('.main-header').hide();

		auto_size();

		// Change Title
		$('title')[0].innerText = 'Data Historis';

		// Change Icon
		$("link[rel*='icon']").attr("href", "<?php echo base_url(); ?>assets/images/historis.jpg");
	});

	// Resize Screen
	$(window).resize(function() {
		auto_size();
	});

	// Auto Size
	function auto_size() {
		var height = $(window).height() - 110;

		$('.card-body').css('height', height);
	}

	// Thumbnail Click
	$('.list').on('click', function(e) {
		var file_pdf = document.getElementById('file_pdf');
		var file_jpg = document.getElementById('file_jpg');

		var index = $(this).index();
		var id = <?php echo json_encode($id_data); ?>;
		var prev = <?php echo json_encode($prev); ?>;
		var dt_judul = <?php echo json_encode($judul); ?>;
		var dt_tag = <?php echo json_encode($tag); ?>;
		var target = (e.target.name).toLowerCase();
		var id_file = id[index];

		aktif_image = index;
		$('.caption:eq(0)').text(dt_judul[index]);
		$('.caption:eq(1)').text(dt_tag[index]);
		if (target == 'pdf' || target == 'mp4' || target == 'mpeg' || target == 'mp3' || target == '3gp' || target == 'avi' || target == 'wmp') {
			$('#file_pdf').removeAttr("hidden");
			$('#file_jpg').attr("hidden", "");

			file_pdf.src = prev[index];
		} else if (target == 'jpg' || target == 'jpeg' || target == 'png') {
			$('#file_jpg').removeAttr("hidden");
			$('#file_pdf').attr("hidden", "");

			file_jpg.src = e.target.src;
		} else {
			$('#file_jpg').removeAttr("hidden");
			$('#file_pdf').attr("hidden", "");
			file_jpg.src = <?php echo json_encode(base_url()); ?> + "images/bank_data/assets/no_preview.jpg";

			buka_offline(id_file);
		}
		
		isi_comment(id_file);
	});

	// Buka File Offline
	function buka_offline(id_file) {
		$.ajax({
			data: {data: id_file},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/it/data/buka_offline',
			success: function(data) {
				console.log(data);
			}
		});
	}

	// Isi Comment
	function isi_comment(id_data) {
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/it/data/show_komen',
			data: {data: id_data},
			success: function(data) {
				$('.data_komen').html(data);
			}
		});
	}

	// Simpan Comment
	$('#post_comment').on('click', function() {
		<?php $kary = explode('|', $_SESSION['logERP']); ?>
		<?php $id_kary = $kary[0]; ?>
		var id_kary = <?php echo $id_kary; ?>;
		var teks = document.getElementById('teks').value;
		var data = [id_data, id_kary, teks];

		if (teks == '') {
			$('#btnIsian').click();
			return;
		}

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/it/data/simpan_comment',
			data: {data: data},
			success: function(data) {
				console.log(data);
				document.getElementById('teks').value = '';
				isi_comment(id_data);
			}
		});
	});

	// Approve or Delete File
	function aprove(btn) {
		var index = $('.fa').index(this);

		if (btn.innerText == 'Aprove') {
			var status = "2";
		} else {
			var status = "0"
		}

		$('#btnHapus').click();
		$('#ya').on('click', function() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/it/data/status',
				data: {data: [id_data, status]},
				success: function(data) {
					$('#btnSukses').click();
				}
			});
			return;
		});
	}

	// Reload Page
	$('#btnOk').click(function() {
		location.reload();
	});

	// Next Image
	function show_next() {
		var qty_img = $('.list').length;

		aktif_image = aktif_image + 1;
		if (aktif_image == qty_img) {
			aktif_image = 0;
		}

		$('.list')[aktif_image].click();
	}

	// Prious Image
	function show_previous() {
		var qty_img = $('.list').length;

		aktif_image = aktif_image - 1;
		if (aktif_image == -1) {
			aktif_image = qty_img - 1;
		}

		$('.list')[aktif_image].click();
	}

	// Tutup Menu
	function keluar() {
		window.top.close();
	}

</script>