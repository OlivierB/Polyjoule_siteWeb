<!--
/**********
Page de gestion des comptes
Réservé à l'administrateur du site
**********/
-->

<div class="contenu">
	<h1> Gestion des comptes </h1>
	<div align="center">
		<table>
			<tr>
				<td>
					<img width="80px" height="80px" src="ressources/design/style1/images/add_user.png" />
				</td>
				<td>
					<a href="#" ><a href="#" ><h2>Inscrire un utilisateur</h2></a>
				</td>
			</tr>
			<tr>
				<td>
					<img width="80px" height="80px" src="ressources/design/style1/images/edit_user.png" />
				</td>
				<td>
					<a href="#" ><a href="#" > <h2>Modifier les informations d'un utilisateur</h2></a>
				</td>
			</tr>
			<tr>
				<td>
					<img width="80px" height="80px" src="ressources/design/style1/images/delete_user.png" />
				</td>
				<td>
					<a href="#" > <h2>Désinscrire un membre</h2></a>
				</td>
			</tr>
		</table>
		
		<table id='articles' style="margin-top:30px;">
			<tr class='article'><th class='article'><input type='checkbox' name="checkAll" id="checkAll" onClick="this.checked=check('checkArticle');"</th class='article'><th class='article'>Pseudo</th><th class='article'>Adresse mail</th></tr>
			<?php
			$req = mysql_query('SELECT id_membre,pseudo_membre,mail_membre FROM MEMBRE;');
			$req1 = mysql_query('SELECT COUNT(*) as nbMemb FROM MEMBRE;');
			$nbMemb = mysql_fetch_array($req1);
			while($membre= mysql_fetch_array($req))
			{
				echo "<tr class='article'><td class='article'><input type='checkbox' name='checkArticle' value='".$membre[0]."'/></td><td class='article'>".$membre[1]."</td><td class='article'>".$membre[2]."</td></tr>";
			}
			?>
		</table>
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
			function toDelete()
			{
				var toDelete;
				var nbArt = <?php echo $nbMemb[0];?>;
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
		</script>
	</div>
</div>

