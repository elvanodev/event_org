function dosearchdoorprize(xAwal) {
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
      url: getBaseURL() + "index.php/ctrdoorprize/searchdoorprize/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledatadoorprize").html(json.tabledatadoorprize);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditdoorprize(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrdoorprize/editrecdoorprize/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        // console.log(json);
        $("#edidx").val(json.idx);
        $("#edevent_id").val(json.event_id);
        $("#edis_primary_doorprize").val(json.is_primary_doorprize);
        // $("#edartist_id").multiSelect('select',json.artist_id);
        $.each(json.artist_id.split(","), function(i,e){
          console.log(e);
            $("#edartist_id option[value='" + e + "']").prop("selected", true);
        });
        $("#eddimension").val(json.dimension);
        $("#edtitle").val(json.title);
        $("#edmedia").val(json.media);
        $("#edyear").val(json.year);
        $("#edimage_art").val(json.image_art);
        $("#eddescription").val(json.description);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doCleardoorprize() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#edevent_id").val("");
    $("#edis_primary_doorprize").val("0");
    $("#edartist_id").multiSelect("");
    $("#eddimension").val("");
    $("#edtitle").val("");
    $("#edmedia").val("");
    $("#edyear").val("");
    $("#edimage_art").val("");
    $("#eddescription").val("");
  });
}

function dosimpandoorprize() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrdoorprize/simpandoorprize/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&edevent_id=" +
        $("#edevent_id").val() +
        "&edis_primary_doorprize=" +
        $("#edis_primary_doorprize").val() +
        "&edartist_id=" +
        $("#edartist_id").val() +
        "&eddimension=" +
        $("#eddimension").val() +
        "&edtitle=" +
        $("#edtitle").val() +
        "&edmedia=" +
        $("#edmedia").val() +
        "&edyear=" +
        $("#edyear").val() +
        "&edimage_art=" +
        $("#edimage_art").val() +
        "&eddescription=" +
        $("#eddescription").val(),
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
        doCleardoorprize();
        dosearchdoorprize("-99");
        toastr.clear();
        // console.log("MYDEBUG", response);
        if (response.error === true) {
          toastr.error("Satu event hanya bisa 1 Doorprize");
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

function dohapusdoorprize(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctrdoorprize/deletetabledoorprize/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doCleardoorprize();
          dosearchdoorprize("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchdoorprize(0);
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
  $("#edimage_art").myupload();
  $('#edartist_id').multiSelect();
});
