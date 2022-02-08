<?php
class M_common extends CI_Model{ 
	function get_data_toko(){
		$result = [];
		$q = $this->db->query("SELECT lookup_kode, lookup_value from lookups where lookup_kode in ('KD001','KD002','KD003')"); 
        if($q->num_rows()>0){
			$result = $q->result();
        } 
		return $result;
	}
}