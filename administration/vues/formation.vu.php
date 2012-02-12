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
			<div class="contenu">
		<?php
			echo create_title_bar("Ajout d'une formation","ressources/design/style1/images/add_formation.png");
		?>
				<form method="POST" action="index.php?page=formation&action=4" name="formAjout">
					<div class="formulaire">
						<p>
							<label for="titreFR"><strong>Nom (FR)</strong> :</label>
							<input type="text" size="60" value="" name="nomFR"/><br/><br/>
							<label for="titreEN"><strong>Nom (EN)</strong> :</label>
							<input type="text" size="60" value="" name="nomEN"/><br/><br/>
							<label for="idEcole"><strong>Nom de l'école</strong> :</label>
							<?php listeEcole(); ?><br/><br/>
							<label for="lien"><strong>Site internet</strong> :</label>
							<input type="url" size="60" value="" name="lien"/>
						</p>
					</div>
						<p>
							<!-- descFR_formation -->
							<div class="editor" id="descFR" align="center">
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
							<div class="editor" id="descEN" align="center">
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
				</form>
				<div align="center">
					<a href="javascript:document.formAjout.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>
					<a href="index.php?page=formation"> <img src="ressources/design/style1/images/cancel.png"/></a>
				</div>
			</div>
		<?php
	} else if ($action==2) { //modification d'une formation
		if (isset($_GET['idformation'])) {
			?>
				<div class="contenu">
			<?php
				echo create_title_bar("Mise à jour d'une formation","ressources/design/style1/images/modify_formation.png");
				$formation=getFormation(securite($_GET['idformation']));
			?>
					<form method="POST" action="index.php?page=formation&action=5" name="formMAJ">
						<div class="formulaire">
							<p>
								<input type="text" name="id" hidden="hidden" value="<?php echo $formation[0]; ?>" />
								<label for="titreFR" style="float : left;"><strong>Nom (FR)</strong> :</label>
								<input type="text" style="margin-left:10px;" size="60" value="<?php echo $formation[2]; ?>" name="nomFR"/><br/><br/>
								<label for="titreEN" style="float : left;"><strong>Nom (EN)</strong> :</label>
								<input type="text" style="margin-left:10px;" size="60" value="<?php echo $formation[3]; ?>" name="nomEN"/><br/><br/>
								<label for="idEcole" style="float : left;"><strong>Nom de l'école</strong> :</label>
								<?php listeEcoleSelect($formation[1]); ?><br/><br/>
								<label for="lien" style="float : left;"><strong>Site internet</strong> :</label>
								<input type="url" style="margin-left:10px;" size="60" value="<?php echo $formation[4]; ?>" name="lien"/>
							</p>
						</div>
							<p>
								<!-- descFR_formation -->
								<div class="editor" id="descFR" align="center">
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
								<div class="editor" id="descEN" align="center">
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
					</form>
					<div align="center">
						<a href="javascript:document.formMAJ.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>
						<a href="index.php?page=formation"> <img src="ressources/design/style1/images/cancel.png"/></a>
					</div>
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
			<br />
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
			<div align=center>
				<br/><br/>
				<table>
					<tr>
						<td class="section_name"> Autres actions : </td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/add_formation.png" />
						</td>
						<td>
							<a class="liens_Action"href="index.php?page=formation&action=1"> Ajouter une formation </a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php
}
?>
