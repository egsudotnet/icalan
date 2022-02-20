<?php 
    $this->load->view('layout/header');
?>
    <!-- Page Content -->
    <div class="container">

        <section id="section-search">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data
                    <small>Barang</small>
                    <div class="pull-right"><a href="#" class="btn btn-sm btn-success" onclick="Detail.ShowModal(1)"><span class="fa fa-plus"></span> Tambah Barang</a></div>
                </h1>
            </div>
        </div>
        <!-- /.row --> 
            <div class="row">
                
                <div class="col-lg-6 form-horizontal">
                <div class="form-group">
                            <label class="control-label col-xs-3" >Nama Barang</label>
                            <div class="col-xs-9">
                                <input v-model="nabar" class="form-control" type="text" placeholder="" style="" required>
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-xs-3" >Kategori</label>
                                <div class="col-xs-9">
                                    <select v-model="kategori" class="selectpicker show-tick form-control" data-allow-clear="true" data-live-search="true" title="" data-width="" placeholder="" required>
                                        <option></option>
                                        <?php foreach ($kat->result_array() as $k2) {
                                            $id_kat=$k2['kategori_id'];
                                            $nm_kat=$k2['kategori_nama'];
                                            ?>
                                                <option value="<?php echo $id_kat;?>"><?php echo $nm_kat;?></option>
                                        <?php }?> 
                                    </select>
                                </div>
                            </div>

                </div>
                <div class="col-lg-6 form-horizontal">
                     
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Satuan</label>
                            <div class="col-xs-9">
                                <select v-model="satuan" class="selectpicker show-tick form-control" data-allow-clear="true" data-live-search="true" title="" data-width="" placeholder="" required>
                                        <option></option>
                                        <?php foreach ($sat->result_array() as $k2) {
                                        $id_kat=$k2['satuan_kode'];
                                        $nm_kat=$k2['satuan_keterangan'];
                                        ?>
                                            <option value="<?php echo $id_kat;?>"><?php echo $nm_kat;?></option>
                                    <?php }?> 
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Status Aktif</label>
                            <div class="col-xs-9">
                                <input type="checkbox" type="number" v-model="statusAktif" checked>
                            </div>
                        </div>
                            
                </div>
                
                <div class="col-lg-12">
                    <button class="btn btn-info fa fa-search" v-on:click="Search"> Cari</button> 
                    <button class="btn btn-default fa fa-refresh" v-on:click="Refresh"> Refresh</button> 
                <div>


                <div class="col-lg-12" id="divTableList">
                    <table class="table table-bordered table-condensed" style="font-size:11px;" id="myList">
                        <thead>
                        </thead>
                        <tbody> 
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        
        <section id="section-detail">
            <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarang" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="myModalLabel"><span>{{labelModalBarang}}</span> Barang</h3>
                </div>
                <div class="form-horizontal">
                    <div class="modal-body"> 
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Nama Barang</label>
                            <div class="col-xs-9">
                                <input v-model="nabar" class="form-control" type="text" placeholder="" style=";" required>
                            </div>
                        </div>

                        <div class="form-group">
                                <label class="control-label col-xs-3" >Kategori</label>
                                <div class="col-xs-9">
                                    <select v-model="kategori" class="selectpicker show-tick form-control" data-allow-clear="true" data-live-search="true" title="" data-width="" placeholder="" required>
                                        <option></option>
                                        <?php foreach ($kat->result_array() as $k2) {
                                            $id_kat=$k2['kategori_id'];
                                            $nm_kat=$k2['kategori_nama'];
                                            ?>
                                                <option value="<?php echo $id_kat;?>"><?php echo $nm_kat;?></option>
                                        <?php }?> 
                                    </select>
                                </div>
                            </div>

                    

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Satuan</label>
                            <div class="col-xs-9">
                                <select v-model="satuan" class="selectpicker show-tick form-control" data-allow-clear="true" data-live-search="true" title="" data-width="" placeholder="" required>
                                    <option></option>
                                        <?php foreach ($sat->result_array() as $k2) {
                                        $id_kat=$k2['satuan_kode'];
                                        $nm_kat=$k2['satuan_keterangan'];
                                        ?>
                                            <option value="<?php echo $id_kat;?>"><?php echo $nm_kat;?></option>
                                    <?php }?> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Harga Pokok</label>
                            <div class="col-xs-9">
                                <input type="number" v-model="harpok" class="harpok form-control" type="text" placeholder="" style="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Harga</label>
                            <div class="col-xs-9">
                                <input type="number"  v-model="harjul" class="harjul form-control" type="text" placeholder="" style="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Stok</label>
                            <div class="col-xs-9">
                                <input type="number"  v-model="stok" class="form-control" type="number" placeholder="" style="">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="control-label col-xs-3" >Minimal Stok</label>
                            <div class="col-xs-9">
                                <input type="number"  v-model="minStok" class="form-control" type="number" placeholder="" style="">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="control-label col-xs-3" >Status Aktif</label>
                            <div class="col-xs-9">
                                <input type="checkbox" type="number" v-model="statusAktif">
                            </div>
                        </div>
                            

                    </div>

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-info" v-on:click="Simpan">Simpan</button>
                    </div>
                </div>
                </div>
                </div>
            </div> 
        </section>
        <!--END MODAL--> 
    </div>
    <!-- /.container -->
  
