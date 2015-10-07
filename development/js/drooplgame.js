$(function () {

	if($(".notfound").length){
      startGame();
    }

	function startGame () {
		
		var coins = [];
		var canvas = document.getElementById("cnvs");
		canvas.width = $(canvas).parent().width();
		canvas.height = $(canvas).parent().height();
		var context = canvas.getContext("2d");
		var coinsprite = [document.getElementById("coin"), document.getElementById("coin2"), document.getElementById("coin3")];

		var xpos = $(canvas).parent().width()/2;
		var speed = $(canvas).width()/20;

		$(window).on("keydown",function(e){

		   console.log(e.keyCode);

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

		  		console.log(index)

		  		var url = "coin"+index;

		  		var coinImg = document.getElementById(url);
		  		context.drawImage(coinImg,coin.xPos,coin.yPos);
			  	coin.yPos += coin.speed;
		  	}else{

		  		coins.splice(coins.indexOf(coin),1);
		  	}
		  	

		  };

		  context.fillStyle = "#FF7F66";
		  context.fillRect(xpos,canvas.height - 40,40,40);
		});

		setInterval(function () {

			coins.push(createCoint(0,0,1,0,0));


		  console.log(coins);

		},1000);

	}

	function createCoint (xPos,yPos,speed,frame,count) {
		return { xPos:xPos, yPos:yPos,speed:speed,frame:frame,count:count}
	}
	
});