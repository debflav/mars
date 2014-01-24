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
use MapGenerator\Patterns\LittlePlate;

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
     * Nombre de bloc en largeur et en longueur de la map
     * @var int
     */
    private $_iBlocXY;

    /**
     * Nombre de cellule en largeur et en longueur dans le bloc
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
        // VARIABLES
        $this->_iBlocXY = 20; // Nombre de blocs en longueur et largeur
        $this->_iDimension = $iDimension; // Nombre de cellule par bloc
        $TabBloc = array_fill(0, $this->_iBlocXY, array_fill(0, $this->_iBlocXY, NULL)); // tableau contenant des objets blocs

        // ETAPE 0 :
        // on génère la carte vide à partir des infos
        $this->_aMatrice = $this->emptyMap($this->_iBlocXY * $this->_iDimension);

        // ETAPE 1 :
        // On génère la carte par bloc avec altitude pseudo plane et nature
        for ($i = 0; $i < ($this->_iBlocXY); $i++) {

            for ($j = 0; $j < ($this->_iBlocXY); $j++) { // colonnes de blocs

                // Fonction de génération d'un bloc
                $TabBloc[$i][$j] = $this->ChoiceBlock($this->_iDimension);
                $TabBloc[$i][$j]->generate();
            }
        }

        // On remplit la carte vide avec les blocs

        // variables pour la boucle
        $ligneBloc = 0; // sert à se déplacer d'une ligne de bloc à l'autre, est remise à zéro une fois égale à $this->_iBlocXY
        $colonneBloc = 0; // sert à se déplacer d'une colonne de bloc à l'autre, est remise à zéro une fois égale à $this->_iBlocXY

        $ligneCelluleBloc = 0; // sert à se déplacer de ligne en ligne dans les blocs, est remise à zéro un fois égale à $this->_iDimension
        $colonneCelluleBloc = 0; // sert à se déplacer de colonne en colonne dans les blocs, est remise à zéro un fois égale à $this->_iDimension

        // on se promène dans les lignes de la map (chaque itération descends d'une ligne)
        for ($ligneCelluleMap=0; $ligneCelluleMap < $this->_iBlocXY * $this->_iDimension; $ligneCelluleMap++) { 


            if ($ligneCelluleBloc >= $this->_iDimension) { // si on atteint la dernière ligne du bloc

                $ligneCelluleBloc = 0; // on revient à la ligne 0 du bloc suivant
                $ligneBloc++;
            }


                // on se promène dans les colonnes de la map (chaque itération se déplace d'une colonne)
            for ($colonneCelluleMap=0; $colonneCelluleMap < $this->_iBlocXY * $this->_iDimension; $colonneCelluleMap++) { 
            

                // on incrémente les variables pour la prochaine cellule (les coordonnées de la map sont incrémentées dans les boucles for)

                // gestion des colonnes
                if ($colonneCelluleBloc >= $this->_iDimension) { // si on atteint la dernière colonne du bloc

                    $colonneCelluleBloc = 0; // on revient à la colonne 0 du bloc suivant

                    if ($colonneBloc >= $this->_iBlocXY) { // Si on arrive au bout de la ligne des blocs

                        $colonneBloc = 0; // on remet la ligne des blocs à 0


                        // on assigne les valeurs à la cellule de la map avec le bloc correspondant
                        $this->_aMatrice[$ligneCelluleMap][$colonneCelluleMap] = $TabBloc[$ligneBloc][$colonneBloc]->block[$ligneCelluleBloc][$colonneCelluleBloc];

                        $colonneCelluleBloc++; // on augmente le numéro de la colonne 

                    } else {

                        // sinon on augmente le numéro de la colonne des blocs
                        $colonneBloc++; // on passe à la colonne du bloc suivant 

                        // on assigne les valeurs à la cellule de la map avec le bloc correspondant
                        $this->_aMatrice[$ligneCelluleMap][$colonneCelluleMap] = $TabBloc[$ligneBloc][$colonneBloc]->block[$ligneCelluleBloc][$colonneCelluleBloc];

                        $colonneCelluleBloc++; // on augmente le numéro de la colonne 
                    }

                } else {

                    // on assigne les valeurs à la cellule de la map avec le bloc correspondant
                    $this->_aMatrice[$ligneCelluleMap][$colonneCelluleMap] = $TabBloc[$ligneBloc][$colonneBloc]->block[$ligneCelluleBloc][$colonneCelluleBloc];

                    $colonneCelluleBloc++; // sinon on augmente le numéro de la colonne 
                }
            }

            // on incrémente les variables pour la prochaine cellule (les coordonnées de la map sont incrémentées dans les boucles for)

            // gestion des lignes
            $ligneCelluleBloc++; // sinon on augmente le numéro de la ligne 
                

            $colonneBloc = 0; // on remet la ligne des blocs à 0
            $colonneCelluleBloc = 0; // on revient à la colonne 0 du bloc suivant
        }

        // ETAPE 2 :
        // on créer le calque de la carte (une nouvelle map vide)

        $calque = $this->emptyMap($this->_iBlocXY * $this->_iDimension);

        // on définit le nombre d'objet à poser en fonction du nombre de bloc divisant la carte

        $nombreObjet = 10;
        $object = $this->jetObject();

        // on dépose sur la carte un certain nombre d'objet

        for($compteurObjet = 0; $compteurObjet < $nombreObjet; $compteurObjet++)
        {

          // init du stack
          $stack = 1;

          while ($stack != 0) // tant que toutes les cases visées ne sont pas vides
          {
            $stack = 0;

            // on tire le random
            $startPostion = array();
            $StartX = rand(0, $this->_iBlocXY * $this->_iDimension);
            $StartY = rand(0, $this->_iBlocXY * $this->_iDimension);

            $startPostion[0] = $StartX;
            $startPostion[1] = $StartY;

            $object = $this->jetObject();
            
            // Boucle parcourant le calque pour verifier que l'emplacement est libre
            for ($x = $StartX; $x < ($StartX + $object->getX()); $x++)
            {
              for ($y = $StartY; $y < ($StartY + $object->getY()); $y++)
              {
                 if(empty($calque[$x][$y])) {
                  $stack += 0;
                 } else {
                  $stack += 1;
                 }
              }
            }

          } // fin du while

          $valuesObject = $object->getPattern();
          $objetX = 0;
          $objetY = 0;

          // on copie notre objet dans le calque
          for ($x = $StartX; $x < ($StartX + $object->getX()); $x++)
          {
            $objetY = 0;
            for ($y = $StartY; $y < ($StartY + $object->getY()); $y++)
            {
               $calque[$x][$y] = $valuesObject[$objetX][$objetY];
               $objetY++;
            }
            $objetX++;
          }
        }

        // on pose les objets un à un
        for ($ligneCelluleMap=0; $ligneCelluleMap < $this->_iBlocXY * $this->_iDimension; $ligneCelluleMap++) { 

          for ($colonneCelluleMap=0; $colonneCelluleMap < $this->_iBlocXY * $this->_iDimension; $colonneCelluleMap++) { 

            if(NULL != $calque[$ligneCelluleMap][$colonneCelluleMap])
            {
              $this->_aMatrice[$ligneCelluleMap][$colonneCelluleMap]['z'] = $calque[$ligneCelluleMap][$colonneCelluleMap];
            }
          }
        }
    }

    public function jetObject()
    {
      $jetObject = rand(0, 3);
      switch ($jetObject) {
        case 0:
          return new LittlePlate();
          break;
        
        default:
          return new LittlePlate();
          break;
      }
    }

    public function ChoiceBlock ($Dimension) {

    // Pondération d'apparition des blocs
    $NatureBlock[0] = 40; // Roche
    $NatureBlock[1] = 45; // Sable
    $NatureBlock[2] = 5;  // Fer
    $NatureBlock[3] = 5;   // Minerai
    $NatureBlock[4] = 5;  // Glace
    $NatureBlock[5] = 0; // Autre

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
                return new Other($Dimension);
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
        // on met en forme pour le JSON
        $temp = array('size' => array('x' => $this->_iBlocXY * $this->_iDimension, 'y' => $this->_iBlocXY * $this->_iDimension),
                      'map' => $this->_aMatrice);
        echo json_encode($temp);
    }

}