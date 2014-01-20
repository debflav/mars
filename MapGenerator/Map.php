<?php

namespace MapGenerator;


use MapGenerator\CellDrawing;
use MapGenerator\Singleton;
use MapGenerator\fonction;
use MapGenerator\Block;
use MapGenerator\Blocks\Ice;
use MapGenerator\Blocks\Iron;
use MapGenerator\Blocks\Ore;
use MapGenerator\Blocks\Other;
use MapGenerator\Blocks\Rock;
use MapGenerator\Blocks\Sand;

/**
 * Generation de notre object map retourné au javascript.
 */
class Map implements MapInterface
{

    /**
     * La map
     *
     * @var array
     */
    private $_aMatrice = [];

    /**
     * Nombre de block de la map
     * @var int
     */
    private $_iBlocXY;

    /**
     * Dimension de la map x et y
     *
     * @var int
     */
    private $_iDimension;


    /**
     * Echelle de la map en mètre (default 100)
     * @var int
     */
    private $_iScale = 5;


    use Singleton;

    /**
     * Initialisation des attributs de la map (echelle, taille...).
     * Fonction générale pour la génération de la carte.
     *
     * @param integer $iNbLine
     * @param integer $iNbColumn
     * @param array   $aAttributes
     * @return void
     */
    public function generate($iDimension)
    {

        // // Setters
        // $this->_aGlobalAttributes = $aAttributes;
        // $this->_iDimension        = $iDimension;
        // $this->_aMatrice = array('size' => array( 'x' => $this->_iDimension, 'y' => $this->_iDimension ));

        // // Création de la map vide
        // $this->_aMatrice['map'] = array_fill(0, $this->_iDimension, array_fill(0, $this->_iDimension, NULL));

        // // Remplissage d'une cellule de notre map.

        // foreach ($this->_aMatrice['map'] as $iLine => $aLine) {
        //     foreach($aLine as $iColumn => $aCellValue) {
        //         $oCellInfo = new CellDrawing($this->_aMatrice['map'], $this->_aGlobalAttributes);
        //         $aCell = $oCellInfo->drawCell( $iLine, $iColumn, $aCellValue);
        //         $this->_aMatrice['map'][$iLine][$iColumn] = $aCell;
        //     }
        //     $iLine++;
        // }


        // VARIABLES
        $this->_iBlocXY = 2; // Nombre de blocs en longueur et largeur
        $this->_iDimension = $iDimension; // Nombre de cellule par bloc
        $Bloc = array_fill(0, $this->_iBlocXY, array_fill(0, $this->_iBlocXY, NULL)); // tableau contenant des objets blocs

        // ETAPE 0 :
        // on génère la carte vide à partir des infos
        $this->_aMatrice = $this->emptyMap($this->_iBlocXY * $this->_iDimension);

        // ETAPE 1 :
        // On génère la carte par bloc avec altitude pseudo plane et nature
        for ($i = 0; $i < ($this->_iBlocXY); $i++) {

            for ($j = 0; $j < ($this->_iBlocXY); $j++) { // colonnes de blocs

                // Fonction de génération d'un bloc
                $Bloc[$i][$j] = $this->ChoiceBlock($this->_iDimension);
                $Bloc[$i][$j]->generate();
            }
        }

        // On remplit la carte vide avec les blocs

        for ($i = 0; $i < ($this->_iBlocXY); $i++) { // ligne de blocs

            $g = $i * $this->_iDimension;
            

            for ($j = 0; $j < ($this->_iBlocXY); $j++) { // colonnes de blocs

                $h = $j * $this->_iDimension;

                for ($k = 0; $k < ($this->_iDimension); $k++) { // ligne du bloc

                    for ($l = 0; $l < ($this->_iDimension); $l++) { // colonnes du bloc
 

                        $this->_aMatrice[$g][$h] = $Bloc[$i][$j]->block[$k][$l];

                        $h++;

                    }

                    $g++;
                }
            }
        }
            


        // ETAPE 2 :
        // on dépose sur la carte un certain nombre d'objet

        // on définit le nombre d'objet à poser en fonction du nombre de bloc divisant la carte

        // on pose les objets un à un

    }

    public function ChoiceBlock ($Dimension) {

    // Pondération d'apparition des blocs
    $NatureBlock[0] = 35;
    $NatureBlock[1] = 35;
    $NatureBlock[2] = 5;
    $NatureBlock[3] = 9;
    $NatureBlock[4] = 15;
    $NatureBlock[5] = 1;

    // Définir la fonction rand() entre 0 et 100
      $jet = rand(1, 100);


      // fait un tri du résultat pout trouver la bonne nature
      
        switch ($jet)
        {
            case($jet <= $NatureBlock[0]) :
                return new Rock($Dimension); // on affecte au bloc la nature tirée au dé
                break;
            case($jet <= $NatureBlock[0] + $NatureBlock[1]) : 
                return new Sand($Dimension);
                break;
            case($jet <= $NatureBlock[0] + $NatureBlock[1] + $NatureBlock[2]) :
                return new Iron($Dimension);
                break;
            case($jet <= $NatureBlock[0] + $NatureBlock[1] + $NatureBlock[2] + $NatureBlock[3]) :
                return new Ore($Dimension);
                break;
            case($jet <= $NatureBlock[0] + $NatureBlock[1] + $NatureBlock[2] + $NatureBlock[3] + $NatureBlock[4]) :
                return new Ice($Dimension);
                break;
            case($jet <= $NatureBlock[0] + $NatureBlock[1] + $NatureBlock[2] + $NatureBlock[3] + $NatureBlock[4] + $NatureBlock[5]) :
                return new Iron($Dimension);
                break;
        }
    }

    public function emptyMap ($Dimension) {

      $MatriceVide = array_fill(0, $Dimension, array_fill(0, $Dimension, NULL));

      return $MatriceVide;
    }

    /**
     * Retourne la carte sous forme de tableau
     *
     * @return array
     */
    public function getMap()
    {
        return $this->_aMatrice;
    }


    /**
     * Encode et retourne la carte au format Json
     *
     * @return string JSON
     */
    public function mapToJson()
    {
        return json_encode( $this->_aMatrice);
    }


    /**
     * ##TODO
     * Prend un Json en paramètre
     *
     * @return string JSON
     */
    public function generateMapFromJson( $sJson)
    {
        // Utilisé lors de l'envoi d'un fichier.
        // test du format json...(extension...)

    }

}