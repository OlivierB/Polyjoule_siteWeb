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
			"autorisation_com" => $art["autorisation_com"],
			"date_article" => $art["date_article"],
			"commentaires" => get_commentaires($art["id_article"]),
			"url_photo_principale" => $art["url_photo_principale"],
			"visible_home" => $art["visible_home"]);
		$i++;
	}
	return $articles;
}

/*fonction qui compte le nombre de rubrique*/
function countRubrique() 
{
	$req = mysql_query('SELECT count(*) FROM RUBRIQUE;');
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}

function get_commentaires($id)
{
	$coms = array();
	$i = 0;
	$req = mysql_query('SELECT * FROM COMMENTAIRE WHERE id_article='.$id);
	while($com = mysql_fetch_array($req))
	{
		$coms[$i] = array(
			"id_commentaire" => $com["id_commentaire"],
			"id_article" => $com["id_article"],
			"date_commentaire" => $com["date_commentaire"],
			"posteur_commentaire" => $com["posteur_commentaire"],
			"mail_commentaire" => $com["mail_commentaire"],
			"message_commentaire" => $com["message_commentaire"]);
		$i++;
	}
	return $coms;
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
		echo "<option value='".$rubrique['id_rubrique']."'".$selected.">".$rubrique['titreFR_rubrique']."</option>";
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

function exist_title($titleFR, $titleEN)
{
	$req = mysql_query('SELECT COUNT(*) FROM ARTICLE WHERE titreFR_article ="'.$titleFR.'" OR titreEN_article="'.$titleEN.'"');
	$nb = mysql_fetch_array($req);
	echo $nb[0];
	return ($nb[0]==1);
}

function ajouter_article($titreFR, $titreEN, $rubrique, $statut, $commentaire, $contenuFR, $contenuEN, $auteur,$visible_home,$photo)
{
	$req = "INSERT INTO ARTICLE VALUES (NULL,".$rubrique.",'".$auteur."','".$titreFR."','".$titreEN."','".$contenuFR."','".$contenuEN."','".$commentaire."',".$statut.",now(),'".$photo."',".$visible_home.")";
	mysql_query($req) or die(mysql_error());
	
	return true;
}

function modify_article($id, $titreFR, $titreEN, $rubrique, $statut, $commentaire, $contenuFR, $contenuEN, $auteur,$visible_home,$photo)
{
	$req = "UPDATE ARTICLE SET url_photo_principale='".$photo."', visible_home=".$visible_home.", id_rubrique=".$rubrique.",titreFR_article='".$titreFR."',titreEN_article='".$titreEN."',contenuFR_article='".$contenuFR."',contenuEN_article='".$contenuEN."',auteur_article='".$auteur."',statut_article=".$statut.",autorisation_com=".$commentaire." WHERE id_article=".$id;
	mysql_query($req) or die(mysql_error());
	
	return true;
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
			$article = get_article($toDelete[$i]);
			delete_file('ressources/data/Photo/', $article['url_photo_principale']);
			mysql_query('DELETE FROM ARTICLE WHERE id_article='.$toDelete[$i]) or die(mysql_error());
			
		}
		else
		{
			$req = mysql_query('SELECT titreFR_article FROM ARTICLE WHERE id_article='.$toDelete[$i]) or die(mysql_error());
			$titre = mysql_fetch_array($req);
			
			// erreur -> retour du titre pour identification
			return $titre[0];
			
		}
	}

	return "";
}
			
?>



