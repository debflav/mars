<html>
  <head>
      <script src="assets/js/jquery-2.0.3.min.js"></script>
  </head>
  <body>
      <script>
        $(function () {
            $( "#mapgenerate" ).submit(function( event ) {
                if($("#line").val().length === 0) {
                    return false;
                }
                if($("#column").val().length === 0) {
                    return false;
                }
            });
        });
    </script>
    <form id="mapgenerate" method="POST">
      <p>
        <label>Dimension en X: </label>
        <input id="line" name="line" type="text" placeholder="Dimension en X" />
      </p>
      <p>
        <label>Dimension en Y: </label>
        <input id="column" name="column" type="text" placeholder="Dimension en Y" />
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
        <label>Pourcentage Autre: </label>
        <input name="other" type="text" placeholder="%" />
      </p>
      <input type="submit" value="Generer la map" />
    </form>
  </body>
</html>