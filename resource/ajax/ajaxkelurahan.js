  function dosearchkelurahan(xAwal){ 
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
          url: getBaseURL()+"index.php/ctrkelurahan/searchkelurahan/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatakelurahan").html(json.tabledatakelurahan); 
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doeditkelurahan(edidx){ 
 $(document).ready(function(){ 
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrkelurahan/editreckelurahan/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#edkode_kelurahan").val(json.kode_kelurahan);
$("#edidkecamatan").val(json.idkecamatan);
$("#edkelurahan").val(json.kelurahan);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doClearkelurahan(){ 
 $(document).ready(function(){ 
 $("#edidx").val("0"); 
 $("#edkode_kelurahan").val(""); 
$("#edidkecamatan").val(""); 
$("#edkelurahan").val(""); 
 
  }); 
 } 
 
function dosimpankelurahan(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrkelurahan/simpankelurahan/", 
   data: "edidx="+$("#edidx").val()+"&edkode_kelurahan="+$("#edkode_kelurahan").val()+"&edidkecamatan="+$("#edidkecamatan").val()+"&edkelurahan="+$("#edkelurahan").val(), 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(msg){ 
                     doClearkelurahan(); 
                     dosearchkelurahan('-99'); 
                         alert("Data Berhasil Disimpan.... "); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapuskelurahan(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrkelurahan/deletetablekelurahan/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
                 success: function(json){ 
                    doClearkelurahan(); 
                    dosearchkelurahan('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchkelurahan(0); 

  function provinsiselect() {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkabupaten/kabupatenbyprovinsi/",
            data: "edidprovinsi=" + $('#edidprovinsi').val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#kabupaten").html(json.combokabupaten);
                $("#kota").html(json.combokota);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}
function kabupatenselect() {
//      alert($('#edidkabupaten').val());
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkecamatan/kecamatanbykabupaten/",
            data: "edidkabupaten=" + $('#edidkabupaten').val() + "&edidprovinsi=" + $('#edidprovinsi').val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#kecamatan").html(json.combokecamatan);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}
