function dosearchartists(xAwal) {
  xSearch = "";
  try {
    if ($("#edSearch").val() != "") {
      xSearch = $("#edSearch").val();
    }
  } catch (err) {
    xSearch = "";
  }
  if (typeof xSearch == "undefined") {
    xSearch = "";
  }
  $(document).ready(function () {
    formhide();
    $.ajax({
      url: getBaseURL() + "index.php/ctrartists/searchartists/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledataartists").html(json.tabledataartists);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditartists(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrartists/editrecartists/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#edname").val(json.name);
        $("#edbirth_date").val(json.birth_date);
        $("#edbirth_place").val(json.birth_place);
        $("#edbio").val(json.bio);
        $("#edquote").val(json.quote);
        $("#edposter_img").val(json.poster_img);
        $("#edphone").val(json.phone);
        $("#edinstagram_link").val(json.instagram_link);
        $("#edtwitter_link").val(json.twitter_link);
        $("#edemail").val(json.email);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doClearartists() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#edname").val("");
    $("#edbirth_date").val("");
    $("#edbirth_place").val("");
    $("#edbio").val("");
    $("#edquote").val("");
    $("#edposter_img").val("");
    $("#edphone").val("");
    $("#edinstagram_link").val("");
    $("#edtwitter_link").val("");
    $("#edemail").val("");
  });
}

function dosimpanartists() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrartists/simpanartists/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&edname=" +
        $("#edname").val() +
        "&edbirth_date=" +
        $("#edbirth_date").val() +
        "&edbirth_place=" +
        $("#edbirth_place").val() +
        "&edbio=" +
        $("#edbio").val() +
        "&edquote=" +
        $("#edquote").val() +
        "&edposter_img=" +
        $("#edposter_img").val() +
        "&edphone=" +
        $("#edphone").val() +
        "&edinstagram_link=" +
        $("#edinstagram_link").val() +
        "&edtwitter_link=" +
        $("#edtwitter_link").val() +
        "&edemail=" +
        $("#edemail").val(),
      cache: false,
      dataType: "json",
      type: "POST",
      beforeSend: function (msg) {
        toastr.info("Loding.....", "", {
          progressBar: true,
          positionClass: "toast-top-center",
          onclick: null,
        });
      },
      success: function (msg) {
        doClearartists();
        dosearchartists("-99");
        toastr.clear();
        toastr.success("Data berhasil disimpan");
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        console.log('EYYOY', xmlHttpRequest.responseText);
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function dohapusartists(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctrartists/deletetableartists/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doClearartists();
          dosearchartists("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchartists(0);
function queryParams() {
  return {
    type: "owner",
    sort: "idx",
    direction: "desc",
    per_page: 1000,
    page: 1,
  };
}
function formshow() {
  $(document).ready(function () {
    $("#btSimpan").show();
    $("#form").show();
  });
}
function formhide() {
  $(document).ready(function () {
    $("#btSimpan").hide();
    $("#form").hide();
  });
}
$(document).ready(function () {  
  $("#edposter_img").myupload();
});