<?php

namespace MapGenerator;

use MapGenerator\CellDrawing,
    Framework\Singleton;

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
     * Taille axe des X
     * @var int
     */
    private $_iAxeX;


    /**
     * Taille axe des Y
     * @var int
     */
    private $_iAxeY;


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
    public function generate($iNbLine, $iNbColumn, $aAttributes)
    {
        // Setters
        $this->_aGlobalAttributes = $aAttributes;
        $this->_iAxeX             = $iNbLine;
        $this->_iAxeY             = $iNbColumn;
        $this->_aMatrice = array('size' => array( 'x' => $this->_iAxeX, 'y' => $this->_iAxeY ));

        // Création de la map vide
        for ($i = 0; $i < $this->_iAxeX; $i++) {
            for ($j = 0; $j < $this->_iAxeY; $j++) {
                $this->_aMatrice['map'][$i][$j] = NULL;
            }
        }
        
        // Remplissage d'une cellule de notre map.
        foreach ($this->_aMatrice['map'] as $iLine => $aLine) {
            foreach($aLine as $iColumn => $aCellValue) {
                $oCellInfo = new CellDrawing($this->_aMatrice, $this->_aGlobalAttributes);
                $aCell = $oCellInfo->drawCell( $iLine, $iColumn, $aCellValue);
                $this->_aMatrice['map'][$iLine][$iColumn] = $aCell;
            }
            $iLine++;
        }
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