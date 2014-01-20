<?php

/*
*
*	Classe qui gère une case, notamment sa nature
*
*/

namespace MapGenerator;

use MapGenerator\Block;

class Tile {

	private $x;
	private $y;
	private $blockLength; // Taille du bloc courant
	private $naturesTile = array();
	private $matriceBlock = array();	// Matrice du bloc courant

	// Lors de la création d'une case, on lui passe les probablités de base du block (differentes en fonction du type de block), ainsi que les coordonnées de la case
	public function __construct($matrice, $naturesTile, $blockLength, $x, $y) {
		$this->naturesTile = $naturesTile;
		$this->matriceBlock = $matrice;
		$this->x = $x;
		$this->y = $y;
	}

	public function Generate()
    { 
        $natureTemp = [null, null, null, null, null, null]; // tableau de 5 cases vides
        $naturePrev = [];
        //aCurrent_Map = $this->block;
        $inatureCellule = 0; // tableau de la taille de la map comportant
        //la nature de chaque cellule remplie au fur et à mesure de la génération.

        $totalTemp = 0; // variable d'agrégation qui va servir à redéfinir le maximum pour le jet de dé

        $compteur = 0; // variable qui va permettre de définir




        // On récupère les cellules précédente
        $cellPrev = $this->prev($this->x, $this->y);
        $naturePrev = $this->prev_nature($this->x, $this->y);
        $cellPrev2 = $this->prev($this->x, $this->y - 1);
        $naturePrev2 = $this->prev_nature($this->x, $this->y - 1);
        $cellPrev3 = $this->prev($this->x, $this->y - 2);
        $naturePrev3 = $this->prev_nature($this->x, $this->y - 2);


        //On va chercher les natures sur la ligne
        if(isset($cellPrev) && isset($naturePrev)) {
            if(isset($cellPrev2) && isset($naturePrev2)) {
                if(isset($cellPrev3) && isset($naturePrev3)) {
                    $this->naturesTile[$naturePrev3] = $this->naturesTile[$naturePrev3] + 10;

                }

                $this->naturesTile[$naturePrev2] = $this->naturesTile[$naturePrev2] + 10;
            }

            $this->naturesTile[$naturePrev] = $this->naturesTile[$naturePrev] + 10;
        }

        $colTop = $this->top($this->x, $this->y);
        $natureTop = $this->top_nature_colonne($this->x, $this->y);

        $colTop2 = $this->top($this->x -1, $this->y);
        $natureTop2 = $this->top_nature_colonne($i-1, $this->y);

        $colTop3 = $this->top($this->x - 2, $this->y);
        $natureTop3 = $this->top_nature_colonne($i-2, $this->y);

        $colTopLeft = $this->topLeft($this->x, $this->y);
        $colTopLeft1_1 = $this->topLeft($this->x, $this->y - 1);
        $colTopLeft2_1 = $this->topLeft($this->x - 1, $this->y - 1);
        $colTopLeft1_2 = $this->topLeft($this->x - 1, $this->y);

        if($this->x > 0 && $this->y < $blockLength)
        {
           $natureTopLeft = $this->topleft_nature_colonne($this->x, $this->y);
           $natureTopLeft1_1 = $this->topleft_nature_colonne($this->x, $this->y-1);
           $natureTopLeft2_1 = $this->topleft_nature_colonne($this->x - 1, $this->y-1);
           $natureTopLeft1_2 = $this->topleft_nature_colonne($this->x - 1, $this->y);
        }

        
        //on va chercher les natures sur la colonne
        if(isset($colTop) && isset($natureTop)) {
                $this->naturesTile[$natureTop] = $this->naturesTile[$natureTop] + 10;
        }
        if(isset($colTopLeft) && isset($natureTopLeft))
        {
            $this->naturesTile[$natureTopLeft] = $this->naturesTile[$natureTopLeft] + 10;
        }
        if(isset($colTopLeft1_1) && isset($natureTopLeft1_1))
        {
            $this->naturesTile[$natureTopLeft1_1] = $this->naturesTile[$natureTopLeft1_1] + 10;
        }
        if(isset($colTopLeft1_2) && isset($natureTopLeft1_2))
        {
            $this->naturesTile[$natureTopLeft1_2] = $this->naturesTile[$natureTopLeft1_2] + 10;
        }
        if(isset($colTopLeft2_1) && isset($natureTopLeft2_1))
        {
            $this->naturesTile[$natureTopLeft2_1] = $this->naturesTile[$natureTopLeft2_1] + 10;
        }            
        if(isset($colTop2) && isset($natureTop2)) {
            $this->naturesTile[$natureTop2] = $this->naturesTile[$natureTop2] + 10;
        }
        if(isset($colTop3) && isset($natureTop3)) {
            $this->naturesTile[$natureTop3] = $this->naturesTile[$natureTop3] + 10;
        }


          // on agrège le tout
       for($k=0;$k<=5;$k++)
        {
            //par nature
            $natureTemp[$k] = $natureTemp[$k] + $this->naturesTile[$k];

            // on fait le total pour le jet de dés
            $totalTemp = $totalTemp + $natureTemp[$k];

        }


        // Définir la fonction rand() entre 0 et $totalTemp
        $this->yet = rand(0, $totalTemp);


        // fait un tri du résultat pout trouver la bonne nature
        for($l=0; $l<=5; $l++)
        {
           if ($this->yet >= $compteur && $this->yet <= ($compteur + $this->naturesTile[$l]))
           {
               $inatureCellule = $l; // on affecte à la cellule actuelle la nature tirée au dé
           }

           $compteur = $compteur + $this->naturesTile[$l];
        }


       return $inatureCellule;
    }

