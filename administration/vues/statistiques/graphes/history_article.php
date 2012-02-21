<?php // content="text/plain; charset=utf-8"

	require_once ('../../../ressources/scripts/php/jpGraph/jpgraph.php');
	require_once ('../../../ressources/scripts/php/jpGraph/jpgraph_line.php');
	
	$array = unserialize(urldecode(stripslashes($_GET['str'])));
	
	// Création du conteneur
	$graph = new Graph(600,300);

	// Fixer les marges
	$graph->img->SetMargin(40,30,50,40);    

	// Lissage sur fond blanc (évite la pixellisation)
	$graph->img->SetAntiAliasing("white");

	// A détailler
	$graph->SetScale("textlin");

	// Ajouter une ombre
	$graph->SetShadow();

	// Ajouter le titre du graphique
	$graph->title->Set("Historique des créations d'articles");

	// Afficher la grille de l'axe des ordonnées
	$graph->ygrid->Show();
	// Fixer la couleur de l'axe (bleu avec transparence : @0.7)
	$graph->ygrid->SetColor('blue@0.7');
	// Des tirets pour les lignes
	$graph->ygrid->SetLineStyle('dashed');

	// Afficher la grille de l'axe des abscisses
	$graph->xgrid->Show();
	// Fixer la couleur de l'axe (rouge avec transparence : @0.7)
	$graph->xgrid->SetColor('red@0.7');
	// Des tirets pour les lignes
	$graph->xgrid->SetLineStyle('dashed');

	// Apparence de la police
	$graph->title->SetFont(FF_ARIAL,FS_BOLD,11);

	// Créer une courbes
	$courbe = new LinePlot(array_values($array));

	// Afficher les valeurs pour chaque point
	$courbe->value->Show();

	// Valeurs: Apparence de la police
	$courbe->value->SetFont(FF_ARIAL,FS_NORMAL,9);
	$courbe->value->SetFormat('%d');
	$courbe->value->SetColor("red");

	// Chaque point de la courbe ****
	// Type de point
	$courbe->mark->SetType(MARK_FILLEDCIRCLE);
	// Couleur de remplissage
	$courbe->mark->SetFillColor("green");
	// Taille
	$courbe->mark->SetWidth(5);

	// Couleur de la courbe
	$courbe->SetColor("blue");
	$courbe->SetCenter();

	// Paramétrage des axes
	$graph->xaxis->title->Set("Dates");
	$graph->yaxis->title->Set("Nombre d'articles");
	$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
	$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
	$graph->xaxis->SetTickLabels(array_keys($array));

	// Ajouter la courbe au conteneur
	$graph->Add($courbe);

	$graph->Stroke();
?>
