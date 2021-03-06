$(function  () {
	
	/*CHAT BUBBLES*/
	if($("section.chat ul li.conversation-bubble div.conversation form").length){

	$("section.chat ul li.conversation-bubble div.conversation form").on("submit",function (e) {

                e.preventDefault();
      var url = $(this).attr("action"); // the script where you handle the form input.
      var form = $(this);
      var formData = new FormData($(this)[0]);


     form.parent().parent().find("ul").addClass("loading");

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

                        var ul = form.parent().parent().find("ul");
                        ul.removeClass("loading");
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
		
		$("section.chat ul li.conversation-bubble div.conversation ul").on("scroll",function (e) {
			if($(this).scrollTop()<= 0){

				var conversation = $(this).parent().parent();
				var id = conversation.attr("id");
				var part = parseInt(conversation.find("ul").attr("id")) + 1;
				$.get( "?page=messages&id="+id+"&part="+part, function( data ) {

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
                        ul.attr("id",part);
                        ul.prepend($(newMessages).addClass("animated slideInUp"));

                       }
                  });





				});

			}
		});
		
	
	}

});