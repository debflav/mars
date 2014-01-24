<?php
    ini_set('memory_limit','4096M');
    ini_set('max_execution_time', '60');

    include 'constant.php';
?>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- JAVASCRIPT -->
      <script src="assets/js/jquery-2.0.3.min.js"></script>
      <script src="assets/js/initialize.js"></script>
      <script src="assets/js/upload.js"></script>
      <!--[if IE]>
        <script src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
        <script>CFInstall.check({mode: 'overlay'});</script>
      <![endif]-->
      <!-- STYLESHEET -->
      <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <!-- Formulaire -->
    <form id="map-generate" method="POST">
        <fieldset>
            <p>
              <label>Dimension: </label>
              <input id="dimension" name="dimension" type="text" placeholder="Dimension" />
              <span id="dimension-error"></span>
            </p>
            <label>Type de partie: </label>
            <select name="type" id ="game-type">
              <option value="1" selected>Destination</option>
              <option value="2">Exploration de carte</option>
            </select>
            <input type="submit" value="Générer la map" />
        </fieldset>
    </form>

    <!-- JSON upload -->
    <fieldset>
        <legend>Charger un fichier JSON</legend>
        <input type="file" name="afile" id="afile" accept="*"/>
    </fieldset>
    
    <!-- Dashboard -->
    <div id="game-dashboard">
        <a href="" onclick="$('#mapgenerate').fadeIn( 2000);" id="showForm">Relancer une partie</a>
        <div id="energy">Energie: <span>0</span></div>
        <div id="round">Nombre de tours: <span>0</span></div>
    </div>

    <!-- Canvas -->
    <canvas id="canvas"></canvas>

    <!-- Console -->
    <div id="console">
        <h3>Console</h3>
    </div>

    <!-- Bouton de loading -->
    <div class="modal"></div>
  </body>
</html>