# STRUCTURE DU SITE

## index.php

	Page qui sert de "racine" : elle gère l'appel aux autres pages du site.
	Ce fichier présente la structure HTML du site.

## connexion.php
	
	Page de connexion séparé du reste de la structure.

## controleurs

	Ce dossier contient toutes les pages incluses dans index.php. Chaque controleur permet la construction des sous-pages

## modeles

	Les fichiers de modele contiennent les requetes SQL correspondant à leur contrôleur. Toutes les requetes sont dans des fonctions appelées dans le fichier controleur

## vues

	Gère l'affichage de la sous-page du controleur correspondant. Contient les boucles d'affichage des résultats de la bdd et toute la structure interne de la sous-page
				
## ressources

	Contient toutes les données ou scripts annexes

## bdd

	Contient le fichier de connexion à la bdd
