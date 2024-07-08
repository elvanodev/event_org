$(document).ready(function(){ 
    dosearchmenu(0);
  }); 
  function dosearchmenu(xAwal){ 
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
        formhide();
        $.ajax({
            url: getBaseURL()+"index.php/ctrmenu/searchmenu/",
            data: "xAwal="+xAwal+"&xSearch="+xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#tabledatamenu").html(json.tabledatamenu);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                       alert("Error juga"+xmlHttpRequest.responseText);
            }
        });
    });
} 

function doeditmenu(edidmenu){ 
    $(document).ready(function(){
        formshow();
        $.ajax({
            url: getBaseURL()+"index.php/ctrmenu/editrecmenu/",
            data: "edidmenu="+edidmenu,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json){
                $("#edidmenu").val(json.idmenu);
                $("#edicon").val(json.icon);
                $("#ednmmenu").val(json.nmmenu);
                $("#edtipemenu").val(json.tipemenu);
                $("#edidkomponen").val(json.idkomponen);
                $("#ediduser").val(json.iduser);
                $("#edparentmenu").val(json.parentmenu);
                $("#edurlci").val(json.urlci);
                $("#edurut").val(json.urut);
                $("#edjmlgambar").val(json.jmlgambar);
                $("#edsettingform").val(json.settingform);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                 alert("Error juga "+xmlHttpRequest.responseText);
            }
        });
    });
} 

function doClearmenu(){ 
    $(document).ready(function(){
        formshow();
        $("#edidmenu").val("0");
        $("#edicon").val("");
        $("#ednmmenu").val("");
        $("#edtipemenu").val("");
        $("#edidkomponen").val("");
        $("#ediduser").val("");
        $("#edparentmenu").val("");
        $("#edurlci").val("");
        $("#edurut").val("");
        $("#edjmlgambar").val("");
        $("#edsettingform").val("xbahasa:Bahasa,;xjudul:Judul,;xisi:Isi / Keterangan,kontent;xisiawal:Isi Awal,Isikan Jika Diperlukan;xurut:urutan,urutan saat ditampilkan diweb;xgb1:,Upload Gambar 1;xgb2:,Upload Gambar 2;xgb3:,Upload Gambar 3;");
    });
} 

function dosimpanmenu(){ 
    $(document).ready(function(){
        $.ajax({
            url: getBaseURL()+"index.php/ctrmenu/simpanmenu/",
            data: "edidmenu="+$("#edidmenu").val()+"&ednmmenu="+$("#ednmmenu").val()+
                  "&edtipemenu="+$("#edtipemenu").val()+"&edidkomponen="+$("#edidkomponen").val()+
                  "&ediduser="+$("#ediduser").val()+"&edparentmenu="+$("#edparentmenu").val()+
                  "&edurlci="+$("#edurlci").val()+"&edurut="+$("#edurut").val()+
                  "&edjmlgambar="+$("#edjmlgambar").val()+"&edsettingform="+$("#edsettingform").val()+"&edicon="+$("#edicon").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(msg){
                doClearmenu();
                dosearchmenu('-99');
                setmenucombo();
                alert("Data Has Been Saved.... ");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                       alert("Error juga "+xmlHttpRequest.responseText);
            }
        });
    });
} 

function dohapusmenu(edidmenu,ednmmenu){ 
    if (confirm("Anda yakin Akan menghapus data "+ednmmenu+"?"))
    {
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrmenu/deletetablemenu/",
                data: "edidmenu="+edidmenu,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    doClearmenu(); 
                    dosearchmenu('-99'); 
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    start = xmlHttpRequest.responseText.search("<title>") + 7;
                    end = xmlHttpRequest.responseText.search("</title>");
                    errorMsg = " HAPUS menu "+xmlHttpRequest.responseText;
                    if (start > 0 && end > 0)
                        alert("Rangerti "+errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("Error juga "+errorMsg);
                }
            });
        });
    }
} 


dosearchmenu(0);

function setmenucombo(){
        $(document).ready(function(){
            $.ajax({
                url: getBaseURL()+"index.php/ctrmenu/setreekategori/",
                data: "",
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function(json){
                    $("#edparentmenu").html("");
                    $("#edparentmenu").html(json.option);
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                     alert("Error juga "+xmlHttpRequest.responseText);
                }
            });
        });

}

setmenucombo();
function formshow(){
    $(document).ready(function() {
        $("#btSimpan").show();
        $("#form").show();
    })
}
function formhide(){
$(document).ready(function() {
    $("#btSimpan").hide();
    $("#form").hide();
})
}