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
                        <table style="width:100%">
                                <tr> 
                                    <td><b>No.Faktur<b></td>  
                                    <td><b>Tanggal<b></td>  
                                </tr>
                                <tr> 
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
                                    <td>
                                         <div class="pull-right"> 
                                            <span class="btn btn-warning" v-on:click="Search"><i class="fa fa-search"> Cari</i></span>
                                        </div>
                                        <!-- <div class="pull-right"> 
                                            <span class="btn btn-primary" v-on:click="Post"><i class="fa fa-save"> Simpan</i></span>
                                            <span class="btn btn-danger" v-on:click="Delete"><i class="fa fa-tras"> Batal</i></span>
                                        </div> -->
                                    </td>
                                </tr>
                        </table>
                        </br> 
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                <th>No.Faktur</th>
                                <th>Tanggal Pembelian</th> 
                                <th>Total Harga</th>
                                <th>Total Bayar</th>
                                <th>Kurang Bayar</th>
                                <th>Nama Pegawai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in listPiutang">
                                    <td>{{row.jual_nofak}}</td>
                                    <td>{{row.jual_tanggal}}</td> 
                                    <td class="text-right priceFormat">{{row.jual_total}}</td>
                                    <td class="text-right priceFormat">{{row.jual_jml_uang}}</td>
                                    <td class="text-right priceFormat">{{row.jual_kembalian}}</td>
                                    <td class="text-right">{{row.user_nama}}</td>
                                    <td class=""><span class="btn btn-success btn-cari-faktur"><i class="glyphicon glyphicon-remove">Pilih</i></span></td>
                                </tr>
                            <tbody> 
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

<div id="divFaktur" style="display:none;width:400px">  
    <section id="sectionFaktur">
        <div class="row">
                <div class="col-lg-12">
                        <table>
                                <tr> 
                                    <th>SELAMAT DATANG</th> 
                                </tr>
                                <tr> 
                                    <th>  
                                        {{namaToko}}
                                    </th>  
                                </tr>
                                <tr> 
                                    <th>  
                                        {{alamatToko}}
                                    </th>  
                                </tr>
                                <tr> 
                                    <th>  
                                        {{hpToko}}
                                    </th>  
                                </tr>
                        </table> 
                        <div>{{nofak}} <span class="pull-right">{{tanggalTransaksi}}</span></div>
                        <div>{{namaUser}}</div>
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:40%">Barang</th>
                                    <th style="width:20%">Harga</th>
                                    <th style="width:20%">Qty</th>
                                    <th style="width:20%">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in listPiutang">
                                    <td>{{row.barang_nama}}</td>
                                    <td class="text-right priceFormat">{{row.barang_harjul}}</td>
                                    <td class="text-right priceFormat">{{row.barang_qty_input}} {{row.barang_satuan}}</td> 
                                    <td class="text-right priceFormat">{{row.barang_harjul * row.barang_qty_input}}</td>
                                </tr>
                            <tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        </br>
                                    </td>
                                </tr> 
                                <tr> 
                                    <td colspan="3"><b class="pull-right">Total</b></td> 
                                    <td class="text-right priceFormat">{{totalHarga}}</td> 
                                </tr>
                                <tr>
                                    <td colspan="3"><b class="pull-right">Total Bayar</b></td> 
                                    <td class="text-right priceFormat">{{totalBayar}}</td> 
                                </tr>
                                <tr>
                                    <td colspan="3"><b class="pull-right">{{labelKembalian}}</b></td> 
                                    <td class="text-right priceFormat">{{kembalian}}</td> 
                                </tr>
                                <tr>

                                    <td colspan="4" align="center">
                                        </br>
                                        <b>Terima kasih</b>
                                    </td>  
                                </tr>
                            </tfoot>
                        </table>
                </div>
            </div>

        </div>
    </section>
</div>

