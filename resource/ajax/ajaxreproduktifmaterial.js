  function dosearchreproduktifmaterial(xAwal){ 
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
          url: getBaseURL()+"index.php/ctrreproduktifmaterial/searchreproduktifmaterial/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatareproduktifmaterial").html(json.tabledatareproduktifmaterial); 
		    $("#edSearch").val(xSearch);
                    $("#edHalaman").html(json.halaman);
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doeditreproduktifmaterial(edidx){ 
 $(document).ready(function(){ 
	 formshow();
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrreproduktifmaterial/editrecreproduktifmaterial/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edidmember").val(json.idmember);
$("#edidjenisalatkerja").val(json.idjenisalatkerja);
$("#edalatkerja").val(json.alatkerja);
$("#edpenyedia").val(json.penyedia);
$("#edharga").val(json.harga);
$("#eddurability").val(json.durability);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doClearreproduktifmaterial(){ 
 $(document).ready(function(){ 
	 formshow();
 $("#edidx").val("0"); 
 $("#edidmember").val(""); 
$("#edidjenisalatkerja").val(""); 
$("#edalatkerja").val(""); 
$("#edpenyedia").val(""); 
$("#edharga").val(""); 
$("#eddurability").val(""); 
 
  }); 
 } 
 
function dosimpanreproduktifmaterial(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrreproduktifmaterial/simpanreproduktifmaterial/", 
   data: "edidx="+$("#edidx").val()+"&edidmember="+$("#edidmember").val()+"&edidjenisalatkerja="+$("#edidjenisalatkerja").val()+"&edalatkerja="+$("#edalatkerja").val()+"&edpenyedia="+$("#edpenyedia").val()+"&edharga="+$("#edharga").val()+"&eddurability="+$("#eddurability").val(), 
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
                     doClearreproduktifmaterial(); 
                     dosearchreproduktifmaterial('-99'); 
					 toastr.clear();
                       toastr.success('Data berhasil disimpan'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapusreproduktifmaterial(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrreproduktifmaterial/deletetablereproduktifmaterial/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
				 success: function(json){ 
                    doClearreproduktifmaterial(); 
                    dosearchreproduktifmaterial('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchreproduktifmaterial(0); 
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
  