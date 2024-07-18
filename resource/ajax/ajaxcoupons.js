function dosearchcoupons(xAwal) {
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
      url: getBaseURL() + "index.php/ctrcoupons/searchcoupons/",
      data: "xAwal=" + xAwal + "&xSearch=" + xSearch,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#tabledatacoupons").html(json.tabledatacoupons);
        $("#edSearch").val(xSearch);
        $("#edHalaman").html(json.halaman);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga" + xmlHttpRequest.responseText);
      },
    });
  });
}

function doeditcoupons(edidx) {
  $(document).ready(function () {
    formshow();
    $.ajax({
      url: getBaseURL() + "index.php/ctrcoupons/editreccoupons/",
      data: "edidx=" + edidx,
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edidx").val(json.idx);
        $("#edevent_id").val(json.event_id);
        $("#ededition_id").val(json.edition_id);
        $("#edcoupon_number").val(json.coupon_number);
        $("#edqr_code").val(json.qr_code);
        $("#edcoupon_price").val(json.coupon_price);
        $("#edshipper_price").val(json.shipper_price);
        $("#edtotal_price").val(json.total_price);
        $("#edcoupon_price_v").val(json.coupon_price);
        $("#edshipper_price_v").val(json.shipper_price);
        $("#edtotal_price_v").val(json.total_price);
        $("#edis_winner").val(json.is_winner);
        $("#edpayment_status_id").val(json.payment_status_id);
        $("#edpayment_confirm_receipt").val(json.payment_confirm_receipt);
        $("#edvalid_until").val(json.valid_until);
        $("#edregistration_id").val(json.registration_id);
        $("#edmember_name").val(json.member_name);
        $("#edpayment_unique_id").val(json.payment_unique_id);
        formatCurrency($("#edcoupon_price_v"));
        formatCurrency($("#edshipper_price_v"));
        formatCurrency($("#edtotal_price_v"));
        onchangeeventid();
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  });
}

function doClearcoupons() {
  $(document).ready(function () {
    formshow();
    $("#edidx").val("0");
    $("#ededition_id").val("");
    $("#edcoupon_number").val("000");
    $("#edqr_code").val("");
    $("#edcoupon_price").val("");
    $("#edshipper_price").val("");
    $("#edtotal_price").val("");
    $("#edis_winner").val("");
    $("#edpayment_status_id").val("");
    $("#edpayment_confirm_receipt").val("");
    $("#edvalid_until").val("");
    $("#edregistration_id").val("");
    $("#edmember_name").val("");
    $("#edpayment_unique_id").val("");
  });
}

function dosimpancoupons() {
  $(document).ready(function () {
    var isvalid = true;
    var message = "";
    if (($("#edcoupon_number").val().length < 3)) {
      isvalid = false;
      message = "Minimum coupon number lengt is 3!";
    }
    if (isvalid) {
      var edcoupon_price = removecurrencyformat($("#edcoupon_price").val());
      var edshipper_price = removecurrencyformat($("#edshipper_price").val());
      var edtotal_price = removecurrencyformat($("#edtotal_price").val());
      $.ajax({
        url: getBaseURL() + "index.php/ctrcoupons/simpancoupons/",
        data:
          "edidx=" +
          $("#edidx").val() +
          "&ededition_id=" +
          $("#ededition_id").val() +
          "&edcoupon_number=" +
          $("#edcoupon_number").val() +
          "&edqr_code=" +
          $("#edqr_code").val() +
          "&edcoupon_price=" +
          edcoupon_price +
          "&edshipper_price=" +
          edshipper_price +
          "&edtotal_price=" +
          edtotal_price +
          "&edis_winner=" +
          $("#edis_winner").val() +
          "&edpayment_status_id=" +
          $("#edpayment_status_id").val() +
          "&edpayment_confirm_receipt=" +
          $("#edpayment_confirm_receipt").val() +
          "&edvalid_until=" +
          $("#edvalid_until").val() +
          "&edregistration_id=" +
          $("#edregistration_id").val() +
          "&edmember_name=" +
          $("#edmember_name").val() +
          "&edpayment_unique_id=" +
          $("#edpayment_unique_id").val() +
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
        success: function (response) {
          doClearcoupons();
          dosearchcoupons("-99");
          toastr.clear();
          if (response.success == "1") {
            toastr.success("Data berhasil disimpan");
          } else {
            toastr.warning(response.message);
          }
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    } else {
      toastr.clear();
      toastr.warning(message);
    }
  });
}

function dohapuscoupons(edidx) {
  if (confirm("Anda yakin Akan menghapus data ?")) {
    $(document).ready(function () {
      $.ajax({
        url: getBaseURL() + "index.php/ctrcoupons/deletetablecoupons/",
        data: "edidx=" + edidx,
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
          doClearcoupons();
          dosearchcoupons("-99");
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
          alert("Error juga " + xmlHttpRequest.responseText);
        },
      });
    });
  }
}

dosearchcoupons(0);
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
  $("#edpayment_confirm_receipt").myupload();
  onchangeeventid();
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
      onchangeeditionid();
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      console.log("onchangeeventid:", xmlHttpRequest.responseText);
      alert("Error juga " + xmlHttpRequest.responseText);
    },
  });
}

function onchangeeditionid() {
  if ($("#ededition_id").val()) {
    $.ajax({
      url:
        getBaseURL() +
        "index.php/ctrregistrations/getregistrationslistbyedition/",
      data: "ededition_id=" + $("#ededition_id").val(),
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edregistration_id").html("");
        $("#edregistration_id").html(json.option);
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
    $.ajax({
      url: getBaseURL() + "index.php/ctreditions/editreceditions/",
      data: "edidx=" + $("#ededition_id").val(),
      cache: false,
      dataType: "json",
      type: "POST",
      success: function (json) {
        $("#edcoupon_price").val(json.coupon_price);
        $("#edcoupon_price_v").val(json.coupon_price);
        formatCurrency($("#edcoupon_price_v"));
      },
      error: function (xmlHttpRequest, textStatus, errorThrown) {
        alert("Error juga " + xmlHttpRequest.responseText);
      },
    });
  }
}

function onchangeshipperid() {
  $.ajax({
    url: getBaseURL() + "index.php/ctrshippers/editrecshippers/",
    data: "edidx=" + $("#edshipper_id").val(),
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {
      $("#edshipper_price").val(json.shipper_price);
      $("#edshipper_price_v").val(json.shipper_price);
      formatCurrency($("#edshipper_price_v"));
      var coupon_price = $("#edcoupon_price").val();
      var shipper_price = $("#edshipper_price").val();
      var total_price = Number(coupon_price) + Number(shipper_price);
      $("#edtotal_price").val(total_price);
      $("#edtotal_price_v").val(total_price);
      formatCurrency($("#edtotal_price_v"));
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      alert("Error juga " + xmlHttpRequest.responseText);
    },
  });
}
