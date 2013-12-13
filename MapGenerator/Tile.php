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
	private $natures = array(); 

	public function __construct(Block $block) {
		$this->natures = $block->getNatures();
	}

}