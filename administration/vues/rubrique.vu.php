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
/*
	rubriqueAbsente : la rubrique est inexistante
	procedureAnnulee : la procédure a été annulée
	rubriqueSupprimee : votre rubrique a bien été supprimée
	rubriqueAjoutee : votre rubrique a bien été ajoutée
	erreurFormulaire : il y a une erreur dans le formulaire. veuillez recommancez.
	rubriqueMAJ : votre rubrique a bien été mise à jour
	rubriqueNonSelectionnee : on est sur la page rubrique/modification mais aucune rubrique n'est selectionnée
	sansRubrique : il n'y a pas de rubrique dans la base de données
	default : affichage du contenu du message
*/
if(isset($_GET['action']) && in_array($_GET['action'],$actions))
{
	$action = $_GET['action'];
	if ($action==1) { //ajouter une rubrique
		?>
			<div class="contenu" style="text-align:center;">
				<div style="height:50px;">
					<div style="float : left;font-size : 120%;font-weight:bold;">
						<div style="float:left;">
							<img src="ressources/design/style1/images/add_rubrique.png" alt="add_article">
						</div>
						<div style="float:right; margin-top:10px;margin-left:10px;">
							Ajout d'une Rubrique
						</div>
					</div>
					<div style="height:50px;width:300px;float:right;">
						<a href="" class="save"><img src="ressources/design/style1/images/save.png" alt="save_article">Sauver</a>
						<a href="" class="validate"><img src="ressources/design/style1/images/validate.png" alt="apply_article">Appliquer</a>
						<a href="index.php?page=rubrique&message=procedureAnnulee" class="cancel"><img src="ressources/design/style1/images/cancel.png" alt="cancel_article">Annuler</a>
					</div>
				</div>
				<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
					<form method="post" action="<?php echo $pageRubrique."&action=4" ?>">
						<p>
							<label for="titleFR" style="float : left;"><strong>Titre</strong> (FR) :</label>
							<input type="text" style="margin-left:10px;" size="60" value="" name="titleFR"/> <br/><br/>
							<label for="titleEN" style="float : left;"><strong>Titre</strong> (EN) :</label>
							<input type="text" style="margin-left:10px;" size="60" value="" name="titleEN"/> <br/><br/>
							<strong>Rubrique mère</strong> : 
							<?php
								listeRubrique();
							?>
							<?php
								if ($baseDonnees==1) {
							?>
							<br/><br/>
							<label for="descriptionFR" style="float : left;"><strong>Description</strong> (FR) :</label>
							<input type="text" style="margin-left:10px;" size="80" value="" name="descriptionFR"/> <br/><br/>
							<label for="descriptionEN" style="float : left;"><strong>Description</strong> (EN) :</label>
							<input type="text" style="margin-left:10px;" size="80" value="" name="descriptionEN"/>
							<?php
								}
							?>
						</p>
						<input type="submit" value="Envoyer !" />
					</form>
				</div>
			</div>
		<?php
	} else if ($action==2) { //modification d'une rubrique
		if(isset($_GET['idRubrique'])) { //vérification du numéro de la rubrique
			$rubr=$_GET['idRubrique'];
			$req = mysql_query("SELECT * FROM `rubrique` WHERE `id_rubrique`=$rubr;");
			$rubrique=mysql_fetch_array($req);
			if (rubriqueExistante($rubr)) { //vérification de l'existence de la rubrique
				?>
					<div class="contenu" style="text-align:center;">
						<div style="height:50px;">
							<div style="float : left;font-size : 120%;font-weight:bold;">
								<div style="float:left;">
									<img src="ressources/design/style1/images/add_rubrique.png" alt="add_article">
								</div>
								<div style="float:right; margin-top:10px;margin-left:10px;">
									Mise à jour d'une Rubrique
								</div>
							</div>
							<div style="height:50px;width:300px;float:right;">
								<a href="" class="save"><img src="ressources/design/style1/images/save.png" alt="save_article">Sauver</a>
								<a href="" class="validate"><img src="ressources/design/style1/images/validate.png" alt="apply_article">Appliquer</a>
								<a href="index.php?page=rubrique&message=procedureAnnulee" class="cancel"><img src="ressources/design/style1/images/cancel.png" alt="cancel_article">Annuler</a>
							</div>
						</div>
						<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
							<form method="post" action="<?php echo $pageRubrique."&action=5" ?>">
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
										}
									?>
								</p>
								<input type="submit" value="Envoyer !" />
							</form>
						</div>
					</div>
				<?php
			} else {
				header("Location: $pageRubrique&message=rubriqueAbsente");
			}
			mysql_free_result($req);
		} else {
			header("Location: $pageRubrique&message=rubriqueNonSelectionnee");
		}
	} else if ($action==3) { //supprimer rubrique
		if(isset($_GET['idRubrique'])) {
			$rubr=$_GET['idRubrique'];
			if (rubriqueExistante($rubr)) {
				$req = mysql_query("DELETE FROM `rubrique` WHERE `id_rubrique`=$rubr;");
				mysql_free_result($req);
				miseAJourRubriqueFilles($rubr);
				header("Location: $pageRubrique&message=rubriqueSupprimee");
			} else {
				header("Location: $pageRubrique&message=rubriqueAbsente");
			}
		} else {
			header("Location: $pageRubrique");
		}
	} else if ($action==4) { //traitement d'ajout de rubrique
		if ($baseDonnes==1) {
			if (isset($_POST['descriptionFR']) && isset($_POST['descriptionEN'])) {
				$toReturn=1;
				$descFR=mysql_real_escape_string($_POST['descriptionFR']);
				$descEN=mysql_real_escape_string($_POST['descriptionEN']);
			} else {
				$toReturn=0;
			}
		} else {
			$toReturn=1;
		}
		if (isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique']) && $toReturn==1) {
			$titreFR=mysql_real_escape_string($_POST['titleFR']);
			$titreEN=mysql_real_escape_string($_POST['titleEN']);
			$rubrique=mysql_real_escape_string($_POST['rubrique']);
			//vérification de la rubrique mère
			if ($rubrique=='null') {
				if ($baseDonnees==1) {
					$req="INSERT INTO `rubrique` VALUES (NULL,NULL,'".$titreFR."','".$titreEN."','".$descFR."','".$descEN."')";
				} else {
					$req="INSERT INTO `rubrique` VALUES (NULL,NULL,'".$titreFR."','".$titreEN."')";
				}
				mysql_query($req) or die(mysql_error());
				mysql_free_result($req);
				header("Location: $pageRubrique&message=rubriqueAjoutee");
			} else {
				$req=mysql_query("SELECT * FROM rubrique WHERE id_rubrique=$rubrique");
				$result=mysql_fetch_array($req);
				if (rubriqueExistante($result[0])) {
					if ($baseDonnees==1) {
						$req ="INSERT INTO rubrique  VALUES (NULL,'".$rubrique."','".$titreFR."','".$titreEN."','".$descFR."','".$descEN."')";
					} else {
						$req ="INSERT INTO rubrique  VALUES (NULL,'".$rubrique."','".$titreFR."','".$titreEN."')";
					}
					mysql_query($req) or die(mysql_error());
					mysql_free_result($req);
					header("Location: $pageRubrique&message=rubriqueAjoutee");
				} else {
					header("Location: $pageRubrique&message=erreurFormulaire");
				}
			}
		} else {
			header("Location: $pageRubrique&message=erreurFormulaireAjout");
		}
	} else if ($action==5) { //traitement de mise à jour de rubrique
		if ($baseDonnees==1) {
			if (isset($_POST['descriptionFR']) && isset($_POST['descriptionEN'])) {
				$toReturn=1;
				$descFR=mysql_real_escape_string($_POST['descriptionFR']);
				$descEN=mysql_real_escape_string($_POST['descriptionEN']);
			} else {
				$toReturn=0;
			}
		} else {
			$toReturn=1;
		}
		if (isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique']) && isset($_POST['rubrique_id']) && $toReturn==1) {
			$titreFR=mysql_real_escape_string($_POST['titleFR']);
			$titreEN=mysql_real_escape_string($_POST['titleEN']);
			$rubrique=mysql_real_escape_string($_POST['rubrique_id']);
			$rubrique_mere=mysql_real_escape_string($_POST['rubrique']);
			if ($rubrique_mere=='null') {
				if ($baseDonnees==1) {
					$req="UPDATE rubrique SET id_mere=NULL, titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."', descriptionFR_rubrique='".$descFR."', descriptionEN_rubrique='".$descEN."' WHERE id_rubrique=".$rubrique.";";
				} else {
					$req="UPDATE rubrique SET id_mere=NULL, titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."' WHERE id_rubrique=".$rubrique.";";
				}
			} else {
				header("Location: $pageRubrique&message=".verificationBoucleRubrique($rubrique,$rubrique_mere));
				if (verificationBoucleRubrique($rubrique,$rubrique_mere)!=0) {
					$req2=mysql_query("SELECT * FROM rubrique WHERE id_rubrique=$rubrique_mere");
					$result=mysql_fetch_array($req2);
					mysql_free_result($req2);
					if (rubriqueExistante($result[0])) {
						if ($baseDonnees==1) {
							$req="UPDATE rubrique SET id_mere='".$rubrique_mere."', titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."', descriptionFR_rubrique='".$descFR."', descriptionEN_rubrique='".$descEN."' WHERE id_rubrique=".$rubrique.";";
						} else {
							$req="UPDATE rubrique SET id_mere='".$rubrique_mere."', titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."' WHERE id_rubrique=".$rubrique.";";
						}
					} else {
						header("Location: $pageRubrique&message=erreurFormulaire");
					}
				} else {
					header("Location: $pageRubrique&message=erreurFormulaire");
				}
			}
			mysql_query($req) or die(mysql_error());
			mysql_free_result($req3);
			header("Location: $pageRubrique&message=rubriqueMAJ");
		} else {
			header("Location: $pageRubrique&message=erreurFormulaire");
		}
	} else { //gestion des rubriques
		header("Location: $pageRubrique");
	}
} else {
	?>
		<div class="contenu" style="text-align:center;">
			<h2>Gestion des	rubriques</h2>
			<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
			</div>
	<?php
	if (isset($_GET['message'])) {
		?>
			<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">
				<strong>Message :</strong>
		<?php
		$msg=$_GET['message'];
		if ($msg=="rubriqueAbsente") {
			echo "La rubrique est inexistante.";
		} else if ($msg=="procedureAnnulee") {
			echo "La procédure a été annulée.";
		} else if ($msg=="rubriqueSupprimee") {
			echo "Votre rubrique a bien été supprimée.";
		} else if ($msg=="rubriqueAjoutee") {
			echo "Votre rubrique a bien été ajoutée.";
		} else if ($msg=="erreurFormulaire") {
			echo "Il y a une erreur dans le formulaire. Veuillez recommencez.";
		} else if ($msg=="rubriqueMAJ") {
			echo "Votre rubrique a bien été mise à jour.";
		} else if ($msg=="rubriqueNonSelectionnee") {
			echo "Aucune rubrique sélectionnée.";
		} else if ($msg=="sansRubrique") {
			echo "Il n'y a aucune rubrique présente dans la base de données.";
		}/* else if ($msg=="") {
			echo "";
		}*/ else {
			echo $_GET['message'];
		}
		?>
			</div>
		<?php
	}
	?>
			<a href="index.php?page=rubrique&action=1"> Ajouter un rubrique </a>
			<?php
				$req = mysql_query('SELECT count(*) FROM RUBRIQUE;');
				$count=mysql_fetch_array($req);
				if ($count[0]==0 && isset($_GET['message'])) {
					$msg=$_GET['message'];
					if ($msg!="sansRubrique") {
						header("Location: $pageRubrique&message=sansRubrique");
					}
				} else {
			?>
			<table id='articles'>
			<tr class='article'><th class='article'>Num Rubrique</th><th class='article'>Titre de la rubrique (FR)</th><th class='article'>Titre de la rubrique (EN)</th><th class='article'>Administration</th></tr>
			<?php
				affichageRubriques(null,0);
			?>
			</table>
			<a href="index.php?page=rubrique&action=1"> Ajouter un rubrique </a>
			<?php
				}
			?>
		</div>
	<?php
}
?>