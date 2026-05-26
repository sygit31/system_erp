<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bskk extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('sgt/M_master_invest');
		$this->load->model('sgt/M_master_departemen');
		$this->load->model('sgt/M_master_bskk');
		$this->load->model('sgt/M_master_terima_bskk');
		$this->load->model('sgt/M_saldo_akhir_bskk');
		$this->load->model('sgt/M_master_keluar_bskk');
		session_start();
	}

	function add()
	{  	
		$data['data_invest'] = $this->M_master_invest->getInvest();	    	
		$data['data_unit'] = $this->M_master_departemen->getUnit();	    	
		$data['data_last'] = $this->M_master_bskk->getDataLast();	    	

		$this->load->view('sgt/cc/bskk/v_add.php',$data);
		// print_r($data['data_invest']);
	}

	function getDepartemen()
	{
		// $dPost = explode("@",$this->input->post('id_unit'));
		// $dataDepartemen = $this->M_master_departemen->getByUnit($dPost[0]);	    	
		$dPost = $this->input->post('id_unit');
		$dataDepartemen = $this->M_master_departemen->getByUnit($dPost);	    	

		print_r(json_encode($dataDepartemen));
		// print_r($_POST);
	}

	function simpan()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[txtNomerBPKK] => 
		// 	[txtTanggal] => 
		// 	[cmbInvest] => 
		// 	[TxtKodeRekening] => 
		// 	[cmbUnit] => 
		// 	[cmbDepartement] => 
		// 	[txtKeterangan] => 
		// 	[txtDebet] => 
		// 	[ArrNoBpkk] => Array
		// 		(
		// 			[0] => JDK03
		// 			[1] => JDK04
		// 		)

		// 	[ArrTanggal] => Array
		// 		(
		// 			[0] => 01-12-2020
		// 			[1] => 02-12-2020
		// 		)

		// 	[ArrInvest] => Array
		// 		(
		// 			[0] => 
		// 			[1] => INV010000002
		// 		)

		// 	[ArrRekening] => Array
		// 		(
		// 			[0] => 5213.08
		// 			[1] => 4123.08
		// 		)

		// 	[ArrUnit] => Array
		// 		(
		// 			[0] => Holo I
		// 			[1] => Holo II
		// 		)

		// 	[ArrDepartemen] => Array
		// 		(
		// 			[0] => 29
		// 			[1] => 13
		// 		)

		// 	[ArrKeterangan] => Array
		// 		(
		// 			[0] => Coba 1
		// 			[1] => Coba 2
		// 		)

		// 	[ArrDebet] => Array
		// 		(
		// 			[0] => 50.000.000
		// 			[1] => 600.000.000
		// 		)

		// )

		$ArrNoBpkk = $this->input->post('ArrNoBpkk');
		$ArrTanggal = $this->input->post('ArrTanggal');
		$ArrInvest = $this->input->post('ArrInvest');
		$ArrRekening = $this->input->post('ArrRekening');
		$ArrUnit = $this->input->post('ArrUnit');
		$ArrDepartemen = $this->input->post('ArrDepartemen');
		$ArrKeterangan = $this->input->post('ArrKeterangan');
		$ArrDebet = $this->input->post('ArrDebet');
		
		for ($i=0; $i < count($ArrNoBpkk); $i++) { 
			$data['KODE_REKENING']=$ArrRekening[$i];
			$data['DEPARTEMEN']=$ArrDepartemen[$i];
			$data['INVEST']=$ArrInvest[$i];
			$data['TANGGAL']=$ArrTanggal[$i];
			$data['KETERANGAN']=$ArrKeterangan[$i];
			$data['NO_BPKK']=$ArrNoBpkk[$i];
			$data['DEBET']=str_replace(".","",$ArrDebet[$i]);

			$this->M_master_bskk->save($data);	
		}
		
		$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
		redirect('sgt/cc/bskk/add', "refresh");
	}

	function getBSKKbyId()
	{  	
		// print_r($_POST);
		$id_bskk = $this->input->post('id_bskk');
		$data = $this->M_master_bskk->getById($id_bskk);	
		print_r(json_encode($data));
		// print_r($data);
	}



	function ubahBSKK()
	{  	
		// print_r($_POST);
		// Array
		// (
		// 	[txtId_Bskk] => 12349
		// 	[txtNomerBPKKE] => JDK057
		// 	[txtTanggalE] => 2021-01-09
		// 	[cmbInvestE] => 
		// 	[TxtKodeRekeningE] => 5301.10
		// 	[cmbUnitE] => Holo II
		// 	[cmbDepartementE] => Gudang@2P2@12
		// 	[txtKeteranganE] => THERMIS U/AC KANTOR PDL
		// 	[txtDebetE] => 25000
		// )

		$data['ID_BSKK']=$this->input->post('txtId_Bskk');
		$data['KODE_REKENING']=$this->input->post('TxtKodeRekeningE');
		$dumpDepartemen = explode("@",$this->input->post('cmbDepartementE'));
		$data['DEPARTEMEN']=$dumpDepartemen[2];
		$data['INVEST']=$this->input->post('cmbInvestE');
		$data['TANGGAL']=$this->input->post('txtTanggalE');
		$data['KETERANGAN']=$this->input->post('txtKeteranganE');
		$data['NO_BPKK']=$this->input->post('txtNomerBPKKE');
		$data['DEBET']=$this->input->post('txtDebetE');

		$success = $this->M_master_bskk->edit($data);
		if($success){
			$_SESSION['pesan'].='<font color="blue">Berhasil diubah</font>';
			redirect('sgt/cc/bskk/add', "refresh");
		}else{
			echo "error";
			exit();
		}
	}

	
	function terima()
	{  	
		$data['data_last'] = $this->M_master_terima_bskk->getDataLast();	    	

		$this->load->view('sgt/cc/bskk/v_terima.php',$data);
	}

	function simpanTerima()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[txtJenis] => adad
		// 	[txtTanggal] => 28-12-2020
		// 	[txtJumlah] => 4.545.454
		// )

		$data['JENIS'] = $this->input->post('txtJenis');
		$data['JUMLAH'] = str_replace(".","",$this->input->post('txtJumlah'));
		$data['TANGGAL'] = $this->input->post('txtTanggal');
		
		$success = $this->M_master_terima_bskk->save($data);	
		if ($success) {
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			redirect('sgt/cc/bskk/terima', "refresh");
		}
	}


	function saldo()
	{  	
		$data['data_last'] = $this->M_saldo_akhir_bskk->getDataLast();	    	

		$this->load->view('sgt/cc/bskk/v_saldo.php',$data);
	}

	function simpanSaldo()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[txtTanggal] => November-2022
		// 	[txtJumlah] => 66.000
		// )

		$periode = explode("-",$this->input->post('txtTanggal'));
		$data['BULAN'] = $periode[0];
		$data['TAHUN'] = $periode[1];
		$data['SALDO'] = str_replace(".","",$this->input->post('txtJumlah'));
		
		$success = $this->M_saldo_akhir_bskk->save($data);	
		if ($success) {
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			redirect('sgt/cc/bskk/saldo', "refresh");
		}
	}


	function keluar()
	{  	
		$data['data_last'] = $this->M_master_keluar_bskk->getDataLast();	    	

		$this->load->view('sgt/cc/bskk/v_keluar.php',$data);
	}

	function simpanKeluar()
	{
		// print_r($_POST);
		// Array
		// (
		// 	[txtPeriode] => Desember-2020
		// 	[txtKeterangan] => PERIODE TGL 01-07/12/2020
		// 	[txtJumlah] => 5.500.000
		// )

		$periode = explode("-",$this->input->post('txtPeriode'));
		$data['BULAN'] = $periode[0];
		$data['TAHUN'] = $periode[1];
		$data['KETERANGAN'] = $this->input->post('txtKeterangan');
		$data['JUMLAH'] = str_replace(".","",$this->input->post('txtJumlah'));
		
		$success = $this->M_master_keluar_bskk->save($data);	
		if ($success) {
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
			redirect('sgt/cc/bskk/saldo', "refresh");
		}
	}

	function tarik()
	{  	
		$this->load->view('sgt/cc/bskk/v_tarik.php');
	}


	function export(){
		$ArrTanggal = explode("-", $this->input->post('txtTanggal'));
		$dataBSKK = $this->M_master_bskk->getExportBSKK($ArrTanggal[0],$ArrTanggal[1]);	

		$dataTerima = $this->M_master_terima_bskk->getTerima($ArrTanggal[0],$ArrTanggal[1]);
		
		$bulan = '';
		$bulan = ($ArrTanggal[0]==1) ? 'Januari' : $bulan;
		$bulan = ($ArrTanggal[0]==2) ? 'Februari' : $bulan;
		$bulan = ($ArrTanggal[0]==3) ? 'Maret' : $bulan;
		$bulan = ($ArrTanggal[0]==4) ? 'April' : $bulan;
		$bulan = ($ArrTanggal[0]==5) ? 'Mei' : $bulan;
		$bulan = ($ArrTanggal[0]==6) ? 'Juni' : $bulan;
		$bulan = ($ArrTanggal[0]==7) ? 'Juli' : $bulan;
		$bulan = ($ArrTanggal[0]==8) ? 'Agustus' : $bulan;
		$bulan = ($ArrTanggal[0]==9) ? 'September' : $bulan;
		$bulan = ($ArrTanggal[0]==10) ? 'Oktober' : $bulan;
		$bulan = ($ArrTanggal[0]==11) ? 'November' : $bulan;
		$bulan = ($ArrTanggal[0]==12) ? 'Desember' : $bulan;
		$dataKeluar = $this->M_master_keluar_bskk->getKeluar($bulan,$ArrTanggal[1]);	

		$TglSaldo = $ArrTanggal[0] - 1;
		$TahunSaldo = ($TglSaldo==0) ? $ArrTanggal[1] - 1 : $ArrTanggal[1];

		$bulanSaldo = '';
		$bulanSaldo = ($TglSaldo==1) ? 'Januari' : $bulan;
		$bulanSaldo = ($TglSaldo==2) ? 'Februari' : $bulan;
		$bulanSaldo = ($TglSaldo==3) ? 'Maret' : $bulan;
		$bulanSaldo = ($TglSaldo==4) ? 'April' : $bulan;
		$bulanSaldo = ($TglSaldo==5) ? 'Mei' : $bulan;
		$bulanSaldo = ($TglSaldo==6) ? 'Juni' : $bulan;
		$bulanSaldo = ($TglSaldo==7) ? 'Juli' : $bulan;
		$bulanSaldo = ($TglSaldo==8) ? 'Agustus' : $bulan;
		$bulanSaldo = ($TglSaldo==9) ? 'September' : $bulan;
		$bulanSaldo = ($TglSaldo==10) ? 'Oktober' : $bulan;
		$bulanSaldo = ($TglSaldo==11) ? 'November' : $bulan;
		$bulanSaldo = ($TglSaldo==0) ? 'Desember' : $bulan;
		$dataSaldo = $this->M_saldo_akhir_bskk->getSaldo($bulanSaldo,$TahunSaldo);	

		// ===========================================================

		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excel = new PHPExcel();

		$excel->getProperties()->setCreator('Profits')
		->setLastModifiedBy('Profits')
		->setTitle("BSKK ". $ArrTanggal[0] ."-". $ArrTanggal[1])
		->setSubject("BSKK")
		->setDescription("BSKK")
		->setKeywords("BSKK");

		$excel->getActiveSheet()->setTitle("BSKK ". $ArrTanggal[0] ."-". $ArrTanggal[1]);

		function Fuang($xyz,$cells){
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

		function MergeC($xyz,$cellA,$cellB){
			$xyz->getActiveSheet()->mergeCells($cellA.':'.$cellB); 
		}


		$style_Tengah_Tebal = array(
			'font' => array('bold' => TRUE,
				'size'  => 13,
			), 

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
		);

		$style_Tengah_Tebal_16 = array(
			'font' => array('bold' => TRUE,
				'size'  => 16,
			), 

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
		);

		$style_Tengah_Tebal_Merah = array(
			'font' => array('bold' => TRUE,
				'color' => array('rgb' => 'E30606'),
				'size'  => 13,
			), 

			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
		);

		$style_Tengah_Tebal_Bordergaris = array(
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

		$style_GarisBawah = array(
			'borders' => array(
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN)
			)
		);

		$style_BorderPutus = array(
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ), 
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_DASHED ) 
			)
		);

		$style_Tebal_Tengah_Kuning = array(
			'font' => array('bold' => TRUE), 
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER 
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => 'FCE118')
			)
		);

		$style_Tebal_Tengah_Cyan = array(
			'font' => array('bold' => TRUE), 
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER ,
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER 
			),
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => array('rgb' => '00FFFF')
			)
		);

		MergeC($excel,'B1','I1');
		MergeC($excel,'B2','I2');
		MergeC($excel,'B3','I3');

		$excel->setActiveSheetIndex(0)->setCellValue('B1', "PT. PURA NUSAPERSADA - UNIT HOLOGRAFI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B2', "JURNAL PENGELUARAN KAS"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "PERIODE : November 2020"); 

		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_Tengah_Tebal);
		$excel->getActiveSheet()->getStyle('B2')->applyFromArray($style_Tengah_Tebal);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_Tengah_Tebal_Merah);

		MergeC($excel,'B5','B7');
		MergeC($excel,'C5','C7');
		MergeC($excel,'D5','D7');
		MergeC($excel,'E5','E7');
		MergeC($excel,'F5','F7');
		MergeC($excel,'G5','G7');
		MergeC($excel,'H5','H7');
		MergeC($excel,'I5','I7');

		$excel->setActiveSheetIndex(0)->setCellValue('B5', "KODE REKENING"); 
		$excel->setActiveSheetIndex(0)->setCellValue('C5', "DEPT"); 
		$excel->setActiveSheetIndex(0)->setCellValue('D5', "ALOKASI"); 
		$excel->setActiveSheetIndex(0)->setCellValue('E5', "TANGGAL"); 
		$excel->setActiveSheetIndex(0)->setCellValue('F5', "KETERANGAN"); 
		$excel->setActiveSheetIndex(0)->setCellValue('G5', "NO BPKK"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H5', "DEBET"); 
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "KREDIT"); 

		$excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_Tengah_Tebal_Bordergaris);

		$excel->getActiveSheet()->getStyle('B6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('C6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('D6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('E6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('H6')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('I6')->applyFromArray($style_Tengah_Tebal_Bordergaris);

		$excel->getActiveSheet()->getStyle('B7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('C7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('D7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('E7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('F7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('G7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('H7')->applyFromArray($style_Tengah_Tebal_Bordergaris);
		$excel->getActiveSheet()->getStyle('I7')->applyFromArray($style_Tengah_Tebal_Bordergaris);

		
		// ================================================================================
		$NumRow = 8;
		$logRekening = '';
		$DebetStart = '';
		$DebetFinish = '';
		$GrandDebetS='';
		$GrandDebetF='';

		foreach ($dataBSKK as $value) {
			if ($logRekening == '') {
				$logRekening = $value->kode_rekening;
				$DebetStart = 'H'.$NumRow;
				$GrandDebetS=$DebetStart;
			}

			if ($logRekening != $value->kode_rekening) {
				$logRekening = $value->kode_rekening;
				$DebetFinish = 'H'.($NumRow-1);

				MergeC($excel,'C'.$NumRow,'H'.$NumRow);
				
				$excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$NumRow, '1101.02', PHPExcel_Cell_DataType::TYPE_STRING);  
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$NumRow, 'KAS UNIT'); 
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$NumRow, "=SUM(".$DebetStart.":".$DebetFinish.")"); 

				$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
				$excel->getActiveSheet()->getStyle('I'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);

				$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_BorderPutus);
				$excel->getActiveSheet()->getStyle('I'.$NumRow)->applyFromArray($style_BorderPutus);

				Fuang($excel,'I'.$NumRow);

				$NumRow += 2;
				$DebetStart = 'H'.$NumRow;
			}

			$excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$NumRow, $value->kode_rekening, PHPExcel_Cell_DataType::TYPE_STRING);   
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$NumRow, $value->kode_departement); 
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$NumRow, $value->alokasi); 
			// $excel->setActiveSheetIndex(0)->setCellValue('E'.$NumRow, $value->tanggal); 
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$NumRow, $value->tanggal_format); 
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$NumRow, $value->keterangan); 
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$NumRow, $value->no_bpkk); 
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$NumRow, $value->debet); 

			$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_BorderPutus);
			$excel->getActiveSheet()->getStyle('I'.$NumRow)->applyFromArray($style_BorderPutus);

			Atengah($excel,'B'.$NumRow);
			Atengah($excel,'C'.$NumRow);
			Atengah($excel,'D'.$NumRow);
			Atengah($excel,'E'.$NumRow);
			Akiri($excel,'F'.$NumRow);
			Atengah($excel,'G'.$NumRow);
			Akanan($excel,'H'.$NumRow);

			Fuang($excel,'H'.$NumRow);
			$NumRow ++;
		}


		$DebetFinish = 'H'.($NumRow-1);
		$GrandDebetF=$DebetFinish;

		MergeC($excel,'C'.$NumRow,'H'.$NumRow);
		
		$excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$NumRow, '1101.02', PHPExcel_Cell_DataType::TYPE_STRING); 
		$excel->setActiveSheetIndex(0)->setCellValue('C'.$NumRow, 'KAS UNIT'); 
		$excel->setActiveSheetIndex(0)->setCellValue('I'.$NumRow, "=SUM(".$DebetStart.":".$DebetFinish.")"); 

		$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);
		$excel->getActiveSheet()->getStyle('I'.$NumRow)->applyFromArray($style_Tebal_Tengah_Kuning);

		$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('I'.$NumRow)->applyFromArray($style_BorderPutus);

		Fuang($excel,'I'.$NumRow);

		// ================================================================================
		
		$NumRow ++;

		MergeC($excel,'B'.$NumRow,'G'.$NumRow);
		$excel->setActiveSheetIndex(0)->setCellValue('B'.$NumRow, "TOTAL"); 
		$excel->setActiveSheetIndex(0)->setCellValue('H'.$NumRow, "=SUM(".$GrandDebetS.":".$GrandDebetF.")"); 

		$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);
		$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);
		$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);
		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);
		$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);
		$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);
		$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_Tebal_Tengah_Cyan);

		$excel->getActiveSheet()->getStyle('B'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('C'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('D'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_BorderPutus);
		$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_BorderPutus);

		Fuang($excel,'H'.$NumRow);

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(7);
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
		// ============================================================
		// ============================================================
		// ============================================================











		$excel->createSheet(1);
		$excel->setActiveSheetIndex(1)->setTitle("REKAP KK");

		MergeC($excel,'A2','H2');
		MergeC($excel,'A5','E5');

		$excel->setActiveSheetIndex(1)->setCellValue('A2', "REKAP KAS KECIL PERIODE ". $ArrTanggal[0] ."-". $ArrTanggal[1]); 
		$excel->setActiveSheetIndex(1)->setCellValue('A5', "SALDO AWAL PERIODE ". $ArrTanggal[0] ."-". $ArrTanggal[1]); 
		$excel->setActiveSheetIndex(1)->setCellValue('F5', "="); 
		$excel->setActiveSheetIndex(1)->setCellValue('G5', "Rp."); 
		$excel->setActiveSheetIndex(1)->setCellValue('H5', $dataSaldo[0]->saldo); 
		Fuang($excel,'H5');

		$CSaldoAwal='H5';

		$excel->getActiveSheet()->getStyle('A2')->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_Tengah_Tebal_16);


		// ================================================================================
		$NumRow = 7;
		MergeC($excel,'A'.$NumRow,'E'.$NumRow);
		$excel->setActiveSheetIndex(1)->setCellValue('A'.$NumRow, "Terima"); 
		$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_Tengah_Tebal_Merah);
		
		$nomer = 1;
		$NumRow ++;
		$DebetS = 'E'.$NumRow;
		$DebetF = '';
		foreach ($dataTerima as $value) {
			$excel->setActiveSheetIndex(1)->setCellValue('A'.$NumRow, $nomer); 
			$excel->setActiveSheetIndex(1)->setCellValue('B'.$NumRow, $value->jenis); 
			$excel->setActiveSheetIndex(1)->setCellValue('C'.$NumRow, '='); 
			$excel->setActiveSheetIndex(1)->setCellValue('D'.$NumRow, 'Rp.'); 
			$excel->setActiveSheetIndex(1)->setCellValue('E'.$NumRow, $value->jumlah); 
			Fuang($excel,'E'.$NumRow);

			$DebetF = 'E'.$NumRow;
			$NumRow ++;
			$nomer ++;
		}

		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_GarisBawah);
		$excel->getActiveSheet()->getRowDimension($NumRow)->setRowHeight(3);
		$NumRow ++;
		
		$excel->setActiveSheetIndex(1)->setCellValue('E'.$NumRow, '=SUM('.$DebetS.':'.$DebetF.')'); 
		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_Tengah_Tebal);
		Fuang($excel,'E'.$NumRow);
		
		$CTerima = 'E'.$NumRow;
		$NumRow += 3;

		// ================================================================================
		
		MergeC($excel,'A'.$NumRow,'E'.$NumRow);
		$excel->setActiveSheetIndex(1)->setCellValue('A'.$NumRow, "Keluar"); 
		$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_Tengah_Tebal_Merah);

		$nomer = 1;
		$NumRow ++;
		$DebetS = 'E'.$NumRow;
		$DebetF = '';
		foreach ($dataKeluar as $value) {
			// print_r($value);
			$excel->setActiveSheetIndex(1)->setCellValue('A'.$NumRow, $nomer); 
			$excel->setActiveSheetIndex(1)->setCellValue('B'.$NumRow, $value->Keterangan); 
			$excel->setActiveSheetIndex(1)->setCellValue('C'.$NumRow, '='); 
			$excel->setActiveSheetIndex(1)->setCellValue('D'.$NumRow, 'Rp.'); 
			$excel->setActiveSheetIndex(1)->setCellValue('E'.$NumRow, $value->jumlah); 
			Fuang($excel,'E'.$NumRow);

			$DebetF = 'E'.$NumRow;
			$NumRow ++;
			$nomer ++;
		}

		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_GarisBawah);
		$excel->getActiveSheet()->getRowDimension($NumRow)->setRowHeight(3);
		$NumRow ++;
		
		$excel->setActiveSheetIndex(1)->setCellValue('E'.$NumRow, '=SUM('.$DebetS.':'.$DebetF.')'); 
		$excel->getActiveSheet()->getStyle('E'.$NumRow)->applyFromArray($style_Tengah_Tebal);
		Fuang($excel,'E'.$NumRow);
		
		$CKeluar = 'E'.$NumRow;
		$NumRow += 2;

		// ================================================================================

		MergeC($excel,'A'.$NumRow,'E'.$NumRow);
		$excel->setActiveSheetIndex(1)->setCellValue('A'.$NumRow, 'SALDO AKHIR PERIODE '. $ArrTanggal[0] ."-". $ArrTanggal[1]); 
		$excel->setActiveSheetIndex(1)->setCellValue('F'.$NumRow, '='); 
		$excel->setActiveSheetIndex(1)->setCellValue('G'.$NumRow, 'Rp.'); 
		$excel->setActiveSheetIndex(1)->setCellValue('H'.$NumRow, '='.$CSaldoAwal.'+'.$CTerima.'-'.$CKeluar); 

		$excel->getActiveSheet()->getStyle('A'.$NumRow)->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('F'.$NumRow)->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('G'.$NumRow)->applyFromArray($style_Tengah_Tebal_16);
		$excel->getActiveSheet()->getStyle('H'.$NumRow)->applyFromArray($style_Tengah_Tebal_16);

		Fuang($excel,'H'.$NumRow);

		// ================================================================================

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
		$excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);










		// ============================================================
		// ============================================================
		// ============================================================
		
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="BSKK '. $ArrTanggal[0] .'-'. $ArrTanggal[1].'.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}


}

?>