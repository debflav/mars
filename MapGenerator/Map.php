<?php

namespace MapGenerator;

use MapGenerator\MapElement,
    Framework\Singleton;

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
    private $_iAxeX;


    /**
     * Taille axe des Y
     * @var int
     */
    private $_iAxeY;


    /**
     * Echelle de la map en mètre (default 100)
     * @var int
     */
    private $_iScale = 100;


    use Singleton;


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
        $this->_iAxeX             = $iNbLine;
        $this->_iAxeY             = $iNbColumn;

        // Initialisation de la map
        self::$_aMatrice["scale"] = $this->_iScale;
        self::$_aMatrice[] = array($this->_sAxeX);

        // Création de la map vide
        for ($i = 0; $i < $this->_sAxeX; $i++) {
        self::$_aMatrice[0][$i] = array( $this->_sAxeY);
            for ($j = 0; $j < $this->_sAxeY; $j++) {
                // Séparateur coordonnées matrice
                $aCell[0] = $i . '-' . $j;
                self::$_aMatrice[0][$i][$j] = $aCell;
            }
        }

        // Remplissage de la map
        foreach (self::$_aMatrice[0] as $aMapInformationCell) {
            foreach( $aMapInformationCell as $aValue) {
                foreach( $aValue as $sValue) {
                    // On retrouve les coordonnées de la map par le biais du explode
                    $aCoordinates = explode('-', $sValue);
                    // On crée la case de la map à l'aide d'un algo
                    $oMapElement = new CellDrawing();
                    $aCell = $oMapElement->drawCell( $aCoordinates[0], $aCoordinates[1]);

                    self::$_aMatrice[$aCoordinates[0]][$aCoordinates[1]] = $aCell;
                }
            }
        }

        /*$natureTemp[5]; // tableau de 5 cases vides

        $natureCellule[$i][$j]; // tableau de la taille de la map comportant
        //la nature de chaque cellule remplie au fur et à mesure de la génération.

        $totalTemp = 0; // variable d'agrégation qui va servir à redéfinir le maximum pour le jet de dé

        $compteur = 0; // variable qui va permettre de définir

        // pourcentage des natures globales de la carte
        $nature[1]=60; //roche
        $nature[2]=30; //sable
        $nature[3]=5; //fer
        $nature[4]=3; //mineral
        $nature[5]=2; //autre

        //On va chercher les natures sur la ligne
        if(isset(case[$i-1][$j])) {
            if(isset(case[$i-2][$j])) {
                if(isset(case[$i-3][$j])) {
                    $natureTemp[$natureCellule[$i-3][$j]] + 5;
                }

                $natureTemp[$natureCellule[$i-2][$j]] + 5;
            }

            $natureTemp[$natureCellule[$i-1][$j]] + 5;
        }

        //on va chercher les natures sur la colonne
        if(isset(case[$i][$j-1])) {
            if(isset(case[$i][$j-2])) {
                if(isset(case[$i][$j-3])) {
                    $natureTemp[$natureCellule[$i][$j-3]] + 5;
                }

                $natureTemp[$natureCellule[$i][$j-2]] + 5;
            }

            $natureTemp[$natureCellule[$i][$j-1]] + 5;
        }

        // on agrège le tout
        for($k=0;$k<5;$k++)
        {
            //par nature
            $natureTemp[$k] = $natureTemp[$k] + $nature[$k];

            // on fait le total pour le jet de dés
            $totalTemp = $totalTemp + $natureTemp[$k];

        }


       // Définir la fonction rand() entre 0 et $totalTemp
       $jet = rand(min=0, max=$totalTemp); // a corriger !!


       // fait un tri du résultat pout trouver la bonne nature
       for($l=0; $l<5; $l++)
       {
           if ($jet > $compteur && $jet <= ($compteur + $natureTemp[$l]))
           {
               $natureCellule[$i][$j] = $l; // on affecte à la cellule actuelle la nature tirée au dé
           }

           $compteur = $compteur + $natureTemp[$l];
       }*/

    }

    /**
     * Retourne la carte
     *
     * @return array
     */
    public function getMap()
    {
        return self::$_aMatrice;
    }


    /**
     * Encode la map en Json
     *
     * @return string JSON
     */
    public function mapToJson()
    {
        return json_encode( self::$_aMatrice);
    }


    /**
     * To json
     *
     * @return JSON
     */
    public function mapToJsonDebugPrint()
    {
        echo '<pre>';
        print_r(json_encode( self::$_aMatrice, JSON_PRETTY_PRINT));
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
        if( $iColumn < ($this->_iAxeY - 1))
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
        if ( $iColumn < ($this->_iAxeY - 1) &&  $iLine > 0)
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
        if( $iLine < $this->_iAxeY - 1 && $iColumn > 0)
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
        if( $iLine < $this->_iAxeX - 1 && $iColumn < $this->_iAxeY - 1)
            return self::$_aMatrice[$iLine+1][$iColumn+1];
    }
}
