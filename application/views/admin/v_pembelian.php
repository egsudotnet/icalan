<div id="divInput"> 
<?php 
    $this->load->view('layout/header');
?> 


<!-- Page Content -->
<div class="container"> 
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Transaksi
            <small>Pembelian</small>
            <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small></small></a>
        </h1> 
    </div>
</div>
    <section id="sectionPembelian">
        <div class="row">
                <div class="col-lg-12">
                        <table class="w-100 filter table-list" >
                                <tr> 
                                    <td style="width: 200px"><b>No.Faktur<b></td> 
                                    <td style="width: 300px"><b>Suplayer<b></td> 
                                    <td ><b>Tanggal Beli<b></td>  
                                </tr>
                                <tr> 
                                    <td> 
                                        <input v-model="nofak" class="form-control input-sm"/>  
                                    </td>  
                                    <td> 
                                        <select name="select_kode_suplier" id="select_kode_suplier"  style="width: 100%" class="form-control input-sm"> 
                                        </select>
                                    </td>    
                                    <td colspan="2"> 
                                        <input type="date" name="tanggal_beli" id="tanggal_beli" v-model="tanggalBeli" class="form-control input-sm"/>  
                                    </td> 
                                </tr>

                                
                                <tr>  
                                    <td><b>Nama Barang<b></td> 
                                </tr>
                                <tr>  
                                    <td colspan="2"> 
                                        <select name="select_kode_brg" id="select_kode_brg" class="form-control input-sm"> 
                                        </select>
                                    </td> 
                                    <td style="width:70px">
                                        <div class="pull-right"> 
                                            <span class="btn btn-success" v-on:click="Post"><i class="fa fa-save"> Simpan</i></span> 
                                        </div>
                                    </td>
                                    <td style="width:70px">
                                        <div class="pull-right">  
                                            <span class="btn btn-danger" v-on:click="Delete"><i class="fa fa-trash"> Batal</i></span>
                                        </div>
                                    </td>
                                </tr>
                        </table>
                        <table class="table table-stripped mt-20 w-100 table-list">
                            <thead>
                                <tr>
                                    <th style="width:20%">Nama</th>
                                    <th style="width:20%">Harga Beli</th>
                                    <th style="width:20%">Qty</th>
                                    <th style="width:20%">Total</th> 
                                    <th style="width:10%"></th> 
                                </tr> 

<!--                                 
                                <tr>
                                <th>Nama</th>
                                <th>Stok</th>  
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Qty</th>
                                <th style="width:200px">Total</th> 
                                <th style="width:10px"></th> 
                                </tr> -->

                            </thead>
                            <tbody>
                                <tr v-for="(row,index) in listBarang">
                                    <td>{{row.barang_nama}}</td>
                                    <td> 
                                        <input type="number" class="form-control input-sm text-right barang-harpok" v-model="row.barang_harpok"/>
                                    </td>
                                    <td style=""> 
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-btn btn-minus">
                                                <span class="btn btn-warning"><i class="glyphicon glyphicon-minus"></i></span>
                                            </span>
                                            <input v-model="row.barang_qty_input" class="form-control input-sm text-right input-qty" style="width:40px"/>
                                            <span class="input-group-btn btn-plus">
                                                <span class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-right">  
                                        <b class="form-control input-sm text-right">{{totalHargaPerBarang(row.barang_harpok,row.barang_qty_input)}}<b>
                                        <!-- <input class="form-control input-sm text-right priceFormat" readonly v-model="totalHargaPerBarang(row.barang_harpok * row.barang_qty_input)"/>  -->
                                    </td>
                                    <td class=""><span class="btn btn-danger btn-delete"><i class="glyphicon glyphicon-remove"></i></span></td>
                                </tr>
                            <tbody>
                            <tfoot>
                                <tr>
                                    </th> 
                                    <th colspan="2"><b class="pull-right">Total Rp.</b></th> 
                                    <th colspan="3">
                                        <input v-model="totalHarga" class="form-control input-sm priceFormat text-right" style="" readonly/>
                                    </th> 
                                </tr>
                                <tr>
                                    <th colspan="2"><b class="pull-right">Total Bayar Rp.</b></th> 
                                    <th colspan="4" v-on:click="ShowInputMoney">
                                        <div class="input-group" style="">
                                            <span class="input-group-addon"><i class="fa fa-money btn-success"></i></span>
                                             <input v-model="totalBayar" class="form-control input-sm priceFormat text-right" style="" readonly>
                                        </div> 
                                    </th>  
                                </tr>
                                <tr>
                                    <th colspan="2"><b v-bind:class="('pull-right ' + (kembalian<0?'text-danger':''))">{{labelKembalian}} Rp.</b></th> 
                                    <th colspan="3">
                                        <input v-model="kembalian" class="form-control input-sm priceFormat text-right" style="" readonly/>
                                    </th> 
                                </tr>
                            </tfoot>
                        </table>
                </div>
            </div>

        </div>
    </section>
