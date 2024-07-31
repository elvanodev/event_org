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