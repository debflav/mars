/*
* Constructeur
*/

Ai = Ai = function(height, width, typeOfGame) {
    this.MAP_HEIGHT = height - 1;
    this.MAP_WIDTH = width - 1;
    this.TYPE_OF_GAME = typeOfGame;

    this.direction = {
		N: 0,
		NE: 0,
		NW: 0,
		W: 0,
		SW: 0,
		S: 0,
		SE: 0,
		E: 0
    };
    this.position = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};

    if(this.TYPE_OF_GAME == 1) {
        this.destination = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
    }
    this.model = this.emptyMap();
    this.lookingForWay();

};

Ai.prototype.lookingForWay = function() {
	
};

Ai.prototype.emptyMap = function() {
	var map = [];
	for (var i = 0; i <= this.MAP_WIDTH; i++) {
		map[i] = [];
	}

	for(var i = 0; i <= this.MAP_WIDTH; i++) {
		for(var j=0; j<= this.MAP_HEIGHT; j++) {
			map[i][j] = {
				z: null,
				type: null,
				blackList: null
			};
			//console.log(map);
		}
	}
	return map;
};