</div>
<!-- /.container -->

<!-- footer -->
<?php 
    $this->load->view('layout/footer');
?> 
</div> 
</div>
 
<script type="text/javascript">
    var Pembelian = new Vue({
        el: "#sectionPembelian",
        data: {
            listBarang: [],
            totalBayar : 0,
            selectBarang : "",
            selectBarangList : "",

            //data struk
            nofak : "",
            namaUser : "",
            namaToko : "",
            alamatToko : "",
            hpToko : "",

            kodeSuplier : "",
            namaSuplier : "",

            tanggalBeli : ""
        },
        mounted: function () { 
            //this.Validation();
        },
        watch: {
            // isNew: function () {
            //     this.action = this.isNew ? "Submit" : "Update";
            //     this.title = this.isNew ? "Add Crew" : "Crew Detail";
            // }
        },
        methods: {
            Init: function (isNew, data) { 
                $('#select_kode_brg').css({"width":"180px"});
                this.selectBarang = $('#select_kode_brg').select2({
                    minimumInputLength: 3,
                    allowClear: true,
                    width:"100%",
                    placeholder: '',
                    ajax: {
                        dataType: 'json',
                        url: '<?php echo base_url().'admin/barang/get_barang2';?>',
                        delay: 800,
                        data: function(params) {
                            return {search: params.term}
                        },
                        processResults: function (data, page) {
                            Pembelian.selectBarangList = data;
                            return {
                                results: data
                            };
                        },
                    }
                }).on('select2:select', function (evt) { 
                }); 
 
                $("#select_kode_brg").change(function(){
                    beep();
                    var idBarang = $(this).val();
                    var barangExist = $.grep(Pembelian.listBarang,(n,i)=>{
                        return n.barang_id == idBarang;
                    });
                    if(barangExist.length>0){
                        barangExist[0].barang_qty_input ++;
                        $("#select_kode_brg").val("").change();
                    }else{
                        Pembelian.Search($(this).val()); 
                    }
                })

                //======================
                
                this.selectBarang = $('#select_kode_suplier').select2({
                    minimumInputLength: 3,
                    allowClear: true,
                    placeholder: '',
                    ajax: {
                        dataType: 'json',
                        url: '<?php echo base_url().'admin/suplier/get_suplier';?>',
                        delay: 800,
                        data: function(params) {
                            return {search: params.term}
                        },
                        processResults: function (data, page) {
                            return {
                                results: data
                            };
                        },
                    }
                }).on('select2:select', function (evt) {  
                    Pembelian.kodeSuplier = $(this).val();
                    Pembelian.namaSuplier = $("#select_kode_suplier option:selected").text(); 
                    Pembelian.$forceUpdate();
                });  
                //=================================>>

                $(document).on("click",".btn-minus,.btn-plus",function(){ 
                    var target = $(this).closest("tr").find("td .input-qty");
                    var index = $(this).closest("tr").index();
                    //var hargaJual = $(this).closest("tr").find("td .barang_harpok");
                    
                    var qty = parseInt(target.val()) 
                    if($(this).hasClass("btn-minus")){
                        qty -= 1;
                    }else{
                        qty += 1;
                    }

                    if(qty>0)
                        beep();

                    var qty = qty < 1 ? 1 : qty;
                    //target.val(qty).change();
                    Pembelian.listBarang[index].barang_qty_input=qty;  
                })
 
                $(document).on("click",".btn-delete",function(){ 
                    var target = $(this).closest("tr").find("td .btn-delete");
                    var index = $(this).closest("tr").index();  
                    Pembelian.listBarang.splice(index, 1);
                }) 

                /////
                
                var dataPembelian = localStorage.dataPembelian; 
                if(dataPembelian){
                    dataPembelian = JSON.parse(dataPembelian);
                    this.nofak = dataPembelian.nofak;
                    this.kodeSuplier = dataPembelian.kodeSuplier;
                    this.tanggalBeli = dataPembelian.tanggalBeli;
                    this.listBarang = dataPembelian.listBarang;
                    this.totalBayar = dataPembelian.totalBayar;
                    this.kodeSuplier = dataPembelian.kodeSuplier;

                    helper.setSelect2("#select_kode_suplier", dataPembelian.kodeSuplier, dataPembelian.namaSuplier); 
                }
            },
            Search: function (kobar) { 
                if(!kobar)
                    return;

                var data = $.grep(Pembelian.selectBarangList,(n,i)=>{
                    return n.barang_id == kobar;
                });

                if(data.length>0){ 
                    Pembelian.listBarang.push(data[0]);
                }
                $("#select_kode_brg").val("").change();
            },
            Post: function () { 
                if(!localStorage.dataPembelian)
                    return;
                var data = JSON.parse(localStorage.dataPembelian);
                
                if(!data.nofak){
                    alert("Silahkan isi nomor faktur!");
                    return;
                }
                if(!data.kodeSuplier){
                    alert("Silahkan isi nama suplayer!");
                    return;
                }
                if(!data.tanggalBeli){
                    alert("Silahkan isi tanggal beli!");
                    return;
                }
                  
                data.totalHarga = helper.convertToInt(data.totalHarga);
                data.totalBayar = helper.convertToInt(data.totalBayar);
                data.kembalian = helper.convertToInt(data.kembalian); 
                $.each(Pembelian.listBarang,(index,item)=>{
                    item.barang_harpok = helper.convertToInt(item.barang_harpok);
                    item.barang_qty_input = helper.convertToInt(item.barang_qty_input);
                }) 

                $.ajax({
                    url: '<?php echo base_url().'admin/pembelian/simpan_pembelian';?>',
                    cache: false,
				    dataType: 'json',
                    // headers: {
                    //     'Content-Type': 'application/json'
                    // },
                    data: data,
                    method: 'POST',
                    beforeSend: function () {
                        BeforeSendAjaxBehaviour(true);
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data.status){
                        Pembelian.ClearData();
                        $(".info-success").text("Data berhasil disimpan."); 
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else{ 
                        $(".info-error").text(data.message);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                }).complete(function(){ 
                    AfterSendAjaxBehaviour(true);
                });
            },
            Delete: function () {
                if(!localStorage.dataPembelian)
                    return;
                    
                if (confirm("Apakah anda akan membatalkan transaksi?")) {
                    localStorage.dataPembelian = "";
                    location.reload();
                }
            },
            ClearData: function(){
                localStorage.dataPembelian = ""; 
            },
            Validation: function () {
            },
            SortArray: function (data, ColumnToSort) {
                data.sort(function (a, b) {
                    var x = a[ColumnToSort].toLowerCase();
                    var y = b[ColumnToSort].toLowerCase();
                    if (x < y) { return -1; }
                    if (x > y) { return 1; }
                    return 0;
                });
                return data;
            },
            totalHargaPerBarang(harpok,qty) { 
                 return helper.numberWithThousandSeparator(helper.convertToInt(harpok) * helper.convertToInt(qty)); 
            },
            ShowInputMoney: function(){
                var callback = function(data){
                    Pembelian.totalBayar=data;
                }
                helper.showModalInputUang(callback);
            }, 
        },
        computed: {
            totalHarga: function () {
                 var total = 0;
                 $.each(this.listBarang,function(index,item){
                    total +=  helper.convertToInt(item.barang_harpok) *  helper.convertToInt(item.barang_qty_input);
                 });
                 return total; 
            },
            kembalian: function () { 
                 return helper.convertToInt(this.totalBayar) - helper.convertToInt(this.totalHarga); 
            },
            labelKembalian: function () {
                 var kembalian = helper.convertToInt(this.totalBayar) - helper.convertToInt(this.totalHarga); 
                 return kembalian<0 ? "Kurang Bayar" : "Kembalian"; 
            }
        },
        updated: function () {
            helper.updatePriceFormat();
            var dataPembelian = {};
            dataPembelian.nofak = Pembelian.nofak;
            dataPembelian.kodeSuplier = Pembelian.kodeSuplier;

            Pembelian.namaSuplier = $("#select_kode_suplier option:selected").text();

            dataPembelian.namaSuplier = Pembelian.namaSuplier;
            dataPembelian.tanggalBeli = Pembelian.tanggalBeli; 
             
            dataPembelian.listBarang = Pembelian.listBarang;

            dataPembelian.totalHarga = Pembelian.totalHarga;
            dataPembelian.totalBayar = Pembelian.totalBayar;
            dataPembelian.kembalian = Pembelian.kembalian;
            dataPembelian.labelKembalian = Pembelian.labelKembalian;
            
            dataPembelian = JSON.stringify(dataPembelian);
            localStorage.dataPembelian = dataPembelian;
        }
    }); 

    $(document).ready(function(){
        Pembelian.Init();
    });
</script>
     