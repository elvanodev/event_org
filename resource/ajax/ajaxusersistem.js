$(document).ready(function(){ 
    dosearchusersistem(0);
  }); 
  function dosearchusersistem(xAwal) {
    xSearch = "";
    try
    {
        if ($("#edSearch").val() != "") {
            xSearch = $("#edSearch").val();
        }
    } catch (err) {
        xSearch = "";
    }
    if (typeof(xSearch) == "undefined") {
        xSearch = "";
    }
    $(document).ready(function() {
        formhide();
        $.ajax({
            url: getBaseURL() + "index.php/ctrusersistem/searchusersistem/",
            data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(json) {
                $("#tabledatausersistem").html(json.tabledatausersistem);
            },
            error: function(xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " error on search usersistem " + xmlHttpRequest.responseText;
                if (start > 0 && end > 0)
                    alert("Rangerti " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga" + errorMsg);
            }
        });
    });
}

function doeditusersistem(edidx) {
    $(document).ready(function() {
        formshow();
        $.ajax({
            url: getBaseURL() + "index.php/ctrusersistem/editrecusersistem/",
            data: "edidx=" + edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            async:false,
            success: function(json) {
                $("#edidx").val(json.idx);
                $("#ednpp").val(json.npp);
                $("#edNama").val(json.Nama);
                $("#edalamat").val(json.alamat);
                $("#edNoTelpon").val(json.NoTelpon);
                $("#eduser").val(json.user);
                $("#edpassword").val(json.password);
                $("#edstatuspeg").val(json.statuspeg);
                $("#edphoto").val(json.photo);
                $("#edemail").val(json.email);
                $("#edym").val(json.ym);
                $("#edisaktif").val(json.isaktif);
                $("#edidusergroup").val(json.idusergroup);
                $("#edidpropinsi").val(json.idpropinsi);
                $("#edimehp").val(json.imehp);
                $("#edidkabupaten").val(json.idkabupaten);
//                settablekabupatenfrompropinsi(json.idpropinsi,json.idkabupaten);
            },
            error: function(xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "OnEdit usersistem " + xmlHttpRequest.responseText;
                if (start > 0 && end > 0)
                    alert("On Edit " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga " + errorMsg);
            }
        });
    });
}

function doClearusersistem() {
    $(document).ready(function() {
        formshow();
        $("#edidx").val("0");
        $("#ednpp").val("");
        $("#edNama").val("");
        $("#edalamat").val("");
        $("#edNoTelpon").val("");
        $("#eduser").val("");
        $("#edpassword").val("");
        $("#edstatuspeg").val("");
        $("#edphoto").val("");
        $("#edemail").val("");
        $("#edym").val("");
        $("#edimehp").val("");
        $("#edisaktif").val("");
        $("#edidusergroup").val("");
    });
}

function dosimpanusersistem() {
    $(document).ready(function() {
        $.ajax({
            url: getBaseURL() + "index.php/ctrusersistem/simpanusersistem/",
            data: "edidx=" + $("#edidx").val() + "&ednpp=" + $("#ednpp").val() + "&edNama=" + $("#edNama").val() + 
                    "&edalamat=" + $("#edalamat").val() + "&edNoTelpon=" + $("#edNoTelpon").val() + 
                    "&eduser=" + $("#eduser").val() + "&edpassword=" + $("#edpassword").val() + 
                    "&edstatuspeg=" + $("#edstatuspeg").val() + "&edphoto=" + $("#edphoto").val() + 
                    "&edemail=" + $("#edemail").val() + "&edym=" + $("#edym").val() + 
                    "&edisaktif=" + $("#edisaktif").val() + 
                    "&edidusergroup=" + $("#edidusergroup").val()+"&edidpropinsi=" + $("#edidpropinsi").val()+
                    "&edidkabupaten=" + $("#edidkabupaten").val()+"&edimehp=" +$("#edimehp").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function(msg) {
                doClearusersistem();
                dosearchusersistem('-99');
                alert("Data Has Been Saved.... ");
            },
            error: function(xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " On Simpan usersistem " + xmlHttpRequest.responseText;
                if (start > 0 && end > 0)
                    alert("Rangerti " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga " + errorMsg);
            }
        });
    });
}

function dohapususersistem(edidx, ednpp) {
    if (confirm("Anda yakin Akan menghapus data " + ednpp + "?"))
    {
        $(document).ready(function() {
            $.ajax({
                url: getBaseURL() + "index.php/ctrusersistem/deletetableusersistem/",
                data: "edidx=" + edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                
                success: function(json) {
                    doClearusersistem();
                    dosearchusersistem('-99');
                },
                error: function(xmlHttpRequest, textStatus, errorThrown) {
                    start = xmlHttpRequest.responseText.search("<title>") + 7;
                    end = xmlHttpRequest.responseText.search("</title>");
                    errorMsg = " HAPUS usersistem " + xmlHttpRequest.responseText;
                    if (start > 0 && end > 0)
                        alert("Rangerti " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("Error juga " + errorMsg);
                }
            });
        });
    }
}


dosearchusersistem(0);


function settablekabupaten() {
    $(document).ready(function() {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkabupaten/kabupatenbyprovinsi/",
            data: "edidprovinsi=" + $("#edidpropinsi").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            async:false,
            success: function(json) {
                $("#edidkabupaten").html("");
                $("#edidkabupaten").html(json.combokabupaten);
            },
            error: function(xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });

}

function settablekabupatenfrompropinsi(idpropinsi,idkabupeten) {
    $(document).ready(function() {
        $.ajax({
            url: getBaseURL() + "index.php/ctrmediator/setcombokabutpaten/",
            data: "idpropinsi=" + idpropinsi,
            cache: false,
            dataType: 'json',
            type: 'POST',
            async:false,
            success: function(json) {
                $("#edidkabupaten").html("");
                $("#edidkabupaten").html(json.option);
                $("#edidkabupaten").val(idkabupeten);
                
            },
            error: function(xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });

}
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