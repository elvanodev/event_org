$(document).ready( function () {
    $(".background-mask").hover( function () {
        $(this).removeClass('mask-surround');
        var doorprizeid = $(this).data('id');
        $("#artDetail_"+doorprizeid).removeClass("d-none");
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#artDetail_"+doorprizeid).offset().top - 50
        }, 500);
        // console.log("HOVER");
    }, function () {
        $(this).addClass('mask-surround');
        // console.log("HOVER OFF");
    });
});
function onclickartdetailclose(doorprizeid) {
    $("#artDetail_"+doorprizeid).addClass("d-none");
    $("#artMask_"+doorprizeid).show();
}