<?php 
    $this->load->view('layout/header');
?> 

<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-success">
                <strong>Transaksi Berhasil Silahkan Cetak Faktur Penjualan!</strong>
                <a class="btn btn-default" href="<?php echo base_url().'admin/penjualan_grosir'?>"><span class="fa fa-backward"></span>Kembali</a>
                <a class="btn btn-info" href="<?php echo base_url().'admin/penjualan_grosir/cetak_faktur_grosir'?>" target="_blank"><span class="fa fa-print"></span>Cetak</a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Projects Row -->
    
    

    <!--END MODAL-->

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p style="text-align:center;">Copyright &copy; <?php echo date('Y');?> by Mahakarya Promosindo</p>
            </div>
        </div>
        <!-- /.row -->
    </footer>

</div>
<!-- /.container -->

<!-- footer -->
<?php 
    $this->load->view('layout/footer');
?> 