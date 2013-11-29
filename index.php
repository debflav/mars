<?php
header('Content-Type: text/html; charset=utf-8');
ini_set('memory_limit','1024M');
ini_set('max_execution_time', '60');

spl_autoload_register();

$oRequest = new Framework\Mvc\Request;
$oRouter = new Framework\Mvc\Router();
$oRouter::getInstance();
echo $oRouter->execute( $oRequest);
