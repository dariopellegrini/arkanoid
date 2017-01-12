var time;
var difficulty;
var quantum;
var circle;
var level = 1;
var blockNumber;
var points = 0;
var pointsWindowGap = 12;
var gameLose=false;

/* Costruttore. */

function Game(_time, _quantum, _blockNumber){
	time = _time;
	quantum = _quantum;
	canvas = document.getElementById("my_canvas");
	
	blockNumber = _blockNumber;
}

/* Inizializzazione del gioco. */

function init(){	
	
	window_width = canvas.width;
	window_height = canvas.height-pointsWindowGap;
	
	block_width = 97;
	block_height = 20;
	red_bar_w = 30;
	
	block_height_plus=35; // Altezza dei blocchi colorati.
	
	circle_radius = 6;
	
	dx=-quantum;
	dy=-quantum;
	

	blockList=new Array();
	main_block = new Block(300-block_width/2,window_height-block_height/2,block_width,block_height/2,"green");
	circle = new Circle(main_block.x+main_block.width/2,main_block.y-circle_radius*2,circle_radius,"red");
	
	var positionX=1;
	var positionY=1;
	var colors =["red","blue","green","yellow","orange","purple","aqua"];
	var newline = window_width/block_width;
	for(var i=0; i<blockNumber; i++){
	
		if(positionX>window_width){
			positionX=1;
			positionY+=block_height_plus+1;
		}
		var color = colors[Math.floor(Math.random()*colors.length)];
		blockList[i]=new Block(positionX, positionY,block_width,block_height_plus,color);
		positionX+=block_width+1;
	}
	
//	canvas.onmousemove = moveBlock;
}

/* Avvio del timer. */

function startTick(){

	timer = setInterval(function(){
	tick();
	paint();
	}, time);
	
	
	canvas.onmousemove = moveBlock;
//	canvas.onmouseout = pauseGame;
}

/* Metodo paint richiamato a ogni iterazione. */

function paint(){

	var context = canvas.getContext('2d');
	
	context.lineWidth = 1;
	context.strokeStyle = 'black';
	
	// Cancello il vecchio canvas e metto un bordo
	context.clearRect(0, 0, canvas.width, canvas.height);
	
	
	
	// Disegno la pallina.
	context.beginPath();
	context.arc(circle.x, circle.y, circle.radius, 0, 2 * Math.PI, false);
	context.fillStyle = circle.color;
	context.fill();
	context.stroke();
	
	// Disegno il blocco principale.
	
	 context.beginPath();
	 context.fillStyle=main_block.color;
     context.fillRect(main_block.x, main_block.y, main_block.width, main_block.height);
     context.fillStyle="red";
     context.fillRect(main_block.x+main_block.width/2-red_bar_w/2, main_block.y, red_bar_w, main_block.height);
     context.strokeRect(main_block.x, main_block.y, main_block.width, main_block.height);
     context.stroke();
     // Disegno i mattoncini.
     
     var b;
     for(var i=0; i<=blockList.length-1; i++){
		b = blockList[i];
//		alert(b);
		if(b.visible==true){
			context.beginPath();
			context.fillStyle=b.color;
			context.fillRect(b.x, b.y, b.width, b.height);
			context.strokeRect(b.x, b.y, b.width, b.height);
			context.stroke();
		}
		
	}
	// Scrivo il punteggio, creando un'apposita sezione sotto la finestra di gioco.
	
	context.clearRect(0, window_height, canvas.width, canvas.height-window_height);
	context.strokeRect(0, window_height, window_width, canvas.height-window_height);
	
	context.fillStyle = "black";
	context.font = "bold 10px Arial";
	context.fillText("Points:" + points,1,window_height+10);
	
	if(gameLose==true){
		context.clearRect(0, 0, canvas.width, canvas.height);
		context.fillStyle = "black";
		context.font = "bold 45px Arial";
		context.fillText("GAME OVER",1,46);
		
		context.font = "bold 30px Arial";
		context.fillText("Livello raggiunto: " + level,1,46*2);
		context.fillText("Punteggio: " + points,1,46*3);

		}
	
}

