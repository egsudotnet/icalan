<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Produk By egsudotnet">
    <meta name="author" content="egsudotnet">

    <title>Transaksi Penjualan</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url().'assets/css/bootstrap.min.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/style.css'?>" rel="stylesheet">
	<link href="<?php echo base_url().'assets/css/font-awesome.css'?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url().'assets/css/4-col-portfolio.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/dataTables.bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet">
    <link href="<?php echo base_url().'assets/dist/css/bootstrap-select.css'?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-datetimepicker.min.css'?>">
	<link href="<?php echo base_url().'assets/css/select2.css'?>" rel="stylesheet">
</head>

<body>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin_v2/menu');
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
                                        <select name="select_kode_brg" id="select_kode_brg" class="form-control"> 
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
                                <th colspan="3">Qty<th>
                                <th>Total</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="row in listBarang">
                                    <td>{{row.barang_nama}}</td>
                                    <td>{{row.satuan}}</td>
                                    <td>{{row.barang_harjul}}</td>
                                    <td>{{row.barang_harjul}}</td>
                                    <td>{{row.barang_harjul}}</td>
                                    <td>{{row.barang_harjul}}</td>
                                    <td>{{row.barang_harjul}}</td>
                                </tr>
                            <tbody>
                        </table>
                </div>
            </div>

        </div>
    </section>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/select2.js'?>"></script> 
    <script src="<?php echo base_url().'assets/js/vue.js'?>"></script> 

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/dist/js/bootstrap-select.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/dataTables.bootstrap.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/jquery.price_format.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/moment.js'?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'?>"></script>
    <script type="text/javascript">
        $(function(){
            $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('#jml_uang2').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
            });
            $('#kembalian').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('#jml_uang').on("input",function(){
                var total=$('#total').val();
                var jumuang=$('#jml_uang').val();
                var hsl=jumuang.replace(/[^\d]/g,"");
                $('#jml_uang2').val(hsl);
                $('#kembalian').val(hsl-total);
            })
        });
    </script> 
    <script type="text/javascript">
        
        var Penjualan = new Vue({
            el: "#sectionPenjualan",
            data: {
                listBarang: []
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
                // statusCode: function () {
                //     if (this.status === true) {
                //         return listStatus.filter(function (a) { return a.value.toLowerCase() === 'active'; })[0].code;
                //     }
                //     else {
                //         return listStatus.filter(function (a) { return a.value.toLowerCase() === 'inactive'; })[0].code;
                //     }
                // }
            }
        });

        $(document).ready(function(){
            Penjualan.Init();
        });
    </script>
    
    
</body>

</html>
