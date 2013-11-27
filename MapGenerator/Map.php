<?php

namespace MapGenerator;

use MapGenerator\CellDrawing;

/**
 * Generation de la carte
 * Méthodes pour parcourir la carte
 */
class Map implements MapInterface
{

    /**
     * Notre map
     * @var array
     */
    protected static $_aMatrice = array();

    /**
     * Attributs de la map(%roche,% glace...)
     * @var array
     */
    protected static $_aGlobalAttributes = array( );

    /**
     * Taille axe des X
     * @var int
     */
    protected static $_iAxeX;


    /**
     * Taille axe des Y
     * @var int
     */
    protected static $_iAxeY;


    /**
     * Echelle de la map en mètre (default 100)
     * @var int
     */
    private $_iScale = 100;


    /**
     * Generation de la carte
     * Echelle, numéro de lignes, colonnes et les attributs
     *
     * @param integer $iNbLine
     * @param integer $iNbColumn
     * @param array   $aAttributs
     * @return void
     */
    public function generate($iNbLine, $iNbColumn, $aAttributes)
    {
        // Setters
        self::$_aGlobalAttributes = $aAttributes;
        self::$_iAxeX             = $iNbLine;
        self::$_iAxeY             = $iNbColumn;

        // Initialisation de la map
        self::$_aMatrice["echelle"] = $this->_iScale;
        self::$_aMatrice["lignes"] = array(self::$_iAxeX);

        // Création de la map vide
        for ($i = 0; $i < self::$_iAxeX; $i++) {
        self::$_aMatrice["lignes"][$i] = array( self::$_iAxeY);
            for ($j = 0; $j < self::$_iAxeY; $j++) {
                // Séparateur coordonnées matrice
                $aCell[0] = $i . '-' . $j;
                self::$_aMatrice["lignes"][$i][$j] = $aCell;
            }
        }

        // Remplissage de la cellule courante de la map
        foreach (self::$_aMatrice["lignes"] as $aMapInformationCell) {
            foreach( $aMapInformationCell as $aValue) {
                foreach( $aValue as $sValue) {
                    // Coordonnées de la cellule
                    $aPosition = explode('-', $sValue);
                    // Création des attributs de la cellule
                    $oCellInfo = new CellDrawing();
                    $aCell = $oCellInfo->drawCell( $aPosition[0], $aPosition[1]);
                    self::$_aMatrice["lignes"][$aPosition[0]][$aPosition[1]] = $aCell;
                }
            }
        }
    }


    /**
     * Retourne la carte sous forme de tableau
     *
     * @return array
     */
    public function getMap()
    {
        return self::$_aMatrice;
    }


    /**
     * Encode et retourne la carte au format Json
     *
     * @return string JSON
     */
    public function mapToJson()
    {
        return json_encode( self::$_aMatrice);
    }


    /**
     * Encode et retourne la carte au format Json
     *
     * @return JSON
     */
    public function mapToJsonDebugPrint()
    {
        echo '<pre>';
        print_r(json_encode( self::$_aMatrice, JSON_PRETTY_PRINT));
    }


    /**
     * Prend un Json en paramètre
     *
     * @return string JSON
     */
    public function loadJson( $sJson)
    {
        // test du format json... ##TODO

    }

}