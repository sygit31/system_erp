<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_barang extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct();
	    	//Codeigniter : Write Less Do More
		$this->output->set_header('Last-Modified:'.gmdate('D,d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control:no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control:post-check=0,pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		$this->load->model('sgt/M_gudang_order');
		$this->load->model('sgt/M_detail_penerimaan');
		$this->load->model('sgt/M_pengeluaran');
		$this->load->model('sgt/M_detail_pengeluaran');
		$this->load->model('sgt/M_retour_gudang');
		$this->load->model('sgt/M_log_mutasi_pet_stok');
		$this->load->model('sgt/M_ipb');
		$this->load->model('sgt/M_ipb_detail');
		session_start();
	}
	

	function index()
	{
		$dataX['order'] = $this->getDataindex();
		$dataX['stokBarang'] = $this->M_detail_penerimaan->getPenerimaanOk();
		$dataX['laporan_pengeluaran'] = $this->M_pengeluaran->getPengeluaran();
		
		$this->load->view('sgt/gudang/v_pengeluaran_barang.php',$dataX);
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

				// Kurangi Outstanding dengan total retour dari produksi
			$ArrQTYr = $this->M_retour_gudang->getQTYbyOrderGudang($order[$i]->ID);
			$QTYr = $ArrQTYr[0]->QTY;
			if ($QTYr !== '') {
				$outstanding += $QTYr;
			}

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
			$data[$i]['ID_RELASI'] = $order[$i]->ID_RELASI;
			$data[$i]['RELASI'] = $order[$i]->RELASI;
			$data[$i]['SERI'] = $order[$i]->SERI;
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
		$dataTable = "";
		for($i=0;$i<count($order);$i++){
			if ($total_list < $jmlRoll){
				if ($total_barang < $outstanding) {
					$dataTable .=
					"<tr>
					<td hidden><input type='text' id='txtIdDetailTerima".$i."' name='txtIdDetailTerima".$i."' class='form-control' value=".$order[$i]->ID_DETAIL_TERIMA."></td>
					<td width = '175'><input type='text' id='txtBarcode".$i."' name='txtBarcode".$i."' class='form-control' value=".$order[$i]->KODE_ROLL." readonly></td>
					<td width = '175'><input type='text' id='txtQty".$i."' name='txtQty".$i."' class='form-control' value=".$order[$i]->QTY_TERIMA." readonly style='text-align:right;'></td>
					<td width = '150'><input type='text' id='txtSatuan".$i."' name='txtSatuan".$i."' class='form-control' value=".$order[$i]->SATUAN." readonly></td>
					</tr>";
					$total_barang += $order[$i]->QTY_TERIMA;
					$total_list += 1;
				    	// <td width = '30' align = 'center'><input type='checkbox' id='cbPakai".$i."' name='cbPakai".$i."' class='minimal' value='ya' checked></td>
				}
			}
		}

		$dataInfo =
		"<input type='hidden' id='txtTotalBarang' name='txtTotalBarang' class='form-control' value=".$total_barang.">
		<input type='hidden' id='txtTotalList' name='txtTotalList' class='form-control' value=".$total_list.">";
		
		$data['dataTable'] = $dataTable;
		$data['dataInfo'] = $dataInfo;
		print_r(json_encode($data));
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
			// $data['NomerIPB'] = $this->input->post('txtNomerIPB');
		$data['IdIpb'] = $this->input->post('cmbIPBX');
		$data['IdGudangOrder'] = $this->input->post('txtIdGudangOrder');

		$dataIPB['ID'] = $this->input->post('cmbIPBX');
		$dataIPB['PENERIMA'] = $this->input->post('cmbPenerima');
		$dataIPB['PEMBERI'] = $this->input->post('cmbPemberi');
		$dataIPB['PENGAWAS'] = $this->input->post('cmbPengawas');

		$jmlRoll = 0;
		$jmlMeter = 0;
		$dataDetail = array();
		$TotalList = $this->input->post('txtTotalList');
		for($i=0;$i<$TotalList;$i++){
			$dataDetail[$i]['BARCODE'] = $this->input->post('txtBarcode'.$i);
			$dataDetail[$i]['QTY'] = $this->input->post('txtQty'.$i);
			$dataDetail[$i]['SATUAN'] = $this->input->post('txtSatuan'.$i);
			$dataDetail[$i]['ID_DETAIL_TERIMA'] = $this->input->post('txtIdDetailTerima'.$i);
			$dataDetail[$i]['SERI'] = $this->input->post('txtSeri');

				//untuk log stok harian
			$jmlRoll += 1;
			$jmlMeter += $dataDetail[$i]['QTY'];

				// Update Status IPB Detail
			$dataIPBDetail['ID_DETAIL_TERIMA'] = $dataDetail[$i]['ID_DETAIL_TERIMA'];
			$dataIPBDetail['STATUS'] = 'CLOSE';
			$success = $this->M_ipb_detail->updateStatus($dataIPBDetail);
		}

			// print_r($dataDetail);
		$success = true;
		$success = $this->M_pengeluaran->save2($data);

			// Update IPB
		$success = $this->M_ipb->update($dataIPB);
		
		if($success){
			$success = $this->M_detail_pengeluaran->save($dataDetail);

				// Log stok
			try {
				$this->M_log_mutasi_pet_stok->UpdateStok('-',$jmlRoll,$jmlMeter);
			} catch (Exception $e) {
				$_SESSION['pesan'].='<font color="red">Log Stok Harian gagal disimpan!!!! <br /> Hubungi Programmer Segera</font> <br />';
			}
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
				// $this->index();
			$_SESSION['cetak']='ipb/cetak_ipb?id='.$dataIPB['ID'];
			$_SESSION['pesan'].='<font color="blue">Berhasil disimpan</font>';
				// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/pengeluaran_barang'>");
			redirect('sgt/gudang/pengeluaran_barang', "refresh");
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
				// $this->index();
			$_SESSION['pesan']='<font color="blue">Berhasil disimpan</font>';
			
				// print_r("<meta http-equiv='refresh' content='0; url=".base_url()."index.php/sgt/gudang/pengeluaran_barang'>");
			redirect('sgt/gudang/pengeluaran_barang', "refresh");
		}else{
			echo "error";
			exit();
		}
	}



	public function tampil(){
	  		// print_r($_POST);


		$data = array();
		$data['tanggalAwal'] = "";
		$data['tanggalAkhir'] = "";
		$data['seri'] = "";
		$tanggalAwal = $this->input->post("tanggalAwal");
		$tanggalAkhir = $this->input->post("tanggalAkhir");
		$seri = $this->input->post("cmbSeri");

		if ($tanggalAwal !== "") {
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
		}
		
		if ($tanggalAkhir !== "") {
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
		}
		
		if ($seri !== "") {
			$data['seri'] = $seri;
		}

		$dataX['laporan_pengeluaran'] = $this->M_pengeluaran->getPengeluaranByFilter($data);
		$dataX['order'] = $this->getDataindex();
		$dataX['stokBarang'] = $this->M_detail_penerimaan->getPenerimaanOk();
		
		$this->load->view('sgt/gudang/v_pengeluaran_barang.php',$dataX);
	}

	public function getIpbOrderByIdKKDetail()
	{
		$id_kk_detail = $this->input->post("id_kk_detail");
		$dataX = $this->M_ipb->getIpbOrderByIdKK($id_kk_detail);

			// print_r($id_kk_detail);
		print_r(json_encode($dataX));
	}

	public function getBarangByIdIpb()
	{
		$id_ipb = $this->input->post("id_ipb");
		$dataX = $this->M_ipb_detail->getBarangByIdIpb($id_ipb);

			// print_r($id_ipb);
		print_r(json_encode($dataX));
	}

}
?>