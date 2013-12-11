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
    context.canvas.width = map.map.length*block_width;
    context.canvas.height = map.map.length*block_width;

    // Boucle sur notre Json, desinne le canvas
    for (var l = 0; l < map.map.length; l++) {
        for( var j = 0; j < map.map[l].length; j++ ) {
            switch(map.map[l][j].type+1) {
                case 1: // Roche
                    context.fillStyle = '#A0A0A0';
                    break;
                case 2: // Sable
                    context.fillStyle = '#FFCC66';
                    break;
                case 3: // Minerai
                    context.fillStyle = '#909090';
                    break;
                case 4: // Fer
                    context.fillStyle = '#282828';
                    break;
                case 5: // Glace
                    context.fillStyle = '#333399';
                    break;
                case 6: // Autre
                    context.fillStyle = '#FF0000';
                    break;
            }
            context.fillRect(l*block_width, j*block_width, block_width - 1, block_width - 1);
        }
    }


});