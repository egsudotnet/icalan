<div id="divInput"> 
<?php 
    $this->load->view('layout/header');
?> 


<!-- Page Content -->
<div class="container"> 
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Transaksi
                <small>Pembayaran Utang</small>
                <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small></small></a>
            </h3> 
        </div>
    </div>

    <section id="sectionPembelian">
        <div class="row">
                <div class="col-lg-12">
                        <table class="w-100 filter table-list">
                                <tr> 
                                    <td><b>Suplayer<b></td>  
                                    <td><b>No.Faktur<b></td>  
                                    <td><b>Status<b></td>   
                                </tr>
                                <tr> 
                                    <td style="">  
                                        <select name="select_kode_suplier" id="select_kode_suplier" class="form-control input-sm"> 
                                        </select> 
                                   </td> 
                                    <td style=""> 
                                        <input v-model="nofak" class="form-control input-sm"/>
                                   </td> 
                                    <td style=""> 
                                       <select v-model="status" class="w-100 form-control"><option value="">Semua</option><option value="0">Belum Lunas</option><option value="1">Lunas</option></select>
                                    </td> 
                                </tr>
                                
                                <tr>  
                                    <td colspan="3"><b>Tanggal<b></td>   
                                </tr>
                                <tr>  
                                    <td style=""> 
                                        <input v-model="tanggalDari" type="date" name="tanggal_dari" id="input_tanggal_dari" class="form-control input-sm"/>  
                                    </td>  
                                    <td style=""> 
                                        <input v-model="tanggalSampai" type="date" name="tanggal_sampai" id="input_tanggal_sampai" class="form-control input-sm"/>  
                                    </td>   
                                    <td>
                                         <div class="pull-right"> 
                                            <span class="btn btn-warning" v-on:click="Search"><i class="fa fa-search"> Cari</i></span>
                                        </div> 
                                    </td>
                                </tr>
                        </table>
                        </br> 
                        <div id="divTableUtangLoading"></div>
                        <table id="tableUtang" class="table table-bordered table-list">
                            <thead>
                                <tr>
                                    <th style="width:30%">Suplayer</th>
                                    <th style="width:15%">No.Faktur</th>
                                    <th style="width:15%">Total Harga</th>
                                    <th style="width:15%">Kurang Bayar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row,index) in listUtang">
                                    <td>{{row.suplier_nama}}</td>
                                    <td>{{row.beli_nofak}}</td>
                                    <!-- <td class="">{{row.beli_tanggal}}</td>  -->
                                    <td class="text-right priceFormat">{{row.beli_total}}</td>
                                    <td class="text-right priceFormat">{{row.beli_kembalian * -1}}</td>
                                    <td class=""><span class="btn btn-success btn-pilih"><i class="glyphicon glyphicon-edit"></i></span></td>
                                </tr>
                            </tbody> 
                        </table>
                </div>
            </div>

        </div>
    </section>

    <section id="sectionDetail" style="display:none">
        <div><span class="btn btn-default" v-on:click="ShowHeader"><i class="glyphicon glyphicon-arrow-left"> Kembali</i></span></div>
     
        <table class="w-100 table-list">   
            <tr>
                <td style="width:150px">No.Faktur</td>
                <td style="width:300px">{{nofak}}</td> 
                <td style="width:150px">Total Harga</td>
                <td style="width:300px" class="">{{numberWithThousandSeparator(totalHarga)}}</td> 
            </tr>
            <tr>
                <td>Tanggal Pembelian</td> 
                <td>{{tanggalPembelian}}</td> 
                <td>Total Bayar</td> 
                <td class="">{{numberWithThousandSeparator(totalBayar)}}</td> 
            </tr>
            <tr>
                <td>Nama Pegawai</td> 
                <td>{{namaPegawai}}</td> 
                <td>Kurang Bayar</td>
                <td>{{numberWithThousandSeparator(kurangBayar * -1)}}</td> 
            </tr>
        </table>

        </br>
        <h3 style="margin-top:10px">List barang</h3>  
        <table class="table table-stripped  table-list">
            <thead>
                <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Qty</th>
                <th style="width:200px">Total</th>
                </tr>
            </thead>
            <tbody>
            <!-- d_beli_barang_nama, d_beli_barang_satuan, d_beli_barang_harpok, d_beli_qty, d_beli_total -->
                <tr v-for="(row,index) in listBarang">
                    <td>{{index+1}}</td>
                    <td>{{row.barang_nama}}</td> 
                    <td class="text-right priceFormat">{{row.barang_harpok}}</td> 
                    <td class="text-right priceFormat">{{row.barang_harjul}}</td> 
                    <td class="text-right">{{row.qty}} {{row.barang_satuan}}</td>
                    <td class="text-right priceFormat">{{row.total}}</td> 
                </tr>
        </tbody>
        </table> 
        
        </br>  
        <h3 style="margin-top:10px">Riwayat Bayar</h3>  
        <!-- <table class="table table-stripped table-list">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>No.Faktur</th>
                        <th>Utang</th>
                        <th>Tgl.Bayar</th>
                        <th>Jml.Pembayaran</th>
                        <th>Kurang Bayar</th>
                        <th>Nama Pegawai</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr v-for="(row,index) in listPembelian">
                            <td>{{index+1}}</td>
                            <td>{{row.bayar_nofak}}</td> 
                            <td class="text-right priceFormat">{{row.utang}}</td> 
                            <td>{{row.bayar_tanggal}}</td> 
                            <td class="text-right priceFormat">{{row.bayar_jml_uang}}</td> 
                            <td class="text-right priceFormat">{{row.bayar_kurang}}</td>
                            <td>{{row.user_nama}}</td> 
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4"></th> 
                            <td align="right" v-on:click="ShowInputMoney">
                                <div class="input-group" style="width:120px">
                                    <span class="input-group-addon"><i class="fa fa-money btn-success"></i></span>
                                    <input v-model="inputBayar" id="inputBayar" class="text-right priceFormat" disabled style="width:120px !important"/>
                                </div>
                            </td> 
                            <td align="right"><b><input v-model="kurangBayarBaruShow" id="inputBayar" class="text-right" disabled/></b></td>  
                            <th>       
                                <span class="btn btn-primary" v-on:click="Simpan"><i class="fa fa-save"> SIMPAN</i></span>
                            </th> 
                        </tr>
                    </tfoot>
                </table>   -->
 
                <table class="table table-stripped  table-list">
                    <thead>
                        <tr>
                        <th>No.Transaksi</th>
                        <th>Tgl.Bayar</th>
                        <th>Pembayaran</th>
                        <th>Kurang Bayar</th>
                        <th>Nama Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- d_jual_barang_nama, d_jual_barang_satuan, d_jual_barang_harjul, d_jual_qty, d_jual_total -->
                        <tr v-for="(row,index) in listPembayaran">
                            <td>{{row.bayar_nofak}}</td> 
                            <td>{{row.bayar_tanggal}}</td> 
                            <td class="text-right priceFormat">{{row.bayar_jml_uang}}</td> 
                            <td class="text-right priceFormat">{{row.bayar_kurang}}</td>
                            <td>{{row.user_nama}}</td> 
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th  colspan="1"></th> 
                            <th colspan="2" v-on:click="ShowInputMoney">
                                <div class="input-group" style="">
                                    <span class="input-group-addon"><i class="fa fa-money btn-success"></i></span>
                                    <input v-model="inputBayar" id="inputBayar" class="form-control input-sm priceFormat text-right" style="" readonly/>
                                </div> 
                            </th>  
                            <td>
                                    <input v-model="kurangBayarBaruShow" class="form-control input-sm priceFormat text-right" style="margin-top:7px" readonly/> 
                            </td>  
                            <th>       
                                <span class="btn btn-success" v-on:click="Simpan"><i class="fa fa-save"></i></span>
                            </th> 
                        </tr>
                    </tfoot>
                </table>  
    <section>
