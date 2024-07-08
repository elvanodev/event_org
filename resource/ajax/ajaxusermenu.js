function getvaluemncheck() {
    var xVal = '';
    $('#chkmenu').each(function () {

        $('input[type=checkbox]:checked').each(function (index) {
            //this.checked = !this.checked;

            xVal += "&" + $(this).attr('id') + "=" + $(this).val();
            
        });

    });


    return xVal;
}

function getclearmncheck() {
    //var xVal ='';
        $('#chkmenu').each(function () {
            $('input[type=checkbox]:checked').each(function (index) {
                this.checked = false;
                //xVal +=  "&"+$(this).attr('name')+"="+$(this).val();
            });

        });


}

function isinmenu(idmenu) {

    $(document).ready(function () {
        // alert(idmenu);
        $.ajax({
            url: getBaseURL() + "index.php/ctrusermenu/isinmenu/",
            data: "xidmenu=" + idmenu + "&xiduser=" + $("#ediduser").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            async: false,
            success: function (json) {

                //$('input[id=mn'+json.idmenu+']').prop('checked', json.isinmenu);

                $('#mn' + json.idmenu).prop('checked', json.isinmenu);
                // alert(json.idmenu+'--'+json.isinmenu);


            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {

                alert(xmlHttpRequest.responseText + " 2");
            }
        });
    });

    //return xBufReturn;
}

function setcheckmenu() {

    $(document).ready(function () {
        $('#chkmenu').each(function () {
            $('input:checkbox').each(function (index) {
                isinmenu($(this).attr('id'));
                //this.checked = isinmenu($(this).val());
                // alert(index + ': ' + $(this).val()+ $(this).attr('name'));
                //xVal +=  "&"+$(this).attr('name')+"="+$(this).val();

            });

        });

    });

}

function dosearch(xAwal) {
    xSearch = "";
    try
    {
        if ($("#edSearch").val() != "") {
            xSearch = $("#edSearch").val();
        }
    } catch (err) {
        xSearch = "";
    }
    if (typeof (xSearch) == "undefined") {
        xSearch = "";
    }
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrusermenu/search/",
            data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                /*$("#tabledata").html(json.tabledata);*/

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " error on search ";
                if (start > 0 && end > 0)
                    alert("Rangerti " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga" + errorMsg);
            }
        });
    });
}

function doedit(edidx) {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrusermenu/editrec/",
            data: "edidx=" + edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#edidx").val(json.idx);
                $("#ediduser").val(json.iduser);
                $("#edidmenu").val(json.idmenu);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = "OnEdit ";
                if (start > 0 && end > 0)
                    alert("On Edit " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga " + errorMsg);
            }
        });
    });
}

function doClear() {
    $(document).ready(function () {
        $("#edidx").val("0");
        getclearmncheck();
        $("#ediduser").val("");
        $("#edidmenu").val("");
    });
}

function dosimpan() {

    var xval = getvaluemncheck();
     $(document).ready(function () {

        $.ajax({
            url: getBaseURL() + "index.php/ctrusermenu/simpan/",
            data: "edidx=" + $("#edidx").val() + "&ediduser=" + $("#ediduser").val() + xval,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (msg) {
                doClear();
                dosearch('-99');
                alert("Data Berhasil Disimpan");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                start = xmlHttpRequest.responseText.search("<title>") + 7;
                end = xmlHttpRequest.responseText.search("</title>");
                errorMsg = " On Simpan ";
                if (start > 0 && end > 0)
                    alert("Rangerti " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                else
                    alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function dohapus(edidx, ediduser) {
    if (confirm("Anda yakin Akan menghapus data " + ediduser + "?"))
    {
        $(document).ready(function () {
            $.ajax({
                url: getBaseURL() + "index.php/ctrusermenu/deletetable/",
                data: "edidx=" + edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function (json) {
                    doClear();
                    dosearch('-99');
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    start = xmlHttpRequest.responseText.search("<title>") + 7;
                    end = xmlHttpRequest.responseText.search("</title>");
                    errorMsg = " HAPUS ";
                    if (start > 0 && end > 0)
                        alert("Rangerti " + errorMsg + "  [" + xmlHttpRequest.responseText.substring(start, end) + "]");
                    else
                        alert("Error juga " + errorMsg);
                }
            });
        });
    }
}


function initCorners() {
    var setting = {
        tl: {
            radius: 10
        }, // top left
        tr: {
            radius: 10
        }, // top right
        bl: {
            radius: 6
        }, // bottom left
        br: {
            radius: 6
        }, // bottom right
        antiAlias: true
    }
    curvyCorners(setting, "div#mnhead h1");
}

function dotree() {
    $(document).ready(function () {
        $("#tree").checkboxTree();
    });
}
//addEvent(window, 'load', initCorners);

//dosearch(0);
dotree();



function dotest() {
    var xVal = getvaluemncheck();
    alert(xVal);
}



