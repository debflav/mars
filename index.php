<?php

spl_autoload_register();

$oMap = new MapGenerator\Map();
$oMap->generate(5, 5);
$aMap = $oMap->getMap();

if( !empty($aMap)) {
    foreach ( $aMap as $aValue) {
        foreach ($aValue as $sKey => $aInformationCell) {
            // Une ligne
            if($sKey == 0){
                echo '<br/>';
            }
            foreach( $aInformationCell as $sKey => $sValue) {
                echo  $sValue . '&nbsp; ';
            }
            echo '&nbsp; | &nbsp;';
        }
    }
}


//var_dump($oMap->next(3 , 1));

/*var_dump($oMap->current(3 , 1));
var_dump($oMap->bottomLeft(3 , 1));*/