<?php 
    $this->load->view('layout/header');
?> 
    <!-- Page Content -->
    <section id="sectionMainVue">
    <div class="container">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Data
                    <small>Laporan</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Projects Row -->
        <div class="row">
            <div class="col-lg-12">
            <table class="table table-bordered table-condensed" style="font-size:12px;" id="mydata">
                <thead>
                    <tr>
                        <th style="text-align:center;width:40px;">No</th>
                        <th>Laporan</th>
                        <th style="width:100px;text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                
                    <tr>
                        <td style="text-align:center;vertical-align:middle">1</td>
                        <td style="vertical-align:middle;" colspan="2">Laporan Data Barang</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/laporan/lap_data_barang'?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">2</td>
                        <td style="vertical-align:middle;" colspan="2">Laporan Stok Barang</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/laporan/lap_stok_barang'?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">3</td>
                        <td style="vertical-align:middle;" rowspan="4">Laporan Penjualan</td>
                        <td style="vertical-align:middle;">Semua</td>
                        <td style="text-align:center;">
                            <!-- <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/laporan/lap_data_penjualan'?>" target="_blank"><span class="fa fa-print"></span> Print</a> -->
                            <a class="btn btn-sm btn-default" href="#lap_jual_semua" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">4</td> 
                        <td style="vertical-align:middle;">Per Tanggal</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">5</td> 
                        <td style="vertical-align:middle;">Per Bulan</td> 
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">6</td>  
                        <td style="vertical-align:middle;">Per Tahun</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_jual_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    
                    <tr>
                        <td style="text-align:center;vertical-align:middle">7</td>
                        <td style="vertical-align:middle;" rowspan="4">Laporan Laba/Rugi</td>
                        <td style="vertical-align:middle;">Semua</td>
                        <td style="text-align:center;">
                            <!-- <a class="btn btn-sm btn-default" href="<?php echo base_url().'admin/laporan/lap_laba_rugi'?>" target="_blank"><span class="fa fa-print"></span> Print</a> -->
                            <a class="btn btn-sm btn-default" href="#lap_laba_rugi_semua" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;vertical-align:middle">8</td> 
                        <td style="vertical-align:middle;">Per Tanggal</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_laba_rugi_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">9</td>  
                        <td style="vertical-align:middle;">Per Bulan</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_laba_rugi_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align:center;vertical-align:middle">10</td>  
                        <td style="vertical-align:middle;">Per Tahun</td>
                        <td style="text-align:center;">
                            <a class="btn btn-sm btn-default" href="#lap_laba_rugi_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                        </td>
                    </tr> 
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_semua" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Penjualan</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi'?>" target="_blank">
                <div class="modal-body"> 

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Penjualan</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_pertanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Dari Tanggal</label>
                        <div class="col-xs-9"> 
                            <input type='date' name="tanggalFrom" class="form-control" value="" placeholder="Tanggal..." required/> 
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Sampai Tanggal</label>
                        <div class="col-xs-9"> 
                            <input type='date' name="tanggalTo" class="form-control" value="" placeholder="Tanggal..." required/> 
                        </div> 
                    </div>   

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Penjualan</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_perbulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Penjualan</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_pertahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tahun</label>
                        <div class="col-xs-9">
                                <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                                <?php foreach ($jual_thn->result_array() as $t) {
                                    $thn=$t['tahun'];
                                ?>
                                    <option><?php echo $thn;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>

<!-- 
        ====================== --> 
        <!-- /.row -->
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi_semua" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Laba/Rugi</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi'?>" target="_blank">
                <div class="modal-body"> 

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Laba/Rugi</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi_pertanggal'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Dari Tanggal</label>
                        <div class="col-xs-9"> 
                            <input type='date' name="tanggalFrom" class="form-control" value="" placeholder="Tanggal..." required/> 
                        </div> 
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Sampai Tanggal</label>
                        <div class="col-xs-9"> 
                            <input type='date' name="tanggalTo" class="form-control" value="" placeholder="Tanggal..." required/> 
                        </div> 
                    </div> 
                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
         <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Laba/Rugi</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi_perbulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_laba_rugi_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Laba/Rugi</h4>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi_pertahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tahun</label>
                        <div class="col-xs-9">
                                <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                                <?php foreach ($jual_thn->result_array() as $t) {
                                    $thn=$t['tahun'];
                                ?>
                                    <option><?php echo $thn;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
                    <button class="btn btn-info"><span class="fa fa-print"></span> Cetak</button>
                </div>
            </form>
            </div>
            </div>
        </div>
        <!--END MODAL-->
        
        </section>
        <hr>
 
    </div>
    <!-- /.container -->
 
<!-- footer -->
<?php 
    $this->load->view('layout/footer');
?> 

<script type="text/javascript">
        
    var mainVue = new Vue({
            el: "#sectionMainVue",
            data: { 
            },
            mounted: function () {  
            },
            watch: { 
            },
            methods: {
                Init: function () {   
                    $(document).on("click","[href^='#lap_']",function(){ 
                        var modalId = $(this).attr("href");
                        var typeFilter = modalId.replace("#lap_laba_rugi_","").replace("#lap_jual_","");
                        if(typeFilter=="semua"){ 
                        } else if(typeFilter=="pertanggal"){ 
                            var currentValue = moment().format("YYYY-MM-DD");
                            $(modalId + " input").val(currentValue);  
                        } else if(typeFilter=="perbulan"){
                            var currentValue = moment().format("MMMM YYYY").toLowerCase();
                            var target = $.grep($(modalId + " span"), function(n,i){
                                return $(n).text().toLowerCase() == currentValue;
                            });
                            if(target.length>0){
                                $(target).click();
                            }  
                        } else if(typeFilter=="pertahun"){
                            var currentValue = moment().format("YYYY").toLowerCase();
                            var target = $.grep($(modalId + " span"), function(n,i){
                                return $(n).text().toLowerCase() == currentValue;
                            });
                            if(target.length>0){
                                $(target).click();
                            }  
                        }                    

                        mainVue.GetSummary($(this), modalId);
                    })   
                    $(document).on("change","[id^='lap_'] input",function(){ 
                        var id = $(this).closest(".modal").attr("id");
                        mainVue.GetSummary("", ("#" + id));
                    })  
                    $(document).on("change","[id^='lap_'] select",function(){ 
                        var id = $(this).closest(".modal").attr("id");
                        mainVue.GetSummary("", ("#" + id));
                    })  

                },
                GetSummary: function (element, modalId) {  
                    var typeFilter = modalId.replace("#lap_laba_rugi_","").replace("#lap_jual_","");
                    if(typeFilter=="semua"){
                        mainVue.Search({modalId : modalId, type:"2"});
                    } else if(typeFilter=="pertanggal"){ 
                        mainVue.Search({modalId : modalId, type:"0", tanggalFrom : $(modalId + " [name=tanggalFrom]").val(), tanggalTo : $(modalId + " [name=tanggalTo]").val()});
                    } else if(typeFilter=="perbulan"){ 
                        mainVue.Search({modalId : modalId, type:"0", bulan : $(modalId + " [name=bln]").val()});
                    } else if(typeFilter=="pertahun"){ 
                        mainVue.Search({modalId : modalId, type:"1", tahun : $(modalId + " [name=thn]").val()});
                    }                    
                }, 
                Search: function (param) {   


                    var data = param;
                    var modalId = param.modalId; 
                    var type = param.type; 
                    param.jenisLaporan =  (modalId.toLowerCase().indexOf("jual") >= 0) ? "0" : "1"; 


                    var namaKolomTanggal = "";
                    if(type=="0"){
                        namaKolomTanggal = "Tanggal";
                    }else if(type=="1"){
                        namaKolomTanggal = "Bulan";
                    }else if(type=="2"){
                        namaKolomTanggal = "Tahun";
                    }

                    $.ajax({
                        url: '<?php echo base_url().'admin/laporan/getSummary';?>',
                        cache: false,
                        dataType: 'json', 
                        data: data,
                        method: 'POST',
                        beforeSend: function () {  
                            // BeforeSendAjaxBehaviour();
                            $(modalId + " .modal-body").addClass('panel-loading'); 
                            $(modalId + " .modal-body table").remove(); 
                        }
                    }).done(function (data, textStatus, jqXHR) {
                        if(data){ 
                            $(modalId + " .modal-body table").remove(); 
                            var html = ""; 
                            var total = 0;
                            $.each(data,function(index,item){
                                html +=  "<tr><td class=''>"+ item.tanggal +"</td><td class='text-right priceFormat'>"+ item.nominal +"</td></tr>";
                                total += parseInt(item.nominal);
                            });
                            html +=  "<tr><td class='text-right'><b>Total Rp.</b></td><td class='text-right priceFormat'><b>"+ total +"</b></td></tr>";
                            html = "<table class='table table-bordered'><tr><th>" + namaKolomTanggal + "</th><th>Nominal</th></tr>"+ html +"</table>";

                            $(modalId + " .modal-body").append(html);
                            $(modalId).modal("show");
                            helper.updatePriceFormat()
                        }else{ 
                            $(".info-error").text("Tidak ada data.");
                        }
                    }).fail(function (jqXHR, textStatus, errorThrown) { 
                        $(".info-error").text(textStatus);
                    }).complete(function(){ 
                        $(modalId + " .modal-body").removeClass('panel-loading'); 
                    });
                },
                Post: function () {  
                }, 
                Delete: function () { 
                },
                ClearData: function(){ 
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
                // totalHarga: function () {
                //     var total = 0;
                //     $.each(this.listUtang,function(index,item){
                //         total +=  helper.convertToInt(item.barang_harpok) *  helper.convertToInt(item.barang_qty_input);
                //     });
                //     return total; 
                // },
                // kembalian: function () { 
                //     return helper.convertToInt(this.totalBayar) - helper.convertToInt(this.totalHarga); 
                // },
                // labelKembalian: function () {
                //     var kembalian = helper.convertToInt(this.totalBayar) - helper.convertToInt(this.totalHarga); 
                //     return kembalian<0 ? "Kurang Bayar" : "Kembalian"; 
                // }
            },
            updated: function () {
                helper.updatePriceFormat()
                //helper.updateDateFormat() 
            }
        });

    $(document).ready(function() { 
        mainVue.Init();
    } );
</script>
    