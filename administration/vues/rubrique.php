<!--/**********Page de gestion des articles**********/-->	<?php 	$actions = array(1,2,3,4,5); // Tableau des actions possibles		if(isset($_GET['action']) && in_array($_GET['action'],$actions))	{		$action = $_GET['action'];		if($action==1) //Ajout rubrique		{ ?>			<div class="contenu" align="center" style="height:50px;">				<div style="float : left;font-size : 120%;font-weight:bold;">					<div style="float:left;">					<img src="ressources/design/style1/images/add_rubrique.png"/>					</div>					<div style="float:right; margin-top:10px;margin-left:10px;">						Ajout d'une rubrique					</div>				</div>				<div style="height:50px;width:300px;float:right;">					<a href="" class="save"><img src="ressources/design/style1/images/save.png"/>Sauver</a>					<a href="" class="validate"><img src="ressources/design/style1/images/validate.png"/>Appliquer</a>					<a href="index.php?page=rubrique&message=procedureAnnulee" class="cancel"><img src="ressources/design/style1/images/cancel.png"/>Annuler</a>				</div>			</div>			<div class="contenu" align ="center">				<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">					<form method="post" action="<?php echo $pageRubrique."&action=4" ?>">						<p>							<label for="titleFR" style="float : left;"><strong>Titre</strong> (FR) :</label>							<input type="text" style="margin-left:10px;" size="60" value="" name="titleFR"/> <br/><br/>							<label for="titleEN" style="float : left;"><strong>Titre</strong> (EN) :</label>							<input type="text" style="margin-left:10px;" size="60" value="" name="titleEN"/> <br/><br/>							<strong>Rubrique mère</strong> : 							<?php								listeRubrique();							?>						</p>						<input type="submit" value="envoyer" />					</form>				</div>								</div>		<?php		} else if ($action==2) { //modifier une rubrique			if(isset($_GET['idRubrique'])) {				$rubr=$_GET['idRubrique'];				$req3 = mysql_query("SELECT * FROM `rubrique` WHERE `id_rubrique`=$rubr;");				$rubrique2=mysql_fetch_array($req3);				if (rubriqueExistante($rubr)) {					<div class="contenu" align="center" style="height:50px;">					<div style="float : left;font-size : 120%;font-weight:bold;">					<div style="float:left;">					<img src="ressources/design/style1/images/add_rubrique.png"/>					</div>					<div style="float:right; margin-top:10px;margin-left:10px;">					Mise à jour d'une rubrique					</div>					</div>					<div style="height:50px;width:300px;float:right;">					<a href="" class="save"><img src="ressources/design/style1/images/save.png"/>Sauver</a>					<a href="" class="validate"><img src="ressources/design/style1/images/validate.png"/>Appliquer</a>					<a href="" class="cancel"><img src="ressources/design/style1/images/cancel.png"/>Annuler</a>					</div>					</div>					<div class="contenu" align ="center">					<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">					<form method="post" action="<?php echo $pageRubrique."&action=5" ?>">						<p>							<input type="hidden" name="rubrique_id" value="<?php echo $rubrique2[0]; ?>"/>							<label for="titleFR" style="float : left;"><strong>Titre</strong> (FR) :</label>							<input type="text" style="margin-left:10px;" size="60" value="<?php echo $rubrique2[2]; ?>" name="titleFR"/> <br/><br/>							<label for="titleEN" style="float : left;"><strong>Titre</strong> (EN) :</label>							<input type="text" style="margin-left:10px;" size="60" value="<?php echo $rubrique2[3]; ?>" name="titleEN"/> <br/><br/>							<strong>Rubrique mère</strong> : 							<?php								listeRubriqueSelected($rubrique2[1],$rubrique2[0]);							?>						</p>						<input type="submit" value="envoyer" />					</form>					</div>				} else {					header("Location: $pageRubrique&message=rubriqueAbsente");				}				mysql_free_result($req3);			} else {				header("Location: $pageRubrique");			}		} else if ($action==3) { //supprimer une rubrique			if(isset($_GET['idRubrique'])) {				$rubr=$_GET['idRubrique'];				if (rubriqueExistante($rubr)) {					$req3 = mysql_query("DELETE FROM `rubrique` WHERE `id_rubrique`=$rubr;");					mysql_free_result($req3);					header("Location: $pageRubrique&message=rubriqueSupprimee");				} else {					header("Location: $pageRubrique&message=rubriqueAbsente");				}			}		} else if ($action==4) { //traitement d'ajout			if (isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique'])) {				$titreFR=mysql_real_escape_string($_POST['titleFR']);				$titreEN=mysql_real_escape_string($_POST['titleEN']);				$rubrique=mysql_real_escape_string($_POST['rubrique']);				//vérification de la rubrique mère				if ($rubrique=='null') {					$req="INSERT INTO `rubrique` VALUES (NULL,NULL,'".$titreFR."','".$titreEN."')";					mysql_query($req) or die(mysql_error());					mysql_free_result($req);					header("Location: $pageRubrique&message=rubriqueAjoutee");				} else {					$req=mysql_query("SELECT * FROM rubrique WHERE id_rubrique=$rubrique");					$result=mysql_fetch_array($req);					if (rubriqueExistante($result[0])) {						$req2 ="INSERT INTO rubrique  VALUES (NULL,'".$rubrique."','".$titreFR."','".$titreEN."')";						mysql_query($req2) or die(mysql_error());						header("Location: $pageRubrique&message=rubriqueAjoutee");					} else {						header("Location: $pageRubrique&message=erreurFormulaire");					}				}				mysql_free_result($req);				mysql_free_result($req2);			} else {				header("Location: $pageRubrique&message=erreurFormulaireAjout");			}		} else if ($action==5) { //traitement de MAJ			if (isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique_id']) && isset($_POST['rubrique'])) {				$titreFR=mysql_real_escape_string($_POST['titleFR']);				$titreEN=mysql_real_escape_string($_POST['titleEN']);				$rubrique=mysql_real_escape_string($_POST['rubrique_id']);				$rubrique_mere=mysql_real_escape_string($_POST['rubrique']);				//vérification de la rubrique mère				//ok				if ($rubrique_mere=='null') {					$req="UPDATE rubrique SET id_mere=NULL, titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."' WHERE id_rubrique=".$rubrique.";";					mysql_query($req) or die(mysql_error());					mysql_free_result($req);					header("Location: $pageRubrique&message=rubriqueMAJ");				} else {					$req=mysql_query("SELECT * FROM rubrique WHERE id_rubrique=$rubrique_mere");					$result=mysql_fetch_array($req);					if (rubriqueExistante($result[0])) {						$req2="UPDATE rubrique SET id_mere='".$rubrique_mere."', titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."' WHERE id_rubrique=".$rubrique.";";						mysql_query($req2) or die(mysql_error());						header("Location: $pageRubrique&message=rubriqueMAJ");					} else {						header("Location: $pageRubrique&message=erreurFormulaire");					}					mysql_free_result($req);				}			} else {				header("Location: $pageRubrique&message=puddi");			}		}	}	else 	{		if (isset($_GET['message'])) {		?>		<div class="contenu" align="center"><!-- Affichage d'un message -->			<?php				// ajouter : 				$msg=$_GET['message'];				if ($msg=="rubriqueAbsente") {					echo "La rubrique est inexistante";				} else if ($msg=="procedureAnnulee") {					echo "La procédure a été annulée";				} else if ($msg=="rubriqueSupprimee") {					echo "Votre rubrique a bien été supprimée";				} else if ($msg=="rubriqueAjoutee") {					echo "Votre rubrique a bien été ajoutée";				} else if ($msg=="erreurFormulaire") {					echo "Il y a une erreur dans le formulaire. Veuillez recommencez.";				} else if ($msg=="rubriqueMAJ") {					echo "Votre rubrique a bien été mise à jour";				}/* else if ($msg=="") {					echo "";				}*/ else {					echo $_GET['message'];				}			?>		</div>		<?php		}		?>		<div class="contenu" align="center">			<h2>Gestion des	rubriques</h2>			<a href="index.php?page=rubrique&action=1"> Ajouter un rubrique </a>			<table id='articles'>			<tr class='article'><th class='article'>Num Rubrique</th><th class='article'>Titre de la rubrique (FR)</th><th class='article'>Titre de la rubrique (EN)</th><th class='article'>Administration</th></tr>			<?php			$req = mysql_query('SELECT * FROM RUBRIQUE;');			while($rubrique = mysql_fetch_array($req))			{				echo "<tr class='article'>";				echo "<td class='article'>".$rubrique[0]."</td>";				echo "<td class='article'>".$rubrique[2]."</td>";				echo "<td class='article'>".$rubrique[3]."</td>";				echo "<td class='article'>";				echo "<a href='index.php?page=rubrique&action=2&idRubrique=".$rubrique[0]."'>Modifier</a> - ";				echo "<a href='index.php?page=rubrique&action=3&idRubrique=".$rubrique[0]."'>Supprimer</a>";				echo "</td>";				echo "</tr>";			}			mysql_free_result($req);			?>			</table>			<a href="index.php?page=rubrique&action=1"> Ajouter un rubrique </a>		</div>		<?php	}	// ?></div>