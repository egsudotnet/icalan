<?php
class Penjualan extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            $url=base_url();
            redirect($url);
        };
		$this->load->model('m_kategori');
		$this->load->model('m_barang');
		$this->load->model('m_suplier');
		$this->load->model('m_penjualan');
	}

	
	function pr($str, $die = true) {
		if ($str) {
			if (is_object($str) || is_array($str)) {
				echo "<pre>" . print_r($str, true) . "</pre>";
			} else {
				echo "<pre>$str</pre>";
			}
		}

		if ($die) {
			echo "---------------------------------------- die ----------------------------------------";
			die();
		}
	}

	function index(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$data['data']=$this->m_barang->tampil_barang();
			$this->load->view('admin_v2/v_penjualan',$data);
		}else{
			echo "Halaman tidak ditemukan";
		}
	}

	function get_barang(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
			$kobar=$this->input->post('kobar');  
			$data=$this->m_barang->get_barang($kobar);
		}else{
			echo "Halaman tidak ditemukan";
		}		
		echo json_encode($data);
	}
	function get_barang2(){
		if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){ 
			$search=$this->input->get('search');  
			$data=$this->m_barang->get_barang_by_search($search);  
		}else{
			echo "Tidak mempunyai akses";
		}
		echo json_encode($data);
	}

	function add_to_cart(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$kobar=$this->input->post('kode_brg');
		$produk=$this->m_barang->get_barang($kobar);
		$i=$produk->row_array();
		$data = array(
               'id'       => $i['barang_id'],
               'name'     => $i['barang_nama'],
               'satuan'   => $i['barang_satuan'],
               'harpok'   => $i['barang_harpok'],
               'price'    => str_replace(",", "", $this->input->post('harjul'))-$this->input->post('diskon'),
               'disc'     => $this->input->post('diskon'),
               'qty'      => $this->input->post('qty'),
               'amount'	  => str_replace(",", "", $this->input->post('harjul'))
            );
	if(!empty($this->cart->total_items())){
		foreach ($this->cart->contents() as $items){
			$id=$items['id'];
			$qtylama=$items['qty'];
			$rowid=$items['rowid'];
			$kobar=$this->input->post('kode_brg');
			$qty=$this->input->post('qty');
			if($id==$kobar){
				$up=array(
					'rowid'=> $rowid,
					'qty'=>$qtylama+$qty
					);
				$this->cart->update($up);
			}else{
				$this->cart->insert($data);
			}
		}
	}else{
		$this->cart->insert($data);
	}

		redirect('admin_v2/penjualan');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function remove(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$row_id=$this->uri->segment(4);
		$this->cart->update(array(
               'rowid'      => $row_id,
               'qty'     => 0
            ));
		redirect('admin_v2/penjualan');
	}else{
        echo "Halaman tidak ditemukan";
    }
	}
	function simpan_penjualan(){
	if($this->session->userdata('akses')=='1' || $this->session->userdata('akses')=='2'){
		$total=$this->input->post('total');
		$jml_uang=str_replace(",", "", $this->input->post('jml_uang'));
		$kembalian=$jml_uang-$total;
		if(!empty($total) && !empty($jml_uang)){
			if($jml_uang < $total){
				echo $this->session->set_flashdata('msg','<label class="label label-danger">Jumlah Uang yang anda masukan Kurang</label>');
				redirect('admin_v2/penjualan');
			}else{
				$nofak=$this->m_penjualan->get_nofak();
				
				$this->session->set_userdata('nofak',$nofak);
				$order_proses=$this->m_penjualan->simpan_penjualan($nofak,$total,$jml_uang,$kembalian);
				if($order_proses){
					$this->cart->destroy();
					
					$this->session->unset_userdata('tglfak');
					$this->session->unset_userdata('suplier');
					$this->load->view('admin_v2/alert/alert_sukses');	
				}else{
					redirect('admin_v2/penjualan');
				}
			}
			
		}else{
			echo $this->session->set_flashdata('msg','<label class="label label-danger">Penjualan Gagal di Simpan, Mohon Periksa Kembali Semua Inputan Anda!</label>');
			redirect('admin_v2/penjualan');
		}

	}else{
        echo "Halaman tidak ditemukan";
    }
	}

	function cetak_faktur(){
		$x['data']=$this->m_penjualan->cetak_faktur();
		$this->load->view('admin_v2/laporan/v_faktur',$x);
		//$this->session->unset_userdata('nofak');
	}


}