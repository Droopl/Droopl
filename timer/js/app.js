$(function () {

    var sentences = ["We innovate the way you will consume tomorrow","Wij innoveren de manier waarop u morgen consumeert","Nous innovons la manière dont vous consommez demain"];
    var id = 0;

    var slideShow;

	var end = new Date('12/01/2015 00:01 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

	function init () {

        console.log("init");

        $("#subscribe").on("submit",function(e){
            console.log("Submitting")
            e.preventDefault();

            console.log();

            $.ajax({
              type: "POST",
              url: "http://droopl.com/api/subscribe",
              data: $(this).serialize(),
              success: function (data) {
                $("#subscribe").animate({"opacity": 0}, function(){
                    $("#subscribe").animate({width:'toggle'},600);
                });
                $("article.countdown footer div.container p").animate({"opacity": 0}, function(){
                    $("article.countdown footer div.container p").animate({width:'toggle'},600);
                });
              }
            });

        }); 

        setQuote();
        showRemaining();
        slideShow = setInterval(nextSlide,5000);
	    timer = setInterval(showRemaining, 1000);

        var time = 1000;
        $(".timer ul li").each(function (key,val) {

            setTimeout(function() {
                $(val).addClass("animated fadeInUp");
            }, time);
            
            time += 200;
        });


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


        var day = days;
        if(days < 10){
            day = "0"+days;
        }

        $("section.timer ul li#days p").html(day);


        var hour = hours;
        if(hours < 10){
            hour = "0"+hours;
        }

        $("section.timer ul li#hours p").html(hour);

        var min = minutes;
        if(minutes < 10){
            min = "0"+minutes;
        }

        $("section.timer ul li#minutes p").html(min);

         var sec = seconds;
        if(seconds < 10){
            sec = "0"+seconds;
        }

        $("section.timer ul li#seconds p").html(sec);

        
       
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