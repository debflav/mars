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
        $this->_aMap  = $_aMap;
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

        $natureTemp = array_fill(0, 6, 0); // tableau de 6 cases vides

        $typeNature = 0; // basée par défaut sur la roche

        $totalTemp = 0; // variable d'agrégation qui va servir à redéfinir le maximum pour le jet de dé

        $compteur = 0; // variable qui va permettre de définir

        // pourcentage des natures globales de la carte
        // roche, sable, minerai, fer, glace, autre
        $this->_aGlobalAttributes = array(55, 29, 5, 5, 5, 3);


        //On va chercher les natures sur la ligne
        if( $this->prev()) {

            if( $this->prev(2)) {

                if( $this->prev(3)) {

                    $natureTemp[0] = 5;
                }

                $natureTemp[1] = 10;
            }

            $natureTemp[2] = 15;
        }

        //on va chercher les natures sur la colonne
        if( $this->top()) {

            if( $this->top(2)) {

                if( $this->top(3)) {

                    $natureTemp[3] = 5;
                }

                $natureTemp[4] = 10;
            }

            $natureTemp[5] = 15;
        }

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
     * @return bool
     */
    public function prev( $iLine = 1)
    {
        if( isset($this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]-$iLine]) ) {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Cellule adjacente suivante
     *
     * @return bool
     */
    public function next( $iLine = 1)
    {
        if( isset($this->_aMap[$this->_aCellPos[0]][$this->_aCellPos[1]+$iLine])) {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Cellule adjacente en haut
     *
     * @return bool
     */
    public function top( $iColumn = 1)
    {
        if( isset($this->_aMap[$this->_aCellPos[0]-$iColumn][$this->_aCellPos[1]])) {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Cellule adjacente haut gauche
     *
     * @return bool
     */
    public function topLeft( $iColumn = 1, $iLine = 1)
    {
       if( isset($this->_aMap[$this->_aCellPos[0]-$iColumn][$this->_aCellPos[1]-$iLine])) {
           return TRUE;
       }
       return FALSE;
    }


    /**
     * Cellule adjacente haut droite
     *
     * @return bool
     */
    public function topRight( $iColumn = 1, $iLine = 1)
    {
        if ( isset($this->_aMap[$this->_aCellPos[0]-$iColumn][$this->_aCellPos[1]+$iLine])) {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Cellule adjacente bas
     *
     * @return bool
     */
    public function bottom( $iColumn = 1)
    {
        if( isset($this->_aMap[$this->_aCellPos[0]+$iColumn][$this->_aCellPos[1]])) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Cellule adjacente en bas à gauche
     *
     * @return bool
     */
    public function bottomLeft( $iColumn = 1, $iLine = 1)
    {
        if( isset($this->_aMap[$this->_aCellPos[0]+$iColumn][$this->_aCellPos[1]-$iLine])) {
            return TRUE;
        }
        return FALSE;
    }


    /**
     * Cellule adjacente en bas à droite
     *
     * @return bool
     */
   public function bottomRight( $iColumn = 1, $iLine = 1)
    {
        if( isset($this->_aMap[$this->_aCellPos[0]+$iColumn][$this->_aCellPos[1]+$iLine])) {
            return TRUE;
        }
        return FALSE;
    }

}
