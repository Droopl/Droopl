$(function(){

    var typing = false;
    var saveVal = "";
    var openConversations = [];
    var part = 1;
    var notificationCount = 0;
    var messagesCount = 0;
    var oldMessageCount = 0;
    var titleBarCount = 0;
    var menuMessage = $("#menu_messages").html();

     checkNotification();
     checkMessages();

    $("#menu .profile ul li a.icon-cog").bind("click",openSettings);

    $("article.verification ul.code-ul li input[type='text']").on("keyup",function(){

        if($(this).val()){
            $(this).addClass("filled");
            $(this).parent().next().find("input[type='text']").select();
        }
    });

    if($("article div.messages section.messages aside ul li.notseen").length){


      $("article div.messages section.messages aside ul li.notseen").each(function () {

        var id = $(this).attr("id");
        $.get( "?page=messages&action=seen&messageid="+id, function( data ) {

        });
      });

    }


    setInterval(function () {

       if($("#menu .notifications ul.show").length === 0){
          $("#menu .notifications ul").load("index.php?page=feed .notifications ul li");

          checkNotification();
          checkMessages();

       }

        /*if($("article aside#side section.activity ul.progress").length){

                var newActivityLis = $("<div/>");
                newActivityLis.load("index.php?page=feed article aside#side section.activity ul.progress li");
                console.log(newActivityLis);
                $.each(newActivityLis.find("li"),function(key,val){
                    var activityLi = $(val);
                    console.log(activityLi);
                    var dashOffset = activityLi.find("path#count").attr("stroke-dashoffset");
                    //console.log(dashOffset);
                });

        }*/


        if($("section.chat ul li.conversation-bubble div.conversation").length){


      if($("section.chat ul li.conversation-bubble div.conversation.open ul li.notseen").length){

        $("section.chat ul li.conversation-bubble div.conversation.open ul li.notseen").each(function () {

          var id = $(this).attr("id");
          $.get( "?page=messages&action=seen&messageid="+id, function( data ) {

          });
        });

      }




      $("section.chat ul li.conversation-bubble div.conversation").each(function () {

        if($(this).hasClass("open")){

          var conversation = $(this);
          var id = $(this).attr("id");
          var url = "?page=messages&id="+id;
           $.ajax({
                 type: "GET",
                 url: url,
                 success: function(data)
                 {

                        var messages = conversation.find("ul li");
                        var loadedMessages = $(data).find("div.messages section.messages aside ul li");

                       $(loadedMessages).each(function(key,newMessages){

                           var found = false;

                           $(messages).each(function(id,message){

                               if($(newMessages).attr("id") == $(message).attr("id")){
                                    found = true;
                               }

                           });

                           if(!found){
                            var ul = conversation.find("ul");
                            ul.removeClass("loading");
                            ul.append($(newMessages).addClass("animated slideInUp"));

                            ul.stop().animate({
                              scrollTop: ul[0].scrollHeight
                            }, {
                              duration:1500,
                            });

                           }
                      });
                    }
                  });

        }else{

          var currentConvo = $(this).parent();

          $.get("?page=add", {}, function(data){
            var loadedConvos = $(data).find(".chat .conversation-bubble");
            loadedConvos.each(function  (key,val) {
              var currentBubble = $(val);

              if(currentConvo.attr("id") == currentBubble.attr("id")){
                //<span class="new-msg animated-slow infinite pulse"></span>
                if(currentBubble.find("span.new-msg").length){

                  if(currentConvo.find("span.new-msg").length){
                  }else{

                    var pulse = $("<span/>").addClass("new-msg animated-slow infinite pulse");
                    currentConvo.append(pulse);
                     $("#sounds").attr("src","sounds/notification.mp3");
                              $("#sounds")[0].play();
                  }
                }
              }

          });


          });
        }
      });




    }


},5000);

    if($("article.feedback").length){
        closeLayerElement($("article.feedback"),false);

        $("article.feedback div.feed section.feedback form").on("submit",function(e){
            e.preventDefault();

            var formData = new FormData($(this)[0]);
            var url = "?page=feedback&action=ajax";
          $.ajax({
                 type: "POST",
                 url: url,
                 data: formData,
                 async: false,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(data){
                    if(data == 1){
                        $("article.feedback div.feed section.feedback  header div").fadeOut(600,function(){
                            $(this).animate({height:0});
                            var lang = $("div.js-language").html();
                            switch(lang){
                                case 'en':
                                $("article.feedback div.feed section.feedback header h1").text("Thanks for your feedback!");
                                break;

                                case 'fr':
                                $("article.feedback div.feed section.feedback header h1").text("Merci pour votre aide précieuse!");
                                break;

                                case 'nl':
                                $("article.feedback div.feed section.feedback header h1").text("Bedankt voor het feedback!");
                                break;

                                default:
                                $("article.feedback div.feed section.feedback header h1").text("Thanks for your feedback!");
                                break;
                            }
                        });
                        setTimeout(function(){
                            $(location).attr("href", "?page=feed");
                        },1400);
                    }
                 }
          });

        });
    }


    if($("article.rating").length){


      var selected = 5;
      var currentSelected = 0;
      var time = 0;
      $("article.rating section footer form input[type='submit']").addClass("animated fadeIn");
      $("article.rating section aside nav ul li").each(function (id,item) {


        setTimeout(function () {

          $(item).css("opacity","1");
          $(item).addClass("animated bounceIn");


        },time);

        time += 200;



      });

      $("article.rating section aside nav ul li").on("mousemove",function (e) {

        var positionMouse = e.pageX - $(this).offset().left;
        var currentLi = $(this);




        if(positionMouse <= currentLi.width()/2){
            if(currentLi.hasClass("full")){
              currentLi.removeClass("full");
            }
            currentLi.addClass("half");
            currentSelected = 0.5;
        }else if(positionMouse >= currentLi.width()/2){
          currentSelected = 1;
          currentLi.attr("class","star full");
        }

        var allLis = currentLi.parent().find("li");

        allLis.each(function (key,val) {

          if(key != currentLi.index()){
            $(val).attr("class","star");
            if (key < currentLi.index()) {
              $(val).addClass("full");

              currentSelected++;

            }
          }

        });

        $("article.rating section aside nav ul li").on("click",function () {
          selected = currentSelected;

        });

      });

      $("article.rating section aside nav ul").on("mouseout",function () {

        var allLis = $(this).find("li");

        allLis.each(function (key,val) {
           $(val).attr("class","star");
          if(key <= currentSelected-1){
            $(val).addClass("full");
          }

        });

      });

      $("article.rating section footer form").on("submit",function (e) {
          //e.preventDefault();
          $("article.rating section footer form input#rating").attr("value",selected);

          /*$.ajax({
            type:"POST",
            url:$(this).attr("action"),
            data:$(this).serialize(),
            success:function (data) {
              console.log(data);
            }
          });*/

      });
    }


    $( '.scrollable' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
        e.preventDefault();
    });


    if($("article.create_community").length){
        closeLayerElement($("article.create_community"),false);
    }

    if( $('article div.messages section.messages aside').length){



      $('article div.messages section.messages aside').stop().animate({
        scrollTop: $("article div.messages section.messages aside")[0].scrollHeight
      }, {
        duration:0,
      });

        $("article div.messages section.messages aside ul li").css("opacity","0");
        var messages = $("article div.messages section.messages aside ul li");
        var animtime = 0;
        $.each(messages,function(key,val){
            var message = $(val);
            setTimeout(function(){
                message.addClass("animated fadeInDown");
            },animtime);
            animtime+=35;
        });

      setInterval(function () {

        var url = $(location).attr("href");
        $.ajax({
        type: "GET",
        url:url,
        success:function (data) {

          /*$.ajax({
            type: "GET",
            url: '?page=messages&update=0',
            success:function (data) {
                console.log("update = 0");
            }
          });*/

          var messages = $("article div.messages section.messages aside ul li.message");
          var loadedMessages = $(data).find("div.messages section.messages aside ul li.message");
          var typing = $(data).find("div.messages section.messages header nav ul li.user");

         $(loadedMessages).each(function(key,newMessages){

               var found = false;

               $(messages).each(function(id,message){

                   if($(newMessages).attr("id") == $(message).attr("id")){
                        found = true;
                   }

               });

               if(!found){
                  $("article div.messages section.messages aside ul").append($(newMessages).addClass("animated slideInUp"));
                  scrollChat();
               }
          });
         $("article div.messages section.messages header nav ul li.user").remove();
         typing.insertBefore("article div.messages section.messages header nav ul li.add");

        }
      });

      },1000);
    }

    if($("article.newconvo section").length){

      $("article.newconvo section #search_people").on("keyup",function (e) {
          $( "article.newconvo section div.search_users ul" ).load( "?page=messages&action=create&search_users="+$(this).val().replace(/\s+/g, '+')+" article.newconvo section div.search_users ul li" ,function (e) {
              $("article.newconvo section div.search_users ul li").on("click",function () {
                $("article.newconvo section div.search_users ul li").removeClass("selected");
                var id = $(this).attr("id");
                $(this).addClass("selected");
                $("article.newconvo section form input[type='text']#user_id").val(id);

              });
          });
      });

      $("article.newconvo section div.search_users ul li").on("click",function () {
        $("article.newconvo section div.search_users ul li").removeClass("selected");
        var id = $(this).attr("id");
        $(this).addClass("selected");

        $("article.newconvo section form input[type='text']#user_id").val(id);

      });

      closeLayerElement($("article.newconvo"),false);

    }

    if($("article div.feed section.post form div.collection").length){

          var scrollTimer;

          $("article div.feed section.post form div.collection").on("mouseover",function (e) {

            var mouseX = e.pageX - $(this).offset().left;
            var xpos = 0;
            var diff = $(this).find('ul').outerWidth() - $(this).outerWidth();

            if(diff < 400){

              if(diff >= 0){

                  var percentage = mouseX/$(this).width();
                  var mX = diff*percentage;
                  var posX = 0;
                  var damp = 150;
                  var $th = $(this).find('ul');
                  $th.css({
                    left: -mX
                  });
              }
          }else{
            console.log("move left");
          }
        });

    }

            dragAndDrop();

            $("div.messages section.messages form textarea").on("keyup",function (e) {

              if($(this).val().length > 0){
                if(!typing){
                  $.ajax({
                    type:"GET",
                    url: '?page=messages&typing=true',
                    success:function (data) {
                      typing = true;
                    }
                  });
                }
              }

              if($(this).val().length <= 0){
                if(typing){
                  $.ajax({
                    type:"GET",
                    url: '?page=messages&typing=false',
                    success:function (data) {
                      typing = false;
                    }
                  });
                }
              }
            });

            $("div.messages section.messages form textarea").on("keydown",function (e) {
              switch(e.keyCode){
                case 13:
                e.preventDefault();
                $(this).parent().submit();
                $("div.messages section.messages form textarea").val("");
                break;
              }
            });
            $("div.messages section.messages form").on("submit",function (e) {

                e.preventDefault();
      var url = $(this).attr("action"); // the script where you handle the form input.

      var formData = new FormData($(this)[0]);

      $.ajax({
             type: "POST",
             url: url,
             data: formData,
             async: false,
            cache: false,
            contentType: false,
            processData: false,
             success: function(data)
             {

                    $("div.messages section.messages form textarea").val("");
                    var messages = $("article div.messages section.messages aside ul li");
                    var loadedMessages = $(data).find("div.messages section.messages aside ul li");

                   $(loadedMessages).each(function(key,newMessages){

                       var found = false;

                       $(messages).each(function(id,message){

                           if($(newMessages).attr("id") == $(message).attr("id")){
                                found = true;
                           }

                       });

                       if(!found){
                        $("article div.messages section.messages aside ul").append($(newMessages).addClass("animated slideInUp"));

                         var objDiv = $("article div.messages section.messages aside");
                        objDiv.scrollTop(objDiv.scrollHeight);
                        $('article div.messages section.messages aside').stop().animate({
                          scrollTop: $("article div.messages section.messages aside")[0].scrollHeight
                        }, {
                          duration:1500,
                        });

                       }
                  });
                }
              });

            });

    function scrollChat () {
      if($("article div.messages section.messages aside")[0].scrollTop + $("article div.messages section.messages aside")[0].scrollHeight > $("article div.messages section.messages aside")[0].scrollHeight - 10){

          var objDiv = $("article div.messages section.messages aside");
          objDiv.scrollTop(objDiv.scrollHeight);
          $('article div.messages section.messages aside').stop().animate({
            scrollTop: $("article div.messages section.messages aside")[0].scrollHeight
          }, {
            duration:1500,
          });

        }
    }


    $("article section.communities #search_communities").bind("keyup",function () {
        $( "article section.communities aside.communities" ).load( "?page=communities&search_full="+$(this).val()+" article section.communities aside.communities section.community");
    });


    $("article div.messages aside.conversations form#search-conversations input[type='text']").bind("keyup",function () {
        $( "article div.messages aside.conversations nav ul" ).load( "?page=messages&search_full="+$(this).val()+" article div.messages aside.conversations nav ul li");
    });


    function handleFileUpload(input){
        var upload = $(input).parent();

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

    			$(input).parent().parent().css({"background-image":"url("+e.target.result+")","background-size":"cover"});
                $(input).parent().parent().css('background-position', 'center');
                var uploadFormData = new FormData($("#add_collection")[0]);
                uploadFormData.append("collection_image",input.files[0]);
            };

            reader.readAsDataURL(input.files[0]);
        }

        /*var upload = $(obj).parent();

        if (obj.files && obj.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

                obj.parent().parent().css('background-image','url('+e.target.result+')');
                obj.parent().parent().css('background-position', 'center');
                console.log(files[0]);
                var uploadFormData = new FormData($("#add_collection")[0]);
                uploadFormData.append("collection_image",files[0]);
                console.log(uploadFormData);
            };

            reader.readAsDataURL(obj.files[0]);
        }*/

      
    }

    $("#search_submit").on("click",function () {

      $(window).on("keyup",function (e) {
        switch(e.keyCode){
          case 27:
          $("article.search").removeClass("show");
          $("article.search form").removeClass("animated fadeInUp");
          break;
        }
      });

      $("article.search form .close").on("click",function  () {


         $("article.search").removeClass("show");
         $( "article.search ul" ).html("");
          $("article.search form").removeClass("animated fadeInUp");
          return false;
      });


      $("article.search").addClass("show");
      $("article.search ul li.preloader").hide();
      $("article.search form").addClass("animated fadeInUp");
      $("article.search form #search_full").val("");
      $("article.search form #search_full").select();

      $("article.search form #search_full").on("keyup",function () {

      $("article.search ul li.quest").remove();
      if($(this).val().length > 0){
        var url = "index.php?page=search&search_full="+$(this).val().replace(/\s+/g, '+'); // the script where you handle the form input.
        $( "article.search ul" ).load( url +" article.search_full ul.search_results");
      }else{
        $( "article.search ul" ).html("");
      }




      });
      var searchQuests = $("article.search li.quest");
      searchQuests.css("opacity", "0");
      searchQuests.each(function (id,val) {

        var quest = $(val);
        setTimeout(function(){
            quest.addClass("animated fadeInUp");
        },time);
        time+=300;

      });
  });

    $("article div.feed section.quest footer a.proposal").bind("click",getDetail);



    $("#side section header nav.stars").bind("click",ratePerson);

    function ratePerson(e) {
        $(this).unbind("click");
        if($("article.rating").length){
            if($("article.rating").hasClass("hide")){
                $("article.rating").removeClass("hide");
                $("#side section header nav.stars").bind("click",ratePerson);
                closeLayerElement($("article.rating"),true);
            }else {
                $("article.rating").addClass("hide");
            }
        }
    }



    $("article aside#side section.quest ul li a").bind("click",getDetail);
    function getDetail(e) {

      e.preventDefault();
      preloader(true);
      var button = $(this);
      button.unbind("click");
      var url = $(this).attr("href");
      $.get( url, function( data ) {

        preloader(false);
        button.bind("click",getDetail);

        var section = $(data).find(".feed");


        $("article.detail").removeClass("hide");
        section.addClass("animated fadeInUpBig").insertAfter("article.detail header.detail");
        $("article.detail div.feed section.quest footer.detail div.search-proposal form input[type='text']").on("focus",focusCollection);

        $("article.detail div.feed section.quest footer div.search-proposal form").on('submit',function (e) {
            e.preventDefault();
            if($("article.detail div.feed section.quest footer.detail div.collection ul li.selected").length){
                var formdata = $(this).serialize();

                $.ajax({
                  type:"POST",
                  url:$(this).attr("action"),
                  data:formdata,
                  success:function (data) {
                    blurCollection();

                    var oldPropos = $("article.detail div.feed section.quest .proposals-list ul .propo");
                    var propos = $(data).find(".proposals-list ul .propo");

                    if(propos.length > oldPropos.length){
                      if($("article.detail div.feed section.quest footer div.proposals-list ul div.no-proposals-container").length){
                          $("article.detail div.feed section.quest footer div.proposals-list ul div.no-proposals-container").remove();
                      }
                      for (var i = oldPropos.length; i < propos.length; i++) {
                        var newPropo = propos[i];
                        $(newPropo).addClass("animated fadeIn").appendTo("article.detail div.feed section.quest .proposals-list ul.list");
                      }

                    }
                  }
                });
            }else{
                focusCollection();
            }
        });

        var container = $("article.detail div.feed section.quest footer.detail div.collection");
        var input = $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']");

        $(document).on('click', function (e) {
            if ($(e.target).closest("article.detail div.feed section.quest footer.detail div.search-collection-container").length === 0) {
                blurCollection();
            }
        });

        $("article.detail div.feed section.quest footer.detail div.collection ul li div.selected").on("click",selectCollectionDetail);
        $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item p").on("click",removeAddedCollectionItem);
        $("article.detail div.feed section.quest footer.detail div.collection").on("mouseover",scrollDetailCollection);

        $("article.detail div.feed section.quest header a.close").on("click",function (e) {

          e.preventDefault();
          $("article.detail").addClass("hide");
          $("article.detail div.feed").remove();

        });

        $(window).on("keyup",function (e) {
            switch(e.keyCode){
              case 27:
               $("article.detail").addClass("hide");
               $("article.detail div.feed").remove();
              break;
            }
        });

      });


    }


    $("article div.feed section.quest header a.collection_item img").on("click",getCollectionDetail);
    $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-menu ul li.edit a").on("click",getCollectionDetail);
    $("article aside#side section.collection ul li img").on("click",getCollectionDetail);
    $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-detail").on("click",getCollectionDetail);

    function getCollectionDetail(e) {
      e.preventDefault();

      preloader(true);

      var id = $(this).attr("id");
      var url = "?page=item&id="+id+"&action=box";
      $.get( url, function( data ) {

        preloader(false);
        var section = $(data).find(".feed");


        $("article.collection_item").removeClass("hide");
        section.addClass("animated fadeInUpBig").insertAfter("article.collection_item header.collection_item");

        $("article.collection_item div.feed section.detail-collection-item form").on("submit",editCollectionItem);

        $("article.collection_item div.feed section.detail-collection-item form aside a.close-collection-detail").on("click",function (e) {

          e.preventDefault();
          $("article.collection_item").addClass("hide");
          $("article.collection_item div.feed").remove();

        });

        $(window).on("keyup",function (e) {
            switch(e.keyCode){
              case 27:
               $("article.collection_item").addClass("hide");
               $("article.collection_item div.feed").remove();
              break;
            }
        });


      });


    }

    function openSettings(e) {
        e.preventDefault();

        preloader(true);

          $.ajax({
                type: "GET",
                url: $(this).attr("href"),
                success: function(data) {

                    preloader(false);

                  var section = $(data).find(".feed");

                  $("<article/>").addClass("settings").html("<header class='hide settings'><h1>settings</h1></header>").insertAfter("article.detail");
                 // section.appendTo("article.settings");
                  section.addClass("animated fadeInUpBig").insertAfter("article.settings header.settings");

                  dragAndDrop();
                  closeLayerElement($("article.settings"),false);



                }
          }).done(function(){

                /* SETTINGS LANG */

                var settingsSwitchBtn = document.getElementById('settings_switch_btn');

                settingsSwitchBtn.addEventListener('touchstart', settingsTouchStart, false);
                settingsSwitchBtn.addEventListener('touchmove', settingsTouchMove, false);

                var xDown = null;
                var yDown = null;



                $("article.settings div.feed section.settings-container aside.right div.select-language div.flag").on("click",function(){
                    if(!$("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list").hasClass("show")){
                        $("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list").addClass("show");
                    }else{
                        $("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list").removeClass("show");
                    }

                    $(document).on('click', function (e) {
                        if ($(e.target).closest("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list").length === 0 && $(e.target).closest("article.settings div.feed section.settings-container aside.right div.select-language div.flag").length === 0) {
                            $("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list").removeClass("show");
                        }
                    });
                });

                $("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list li").on("click",function(){

                    var thisClass = $(this).attr("class");
                    $("article.settings div.feed section.settings-container aside.right div.select-language input#selected_lang").attr("value",thisClass);
                    $("article.settings div.feed section.settings-container aside.right div.select-language div.flag").removeClass("en nl fr");

                    $("article.settings div.feed section.settings-container aside.right div.select-language div.flag").addClass(thisClass);
                    $("article.settings div.feed section.settings-container aside.right div.select-language ul.lang-list").removeClass("show");
                });



                      $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").on("click",function(){
                if($(this).hasClass("male")){
                    $(this).removeClass("male").addClass("female");
                    $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.male").removeClass("selected");
                    $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.female").addClass("selected");
                    $("article.settings div.feed section.settings-container aside.right input[type='text']#gender").attr("value","f");
                }else{
                    $(this).removeClass("female").addClass("male");
                    $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.female").removeClass("selected");
                    $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.male").addClass("selected");
                    $("article.settings div.feed section.settings-container aside.right input[type='text']#gender").attr("value","m");
                }

            });

          });
    }

    function settingsTouchStart(evt) {
        xDown = evt.touches[0].clientX;
        yDown = evt.touches[0].clientY;
    }

    function settingsTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
            if($("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").hasClass("male")){
                $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").removeClass("male").addClass("female");
                $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.male").removeClass("selected");
                $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.female").addClass("selected");
                $("article.settings div.feed section.settings-container aside.right input[type='text']#gender").attr("value","f");
            }else{
                $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").removeClass("female").addClass("male");
                $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.female").removeClass("selected");
                $("article.settings div.feed section.settings-container aside.right div.switch-gender div.switch-container p.male").addClass("selected");
                $("article.settings div.feed section.settings-container aside.right input[type='text']#gender").attr("value","m");
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    }

    function editCollectionItem(e){

        e.preventDefault();

        if($(this).parent().hasClass("editable") && !$("article.collection_item div.feed section.detail-collection-item form header input[type='submit']#edit_item").hasClass("editable")){

            $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").addClass("editable");
            $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Save");
            $("article.collection_item div.feed section.detail-collection-item").addClass("bordered");

            $("article.collection_item div.feed section.detail-collection-item form aside header input[type='text']#item_name").attr("readonly",false);
            $("article.collection_item div.feed section.detail-collection-item form aside textarea#item_description").attr("readonly",false);
            $("article.collection_item div.feed section.detail-collection-item form aside header input[type='text']#item_name").focus();

            $("article.collection_item div.feed section.detail-collection-item form aside div.button-container input[type='button'].privacy-editable").on("click",function(){
                var button = $(this);
                if($(this).attr("value") == "public"){
                    button.attr("value","private");
                    //console.log(button.prev());
                    button.prev().removeClass("public").addClass("private");
                    $(this).next().attr("value","1");
                }else if(button.attr("value") == "private"){
                    button.attr("value","public");
                    button.prev().removeClass("private").addClass("public");
                    $(this).next().attr("value","0");
                }
            });

            $("article.collection_item div.feed section.detail-collection-item form aside div.button-container input[type='button'].availability-editable").on("click",function(){
                var button = $(this);
                if($(this).attr("value") == "available"){
                    $(this).attr("value","not available");
                    //console.log(button.prev());
                    button.prev().removeClass("available").addClass("not-available");
                    $(this).next().attr("value","1");
                }else if($(this).attr("value") == "not available"){
                    $(this).attr("value","available");
                    button.prev().removeClass("not-available").addClass("available");
                    $(this).next().attr("value","0");
                }
            });

        }else{

              $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Saving ...");
              var id = $("article.collection_item div.feed section.detail-collection-item").attr("id");
              var url = "index.php?page=update&id="+id; // the script where you handle the form input.

              var formData = new FormData($(this)[0]);

                $.ajax({
                       type: "POST",
                       url: url,
                       data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                       success: function(data){
                           if(data == 1){
                               $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").addClass("saved").attr("value","Saved !");
                               setTimeout(function(){
                                   $("article.collection_item div.feed section.detail-collection-item").removeClass("bordered");
                                   $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Edit");
                                   $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").removeClass("editable").removeClass("saved");
                                   $("article.collection_item div.feed section.detail-collection-item form aside header input[type='text']#item_name").blur();
                                   $("article.collection_item div.feed section.detail-collection-item form aside header input[type='text']#item_name").attr("readonly",true);
            $("article.collection_item div.feed section.detail-collection-item form aside textarea#item_description").attr("readonly",true);
                               },1000);
                           }else{
                               $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Please choose an item name !");
                               setTimeout(function(){
                                   $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Save");
                               },1000);
                           }
                       }
                });

        }

    }

    function scrollDetailCollection(e) {
          var diff = $(this).find('ul').outerWidth() - $(this).outerWidth();

          if(diff >= 0){
              var mouseX = e.pageX - $(this).offset().left;
              var percentage = mouseX/$(this).width();
              var mX = diff*percentage;
              var posX = 0;
              var damp = 150;
              var $th = $(this).find('ul');
              $th.animate({
                left: -mX
              },{ "duration": percentage*damp, "easing": "linear" });
          }
    }

    $("article aside#side section.collection ul li.add-to-collection").on("click",addCollectionItem);

    $("article div.feed section.post form div.collection header h2 a.post-add-collection-item").on("click",addCollectionItem);
                                                                                                                   $("article div.feed section.profile-collection ul li.template a").on("click",addCollectionItem);

    function addCollectionItem(e) {

          e.preventDefault();

          preloader(true);

          $(window).on("keyup",function (e) {
            switch(e.keyCode){
              case 27:
               $("article.add_collection").addClass("hide");
               $("article.add_collection .feed").remove();
              break;
            }
        });

          var url = "?page=add";
          $.get( url, function( data ) {

            preloader(false);
            var section = $(data).find(".feed");

            $("article.add_collection").removeClass("hide");
            section.addClass("animated fadeInUpBig").insertAfter("article.add_collection header.add_collection");

            $("article.add_collection section.add-collection-item span.close-add").on("click", function(){
              $("article.add_collection").addClass("hide");
               $("article.add_collection .feed").remove();

            });

            dragAndDrop();

          });


    }

    $("#email").select();
    /*var quests = $(".feed .quest");
    if($(".feed .last_quest").length > 0){
      quests.push($(".feed .last_quest"));
    }
    var time = 0;
    console.log(quests.length);
    $.each(quests,function(key,val){
        var quest = $(val);
        var page;
        page = getParameterByName("page");
        if(page != 'login' && isQuestScrolledIntoView(quest)){
            setTimeout(function(){
                quest.addClass("animated fadeInUp");
            },time);
            time+=300;
        }
    });*/

    animateChatBubbles();
    function animateChatBubbles(){
        var bubbles = $("section.chat ul li.conversation-bubble");
        bubbles.css("opacity","0");
        var time = 0;
        $.each(bubbles,function(key,val){
            var bubble = $(val);
            setTimeout(function(){
                bubble.addClass("animated fadeInRight2");
            },time);
            time+=80;
        });
    }

    $("section.chat ul li.conversation-bubble span.close-conversation").on("click",function(){
      var convo = $(this).parent().find("div.conversation");
      var close = $(this).parent().find(".close-conversation");
      var footer = $(this).parent().find("div.conversation footer");
      var ul = $(this).parent().find("div.conversation footer ul");
      var form = $(this).parent().find("div.conversation footer form");
      var notification = $(this).parent().find("span.new-msg");
      var offline = $(this).parent().find("span.offline-conversation");
      var img = $(this).parent().find("img").first();
      var bubbles = $("section.chat ul li.conversation-bubble");

      if(convo.hasClass("open")){
          ul.animate({opacity:"0"},150);
          form.animate({opacity:"0"},150);
          setTimeout(function(){
              footer.slideUp(300);
          },150);
          setTimeout(function(){
              convo.removeClass("open");
              close.animate({opacity:"0"},80);
              if(!offline.length){
                  img.removeClass("light");
              }
              offline.animate({opacity:"1"},80);
          },450);
      }else{
          $("section.chat ul li.new-conversation span.new-icon").removeClass("close");
          $("section.chat ul li.new-conversation form#new-conversation-form").removeClass("show");
          notification.fadeOut(200);
          setTimeout(function(){
              notification.remove();
          },210);

          $("section.chat ul li.new-conversation form#new-conversation-form ul").css("opacity","0");
          $("section.chat ul li.new-conversation form#new-conversation-form ul").slideUp(300);
          $("section.chat ul li.new-conversation span.new-icon").removeClass("close");
          $("section.chat ul li.new-conversation form#new-conversation-form").removeClass("show");
          $.each(bubbles,function(key,val){
              var bubble = $(val);
              if(!bubble.find("span.offline-conversation").length){
                  bubble.find("img").removeClass("light");
              }
          });

          $("div.conversation footer ul").css("opacity","0");
          $("div.conversation footer form").css("opacity","0");
          $("div.conversation footer").slideUp(300);
          $("div.conversation").removeClass("open");
          $(".close-conversation").animate({opacity:"0"},80);
          $("span.offline-conversation").animate({opacity:"1"},80);

          offline.animate({opacity:"0"},80);
          close.animate({opacity:"1"},80);
          img.addClass("light");
          convo.addClass("open");
          setTimeout(function(){
              footer.slideDown(300);
          },200);
          setTimeout(function(){
              form.animate({opacity:"1"},150);
              ul.animate({opacity:"1"},150);
          },500);
      }

    });

    function registerTouchStart(evt) {
        xDown = evt.touches[0].clientX;
        yDown = evt.touches[0].clientY;
    }

    function registerTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
            if($("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").hasClass("male")){
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").removeClass("male").addClass("female");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.male").removeClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.female").addClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right input[type='text']#gender").attr("value","f");
            }else{
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").removeClass("female").addClass("male");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.female").removeClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.male").addClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right input[type='text']#gender").attr("value","m");
            }
        }
        /* reset values */
        xDown = null;
        yDown = null;
    }

    if($("article.register").length){
        dragAndDrop();

        var myElement = document.getElementById('register_switch_btn');
        myElement.addEventListener('touchstart', registerTouchStart, false);
        myElement.addEventListener('touchmove', registerTouchMove, false);

        var xDown = null;
        var yDown = null;



        $("article.register div.register-box div.container section.step_2 aside.left form").on("submit",function(e){
            e.preventDefault();
            //$(this).find("#search_location").blur();
        });

        $("article.register div.register-box div.container section.step_1 form aside.left input[type='date']").on("keydown",function(e){
            var key = e.keyCode;
            switch(key){
                case 9:
                e.preventDefault();
                break;
            }
            /*if ( $(this).prop('type') != 'date' ) {
                $("#birth_date").datepicker();
            }*/
        });

        $("article.register div.register-box div.container section.step_1 form").on("submit",function(e){
            e.preventDefault();



            var formData = new FormData($(this)[0]);
            var inputs = $("article.register div.register-box div.container section.step_1 form aside.left input");
            var filled = true;

            $.each(inputs,function(key,val){
                if($(this).val().length === 0){
                    //console.log($(this));
                    filled = false;
                }
            });

            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

            if(!pattern.test($("article.register div.register-box div.container section.step_1 form aside.left input[type='email']").val())){
                filled = false;
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='email']").css("color","#F47D67");
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='email']").on("focus",focusMail);
            }else{
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='email']").css("color","#3E454C");
            }

            function focusMail(){
                $(this).css("color","#3E454C");
            }

            if($("article.register div.register-box div.container section.step_1 form aside.left input[type='password']#pass").val() != $("article.register div.register-box div.container section.step_1 form aside.left input[type='password']#repeat_pass").val()){
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='password']").css("color","#F47D67");
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='password']").on("focus",focusPass);
                filled = false;
            }else{
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='password']").css("color","#3E454C");
            }

            function focusPass(){
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='password']").css("color","#3E454C");
            }

            var dateValue = $("article.register div.register-box div.container section.step_1 form aside.left input[type='date']").val();
            dateValue = dateValue.split("-");
            var day = dateValue[2];
            var month = dateValue[1];
            var year = dateValue[0];
            var clickedDate = day + "/" + month + "/" + year;
            if(dateValue[0].length !== 0){
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='date']").attr("placeholder",clickedDate);
            }

            var selectedDate = new Date();
            selectedDate.setFullYear(year, month - 1, day);

            var maxDate = new Date();
            maxDate.setYear(maxDate.getYear() - 18);

            if (maxDate < selectedDate) {
                filled = false;
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='date']").attr("placeholder","Must be older than 16");
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='date']").css("color","#F47D67");
                $("article.register div.register-box div.container section.step_1 form aside.left input[type='date']").focus(function(){
                    $(this).css("color","#A9A9A9");
                    $(this).attr("placeholder","Date of birth");
                });
            }

            if (!$('article.register div.register-box div.container section.step_1 #agreed').is(':checked')) {
                filled = false;
                $("article.register div.register-box div.container section.step_1").scrollTop($("article.register div.register-box div.container section.step_1")[0].scrollHeight);
            }


            if(filled){

                $.ajax({
                    type: "POST",
                    url: "?page=register&step=1",
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function (data) {

                        if(data == 1){

                            $('article.register div.register-box div.container section.step_1 form input[type="submit"]').hide();

                            $("article.register div.register-box div.container section.step_1").addClass("completed");
                            $("article.register div.register-box nav.pages ul li.current").addClass("filled");
                            $("article.register div.register-box div.container").stop().animate({left: -$("article.register div.register-box div.container section.step_1").outerWidth()});
                            var next = $("article.register div.register-box nav.pages ul li.current").next();
                            $("article.register div.register-box nav.pages ul li.current").addClass("completed");
                            $("article.register div.register-box nav.pages ul li").removeClass("current");
                            next.addClass("current");

                        }

                    }
                });

            }

        });

        var validationCodeId;
        var validationCode;

        $("article.register div.register-box div.container section.step_2 aside.left form").on("submit",function(e){
            var filled = true;
            var inputs = $("article.register div.register-box div.container section.step_2 aside.left form input[type='text'].hide");
            $.each(inputs,function(key,val){
                if($(val).attr("value").length === 0){
                    filled = false;
                    //console.log($(val));
                }
            });

            if(filled){

                var formData = new FormData($(this)[0]);
                $(this).find("#submit_step_2").addClass("animated fadeOut");
                $.ajax({
                    type: "POST",
                    url: "?page=register&step=2",
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function (data) {

                        if(data == "1"){

                            validationCodeId = data.split(" ")[1];
                            validationCode = data.split(" ")[2];

                            $("article.register div.register-box div.container section.step_2").addClass("completed");
                            $("article.register div.register-box nav.pages ul li.current").addClass("filled");
                            $("article.register div.register-box nav.pages").fadeOut();
                            $("article.register div.register-box div.container").stop().animate({left: -($("article.register div.register-box div.container section.step_1").outerWidth()*2)},function(){
                             $("article.register div.register-box div.container section.step_1").remove();
                             $("article.register div.register-box div.container section.step_2").remove();
                             $("article.register div.register-box div.container").css("left","0");
                            });
                            var next = $("article.register div.register-box nav.pages ul li.current").next();
                            $("article.register div.register-box nav.pages ul li.current").addClass("completed");
                            $("article.register div.register-box nav.pages ul li").removeClass("current");
                            next.addClass("current");
                        }

                    }
                });

            }

        });

        /*$("article.register div.register-box div.container section.step_3 aside.left form").on("submit",function(e){

          e.preventDefault();

          var valid = true;

            var inputs = $("article.register div.register-box div.container section.step_3 aside.left ul li input[type='text']");
            var typedCode = "";
            $.each(inputs,function(key,input){
                typedCode += $(input).val();
            });
            console.log(validationCodeId);

            if(typedCode.length < 4){
              valid = false;
            }else{
              var url = "?page=verification&code="+typedCode+"&id="+validationCodeId;
              $(this).attr("action",url);
            }


            if (valid) this.submit();

        });*/

        $("article.register div.register-box div.container section.step_2 aside.left form input[type='text']#search_location").on("keyup",function(e){
            switch(e.keyCode){

                case 37:
                e.preventDefault();
                break;

                case 39:
                e.preventDefault();
                break;

            }
        });

        var navPagesLis = $("article.register div.register-box nav.pages ul li");
        navPagesLis.css("opacity","0");
        var animationtime = 0;
        $.each(navPagesLis,function(key,val){
            var navPagesLi = $(val);
            setTimeout(function(){
                navPagesLi.addClass("animated fadeInUp");
            },animationtime);
            animationtime+=250;
        });

        $(document).on("keyup",function(e){
            var currentPage = $("article.register div.register-box nav.pages ul li.current").index();
            var sectionWidth = $("article.register div.register-box div.container section").width();
            var thisSection = $("article.register div.register-box div.container section")[currentPage];
            var navPages = $("article.register div.register-box nav.pages ul li");
            if($("article.register div.register-box div.container section.step_2").length){
                switch(e.keyCode){
                        case 39:
                        if(!$(thisSection).hasClass("completed")){
                            $("article.register div.register-box nav.pages ul li.current").addClass("shake");
                        }
                        if(currentPage != navPages.length-1 && $(thisSection).hasClass("completed")){
                            $("article.register div.register-box nav.pages ul li").removeClass("current");
                            $.each(navPages,function(key,val){
                                var thisPage = $(val);
                                if(key == currentPage+1){
                                    thisPage.addClass("current");
                                }
                            });
                            $("article.register div.register-box div.container").stop().animate({left: (currentPage+1)*-sectionWidth});
                        }
                        break;

                        case 37:
                        if(currentPage !== 0){
                            $("article.register div.register-box nav.pages ul li").removeClass("current");
                            $.each(navPages,function(key,val){
                                var thisPage = $(val);
                                if(key == currentPage-1){
                                    thisPage.addClass("current");
                                }
                            });
                            $("article.register div.register-box div.container").stop().animate({left: (currentPage-1)*-sectionWidth});
                        }
                        break;
                }
            }
        });


        /* REGISTER LANG */

        $("article.register div.register-box div.container section.step_1 form aside.left div.select-language div.flag").on("click",function(){
            if(!$("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list").hasClass("show")){
                $("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list").addClass("show");
            }else{
                $("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list").removeClass("show");
            }

            $(document).on('click', function (e) {
                if ($(e.target).closest("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list").length === 0 && $(e.target).closest("article.register div.register-box div.container section.step_1 form aside.left div.select-language div.flag").length === 0) {
                    $("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list").removeClass("show");
                }
            });
        });

        $("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list li").on("click",function(){

            var thisClass = $(this).attr("class");
            $("article.register div.register-box div.container section.step_1 form aside.left div.select-language input#selected_lang").attr("value",thisClass);
            $("article.register div.register-box div.container section.step_1 form aside.left div.select-language div.flag").removeClass("en nl fr");

            $("article.register div.register-box div.container section.step_1 form aside.left div.select-language div.flag").addClass(thisClass);
            $("article.register div.register-box div.container section.step_1 form aside.left div.select-language ul.lang-list").removeClass("show");
        });


        $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container div.switch-limit div.switch-btn").on("click",function(){
            if($(this).hasClass("male")){
                $(this).removeClass("male").addClass("female");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.male").removeClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.female").addClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right input[type='text']#gender").attr("value","f");
            }else{
                $(this).removeClass("female").addClass("male");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.female").removeClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right div.switch-gender div.switch-container p.male").addClass("selected");
                $("article.register div.register-box div.container section.step_1 form aside.right input[type='text']#gender").attr("value","m");
            }
        });

        $("article.register div.register-box div.container section.step_3 aside.left ul li input[type='text']").on("keyup",function(){

        if($(this).val()){
            $(this).addClass("filled");
            $(this).parent().next().find("input[type='text']").select();
        }
        });

    }

    $("article.register div.register-box nav.pages ul li").on("click",function(){
        var thisIndex = $(this).index();
        var lis = $("article.register div.register-box nav.pages ul li");
        var sections = $("article.register div.register-box div.container section");
        var sectionWidth = $("article.register div.register-box div.container section").width();

        if($("article.register div.register-box nav.pages ul li").first().hasClass("completed")){
         $("article.register div.register-box div.container").animate({left: thisIndex*-sectionWidth});
         $("article.register div.register-box nav.pages ul li").removeClass("current");
         $(this).addClass("current");
        }
    });

    $("section.chat ul li.new-conversation span.new-icon").on("click",function(){
        window.location.replace("?page=messages&action=create");

    });

    function checkNotification(){
        if($("header#menu nav ul li.notifications ul li.notseen").length){
            notificationCount = $("header#menu nav ul li.notifications ul li.notseen").length;

            $("header#menu nav ul li.notifications span.icon-bell").addClass("notif animated swing infinite");
        }else{
           $("header#menu nav ul li.notifications span.icon-bell").removeClass("notif animated swing infinite");
           notificationCount = 0;
        }

        titleBarUpdate();
    }

    function checkMessages() {

        if($("section.chat ul li.conversation-bubble span.new-msg").length){
            messagesCount = $("section.chat ul li.conversation-bubble span.new-msg").length;

        }else{
            messagesCount = 0;
        }

        titleBarUpdate();
    }

    function titleBarUpdate() {

        var newTitleBarCount = notificationCount + messagesCount;

        var titleMessage = "Droopl ";

        if(titleBarCount != newTitleBarCount){
            titleBarCount = newTitleBarCount;
            if(titleBarCount !== 0){
                titleMessage += "("+titleBarCount+")";
            }

            document.title = titleMessage;
        }

        updateMessagesCount();
    }

    function updateMessagesCount() {


        var messageTitle = menuMessage;
        if(oldMessageCount != messagesCount){
            oldMessageCount = messagesCount;
            if(oldMessageCount !== 0){
                messageTitle += "("+oldMessageCount+")";
            }
            $("#menu_messages").html(messageTitle);
        }
    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {

              $('#quest .upload_image').addClass('animated fadeOut');
              $('#quest .uploaded_image').removeClass("hide");
              $('#quest .uploaded_image').on("click",function () {
                $(this).addClass("hide");
                $(this).prev().removeClass('animated fadeOut');
                $(this).prev().addClass('animated fadeIn');
              });
              $('#quest .uploaded_image img').attr("src",e.target.result);
              $('#quest .uploaded_image').addClass("animated fadeIn");
          };

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#quest input[type='file']").change(function(){
        readURL(this);
    });
    $("#register_quest input[type='file']").change(function(){
        $(this).parent().css("background-image","url(images/assets/check-icon.svg)");
    });
    $("#login input#email").on("keyup",function () {
        if( isValidEmailAddress( $(this).val() ) ) {
          if($(this).hasClass("wrong")){
            $(this).removeClass("wrong");
          }
          $(this).addClass("correct");
        }else{
          if($(this).hasClass("correct")){
            $(this).removeClass("correct");
          }
          $(this).addClass("wrong");

        }
        if($(this).val() === ""){
            $(this).removeClass("wrong");
        }
    });


     function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }



    /*QUEST ADDING FUNCTIE*/
	$("#quest").submit(function(e) {
        preloader(true);
      e.preventDefault();

      var formData = new FormData($(this)[0]);

	    $.ajax({
	           type: "POST",
	           data: formData,
             async: false,
            cache: false,
            contentType: false,
            processData: false,
	           success: function(data)
	           {

               preloader(false);
                    $("#quest input[type='text']").val("");
                    var quests = $(".feed .quest");
				    var feed = $(data).find(".feed .quest");

                   $(feed).each(function(key,newquest){

                     var found = false;

                     $(quests).each(function(id,quest){

                         if($(newquest).attr("id") == $(quest).attr("id")){
                              found = true;
                         }

                     });

                     if(!found){

                     	$(newquest).addClass("animated fadeIn").insertAfter(".feed .post");

                     	 //$(".feed").insertAfter($(newquest).addClass("animated fadeInDown"));
                     		//$(".feed").prepend($(newquest).addClass("animated fadeInDown"));
                     }

                   });

                   $("article div.feed section.quest header nav ul li.options").on("click",editPost);

                    //$("article div.feed section.quest footer a.proposal").on("click",getDetail);

                    var lang = $("div.js-language").html();
                    $("article div.feed section.post form div.collection ul li div.selected").removeClass("show").removeClass("bounceIn");
                    $("article div.feed section.post form div.collection ul li").removeClass("selected");
                    $("article div.feed section.post form div.collection ul li p.collection-item-name").removeClass("selected");
                    $("article div.feed section.post form div div.added-collection-item").removeClass("show");
                    $("article div.feed section.post form div div.added-collection-item").attr("id","");
                    $("article div.feed section.post form div.collection input#collection_item").attr("value","");

                    switch(lang){

                        case 'en':
                        $("article div.feed section.post form div input#item").attr("placeholder", "What are you looking for ?");
                        break;

                        case 'fr':
                        $("article div.feed section.post form div input#item").attr("placeholder", "Qu'est-ce que vous cherchez ?");
                        break;

                        case 'nl':
                        $("article div.feed section.post form div input#item").attr("placeholder", "Wat ben je naar op zoek ?");
                        break;

                        default:
                        $("article div.feed section.post form div input#item").attr("placeholder", "What are you looking for ?");
                        break;
                    }

                    $(".button").removeClass("offering-mode").addClass("looking-mode");
                    $("article div.feed section.post form div input#type").attr("value", "0");
                    $("article div.feed section.post form div input#quest_submit").removeClass("offering-bg");
                    $("article div.feed section.post form div span.upload_image input[type='file']").show();
                    $("article div.feed section.post form div span.upload_image").animate({"opacity": 1},200);

                    if($("article div.feed section.post form div.collection ul").length){

                    $("article div.feed section.post form div.collection ul").animate({left: 0},200,function(){
                        var collectionItems = $("article div.feed section.post form div.collection ul li");
                        var time = 0;
                        $.each(collectionItems,function(key,val){
                            var collectionItem = $(val);
                            if(key < 7){
                                setTimeout(function(){
                                    collectionItem.addClass("animated-fast fadeOutUp");
                                },time);
                                time+=35;
                            }else{
                                collectionItem.css("opacity","0");
                            }
                        });
                        setTimeout(function(){
                            $("article div.feed section.post form div.collection").slideUp(400);
                        },80);
                        setTimeout(function(){
                            $("article div.feed section.post form div.collection ul li").removeClass("fadeInDown");
                        },480);
                    });

                    }else{
                        $("article div.feed section.post form div.collection").slideUp(400);
                        $("article div.feed section.post form div.collection ul li").removeClass("fadeInDown");
                    }

					/*if($(data).length > 0){
						$(".feed .quest").remove();

						$(feed).each(function (key,val) {

							$(".feed").append(val);


		               });
					}*/
	          }
	         });

	    //return false;  avoid to execute the actual submit of the form.
	});

    $("article div.feed section.quest header nav ul li.options").on("click",editPost);

    function editPost(){

        if(!$(this).next().find("ul.options").hasClass("show")){
            $(this).next().find("ul.options").addClass("show");
        }else{
            $(this).next().find("ul.options").removeClass("show");
        }

    }

    /*$("#login").submit(function(e) {
        var url = "index.php?page=login"; // the script where you handle the form input.

        $.ajax({
            type: "POST",
            url: url,
            data: $("#login").serialize(),
            // serializes the form's elements.
            success: function(data) {
                var bool = $(data).find("#loggedin").html();
                $("#login").removeClass();
                if (bool == "false") {
                    $("#login").addClass("animated shake");
                    setTimeout(function() {
                        $("#login").removeClass();
                    }, 1000);
                } else {
                    $(".inner-form-container input").animate({opacity:"0"});
                    $("footer p.create-account").animate({opacity:"0"});
                    setTimeout(function(){
                        $(".inner-form-container").slideUp(500);
                        $("#preloader").animate({opacity:"1"});
                    },500);
                    setTimeout(function() {
                        $("#sounds").attr("src","sounds/notification.mp3");
                        $("#sounds")[0].play();
                    }, 1000);

                    $("#sounds").on("ended",function (argument) {
                      $(location).attr('href', "?page=feed");
                    });
                }
            }
        });

        return false;
    });*/

  $("#side .profile a").on("click",function  () {

    var url = $(this).attr("href");
    if($(this).hasClass("follow")){
      $(this).removeClass("follow");
      $(this).addClass("followed");

      $(this).html("  followed");
    }else{
      $(this).removeClass("followed");
      $(this).addClass("follow");
      $(this).html("  follow");
    }
    $.ajax({
            type: "GET",
            url: url
        });
    return false;
});

	$(window).scroll(function  () {

      if($("#side .activity").length > 0){
      		var check = isScrolledIntoView($("#side .activity"));

      		if(check){
      			$("#side").addClass("fixed");
      			$(".feed").addClass("fixed");
      		}

      		if($(window).scrollTop() <= 320){
      			$("#side").removeClass("fixed");
      			$(".feed").removeClass("fixed");
      		}

      }

      if($(".feed .quest").length){
        if($(this).scrollTop() >= $(".feed").height() - $(window).height()){
          var url = $(location).attr('href');
          $.get( url+"&part="+part, function( data ) {

          var quests = $(".feed .quest");
          var loadedQuest = $(data).find(".feed .quest");

          if(loadedQuest.length > 1){

             $(loadedQuest).each(function(key,newquest){

               var found = false;

                 $(quests).each(function(id,quest){

                       if($(newquest).attr("id") == $(quest).attr("id")){
                            found = true;
                       }
                 });

                 if(!found){
                  var feed = $(".feed");
                  feed.append($(newquest));
                 }
              });

            part++;
          }else{

            if($(".feed .last_quest").length ){
            }else{
              var lastQuest = $("<section/>").addClass("last_quest").html('<header><h1 class="quest"><span class="hide">no more quests</span></h1> <h2>Youre out of quests</h2></header><p>If you want to see more quests, you will need to get social. Follow some cool people on droopl and see the quests poor in.</p>');
              $(".feed").append($(lastQuest).addClass("animated fadeIn"));
            }


            /*<section class="last_quest hide">

    <header>
      <h1 class="quest"><span class="hide">no more quests</span></h1>
      <h2>You're out of quests</h2>
    </header>

    <p>If you want to see more quests, you will need to get social. Follow some cool people on droopl and see the quests poor in.</p>

    <a href="?page=people">find people</a>

  </section>*/

          }




          });


        }
      }

    });

	$("header#menu div nav ul li.notifications .icon-bell").on("click",function  () {


		//$("header#menu div nav ul li.profile img").next().removeClass("show");

		if($(this).next().hasClass("show")){
			$(this).next().removeClass("show");
		}else{
			$(this).next().addClass("show");


            var elements = $(this).parent().find("li");
            elements.each(function (key,val) {
                if($(val).hasClass("notseen")){
                  var id =$(val).attr("id");
                  var data = {"notification_id": id};

                  $.ajax({
                   type: "POST",
                   url: "?page=feed",
                   data: data,
                   success: function(data) {
                      $(val).removeClass("notseen");

                   }
                  });
                }
            });

            $("header#menu nav ul li.notifications span.icon-bell").removeClass("notif animated swing infinite");
		}


	});

    $("header#menu div nav ul li.profile img").on("click",function  () {
        $("header#menu div nav ul li.notifications .icon-bell").next().removeClass("show");
        if($(this).next().hasClass("show")){
          $(this).next().removeClass("show");
        }else{
          $(this).next().addClass("show");
        }


      });

    $(".logout").on("click", function(){
        $("header#menu div nav ul li.profile img").next().removeClass("show");
        $("article").fadeOut(700);
        setTimeout(function(){
            $("header#menu").addClass("animated fadeOutUp");
        },300);
        setTimeout(function(){
            $(location).attr('href', "?action=logout");
        },1000);
    });

    var bool = true;

    if(document.body.contains(document.getElementById("quest_switch_btn"))){

        var questSwitchButton = document.getElementById('quest_switch_btn');

        questSwitchButton.addEventListener('touchstart', questTouchStart, false);
        questSwitchButton.addEventListener('touchmove', questTouchMove, false);


    }

    function questTouchStart(evt) {
        xDown = evt.touches[0].clientX;
        yDown = evt.touches[0].clientY;
    }

    function questTouchMove(evt) {
        if ( ! xDown || ! yDown ) {
            return;
        }

        var xUp = evt.touches[0].clientX;
        var yUp = evt.touches[0].clientY;

        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {
            questslider();
        }
        /* reset values */
        xDown = null;
        yDown = null;
    }


    $(".switch-container").on("click",function(){

        questslider();

    });

    function questslider(){
        var lang = $("div.js-language").html();

        if(bool){

            if(!$(".button").hasClass("offering-mode")){
                bool = false;
                switch(lang){

                    case 'en':
                    $("article div.feed section.post form div input#item").attr("placeholder", "What do you like to offer ?");
                    break;

                    case 'fr':
                    $("article div.feed section.post form div input#item").attr("placeholder", "Qu'est-ce que vous proposez ?");
                    break;

                    case 'nl':
                    $("article div.feed section.post form div input#item").attr("placeholder", "Wat wil je aanbieden ?");
                    break;

                    default:
                    $("article div.feed section.post form div input#item").attr("placeholder", "What do you like to offer ?");
                    break;
                }

                $(".button").removeClass("looking-mode").addClass("offering-mode");
                $("article div.feed section.post form div input#type").attr("value", "1");
                $("article div.feed section.post form div input#quest_submit").addClass("offering-bg");
                $("article div.feed section.post form div span.upload_image").removeClass("animated fadeIn");
                $("article div.feed section.post form div span.upload_image").animate({opacity: "0"},200);
                $("article div.feed section.post form div span.upload_image input[type='file']").hide();
                $("article div.feed section.post form div select").animate({right: 70},200);
                $("article div.feed section.post form div select").css("color", "#92CCCE");
                $("article div.feed section.post form div.collection ul li").removeClass("fadeOutUp");

                $("article div.feed section.post div input#item").select();
                $("article div.feed section.post div input#item").on("keyup",function () {
                  $("article div.feed section.post form div.collection ul li");
                  var itemName = $(this).val().toLowerCase();
                  var collectionItems = $("article div.feed section.post form div.collection ul li p span");

                  $.each(collectionItems,function (id,item) {

                    var itemText = $(item).text().toLowerCase();

                    if(itemText.indexOf(itemName) != -1){
                      $(item).parent().parent().fadeIn();
                    }else{
                      $(item).parent().parent().fadeOut();
                    }
                  });
                });

                if($("article div.feed section.post form div.collection").length){
                    var collectionItems = $("article div.feed section.post form div.collection ul li");
                    var time = 0;
                    $("article div.feed section.post form div.collection").slideDown(300);

                    $.each(collectionItems,function(key,val){
                        var collectionItem = $(val);
                        if(key < 7){
                            setTimeout(function(){
                                collectionItem.addClass("animated-fast fadeInDown");
                            },time);
                            time+=100;
                        }else{
                            collectionItem.css("opacity","1");
                        }
                    });
                }

                setTimeout(function(){
                    bool = true;
                },700);
            }else{
                bool = false;
                $("article div.feed section.post form div.collection ul li div.selected").removeClass("show").removeClass("bounceIn");
                $("article div.feed section.post form div.collection ul li").removeClass("selected");
                $("article div.feed section.post form div.collection ul li p.collection-item-name").removeClass("selected");
                $("article div.feed section.post form div div.added-collection-item").removeClass("show");

                switch(lang){

                    case 'en':
                    $("article div.feed section.post form div input#item").attr("placeholder", "What are you looking for ?");
                    break;

                    case 'fr':
                    $("article div.feed section.post form div input#item").attr("placeholder", "Qu'est-ce que vous cherchez ?");
                    break;

                    case 'nl':
                    $("article div.feed section.post form div input#item").attr("placeholder", "Wat ben je naar op zoek ?");
                    break;

                    default:
                    $("article div.feed section.post form div input#item").attr("placeholder", "What are you looking for ?");
                    break;
                }

                $(".button").removeClass("offering-mode").addClass("looking-mode");
                $("article div.feed section.post form div input#type").attr("value", "0");
                $("article div.feed section.post form div input#quest_submit").removeClass("offering-bg");
                $("article div.feed section.post form div span.upload_image").animate({opacity: "1"},200);
                $("article div.feed section.post form div span.upload_image input[type='file']").show();
                $("article div.feed section.post form div select").animate({right: 125},200);
                $("article div.feed section.post form div select").css("color", "#F47D67");
                $("article div.feed section.post form div div.added-collection-item").attr("id","");
                $("article div.feed section.post form div.collection input#collection_item").attr("value","");

                if($("article div.feed section.post form div.collection ul").length){

                $("article div.feed section.post form div.collection ul").animate({left: 0},200,function(){
                    var collectionItems = $("article div.feed section.post form div.collection ul li");
                    var time = 0;
                    $.each(collectionItems,function(key,val){
                        var collectionItem = $(val);
                        if(key < 7){
                            setTimeout(function(){
                                collectionItem.addClass("animated-fast fadeOutUp");
                            },time);
                            time+=35;
                        }else{
                            collectionItem.css("opacity","0");
                        }
                    });
                    setTimeout(function(){
                        $("article div.feed section.post form div.collection").slideUp(400);
                    },80);
                    setTimeout(function(){
                        $("article div.feed section.post form div.collection ul li").removeClass("fadeInDown");
                    },480);
                });

                }else{
                    $("article div.feed section.post form div.collection").slideUp(400);
                    $("article div.feed section.post form div.collection ul li").removeClass("fadeInDown");
                }

                setTimeout(function(){
                    bool = true;
                },700);
            }
        }
    }



    var boolCollection = true;
    function focusCollection(){

            $("article.detail div.feed section.quest footer.detail div.collection ul li").removeClass("fadeOutUp");

            if($("article.detail div.feed section.quest footer.detail div.collection ul").length){

                if(boolCollection){
                    boolCollection = false;
                    var collectionItems = $("article.detail div.feed section.quest footer.detail div.collection ul li");
                    var time = 0;
                    $("article div.feed section.quest footer div.collection").slideDown(300);
                    $.each(collectionItems,function(key,val){
                        var collectionItem = $(val);
                        if(key < 7){
                            setTimeout(function(){
                                collectionItem.addClass("animated-fast fadeInDown");
                            },time);
                            time+=100;
                        }else{
                            collectionItem.css("opacity","1");
                        }
                    });
                    setTimeout(function(){
                        boolCollection = true;
                    },700);
                }


                //bug
                /*$("article.detail div.feed section.quest footer div.search-proposal form").on('submit',function (e) {
                    e.preventDefault();
                    var formdata = $(this).serialize();

                    $.ajax({
                      type:"POST",
                      url:$(this).attr("action"),
                      data:formdata,
                      success:function (data) {
                        blurCollection();

                        var oldPropos = $("article.detail div.feed section.quest .proposals-list ul .propo");
                        var propos = $(data).find(".proposals-list ul .propo");

                        if(propos.length > oldPropos.length){
                          if($("article.detail div.feed section.quest footer div.proposals-list ul div.no-proposals-container").length){
                              $("article.detail div.feed section.quest footer div.proposals-list ul div.no-proposals-container").remove();
                          }
                          for (var i = oldPropos.length; i < propos.length; i++) {
                            var newPropo = propos[i];
                            $(newPropo).addClass("animated fadeIn").appendTo("article.detail div.feed section.quest .proposals-list ul.list");
                          }

                        }
                      }
                    });

                });*/

            }

    }

   function blurCollection(){


            if(boolCollection){
            boolCollection = false;
            if($("article.detail div.feed section.quest footer.detail div.collection ul").length){



            $("article.detail div.feed section.quest footer.detail div.collection ul").animate({left: 0},200,function(){
                var collectionItems = $("article.detail div.feed section.quest footer.detail div.collection ul li");
                var time = 0;
                $.each(collectionItems,function(key,val){
                    var collectionItem = $(val);
                    if(key < 7){
                        setTimeout(function(){
                            collectionItem.addClass("animated-fast fadeOutUp");
                        },time);
                        time+=35;
                    }else{
                        collectionItem.css("opacity","0");
                    }
                });
                setTimeout(function(){
                    $("article.detail div.feed section.quest footer.detail div.collection").slideUp(400);
                },80);
                setTimeout(function(){
                    $("article.detail div.feed section.quest footer.detail div.collection ul li").removeClass("fadeInDown");
                },480);
            });

            }else{
                $("article.detail div.feed section.quest footer.detail div.collection").slideUp(400);
                $("article.detail div.feed section.quest footer.detail div.collection ul li").removeClass("fadeInDown");
            }


            $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").val("");

            var lang = $("div.js-language").html();
            $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item").removeClass("show");
            $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item").attr("id","");
            $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("value","");
            $("article.detail div.feed section.quest footer.detail div.collection ul li div.selected").removeClass("show");
            $("article.detail div.feed section.quest footer.detail div.collection ul li").removeClass("selected");
            $("article.detail div.feed section.quest footer.detail div.collection ul li p.collection-item-name").removeClass("selected");
            $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "What are you offering ?");

            switch(lang){

                    case 'en':
                    $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "Propose an item from your collection");
                    break;

                    case 'fr':
                    $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "Proposez un objet de votre collection");
                    break;

                    case 'nl':
                    $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "Stel een item voor vanuit jouw collectie");
                    break;

                    default:
                    $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "What are you offering ?");
                    break;
            }
            setTimeout(function(){
                boolCollection = true;
            },700);
        }
    }

    /* COLLECTION ITEMS SELECT QUEST DETAIL */
    function selectCollectionDetail(){

        var itemId = $(this).parent().attr("id");
        var thisItem = $(this);
        var thisItemName = $(this).next().find("span").html();

        if(!thisItem.hasClass("show")){
            $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']#search_proposals").attr("placeholder", "");
            saveVal = $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']#search_proposals").val();
            $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']#search_proposals").val("");
            $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']#collection_item").attr("value",itemId);
            $("article.detail div.feed section.quest footer.detail div.collection ul li div.selected").removeClass("show");
            $("article.detail div.feed section.quest footer.detail div.collection ul li").removeClass("selected");
            $("article.detail div.feed section.quest footer.detail div.collection ul li p.collection-item-name").removeClass("selected");

            thisItem.addClass("show");
            thisItem.parent().addClass("selected");
            thisItem.next().addClass("selected");

            $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item").attr("id",itemId);
            $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item p").html(thisItemName + " <span class='remove-collection-item icon-cross'></span>");
            $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item").addClass("show").addClass("animated bounceIn");
            setTimeout(function(){
                $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item").removeClass("animated bounceIn");
            },1000);
        }
    }

    /* COLLECTION ITEMS SELECT POST QUEST */
    $("article div.feed section.post form div.collection ul li div.selected").on("click",function(){
        var itemId = $(this).parent().attr("id");
        var thisItem = $(this);
        var thisItemName = $(this).next().find("span").html();

        if(!thisItem.hasClass("show")){
            $("article div.feed section.post form div input#item").attr("placeholder", "");
            saveVal = $("article div.feed section.post form input#item").val();
            $("article div.feed section.post form input#item").val("");
            $("article div.feed section.post form div.collection input#collection_item").attr("value",itemId);
            $("article div.feed section.post form div.collection ul li div.selected").removeClass("show");
            $("article div.feed section.post form div.collection ul li").removeClass("selected");
            $("article div.feed section.post form div.collection ul li p.collection-item-name").removeClass("selected");

            thisItem.addClass("show");
            thisItem.parent().addClass("selected");
            thisItem.next().addClass("selected");

            $("article div.feed section.post form div div.added-collection-item").attr("id",itemId);
            $("article div.feed section.post form div div.added-collection-item p").html(thisItemName + " <span class='remove-collection-item icon-cross'></span>");
            $("article div.feed section.post form div div.added-collection-item").addClass("show").addClass("animated bounceIn");
            setTimeout(function(){
                $("article div.feed section.post form div div.added-collection-item").removeClass("animated bounceIn");
            },1000);
        }
    });

    function removeAddedCollectionItem(){

        $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").val(saveVal);

        var lang = $("div.js-language").html();
        $(this).parent().removeClass("show");
        $("article.detail div.feed section.quest footer div.search-proposal form div.added-collection-item").attr("id","");
        $("article.detail div.feed section.quest footer div.search-proposal form input#collection_item").attr("value","");
        $("article.detail div.feed section.quest footer.detail div.collection ul li div.selected").removeClass("show");
        $("article.detail div.feed section.quest footer.detail div.collection ul li").removeClass("selected");
        $("article.detail div.feed section.quest footer.detail div.collection ul li p.collection-item-name").removeClass("selected");
        $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "What are you offering ?");

        switch(lang){

                case 'en':
                $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "What are you offering ?");
                break;

                case 'fr':
                $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "Qu'est-ce que vous proposez ?");
                break;

                case 'nl':
                $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "Wat wilt u uitlenen ?");
                break;

                default:
                $("article.detail div.feed section.quest footer div.search-proposal form input[type='text']").attr("placeholder", "What are you offering ?");
                break;
        }
    }

    $("article div.feed section.post form div div.added-collection-item p").on("click",function(){

        $("article div.feed section.post form input#item").val(saveVal);

        var lang = $("div.js-language").html();
        $(this).parent().removeClass("show");
        $("article div.feed section.post form div div.added-collection-item").attr("id","");
        $("article div.feed section.post form div.collection input#collection_item").attr("value","");
        $("article div.feed section.post form div.collection ul li div.selected").removeClass("show");
        $("article div.feed section.post form div.collection ul li").removeClass("selected");
        $("article div.feed section.post form div.collection ul li p.collection-item-name").removeClass("selected");
        $("article div.feed section.post form div input#item").attr("placeholder", "What are you offering ?");

        switch(lang){

                case 'en':
                $("article div.feed section.post form div input#item").attr("placeholder", "What are you offering ?");
                break;

                case 'fr':
                $("article div.feed section.post form div input#item").attr("placeholder", "Qu'est-ce que vous proposez ?");
                break;

                case 'nl':
                $("article div.feed section.post form div input#item").attr("placeholder", "Wat wilt u uitlenen ?");
                break;

                default:
                $("article div.feed section.post form div input#item").attr("placeholder", "What are you offering ?");
                break;
        }
    });

    $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-menu").on("click",function(){
        var thisUl = $(this).find("ul");

        if(!thisUl.hasClass("show")){
            $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-menu ul").removeClass("show");
            thisUl.addClass("show");
        }else{
            thisUl.removeClass("show");
        }
    });

    animateCollectionItems();
    function animateCollectionItems(){
        var collectionItems = $("article div.feed section.profile-collection ul li.profile-collection-item");
        var time = 0;
        $.each(collectionItems,function(key,val){
            var collectionItem = $(val);
            setTimeout(function(){
                collectionItem.addClass("animated fadeInUp");
            },time);
            time+=100;
        });
    }

    $(".feed a.add_collection_item").on("click",function (e) {

      e.preventDefault();
      preloader(true);
      $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            success: function(data) {
              preloader(false);
              var section = $(data).find(".feed");


              $("article.add_collection").removeClass("hide");
              section.addClass("animated fadeInUpBig").insertAfter("article.add_collection header.add_collection");

              $("article.add_collection section.add-collection-item span.close-add").on("click", function(){
                $("article.add_collection").addClass("hide");
                 $("article.add_collection .feed").remove();

              });

              dragAndDrop();

            }
        });


    });


    $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-menu ul li.delete a").on("click",function(e){

        e.preventDefault();
        $("article.remove-msg").addClass("show");
        $("article.remove-msg a.yes-btn").attr('href','?page=collection&action=remove&collection_id='+$(this).attr('id'));
        $("article.remove-msg").animate({opacity: 1},200);
    });

    $("article.remove-msg div.remove-collection-item-msg a.cancel-btn").on("click",function(e){
        e.preventDefault();
        $("article.remove-msg").animate({opacity: 0},200);
        setTimeout(function(){
            $("article.remove-msg").removeClass("show");
        },200);
    });

    $("article.remove-msg div.remove-collection-item-msg div.yes-btn").on("click",function(){
        $("article.remove-msg").animate({opacity: 0},200);
        setTimeout(function(){
            $("article.remove-msg").removeClass("show");
            animateRemovedCollectionItem();
        },200);

    });

   $("article div.messages aside.conversations form#search-conversations input[type='button']#new-conversation-btn").on("click",function(){

       window.location.replace("?page=messages&action=create");

    });

    $("article.new-conversation form#new-conversation-form span.close-new-conversation").on("click",function(){
        $("article.new-conversation").animate({opacity: 0},200);
        setTimeout(function(){
            $("article.new-conversation").removeClass("show");
        },200);
    });

    function dragAndDrop() {

        var obj = $("#dragndrop input[type='file']");
        obj.on('dragenter', function (e)
        {
          //console.log("enter");
            e.preventDefault();
            $(this).parent().parent().css('border', '3px solid #E5E5E5');
            $(this).parent().parent().css('background-position', 'center -140px');
        });
        obj.on('dragover', function (e)
        {
        });
        obj.on('dragleave', function (e)
        {
            //console.log("out");
             $(this).parent().parent().css('border', '1px solid #E5E5E5');
            $(this).parent().parent().css('background-position', 'center 0px');

        });
        obj.change(function(){
            $(this).parent().parent().css('border', 'none');
           $(this).parent().parent().addClass("containFile");
		    handleFileUpload(this);
		});

    }

    function closeLayerElement(obj,hide) {
        var closebtn = $(obj).find("a.close");
        $(closebtn).bind("click",function  (e) {
            e.preventDefault();
            if(hide){
                obj.addClass("hide");
            }else{
                obj.remove();
            }
            closebtn.unbind("click");
        });

        obj.bind("click",function (e) {
            if($(e.target).attr("class") == obj.attr("class")){
                obj.unbind("click");
                if(hide){
                    obj.addClass("hide");
                }else{
                    obj.remove();
                }
            }
        });

        $(window).bind("keyup",function (e) {
            if(e.keyCode == 27){
                if(hide){
                    console.log("here");
                    obj.addClass("hide");
                }else{
                    obj.remove();
                }
                closebtn.unbind("click");
                $(window).unbind("keyup");
            }
        })
    }



	function isScrolledIntoView(elem){

	    var $elem = $(elem);
	    var $window = $(window);

	    var elemTop = $elem.offset().top;
	    var elemBottom = elemTop + $elem.height();

	    var docViewTop = $window.scrollTop();
	    var docViewBottom = docViewTop + $elem.height() + $("#menu").height()+20;

	    return (elemBottom <= docViewBottom);
	}


    function isNotificationScrolledIntoView(elem){
      var $elem = $(elem);
	    var $window = $("header#menu div nav ul li.notifications ul li");

	    var elemTop = $elem.offset().top;
	    var elemBottom = elemTop + $elem.height();

	    var docViewTop = $window.scrollTop();
	    var docViewBottom = docViewTop + $window.height();



	    return (elemTop <= docViewBottom);
    }
    function isValidEmailAddress(emailAddress) {
      var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
      return pattern.test(emailAddress);
    }

    function initialize() {

        var userCoordinates = $("div.user-coordinates").html().split(" ");
        var userLatitude = parseFloat(userCoordinates[0])-0.004;
        var userLongitude = parseFloat(userCoordinates[1]);
        var myLatlng = new google.maps.LatLng(userLatitude,userLongitude);
        var mapOptions = {
          center: { lat: userLatitude, lng: userLongitude},
          scrollwheel: false,
          zoom: 12,
          disableDoubleClickZoom: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          disableDefaultUI: false,
          draggable: false,
          panControl:false,
          zoomControl:false,
          mapTypeControl: false,
          scaleControl:false,
          streetViewControl: false,
          overviewMapControl: false,
          rotateControl: false,
          styles:

          [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]

        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
        google.maps.event.addDomListener(map, 'click', function() {
            goToMaps();
        });
      }

      if($("div.user-coordinates").length){
        google.maps.event.addDomListener(window, 'load', initialize);
      }

      function goToMaps(){
          var link = $("div.map-container").find("a.google-maps-link").attr("href");
          window.open(link, '_blank');
      }

      var latitude = 50.850340;
      var longitude = 4.351710;
      var map;
      var icon;
      var markers;
      var street;
      var zipcode;
      var city;
      var country;
      var number;
      function initAutocomplete() {
          var mapOptions = {
          center: { lat: latitude+.006, lng: longitude},
          scrollwheel: false,
          zoom: 12,
          maxZoom: 15,
          disableDoubleClickZoom: true,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          disableDefaultUI: false,
          draggable: true,
          panControl: false,
          zoomControl:false,
          mapTypeControl: false,
          scaleControl:false,
          streetViewControl: false,
          overviewMapControl: false,
          rotateControl: false,
          styles:

          [{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"stylers":[{"hue":"#00aaff"},{"saturation":-100},{"gamma":2.15},{"lightness":12}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"lightness":24}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":57}]}]

        };
          map = new google.maps.Map(document.getElementById('maps-api-container'), mapOptions);

          var infoWindow = new google.maps.InfoWindow({map: map});


          /*if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };

              infoWindow.setPosition(pos);
              infoWindow.setContent('Location found.');
              map.setCenter(pos);
            }, function() {
              handleLocationError(true, infoWindow, map.getCenter());
            });
          } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }*/

          // Create the search box and link it to the UI element.
          var input = document.getElementById('search_location');
          var searchBox = new google.maps.places.SearchBox(input);
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
          });

          markers = [];
          // [START region_getplaces]
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length === 0) {
              return;
            }



            // Clear out the old markers.
            markers.forEach(function(marker) {
              marker.setMap(null);
            });

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
              icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
              };

              // Create a marker for each place.
              markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
              }));

                latitude = place.geometry.location.lat();
                longitude = place.geometry.location.lng();
                setAdress();

              if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
              } else {
                bounds.extend(place.geometry.location);
              }
            });
            map.fitBounds(bounds);
          });
          // [END region_getplaces]
        }

        /*function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(browserHasGeolocation ?
                                'Error: The Geolocation service failed.' :
                                'Error: Your browser doesn\'t support geolocation.');
        }*/


        function setAdress(){

            var thisUrl = "http://maps.googleapis.com/maps/api/geocode/json?latlng="+latitude+","+longitude+"&sensor=true";
            var address = "";
            $.ajax({
                type:"POST",
                url: thisUrl,
                data:$(this).serialize(),
                success:function (data) {
                  var components = data['results'][0]['address_components'];

                  latitude = data['results'][1]['geometry']['location']['lat'];
                  longitude = data['results'][1]['geometry']['location']['lng'];

                  $.each(components,function(key,val){
                      var component = val;
                      var componentType = val['types'][0];
                      //console.log(componentType);

                      switch(componentType){

                        case "route":
                        street = component['long_name'];
                        break;

                        case "street_number":
                        number = component['long_name'];
                        break;

                        case "postal_code":
                        zipcode = component['long_name'];
                        break;

                        case "locality":
                        city = component['long_name'];
                        break;

                        case "country":
                        country = component['long_name'];
                        break;

                      }
                  });
                }
            }).done(function(){
                address = street + " " + number + ", " + zipcode + " " + city + ", " + country;
                $("article.register div.register-box div.container section.step_2 aside.left form input[type='text']#search_location").val(address);
                $("article.register div.register-box div.container section.step_2 aside.left form input#street").attr("value",street);
                $("article.register div.register-box div.container section.step_2 aside.left form input#number").attr("value",number);
                $("article.register div.register-box div.container section.step_2 aside.left form input#zipcode").attr("value",zipcode);
                $("article.register div.register-box div.container section.step_2 aside.left form input#city").attr("value",city);
                $("article.register div.register-box div.container section.step_2 aside.left form input#country").attr("value",country);
                $("article.register div.register-box div.container section.step_2 aside.left form input#longitude").attr("value",longitude);
                $("article.register div.register-box div.container section.step_2 aside.left form input#latitude").attr("value",latitude);
            });

        }


        function setCenter(){
             markers.forEach(function(marker) {
              marker.setMap(null);
            });
            map.setCenter(new google.maps.LatLng(latitude+.006,longitude));
            var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude,longitude),
                    animation: google.maps.Animation.DROP,
                    icon: icon,
                    map: map,
            });
            $("#sounds").attr("src","sounds/notification.mp3");
            $("#sounds")[0].play();
            clearInterval(interval);
            $("article.register div.register-box div.container section.step_2 aside.left form div.loader-container").fadeOut();
            $("article.register div.register-box div.container section.step_2 aside.left form div#maps-api-container").animate({opacity: "1"});
            //$("article.register div.register-box div.container section.step_2 aside.left form div.scan-container").fadeOut();
            //$("article.register div.register-box div.container section.step_2 aside.left form div.scan-container").addClass("hide");
            $("article.register div.register-box div.container section.step_2 aside.left form input[type='button']").removeClass("locating");
        }


        var interval;
        function findMe(){
            $("article.register div.register-box div.container section.step_2 aside.left form div.loader-container").fadeIn();
            $("article.register div.register-box div.container section.step_2 aside.left form div#maps-api-container").animate({opacity: ".2"});
            var locate = ["locating ","locating .","locating ..","locating ..."];
            var locIndex = 0;
            interval = setInterval(function(){
                if(locIndex == locate.length-1){
                    $("article.register div.register-box div.container section.step_2 aside.left form div.loader-container p.location-loader").text(locate[locIndex]);
                    locIndex = 0;
                }else{
                    $("article.register div.register-box div.container section.step_2 aside.left form div.loader-container p.location-loader").text(locate[locIndex]);
                    locIndex++;
                }
            },300);

            $("article.register div.register-box div.container section.step_2 aside.left form input[type='button']").addClass("locating");
            //$("article.register div.register-box div.container section.step_2 aside.left form div.scan-container").removeClass("hide").fadeIn();
            //$("article.register div.register-box div.container section.step_2 aside.left form div.scan-container span.location-scanner").addClass("scanning");

            function success(position){

                latitude  = position.coords.latitude;
                longitude = position.coords.longitude;

                coordinates = [latitude,longitude];


                setAdress();
                setCenter();

            }

            function error(){
                $("article.register div.register-box div.container section.step_2 aside.left form input[type='button']").removeClass("locating");


                clearInterval(interval);
                $("article.register div.register-box div.container section.step_2 aside.left form div.loader-container p.location-loader").text("Something went wrong ...");

                setTimeout(function(){
                    $("article.register div.register-box div.container section.step_2 aside.left form div.loader-container").fadeOut();
                $("article.register div.register-box div.container section.step_2 aside.left form div#maps-api-container").animate({opacity: "1"});
                $("article.register div.register-box div.container section.step_2 aside.left form input[type='button']").removeClass("locating");
                },2000);
            }

            if (!navigator.geolocation){
                alert("not supported by browser");
                $("article.register div.register-box div.container section.step_2 aside.left form input[type='button']").removeClass("locating");
            }else{
                navigator.geolocation.getCurrentPosition(success, error);
            }


        }

      if($("div#maps-api-container").length){
          google.maps.event.addDomListener(window, 'load', initAutocomplete);

          $("article.register div.register-box div.container section.step_2 aside.left form input[type='button']").on("click",function(){
              findMe();
          });
      }

      function preloader(showing) {
          if(showing){
              if(!$("article.preloader").hasClass("show")){
                  $("article.preloader").addClass("show");
              }
          }else{
              $("article.preloader").removeClass("show");
          }
      }

});
