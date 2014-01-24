<?php

spl_autoload_register();

$dimension  = isset($_POST['dimension'])  ? $_POST['dimension']  : NULL;

if($dimension === NULL) {
    $map = new MapGenerator\Map();
    // ##TODO check json validity
    // $map->checkJsonFormat(file_get_contents($_FILES["afile"]["tmp_name"]));
    echo file_get_contents($_FILES["afile"]["tmp_name"]);
} else {

    $map = new MapGenerator\Map();
    $map->generate($dimension);
    echo $map->mapToJson();
}
