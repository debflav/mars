<?php

namespace MapGenerator;

/**
 *
 * Genere une cellule de la map:
 * ses attributs...
 * Algo de l'élévation du terrain, la roche...
 *
 */
class MapElement extends Map
{

    /**
     * Tous les attributs(% roche, % glace... ##TODO)
     *
     * @var array
     */
    protected $aAttributes;

    /**
     * Une cellule
     *
     * @var array
     */
    private $_aCell = array();

    /**
     * 'Dessine' une cellule
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function drawCell( $iLine, $iColumn)
    {
        // Cell cordonnate
        $this->_aCell[0] = $iLine . '-' . $iColumn;

        // Algo TODO;
        // $this->_aCell[1] = "{".$this->elevation()."}";
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
        return $this->_aCell;
    }

    /**
     * Algo z index
     *
     * @return string
     */
    public function elevation()
    {
        $sElevation = rand(0, 100);
        $aCoordinates = explode('-', $this->_aCell[0]);
        // Avec les coordonnées de la case on peut regarder autour pour la gestion des probas
        // ##TODO
        //var_dump($this->prev($aCoordinates[0], $aCoordinates[1]));
        return $sElevation;
    }


}
