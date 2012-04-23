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
	<form method="POST" action="index.php?page=article&action=4" name="ajoutArticle" onSubmit="return valider_ajoutArticle();"  enctype="multipart/form-data">
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
				<input type="radio" <?php if(!$article['statut_article']) echo "checked='checked'";?> name="statut" value="0"/> Non<br/><br/>
				<br/><br/>
				
				<label for="commentaire">Autoriser les commentaires :</label>
				<input type="radio" <?php if($article['autorisation_com']) echo "checked='checked'";?> name="commentaire" value="1"/> Oui
				<input type="radio"  <?php if(!$article['autorisation_com']) echo "checked='checked'";?> name="commentaire" value="0"/> Non<br/><br/>
				
				<label for="visible_home">A la une  ?</label>
				
				<input type="radio"  <?php if($article['visible_home']) echo "checked='checked'";?>  name="visible_home" value="1"/> Oui 
				<input type="radio" <?php if(!$article['visible_home']) echo "checked='checked'";?>  name="visible_home" value="0"/> Non<br/><br/>
			
				<label for="">Photo principale :</label><br/>
				<div align="center">
					<?php echo "<img id='photo_article' src='ressources/data/Photo/".$article['url_photo_principale']."'/><br/><br/>";?>
				</div>
				<?php echo create_information("Taille limitée à 5Mo et format image uniquement.");?>
				<label for="url_photo_principale" >Changer la photo principale	:</label>
				<input type="file" name="url_photo_principale" maxlength="5242880" accept="image/*" id="url_photo_principale" />
				
				<input type="hidden" value="<?php echo $id;?>" name="id"/>
			</p>
		</div>

		<h3> Contenu de l'article en français : </h3>
		<textarea cols="80" class="ckeditor" id="contenuFR" name="contenuFR" rows="10"> <?php echo $article['contenuFR_article'];?> </textarea>
		<h3> Contenu de l'article en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="contenuEN" name="contenuEN" rows="10"> <?php echo $article['contenuEN_article'];?> </textarea>
		<script>
		
			CKEDITOR.replace( 'contenuFR',
			{
				toolbar : 'Full',
				fullPage : true,
				entities : true,
				uiColor : '#468093',
				filebrowserBrowseUrl : "ressources/scripts/js//ckfinder/ckfinder.html?Type=Files",
				filebrowserImageBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Images",
				filebrowserFlashBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Flash",
				filebrowserUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
				filebrowserImageUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
				filebrowserFlashUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
			});
			CKEDITOR.replace( 'contenuEN',
			{
				toolbar : 'Full',
				uiColor : '#468093',
				fullPage : true,
				entities : true,
				filebrowserBrowseUrl : "ressources/scripts/js//ckfinder/ckfinder.html?Type=Files",
				filebrowserImageBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Images",
				filebrowserFlashBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Flash",
				filebrowserUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
				filebrowserImageUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
				filebrowserFlashUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
			});
		</script>
		

		<div align="center">
			<a href="javascript:valider_ajoutArticle();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=article"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
