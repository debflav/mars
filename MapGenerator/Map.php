<?php

namespace MapGenerator;

use MapGenerator\CellDrawing,
    MapGenerator\Block,
    MapGenerator\Blocks\Ice,
    MapGenerator\Singleton;

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
     * Attributs de la map(%roche, % glace...)
     * @var array
     */
    private $_aGlobalAttributes = [];

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
    public function generate($iDimension, $aAttributes)
    {
        // var_dump('totototo');
        // Setters
        $this->_aGlobalAttributes = $aAttributes;
        $this->_iDimension        = $iDimension;
        // $this->_aMatrice = array('size' => array( 'x' => $this->_iDimension, 'y' => $this->_iDimension ));

        // Création de la map vide
        // $this->_aMatrice['map'] = array_fill(0, $this->_iDimension, array_fill(0, $this->_iDimension, NULL));

        // Remplissage d'une cellule de notre map.
        // foreach ($this->_aMatrice['map'] as $iLine => $aLine) {
        //     foreach($aLine as $iColumn => $aCellValue) {
        //         $oCellInfo = new CellDrawing($this->_aMatrice['map'], $this->_aGlobalAttributes);
        //         $aCell = $oCellInfo->drawCell( $iLine, $iColumn, $aCellValue);
        //         $this->_aMatrice['map'][$iLine][$iColumn] = $aCell;
        //     }
        //     $iLine++;
        // }

        $ice = new Ice($this->_iDimension);
        $ice->generate();
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