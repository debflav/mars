<?php
    header('Content-Type: text/html; charset=utf-8');
    ini_set('memory_limit','1024M');
    ini_set('max_execution_time', '60');

    spl_autoload_register();
?>

<html>
  <head>
      <script src="assets/js/jquery-2.0.3.min.js"></script>
  </head>
  <body>
      <script>
        $(function () {
            $( "#mapgenerate" ).submit(function( event ) {

                if($("#dimension").val().length === 0) {
                    return false;
                }


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
                            alert('Problème lors du loading du script');
                        });

                        $.getScript( "assets/js/canvas.js" ).fail(function( jqxhr, settings, exception ) {
                            alert('Problème lors du loading du script');
                        });


                    });
                    return false;
            });
        });
    </script>
    <form id="mapgenerate" method="POST">
      <p>
        <label>Dimension: </label>
        <input id="dimension" name="dimension" type="text" placeholder="Dimension" />
      </p>
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
      <input type="submit" value="Générer la map" />
    </form>

        <canvas id="canvas" >
            Canvas not supported.
        </canvas>
  </body>
</html>