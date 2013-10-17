<?php

namespace MapGenerator;

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
        // Coordonnées de la cellule
        // Debug peut-être supprimé sans risque
        $this->_aCell[0] = $iLine . '-' . $iColumn;

        // Algo ##TODO
        $this->_aCell[1] = "{".$this->cellType()."}";

        // Exemple pour ajouter l'élèvation du terrain
        //$this->_aCell[2] =  $this->elevationField();
                
        return $this->_aCell;
    }

    /**
     * Définit le type de la cellule ( si c'est de la roche,
     * de la glace...)
     * 
     * @return array
     */
    private function cellType()
    {
        $aCellType = rand(0, 100);
        // Avec les coordonnées de la case on peut regarder autour pour la gestion des probas
        //var_dump( $this->next($aCoordinates[0], $aCoordinates[1]));
        //echo $aCoordinates[0] . ' ' . $aCoordinates[1] . '<br/>';
        return $aCellType;
    }

    /**
     * Algo elevation du terrain (z index)
     * 
     * @return string
     */
    private function elevationField()
    {
        $sElevation = 0;
        
        return $sElevation;
    }

}
