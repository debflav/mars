<?php

spl_autoload_register();

$attributes = isset($_POST['attributes']) ? $_POST['attributes'] : NULL;
$dimension  = isset($_POST['dimension'])  ? $_POST['dimension']  : NULL;

if($dimension === NULL) {
    $map = new MapGenerator\Map();
    echo $map->mapToJson($_FILES);
} else {

    $map = new MapGenerator\Map();
    $map->generate($dimension, array($attributes));
    echo $map->mapToJson();
}
