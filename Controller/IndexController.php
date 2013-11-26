<?php

namespace Controller;

use Framework\Mvc\AbstractController,
    Framework\Mvc\Request,
    MapGenerator\Map;

class IndexController extends AbstractController {

    /**
     * User home
     *
     * @param Request $oRequest
     */
    public function index( Request $oRequest)
    {

        if( $oRequest->isMethod('POST')) {

            $aAttributes = array( "roche"    => $oRequest->get('pourcentage_roche')  ? $oRequest->get('pourcentage_roche')    : 0,
                                 "sable"    => $oRequest->get('pourcentage_sable')   ? $oRequest->get('pourcentage_sable')    : 0,
                                 "fer"      => $oRequest->get('pourcentage_fer')     ? $oRequest->get('pourcentage_fer')      : 0,
                                 "mineraux" => $oRequest->get('pourcentage_mineraux')? $oRequest->get('pourcentage_mineraux') : 0,
                                 "autre"    => $oRequest->get('pourcentage_autre')   ? $oRequest->get('pourcentage_autre')    : 0,
                                );

            $iNbLine   = $oRequest->get('ligne');
            $iNbColumn = $oRequest->get('colonne');

            $oMap = new Map();
            $oMap->generate($iNbLine, $iNbColumn, $aAttributes);
            /*echo '<pre>'; print_r($oMap->getMap());
            $oMap->mapToJsonDebugPrint();
            exit;*/
            return $this->render('Index/map', array( 'oMap' => $oMap->mapToJson()));
        }

        return $this->render('Index/index', array( ));
    }
}
