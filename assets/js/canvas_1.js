$(function() {

    // Terrain
    var tilesetImage = new Image();
    tilesetImage.src = 'assets/js/tileset01.png';
    tilesetImage.onload = drawCanvas;

    // Rover
    var roverImage = new Image();
    roverImage.src = 'assets/js/glad1.png';

    // Initialisation & récupération du canvas
    var canvas = document.getElementById('canvas');
    if(!canvas) {
        alert("Impossible de récupérer le canvas");
        return;
    }
    var ctx = canvas.getContext('2d');
    if(!ctx) {
        alert("Impossible de récupérer le context du canvas");
        return;
    }

    var tileSize = 32;      // La taille d'une image (32x32)
    var imageNumTiles = 16; // Le nombre de tiles par cellule dans le tileset image
    ctx.canvas.height = tileSize * map.size.x; // Initialise la taille du canvas suivant le nombre de colonnes
    ctx.canvas.width =  tileSize * map.size.y; // Initialise la taille du canvas suivant le nombre de lignes

    // Initialisation de l'objet rover
    var rover = new Rover(map.size.x, map.size.y);
    rover.init();

    // Rafraîchissement du rover et de la map
    setInterval(function() {
        drawCanvas();
        rover.moveRover();
    }, 1000);


    function drawCanvas () {
        // Dessine la map
        for (var l = 0; l < map.map.length; l++) {
            for( var j = 0; j < map.map[l].length; j++ ) {
                var tile = 0;
                switch(map.map[l][j].type) {
                    case 0: // Roche
                        tile = 124;
                        break;
                    case 1: // Sable
                        tile = 172;
                        break;
                    default:
                        tile = 79;
                        break;
                }
                var tileRow = (tile / imageNumTiles) | 0;
                var tileCol = (tile % imageNumTiles) | 0;
                ctx.drawImage(tilesetImage, (tileCol * tileSize), (tileRow * tileSize), tileSize, tileSize, (j * tileSize), (l * tileSize), tileSize, tileSize);
            }
        }
        // Dessine le rover
        var tile = 0;
        var tileRow = (tile / imageNumTiles) | 0;
        var tileCol = (tile % imageNumTiles) | 0;
        ctx.drawImage(roverImage, (tileCol*tileSize), (tileRow*tileSize), tileSize, tileSize, (rover.rover_pos[0].x*tileSize), (rover.rover_pos[0].y*tileSize), tileSize, tileSize);
    }

});