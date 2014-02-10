// Terrain
var worldmapImage = new Image();
worldmapImage.src = 'assets/images/worldmap_ex.png';
worldmapImage.onload = drawCanvas;

var worldmapImage2 = new Image();
worldmapImage2.src = 'assets/images/worldmap2_ex.png';
worldmapImage2.onload = drawCanvas;

// Rover
var roverImage = new Image();
roverImage.src = 'assets/images/rover.png';


// Rover
var marker = new Image();
marker.src = 'assets/images/marker.png';


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

// Initialisation
var rover = new Rover(json.size.x, json.size.y, $("#game-type").val());
rover.init();
$('#console').append("<p>Destination x:"+ rover.destination.x + " y:" + rover.destination.y + "</p>");
updateMap();


/* Dessine la carte */
function drawCanvas () {
    // Dessine la map
    for (var x = 0; x < json.map.length; x++) {
        for( var l = 0; l < json.map[x].length; l++ ) {
            ctx.globalAlpha = 1.0;
            // Pour toutes les images sans fond on ajoute de l'herbe (à modifier)
            var tile = 0;
            var image = null;
            var tileRow = (tile / imageNumTiles) | 0;
            var tileCol = (tile % imageNumTiles) | 0;
            ctx.drawImage(worldmapImage2, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (l * tileSize), tileSize, tileSize);
            switch(json.map[x][l].type) {
                case 0: // Roche
                    tile = 20;
                    image = worldmapImage;
                    break;
                case 1: // Sable
                    tile = 6;
                    image = worldmapImage;
                    break;
                case 2: // Minerai
                    tile = 21;
                    image = worldmapImage;
                    break;
                case 3: // Fer
                    tile = 16;
                    image = worldmapImage;
                    break;
                case 4: // Glace
                    tile = 4;
                    image = worldmapImage;
                    break;
                case 5: // Autre
                    tile = 55;
                    image = worldmapImage;
                    break;
                default:
                    image = worldmapImage;
                    break;
            }
            if(json.map[x][l].z > 0) {
                ctx.globalAlpha = 1.5;
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(image, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (l * tileSize), tileSize, tileSize);
            } else if (json.map[x][l].z < 0){
                ctx.globalAlpha = 0.5;
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(image, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (l * tileSize), tileSize, tileSize);
            } else {
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(image, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (x * tileSize), (l * tileSize), tileSize, tileSize);
            }
        }
    }
    // Dessine le rover
    ctx.globalAlpha = 1.0;
    var tile = 0;
    var tileRow = (tile / imageNumTiles) | 0;
    var tileCol = (tile % imageNumTiles) | 0;
    // Marker
    ctx.drawImage(marker, (tileCol*tileSize), (tileRow*tileSize), tileSize, tileSize, (rover.destination.x*tileSize), (rover.destination.y*tileSize), tileSize, tileSize);
    // Rover
    ctx.drawImage(roverImage, (tileCol*tileSize), (tileRow*tileSize), tileSize, tileSize, (rover.position.x*tileSize), (rover.position.y*tileSize), tileSize, tileSize);

}

/* Mise à jour du nombre de déplacement ... ect */
function updateValue() {
    $("#energy span").text(rover.energy.toFixed(2));
    $("#round span").text(rover.round);
}

/* Mise à jour de la console (avant que le rover bouge) */
function updateConsole() {
    var date = new Date();
    var curr_time = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
    var energyUsed = energyStart - rover.energy;

    if(rover.waiting == 0) {
        $('#console').append("<p>" + curr_time + ": X:"+ rover.position.x + '; Y:'
        + rover.position.y + '; Z: ' + json.map[rover.position.x][rover.position.y].z
        + '; Type: ' + json.map[rover.position.x][rover.position.y].type + " E:"+ energyUsed.toFixed(2) +"</p>");
    }
    // Si case de type glace l'énergie est remplie à son maximum.
    if(json.map[rover.position.x][rover.position.y].type === 4) {
        rover.fillEnergy();
        $('#console').append("<p><b>Le rover a trouvé de la glace. Energie rechargée.</b></p>");
    }
    $("#console").animate({
	scrollTop: $("#console").scrollTop() + 60
    });
}

/* Rafraîchissement du rover et de la map */
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
            if( rover.position.x == rover.destination.x &&
                rover.position.y == rover.destination.y){
                clearInterval(setIntervalId);
                $('#console').append("<b style='color:red'>Fin de la partie. Le rover a atteint sa destination. Tours réalisés: "+ rover.round +".</b>");
            }
        }
    }, 1000);
}