<?php
class Suplier extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_suplier');
	}
	function index(){
		if($this->session->userdata('akses')=='1'){
			$data['data']=$this->m_suplier->tampil_suplier();
			$data['title']="Master Suplayer";
			$this->load->view('admin/v_suplier',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function tambah_suplier(){
		if($this->session->userdata('akses')=='1'){
			$nama=$this->input->post('nama');
			$alamat=$this->input->post('alamat');
			$notelp=$this->input->post('notelp');
			$this->m_suplier->simpan_suplier($nama,$alamat,$notelp);
			redirect('admin/suplier');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function edit_suplier(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$nama=$this->input->post('nama');
			$alamat=$this->input->post('alamat');
			$notelp=$this->input->post('notelp');
			$this->m_suplier->update_suplier($kode,$nama,$alamat,$notelp);
			redirect('admin/suplier');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}
	function hapus_suplier(){
		if($this->session->userdata('akses')=='1'){
			$kode=$this->input->post('kode');
			$this->m_suplier->hapus_suplier($kode);
			redirect('admin/suplier');
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	//=====API===  
	function get_suplier(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$search=$this->input->get('search'); 
			$suplierId=$this->input->get('suplierId');
			$data=$this->m_suplier->get_suplier($search, $suplierId);
		}else{
			echo "Halaman tidak ditemukan";
		}		
		echo json_encode($data);
	} 
}