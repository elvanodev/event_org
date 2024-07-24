$(document).ready( function () {
  $(".collaboratorPoster").hover( function () {
    $(this).children(".imgPoster").addClass("d-none");
    $(this).children(".quoteArtist").removeClass("d-none");
  }, function () {
    $(this).children(".imgPoster").removeClass("d-none");
    $(this).children(".quoteArtist").addClass("d-none");
  });
});

function onclickclose() {
  $("#modalCollaborators").modal('hide');
}

function onclickcollaborators(collaboratorid) {
  $.ajax({
    url: getBaseURL() + "index.php/frontend/collaborators/detail",
    data: "collaboratorid=" + collaboratorid,
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {
      var phone = json.phone;
      phone = phone.replace(/^0+/, '');
      $("#waLink").attr("href", "http://wa.me/62"+phone);
      $("#instagramLink").attr("href", json.instagram_link);
      $("#twitterLink").attr("href", json.twitter_link);
      $("#mailLink").attr("href", "mailto:"+json.email);
      $("#artistPhoto").html('<img src="'+getBaseURL()+'resource/uploaded/img/'+json.profile_img+'" class="img-fluid img-circle" />');
      $("#artistName").html(json.artist_name);
      $("#bornPlaceDate").html(json.birth_place + ' ,' + json.birth_date);
      $("#artistBio").html(json.bio);
      $("#modalCollaborators").modal('show');
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      console.log("Error Log:", xmlHttpRequest.responseText);
    },
  });
}
