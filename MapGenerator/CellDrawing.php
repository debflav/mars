<?php

namespace MapGenerator;

use MapGenerator\Element\Element;

/**
 * Génère une cellule de la map:
 * Elevation du terrain, type de case.
 */
class CellDrawing extends Map
{

    /**
     * Une cellule
     *
     * @var array
     */
    private $_aCell = array();


    /**
     * Dessine une cellule
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function drawCell( $iLine, $iColumn)
    {
        // Cell cordonnate
        $this->_aCell["debugXY"] = array( $iLine, $iColumn);

        // Coordonnées Z
        $this->_aCell["elevation"] = $this->elevationField();

        // Algo TODO;
        $this->_aCell["nature"] = array( $this->defineCellType());

        return $this->_aCell;
    }

    /**
     * Définit le type de la cellule
     *
     * @return array. ex : ( "rock" => 35, "sand" => 25...)
     */
    private function defineCellType()
    {
        // Création d'un nouvel élément
        $aElement = new Element( self::$_aGlobalAttributes);

        $aCellType = rand(0, 100);
        return $aCellType;
    }

    /**
     * Algo elevation du terrain (z index)
     *
     * @return string
     */
    private function elevationField()
    {
        $sElevation = rand(0, 100);

        return $sElevation;
    }

}
