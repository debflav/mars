<?php

namespace MapGenerator;

use MapGenerator\Element\Element;

/**
 * Génère une cellule de la map:
 * Son elevation, le type de case.
 */
class CellDrawing extends Map
{

    /**
     * Contient toutes les informations sur notre cellule courante.
     *
     * @var array
     */
    private $_aCell = [];


    /**
     * Position de la cellule courante
     *
     * @var array
     */
    protected $_aCellPosition = [];


    /**
     * Dessine une cellule.
     * z      : Elevation de notre terrain.
     * nature : nombre entre 1 et 6.
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function drawCell( $iLine, $iColumn, $aCellValue)
    {
        $this->_aCellPosition = array( $iLine, $iColumn);

        // Si aucune valeur on crée notre tableau pour la première fois,
        // sinon on lisse nos premières valeurs obtenues.
        if( empty( $aCellValue)) {
            $this->_aCell["z"] = $this->elevationField();
            $this->_aCell["type"] = $this->defineCellType( $iLine, $iColumn);
        } else {

        }

        return $this->_aCell;
    }

    /**
     * Définit le type de la cellule.
     *
     * @return string
     */
    private function defineCellType( $iLine, $iColumn)
    {
        // Création d'un nouvel élément
        $oElement = new Element( );
        $sCellType = $oElement->Algo($iLine, $iColumn);

        return $sCellType;
    }

    /**
     * Définit l'élevation du terrain.
     *
     * @return string
     */
    private function elevationField()
    {
        $sElevation = rand(-100, 100);

        return $sElevation;
    }

}
