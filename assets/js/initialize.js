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
        $("#map-generate").hide();

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

            }).error( function( ) {
                $("body").text("Une erreur s'est produite et la requête n'a pas aboutie :(.");
                $("body").append("<p><a href=\"\" >Cliquez pour recharger la page</a></p>");
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