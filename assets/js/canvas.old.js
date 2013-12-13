$(function() {
    var canvas = document.getElementById('canvas');
        if(!canvas)
        {
            alert("Impossible de récupérer le canvas");
            return;
        }

    var context = canvas.getContext('2d');
        if(!context)
        {
            alert("Impossible de récupérer le context du canvas");
            return;
        }

    // Initialisation
    var rover = new Rover(map.size.x, map.size.y);
    rover.init();
    updateMap();

    // Taille des block
    var block_width = 25;

    // Modification de la taille du canvas
    context.canvas.width = map.map.length*block_width;
    context.canvas.height = map.map.length*block_width;

/* Dessine la carte */
function drawCanvas () {
    // Boucle sur notre Json, dessine le canvas
    for (var l = 0; l < map.map.length; l++) {
        for( var j = 0; j < map.map[l].length; j++ ) {
            switch(map.map[l][j].type) {
                case 0: // Roche
                    context.fillStyle = '#A0A0A0';
                    break;
                case 1: // Sable
                    context.fillStyle = '#FFCC66';
                    break;
                case 2: // Minerai
                    context.fillStyle = '#909090';
                    break;
                case 3: // Fer
                    context.fillStyle = '#282828';
                    break;
                case 4: // Glace
                    context.fillStyle = '#333399';
                    break;
                case 5: // Autre
                    context.fillStyle = '#FF0000';
                    break;
            }
            context.fillRect(l*block_width, j*block_width, block_width - 1, block_width - 1);
        }
        context.fillStyle = 'Yellow';
        context.fillRect(rover.rover_pos[0].x*block_width, rover.rover_pos[0].y*block_width, block_width - 1, block_width - 1);
    }
}

/* Rafraîchissement du rover et de la map */
function updateMap() {
    setIntervalId = setInterval(function() {
        drawCanvas();
        rover.moveRover();
    }, 1000);
}

});