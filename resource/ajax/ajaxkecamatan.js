function dosearchkecamatan(xAwal) {
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
            url: getBaseURL() + "index.php/ctrkecamatan/searchkecamatan/",
            data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#tabledatakecamatan").html(json.tabledatakecamatan);
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}


function doeditkecamatan(edidx) {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkecamatan/editreckecamatan/",
            data: "edidx=" + edidx,
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (json) {
                $("#edidx").val(json.idx);
                $("#edkode_kecamatan").val(json.kode_kecamatan);
                $("#edkecamatan").val(json.kecamatan);
                $("#edidkabupaten").val(json.idkabupaten);
                $("#edidprovinsi").val(json.idprovinsi);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function doClearkecamatan() {
    $(document).ready(function () {
        $("#edidx").val("0");
        $("#edkode_kecamatan").val("");
        $("#edkecamatan").val("");
        $("#edidkabupaten").val("");
        $("#edidprovinsi").val("");

    });
}

function dosimpankecamatan() {
    $(document).ready(function () {
        $.ajax({
            url: getBaseURL() + "index.php/ctrkecamatan/simpankecamatan/",
            data: "edidx=" + $("#edidx").val() + "&edkode_kecamatan=" + $("#edkode_kecamatan").val() + "&edkecamatan=" + $("#edkecamatan").val() + "&edidkabupaten=" + $("#edidkabupaten").val() + "&edidprovinsi=" + $("#edidprovinsi").val(),
            cache: false,
            dataType: 'json',
            type: 'POST',
            success: function (msg) {
                doClearkecamatan();
                dosearchkecamatan('-99');
                alert("Data Berhasil Disimpan.... ");
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga " + xmlHttpRequest.responseText);
            }
        });
    });
}

function dohapuskecamatan(edidx) {
    if (confirm("Anda yakin Akan menghapus data ?"))
    {
        $(document).ready(function () {
            $.ajax({
                url: getBaseURL() + "index.php/ctrkecamatan/deletetablekecamatan/",
                data: "edidx=" + edidx,
                cache: false,
                dataType: 'json',
                type: 'POST',
                success: function (json) {
                    doClearkecamatan();
                    dosearchkecamatan('-99');
                },
                error: function (xmlHttpRequest, textStatus, errorThrown) {
                    alert("Error juga " + xmlHttpRequest.responseText);
                }
            });
        });
    }
}


dosearchkecamatan(0);

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
                $("#provinsi").html(json.comboprovinsi);

            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("Error juga" + xmlHttpRequest.responseText);
            }
        });
    });
}