<?php

namespace MapGenerator;

use MapGenerator\MapElement,
    Utils\Singleton;

/**
 * Generation de la carte
 * Méthodes pour parcourir la carte
 */
class Map implements MapGenerator
{
    /**
     * Notre map
     * @var array
     */
    protected static $_aMatrice = array();


    /**
     * Tous les attributs(% roche, % glace...)
     * @var array
     */
    protected $_aAttributes = array( );

    ##TODO voir pour créer des attributs _sAxeX et _sAxeY


    /**
     * Taille axe des X
     * @var string
     */
    private $_sAxeX;


    /**
     * Taille axe des Y
     * @var string
     */
    private $_sAxeY;


    use Singleton;


    /**
     * Generation de la carte
     * Nombre de lignes, colonnes et les attributs
     * exemple(10, 10, array(rock => 60, sand => 30))
     *
     * @param integer $iNbLine
     * @param integer $iNbColumn
     * @param array   $aAttributs
     * @return array
     */
    public function generate($iNbLine, $iNbColumn, $aAttributes)
    {
        // Setters
        $this->_aAttributes = $aAttributes;
        $this->_sAxeX       = $iNbLine;
        $this->_sAxeY       = $iNbColumn;

        self::$_aMatrice = array($this->_sAxeX);

        // Création de la map vide
        for ($i = 0; $i < $this->_sAxeX; $i++) {
        self::$_aMatrice[$i] = array( $this->_sAxeY);
            for ($j = 0; $j < $this->_sAxeY; $j++) {
                // Séparateur coordonnées matrice
                $aCell[0] = $i . '-' . $j;
                self::$_aMatrice[$i][$j] = $aCell;
            }
        }

        // Remplissage de la map
        foreach (self::$_aMatrice as $aInformationCell) {
            foreach( $aInformationCell as $sKey => $aValue) {
                foreach( $aValue as $sValue) {
                    // On retrouve les coordonnées de la map par le biais du explode
                    // On ajoute avec les caracteristique de la case
                    $aCoordinates = explode('-', $sValue);
                    $oMapElement = new MapElement();
                    $aCell = $oMapElement->drawCell( $aCoordinates[0], $aCoordinates[1]);
                    self::$_aMatrice[$aCoordinates[0]][$aCoordinates[1]] = $aCell;
                    var_dump( $this->bottomRight($aCoordinates[0],$aCoordinates[1]));
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
        if( $iColumn < ($this->_sAxeY - 1))
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
        if ( $iColumn < ($this->_sAxeY - 1) &&  $iLine > 0)
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
        if( $iLine < $this->_sAxeY - 1 && $iColumn > 0)
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
        if( $iLine < $this->_sAxeX - 1 && $iColumn < $this->_sAxeY - 1)
            return self::$_aMatrice[$iLine+1][$iColumn+1];
    }
}
