<div class="entry-list">
<h3> Pencairan </h3>
<div class="content"><?php echo $data;?></div>
 
</div>
<script>
function dosearchpencairan(xAwal){ 
   
  $(document).ready(function(){ 
  $.ajax({ 
          url: "<?php echo base_url();?>index.php/ctrmypencairan/searchpencairan/", 
          data: "xAwal="+xAwal+"&xSearch="+ $("#edNIK").val()+"&xtglmulai="+$('#edtglmulai').val()+"&xtglakhir="+$('#edtglakhir').val(), 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatapencairan").html(json.tabledatapencairan); 
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 
 dosearchpencairan(0);
 function dodetailkomisi() {
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo base_url();?>index.php/ctrmypencairan/detailkomisi/",
            data: "edNIK=" + $('#edNIK').val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#edidx").val(json.idx);
                $("#edNIK").val(json.NIK);
                $("#edpulsa").val(json.pulsa);
                $("#edonline").val(json.online);
                $("#edutilitas").val(json.utilitas);
                $("#edasuransi").val(json.asuransi);
                $("#edtourtravel").val(json.tourtravel);
                $("#edbonusdeposit").val(json.bonusdeposit);
                $("#edtotalkomisi").val(json.totalkomisi);
                $("#eddicairkan").val(json.dicairkan);
                $("#edtotal").val(json.total);
                $("#edremit").val(json.remit);
                $("#edtanggal").val(json.tanggal);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
} 
dodetailkomisi();
function dosimpanpencairan() {
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo base_url();?>index.php/ctrmypencairan/simpanpencairan/",
            data: "edidx=" + $("#edidx").val() + "&edNIK=" + $("#edNIK").val() + "&edpulsa=" + $("#edpulsa").val() + "&edonline=" + $("#edonline").val() + "&edutilitas=" + $("#edutilitas").val() + "&edasuransi=" + $("#edasuransi").val() + "&edtourtravel=" + $("#edtourtravel").val() + "&edbonusdeposit=" + $("#edbonusdeposit").val() + "&edtotal=" + $("#edtotal").val() + "&edremit=" + $("#edremit").val() + "&edtanggal=" + $("#edtanggal").val()+"&edtotalkomisi="+$("#edtotalkomisi").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (msg) {
                dosearchpencairan('-99');
                alert("Data Berhasil Disimpan.... ");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });

}

</script>