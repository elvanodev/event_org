$(document).ready(function () {
  formatrupiah();
  settanggal();
  $(".datetimepicker").each(function () {
    $(this).datetimepicker();
  });
  $(".selectedEdition").html("");
  getEdition($("#editionId").val());
  $("#editionId").change(function (e) {
    e.preventDefault();
    getEdition($(this).val());
  });
  $("#editionIdMobile").change(function (e) {
    e.preventDefault();
    getEdition($(this).val());
  });
});

function seteditionsession(edition_id) {
  $.ajax({
    url: getBaseURL() + "index.php/home/seteditionsession/",
    data: "ededition_id=" + edition_id,
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {},
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
        $("#editionenddate").val(json.ended_at);
        let date = new Date(json.started_at);
        seteditionsession(json.idx);
        $(".selectedEdition").html(
          json.name + " " + json.venue_address + " " + date.getFullYear()
        );
        if (location.pathname == "/") {
          getEditiondatetimestart();
        }
        if (editionId !== $('#editionId').val() || editionId !== $('#editionIdMobile').val() ) {
          location.reload();
        }
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        console.log("Error juga " + xmlHttpRequest.responseText);
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  }
}

function onclickclose() {
  $("#modalArtist").modal("hide");
}

function onclickartist(artistid) {
  $.ajax({
    url: getBaseURL() + "index.php/frontend/collaborators/detail",
    data: "artistid=" + artistid,
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {
      var phone = json.phone;
      phone = phone.replace(/^0+/, "");
      $("#waLink").attr("href", "http://wa.me/62" + phone);
      $("#instagramLink").attr("href", json.instagram_link);
      $("#twitterLink").attr("href", json.twitter_link);
      $("#mailLink").attr("href", "mailto:" + json.email);
      $("#artistPhoto").html(
        '<img src="' +
          getBaseURL() +
          "resource/uploaded/img/" +
          json.profile_img +
          '" class="img-fluid img-circle" />'
      );
      $("#artistName").html(json.name);
      $("#bornPlaceDate").html(json.birth_place + " ," + json.birth_date);
      $("#artistBio").html(json.bio);
      $("#modalArtist").modal("show");
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      console.log("Error Log:", xmlHttpRequest.responseText);
    },
  });
}
