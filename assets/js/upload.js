$(function () {
    document.querySelector('#afile').addEventListener('change', function(e) {
        var file = this.files[0];

        var fd = new FormData();
        fd.append("afile", file);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'request.php', true);

        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
              var percentComplete = (e.loaded / e.total) * 100;
              console.log(percentComplete + '% uploaded');
            }
        };

        xhr.upload.addEventListener('loadstart', function(e) {
            $("body").addClass("loading");
        });


        xhr.upload.addEventListener('loadend', function(e) {
            $("body").removeClass("loading");
        });

        xhr.onload = function() {
            if(this.response === 'errorJsonFormat') {
                $("body").text("Le format du Json donné comporte des incohérences.");
                $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
                return;
            }
            json = JSON.parse(this.response);

            if(startX > json.size.x || startY > json.size.y ||
               endX > json.size.x || endY > json.size.y) {
                $("body").text("Vous avez donné des coordonnées hors de votre carte. Celle-ci a une dimension de: " + json.size.x);
                $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
                
                return false;
            }
            
            $.getScript("assets/js/rover.js").fail(function( ) {
                $("body").text("Une erreur s'est produite et le script de déplacement du rover a rencontré une erreur.");
                $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
            });
            $.getScript("assets/js/ai.js").fail(function( ) {
                 $("body").text("Une erreur s'est produite et l'AI rencontré une erreur.");
                 $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
            });
            $.getScript("assets/js/canvas.js").fail(function( ) {
                $("body").text("Une erreur s'est produite et le script de génération de la map a rencontré une erreur.");
                $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
            });

            // Affichage des éléments
            $("#console").fadeIn(2000);
            $("#game-dashboard").fadeIn(2000);
        };

          xhr.send(fd);
    }, false);
});