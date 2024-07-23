$(document).ready( function () {
  $(".collaboratorPoster").hover( function () {
    $(this).children(".imgPoster").addClass("d-none");
    $(this).children(".quoteArtist").removeClass("d-none");
  }, function () {
    $(this).children(".imgPoster").removeClass("d-none");
    $(this).children(".quoteArtist").addClass("d-none");
  });
});

function onclickartist() {
  $.ajax({
    url: getBaseURL() + "index.php/frontend/collaborators/detail",
    data: "collaboratorid=" + $("#collaboratorid").val(),
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {
      $("#ededition_id").html("");
      $("#ededition_id").html(json.option);
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      alert("Error juga " + xmlHttpRequest.responseText);
    },
  });
}
