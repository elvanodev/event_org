function dosearchregistrations(xAwal) {
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
      url: getBaseURL() + "index.php/ctrregistrations/searchregistrations/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledataregistrations").html(json.tabledataregistrations);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditregistrations(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrregistrations/editrecregistrations/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#ededition_id").val(json.edition_id);
        $("#edmember_id").val(json.member_id);
        $("#edregistered_at").val(json.registered_at);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doClearregistrations() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#ededition_id").val("");
    $("#edmember_id").val("");
    $("#edregistered_at").val("");
  });
}

function dosimpanregistrations() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrregistrations/simpanregistrations/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&ededition_id=" +
        $("#ededition_id").val() +
        "&edmember_id=" +
        $("#edmember_id").val() +
        "&edregistered_at=" +
        $("#edregistered_at").val(),
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
        doClearregistrations();
        dosearchregistrations("-99");
        toastr.clear();
        toastr.success("Data berhasil disimpan");
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        // alert("Error juga " + xmlHttpRequest.responseText);
        console.log("Error", xmlHttpRequest.responseText);
      },
    });
  });
}

function dohapusregistrations(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url:
          getBaseURL() + "index.php/ctrregistrations/deletetableregistrations/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doClearregistrations();
          dosearchregistrations("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchregistrations(0);
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

function onchangeeventid() {
  $.ajax({
    url: getBaseURL() + "index.php/ctreditions/geteditionslistbyevent/",
    data: "edevent_id=" + $("#edevent_id").val(),
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
