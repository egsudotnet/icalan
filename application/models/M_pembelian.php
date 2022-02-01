<?php
class M_pembelian extends CI_Model{

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


	function simpan_pembelian($nofak, $kodeSuplier, $tanggalBeli, $total,$jml_uang,$kembalian,$listBarang){ 
		$idadmin=$this->session->userdata('idadmin'); 
		$this->db->trans_start(); 
		try { 
 
		$nofakBeli = $this->get_nofak();  

		$this->db->query("
			INSERT INTO tbl_beli 
			(beli_nofak,
			beli_tanggal,
			beli_suplier_id,
			beli_user_id,
			beli_kode,
			beli_total,
			beli_jml_uang,
			beli_kembalian,
			beli_keterangan) 
			VALUES 
			('$nofak',
			'$tanggalBeli',
			'$kodeSuplier',
			'$idadmin',
			'$nofakBeli',
			'$total',
			'$jml_uang',
			'$kembalian',
			''
		)");
 

			foreach ($listBarang as $item) {
				$data=array(
					'd_beli_nofak' 			=>	$nofak,
					'd_beli_barang_id'		=>	$item['barang_id'], 
					'd_beli_harga'			=>	$item['barang_harpok'], 
					'd_beli_jumlah'			=>	$item['barang_qty_input'], 
					'd_beli_total'			=>	$item['barang_harpok'] * $item['barang_qty_input'],
					'd_beli_kode'			=>	$nofakBeli, 
				);
				$this->db->insert('tbl_detail_beli',$data); 
				$this->db->query("update tbl_barang set barang_stok=barang_stok+'$item[barang_qty_input]',barang_harpok='$item[barang_harpok]' where barang_id='$item[barang_id]'");
			}


			$bayarNofak = $this->get_bayar_nofak();  

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
				'$total',
				'$jml_uang',
				'$kembalian',
				'$idadmin');
			"); 

			$tBeli = $this->db->query("SELECT DATE_FORMAT(beli_tanggal,'%d-%m-%Y %H:%i:%s') AS beli_tanggal FROM tbl_beli WHERE beli_nofak = '$nofak'");
			if($tBeli->num_rows()>0){
				$tanggalTransaksi = $tBeli->row()->beli_tanggal;
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
				'data' =>['nofak' => $nofak], tanggalTransaksi
			];
			$this->_log_request($authorized = true, serialize($response), serialize($errors), serialize($detailData));
			return $response;  
		}

		return $response;
	}
	function get_nofak(){
		$q = $this->db->query("SELECT MAX(RIGHT(beli_kode,6)) AS kd_max FROM tbl_beli WHERE DATE(insert_date)=CURDATE()");
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
		return "BL".$tanggal.$kd;
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

	function get_data_toko(){
		$result = [];
		$q = $this->db->query("SELECT lookup_kode, lookup_value from lookups where lookup_kode in ('KD001','KD002','KD003')"); 
        if($q->num_rows()>0){
			$result = $q->result();
        } 
		return $result;
	}
}