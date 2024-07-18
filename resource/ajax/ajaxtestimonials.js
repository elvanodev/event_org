function dosearchtestimonials(xAwal) {
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
      url: getBaseURL() + "index.php/ctrtestimonials/searchtestimonials/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledatatestimonials").html(json.tabledatatestimonials);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doedittestimonials(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrtestimonials/editrectestimonials/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#edcoupon_id").val(json.coupon_id);
        $("#edcoupon_number").val(json.coupon_number);
        $("#edevent_name").val(json.event_name);
        $("#edmember_name").val(json.member_name);
        $("#edtestimoni_text").val(json.testimoni_text);
        $("#edtestimoni_photo").val(json.testimoni_photo);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doCleartestimonials() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#edcoupon_id").val("");
    $("#edcoupon_number").val("");
    $("#edevent_name").val("");
    $("#edmember_name").val("");
    $("#edtestimoni_text").val("");
    $("#edtestimoni_photo").val("");
  });
}

function dosimpantestimonials() {
  $(document).ready(function () {
    $.ajax({
      url: getBaseURL() + "index.php/ctrtestimonials/simpantestimonials/",
      data:
        "edidx=" +
        $("#edidx").val() +
        "&edcoupon_id=" +
        $("#edcoupon_id").val() +
        "&edcoupon_number=" +
        $("#edcoupon_number").val() +
        "&edevent_name=" +
        $("#edevent_name").val() +
        "&edmember_name=" +
        $("#edmember_name").val() +
        "&edtestimoni_text=" +
        $("#edtestimoni_text").val() +
        "&edtestimoni_photo=" +
        $("#edtestimoni_photo").val(),
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
        doCleartestimonials();
        dosearchtestimonials("-99");
        toastr.clear();
        toastr.success("Data berhasil disimpan");
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        console.log("Error juga " + xmlHttpRequest.responseText);
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function dohapustestimonials(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url:
          getBaseURL() + "index.php/ctrtestimonials/deletetabletestimonials/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doCleartestimonials();
          dosearchtestimonials("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchtestimonials(0);
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

function onchangecoupon_number(edition_id) {
  $.ajax({
    url: getBaseURL() + "index.php/ctrcoupons/detailcouponbynumber/",
    data: "edcoupon_number=" + $("#edcoupon_number").val() + "&ededition_id=" + edition_id,
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {
      if (json.coupon_id != 0) {
        $("#edcoupon_id").val(json.coupon_id);
        $("#edevent_name").val(json.event_name);
        $("#edmember_name").val(json.member_name);
        $("#edevent_name_v").val(json.event_name);
        $("#edmember_name_v").val(json.member_name);
      } else {        
        $("#edcoupon_id").val("");
        $("#edevent_name").val("");
        $("#edmember_name").val("");
        $("#edevent_name_v").val("");
        $("#edmember_name_v").val("");
      }
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      alert("Error juga " + xmlHttpRequest.responseText);
    },
  });
}

$(document).ready(function () {
  $("#edtestimoni_photo").myupload();
  let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});

function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
  
  var decodedqr = decodeqrnumber(decodedText);
  console.log(decodedqr);

  $("#edcoupon_number").val(decodedqr.qr_number);
  onchangecoupon_number(decodedqr.edition_id);
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

