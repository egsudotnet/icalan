
<?php 
    $this->load->view('layout/header');
?> 

<!-- Page Content -->
<div class="container"> 
    <section id="sectionPenjualan">
        <div class="row">
                <div class="col-lg-12">
                        <table>
                                <tr> 
                                    <th>Nama Barang</th> 
                                </tr>
                                <tr> 
                                    <td> 
                                        <select name="select_kode_brg" id="select_kode_brg" class="form-control input-lg"> 
                                        </select>
                                    </td>  
                                </tr>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th>Nama</th>
                                <th>Satuan</th> 
                                <th>Harga</th>
                                <th>Qty</th>
                                <th style="width:200px">Total</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in listBarang">
                                    <td>{{row.barang_nama}}</td>
                                    <td>{{row.barang_satuan}}</td>
                                    <td class="barang_harjul text-right">{{row.barang_harjul}}</td> 
                                    <td style="width:120px"> 
                                        <div class="input-group input-group-lg">
                                        <span class="input-group-btn btn-minus">
                                            <span class="btn btn-warning"><i class="glyphicon glyphicon-minus"></i></span>
                                        </span>
                                        <input v-model="row.barang_qty_input" class="form-control input-lg text-right input-qty" style="width:100px"/>
                                        <span class="input-group-btn btn-plus">
                                            <span class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></span>
                                        </span>
                                        </div>
                                    </td>
                                    <td class="text-right">{{row.barang_harjul * row.barang_qty_input}}</td>
                                </tr>
                            <tbody>
                            <tfoot>
                                <tr>
                                    <th rowspan="3" colspan="3"><span class="btn btn-primary"><i class="fa fa-save"> Simpan</i></span></th> 
                                    <th colspan="1"><b class="pull-right">Total</b></th> 
                                    <th>
                                        <input v-model="totalHarga" class="form-control input-lg priceFormat text-right" style="width:200px"/>
                                    </th> 
                                </tr>
                                <tr>
                                    <th colspan="1"><b class="pull-right">Total Bayar</b></th> 
                                    <th>
                                        <input v-model="totalBayar" class="form-control input-lg priceFormat text-right" style="width:200px"/>
                                    </th> 
                                </tr>
                                <tr>
                                    <th colspan="1"><b class="pull-right">{{labelKembalian}}</b></th> 
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

<script type="text/javascript">
    var Penjualan = new Vue({
        el: "#sectionPenjualan",
        data: {
            listBarang: [],
            totalBayar : 0,
        },
        mounted: function () {
            this.Validation();
        },
        watch: {
            // isNew: function () {
            //     this.action = this.isNew ? "Submit" : "Update";
            //     this.title = this.isNew ? "Add Crew" : "Crew Detail";
            // }
        },
        methods: {
            Init: function (isNew, data) {
                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'admin_v2/penjualan/get_barang2';?>", 
                    success: function(data){  
                        data = eval("("+ data +")") ;
                        data.push({id:"",text:""});
                        $('#select_kode_brg').css({"width":"180px"});
                        var selectOrigin = $('#select_kode_brg').select2();
                        selectOrigin.empty();
                        selectOrigin.select2({
                            placeholder: "",
                            allowclear: true,
                            data: data,
                            width: '100%',
                            dropdownAutoWidth: 'true'
                        });
                        $('#select_kode_brg').val("");
                    }
                });

                
                $("#select_kode_brg").change(function(){
                    Penjualan.Search($(this).val());
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
                    var qty = qty<1 ? 1 : qty;
                    //target.val(qty).change();
                    Penjualan.listBarang[index].barang_qty_input=qty; 
                })
                
            },
            Search: function (kobar) { 
                if(!kobar)
                    false;

                $.ajax({
                    type: "POST",
                    url : "<?php echo base_url().'admin_v2/penjualan/get_barang';?>",
                    data: {"kobar": kobar},
                    success: function(data){
                        data = eval("("+ data +")") ;
                        Penjualan.listBarang.push(data);
                    }
                });
            },
            Post: function () {
                $.ajax({
                    url: kmi.Configuration.serviceUrl + '/api/v1/get_barang',
                    cache: false,
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    data: JSON.stringify(Penjualan.listDetail),
                    method: 'POST',
                    beforeSend: function () {
                        BeforeSendAjaxBehaviour(true);
                    }
                }).done(function (data, textStatus, jqXHR) {
                    AfterSendAjaxBehaviour(true);
                    if (data.errorcode === 0) {
                        kmi.Utility.CreateAlert(".divAlert", "success", "Data saved successfully.");
                    }
                    else {
                        kmi.Utility.CreateAlert(".divAlert", "fail", data.message);
                    }
                    $('#modalCrewDetail').modal('hide');
                    CrewSearch.Search(false);
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    AfterSendAjaxBehaviour(true);
                });
            },
            Put: function () {
            },
            Delete: function () {
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
                    total += item.barang_harjul * item.barang_qty_input;
                 });
                 return total; 
            },
            kembalian: function () { 
                 return this.totalBayar - this.totalHarga; 
            },
            labelKembalian: function () {
                 var kembalian = this.totalBayar - this.totalHarga; 
                 return kembalian<0 ? "Kurang Bayar" : "Kembalian"; 
            }
            // statusCode: function () {
            //     if (this.status === true) {
            //         return listStatus.filter(function (a) { return a.value.toLowerCase() === 'active'; })[0].code;
            //     }
            //     else {
            //         return listStatus.filter(function (a) { return a.value.toLowerCase() === 'inactive'; })[0].code;
            //     }
            // }
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
     