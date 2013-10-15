<?php

namespace MapGenerator;

use MapGenerator\MapElement;
/**
 * Generate the Map
 *
 */
class Map implements MapGenerator
{
    /**
     * Notre map
     *
     * @var array
     */
    protected static $_aMatrice;


    /**
     * Generation de la carte
     *
     * @param integer $iNbLine
     * @param integer $iNbColumn
     * @return array
     */
    public function generate($iNbLine, $iNbColumn)
    {
        self::$_aMatrice = array($iNbLine);

        for ($i = 0; $i < $iNbLine; $i++) {
        self::$_aMatrice[$i] = array($iNbColumn);
            for ($j = 0; $j <$iNbColumn; $j++) {
                $oMapElement = new MapElement();
                $aCell = $oMapElement->drawCell( $i, $j);
                self::$_aMatrice[$i][$j] = $aCell;
            }
        }
    }

    /**
     * Retourne la carte
     *
     * @return Map
     */
    public function getMap()
    {
        return self::$_aMatrice;
    }

    /**
     * To json
     *
     * @return JSON
     */
    public function mapToJson()
    {
        return json_encode( self::$_aMatrice);
    }

    public function current( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine][$iColumn];
    }

    public function prev( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine][$iColumn-1];
    }

    public function next( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine][$iColumn+1];
    }

    public function topLeft( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine-1][$iColumn-1];
    }

    public function topRight( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine-1][$iColumn+1];
    }

    public function bottomLeft( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine+1][$iColumn+1];
    }

    public function bottomRight( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine+1][$iColumn-1];
    }
}
