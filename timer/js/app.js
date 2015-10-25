$(function () {

    var sentences = ["Nous innovons la manière dont vous consommez demain","Wij innoveren de manier waarop u morgen consumeert","We innovate the way you consume tommorow"];
    var id = 0;

    var slideShow;

	var end = new Date('12/01/2015 00:01 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

	function init () {

        showRemaining();
        slideShow = setInterval(nextSlide,5000);
	    timer = setInterval(showRemaining, 1000);


	}
    function prevSlide () {
        id--;
        setQuote();
        
    }

    function nextSlide () {
        id++;
        setQuote();
    }

    function setQuote () {

        if(id > sentences.length-1){
            id = 0;
        }

        if(id < 0){
            id = sentences.length-1;
        }

        $("#quote").removeClass("animated fadeIn");
        $("#quote").addClass("animated fadeOut");
        setTimeout(function () {
            $("#quote").html(sentences[id]);
            $("#quote").removeClass("animated fadeOut");
            $("#quote").addClass("animated fadeIn");
        },1000);

        $(".indicators li").removeClass("selected");

        var li = $(".indicators li").get(id);
        $(li).addClass("selected");
    }

	function showRemaining() {

        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        var dayCruve = 630 - (days/40*100)*6.3;


        var day = days;
        if(days < 10){
            day = "0"+days;
        }

        $("section.timer ul li#days").attr("data-name",day+" D");
        $("section.timer ul li#days path").attr("stroke-dashoffset",dayCruve);

        var hourCruve = 630 - (hours/24*100)*6.3;

        var hour = hours;
        if(hours < 10){
            hour = "0"+hours;
        }

        $("section.timer ul li#hours").attr("data-name",hour+" H");
        $("section.timer ul li#hours path").attr("stroke-dashoffset",hourCruve);

        var min = minutes;
        if(minutes < 10){
            min = "0"+minutes;
        }

        var minCruve = 630 - (minutes/60*100)*6.3;

        $("section.timer ul li#minutes").attr("data-name",min+" M");
        $("section.timer ul li#minutes path").attr("stroke-dashoffset",minCruve);

         var sec = seconds;
        if(seconds < 10){
            sec = "0"+seconds;
        }
        var secCruve = 630 - (seconds/60*100)*6.3;

        $("section.timer ul li#seconds").attr("data-name",sec+" S");
        $("section.timer ul li#seconds path").attr("stroke-dashoffset",secCruve);

        
       
    }


    document.addEventListener('touchstart', handleTouchStart, false);        
    document.addEventListener('touchmove', handleTouchMove, false);

    var xDown = null;                                                        
    var yDown = null;                                                        

    function handleTouchStart(evt) {                                         
        xDown = evt.touches[0].clientX;                                      
        yDown = evt.touches[0].clientY;                                      
    };                                                

    function handleTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;                                    
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
            if ( xDiff > 0 ) {
                nextSlide();
               resetSlideshow();
            } else {
                prevSlide();
                
               resetSlideshow();
            }                       
        } else {
            if ( yDiff > 0 ) {
                /* up swipe */ 
            } else { 
                /* down swipe */
            }                                                                 
        }
        /* reset values */
        xDown = null;
        yDown = null;                                             
    };




	init();


    function resetSlideshow () {
         clearInterval(slideShow);
         slideShow = setInterval(nextSlide,5000);
    }
	
});