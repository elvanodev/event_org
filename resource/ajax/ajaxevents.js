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
        $("#edposter_image").val(json.poster_image);
        $("#edcontact_phone").val(json.contact_phone);
        $("#edcontact_email").val(json.contact_email);
        $("#edagent_open_date").val(json.agent_open_date);
        $("#edagent_close_date").val(json.agent_close_date);
        $("#edagent_open_time").val(json.agent_open_time);
        $("#edagent_close_time").val(json.agent_close_time);
        $("#edagent_address").val(json.agent_address);
        $("#edagent_gmap").val(json.agent_gmap);
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
    $("#edposter_image").val("");
    $("#edcontact_phone").val("");
    $("#edcontact_email").val("");
    $("#edagent_open_date").val("");
    $("#edagent_close_date").val("");
    $("#edagent_open_time").val("");
    $("#edagent_close_time").val("");
    $("#edagent_address").val("");
    $("#edagent_gmap").val("");
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
        "&edposter_image=" +
        $("#edposter_image").val() +
        "&edcontact_phone=" +
        $("#edcontact_phone").val() +
        "&edcontact_email=" +
        $("#edcontact_email").val() +
        "&edagent_open_date=" +
        $("#edagent_open_date").val() +
        "&edagent_close_date=" +
        $("#edagent_close_date").val() +
        "&edagent_open_time=" +
        $("#edagent_open_time").val() +
        "&edagent_close_time=" +
        $("#edagent_close_time").val() +
        "&edagent_address=" +
        $("#edagent_address").val() +
        "&edagent_gmap=" +
        $("#edagent_gmap").val(),
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