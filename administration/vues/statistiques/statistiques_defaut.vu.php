<!--
/**********
Page des statistiques

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Statistiques", "help.png");
	?>
	<ul class="section_name">
		<li>Statistiques membres</li>
	</ul>
	
	<div align="center">
		<?php
			echo "<img src='vues/statistiques/graphes/nbArt_par_membre.php?str=".addslashes(urlencode(serialize($graph1)))."' width='600' height='300' />";
		?>
	</div>
	
	<ul class="section_name">
		<li>Statistiques articles</li>
	</ul>
	
	<div align="center">
		<?php
			echo "<img src='vues/statistiques/graphes/history_article.php?str=".addslashes(urlencode(serialize($graph2)))."' width='600' height='300' />";
		?>
	</div>
</div>
