<?php
class M_suplier extends CI_Model{

	function hapus_suplier($kode){
		$hsl=$this->db->query("DELETE FROM tbl_suplier where suplier_id='$kode'");
		return $hsl;
	}

	function update_suplier($kode,$nama,$alamat,$notelp){
		$hsl=$this->db->query("UPDATE tbl_suplier set suplier_nama='$nama',suplier_alamat='$alamat',suplier_notelp='$notelp' where suplier_id='$kode'");
		return $hsl;
	}

	function tampil_suplier(){
		$hsl=$this->db->query("select * from tbl_suplier order by suplier_id desc");
		return $hsl;
	}

	function simpan_suplier($nama,$alamat,$notelp){
		$hsl=$this->db->query("INSERT INTO tbl_suplier(suplier_nama,suplier_alamat,suplier_notelp) VALUES ('$nama','$alamat','$notelp')");
		return $hsl;
	}

	//API 
	function get_suplier($search, $suplierId){
		$additionalFilter = "WHERE 1=1 ";
		if(!empty($search)){
			$additionalFilter .= " AND (suplier_id like '%$search%' OR suplier_nama like '%$search%' OR suplier_alamat like '%$search%' OR suplier_notelp like '%$search%') ";
		}
		if(!empty($suplierId)){
			$additionalFilter .= " AND suplier_id='$suplierId' ";
		}
		$query=$this->db->query("SELECT suplier_id AS id,
									suplier_nama AS text,
									suplier_alamat AS alamat,
									suplier_notelp AS tlp
								FROM tbl_suplier
								$additionalFilter
								");
		if($query->num_rows() > 0){ 
            return $query->result() ;
        }
	}
}