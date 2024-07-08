  function dosearchtestimoni_photos(xAwal){ 
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
          url: getBaseURL()+"index.php/ctrtestimoni_photos/searchtestimoni_photos/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatatestimoni_photos").html(json.tabledatatestimoni_photos); 
		    $("#edSearch").val(xSearch);
                    $("#edHalaman").html(json.halaman);
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doedittestimoni_photos(edidx){ 
 $(document).ready(function(){ 
	 formshow();
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrtestimoni_photos/editrectestimoni_photos/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edtestimoni_id").val(json.testimoni_id);
$("#edlink_photo").val(json.link_photo);
$("#edcreated_at").val(json.created_at);
$("#edupdated_at").val(json.updated_at);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doCleartestimoni_photos(){ 
 $(document).ready(function(){ 
	 formshow();
 $("#edidx").val("0"); 
 $("#edtestimoni_id").val(""); 
$("#edlink_photo").val(""); 
$("#edcreated_at").val(""); 
$("#edupdated_at").val(""); 
 
  }); 
 } 
 
function dosimpantestimoni_photos(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrtestimoni_photos/simpantestimoni_photos/", 
   data: "edidx="+$("#edidx").val()+"&edtestimoni_id="+$("#edtestimoni_id").val()+"&edlink_photo="+$("#edlink_photo").val()+"&edcreated_at="+$("#edcreated_at").val()+"&edupdated_at="+$("#edupdated_at").val(), 
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
                     doCleartestimoni_photos(); 
                     dosearchtestimoni_photos('-99'); 
					 toastr.clear();
                       toastr.success('Data berhasil disimpan'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapustestimoni_photos(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrtestimoni_photos/deletetabletestimoni_photos/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
				 success: function(json){ 
                    doCleartestimoni_photos(); 
                    dosearchtestimoni_photos('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchtestimoni_photos(0); 
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
  