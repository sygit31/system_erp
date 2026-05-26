<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lpblpj extends CI_Controller{
	private $filename = "import_data"; // Kita tentukan nama filenya

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_master_invest');
		$this->load->model('sgt/M_master_departemen');
		$this->load->model('sgt/M_master_lpb');
		$this->load->model('sgt/M_master_lpj');
		session_start();
	}

	function lpb()
	{  	
		$data['data_invest'] = $this->M_master_invest->getInvest();	    	
		$data['data_unit'] = $this->M_master_departemen->getUnit();	
		$data['data_last'] = $this->M_master_lpb->getDataLast();	
		// print_r($data['data_invest']);

		$this->load->view('sgt/cc/lpblpj/v_lpb.php',$data);
	}


	function simpanLpb()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[cmbInvest] => 
		// 	[TxtKodeRekening] => 
		// 	[cmbUnit] => 
		// 	[cmbDepartement] => 
		// 	[cmbJenis] => 
		// 	[cmbSumber] => 
		// 	[txtTanggal] => 
		// 	[txtSupplier] => 
		// 	[txtKeterangan] => 
		// 	[txtNoLpbInternal] => 
		// 	[txtQuantity] => 
		// 	[txtSatuan] => 
		// 	[txtHarga] => 
		// 	[txtDebet] => 
		// 	[ArrInvest] => Array
		// 		(
		// 			[0] => INV120000034
		// 			[1] => 
		// 		)

		// 	[ArrRekening] => Array
		// 		(
		// 			[0] => adsa
		// 			[1] => asda
		// 		)

		// 	[ArrUnit] => Array
		// 		(
		// 			[0] => 4A
		// 			[1] => 5A
		// 		)

		// 	[ArrDepartemen] => Array
		// 		(
		// 			[0] => 29
		// 			[1] => 13
		// 		)

		// 	[ArrJenis] => Array
		// 		(
		// 			[0] => POLOS
		// 			[1] => RESMI
		// 		)

		// 	[ArrSumber] => Array
		// 		(
		// 			[0] => LOKAL
		// 			[1] => IMPORT
		// 		)

		// 	[ArrTanggal] => Array
		// 		(
		// 			[0] => 28-12-2020
		// 			[1] => 30-12-2020
		// 		)

		// 	[ArrSupplier] => Array
		// 		(
		// 			[0] => dad
		// 			[1] => sada
		// 		)

		// 	[ArrKeterangan] => Array
		// 		(
		// 			[0] => asdasd
		// 			[1] => asd
		// 		)

		// 	[ArrLpbInt] => Array
		// 		(
		// 			[0] => ads
		// 			[1] => 54sd
		// 		)

		// 	[ArrIpbExt] => Array
		// 		(
		// 			[0] => asda
		// 			[1] => asd
		// 		)

		// 	[Arrqty] => Array
		// 		(
		// 			[0] => 45
		// 			[1] => 545
		// 		)

		// 	[ArrSatuan] => Array
		// 		(
		// 			[0] => asd
		// 			[1] => asda
		// 		)

		// 	[ArrHarga] => Array
		// 		(
		// 			[0] => 55
		// 			[1] => 345
		// 		)

		// 	[ArrDebet] => Array
		// 		(
		// 			[0] => 2.475
		// 			[1] => 188.025
		// 		)

		// )

		$ArrInvest = $this->input->post('ArrInvest');
		$ArrRekening = $this->input->post('ArrRekening');
		$ArrUnit = $this->input->post('ArrUnit');
		$ArrDepartemen = $this->input->post('ArrDepartemen');
		$ArrJenis = $this->input->post('ArrJenis');
		$ArrSumber = $this->input->post('ArrSumber');
		$ArrTanggal = $this->input->post('ArrTanggal');
		$ArrSupplier = $this->input->post('ArrSupplier');
		$ArrKeterangan = $this->input->post('ArrKeterangan');
		$ArrLpbInt = $this->input->post('ArrLpbInt');
		$ArrIpbExt = $this->input->post('ArrIpbExt');
		$Arrqty = $this->input->post('Arrqty');
		$ArrSatuan = $this->input->post('ArrSatuan');
		$ArrHarga = $this->input->post('ArrHarga');
		$ArrDebet = $this->input->post('ArrDebet');

		for ($i=0; $i < count($ArrRekening); $i++) { 
			//tampung array kemudian simpan

			$data['KODE_INVEST'] = $ArrInvest[$i];
			$data['KODE_REKENING'] = $ArrRekening[$i];
			$data['ALOKASI_BIAYA'] = $ArrUnit[$i];
			$data['KODE_DEPARTEMEN'] = $ArrDepartemen[$i];
			$data['TANGGAL'] = $ArrTanggal[$i];
			$TempTgl = explode("/",$ArrTanggal[$i]);
			$log_tanggal = '';

			if ($TempTgl[0]=='1') {
				$log_tanggal = $TempTgl[1].' Jan '.$TempTgl[2];
			} else {
				if ($TempTgl[0]=='2') {
					$log_tanggal = $TempTgl[1].' Feb '.$TempTgl[2];
				} else {
					if ($TempTgl[0]=='3') {
						$log_tanggal = $TempTgl[1].' Mar '.$TempTgl[2];
					} else {
						if ($TempTgl[0]=='4') {
							$log_tanggal = $TempTgl[1].' Apr '.$TempTgl[2];
						} else {
							if ($TempTgl[0]=='5') {
								$log_tanggal = $TempTgl[1].' May '.$TempTgl[2];
							} else {
								if ($TempTgl[0]=='6') {
									$log_tanggal = $TempTgl[1].' Jun '.$TempTgl[2];
								} else {
									if ($TempTgl[0]=='7') {
										$log_tanggal = $TempTgl[1].' Jul '.$TempTgl[2];
									} else {
										if ($TempTgl[0]=='8') {
											$log_tanggal = $TempTgl[1].' Agu '.$TempTgl[2];
										} else {
											if ($TempTgl[0]=='9') {
												$log_tanggal = $TempTgl[1].' Sep '.$TempTgl[2];
											} else {
												if ($TempTgl[0]=='10') {
													$log_tanggal = $TempTgl[1].' Okt '.$TempTgl[2];
												} else {
													if ($TempTgl[0]=='11') {
														$log_tanggal = $TempTgl[1].' Nov '.$TempTgl[2];
													} else {
														if ($TempTgl[0]=='12') {
															$log_tanggal = $TempTgl[1].' Dec '.$TempTgl[2];
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}

			$data['LOG_TANGGAL'] = $log_tanggal;
			$data['KETERANGAN'] = $ArrKeterangan[$i];
			$data['SUPLIER'] = $ArrSupplier[$i];
			$data['NO_LPB_INTERNAL'] = $ArrLpbInt[$i];
			$data['NO_LPB_EKSTERNAL'] = $ArrIpbExt[$i];
			$data['JUMLAH'] = str_replace(".","",$Arrqty[$i]);
			$data['SATUAN'] = $ArrSatuan[$i];
			$data['HARGA_SATUAN'] = str_replace(".","",$ArrHarga[$i]);
			$data['DEBET'] = str_replace(".","",$ArrDebet[$i]);
			$data['STATUS'] = $ArrJenis[$i];
			$data['ACTIVE_STATUS'] = 'ACTIVE';
			$data['SUMBER_BARANG'] = $ArrSumber[$i];

			$this->M_master_lpb->save($data);	
		}
		
		$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
		redirect('sgt/cc/lpblpj/lpb', "refresh");
	}

	function lpj()
	{  	
		$data['data_invest'] = $this->M_master_invest->getInvest();	    	
		$data['data_unit'] = $this->M_master_departemen->getUnit();	
		$data['data_last'] = $this->M_master_lpj->getDataLast();	

		$this->load->view('sgt/cc/lpblpj/v_lpj.php',$data);
	}

	function simpanLpj()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[cmbInvest] => 
		// 	[TxtKodeRekening] => 
		// 	[cmbUnit] => 
		// 	[cmbDepartement] => 
		// 	[cmbJenis] => 
		// 	[txtTanggal] => 
		// 	[txtSupplier] => 
		// 	[txtKeterangan] => 
		// 	[txtNoLpjInternal] => 
		// 	[txtNoLpjExternal] => 
		// 	[txtQuantity] => 
		// 	[txtSatuan] => 
		// 	[txtHarga] => 
		// 	[txtDebet] => 
		// 	[txtPph] => 
		// 	[ArrInvest] => Array
		// 		(
		// 			[0] => INV120000034
		// 			[1] => 
		// 		)

		// 	[ArrRekening] => Array
		// 		(
		// 			[0] => 234asd
		// 			[1] => sada45
		// 		)

		// 	[ArrUnit] => Array
		// 		(
		// 			[0] => 4A
		// 			[1] => 4A
		// 		)

		// 	[ArrDepartemen] => Array
		// 		(
		// 			[0] => 29
		// 			[1] => 29
		// 		)

		// 	[ArrJenis] => Array
		// 		(
		// 			[0] => POLOS
		// 			[1] => RESMI
		// 		)

		// 	[ArrTanggal] => Array
		// 		(
		// 			[0] => 16-12-2020
		// 			[1] => 25-12-2020
		// 		)

		// 	[ArrSupplier] => Array
		// 		(
		// 			[0] => asda
		// 			[1] => adadads
		// 		)

		// 	[ArrKeterangan] => Array
		// 		(
		// 			[0] => asdasad
		// 			[1] => sadadasddawwasdsa
		// 		)

		// 	[ArrLpjInt] => Array
		// 		(
		// 			[0] => as43
		// 			[1] => 45edf
		// 		)

		// 	[ArrIpjExt] => Array
		// 		(
		// 			[0] => 45sf
		// 			[1] => 66fd
		// 		)

		// 	[Arrqty] => Array
		// 		(
		// 			[0] => 55
		// 			[1] => 55
		// 		)

		// 	[ArrSatuan] => Array
		// 		(
		// 			[0] => sd
		// 			[1] => dfs
		// 		)

		// 	[ArrHarga] => Array
		// 		(
		// 			[0] => 56.000
		// 			[1] => 34.000
		// 		)

		// 	[ArrDebet] => Array
		// 		(
		// 			[0] => 3.080.000
		// 			[1] => 1.870.000
		// 		)

		// 	[ArrPph] => Array
		// 		(
		// 			[0] => 5.600
		// 			[1] => 6.500
		// 		)

		// )

		$ArrInvest = $this->input->post('ArrInvest');
		$ArrRekening = $this->input->post('ArrRekening');
		$ArrUnit = $this->input->post('ArrUnit');
		$ArrDepartemen = $this->input->post('ArrDepartemen');
		$ArrJenis = $this->input->post('ArrJenis');
		$ArrTanggal = $this->input->post('ArrTanggal');
		$ArrSupplier = $this->input->post('ArrSupplier');
		$ArrKeterangan = $this->input->post('ArrKeterangan');
		$ArrLpjInt = $this->input->post('ArrLpjInt');
		$ArrLpjExt = $this->input->post('ArrIpjExt');
		$Arrqty = $this->input->post('Arrqty');
		$ArrSatuan = $this->input->post('ArrSatuan');
		$ArrHarga = $this->input->post('ArrHarga');
		$ArrDebet = $this->input->post('ArrDebet');
		$ArrPph = $this->input->post('ArrPph');

		for ($i=0; $i < count($ArrRekening); $i++) { 
			//tampung array kemudian simpan

			$data['KODE_INVEST'] = $ArrInvest[$i];
			$data['KODE_REKENING'] = $ArrRekening[$i];
			$data['ALOKASI_BIAYA'] = $ArrUnit[$i];
			$data['KODE_DEPARTEMEN'] = $ArrDepartemen[$i];
			$data['TANGGAL'] = $ArrTanggal[$i];
			$data['KETERANGAN'] = $ArrKeterangan[$i];
			$data['SUPLIER'] = $ArrSupplier[$i];
			$data['NO_LPJ_INTERNAL'] = $ArrLpjInt[$i];
			$data['NO_LPJ_EKSTERNAL'] = $ArrLpjExt[$i];
			$data['JUMLAH'] = str_replace(".","",$Arrqty[$i]);
			$data['SATUAN'] = $ArrSatuan[$i];
			$data['HARGA_SATUAN'] = str_replace(".","",$ArrHarga[$i]);
			$data['DEBET'] = str_replace(".","",$ArrDebet[$i]);
			$data['STATUS'] = $ArrJenis[$i];
			$data['ACTIVE_STATUS'] = 'ACTIVE';
			$data['PPH'] = str_replace(".","",$ArrPph[$i]);
			$data['PPN_RUPIAH'] = '0';

			$this->M_master_lpj->save($data);	
		}
		
		$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
		redirect('sgt/cc/lpblpj/lpj', "refresh");
	}


	// =============================================================================


	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 7){
				// Kita push (add) array data ke variabel data
				$STATUS_LPB ='POLOS';
				$ppn = floatval(str_replace(",","",$row['N']));
				if ($ppn > 0) {
					$STATUS_LPB = 'RESMI';
				}

				// array_push($data, array(
				// 'KODE_INVEST'=>'',
				// 'KODE_REKENING'=>$row['G'], // Insert data nis dari kolom A di excel
				// 'ALOKASI_BIAYA'=>$row['H'], // Insert data nama dari kolom B di excel
				// 'KODE_DEPARTEMEN'=>$row['I'], // Insert data jenis kelamin dari kolom C di excel
				// 'TANGGAL'=>$row['E'], // Insert data alamat dari kolom D di excel
				// 'LOG_TANGGAL'=>$row['E'], // Insert data alamat dari kolom D di excel
				// 'KETERANGAN'=>$row['F'],
				// 'SUPLIER'=>$row['B'],
				// 'NO_LPB_INTERNAL'=>$row['C'],
				// 'NO_LPB_EKSTERNAL'=>$row['D'],
				// 'JUMLAH'=>$row['J'],
				// 'SATUAN'=>$row['K'],
				// 'HARGA_SATUAN'=>str_replace(",","",$row['L']),
				// 'DEBET'=>str_replace(",","",$row['P']),
				// 'STATUS'=>$STATUS_LPB,
				// 'ACTIVE_STATUS'=>'ACTIVE',
				// 'SUMBER_BARANG'=>'LOKAL',
				// ));

				
				$data['KODE_INVEST']='';
				$data['KODE_REKENING']=$row['G']; // Insert data nis dari kolom A di excel
				$data['ALOKASI_BIAYA']=$row['H']; // Insert data nama dari kolom B di excel
				// $data['KODE_DEPARTEMEN']=$row['I']; // Insert data jenis kelamin dari kolom C di excel

				//kode departemen ambil dulu di tabel master departemen (id_departement)
				$Xid_departement = $this->M_master_departemen->getIdByKode($row['I']);	
				// print_r($Xid_departement['0']->id_departement);
				$data['KODE_DEPARTEMEN']=$Xid_departement['0']->id_departement; 

				$data['TANGGAL']=$row['E']; // Insert data alamat dari kolom D di excel
				
				$TempTgl = explode("/",$row['E']);
				$log_tanggal = '';

				if ($TempTgl[0]=='1') {
					$log_tanggal = $TempTgl[1].' Jan '.$TempTgl[2];
				} else {
					if ($TempTgl[0]=='2') {
						$log_tanggal = $TempTgl[1].' Feb '.$TempTgl[2];
					} else {
						if ($TempTgl[0]=='3') {
							$log_tanggal = $TempTgl[1].' Mar '.$TempTgl[2];
						} else {
							if ($TempTgl[0]=='4') {
								$log_tanggal = $TempTgl[1].' Apr '.$TempTgl[2];
							} else {
								if ($TempTgl[0]=='5') {
									$log_tanggal = $TempTgl[1].' May '.$TempTgl[2];
								} else {
									if ($TempTgl[0]=='6') {
										$log_tanggal = $TempTgl[1].' Jun '.$TempTgl[2];
									} else {
										if ($TempTgl[0]=='7') {
											$log_tanggal = $TempTgl[1].' Jul '.$TempTgl[2];
										} else {
											if ($TempTgl[0]=='8') {
												$log_tanggal = $TempTgl[1].' Agu '.$TempTgl[2];
											} else {
												if ($TempTgl[0]=='9') {
													$log_tanggal = $TempTgl[1].' Sep '.$TempTgl[2];
												} else {
													if ($TempTgl[0]=='10') {
														$log_tanggal = $TempTgl[1].' Okt '.$TempTgl[2];
													} else {
														if ($TempTgl[0]=='11') {
															$log_tanggal = $TempTgl[1].' Nov '.$TempTgl[2];
														} else {
															if ($TempTgl[0]=='12') {
																$log_tanggal = $TempTgl[1].' Dec '.$TempTgl[2];
															}
														}
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}

				$data['LOG_TANGGAL']=$log_tanggal; 
				$data['KETERANGAN']=$row['F'];
				$data['SUPLIER']=$row['B'];
				$data['NO_LPB_INTERNAL']=$row['C'];
				$data['NO_LPB_EKSTERNAL']=$row['D'];

				$tmpJumlah=explode(".",$row['J']);
				$data['JUMLAH']=$tmpJumlah[0];
				$data['SATUAN']=$row['K'];

				// $tmpHargaSatuan=explode(".",str_replace(",","",$row['L']));
				// $data['HARGA_SATUAN']=$tmpHargaSatuan[0];
				$tmpHargaSatuan=substr(str_replace(".","",str_replace(",","",$row['L'])), 0, -2);
				$tmpHargaSatuanD=substr($row['L'], -3);
				$data['HARGA_SATUAN']=$tmpHargaSatuan.$tmpHargaSatuanD;

				// $tmpDebet=explode(".",str_replace(",","",$row['P']));
				// $data['DEBET']=$tmpDebet[0];
				$tmpDebet=substr(str_replace(".","",str_replace(",","",$row['P'])), 0, -2);
				$tmpDebetD=substr($row['P'], -3);
				$data['DEBET']=$tmpDebet.$tmpDebetD;


				$data['STATUS']=$STATUS_LPB;
				$data['ACTIVE_STATUS']='ACTIVE';
				$data['SUMBER_BARANG']='LOKAL';

				$this->M_master_lpb->save($data);	

				// print_r($data);
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		// print_r($data);


		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		// $this->M_master_lpb->insert_multiple($data);
		
		// Redirect ke halaman awal (ke controller siswa fungsi index)
		// redirect("Siswa"); 

		// ===================================
		$_SESSION['pesan'].='<font color="blue">Berhasil diimport</font>';
		redirect('sgt/cc/lpblpj/lpb', "refresh");
	}

	

	public function preview(){
		$data = array(); // Buat variabel $data sebagai array
		
		// lakukan upload file dengan memanggil function upload yang ada di SiswaModel.php
		$upload = $this->M_master_lpb->upload_file($this->filename);
		
		if($upload['result'] == "success"){ // Jika proses upload sukses
			// Load plugin PHPExcel nya
			include APPPATH.'third_party/PHPExcel/PHPExcel.php';
			
			$excelreader = new PHPExcel_Reader_Excel2007();
			$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
			$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			
			// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file form.php
			// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudha di upload sebelumnya
			$data['sheet'] = $sheet; 
		}else{ // Jika proses upload gagal
			$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
		}
		
		// print_r($data);
		// $this->import();
		$this->load->view('sgt/cc/lpblpj/v_lpb.php',$data);
	}



	public function export(){
		// print_r($_POST);
		$ArrTanggal = explode("-", $this->input->post('txtTanggalExport'));
		$dataLPBPolos = $this->M_master_lpb->getExportLpbPolos($ArrTanggal[0],$ArrTanggal[1]);	
		$dataLPBResmi = $this->M_master_lpb->getExportLpbResmi($ArrTanggal[0],$ArrTanggal[1]);	
		// print_r($dataLPB);
		// print_r($dataLPB[0]->id_lpb);

		// ===========================================================

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excel = new PHPExcel();

		$excel->getProperties()->setCreator('Profits')
		->setLastModifiedBy('Profits')
		->setTitle("LPB ". $ArrTanggal[0] ."-". $ArrTanggal[1])
		->setSubject("LPB")
		->setDescription("LPB")
		->setKeywords("LPB");

		$excel->getActiveSheet()->setTitle("LPB POLOS");

		$style_head = array(
			'font' => array('bold' => TRUE), 
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
			)
		);

		$style_kredit = array(
			'font' => array('bold' => TRUE), 
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ), 
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ) 
			)
		);
		
		$style_Grand = array(
			'font' => array('bold' => TRUE,
				'color' => array('rgb' => 'E30606'),
				'size'  => 13,
			), 

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			
		);

		$style_pembelian = array(
			'font' => array('bold' => TRUE), 
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'FCE118')
			)
		);

		function FormatUang($xyz,$cells){
			$xyz->getActiveSheet()->getStyle($cells)->getNumberFormat()->setFormatCode("#,##0.00");
		}

		function Atengah($xyz,$cells){
			$xyz->getActiveSheet()->getStyle($cells)->applyFromArray(array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER 
				),
			));
		}

		function Akiri($xyz,$cells){
			$xyz->getActiveSheet()->getStyle($cells)->applyFromArray(array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
				),
			));
		}

		function Akanan($xyz,$cells){
			$xyz->getActiveSheet()->getStyle($cells)->applyFromArray(array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
				),
			));
		}


		$excel->setActiveSheetIndex(0)->setCellValue('A2', "JURNAL PENERIMAAN BARANG (RESMI)"); 
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "PERIODE ". $ArrTanggal[0] ."-". $ArrTanggal[1] ); 
		$excel->getActiveSheet()->mergeCells('A2:M2'); 
		$excel->getActiveSheet()->mergeCells('A3:M3');
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

		$excel->getActiveSheet()->mergeCells('A5:A6'); 
		$excel->getActiveSheet()->mergeCells('B5:B6'); 
		$excel->getActiveSheet()->mergeCells('C5:C6'); 
		$excel->getActiveSheet()->mergeCells('D5:D6'); 
		$excel->getActiveSheet()->mergeCells('E5:E6'); 
		$excel->getActiveSheet()->mergeCells('F5:F6'); 
		$excel->getActiveSheet()->mergeCells('G5:H5'); 
		$excel->getActiveSheet()->mergeCells('I5:I6'); 
		$excel->getActiveSheet()->mergeCells('J5:J6'); 
		$excel->getActiveSheet()->mergeCells('K5:K6'); 
		$excel->getActiveSheet()->mergeCells('L5:L6'); 
		$excel->getActiveSheet()->mergeCells('M5:M6'); 

		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_head);

		$excel->setActiveSheetIndex(0)->setCellValue('A5', "KODE REKENING"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B5', "ALOKASI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "KODE DEPT"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "TANGGAL"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "KETERANGAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "SUPLIER"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "REF NO. LPB"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G6', "INTR"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H6', "EX"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "QTY"); 
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "SAT"); 
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "HRG"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L5', "DEBET (Rp.)"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M5', "KREDIT (Rp.)"); 

		// ================================================================================
		$NumRow = 8;
		$logRekening = '';
		$DebetStart = '';
		$DebetFinish = '';
		$GrandTotalS='';
		$GrandTotalF='';
		$GrandDebetS='';
		$GrandDebetF='';
		$SelS='';
		$SelF='';
		foreach ($dataLPBPolos as $value) {
			// print_r($value->id_lpb);
			if ($logRekening == '') {
				$logRekening = $value->kode_rekening;
				$DebetStart = 'L'.$NumRow;
				$GrandTotalS=$DebetStart;
				$GrandDebetS=$DebetStart;
			}

			if ($logRekening != $value->kode_rekening) {
				$logRekening = $value->kode_rekening;
				$DebetFinish = 'L'.($NumRow-1);

				$excel->setActiveSheetIndex(0)->setCellValueExplicit('A'.$NumRow, "2101.01", PHPExcel_Cell_DataType::TYPE_STRING); 
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$NumRow, "HUTANG USAHA"); 
				$excel->setActiveSheetIndex(0)->setCellValue('M'.$NumRow, "=SUM(".$DebetStart.":".$DebetFinish.")"); 

				$excel->getActiveSheet()->mergeCells('B'.$NumRow.':L'.$NumRow); 

				$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_kredit);
				$excel->getActiveSheet()->getStyle('B'.$NumRow.':L'.$NumRow)->applyFromArray($style_kredit);
				$excel->getActiveSheet()->getStyle('M'.$NumRow)->applyFromArray($style_kredit);

				Atengah($excel,'A'.$NumRow);
				Atengah($excel,'B'.$NumRow);
				Akanan($excel,'M'.$NumRow);

				FormatUang($excel,'M'.$NumRow);

				$logDebet = 0;
				$NumRow += 3;
				$DebetStart = 'L'.$NumRow;
			}
			
			$excel->setActiveSheetIndex(0)->setCellValueExplicit('A'.$NumRow, $value->kode_rekening, PHPExcel_Cell_DataType::TYPE_STRING); 
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$NumRow, $value->alokasi_biaya); 
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$NumRow, $value->kode_departemen); 
			// $excel->setActiveSheetIndex(0)->setCellValue('D'.$NumRow, $value->tanggal); 
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$NumRow, $value->tanggal_format); 
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$NumRow, $value->keterangan); 
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$NumRow, $value->suplier); 
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$NumRow, $value->no_lpb_internal); 
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$NumRow, $value->no_lpb_eksternal); 
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$NumRow, $value->jumlah); 
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$NumRow, $value->satuan); 
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$NumRow, $value->harga_satuan); 
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$NumRow, $value->debet); 
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$NumRow, ''); 
			
			Atengah($excel,'A'.$NumRow);
			Atengah($excel,'B'.$NumRow);
			Atengah($excel,'C'.$NumRow);
			Atengah($excel,'D'.$NumRow);
			Akiri($excel,'E'.$NumRow);
			Akiri($excel,'F'.$NumRow);
			Atengah($excel,'G'.$NumRow);
			Atengah($excel,'H'.$NumRow);
			Akanan($excel,'I'.$NumRow);
			Akiri($excel,'J'.$NumRow);
			Akanan($excel,'K'.$NumRow);
			Akanan($excel,'L'.$NumRow);

			FormatUang($excel,'K'.$NumRow);
			FormatUang($excel,'L'.$NumRow);

			$NumRow ++;
		}

		$DebetFinish = 'L'.($NumRow-1);
		$GrandTotalF=$DebetFinish;
		$GrandDebetF='L'.$NumRow;
		$excel->setActiveSheetIndex(0)->setCellValueExplicit('A'.$NumRow, "2101.01", PHPExcel_Cell_DataType::TYPE_STRING); 
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$NumRow, "HUTANG USAHA"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$NumRow, "=SUM(".$DebetStart.":".$DebetFinish.")"); 

		$excel->getActiveSheet()->mergeCells('B'.$NumRow.':L'.$NumRow); 

		$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_kredit);
		$excel->getActiveSheet()->getStyle('B'.$NumRow.':L'.$NumRow)->applyFromArray($style_kredit);
		$excel->getActiveSheet()->getStyle('M'.$NumRow)->applyFromArray($style_kredit);

		$excel->getActiveSheet()->getStyle('A'.$NumRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('B'.$NumRow.':L'.$NumRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
		$excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		// ================================================================================

		$NumRow ++;
		$excel->getActiveSheet()->mergeCells('A'.$NumRow.':K'.$NumRow); 
		$excel->setActiveSheetIndex(0)->setCellValue('A'.$NumRow, "GRAND TOTAL"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L'.$NumRow, "=SUM(".$GrandTotalS.":".$GrandTotalF.")"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M'.$NumRow, "=SUM(".$GrandDebetS.":".$GrandDebetF.")"); 
		
		$excel->getActiveSheet()->getStyle('A'.$NumRow.':M'.$NumRow)->applyFromArray($style_Grand);
		
		Akanan($excel,'L'.$NumRow);
		Akanan($excel,'M'.$NumRow);
		
		FormatUang($excel,'L'.$NumRow);
		FormatUang($excel,'M'.$NumRow);
		
		$SelS = 'M'.$NumRow;
		// ================================================================================

		$NumRow ++;
		$excel->getActiveSheet()->mergeCells('I'.$NumRow.':K'.$NumRow); 
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$NumRow, "REKAP PEMBELIAN"); 
		
		$excel->getActiveSheet()->getStyle('I'.$NumRow.':K'.$NumRow)->applyFromArray($style_pembelian);
		$excel->getActiveSheet()->getStyle('M'.$NumRow)->applyFromArray($style_pembelian);
		Akanan($excel,'M'.$NumRow);
		FormatUang($excel,'M'.$NumRow);
		$SelF = 'M'.$NumRow;
		// ================================================================================
		$NumRow ++;
		$excel->setActiveSheetIndex(0)->setCellValue('K'.$NumRow, "SEL"); 
		$excel->setActiveSheetIndex(0)->setCellValue('L'.$NumRow, "=SUM(".$SelS."-".$SelF.")"); 

		$excel->getActiveSheet()->getStyle('K'.$NumRow.':L'.$NumRow)->applyFromArray($style_kredit);
		Akanan($excel,'L'.$NumRow);
		FormatUang($excel,'L'.$NumRow);
		// ============================================================
		// ============================================================
		// ============================================================
		






















		$excel->createSheet(1);
		$excel->setActiveSheetIndex(1)->setTitle("LPB RESMI");

		// $style_head = array(
		// 	'font' => array('bold' => TRUE), 
		// 	'alignment' => array(
		// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
		// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		// 	),
		// 	'borders' => array(
		// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
		// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
		// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
		// 	)
		// );

		// $style_kredit = array(
		// 	'font' => array('bold' => TRUE), 
		// 	'alignment' => array(
		// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		// 	),
		// 	'borders' => array(
		// 		'top' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ),
		// 		'right' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ), 
		// 		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ),
		// 		'left' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ) 
		// 	)
		// );
		
		// $style_Grand = array(
		// 	'font' => array('bold' => TRUE,
		// 	'color' => array('rgb' => 'E30606'),
		// 	'size'  => 13,
		// 	), 

		// 	'alignment' => array(
		// 		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
		// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		// 	),
		
		// );

		// $style_pembelian = array(
		// 	'font' => array('bold' => TRUE), 
		// 	'alignment' => array(
		// 		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
		// 	),
		// 	'fill' => array(
		// 		'type' => PHPExcel_Style_Fill::FILL_SOLID,
		// 		'color' => array('rgb' => 'FCE118')
		// 	)
		// );

		// function FormatUang($xyz,$cells){
		// 	$xyz->getActiveSheet()->getStyle($cells)->getNumberFormat()->setFormatCode("#,##0.00");
		// }

		// function Atengah($xyz,$cells){
		// 	$xyz->getActiveSheet()->getStyle($cells)->applyFromArray(array(
		// 		'alignment' => array(
		// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER 
		// 		),
		// 	));
		// }

		// function Akiri($xyz,$cells){
		// 	$xyz->getActiveSheet()->getStyle($cells)->applyFromArray(array(
		// 		'alignment' => array(
		// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT
		// 		),
		// 	));
		// }

		// function Akanan($xyz,$cells){
		// 	$xyz->getActiveSheet()->getStyle($cells)->applyFromArray(array(
		// 		'alignment' => array(
		// 			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT
		// 		),
		// 	));
		// }


		$excel->setActiveSheetIndex(1)->setCellValue('A2', "JURNAL PENERIMAAN BARANG RESMI"); 
		$excel->setActiveSheetIndex(1)->setCellValue('A3', "PERIODE ". $ArrTanggal[0] ."-". $ArrTanggal[1] ); 
		$excel->getActiveSheet()->mergeCells('A2:M2'); 
		$excel->getActiveSheet()->mergeCells('A3:M3');
		$excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

		$excel->getActiveSheet()->mergeCells('A5:A6'); 
		$excel->getActiveSheet()->mergeCells('B5:B6'); 
		$excel->getActiveSheet()->mergeCells('C5:C6'); 
		$excel->getActiveSheet()->mergeCells('D5:D6'); 
		$excel->getActiveSheet()->mergeCells('E5:E6'); 
		$excel->getActiveSheet()->mergeCells('F5:F6'); 
		$excel->getActiveSheet()->mergeCells('G5:H5'); 
		$excel->getActiveSheet()->mergeCells('I5:I6'); 
		$excel->getActiveSheet()->mergeCells('J5:J6'); 
		$excel->getActiveSheet()->mergeCells('K5:K6'); 
		$excel->getActiveSheet()->mergeCells('L5:L6'); 
		$excel->getActiveSheet()->mergeCells('M5:M6'); 

		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('M5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('A6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('J6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('K6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('L6')->applyFromArray($style_head);
		$excel->getActiveSheet()->getStyle('M6')->applyFromArray($style_head);

		$excel->setActiveSheetIndex(1)->setCellValue('A5', "KODE REKENING"); 
		$excel->setActiveSheetIndex(1)->setCellValue('B5', "ALOKASI"); 
		$excel->setActiveSheetIndex(1)->setCellValue('C5', "KODE DEPT"); 
		$excel->setActiveSheetIndex(1)->setCellValue('D5', "TANGGAL"); 
		$excel->setActiveSheetIndex(1)->setCellValue('E5', "KETERANGAN"); 
		$excel->setActiveSheetIndex(1)->setCellValue('F5', "SUPLIER"); 
		$excel->setActiveSheetIndex(1)->setCellValue('G5', "REF NO. LPB"); 
		$excel->setActiveSheetIndex(1)->setCellValue('G6', "INTR"); 
		$excel->setActiveSheetIndex(1)->setCellValue('H6', "EX"); 
		$excel->setActiveSheetIndex(1)->setCellValue('I5', "QTY"); 
		$excel->setActiveSheetIndex(1)->setCellValue('J5', "SAT"); 
		$excel->setActiveSheetIndex(1)->setCellValue('K5', "HRG"); 
		$excel->setActiveSheetIndex(1)->setCellValue('L5', "DEBET (Rp.)"); 
		$excel->setActiveSheetIndex(1)->setCellValue('M5', "KREDIT (Rp.)"); 

		// ================================================================================
		$NumRow = 8;
		$logRekening = '';
		$DebetStart = '';
		$DebetFinish = '';
		$GrandTotalS='';
		$GrandTotalF='';
		$GrandDebetS='';
		$GrandDebetF='';
		$SelS='';
		$SelF='';
		foreach ($dataLPBResmi as $value) {
			// print_r($value->id_lpb);
			if ($logRekening == '') {
				$logRekening = $value->kode_rekening;
				$DebetStart = 'L'.$NumRow;
				$GrandTotalS=$DebetStart;
				$GrandDebetS=$DebetStart;
			}

			if ($logRekening != $value->kode_rekening) {
				$logRekening = $value->kode_rekening;
				$DebetFinish = 'L'.($NumRow-1);

				$excel->setActiveSheetIndex(1)->setCellValueExplicit('A'.$NumRow, "2101.01", PHPExcel_Cell_DataType::TYPE_STRING); 
				$excel->setActiveSheetIndex(1)->setCellValue('B'.$NumRow, "HUTANG USAHA"); 
				$excel->setActiveSheetIndex(1)->setCellValue('M'.$NumRow, "=SUM(".$DebetStart.":".$DebetFinish.")"); 

				$excel->getActiveSheet()->mergeCells('B'.$NumRow.':L'.$NumRow); 

				$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_kredit);
				$excel->getActiveSheet()->getStyle('B'.$NumRow.':L'.$NumRow)->applyFromArray($style_kredit);
				$excel->getActiveSheet()->getStyle('M'.$NumRow)->applyFromArray($style_kredit);

				Atengah($excel,'A'.$NumRow);
				Atengah($excel,'B'.$NumRow);
				Akanan($excel,'M'.$NumRow);
				
				FormatUang($excel,'M'.$NumRow);

				$logDebet = 0;
				$NumRow += 3;
				$DebetStart = 'L'.$NumRow;
			}

			$excel->setActiveSheetIndex(1)->setCellValueExplicit('A'.$NumRow, $value->kode_rekening, PHPExcel_Cell_DataType::TYPE_STRING); 
			$excel->setActiveSheetIndex(1)->setCellValue('B'.$NumRow, $value->alokasi_biaya); 
			$excel->setActiveSheetIndex(1)->setCellValue('C'.$NumRow, $value->kode_departemen); 
			// $excel->setActiveSheetIndex(1)->setCellValue('D'.$NumRow, $value->tanggal); 
			$excel->setActiveSheetIndex(1)->setCellValue('D'.$NumRow, $value->tanggal_format); 
			$excel->setActiveSheetIndex(1)->setCellValue('E'.$NumRow, $value->keterangan); 
			$excel->setActiveSheetIndex(1)->setCellValue('F'.$NumRow, $value->suplier); 
			$excel->setActiveSheetIndex(1)->setCellValue('G'.$NumRow, $value->no_lpb_internal); 
			$excel->setActiveSheetIndex(1)->setCellValue('H'.$NumRow, $value->no_lpb_eksternal); 
			$excel->setActiveSheetIndex(1)->setCellValue('I'.$NumRow, $value->jumlah); 
			$excel->setActiveSheetIndex(1)->setCellValue('J'.$NumRow, $value->satuan); 
			$excel->setActiveSheetIndex(1)->setCellValue('K'.$NumRow, $value->harga_satuan); 
			$excel->setActiveSheetIndex(1)->setCellValue('L'.$NumRow, $value->debet); 
			$excel->setActiveSheetIndex(1)->setCellValue('M'.$NumRow, ''); 
			
			Atengah($excel,'A'.$NumRow);
			Atengah($excel,'B'.$NumRow);
			Atengah($excel,'C'.$NumRow);
			Atengah($excel,'D'.$NumRow);
			Akiri($excel,'E'.$NumRow);
			Akiri($excel,'F'.$NumRow);
			Atengah($excel,'G'.$NumRow);
			Atengah($excel,'H'.$NumRow);
			Akanan($excel,'I'.$NumRow);
			Akiri($excel,'J'.$NumRow);
			Akanan($excel,'K'.$NumRow);
			Akanan($excel,'L'.$NumRow);

			FormatUang($excel,'K'.$NumRow);
			FormatUang($excel,'L'.$NumRow);

			$NumRow ++;
		}

		$DebetFinish = 'L'.($NumRow-1);
		$GrandTotalF=$DebetFinish;
		$GrandDebetF='L'.$NumRow;
		$excel->setActiveSheetIndex(1)->setCellValueExplicit('A'.$NumRow, "2101.01", PHPExcel_Cell_DataType::TYPE_STRING); 
		$excel->setActiveSheetIndex(1)->setCellValue('B'.$NumRow, "HUTANG USAHA"); 
		$excel->setActiveSheetIndex(1)->setCellValue('M'.$NumRow, "=SUM(".$DebetStart.":".$DebetFinish.")"); 

		$excel->getActiveSheet()->mergeCells('B'.$NumRow.':L'.$NumRow); 

		$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_kredit);
		$excel->getActiveSheet()->getStyle('B'.$NumRow.':L'.$NumRow)->applyFromArray($style_kredit);
		$excel->getActiveSheet()->getStyle('M'.$NumRow)->applyFromArray($style_kredit);

		$excel->getActiveSheet()->getStyle('A'.$NumRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle('B'.$NumRow.':L'.$NumRow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
		$excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
		// ================================================================================

		$NumRow ++;
		$excel->getActiveSheet()->mergeCells('A'.$NumRow.':K'.$NumRow); 
		$excel->setActiveSheetIndex(1)->setCellValue('A'.$NumRow, "GRAND TOTAL"); 
		$excel->setActiveSheetIndex(1)->setCellValue('L'.$NumRow, "=SUM(".$GrandTotalS.":".$GrandTotalF.")"); 
		$excel->setActiveSheetIndex(1)->setCellValue('M'.$NumRow, "=SUM(".$GrandDebetS.":".$GrandDebetF.")"); 
		
		$excel->getActiveSheet()->getStyle('A'.$NumRow.':M'.$NumRow)->applyFromArray($style_Grand);
		
		Akanan($excel,'L'.$NumRow);
		Akanan($excel,'M'.$NumRow);
		
		FormatUang($excel,'L'.$NumRow);
		FormatUang($excel,'M'.$NumRow);
		
		$SelS = 'M'.$NumRow;
		// ================================================================================

		$NumRow ++;
		$excel->getActiveSheet()->mergeCells('I'.$NumRow.':K'.$NumRow); 
		$excel->setActiveSheetIndex(1)->setCellValue('I'.$NumRow, "REKAP PEMBELIAN"); 
		
		$excel->getActiveSheet()->getStyle('I'.$NumRow.':K'.$NumRow)->applyFromArray($style_pembelian);
		$excel->getActiveSheet()->getStyle('M'.$NumRow)->applyFromArray($style_pembelian);
		Akanan($excel,'M'.$NumRow);
		FormatUang($excel,'M'.$NumRow);
		$SelF = 'M'.$NumRow;
		// ================================================================================
		$NumRow ++;
		$excel->setActiveSheetIndex(1)->setCellValue('K'.$NumRow, "SEL"); 
		$excel->setActiveSheetIndex(1)->setCellValue('L'.$NumRow, "=SUM(".$SelS."-".$SelF.")"); 

		$excel->getActiveSheet()->getStyle('K'.$NumRow.':L'.$NumRow)->applyFromArray($style_kredit);
		Akanan($excel,'L'.$NumRow);
		FormatUang($excel,'L'.$NumRow);

		



















		// ============================================================
		// ============================================================
		// ============================================================
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="LPB '.$ArrTanggal[0] ."-". $ArrTanggal[1].'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	

	public function contoh(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('My Notes Code')
		->setLastModifiedBy('My Notes Code')
		->setTitle("Data Siswa")
		->setSubject("Siswa")
		->setDescription("Laporan Semua Data Siswa")
		->setKeywords("Data Siswa");
		
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		'font' => array('bold' => true), // Set font nya jadi bold
		'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
	);
		
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
			'alignment' => array(
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
			'borders' => array(
			'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
			'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
			'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
			'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
		);
		
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
		
		// Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
		$excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
		$excel->setActiveSheetIndex(0)->setCellValue('D3', "JENIS KELAMIN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "ALAMAT"); // Set kolom E3 dengan tulisan "ALAMAT"
		
		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		
		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$siswa = $this->SiswaModel->view();
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($siswa as $data){ // Lakukan looping pada variabel siswa
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nis);
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jenis_kelamin);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->alamat);
			
		// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			
		$no++; // Tambah 1 setiap kali looping
		$numrow++; // Tambah 1 setiap kali looping
	}
	
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
		$excel->setActiveSheetIndex(0);
		
		// ============================================================
		// ============================================================
		// ============================================================
		//Start adding next sheets
		$i=1;
		while ($i < 10) {
			
		// Add new sheet
		$objWorkSheet = $excel->createSheet($i); //Setting index when creating
		
		//Write cells
		$objWorkSheet->setCellValue('A1', 'Hello'.$i)
		->setCellValue('B2', 'world!')
		->setCellValue('C1', 'Hello')
		->setCellValue('D2', 'world!');
		
		// Rename sheet
		$objWorkSheet->setTitle("$i");
		
		$i++;
	}
		// ============================================================
		// ============================================================
		// ============================================================
	
		// Proses file excel
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data LPB.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	
	function getDataLPBbyId()
	{
		$id_lpb = $this->input->post('id_lpb');
		$dataX = $this->M_master_lpb->getDataById($id_lpb);	
		print_r(json_encode($dataX));
		// print_r($dataX);
	}

	function getDataDepartementById()
	{
		$id_departement = $this->input->post('id_departement');
		$dataX = $this->M_master_departemen->getByIdDepartemen($id_departement);	
		print_r(json_encode($dataX));
		// print_r($dataX);
	}

	function ubahLpb()
	{
		// print_r($_POST);

		// Array
		// (
		// 	[txtIdLpb] => 14200
		// 	[cmbInvestE] => 
		// 	[TxtKodeRekeningE] => 5224.04
		// 	[cmbUnitE] => Holo II
		// 	[cmbDepartementE] => QC@2P5@55@5A
		// 	[cmbJenisE] => POLOS
		// 	[cmbSumberE] => LOKAL
		// 	[txtTanggalE] => 2020-12-30
		// 	[txtSupplierE] => PURNAMA REPRO
		// 	[txtKeteranganE] => FILM SPECKLE METERAI 10K UK.25CMX10CM                       
		// 	[txtNoLpbInternalE] => 0125
		// 	[txtNoLpbExternalE] => 8656
		// 	[txtQuantityE] => 1
		// 	[txtSatuanE] => LBR
		// 	[txtHargaE] => 56980.00
		// 	[txtDebetE] => 56980.00
		// )

		$DumpDept = explode("@",$this->input->post('cmbDepartementE'));

		$data['ID_LPB']=$this->input->post('txtIdLpb');
		$data['KODE_INVEST']=$this->input->post('cmbInvestE');
		$data['KODE_REKENING']=$this->input->post('TxtKodeRekeningE');
		$data['ALOKASI_BIAYA']=$DumpDept[3];
		$data['KODE_DEPARTEMEN']=$DumpDept[2];
		$data['TANGGAL']=$this->input->post('txtTanggalE');
		$data['KETERANGAN']=$this->input->post('txtKeteranganE');
		$data['SUPLIER']=$this->input->post('txtSupplierE');
		$data['NO_LPB_INTERNAL']=$this->input->post('txtNoLpbInternalE');
		$data['NO_LPB_EKSTERNAL']=$this->input->post('txtNoLpbExternalE');
		$data['JUMLAH']=$this->input->post('txtQuantityE');
		$data['SATUAN']=$this->input->post('txtSatuanE');
		$data['HARGA_SATUAN']=$this->input->post('txtHargaE');
		$data['DEBET']=$this->input->post('txtDebetE');
		$data['STATUS']=$this->input->post('cmbJenisE');
		$data['SUMBER_BARANG']=$this->input->post('cmbSumberE');

		$success = $this->M_master_lpb->Edit($data);
		if($success){
			$_SESSION['pesan'].='<font color="blue">Berhasil diubah</font>';
			redirect('sgt/cc/lpblpj/lpb', "refresh");
		}else{
			echo "error";
			exit();
		}
	}


	
}

?>