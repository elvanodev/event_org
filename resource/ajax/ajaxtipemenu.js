   function dosearchtipemenu(xAwal){ 
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
  $.ajax({ 
          url: getBaseURL()+"index.php/ctrtipemenu/searchtipemenu/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatatipemenu").html(json.tabledatatipemenu); 
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
         start = xmlHttpRequest.responseText.search("<title>") + 7; 
          end  = xmlHttpRequest.responseText.search("</title>"); 
       errorMsg = " error on search tipemenu "+xmlHttpRequest.responseText; 
          if (start > 0 && end > 0) 
             alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
          else 
              alert("Error juga"+errorMsg);  
         } 
         }); 
       }); 
 } 

   function doedittipemenu(edidTipeMenu){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrtipemenu/editrectipemenu/", 
   data: "edidTipeMenu="+edidTipeMenu, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidTipeMenu").val(json.idTipeMenu); 
       $("#edNmTipeMenu").val(json.NmTipeMenu); 
     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 start = xmlHttpRequest.responseText.search("<title>") + 7; 
     end = xmlHttpRequest.responseText.search("</title>"); 
 errorMsg = "OnEdit tipemenu "+xmlHttpRequest.responseText; 
 if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
  else 
 alert("Error juga "+errorMsg); 
 } 
 }); 
 }); 
 } 

 function doCleartipemenu(){ 
 $(document).ready(function(){ 
 $("#edidTipeMenu").val("0"); 
 $("#edNmTipeMenu").val(""); 
  }); 
 } 

         function dosimpantipemenu(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrtipemenu/simpantipemenu/", 
   data: "edidTipeMenu="+$("#edidTipeMenu").val()+"&edNmTipeMenu="+$("#edNmTipeMenu").val(), 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(msg){ 
                     doCleartipemenu(); 
                     dosearchtipemenu('-99'); 
                         alert("Data Has Been Saved.... "); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                     start = xmlHttpRequest.responseText.search("<title>") + 7; 
                     end = xmlHttpRequest.responseText.search("</title>"); 
                     errorMsg =  " On Simpan tipemenu "+xmlHttpRequest.responseText; 
                     if (start > 0 && end > 0) 
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
                     else 
                         alert("Error juga "+errorMsg); 
               } 
           }); 
         }); 
         } 

         function dohapustipemenu(edidTipeMenu,edNmTipeMenu){ 
         if (confirm("Anda yakin Akan menghapus data "+edNmTipeMenu+"?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrtipemenu/deletetabletipemenu/", 
                 data: "edidTipeMenu="+edidTipeMenu, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(json){ 
                    doCleartipemenu(); 
                    dosearchtipemenu('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                     start = xmlHttpRequest.responseText.search("<title>") + 7; 
                     end = xmlHttpRequest.responseText.search("</title>"); 
                     errorMsg = " HAPUS tipemenu "+xmlHttpRequest.responseText; 
                     if (start > 0 && end > 0) 
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]"); 
                     else 
                         alert("Error juga "+errorMsg); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchtipemenu(0); 


