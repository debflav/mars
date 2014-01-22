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
    this.TYPE_OF_GAME = typeOfGame;
};


/**
 * Initialisation du rover
 */
Rover.prototype.init = function() {
    this.energy = ENERGY;
    this.round = 0;
    this.destination = null;
    this.waiting = 0;
    this.usedWay = [];
    this.position = [{x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)}];

    if(this.TYPE_OF_GAME == 1) {
        this.destination = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
    }
};


/**
 * Bouge le Rover
 */
Rover.prototype.moveRover = function() {
    // Incrémentation nombre de tours
    this.incrementRound();

    // Robot incapable de bouger. Recharge de l'énergie.
    if(this.waiting > 0) {
        $('#console').append("<p><b>Plus d'energie. Récupération reste "+ this.waiting +" tour(s)</b></p>");
        this.waiting--;
        return;
    }

    // Initialisation
    var tempX     = this.position[0].x,
        tempY     = this.position[0].y,
        sand      = false,
        diagonale = false;

    // Déplacement temporaire horizontal
    if(tempX < this.destination.x) {
        tempX = tempX+1;
    } else if(tempX > this.destination.x) {
        tempX = tempX-1;
    }

    // Déplacement temporaire vertical
    if(tempY < this.destination.y) {
        tempY = tempY+1;
    } else if(tempY > this.destination.y) {
        tempY = tempY-1;
    }

    // Calcul de la pente pour la case temporaire
    var slope = this.checkSlope(tempX, tempY);

    // Test de la pente pour voir si la case est pratiquable
    /*if(Math.abs(slope) < 1.5) {
        this.position[0].x = tempX;
        this.position[0].y = tempY;
    }
    else {
        // En attendant
        this.position[0].x = tempX;
        this.position[0].y = tempY;
    }*/

    // Palpeur de terrain
    //this.checkFieldType(tempX, tempY);

    // Détermine si se déplace sur une case de sable
    if(map.map[tempX][tempY].type === 1) {
        sand = true;
    }

    // Détermine si se déplace en diagonale
    if(this.position[0].x !== tempX &&
       this.position[0].y !== tempY)
       {
           diagonale = true;
       }

    // Incrémentations liées aux déplacements
    this.consumeEnergy(0, sand, diagonale, tempX, tempY);

    // Mouvement temporaire debug
    this.position[0].x = tempX;
    this.position[0].y = tempY;
};



/**
 * Energie consommée suivant le type de terrain rencontré
 *
 * slope : valeur de la pente
 * sand : bool
 * diagonale : bool.
 */
Rover.prototype.consumeEnergy = function(slope, sand, diagonale, tempX, tempY) {

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

    if( this.energy - price > 0) {
        this.energy -= price;
    }
    else {
        // Recherche un autre chemin en ligne droite ou de la glaçe
        // si on est en diagonale
        var price = 1,
            priceSandUp = 1 + 0.1*E,
            priceSandDown = 1 - 0.1*E,
            priceSlope = 1 * (1 + slope);

        if(diagonale && this.energy > 1) {
            // Avec le peu d'energie qu'il reste le rover peut palper les cases
            // autour de lui pour choisir le meilleur chemin.
            if(this.energy > 1 && this.energy < 1.2) {
                //this.cheapestTile();
                //this.findIce();
                //this.position[0].x
                //this.position[0].y
            }
            else {

            }
        } // Cas où on part déjà en ligne droite
        else if(!diagonale && this.energy >= 1) {



        }
        else {
            // Cas où le rover a moins de 1 d'énergie et qu'il n'a plus
            // d'options de déplacement possible.
            this.waiting = 5;
        }
    }
};


/**
 * Remplissage de l'énergie suivant le type de terrain rencontré
 */
Rover.prototype.fillEnergy = function() {
    // RESET
    this.energy = ENERGY;
};


/**
 * Augmentation du nombre de tour du robot
 */
Rover.prototype.incrementRound = function() {
    this.round++;
};


/**
 * Regarde la pente
 * (Elevation case + 1 / elevation case courante) / distance entre deux cases
 */
Rover.prototype.checkSlope = function(tempX, tempY) {
    //console.log(map.map[tempX][tempY].z);
    //console.log(map.map[this.position[0].x][this.position[0].y].z);

    return (map.map[tempX][tempY].z - map.map[this.position[0].x][this.position[0].y].z) / SCALE;// 7,5 ?
};


/**
 * Regarde le type de terrain aux alentours pour choisir où allé
 */
Rover.prototype.checkFieldType = function(posX, posY) {

    var E = 1;  //Coefficient du coût
    var price = 0;

    // Si on check la case sur laquelle le rover est
    if (posX - this.position[0].x == 0 && posY - this.position[0].y == 0) {
        price = E * 0.1;
        this.energy -= price;
        return map.map[posX][posY].type;
    }
    // Si on check une case adjacente
    else if(Math.abs(posX - this.position[0].x) <= 1 && Math.abs(posY - this.position[0].y) <= 1) {
        price = E * 0.2;
        this.energy -= price;
        return map.map[posX][posY].type;
    }
    // Si on check une case plus loin
    else if(Math.abs(posX - this.position[0].x) <= 2 && Math.abs(posY - this.position[0].y) <= 2) {
        price = E * 0.4;
        this.energy -= price;
        return map.map[posX][posY].type;
    }
};


/**
 * Case la plus benefique à emprûnter.
 */
Rover.prototype.cheapestTile = function() {
    //this.position[0].x
    //this.position[0].y

};