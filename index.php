<?php
    header('Content-Type: text/html; charset=utf-8');
    ini_set('memory_limit','1024M');
    ini_set('max_execution_time', '60');

    spl_autoload_register();
?>

<html>
  <head>
      <script src="assets/js/jquery-2.0.3.min.js"></script>
      <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
      <script>
        $(function () {
            $( "#map-generate" ).submit(function( event ) {

                if($("#dimension").val().length === 0) {
                    $("#dimension-error").fadeIn(1000, function() {
                        $(this).css( "display", "inline" );
                    });
                    return false;
                }
                $("#map-generate ").fadeOut(2000);

                var attributes = [];
                attributes[0] = $("#rock").val();
                attributes[1] = $("#sand").val();
                attributes[2] = $("#iron").val();
                attributes[3] = $("#minerals").val();
                attributes[4] = $("#ice").val();
                attributes[5] = $("#other").val();

                $.ajax({
                        type: "POST",
                        url: 'request.php',
                        dataType: 'json',
                        data: {"dimension": $("#dimension").val(), attributes: attributes }
                    }).success( function(msg) {
                        map = msg;

                        $.getScript( "assets/js/rover.js" ).fail(function( jqxhr, settings, exception ) {
                             $("body").text("Une erreur s'est produite et le script de déplacement du rover n'a pas été trouvée");
                        });

                        $.getScript( "assets/js/canvas.js" ).fail(function( jqxhr, settings, exception ) {
                            console.log(jqxhr);
                            $("body").text("Une erreur s'est produite et le script de génération de la map n'a pas été trouvée");
                        });

                    }).error( function() {
                        $("body").text("Une erreur s'est produite et la requête n'a pas aboutie :(.");
                    });
                    $("#game-dashboard").fadeIn(2000);
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
    </script>

    <form id="map-generate" method="POST">
              <fieldset>
      <p>
        <label>Dimension: </label>
        <input id="dimension" name="dimension" type="text" placeholder="Dimension" />
        <span id="dimension-error">Ne peut être vide</span>
      </p>
      <div id="show-globals">
          Affiner la création de la carte <a href="#" onclick="$('#show-globals a').text('');$('#globals').fadeIn( 2000);">+</a>
          <span title="La carte sera générée de manière totalement aléatoire si les attributs ne sont pas remplis.">?</span>
      </div>

      <div id="globals">
        <p>
          <label>Pourcentage Roche: </label>
          <input id="rock" name="rock" type="text" placeholder="%" />
        </p>
        <p>
          <label>Pourcentage Sable: </label>
          <input id="sand" name="sand" type="text" placeholder="%" />
        </p>
        <p>
          <label>Pourcentage Fer: </label>
          <input id="iron" name="iron" type="text" placeholder="%" />
        </p>
        <p>
          <label>Pourcentage Mineraux: </label>
          <input id="minerals" name="minerals" type="text" placeholder="%" />
        </p>
        <p>
          <label>Pourcentage Glace: </label>
          <input id="ice" name="ice" type="text" placeholder="%" />
        </p>
        <p>
          <label>Pourcentage Autre: </label>
          <input id="other" name="other" type="text" placeholder="%" />
        </p>
      </div>
      <input type="submit" value="Générer la map" />
       </fieldset>
    </form>
    <div id="game-dashboard">
        <a href="" onclick="$('#mapgenerate').fadeIn( 2000);" id="showForm">Relancer une partie</a>
        <div id="energy">Energy: <span>0</span></div>
        <div id="score">Score: <span>0</span></div>
    </div>
    <canvas id="canvas" >
        Canvas not supported.
    </canvas>
    <!-- Bouton de loading -->
    <div class="modal"></div>
  </body>
</html>