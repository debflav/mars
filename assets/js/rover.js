/**
 *
 * GLOBALS
 */
var ENERGY = 10,
    SCALE = 5;

/**
 * Constructeur
 */
Rover = Rover = function(height, width, typeOfGame) {
    this.MAP_HEIGHT = height - 1;
    this.MAP_WIDTH = width - 1;
    this.ENERGY = ENERGY;
    this.SCORE = 0;
    this.DESTINATION = null;
    this.TYPE_OF_GAME = typeOfGame;

};


/**
 * Initialisation du rover
 */
Rover.prototype.init = function() {
    this.rover_pos = [{x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)}];

    if(this.TYPE_OF_GAME == 1) {
        this.DESTINATION = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
    }
};


/**
 * Bouge le Rover
 */
Rover.prototype.moveRover = function() {
    var tempX = this.rover_pos[0].x,
        tempY = this.rover_pos[0].y,
        sand = false;

    // Horizontal
    if(tempX < this.DESTINATION.x) {
        tempX = tempX+1;
    } else if(tempX > this.DESTINATION.x) {
        tempX = tempX-1;
    }

    // Vertical
    if(tempY < this.DESTINATION.y) {
        tempY = tempY+1;
    } else if(tempY > this.DESTINATION.y) {
        tempY = tempY-1;
    }

    // Pente
    var slope = this.checkSlope(tempX, tempY);

    // Test de la pente pour voir s'il faut
    // prendre un autre chose chemin
    if(Math.abs(slope) < 1.5) {
        this.rover_pos[0].x = tempX;
        this.rover_pos[0].y = tempY;
    }
    else {
        // En attendant
        this.rover_pos[0].x = tempX;
        this.rover_pos[0].y = tempY;
    }



    // Palpeur de terrain
    this.checkFieldType(tempX, tempY);



    // Test du type de terrain
    if(map.map[tempX][tempY].type === 4) {
        this.fillEnergy();
        $('#console').append("<b>Le rover a trouvé de la glace. Energie rechargée.</b>");
    } else if(map.map[tempX][tempY].type === 1) {
        sand = true;
    }

    // Incrémentations liées aux déplacements
    this.consumeEnergy(0.8, sand, true);



    this.incrementScore();
};



/**
 * Energie consommée suivant le type de terrain rencontré
 * slope = valeur de la pente. sand = bool. diagonale = bool.
 */
Rover.prototype.consumeEnergy = function(slope, sand, diagonale) {

    var E = 0;  //Coefficient du coût
    var price = 0;

    if(diagonale) {
        E = 1.4;
    }
    else {
        E = 1;
    }

    if(slope > 0) { // Si on monte
        if(sand) {
            E = E + 0.1*E;
        }
    }
    else {  // On descend
        if(sand) {
            E = E - 0.1*E;
        }
    }

    price = E * (1 + slope);    // Coût du déplacement en énergie

    if( this.ENERGY - price > 0) {
        this.ENERGY -= price;
    } else {
        // Recherche un autre chemin en ligne droite ou de la glaçe
        // si on est en diagonale
        var price = 1,
            priceSandUp = 1 + 0.1*E,
            priceSandDown = 1 - 0.1*E,
            priceSlope = 1 * (1 + slope);

        if(diagonale && this.ENERGY > 1) {
            // Assez d'energie pour palper
            if(this.ENERGY > 1 && this.ENERGY < 1.2) {
                // Palpe moi

            } else {

            }

        } else {
            // Obligé d'attendre 5 tours
        }
    }
};


/**
 * Remplissage de l'énergie suivant le type de terrain rencontré
 */
Rover.prototype.fillEnergy = function() {
    // RESET
    this.ENERGY = ENERGY;
};


/**
 * Augmentation du score
 */
Rover.prototype.incrementScore = function() {
    this.SCORE++;
};


/**
 * Regarde la pente
 * (Elevation case + 1 / elevation case courante) / distance entre deux cases
 */
Rover.prototype.checkSlope = function(tempX, tempY) {
    //console.log(map.map[tempX][tempY].z);
    //console.log(map.map[this.rover_pos[0].x][this.rover_pos[0].y].z);

    return (map.map[tempX][tempY].z - map.map[this.rover_pos[0].x][this.rover_pos[0].y].z) / SCALE;// 7,5 ?
};


/**
 * Regarde le type de terrain aux alentours pour choisir où allé
 */
Rover.prototype.checkFieldType = function(posX, posY) {

    var E = 1;  //Coefficient du coût
    var price = 0;

    // Si on check la case sur laquelle le rover est
    if (posX - this.rover_pos[0].x == 0 && posY - this.rover_pos[0].y == 0) {
        price = E * 0.1;
        this.ENERGY -= price;
        return map.map[posX][posY].type;
    }
    // Si on check une case adjacente
    else if(Math.abs(posX - this.rover_pos[0].x) <= 1 && Math.abs(posY - this.rover_pos[0].y) <= 1) {
        price = E * 0.2;
        this.ENERGY -= price;
        return map.map[posX][posY].type;
    }
    // Si on check une case plus loin
    else if(Math.abs(posX - this.rover_pos[0].x) <= 2 && Math.abs(posY - this.rover_pos[0].y) <= 2) {
        price = E * 0.4;
        this.ENERGY -= price;
        return map.map[posX][posY].type;
    }
};