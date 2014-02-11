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
    var rover = new Rover(json.size.x, json.size.y, $("#game-type").val());
    rover.init();
    $('#console').append("<p>Destination x:"+ rover.destination.x + " y:" + rover.destination.y + "</p>");
    updateMap();

    // Taille des block
    var block_width = 25;

    // Modification de la taille du canvas
    context.canvas.width = json.map.length * block_width;
    context.canvas.height = json.map.length * block_width;

/* Dessine la carte */
function drawCanvas () {
    // Boucle sur notre Json, dessine le canvas
    for (var x = 0; x < json.map.length; x++) {
        for( var l = 0; l < json.map[x].length; l++ ) {
            context.globalAlpha = 1.0;
            switch(json.map[x][l].type) {
                case 0: // Roche
                    context.fillStyle = '#a38980';
                    break;
                case 1: // Sable
                    context.fillStyle = '#FFCC66';
                    break;
                case 2: // Minerai
                    context.fillStyle = '#900066';
                    break;
                case 3: // Fer
                    context.fillStyle = '#3c3c3c';
                    break;
                case 4: // Glace
                    context.fillStyle = '#fefdff';
                    break;
                case 5: // Autre
                    context.fillStyle = '#abff2a';
                    break;
            }
            
            context.globalAlpha = 0.5 + 0.5 * (json.map[x][l].z / 40);
            context.fillRect(l*block_width, x*block_width, block_width - 1, block_width - 1);
            
            // context.fillRect(l*block_width, x*block_width, block_width - 1, block_width - 1);
        }
        context.globalAlpha = 1.0;
        context.fillStyle = 'Yellow';
        context.fillRect(rover.position.x*block_width, rover.position.y*block_width, block_width - 1, block_width - 1);
    }
}

/* Mise à jour du score ... ect */
function updateValue() {
    $("#energy span").text(rover.energy);
    $("#score span").text(rover.SCORE);
}

/* Mise à jour de la console (avant que le rover bouge) */
function updateConsole() {
    var date = new Date();
    var curr_time = date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
    $('#console').append("<p>" + curr_time + ": Le rover est en x:"+ rover.position.x + '; y:' + rover.position.y + '; type terrain: ' + json.map[rover.position.x][rover.position.y].type +"</p>");
    $("#console").animate({
	scrollTop: $("#console").scrollTop() + 60
    });
}

/* Rafraîchissement du rover et de la map */
function updateMap() {
    setIntervalId = setInterval(function() {
        drawCanvas();
        updateConsole();
        rover.moveRover();
        updateValue();
        // Si le rover n'a plus d'energie il se recharge pendant 5 tours ##TODO
        if( rover.energy <= 0) {
            clearInterval(setIntervalId);
            $('#console').append("<b style='color:red'>Fin de la partie. Le rover n'a plus d'energie. Score: "+ rover.SCORE +".</b>");
        }
        // Mission 1 (Point A vers point B)
        if(rover.TYPE_OF_GAME == 1) {
            // Partie finis objectif atteint
            if( rover.position.x == rover.destination.x &&
                rover.position.y == rover.destination.y){
                clearInterval(setIntervalId);
                $('#console').append("<b style='color:red'>Fin de la partie. Le rover a atteint sa destination. Score: "+ rover.SCORE +".</b>");
            }
        }
        clearInterval(setIntervalId);
    }, 1000);
}

});