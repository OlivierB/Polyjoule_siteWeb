<!--
/**********
Page d'aide

	Option 1 : aide administration
	Option 2 : Contact
	Option 3 : Liens utiles

**********/
-->

<?php
	$Options = array(1,2,3); // Tableau des options possibles

	if( !isset($_GET['option']) )
	{
		?>
		<div class="contenu">
			<?php
				echo create_title_bar("Besoin d'aide ?", "ressources/design/style1/images/help.png");
			?>
			<div align=center>
				<br/><br/>
				<table>
					<tr>
						<td>
							<img src="ressources/design/style1/images/help.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=aide&option=1" >Obtenir de l'aide sur l'administration</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/contact.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=aide&option=2" >Envoyer un mail aux administrateurs</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/web.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=aide&option=3" >Liens utiles</a>
						</td>
					</tr>
				</table>
			</div>	
		</div>
		<?php
	}
	else
	{
		if( $_GET['option']==1 )
		{
			?>
			<div class="contenu">
			<?php
				echo create_title_bar("Aide administration", "ressources/design/style1/images/help.png");
			?>
			</div>
			<?php
		}
		else if( $_GET['option']==2 )
		{
			?>
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
		}
		else if( $_GET['option']==3 )
		{
			?>
			<div class="contenu">
			<?php
				echo create_title_bar("Liens utiles", "ressources/design/style1/images/web.png");
			?>
			</div>
			<?php
		}
		else
		{
			$informations = Array(/*Erreur*/
							true,
							'Erreur',
							'La page demandée n\'est pas accessible.',
							'index.php',
							2
							);
			require_once('vues/informations.php');
			exit();
		}
	}
