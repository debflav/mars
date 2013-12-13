<?php
namespace MapGenerator\Block;

use MapGenerator\CellDrawing;
use MapGenerator\Element\Element;

abstract class Block 
{

	private $blockLength;

	private $block = array("nature" => null, "z" => null); //Matrice du block


	public function __construct($blockLength) //On définie la taille du block lors de l'instanciation de celui ci
	{	
		$this->blockLength = $blockLength;
	}

	abstract public function generate();

	public function setBlockLength($value) 
	{
		$this->blockLength = $value;
	}

	public function getBlockLength() 
	{
		return $this->blockLength;
	}

	public function getBlock() 
	{
		return $this->block;
	}
}