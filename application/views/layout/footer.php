
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
    <script> 
     
    var helper = {};
    helper.dataToko = {
        namaTokoKode : "KD001",
        alamatTokoKode : "KD002",
        hpTokoKode : "KD003", 
    }
    helper.convertToInt = function (myStr){ 
        myStr = myStr.toString();
        return parseInt(myStr.replaceAll('.', ''));
    }
        $(function(){
            BeforeSendAjaxBehaviour = () =>{
                $(".info-error,info-warning,.info-success").text("");
            }
                // $('.priceFormat').priceFormat({
                //         prefix: '',
                //         //centsSeparator: '',
                //         centsLimit: 0,
                //         thousandsSeparator: ','
                // });
        
                // $('#jml_uang').on("input",function(){
                //     var total=$('#total').val();
                //     var jumuang=$('#jml_uang').val();
                //     var hsl=jumuang.replace(/[^\d]/g,"");
                //     $('#jml_uang2').val(hsl);
                //     $('#kembalian').val(hsl-total);
                // })

                // $(document).on("input","#jml_uang",function(){
                //     var total=$('#total').val();
                //     var jumuang=$('#jml_uang').val();
                //     var hsl=jumuang.replace(/[^\d]/g,"");
                //     $('#jml_uang2').val(hsl);
                //     $('#kembalian').val(hsl-total);
                // })

         }); 
    
    </script>

    </body>

</html>