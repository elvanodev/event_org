$(document).ready(function () {  
    validateform();
});

function onchangeshipper_id() {      
    $.ajax({
        url: getBaseURL() + "index.php/ctrshippers/editrecshippers/",
        data: "edidx=" + $("#shipper_id").val(),
        cache: false,
        dataType: "json",
        type: "POST",
        success: function (json) {
            var shipper_price = json.shipper_price;
            var coupon_price = removecurrencyformat($("#coupon_price").val());
            var total_price = Number(shipper_price) + Number(coupon_price);
            $("#total_price").val(total_price);
            formatCurrency($("#total_price"));
        },
        error: function (xmlHttpRequest, textStatus, errorThrown) {
            console.log("Error:", xmlHttpRequest.responseText);
            alert("Error juga " + xmlHttpRequest.responseText);
        },
    });
}