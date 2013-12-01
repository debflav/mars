<?php

namespace MapGenerator;

/**
 * Génère une cellule de la map:
 * Son elevation, le type de case.
 */
class CellDrawing implements CellDrawingInterface
{
    
    /**
     * La map
     *
     * @var array
     */
    private $_aMap = array();

    
    /**
     * Taille axe des X
     * 
     * @var int
     */
    private $_iAxeX;


    /**
     * Taille axe des Y
     * 
     * @var int
     */
    private $_iAxeY;
    
    
    /**
     * Attributs de la map(%roche, % glace...)
     * @var array
     */
    private $_aGlobalAttributes = array();
    
    
    /**
     * Contient toutes les informations sur notre cellule courante.
     *
     * @var array
     */
    private $_aCell = array();


    /**
     * Position de la cellule courante
     *
     * @var array
     */
    private $_aCellPos = array();
    
    
    /**
     * @param array $_aMap
     * @param array $_aGlobalAttributes
     */
    public function __construct($_aMap, $_aGlobalAttributes) {
        $this->_aMap  = $_aMap['map'];
        $this->_iAxeX = $_aMap['size']['x'];
        $this->_iAxeY = $_aMap['size']['y'];
        $this->_aGlobalAttributes = $_aGlobalAttributes;
    }


    /**
     * Dessine une cellule.
     *
     * @param integer $iLine
     * @param integer $iColumn
     * @return array
     */
    public function drawCell( $iLine, $iColumn, $aCellValue)
    {
        $this->_aCellPos = array( $iLine, $iColumn);

        // Si aucune valeur on crée notre tableau pour la première fois,
        // sinon on lisse nos premières valeurs obtenues.
        if( empty( $aCellValue)) {
            $this->_aCell["z"] = $this->elevationField( );
            $this->_aCell["type"] = $this->defineCellType( );
        } else {
            $this->_aCell["type"] = $this->defineCellType( );
        }

        return $this->_aCell;
    }

    /**
     * Définit la nature de la cellule.
     *
     * @return string
     */
    private function defineCellType( )
    {

        $natureTemp = array(0,0,0,0,0,0); // tableau de 6 cases vides

        $typeNature = 0; // basée par défaut sur la roche

        $natureCellule = array(); // tableau de la taille de la map comportant
        //la nature de chaque cellule remplie au fur et à mesure de la génération.

        $totalTemp = 0; // variable d'agrégation qui va servir à redéfinir le maximum pour le jet de dé

        $compteur = 0; // variable qui va permettre de définir

        // pourcentage des natures globales de la carte
        // roche, sable, minerai, fer, glace, autre
        $this->_aGlobalAttributes = array(55, 29, 5, 5, 3, 3);


        //On va chercher les natures sur la ligne
        /*if(isset($this->_aMap[$this->_aCellPos[0]-1][$this->_aCellPos[1]])) {

            if(isset($this->_aMap[$this->_aCellPos[0]-2][$this->_aCellPos[1]])) {

                if(isset($this->_aMap[$this->_aCellPos[0]-3][$this->_aCellPos[1]])) {

                    $natureTemp[$natureCellule[$this->_aCellPos[0]-3][$this->_aCellPos[1]]] + 5;
                }

                $natureTemp[$natureCellule[$this->_aCellPos[0]-2][$this->_aCellPos[1]]] + 10;
            }

            $natureTemp[$natureCellule[$this->_aCellPos[0]-1][$this->_aCellPos[1]]] + 15;
        }

        //on va chercher les natures sur la colonne
        if(isset($this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]-1])) {

            if(isset($this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]-2])) {

                if(isset($this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]-3])) {

                    $natureTemp[$natureCellule[$this->_aCellPos[0]][$this->_aCellPos[1]-3]] + 5;
                }

                $natureTemp[$natureCellule[$this->_aCellPos[0]][$this->_aCellPos[1]-2]] + 10;
            }

            $natureTemp[$natureCellule[$this->_aCellPos[0]][$this->_aCellPos[1]-1]] + 15;
        }*/

        // on agrège le tout
        for($k=0;$k<6;$k++)
        {
            //par nature
            $natureTemp[$k] = $natureTemp[$k] + $this->_aGlobalAttributes[$k];

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

    
    /**
     * Définit l'élevation du terrain (z)
     *
     * @return string
     */
    private function elevationField()
    {
        $sElevation = rand(-100, 100);

        return $sElevation;
    }
    
    
    /**
     * Attribut de la cellule courante
     *
     * @return null|array
     */
    public function current( )
    {
        return $this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]];
    }


    /**
     * Cellule adjacente précèdente
     *
     * @return null|array
     */
    public function prev( )
    {
        if( $this->_aCellPos[1] > 0 ) {
            return $this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]-1];
        }
        return NULL;
    }


    /**
     * Cellule adjacente suivante
     *
     * @return null|array
     */
    public function next( )
    {
        if( $this->_aCellPos[1] < ($this->_iAxeY - 1)) {
            return $this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]+1];
        }
        return NULL;
    }
     
     
    /**
     * Cellule adjacente en haut
     *
     * @return null|array
     */
    public function top( )
    {
        if( $this->_aCellPos[0] > 0) {
            return $this->_aMap[$this->_aCellPos[0]-1][$this->_aCellPos[1]];
        }
        return NULL;
    }


    /**
     * Cellule adjacente haut gauche
     *
     * @return null|array
     */
    public function topLeft( )
    {
       if( $this->_aCellPos[0] > 0 && $this->_aCellPos[1] > 0) {
           return $this->_aMap[$this->_aCellPos[0]-1][$this->_aCellPos[1]-1];
       }
       return NULL;
    }


    /**
     * Cellule adjacente haut droite
     *
     * @return null|array
     */
    public function topRight( )
    {
        if ( $this->_aCellPos[1] < ($this->_iAxeY - 1) &&  $this->_aCellPos[0] > 0) {
            return $this->_aMap[$this->_aCellPos[0]-1][$this->_aCellPos[1]+1];
        }
        return NULL;
    }


    /**
     * Cellule adjacente bas
     *
     * @return null|array
     */
    public function bottom( )
    {
        if( $this->_aCellPos[0] > $this->_iAxeY) {
            return $this->_aMap[$this->_aCellPos[0]+1][$this->_aCellPos[1]];
        }
        return NULL;
    }

    /**
     * Cellule adjacente en bas à gauche
     *
     * @return null|array
     */
    public function bottomLeft( )
    {
        if( $this->_aCellPos[0] < $this->_iAxeY - 1 && $this->_aCellPos[1] > 0) {
            return $this->_aMap[$this->_aCellPos[0]+1][$this->_aCellPos[1]-1];
        }
        return NULL;
    }


    /**
     * Cellule adjacente en bas à droite
     *
     * @return null|array
     */
   public function bottomRight( )
    {
        if( $this->_aCellPos[0] < $this->_iAxeX - 1 && $this->_aCellPos[1] < $this->_iAxeY - 1) {
            return $this->_aMap[$this->_aCellPos[0]+1][$this->_aCellPos[1]+1];
        }
        return NULL;
    }

}
