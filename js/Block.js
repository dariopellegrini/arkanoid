function Block(x,y,width,height,color){
	this.x=x;
	this.y=y;
	this.width=width;
	this.height=height;
	this.color=color;
	this.visible=true;
}

Circle.prototype.setPosition = function(x,y){
	this.x=x;
	this.y=y;
}