    public function adjustNature($natureTile)
    {
    	if(isset($natureTile)) {
            switch($natureTile) {
                case 0: // Roche
                    $this->naturesTile[0] += 0;
                    $this->naturesTile[1] -= 4;
                    $this->naturesTile[2] += 2;
                    $this->naturesTile[3] += 2;
                    $this->naturesTile[4] += 1;
                    $this->naturesTile[5] += 1;
                    break;
                case 1: // Sable
                    $this->naturesTile[0] -= 5;
                    $this->naturesTile[1] += 5;
                    $this->naturesTile[2] -= 4;
                    $this->naturesTile[3] -= 4;
                    $this->naturesTile[4] += 2;
                    $this->naturesTile[5] += 4;
                    break;
                case 2: // Minerai
                    $this->naturesTile[0] += 1;
                    $this->naturesTile[1] -= 5;
                    $this->naturesTile[2] += 0;
                    $this->naturesTile[3] += 5;
                    $this->naturesTile[4] += 2;
                    $this->naturesTile[5] += 1;
                    break;
                case 3: // Fer
                    $this->naturesTile[0] += 1;
                    $this->naturesTile[1] -= 5;
                    $this->naturesTile[2] += 2;
                    $this->naturesTile[3] += 0;
                    $this->naturesTile[4] += 1;
                    $this->naturesTile[5] += 1;
                    break;
                case 4: // Glace
                    $this->naturesTile[0] += 0;
                    $this->naturesTile[1] += 2;
                    $this->naturesTile[2] += 2;
                    $this->naturesTile[3] -= 2;
                    $this->naturesTile[4] += 0;
                    $this->naturesTile[5] += 5;
                    break;
                case 5: // Autre
                    $this->naturesTile[0] += 0;
                    $this->naturesTile[1] += 2;
                    $this->naturesTile[2] += 5;
                    $this->naturesTile[3] += 5;
                    $this->naturesTile[4] += 5;
                    $this->naturesTile[5] += 0;
                    break;
            }
        }
        return;
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
        return $this->block[$iLine][$iColumn];
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
            return $this->block[$iLine][$iColumn-1];
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
            return $this->block[$iLine][$iColumn-1]['type'];
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
            return $this->block[$iLine - 1][$iColumn]['type'];
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
            return $this->block[$iLine - 1][$iColumn - 1]['type'];
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
        if( $iLine > 0 && $iLine < $blockLength && $iColumn < $blockLength - 1)
            return $this->block[$iLine - 1][$iColumn + 1]['type'];
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
        if( $iColumn < ($blockLength - 1))
            return $this->block[$iLine][$iColumn+1];
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
            return $this->block[$iLine-1][$iColumn-1];
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
        if ( $iColumn < ($blockLength - 1) &&  $iLine > 0)
            return $this->block[$iLine-1][$iColumn+1];
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
        if ( $iColumn < ($blockLength - 1) &&  $iLine > 0)
            return $this->block[$iLine-1][$iColumn];
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
        if( $iLine < $blockLength - 1 && $iColumn > 0)
            return $this->block[$iLine+1][$iColumn-1];
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
        if( $iLine < $blockLength - 1 && $iColumn < $this->_iAxeY - 1)
            return $this->block[$iLine+1][$iColumn+1];
    }
}