<?php
	class M_barang extends CI_Model{

	function hapus_barang($kobar){
		try { 
			
			$query=$this->db->query("
			SELECT 1 
			FROM tbl_detail_jual
			where d_jual_barang_id = '". $kobar ."'
			UNION ALL
			SELECT 1 
			FROM tbl_detail_beli
			where d_beli_barang_id = '". $kobar ."'
			"); 

			if($query->num_rows() > 0){   
				$response = [
					'status' => false,
					'message' => 'Proses Hapus Tidak Bisa dilakukan karena barang ini sudah ada dalam data transaksi. Silahkan mengubah status menjadi tidak aktif supaya tidak bisa digunakan!'
				]; 
			}else{ 
				$this->db->query("
					DELETE FROM tbl_barang where barang_id='$kobar'
				"); 
				$response = [
					'status' => true,
					'message' => 'Proses Hapus Berhasil'
				];
			} 
		} catch ( Exception $e ) {  
			$response = [
				'status' => false,
				'message' => $e, 
			]; 
		}
		return $response;  
	}

	function update_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$min_stok,$statusAktif){
		try { 
			$user_id=$this->session->userdata('idadmin');
			$hsl=$this->db->query("
				UPDATE tbl_barang 
				SET barang_nama='$nabar',
				barang_satuan='$satuan',
				barang_harpok='$harpok',
				barang_harjul='$harjul',
				barang_harjul_grosir='$harjul_grosir',
				barang_stok='$stok',
				barang_min_stok='$min_stok',
				barang_tgl_last_update=NOW(),
				barang_kategori_id='$kat',
				barang_user_id='$user_id',
				is_aktif='$statusAktif'
				WHERE barang_id='$kobar'");
			//return $hsl; 
			$response = [
				'status' => true,
				'message' => 'Proses Ubah Berhasil'
			];
		} catch ( Exception $e ) {  
			$response = [
				'status' => false,
				'message' => $e, 
			]; 
		}
		return $response;  
	}

	function tampil_barang(){
		$hsl=$this->db->query("SELECT barang_id,barang_nama,barang_satuan,barang_harpok,barang_harjul,barang_harjul_grosir,barang_stok,barang_min_stok,barang_kategori_id,kategori_nama,is_aktif FROM tbl_barang JOIN tbl_kategori ON barang_kategori_id=kategori_id");
		return $hsl;
	}

	function simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$min_stok,$statusAktif){
		////return $hsl;
		try { 
			$user_id=$this->session->userdata('idadmin');
			$hsl=$this->db->query("
				INSERT INTO tbl_barang 
				(
					barang_id,
					barang_nama,
					barang_satuan,
					barang_harpok,
					barang_harjul,
					barang_harjul_grosir,
					barang_stok,
					barang_min_stok,
					barang_kategori_id,
					barang_user_id,
					is_aktif
					) VALUES (
						'$kobar',
						'$nabar',
						'$satuan',
						'$harpok',
						'$harjul',
						'$harjul_grosir',
						'$stok',
						'$min_stok',
						'$kat',
						'$user_id',
						'$statusAktif'
						)");
	
			$response = [
				'status' => true,
				'message' => 'Proses Simpan Berhasil',
				'data' => $hsl
			];
		} catch ( Exception $e ) {  
			$response = [
				'status' => false,
				'message' => $e, 
			];  
		}
		return $response; 
	}


	// function get_barang($kobar){
	// 	$hsl=$this->db->query("SELECT * FROM tbl_barang where barang_id='$kobar'");
	// 	return $hsl;
	// }

	
	//=============API==========

	function get_all_nama_barang(){   
		$query=$this->db->query("
			SELECT 
			barang_id,
			barang_nama 
			FROM tbl_barang 
			where is_aktif='1' 
			");
		if($query->num_rows() > 0){ 
            return $query->result() ;
        }
	}

	function get_barang(){ 
		$param = $this->input; 
		$kobar = $param->post('kobar');
		$nabar = $param->post('nabar');
		$kategori = $param->post('kategori');
		$satuan = $param->post('satuan');
		$statusAktif = $param->post('statusAktif');  
		$statusAktif = empty($statusAktif) ? "0" : "1";

		$filter = "";
		if(!empty($kobar))
			$filter .= " AND barang_id='$kobar'";
			
		if(!empty($nabar))
			$filter .= " AND barang_nama LIKE '%$nabar%'";
		if(!empty($kategori))
			$filter .= " AND barang_kategori_id='$kategori'";
		if(!empty($satuan))
			$filter .= " AND barang_satuan='$satuan'"; 

		$query=$this->db->query("
			SELECT 
			barang_id,
			barang_nama,
			barang_satuan,
			barang_harpok,
			barang_harjul,
			barang_harjul_grosir,
			barang_stok,
			barang_min_stok,
			barang_kategori_id,
			barang_user_id,
			1 barang_qty_input,
			is_aktif
			FROM tbl_barang 
			where is_aktif='$statusAktif' 
			$filter");
		if($query->num_rows() > 0){ 
            return $query->result() ;
        }
	}
    function get_barang_by_search($filter){
		$query=$this->db->query("SELECT 
			barang_id AS id,
			barang_nama AS text,
			barang_id,
			barang_nama,
			barang_satuan,
			barang_harpok,
			barang_harjul,
			barang_harjul_grosir,
			barang_stok,
			barang_min_stok,
			barang_kategori_id,
			barang_user_id,
			1 barang_qty_input
		FROM tbl_barang 
		where is_aktif = 1 AND (barang_id like '%$filter%' or barang_nama like '%$filter%') Limit 10");
        if($query->num_rows() > 0){ 
            return $query->result() ;
        }
    }
	function get_kobar(){
		$q = $this->db->query("SELECT MAX(RIGHT(barang_id,6)) AS kd_max FROM tbl_barang");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%06s", $tmp);
			}
		}else{
			$kd = "000001";
		}
		return "BR".$kd;
	} 
	
	function api_update_harga($kobar,$harjulLama,$harjulbaru){ 
		$idadmin=$this->session->userdata('idadmin');  
		$this->db->trans_start(); 
		try {    
			$this->db->query("
				UPDATE tbl_barang SET barang_harjul='$harjulbaru' WHERE barang_id='$kobar'
			");  
 
			$this->db->query("
			INSERT INTO log_update
			( 
				nama_table,
				nama_kolom,
				kolom_id,
				nilai_lama,
				nilai_baru,
				user_id
			)
			VALUES
			( 
				'tbl_barang',
				'barang_harjul',
				'$kobar',
				'$harjulLama',
				'$harjulbaru',
				'$idadmin'
			);
			
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

} 