<?php
    ini_set('memory_limit','4096M');
    ini_set('max_execution_time', '60');

    include 'constant.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!-- STYLESHEET -->
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
    <body>
      <div class="center-div">
          <input type="submit" class='btn' value="Générer une nouvelle carte" onclick="window.location='map.php';" />
          <br />
          <p>OU</p>
          <input type="submit" class='btn' value="Chargement d'une carte" onclick="window.location='json.php';"/>
      </div>
    </body>
</html>