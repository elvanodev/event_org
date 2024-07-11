function dosearchcollabolators(xAwal) {
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
      url: getBaseURL() + "index.php/ctrcollabolators/searchcollabolators/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledatacollabolators").html(json.tabledatacollabolators);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditcollabolators(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrcollabolators/editreccollabolators/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#ededition_id").val(json.edition_id);
        $("#edartist_id").val(json.artist_id);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doClearcollabolators() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#ededition_id").val("");
    $("#edartist_id").val("");
  });
}

function dosimpancollabolators() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrcollabolators/simpancollabolators/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&ededition_id=" +
        $("#ededition_id").val() +
        "&edartist_id=" +
        $("#edartist_id").val() +
        "&edcreated_at=" +
        $("#edcreated_at").val(),
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
        doClearcollabolators();
        dosearchcollabolators("-99");
        toastr.clear();
        toastr.success("Data berhasil disimpan");
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function dohapuscollabolators(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url:
          getBaseURL() + "index.php/ctrcollabolators/deletetablecollabolators/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doClearcollabolators();
          dosearchcollabolators("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchcollabolators(0);
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
