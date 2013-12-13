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
	private $natures = array(); 

	// Lors de la création d'une case, on lui passe les probablités de base du block (differentes en fonction du type de block), ainsi que les coordonnées de la case
	public function __construct(Block $block, $x, $y) {
		$this->natures = $block->getNatures();
		$this->x = $x;
		$this->y = $y;
	}

}