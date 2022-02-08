

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="modalInputUang" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="false">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  
            </div>
            <div class="modal-body">
                <div class="">
                    <table id="tableInputUang" class="w-100">
                    <tr><td colspan="5"><input readonly class="form-control mb-10  input-lg text-right" id="nilaiInput" value=""/></td><tr>
                    <tr>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="1">1</span></td>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="2">2</span></td>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="3">3</span></td>
                        <td><span class="btn btn-danger w-100 glyphicon glyphicon-arrow-left backspace" nilai=""> </span></td>
                        <td><span class="btn btn-danger w-100" nilai="clear">CLEAR</span></td>
                    <tr>
                    <tr>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="4">4</span></td>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="5">5</span></td>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="6">6</span></td>
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="50000">50rb</span></td>
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="100000">100rb</span></td>
                    <tr>
                    <tr>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="7">7</span></td>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="8">8</span></td>
                        <td><span class="btn btn-warning w-100 bilangan-asli" nilai="9">9</span></td>
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="150000">150rb</span></td>
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="200000">200rb</span></td>
                    <tr>
                    <tr>
                        <td colspan="1"><span class="btn btn-warning w-100 bilangan-asli" nilai="0">0</span></td>  
                        <td colspan="2"><span class="btn btn-warning w-100 bilangan-asli" nilai="000">000</span></td> 
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="250000">250rb</span></td>
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="500000">500rb</span></td>
                    <tr>
                    <tr>
                        <td colspan="3"><span class="btn btn-success w-100" nilai="selesai">Selesai</span></td>  
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="750000">750rb</span></td>
                        <td><span class="btn btn-default w-100 bilangan-besar" nilai="1000000">1jt</span></td>
                    <tr>
                    </table> 
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button> 
            </div>
            </div>
            </div>
        </div>

<script> 
    $(document).ready(function(){
       
       var tableInputUang = $('#tableInputUang');
       var isUsingBilanganBesar = false;
       var callbackInputUang;

       tableInputUang.find(".bilangan-asli").click(function(){
            if(isUsingBilanganBesar)
                $("#nilaiInput").val("");

            var nilaiInput = $("#nilaiInput").val();
            nilaiInput = nilaiInput != "undefined" ? nilaiInput : "";
            nilaiInput = nilaiInput.toString() + $(this).attr("nilai");
            nilaiInput = helper.numberWithThousandSeparator(helper.convertToInt(nilaiInput) );
            $("#nilaiInput").val(nilaiInput);
            isUsingBilanganBesar = false;
       });
       tableInputUang.find(".backspace").click(function(){  
            var nilaiInput = $("#nilaiInput").val();
            nilaiInput = nilaiInput != "undefined" ? nilaiInput.substr(0,nilaiInput.length-1) : ""; 
            nilaiInput = helper.numberWithThousandSeparator(helper.convertToInt(nilaiInput) );
            $("#nilaiInput").val(nilaiInput); 
       });
       
       tableInputUang.find("[nilai=clear]").click(function(){
            $("#nilaiInput").val("");
       });

       tableInputUang.find("[nilai=selesai]").click(function(){
            var nilaiInput = helper.convertToInt($("#nilaiInput").val());
            //kirim todo
            callbackInputUang(nilaiInput);
            $("#nilaiInput").val("");
            $("#modalInputUang").modal("hide")
       });

       tableInputUang.find(".bilangan-besar").click(function(){ 
            $("#nilaiInput").val("");
            var nilaiInput = $(this).attr("nilai");
            nilaiInput = helper.numberWithThousandSeparator(helper.convertToInt(nilaiInput) );
            $("#nilaiInput").val(nilaiInput);
            //kirim todo
            isUsingBilanganBesar = true;
       });

       tableInputUang.find("td").css({ "padding": "4px"});

       helper.showModalInputUang = function(callback){
            $("#modalInputUang").modal("show")
            callbackInputUang =callback;
       }
    });
</script>  