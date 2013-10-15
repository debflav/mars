<?php

/**
 *
 * Genere les attributs de la carte
 * Algo de l'élévation du terrain, la roche...
 *
 */
class MapElement
{

    protected $aAttributes;

    private $_aCell = array();

    /**
     *
     * @param type $iLine
     * @param type $iColumn
     * @return type
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
     */
    public function elevation()
    {
        $sElevation = rand(0, 100);
        return $sElevation;
    }


}
