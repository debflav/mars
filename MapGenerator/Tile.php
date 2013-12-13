<?php

/*
*
*	Classe qui gère une case, notamment sa nature
*
*/

namespace MapGenerator;

class Tile {

	private $x;
	private $y;
	private $naturesTile = array(); 

	public function __construct(Block $block) {
		$this->naturesTile = $block->getNatures();
	}

	 public function Algo($i, $j)
    { 
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
                    $this->$natureTile[$naturePrev3] = $this->$natureTile[$naturePrev3] + 10;

                }

                $this->$natureTile[$naturePrev2] = $this->$natureTile[$naturePrev2] + 10;
            }

            $this->$natureTile[$naturePrev] = $this->$natureTile[$naturePrev] + 10;
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
                $this->$natureTile[$natureTop] = $this->$natureTile[$natureTop] + 10;
        }
        if(isset($colTopLeft) && isset($natureTopLeft))
        {
            $this->$natureTile[$natureTopLeft] = $this->$natureTile[$natureTopLeft] + 10;
        }
        if(isset($colTopLeft1_1) && isset($natureTopLeft1_1))
        {
            $this->$natureTile[$natureTopLeft1_1] = $this->$natureTile[$natureTopLeft1_1] + 10;
        }
        if(isset($colTopLeft1_2) && isset($natureTopLeft1_2))
        {
            $this->$natureTile[$natureTopLeft1_2] = $this->$natureTile[$natureTopLeft1_2] + 10;
        }
        if(isset($colTopLeft2_1) && isset($natureTopLeft2_1))
        {
            $this->$natureTile[$natureTopLeft2_1] = $this->$natureTile[$natureTopLeft2_1] + 10;
        }            
        if(isset($colTop2) && isset($natureTop2)) {
            $this->$natureTile[$natureTop2] = $this->$natureTile[$natureTop2] + 10;
        }
        if(isset($colTop3) && isset($natureTop3)) {
            $this->$natureTile[$natureTop3] = $this->$natureTile[$natureTop3] + 10;
        }


          // on agrège le tout
       for($k=0;$k<=5;$k++)
        {
            //par nature
            $natureTemp[$k] = $natureTemp[$k] + $this->$natureTile[$k];

            // on fait le total pour le jet de dés
            $totalTemp = $totalTemp + $natureTemp[$k];

        }


        // Définir la fonction rand() entre 0 et $totalTemp
        $jet = rand(0, $totalTemp);


        // fait un tri du résultat pout trouver la bonne nature
        for($l=0; $l<=5; $l++)
        {
           if ($jet >= $compteur && $jet <= ($compteur + $this->$natureTile[$l]))
           {
               $inatureCellule = $l; // on affecte à la cellule actuelle la nature tirée au dé
           }

           $compteur = $compteur + $this->$natureTile[$l];
        }


       return $inatureCellule;
    }

    public function adjustNature($natureTile)
    {
    	if(isset($natureTile)) {
            switch($natureTile) {
                case 0: // Roche
                    $this->$natureTile[0] += 0;
                    $this->$natureTile[1] -= 4;
                    $this->$natureTile[2] += 2;
                    $this->$natureTile[3] += 2;
                    $this->$natureTile[4] += 1;
                    $this->$natureTile[5] += 1;
                    break;
                case 1: // Sable
                    $this->$natureTile[0] -= 5;
                    $this->$natureTile[1] += 5;
                    $this->$natureTile[2] -= 4;
                    $this->$natureTile[3] -= 4;
                    $this->$natureTile[4] += 2;
                    $this->$natureTile[5] += 4;
                    break;
                case 2: // Minerai
                    $this->$natureTile[0] += 1;
                    $this->$natureTile[1] -= 5;
                    $this->$natureTile[2] += 0;
                    $this->$natureTile[3] += 5;
                    $this->$natureTile[4] += 2;
                    $this->$natureTile[5] += 1;
                    break;
                case 3: // Fer
                    $this->$natureTile[0] += 1;
                    $this->$natureTile[1] -= 5;
                    $this->$natureTile[2] += 2;
                    $this->$natureTile[3] += 0;
                    $this->$natureTile[4] += 1;
                    $this->$natureTile[5] += 1;
                    break;
                case 4: // Glace
                    $this->$natureTile[0] += 0;
                    $this->$natureTile[1] += 2;
                    $this->$natureTile[2] += 2;
                    $this->$natureTile[3] -= 2;
                    $this->$natureTile[4] += 0;
                    $this->$natureTile[5] += 5;
                    break;
                case 5: // Autre
                    $this->$natureTile[0] += 0;
                    $this->$natureTile[1] += 2;
                    $this->$natureTile[2] += 5;
                    $this->$natureTile[3] += 5;
                    $this->$natureTile[4] += 5;
                    $this->$natureTile[5] += 0;
                    break;
            }
        }
        return
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