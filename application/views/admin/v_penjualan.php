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
            <small>Penjualan</small>
            <a href="#" data-toggle="modal" data-target="#largeModal" class="pull-right"><small></small></a>
        </h1> 
    </div>
</div>
    <section id="sectionPenjualan">
        <div class="row">
                <div class="col-lg-12">
                        <table style="width:100%">
                                <tr> 
                                    <td><b>Nama Barang<b></td> 
                                </tr>
                                <tr> 
                                    <td> 
                                        <select name="select_kode_brg" id="select_kode_brg" class="form-control input-lg"> 
                                        </select>
                                    </td>  
                                    <td>
                                        <div class="pull-right"> 
                                            <span class="btn btn-primary" v-on:click="Post"><i class="fa fa-save"> Simpan</i></span>
                                            <span class="btn btn-danger" v-on:click="Delete"><i class="fa fa-trash"> Batal</i></span>
                                        </div>
                                    </td>
                                </tr>
                        </table>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                <th>Nama</th>
                                <th>Satuan</th> 
                                <th>Harga</th>
                                <th>Qty</th>
                                <th style="width:200px">Total</th> 
                                <th style="width:10px"></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in listBarang">
                                    <td>{{row.barang_nama}}</td>
                                    <td>{{row.barang_satuan}}</td>
                                    <td class="barang_harjul text-right priceFormat">{{row.barang_harjul}}</td> 
                                    <td style="width:120px"> 
                                        <div class="input-group input-group-sm">
                                        <span class="input-group-btn btn-minus">
                                            <span class="btn btn-warning"><i class="glyphicon glyphicon-minus"></i></span>
                                        </span>
                                        <input v-model="row.barang_qty_input" class="form-control input-sm text-right input-qty" style="width:100px"/>
                                        <span class="input-group-btn btn-plus">
                                            <span class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></span>
                                        </span>
                                        </div>
                                    </td>
                                    <td class="text-right priceFormat">{{row.barang_harjul * row.barang_qty_input}}</td>
                                    <td class=""><span class="btn btn-danger btn-delete"><i class="glyphicon glyphicon-remove"></i></span></td>
                                </tr>
                            <tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="3" colspan="3">
                                    </th> 
                                    <th colspan="1"><b class="pull-right">Total Rp.</b></th> 
                                    <th>
                                        <input v-model="totalHarga" class="form-control input-lg priceFormat text-right" style="width:200px"/>
                                    </th> 
                                </tr>
                                <tr>
                                    <th colspan="1"><b class="pull-right">Total Bayar Rp.</b></th> 
                                    <th>
                                        <input v-model="totalBayar" class="form-control input-lg priceFormat text-right" style="width:200px"/>
                                    </th> 
                                </tr>
                                <tr>
                                    <th colspan="1"><b v-bind:class="('pull-right ' + (kembalian<0?'text-danger':''))">{{labelKembalian}} Rp.</b></th> 
                                    <th>
                                        <input v-model="kembalian" class="form-control input-lg priceFormat text-right" style="width:200px" readonly/>
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
                                <tr v-for="row in listBarang">
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
    var Penjualan = new Vue({
        el: "#sectionPenjualan",
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
                    placeholder: '',
                    ajax: {
                        dataType: 'json',
                        url: '<?php echo base_url().'admin/penjualan/get_barang2';?>',
                        delay: 800,
                        data: function(params) {
                            return {search: params.term}
                        },
                        processResults: function (data, page) {
                            Penjualan.selectBarangList = data;
                            return {
                                results: data
                            };
                        },
                    }
                }).on('select2:select', function (evt) {
                    $("#kode_brg").val($('#select_kode_brg').val()).trigger("input");
                });
                
                $("#select_kode_brg").change(function(){
                    beep();
                    var idBarang = $(this).val();
                    var barangExist = $.grep(Penjualan.listBarang,(n,i)=>{
                        return n.barang_id == idBarang;
                    });
                    if(barangExist.length>0){
                        barangExist[0].barang_qty_input ++;
                    }else{
                        Penjualan.Search($(this).val()); 
                    }
                })

                $(document).on("click",".btn-minus,.btn-plus",function(){ 
                    var target = $(this).closest("tr").find("td .input-qty");
                    var index = $(this).closest("tr").index();
                    //var hargaJual = $(this).closest("tr").find("td .barang_harjul");
                    
                    var qty = parseInt(target.val()) 
                    if($(this).hasClass("btn-minus")){
                        qty -= 1;
                    }else{
                        qty += 1;
                    }

                    if(qty>0)
                        beep();

                    var qty = qty<1 ? 1 : qty;
                    //target.val(qty).change();
                    Penjualan.listBarang[index].barang_qty_input=qty; 
                })

                $(document).on("click",".btn-delete",function(){ 
                    var target = $(this).closest("tr").find("td .btn-delete");
                    var index = $(this).closest("tr").index();  
                    Penjualan.listBarang.splice(index, 1);
                }) 

                /////
                
                var dataPenjualanEceran = localStorage.dataPenjualanEceran;
                if(dataPenjualanEceran){
                    dataPenjualanEceran = eval("("+ dataPenjualanEceran +")");
                    this.listBarang = dataPenjualanEceran.listBarang;
                    this.totalBayar = dataPenjualanEceran.totalBayar;
                }
            },
            Search: function (kobar) { 
                if(!kobar)
                    return;

                var data = $.grep(Penjualan.selectBarangList,(n,i)=>{
                    return n.barang_id == kobar;
                });

                if(data.length>0){
                    Penjualan.listBarang.push(data[0]);
                }
                $("#select_kode_brg").val("").change();
            },
            Post: function () { 
                if(!localStorage.dataPenjualanEceran)
                    return;

                var data = JSON.parse(localStorage.dataPenjualanEceran);
                data.totalHarga = helper.convertToInt(data.totalHarga);
                data.totalBayar = helper.convertToInt(data.totalBayar);
                data.kembalian = helper.convertToInt(data.kembalian); 
                $.each(Penjualan.listBarang,(index,item)=>{
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
                if(!localStorage.dataPenjualanEceran)
                    return;
                    
                if (confirm("Apaah anda akan membatalkan transaksi?")) {
                    localStorage.dataPenjualanEceran = "";
                    location.reload();
                }
            },
            ClearData: function(){
                localStorage.dataPenjualanEceran = "";
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
                 $.each(this.listBarang,function(index,item){
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

            var dataPenjualanEceran = {};
            dataPenjualanEceran.listBarang = Penjualan.listBarang;
            dataPenjualanEceran.totalHarga = Penjualan.totalHarga;
            dataPenjualanEceran.totalBayar = Penjualan.totalBayar;
            dataPenjualanEceran.kembalian = Penjualan.kembalian;
            dataPenjualanEceran.labelKembalian = Penjualan.labelKembalian;
            
            dataPenjualanEceran = JSON.stringify(dataPenjualanEceran);
            localStorage.dataPenjualanEceran = dataPenjualanEceran;
        }
    });

    var Faktur = new Vue({
        el: "#sectionFaktur",
        data: {
            listBarang: [],
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

                this.listBarang  = Penjualan.listBarang;
                this.totalHarga  = Penjualan.totalHarga;
                this.totalBayar  = Penjualan.totalBayar;
                this.kembalian  = Penjualan.kembalian;
                
                this.labelKembalian  = Penjualan.labelKembalian;
                $("#divInput").hide();
                $("#divFaktur").show();
                
                setTimeout(() => { 
                    window.print();
                    Penjualan.ClearData();
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
        Penjualan.Init();
    });
</script>
     