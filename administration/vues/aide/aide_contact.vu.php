<!--
/**********
Page d'aide

	Option 2 : Contact

**********/
-->

<div class="contenu" align="center">
				<?php
					echo create_title_bar("Formulaire de contact", "ressources/design/style1/images/contact.png");
				?>
				<form name="contact" action="index.php?page=aide&action=4" method="POST">
					<label for="objet"><strong>Objet :</strong></label>
					<input type="text" size="50" value="" name="objet"/>
					<br/><br/>
					<div  id="message" align="center">
					</div>
					<script language="javascript" type="text/javascript">
					  with (document.getElementById ("message")) {
						with (appendChild (document.createElement ("TEXTAREA"))) {
						  name = "message";
						  cols = 80;
						  rows = 25;
						  value = "Votre message ici ... ";
						}
					  }
					//-->
					</script>
					<noscript>
					  The editor requires scripting to be enabled.
					</noscript>
					<noscript>mce:3</noscript>
				</form>
				<div align="center">
					<a href="javascript:check_form_contact();"> <img src="ressources/design/style1/images/validate.png"/></a>
					<a href="index.php?page=aide"> <img src="ressources/design/style1/images/cancel.png"/></a>
				</div>
			</div>
			<?php
