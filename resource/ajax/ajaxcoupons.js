  function dosearchcoupons(xAwal){ 
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
          url: getBaseURL()+"index.php/ctrcoupons/searchcoupons/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatacoupons").html(json.tabledatacoupons); 
		    $("#edSearch").val(xSearch);
                    $("#edHalaman").html(json.halaman);
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doeditcoupons(edidx){ 
 $(document).ready(function(){ 
	 formshow();
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrcoupons/editreccoupons/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#ededition_id").val(json.edition_id);
$("#edcoupon_number").val(json.coupon_number);
$("#edqr_code").val(json.qr_code);
$("#edcoupon_price").val(json.coupon_price);
$("#edshipper_price").val(json.shipper_price);
$("#edtotal_price").val(json.total_price);
$("#edis_winner").val(json.is_winner);
$("#edpayment_status_id").val(json.payment_status_id);
$("#edpayment_confirm_receipt").val(json.payment_confirm_receipt);
$("#edvalid_until").val(json.valid_until);
$("#edregistration_id").val(json.registration_id);
$("#edmember_name").val(json.member_name);
$("#edpayment_unique_id").val(json.payment_unique_id);
$("#edcreated_at").val(json.created_at);
$("#edupdated_at").val(json.updated_at);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doClearcoupons(){ 
 $(document).ready(function(){ 
	 formshow();
 $("#edidx").val("0"); 
 $("#ededition_id").val(""); 
$("#edcoupon_number").val(""); 
$("#edqr_code").val(""); 
$("#edcoupon_price").val(""); 
$("#edshipper_price").val(""); 
$("#edtotal_price").val(""); 
$("#edis_winner").val(""); 
$("#edpayment_status_id").val(""); 
$("#edpayment_confirm_receipt").val(""); 
$("#edvalid_until").val(""); 
$("#edregistration_id").val(""); 
$("#edmember_name").val(""); 
$("#edpayment_unique_id").val(""); 
$("#edcreated_at").val(""); 
$("#edupdated_at").val(""); 
 
  }); 
 } 
 
function dosimpancoupons(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrcoupons/simpancoupons/", 
   data: "edidx="+$("#edidx").val()+"&ededition_id="+$("#ededition_id").val()+"&edcoupon_number="+$("#edcoupon_number").val()+"&edqr_code="+$("#edqr_code").val()+"&edcoupon_price="+$("#edcoupon_price").val()+"&edshipper_price="+$("#edshipper_price").val()+"&edtotal_price="+$("#edtotal_price").val()+"&edis_winner="+$("#edis_winner").val()+"&edpayment_status_id="+$("#edpayment_status_id").val()+"&edpayment_confirm_receipt="+$("#edpayment_confirm_receipt").val()+"&edvalid_until="+$("#edvalid_until").val()+"&edregistration_id="+$("#edregistration_id").val()+"&edmember_name="+$("#edmember_name").val()+"&edpayment_unique_id="+$("#edpayment_unique_id").val()+"&edcreated_at="+$("#edcreated_at").val()+"&edupdated_at="+$("#edupdated_at").val(), 
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
                     doClearcoupons(); 
                     dosearchcoupons('-99'); 
					 toastr.clear();
                       toastr.success('Data berhasil disimpan'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapuscoupons(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrcoupons/deletetablecoupons/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
				 success: function(json){ 
                    doClearcoupons(); 
                    dosearchcoupons('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchcoupons(0); 
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
  