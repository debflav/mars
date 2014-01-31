/**
 *
 * GLOBALS
 */
var ENERGY = 10,
    SCALE = 5;

//Type de cases
var ROCK = 0,
    SAND = 1,
    IRON = 2,
    ORE = 3,
    ICE = 4,
    OTHER = 5;

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
    this.position = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
    this.tempX = null;
    this.tempY = null;

    if(this.TYPE_OF_GAME == 1) {
        this.destination = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
    }
};


/**
 * Bouge le Rover
 */
Rover.prototype.moveRover = function() {
    // Initialisation
    var sand = false;

    this.tempX = this.position.x;
    this.tempY = this.position.y;

    // Robot incapable de bouger. Recharge de l'énergie.
    if(this.waiting > 0) {
        $('#console').append("<p><b>Plus d'energie. Récupération reste "+ this.waiting +" tour(s)</b></p>");
        this.waiting--;
        this.energy++;
        return;
    }

    this.defaultMovement();

    var diagonal = this.isDiagonal();

    // Détermine si se déplace sur une case de sable
    if(json.map[this.tempY][this.tempX].type === SAND) {
        sand = true;
    }

    // Calcul de la pente pour la case temporaire
    var slope = this.checkSlope(diagonal);

    // Test de la pente pour voir si la case est pratiquable
    if(Math.abs(slope) < 150) {
            // Incrémentations liées aux déplacements
            this.consumeEnergy(slope, sand, diagonal);
    }
    else {
        // Obligé de prendre un autre chemin car pente non pratiquable
        // Cellule déjà connues
        var knownTiles = [];
        knownTiles.push({"x" : this.tempX, "y" : this.tempY});

        if(this.position.x !== this.tempX) {
            value = this.position.x - this.tempX;
            if(value > 0) {

            }
        }
    }

    // Palpeur de terrain
    //this.checkFieldType(tempX, tempY);

    // Incrémentations liées aux déplacements
    //this.consumeEnergy(0, sand, diagonale, tempX, tempY);


    // Incrémentation nombre de tours
    this.incrementRound();

    // Mouvement temporaire debug
    this.position.x = this.tempX;
    this.position.y = this.tempY;
};


/**
 * Détermine si se déplace en diagonale
 */
Rover.prototype.isDiagonal = function() {
    if(this.position.x !== this.tempX &&
       this.position.y !== this.tempY)
       {
           return true;
       }

    return false;
};


Rover.prototype.defaultMovement = function() {
    // Déplacement temporaire horizontal
    if(this.tempX < this.destination.x) {
        this.tempX = this.tempX+1;
    }
    else if(this.tempX > this.destination.x) {
        this.tempX = this.tempX-1;
    }

    // Déplacement temporaire vertical
    if(this.tempY < this.destination.y) {
        this.tempY = this.tempY+1;
    }
    else if(this.tempY > this.destination.y) {
        this.tempY = this.tempY-1;
    }
};


/**
 * Energie consommée suivant le type de terrain rencontré
 *
 * slope : valeur de la pente
 * sand : bool
 * diagonale : bool.
 */
Rover.prototype.consumeEnergy = function(slope, sand, diagonale) {

    var E = 0;  //Coefficient du coût
    var price = 0;

    // Si l'energie est inférieure à 50% on change le comportement.
    // Cad palpe pour trouver de la glace
    if(this.energy <= (ENERGY/2)) {

    }

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
    }// energie insuffisante pour un déplacement, recherche d'alternative
    else {
        // Recherche un autre chemin en ligne droite ou de la glaçe
        // si on est en diagonale
        var priceSandUp = 1 + 0.1*E,
            priceSandDown = 1 - 0.1*E,
            priceSlope = 1 * (1 + slope);
            price = 1;

        if(diagonale && this.energy > 1) {
            // Avec le peu d'energie qu'il reste le rover peut palper les cases
            // autour de lui pour choisir le meilleur chemin.
            if(this.energy >= 1.1 && this.energy <= 1.4) {
                // Si la destination est a droite du rover
                /*if(this.destination.x - this.position.x > 0) {
                    // Si la destination est en haut a droite du rover
                    if(this.destination.y - this.position.y > 0) {
                        // Si la case à gauche du rover est de type glace
                        if(this.checkFieldType(this.position.x - 1, this.position.y == ICE)) {

                            // Traitement

                        }
                        // Sinon si la case en bas du rovert est de type glace
                        else if(this.checkFieldType(this.position.x, this.position.y - 1 == ICE)) {

                            // Traitement

                        }
                    }
                }*/
            }

            //}
            //else {

            //}

            //On cherche en priorité une case de glace


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
Rover.prototype.checkSlope = function(diagonale) {
    if(diagonale) {

        return (Math.abs(json.map[this.tempY][this.tempX].z - json.map[this.position.y][this.position.x].z)) / (SCALE*Math.sqrt(2));
    }

    return (Math.abs(json.map[this.tempY][this.tempX].z - json.map[this.position.y][this.position.x].z)) / SCALE;
};


/**
 * Regarde le type de terrain aux alentours pour choisir où allé
 */
Rover.prototype.checkFieldType = function(posX, posY) {

    var E = 1;  //Coefficient du coût
    var price = 0;

    // Si on check la case sur laquelle le rover est
    if (posX - this.position.x == 0 && posY - this.position.y == 0) {
        price = E * 0.1;
        if(this.energy - price > 0) {
            this.energy -= price;
            return json.map[posY][posX].type;
        }
        return false;
    }
    // Si on check une case adjacente
    else if(this.isAdjacent(posY, posX)) {
        price = E * 0.2;
        if(this.energy - price > 0) {
            this.energy -= price;
            return json.map[posY][posX].type;
        }
        return false;
    }
    // Si on check une case plus loin
    else if(Math.abs(posX - this.position.x) <= 2 && Math.abs(posY - this.position.y) <= 2) {
        price = E * 0.4;
        if(this.energy - price > 0) {
            this.energy -= price;
            return json.map[posY][posX].type;
        }
        return false;
    }
};


/**
 * Case la plus benefique à emprûnter.
 */
Rover.prototype.cheapestTile = function() {
    //this.position.x
    //this.position.y

};


/**
 *
 * @param int posX
 * @param int posY
 */
Rover.prototype.isAdjacent = function(posY, posX) {
    return (Math.abs(posX - this.position.x) <= 1 && Math.abs(posY - this.position.y) <= 1);
};