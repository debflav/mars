<?php

namespace MapGenerator\Blocks;

use MapGenerator\Block;

class Sand extends Block
{
	private $rock    = 18;
	private $sand    = 66;
	private $iron    = 6;
	private $ore     = 6;
	private $ice     = 4;
	private $other   = 0;
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
		$this->natures[] = $rock;
		$this->natures[] = $sand;
		$this->natures[] = $iron;
		$this->natures[] = $ore;
		$this->natures[] = $ice;
		$this->natures[] = $other;

	}

	public function getNatures()
	{
		return $this->natures;
	}


}