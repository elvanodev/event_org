function dosearchkabupaten(xAwal) {
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
            url: getBaseURL() + "index.php/ctrkabupaten/searchkabupaten/",
            data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#tabledatakabupaten").html(json.tabledatakabupaten);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}


function doeditkabupaten(edidx) {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkabupaten/editreckabupaten/",
            data: "edidx=" + edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#edidx").val(json.idx);
                $("#edkode_kabupaten").val(json.kode_kabupaten);
                $("#edkabupaten").val(json.kabupaten);
                $("#edidprovinsi").val(json.idprovinsi);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function doClearkabupaten() {
    $(document).ready(function () {
        $("#edidx").val("0");
        $("#edkode_kabupaten").val("");
        $("#edkabupaten").val("");
        $("#edidprovinsi").val("");

    });
}

function dosimpankabupaten() {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkabupaten/simpankabupaten/",
            data: "edidx=" + $("#edidx").val() + "&edkode_kabupaten=" + $("#edkode_kabupaten").val() + "&edkabupaten=" + $("#edkabupaten").val() + "&edidprovinsi=" + $("#edidprovinsi").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (msg) {
                doClearkabupaten();
                dosearchkabupaten('-99');
                alert("Data Berhasil Disimpan.... ");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function dohapuskabupaten(edidx) {
    if (confirm("Anda yakin Akan menghapus data ?"))
    {
        $(document).ready(function () {
            $.ajax({
                url: getBaseURL() + "index.php/ctrkabupaten/deletetablekabupaten/",
                data: "edidx=" + edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function (json) {
                    doClearkabupaten();
                    dosearchkabupaten('-99');
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("Error juga " + xmlHttpRequest.responseText);
                }
            });
        });
    }
}


dosearchkabupaten(0);

 