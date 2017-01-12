function Circle(x,y,radius,color){
	//Coordinate del centro.
	this.x=x;
	this.y=y;
	this.radius=radius;
	this.color=color;
}

Circle.prototype.setPosition = function(x,y){
	this.x=x;
	this.y=y;
}

