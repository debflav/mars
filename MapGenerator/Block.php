<?php
namespace MapGenerator\Block;

use MapGenerator\CellDrawing;
use MapGenerator\Element\Element;

abstract class Block 
{

	private $blockLength;
	private $block = array(); //Matrice du block

	public function __construct($blockLength) //On définie la taille du block lors de l'instanciation de celui ci
	{	
		$this->blockLength = $blockLength;
	}

	public function setBlockLength($value) 
	{
		$this->blockLength = $value;
	}

	public function getBlockLength() 
	{
		return $this->blockLength;
	}

	public function generate() //$blockLength correspond au nombre de cases qui composent un bloc
	{ 	
		for($i = 0; $i < $this->blockLength; $i++) {
			for ($j=0; $j < $this->blockLength; $j++) {
				$this->block[$i][$j] = Algo($i, $j);
				$this->block[$i][$j] = elevationField();
			}
		}
	}

	// public function setNatures($index, $value) {
	// 	if($index >= 0 && $index <= 6) {
	// 		$this->natures[$index] = (int) $value;
	// 	}
	// }

	public function setNatures($rock, $sand, $iron, $ice, $ore, $other) 
	{
		$this->natures[ROCK] = (int) $rock;
		$this->natures[SAND] = (int) $sand;
		$this->natures[IRON] = (int) $iron;
		$this->natures[ICE] = (int) $ice;
		$this->natures[ORE] = (int) $ore;
		$this->natures[OTHER] = (int) $other;
	}

	public function getNatures() 
	{
		return $this->natures;
	}

}