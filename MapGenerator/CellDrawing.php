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
     * Contient toutes les informations sur notre cellule courante
     *
     * @var array
     */
    private $_aCell = array();


    /**
     * Dessine une cellule
     * Z : Elevation de notre terrain
     * nature : nombre entre 1 et 6
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function drawCell( $iLine, $iColumn)
    {
        // Coordonnées Z
        $this->_aCell["z"] = $this->elevationField();

        // Algo TODO;
        $this->_aCell["nature"] = $this->defineCellType( $iLine, $iColumn);

        return $this->_aCell;
    }

    /**
     * Définit le type de la cellule
     *
     * @return string
     */
    private function defineCellType( $iLine, $iColumn)
    {
        $aCellPosition = array( $iLine, $iColumn);

        // Création d'un nouvel élément
        $oElement = new Element( $aCellPosition);
        $sCellType = $oElement->Algo();

        return $sCellType;
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
