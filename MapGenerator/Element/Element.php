<?php

namespace MapGenerator\Element;

use MapGenerator\CellDrawing;


class Element extends CellDrawing implements ElementInterface
{


    /**
     * A implementer
     */
    public function Algo()
    {
        $natureTemp = array(0,0,0,0,0,0); // tableau de 6 cases vides

        $typeNature = 0; // basée par défaut sur la roche

        $natureCellule = array(); // tableau de la taille de la map comportant
        //la nature de chaque cellule remplie au fur et à mesure de la génération.

        $totalTemp = 0; // variable d'agrégation qui va servir à redéfinir le maximum pour le jet de dé

        $compteur = 0; // variable qui va permettre de définir

        // pourcentage des natures globales de la carte
        $nature[0]=55;  // roche
        $nature[1]=29;  // sable
        $nature[2]=5;   // minerai
        $nature[3]=5;   // fer
        $nature[4]=3;   // glace
        $nature[5]=3;   // autre

        $i = self::$_aCellPosition[0];
        $j = self::$_aCellPosition[1];

        //On va chercher les natures sur la ligne
        if(isset(self::$_aMatrice[$i-1][$j])) {

            if(isset(self::$_aMatrice[$i-2][$j])) {

                if(isset(self::$_aMatrice[$i-3][$j])) {

                    $natureTemp[$natureCellule[$i-3][$j]] + 5;
                }

                $natureTemp[$natureCellule[$i-2][$j]] + 10;
            }

            $natureTemp[$natureCellule[$i-1][$j]] + 15;
        }

        //on va chercher les natures sur la colonne
        if(isset(self::$_aMatrice[$i][$j-1])) {

            if(isset(self::$_aMatrice[$i][$j-2])) {

                if(isset(self::$_aMatrice[$i][$j-3])) {

                    $natureTemp[$natureCellule[$i][$j-3]] + 5;
                }

                $natureTemp[$natureCellule[$i][$j-2]] + 10;
            }

            $natureTemp[$natureCellule[$i][$j-1]] + 15;
        }

        // on agrège le tout
        for($k=0;$k<6;$k++)
        {
            //par nature
            $natureTemp[$k] = $natureTemp[$k] + $nature[$k];

            // on fait le total pour le jet de dés
            $totalTemp = $totalTemp + $natureTemp[$k];

        }


        // Définir la fonction rand() entre 0 et $totalTemp
        $jet = rand(0, $totalTemp);


        // fait un tri du résultat pout trouver la bonne nature
        for($l=0; $l<6; $l++)
        {
           if ($jet > $compteur && $jet <= ($compteur + $natureTemp[$l]))
           {
               $typeNature = $l; // on affecte à la cellule actuelle la nature tirée au dé
           }

           $compteur = $compteur + $natureTemp[$l];
        }


        return $typeNature;
    }

    // /**
    //  * Attribut de la cellule courante
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return array
    //  */
    // public function current( $iLine, $iColumn)
    // {
    //     return self::$_aMatrice[$iLine][$iColumn];
    // }


    // /**
    //  * Cellule adjacente précèdente
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return null|array
    //  */
    // public function prev( $iLine, $iColumn)
    // {
    //     if( $iColumn > 0 )
    //         return self::$_aMatrice['map'][$iLine][$iColumn-1];
    // }


    // /**
    //  * Cellule adjacente suivante
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return null|array
    //  */
    // public function next( $iLine, $iColumn)
    // {
    //     if( $iColumn < (self::$_iAxeY - 1))
    //         return self::$_aMatrice['map'][$iLine][$iColumn+1];
    // }


    // /**
    //  * Cellule adjacente haut gauche
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return null|array
    //  */
    // public function topLeft( $iLine, $iColumn)
    // {
    //     if( $iLine > 0 && $iColumn > 0)
    //         return self::$_aMatrice['map']["lignes"][$iLine-1][$iColumn-1];
    // }


    // /**
    //  * Cellule adjacente haut droite
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return null|array
    //  */
    // public function topRight( $iLine, $iColumn)
    // {
    //     if ( $iColumn < (self::$_iAxeY - 1) &&  $iLine > 0)
    //         return self::$_aMatrice['map'][$iLine-1][$iColumn+1];
    // }



    // /**
    //  * Cellule adjacente en bas à gauche
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return null|array
    //  */
    // public function bottomLeft( $iLine, $iColumn)
    // {
    //     if( $iLine < self::$_iAxeY - 1 && $iColumn > 0)
    //         return self::$_aMatrice['map'][$iLine+1][$iColumn-1];
    // }


    // /**
    //  * Cellule adjacente en bas à droite
    //  *
    //  * @param integer $iLine
    //  * @param integer $iColumn
    //  * @return null|array
    //  */
    // public function bottomRight( $iLine, $iColumn)
    // {
    //     if( $iLine < self::$_iAxeX - 1 && $iColumn < $this->_iAxeY - 1)
    //         return self::$_aMatrice['map'][$iLine+1][$iColumn+1];
    // }
}
