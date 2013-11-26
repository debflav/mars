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
        $this->_aCell["debugXY"] = array($iLine, $iColumn);

        // Coordonnées Z
        $this->_aCell["elevation"] = $this->cellAttributes();

        // Algo TODO;
        $this->_aCell["nature"] = array(
                                        "example1" => $this->cellAttributes(),
                                        "example2" => $this->cellAttributes(),
                                        );

        return $this->_aCell;
    }

    /**
     *
     * @return string
     */
    public function cellAttributes()
    {
        $aCellAttributes = rand(0, 100);
        // Avec les coordonnées de la case on peut regarder autour pour la gestion des probas
        //var_dump( $this->next($aCoordinates[0], $aCoordinates[1]));
        //echo $aCoordinates[0] . ' ' . $aCoordinates[1] . '<br/>';
        return $aCellAttributes;
    }


}
