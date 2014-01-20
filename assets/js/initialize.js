$(function () {
    $( "#map-generate" ).submit(function( ) {

        // Récupération de la valeur de la map
        if(isNaN(Number( $("#dimension").val()))) {
            $("#dimension-error").text("Doit être un nombre.");
            return false;
        }
        if($("#dimension").val().length === 0) {
            $("#dimension-error").text("Ne peut être vide.");
            return false;
        }

        // Récupération des valeurs des attributs de la map
        var attributes = [];
        attributes[0] = $("#rock").val();
        attributes[1] = $("#sand").val();
        attributes[2] = $("#iron").val();
        attributes[3] = $("#minerals").val();
        attributes[4] = $("#ice").val();
        attributes[5] = $("#other").val();

        $("#map-generate").hide();

        // Requête ajax
        $.ajax({
                type: "POST",
                url: 'request.php',
                dataType: 'json',
                data: {"dimension": $("#dimension").val(), attributes: attributes }
            }).success( function(msg) {
                map = msg;

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
                $("body").append("<p><a href=\"\" >Cliquez pour rechargé la page</a></p>");
            });

            return false;
    });
    $(document).on({
        ajaxStart: function() {
            $("body").addClass("loading");
        },
        ajaxStop: function() {
            $("body").removeClass("loading");
        }
    });

});