<?php
class Penjualan_bayar extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		//$this->load->model('m_kategori');
		$this->load->model('M_barang_v2');
		//$this->load->model('m_suplier');
		$this->load->model('M_penjualan_bayar_v2');
	} 

	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['data']=$this->M_barang_v2->tampil_barang();
			$this->load->view('admin/v_penjualan_bayar',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function get_piutang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input;
			$tanggalDari = $param->post("tanggalDari");
			$tanggalSampai = $param->post("tanggalSampai");
			$nofak = $param->post("nofak");   
			$data=$this->M_penjualan_bayar_v2->get_piutang($tanggalDari, $tanggalSampai, $nofak);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}

	function get_list_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input; 
			$nofak = $param->get("nofak");   
			$data=$this->M_penjualan_bayar_v2->get_list_barang($nofak);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}
 
	function get_list_bayar(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input; 
			$nofak = $param->get("nofak");   
			$data=$this->M_penjualan_bayar_v2->get_list_bayar($nofak);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	} 

	function simpan_pembayaran(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input;
			$nofak = $param->post("nofak");
			$kurangBayar = $param->post("kurangBayar");
			$inputBayar = $param->post("inputBayar"); 	
			$kurangBayarBaru = $param->post("kurangBayarBaru"); 	 
			$result=$this->M_penjualan_bayar_v2->simpan_pembayaran($nofak, $kurangBayar, $inputBayar,$kurangBayarBaru);
			echo json_encode($result); 
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}