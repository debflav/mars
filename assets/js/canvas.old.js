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
    var block_width = 25;

    // Modification de la taille du canvas
    context.canvas.width = map.map.length*block_width;
    context.canvas.height = map.map.length*block_width;

    // Boucle sur notre Json, desinne le canvas
    for (var l = 0; l < map.map.length; l++) {
        for( var j = 0; j < map.map[l].length; j++ ) {
            switch(map.map[l][j].type) {
                case 0: // Roche
                    context.fillStyle = '#e07327';
                    break;
                case 1: // Sable
                    context.fillStyle = '#ffd859';
                    break;
                case 2: // Minerai
                    context.fillStyle = '#952023';
                    break;
                case 3: // Fer
                    context.fillStyle = '#898989';
                    break;
                case 4: // Glace
                    context.fillStyle = '#1bbbb1';
                    break;
                case 5: // Autre
                    context.fillStyle = '#38cc2e';
                    break;
            }
            context.fillRect(l*block_width, j*block_width, block_width - 1, block_width - 1);
        }
    }

});