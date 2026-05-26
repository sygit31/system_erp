<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Back_up_pengeluaran_barang extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->load->model('administrator/M_log');
		$this->M_log->set_nls_global();
		
		$this->load->model('M_gudang_order');
		$this->load->model('M_detail_penerimaan');
		$this->load->model('M_pengeluaran');
		$this->load->model('M_detail_pengeluaran');
		session_start();
	}
	
	function index()
	{
		$dataX['order'] = $this->getDataindex();
		$dataX['laporan_pengeluaran'] = $this->M_pengeluaran->getPengeluaran();
		$dataX['stokBarang'] = $this->M_detail_penerimaan->getPenerimaanOk();
		
		$this->load->view('gudang/v_pengeluaran_barang.php',$dataX);
	}


	function getDataindex()
	{
		$order = $this->M_gudang_order->getOrder();

		$data = array();
		for($i=0;$i<count($order);$i++){
				//AMBIL TOTAL (SUM) PENGELUARAN SESUAI ORDER GUDANG
			$QTYx = $this->M_detail_pengeluaran->getQTYbyOrderGudang($order[$i]->ID);
			$QTYz = $QTYx[0]->QTY;
			if ($QTYz == "") {
				$QTYz = 0;
			}
			$outstanding = $order[$i]->QTY - $QTYz;

			$data[$i]['TANGGAL_PENGGUNAAN'] = $order[$i]->TANGGAL_PENGGUNAAN;
			$data[$i]['BARANG'] = $order[$i]->BARANG;
			$data[$i]['QTY'] = $order[$i]->QTY;
			$data[$i]['REALISASI'] = $QTYz;
			$data[$i]['OUTSTANDING'] = $outstanding;
			$data[$i]['SATUAN'] = $order[$i]->SATUAN;
			$data[$i]['BAGIAN'] = $order[$i]->BAGIAN;
			$data[$i]['KETERANGAN_PENGGUNAAN'] = $order[$i]->KETERANGAN_PENGGUNAAN;
			$data[$i]['ID_BARANG'] = $order[$i]->ID_BARANG;
			$data[$i]['ID_GUDANG_ORDER'] = $order[$i]->ID;
		}

		return $data;
	}

	
	public function list_barang()
	{
	  		// print_r($_POST);

		$id_barang = $this->input->post('id_barang');
		$outstanding = $this->input->post('outstanding');
		$jmlRoll = $this->input->post('jmlRoll');
		$order = $this->M_detail_penerimaan->getPenerimaanOkByIdBarang($id_barang);

		  	// print_r($order);
		$total_barang = 0;
		$total_list = 0;
		for($i=0;$i<count($order);$i++){
			if ($total_list < $jmlRoll){
				if ($total_barang < $outstanding) {
					echo
					"<tr>
					<td hidden><input type='text' id='txtIdDetailTerima".$i."' name='txtIdDetailTerima".$i."' class='form-control' value=".$order[$i]->ID_DETAIL_TERIMA."></td>
					<td width = '255'><input type='text' id='txtBarcode".$i."' name='txtBarcode".$i."' class='form-control' value=".$order[$i]->BARCODE." readonly></td>
					<td width = '255'><input type='text' id='txtQty".$i."' name='txtQty".$i."' class='form-control' value=".$order[$i]->QTY_TERIMA." readonly style='text-align:right;'></td>
					<td width = '150'><input type='text' id='txtSatuan".$i."' name='txtSatuan".$i."' class='form-control' value=".$order[$i]->SATUAN." readonly></td>
					
					</tr>";
					$total_barang += $order[$i]->QTY_TERIMA;
					$total_list += 1;
				    	// <td width = '30' align = 'center'><input type='checkbox' id='cbPakai".$i."' name='cbPakai".$i."' class='minimal' value='ya' checked></td>
				}
			}
		}

		echo
		"<tr style='display: none;'>
		<td><input type='text' id='txtTotalBarang' name='txtTotalBarang' class='form-control' value=".$total_barang."></td>
		<td><input type='text' id='xxxxx' name='xxxxx' class='form-control' value=''></td>
		<td><input type='text' id='yyyyy' name='yyyyy' class='form-control' value=''></td>
		<td><input type='text' id='txtTotalList' name='txtTotalList' class='form-control' value=".$total_list."></td>
		
		</tr>";
		    	// <td style='visibility:collapse;'><input type='text' id='zzzzz' name='zzzzz' class='form-control' value=''></td>
	}


	public function all_barang()
	{
		$data = $this->input->post('id_gudang_order');
		$stokBarang = $this->M_detail_penerimaan->getPenerimaanOkByIdGudangOrder($data);
		
		$response = "<option value=''></option>";
		foreach($stokBarang as $row){ 
			$response .= "<option value=".$row->ID_DETAIL_TERIMA.">".$row->BARCODE."</option>";
		} 

		print_r($response);
	}


	public function penuhi()
	{
			// print_r($_POST);
		
		$CRE = explode('|',$_SESSION['logERP']);
		$data['IdLogin'] = $CRE[0];
		$data['NomerIPB'] = $this->input->post('txtNomerIPB');
		$data['IdGudangOrder'] = $this->input->post('txtIdGudangOrder');

		$dataDetail = array();
		$TotalList = $this->input->post('txtTotalList');
		for($i=0;$i<$TotalList;$i++){
			$dataDetail[$i]['BARCODE'] = $this->input->post('txtBarcode'.$i);
			$dataDetail[$i]['QTY'] = $this->input->post('txtQty'.$i);
			$dataDetail[$i]['SATUAN'] = $this->input->post('txtSatuan'.$i);
			$dataDetail[$i]['ID_DETAIL_TERIMA'] = $this->input->post('txtIdDetailTerima'.$i);
		}

			// print_r($dataDetail);
		$success = $this->M_pengeluaran->save($data);
		
		if($success){
			$success = $this->M_detail_pengeluaran->save($dataDetail);
		}else{
			echo "error";
			exit();
		}

			//update status detail penerimaan
		if($success){
			$success = $this->M_detail_penerimaan->UpdateStatusPengeluaranGudang($dataDetail);
		}else{
			echo "error";
			exit();
		}

			//update status gudang order
		if($success){
			$status = $this->input->post('txtStatusGudangOrder');
			if ($status == "CLOSE"){
				$datax['status'] = $status;
				$datax['id'] = $data['IdGudangOrder'];
				$success = $this->M_gudang_order->updateStatus($datax);
			}
		}else{
			echo "error";
			exit();
		}

		if($success){
			$this->index();
		}else{
			echo "error";
			exit();
		}
	}


	public function penuhiManual()
	{
			// print_r($_POST);
		
		$CRE = explode('|',$_SESSION['logERP']);
		$data['IdLogin'] = $CRE[0];
		$data['NomerIPB'] = $this->input->post('txtMNomerIPB');
		$data['IdGudangOrder'] = $this->input->post('txtMIdGudangOrder');

		$dataDetail = array();
		$TotalList = $this->input->post('txtNomorDetail');
		for($i=0;$i<=$TotalList;$i++){
			$dataDetail[$i]['BARCODE'] = $this->input->post('txtDBarcode'.$i);
			$dataDetail[$i]['QTY'] = $this->input->post('txtDJumlah'.$i);
			$dataDetail[$i]['SATUAN'] = $this->input->post('txtDSatuan'.$i);
			$dataDetail[$i]['ID_DETAIL_TERIMA'] = $this->input->post('txtDIdDTerima'.$i);
		}

			// print_r($dataDetail);
		$success = $this->M_pengeluaran->save($data);
		
		if($success){
			$success = $this->M_detail_pengeluaran->save($dataDetail);
		}else{
			echo "error";
			exit();
		}

			//update status detail penerimaan
		if($success){
			$success = $this->M_detail_penerimaan->UpdateStatusPengeluaranGudang($dataDetail);
		}else{
			echo "error";
			exit();
		}

			//update status gudang order
		if($success){
			$status = $this->input->post('txtMStatusGudangOrder');
			if ($status == "CLOSE"){
				$datax['status'] = $status;
				$datax['id'] = $data['IdGudangOrder'];
				$success = $this->M_gudang_order->updateStatus($datax);
			}
		}else{
			echo "error";
			exit();
		}

		if($success){
			$this->index();
		}else{
			echo "error";
			exit();
		}
	}



	public function tampil(){
		$data = array();
		$data['tanggalAwal'] = "";
		$data['tanggalAkhir'] = "";
		$tanggalAwal = $this->input->post("tanggalAwal");
		$tanggalAkhir = $this->input->post("tanggalAkhir");
			// print_r($data);
		$Xtanggal = explode(' ',$tanggalAwal); 
		$Bulan = $Xtanggal[1];
		if ($Bulan == 'Januari'){$data['tanggalAwal'] = $Xtanggal[0] . "/01/" . $Xtanggal[2];}
		if ($Bulan == 'Februari'){$data['tanggalAwal'] = $Xtanggal[0] . "/02/" . $Xtanggal[2];}
		if ($Bulan == 'Maret'){$data['tanggalAwal'] = $Xtanggal[0] . "/03/" . $Xtanggal[2];}
		if ($Bulan == 'April'){$data['tanggalAwal'] = $Xtanggal[0] . "/04/" . $Xtanggal[2];}
		if ($Bulan == 'Mei'){$data['tanggalAwal'] = $Xtanggal[0] . "/05/" . $Xtanggal[2];}
		if ($Bulan == 'Juni'){$data['tanggalAwal'] = $Xtanggal[0] . "/06/" . $Xtanggal[2];}
		if ($Bulan == 'Juli'){$data['tanggalAwal'] = $Xtanggal[0] . "/07/" . $Xtanggal[2];}
		if ($Bulan == 'Agustus'){$data['tanggalAwal'] = $Xtanggal[0] . "/08/" . $Xtanggal[2];}
		if ($Bulan == 'September'){$data['tanggalAwal'] = $Xtanggal[0] . "/09/" . $Xtanggal[2];}
		if ($Bulan == 'Oktober'){$data['tanggalAwal'] = $Xtanggal[0] . "/10/" . $Xtanggal[2];}
		if ($Bulan == 'November'){$data['tanggalAwal'] = $Xtanggal[0] . "/11/" . $Xtanggal[2];}
		if ($Bulan == 'Desember'){$data['tanggalAwal'] = $Xtanggal[0] . "/12/" . $Xtanggal[2];}

		$Xtanggal = explode(' ',$tanggalAkhir); 
		$Bulan = $Xtanggal[1];
		if ($Bulan == 'Januari'){$data['tanggalAkhir'] = $Xtanggal[0] . "/01/" . $Xtanggal[2];}
		if ($Bulan == 'Februari'){$data['tanggalAkhir'] = $Xtanggal[0] . "/02/" . $Xtanggal[2];}
		if ($Bulan == 'Maret'){$data['tanggalAkhir'] = $Xtanggal[0] . "/03/" . $Xtanggal[2];}
		if ($Bulan == 'April'){$data['tanggalAkhir'] = $Xtanggal[0] . "/04/" . $Xtanggal[2];}
		if ($Bulan == 'Mei'){$data['tanggalAkhir'] = $Xtanggal[0] . "/05/" . $Xtanggal[2];}
		if ($Bulan == 'Juni'){$data['tanggalAkhir'] = $Xtanggal[0] . "/06/" . $Xtanggal[2];}
		if ($Bulan == 'Juli'){$data['tanggalAkhir'] = $Xtanggal[0] . "/07/" . $Xtanggal[2];}
		if ($Bulan == 'Agustus'){$data['tanggalAkhir'] = $Xtanggal[0] . "/08/" . $Xtanggal[2];}
		if ($Bulan == 'September'){$data['tanggalAkhir'] = $Xtanggal[0] . "/09/" . $Xtanggal[2];}
		if ($Bulan == 'Oktober'){$data['tanggalAkhir'] = $Xtanggal[0] . "/10/" . $Xtanggal[2];}
		if ($Bulan == 'November'){$data['tanggalAkhir'] = $Xtanggal[0] . "/11/" . $Xtanggal[2];}
		if ($Bulan == 'Desember'){$data['tanggalAkhir'] = $Xtanggal[0] . "/12/" . $Xtanggal[2];}
		
		$dataX['laporan_pengeluaran'] = $this->M_pengeluaran->getPengeluaranByFilter($data);
		$dataX['order'] = $this->getDataindex();
		$dataX['stokBarang'] = $this->M_detail_penerimaan->getPenerimaanOk();
		
		$this->load->view('gudang/v_pengeluaran_barang.php',$dataX);
	}
}
?>