/* Metodo richiamato ogni quanto di tempo. */

function tick(){
	var x0 = circle.x;
	var y0 = circle.y;
	var red_bar_x = main_block.x+main_block.width/2;

	if(blockNumber==0){
		winGame();
		return 1;
		}
	if(checkSovrapposition(circle, main_block)){
		y0 = main_block.y-20;
		dy*=-1;	
	}
	else
	if(x0+circle.radius>=window_width || x0-circle.radius<=0 
		|| contact(circle,main_block)=="horizontal")dx*=-1;
		
	else
	if(y0-circle.radius<=0) dy*=-1; 
	else
	if(contact(circle,main_block)=="vertical"){
		if(x0>red_bar_x-red_bar_w/2 && x0<red_bar_x+red_bar_w/2) dy=2*quantum;
			else dy = quantum;
			dy*=-1;
	}
	else
	if(y0+circle.radius>=window_height) loseGame();
	

	for(var i=0; i<blockList.length; i++){
		
		if(contact(circle, blockList[i])=="vertical"
			&& blockList[i].visible==true){
			blockList[i].visible=false;
			dy*=-1;
			blockNumber--;
			points+=10;
		}
		else
		if(contact(circle, blockList[i])=="horizontal"
			&& blockList[i].visible==true){
			blockList[i].visible=false;
			dx*=-1;
			blockNumber--;
			points+=10;
		}
	}
	
	var X = x0 + dx;
	var Y = y0 + dy;
	
	if(X+circle.radius>window_width)X=window_width-circle.radius;
	
	if(X-circle.radius<0)X=circle.radius;
	
	if(Y-circle.radius<0)Y=circle.radius;
	
	if(Y+circle.radius>main_block.y && X>main_block.x && X<main_block.x+main_block.width) Y=main_block.y-circle.radius;
	
	/*
	if(X+circle.radius>main_block.x && X<main_block.x+2*circle.radius && Y+circle.radius>main_block.y) 
		X=main_block.x-circle.radius;
	
	if(X-circle.radius<main_block.x+main_block.width && X>main_block.x+main_block.width-2*circle.radius && Y+circle.radius>main_block.y)
		X=main_block.x+main_block.width+circle.radius;
	*/
	circle.setPosition(X,Y);
	
}

/* Metodo che controlla il contatto tra la pallina e un blocco. */

function contact(circle, block){
	var radius = circle.radius;
	var cx = circle.x;
	var cy = circle.y;
	var bx = block.x;
	var by = block.y;
	var w = block.width;
	var h = block.height;
	var cx = circle.x-radius;
	var cy = circle.y-radius;
	
	
	// Angolo superiore sinistro
	// Andava bene anche
	/*
		if( (cx>=bx && cx<=bx+w) && (cy>=by && cy<=by+h) ){
		if(-(bx+w)+cx<(by+h)-cy) return "horizontal";
			else
				return "vertical";
	}
	*/
	
	
	if( (cx>=bx && cx<=bx+w) && (cy>=by && cy<=by+h) ){
		if((bx+w)-cx>(by+h)-cy) return "vertical";
			else
				return "horizontal";
	}
	else
	
	// Angolo superiore destro
	if( (cx+2*radius>=bx && cx+2*radius<=bx+w) && (cy>=by && cy<=by+h)){
		if( (cx+2*radius)-bx<(by+h)-cy ) return "horizontal";
			else
				return "vertical";
	}
	else
	
	// Angolo inferiore sinistro
	if( (cx>=bx && cx<=bx+w) && (cy+2*radius>=by && cy+2*radius<=by+h) ){
		if((cy+2*radius)-by>(bx+w)-cx) return "horizontal";
			else
				return "vertical";
	}
	else
	
	// Angolo inferiore destro
	if( (cx+2*radius>=bx && cx+radius*2<=bx+w) && (cy+2*radius>=by && cy+2*radius<=by+h) ){
		if((cx+2*radius)-bx<(cy+2*radius)-by) return "horizontal";
			else
				return "vertical";
	}
	else
	
	return "none";
	
	/*
	
	if(distance(cx+radius,bx)<=0) return "horizontal";
	else
	if(distance(cx,bx+w)<=0) return "horizontal";
	else
	if(distance(cy+radius,by)<=0) return "vertical";
	else
	if(distance(cy,by+h)<=0) return "vertical";
	else
	return "none";
	*/
}
/*
function distance(x,y){
	return Math.sqrt(x*x+y*y);
}
*/

