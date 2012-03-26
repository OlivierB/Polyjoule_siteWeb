<!--
/**********
Page d'ajout de commentaire

**********/
-->

<div id="ajout" name="ajout">
	<form name="ajoutCom" method="POST" action="index.php?page=commentaire&id_article=<?php echo $id_article;?>&action=4">
		<textarea id="message" name="message"></textarea>
	
		<script>
			CKEDITOR.replace( 'message',
			{
				toolbar : 'Basic',
				uiColor : '#468093',
				height:"150", width:"600",
			});
		</script>	
		<div align="center">
			<a href="javascript:document.ajoutCom.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=commentaire&id_article=<?php echo $id_article; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
