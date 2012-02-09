<!--
/**********
Page de gestion des articles

**********/
-->


<?php 
$actions = array(1,2,3,4,5); // Tableau des actions possibles
/*
	Action 1 : Ajouter article
	Action 2 : Modifier article
	Action 3 : Traitement d'ajout d'un article
	Action 4 : Traitement de mise à jour d'un article
	Action 5 : Traitement de suppression d'un article
	Defaut : Gestion des rubriques
*/

if(isset($_GET['action']) && in_array(securite($_GET['action']),$actions)) $action = securite($_GET['action']);
else $action = 0;

if ($action == 1)//Ajout d'un article
{ ?>

	<!-- Barre de titre avec logo des actions possibles -->
	<div class="contenu">
		<?php
			echo create_title_bar("Ajout d'un article", "ressources/design/style1/images/add_article.png");
		?>
	<!-- Formulaire d'ajout d'article -->		
	<form method="POST" action="index.php?page=article&action=3" name="ajout">
		<div style="margin-left : 120px;">
			<p>
				<label for="titleFR" style="float : left;"><strong>Titre</strong> (FR) :</label>
				<input type="text" style="margin-left:10px;" size="60" value="" name="titleFR"/> <br/><br/>
				<label for="titleEN" style="float : left;"><strong>Titre</strong> (EN) :</label>
				<input type="text" style="margin-left:10px;" size="60" value="" name="titleEN"/> <br/><br/>
				<strong>Section</strong> : 
				<?php
					echo "<select name='rubrique'>";
					echo "<option value='".$rub[0]."'>".$rub[2]."</option>";
					echo "</select>";
				?>
				<br/><br/>
				<strong>Publié</strong> :
				Oui <input type="radio" name="statut" value=true/>
				Non<input type="radio" name="statut" value=false/>
				<br/>
				<strong>Autoriser les commentaires</strong> :
				Oui <input type="radio" name="commentaire" value=true/>
				Non<input type="radio" name="commentaire" value=false/>
			</p>
		
		</div>
		<div  id="contenuFR" align="center">
		</div>
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("contenuFR")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "contenuFR";
			  cols = 120;
			  rows = 25;
			  value = "Votre article en français ici...";
			}
		  }
		//-->
		</script>
		<noscript>
		  The editor requires scripting to be enabled.
		</noscript>
		<noscript>mce:3</noscript>
		
		<div id="contenuEN" align="center">
		</div>
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("contenuFR")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "contenuEN";
			  cols = 120;
			  rows = 25;
			  value = "Here, your article in english...";
			}
		  }
		//-->
		</script>
		<noscript>
		  The editor requires scripting to be enabled.
		</noscript>
		<noscript>mce:3</noscript>
		<div align="center">
			<a href="javascript:document.ajout.submit()"> Ajouter ! </a>
		</div>
	</form>
<?php
}
else if ($action == 3)// Traitement d'ajout d'un article
{
	ajouterArticle(securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['statut']),securite($_POST['commentaire']),securite($_POST['contenuFR']),securite($_POST['contenuEN']));
}
else
{
?>

	<div class="contenu" style="text-align:center;">
	<?php
		echo create_title_bar("Gestion des articles", "ressources/design/style1/images/gestion_article.png");
	?>
	
	<ul class="section_name">
		<li>Articles en ligne</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_cell">
			<th class="blue_tabular_cell">
				<input type='checkbox' name="checkAll" id="checkAll" onClick="CheckAll('checkAll','checkArticle');"/>
			</th>
			<th class="blue_tabular_cell">
				Titre FR
			</th>
			<th class="blue_tabular_cell">
				Titre EN
			</th >
			<th class="blue_tabular_cell">
				Auteur
			</th>
			<th class="blue_tabular_cell">
				Rubrique
			</th>
			<th class="blue_tabular_cell">
				Commentaires autorisés
			</th>
			<th class="blue_tabular_cell">
				Statut
			</th>
		</tr>
		
		<?php
		for($i=0;$i<sizeof($articles);$i++)
		{
			echo "<tr class='blue_tabular_cell'>
					<td class='blue_tabular_cell'>
						<input type='checkbox' name='checkArticle' value='".$articles[$i]["id_article"]."'/>
					</td>
					<td class='blue_tabular_cell'>".$articles[$i]["titreFR_article"]."</td>
					<td class='blue_tabular_cell'>".$articles[$i]["titreEN_article"]."</td>
					<td class='blue_tabular_cell'>".$articles[$i]["auteur_article"]."</td>
					<td class='blue_tabular_cell'>".$articles[$i]["titreFR_rubrique"]."</td>";
			if ($articles[$i]["autorisation_com"])
				echo "<td class='blue_tabular_cell'>Oui</td>";
			else
				echo "<td class='blue_tabular_cell'>Non</td>";
			if ($articles[$i]["statut_article"])
				echo "<td class='blue_tabular_cell'>En ligne</td>";
			else
				echo "<td class='blue_tabular_cell'> -- </td>";
			echo "</tr>";
		}
		
		?>
	</table>

	<p>
		Pour la sélection : <a href="index.php?page=article&action=2" onclick="">Modifier</a> <a href="#" onclick="alert(article_toDelete(<?php echo sizeof($articles);?>));">Supprimer</a>
	</p>

	<a href="index.php?page=article&action=1"> Ajouter un article </a>
</div>
<?php
}
// ?>
</div>
