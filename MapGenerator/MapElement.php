<?php

namespace MapGenerator;

/**
 *
 * Genere une cellule de la map:
 * ses attributs...
 * Algo de l'élévation du terrain, la roche...
 *
 */
class MapElement extends Map
{

    /**
     * Une cellule
     *
     * @var array
     */
    private $_aCell = array();

    /**
     * 'Dessine' une cellule
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function drawCell( $iLine, $iColumn)
    {
        // Cell cordonnate
        $this->_aCell[0] = $iLine . '-' . $iColumn;

        // Algo TODO;
        $this->_aCell[1] = "{".$this->cellAttributes()."}";

        return $this->_aCell;
    }

    /**
     *
     * @return string
     */
    public function cellAttributes()
    {
        $aCellAttributes = rand(0, 100);
        $aCoordinates = explode('-', $this->_aCell[0]);
        // Avec les coordonnées de la case on peut regarder autour pour la gestion des probas
        // Attention on est dans la génération du tableau de gauche vers la droite
        // ligne par ligne...
        // Tableau actuellement completé : var_dump( static::$_aMatrice);
        // ##TODO
        //echo $aCoordinates[0] . ' ' . $aCoordinates[1] . '<br/>';
        return $aCellAttributes;
    }


}
