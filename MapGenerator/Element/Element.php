<?php

namespace MapGenerator\Element;

use MapGenerator\CellDrawing;


class Element extends CellDrawing implements ElementInterface
{

    
    /**
     * A implementer
     */
    public function Algo($i, $j)
    {
        // pourcentage des natures globales de la carte
        $nature[0]=45; //roche
        $nature[1]=30; //sable
        $nature[2]=15; //fer
        $nature[3]=7; //mineral
        $nature[4]=2; //glace
        $nature[5]=1; //autre
        
        $natureTemp = [null, null, null, null, null, null]; // tableau de 5 cases vides
        $naturePrev = [];
        //aCurrent_Map = self::$_aMatrice;
        $inatureCellule = 0; // tableau de la taille de la map comportant
        //la nature de chaque cellule remplie au fur et à mesure de la génération.

        $totalTemp = 0; // variable d'agrégation qui va servir à redéfinir le maximum pour le jet de dé

        $compteur = 0; // variable qui va permettre de définir




        // On récupère les cellules précédente
        $cellPrev = $this->prev($i, $j);
        $naturePrev = $this->prev_nature($i, $j);
        $cellPrev2 = $this->prev($i, $j - 1);
        $naturePrev2 = $this->prev_nature($i, $j - 1);
        $cellPrev3 = $this->prev($i, $j - 2);
        $naturePrev3 = $this->prev_nature($i, $j - 2);


        //On va chercher les natures sur la ligne
        if(isset($cellPrev) && isset($naturePrev)) {
            if(isset($cellPrev2) && isset($naturePrev2)) {
                if(isset($cellPrev3) && isset($naturePrev3)) {
                    $nature[$naturePrev3] = $nature[$naturePrev3] + 10;

                }

                $nature[$naturePrev2] = $nature[$naturePrev2] + 10;
            }

            $nature[$naturePrev] = $nature[$naturePrev] + 10;
        }

        $colTop = $this->top($i, $j);
        $natureTop = $this->top_nature_colonne($i, $j);

        $colTop2 = $this->top($i -1, $j);
        $natureTop2 = $this->top_nature_colonne($i-1, $j);

        $colTop3 = $this->top($i - 2, $j);
        $natureTop3 = $this->top_nature_colonne($i-2, $j);

        $colTopLeft = $this->topLeft($i, $j);
        $colTopLeft1_1 = $this->topLeft($i, $j - 1);
        $colTopLeft2_1 = $this->topLeft($i - 1, $j - 1);
        $colTopLeft1_2 = $this->topLeft($i - 1, $j);

        if($i > 0 && $j < self::$_iAxeX)
        {
           $natureTopLeft = $this->topleft_nature_colonne($i, $j);
           $natureTopLeft1_1 = $this->topleft_nature_colonne($i, $j-1);
           $natureTopLeft2_1 = $this->topleft_nature_colonne($i - 1, $j-1);
           $natureTopLeft1_2 = $this->topleft_nature_colonne($i - 1, $j);
        }

        
        //on va chercher les natures sur la colonne
        if(isset($colTop) && isset($natureTop)) {
                $nature[$natureTop] = $nature[$natureTop] + 10;
        }
        if(isset($colTopLeft) && isset($natureTopLeft))
        {
            $nature[$natureTopLeft] = $nature[$natureTopLeft] + 10;
        }
        if(isset($colTopLeft1_1) && isset($natureTopLeft1_1))
        {
            $nature[$natureTopLeft1_1] = $nature[$natureTopLeft1_1] + 10;
        }
        if(isset($colTopLeft1_2) && isset($natureTopLeft1_2))
        {
            $nature[$natureTopLeft1_2] = $nature[$natureTopLeft1_2] + 10;
        }
        if(isset($colTopLeft2_1) && isset($natureTopLeft2_1))
        {
            $nature[$natureTopLeft2_1] = $nature[$natureTopLeft2_1] + 10;
        }            
        if(isset($colTop2) && isset($natureTop2)) {
            $nature[$natureTop2] = $nature[$natureTop2] + 10;
        }
        if(isset($colTop3) && isset($natureTop3)) {
            $nature[$natureTop3] = $nature[$natureTop3] + 10;
        }

        if(isset($naturePrev)) {
            switch($naturePrev) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] += 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($naturePrev2)) {
            switch($naturePrev2) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($naturePrev3)) {
            switch($naturePrev3) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTop)) {
            switch($natureTop) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTop2)) {
            switch($natureTop2) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTop3)) {
            switch($natureTop3) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTopLeft)) {
            switch($natureTopLeft) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTopLeft2_1)) {
            switch($natureTopLeft2_1) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTopLeft1_1)) {
            switch($natureTopLeft1_1) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }
        if(isset($natureTopLeft1_2)) {
            switch($natureTopLeft1_2) {
                case 0: // Roche
                    $nature[0] += 0;
                    $nature[1] -= 4;
                    $nature[2] += 2;
                    $nature[3] += 2;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 1: // Sable
                    $nature[0] -= 5;
                    $nature[1] += 5;
                    $nature[2] -= 4;
                    $nature[3] -= 4;
                    $nature[4] += 2;
                    $nature[5] += 4;
                    break;
                case 2: // Minerai
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 0;
                    $nature[3] += 5;
                    $nature[4] += 2;
                    $nature[5] -= 1;
                    break;
                case 3: // Fer
                    $nature[0] += 1;
                    $nature[1] -= 5;
                    $nature[2] += 2;
                    $nature[3] += 0;
                    $nature[4] += 1;
                    $nature[5] += 1;
                    break;
                case 4: // Glace
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 2;
                    $nature[3] -= 2;
                    $nature[4] += 0;
                    $nature[5] += 5;
                    break;
                case 5: // Autre
                    $nature[0] += 0;
                    $nature[1] += 2;
                    $nature[2] += 5;
                    $nature[3] += 5;
                    $nature[4] += 5;
                    $nature[5] += 0;
                    break;
            }
        }        
            /*if($naturePrev == 0) {
            $nature[0] += 5;
            $nature[1] -= 2;
            $nature[2] += 2;
            $nature[3] += 2;
            $nature[4] += 1;
            $nature[5] += 1;
            } 
        }
        if($naturePrev3 == 0 && $naturePrev2 == 0 && $naturePrev == 0 && $natureTop == 0 && $natureTopLeft == 0 && $natureTopLeft1_1 == 0 && $natureTopLeft2_1 ==0 && $natureTopLeft1_2 == 0) {
            $nature[0] += 20;
            $nature[1] -= 5;
            $nature[2] += 15;
            $nature[3] += 15;
            $nature[4] += 5;
            $nature[5] += 5;
        }*/



        // on agrège le tout
       for($k=0;$k<=5;$k++)
        {
            //par nature
            $natureTemp[$k] = $natureTemp[$k] + $nature[$k];

            // on fait le total pour le jet de dés
            $totalTemp = $totalTemp + $natureTemp[$k];

        }


        // Définir la fonction rand() entre 0 et $totalTemp
        $jet = rand(0, $totalTemp);


        // fait un tri du résultat pout trouver la bonne nature
        for($l=0; $l<=5; $l++)
        {
           if ($jet >= $compteur && $jet <= ($compteur + $nature[$l]))
           {
               $inatureCellule = $l; // on affecte à la cellule actuelle la nature tirée au dé
           }

           $compteur = $compteur + $nature[$l];
        }


       return $inatureCellule;
    }

    /**
     * Attribut de la cellule courante
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function current($iLine, $iColumn)
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
            return self::$_aMatrice['map'][$iLine][$iColumn-1];
    }

    /**
     * Nature Cellule précédente précèdente
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @param integer $nature
     * @return null|array
     */
    public function prev_nature( $iLine, $iColumn)
    {
        if( $iColumn > 0 )
            return self::$_aMatrice['map'][$iLine][$iColumn-1]['type'];
    }

    /**
     * Nature Cellule sur la ligne précèdente
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @param integer $nature
     * @return null|array
     */
    public function top_nature_colonne($iLine, $iColumn)
    {
        if( $iLine > 0 )
            return self::$_aMatrice['map'][$iLine - 1][$iColumn]['type'];
    }

    /**
     * Nature Cellule sur la ligne précèdente
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @param integer $nature
     * @return null|array
     */
    public function topleft_nature_colonne($iLine, $iColumn)
    {
        if( $iLine > 0 && $iColumn > 0)
            return self::$_aMatrice['map'][$iLine - 1][$iColumn - 1]['type'];
    }

    /**
     * Nature Cellule sur la ligne précèdente
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @param integer $nature
     * @return null|array
     */
    public function topright_nature_colonne($iLine, $iColumn)
    {
        if( $iLine > 0 && $iLine < self::$_iAxeY && $iColumn < self::$_iAxeX - 1)
            return self::$_aMatrice['map'][$iLine - 1][$iColumn + 1]['type'];
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
        if( $iColumn < (self::$_iAxeY - 1))
            return self::$_aMatrice['map'][$iLine][$iColumn+1];
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
            return self::$_aMatrice['map'][$iLine-1][$iColumn-1];
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
        if ( $iColumn < (self::$_iAxeY - 1) &&  $iLine > 0)
            return self::$_aMatrice['map'][$iLine-1][$iColumn+1];
    }

    /**
     * Cellule adjacente haut
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return null|array
     */
    public function top( $iLine, $iColumn)
    {
        if ( $iColumn < (self::$_iAxeY - 1) &&  $iLine > 0)
            return self::$_aMatrice['map'][$iLine-1][$iColumn];
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
        if( $iLine < self::$_iAxeY - 1 && $iColumn > 0)
            return self::$_aMatrice['map'][$iLine+1][$iColumn-1];
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
        if( $iLine < self::$_iAxeX - 1 && $iColumn < $this->_iAxeY - 1)
            return self::$_aMatrice['map'][$iLine+1][$iColumn+1];
    }
}
