<?php
    ini_set('memory_limit','1024M');
    ini_set('max_execution_time', '60');

    include 'constant.php';
?>
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <!-- JAVASCRIPT -->
      <script src="assets/js/jquery-2.0.3.min.js"></script>
      <script src="assets/js/initialize.js"></script>
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
            <p>
            <label>Type de partie: </label>
            <select name="type" id ="game-type">
              <option value="1" selected>Destination</option>
              <option value="2">Exploration de carte</option>
              <option value="3">Récolte de matériel</option>
            </select>
            </p>
            <div id="show-globals">
                Affiner la création de la carte <a href="#" onclick="$('#show-globals a').text('');$('#globals').fadeIn( 2000);">+</a>
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

    <!-- Formulaire d'envoi de JSON ##TODO -->
    <form id="map-upload" enctype="multipart/form-data" method="POST">
        <fieldset>
            <legend>Upload fucking json</legend>
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
            <input type="file" id="jsonfile" name="file" />
            <input type="submit" value="Envoyer" />
        </fieldset>
    </form>

    <!-- Dashboard -->
    <div id="game-dashboard">
        <a href="" onclick="$('#mapgenerate').fadeIn( 2000);" id="showForm">Relancer une partie</a>
        <div id="energy">Energie: <span>0</span></div>
        <div id="round">Nombre de tours: <span>0</span></div>
    </div>

    <!-- Canvas -->
    <canvas id="canvas" ></canvas>

    <!-- Console -->
    <div id="console">
        <h3>Console</h3>
    </div>

    <!-- Bouton de loading -->
    <div class="modal"></div>
  </body>
</html>