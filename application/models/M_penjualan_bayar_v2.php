<?php
class M_penjualan_bayar_v2 extends CI_Model{
 
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


	function get_piutang($tanggalDari, $tanggalSampai, $nofak){
		$result = [];
		$additionalQuery = "";

		if(!empty($tanggalDari) && !empty($tanggalSampai)){
			$additionalQuery .= "AND jual_tanggal BETWEEN= '$tanggalDari' AND '$tanggalSampai'";
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

		$query = $this->db->query("
		SELECT
			jual_nofak, jual_tanggal, jual_total, jual_jml_uang, jual_kembalian, jual_user_id, b.user_nama 
		FROM tbl_jual A 
		LEFT JOIN tbl_user B ON A.jual_user_id=B.user_id
		WHERE jual_kembalian < 0 
			$additionalQuery 
		"); 
        if($query->num_rows()>0){
			$result = $query->result();
        } 
		return $result;
	}

	function simpan_pembayaran($nofak, $piutang, $jumlahBayar,$kurangBayar){ 
		$idadmin=$this->session->userdata('idadmin');  
		$this->db->trans_start(); 
		try {  
			$bayarNofak = $this->get_bayar_nofak();   
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
					$bayarNofak,
					$nofak,
					$piutang,
					$jumlahBayar,
					$kurangBayar,
					$idadmin);
			");   

			$this->db->query("
				UPDATE tbl_jual
				SET  
					jual_jml_uang = (SELECT SUM(jumlahBayar) FROM tbl_jual_bayar WHERE jual_nofak='$nofak'),
					jual_kembalian = $kurangBayar 
				WHERE
					jual_nofak=$nofak 
			");  
			 
			$this->db->trans_commit(); 
			////$this->db->trans_rollback(); 
			$response = [
				'status' => true,
				'message' => 'Proses Simpan Berhasil', 
				'data' =>['nofak' => $nofak,'namaUser' => $this->session->userdata('nama'), 'dataToko' => $this->get_data_toko(), 'tanggalTransaksi' => $tanggalTransaksi],
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

	function get_data_toko(){
		$result = [];
		$q = $this->db->query("SELECT lookup_kode, lookup_value from lookups where lookup_kode in ('KD001','KD002','KD003')"); 
        if($q->num_rows()>0){
			$result = $q->result();
        } 
		return $result;
	}
}