<!-- footer -->
<?php 
    $this->load->view('layout/footer');
?> 

    <script type="text/javascript"> 
        var Current={};
        Current.tableListObj; 
        var Main = new Vue({
            el: "#section-search",
            data: {
                nabar: "",
                kategori: "",
                satuan : "", 
                statusAktif: true, 
                listBarang: [], 
            },
            mounted: function () { 
            },
            watch: {
                // isNew: function () {
                //     this.action = this.isNew ? "Submit" : "Update";
                //     this.title = this.isNew ? "Add Crew" : "Crew Detail";
                // }
            },
            methods: {
                Init: function (isNew, data) { 
                },
                Search: function (kobar) { 
                    var data = {}; 
                    data.nabar = this.nabar;
                    data.kategori = this.kategori;
                    data.satuan = this.satuan;  
                    data.statusAktif = this.statusAktif?1:0;
                    $.ajax({
                        url: '<?php echo base_url().'admin/barang/get_barang';?>',
                        cache: false,
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        beforeSend: function () {
					        $('#divTableList').addClass('panel-loading');
                            Current.tableListObj.clear().draw();
                            BeforeSendAjaxBehaviour(false);
                        }
                    }).done(function (data, textStatus, jqXHR) { 
                        if(!data)
                            return;
                            
				        Current.tableListObj.clear().draw();
                        Current.tableListObj.rows.add(data).draw(); 
                        setTimeout(function () {
                            Current.tableListObj.columns.adjust().draw(); 
                        }, 200); 
                    }).fail(function (jqXHR, textStatus, errorThrown) { 
                        $(".info-error").text(textStatus);
                    }).complete(function(){ 
					    $('#divTableList').removeClass('panel-loading');
                    });
                },  
                Refresh: function () { 
                    this.nabar = "";
                    this.kategori = "";
                    this.satuan = "";
                    this.statusAktif = true;
                    this.listBarang = [];
                    $("select").val("").change()
                },
            },
            computed: { 
            },
            updated: function () {
                helper.updatePriceFormat();
            }
        }); 
        var Detail = new Vue({
            el: "#section-detail",
            data: {
                id : "",
                kobar : "",
                nabar: "",
                kategori: "",
                satuan : "",
                harpok : "",
                harjul : "",
                stok : "",
                ////minStok : "",
                statusAktif: "", 
                labelModalBarang: "",
                aksiModalBarang: 0
            },
            mounted: function () { 
            },
            watch: {
                // isNew: function () {
                //     this.action = this.isNew ? "Submit" : "Update";
                //     this.title = this.isNew ? "Add Crew" : "Crew Detail";
                // }
            },
            methods: {
                ShowModal: function (action,data) {
                    this.aksiModalBarang = action;
                    if(action==1){ 
                        this.nabar = "";
                        this.kategori = "";
                        this.satuan = "";
                        this.harpok = "";
                        this.harjul = "";
                        this.stok = 1; 
                        this.statusAktif = true;
                        this.labelModalBarang = "Tambah";
                    }
                    if(action==2){
                        this.kobar = data.barang_id;
                        this.nabar = data.barang_nama;
                        this.kategori = data.barang_kategori_id;
                        this.satuan = data.barang_satuan;
                        this.harpok = data.barang_harpok;
                        this.harjul = data.barang_harjul;
                        this.stok = data.barang_stok; 
                        this.statusAktif = data.is_aktif==1;
                        this.labelModalBarang = "Edit";
                    }
                    this.labelModalBarang = action == 1 ? "Tambah" : 'Edit';
                    $("#modalBarang").modal("show");
                    setTimeout(() => {
                        $("#modalBarang select").change(); 
                    }, 500);
                },
                Simpan: function () { 
                    if(this.aksiModalBarang==1)
                        this.Add();
                    if(this.aksiModalBarang==2)
                        this.Put();
                },
                Add: function () { 
                    var data = {};  
                    data.nabar = this.nabar;
                    data.kategori = this.kategori;
                    data.satuan = this.satuan;
                    data.harpok = this.harpok;
                    data.harjul = this.harjul;
                    data.stok = this.stok;
                    data.minStok = 1;
                    data.statusAktif = this.statusAktif?1:0;

                    $.ajax({
                        url: '<?php echo base_url().'admin/barang/tambah_barang/';?>',
                        cache: false,
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        beforeSend: function () {
                            BeforeSendAjaxBehaviour(true);
                        }
                    }).done(function (data, textStatus, jqXHR) { 
                        $(".info-success").text("Data berhasil disimpan."); 
                        Main.Search();  
                    }).fail(function (jqXHR, textStatus, errorThrown) { 
                        $(".info-error").text(textStatus);
                    }).complete(function(){ 
                        AfterSendAjaxBehaviour(true);
                        $("#modalBarang").modal("hide"); 
                    });
                }, 
                Put: function () {
                    var data = {}; 
                    data.kobar = this.kobar;
                    data.nabar = this.nabar;
                    data.kategori = this.kategori;
                    data.satuan = this.satuan;
                    data.harpok = this.harpok;
                    data.harjul = this.harjul;
                    data.stok = this.stok;
                    data.minStok = 1;
                    data.statusAktif = this.statusAktif?1:0;

                    $.ajax({
                        url: '<?php echo base_url().'admin/barang/edit_barang';?>',
                        cache: false,
                        dataType: 'json',
                        data: data,
                        method: 'POST',
                        beforeSend: function () {
                            BeforeSendAjaxBehaviour(true);
                        }
                    }).done(function (data, textStatus, jqXHR) { 
                        $(".info-success").text("Data berhasil diubah."); 
                        Main.Search(); 
                    }).fail(function (jqXHR, textStatus, errorThrown) { 
                        $(".info-error").text(textStatus);
                    }).complete(function(){ 
                        AfterSendAjaxBehaviour(true);
                        $("#modalBarang").modal("hide"); 
                    });
                },
                Delete: function (kobar) {  
                    if (confirm("Apakah anda akan menghapus data?")) {
                        $.ajax({
                            url: '<?php echo base_url().'admin/barang/hapus_barang?kobar=';?>' + kobar,
                            cache: false,
                            dataType: 'json',  
                            beforeSend: function () {
                                BeforeSendAjaxBehaviour(true);
                            }
                        }).done(function (data, textStatus, jqXHR) { 
                            if(data.status){  
                                $(".info-success").text("Data berhasil dihapus."); 
                                Main.Search();
                            }else{
                                $(".info-warning").text(data.message); 
                            }  
                        }).fail(function (jqXHR, textStatus, errorThrown) { 
                            $(".info-error").text(textStatus);
                        }).complete(function(){ 
                            AfterSendAjaxBehaviour(true);
                            $("#modalBarang").modal("hide");
                        });
                    }
                },
                Edit: function () { 
                    $("#modalBarang").modal("show");
                } 
            },
            computed: { 
            },
            updated: function () {
                helper.updatePriceFormat();
            }
        }); 

        $(document).ready(function(){  
            Current.tableListObj = $('#myList').DataTable({
                scrollY: 500,
                scrollX: 400,
                //scrollCollapse: true,
                //pagingType: 'full_numbers',
                order: [[0, "desc"]],
                pageLength: 10,
                //bLengthChange: false,
                // bFilter: true,
                // keys: true,
                // deferRender: true,
                // select: true,
                searching: false,
                paging: false,
                columns: [ 
                    { data: null, visible: true, title: 'No' }, 
                    { data: 'barang_id', name: 'barang_id', visible: true, title: 'id' }, 
                    { data: 'barang_nama', name: 'barang_nama', visible: true, title: 'Nama Bbarang' }, 
                    //{ data: 'barang_satuan', name: 'barang_satuan', visible: true, title: 'Satuan' }, 
                    //{ data: 'barang_harpok', name: 'barang_harpok', visible: true, title: 'Harga Pokok' }, 
                    { data: 'barang_harjul', name: 'barang_harjul', visible: true, title: 'Harga Jual' }, 
                    //{ data: 'barang_stok', name: 'barang_stok', visible: true, title: 'Stok' }, 
                    //{ data: 'barang_min_stok', name: 'barang_min_stok', visible: true, title: 'minimal stok' }, 
                    // { data: 'kategori_nama', name: 'kategori_nama', visible: true, title: 'kategori' },  
                    { 
                        title: 'Edit', 
                        render: function (data, type, full, meta) {
                            return '<a class="btn btn-xs btn-warning mr-10 edit" title="Edit"><span class="fa fa-edit"></span></a>';
                        }
                    },  
                    { 
                        title: 'Hapus', 
                        render: function (data, type, full, meta) {
                            return '<a class="btn btn-xs btn-danger hapus" title="Hapus"><span class="fa fa-close"></span></a>';
                        }
                    },  
                ],
                rowCallback: function (row, data, index) {  
                    var no =  index + 1;
                    $(row).find('td:eq(0)').html(no);

                    $(row).find('.edit').unbind();
                    $(row).find('.edit').click(function(){
                        Detail.ShowModal(2,data);
                    });
                    $(row).find('.hapus').unbind();
                    $(row).find('.hapus').click(function(){
                        Detail.Delete(data.barang_id);
                    }); 
                // 	$('td', row).attr('nowrap', 'nowrap');
                // 	if (parseInt(data.IS_VERIF) === 1) {
                // 		$(row).addClass('is-verif');
                // 	}
                }
            });
 
        });
    </script>
  