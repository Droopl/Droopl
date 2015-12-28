$(function () {

    var sentences = ["We innovate the way you will consume tomorrow","Wij innoveren de manier waarop u morgen consumeert","Nous innovons la manière dont vous consommez demain"];
    var id = 0;

    var slideShow;

	var end = new Date('01/08/2016 00:01 AM');

    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

	function init () {


        $("article.message section.add-collection-item #message").on("keyup",function (e) {
            if($(this).val().length > 100){
                e.preventDefault();
            }
            $("#charactercount").html((100 - $(this).val().length)+ " characters left");
        });

        $("article.message section.add-collection-item span.close-add").on("click",leaveMessage);
        $("article.message section.add-collection-item #add_message").submit(function (e) {


            e.preventDefault();
            var errors = false;

            if($("#quote_img").val().length < 1){
                errors = true;
                $("#quote_img").parent().parent().css('border', '1px solid #f47d67');
            }else{
                $("#quote_img").parent().parent().css('border', 'none');
            }
            if($("#naam").val().length < 1){
                errors = true;
                $("#naam").removeClass("correct");
                $("#naam").addClass("wrong");
            }else{
                $("#naam").removeClass("wrong");
                $("#naam").addClass("correct");
            }
            if($("#email").val().length < 1){
                errors = true;
                $("#email").removeClass("correct");
                $("#email").addClass("wrong");
            }else{
                $("#email").removeClass("wrong");
                $("#email").addClass("correct");
            }
            if($("#message").val().length < 1){
                errors = true;
                $("#message").removeClass("correct");
                $("#message").addClass("wrong");
            }else{
                $("#message").removeClass("wrong");
                $("#message").addClass("correct");
            }

            if(!errors){

                var url = "http://droopl.com/api/subscribe"; // the script where you handle the form input.
    			var formData = new FormData($(this)[0]);
    			formData.append("quote_img", $("#quote_img")[0].files[0]);
                $("#add_item").attr("type","button").val("Receiving your love ...");
    			jQuery.ajax({
    			    url: url,
    			    data: formData,
    			    cache: false,
    			    contentType: false,
    			    processData: false,
    			    type: 'POST',
    			    success: function(data){
                        $("#add_item").attr("type","submit").val("Send us some love");
                        leaveMessage();
                        loadQuotes();
    			    }
    			});

            }



        });

        $("div.container a.message").on("click",function(e){

            e.preventDefault();

            leaveMessage();

            /*$.ajax({
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
          });*/

        });

        setQuote();
        loadQuotes();
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
    function loadQuotes() {
        $("ul.quotes").html("");
        $.get( "http://droopl.com/api/subscribers", function( data ) {
            if(data.length !== 0){
                $(data).each(function (key,val) {
                    $("<li/>").html("<li><div class='wrapper delay"+(Math.floor(Math.random() * 3) + 1) +"' style='background-image:url(http://droopl.com/profiles/"+val.url+")'></div><span>"+val.message+"</span></li>").appendTo("ul.quotes");
                });
            }else if(data.length == 1){
                $("#message_header").html("This person has left us a message");
                $("#message_sub_header").html("Be the second and leave us a message");
            }else{
                $("#message_header").html("No one has left us a message yet");
                $("#message_sub_header").html("Be the first and leave us a message");
            }

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
    }

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
    }




	init();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).parent().parent().css('background-image','url('+e.target.result+')');
                $(input).parent().parent().css('background-position', 'center');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function handleFileUpload(files,obj){

      var reader = new FileReader();
      reader.readAsDataURL(files[0]);
      reader.onload = function (e) {

          obj.parent().parent().css('background-image','url('+e.target.result+')');
          obj.parent().parent().css('background-position', 'center');

      };
      
    }

    function leaveMessage() {

        if($("article.message").hasClass("show")){

            $("article.message").removeClass("show");
            $("article.message").removeClass("animated fadeIn");

            $("article.message input[type='text']").val("");
            $("article.message input[type='file']").val("");

        }else {
            $("article.message").addClass("show");
            $("article.message").addClass("animated fadeIn");

            dragAndDrop();

        }

    }

    function dragAndDrop() {

        var obj = $("#dragndrop input[type='file']");
        obj.on('dragenter', function (e)
        {
            e.preventDefault();
            $(this).parent().parent().css('border', '3px solid #E8E8EA');
            $(this).parent().parent().css('background-position', 'center -140px');
        });
        obj.on('dragover', function (e)
        {
        });
        obj.on('dragleave', function (e)
        {
             $(this).parent().parent().css('border', '1px solid #E8E8EA');
            $(this).parent().parent().css('background-position', 'center 0px');

        });
        obj.on('drop', function (e)
        {
             $(this).parent().parent().css('border', 'none');
        });
        obj.change(function ()
        {
             var files = this;
             readURL(files);
        });
    }


    function resetSlideshow () {
         clearInterval(slideShow);
         slideShow = setInterval(nextSlide,5000);
    }


});
