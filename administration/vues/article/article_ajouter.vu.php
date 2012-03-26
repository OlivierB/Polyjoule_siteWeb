<!--
/**********
Page de gestion des articles -> ajout d'un article

**********/
-->


<div class="contenu">
	
	<!-- Barre de titre avec logo des actions possibles -->
		<?php
			echo create_title_bar("Ajout d'un article", "add_article.png");
			
			// affichage succès ou erreurs
			$infos->printInfos();
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
		
		<h3> Contenu de l'article en français : </h3>
		<textarea cols="80" class="ckeditor" id="contenuFR" name="contenuFR" rows="10"></textarea>
		<h3> Contenu de l'article en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="contenuEN" name="contenuEN" rows="10"></textarea>
		<script>
			CKEDITOR.replace( 'contenuFR',
			{
				toolbar : 'Full',
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
