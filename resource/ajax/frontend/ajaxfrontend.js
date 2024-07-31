
$(document).ready(function () {
    formatrupiah();
    settanggal();
    $(".datetimepicker").each(function () {
        $(this).datetimepicker();
    });
    $("#selectedEdition").html("");
    getEdition($("#editionId").val());
    $("#editionId").change(function (e) { 
        e.preventDefault();  
        getEdition($(this).val());
    });
});

function seteditionsession() {    
    $.ajax({
        url: getBaseURL() + "index.php/home/seteditionsession/",
        data: "ededition_id=" + $("#editionId").val(),
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {

        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            console.log("Error:", xmlHttpRequest.responseText);
            alert("Error juga " + xmlHttpRequest.responseText);
        },
    });
}

function getEdition(editionId) {
    if (editionId != undefined) {
        $.ajax({
            url: getBaseURL() + "index.php/ctreditions/editreceditions/",
            data: "edidx=" + editionId,
            cache: false,
            dataType: "json",
            type: "POST",
            success: function (json) {
                $("#editionstartdate").val(json.started_at);
                let date = new Date(json.started_at);
                $("#selectedEdition").html(json.name + " " + json.venue_address + " " + date.getFullYear());
                if (location.search == "") {
                    getEditiondatetimestart();
                }
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                console.log("Error juga " + xmlHttpRequest.responseText);
                alert("Error juga " + xmlHttpRequest.responseText);
            },
        });        
    }
}