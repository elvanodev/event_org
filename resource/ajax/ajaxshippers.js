  function dosearchshippers(xAwal){ 
   xSearch =""; 
    try 
        {             if ($("#edSearch").val()!=""){ 
              xSearch = $("#edSearch").val();
        } 
         }catch(err){ 
          xSearch =""; 
         } 
   if (typeof(xSearch) =="undefined"){ 
     xSearch =""; 
    } 
  $(document).ready(function(){ 
	  formhide();
  $.ajax({ 
          url: getBaseURL()+"index.php/ctrshippers/searchshippers/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatashippers").html(json.tabledatashippers); 
		    $("#edSearch").val(xSearch);
                    $("#edHalaman").html(json.halaman);
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doeditshippers(edidx){ 
 $(document).ready(function(){ 
	 formshow();
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrshippers/editrecshippers/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edname").val(json.name);
$("#edshipper_price").val(json.shipper_price);
$("#edcreated_at").val(json.created_at);
$("#edupdated_at").val(json.updated_at);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doClearshippers(){ 
 $(document).ready(function(){ 
	 formshow();
 $("#edidx").val("0"); 
 $("#edname").val(""); 
$("#edshipper_price").val(""); 
$("#edcreated_at").val(""); 
$("#edupdated_at").val(""); 
 
  }); 
 } 
 
function dosimpanshippers(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrshippers/simpanshippers/", 
   data: "edidx="+$("#edidx").val()+"&edname="+$("#edname").val()+"&edshipper_price="+$("#edshipper_price").val()+"&edcreated_at="+$("#edcreated_at").val()+"&edupdated_at="+$("#edupdated_at").val(), 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                  beforeSend: function (msg) {
                toastr.info('Loding.....', '', {
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "onclick": null
                });
            },
			success: function(msg){ 
                     doClearshippers(); 
                     dosearchshippers('-99'); 
					 toastr.clear();
                       toastr.success('Data berhasil disimpan'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapusshippers(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrshippers/deletetableshippers/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
				 success: function(json){ 
                    doClearshippers(); 
                    dosearchshippers('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchshippers(0); 
function queryParams() {
    return {
        type: 'owner',
        sort: 'idx',
        direction: 'desc',
        per_page: 1000,
        page: 1
    };
}
function formshow(){
    $(document).ready(function() {
        $("#form").show();
    })
}
function formhide(){
$(document).ready(function() {
    $("#form").hide();
})
}
  