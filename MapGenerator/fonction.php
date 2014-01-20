<?php

// Auteur : Lucas


	function EmptyMap ($Dimension) {

		$MatriceVide = array_fill(0, $Dimension, array_fill(0, $Dimension, NULL));

		return $MatriceVide;
	}
	
	function ChoiceBlock ($Dimension) {

		// Pondération d'apparition des blocs
		$NatureBlock[ROCK] = 35;
		$NatureBlock[SAND] = 35;
		$NatureBlock[IRON] = 5;
		$NatureBlock[ORE] = 9;
		$NatureBlock[ICE] = 15;
		$NatureBlock[OTHER] = 1;

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
       	    	return new Iron($Dimension);
       	    	break;
      	}

	}