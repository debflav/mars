/**
 *
 * Constructeur
 */
Rover = Rover = function(height, width) {
    this.MAP_HEIGHT = height;
    this.MAP_WIDTH = width;
    this.ENERGY = 100;
    this.SCORE = 0;
};

/**
 * Initialisation du rover
 */
Rover.prototype.init = function() {
    this.rover_pos = [{x:Math.floor((Math.random()*this.MAP_HEIGHT)+0), y:Math.floor((Math.random() * this.MAP_WIDTH)+0)}];
};

/**
 * Bouge le Rover
 */
Rover.prototype.moveRover = function() {
    this.checkFieldType();
    this.rover_pos[0].x = this.rover_pos[0].x + 1;
};

/**
 * Energie consommée suivant le type de terrain rencontré
 */
Rover.prototype.consumeEnergy = function() {
    this.ENERGY--;
};

/**
 * Remplissage de l'énergie suivant le type de terrain rencontré
 */
Rover.prototype.fillEnergy = function() {
    this.ENERGY++;
};

/**
 * Augmentation du score
 */
Rover.prototype.incrementScore = function() {
    this.SCORE++;
};

/**
 * Regarde le type de terrain aux alentours pour choisir où allé
 */
Rover.prototype.checkFieldType = function() {
    if(map.map[this.rover_pos[0].x+1] !== undefined &&  map.map[this.rover_pos[0].y] !== undefined) {

    }
    if( this.rover_pos[0].x+1 >= this.MAP_HEIGHT || this.rover_pos[0].y >= this.MAP_WIDTH) {
           this.init();
    }
    this.consumeEnergy();
};