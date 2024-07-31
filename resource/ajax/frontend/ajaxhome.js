$(document).ready(function(){
    var cardOpen = false;
    $('#testimonialCardOpen').click(function (e) { 
        e.preventDefault();
        if (cardOpen) {
            $('#testimonialCard').animate({            
                opacity: '0',
                width: '5%',
                height: '5%',
                right: '-91%',
                top: '-2%',
                fontSize: '1px',
            }, 1000);
            cardOpen = false;
        } else {
            $('#testimonialCard').animate({            
                opacity: '1',
                width: '100%',
                height: '100%',
                right: 0,
                top: 0,
                fontSize: '16px',
            }, 1000);
            cardOpen = true;
        }
    });
});

function getEditiondatetimestart() {
    var countDownDate = new Date($("#editionstartdate").val()).getTime();
    console.log($("#editionstartdate").val());
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