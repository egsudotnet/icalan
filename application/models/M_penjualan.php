<?php
class M_penjualan extends CI_Model{

	// function hapus_retur($kode){
	// 	$hsl=$this->db->query("DELETE FROM tbl_retur WHERE retur_id='$kode'");
	// 	return $hsl;
	// }

	// function tampil_retur(){
	// 	$hsl=$this->db->query("SELECT retur_id,DATE_FORMAT(retur_tanggal,'%d/%m/%Y') AS retur_tanggal,retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,(retur_harjul*retur_qty) AS retur_subtotal,retur_keterangan FROM tbl_retur ORDER BY retur_id DESC");
	// 	return $hsl;
	// }

	// function simpan_retur($kobar,$nabar,$satuan,$harjul,$qty,$keterangan){
	// 	$hsl=$this->db->query("INSERT INTO tbl_retur(retur_barang_id,retur_barang_nama,retur_barang_satuan,retur_harjul,retur_qty,retur_keterangan) VALUES ('$kobar','$nabar','$satuan','$harjul','$qty','$keterangan')");
	// 	return $hsl;
	// }

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


	function simpan_penjualan($namaPelanggan,$total,$jml_uang,$kembalian,$listBarang){ 
		$idadmin=$this->session->userdata('idadmin'); 
		$nofak = $this->get_nofak();  
		$this->db->trans_start(); 
		try { 
			$this->db->query("
			INSERT INTO tbl_jual 
			(jual_nofak,
			jual_total,
			jual_jml_uang,
			jual_kembalian,
			jual_user_id,
			jual_keterangan,
			jual_nama_pelanggan) 
			VALUES 
			('$nofak',
			'$total',
			'$jml_uang',
			'$kembalian',
			'$idadmin',
			'',
			'$namaPelanggan')");
		 
			foreach ($listBarang as $item) {
				$data=array(
					'd_jual_nofak' 			=>	$nofak,
					'd_jual_barang_id'		=>	$item['barang_id'],
					'd_jual_barang_nama'	=>	$item['barang_nama'],
					'd_jual_barang_satuan'	=>	$item['barang_satuan'],
					'd_jual_barang_harpok'	=>	$item['barang_harpok'],
					'd_jual_barang_harjul'	=>	$item['barang_harjul'],
					'd_jual_qty'			=>	$item['barang_qty_input'],
					'd_jual_diskon'			=>	0,
					'd_jual_total'			=>	$item['barang_qty_input'] * $item['barang_harjul']
				);
				$this->db->insert('tbl_detail_jual',$data);
				$this->db->query("update tbl_barang set barang_stok=barang_stok-'$item[barang_qty_input]' where barang_id='$item[barang_id]'");
			}


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
				'$bayarNofak',
				'$nofak',
				'$total',
				'$jml_uang',
				'$kembalian',
				'$idadmin');
			"); 

			$tJual = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d-%m-%Y %H:%i:%s') AS jual_tanggal FROM tbl_jual WHERE jual_nofak = '$nofak'");
			if($tJual->num_rows()>0){
				$tanggalTransaksi = $tJual->row()->jual_tanggal;
			} 

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
				'data' =>['nofak' => $nofak]
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