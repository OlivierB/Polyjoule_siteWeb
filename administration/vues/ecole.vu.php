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
			<div class="contenu" align="center">
		<?php
			echo create_title_bar("Ajout d'une école","ressources/design/style1/images/add_ecole.png");
		?>
				<form method="POST" action="index.php?page=ecole&action=4" name="ajoutEcole">
					<div style="margin-left : 120px;" align="left">
						<table>
							<tr><!-- nom -->
								<td><label for="nom" style="float : left;"><strong>Nom de l'école</strong> :</label></td>
								<td><input type="text" style="margin-left:10px;" size="60" value="" name="nom"/></td>
							</tr>
							<tr><!-- adresse -->
								<td><label for="adresse" style="float : left;"><strong>Adresse de l'école</strong> :</label></td>
								<td><input type="text" style="margin-left:10px;" size="60" value="" name="adresse"/></td>
							</tr>
							<tr><!-- photo -->
								<td><label for="photo" style="float : left;"><strong>Photo de l'école</strong> : </label></td>
								<td><input type="file" name="photo"/></td>
								<input type="text" hidden="hidden" name="photo" value=""/>
							</tr>
						</table>
						<br />
						<p>
							<!-- descFR -->
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
							<!-- descEN -->
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
	} else if ($action==2) { //modification d'une école
		if (isset($_GET['idEcole'])) {
			$idEcole=securite($_GET['idEcole']);
			if (ecoleExistante($idEcole)) {
				$ecole=getEcole($idEcole);
				?>
					<div class="contenu" style="text-align:center;">
						<?php echo create_title_bar("Mise à jour d'une école","ressources/design/style1/images/modify_ecole.png"); ?>
						<form method="POST" action="index.php?page=ecole&action=5" name="MAJEcole">
							<div style="margin-left : 120px;" align="left">
								<input type="text" hidden="hidden" name="idEcole" value="<?php echo $idEcole; ?>"/>
								<table>
									<tr><!-- nom -->
										<td><label for="nom" style="float : left;"><strong>Nom de l'école</strong> :</label></td>
										<td><input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[1]; ?>" name="nom"/></td>
									</tr>
									<tr><!-- adresse -->
										<td><label for="adresse" style="float : left;"><strong>Adresse de l'école</strong> :</label></td>
										<td><input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[2]; ?>" name="adresse"/></td>
									</tr>
									<tr><!-- photo -->
										<td><label for="photo" style="float : left;"><strong>Photo de l'école</strong> : </label></td>
										<td><input type="file" name="photo"/></td>
										<input type="text" hidden="hidden" name="photo" value="<?php echo $ecole[3]; ?>"/>
									</tr>
								</table>
							</div>
							<p>
								<!-- descFR -->
								<div id="descFR" align="center">
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
								<div id="descEN" align="center">
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
							<input type="submit" value="Envoyer !" />
						</form>
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
		<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:center; padding-left : 20px;">
			<a href="index.php?page=ecole&action=1">Ajouter une école</a>
			<br /><br />
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
			<br />
			<a href="index.php?page=ecole&action=1">Ajouter une école</a>
		</div>
		</div>
	<?php
}
?>