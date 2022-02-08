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
                <small>Pembayaran Piutang</small>
                <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small></small></a>
            </h1> 
        </div>
    </div>

    <section id="sectionPembayaran">
        <div class="row">
                <div class="col-lg-12">
                        <table class="w-100 filter">
                                <tr> 
                                    <td><b>Nama Pelanggan<b></td>  
                                    <td><b>No.Faktur<b></td>  
                                    <td colspan="3"><b>Tanggal<b></td>  
                                    <td><b>Status<b></td>   
                                </tr>
                                <tr> 
                                    <td style="width:200px"> 
                                        <input v-model="namaPelanggan" class="form-control input-sm"/>
                                   </td> 
                                    <td style="width:200px"> 
                                        <input v-model="nofak" class="form-control input-sm"/>
                                   </td> 
                                    <td style="width:200px"> 
                                        <input v-model="tanggalDari" type="date" name="tanggal_dari" id="input_tanggal_dari" class="form-control input-sm"/>  
                                    </td> 
                                    <td style="width:10px">s/d</td>
                                    <td style="width:200px"> 
                                        <input v-model="tanggalSampai" type="date" name="tanggal_sampai" id="input_tanggal_sampai" class="form-control input-sm"/>  
                                    </td>  
                                    <td style="width:200px"> 
                                       <select v-model="status"><option value="">Semua</option><option value="0">Belum Lunas</option><option value="1">Lunas</option></select>
                                    </td> 
                                    <td>
                                         <div class="pull-right"> 
                                            <span class="btn btn-warning" v-on:click="Search"><i class="fa fa-search"> Cari</i></span>
                                        </div> 
                                    </td>
                                </tr>
                        </table>
                        </br> 
                        <div id="divTablePiutangLoading"></div>
                        <table id="tablePiutang" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No.Faktur</th>
                                    <th>Tanggal Pembelian</th> 
                                    <th>Total Harga</th>
                                    <th>Total Bayar</th>
                                    <th>Kurang Bayar</th>
                                    <th>Nama Pegawai</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(row,index) in listPiutang">
                                    <td>{{index+1}}</td>
                                    <td>{{row.jual_nofak}}</td>
                                    <td class="">{{row.jual_tanggal}}</td> 
                                    <td class="text-right priceFormat">{{row.jual_total}}</td>
                                    <td class="text-right priceFormat">{{row.jual_jml_uang}}</td>
                                    <td class="text-right priceFormat">{{row.jual_kembalian * -1}}</td>
                                    <td class="">{{row.user_nama}}</td>
                                    <td class=""><span class="btn btn-success btn-pilih"><i class="glyphicon glyphicon-edit">Pilih</i></span></td>
                                </tr>
                            </tbody> 
                        </table>
                </div>
            </div>

        </div>
    </section>

    <section id="sectionDetail" style="display:none">
        <div><span class="btn btn-default" v-on:click="ShowHeader"><i class="glyphicon glyphicon-arrow-left"> Kembali</i></span></div>
        <h3 style="margin-top:10px"></h3>  
        <table class="w-100">   
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
                <td class="">{{numberWithThousandSeparator(kurangBayar * -1)}}</td> 
            </tr>
        </table>

        </br>
        <h3 style="margin-top:10px">List barang</h3>  
        <table class="table table-stripped">
            <thead>
                <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Qty</th>
                <th style="width:200px">Total</th>
                </tr>
            </thead>
            <tbody>
            <!-- d_jual_barang_nama, d_jual_barang_satuan, d_jual_barang_harjul, d_jual_qty, d_jual_total -->
                <tr v-for="(row,index) in listBarang">
                    <td>{{index+1}}</td>
                    <td>{{row.barang_nama}}</td> 
                    <td class="text-right priceFormat">{{row.barang_harjul}}</td> 
                    <td class="text-right">{{row.qty}} {{row.barang_satuan}}</td>
                    <td class="text-right priceFormat">{{row.total}}</td> 
                </tr>
        </tbody>
        </table> 
        
        </br>  
        <h3 style="margin-top:10px">Riwayat Bayar</h3>  
        <table class="table table-stripped">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>No.Faktur</th>
                        <th>Piutang</th>
                        <th>Tgl.Bayar</th>
                        <th>Jml.Pembayaran</th>
                        <th>Kurang Bayar</th>
                        <th>Nama Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                    <!-- d_jual_barang_nama, d_jual_barang_satuan, d_jual_barang_harjul, d_jual_qty, d_jual_total -->
                        <tr v-for="(row,index) in listPembayaran">
                            <td>{{index+1}}</td>
                            <td>{{row.bayar_nofak}}</td> 
                            <td class="text-right priceFormat">{{row.piutang}}</td> 
                            <td>{{row.bayar_tanggal}}</td> 
                            <td class="text-right priceFormat">{{row.bayar_jml_uang}}</td> 
                            <td class="text-right priceFormat">{{row.bayar_kurang}}</td>
                            <td>{{row.user_nama}}</td> 
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4"></th> 
                            <td align="right"><b><input v-model="inputBayar" id="inputBayar" class="text-right priceFormat"/></b></td> 
                            <td align="right"><b><input v-model="kurangBayarBaruShow" id="inputBayar" class="text-right" disabled/></b></td>  
                            <th>       
                                <span class="btn btn-primary" v-on:click="Simpan"><i class="fa fa-save"> SIMPAN</i></span>
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
    // var tablePiutang = $('#tablePiutang').DataTable({
    //     paging:false,
    //     scrollY: 400,
    //     searching:false,
    //     info:false,
    //     ordering:false,
    //     catch:false
    // });

    var tablePiutang;

    var Pembayaran = new Vue({
        el: "#sectionPembayaran",
        data: {
            listPiutang: [],
            totalPiutang : 0 ,
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
            
            namaPelanggan:"",
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
                    var data = Pembayaran.listPiutang[index];
                    Detail.Show(data);
                })  
            },
            Search: function () {  
                if(!Pembayaran.namaPelanggan && !Pembayaran.tanggalDari && !Pembayaran.tanggalSampai && !Pembayaran.nofak){
                    alert("Silahkan isi minimal satu data filter nomor faktur, nama pelanggan atau tanggal!");
                    return;
                }
                var data = {
                    namaPelanggan : Pembayaran.namaPelanggan,
                    tanggalDari : Pembayaran.tanggalDari, 
                    tanggalSampai : Pembayaran.tanggalSampai,  
                    nofak : Pembayaran.nofak, 
                    status : Pembayaran.status,  
                };
                $.ajax({
                    url: '<?php echo base_url().'admin/penjualan_bayar/get_piutang';?>',
                    cache: false,
				    dataType: 'json', 
                    data: data,
                    method: 'POST',
                    beforeSend: function () {  
                        BeforeSendAjaxBehaviour();
					    $('#divTablePiutangLoading').addClass('panel-loading');
					    $('#tablePiutang').hide();
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data){
                        Pembayaran.listPiutang = [];
                        setTimeout(() => {
                            Pembayaran.listPiutang = data; 
                            if(!tablePiutang){
                                setTimeout(() => { 
                                    ////alert($(window).height()-1000);
                                    tablePiutang = $('#tablePiutang').DataTable({
                                        paging:false,
                                        scrollY: 800,
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
                    $('#divTablePiutangLoading').removeClass('panel-loading');
				    $('#tablePiutang').show();
                });
            },
            Post: function () { 
                if(!localStorage.dataPembayaran)
                    return;

                var data = JSON.parse(localStorage.dataPembayaran);
                data.totalHarga = helper.convertToInt(data.totalHarga);
                data.totalBayar = helper.convertToInt(data.totalBayar);
                data.kembalian = helper.convertToInt(data.kembalian); 
                $.each(Pembayaran.listPiutang,(index,item)=>{
                    item.barang_harjul = helper.convertToInt(item.barang_harjul);
                    item.barang_qty_input = helper.convertToInt(item.barang_qty_input);
                })

                $.ajax({
                    url: '<?php echo base_url().'admin/penjualan/simpan_penjualan';?>',
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
            numberWithThousandSeparator: function (myNumber) {
                return helper.numberWithThousandSeparator(myNumber);
            },
            Delete: function () {
                if(!localStorage.dataPembayaran)
                    return;
                    
                if (confirm("Apakah anda akan membatalkan transaksi?")) {
                    localStorage.dataPembayaran = "";
                    location.reload();
                }
            },
            ClearData: function(){
                localStorage.dataPembayaran = "";
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
            }
        },
        computed: {
            totalHarga: function () {
                 var total = 0;
                 $.each(this.listPiutang,function(index,item){
                    total +=  helper.convertToInt(item.barang_harjul) *  helper.convertToInt(item.barang_qty_input);
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
                $("#sectionPembayaran").hide();
                $("#sectionDetail").show(); 
                this.inputBayar = "";
                this.nofak = data.jual_nofak;
                this.tanggalPembelian = moment(data.jual_tanggal).format("DD-MM-YY HH:mm");
                this.totalHarga = data.jual_total;
                this.totalBayar = data.jual_jml_uang;
                this.kurangBayar = data.jual_kembalian;
                this.namaPegawai = data.user_nama; 
                
                this.SearchListBarang(this.nofak); 
                this.SearchListBayar(this.nofak); 
                $("#inputBayar").focus(); 
            },
            ShowHeader: function () { 
                $("#sectionPembayaran").show();
                $("#sectionDetail").hide(); 
            },
            SearchListBarang: function (nofak) { 
                if(!nofak)
                    return;

                $.ajax({
                    url: '<?php echo base_url().'admin/penjualan_bayar/get_list_barang?nofak=';?>' + nofak,
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
                    url: '<?php echo base_url().'admin/penjualan_bayar/get_list_bayar?nofak=';?>' + nofak,
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
            numberWithThousandSeparator: function (myNumber) {
                return helper.numberWithThousandSeparator(myNumber);
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
                    url: '<?php echo base_url().'admin/penjualan_bayar/simpan_pembayaran';?>',
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
                      Pembayaran.Search();
                    }else{ 
                        $(".info-error").text(data.message);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $(".info-error").text(textStatus);
                }).complete(function () { 
                    AfterSendAjaxBehaviour(true);
                });
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
        Pembayaran.Init();
    });
</script>
     