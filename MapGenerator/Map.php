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
    protected static $_aMatrice = [];

    /**
     * Attributs de la map(%roche, % glace...)
     * @var array
     */
    protected static $_aGlobalAttributes = [];

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
    private $_iScale = 5;


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


        // Création de la map vide
        for ($i = 0; $i < self::$_iAxeX; $i++) {
            for ($j = 0; $j < self::$_iAxeY; $j++) {
                self::$_aMatrice[$i][$j] = NULL;
            }
        }

        // Remplissage d'une cellule de notre map.
        // Ici on applique notre remplissage trois fois pour lisser les valeurs.
        for($i=0; $i<3; $i++) {
            foreach (self::$_aMatrice as $iLine => $aLine) {
                foreach($aLine as $iColumn => $aCellValue) {
                    $oCellInfo = new CellDrawing();
                    $aCell = $oCellInfo->drawCell( $iLine, $iColumn, $aCellValue);
                    self::$_aMatrice[$iLine][$iColumn] = $aCell;
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