function dosearchdermawan(xAwal) {
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
      url: getBaseURL() + "index.php/ctrdermawan/searchdermawan/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledatadermawan").html(json.tabledatadermawan);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditdermawan(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrdermawan/editrecdermawan/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#edevent_id").val(json.event_id);
        $("#edname").val(json.name);
        $("#edquote").val(json.quote);
        $("#ednominal").val(json.nominal);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doCleardermawan() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#edevent_id").val("");
    $("#edname").val("");
    $("#edquote").val("");
    $("#ednominal").val("");
  });
}

function dosimpandermawan() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrdermawan/simpandermawan/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&edevent_id=" +
        $("#edevent_id").val() +
        "&edname=" +
        $("#edname").val() +
        "&edquote=" +
        $("#edquote").val() +
        "&ednominal=" +
        $("#ednominal").val(),
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
      success: function (response) {
        doCleardermawan();
        dosearchdermawan("-99");
        toastr.clear();
        // console.log("MYDEBUG", response);
        if (response.error === true) {
          toastr.error("Satu event hanya bisa 1 dermawan");
        } else {
          toastr.success("Data berhasil disimpan");
        }
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function dohapusdermawan(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctrdermawan/deletetabledermawan/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doCleardermawan();
          dosearchdermawan("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchdermawan(0);
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