<?php

namespace Utils;


abstract class Controller {

    public abstract function index( Request $oRequest);

    /**
     * Render the view from the view name
     * @param string $sViewName
     */
    public function render( $sViewName, $aParameters = array())
    {
        // Création du buffer
        ob_start();

        foreach ($aParameters as $sKey => $sValue) {
            ${$sKey} = $sValue;
        }

        include(__DIR__ . '/../views/' . $sViewName . '.php');

        // On récupère le buffer
        $oRendering = ob_get_contents();
        // On vide le buffer
        ob_end_clean();

        return $oRendering;
    }

}
