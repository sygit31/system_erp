<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_lpb extends CI_Model 
	{
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO MASTER_LPB 
            (ID_LPB,KODE_INVEST,KODE_REKENING,ALOKASI_BIAYA,KODE_DEPARTEMEN,
			TANGGAL,LOG_TANGGAL,KETERANGAN,SUPLIER,NO_LPB_INTERNAL,
			NO_LPB_EKSTERNAL,JUMLAH,SATUAN,HARGA_SATUAN,DEBET,STATUS,ACTIVE_STATUS,
			SUMBER_BARANG)
            VALUES
            (MI_MASTER_LPB.NEXTVAL,'". $data['KODE_INVEST'] ."',
            '". $data['KODE_REKENING'] ."','". $data['ALOKASI_BIAYA'] ."',
            '". $data['KODE_DEPARTEMEN'] ."',TO_DATE('". $data['TANGGAL'] ."','MM/DD/YYYY'),
            '". $data['LOG_TANGGAL'] ."','". $data['KETERANGAN'] ."',
            '". $data['SUPLIER'] ."','". $data['NO_LPB_INTERNAL'] ."',
            '". $data['NO_LPB_EKSTERNAL'] ."','". $data['JUMLAH'] ."',
            '". $data['SATUAN'] ."','". $data['HARGA_SATUAN'] ."',
            '". $data['DEBET'] ."','". $data['STATUS'] ."',
            '". $data['ACTIVE_STATUS'] ."','". $data['SUMBER_BARANG'] ."')";
			
			$success = $this->db->query($sql);

			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}
			
			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;
		}

		
		// ==================================================================
		// ==================================================================
		// ==================================================================

		public function getExportLpbPolos($bulan,$tahun) 
		{
			$sql = "SELECT *,DATE_FORMAT(tanggal,'%d/%m/%Y') tanggal_format FROM master_lpb
			WHERE DATE_FORMAT(tanggal,'%Y%m') = '".$tahun.$bulan."' AND status = 'POLOS'
			ORDER BY kode_rekening,tanggal";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getExportLpbResmi($bulan,$tahun) 
		{
			$sql = "SELECT *,DATE_FORMAT(tanggal,'%d/%m/%Y') tanggal_format FROM master_lpb
			WHERE DATE_FORMAT(tanggal,'%Y%m') = '".$tahun.$bulan."' AND status = 'RESMI' 
			ORDER BY kode_rekening,tanggal";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function save($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('mi',true);

			$sql = "INSERT INTO MASTER_LPB 
            (KODE_INVEST,KODE_REKENING,ALOKASI_BIAYA,KODE_DEPARTEMEN,
			TANGGAL,LOG_TANGGAL,KETERANGAN,SUPLIER,NO_LPB_INTERNAL,
			NO_LPB_EKSTERNAL,JUMLAH,SATUAN,HARGA_SATUAN,DEBET,STATUS,ACTIVE_STATUS,
			SUMBER_BARANG)
            VALUES
            ('". $data['KODE_INVEST'] ."',
            '". $data['KODE_REKENING'] ."','". $data['ALOKASI_BIAYA'] ."',
            '". $data['KODE_DEPARTEMEN'] ."',STR_TO_DATE('". $data['TANGGAL'] ."', '%m/%d/%Y'),
            '". $data['LOG_TANGGAL'] ."','". str_replace("'", "\'", $data['KETERANGAN'])  ."',
            '". $data['SUPLIER'] ."','". $data['NO_LPB_INTERNAL'] ."',
            '". $data['NO_LPB_EKSTERNAL'] ."','". $data['JUMLAH'] ."',
            '". $data['SATUAN'] ."','". $data['HARGA_SATUAN'] ."',
            '". $data['DEBET'] ."','". $data['STATUS'] ."',
            '". $data['ACTIVE_STATUS'] ."','". $data['SUMBER_BARANG'] ."')";

			$success = $this->db->query($sql);
			
			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}
			
			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;



			// ==============================================
			// ==============================================
			// ==============================================
			// ==============================================
			// $sql = "INSERT INTO MASTER_LPB 
   //          (KODE_INVEST,KODE_REKENING,ALOKASI_BIAYA,KODE_DEPARTEMEN,
			// TANGGAL,LOG_TANGGAL,KETERANGAN,SUPLIER,NO_LPB_INTERNAL,
			// NO_LPB_EKSTERNAL,JUMLAH,SATUAN,HARGA_SATUAN,DEBET,STATUS,ACTIVE_STATUS,
			// SUMBER_BARANG)
   //          VALUES
   //          (?,
   //          ?,?,
   //          ?,STR_TO_DATE('".$data['TANGGAL']."', '%m/%d/%Y'),
   //          ?,?,
   //          ?,?,
   //          ?,?,
   //          ?,?,
   //          ?,?,
   //          ?,? )";
			
			// $stmt = $this->db->prepare($sql);
			// $stmt->bind_param("ssssssssssssssss", $data['KODE_INVEST'], $data['KODE_REKENING'] , $data['ALOKASI_BIAYA'],
			// 	$data['KODE_DEPARTEMEN'],$data['LOG_TANGGAL'] , $data['KETERANGAN'] ,$data['SUPLIER'] , $data['NO_LPB_INTERNAL'] ,
			// 	$data['NO_LPB_EKSTERNAL'] ,$data['JUMLAH'],$data['SATUAN'] , $data['HARGA_SATUAN'] , $data['DEBET'] , $data['STATUS'],
			// 	$data['ACTIVE_STATUS'] , $data['SUMBER_BARANG'] 
			// 	);

		 //    $stmt->execute();
		 //    $stmt->close();

		 //    $mysqli->close();
		}


		public function Edit($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('mi',true);

			$sql = "UPDATE MASTER_LPB SET
            KODE_INVEST = '". $data['KODE_INVEST'] ."',
			KODE_REKENING = '". $data['KODE_REKENING'] ."',
			ALOKASI_BIAYA = '". $data['ALOKASI_BIAYA'] ."',
			KODE_DEPARTEMEN = '". $data['KODE_DEPARTEMEN'] ."',
			TANGGAL = STR_TO_DATE('". $data['TANGGAL'] ."', '%Y/%m/%d'),
			KETERANGAN = '". str_replace("'", "\'", $data['txtKeteranganE'])  ."',
			SUPLIER = '". $data['txtSupplierE'] ."',
			NO_LPB_INTERNAL = '". $data['txtNoLpbInternalE'] ."',
			NO_LPB_EKSTERNAL = '". $data['NO_LPB_EKSTERNAL'] ."',
			JUMLAH = '". $data['JUMLAH'] ."',
			SATUAN = '". $data['SATUAN'] ."',
			HARGA_SATUAN = '". $data['HARGA_SATUAN'] ."',
			DEBET = '". $data['DEBET'] ."',
			STATUS = '". $data['STATUS'] ."',
			ACTIVE_STATUS = '". $data['ACTIVE_STATUS'] ."',
			SUMBER_BARANG = '". $data['SUMBER_BARANG'] ."'
			WHERE id_lpb = '". $data['ID_LPB'] ."'";

			$success = $this->db->query($sql);
			
			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}
			
			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;

		}



		public function getDataLast() 
		{
			$sql = "SELECT *,DATE_FORMAT(l.tanggal,'%d/%m/%Y') tanggal_format FROM master_lpb l
			join master_departemen d on l.kode_departemen = d.id_departement
			where  l.tanggal > DATE_ADD(NOW(), INTERVAL -2 MONTH)
			order by id_lpb desc";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getDataById($data) 
		{
			$sql = "SELECT * FROM master_lpb WHERE id_lpb=". $data;

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}


		// ===================================================================

		// Fungsi untuk melakukan proses upload file
		public function upload_file($filename){
			$this->load->library('upload'); // Load librari upload
			
			$config['upload_path'] = './excel/';
			$config['allowed_types'] = 'xlsx';
			$config['max_size']	= '2048';
			$config['overwrite'] = true;
			$config['file_name'] = $filename;
		  
			$this->upload->initialize($config); // Load konfigurasi uploadnya
			if($this->upload->do_upload('fileLpb')){ // Lakukan upload dan Cek jika proses upload berhasil
				// Jika berhasil :
				$return = array('result' => 'success', 'fileLpb' => $this->upload->data(), 'error' => '');
				return $return;
			}else{
				// Jika gagal :
				$return = array('result' => 'failed', 'fileLpb' => '', 'error' => $this->upload->display_errors());
				return $return;
			}
		}

		// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
		public function insert_multiple($data){
			$this->db->set('ID_LPB', "MI_MASTER_LPB.NEXTVAL", FALSE); //false escape
			$this->db->set('LOG_TANGGAL', "CURRENT_DATE", FALSE); //false escape
			$this->db->insert_batch('MASTER_LPB', $data);
		  }
	}
?>