</div>
<!-- /.container -->

<!-- footer -->
<?php 
    $this->load->view('layout/footer');
?> 
</div> 
</div>
 
<script type="text/javascript">
    // var tableUtang = $('#tableUtang').DataTable({
    //     paging:false,
    //     scrollY: 400,
    //     searching:false,
    //     info:false,
    //     ordering:false,
    //     catch:false
    // });

    var tableUtang;

    var Pembelian = new Vue({
        el: "#sectionPembelian",
        data: {
            listUtang: [],
            totalUtang : 0 ,
            totalBayar : 0 ,
            kurangBayar : 0,

            tanggalDari : "",
            tanggalSampai : "",
            //data struk
            nofak : "",
            namaUser : "",
            namaToko : "",
            alamatToko : "",
            hpToko : "",
            
            kodeSuplier:"",
            status:""
        },
        mounted: function () {  
        },
        watch: { 
        },
        methods: {
            Init: function (isNew, data) {   
                $(document).on("click",".btn-pilih",function(){ 
                    var target = $(this).closest("tr").find("td .btn-pilih");
                    var index = $(this).closest("tr").index();
                    var data = Pembelian.listUtang[index];
                    Detail.Show(data);
                })  

                
                this.selectBarang = $('#select_kode_suplier').select2({
                    minimumInputLength: 3,
                    allowClear: true,
                    width:"100%",
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
                });  
            },
            Search: function () {  
                if(!Pembelian.kodeSuplier && !Pembelian.tanggalDari && !Pembelian.tanggalSampai && !Pembelian.nofak){
                    alert("Silahkan isi minimal satu data filter nomor faktur, suplayer atau tanggal!");
                    return;
                }
                var data = {
                    kodeSuplier : Pembelian.kodeSuplier,
                    tanggalDari : Pembelian.tanggalDari, 
                    tanggalSampai : Pembelian.tanggalSampai,  
                    nofak : Pembelian.nofak, 
                    status : Pembelian.status,  
                };
                $.ajax({
                    url: '<?php echo base_url().'admin/pembelian_bayar/get_utang';?>',
                    cache: false,
				    dataType: 'json', 
                    data: data,
                    method: 'POST',
                    beforeSend: function () {  
                        BeforeSendAjaxBehaviour();
					    $('#divTableUtangLoading').addClass('panel-loading');
					    $('#tableUtang').hide();
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data){
                        Pembelian.listUtang = [];
                        setTimeout(() => {
                            Pembelian.listUtang = data; 
                            if(!tableUtang){
                                setTimeout(() => { 
                                    ////alert($(window).height()-1000);
                                    tableUtang = $('#tableUtang').DataTable({
                                        paging:false,
                                        scrollY: 500,
                                        searching:false,
                                        info:false,
                                        ordering:false,
                                        catch:false
                                    });
                                }, 1000); 
                            }
                        }, 1000);
                    }else{ 
                        $(".info-error").text("Tidak ada data.");
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                }).complete(()=>{ 
                    $('#divTableUtangLoading').removeClass('panel-loading');
				    $('#tableUtang').show();
                });
            },
            Post: function () { 
                if(!localStorage.dataPembelian)
                    return;

                var data = JSON.parse(localStorage.dataPembelian);
                data.totalHarga = helper.convertToInt(data.totalHarga);
                data.totalBayar = helper.convertToInt(data.totalBayar);
                data.kembalian = helper.convertToInt(data.kembalian); 
                $.each(Pembelian.listUtang,(index,item)=>{
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
                        Faktur.print(data.data); 
                    }else{ 
                        $(".info-error").text(data.message);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                }).complete(function () { 
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
                location.reload();
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
            numberWithThousandSeparator: function (myNumber) {
                return helper.numberWithThousandSeparator(myNumber);
            },
        },
        computed: {
            totalHarga: function () {
                 var total = 0;
                 $.each(this.listUtang,function(index,item){
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
            helper.updatePriceFormat()
            //helper.updateDateFormat() 
        }
    });

    var Detail = new Vue({
        el: "#sectionDetail",
        data: { 
            nofak:"",
            tanggalPembelian:"",
            totalHarga:"",
            totalBayar:"",
            kurangBayar:"",
            namaPegawai:"",
            listBarang:[],
            listPembayaran:[], 
            inputBayar:0
        },
        mounted: function () { 
        },
        watch: { 
        },
        methods: {
            Init: function () { 
            },
            Clear: function () { 
                this.nofak = "";
                this.tanggalPembelian = "";
                this.totalHarga = "";
                this.totalBayar = "";
                this.kurangBayar = "";
                this.namaPegawai = "";
                this.listBarang = [];
                this.listPembayaran = [];
                this.inputBayar = 0
            },
            Show: function (data) { 
                this.Clear();
                $("#sectionPembelian").hide();
                $("#sectionDetail").show(); 
                this.inputBayar = "";
                this.nofak = data.beli_nofak;
                this.tanggalPembelian = moment(data.beli_tanggal).format("DD-MM-YY HH:mm");
                this.totalHarga = data.beli_total;
                this.totalBayar = data.beli_jml_uang;
                this.kurangBayar = data.beli_kembalian;
                this.namaPegawai = data.user_nama; 
                
                this.SearchListBarang(this.nofak); 
                this.SearchListBayar(this.nofak); 
                $("#inputBayar").focus(); 
            },
            ShowHeader: function () { 
                $("#sectionPembelian").show();
                $("#sectionDetail").hide(); 
            },
            SearchListBarang: function (nofak) { 
                if(!nofak)
                    return;

                $.ajax({
                    url: '<?php echo base_url().'admin/pembelian_bayar/get_list_barang?nofak=';?>' + nofak,
                    cache: false,
				    dataType: 'json',  
                    method: 'GET',
                    beforeSend: function () {
                        BeforeSendAjaxBehaviour();
                        $('#sectionDetail').addClass('panel-loading'); 
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data){
                        Detail.listBarang = data;
                    }else{ 
                        $(".info-error").text("Tidak ada data.");
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                }).complete(()=>{
                    $('#sectionDetail').removeClass('panel-loading');
                });
            },
            SearchListBayar: function (nofak) { 
                if(!nofak)
                    return;

                $.ajax({
                    url: '<?php echo base_url().'admin/pembelian_bayar/get_list_bayar?nofak=';?>' + nofak,
                    cache: false,
				    dataType: 'json',  
                    method: 'GET',
                    beforeSend: function () {
                        BeforeSendAjaxBehaviour();
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data){
                        Detail.listPembayaran = data;
                    }else{ 
                        $(".info-error").text("Tidak ada data.");
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                });
            },
            Simpan: function () { 
                var data= {};
                data.nofak = this.nofak;
                data.kurangBayar = helper.convertToInt(this.kurangBayar);
                data.inputBayar = helper.convertToInt(this.inputBayar);  
                data.kurangBayarBaru = helper.convertToInt(this.kurangBayarBaru);  

                if(data.kurangBayarBaru>0){
                    alert("Pembayaran makasimal adalah Rp." + helper.numberWithThousandSeparator(data.kurangBayar * -1))
                    $("#inputBayar").focus(); 
                    return;
                }
                if(data.inputBayar<=0){
                    alert("Silahkan isi jumlah pembayaran!")
                    $("#inputBayar").focus(); 
                    return;
                }

                $.ajax({
                    url: '<?php echo base_url().'admin/pembelian_bayar/simpan_pembayaran';?>',
                    cache: false,
				    dataType: 'json', 
                    data: data,
                    method: 'POST',
                    beforeSend: function () {
                        BeforeSendAjaxBehaviour(true);
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data.status){
                      Detail.ShowHeader();
                      Pembelian.Search();
                    }else{ 
                        $(".info-error").text(data.message);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                }).complete(function () { 
                    AfterSendAjaxBehaviour(true);
                });
            },
            numberWithThousandSeparator: function (myNumber) {
                return helper.numberWithThousandSeparator(myNumber);
            },
            ShowInputMoney: function(){
                var callback = function(data){
                    Detail.inputBayar=data;
                }
                helper.showModalInputUang(callback);
            }, 
        },
        computed: {
            kurangBayarBaru: function () {
                 var value = 0; 
                 value = helper.convertToInt(this.kurangBayar) + helper.convertToInt(this.inputBayar);
                 value = isNaN(value)?"":value;
                 return value;
            },
            kurangBayarBaruShow: function () {
                 var value = 0; 
                 value = helper.convertToInt(this.kurangBayar) + helper.convertToInt(this.inputBayar);
                 value = isNaN(value)?0: value ;
                 return helper.numberWithThousandSeparator(value * -1);
            } 
        },
        updated: function () {
            helper.updatePriceFormat();
        }
    });
 
    $(document).ready(function(){
        Pembelian.Init();
    });
</script>
     