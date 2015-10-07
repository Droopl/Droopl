$(function () {

	if($(".notfound").length){
      startGame();
    }

	function startGame () {


	
	var canvas = document.getElementById("cnvs");
	canvas.width = $(canvas).parent().width();
	canvas.height = $(canvas).parent().height();
	var context = canvas.getContext("2d");

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

	  context.fillStyle = "#FF7F66";
	  context.fillRect(xpos,canvas.height - 200,40,40);
	});

	}
	
});