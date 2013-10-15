<?php

namespace MapGenerator;

use MapGenerator\MapElement;

/**
 * Generation de la carte
 * Méthodes pour parcourir la carte
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


    /**
     * Attribut de la cellule courante
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function current( $iLine, $iColumn)
    {
        return self::$_aMatrice[$iLine][$iColumn];
    }

    /**
     * Cellule adjacente précèdente
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function prev( $iLine, $iColumn)
    {
        if( $iColumn > 0 )
            return self::$_aMatrice[$iLine][$iColumn-1];
    }

    /**
     * Cellule adjacente suivante
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function next( $iLine, $iColumn)
    {
        if( $iColumn < count(self::$_aMatrice[0]) - 1 )
            return self::$_aMatrice[$iLine][$iColumn+1];
    }

    /**
     * Cellule adjacente haut gauche
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function topLeft( $iLine, $iColumn)
    {
        if( $iLine > 0 && $iColumn > 0)
            return self::$_aMatrice[$iLine-1][$iColumn-1];
    }

    /**
     * Cellule adjacente haut droite
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function topRight( $iLine, $iColumn)
    {
        if ( $iColumn < count(self::$_aMatrice[0]) - 1 )
            return self::$_aMatrice[$iLine-1][$iColumn+1];
    }

    /**
     * Cellule adjacente en bas à gauche
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function bottomLeft( $iLine, $iColumn)
    {
        if( $iLine < count(self::$_aMatrice) - 1 && $iColumn < count(self::$_aMatrice) - 1)
            return self::$_aMatrice[$iLine+1][$iColumn-1];
    }

    /**
     * Cellule adjacente en bas à droite
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function bottomRight( $iLine, $iColumn)
    {
        if( $iLine < count(self::$_aMatrice) - 1 && $iColumn < count(self::$_aMatrice) - 1)
            return self::$_aMatrice[$iLine+1][$iColumn+1];
    }
}
