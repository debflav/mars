<?php
header('Content-Type: text/html; charset=utf-8');

spl_autoload_register();

$oRequest = new Framework\Mvc\Request;
$oRouter = new Framework\Mvc\Router();
$oRouter::getInstance();
echo $oRouter->execute( $oRequest);
