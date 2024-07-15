$(document).ready(function () {  
    $("#selectedEdition").html("");
    getEdition($("#editionId").val());
    $("#editionId").change(function (e) { 
        e.preventDefault();  
        getEdition($(this).val());
    });
  });

  function getEdition(editionId) {
    $.ajax({
        url: getBaseURL() + "index.php/ctreditions/editreceditions/",
        data: "edidx=" + editionId,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
            let date = new Date(json.started_at);
            $("#selectedEdition").html(json.name + " " + json.venue_address + " " + date.getFullYear());
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
        },
    });
  }