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

            $iDimension   = (int) $oRequest->get('dimension');

            $oMap = new Map();
            $oMap->generate($iDimension, $aAttributes);

            return $this->render('Index/map', array( 'oMap' => $oMap->mapToJson()));
        }

        return $this->render('Index/index', array( ));
    }
}
