<!--
/**********
Page de gestion des écoles

**********/
-->


<?php 
$actions = array(1,2,4,5,6); // Tableau des actions possibles
/*
	Action 1 : Ajouter école
	Action 2 : Modifier école
	Action 4 : Traitement d'ajout de école
	Action 5 : Traitement de mise à jour d'une école
	Action 6 : Traitement de suppression d'une école
	Defaut : Gestion des écoles
*/

if(isset($_GET['action']) && in_array($_GET['action'],$actions)) {
	$action = securite($_GET['action']);
	if ($action==1) { //ajouter une école
		?>
			<div class="contenu">
		<?php
			echo create_title_bar("Ajout d'une école","ressources/design/style1/images/add_ecole.png");
		?>
				<form method="POST" action="index.php?page=ecole&action=4" name="formAjout">
					<div class="formulaire">
						<label for="nom"><strong>Nom de l'école</strong> :</label>
						<input type="text" size="60" value="" name="nom"/><br /><br />
						<label for="adresse"><strong>Adresse de l'école</strong> :</label>
						<input type="text" size="60" value="" name="adresse"/><br /><br />
						<label for="photo"><strong>Photo de l'école</strong> : </label>
						<input type="file" name="photo"/><br /><br />
						<input type="text" hidden="hidden" name="photo" value=""/>
					</div>
						<p>
							<!-- descFR -->
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
							<!-- descEN -->
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
					<a href="index.php?page=ecole"> <img src="ressources/design/style1/images/cancel.png"/></a>
				</div>
			</div>
		<?php
	} else if ($action==2) { //modification d'une école
		if (isset($_GET['idEcole'])) {
			$idEcole=securite($_GET['idEcole']);
			if (ecoleExistante($idEcole)) {
				$ecole=getEcole($idEcole);
				?>
					<div class="contenu">
						<?php echo create_title_bar("Mise à jour d'une école","ressources/design/style1/images/modify_ecole.png"); ?>
						<form method="POST" action="index.php?page=ecole&action=5" name="formMAJ">
							<div class="formulaire">
								<p>
									<input type="text" hidden="hidden" name="idEcole" value="<?php echo $idEcole; ?>"/>
									<label for="nom" style="float : left;"><strong>Nom de l'école</strong> :</label>
									<input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[1]; ?>" name="nom"/><br /><br />
									<label for="adresse" style="float : left;"><strong>Adresse de l'école</strong> :</label>
									<input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[2]; ?>" name="adresse"/><br /><br />
									<label for="photo" style="float : left;"><strong>Photo de l'école</strong> : </label>
									<input type="file" name="photo"/>
									<input type="text" hidden="hidden" name="photo" value="<?php echo $ecole[3]; ?>"/>
								</p>
							</div>
							<p>
								<!-- descFR -->
								<div class="editor" id="descFR" align="center">
								</div>
								<script language="javascript" type="text/javascript">
									with (document.getElementById ("descFR")) {
										with (appendChild (document.createElement ("TEXTAREA"))) {
										  name = "descFR";
										  cols = 120;
										  rows = 25;
										  value = "<?php echo mysql_real_escape_string($ecole[4]);?>";
										}
									}
								//-->
								</script>
								<noscript>
								  The editor requires scripting to be enabled.
								</noscript>
								<noscript>mce:3</noscript>
								<!-- descEN -->
								<div class="editor" id="descEN" align="center">
								</div>
								<script language="javascript" type="text/javascript">
								  with (document.getElementById ("descEN")) {
									with (appendChild (document.createElement ("TEXTAREA"))) {
									  name = "descEN";
									  cols = 120;
									  rows = 25;
									  value = "<?php echo mysql_real_escape_string($ecole[5]);?>";
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
							<a href="index.php?page=ecole"> <img src="ressources/design/style1/images/cancel.png"/></a>
						</div>
					</div>
				<?php
			} else {
				header("Location: index.php?page=ecole&message=ecoleInexistante");
			}
		} else {
			header("Location: index.php?page=ecole&message=ecoleNonSelectionnee");
		}
	} else if ($action==4) { //traitement d'ajout de école
		if (isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['photo']) && isset($_POST['descFR']) && isset($_POST['descEN'])) {
			ajouterEcole(securite($_POST['nom']),securite($_POST['adresse']),securite($_POST['photo']),securite($_POST['descFR']),securite($_POST['descEN']));
		} else {
			header("Location:index.php?page=ecole&message=erreurFormulaire");
		}
	} else if ($action==5) { //traitement de mise à jour de école
		if (isset($_POST['idEcole']) && isset($_POST['nom']) && isset($_POST['adresse']) && isset($_POST['photo']) && isset($_POST['descFR']) && isset($_POST['descEN'])) {
			MAJEcole(securite($_POST['idEcole']),securite($_POST['nom']),securite($_POST['adresse']),securite($_POST['photo']),securite($_POST['descFR']),securite($_POST['descEN']));
		} else {
			header("Location:index.php?page=ecole&message=erreurFormulaire");
		}
	} else if ($action==6) { //traitement de suppression de école
		if (isset($_GET['idEcole'])) {
			supprimerEcole(securite($_GET['idEcole']));
		} else {
			header("Location:index.php?page=ecole&message=ecoleNonSelectionnee");
		}
	} else { //gestion des écoles
		header("Location: index.php?page=ecole");
	}
} else {
	?>
		<div class="contenu">
			<?php echo create_title_bar("Gestion des écoles", "ressources/design/style1/images/gestion_ecole.png"); ?>
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
						Numéro école
					</th>
					<th class="blue_tabular_title">
						Nom de l'école
					</th>
					<th class="blue_tabular_title">
						Adresse de l'école
					</th>
					<th class="blue_tabular_title">
						Administration
					</th>
				</tr>
			<?php
				affichageEcoles();
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
							<img src="ressources/design/style1/images/add_ecole.png" />
						</td>
						<td>
							<a class="liens_Action"href="index.php?page=ecole&action=1"> Ajouter une école </a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php
}
?>
