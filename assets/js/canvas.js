// Terrain
var worldmapImage = new Image();
worldmapImage.src = 'assets/images/32x32/worldmap_ex.png';
//worldmapImage.onload = drawCanvas;

var worldmapImage2 = new Image();
worldmapImage2.src = 'assets/images/32x32/worldmap2_ex.png';
worldmapImage2.onload = drawCanvas;

// Rover
var roverImage = new Image();
roverImage.src = 'assets/images/32x32/rover.png';

// Marker
var marker = new Image();
marker.src = 'assets/images/32x32/marker.png';

// Initialisation & récupération du canvas
var canvas = document.getElementById('canvas');

if(!canvas) {
    alert("Impossible de récupérer le canvas");
}

var ctx = canvas.getContext('2d');
if(!ctx) {
    alert("Impossible de récupérer le context du canvas");
}

// Intialisation des objets du canvas
var tileSize = 32;      // La taille d'une image (32x32)
var imageNumTiles = 16; // Le nombre de tiles par cellule dans le tileset image
ctx.canvas.height = tileSize * json.size.x; // Initialise la taille du canvas suivant le nombre de colonnes
ctx.canvas.width =  tileSize * json.size.y; // Initialise la taille du canvas suivant le nombre de lignes

// Temps de rafraîchissement suivant la taille de la carte
var msInterval = 1000;

if(json.size.x >= 200) {
    msInterval = 1500;
}
else if(json.size.x >= 300) {
    msInterval = 2000;
}

// Initialisation
var rover = new Rover(json.size.x, json.size.y, $("#game-type").val());
var ai = new Ai(json.size.x, json.size.y, 1);
ai.emptyMap();
rover.init();
$('#console').append("<p>Destination x:"+ rover.destination.x + " y:" + rover.destination.y + "</p>");
updateMap();


/* Dessine le canvas
 * - Marqueur de destination
 * - Déplacement du rover
 */
function drawCanvas () {
    for (var y = 0; y < json.map.length; y++) {
        for( var x = 0; x < json.map[y].length; x++ ) {
            ctx.globalAlpha = 1.0;
            // Pour toutes les images sans fond on ajoute de l'herbe (à modifier)
            var tile = 0;
            var tileRow = (tile / imageNumTiles) | 0;
            var tileCol = (tile % imageNumTiles) | 0;
            ctx.drawImage(worldmapImage2, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (y * tileSize), tileSize, tileSize);
            switch(json.map[y][x].type) {
                case 0: // Roche
                    tile = 20;
                    break;
                case 1: // Sable
                    tile = 6;
                    break;
                case 2: // Minerai
                    tile = 21;
                    break;
                case 3: // Fer
                    tile = 16;
                    break;
                case 4: // Glace
                    tile = 4;
                    break;
                case 5: // Autre
                    tile = 55;
                    break;
                default:
                    break;
            }
            if(json.map[x][y].z > 0) {
                ctx.globalAlpha = 1,5;
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(worldmapImage, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (y * tileSize), tileSize, tileSize);
            } else if (json.map[x][y].z < 0){
                ctx.globalAlpha = 0,5;
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(worldmapImage, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (y * tileSize), tileSize, tileSize);
            } else {
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(worldmapImage, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (y * tileSize), tileSize, tileSize);
            }
        }
    }
    // Règle l'opacité à 1 pour éviter les bugs
    ctx.globalAlpha = 1.0;
    var tile = 0;
    var tileRow = (tile / imageNumTiles) | 0;
    var tileCol = (tile % imageNumTiles) | 0;
    // Marker
    ctx.drawImage(marker, (tileCol*tileSize), (tileRow*tileSize), tileSize, tileSize, (rover.destination.x*tileSize), (rover.destination.y*tileSize), tileSize, tileSize);
    // Rover
    ctx.drawImage(roverImage, (tileCol*tileSize), (tileRow*tileSize), tileSize, tileSize, (rover.position.x*tileSize), (rover.position.y*tileSize), tileSize, tileSize);

}


/* Mise à jour du nombre de déplacement... */
function updateValue() {
    // Specs 3 chiffres après la virgule
    $("#energy span").text(rover.energy.toFixed(3));
    $("#round span").text(rover.round);
}


/* Mise à jour de la console */
function updateConsole() {
    var date = new Date();
    var curr_time = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
    // Energie consommée
    var energyUsed = energyStart - rover.energy;

    // Info de jeux (et debug pour le moment) dans la console
    if(rover.waiting === 0) {
        $('#console').append("<p>" + curr_time + ": X:"+ rover.position.x + '; Y:'
        + rover.position.y + '; Z: ' + json.map[rover.position.y][rover.position.x].z
        + '; Type: ' + json.map[rover.position.y][rover.position.x].type + "; coût E:"+ energyUsed.toFixed(3) +"</p>");
    }

    // Doit être implémenter dans rover.js. La case doit être palpé au préalable
    // pour savoir si c'est de l'énergie

    // Si case de type glace l'énergie est remplie à son maximum.
    //if(json.map[rover.position.y][rover.position.x].type === 4) {
    //    rover.fillEnergy();
    //    $('#console').append("<p><b>Le rover a trouvé de la glace. Energie rechargée.</b></p>");
    //}

    // Scroll automatique de la console
    $("#console").animate({
	scrollTop: $("#console").scrollTop() + 60
    });
}


/************************************
 * Rafraîchissement du rover et de la map
 * - Calcul de la dépense en énergie
 * - Algo déplacement rover
 * - Maj canvas (rover)
 * - Maj de notre console
 * - Maj de l'energie et du nombre de tours
 ************************************/
function updateMap() {
    setIntervalId = setInterval(function() {
        energyStart = rover.energy;
        rover.moveRover();
        drawCanvas();
        updateConsole();
        updateValue();
        // Mission 1 (Point A vers point B)
        if(rover.TYPE_OF_GAME == 1) {
            // Partie finis objectif atteint
            if( rover.position.x === rover.destination.x &&
                rover.position.y === rover.destination.y){
                clearInterval(setIntervalId);
                $('#console').append("<b style='color:red'>Fin de la partie. Le rover a atteint sa destination. Tours réalisés: "+ rover.round +".</b>");
            }
        }
    }, msInterval);
}