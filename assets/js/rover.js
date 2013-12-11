/**
 *
 * Constructeur
 */
Rover = Rover = function(height, width) {
    this.MAP_HEIGHT = height;
    this.MAP_WIDTH = width;
    this.ENERGY= 100;
};

/**
 * Initialisation du rover
 */
Rover.prototype.init = function() {
    this.rover_pos = [{x:Math.floor(Math.random() * this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)}];
};

/**
 * Bouge le Rover
 */
Rover.prototype.moveRover = function() {
    this.rover_pos[0].x = this.rover_pos[0].x + 1;
    if( this.rover_pos[0].x === this.MAP_HEIGHT || this.rover_pos[0].y === this.MAP_WIDTH) {
        //alert('En dehors de la map');
        this.init();
    }
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
 * Regarde le type de terrain aux alentours pour choisir où allé
 */
Rover.prototype.checkFieldType = function() {
    this.consumeEnergy();
};