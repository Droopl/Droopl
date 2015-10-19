$(function  () {
	
	/*CHAT BUBBLES*/

	setInterval(function () {

		if($("section.chat ul li.conversation-bubble div.conversation").length){

			if($("section.chat ul li.conversation-bubble div.conversation.open ul li.notseen").length){
				$("section.chat ul li.conversation-bubble div.conversation.open ul li.notseen").each(function () {

					var id = $(this).attr("id");
					console.log(id);
					$.get( "?page=messages&action=seen&messageid="+id, function( data ) {
						console.log(data);
					});
				});
				
			}

			$("section.chat ul li.conversation-bubble div.conversation").each(function () {

				if($(this).hasClass("open")){

					var conversation = $(this);
					var id = $(this).attr("id");
					var url = "?page=messages&id="+id
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
					  			console.log("new message");

					  			if(currentConvo.find("span.new-msg").length){
					  				console.log("already");
					  			}else{
					  				var pulse = $("<span/>").addClass("new-msg animated-slow infinite pulse");
					  				currentConvo.append(pulse);
					  				 $("#sounds").attr("src","sounds/notification.mp3");
                        			$("#sounds")[0].play();
					  			}
					  		}
					  	}

					  })
					});
				}
			});




		}


		console.log("interval");
	},1000);

	if($("section.chat ul li.conversation-bubble div.conversation form").length){

	$("section.chat ul li.conversation-bubble div.conversation form").on("submit",function (e) {

                e.preventDefault();
      var url = $(this).attr("action"); // the script where you handle the form input.
      var form = $(this);
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

                   form.find("input").val("");
                    var messages = form.parent().parent().find("ul li");
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

                        var ul = form.parent().parent().find("ul");

                        ul.append($(newMessages).addClass("animated slideInUp"));

                         var objDiv = form.parent().parent().find("ul");
                         console.log(objDiv);
                        objDiv.stop().animate({
                          scrollTop: objDiv[0].scrollHeight
                        }, {
                          duration:1500,
                        });

                       }
                  });
                }
              });

            });
	}

});