<?php

$attributes = $_POST['attributes'];
$dimension  = $_POST['dimension'];

$map = new MapGenerator\Map();
$map->generate($dimension, array($attributes));
echo $map->mapToJson();
