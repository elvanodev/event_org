function getcoupon(qr_code) {
  $.ajax({
    url: getBaseURL() + "index.php/ctrcoupons/detailcouponbyqr/",
    data: "edqr_code=" + qr_code,
    cache: false,
    dataType: "json",
    type: "POST",
    success: function (json) {
      console.log("QR DEBUG", "GET QR CODE", json);
      if (json.coupon_id != 0) {
        $("#qrnotfound").addClass('d-none');
        $("#edcoupon_id").val(json.coupon_id);
        $("#edcoupon_number").val(json.coupon_number);
        $("#edevent_name").val(json.event_name);
        $("#edmember_name").val(json.member_name);
      } else {       
        $("#qrnotfound").removeClass('d-none'); 
        $("#edcoupon_id").val("");
        $("#edcoupon_number").val("");
        $("#edevent_name").val("");
        $("#edmember_name").val("");
      }
    },
    error: function (xmlHttpRequest, textStatus, errorThrown) {
      alert("Error juga " + xmlHttpRequest.responseText);
    },
  });
}
$(document).ready(function () {
  validateform();
  $("#edtestimoni_photo").myupload();
  $("#edqr_code").on('keyup', function () {
    $("#qrnotfound").addClass('d-none');    
    console.log("QR DEBUG", "ONCHANGE QR CODE", $(this).val());
    getcoupon($(this).val());
  });
  let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
  html5QrcodeScanner.render(onScanSuccess, onScanFailure);
});

function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
  $("#edqr_code").val(decodedText);
  getcoupon(decodedText);
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

