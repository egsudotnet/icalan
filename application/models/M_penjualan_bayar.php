<?php
class M_penjualan_bayar extends CI_Model{
 
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


	function get_piutang($namaPelanggan, $tanggalDari, $tanggalSampai, $nofak, $status){
		$result = [];
		$additionalQuery = ""; 

		if($status == "0"){
			$additionalQuery .= " AND jual_kembalian < 0 ";
		}
		if($status == "1"){
			$additionalQuery .= " AND jual_kembalian >= 0 ";
		}

		if(empty($additionalQuery)){
			$additionalQuery .= "";
		}

		if(!empty($tanggalDari) && !empty($tanggalSampai)){
			$additionalQuery .= "AND jual_tanggal BETWEEN '$tanggalDari' AND '$tanggalSampai'";
		}
		if(!empty($tanggalDari) && empty($tanggalSampai)){
			$additionalQuery .= "AND jual_tanggal >= '$tanggalDari'";
		}
		if(empty($tanggalDari) && empty(!$tanggalSampai)){
			$additionalQuery .= "AND jual_tanggal <= '$tanggalSampai'";
		}
		
		if(!empty($nofak)){
			$additionalQuery .= "AND jual_nofak = '$nofak'";
		}
		if(!empty($namaPelanggan)){
			$additionalQuery .= "AND jual_nama_pelanggan like '%$namaPelanggan%'";
		}

		$query = $this->db->query("
		SELECT
			jual_nofak, DATE_FORMAT(jual_tanggal, '%d-%m-%Y %H:%i')jual_tanggal, jual_total, 
			jual_jml_uang, 
			case when jual_kembalian >= 0 then 0 else jual_kembalian end AS jual_kembalian, 
			jual_user_id, 
			b.user_nama ,jual_nama_pelanggan AS nama_pelanggan
		FROM tbl_jual AS a 
		LEFT JOIN tbl_user AS b ON a.jual_user_id=b.user_id
		WHERE 1=1 $additionalQuery
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
				d_jual_barang_nama AS barang_nama , 
				d_jual_barang_satuan AS barang_satuan , 
				d_jual_barang_harjul AS barang_harjul, 
				d_jual_qty AS qty, 
				d_jual_total AS total
			FROM  tbl_detail_jual
			WHERE d_jual_nofak='$nofak'
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
				bayar_nofak, piutang, bayar_tanggal, bayar_jml_uang, bayar_kurang, b.user_nama 
			FROM tbl_jual_bayar a 
					LEFT JOIN tbl_user b ON a.bayar_user_id=b.user_id
			WHERE jual_nofak='$nofak'
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
				INSERT INTO tbl_jual_bayar
				(
					bayar_nofak,
					jual_nofak,
					piutang,
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
				UPDATE tbl_jual
				SET  
					jual_jml_uang = (SELECT SUM(bayar_jml_uang) FROM tbl_jual_bayar WHERE jual_nofak='$nofak'),
					jual_kembalian = jual_jml_uang - jual_total
				WHERE
					jual_nofak=$nofak 
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
		$q = $this->db->query("SELECT MAX(RIGHT(jual_nofak,6)) AS kd_max FROM tbl_jual WHERE DATE(jual_tanggal)=CURDATE()");
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
		$q = $this->db->query("SELECT MAX(RIGHT(bayar_nofak,6)) AS kd_max FROM tbl_jual_bayar WHERE DATE(bayar_tanggal)=CURDATE()");
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