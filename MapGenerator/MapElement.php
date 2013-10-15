<?php

namespace MapGenerator;

/**
 *
 * Genere les attributs de la carte
 * Algo de l'élévation du terrain, la roche...
 *
 */
class MapElement
{

    /**
     * Tous les attributs(% roche, % glace... ##TODO)
     *
     * @var array
     */
    protected $aAttributes;

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
        $this->_aCell[1] = "{".$this->elevation()."}";

        return $this->_aCell;
    }

    /**
     * Algo z index
     *
     * @return string
     */
    public function elevation()
    {
        $sElevation = rand(0, 100);

        return $sElevation;
    }


}
