<?php

	// On inclus les fonctions de l'index
	include 'fonction.php';

	// VARIABLES
	$BlocXY = 5; // Nombre de blocs en longueur et largeur
	$DimensionBloc = 25; // Nombre de cellule par bloc
	$Bloc = array_fill(0, $BlocXY, array_fill(0, $BlocXY, NULL)); // tableau contenant des objets blocs

	// ETAPE 0 :
	// on génère la carte vide à partir des infos
	$TheMap = EmptyMap($BlocXY * $DimensionBloc);

	// ETAPE 1 :
	// On génère la carte par bloc avec altitude pseudo plane et nature
	for ($i = 0; $i < ($BlocXY); $i++) {

		for ($j = 0; $j < ($BlocXY); $j++) { // colonnes de blocs

			// Fonction de génération d'un bloc
			$Bloc[$i][$j] = ChoiceBlock($DimensionBloc);
			$Bloc[$i][$j]->generate();
		}
	}

	// On remplit la carte vide avec les blocs

	for ($i = 0; $i < ($BlocXY); $i++) { // ligne de blocs

		$g = $i * $DimensionBloc;

		for ($j = 0; $j < ($BlocXY); $j++) { // colonnes de blocs

			$h = $j * $DimensionBloc;

			for ($k = 0; $k <= ($DimensionBloc); $k++) { // ligne du bloc

				for ($l = 0; $l <= ($DimensionBloc); $l++) { // colonnes du bloc

					$TheMap[$g][$h] = $Bloc[$i][$j]->$block[$k][$l];

					$h++;

				}

				$g++;
			}
		}
	}
		
	




	// ETAPE 2 :
	// on dépose sur la carte un certain nombre d'objet

	// on définit le nombre d'objet à poser en fonction du nombre de bloc divisant la carte

	// on pose les objets un à un

	// ETAPE 3 :
	// On créer le JSON