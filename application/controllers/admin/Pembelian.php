<?php
class Pembelian extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		//$this->load->model('m_kategori');
		$this->load->model('M_barang');
		//$this->load->model('m_suplier');
		$this->load->model('M_pembelian');
	} 

	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['data']=$this->M_barang->tampil_barang();
			$data['title']="Pembelian";
			$this->load->view('admin/v_pembelian',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
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

	function simpan_pembelian(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input;
			$nofak = $param->post("nofak");
			$kodeSuplier = $param->post("kodeSuplier");
			$tanggalBeli = $param->post("tanggalBeli");
			$total = $param->post("totalHarga");
			$jml_uang = $param->post("totalBayar");
			$kembalian = $param->post("kembalian"); 	
			$listBarang = $param->post("listBarang"); 	 
			$result=$this->M_pembelian->simpan_pembelian($nofak,$kodeSuplier,$tanggalBeli,$total,$jml_uang,$kembalian,$listBarang); 
			echo json_encode($result); 
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}