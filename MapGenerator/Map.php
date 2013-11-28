<?php

namespace MapGenerator;

use MapGenerator\CellDrawing;

/**
 * Generation de notre object map retourné au javascript.
 */
class Map implements MapInterface
{

    /**
     * La map
     *
     * @var array
     */
    protected static $_aMatrice = array();

    /**
     * Attributs de la map(%roche, % glace...)
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
     * Initialisation des attributs de la map (echelle, taille...).
     * Fonction générale pour la génération de la carte.
     *
     * @param integer $iNbLine
     * @param integer $iNbColumn
     * @param array   $aAttributes
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
                // $aCell[0] = $i . '-' . $j;
                // Initialisation de notre matrice
                self::$_aMatrice["lignes"][$i][$j] = NULL;
            }
        }

        // Remplissage de la cellule courante de la map
        /*foreach (self::$_aMatrice["lignes"] as $aMapInformationCell) {
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
        }*/

        // Remplissage d'une cellule de notre map.
        // Ici on applique notre remplissage trois fois pour lisser les valeurs.
        for($i=0; $i<3; $i++) {
            foreach (self::$_aMatrice["lignes"] as $iLine => $aLine) {
                foreach($aLine as $iColumn => $aCellValue) {
                    $oCellInfo = new CellDrawing();
                    $aCell = $oCellInfo->drawCell( $iLine, $iColumn, $aCellValue);
                    self::$_aMatrice["lignes"][$iLine][$iColumn] = $aCell;
                }
                $iLine++;
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
        echo '<pre>';print_r(json_encode( self::$_aMatrice, JSON_PRETTY_PRINT));
    }


    /**
     * ##TODO
     * Prend un Json en paramètre
     *
     * @return string JSON
     */
    public function generateMapFromJson( $sJson)
    {
        // Utilisé lors de l'envoi d'un fichier.
        // test du format json...(extension...)

    }

}