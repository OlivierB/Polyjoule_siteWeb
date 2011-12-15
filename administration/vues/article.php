<!--
/**********
Page de gestion des articles

**********/
-->

<div class="contenu" align="center">
	<?php 
	$actions = array(1,2,3); // Tableau des actions possibles
	
	if(isset($_GET['action']) && in_array($_GET['action'],$actions))
	{
		$action = $_GET['action'];
		if($action==1) //Ajout article
		{ ?>
			<h1> Ajout d'article </h1>
			<span id="content_placeholder"></span>
			<script language="javascript" type="text/javascript">
			  with (document.getElementById ("content_placeholder")) {
				with (appendChild (document.createElement ("TEXTAREA"))) {
				  name = "nom_du_textarea";
				  cols = 80;
				  rows = 25;
				  value = "texte_par_defaut";
				}
			  }
			//-->
			</script>
			<noscript>
			  The editor requires scripting to be enabled.
			</noscript>
			<noscript>mce:3</noscript>
		<?php
		}
	}
	else
	{
		?>
		<script>
		/* Fonction qui permet de sélectionner/desélectionner tout les articles */
		function check(field) {
		if (document.getElementById('checkAll').checked == true) {
		  for (i = 0; i < field.length; i++) {
		  document.getElementsByName(field)[i].checked = true;}
		  checkflag = "true";
		  return true; }
		else {
		  for (i = 0; i < field.length; i++) {
		  document.getElementsByName(field)[i].checked = false; }
		  checkflag = "false";
		  return false; }
		}
		</script>
		
		<h2>Gestion des	articles</h2>
		<table id='articles'>
		<tr class='article'><th class='article'><input type='checkbox' name="checkAll" id="checkAll" onClick="this.checked=check('checkArticle');"</th class='article'><th class='article'>Rubrique</th><th class='article'>Num Article</th><th class='article'>Titre de l'article</th></tr>
		<?php
		$req = mysql_query('SELECT * FROM ARTICLE;');
		while($article = mysql_fetch_array($req))
		{
			$req1 = mysql_query('SELECT titreFR_rubrique FROM RUBRIQUE WHERE id_rubrique='.$article[0]);
			$titreRub = mysql_fetch_array($req1);
			echo "<tr class='article'><td class='article'><input type='checkbox' name='checkArticle' value='".$article[0]."'/></td><td class='article'>".$titreRub[0]."</td><td class='article'>".$article[1]."</td><td class='article'>".$article[2]."</td></tr>";
		}
		?>
		</table>
		<p>
			Pour la sélection : <a href="index.php?page=article&action=2">Modifier</a> <a href="index.php?page=article&action=3">Supprimer</a>
		</p>
		<a href="index.php?page=article&action=1"> Ajouter un article </a>
		<?php
	}
	// ?>
</div>
