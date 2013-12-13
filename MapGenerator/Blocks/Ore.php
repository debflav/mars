<?php

namespace MapGenerator\Blocks;

use MapGenerator\Block;

class Ore extends Block
{
	private $rock    = 60;
	private $sand    = 10;
	private $iron    = 2;
	private $ore     = 18;
	private $ice     = 8;
	private $other   = 2;
	private $natures = array(); // On va stocker les pourcentages de natures dans ce tableau


	// SETTERS

	public function setRock($value) 
	{
		$this->rock = (int) $value;
	}

	public function setSand($value) 
	{
		$this->sand = (int) $value;
	}

	public function setIron($value) 
	{
		$this->iron = (int) $value;
	}

	public function setOre($value) 
	{
		$this->ore = (int) $value;
	}

	public function setIce($value) 
	{
		$this->ice = (int) $value;
	}

	public function setOther($value) 
	{
		$this->other = (int) $value;
	}

	// GETTERS

	public function getRock() 
	{
		return $this->rock;
	}

	public function getSand() 
	{
		return $this->sand;
	}

	public function getIron() 
	{
		return $this->iron;
	}

	public function getOre() 
	{
		return $this->ore;
	}

	public function getIce() 
	{
		return $this->ice;
	}

	public function getOther() 
	{
		return $this->other;
	}

	public function setNatures($rock, $sand, $iron, $ore, $ice, $other) 
	{
		$this->rock  = $this->setRock($rock);
		$this->sand  = $this->setSand($sand);
		$this->iron  = $this->setIron($iron);
		$this->ore   = $this->setOre($ore);
		$this->ice   = $this->setIce($ice);
		$this->other = $this->setOther($other);
	}

	public function getNatures()
	{
		return $this->natures;
	}


}