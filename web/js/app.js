$(function  () {

	var convo_id = 1;
	var user_id = 1;
	
	function init () {

		$('.conversation nav input#message').on("keyup",function (e) {

			if(e.keyCode == 13){
				postMessage($(this).val());

				$(this).val("");
			}


		});
		updateChat();
	}

	function updateChat() {

		var url = "http://student.howest.be/rachouan.rejeb/OWN/chat_api/api/messages/2";

		$.ajax({
            url: url
        }).done(function (data) {


        	var htmlString = "";

        	$(data).each(function (key,val) {

        		if(val.id != user_id){
        			htmlString += "<li><p><span>"+val.message+"</span></p></li>";
        		}else{

        			htmlString += "<li><p class='me'><span>"+val.message+"</span></p></li>";
        		}
        		

        	});

        	$(".chat ul").html(htmlString);

        	var height = $(".chat ul").height();

        	height += '';
        	
			$('.chat').animate({scrollTop: height});
			
        });
        setTimeout(updateChat, 100);	
	}

	function postMessage (msg) {

		var message = msg;

		var url = "http://student.howest.be/rachouan.rejeb/OWN/chat_api/api/insertMessage";

		var sendInfo = {
		   user_id: user_id,
		   convo_id: 2,
		   message: message
		};

		$.ajax(
		    {
		        url : url,
		        type: "POST",
		        data : sendInfo,
		        success:function(data, textStatus, jqXHR) 
		        {
		            console.log(data);
		        },
		        error: function(jqXHR, textStatus, errorThrown) 
		        {
		            console.log(textStatus);
		        }
		    });

	}

	init();
});