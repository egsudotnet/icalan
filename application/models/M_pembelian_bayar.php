<?php
class M_pembelian_bayar extends CI_Model{
 
	// function pr($str, $die = true) {
	// 	if ($str) {
	// 		if (is_object($str) || is_array($str)) {
	// 			echo "<pre>" . print_r($str, true) . "</pre>";
	// 		} else {
	// 			echo "<pre>$str</pre>";
	// 		}
	// 	}

	// 	if ($die) {
	// 		echo "---------------------------------------- die ----------------------------------------";
	// 		die();
	// 	}
	// }


	function get_utang( $kodeSupplier, $tanggalDari, $tanggalSampai, $nofak, $status){
		$result = [];
		$additionalQuery = " beli_kembalian <= 0 "; 

		if($status == "0"){
			$additionalQuery .= " AND beli_kembalian < 0 ";
		}
		if($status == "1"){
			$additionalQuery .= " AND beli_kembalian = 0 ";
		}

		if(empty($additionalQuery)){
			$additionalQuery .= " 1=1  ";
		}

		if(!empty($tanggalDari) && !empty($tanggalSampai)){
			$additionalQuery .= " AND beli_tanggal BETWEEN '$tanggalDari' AND '$tanggalSampai' ";
		}
		if(!empty($tanggalDari) && empty($tanggalSampai)){
			$additionalQuery .= " AND beli_tanggal >= '$tanggalDari' ";
		}
		if(empty($tanggalDari) && empty(!$tanggalSampai)){
			$additionalQuery .= " AND beli_tanggal <= '$tanggalSampai' ";
		}
		
		if(!empty($nofak)){
			$additionalQuery .= " AND beli_nofak = '$nofak' ";
		} 
		if(!empty($kodeSupplier)){
			$additionalQuery .= " AND beli_suplier_id = '$kodeSupplier' ";
		}

		$query = $this->db->query("
		SELECT
			beli_nofak,suplier_nama, DATE_FORMAT(beli_tanggal, '%d-%m-%Y %H:%i')beli_tanggal, beli_total, beli_jml_uang, beli_kembalian, beli_user_id, b.user_nama 
		FROM tbl_beli a 
		LEFT JOIN tbl_user b ON a.beli_user_id=b.user_id
		LEFT JOIN tbl_suplier c ON a.beli_suplier_id=c.suplier_id
		WHERE $additionalQuery
		"); 
        if($query->num_rows()>0){
			$result = $query->result();
        } 
		return $result;
	}
	

	function get_list_barang($nofak){
		$result = []; 

		$query = $this->db->query("
			SELECT 
				b.barang_nama AS barang_nama , 
				b.barang_satuan AS barang_satuan , 
				b.barang_harpok AS barang_harpok, 
				b.barang_harjul AS barang_harjul, 
				d_beli_jumlah AS qty, 
				d_beli_total AS total
			FROM  tbl_detail_beli as a
                 LEFT JOIN tbl_barang b ON a.d_beli_barang_id=b.barang_id
			WHERE d_beli_nofak='$nofak'
		"); 
        if($query->num_rows()>0){
			$result = $query->result();
        } 
		return $result;
	}

	function get_list_bayar($nofak){
		$result = []; 

		$query = $this->db->query("
			SELECT 
				bayar_nofak, utang, bayar_tanggal, bayar_jml_uang, bayar_kurang, b.user_nama 
			FROM tbl_beli_bayar a 
					LEFT JOIN tbl_user b ON a.bayar_user_id=b.user_id
			WHERE beli_nofak='$nofak'
			ORDER BY bayar_tanggal
		"); 
        if($query->num_rows()>0){
			$result = $query->result();
        } 
		return $result;
	}
	
	function simpan_pembayaran($nofak, $kurangBayar, $inputBayar,$kurangBayarBaru){ 
		$idadmin=$this->session->userdata('idadmin');  
		$this->db->trans_start(); 
		try {  
			$bayarNofak = $this->get_bayar_nofak();   
			$kurangBayar = $kurangBayar * -1;
			$kurangBayarBaru = $kurangBayarBaru * -1;
			$this->db->query("
				INSERT INTO tbl_beli_bayar
				(
					bayar_nofak,
					beli_nofak,
					utang,
					bayar_jml_uang,
					bayar_kurang,
					bayar_user_id)
				VALUES 
				(
					'$bayarNofak',
					'$nofak',
					'$kurangBayar',
					'$inputBayar',
					'$kurangBayarBaru',
					'$idadmin');
			");   


			$this->db->query("
				UPDATE tbl_beli
				SET  
					beli_jml_uang = (SELECT SUM(bayar_jml_uang) FROM tbl_beli_bayar WHERE beli_nofak='$nofak'),
					beli_kembalian = beli_jml_uang - beli_total
				WHERE
					beli_nofak='$nofak'
			");  
			 
			$this->db->trans_commit();  
			$response = [
				'status' => true,
				'message' => 'Proses Simpan Berhasil'
			];
		} catch ( Exception $e ) { 
			$this->db->trans_rollback(); 
			$response = [
				'status' => false,
				'message' => $e,
				'data' =>['nofak' => $nofak], tanggalTransaksi
			];
			$this->_log_request($authorized = true, serialize($response), serialize($errors), serialize($detailData));
			return $response;  
		}

		return $response;
	}

	function get_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(beli_nofak,6)) AS kd_max FROM tbl_beli WHERE DATE(beli_tanggal)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
		 
		$tanggal = $this->db->query("SELECT DATE_FORMAT(CURDATE(),'%y%m%d') AS Tanggal")->row()->Tanggal;  
        // return date('dmy').$kd;
		return $tanggal.$kd;
	}
	
	function get_bayar_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(bayar_nofak,6)) AS kd_max FROM tbl_beli_bayar WHERE DATE(bayar_tanggal)=CURDATE()");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%06s", $tmp);
            }
        }else{
            $kd = "000001";
        }
		 
		$tanggal = $this->db->query("SELECT DATE_FORMAT(CURDATE(),'%y%m%d') AS Tanggal")->row()->Tanggal;  
        // return date('dmy').$kd;
		return $tanggal.$kd;
	} 
}