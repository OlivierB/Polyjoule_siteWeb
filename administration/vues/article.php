<!--
/**********
Page de gestion des articles

**********/
-->


	<?php 
	$actions = array(1,2,3); // Tableau des actions possibles
	
	if(isset($_GET['action']) && in_array($_GET['action'],$actions))
	{
		$action = $_GET['action'];
		if($action==1) //Ajout article
		{ ?>
			<div class="contenu" align="center" style="height:50px;">
				<div style="float : left;font-size : 120%;font-weight:bold;">
					<div style="float:left;">
					<img src="ressources/design/style1/images/add_article.png"/>
					</div>
					<div style="float:right; margin-top:10px;margin-left:10px;">
						Ajout d'un Article
					</div>
				</div>
				<div style="height:50px;width:300px;float:right;">
					<a href="" class="save"><img src="ressources/design/style1/images/save.png"/>Sauver</a>
					<a href="" class="validate"><img src="ressources/design/style1/images/validate.png"/>Appliquer</a>
					<a href="" class="cancel"><img src="ressources/design/style1/images/cancel.png"/>Annuler</a>
				</div>
			</div>
			<div class="contenu" align ="center">
			<?php
			$req = mysql_query("SELECT * FROM RUBRIQUE");
			$rubriques = array();
			while($rub=mysql_fetch_array($req))
			{
				$rubriques[$rub[1]] = $rub[0];
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
									/*$req1 = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$rub[0]);
									while($ssrub=mysql_fetch_array($req1))
									{
										echo "<option value='".$ssrub[0]."'>---->".$ssrub[2]."<option>";
									}*/				
								
								echo "</select>";
							?><br/><br/>
							<strong>Publié</strong> : Oui<input type="radio" name="publie" value=true/> Non<input type="radio" name="publie" value=false/>
						</p>
					</form>
				</div>					
							
				<span id="content_placeholder"></span>
				<script language="javascript" type="text/javascript">
				  with (document.getElementById ("content_placeholder")) {
					with (appendChild (document.createElement ("TEXTAREA"))) {
					  name = "nom_du_textarea";
					  cols = 120;
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
			</div>
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
			
		<div class="contenu" align="center">
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
		</div>
		<?php
	}
	// ?>
</div>
