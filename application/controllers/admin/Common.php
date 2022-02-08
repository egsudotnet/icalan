<?php
class Common extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        }; 
		$this->load->model('M_common');  
	} 

	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
 

	function get_data_toko(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){   
			$result=$this->M_common->get_data_toko(); 
			echo json_encode($result); 
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}