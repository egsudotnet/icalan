<?php
class Penjualan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		//$this->load->model('m_kategori');
		$this->load->model('M_barang_v2');
		//$this->load->model('m_suplier');
		$this->load->model('M_penjualan_v2');
	} 

	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['data']=$this->M_barang_v2->tampil_barang();
			$this->load->view('admin/v_penjualan',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function get_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$kobar=$this->input->post('kobar');  
			$data=$this->M_barang_v2->get_barang($kobar);
		}else{
			echo "Halaman tidak ditemukan";
		}		
		echo json_encode($data);
	}
	function get_barang2(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){ 
			$search=$this->input->get('search');  
			$data=$this->M_barang_v2->get_barang_by_search($search);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}
 

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

	function simpan_penjualan(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input;
			$total = $param->post("totalHarga");
			$jml_uang = $param->post("totalBayar");
			$kembalian = $param->post("kembalian"); 	
			$listBarang = $param->post("listBarang"); 	 
			$result=$this->M_penjualan_v2->simpan_penjualan($total,$jml_uang,$kembalian,$listBarang); 
			echo json_encode($result); 
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}