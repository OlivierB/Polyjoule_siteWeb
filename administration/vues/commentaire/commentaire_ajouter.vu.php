<!--
/**********
Page d'ajout de commentaire

**********/
-->

<div id="ajout" name="ajout">
	<form name="ajoutCom" method="POST" action="index.php?page=commentaire&id_article=<?php echo $id_article;?>&action=4">
		<div  class="editor" id="message" align="center">
		</div>
	
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("message")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "message";
			  cols = 60;
			  rows = 15;
			  value = "";
			}
		  }
		//-->
		</script>
		<noscript>
		  The editor requires scripting to be enabled.
		</noscript>
		<noscript>mce:3</noscript>
		<div align="center">
			<a href="javascript:document.ajoutCom.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=commentaire&id_article=<?php echo $id_article; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
