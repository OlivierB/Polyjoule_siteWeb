<?php // content="text/plain; charset=utf-8"

	require_once ('../../../ressources/scripts/php/jpGraph/jpgraph.php');
	require_once ('../../../ressources/scripts/php/jpGraph/jpgraph_bar.php');
	
	$array = unserialize(urldecode(stripslashes($_GET['str'])));
	
	// Construction du conteneur
	// Spécification largeur et hauteur
	$graph = new Graph(600,300);

	// Réprésentation linéaire
	$graph->SetScale("textlin");

	// Ajouter une ombre au conteneur
	$graph->SetShadow();

	// Fixer les marges
	$graph->img->SetMargin(40,30,25,40);

	// Création du graphique histogramme
	$bplot = new BarPlot(array_values($array));

	// Spécification des couleurs des barres
	$bplot->SetFillColor(array('red', 'green', 'blue'));
	// Une ombre pour chaque barre
	$bplot->SetShadow();

	// Afficher les valeurs pour chaque barre
	$bplot->value->Show();
	// Fixer l'aspect de la police
	$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
	// Modifier le rendu de chaque valeur
	$bplot->value->SetFormat('%d articles');

	// Ajouter les barres au conteneur
	$graph->Add($bplot);

	// Le titre
	$graph->title->Set("Nombres d'articles écrits par membre");
	$graph->title->SetFont(FF_ARIAL,FS_BOLD);

	// Titre pour l'axe horizontal(axe x) et vertical (axe y)
	$graph->xaxis->title->Set("Membres");
	$graph->yaxis->title->Set("Nombre d'articles");

	$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
	$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

	// Légende pour l'axe horizontal
	$graph->xaxis->SetTickLabels(array_keys($array));

	// Afficher le graphique
	$graph->Stroke();
?>
