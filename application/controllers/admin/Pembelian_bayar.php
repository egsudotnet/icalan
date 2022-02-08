<?php
class Pembelian_bayar extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		//$this->load->model('m_kategori');
		$this->load->model('M_barang');
		//$this->load->model('m_suplier');
		$this->load->model('M_pembelian_bayar'); 
	} 

	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['data']=$this->M_barang->tampil_barang();
			$data['title']="Pembayaran Utang";
			$this->load->view('admin/v_pembelian_bayar',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function get_utang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input; 
			$kodeSuplier = $param->post("kodeSuplier");
			$tanggalDari = $param->post("tanggalDari");
			$tanggalSampai = $param->post("tanggalSampai");
			$nofak = $param->post("nofak");   
			$status = $param->post("status");   
			$data=$this->M_pembelian_bayar->get_utang($kodeSuplier, $tanggalDari, $tanggalSampai, $nofak, $status);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}

	function get_list_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input; 
			$nofak = $param->get("nofak");   
			$data=$this->M_pembelian_bayar->get_list_barang($nofak);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}
 
	function get_list_bayar(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){  
			$param=$this->input; 
			$nofak = $param->get("nofak");   
			$data=$this->M_pembelian_bayar->get_list_bayar($nofak);  
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
			$result=$this->M_pembelian_bayar->simpan_pembayaran($nofak, $kurangBayar, $inputBayar,$kurangBayarBaru);
			echo json_encode($result); 
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
}