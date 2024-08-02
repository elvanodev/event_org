$(document).ready( function () {
    $(".background-mask").hover( function () {
        $(this).hide();
        $("#artDetail").removeClass("d-none");
        console.log("HOVER");
    }, function () {
        console.log("HOVER OFF");
    });    
    $("#artDetailClose").click(function (e) { 
        e.preventDefault();
        $("#artDetail").addClass("d-none");
        $(".background-mask").show();
    });
});