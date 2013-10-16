<?php

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