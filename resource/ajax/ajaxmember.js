  function dosearchmember(xAwal){ 
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
          url: getBaseURL()+"index.php/ctrmember/searchmember/", 
          data: "xAwal="+xAwal+"&xSearch="+xSearch, 
          cache: false, 
          dataType: 'json', 
          type: 'POST', 
       success: function(json){ 
           $("#tabledatamember").html(json.tabledatamember); 
		    $("#edSearch").val(xSearch);
                    $("#edHalaman").html(json.halaman);
          }, 
        error: function (xmlHttpRequest, textStatus, errorThrown) { 
              alert("Error juga"+xmlHttpRequest.responseText);  
         } 
         }); 
       }); 
 } 

    
 function doeditmember(edidx){ 
 $(document).ready(function(){ 
	 formshow();
 $.ajax({ 
    url: getBaseURL()+"index.php/ctrmember/editrecmember/", 
   data: "edidx="+edidx, 
  cache: false, 
 dataType: 'json', 
     type: 'POST', 
  success: function(json){ 
       $("#edidx").val(json.idx); 
       $("#ednama").val(json.nama);
$("#edemail").val(json.email);
$("#edgender").val(json.gender);
$("#ednilaiupah").val(json.nilaiupah);
$("#edidsubsektor").val(json.idsubsektor);
$("#edsubsektorname").val(json.subsektorname);
$("#edjenisprofesi").val(json.jenisprofesi);
$("#edidpendidikan").val(json.idpendidikan);
$("#ednamapendidikan").val(json.namapendidikan);
$("#edidprovinsi").val(json.idprovinsi);
$("#edidkabupaten").val(json.idkabupaten);
$("#edtanggungan").val(json.tanggungan);
$("#edtanggunganpasangan").val(json.tanggunganpasangan);
$("#edtanggungananak1").val(json.tanggungananak1);
$("#edtanggungananak2").val(json.tanggungananak2);
$("#edtanggungananak3").val(json.tanggungananak3);
$("#edtanggungananak4").val(json.tanggungananak4);
$("#edtanggungansaudara").val(json.tanggungansaudara);
$("#edtanggungankeluarga").val(json.tanggungankeluarga);
$("#edisanggotaserikatpekerja").val(json.isanggotaserikatpekerja);
$("#ednamaserikat").val(json.namaserikat);
$("#edformuniqueid").val(json.formuniqueid);

     }, 
 error: function (xmlHttpRequest, textStatus, errorThrown) { 
 alert("Error juga "+xmlHttpRequest.responseText); 
 } 
 }); 
 }); 
 } 
    
function doClearmember(){ 
 $(document).ready(function(){ 
	 formshow();
 $("#edidx").val("0"); 
 $("#ednama").val(""); 
$("#edemail").val(""); 
$("#edgender").val(""); 
$("#ednilaiupah").val(""); 
$("#edidsubsektor").val(""); 
$("#edsubsektorname").val(""); 
$("#edjenisprofesi").val(""); 
$("#edidpendidikan").val(""); 
$("#ednamapendidikan").val(""); 
$("#edidprovinsi").val(""); 
$("#edidkabupaten").val(""); 
$("#edtanggungan").val(""); 
$("#edtanggunganpasangan").val(""); 
$("#edtanggungananak1").val(""); 
$("#edtanggungananak2").val(""); 
$("#edtanggungananak3").val(""); 
$("#edtanggungananak4").val(""); 
$("#edtanggungansaudara").val(""); 
$("#edtanggungankeluarga").val(""); 
$("#edisanggotaserikatpekerja").val(""); 
$("#ednamaserikat").val(""); 
$("#edformuniqueid").val(""); 
 
  }); 
 } 
 
function dosimpanmember(){ 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrmember/simpanmember/", 
   data: "edidx="+$("#edidx").val()+"&ednama="+$("#ednama").val()+"&edemail="+$("#edemail").val()+"&edgender="+$("#edgender").val()+"&ednilaiupah="+$("#ednilaiupah").val()+"&edidsubsektor="+$("#edidsubsektor").val()+"&edsubsektorname="+$("#edsubsektorname").val()+"&edjenisprofesi="+$("#edjenisprofesi").val()+"&edidpendidikan="+$("#edidpendidikan").val()+"&ednamapendidikan="+$("#ednamapendidikan").val()+"&edidprovinsi="+$("#edidprovinsi").val()+"&edidkabupaten="+$("#edidkabupaten").val()+"&edtanggungan="+$("#edtanggungan").val()+"&edtanggunganpasangan="+$("#edtanggunganpasangan").val()+"&edtanggungananak1="+$("#edtanggungananak1").val()+"&edtanggungananak2="+$("#edtanggungananak2").val()+"&edtanggungananak3="+$("#edtanggungananak3").val()+"&edtanggungananak4="+$("#edtanggungananak4").val()+"&edtanggungansaudara="+$("#edtanggungansaudara").val()+"&edtanggungankeluarga="+$("#edtanggungankeluarga").val()+"&edisanggotaserikatpekerja="+$("#edisanggotaserikatpekerja").val()+"&ednamaserikat="+$("#ednamaserikat").val()+"&edformuniqueid="+$("#edformuniqueid").val(), 
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
                     doClearmember(); 
                     dosearchmember('-99'); 
					 toastr.clear();
                       toastr.success('Data berhasil disimpan'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
         } 
  
function dohapusmember(edidx){ 
         if (confirm("Anda yakin Akan menghapus data ?")) 
     { 
         $(document).ready(function(){ 
           $.ajax({ 
                 url: getBaseURL()+"index.php/ctrmember/deletetablemember/", 
                 data: "edidx="+edidx, 
                 cache: false, 
                 dataType: 'json', 
                 type: 'POST', 
				 success: function(json){ 
                    doClearmember(); 
                    dosearchmember('-99'); 
                 }, 
               error: function (xmlHttpRequest, textStatus, errorThrown) { 
                         alert("Error juga "+xmlHttpRequest.responseText); 
               } 
           }); 
         }); 
        } 
        } 


     dosearchmember(0); 
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

  