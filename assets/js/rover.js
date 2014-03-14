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
    this.deplacementCases = [];
    
};


/**
 * Initialisation du rover
 */
Rover.prototype.init = function() {
    this.energy = ENERGY;
    this.round = 0;
    this.waiting = 0;
    this.usedWay = [];

    //this.position = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
    this.position = {x:Math.floor(startX), y:Math.floor(startY)};

    if(this.TYPE_OF_GAME == 1) {
        //this.destination = {x:Math.floor(Math.random()*this.MAP_HEIGHT), y:Math.floor(Math.random() * this.MAP_WIDTH)};
        this.destination = {x:Math.floor(endX), y:Math.floor(endY)};
    }

    this.map = this.emptyMap();
    this.nextMove = { "x" : 0, "y" : 0, "weight" : 0};
    this.count = 0;
};


/**
 * Bouge le Rover
 */
Rover.prototype.moveRover = function() {
    // Initialisation
    var sand = false;

    this.tempX = this.position.x;
    this.tempY = this.position.y;
    
    this.movement = {"N" : 0, "NE" : 0, "E" : 0, "SE" : 0, "S" : 0, "SW" : 0, "W" : 0, "NW" : 0};

    this.map[this.position.y][this.position.x].visited += 1;
    //On récupère les altitudes des cases adjacentes au rover
    this.getAdjacentsZ();

    // Robot incapable de bouger. Recharge de l'énergie.
    if(this.waiting > 0) {
        $('#console').append("<p><b>Plus d'energie. Récupération reste "+ this.waiting +" tour(s)</b></p>");
        this.waiting--;
        this.energy++;
        return;
    }
    var nextMovement;
     nextMovement = this.defaultMovement();
     //console.log(nextMovement);
   // while (nextMovement.x === 0 && nextMovement.y === 0 ) {
        this.count += 1;
        this.recusirveSearch(this.nextMove, this.count);
    //}

    //this.recusirveSearch(this.nextMove);
    // console.log(this.nextMove.x);
    // console.log(this.nextMove.y);
    this.position.x += nextMovement.x;
    this.position.y += nextMovement.y;
};

/**
 *  On recupère les Z des cases adjacentes au rover
 */
Rover.prototype.getAdjacentsZ = function() {
    if(this.position.y >= 0 && this.position.y < 20 && this.position.x >= 0 && this.position.x < 20) {
        this.map[this.position.y][this.position.x].z = json.map[this.position.y][this.position.x].z;
    }
    if(this.position.y-1 >= 0 && this.position.y-1 < 20 && this.position.x >= 0 && this.position.x < 20) {
        this.map[this.position.y - 1][this.position.x].z = json.map[this.position.y - 1][this.position.x].z;
    }
    if(this.position.y-1 >= 0 && this.position.y-1 < 20 && this.position.x+1 >= 0 && this.position.x+1 < 20) {
        this.map[this.position.y - 1][this.position.x + 1].z = json.map[this.position.y - 1][this.position.x + 1].z;
    }
    if(this.position.y >= 0 && this.position.y < 20 && this.position.x+1 >= 0 && this.position.x+1 < 20) {
        this.map[this.position.y][this.position.x + 1].z = json.map[this.position.y][this.position.x + 1].z;
    }
    if(this.position.y+1 >= 0 && this.position.y+1 < 20 && this.position.x+1 >= 0 && this.position.x+1 < 20) {
        this.map[this.position.y + 1][this.position.x + 1].z = json.map[this.position.y + 1][this.position.x + 1].z;
    }
    if(this.position.y+1 >= 0 && this.position.y+1 < 20 && this.position.x >= 0 && this.position.x < 20) {
        this.map[this.position.y + 1][this.position.x].z = json.map[this.position.y + 1][this.position.x].z;
    }
    if(this.position.y-1 >= 0 && this.position.y-1 < 20 && this.position.x-1 >= 0 && this.position.x-1 < 20) {
        this.map[this.position.y - 1][this.position.x - 1].z = json.map[this.position.y - 1][this.position.x - 1].z;
    }
    if(this.position.y >= 0 && this.position.y < 20 && this.position.x-1 >= 0 && this.position.x-1 < 20) {
        this.map[this.position.y][this.position.x - 1].z = json.map[this.position.y][this.position.x - 1].z;
    }
    if(this.position.y+1 >= 0 && this.position.y+1 < 20 && this.position.x-1 >= 0 && this.position.x-1 < 20) {
        this.map[this.position.y + 1][this.position.x - 1].z = json.map[this.position.y][this.position.x - 1].z;
    }
};