<script type="text/javascript">
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
                    alert("pilih");   
                })  
            },
            Search: function () {  
                var data = {
                    tanggalDari : Pembayaran.tanggalDari, 
                    tanggalSampai : Pembayaran.tanggalSampai,  
                    nofak : Pembayaran.nofak, 
                };
                $.ajax({
                    url: '<?php echo base_url().'admin/penjualan_bayar/get_piutang';?>',
                    cache: false,
				    dataType: 'json', 
                    data: data,
                    method: 'POST',
                    beforeSend: function () {
                        BeforeSendAjaxBehaviour(true);
                    }
                }).done(function (data, textStatus, jqXHR) {
                    if(data){
                        Pembayaran.listPiutang = data;
                    }else{ 
                        $("#info-error").text("Tidak ada data.");
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $("#info-error").text(textStatus);
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
                        $("#info-error").text(data.message);
                    }
                }).fail(function (jqXHR, textStatus, errorThrown) { 
                    $("#info-error").text(textStatus);
                });
            },
            Put: function () {
            },
            Delete: function () {
                if(!localStorage.dataPembayaran)
                    return;
                    
                if (confirm("Apaah anda akan membatalkan transaksi?")) {
                    localStorage.dataPembayaran = "";
                    location.reload();
                }
            },
            ClearData: function(){
                localStorage.dataPembayaran = "";
                location.reload();
            },
            Validation: function () {
                // $("#crewForm").validate({
                //     rules: {
                //         textNonEmployeeIdModal: {
                //             alphanumeric : true
                //         }
                //     },
                //     highlight: function (element, errorClass, validClass) {
                //         $(element).parents('.form-control').removeClass('has-success').addClass('has-error');
                //     },
                //     unhighlight: function (element, errorClass, validClass) {
                //         $(element).parents('.form-control').removeClass('has-error').addClass('has-success');
                //     },
                //     errorPlacement: function (error, element) {
                //         if (element.hasClass('select2') && element.next('.select2-container').length) {
                //             error.insertAfter(element.next('.select2-container'));
                //         } else if (element.parent('.input-group').length) {
                //             error.insertAfter(element.parent());
                //         }
                //         else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                //             error.insertAfter(element.parent().parent());
                //         }
                //         else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                //             error.appendTo(element.parent().parent());
                //         }
                //         else if (element.hasClass('select2-employee')) {
                //             error.insertAfter(element.parent());
                //         }
                //         else {
                //             error.insertAfter(element);
                //         }
                //     }
                // });
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
            $('.priceFormat').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: '.'
            });

            var dataPembayaran = {};
            dataPembayaran.listPiutang = Pembayaran.listPiutang;
            dataPembayaran.totalHarga = Pembayaran.totalHarga;
            dataPembayaran.totalBayar = Pembayaran.totalBayar;
            dataPembayaran.kembalian = Pembayaran.kembalian;
            dataPembayaran.labelKembalian = Pembayaran.labelKembalian;
            
            dataPembayaran = JSON.stringify(dataPembayaran);
            localStorage.dataPembayaran = dataPembayaran;
        }
    });

    var Faktur = new Vue({
        el: "#sectionFaktur",
        data: {
            listPiutang: [],
            totalHarga : 0,
            totalBayar : 0,
            kembalian : "", 
            nofak : "",
            namaUser : "",
            namaToko : "",
            alamatToko : "",
            hpToko : "",
            labelKembalian : "",
            tanggalTransaksi : "ffffff ff"
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
            },
            print: function (data) {
                this.nofak =  data.nofak;
                this.namaUser = data.namaUser;
                this.tanggalTransaksi = data.tanggalTransaksi;
                this.namaToko = $.grep(data.dataToko,(n,i)=>{return n.lookup_kode == helper.dataToko.namaTokoKode})[0].lookup_value;
                this.alamatToko = $.grep(data.dataToko,(n,i)=>{return n.lookup_kode == helper.dataToko.alamatTokoKode})[0].lookup_value;
                this.hpToko = $.grep(data.dataToko,(n,i)=>{return n.lookup_kode == helper.dataToko.hpTokoKode})[0].lookup_value;

                this.listPiutang  = Pembayaran.listPiutang;
                this.totalHarga  = Pembayaran.totalHarga;
                this.totalBayar  = Pembayaran.totalBayar;
                this.kembalian  = Pembayaran.kembalian;
                
                this.labelKembalian  = Pembayaran.labelKembalian;
                $("#divInput").hide();
                $("#divFaktur").show();
                
                setTimeout(() => { 
                    window.print();
                    Pembayaran.ClearData();
                }, 1000);
            },
            Put: function () {
            },
            Delete: function () {
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
        },
        updated: function () {
            $('.priceFormat').priceFormat({
                prefix: '',
                //centsSeparator: '',
                centsLimit: 0,
                thousandsSeparator: '.'
            });
        }
    });

    $(document).ready(function(){
        Pembayaran.Init();
    });
</script>
     