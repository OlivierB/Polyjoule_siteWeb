<!--
/**********
Page de gestion des articles

**********/
-->


<?php 
$actions = array(1,2,3); // Tableau des actions possibles
/*
	Action 1 : Ajouter article
	Action 2 : Modifier article
	Action 3 : Supprimer article
	Defaut : Gestion des articles
*/
if(isset($_GET['action']) && in_array(securite($_GET['action']),$actions)) $action = securite($_GET['action']);
else $action = 4;

	
if($action==1) //Ajout d'un article
{ ?>

	<!-- Barre de titre avec logo des actions possibles -->
	<div class="contenu" style="text-align:center;">
		<?php
			echo create_title_bar("Ajout d'un article", "ressources/design/style1/images/add_article.png");
		?>
	<!-- Formulaire d'ajout d'article -->
	
		<?php
		$req = mysql_query("SELECT * FROM RUBRIQUE"); // Sélection des rubriques
		$rubriques = array();
		while($rub=mysql_fetch_array($req))
		{
			$rubriques[$rub[1]] = $rub[0]; // Stockage des rubriques dans un tableau associatif
		}
		?>
		<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
			<form>
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
					Oui <input type="radio" name="publie" value=true/>
					Non<input type="radio" name="publie" value=false/>
				</p>
			</form>
		</div>					
					
		<div id="contenuFR" style="margin-left : 12px;">
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
		<strong>Traduction</strong> : 
		Automatique <input type="radio" name="traduction" onclick="traduction();" value="auto"/>
		Manuelle <input type="radio" name="traduction" onclick="traduction();" value="manu"/>
	</div>
<?php
} else if( $action == 3 ) // Supprimer articles
	{
		$toDelete = $_GET['toDelete'];
		rprint($toDelete);
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
	<div class="contenu" style="text-align:center;">
	<?php
		echo create_title_bar("Gestion des articles", "ressources/design/style1/images/gestion_article.png");
	?>
	<table id='articles'>
		<tr class='article'><th class='article'><input type='checkbox' name="checkAll" id="checkAll" onClick="this.checked=check('checkArticle');"</th class='article'><th class='article'>Rubrique</th><th class='article'>Num Article</th><th class='article'>Titre de l'article</th></tr>
		<?php
		$req = mysql_query('SELECT * FROM ARTICLE;');
		$req1 = mysql_query('SELECT COUNT(*) as nbArt FROM ARTICLE;');
		$nbArt = mysql_fetch_array($req1);
		while($article = mysql_fetch_array($req))
		{
			$req2 = mysql_query('SELECT titreFR_rubrique FROM RUBRIQUE WHERE id_rubrique='.$article[0]);
			$titreRub = mysql_fetch_array($req2);
			echo "<tr class='article'><td class='article'><input type='checkbox' name='checkArticle' value='".$article[0]."'/></td><td class='article'>".$titreRub[0]."</td><td class='article'>".$article[1]."</td><td class='article'>".$article[2]."</td></tr>";
		}
		?>
	</table>
	<script>
		function toDelete()
		{
			var toDelete;
			var nbArt = <?php echo $nbArt[0];?>;
			var i,j=0;
			for(i=0;i<nbArt;i++)
			{
				if(document.getElementsByName('checkArticle')[i].checked == true)
				{
					toDelete[j]= document.getElementsByName('checkArticle')[i].value;
					j++;
				}
			}
			alert("Redirection");
			return "index.php?page=article&action=3&toDelete="+toDelete;
		}
	</script>
	<p>
		Pour la sélection : <a href="index.php?page=article&action=2" onclick="">Modifier</a> <a href="javascript:toDelete();">Supprimer</a>
	</p>

	<a href="index.php?page=article&action=1"> Ajouter un article </a>
</div>
<?php
}
// ?>
</div>
