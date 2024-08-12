function dosearchgalleries(xAwal) {
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
      url: getBaseURL() + "index.php/ctrgalleries/searchgalleries/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledatagalleries").html(json.tabledatagalleries);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditgalleries(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrgalleries/editrecgalleries/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#edevent_id").val(json.event_id);
        $("#ededition_id").val(json.edition_id);
        $("#edimage_title").val(json.image_title);
        $("#edimage_link").val(json.image_link);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doCleargalleries() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#edevent_id").val("");
    $("#ededition_id").val("0");
    $("#edimage_title").val("");
    $("#edimage_link").val("");
  });
}

function dosimpangalleries() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrgalleries/simpangalleries/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&edevent_id=" +
        $("#edevent_id").val() +
        "&ededition_id=" +
        $("#ededition_id").val() +
        "&edimage_title=" +
        $("#edimage_title").val() +
        "&edimage_link=" +
        $("#edimage_link").val(),
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
        doCleargalleries();
        dosearchgalleries("-99");
        toastr.clear();
        // console.log("MYDEBUG", response);
        if (response.error === true) {
          toastr.error("Satu event hanya bisa 1 galleries");
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

function dohapusgalleries(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctrgalleries/deletetablegalleries/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doCleargalleries();
          dosearchgalleries("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchgalleries(0);
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
  $("#edimage_link").myupload();
});

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