/**
 * Détermine si se déplace en diagonale
 */
Rover.prototype.isDiagonal = function(tempX, tempY) {
    if(this.position.x !== tempX &&
       this.position.y !== tempY)
       {
           return true;
       }
    return false;
};


Rover.prototype.defaultMovement = function() {
    // Déplacement temporaire horizontal
        var nextArea = this.getVector();
        var coordinate = this.compass(nextArea);
    
        this.tempX += coordinate.x;
        this.tempY += coordinate.y;
        var slope = 0;
        slope = this.checkSlope(this.isDiagonal(this.tempX , this.tempY ), this.tempX , this.tempY );
        if(slope > 150) {
            // 
            this.movement[nextArea] = 0;
        } else {
            
            this.movement[nextArea] += 10;
            this.movement[nextArea] -= this.map[this.tempY][this.tempX].visited * 4;
        }
        //var diagonal = this.isDiagonal();
          // Détermine si se déplace sur une case de sable
            //if(json.map[nextCase.y][nextCase.x].type === SAND) {
              //  sand = true;
            //}

    // Calcul de la pente pour la case temporaire
        //var slope = this.checkSlope(diagonal);

    // Test de la pente pour voir si la case est pratiquable
        // if(Math.abs(slope) < 150) {
        //     // Incrémentations liées aux déplacements
        //     this.consumeEnergy(slope, sand, diagonal);
        // }
        // else {
        //     // Obligé de prendre un autre chemin car pente non pratiquable
        //     // Cellule déjà connues
        //     var knownTiles = [];
        //     knownTiles.push({"x" : this.tempX, "y" : this.tempY});

        //     if(this.position.x !== this.tempX) {
        //         value = this.position.x - this.tempX;
        //         if(value > 0) {

        //         }
        //     }
        // }

    // Palpeur de terrain
    //this.checkFieldType(tempX, tempY);

    // Incrémentations liées aux déplacements
    //this.consumeEnergy(0, sand, diagonale, tempX, tempY);


    // Incrémentation nombre de tours
    this.incrementRound();

    //console.log("this.nextMove.x, y : " + this.movement[nextArea].x + ", " + this.movement[nextArea].y);
    if(this.movement[nextArea] !== 0) {
        //coordinate = this.compass(nextArea);
        var next = {"x" : 0, "y" : 0};
        for(var value in this.movement){

            if(this.movement[value] > this.nextMove.weight){
                 this.nextMove.weight = this.movement[nextArea];

            }
                next.x = coordinate.x;
                next.y = coordinate.y;
        }
    return next;
    }
    // for(var i = 0; i < 3; i++) {
    //     for(var j=0; j< 3; j++) {
    //         //console.log("test");
    //         //console.log(this.deplacementCases[i][j]);
    //         if(this.deplacementCases[i][j].weight != 0 && nextMove.weight < this.deplacementCases[i][j].weight) {
    //             console.log("test");
    //             console.log();
    //             nextMove.y = this.position.y + nextCase.y;
                

    //             nextMove.x = this.position.x + nextCase.x;
    //             nextMove.weight = this.deplacementCases[i][j].weight;
    //             console.log(nextMove);
    //         }
    //     }
    // }
    // Mouvement temporaire debug
     // this.position.x += this.nextMove.x;
     // this.position.y += this.nextMove.y;
    // if(difX > 0 && difY > 0) {

    // }
    return next;
};

