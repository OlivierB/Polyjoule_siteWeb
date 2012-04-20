<!--
/**********
Page d'aide

	Option 2 : Contact

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Contact", "contact.png");
	?>
	
	<div align=center>
		<p> N'hésitez pas à nous contacter !</p>
		<br/>
		<table>
			<tr >
				<td style="padding-right:80px;">
					<p style="text-decoration:bold;color:green;" >Partie utilisateur du site</p>
				</td>
				<td>
					<p style="text-decoration:bold;color:green;" >Partie administrateur du site</p>
				</td>
			</tr>
			<tr>
				<td>
					<p>Antonin BIRET</p>
					<p>Josselin ROUSSEAU</p>
					<p>Olivier MANDIN</p>
				</td>
				<td>
					<p>Alexandre BISIAUX</p>
					<p>Simon ROUSSEAU</p>
					<p>Olivier BLIN</p>
				</td>
			</tr>

		</table>
	</div>	
	
				<!--
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
				-->
</div>

