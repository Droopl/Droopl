$(function  () {
	
	/*CHAT BUBBLES*/


	$("section.chat ul li.conversation-bubble div.conversation form").on("submit",function (e) {
		e.prevetDefault();
		console.log("message sending ... ");
	});

});