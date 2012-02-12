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

?>
<?php
if ($action == 1)//Ajout d'un article
{ 
	if(countRubrique()==0)
	{
		$informations = Array(/*Erreur*/
						true,
						'Erreur',
						'Impossible de créer un article, veuillez créer une rubrique avant.',
						'index.php?page=rubrique&action=1',
						4
						);
		require_once('vues/informations.vu.php');
		exit();
	}
	?>
	<div class="contenu">
	<!-- Barre de titre avec logo des actions possibles -->
	
		<?php
			echo create_title_bar("Ajout d'un article", "ressources/design/style1/images/add_article.png");
		?>
	<!-- Formulaire d'ajout d'article -->		
	<form method="POST" action="index.php?page=article&action=3" name="ajoutArticle" onSubmit="return valider_ajoutArticle();">
		<div class="formulaire">
			<p>
				<label for="titleFR">Titre(FR) :</label>
				<input type="text" size="60" value="" name="titleFR"/> <br/><br/>
				
				<label for="titleEN">Titre(EN) :</label>
				<input type="text" size="60" value="" name="titleEN"/> <br/><br/>
				
				<label for="rubrique">Rubrique :</label> 
				<?php
					echo listeRubrique_article(NULL);
				?>
				<br/><br/>
				<label for="statut">Publié :</label>
				<input type="radio" checked="checked" name="statut" value="1"/> Oui 
				<input type="radio" name="statut" value="0"/> Non<br/><br/>
				
				<label for="commentaire">Autoriser les commentaires :</label>
				<input type="radio" checked="checked" name="commentaire" value="1"/> Oui 
				<input type="radio" name="commentaire" value="0"/> Non
			</p>
		
		</div>
		
		<div  class="editor" id="contenuFR" align="center">
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
		
		<div class="editor" id="contenuEN" align="center">
		</div>
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("contenuEN")) {
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
			<a href="javascript:valider_ajoutArticle();"> <img src="ressources/design/style1/images/validate.png"/></a>
			<a href="index.php?page=article"> <img src="ressources/design/style1/images/cancel.png"/></a>
		</div>
	</form>
<?php
}
else if ($action == 2)// Modification d'un article
{
	if(countRubrique()==0)
	{
		$informations = Array(/*Erreur*/
						true,
						'Erreur',
						'Impossible de modifier un article, veuillez créer une rubrique avant.',
						'index.php?page=rubrique&action=1',
						4
						);
		require_once('vues/informations.vu.php');
		exit();
	}
	
	if( !isset($_GET['id']) || sizeof($_GET['id'])==0)
	{
		$informations = Array(/*Erreur*/
						false,
						'Erreur',
						'Aucun article sélectionné.',
						'index.php?page=article',
						4
						);
		require_once('vues/informations.vu.php');
		exit();
	}
	if(sizeof($_GET['id'])>1)
	{
		$informations = Array(/*Information*/
						true,
						'Information',
						'Veuillez modifier qu\'un seul article à la fois.',
						'index.php?page=article',
						4
						);
		require_once('vues/informations.vu.php');
		exit();
	}
		
	$id = securite($_GET['id'][0]);
	if( !exist_article($id))
	{
		$error = "L'article n'existe pas dans la base.";
	}
	if( !isAutorOf($id, $_SESSION['pseudo_membre']))
	{
		$error = "Vous n'êtes pas autorisé à modifier cette article car vous en êtes pas l'auteur.";
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
	else
	{
		$article = get_article($id);
		
		?>
		<!-- Barre de titre avec logo des actions possibles -->
		<div class="contenu">
		<?php
			echo create_title_bar("Modification d'un article", "ressources/design/style1/images/modify_article.png");
		?>
		<!-- Formulaire de modification d'un article -->		
		<form method="POST" action="index.php?page=article&action=4" name="ajoutArticle" onSubmit="return valider_ajoutArticle();">
			<div class="formulaire">
				<p>
					<label for="titleFR">Titre(FR) :</label>
					<input type="text" size="60" value="<?php echo $article['titreFR_article'];?>" name="titleFR"/> <br/><br/>
					
					<label for="titleEN" >Titre(EN) :</label>
					<input type="text" size="60" value="<?php echo $article['titreEN_article'];?>" name="titleEN"/> <br/><br/>
					
					<label for="rubrique">Rubrique :</label>
					<?php
						echo listeRubrique_article($article['id_rubrique']);
					?>
					<br/><br/>
					
					<label for="statut">Publié :</label>
					<input type="radio" <?php if($article['statut_article']) echo "checked='checked'";?> name="statut" value="1"/> Oui
					<input type="radio" <?php if(!$article['statut_article']) echo "checked='checked'";?> name="statut" value="0"/> Non
					<br/><br/>
					
					<label for="commentaire">Autoriser les commentaires :</label>
					<input type="radio" <?php if($article['autorisation_com']) echo "checked='checked'";?> name="commentaire" value="1"/> Oui
					<input type="radio"  <?php if(!$article['autorisation_com']) echo "checked='checked'";?> name="commentaire" value="0"/> Non
					
					<input type="hidden" value="<?php echo $id;?>" name="id"/>
				</p>
			</div>
			
			<div class="editor" id="contenuFR" align="center">
			</div>
			<script language="javascript" type="text/javascript">
			  with (document.getElementById ("contenuFR")) {
				with (appendChild (document.createElement ("TEXTAREA"))) {
				  name = "contenuFR";
				  cols = 120;
				  rows = 25;
				  value = "<?php echo mysql_real_escape_string($article['contenuFR_article']);?>";
				}
			  }
			//-->
			</script>
			<noscript>
			  The editor requires scripting to be enabled.
			</noscript>
			<noscript>mce:3</noscript>
			
			<div class="editor" id="contenuEN" align="center">
			</div>
			<script language="javascript" type="text/javascript">
			  with (document.getElementById ("contenuFR")) {
				with (appendChild (document.createElement ("TEXTAREA"))) {
				  name = "contenuEN";
				  cols = 120;
				  rows = 25;
				  value = "<?php echo mysql_real_escape_string($article['contenuEN_article']);?>";
				}
			  }
			//-->
			</script>
			<noscript>
			  The editor requires scripting to be enabled.
			</noscript>
			<noscript>mce:3</noscript>
			
			<div align="center">
				<a href="javascript:valider_ajoutArticle();"> <img src="ressources/design/style1/images/validate.png"/></a>
				<a href="index.php?page=article"> <img src="ressources/design/style1/images/cancel.png"/></a>
			</div>
		</form>
	<?php
	}
}
else if ($action == 3)// Traitement d'ajout d'un article
{
	if(isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique']) && isset($_POST['statut']) && isset($_POST['commentaire']) && isset($_POST['contenuFR']) && isset($_POST['contenuEN']) && isset($_SESSION['pseudo_membre']))
		ajouter_article(securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['statut']),securite($_POST['commentaire']),securite($_POST['contenuFR']),securite($_POST['contenuEN']), $_SESSION['pseudo_membre']);
	header("Location:index.php?page=article");
}
else if ($action == 4)// Traitement de modification d'un article
{
	if(isset($_POST['id']) && isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique']) && isset($_POST['statut']) && isset($_POST['commentaire']) && isset($_POST['contenuFR']) && isset($_POST['contenuEN']) && isset($_SESSION['pseudo_membre']))
		modify_article(securite($_POST['id']),securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['statut']),securite($_POST['commentaire']),securite($_POST['contenuFR']),securite($_POST['contenuEN']), $_SESSION['pseudo_membre']);
	header("Location:index.php?page=article");
}
else if ($action == 5)// Traitement de suppression d'articles
{
	if(isset($_GET['id']))
	{
		$toDelete = $_GET['id'];
		delete_articles($toDelete);
	}
	header("Location:index.php?page=article");
}
else
{
?>
	<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des articles", "ressources/design/style1/images/gestion_article.png");
	?>
	
	<ul class="section_name">
		<li>Liste des articles</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				<input type='checkbox' name="checkAll" id="checkAll" onClick="CheckAll('checkAll','checkArticle');"/>
			</th>
			<th class="blue_tabular_title">
				Titre FR
			</th>
			<th class="blue_tabular_title">
				Titre EN
			</th >
			<th class="blue_tabular_title">
				Auteur
			</th>
			<th class="blue_tabular_title">
				Rubrique
			</th>
			<th class="blue_tabular_title">
				Commentaires autorisés
			</th>
			<th class="blue_tabular_title">
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
	<div align=center>
		<br/><br/>
		<table>
			<tr>
				<td class="section_name"> Pour la sélection : </td>
			</tr>
			<tr>
				<td>
					<img src="ressources/design/style1/images/modify_article.png" />
				</td>
				<td>
					<a class="liens_Action" href="#" onclick="window.location.href=recuperer_selection('checkArticle',<?php echo sizeof($articles);?>,'index.php?page=article&action=2');">Modifier</a>
				</td>
			</tr>
			<tr>
				<td>
					<img src="ressources/design/style1/images/delete_article.png" />
				</td>
				<td>
					<a class="liens_Action" href="#" onclick="window.location.href=recuperer_selection('checkArticle',<?php echo sizeof($articles);?>,'index.php?page=article&action=5');">Supprimer</a>
				</td>
			</tr>
			<tr>
				<td class="section_name"> Autres actions : </td>
			</tr>
			<tr>
				<td>
					<img src="ressources/design/style1/images/add_article.png" />
				</td>
				<td>
					<a class="liens_Action" href="index.php?page=article&action=1">Ajouter un article </a>
				</td>
			</tr>
		</table>
	</div>	
<?php
}
?>
</div>
