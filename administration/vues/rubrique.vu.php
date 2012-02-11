<!--
/**********
Page de gestion des rubriques

**********/
-->


<?php 
$actions = array(1,2,3,4,5); // Tableau des actions possibles
/*
	Action 1 : Ajouter rubrique
	Action 2 : Modifier rubrique
	Action 3 : Supprimer rubrique
	Action 4 : Traitement d'ajout de rubrique
	Action 5 : Traitement de mise à jour d'une rubrique
	Defaut : Gestion des rubriques
*/

if(isset($_GET['action']) && in_array($_GET['action'],$actions))
{
	$action = securite($_GET['action']);
	if ($action==1) { //ajouter une rubrique
		?>
			<div class="contenu" style="text-align:center;">
				<?php echo create_title_bar("Ajout d'une rubrique", "ressources/design/style1/images/add_rubrique.png"); ?>
				<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
					<form name="formAjout" method="post" action="index.php?page=rubrique&action=4">
						<table>
							<tr>
								<td><label for="titleFR" style="float : left;"><strong>Titre</strong> (FR) :</label></td>
								<td><input type="text" style="margin-left:10px;" size="60" value="" name="titleFR"/> <br/><br/></td>
							</tr>
							<tr>
								<td><label for="titleEN" style="float : left;"><strong>Titre</strong> (EN) :</label></td>
								<td><input type="text" style="margin-left:10px;" size="60" value="" name="titleEN"/> <br/><br/></td>
							</tr>
							<tr>
								<td><label for="rubriqueMère" style="float : left;"><strong>Rubrique mère</strong> :</label></td>
								<td><?php listeRubrique(); ?></td>
							</tr>
							<?php
								if ($baseDonnees==1) {
							?>
									<tr>
										<td><label for="descriptionFR" style="float : left;"><strong>Description</strong> (FR) :</label></td>
										<td><input type="text" style="margin-left:10px;" size="80" value="" name="descriptionFR"/></td>
									</tr>
									<tr>
										<td><label for="descriptionEN" style="float : left;"><strong>Description</strong> (EN) :</label></td>
										<td><input type="text" style="margin-left:10px;" size="80" value="" name="descriptionEN"/></td>
									</tr>
							<?php
								} else {
							?>
									<input type="text" style="margin-left:10px;" hidden="hidden" size="80" value="" name="descriptionFR"/>
									<input type="text" style="margin-left:10px;" hidden="hidden" size="80" value="" name="descriptionEN"/>
							<?php
								}
							?>
						</table>
						<input type="submit" value="Envoyer !" />
					</form>
				</div>
			</div>
		<?php
	} else if ($action==2) { //modification d'une rubrique
		if(isset($_GET['idRubrique'])) { //vérification du numéro de la rubrique
			$rubr=securite($_GET['idRubrique']);
			if (rubriqueExistante($rubr)) { //vérification de l'existence de la rubrique
				$rubrique=getRubrique($rubr);
				?>
					<div class="contenu" style="text-align:center;">
						<?php echo create_title_bar("Mise à jour d'une rubrique", "ressources/design/style1/images/modify_rubrique.png"); ?>
						<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
							<form method="post" action="index.php?page=rubrique&action=5">
								<p>
									<input type="hidden" name="rubrique_id" value="<?php echo $rubrique[0]; ?>"/>
									<label for="titleFR" style="float : left;"><strong>Titre</strong> (FR) :</label>
									<input type="text" style="margin-left:10px;" size="60" value="<?php echo $rubrique[2]; ?>" name="titleFR"/> <br/><br/>
									<label for="titleEN" style="float : left;"><strong>Titre</strong> (EN) :</label>
									<input type="text" style="margin-left:10px;" size="60" value="<?php echo $rubrique[3]; ?>" name="titleEN"/> <br/><br/>
									<strong>Rubrique mère</strong> : 
									<?php
										listeRubriqueSelected($rubrique[1],$rubrique[0]);
									?>
									<?php
										if ($baseDonnees==1) {
									?>
									<br/><br/>
									<label for="descriptionFR" style="float : left;"><strong>Description</strong> (FR) :</label>
									<input type="text" style="margin-left:10px;" size="80" value="<?php echo $rubrique[4]; ?>" name="descriptionFR"/> <br/><br/>
									<label for="descriptionEN" style="float : left;"><strong>Description</strong> (EN) :</label>
									<input type="text" style="margin-left:10px;" size="80" value="<?php echo $rubrique[5]; ?>" name="descriptionEN"/>
									<?php
										} else {
									?>
									<input type="text" hidden="hidden" style="margin-left:10px;" size="80" value="" name="descriptionFR"/>
									<input type="text" hidden="hidden" style="margin-left:10px;" size="80" value="" name="descriptionEN"/>
									<?php
										}
									?>
								</p>
								<input type="submit" value="Envoyer !" />
							</form>
						</div>
					</div>
				<?php
			} else {
				header("Location: index.php?page=rubrique&message=rubriqueAbsente");
			}
		} else {
			header("Location: index.php?page=rubrique&message=rubriqueNonSelectionnee");
		}
	} else if ($action==3) { //supprimer rubrique
		supprimerRubrique($_GET['idRubrique']);
	} else if ($action==4) { //traitement d'ajout de rubrique
		if (isset($_POST['descriptionFR']) && isset($_POST['descriptionEN']) && isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique'])) {
			ajoutRubrique(securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['descriptionFR']),securite($_POST['descriptionEN']));
		} else {
			header("Location: index.php?page=rubrique&message=erreurFormulaire");
		}
	} else if ($action==5) { //traitement de mise à jour de rubrique
		if (isset($_POST['rubrique_id'])&& isset($_POST['titleFR'])&& isset($_POST['titleEN'])&& isset($_POST['rubrique'])&& isset($_POST['descriptionFR'])&& isset($_POST['descriptionEN'])) {
			MAJRubrique(securite($_POST['rubrique_id']),securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['descriptionFR']),securite($_POST['descriptionEN']));
		} else {
			header("Location: index.php?page=rubrique&message=erreurFormulaire");
		}
	} else { //gestion des rubriques
		header("Location: index.php?page=rubrique");
	}
} else {
	?>
		<div class="contenu" style="text-align:center;">
			<?php echo create_title_bar("Gestion des rubriques", "ressources/design/style1/images/gestion_rubrique.png"); ?>
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
			<a href="index.php?page=rubrique&action=1"> Ajouter un rubrique</a>
			<br />
			<?php
				if (!countRubrique() && isset($_GET['message'])) {
					$msg=securite($_GET['message']);
					if ($msg!="sansRubrique") {
						header("Location: index.php?page=rubrique&message=sansRubrique");
					}
				} else {
			?>
			<br />
			<table class="blue_tabular">
			<tr class="blue_tabular_title">
				<th class="blue_tabular_title">
					Numéro Rubrique
				</th>
				<th class="blue_tabular_title">
					Titre de la rubrique (FR)
				</th>
				<th class="blue_tabular_title">
					Titre de la rubrique (EN)
				</th>
				<th class="blue_tabular_title">
					Administration
				</th>
			</tr>
			<?php
				affichageRubriques(null,0);
			?>
			</table>
			<br />
			<a href="index.php?page=rubrique&action=1"> Ajouter un rubrique </a>
			<?php
				}
			?>
		</div>
	<?php
}
?>