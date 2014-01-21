<?php
namespace MapGenerator;

abstract class Block 
{

	protected $blockLength;

	public $block = array(); //Matrice du block


	public function __construct($blockLength) //On définie la taille du block lors de l'instanciation de celui ci
	{	
		$this->blockLength = $blockLength;
		$this->setNatures($this->getRock(), $this->getSand(), $this->getIron(), $this->getOre(), $this->getIce(), $this->getOther()  );
	}

	public function generate() //$blockLength correspond au nombre de cases qui composent un bloc
	{ 	
		for($i = 0; $i < $this->blockLength; $i++) {
			for ($j=0; $j < $this->blockLength; $j++) {
				$tile = new Tile($this->getBlock(), $this->getNatures(), $this->getBlockLength(), $i, $j);
				$this->block[$i][$j] = array(
					'type' => $tile->generate(),
					'z' => $tile->elevationField(),
				);
			}
		}
	}

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