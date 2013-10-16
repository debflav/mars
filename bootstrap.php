<?php

spl_autoload_register();

$oRequest = new Utils\Request;
$oRouter = new Utils\Router();
$oRouter::getInstance();
echo $oRouter->execute( $oRequest);
