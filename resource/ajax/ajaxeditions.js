  function dosearcheditions(xAwal){ 
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
          url: getBaseURL()+"index.php/ctreditions/searcheditions/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledataeditions").html(json.tabledataeditions); 
		    $("#edSearch").val(xSearch);
                    $("#edHalaman").html(json.halaman);
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doediteditions(edidx){ 
 $(document).ready(function(){ 
	 formshow();
 $.ajax({ 
    url: getBaseURL()+"index.php/ctreditions/editreceditions/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edevent_id").val(json.event_id);
$("#edname").val(json.name);
$("#edstarted_at").val(json.started_at);
$("#edended_at").val(json.ended_at);
$("#edvenue_address").val(json.venue_address);
$("#edvenue_city").val(json.venue_city);
$("#eddescriptions").val(json.descriptions);
$("#edquota").val(json.quota);
$("#edcoupon_price").val(json.coupon_price);
$("#edcreated_at").val(json.created_at);
$("#edupdated_at").val(json.updated_at);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doCleareditions(){ 
 $(document).ready(function(){ 
	 formshow();
 $("#edidx").val("0"); 
 $("#edevent_id").val(""); 
$("#edname").val(""); 
$("#edstarted_at").val(""); 
$("#edended_at").val(""); 
$("#edvenue_address").val(""); 
$("#edvenue_city").val(""); 
$("#eddescriptions").val(""); 
$("#edquota").val(""); 
$("#edcoupon_price").val(""); 
$("#edcreated_at").val(""); 
$("#edupdated_at").val(""); 
 
  }); 
 } 
 
function dosimpaneditions(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctreditions/simpaneditions/", 
   data: "edidx="+$("#edidx").val()+"&edevent_id="+$("#edevent_id").val()+"&edname="+$("#edname").val()+"&edstarted_at="+$("#edstarted_at").val()+"&edended_at="+$("#edended_at").val()+"&edvenue_address="+$("#edvenue_address").val()+"&edvenue_city="+$("#edvenue_city").val()+"&eddescriptions="+$("#eddescriptions").val()+"&edquota="+$("#edquota").val()+"&edcoupon_price="+$("#edcoupon_price").val()+"&edcreated_at="+$("#edcreated_at").val()+"&edupdated_at="+$("#edupdated_at").val(), 
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
                     doCleareditions(); 
                     dosearcheditions('-99'); 
					 toastr.clear();
                       toastr.success('Data berhasil disimpan'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapuseditions(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctreditions/deletetableeditions/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
				 success: function(json){ 
                    doCleareditions(); 
                    dosearcheditions('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearcheditions(0); 
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
  