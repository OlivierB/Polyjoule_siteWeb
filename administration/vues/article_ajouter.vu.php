<!--
/**********
Page de gestion des articles -> ajout d'un article

**********/
-->


<div class="contenu">
	
	<!-- Barre de titre avec logo des actions possibles -->
		<?php
			echo create_title_bar("Ajout d'un article", "ressources/design/style1/images/add_article.png");
			
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
</div>
