<?php

namespace Controller;

use Utils\Controller;
use Utils\Request;
use MapGenerator\Map;

class IndexController extends Controller {

    /**
     * User home
     *
     * @param Request $oRequest
     */
    public function index( Request $oRequest)
    {

        if( $oRequest->isMethod('POST')) {
            $iNbLine   = $oRequest->get('ligne');
            $iNbColumn = $oRequest->get('colonne');

            $oMap = new Map();
            $oMap->generate($iNbLine, $iNbColumn);
            return $this->render('Index/map', array( 'aMap' => $oMap->getMap()));
        }



        return $this->render('Index/index', array( ));
    }
}
