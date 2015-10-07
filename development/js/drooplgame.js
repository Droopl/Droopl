$(function () {

	if($(".notfound").length){
      startGame();
    }

	function startGame () {
		
		var coins = [];
		var lives = 3;
		var canvas = document.getElementById("cnvs");
		canvas.width = $(canvas).parent().width();
		canvas.height = $(canvas).parent().height();
		var context = canvas.getContext("2d");
		var coinsprite = [document.getElementById("coin"), document.getElementById("coin2"), document.getElementById("coin3")];

		var xpos = $(canvas).parent().width()/2;
		var speed = $(canvas).width()/20;

		for (var i = 0; i < lives; i++) {
			$(".notfound header nav ul").append($("<li/>").addClass("animated pulse infinite"));
		};

		$(window).on("keydown",function(e){


		  switch(e.keyCode){
		    case 37:
		    xpos -= speed;
		    break;

		    case 39:
		    xpos += speed;
		    break;

		    case 40:
		    jump ++;
		    break;
		  }

		});

		setInterval(function () {


		  if(xpos <= 0){
		    xpos = 0;
		  }else if(xpos >= canvas.width){
		    xpos = canvas.width-40;
		  }

		  context.clearRect(0, 0, canvas.width, canvas.height);

		  for (var i = coins.length - 1; i >= 0; i--) {
		  	var coin = coins[i];
		  	if(coin.yPos < $(canvas).height()){

		  		coin.count++;
		  		if(coin.count == 39){
		  			coin.count = 0;
		  		}

		  		var index = parseInt(coin.count/10);
		  		var url = "coin"+index;

		  		var coinImg = document.getElementById(url);
		  		context.drawImage(coinImg,coin.xPos,coin.yPos);
			  	coin.yPos += coin.speed;
		  	}else{

		  		coins.splice(coins.indexOf(coin),1);

		  		lives--;

		  		console.log("lost a life");

		  		if(lives != 0){

			  		var hearts = $(".notfound header nav ul li");

			  		for (var i = hearts.length; i > lives-1; i--) {
			  			var heart = hearts.get(i);
			  			$(heart).removeClass("pulse infinite");
			  			$(heart).addClass("fadeOutUp");
			  		};
		  			
		  		}else{
		  			stopGame();
		  		}



		  		

		  	}
		  	

		  };

		  context.fillStyle = "#FF7F66";
		  context.fillRect(xpos,canvas.height - 40,40,40);
		});

		setInterval(function () {

			var x = Math.floor((Math.random() * $(canvas).width()) + 20);
			coins.push(createCoint(x,0,1,0,0));


		},3000);

		function stopGame (context) {
			console.log("stopGame");
			context.clearRect(0, 0, canvas.width, canvas.height);
		}

	}

	

	function createCoint (xPos,yPos,speed,frame,count) {
		return { xPos:xPos, yPos:yPos,speed:speed,frame:frame,count:count}
	}
	
});