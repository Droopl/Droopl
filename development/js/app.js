$(function  () {  

    var typing = false;
    var saveVal = "";

     checkNotification();
    
    setInterval(function () {

       if($("#menu .notifications ul.show").length == 0){
          $("#menu .notifications ul").load("index.php?page=feed .notifications ul li");

          checkNotification();
          
       }
        
        if($("article aside#side section.activity ul.progress").length){
            $.get("index.php?page=feed", function( data ) { 
                var $data = $(data);
                var activityLis = $data.find("article aside#side section.activity ul.progress li");
                $.each(activityLis,function(key,val){
                    var activityLi = $(val);
                    var dashOffset = activityLi.find("path").attr("stroke-dashoffset");
                    console.log(dashOffset);
                });
            });
        }
    },1000);

    


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


        console.log
      
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

          console.log(selected);
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
          console.log("submit");
          $("article.rating section footer form input#rating").attr("value",selected);
          console.log( $("article.rating section footer form input#rating"));

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

    if( $('article div.messages section.messages aside').length){

      

      $('article div.messages section.messages aside').stop().animate({
        scrollTop: $("article div.messages section.messages aside")[0].scrollHeight
      }, {
        duration:0,
      });
        
        $("article div.messages section.messages aside ul li").css("opacity","0");
        var messages = $("article div.messages section.messages aside ul li");
        var time = 0;
        $.each(messages,function(key,val){
            var message = $(val);
            setTimeout(function(){
                message.addClass("animated fadeInDown");
            },time);
            time+=35;
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

    if($("article div.feed section.post form div.collection").length){

          $("article div.feed section.post form div.collection").on("mouseover",function (e) {
          var diff = $(this).find('ul').outerWidth() - $(this).outerWidth();
          console.log(diff);

          if(diff >= 0){
              var mouseX = e.pageX - $(this).offset().left;
              var percentage = mouseX/$(this).width();
              console.log(diff*percentage);
              var mX = diff*percentage;
              var posX = 0;
              var damp = 150;
              var $th = $(this).find('ul');
              $th.css({
                left: -mX
              });
          }
        });
        /*var $bl    = $("article div.feed section.post form div.collection"),
        $th    = $("article div.feed section.post form div.collection ul"),
        blW    = $bl.outerWidth(),
        blSW   = $bl[0].scrollWidth,
        wDiff  = (blSW/blW)-1,  // widths difference ratio
        mPadd  = 60,  // Mousemove Padding
        damp   = 20,  // Mousemove response softness
        mX     = 0,   // Real mouse position
        mX2    = 0,   // Modified mouse position
        posX   = 0,
        mmAA   = blW-(mPadd*2), // The mousemove available area
        mmAAr  = (blW/mmAA);    // get available mousemove fidderence ratio



        $bl.on("mousemove",function(e) {
              mX = e.pageX - $(this).offset().left;
              mX2 = Math.min( Math.max(0, mX-mPadd), mmAA ) * mmAAr;
              console.log(mX2);
        });


        setInterval(function(){
          posX += (mX2 - posX) / damp; // zeno's paradox equation "catching delay"  
          $th.css({marginLeft: +posX*wDiff });
          console.log(posX);
        }, 10);*/
        //var leftVar = 0;
        /*$("article div.feed section.post form div.collection").on("mouseover",function (e) {
          var mouseX = e.pageX - $(this).offset().left;
          var diff = $(this).find('ul').outerWidth() - $(this).outerWidth();
          var $ul = $(this).find('ul');
          if(mouseX < $(this).outerWidth()/2){
              if(diff >= 0){
                  setInterval(function(){
                      if(leftVar <= diff){
                          $ul.animate({left: leftVar});
                          leftVar++;
                      }
                  }); 
              }
          }else{
              if(diff >= 0){
                  setInterval(function(){
                      $ul.animate({left: leftVar});
                      leftVar-=10;
                  },10);
              }
          }
        });*/

    }
    
            var obj = $("#dragndrop input[type='file']");
            obj.on('dragenter', function (e) 
            {
              console.log("enter");
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
                 var files = e.originalEvent.dataTransfer.files;

                 handleFileUpload(files,obj);
            });

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
                    console.log("sent");
                    var loadedMessages = $(data).find("div.messages section.messages aside ul li");

                   $(loadedMessages).each(function(key,newMessages){
                       
                       var found = false;
                    
                       $(messages).each(function(id,message){
                           
                           if($(newMessages).attr("id") == $(message).attr("id")){
                                found = true;
                           }
                       
                       });

                       if(!found){
                        console.log("adding");
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

          console.log('scroll');
          var objDiv = $("article div.messages section.messages aside");
          objDiv.scrollTop(objDiv.scrollHeight);
          $('article div.messages section.messages aside').stop().animate({
            scrollTop: $("article div.messages section.messages aside")[0].scrollHeight
          }, {
            duration:1500,
          });

        }
    }

    function handleFileUpload(files,obj){

      var reader = new FileReader();
      reader.readAsDataURL(files[0]);
      reader.onload = function (e) {

          obj.parent().parent().css('background-image','url('+e.target.result+')');
          obj.parent().parent().css('background-position', 'center');
          console.log(files[0]);
          var uploadFormData = new FormData($("#add_collection")[0]); 
          uploadFormData.append("collection_image",files[0]);
          console.log(uploadFormData);
      }
      
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
        $("article.search ul li.preloader").show();
      }else{
        $("article.search ul li.preloader").hide();
      }
      var url = "index.php?page=search"; // the script where you handle the form input.

      var formData = new FormData($(this).parent()[0]);

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
              var items = $(data).find(".search_results li");

              var quests = $("article.search ul li.quest");

              items.each(function (key,newquest) {

                  console.log("adding");

                  $(newquest).addClass("animated fadeIn").insertAfter("article.search ul li.preloader");

              });

              if($("article.search ul li.quest").length > 0){
                $("article.search ul li.preloader").hide();
              }
            }
           });



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
    })

    $("article div.feed section.quest footer a.proposal").on("click",getDetail);
    $("article aside#side section.quest ul li a").on("click",getDetail);
    function getDetail(e) {
      e.preventDefault();

      var url = $(this).attr("href");
      $.get( url, function( data ) { 

        var section = $(data).find(".feed");


        $("article.detail").removeClass("hide");
        section.addClass("animated fadeInUpBig").insertAfter("article.detail header.detail");
        $("article.detail div.feed section.quest footer.detail div.search-proposal form input[type='text']").on("focus",focusCollection);

        $("article.detail div.feed section.quest footer div.search-proposal form").on('submit',function (e) {
            e.preventDefault();
            console.log("submit");
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
                  console.log("longer");
                  if($("article.detail div.feed section.quest footer div.proposals-list ul div.no-proposals-container").length){
                      $("article.detail div.feed section.quest footer div.proposals-list ul div.no-proposals-container").remove();
                  }
                  for (var i = oldPropos.length; i < propos.length; i++) {
                    var newPropo = propos[i];
                    $(newPropo).addClass("animated fadeIn").appendTo("article.detail div.feed section.quest .proposals-list ul.list");
                  };

                }
              }
            });

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
          console.log("close");
          $("article.detail").addClass("hide");
          $("article.detail div.feed").remove();
          
        });
          
        $(window).on("keyup",function (e) {
            switch(e.keyCode){
              case 27:
               console.log("close");
               $("article.detail").addClass("hide");
               $("article.detail div.feed").remove();
              break;
            }
        });

      });


    }
    
    
    $("article div.feed section.quest header a.collection_item").on("click",getCollectionDetail);
    $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-menu ul li.edit a").on("click",getCollectionDetail);
    $("article aside#side section.collection ul li img").on("click",getCollectionDetail);
    $("article div.feed section.profile-collection ul li.profile-collection-item span.collection-item-detail").on("click",getCollectionDetail);
    
    function getCollectionDetail(e) {
      e.preventDefault();

      var id = $(this).attr("id");
      var url = "?page=item&id="+id;
      $.get( url, function( data ) { 

        var section = $(data).find(".feed");


        $("article.collection_item").removeClass("hide");
        section.addClass("animated fadeInUpBig").insertAfter("article.collection_item header.collection_item");
          
        $("article.collection_item div.feed section.detail-collection-item form").on("submit",editCollectionItem);
          
        $("article.collection_item div.feed section.detail-collection-item form aside a.close-collection-detail").on("click",function (e) {

          e.preventDefault();
          console.log("close");
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
    
    function editCollectionItem(e){
        
        e.preventDefault();
        
        if($(this).parent().hasClass("editable") && !$("article.collection_item div.feed section.detail-collection-item form header input[type='submit']#edit_item").hasClass("editable")){
        
            $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").addClass("editable");
            $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Save");

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
            
              var id = $("article.collection_item div.feed section.detail-collection-item").attr("id");
              var url = "index.php?page=update&id="+id; // the script where you handle the form input.

              var formData = new FormData($(this)[0]);

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
                               $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").addClass("saved").attr("value","Saved !");
                               setTimeout(function(){
                                   $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","");
                                   $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").removeClass("editable").removeClass("saved");
                                   $("article.collection_item div.feed section.detail-collection-item form aside header input[type='text']#item_name").blur();
                                   $("article.collection_item div.feed section.detail-collection-item form aside header input[type='text']#item_name").attr("readonly",true);
            $("article.collection_item div.feed section.detail-collection-item form aside textarea#item_description").attr("readonly",true);
                               },1000);
                           }else{
                               $("article.collection_item div.feed section.detail-collection-item form header input[type='submit']").attr("value","Error while saving ...");
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
          console.log(diff);

          if(diff >= 0){
              var mouseX = e.pageX - $(this).offset().left;
              var percentage = mouseX/$(this).width();
              console.log(diff*percentage);
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
                                                                                                                             
    function addCollectionItem(e) {
          e.preventDefault();

          $(window).on("keyup",function (e) {
            switch(e.keyCode){
              case 27:
               $("article.add_collection").addClass("hide");
               $("article.add_collection .feed").remove();
              break;
            }
          })

          var url = "?page=add";
          $.get( url, function( data ) { 
            console.log(data);
            var section = $(data).find(".feed");

            $("article.add_collection").removeClass("hide");
            section.addClass("animated fadeInUpBig").insertAfter("article.add_collection header.add_collection");
              
            var obj = $("#dragndrop input[type='file']");
            obj.on('dragenter', function (e) 
            {
              console.log("enter");
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
                 var files = e.originalEvent.dataTransfer.files;

                 handleFileUpload(files,obj);
            });

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
      var img = $(this).parent().find("img");
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
    
    $("section.chat ul li.new-conversation span.new-icon").on("click",function(){
        var thisConvo = $(this);
        var bubbles = $("section.chat ul li.conversation-bubble");
        
        if($(this).hasClass("close")){
            $("section.chat ul li.new-conversation form#new-conversation-form ul").animate({opacity:"0"},150);
            setTimeout(function(){
                $("section.chat ul li.new-conversation form#new-conversation-form ul").slideUp(300);
            },150);
            setTimeout(function(){
                thisConvo.removeClass("close");
                $("section.chat ul li.new-conversation form#new-conversation-form").removeClass("show");
            },450);
        }else{
            $("div.conversation footer ul").css("opacity","0");
            $("div.conversation footer form").css("opacity","0");
            $("div.conversation footer").slideUp(300);
            $("div.conversation").removeClass("open");
            $(".close-conversation").animate({opacity:"0"},100);
            $("span.offline-conversation").animate({opacity:"1"},80);
            $.each(bubbles,function(key,val){
              var bubble = $(val);
              if(!bubble.find("span.offline-conversation").length){
                  bubble.find("img").removeClass("light");
              }
            });
            
            $(this).addClass("close");
            $("section.chat ul li.new-conversation form#new-conversation-form").addClass("show");
            setTimeout(function(){
                $("section.chat ul li.new-conversation form#new-conversation-form ul").slideDown(300);
            },200);
            setTimeout(function(){
                $("section.chat ul li.new-conversation form#new-conversation-form ul").animate({opacity:"1"},150);
            },500);
        }
    });

    function checkNotification(){
        if($("header#menu nav ul li.notifications ul li.notseen").length){
            $("header#menu nav ul li.notifications span.icon-bell").addClass("notif animated swing infinite");
        }else{
          if($("header#menu nav ul li.notifications span.icon-bell").hasClass()){
             $("header#menu nav ul li.notifications span.icon-bell").removeClass("notif animated swing infinite");
           }
        }
    }

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
              console.log(e.target.result)

              $('#quest .upload_image').addClass('animated fadeOut');
              $('#quest .uploaded_image').removeClass("hide");
              $('#quest .uploaded_image').on("click",function () {
                $(this).addClass("hide");
                $(this).prev().removeClass('animated fadeOut');
                $(this).prev().addClass('animated fadeIn');
              });
              $('#quest .uploaded_image img').attr("src",e.target.result);
              $('#quest .uploaded_image').addClass("animated fadeIn");
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#quest input[type='file']").change(function(){
        readURL(this);
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
        if($(this).val() == ""){
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
      e.preventDefault();
	    var url = "index.php?page=feed"; // the script where you handle the form input.

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
              console.log(data);
                    $("#quest input[type='text']").val("");
                    var quests = $(".feed .quest");
	           		console.log("sent");
				    var feed = $(data).find(".feed .quest");
                   
                   $(feed).each(function(key,newquest){
                       
                     var found = false;
                  
                     $(quests).each(function(id,quest){
                         
                         if($(newquest).attr("id") == $(quest).attr("id")){
                              found = true;
                         }
                     
                     });

                     if(!found){
                     	console.log("adding");

                     	$(newquest).addClass("animated fadeIn").insertAfter(".feed .post");

                     	 //$(".feed").insertAfter($(newquest).addClass("animated fadeInDown"));
                     		//$(".feed").prepend($(newquest).addClass("animated fadeInDown"));
                     }
                       
                   });
                   
                    $("article div.feed section.quest footer a.proposal").on("click",getDetail);

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
    
    $("#login").submit(function(e) {
        var url = "index.php?page=login"; // the script where you handle the form input.

        $.ajax({
            type: "POST",
            url: url,
            data: $("#login").serialize(),
            // serializes the form's elements.
            success: function(data) {
                var bool = $(data).find("#loggedin").html();
                console.log(bool);
                $("#login").removeClass();
                if (bool == "false") {
                    $("#login").addClass("animated shake");
                    setTimeout(function() {
                        $("#login").removeClass();
                    }, 1000);
                } else {
                    $(".inner-form-container input").animate({opacity:"0"});
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
                    /*setTimeout(function() {
                        $(location).attr('href', "?page=feed");
                    }, 2000);*/
                }
            }
        });

        return false;
    });

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
  })

	$(window).scroll(function  () {

      console.log("scroll")

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
            
    });

	$("header#menu div nav ul li.notifications .icon-bell").on("click",function  () {

		$("header#menu div nav ul li.profile img").next().removeClass("show");
		if($(this).next().hasClass("show")){
			$(this).next().removeClass("show");
		}else{
			$(this).next().addClass("show");
      $(this).parent().find("ul").on("scroll",function () {
        var elements = $(this).find("li");

        elements.each(function (key,val) {
          if(isNotificationScrolledIntoView($(val))){
            if($(val).hasClass("notseen")){
              console.log("seen");
              
              var id =$(val).attr("id");
              var data = {"notification_id": id};

              $.ajax({
               type: "POST",
               url: "?page=feed",
               data: data,
               success: function(data) {
                  $(val).removeClass("notseen");
                  checkNotification();
               }
              });
            }
            
          }else{

            if($(val).hasClass("notseen")){
              console.log("not ye seen");
            }
            
          }
        });

      });
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
    $(".switch-container").on("click",function(){ 
        
        var lang = $("div.js-language").html();
        
        if(bool){
        
            if(!$(".button").hasClass("offering-mode")){
                bool = false;
                switch(lang){

                    case 'en':
                    $("article div.feed section.post form div input#item").attr("placeholder", "What are you offering ?");
                    break;

                    case 'fr':
                    $("article div.feed section.post form div input#item").attr("placeholder", "Qu'est-ce que vous proposez ?");
                    break;

                    case 'nl':
                    $("article div.feed section.post form div input#item").attr("placeholder", "Wat wil je uitlenen ?");
                    break;

                    default:
                    $("article div.feed section.post form div input#item").attr("placeholder", "What are you offering ?");
                    break;
                }

                $(".button").removeClass("looking-mode").addClass("offering-mode");
                $("article div.feed section.post form div input#type").attr("value", "1");
                $("article div.feed section.post form div input#quest_submit").addClass("offering-bg");
                $("article div.feed section.post form div span.upload_image").removeClass("animated fadeIn");
                $("article div.feed section.post form div span.upload_image").animate({"opacity": 0},200);
                $("article div.feed section.post form div span.upload_image input[type='file']").hide();
                $("article div.feed section.post form div.collection ul li").removeClass("fadeOutUp");

                $("article div.feed section.post div input#item").select();
                $("article div.feed section.post div input#item").on("keyup",function () {
                  $("article div.feed section.post form div.collection ul li")
                  var itemName = $(this).val().toLowerCase();
                  console.log(itemName);
                  var collectionItems = $("article div.feed section.post form div.collection ul li p span");

                  $.each(collectionItems,function (id,item) {
                    console.log($(item).text());

                    var itemText = $(item).text().toLowerCase();

                    if(itemText.indexOf(itemName) != -1){
                      console.log("found");
                      $(item).parent().parent().fadeIn();
                    }else{
                      console.log("not found");
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
                $("article div.feed section.post form div span.upload_image input[type='file']").show();
                $("article div.feed section.post form div span.upload_image").animate({"opacity": 1},200);
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
    });
    
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
            console.log("click");
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
        console.log("click");
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
        console.log("click");
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

      $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            success: function(data) {

              var section = $(data).find(".feed");


              $("article.add_collection").removeClass("hide");
              section.addClass("animated fadeInUpBig").insertAfter("article.add_collection header.add_collection");


              var obj = $("article.add_collection #dragndrop input[type='file']");
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
              obj.on('drop', function (e) 
              {
               
                   $(this).parent().parent().css('border', 'none');
                  $(this).parent().parent().addClass("containFile");
                   var files = e.originalEvent.dataTransfer.files;

                   handleFileUpload(files,obj);
              });



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
        $("article.new-conversation").addClass("show");
         $("article.new-conversation").animate({opacity: 1},200);
    });
    
    $("article.new-conversation form#new-conversation-form span.close-new-conversation").on("click",function(){
        $("article.new-conversation").animate({opacity: 0},200);
        setTimeout(function(){
            $("article.new-conversation").removeClass("show");
        },200);
    });
    
    
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
    };
    
    function initialize() {

        var userCoordinates = $("div.user-coordinates").html().split(" ");
        var userLatitude = parseFloat(userCoordinates[0])-0.004;
        var userLongitude = parseFloat(userCoordinates[1]);
        console.log(userLongitude);
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
});