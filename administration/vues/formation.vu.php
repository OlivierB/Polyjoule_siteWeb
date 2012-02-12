<!--
/**********
Page de gestion des écoles

**********/
-->


<?php 
$actions = array(1,2,4,5,6); // Tableau des actions possibles
/*
	Action 1 : Ajouter formation
	Action 2 : Modifier formation
	Action 4 : Traitement d'ajout de formation
	Action 5 : Traitement de mise à jour d'une formation
	Action 6 : Traitement de suppression d'une formation
	Defaut : Gestion des formations
*/

if(isset($_GET['action']) && in_array($_GET['action'],$actions)) {
	$action = securite($_GET['action']);
	if ($action==1) { //ajouter une formation
		?>
			<div class="contenu" align="center">
		<?php
			echo create_title_bar("Ajout d'une formation","ressources/design/style1/images/add_formation.png");
		?>
				<form method="POST" action="index.php?page=formation&action=4" name="ajoutFormation">
					<div style="margin-left : 120px;" align="left">
						<table>
							<tr><!-- titreFR_formation -->
								<td><label for="titreFR" style="float : left;"><strong>Nom de la formation (FR)</strong> :</label></td>
								<td><input type="text" style="margin-left:10px;" size="60" value="" name="nomFR"/></td>
							</tr>
							<tr><!-- titreEN_formation -->
								<td><label for="titreEN" style="float : left;"><strong>Nom de la formation (EN)</strong> :</label></td>
								<td><input type="text" style="margin-left:10px;" size="60" value="" name="nomEN"/></td>
							</tr>
							<tr><!-- id_ecole -->
								<td><label for="idEcole" style="float : left;"><strong>Nom de l'école</strong> :</label></td>
								<td><?php listeEcole(); ?></td>
							</tr>
							<tr><!-- lien_formation -->
								<td><label for="lien" style="float : left;"><strong>Lien externe vers la formation</strong> :</label></td>
								<td><input type="url" style="margin-left:10px;" size="60" value="" name="lien"/></td>
							</tr>
						</table>
						<br />
						<p>
							<!-- descFR_formation -->
							<div  id="descFR" align="center">
							</div>
							<script language="javascript" type="text/javascript">
							  with (document.getElementById ("descFR")) {
								with (appendChild (document.createElement ("TEXTAREA"))) {
								  name = "descFR";
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
							<!-- descEn_formation -->
							<div id="descEN" align="center">
							</div>
							<script language="javascript" type="text/javascript">
							  with (document.getElementById ("descEN")) {
								with (appendChild (document.createElement ("TEXTAREA"))) {
								  name = "descEN";
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
						</p>
					</div>
					<input type="submit" value="Envoyer !" />
				</form>
			</div>
		<?php
	} else if ($action==2) { //modification d'une formation
		if (isset($_GET['idformation'])) {
			?>
				<div class="contenu" align="center">
			<?php
				echo create_title_bar("Mise à jour d'une formation","ressources/design/style1/images/modify_formation.png");
				$formation=getFormation(securite($_GET['idformation']));
			?>
					<form method="POST" action="index.php?page=formation&action=5" name="MAJFormation">
						<div style="margin-left : 120px;" align="left">
							<input type="text" name="id" hidden="hidden" value="<?php echo $formation[0]; ?>" />
							<table>
								<tr><!-- titreFR_formation -->
									<td><label for="titreFR" style="float : left;"><strong>Nom de la formation (FR)</strong> :</label></td>
									<td><input type="text" style="margin-left:10px;" size="60" value="<?php echo $formation[2]; ?>" name="nomFR"/></td>
								</tr>
								<tr><!-- titreEN_formation -->
									<td><label for="titreEN" style="float : left;"><strong>Nom de la formation (EN)</strong> :</label></td>
									<td><input type="text" style="margin-left:10px;" size="60" value="<?php echo $formation[3]; ?>" name="nomEN"/></td>
								</tr>
								<tr><!-- id_ecole -->
									<td><label for="idEcole" style="float : left;"><strong>Nom de l'école</strong> :</label></td>
									<td><?php listeEcoleSelect($formation[1]); ?></td>
								</tr>
								<tr><!-- lien_formation -->
									<td><label for="lien" style="float : left;"><strong>Lien externe vers la formation</strong> :</label></td>
									<td><input type="url" style="margin-left:10px;" size="60" value="<?php echo $formation[4]; ?>" name="lien"/></td>
								</tr>
							</table>
							<br />
							<p>
								<!-- descFR_formation -->
								<div  id="descFR" align="center">
								</div>
								<script language="javascript" type="text/javascript">
								  with (document.getElementById ("descFR")) {
									with (appendChild (document.createElement ("TEXTAREA"))) {
									  name = "descFR";
									  cols = 120;
									  rows = 25;
									  value = "<?php echo mysql_real_escape_string($formation[5]);?>";
									}
								  }
								//-->
								</script>
								<noscript>
								  The editor requires scripting to be enabled.
								</noscript>
								<noscript>mce:3</noscript>
								<!-- descEn_formation -->
								<div id="descEN" align="center">
								</div>
								<script language="javascript" type="text/javascript">
								  with (document.getElementById ("descEN")) {
									with (appendChild (document.createElement ("TEXTAREA"))) {
									  name = "descEN";
									  cols = 120;
									  rows = 25;
									  value = "<?php echo mysql_real_escape_string($formation[6]);?>";
									}
								  }
								//-->
								</script>
								<noscript>
								  The editor requires scripting to be enabled.
								</noscript>
								<noscript>mce:3</noscript>
							</p>
						</div>
						<input type="submit" value="Envoyer !" />
					</form>
				</div>
			<?php
		} else {
			header("Location:index.php?page=formation&message=erreurFormulaire");
		}
	} else if ($action==4) { //traitement d'ajout de formation
		if (isset($_POST['nomFR'])&&isset($_POST['nomEN'])&&isset($_POST['ecole'])) {
			ajouterFormation(securite($_POST['nomFR']),securite($_POST['nomEN']),securite($_POST['ecole']),securite($_POST['lien']),securite($_POST['descFR']),securite($_POST['descEN']));
		} else {
			header("Location:index.php?page=formation&message=erreurFormulaire");
		}
	} else if ($action==5) { //traitement de mise à jour de formation
		if (isset($_POST['id'])&&isset($_POST['nomFR'])&&isset($_POST['nomEN'])&&isset($_POST['ecole'])) {
			MAJFormation(securite($_POST['id']),securite($_POST['nomFR']),securite($_POST['nomEN']),securite($_POST['ecole']),securite($_POST['lien']),securite($_POST['descFR']),securite($_POST['descEN']));
		} else {
			header("Location:index.php?page=formation&message=erreurFormulaire");
		}
	} else if ($action==6) { //traitement de suppression de formation
		if (isset($_GET['idformation'])) {
			supprimerFormation(securite($_GET['idformation']));
		} else {
			header("Location:index.php?page=formation&message=erreurFormulaire");
		}
	} else { //gestion des formations
		header("Location: index.php?page=formation");
	}
} else {
	?>
		<div class="contenu">
			<?php echo create_title_bar("Gestion des formations", "ressources/design/style1/images/gestion_formation.png"); ?>
		<?php
	if (isset($_GET['message'])) {
		?>
			<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
				<strong>Message :</strong>
		<?php
			echo getMessage(securite($_GET['message']));
		?>
			</div>
		<?php
	}
	?>
		<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:center; padding-left : 20px;">
			<a href="index.php?page=formation&action=1">Ajouter une formation</a>
			<br /><br />
			<table class="blue_tabular">
				<tr class="blue_tabular_title">
					<th class="blue_tabular_title">
						Numéro formation
					</th>
					<th class="blue_tabular_title">
						Nom de la formation (FR)
					</th>
					<th class="blue_tabular_title">
						Nom de l'école
					</th>
					<th class="blue_tabular_title">
						Administration
					</th>
				</tr>
			<?php
				affichageFormations();
			?>
			</table>
			<br />
			<a href="index.php?page=formation&action=1">Ajouter une formation</a>
		</div>
		</div>
	<?php
}
?>