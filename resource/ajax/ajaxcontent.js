function dosearchcontent(xAwal){ 
    xSearch ="";
    try 
    {
        if ($("#edSearch").val()!=""){
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
            url: getBaseURL()+"index.php/ctrcontent/searchcontent/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch+"&idmenu="+$("#edidmenu").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#tabledatacontent").html(json.tabledatacontent);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end  = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " error on search content "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)
                    alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga"+errorMsg);
            }
        });
    });
} 
function kosongkanimage(){
    $(document).ready(function(){


       
        $('.previewimage2g').attr({
            src:  "",
            alt: ""
        });

        $('.previewimage2g').attr({
            href: "#",
            
            alt: "",
            title: ""
        });

        $('.previewimage3g').attr({
            src:  "",
            alt: ""
        });

        $('.previewimage3g').attr({
            href: "#",
            
            alt: "",
            title: ""
        });
    });
}

function doeditcontent(edidx){ 
    $(document).ready(function(){
        //alert(edidx);
        $.ajax({
            url: getBaseURL()+"index.php/ctrcontent/editreccontent/",
            data: "edidx="+edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            async:false,
            success: function(json){
                $("#edidx").val(json.idx);
                $("#edjudul").val(json.judul);
                $("#edisiawal").val(json.isiawal+"");
                $("#edisi").val(json.isi+"");
                $("#edidbahasa").val(json.idbahasa);
//                $("#edidmenu").val(json.idmenu);
//                $("#edidkomponen").val(json.idkomponen);
                $("#edtanggal").val(json.tanggal);
                $("#edjam").val(json.jam);
                $("#edidadmin").val(json.idadmin);
                $("#edurut").val(json.urut);
                $("#edimage1").val(json.image1).trigger('change');
                $("#edimage2").val(json.image2).trigger('change');
                $("#edimage3").val(json.image3).trigger('change');
                
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "OnEdit content "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)  alert("On Edit "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga "+errorMsg);
            }
        });
    });
} 

function doClearcontent(){ 
    $(document).ready(function(){
        $("#edidx").val("0");
        $("#edjudul").val("");
        $("#edisiawal").val("");
        $("#edisi").val("");
        $("#edidbahasa").val("");
//        $("#edidmenu").val("");
//        $("#edidkomponen").val("");
        $("#edtanggal").val("");
        $("#edjam").val("");
        $("#edidadmin").val("");
        $("#edurut").val("");

        $("#edimage1").val("").trigger('change');
                $("#edimage2").val("").trigger('change');
                $("#edimage3").val("").trigger('change');

       
    });
} 

function dosimpancontent(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrcontent/simpancontent/",
            data: "edidx="+$("#edidx").val()+"&edjudul="+encodeURIComponent($("#edjudul").val())+
                             "&edisiawal="+encodeURIComponent($("#edisiawal").val())+
                             "&edisi="+encodeURIComponent($("#edisi").val())+"&edidbahasa="+$("#edidbahasa").val()+"&edidmenu="+$("#edidmenu").val()+"&edidkomponen="+$("#edidkomponen").val()+"&edtanggal="+$("#edtanggal").val()+"&edjam="+$("#edjam").val()+"&edidadmin="+$("#edidadmin").val()+"&edurut="+$("#edurut").val()+"&edimage1="+$("#edimage1").val()+"&edimage2="+$("#edimage2").val()+"&edimage3="+$("#edimage3").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(msg){
                //doClearcontent();
                doeditcontent($("#edidx").val());
                dosearchcontent('-99');
                alert("Data Has Been Saved.... ");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg =  " On Simpan content "+xmlHttpRequest.responseText;
                if (start > 0 && end > 0)
                    alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga "+errorMsg);
            }
        });
    });
} 

function dohapuscontent(edidx,edjudul){ 
    if (confirm("Anda yakin Akan menghapus data "+edjudul+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrcontent/deletetablecontent/",
                data: "edidx="+edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    doClearcontent(); 
                    dosearchcontent('-99'); 
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    start = xmlHttpRequest.responseText.search("<title>") + 7;
                    end = xmlHttpRequest.responseText.search("</title>");
                    errorMsg = " HAPUS content "+xmlHttpRequest.responseText;
                    if (start > 0 && end > 0)
                        alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("Error juga "+errorMsg);
                }
            });
        });
    }
} 


dosearchcontent(0); 
$(document).ready(function() {
  $("#edimage1").myupload();
  $("#edimage2").myupload();
  $("#edimage3").myupload();
});

$(document).ready(function() {
    //alert("testtt");
    $("#tabs").tabs();
    //alert("testtt"+$("#edidx").val());

    if($("#edidx").val()!='0'){
      doeditcontent($("#edidx").val());
    }
});

