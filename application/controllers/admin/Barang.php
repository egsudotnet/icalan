<?php
class Barang extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_satuan');
		// $this->load->library('barcode');
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->m_barang->tampil_barang();
			$data['kat']=$this->m_kategori->tampil_kategori(); 
			$data['sat']=$this->m_satuan->tampil_satuan(); 
			$data['title']="Master Barang";
			$this->load->view('admin/v_barang',$data);
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

	function tambah_barang(){
		if($this->session->userdata('akses')=='1'){
			$kobar=$this->m_barang->get_kobar();
			$nabar=$this->input->post('nabar');
			$kat=$this->input->post('kategori');
			$satuan=$this->input->post('satuan');
			$harpok=str_replace(',', '', $this->input->post('harpok'));
			$harjul=str_replace(',', '', $this->input->post('harjul'));
			$harjul_grosir=str_replace(',', '', $this->input->post('harjul_grosir'));
			$stok=$this->input->post('stok');
			$minStok=$this->input->post('minStok');
			$statusAktif=$this->input->post('statusAktif'); 
			$result = $this->m_barang->simpan_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$minStok,$statusAktif);

			echo json_encode($result);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_barang(){
		if($this->session->userdata('akses')=='1'){ 
			$kobar=$this->input->post('kobar');
			$nabar=$this->input->post('nabar');
			$kat=$this->input->post('kategori');
			$satuan=$this->input->post('satuan');
			$harpok=str_replace('.', '', $this->input->post('harpok'));
			$harjul=str_replace('.', '', $this->input->post('harjul'));
			$harjul_grosir=str_replace('.', '', $this->input->post('harjul_grosir'));
			$stok=$this->input->post('stok');
			$minStok=$this->input->post('minStok');
			$statusAktif=$this->input->post('statusAktif'); 
			$result = $this->m_barang->update_barang($kobar,$nabar,$kat,$satuan,$harpok,$harjul,$harjul_grosir,$stok,$minStok,$statusAktif);
		
			echo json_encode($result);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_barang(){
		if($this->session->userdata('akses')=='1'){
			$kobar=$this->input->get('kobar');
			$result = $this->m_barang->hapus_barang($kobar);
			echo json_encode($result);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	//==============API================ 

	function get_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){ 
			$data=$this->m_barang->get_barang();
		}else{
			echo "Halaman tidak ditemukan";
		}		
		echo json_encode($data);
	}

	function get_all_nama_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){ 
			$data=$this->m_barang->get_all_nama_barang();
		}else{
			echo "Halaman tidak ditemukan";
		}		
		echo json_encode($data);
	} 
	
	function get_barang2(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){ 
			$search=$this->input->get('search');  
			$data['title']="Master Barang";
			$data=$this->m_barang->get_barang_by_search($search);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}
 
	function api_update_harga(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$kobar=$this->input->post('kobar'); 
			$harjulLama=str_replace('.', '', $this->input->post('harjulLama'));
			$harjulBaru=str_replace('.', '', $this->input->post('harjulBaru'));
			$data = $this->m_barang->api_update_harga($kobar,$harjulLama,$harjulBaru);
		}else{
			echo "Halaman tidak ditemukan";
		} 
		echo json_encode($data);
	}
}