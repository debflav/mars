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
    <fieldset id='map-generate'>
        <legend>Type de partie</legend>
        <select name="type" id ="game-type">
            <option value="1">Destination</option>
            <option value="2">Exploration de carte</option>
        </select>
    </fieldset>

    <!-- JSON upload -->
    <fieldset id="json-upload">
        <legend>Votre fichier JSON</legend>
        <input disabled type="file" name="afile" id="afile" accept="*"/>
    </fieldset>

    <?php include_once 'common.php';?>
  </body>
</html>