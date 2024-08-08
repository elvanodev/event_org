$(document).ready(function(){
    $('#testimonialCardOpen').click(function (e) { 
        e.preventDefault();
        $('#testimonialCard').removeClass('d-none');
        $('#testimonialButton').addClass('d-none');
    });    
    $('#testimonialCardClose').click(function (e) { 
        e.preventDefault();
        $('#testimonialCard').addClass('d-none');
        $('#testimonialButton').removeClass('d-none');
    });
});

function getEditiondatetimestart() {
    var countDownDate = new Date($("#editionstartdate").val()).getTime();
    // console.log($("#editionstartdate").val());
    var x = setInterval(function() {

        var now = new Date().getTime();
    
        var distance = countDownDate - now;
    
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
        document.getElementById("cdDay").innerHTML = days;
        document.getElementById("cdHour").innerHTML = hours;
        document.getElementById("cdMinute").innerHTML = minutes;
        document.getElementById("cdSecond").innerHTML = seconds;
    
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("cdDay").innerHTML = '00';
            document.getElementById("cdHour").innerHTML = '00';
            document.getElementById("cdMinute").innerHTML = '00';
            document.getElementById("cdSecond").innerHTML = '00';
        }
    }, 1000);
}