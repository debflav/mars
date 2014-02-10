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
      <!-- STYLESHEET -->
      <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <!-- Generation -->
    <fieldset id="map-generate">
        <legend>Generation de la partie</legend>

        <label>Taille de la carte:</label>
        <select name="type" id="dimension">
            <option value="1">Petite</option>
            <option value="2">Moyenne</option>
            <option value="2">Grande</option>
        </select>
        <br />

        <label>Type de partie: </label>
        <select name="type" id ="game-type">
          <option value="1" selected>Destination</option>
          <option value="2">Exploration de carte</option>
        </select>
    </fieldset>

    <?php include_once 'common.php';?>
  </body>
</html>