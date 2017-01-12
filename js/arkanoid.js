$(document).ready(function(){
	g1 = new Game(20,7,6);
	startGame(g1);

});

function startGame(g){

	g.countDown();
}