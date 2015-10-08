$(function () {

	var gameStarted = false;

	if($(".notfound").length){
		$(window).on("keydown",function () {
			if(!gameStarted){
				gameStarted = true;
				$(".notfound header:first-child h1").removeClass("fadeInDown");
				$(".notfound header:first-child img").removeClass("fadeInDown");
				$(".notfound header:first-child h2").removeClass("fadeInUp");
				$(".notfound header:first-child h3").removeClass("fadeInUp");
				$(".notfound header:first-child h1").addClass("fadeOutUp");
				$(".notfound header:first-child img").addClass("fadeOutUp");
				$(".notfound header:first-child h2").addClass("fadeOutDown");
				$(".notfound header:first-child h3").addClass("fadeOutDown");
				startGame();
			}
		})
    }

	function startGame () {
		
		var coins = [];
		var lives = 3;
		var points = 0;
		var canvas = document.getElementById("cnvs");
		canvas.width = $(canvas).parent().width();
		canvas.height = $(canvas).parent().height();
		var context = canvas.getContext("2d");
		var coinsprite = [document.getElementById("coin"), document.getElementById("coin2"), document.getElementById("coin3")];

		var xpos = $(canvas).parent().width()/2;
		var speed = $(canvas).width()/20;
		var character = createCharacter(xpos,$(canvas).height(),speed,document.getElementById("manu"));

		for (var i = 0; i < lives; i++) {
			$(".notfound header nav ul").append($("<li/>").addClass("animated pulse infinite"));
		};

		$(window).on("keydown",function(e){

			if(gameStarted){
			  switch(e.keyCode){
			    case 37:
			    character.xPos -= character.speed;
			    break;

			    case 39:
			    character.xPos += character.speed;
			    break;
			  }
		  }

		});


		var draw = setInterval(function () {


		  if(character.xPos <= 0){
		    character.xPos = 0;
		  }else if(character.xPos + 150 >= canvas.width){
		  	character.xPos = canvas.width-150;
		  }

		  context.clearRect(0, 0, canvas.width, canvas.height);
		  
			var characterImg = document.getElementById("manu");
			context.drawImage(character.img,character.xPos,character.yPos-150);

		  for (var i = coins.length - 1; i >= 0; i--) {
		  	var coin = coins[i];
		  	if(coin.yPos < $(canvas).height()){

		  		coin.count++;
		  		if(coin.count == 39){
		  			coin.count = 0;
		  		}

		  		if(coin.yPos >= character.yPos-140 && coin.xPos > character.xPos  && coin.xPos < character.xPos + 140){
		  			points++;
		  			console.log(points);
		  			$("article section.notfound header div.points p").text(points);
		  			if($("article section.notfound header div.points img").hasClass("animated bounce")){
		  				$("article section.notfound header div.points img").addClass("animated bounce");
		  			}
		  			coins.splice(coins.indexOf(coin),1);
		  		}
		  		var index = parseInt(coin.count/10);
		  		var url = "coin"+index;

		  		var coinImg = document.getElementById(url);
		  		context.drawImage(coinImg,coin.xPos,coin.yPos);
			  	coin.yPos += coin.speed;
		  	}else{

		  		coins.splice(coins.indexOf(coin),1);

		  		lives--;

		  		if(lives != 0){

			  		var hearts = $(".notfound header nav ul li");

			  		for (var i = hearts.length; i > lives-1; i--) {
			  			var heart = hearts.get(i);
			  			$(heart).removeClass("pulse infinite");
			  			$(heart).addClass("fadeOutUp");
			  			setTimeout(function () {
			  				$(heart).remove();	
			  			},1000);
			  		};
		  			
		  		}else{

		  			$(".notfound header nav ul li").removeClass("pulse infinite");
			  		$(".notfound header nav ul li").addClass("fadeOutUp");
		  			stopGame();
		  		}

		  	}
		  	

		  };

		});

		var coinsInterval = setInterval(function () {

			var x = Math.floor((Math.random() * ($(canvas).width() - 50) ) + 50);
			coins.push(createCoint(x,0,1,0,0));


		},1000);

		function stopGame () {

			$(".notfound header:first-child h1").removeClass("fadeOutUp");
			$(".notfound header:first-child img").removeClass("fadeOutUp");
			$(".notfound header:first-child h2").removeClass("fadeOutDown");
			$(".notfound header:first-child h3").removeClass("fadeOutDown");
			$(".notfound header:first-child h1").addClass("fadeInDown");
			$(".notfound header:first-child img").addClass("fadeInDown");
			$(".notfound header:first-child h2").addClass("fadeInUp");
			$(".notfound header:first-child h3").text("Press any key to restart");
			$(".notfound header:first-child h3").addClass("fadeInUp");

			console.log("stopGame");
			clearInterval(coinsInterval);
			clearInterval(draw);
			context.clearRect(0, 0, canvas.width, canvas.height);
			gameStarted = false;

		}

	}

	function createCharacter (xPos,yPos,speed,img) {
		return { xPos:xPos, yPos:yPos,speed:speed,img:img}
	}

	function createCoint (xPos,yPos,speed,frame,count) {
		return { xPos:xPos, yPos:yPos,speed:speed,frame:frame,count:count}
	}
	
});