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
            //     $oMapElement = new MapElement();
            //     $aCell = $oMapElement->drawCell( $i, $j);
            //     self::$_aMatrice[$i][$j] = $aCell;
            // 

                $natureTemp[5]; // tableau de 5 cases vides

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
               }

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