Rover.prototype.recusirveSearch = function(blockedTile, count) {
    //console.log(blockedTile);
    var nextArea = this.getVector();
    cardinal = this.getTwoNearCadinals(nextArea);

};

Rover.prototype.getTwoNearCadinals = function(cardinal) {
    var result = {"un" : "", "deux" : ""};
    if(cardinal.length > 1) {
        result.un = cardinal.substr(0,1);
        result.deux = cardinal.substr(1,1);
    } else {
        if(cardinal == "S" || cardinal == "N") {
            result.un = cardinal.concat("E");
            result.deux = cardinal.concat("W");
        } else {
            result.un = "N".concat(cardinal);
            result.deux = "S".concat(cardinal);
        }
    }
    return result;
};

Rover.prototype.getVector = function() {
        var difX = this.tempX - this.destination.x;
        var difY = this.tempY - this.destination.y;
        var result = "";

        if(difX === 0 && difY >= 1){
            result = "N";
        } else if(difY >= 1 && difX >= 1) {
            result = "NW";
        } else if (difY >= 1 && difX <= (-1)) {
            result = "NE";
        } else if (difY === 0 && difX >= 1) {
            result = "W";
        } else if (difY === 0 && difX <= (-1)) {
            result = "E";
        } else if (difY <= (-1) && difX <= (-1)) {
            result = "SE";
        } else if (difY <= (-1) && difX >= 1) {
            result = "SW";
        } else if (difY <= (-1) && difX === 0) {
            result = "S";
        }

        // if(difX >= 1){
        //     echo "W"
        //     nextTile["x"] = (-1);
        // } else if (difX === 0) {
        //     echo "S OU N"
        //     nextTile["x"] = 0;
        // } else {
        //     echo "E"
        //     nextTile["x"] = 1;
        // }
        //         if(difY >= 1){
        //             echo "N"
        //     nextTile["y"] =  (-1);
        // } else if (difY === 0) {
        //     "E ou W"
        //     nextTile["y"] = 0;
        // } else {
        //     nextTile["y"] = 1;
        //     "S"
        // }
        //return nextTile;
        return result;
};
Rover.prototype.compass = function(cardinal) {
    var result = {"x" : 0, "y" : 0};

    switch (cardinal) {
        case "S" :
            result.y = 1;
            break;

         case "SE" :
            result.y = 1;
            result.x = 1;
            break;

         case "E" :
            result.x = 1;
            break;

         case "NE" :
            result.y = (-1);
            result.x = 1;
            break;

         case "N" :
            result.y = (-1);
            break;

         case "NW" :
            result.y = (-1);
            result.x = (-1);
            break;

         case "W" :
            result.x = (-1);
            break;

         case "SW" :
            result.x = (-1);
            result.y = 1;
            // return result;
            break;
    }
    return result;
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
Rover.prototype.checkSlope = function(diagonale, x, y) {
    if(diagonale) {
        return (Math.abs(json.map[y][x].z - json.map[this.position.y][this.position.x].z)) / (SCALE*Math.sqrt(2));
    }
    return (Math.abs(json.map[y][x].z - json.map[this.position.y][this.position.x].z)) / SCALE;
};


/**
 * Regarde le type de terrain aux alentours pour choisir où allé
 */
Rover.prototype.checkFieldType = function(posX, posY) {

    var E = 1;  //Coefficient du coût
    var price = 0;

    // Si on check la case sur laquelle le rover est
    if (posX - this.position.x === 0 && posY - this.position.y === 0) {
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



/**
 * On créer la map d'exploration vide
*/
Rover.prototype.emptyMap = function() {
    var map = [];
    for (var i = 0; i <= this.MAP_WIDTH; i++) {
        map[i] = [];
    }

    for(var i = 0; i <= this.MAP_WIDTH; i++) {
        for(var j=0; j<= this.MAP_HEIGHT; j++) {
            map[i][j] = {
                z: null,
                type: null,
                blackList: null,
                visited: 0
            };
            //console.log(map);
        }
    }
    return map;
};