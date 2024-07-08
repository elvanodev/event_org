function dosearchprovinsi(xAwal) {
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
            url: getBaseURL() + "index.php/ctrprovinsi/searchprovinsi/",
            data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#tabledataprovinsi").html(json.tabledataprovinsi);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}


function doeditprovinsi(edidx) {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrprovinsi/editrecprovinsi/",
            data: "edidx=" + edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#edidx").val(json.idx);
                $("#edkode_provinsi").val(json.kode_provinsi);
                $("#edprovinsi").val(json.provinsi);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function doClearprovinsi() {
    $(document).ready(function () {
        $("#edidx").val("0");
        $("#edkode_provinsi").val("");
        $("#edprovinsi").val("");

    });
}

function dosimpanprovinsi() {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrprovinsi/simpanprovinsi/",
            data: "edidx=" + $("#edidx").val() + "&edkode_provinsi=" + $("#edkode_provinsi").val() + "&edprovinsi=" + $("#edprovinsi").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (msg) {
                doClearprovinsi();
                dosearchprovinsi('-99');
                alert("Data Berhasil Disimpan.... ");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function dohapusprovinsi(edidx) {
    if (confirm("Anda yakin Akan menghapus data ?"))
    {
        $(document).ready(function () {
            $.ajax({
                url: getBaseURL() + "index.php/ctrprovinsi/deletetableprovinsi/",
                data: "edidx=" + edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function (json) {
                    doClearprovinsi();
                    dosearchprovinsi('-99');
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("Error juga " + xmlHttpRequest.responseText);
                }
            });
        });
    }
}


dosearchprovinsi(0);

  