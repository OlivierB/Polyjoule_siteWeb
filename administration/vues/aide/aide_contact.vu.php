<!--
/**********
Page d'aide

	Option 2 : Contact

**********/
-->

<div class="contenu" align="center">
				<?php
					echo create_title_bar("Formulaire de contact", "contact.png");
				?>
				<form name="contact" action="index.php?page=aide&action=4" method="POST">
					<label for="objet"><strong>Objet :</strong></label>
					<input type="text" size="50" value="" name="objet"/>
					<br/><br/>
					<textarea id="message" name="message"></textarea>
					<script>
						CKEDITOR.replace( 'message',
						{
							toolbar : 'Basic',
							uiColor : '#468093',
							height:"150", width:"600",
						});
					</script>
				</form>
				<div align="center">
					<a href="javascript:check_form_contact();"> <img src="ressources/design/style1/images/validate.png"/></a>
					<a href="index.php?page=aide"> <img src="ressources/design/style1/images/cancel.png"/></a>
				</div>
			</div>
			<?php
