<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des articles
*
-->

<?php

function get_articles()
{
	$articles = array();
	$i = 0;
	$req = mysql_query('SELECT * FROM ARTICLE;');
	while($art = mysql_fetch_array($req))
	{
		if($art["id_rubrique"]!=NULL)
		{
			$req1 = mysql_query("SELECT titreFR_rubrique FROM RUBRIQUE WHERE id_rubrique=".$art["id_rubrique"]);
			$titreRub = mysql_fetch_array($req1);
		}
		else
		{
			$titreRub['titreFR_rubrique'] = "--";
		}
		$articles[$i] = array(
			"id_article" => $art["id_article"],
			"id_rubrique" => $art["id_rubrique"],
			"titreFR_rubrique" => $titreRub["titreFR_rubrique"],
			"titreFR_article" => $art["titreFR_article"],
			"titreEN_article" => $art["titreEN_article"],
			"contenuFR_article" => $art["contenuFR_article"],
			"contenuEN_article" => $art["contenuEN_article"],
			"auteur_article" => $art["auteur_article"],
			"statut_article" => $art["statut_article"],
			"autorisation_com" => $art["autorisation_com"] );
		$i++;
	}
	return $articles;
}

function get_article($id)
{
	$req = mysql_query('SELECT * FROM ARTICLE WHERE id_article='.$id);
	$art = mysql_fetch_array($req);
	
	return $art;
}

function exist_rubrique($rubrique)
{
	$req = mysql_query('SELECT COUNT(*) FROM RUBRIQUE WHERE id_rubrique = '.$rubrique);
	$nb = mysql_fetch_array($req);
	return ($nb[0]==1);
}

/*Fait la liste des rubriques*/
function listeRubrique_article($rub_selected)
{
	echo "<select name='rubrique'>";
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE `id_mere` is null;");
	while($rubrique=mysql_fetch_array($req))
	{
		$selected = "";
		if($rub_selected == $rubrique['id_rubrique'])
			$selected = "selected='selected'";
		echo "<option value='".$rubrique['id_rubrique']."'".$selected.">".$rubrique[2]."</option>";
		getChildRubrique_article($rubrique['id_rubrique'],0,$rub_selected);
	}
	echo "</select>";
}

/*Faire une liste des rubriques filles*/
function getChildRubrique_article($idRubrique,$niveau,$rub_selected)
{
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$idRubrique);
	$niveau++;
	while ($rubrique=mysql_fetch_array($req)) {
		if($rubrique['id_rubrique']!=null){
			$selected = "";
			if($rub_selected == $rubrique['id_rubrique'])
				$selected = "selected='selected'";
			echo "<option value='".$rubrique['id_rubrique']."'".$selected.">";
			for($i=0;$i<$niveau;$i++){
				echo "----";
			}
			echo ">";
			echo $rubrique['titreFR_rubrique']."</option>";
			getChildRubrique_article($rubrique[0],$niveau,$rub_selected);
		}
	}
}

function is_boolean($bit)
{ 
	return (($bit == 0) || ($bit == 1));
}

function ajouter_article($titreFR, $titreEN, $rubrique, $statut, $commentaire, $contenuFR, $contenuEN, $auteur)
{
	$req = "INSERT INTO ARTICLE VALUES (NULL,".$rubrique.",'".$titreFR."','".$titreEN."','".$contenuFR."','".$contenuEN."','".$auteur."',".$statut.",".$commentaire.")";
	mysql_query($req) or die(mysql_error());
}

function modify_article($id, $titreFR, $titreEN, $rubrique, $statut, $commentaire, $contenuFR, $contenuEN, $auteur)
{
	$req = "UPDATE ARTICLE SET id_rubrique=".$rubrique.",titreFR_article='".$titreFR."',titreEN_article='".$titreEN."',contenuFR_article='".$contenuFR."',contenuEN_article='".$contenuEN."',auteur_article='".$auteur."',statut_article=".$statut.",autorisation_com=".$commentaire." WHERE id_article=".$id;
	mysql_query($req) or die(mysql_error());
}

function isAutorOf($id, $autor)
{
	$req = mysql_query('SELECT auteur_article FROM ARTICLE WHERE id_article	= '.$id);
	$result = mysql_fetch_array($req);
	if($_SESSION['statut_membre'] == 'admin') return 1;
	else return (!strcmp($result[0], $autor));
}

function exist_article($id)
{
	$req = mysql_query('SELECT COUNT(*) FROM ARTICLE WHERE id_article = '.$id);
	$nb = mysql_fetch_array($req);
	return ($nb[0]==1);
}

function delete_articles($toDelete)
{
	for($i=0;$i<sizeof($toDelete);$i++)
	{
		if(isAutorOf($toDelete[$i],$_SESSION['pseudo_membre']) && exist_article($toDelete[$i]))
		{
			mysql_query('DELETE FROM ARTICLE WHERE id_article='.$toDelete[$i]) or die(mysql_error());
		}
		else
		{
			$req = mysql_query('SELECT titreFR_article FROM ARTICLE WHERE id_article='.$toDelete[$i]) or die(mysql_error());
			$titre = mysql_fetch_array($req);
			$error ="Impossible de supprimer l'article : ".$titre[0]."<br/>";
		}
	}
	if(isset($error))
	{
		$informations = Array(/*Erreur*/
						false,
						'Erreur',
						$error,
						'index.php?page=article',
						4
						);
		require_once('vues/informations.vu.php');
		exit();
	}
}
			
?>



