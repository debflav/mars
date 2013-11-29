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

            $aAttributes = array( "rock"     => $oRequest->get('rock')     ? (int) $oRequest->get('rock')     : 0,
                                  "sand"     => $oRequest->get('sand')     ? (int) $oRequest->get('sand')     : 0,
                                  "iron"     => $oRequest->get('iron')     ? (int) $oRequest->get('iron')     : 0,
                                  "minerals" => $oRequest->get('minerals') ? (int) $oRequest->get('minerals') : 0,
                                  "ice"      => $oRequest->get('ice')      ? (int) $oRequest->get('ice')      : 0,
                                  "other"    => $oRequest->get('other')    ? (int) $oRequest->get('other')    : 0,
                                );

            $iNbLine   = (int) $oRequest->get('line');
            $iNbColumn = (int) $oRequest->get('column');

            $oMap = new Map();
            $oMap->generate($iNbLine, $iNbColumn, $aAttributes);
            // DEBUG
            echo '<pre>'; print_r($oMap->getMap());
            $oMap->mapToJsonDebugPrint();
            exit;
            return $this->render('Index/map', array( 'oMap' => $oMap->mapToJson()));
        }

        return $this->render('Index/index', array( ));
    }
}
