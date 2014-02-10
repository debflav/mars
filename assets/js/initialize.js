$(function () {
    function mapGenerate( ) {
        // Requête ajax
        $.ajax({
                type: "POST",
                url: 'request.php',
                dataType: 'json',
                data: {"dimension": $("#dimension").val() }
            }).success( function(msg) {
                json = msg;

                // Récupération des scripts pour afficher la map & le viewer
                $.getScript("assets/js/rover.js").fail(function( ) {
                     $("body").text("Une erreur s'est produite et le script de déplacement du rover a rencontré une erreur.");
                     $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
                });
                $.getScript("assets/js/canvas.old.js").fail(function( ) {
                    $("body").text("Une erreur s'est produite et le script de génération de la map a rencontré une erreur.");
                    $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
                });

                // Affichage des éléments
                $("#console").fadeIn(2000);
                $("#game-dashboard").fadeIn(2000);

            }).error( function( ) {
                $("body").text("Une erreur s'est produite et la requête n'a pas aboutie :(.");
                $("body").append("<p><a href=\"\" >Cliquez pour recharger la page</a></p>");
            });

            return false;
    };
    $(document).on({
        ajaxStart: function() {
            $("body").addClass("loading");
        },
        ajaxStop: function() {
            $("body").removeClass("loading");
        }
    });

    /* Manage showing via js */
    $("#game-type").change(function( ) {
        $("#game-type-fieldset" ).hide();

        if( $("#game-type").val() !== 1) {
            $("#map-coordinates").hide();
            $("#json-upload").show();
            $("#json-upload input").removeAttr('disabled');
        }
        if( $( "#game-type" ).val() == 1) {
            $( "#map-coordinates" ).show();
        }

    });
    $( "#map-coordinates input[type=submit]" ).click(function( ) {
        // Set Rover Globals
        startX = $("#startX").val();
        startY = $("#startY").val();
        endX   = $("#endX").val();
        endY   = $("#endY").val();
        mapDim = $("#dimension").val()*20;
        
        // Test if files are not empty
        if(startX && startY && endX && endY) {
            // Test if value are not bigger than the map dimension
            if(startX > mapDim || startY > mapDim ||
               endX > mapDim || endY > mapDim) {
                $("#fields-rover-error" ).html('Les coordonnées doivent être inférieures à ' + mapDim);
                
                return false;
            }
            
            $( "#map-generate" ).hide();
            $( "#map-coordinates" ).hide();
            if($("#json-upload").length === 0) {
                mapGenerate();
            } else {
                $("#json-upload").show();
                $("#json-upload input").removeAttr('disabled');
            }
        } else {
             $("#fields-rover-error" ).html('Toutes les valeurs doivent être remplis');
        }

        return false;
    });

});