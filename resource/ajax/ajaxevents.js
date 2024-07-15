function dosearchevents(xAwal) {
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
      url: getBaseURL() + "index.php/ctrevents/searchevents/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledataevents").html(json.tabledataevents);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditevents(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrevents/editrecevents/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#edname").val(json.name);
        $("#edlong_name").val(json.long_name);
        $("#edis_active").val(json.is_active);
        $("#eddescriptions").val(json.descriptions);
        $("#edabout_event").val(json.about_event);
        $("#edabout1_event").val(json.about1_event);
        $("#edabout2_event").val(json.about2_event);
        $("#edabout3_event").val(json.about3_event);
        $("#edposter_image").val(json.poster_image);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doClearevents() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#edname").val("");
    $("#edlong_name").val("");
    $("#edis_active").val("");
    $("#eddescriptions").val("");
    $("#edabout_event").val("");
    $("#edabout1_event").val("");
    $("#edabout2_event").val("");
    $("#edabout3_event").val("");
    $("#edposter_image").val("");
  });
}

function dosimpanevents() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrevents/simpanevents/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&edname=" +
        $("#edname").val() +
        "&edlong_name=" +
        $("#edlong_name").val() +
        "&edis_active=" +
        $("#edis_active").val() +
        "&eddescriptions=" +
        $("#eddescriptions").val() +
        "&edabout_event=" +
        $("#edabout_event").val() +
        "&edabout1_event=" +
        $("#edabout1_event").val() +
        "&edabout2_event=" +
        $("#edabout2_event").val() +
        "&edabout3_event=" +
        $("#edabout3_event").val() +
        "&edposter_image=" +
        $("#edposter_image").val(),
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
        doClearevents();
        dosearchevents("-99");
        toastr.clear();
        toastr.success("Data berhasil disimpan");
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function dohapusevents(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctrevents/deletetableevents/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doClearevents();
          dosearchevents("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchevents(0);
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
  $("#edposter_image").myupload();
});