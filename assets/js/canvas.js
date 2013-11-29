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

    // Taille des block
    var block_width = 10;

    // Modification de la taille du canvas
    context.canvas.width = map.length*block_width;
    context.canvas.height = map.length*block_width;

    // Boucle sur notre Json, desinne le canvas
    for (var l = 0; l < map.length; l++) {
        for( var j = 0; j < map[l].length; j++ ) {
            //console.log("line number : " + l);
            //console.log(map[l][j]);
            if(map[l][j].type === 1) { // Roche
                context.fillStyle = '#A0A0A0';
            } else if(map[l][j].type === 2) { // Sable
                context.fillStyle = '#FFCC66';
            } else if(map[l][j].type === 3) { // Minerai
                context.fillStyle = '#909090';
            } else if(map[l][j].type === 4) { // Fer
                context.fillStyle = '#282828';
            } else if(map[l][j].type === 5) { // Glace
                context.fillStyle = '#333399';
            } else if(map[l][j].type === 6) { // Autre
                context.fillStyle = '#CC0000';
            }
            context.fillRect(l*block_width, j*block_width, block_width - 1, block_width - 1);
        }
    }


});