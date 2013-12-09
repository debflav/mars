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
        <input name="rock" type="text" placeholder="%" />
      </p>
      <p>
        <label>Pourcentage Sable: </label>
        <input name="sand" type="text" placeholder="%" />
      </p>
      <p>
        <label>Pourcentage Fer: </label>
        <input name="iron" type="text" placeholder="%" />
      </p>
      <p>
        <label>Pourcentage Mineraux: </label>
        <input name="minerals" type="text" placeholder="%" />
      </p>
      <p>
        <label>Pourcentage Glace: </label>
        <input name="ice" type="text" placeholder="%" />
      </p>
      <p>
        <label>Pourcentage Autre: </label>
        <input name="other" type="text" placeholder="%" />
      </p>
      <input type="submit" value="Générer la map" />
    </form>
  </body>
</html>