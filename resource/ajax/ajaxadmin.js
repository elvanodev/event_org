/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * Base url :  src="http://localhost/tebu-digital/resource/js/jquery.js"
 * site URL : http://localhost/tebu-digital/index.php/voxus/setView
 */


function dosearch(xAwal){
    xSearch ="";
    try
    { if ($("#edSearch").val()!=""){
            xSearch = $("#edSearch").val();
        }
    }catch(err){
        xSearch ="";
    }

    if (typeof(xSearch) ==="undefined"){
        xSearch ="";
    }

    $(document).ready(function(){
        $.ajax({
            //url: "' . site_url('admin/search/') . '",
            url: getBaseURL()+"index.php/admin/search/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch+"&xIdMenu="+$("#edidmenu").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#tabledatatranslete").html(json.tabledata);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end  = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " error on search ";
                if (start > 0 && end > 0)
                    alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("This Is "+errorMsg);
            }
        });
    });
}

function doedit(edidtranslete){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/admin/editrec/",
            data: "edidtranslete="+edidtranslete,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidtranslete").val(json.idtranslete);
                $("#edUrut").val(json.urut);
                $("#edJudul").val(json.judul);
                tinyMCE.activeEditor.setContent(json.isi);
                //alert(json.gambar1);
                $('#previewg1').attr({
                    src: getBaseURL()+"resource/uploaded/project/"+json.gambar1,
                    alt: ""
                });
                //var a_gal = $(\'#preview\').attr({
                $('#preview1').attr({
                    href: getBaseURL()+"resource/uploaded/project/"+json.gambar1,
                    class : "thickbox",
                    alt: "",
                    title: ""
                });

                //tinyMCE.get(\'text\').getContent
                //     $("#edidbahasa").val(json.idbahasa);
                //     $("#edidfield").val(json.idfield);
                //     $("#edidmenu").val(json.idmenu);
                //    $("#edidkomponen").val(json.idkomponen);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("Error juga"+xmlHttpRequest.responseTex);
            }
        });
    });
}

function getUrutTranslete(){
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/admin/getUrutTranslete/",
            data: "edidmenu="+$("#edidmenu").val()+"&edidkomponen="+$("#edidkomponen").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edUrut").val(json.urut);

                tinyMCE.activeEditor.setContent(json.isi);

                //tinyMCE.get(\'text\').getContent
                //     $("#edidbahasa").val(json.idbahasa);
                //     $("#edidfield").val(json.idfield);
                //     $("#edidmenu").val(json.idmenu);
                //    $("#edidkomponen").val(json.idkomponen);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "error ";
                if (start > 0 && end > 0)  alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga"+errorMsg);
            }
        });
    });
}

function doClear(){

    $(document).ready(function(){

        $("#edidtranslete").val("0");
        $("#edJudul").val("");
        $("#edisi").val("");
        tinyMCE.activeEditor.setContent("");
        getUrutTranslete();
        $('#previewg1').attr({
                    src: getBaseURL()+"resource/uploaded/white.png",
                    alt: ""
                });
                //var a_gal = $(\'#preview\').attr({
                $('#preview1').attr({
                    src: getBaseURL()+"resource/uploaded/white.png",
                    class : "thickbox",
                    alt: "",
                    title: ""
                });

        // $("#edidbahasa").val("");
        // $("#edidfield").val("");
        // $("#edidmenu").val("");
        // $("#edidkomponen").val("");
    });
}

function dosimpanimage(idx){
    $(document).ready(function(){
       //alert("edgambar="+$("#edgambar"+idx).val()+"&edidmenu="+$("#edidmenu").val()+"&idxgambar="+idx);
        $.ajax({
            url: getBaseURL()+"index.php/admin/simpanimage/",
            data: "edgambar="+$("#edgambar"+idx).val()+"&edidmenu="+$("#edidmenu").val()+"&idxgambar="+idx+"&edidtranslete="+$("#edidtranslete").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //   doClear();
                // dosearch('-99');
                // tinyMCE.activeEditor.setContent(json.edisi);
                //  alert(tinyMCE.activeEditor.getContent());

                //alert("Image Di simpan");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg =  " dosimpanimage";
                if (start > 0 && end > 0)
                    alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga "+errorMsg);
            }
        });
    });
}


function dosimpan(){
    $(document).ready(function(){

        $.ajax({
            url: getBaseURL()+"index.php/admin/simpan/",
            data: "edidtranslete="+$("#edidtranslete").val()+
                     "&edisi="+encodeURIComponent(tinyMCE.activeEditor.getContent())+
                 "&edJudul="+$("#edJudul").val()+"&edUrut="+$("#edUrut").val()+
                "&edidmenu="+$("#edidmenu").val()+"&edidkomponen="+$("#edidkomponen").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                //   doClear();
                dosearch('-99');
                // tinyMCE.activeEditor.setContent(json.edisi);
                //  alert(tinyMCE.activeEditor.getContent());

                alert("Data Sudah Di simpan");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg =  " ";
                if (start > 0 && end > 0)
                    alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga "+errorMsg);
            }
        });
    });
}


function dohapus(edidtranslete){
    if (confirm("Anda yakin Akan menghapus data ini?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/admin/deletetable/",
                data: "edidtranslete="+edidtranslete,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    doClear();
                    dosearch('-99');
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    start = xmlHttpRequest.responseText.search("<title>") + 7;
                    end = xmlHttpRequest.responseText.search("</title>");
                    errorMsg = " error"+xmlHttpRequest.responseText;
                    if (start > 0 && end > 0)
                        alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("Error juga "+errorMsg);
                }
            });
        });
    }
}

    function dologin(){
         $(document).ready(function(){
          // alert(getBaseURL());
           $.ajax({
                 url: getBaseURL()+"index.php/admin/dologin/",
                 data: "edUser="+$("#edUser").val()+"&edPassword="+$("#edPassword").val(),
                 cache: false,
                 dataType: 'json',
                 type: 'POST',
                 success: function(json){

                 if(json.data){
                  document.location = json.location;
                 }else
                 {
                   alert("Login Anda Salah Silahkan di ulangi");
                 }
                 },
               error: function (xmlHttpRequest, textStatus, errorThrown) {
                     start = xmlHttpRequest.responseText.search("<title>") + 7;
                     end = xmlHttpRequest.responseText.search("</title>");
                     errorMsg =  " "+xmlHttpRequest.responseText;
                     if (start > 0 && end > 0)
                         alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                     else
                         alert("Error juga "+errorMsg);
               }
           });
         });
         }

function dogetpropinsi(idpropinsi){
       $(document).ready(function(){
          document.location = getBaseURL()+"index.php/ctrlapperkabupaten/index/"+idpropinsi; 
       });  
}