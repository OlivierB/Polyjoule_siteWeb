<!--
/**********
Page de gestion des articles

**********/
-->

<!-- Barre de titre avec logo des actions possibles -->
<div class="contenu">
	<?php
		echo create_title_bar("Modification d'un article", "modify_article.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
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
			<a href="javascript:valider_ajoutArticle();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=article"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