/* Metodo che controlla sovrapposizioni tra cerchio e blocco. */

function checkSovrapposition(circle, block){
	var radius = circle.radius;
	var cx = circle.x;
	var cy = circle.y;
	var bx = block.x;
	var by = block.y;
	var w = block.width;
	var h = block.height;
	var cx = circle.x-radius;
	var cy = circle.y-radius;
	
	var gap=6;
		if( (cy+2*radius<by+h-gap && cy+2*radius>by+gap && cx<bx+w-gap && cx>bx+gap)
		|| (cy<by+h-gap && cy>by+gap && cx<bx+w-gap && cx>bx+gap) 
		|| (cx+2*radius<bx+w-gap && cx+2*radius>bx+gap && cy<by+h-gap && cy>by+gap) 
		|| (cx+2*radius<bx+w-gap && cx+2*radius>bx+gap && cy+2*radius<by+h-gap && cy+2*radius>by+gap) ) return true;
	
	return false;
}

/* Ritorna il valore del delta. */

function getDelta(val){
	var d=-val;
//	if(difficulty=="easy")return d;
	
	var step = 10;
	d = (d > 0 ) ? step : -step;
	return d;
}

/* Metodo chiamato alla vittoria del livello. Inizializza un altra istanza di gioco rendendo più difficili i parametri. */

function winGame(){
	clearInterval(timer);
	alert("Hai vinto il livello " + level + ". Prosegui al successivo...");

	level++;
	if(time>5)time-=1;
	if(quantum>block_height_plus-circle_radius)quantum+=3;
	
	if(blockNumber<43)blockNumber=6*level;
	
	g = new Game(time, quantum, blockNumber);
	g.countDown();
	
}

/* Metodo chiamato al Game Over. */

function loseGame(){
	alert("Hai perso la partita. Il tuo punteggio: " + points);
	gameLose=true;
	clearInterval(timer);
	postPoints();
	displayScores();
}

/* Funzione per muovere il blocco al movimento del mouse. */

var moveBlock = function(e){

/*
	if(pause){
		pause=false;
		timer = setInterval(function(){
				tick();
					paint();
				}, time);
		}
		*/
		
	main_block.x=e.pageX-canvas.offsetLeft-block_width/2;
}

/* Metodo da cui parte tutto. Avvia il countdown. */

Game.prototype.countDown = function(){
	var n = 3;
	cd = setInterval(function(){displayNumber(n);n--;}, 1000);
}

/* Visualizza il livello, il numero di blocchi e il numero del countdown. */

function displayNumber(n){
	if(n>0){
		var context = canvas.getContext("2d");

		context.clearRect(0, 0, canvas.width, canvas.height);
		context.fillStyle = "black";
		context.font = "bold 45px Arial";
		context.fillText("Level " + level + ": ",1,46);
		
		context.font = "bold 30px Arial";
		context.fillText("Blocks: " + blockNumber,1,46*2);

		context.font = "bold 60px Arial";
		context.fillText(n, canvas.width/2, canvas.height/2);
		
	}
	else{
		clearInterval(cd);
		init();
		startTick();
	}
	
}

/* Effettua una chiamata AJAX per inserire il punteggio nel DB. */

function postPoints(){

	if(points==0) points="";
	
	$.ajax({
		type: "POST",
		url: "inserisciPunteggio.php",
		data: "punti="+points,
		cache: false,
		success: function(dat) {
			$("#classifica_pagina_gioco").append(dat);
			}
		});
}

function displayScores(){
	$("#classifica_container").fadeIn();
}
