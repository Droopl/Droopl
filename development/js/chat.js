$(function  () {
	
	/*CHAT BUBBLES*/

	setInterval(function () {

		if($("section.chat ul li.conversation-bubble div.conversation.open").length){

			$("section.chat ul li.conversation-bubble div.conversation.open").each(function () {
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