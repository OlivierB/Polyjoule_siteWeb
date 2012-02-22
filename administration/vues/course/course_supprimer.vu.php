<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'une course", "modify_course.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer la course du <b><?php echo $course[2]; ?></b> à <b><?php echo $course[3]; ?></b> ?
	</div>
	<div align="center">
			<a href="index.php?page=course&action=6&idCourse=<?php echo $course[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=course"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
